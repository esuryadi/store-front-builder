<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$admin = new Admin();
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

if ($Action == "Add" || $Action == "Update")
	$cc_exp_date = $cc_exp_mm . $cc_exp_yyyy;

if ($Action == "Add")
	$query = "INSERT INTO BILLING (user_id,billing_first_name,billing_last_name,billing_address_1,billing_address_2,billing_city,billing_state,billing_zip,billing_country,billing_phone,payment_type,account_number,cc_exp_date,monthly_fee,order_date) VALUES ('$user_id','$billing_first_name','$billing_last_name','$billing_address_1','$billing_address_2','$billing_city','$billing_state','$billing_zip','$billing_country','$billing_phone','$payment_type','$account_number','$cc_exp_date','$monthly_fee','$order_date')";
else if ($Action == "Update")
	$query = "UPDATE BILLING SET user_id = '$user_id', billing_first_name = '$billing_first_name', billing_last_name = '$billing_last_name', billing_address_1 = '$billing_address_1', billing_address_2 = '$billing_address_2', billing_city = '$billing_city', billing_state = '$billing_state', billing_zip = '$billing_zip', billing_country = '$billing_country', billing_phone = '$billing_phone', payment_type = '$payment_type', account_number = '$account_number', cc_exp_date = '$cc_exp_date', monthly_fee = '$monthly_fee' WHERE user_id = '$old_user_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM BILLING WHERE user_id = '$user_id'";
else if ($Action == "Charge") {
	$query = "SELECT * FROM BILLING WHERE user_id = '$user_id'";
	$rs = mysql_fetch_array(mysql_query($query));
	$success = true;
	$transaction = Array();
	/*
	$init_str = "TRXTYPE=S&TENDER=C&USER=suryadi&PWD=chien76&VENDOR=suryadi&PARTNER=VeriSign";
	$orderdate = "&ORDERDATE=" . $rs["order_date"];
	$firstname = "&FIRSTNAME=" . $rs["billing_first_name"];
	$lastname = "&LASTNAME=" . $rs["billing_last_name"];
	$street = "&STREET=" . $rs["billing_address_1"] . " " . $rs["billing_address_2"];
	$city = "&CITY=" . $rs["billing_city"];
	$state = "&STATE=" . $rs["billing_state"];
	$zip = "&ZIP=" . $rs["billing_zip"];
	$acct = "&ACCT=" . $rs["account_number"];
	$exp_date = "&EXPDATE=" . $rs["cc_exp_date"];
	$amt = "&AMT=" . $rs["monthly_fee"];
	$cmd = "C:\\Verisign\\payflowpro\\win32\\bin\\pfpro test-payflow.verisign.com 443 ";
	$param =  $init_str . $firstname . $lastname . $acct . $exp_date . $amt;
	$result = exec($cmd . "\"" . $param . "\"" . " 30");
	$valArray = explode('&', $result);	
	for($i=0;$i<count($valArray);$i++) {
		$valArray2 = explode('=', $valArray[$i]);
		$transaction[$valArray2[0]] = $valArray2[1];
	}
	*/
	$pfpro["TRXTYPE"] = "S";
	$pfpro["TENDER"] = "C";
	$pfpro["USER"] = "es7911ca";
	$pfpro["PWD"] = "sweetchien76";
	$pfpro["VENDOR"] = "es7911ca";
	$pfpro["PARTNER"] = "tmerchant";
	$pfpro["ORDERDATE"] = $rs["order_date"];
	$pfpro["FIRSTNAME"] = $rs["billing_first_name"];
	$pfpro["LASTNAME"] = $rs["billing_last_name"];
	$pfpro["STREET"] = $rs["billing_address_1"] . " " . $rs["billing_address_2"];
	$pfpro["CITY"] = $rs["billing_city"];
	$pfpro["STATE"] = $rs["billing_state"];
	$pfpro["ZIP"] = $rs["billing_zip"];
	$pfpro["ACCT"] = $rs["account_number"];
	$pfpro["EXPDATE"] = $rs["cc_exp_date"];
	$pfpro["AMT"] = $rs["monthly_fee"];
	pfpro_init();
	$transaction = pfpro_process($pfpro,"payflow.verisign.com",443,30);
	
	if ($transaction["RESULT"] != 0)
		$success = false;
	else
		$admin->addBillingRecord($rs["user_id"],"paid");
}

$num_rows = 0;
if ($Action == "Add")
	$num_rows = mysql_num_rows(mysql_query("SELECT * FROM BILLING WHERE user_id = '$user_id'"));

if ($Action != "Charge" && $num_rows == 0) {
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
Billing Info Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if (isset($isSuccess)) {?>
	<? if($num_rows == 0 && $isSuccess) {?>
	<meta http-equiv="refresh" content="0;URL=manage_billing.php">
	<? } else {?>
	<meta http-equiv="refresh" content="0;URL=manage_billing.php?Action=Add&Status=failed">
	<? }?>
<? }?>
</head>

<body vlink="00aeef">

<? if (isset($success)) {?>
	<? if ($success) {?>
		<h2>RESULT: <?=$transaction["RESPMSG"]?></h2>
		<p align="center">|<a href="manage_billing.php">Back</a>|</p>
	<? } else {?>
		<h2>ERROR: <?=$transaction["RESPMSG"]?></h2>
		
		<p>Please make sure the billing information that you enter is correct 
			and accurate.</p>
		<p align="center">|<a href="manage_billing.php?Action=Add">Return to fix error</a>|</p>
	<? }?>
<? }?>

</body>
</html>
