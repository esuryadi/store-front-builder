<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once "../../class/Themes.php";
require_once("../config.php");

$theme = new Themes();
$properties = $theme->getProperties($selected_theme,$selected_color_scheme);

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = "SELECT * FROM PROPERTY WHERE property_name = 'selected_theme'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('selected_theme','$selected_theme')";
else
	$query = "UPDATE PROPERTY SET property_value = '$selected_theme' WHERE property_name = 'selected_theme'";
$isSuccess = mysql_query($query);	
if(!$isSuccess) {
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	Log::write($query . "\n\n");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}
$query = "SELECT * FROM PROPERTY WHERE property_name = 'selected_color_scheme'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('selected_color_scheme','$selected_color_scheme')";
else
	$query = "UPDATE PROPERTY SET property_value = '$selected_color_scheme' WHERE property_name = 'selected_color_scheme'";
$isSuccess = mysql_query($query);	
if(!$isSuccess) {
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	Log::write($query . "\n\n");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}
for ($i=0;$i<count($properties);$i++) {
	$theme_prop = $properties[$i];
	$name = $selected_theme . "_" . str_replace(" ","_",strtolower($theme_prop["name"]));
	if ($name != ($selected_theme . "_preview_images")) {
		eval("\$value = \$$name;");		
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = '$name'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2 = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('$name','$value')";
		else
			$query2 = "UPDATE PROPERTY SET property_value = '$value' WHERE property_name = '$name'";

		$isSuccess = mysql_query($query2);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2 . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
}
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>

<meta http-equiv="refresh" content="0;URL=wizard_step_2.php?action=create_page">
