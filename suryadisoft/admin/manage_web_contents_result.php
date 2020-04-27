<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Create")
	$query [] = "INSERT INTO BUILT_IN_WEB_CONTENT (component_name,title,filename,type,position,sequence,display_name,description) VALUES ('$component_name','$title','$filename','$type','$position','$sequence','$display_name','$description')";
else if ($Action == "Update") {
	$query [] = "UPDATE BUILT_IN_WEB_CONTENT SET component_name = '$component_name', title = '$title', filename = '$filename', type = '$type', position = '$position', sequence = $sequence, display_name = '$display_name', description = '$description' WHERE id = $id";
	$query [] = "UPDATE COMPONENT_DESIGN SET component_name = '$component_name' WHERE component_name = '$old_component_name'";
	$query [] = "UPDATE COMPONENT_PROPERTIES SET component_name = '$component_name' WHERE component_name = '$old_component_name'";
} else if ($Action == "Delete") {
	$query [] = "DELETE FROM BUILT_IN_WEB_CONTENT WHERE id = $id";
	$query [] = "DELETE FROM COMPONENT_DESIGN WHERE component_name = '$comp_name'";
	$query [] = "DELETE FROM COMPONENT_PROPERTIES WHERE component_name = '$comp_name'";
}
mysql_select_db(_ADMIN_DATABASE);
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

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Built-in Web Content Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_web_contents.php">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
