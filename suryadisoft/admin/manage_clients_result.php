<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Create")
	$query = "INSERT INTO CLIENTS (user_id,company_name,company_url,company_address1,company_address2,company_city,company_state,company_zip,company_country,company_phone,company_fax,company_email) VALUES ('$user_id','$company_name','$company_url','$company_address1','$company_address2','$company_city','$company_state','$company_zip','$company_country','$company_phone','$company_fax','$company_email')";
else if ($Action == "Update")
	$query = "UPDATE CLIENTS SET company_name = '$company_name', company_url = '$company_url', company_address1 = '$company_address1', company_address2 = '$company_address2', company_city = '$company_city', company_state = '$company_state', company_zip = '$company_zip', company_country = '$company_country', company_phone = '$company_phone', company_fax = '$company_fax', company_email = '$company_email' WHERE user_id = '$user_id'";
else if ($Action == "Delete") {
	$query[] = "DELETE FROM CLIENTS WHERE user_id = '$user_id'";
	$query[] = "DELETE FROM CLIENT_DATABASE WHERE user_id = '$user_id'";
	$query[] = "DELETE FROM CLIENT_COMPONENTS WHERE user_id = '$user_id'";
	$query[] = "DELETE FROM CLIENT_PAYMENT_SERVICE WHERE user_id = '$user_id'";
}
mysql_select_db(_ADMIN_DATABASE);

$num_rows = 0;
if ($Action == "Create")
	$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CLIENTS WHERE user_id = '$user_id'"));

if ($Action == "Delete") {
	for ($i=0;$i<count($query);$i++) {
		$isSuccess = mysql_query($query[$i]);
		Log::writeToFile("log.txt",$query[$i] . "\n\n");
		if(!$isSuccess) {
			print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else if ($num_rows == 0) {
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
Clients Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($num_rows == 0 && $isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_clients.php">
<? } else {?>
<meta http-equiv="refresh" content="0;URL=manage_clients.php?Status=failed">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
