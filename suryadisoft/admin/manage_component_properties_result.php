<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO COMPONENT_PROPERTIES (component_name,property_name,property_type,property_default_value,property_option_values,property_description) VALUES ('$component_name','$property_name','$property_type','$property_default_value','$property_option_values','$property_description')";
else if ($Action == "Update")
	$query = "UPDATE COMPONENT_PROPERTIES SET component_name = '$component_name', property_name = '$property_name', property_type = '$property_type', property_default_value = '$property_default_value', property_option_values = '$property_option_values', property_description = '$property_description' WHERE component_name = '$component_name' AND property_name = '$old_property_name'";
else if ($Action == "Delete")
	$query = "DELETE FROM COMPONENT_PROPERTIES WHERE component_name = '$component_name' AND property_name = '$property_name'";
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
<meta http-equiv="refresh" content="0;URL=manage_component_properties.php?component_name=<?=$component_name?>">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
