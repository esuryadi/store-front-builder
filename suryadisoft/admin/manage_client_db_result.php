<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Create")
	$query = "INSERT INTO CLIENT_DATABASE (user_id,database_name) VALUES ('$user_id','$database_name')";
else if ($Action == "Update")
	$query = "UPDATE CLIENT_DATABASE SET database_name = '$database_name' WHERE user_id = '$user_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM CLIENT_DATABASE WHERE user_id = '$user_id'";
mysql_select_db(_ADMIN_DATABASE);

$num_rows = 0;
if ($Action == "Create")
	$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CLIENT_DATABASE WHERE user_id = '$user_id'"));

if ($num_rows == 0) {
	$isSuccess = mysql_query($query);
	Log::writeToFile("log.txt",$query . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Client Database Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($num_rows == 0 && $isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_client_db.php">
<? } else {?>
<meta http-equiv="refresh" content="0;URL=manage_client_db.php?Status=failed">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
