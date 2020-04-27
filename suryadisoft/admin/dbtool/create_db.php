<?php
	require_once "../../class/User.php";
	require_once "../../class/DBConnect.php";
	require_once("../config.php");
	$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Create New Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

<?php
$HTTP_SESSION_VARS["db_connect"]->open();

if (mysql_create_db ($dbname, $HTTP_SESSION_VARS["db_connect"]->getConnection())) {
	print ("<h1>The database, $dbname, was successfully created!</h1><p>\n");
	fwrite($log,"Create Database: $dbname\n\n");
} else {
	print ("<h1>The database, $dbname, could not be created!</h1><p>\n");
	fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>

<p align="center"><a href="menu_top.php?Action=Refresh" target="topFrame"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a></p>

</body>
</html>
<?php
	fclose($log);
?>