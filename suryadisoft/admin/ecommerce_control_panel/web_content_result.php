<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Create")
	$query[] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('$component_name','$title','$filename','$type','$position','$sequence','$component_type','$category','$style')";
else if ($Action == "Update")
	$query[] = "UPDATE WEB_CONTENT SET component_name = '$component_name', title = '$title', filename = '$filename', type = '$type', position = '$position', sequence = $sequence, component_type = '$component_type', category = '$category', style = '$style' WHERE id = $id";
else if ($Action == "Delete") {
	for($i=0;$i<count($id);$i++)
		$query[] = "DELETE FROM WEB_CONTENT WHERE id = " . $id[$i];
}
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
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

if (isset($show_items)) {
	$query = Array();
	if ($Action == "Create") {
		$query1 = "select MAX(id) from WEB_CONTENT";
		$rs = mysql_fetch_row(mysql_query($query1));
		$id = $rs[0];
		$query[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_items_$id','$show_items')";
	} else if ($Action == "Update") {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'show_items_$id'";
		$query_result = mysql_query($query1);
		if (mysql_num_rows($query_result) > 0)
			$query[] = "UPDATE PROPERTY SET property_name = 'show_items_$id', property_value = '$show_items' WHERE property_name = 'show_items_$id'";
		else
			$query[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_items_$id','$show_items')";
	} else if ($Action == "Delete") {
		for ($i=0;$i<count($id);$i++) 
			$query[] = "DELETE FROM PROPERTY WHERE property_name = 'show_items_" . $id[$i] . "'";
	}

	for($i=0;$i<count($query);$i++) {
		$isSuccess = mysql_query($query[$i]);
		Log::write($query[$i] . "\n\n");
		if(!$isSuccess) {
			print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
}

if (isset($num_col)) {
	$query = Array();
	if ($Action == "Create") {
		$query1 = "select MAX(id) from WEB_CONTENT";
		$rs = mysql_fetch_row(mysql_query($query1));
		$id = $rs[0];
		$query[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('num_col_$id','$num_col')";
	} else if ($Action == "Update") {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'num_col_$id'";
		$query_result = mysql_query($query1);
		if (mysql_num_rows($query_result) > 0)
			$query[] = "UPDATE PROPERTY SET property_name = 'num_col_$id', property_value = '$num_col' WHERE property_name = 'num_col_$id'";
		else
			$query[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('num_col_$id','$num_col')";
	} else if ($Action == "Delete") {
		for ($i=0;$i<count($id);$i++) 
			$query[] = "DELETE FROM PROPERTY WHERE property_name = 'num_col_" . $id[$i] . "'";
	}

	for($i=0;$i<count($query);$i++) {
		$isSuccess = mysql_query($query[$i]);
		Log::write($query[$i] . "\n\n");
		if(!$isSuccess) {
			print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
Web Content Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<? if ($Mode == "wizard") {?>
<script language="javascript">window.close();</script>
<? } else {?>
<meta http-equiv="refresh" content="0;URL=web_content_frame.php?cat=<?=urlencode($cat)?>">
<? }?>
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
