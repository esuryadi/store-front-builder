<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Database Tool - Run SQL Script Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<h1 align="center">Run SQL Script Result</h1>
<?php
if (file_exists($Filename)) {
	$HTTP_SESSION_VARS["db_connect"]->open();
	$selected_db = $HTTP_SESSION_VARS["selected_db"];
	mysql_select_db($selected_db);
	$file_in = fopen($Filename,"r");
	$i = 0;
	$query = "";
	while(!feof($file_in)) {
		$str = fgets($file_in,10000);
		if (trim($str) != "") {
			$query = $query . $str;
		} else {
			$isSuccess = mysql_query($query);
			fwrite($log,$query . "\n\n");
			if($isSuccess) {
				print ("<p><b>SQL Statement $i has been successfully executed.</b></p>\n");
				fwrite($log,"SQL Statement $i has been successfully executed.\n\n");
			} else {
				print("<p><b>SQL Statement $i cannot be executed.</b></p>\n");
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				print("<p>");
				fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			$i++;
			$query = "";
		}
	}
	fclose($file_in);
	$HTTP_SESSION_VARS["db_connect"]->close();
} else {
	echo "<h2>ERROR: File Not Found</h2>";
}
?>
<p align="center">[<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>]</p>
</body>
</html>
