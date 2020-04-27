<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

if ($Action == "Set") {	
	$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CLIENT_PAYMENT_SERVICE WHERE user_id = '$user_id'"));
	if ($num_rows == 0)
		$query = "INSERT INTO CLIENT_PAYMENT_SERVICE (user_id,payment_service) VALUES ('$user_id','$Payment')";
	else
		$query = "UPDATE CLIENT_PAYMENT_SERVICE SET payment_service = '$Payment' WHERE user_id = '$user_id'";
} 

$success = true;
$isSuccess = mysql_query($query);
Log::writeToFile("log.txt",$query . "\n\n");
if(!$isSuccess) {
	$success = false;
	print("<h1>Data cannot be " . $Action . "!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Client Payment Service Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($success) {?>
<meta http-equiv="refresh" content="0;URL=manage_client_payment.php">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
