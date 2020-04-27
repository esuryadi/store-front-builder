<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Update Data Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$first_time = true;

for ($i=0;$i<count($FieldName);$i++) {
	if ($FieldValue[$i] != "") {
		if ($first_time) {
			if (strtolower($FieldValue[$i]) == "null")
				$set_clause = $FieldName[$i] . " = " . strtoupper($FieldValue[$i]);
			else if (strtolower($FieldValue[$i]) != "")
				$set_clause = $FieldName[$i] . " = '" . $FieldValue[$i] . "'";
			if (strtolower($FieldValue[$i]) != "")
				$first_time = false;
		} else {
			if (strtolower($FieldValue[$i]) == "null")
				$set_clause = $set_clause . "," . $FieldName[$i] . " = " . strtoupper($FieldValue[$i]);
			else if (strtolower($FieldValue[$i]) != "")
				$set_clause = $set_clause . "," . $FieldName[$i] . " = '" . $FieldValue[$i] . "'";
		}
	}
}	 
$query = stripslashes("UPDATE $TableName SET $set_clause WHERE $WhereClause");
mysql_select_db($DatabaseName);
$isSuccess = mysql_query($query);
fwrite($log,$query . "\n\n");
if($isSuccess) {
	print ("<h1>Data has been successfully updated!</h1><p>\n");
	fwrite($log,"Data has been successfully updated!\n\n");
} else {
	print("<h1>Data cannot be updated!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<div align="center">[<a href="update_table.php">Update More Data</a>][<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>]</div>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
fclose($log);
?>