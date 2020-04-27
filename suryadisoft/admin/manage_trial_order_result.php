<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once("config.php");
require_once("../path_config.php");

if ($Action == "Delete") {
	$admin = new Admin();
	$admin->mailExpiredTrialNote($id);
}

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Create")
	$query = "INSERT INTO TRIAL_ORDER (first_name,last_name,address_1,address_2,city,state,zip,country,phone,email,order_date,build_status) VALUES ('$first_name','$last_name','$address_1','$address_2','$city','$state','$zip','$country','$phone','$email','$order_date','pending')";
else if ($Action == "Update")
	$query = "UPDATE TRIAL_ORDER SET first_name = '$first_name', last_name = '$last_name', address_1 = '$address_1', address_2 = '$address_2', city = '$city', state = '$state', zip = '$zip', country = '$country', phone = '$phone', email = '$email' WHERE id = $id";
else if ($Action == "Delete") {
	$query = "DELETE FROM TRIAL_ORDER WHERE id = $id";
}
mysql_select_db(_ADMIN_DATABASE);

if ($Action == "Delete") {
	$query_delete = "SELECT user_id FROM TRIAL_ORDER WHERE id = $id";
	$rs = mysql_fetch_row(mysql_query($query_delete));
	$user_id = $rs[0];
}

$isSuccess = mysql_query($query);
Log::writeToFile("log.txt",$query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

if ($Action == "Create") {
	$query = "SELECT id FROM TRIAL_ORDER WHERE first_name = '$first_name' AND last_name = '$last_name'";
	$rs = mysql_fetch_row(mysql_query($query));
	$query_update = "UPDATE TRIAL_ORDER SET user_id = 'trial" . $rs[0] . "' WHERE id = " . $rs[0];
	mysql_query($query_update);
} else if ($Action == "Delete") {
	$query = Array();
	$query [] = "DELETE FROM USER WHERE user_id = '$user_id'";
	$query [] = "DELETE FROM CLIENTS WHERE user_id = '$user_id'";
	$query [] = "DELETE FROM CLIENT_COMPONENTS WHERE user_id = '$user_id'";
	$query [] = "DELETE FROM CLIENT_DATABASE WHERE user_id = '$user_id'"; 
	$query [] = "DELETE FROM CLIENT_PAYMENT_SERVICE WHERE user_id = '$user_id'";
	for ($i=0;$i<count($query);$i++)
		mysql_query($query[$i]);
	mysql_drop_db($user_id . "_db");	
}
$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Trial Order Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_trial_order.php">
<? }?>
</head>
<body vlink="00aeef">
</body>
</html>
