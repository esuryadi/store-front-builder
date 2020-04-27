<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO THEMES_PROPERTY (theme_name,theme_color_scheme,theme_property_name,theme_property_value) VALUES ('$theme_name','$theme_color_scheme','$theme_property_name','$theme_property_value')";
else if ($Action == "Update")
	$query = "UPDATE THEMES_PROPERTY SET theme_property_name = '$theme_property_name', theme_property_value = '$theme_property_value' WHERE theme_name = '$theme_name' AND theme_color_scheme = '$theme_color_scheme' AND theme_property_name = '$old_theme_property_name'";
else if ($Action == "Delete")
	$query = "DELETE FROM THEMES_PROPERTY WHERE theme_name = '$theme_name' AND theme_color_scheme = '$theme_color_scheme' AND theme_property_name = '$theme_property_name'";
mysql_select_db(_ADMIN_DATABASE);
$isSuccess = mysql_query($query);
Log::writeToFile("log.txt",$query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Themes Property Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_themes_property.php?theme_name=<?=$theme_name?>&theme_color_scheme=<?=$theme_color_scheme?>">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
