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
	$client->setSalesId($sales_id);
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
	$client->setOneTimeSetupFee($one_time_fee);
	$client->setRecurringMonthlyFee($recurring_fee);
	$client->setDateTime(date("Y-m-d H:i:s"));
	if (isset($UserAccount) && ($subscription_package == "free" || $subscription_package == "mini" || $subscription_package == "basic" || $subscription_package == "standard"))
		$client->addOption("eCommerce Component: User Account",$user_account);
	else if ($subscription_package == "professional" || $subscription_package == "duluxe")
		$client->addOption("eCommerce Component: User Account",0);
	if (isset($WishList) && ($subscription_package == "mini" || $subscription_package == "basic" || $subscription_package == "standard"))
		$client->addOption("eCommerce Component: Wish List",$wish_list);
	else if ($subscription_package == "professional" || $subscription_package == "duluxe")
		$client->addOption("eCommerce Component: Wish List",0);

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
	$cmd = "C:\\Verisign\\payflowpro\\win32\\bin\\pfpro test-payflow.verisign.com 443 ";
	$param =  $init_str . $invnum . $ponum . $desc . $firstname . $lastname . $street . $city . $state . $zip . $acct . $exp_date . $amt . $taxamt;
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
	$pfpro["DESC"] = "Online Store Subscription";
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
	pfpro_init();
	$transaction = pfpro_process($pfpro,"payflow.verisign.com",443,30);
	
	if ($transaction["RESULT"] == 0) {
		$client->record();
		$client->mailInvoice();
		session_unregister("client");
	} else
		$isSuccess = false;
}
?>
<html>
<head>
<title>Sales Order Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">

<? if (!$isSuccess) {?>
	<h2>ERROR: <?=$transaction["RESPMSG"]?></h2>
	
	<p>Please make sure the billing information that you enter is correct 
		and accurate.</p>
	<p align="center">|<a href="sales_order.php?Action=Add">Return to fix error</a>|</p>
<? } else {?>
	<h3>Your order has been submitted successfully. Thank You <?=$first_name?>.</h3>
<? }?>
</body>
</html>
