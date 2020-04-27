<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = "SELECT * FROM PROPERTY WHERE property_name = 'ftp_username'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ftp_username','$ftp_username')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$ftp_username' WHERE property_name = 'ftp_username'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'ftp_password'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ftp_password','$ftp_password')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$ftp_password' WHERE property_name = 'ftp_password'";

for ($i=0;$i<count($query2);$i++) {
	$isSuccess = mysql_query($query2[$i]);
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query2[$i] . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<meta http-equiv="refresh" content="0;URL=change_ftp_password.php">
