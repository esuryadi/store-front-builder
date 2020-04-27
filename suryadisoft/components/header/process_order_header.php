<?php
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$user_id = $user->getUserId();
	$shopping_cart = new ShoppingCart();
} else {
	$user_id = "";
	$shopping_cart = $HTTP_SESSION_VARS["shopping_cart"];
}

$success = false;
$trx = Array();

if (isset($HTTP_SESSION_VARS["customer"])) {
	$customer = $HTTP_SESSION_VARS["customer"];
	$transaction = new Transaction();
	if ($payment->getPaymentService(_USER) == "PayPal" || $customer->getPaymentMethod() == "PayPal" || $customer->getPaymentMethod() == "Check") {
		$result = 0;
		$SubTotalCharges = $HTTP_SESSION_VARS["SubTotalCharges"];
		$SalesTax = $HTTP_SESSION_VARS["SalesTax"];
		$Shipping = $HTTP_SESSION_VARS["Shipping"];
		$TotalCharges = $HTTP_SESSION_VARS["TotalCharges"];
		$DiscountValue = $HTTP_SESSION_VARS["DiscountValue"];
		$transaction->getInvoiceNumber();
		$transaction->getTransactionId();
		if (session_is_registered("TotalCharges"))
			session_unregister("TotalCharges");
		if (session_is_registered("SubTotalCharges"))
			session_unregister("SubTotalCharges");
		if (session_is_registered("SalesTax"))
			session_unregister("SalesTax");
		if (session_is_registered("Shipping"))
			session_unregister("Shipping");
		if (session_is_registered("DiscountValue"))
			session_unregister("DiscountValue");
	} else if ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link") {
		if (WebContent::getPropertyValue("record_transaction") == "yes")
			$result = 0;
		else
			$result = $RESULT;
		$message = $RESPMSG;
		$SubTotalCharges = $HTTP_SESSION_VARS["SubTotalCharges"];
		$SalesTax = $HTTP_SESSION_VARS["SalesTax"];
		$Shipping = $HTTP_SESSION_VARS["Shipping"];
		$DiscountValue = $HTTP_SESSION_VARS["DiscountValue"];
		$TotalCharges = $HTTP_SESSION_VARS["TotalCharges"];
		$transaction->getInvoiceNumber();
		$transaction->getTransactionId();
		
		if (session_is_registered("TotalCharges"))
			session_unregister("TotalCharges");
		if (session_is_registered("SubTotalCharges"))
			session_unregister("SubTotalCharges");
		if (session_is_registered("SalesTax"))
			session_unregister("SalesTax");
		if (session_is_registered("Shipping"))
			session_unregister("Shipping");
		if (session_is_registered("DiscountValue"))
			session_unregister("DiscountValue");
	} else if ($payment->getPaymentService(_USER) == "Authorize.Net") {
		$result = -1;
		$message = "ERROR";
		$SubTotalCharges = $HTTP_SESSION_VARS["SubTotalCharges"];
		$SalesTax = $HTTP_SESSION_VARS["SalesTax"];
		$Shipping = $HTTP_SESSION_VARS["Shipping"];
		$DiscountValue = $HTTP_SESSION_VARS["DiscountValue"];
		$TotalCharges = $HTTP_SESSION_VARS["TotalCharges"];
		$transaction->getInvoiceNumber();
		$transaction->getTransactionId();
		
		if (session_is_registered("SubTotalCharges"))
			session_unregister("SubTotalCharges");
		if (session_is_registered("SalesTax"))
			session_unregister("SalesTax");
		if (session_is_registered("Shipping"))
			session_unregister("Shipping");
		if (session_is_registered("DiscountValue"))
			session_unregister("DiscountValue");
	} else if ($payment->getPaymentService(_USER) == "VeriSign PayFlow Pro") {
		/*
		$trxtype = "TRXTYPE=" . WebContent::getPropertyValue("verisign_trxtype");
		$tender = "&TENDER=" . WebContent::getPropertyValue("verisign_tender");
		$user = "&USER=" .  WebContent::getPropertyValue("verisign_user_id");
		$pwd = "&PWD=" . WebContent::getPropertyValue("verisign_password");
		$vendor = "&VENDOR=" . WebContent::getPropertyValue("verisign_vendor");
		$partner = "&PARTNER=" . WebContent::getPropertyValue("verisign_partner");
		$invnum = "&INVNUM=" . $transaction->getInvoiceNumber();
		$ponum = "&PONUM=" . $transaction->getTransactionId();
		$orderdate = "&ORDERDATE=" . date("mdy");
		$desc = "&DESC=" . $adminuser->getCompanyName() . " sales";
		$firstname = "&FIRSTNAME=" . $customer->getBillingFirstName();
		$lastname = "&LASTNAME=" . $customer->getBillingLastName();
		$street = "&STREET=" . $customer->getBillingAddress1() . " " . $customer->getBillingAddress2();
		$city = "&CITY=" . $customer->getBillingCity();
		$state = "&STATE=" . $customer->getBillingState();
		$zip = "&ZIP=" . $customer->getBillingZip();
		$acct = "&ACCT=" . $customer->getAccountNumber();
		$exp_date = "&EXPDATE=" . $customer->getCreditCardExpDate();
		$amt = "&AMT=" . $TotalCharges;
		$taxamt = "&TAXAMT=" . $SalesTax;
		$shipfromzip = "&SHIPFROMZIP=" . $adminuser->getCompanyZip();
		$shiptozip = "&SHIPTOZIP=" . $customer->getBillingZip();
		$cmd = "C:\\Verisign\\payflowpro\\win32\\bin\\pfpro " . WebContent::getPropertyValue("verisign_trxmode") . " 443 ";
		$param =  $trxtype . $tender . $user . $pwd . $vendor . $partner . $invnum . $ponum . $desc . $firstname . $lastname . $street . $city . $state . $zip . $acct . $exp_date . $amt . $taxamt . $shipfromzip . $shiptozip;
		$result = exec($cmd . "\"" . $param . "\"" . " 30");
		$myarray = explode('&', $result);	
		for($i=0;$i<count($myarray);$i++) {
			$myarray2 = explode('=', $myarray[$i]);
			$trx[$myarray2[0]] = $myarray2[1];
		}
		*/
		$pfpro["TRXTYPE"] = WebContent::getPropertyValue("verisign_trxtype");
		$pfpro["TENDER"] = WebContent::getPropertyValue("verisign_tender");
		$pfpro["USER"] = WebContent::getPropertyValue("verisign_user_id");
		$pfpro["PWD"] = WebContent::getPropertyValue("verisign_password");
		$pfpro["VENDOR"] = WebContent::getPropertyValue("verisign_vendor");
		$pfpro["PARTNER"] = WebContent::getPropertyValue("verisign_partner");
		$pfpro["INVNUM"] = $transaction->getInvoiceNumber();
		$pfpro["PONUM"] = $transaction->getTransactionId();
		$pfpro["ORDERDATE"] = date("mdy");
		$pfpro["DESC"] = $adminuser->getCompanyName() . " sales";
		$pfpro["FIRSTNAME"] = $customer->getBillingFirstName();
		$pfpro["LASTNAME"] = $customer->getBillingLastName();
		$pfpro["STREET"] = $customer->getBillingAddress1() . " " . $customer->getBillingAddress2();
		$pfpro["CITY"] = $customer->getBillingCity();
		$pfpro["STATE"] = $customer->getBillingState();
		$pfpro["ZIP"] = $customer->getBillingZip();
		$pfpro["ACCT"] = $customer->getAccountNumber();
		$pfpro["EXPDATE"] = $customer->getCreditCardExpDate();
		$pfpro["AMT"] = $TotalCharges;
		$pfpro["TAXAMT"] = $SalesTax;
		$pfpro["SHIPFROMZIP"] = $adminuser->getCompanyZip();
		$pfpro["SHIPTOZIP"] = $customer->getBillingZip();
		pfpro_init();
		$trx = pfpro_process($pfpro,WebContent::getPropertyValue("verisign_trxmode"),443,30);
				
		$result = $trx["RESULT"];
		$message = $trx["RESPMSG"];
	} else if ($payment->getPaymentService(_USER) == "Paradata") {
		if (WebContent::getPropertyValue("paradata_trxmode") == "test")
			define("TEST_TOKEN", WebContent::getPropertyValue("token_id"));
		else
			define("TOKEN", WebContent::getPropertyValue("token_id"));
		define("CURRENCY", "840");  // US Dollar
	
		$errorMessages = array();
	
		$creditCardRequest = new TransactionRequest();	
		
		if (WebContent::getPropertyValue("paradata_trxmode") == "test")
			$creditCardRequest->setAccountToken(TEST_TOKEN);
		else
			$creditCardRequest->setAccountToken(TOKEN);
		$creditCardRequest->setCurrency(CURRENCY);
		$creditCardRequest->setChargeType(WebContent::getPropertyValue("paradata_trxtype"));	
	
		// Populate request with data from web form
		$billAddressOne = $customer->getBillingAddress1();
		if($billAddressOne != "") {
			if(!$creditCardRequest->setBillAddressOne($billAddressOne)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$billAddressTwo = $customer->getBillingAddress2();
		if($billAddressTwo != "") {
			if(!$creditCardRequest->setBillAddressTwo($billAddressTwo))	{
				$errorMessages[] = $creditCardRequest->getError();
			}
		}	
		
		$billCity = $customer->getBillingCity();
		if($billCity != "") {
			if(!$creditCardRequest->setBillCity($billCity)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$billEmail = $customer->getEmail();
		if($billEmail != "") {
			if(!$creditCardRequest->setBillEmail($billEmail)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
			
		$billFirstName = $customer->getBillingFirstName();
		if($billFirstName != "") {
			if(!$creditCardRequest->setBillFirstName($billFirstName)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$billLastName = $customer->getBillingLastName();
		if($billLastName != "") {
			if(!$creditCardRequest->setBillLastName($billLastName)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$billMiddleName = $customer->getBillingMiddleInitial();
		if($billMiddleName != "") {
			if(!$creditCardRequest->setBillMiddleName($billMiddleName)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
			
		$billPhone = $customer->getBillingPhone();
		if($billPhone != "") {
			if(!$creditCardRequest->setBillPhone($billPhone)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$billZipOrPostalCode = $customer->getBillingZip();
		if($billZipOrPostalCode != "") {
			if(!$creditCardRequest->setBillZipOrPostalCode($billZipOrPostalCode)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$billStateOrProvince = ($customer->getBillingState() != "")?$customer->getBillingState():$customer->getBillingProvince();
		if($billStateOrProvince != "") {
			if(!$creditCardRequest->setBillStateOrProvince($billStateOrProvince)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$cardBrand = strtoupper($customer->getPaymentType());
		if($cardBrand != "") {
			if(!$creditCardRequest->setCardBrand($cardBrand)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$chargeTotal = $TotalCharges;
		if($chargeTotal != "") {
			if(!$creditCardRequest->setChargeTotal($chargeTotal)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$creditCardNumber = $customer->getAccountNumber();
		if($creditCardNumber != "") {
			if(!$creditCardRequest->setCreditCardNumber($creditCardNumber)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$creditCardVerificationNumber = $customer->getCreditCardVerCode();
		if($creditCardVerificationNumber != "") {
			if(!$creditCardRequest->setCreditCardVerificationNumber($creditCardVerificationNumber)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$expireMonth = intval(substr($customer->getCreditCardExpDate(),0,2));
		if($expireMonth != "") {
			if(!$creditCardRequest->setExpireMonth($expireMonth)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$expireYear = "20" . substr($customer->getCreditCardExpDate(),2,2);
		if($expireYear != "") {
			if(!$creditCardRequest->setExpireYear($expireYear)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$orderDescription = $adminuser->getCompanyName() . " sales";
		if($orderDescription != "") {
			if(!$creditCardRequest->setOrderDescription($orderDescription)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$orderID = $transaction->getTransactionId();
		if($orderID != "") {
			if(!$creditCardRequest->setOrderID($orderID)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipAddressOne = $customer->getShippingAddress1();
		if($shipAddressOne != "") {
			if(!$creditCardRequest->setShipAddressOne($shipAddressOne)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipAddressTwo = $customer->getShippingAddress2();
		if($shipAddressTwo != "") {
			if(!$creditCardRequest->setShipAddressTwo($shipAddressTwo))	{
				$errorMessages[] = $creditCardRequest->getError();
			}
		}	
		
		$shipCity = $customer->getShippingCity();
		if($shipCity != "") {
			if(!$creditCardRequest->setShipCity($shipCity)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipEmail = $customer->getEmail();
		if($shipEmail != "") {
			if(!$creditCardRequest->setShipEmail($shipEmail)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipFirstName = $customer->getShippingFirstName();
		if($shipFirstName != "") {
			if(!$creditCardRequest->setShipFirstName($shipFirstName)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipLastName = $customer->getShippingLastName();
		if($shipLastName != "") {
			if(!$creditCardRequest->setShipLastName($shipLastName)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipMiddleName = $customer->getShippingMiddleInitial();
		if($shipMiddleName != "") {
			if(!$creditCardRequest->setShipMiddleName($shipMiddleName)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
			
		$shipZipOrPostalCode = $customer->getShippingZip();
		if($shipZipOrPostalCode != "") {
			if(!$creditCardRequest->setShipZipOrPostalCode($shipZipOrPostalCode)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$shipStateOrProvince = ($customer->getShippingState() != "")?$customer->getShippingState():$customer->getShippingProvince();
		if($shipStateOrProvince != "") {
			if(!$creditCardRequest->setShipStateOrProvince($shipStateOrProvince)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}	
		
		$shippingCharge = $Shipping;
		if($shippingCharge != "") {
			if(!$creditCardRequest->setShippingCharge($shippingCharge)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		$taxAmount = $SalesTax;
		if($taxAmount != "") {
			if(!$creditCardRequest->setTaxAmount($taxAmount)) {
				$errorMessages[] = $creditCardRequest->getError();
			}
		}
		
		if(sizeof($errorMessages) != 0) {
			$result = -1;
			foreach ($errorMessages as $error) 
				$message = "<li>$error</li>";
		} else {
			$creditCardResponse = $creditCardRequest->doTransaction();
			if($creditCardResponse) {
				if($creditCardResponse->getResponseCode() == RC_SUCCESSFUL_TRANSACTION)
					$result = 0;
				else {
					$result = -1;
					$message = $creditCardRequest->getError();
				}
			} else {
				$result = -1;
				$message = $creditCardRequest->getError();
			}
		}
	} else {
		$result = 0;
		$transaction->getInvoiceNumber();
		$transaction->getTransactionId();
	}

	if ($result == 0) {
		$customer->storeCustomerData();
		$purchase = new Purchase();
		$transaction->setCustomerId($customer->getCustomerId());
		$transaction->setShippingId($customer->getShippingId());
		$transaction->setBillingId($customer->getBillingId());
		$transaction->setSubTotalCharges($SubTotalCharges);
		$transaction->setTotalCharges($TotalCharges);
		$transaction->setTaxCharges($SalesTax);
		$transaction->setShippingCharges($Shipping);
		$transaction->setCouponCode($coupon_code);
		$transaction->setDiscountValue($DiscountValue);
		$transaction->setDateTime(date("Y-m-d H:i:s"));
		$transaction->storeTransaction();
		$transaction->retrieveTransaction();
		$purchase->setCustomerId($customer->getCustomerId());
		$purchase->setTransactionId($transaction->getTransactionId());
		$purchase->storePurchase($shopping_cart->getItems($user_id),$user);
		$transaction->mailInvoice($customer->getMessage(),$shipping->getAddressType());
		$shopping_cart->emptyCart($user_id);
		$product = new Product();
		$product->deleteCoupons($HTTP_SESSION_VARS["product_coupons"]);
		if ($payment->getPaymentService(_USER) != "VeriSign PayFlow Link" || ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && WebContent::getPropertyValue("show_payment_button") == "yes")) {
			if (session_is_registered("affiliate")) {
				$HTTP_SESSION_VARS["affiliate"]->setTotalSales($SubTotalCharges);
				$HTTP_SESSION_VARS["affiliate"]->increaseTotalPurchase();
				session_unregister("affiliate");
			}
			session_unregister("shipping");
			if (session_is_registered("shopping_cart"))
				session_unregister("shopping_cart");
			session_unregister("customer");
			session_unregister("product_coupons");
			session_unregister("sub_total");
		}
		$success = true;
	} 
} 

$admin_first_name = $adminuser->getFirstName();
$admin_last_name = $adminuser->getLastName();
$admin_email = $adminuser->getEmail();
$company_name = $adminuser->getCompanyName();
$company_url = $adminuser->getCompanyURL();
$company_address_1 = $adminuser->getCompanyAddress1();
$company_address_2 = $adminuser->getCompanyAddress2();
$company_city = $adminuser->getCompanyCity();
$company_state = $adminuser->getCompanyState();
$company_zip = $adminuser->getCompanyZip();
$company_country = $adminuser->getCompanyCountry();
$company_phone = $adminuser->getCompanyPhone();
$company_fax = $adminuser->getCompanyFax();
$company_email = $adminuser->getCompanyEmail();
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$user_first_name = $user->getFirstName();
	$user_last_name = $user->getLastName();
	$user_email = $user->getEmail();
	$user_id = $user->getUserId();
	$user_password = $user->getPassword();
}
?>
<? if ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && WebContent::getPropertyValue("show_payment_button") != "yes") {?>
<? if (!isset($HTTP_SESSION_VARS["return_from_verisign"])) {?>
<form name="verisign" method="POST" action="https://payflowlink.verisign.com/payflowlink.cfm">
<input type="hidden" name="TYPE" value="<?=$TYPE?>">
<input type="hidden" name="LOGIN" value="<?=$LOGIN?>">
<input type="hidden" name="PARTNER" value="<?=$PARTNER?>">
<input type="hidden" name="METHOD" value="<?=$METHOD?>">
<input type="hidden" name="INVOICE" value="<?=$INVOICE?>">
<input type="hidden" name="PONUM" value="<?=$PONUM?>">
<input type="hidden" name="DESCRIPTION" value="<?=$DESCRIPTION?>">
<input type="hidden" name="NAME" value="<?=$NAME?>">
<input type="hidden" name="ADDRESS" value="<?=$ADDRESS?>">
<input type="hidden" name="CITY" value="<?=$CITY?>">
<input type="hidden" name="STATE" value="<?=$STATE?>">
<input type="hidden" name="ZIP" value="<?=$ZIP?>">
<input type="hidden" name="PHONE" value="<?=$PHONE?>">
<input type="hidden" name="AMOUNT" value="<?=$AMOUNT?>">
<input type="hidden" name="TAX" value="<?=$TAX?>">
<input type="hidden" name="SHIPAMOUNT" value="<?=$SHIPAMOUNT?>">
<input type="hidden" name="ADDRESSTOSHIP" value="<?=$ADDRESSTOSHIP?>">
<input type="hidden" name="CITYTOSHIP" value="<?=$CITYTOSHIP?>">
<input type="hidden" name="STATETOSHIP" value="<?=$STATETOSHIP?>">
<input type="hidden" name="ZIPTOSHIP" value="<?=$ZIPTOSHIP?>">
<input type="hidden" name="EMAIL" value="<?=$EMAIL?>">
<input type="hidden" name="EMAILTOSHIP" value="<?=$EMAILTOSHIP?>">
<input type="hidden" name="NAMETOSHIP" value="<?=$NAMETOSHIP?>">
<input type="hidden" name="ECHODATA" value="True">
<input type="hidden" name="EMAILCUSTOMER" value="<?=$EMAILCUSTOMER?>">
<input type="hidden" name="ORDERFORM" value="<?=$ORDERFORM?>">
<input type="hidden" name="SHOWCONFIRM" value="<?=$SHOWCONFIRM?>">
</form>
<? $return_from_verisign = true;
session_register("return_from_verisign");?>
<script language="JavaScript">
<!--
document.verisign.submit();
-->
</script>
<? } else {
	session_unregister("return_from_verisign");
	$success = ($RESULT == 0)?true:false;
	$message = $RESPMSG;
}?>
<? } else if ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && WebContent::getPropertyValue("show_payment_button") == "yes") {
	if (!isset($HTTP_SESSION_VARS["return_from_verisign"])) {
		$return_from_verisign = true;
		session_register("return_from_verisign");
	} else {
		session_unregister("return_from_verisign");
		$success = ($RESULT == 0)?true:false;
		$message = $RESPMSG;
	}
}?>