<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Remove Table Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($DatabaseName);

for ($i=0;$i<count($TableName);$i++) {
	$success = mysql_query("DROP TABLE $TableName[$i]");
	fwrite($log,"DROP TABLE $TableName[$i]\n\n");
	if ($success) {
		print "<h2>$TableName[$i] has been successfully removed.</h2>";
		fwrite($log,"DROP TABLE $TableName[$i]\n\n");
	} else {
		print "<h2>$TableName[$i] cannot be removed.</h2>";
		fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<div align="center">[<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>] 
</div>
</body>
</html>
<?php
fclose($log);
?>