<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Remove Data Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$first_time = true;

if ($WhereClause != "") 
	$where_clause = "WHERE $WhereClause";
else
	$where_clause = "";
$query = stripslashes("DELETE FROM $TableName $where_clause");
mysql_select_db($DatabaseName);
$isSuccess = mysql_query($query);
fwrite($log,$query . "\n\n");
if($isSuccess) {
	print ("<h1>Data has been successfully deleted!</h1><p>\n");
	fwrite($log,"Data has been successfully deleted!\n\n");
} else {
	print("<h1>Data cannot be deleted!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<div align="center">[<a href="remove_data.php">Delete More Data</a>][<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>]</div>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
fclose($log);
?>