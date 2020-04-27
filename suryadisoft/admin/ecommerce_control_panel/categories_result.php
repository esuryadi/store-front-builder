<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = Array();
$isSuccess = true;

if ($Action == "Add") {
	if ($category_level == "main")
		$query[] = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) VALUES ('$category_name','','')";
	else if ($category_level == "sub 1")
		$query[] = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) VALUES ('$main_category','$category_name','')";	
	else if ($category_level == "sub 2") {
		$main_category_query = "SELECT categories_main FROM CATEGORIES WHERE categories_sub_1 = '$sub_category_1' GROUP BY categories_main";
		$main_category = mysql_fetch_row(mysql_query($main_category_query));
		$query[] = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) VALUES ('" . $main_category[0] . "','$sub_category_1','$category_name')";
	}
} else if ($Action == "Update") {
	if ($category_level == "main") {
		if ($category_level == $current_category_level)
			$query[] = "UPDATE CATEGORIES SET categories_main = '$category_name' WHERE categories_main = '$category'";
		else {
			if ($current_category_level == "sub 1")
				$query[] = "UPDATE CATEGORIES SET categories_main = '$category_name', categories_sub_1 = '' WHERE categories_sub_1 = '$category'";
			else if ($current_category_level == "sub 2")
				$query[] = "UPDATE CATEGORIES SET categories_main = '$category_name', categories_sub_1 = '', categories_sub_2 = '' WHERE categories_sub_2 = '$category'";
		}
	} else if ($category_level == "sub 1") {
		if ($category_level == $current_category_level)
			$query[] = "UPDATE CATEGORIES SET categories_main = '$main_category', categories_sub_1 = '$category_name' WHERE categories_sub_1 = '$category'";
		else {
			if ($current_category_level == "main" && $category != $main_category)
				$query[] = "UPDATE CATEGORIES SET categories_main = '$main_category', categories_sub_1 = '$category_name' WHERE categories_main = '$category'";
			else if ($current_category_level == "sub 2")
				$query[] = "UPDATE CATEGORIES SET categories_main = '$main_category', categories_sub_1 = '$category_name', categories_sub_2 = '' WHERE categories_sub_2 = '$category'";
		}
			
	} else if ($category_level == "sub 2") {
		$main_category_query = "SELECT categories_main FROM CATEGORIES WHERE categories_sub_1 = '$sub_category_1' GROUP BY categories_main";
		$main_category = mysql_fetch_row(mysql_query($main_category_query));
		if ($category_level == $current_category_level)
			$query[] = "UPDATE CATEGORIES SET categories_main = '" . $main_category[0] . "', categories_sub_1 = '$sub_category_1', categories_sub_2 = '$category_name' WHERE categories_sub_2 = '$category'";
		else {
			if ($current_category_level == "main" && $category != $main_category[0])
				$query[] = "UPDATE CATEGORIES SET categories_main = '" . $main_category[0] . "', categories_sub_1 = '$sub_category_1', categories_sub_2 = '$category_name' WHERE categories_main = '$category'";
			else if ($current_category_level == "sub 1" && $category != $sub_category_1)
				$query[] = "UPDATE CATEGORIES SET categories_main = '" . $main_category[0] . "', categories_sub_1 = '$sub_category_1', categories_sub_2 = '$category_name' WHERE categories_sub_1 = '$category'";
		}
	}
} else if ($Action == "Delete") {
	if (isset($sub_cat_2) && count($sub_cat_2) > 0) {
		for ($i=0;$i<count($sub_cat_2);$i++)
			$query [] = "DELETE FROM CATEGORIES WHERE categories_sub_2 = '$sub_cat_2[$i]'";
	}
	if (isset($sub_cat_1) && count($sub_cat_1) > 0) {
		for ($i=0;$i<count($sub_cat_1);$i++)
			$query [] = "DELETE FROM CATEGORIES WHERE categories_sub_1 = '$sub_cat_1[$i]'";
	}
	if (isset($main_cat) && count($main_cat) > 0) {
		for ($i=0;$i<count($main_cat);$i++)
			$query [] = "DELETE FROM CATEGORIES WHERE categories_main = '$main_cat[$i]'";
	}
}

for ($i=0;$i<count($query);$i++) {
	$isSuccess = mysql_query($query[$i]);
	Log::write($query[$i] . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
Categories Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=categories_frame.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
