<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Clients.php";
require_once "../class/Log.php";
require_once "../path_config.php";
require_once("config.php");

$client = new Clients();
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add") {

	$client = new Clients();
	$isSuccess = true;
	$transaction = Array();

	session_register("client");
	$client->setFirstName($first_name);
	$client->setMiddleInitial($middle_initial);
	$client->setLastName($last_name);
	$client->setCompanyName($company_name);
	$client->setCompanyAddress1($company_address_1);
	$client->setCompanyAddress2($company_address_2);
	$client->setCompanyCity($company_city);
	$client->setCompanyState($company_state);
	$client->setCompanyProvince($company_province);
	$client->setCompanyZip($company_zip);
	$client->setCompanyCountry($company_country);
	$client->setCompanyPhone($company_phone);
	$client->setCompanyFax($company_fax);
	$client->setCompanyEmail($company_email);
	$client->setBillingFirstName($billing_first_name);
	$client->setBillingMiddleInitial($billing_middle_initial);
	$client->setBillingLastName($billing_last_name);
	$client->setBillingAddress1($billing_address_1);
	$client->setBillingAddress2($billing_address_2);
	$client->setBillingCity($billing_city);
	$client->setBillingState($billing_state);
	$client->setBillingProvince($billing_province);
	$client->setBillingZip($billing_zip);
	$client->setBillingCountry($billing_country);
	$client->setBillingPhone($billing_phone);
	$client->setPaymentType($payment_type);
	$client->setCCNumber($cc_number);
	$client->setCCExpDate($cc_exp_mm . $cc_exp_yyyy);
	$client->setCCVerCode($cc_ver_code);
	$client->setSubscriptionPackage($subscription_package);
	$client->setDomainName($domain_name);
	$client->setDomainStatus($domain_status);
	$client->setOneTimeSetupFee($one_time_setup_fee);
	$client->setRecurringMonthlyFee($recurring_monthly_fee);
	$client->setDateTime(date("Y-m-d H:i:s"));
	$client->setOptions($additional_options);
	
	$total = $one_time_setup_fee + $recurring_monthly_fee;
	/*
	$init_str = "TRXTYPE=S&TENDER=C&USER=suryadi&PWD=chien76&VENDOR=suryadi&PARTNER=VeriSign";
	$invnum = "&INVNUM=" . $client->getInvoiceNumber();
	$ponum = "&PONUM=" . $client->getOrderId();
	$orderdate = "&ORDERDATE=" . date("mdy");
	$desc = "&DESC=eCommerce subscription package";
	$firstname = "&FIRSTNAME=" . $client->getBillingFirstName();
	$lastname = "&LASTNAME=" . $client->getBillingLastName();
	$street = "&STREET=" . $client->getBillingAddress1() . " " . $client->getBillingAddress2();
	$city = "&CITY=" .$client->getBillingCity();
	$state = "&STATE=" . $client->getBillingState();
	$zip = "&ZIP=" . $client->getBillingZip();
	$acct = "&ACCT=" . $client->getCCNumber();
	$exp_date = "&EXPDATE=" . $client->getCCExpDate();
	$amt = "&AMT=" . $total;
	$taxamt = "&TAXAMT=0";
	$shipfromzip = "&SHIPFROMZIP=93711";
	$shiptozip = "&SHIPTOZIP=" . $client->getCompanyZip();
	$cmd = "C:\\Verisign\\payflowpro\\win32\\bin\\pfpro test-payflow.verisign.com 443 ";
	$param =  $init_str . $invnum . $ponum . $desc . $firstname . $lastname . $street . $city . $state . $zip . $acct . $exp_date . $amt . $taxamt . $shipfromzip . $shiptozip;
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
	$pfpro["INVNUM"] = $client->getInvoiceNumber();
	$pfpro["PONUM"] = $client->getOrderId();
	$pfpro["ORDERDATE"] = date("mdy");
	$pfpro["DESC"] = "mini eCommerce subscription package";
	$pfpro["FIRSTNAME"] = $client->getBillingFirstName();
	$pfpro["LASTNAME"] = $client->getBillingLastName();
	$pfpro["STREET"] = $client->getBillingAddress1() . " " . $client->getBillingAddress2();
	$pfpro["CITY"] = $client->getBillingCity();
	$pfpro["STATE"] = $client->getBillingState();
	$pfpro["ZIP"] = $client->getBillingZip();
	$pfpro["ACCT"] = $client->getCCNumber();
	$pfpro["EXPDATE"] = $client->getCCExpDate();
	$pfpro["AMT"] = $total;
	$pfpro["TAXAMT"] = "0";
	$pfpro["SHIPFROMZIP"] = "93711";
	$pfpro["SHIPTOZIP"] = $client->getCompanyZip();
	pfpro_init();
	$transaction = pfpro_process($pfpro,"payflow.verisign.com",443,30);
	
	if ($transaction["RESULT"] == 0) {
		$client->record();
		$client->mailInvoice();
		session_unregister("client");
	} else
		$isSuccess = false;

} else {

	mysql_select_db(_ADMIN_DATABASE);
	
	if ($Action == "Update") {
		$query = "UPDATE PURCHASE_ORDER SET order_status = '$order_status' WHERE order_id = $order_id";
		$query2 = "SELECT user_id, client_first_name, client_last_name, billing_address_1, billing_address_2, billing_city, billing_state, billing_zip, billing_country, billing_phone, payment_type, account_number, cc_exp_date, recurring_monthly_fee, order_date, sales_id FROM USER, PURCHASE_ORDER WHERE USER.first_name = PURCHASE_ORDER.client_first_name AND USER.last_name = PURCHASE_ORDER.client_last_name AND order_id = $order_id AND USER.user_id NOT REGEXP '^trial'";
		$rs = mysql_fetch_row(mysql_query($query2));
		$query3 = "INSERT INTO BILLING (user_id,billing_first_name,billing_last_name,billing_address_1,billing_address_2,billing_city,billing_state,billing_zip,billing_country,billing_phone,payment_type,account_number,cc_exp_date,monthly_fee,order_date,sales_id) VALUES ('$rs[0]','$rs[1]','$rs[2]','$rs[3]','$rs[4]','$rs[5]','$rs[6]','$rs[7]','$rs[8]','$rs[9]','$rs[10]','$rs[11]','$rs[12]','$rs[13]','$rs[14]','$rs[15]')";
	} else if ($Action == "Delete")
		$query = "DELETE FROM PURCHASE_ORDER WHERE order_id = $order_id";
	
	$isSuccess = mysql_query($query);
	Log::writeToFile("log.txt",$query . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	} else {
		if ($Action == "Update") {
			$success = mysql_query($query3);
			if (!$success)
				echo mysql_error();
		}
	}
	
	$db_connect->close();

	if ($Action == "Update" && $isSuccess)
		$client->mailNotification($order_id);

}
?>
<html>
<head>
<title>Manage Order Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_order.php">
<? }?>
</head>

<body vlink="00aeef">

<? if (!$isSuccess) {?>
	<h2>ERROR: <?=$transaction["RESPMSG"]?></h2>
	
	<p>Please make sure the billing information that you enter is correct 
		and accurate.</p>
	<p align="center">|<a href="manage_order.php?Action=Add">Return to fix error</a>|</p>
<? }?>

</body>
</html>
