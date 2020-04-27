<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<title>Create New Table Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

<?php
$column = $HTTP_SESSION_VARS["column"];
$data_type = $HTTP_SESSION_VARS["data_type"];
$options = $HTTP_SESSION_VARS["options"];
$length = $HTTP_SESSION_VARS["length"];
$decimal = $HTTP_SESSION_VARS["decimal"];
$isNullAllowed = $HTTP_SESSION_VARS["isNullAllowed"];
$isAutoIncrement = $HTTP_SESSION_VARS["isAutoIncrement"];
$isUnsigned = $HTTP_SESSION_VARS["isUnsigned"];

for ($i=0;$i<count($column);$i++) {
	if ($options[$i] != "")
		$str1 = " ($options[$i]) ";
	else
		$str1 = "";
		
	if ($length[$i] > 0)
		$str2 = " ($length[$i]) ";
	else
		$str2 = "";
		
	if ($decimal[$i] != "")
		$str3 = " ($decimal[$i]) ";
	else
		$str3 = "";
		
	if ($isUnsigned[$i])
		$str4 = " UNSIGNED ";
	else
		$str4 = "";
		
	if (!$isNullAllowed[$i])
		$str5 = " NOT NULL ";
	else
		$str5 = "";
		
	if ($isAutoIncrement[$i])
		$str6 = " AUTO_INCREMENT ";
	else
		$str6 = "";
		
	if ($i == 0) {
		$col_str = "$column[$i] $data_type[$i]" . $str1 . $str2 . $str3 . $str4 . $str5 . $str6;
	} else {
		$col_str = $col_str . ", $column[$i] $data_type[$i]" . $str1 . $str2 . $str3 . $str4 . $str5 . $str6;
	}
}

if (isset($PrimaryKey))
	$col_str = $col_str . ", PRIMARY KEY($PrimaryKey)";
	
if (isset($TableIndex))
	$col_str = $col_str . ", INDEX($TableIndex)";
	
$query = "CREATE TABLE $TableName ($col_str)";
echo $query;
$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($DatabaseName);
$isSuccess = mysql_query($query);

fwrite($log,$query . "\n\n");
	
if($isSuccess) {
	print ("<h1>The table, $TableName, was successfully created!</h1><p>\n");
	fwrite($log,"Table $TableName was successfully created!\n\n");
} else {
	print("<h1>The table, $TableName, could not be created!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	fwrite($log,"ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>

<p align="center">[<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>]</p>
</body>
</html>
<?php
	fclose($log);
	session_unregister("column");
	session_unregister("data_type");
	session_unregister("options");
	session_unregister("length");
	session_unregister("decimal");
	session_unregister("primary_key_index");
	session_unregister("isNullAllowed");
	session_unregister("isAutoIncrement");
	session_unregister("isUnsigned");
	session_unregister("table_index");
?>