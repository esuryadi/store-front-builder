<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO THEMES_COLOR_SCHEME (theme_name,theme_color_scheme) VALUES ('$theme_name','$theme_color_scheme')";
else if ($Action == "Update")
	$query = "UPDATE THEMES_COLOR_SCHEME SET theme_color_scheme = '$theme_color_scheme' WHERE theme_name = '$theme_name' AND theme_color_scheme = '$old_theme_color_scheme'";
else if ($Action == "Delete")
	$query = "DELETE FROM THEMES_COLOR_SCHEME WHERE theme_name = '$theme_name' AND theme_color_scheme = '$theme_color_scheme'";
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
Themes Color Scheme Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_themes_color_scheme.php?theme_name=<?=$theme_name?>">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
