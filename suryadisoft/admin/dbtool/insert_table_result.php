<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>

<html>
<head>
<title>Insert Data into Table Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$first_time = true;

for ($i=0;$i<count($FieldName);$i++) {
	if ($FieldValue[$i] != "") {
		if ($first_time) {
			$field_name = $FieldName[$i];
			if (strtolower($FieldValue[$i]) == "null")
				$field_value = strtoupper($FieldValue[$i]);
			else
				$field_value = "'" . $FieldValue[$i] . "'";
			$first_time = false;
		} else {
			$field_name = $field_name . "," . $FieldName[$i];
			if (strtolower($FieldValue[$i]) == "null")
				$field_value = $field_value . "," . strtoupper($FieldValue[$i]);
			else
				$field_value = $field_value . ",'" . $FieldValue[$i] . "'";
		}
	}
}	 
$query = "INSERT INTO $TableName ($field_name) VALUES ($field_value)";
mysql_select_db($DatabaseName);
$isSuccess = mysql_query($query);
fwrite($log,$query . "\n\n");
if($isSuccess) {

	print ("Data has been successfully inserted!<p>\n");

	fwrite($log,"Data has been successfully inserted!\n\n");
} else {

	print("Data cannot be inserted!<p>\n");

	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
  </font> </p>
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="insert_table.php">Insert 
  More Data</a> | <a href="menu_top.php?Action=Refresh" target="topFrame">Back</a></font> 
</p>
</body>
</html>
<?php
fclose($log);
?>