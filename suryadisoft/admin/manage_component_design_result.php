<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO COMPONENT_DESIGN (component_name,design_style,filename,preview_images) VALUES ('$component_name','$design_style','$filename','$preview_images')";
else if ($Action == "Update")
	$query = "UPDATE COMPONENT_DESIGN SET design_style = '$design_style', filename = '$filename', preview_images = '$preview_images' WHERE component_name = '$component_name' AND design_style = '$old_design_style'";
else if ($Action == "Delete")
	$query = "DELETE FROM COMPONENT_DESIGN WHERE component_name = '$component_name' AND design_style = '$design_style'";
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
Component Design Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_component_design.php?component_name=<?=$component_name?>">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
