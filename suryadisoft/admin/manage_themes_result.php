<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO THEMES (theme_name,theme_directory,theme_filename) VALUES ('$theme_name','$theme_directory','$theme_filename')";
else if ($Action == "Update")
	$query = "UPDATE THEMES SET theme_name = '$theme_name', theme_directory = '$theme_directory', theme_filename = '$theme_filename' WHERE theme_name = '$old_theme_name'";
else if ($Action == "Delete") {
	$query[] = "DELETE FROM THEMES WHERE theme_name = '$theme_name'";
	$query[] = "DELETE FROM THEMES_PROPERTY WHERE theme_name = '$theme_name'";
}

mysql_select_db(_ADMIN_DATABASE);
	
if ($Action == "Delete") {
	for ($i=0;$i<count($query);$i++) {
		$isSuccess = mysql_query($query[$i]);
		Log::writeToFile("log.txt",$query[$i] . "\n\n");
		if(!$isSuccess) {
			print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else {
	$isSuccess = mysql_query($query);
	Log::writeToFile("log.txt",$query . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Themes Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_themes.php">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
