<html>
<head>
   <title>Demo Store Sale Results</title>
</head>
<STYLE TYPE="text/css">
  H1 { font-size: x-large; color: darkblue }
  H2 { font-size: large; color: darkblue }
  BODY { font-family: Arial, Helvetica, sans-serif }
</STYLE>

<body bgcolor="#FFFFFF" text="#000000">

<?php
	include("Paygateway.php");
	include("CountryCodes.php");
	
	define("TEST_TOKEN", "195325FCC230184964CAB3A8D93EEB31888C42C714E39CBBB2E541884485D04B");
	define("CURRENCY", "840");  // US Dollar
	
	$errorMessages = array();
	
	$creditCardRequest = new TransactionRequest();	
	
	$creditCardRequest->setAccountToken(TEST_TOKEN);
	$creditCardRequest->setCurrency(CURRENCY);
	$creditCardRequest->setChargeType(SALE);	

	// Populate request with data from web form
	$billAddressOne = $HTTP_POST_VARS["bill_address_one"];
	if($billAddressOne != "") {
		if(!$creditCardRequest->setBillAddressOne($billAddressOne)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billAddressTwo = $HTTP_POST_VARS["bill_address_two"];
	if($billAddressTwo != "") {
		if(!$creditCardRequest->setBillAddressTwo($billAddressTwo))	{
			$errorMessages[] = $creditCardRequest->getError();
		}
	}	
	
	$billCity = $HTTP_POST_VARS["bill_city"];
	if($billCity != "") {
		if(!$creditCardRequest->setBillCity($billCity)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billCompany = $HTTP_POST_VARS["bill_company"];
	if($billCompany != "") {
		if(!$creditCardRequest->setBillCompany($billCompany)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billCountryCode = $HTTP_POST_VARS["bill_country_code"];
	if($billCountryCode != "") {
		if(!$creditCardRequest->setBillCountryCode($billCountryCode)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billCustomerTitle = $HTTP_POST_VARS["bill_customer_title"];
	if($billCustomerTitle != "") {
		if(!$creditCardRequest->setBillCustomerTitle($billCustomerTitle)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billEmail = $HTTP_POST_VARS["bill_email"];
	if($billEmail != "") {
		if(!$creditCardRequest->setBillEmail($billEmail)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billFax = $HTTP_POST_VARS["bill_fax"];
	if($billFax != "") {
		if(!$creditCardRequest->setBillFax($billFax)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billFirstName = $HTTP_POST_VARS["bill_first_name"];
	if($billFirstName != "") {
		if(!$creditCardRequest->setBillFirstName($billFirstName)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billLastName = $HTTP_POST_VARS["bill_last_name"];
	if($billLastName != "") {
		if(!$creditCardRequest->setBillLastName($billLastName)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billMiddleName = $HTTP_POST_VARS["bill_middle_name"];
	if($billMiddleName != "") {
		if(!$creditCardRequest->setBillMiddleName($billMiddleName)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billNote = $HTTP_POST_VARS["bill_note"];
	if($billNote != "") {
		if(!$creditCardRequest->setBillNote($billNote)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billPhone = $HTTP_POST_VARS["bill_phone"];
	if($billPhone != "") {
		if(!$creditCardRequest->setBillPhone($billPhone)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billZipOrPostalCode = $HTTP_POST_VARS["bill_zip_or_postal_code"];
	if($billZipOrPostalCode != "") {
		if(!$creditCardRequest->setBillZipOrPostalCode($billZipOrPostalCode)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$billStateOrProvince = $HTTP_POST_VARS["bill_state_or_province"];
	if($billStateOrProvince != "") {
		if(!$creditCardRequest->setBillStateOrProvince($billStateOrProvince)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$cardBrand = $HTTP_POST_VARS["card_brand"];
	if($cardBrand != "") {
		if(!$creditCardRequest->setCardBrand($cardBrand)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$chargeTotal = $HTTP_POST_VARS["charge_total"];
	if($chargeTotal != "") {
		if(!$creditCardRequest->setChargeTotal($chargeTotal)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$creditCardNumber = $HTTP_POST_VARS["credit_card_number"];
	if($creditCardNumber != "") {
		if(!$creditCardRequest->setCreditCardNumber($creditCardNumber)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$creditCardVerificationNumber = $HTTP_POST_VARS["credit_card_verification_number"];
	if($creditCardVerificationNumber != "") {
		if(!$creditCardRequest->setCreditCardVerificationNumber($creditCardVerificationNumber)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$ecommerceIndicator = $HTTP_POST_VARS["ecommerce_indicator"];
	if($ecommerceIndicator != "") {
		if(!$creditCardRequest->setEcommerceIndicator($ecommerceIndicator)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$expireMonth = $HTTP_POST_VARS["expire_month"];
	if($expireMonth != "") {
		if(!$creditCardRequest->setExpireMonth($expireMonth)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$expireYear = $HTTP_POST_VARS["expire_year"];
	if($expireYear != "") {
		if(!$creditCardRequest->setExpireYear($expireYear)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$orderDescription = $HTTP_POST_VARS["order_description"];
	if($orderDescription != "") {
		if(!$creditCardRequest->setOrderDescription($orderDescription)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$orderID = $HTTP_POST_VARS["order_id"];
	if($orderID != "") {
		if(!$creditCardRequest->setOrderID($orderID)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$orderUserID = $HTTP_POST_VARS["order_user_id"];
	if($orderUserID != "") {
		if(!$creditCardRequest->setOrderUserID($orderUserID)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipAddressOne = $HTTP_POST_VARS["ship_address_one"];
	if($shipAddressOne != "") {
		if(!$creditCardRequest->setShipAddressOne($shipAddressOne)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipAddressTwo = $HTTP_POST_VARS["ship_address_two"];
	if($shipAddressTwo != "") {
		if(!$creditCardRequest->setShipAddressTwo($shipAddressTwo))	{
			$errorMessages[] = $creditCardRequest->getError();
		}
	}	
	
	$shipCity = $HTTP_POST_VARS["ship_city"];
	if($shipCity != "") {
		if(!$creditCardRequest->setShipCity($shipCity)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipCompany = $HTTP_POST_VARS["ship_company"];
	if($shipCompany != "") {
		if(!$creditCardRequest->setShipCompany($shipCompany)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipCountryCode = $HTTP_POST_VARS["ship_country_code"];
	if($shipCountryCode != "") {
		if(!$creditCardRequest->setShipCountryCode($shipCountryCode)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipCustomerTitle = $HTTP_POST_VARS["ship_customer_title"];
	if($shipCustomerTitle != "") {
		if(!$creditCardRequest->setShipCustomerTitle($shipCustomerTitle)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipEmail = $HTTP_POST_VARS["ship_email"];
	if($shipEmail != "") {
		if(!$creditCardRequest->setShipEmail($shipEmail)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipFax = $HTTP_POST_VARS["ship_fax"];
	if($shipFax != "") {
		if(!$creditCardRequest->setShipFax($shipFax)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipFirstName = $HTTP_POST_VARS["ship_first_name"];
	if($shipFirstName != "") {
		if(!$creditCardRequest->setShipFirstName($shipFirstName)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipLastName = $HTTP_POST_VARS["ship_last_name"];
	if($shipLastName != "") {
		if(!$creditCardRequest->setShipLastName($shipLastName)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipMiddleName = $HTTP_POST_VARS["ship_middle_name"];
	if($shipMiddleName != "") {
		if(!$creditCardRequest->setShipMiddleName($shipMiddleName)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipNote = $HTTP_POST_VARS["ship_note"];
	if($shipNote != "") {
		if(!$creditCardRequest->setShipNote($shipNote)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipPhone = $HTTP_POST_VARS["ship_phone"];
	if($shipPhone != "") {
		if(!$creditCardRequest->setShipPhone($shipPhone)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipZipOrPostalCode = $HTTP_POST_VARS["ship_zip_or_postal_code"];
	if($shipZipOrPostalCode != "") {
		if(!$creditCardRequest->setShipZipOrPostalCode($shipZipOrPostalCode)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$shipStateOrProvince = $HTTP_POST_VARS["ship_state_or_province"];
	if($shipStateOrProvince != "") {
		if(!$creditCardRequest->setShipStateOrProvince($shipStateOrProvince)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}	
	
	$shippingCharge = $HTTP_POST_VARS["shipping_charge"];
	if($shippingCharge != "") {
		if(!$creditCardRequest->setShippingCharge($shippingCharge)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}
	
	$taxAmount = $HTTP_POST_VARS["tax_amount"];
	if($taxAmount != "") {
		if(!$creditCardRequest->setTaxAmount($taxAmount)) {
			$errorMessages[] = $creditCardRequest->getError();
		}
	}	
	
	if(sizeof($errorMessages) != 0) {	
		// Print out all the errors that happened when setting.
		print("<h1><font color=red>Test Transaction Not Attempted</font></h1>");
		print("<p>There was an error setting the fields of the TransactionRequest object.");
		print("The following errors were found:");		
		print("<ul>");
			
		foreach ($errorMessages as $error) {
			print("   <li>$error</li>");
		}
		
		print("</ul>");
		
	} else {	
		// No errors setting the values; perform the transaction	
		$creditCardResponse = $creditCardRequest->doTransaction();

		// If there was a communication failure, then the response
		// object will be false.
		if($creditCardResponse) {
			if($creditCardResponse->getResponseCode() == RC_SUCCESSFUL_TRANSACTION) {
				print("<h1><font color=green>Test Transaction Successful</font></h1>");
			} else {
				print("<h1><font color=red>Test Transaction Failed</font></h1>");
			}
	
			print("<h2>Transaction Information</h2>");
			print("<table width=600>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Response Code:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getResponseCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Reponse Code Text:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getResponseCodeText() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Time Stamp:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getTimeString() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Retry Recommended:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getRetryRecommended() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Reference ID:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getReferenceID() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Order ID:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getOrderID() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>ISO Code:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getISOCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Bank Approval Code:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getBankApprovalCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Bank Transaction ");
			print("      ID:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getBankTransactionID() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Batch ID:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getBatchID() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>AVS Code:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getAVSCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Credit Card Verification ");
			print("      Response:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardResponse->getCreditCardVerificationResponse() . "</td>");
			print("  </tr>");
			print("</table>");

			print("<h2>Billing Information</h2>");
			print("<table width=600>");
			print("  <tr> ");
			print("    <td  width=180 bgcolor='#000099' align='right'><font color='#FFFFFF'>Title:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillCustomerTitle() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>First name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillFirstName() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Middle name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillMiddleName() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Last name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillLastName() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Company name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillCompany() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Street address:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillAddressOne() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>&nbsp;</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillAddressTwo() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>City:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillCity() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>State / Province:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillStateOrProvince() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Zip / Postal code:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillZipOrPostalCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Country:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillCountryCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Phone number:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillPhone() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Fax number:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillFax() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Email address:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillEmail() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Billing ");
			print("      comments:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getBillNote() . "</td>");
			print("  </tr>");
			print("</table>");
	
			print("<h2>Shipping Information</h2>");
			print("<table width=600>");
			print("  <tr> ");
			print("    <td  width=180 bgcolor='#000099' align='right'><font color='#FFFFFF'>Title:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipCustomerTitle() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>First name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipFirstName() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Middle name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipMiddleName() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Last name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipLastName() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Company name:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipCompany() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Street address:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipAddressOne() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>&nbsp;</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipAddressTwo() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>City:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipCity() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>State / Province:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipStateOrProvince() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Zip / Postal code:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipZipOrPostalCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Country:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipCountryCode() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Phone number:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipPhone() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Fax number:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipFax() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Email address:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipEmail() . "</td>");
			print("  </tr>");
			print("  <tr> ");
			print("    <td bgcolor='#000099' align='right'><font color='#FFFFFF'>Shipping ");
			print("      comments:</font></td>");
			print("    <td bgcolor='#CCCC99'>" . $creditCardRequest->getShipNote() . "</td>");
			print("  </tr>");
			print("</table>");
			print("<p>&nbsp;</p>");
		} else {
			print("<h1><font color=red>Test Transaction Failed</font></h1>A communication error occured.");
			print("<p>Error: ". $creditCardRequest->getError());
		}
	}
?>

</body>
</html>

