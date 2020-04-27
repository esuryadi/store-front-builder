<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO REFERRAL (referral_id,first_name,middle_initial,last_name,address_1,address_2,city,state,zip,country,phone) VALUES ('$referral_id','$first_name','$middle_initial','$last_name','$address_1','$address_2','$city','$state','$zip','$country','$phone')";
else if ($Action == "Update")
	$query = "UPDATE REFERRAL SET referral_id = '$referral_id', first_name = '$first_name', middle_initial = '$middle_initial', last_name = '$last_name', address_1 = '$address_1', address_2 = '$address_2', city = '$city', state = '$state', zip = '$zip', country = '$country', phone = '$phone', paid_amount = '$paid_amount' WHERE referral_id = '$old_referral_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM REFERRAL WHERE referral_id = '$referral_id'";
else if ($Action == "Pay") {
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT paid_amount FROM REFERRAL WHERE referral_id = '$referral_id'";
	$rs = mysql_fetch_row(mysql_query($query));
	$paid_amount = $rs[0];
	$query = "UPDATE REFERRAL SET paid_amount = '" . ($paid_amount + $amount) . "' WHERE referral_id = '$referral_id'";
}

mysql_select_db(_ADMIN_DATABASE);

$isSuccess = mysql_query($query);
Log::writeToFile("log.txt",$query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
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
Referral Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_referral.php">
<? } else {?>
<meta http-equiv="refresh" content="0;URL=manage_referral.php?Action=Add&Status=failed">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
