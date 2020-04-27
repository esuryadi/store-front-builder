<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Remove Database Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

for ($i=0;$i<count($DatabaseName);$i++) {
	$success = mysql_drop_db($DatabaseName[$i]);
	if ($success) {
		print "<h2>$DatabaseName[$i] has been successfully removed.</h2>";
		fwrite($log,"$DatabaseName[$i] has been successfully removed.\n\n");
	} else {
		print "<h2>$DatabaseName[$i] cannot be removed.</h2>";
		fwrite($log,"$DatabaseName[$i] cannot be removed.\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<p align="center">[<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>]</p>
</body>
</html>
<?php
fclose($log);
?>