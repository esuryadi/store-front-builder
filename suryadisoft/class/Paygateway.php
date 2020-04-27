<?php
	// Constants
	define("VERSION", "PHP Plug v1.6.2");
	define("PARAMETER_SEPERATOR", "&");
	define("POST_URL", "https://etrans.paygateway.com/TransactionManager");

	// Credit card charge type constants
	define("AUTH", "AUTH");
	define("CAPTURE", "CAPTURE");
	define("SALE", "SALE");
	define("VOID", "VOID");
	define("CREDIT", "CREDIT");
	define("VOID_AUTH", "VOID_AUTH");
	define("VOID_CAPTURE", "VOID_CAPTURE");
	define("VOID_CREDIT", "VOID_CREDIT");
	define("CREATE_ORDER", "CREATE_ORDER");
	define("CANCEL_ORDER", "CANCEL_ORDER");
	define("CLOSE_ORDER", "CLOSE_ORDER");

	// Batch request action constants
	define("SETTLE", "SETTLE");
	define("PURGE", "PURGE");
	define("TOTALS", "TOTALS");

	// Credit card brands
	define("VISA", "VISA");
	define("MASTERCARD", "MASTERCARD");
	define("DISCOVER", "DISCOVER");
	define("NOVA", "NOVA");
	define("AMEX", "AMEX");
	define("DINERS", "DINERS");
	define("EUROCARD", "EUROCARD");

	// Response Codes
	define("RC_SUCCESSFUL_TRANSACTION", 1);
	define("RC_CREDIT_CARD_DECLINED", 100);
	define("RC_TRANSACTION_NOT_POSSIBLE", 6);
	define("RC_ILLEGAL_TRANSACTION_REQUEST", 4);
	define("RC_MISSING_REQUIRED_REQUEST_FIELD", 2);
	define("RC_MISSING_REQUIRED_RESPONSE_FIELD", 8);
	define("RC_INVALID_REQUEST_FIELD", 3);
	define("RC_INVALID_RESPONSE_FIELD", 9);
	define("RC_TRANSACTION_CLIENT_ERROR", 10);
	define("RC_PAYMENT_ENGINE_ERROR", 102);
	define("RC_ACQUIRER_GATEWAY_ERROR", 101);
	define("RC_TRANSACTION_SERVER_ERROR", 5);
	define("RC_INVALID_VERSION", 7);

	// Constants for credit card post string keys
	define("ACCOUNT_TOKEN", "account_token");
	define("VERSION_ID", "version_id");
	define("TRANSACTION_TYPE", "transaction_type");
	define("CREDIT_CARD_NUMBER", "credit_card_number");
	define("EXPIRE_MONTH", "expire_month");
	define("EXPIRE_YEAR", "expire_year");
	define("CREDIT_CARD_VERIFICATION_NUMBER", "credit_card_verification_number");
	define("ECOMMERCE_INDICATOR", "ecommerce_indicator");
	define("CHARGE_TYPE", "charge_type");
	define("CURRENCY", "currency");
	define("CHARGE_TOTAL", "charge_total");
	define("CARD_BRAND", "card_brand");
	define("ORDER_ID", "order_id");
	define("REFERENCE_ID", "capture_reference_id");
	define("ORDER_DESCRIPTION", "order_description");
	define("ORDER_USER_ID", "order_user_id");
	define("TAX_AMOUNT", "tax_amount");
	define("SHIPPING_CHARGE", "shipping_charge");
	define("CARTRIDGE_TYPE", "cartridge_type");
	define("BILL_FIRST_NAME", "bill_first_name");
	define("BILL_MIDDLE_NAME", "bill_middle_name");
	define("BILL_LAST_NAME", "bill_last_name");
	define("BILL_CUSTOMER_TITLE", "bill_customer_title");
	define("BILL_COMPANY", "bill_company");
	define("BILL_ADDRESS_ONE", "bill_address_one");
	define("BILL_ADDRESS_TWO", "bill_address_two");
	define("BILL_CITY", "bill_city");
	define("BILL_STATE_OR_PROVINCE", "bill_state_or_province");
	define("BILL_ZIP_OR_POSTAL_CODE", "bill_postal_code");
	define("BILL_COUNTRY_CODE", "bill_country_code");
	define("BILL_EMAIL", "bill_email");
	define("BILL_PHONE", "bill_phone");
	define("BILL_FAX", "bill_fax");
	define("BILL_NOTE", "bill_note");
	define("SHIP_FIRST_NAME", "ship_first_name");
	define("SHIP_MIDDLE_NAME", "ship_middle_name");
	define("SHIP_LAST_NAME", "ship_last_name");
	define("SHIP_CUSTOMER_TITLE", "ship_customer_title");
	define("SHIP_COMPANY", "ship_company");
	define("SHIP_ADDRESS_ONE", "ship_address_one");
	define("SHIP_ADDRESS_TWO", "ship_address_two");
	define("SHIP_CITY", "ship_city");
	define("SHIP_STATE_OR_PROVINCE", "ship_state_or_province");
	define("SHIP_ZIP_OR_POSTAL_CODE", "ship_postal_code");
	define("SHIP_COUNTRY_CODE", "ship_country_code");
	define("SHIP_EMAIL", "ship_email");
	define("SHIP_PHONE", "ship_phone");
	define("SHIP_FAX", "ship_fax");
	define("SHIP_NOTE", "ship_note");

	// Constants for credit card post string values
	define("CREDIT_CARD", "CREDIT_CARD");
	define("BATCH", "BATCH");

	// Constants for batch post string keys
	define("ACTION", "action");
	//define("BATCH_ID", "batch_id");  // same name as response field. share constant.
	//define("VERSION_ID", "version_id");

	// Constants common to all responses
	define("RESPONSE_CODE", "response_code");
	define("RESPONSE_CODE_TEXT", "response_code_text");
	define("TIME_STAMP", "time_stamp");
	define("RETRY_RECOMMENDED", "retry_recommended");

	// Constants for credit card response fields
	//define("REFERENCE_ID", "capture_reference_id");
	//define("ORDER_ID", "order_id");
	define("ISO_CODE", "iso_code");
	define("BANK_APPROVAL_CODE", "bank_approval_code");
	define("BANK_TRANSACTION_ID", "bank_transaction_id");
	define("BATCH_ID", "batch_id");
	define("AVS_CODE", "avs_code");
	define("CREDIT_CARD_VERIFICATION_RESPONSE", "credit_card_verification_response");

	// Constants for batch response fields
	//define("BATCH_ID", "batch_id");
	define("PAYMENT_TOTAL", "payment_total");
	define("CREDIT_TOTAL", "credit_total");
	define("NUMBER_OF_PAYMENTS", "number_of_payments");
	define("NUMBER_OF_CREDITS", "number_of_credits");
	define("BATCH_STATE", "batch_state");
	define("BATCH_BALANCE_STATE", "batch_balance_state");

	class TransactionRequest {
		// Object variables
		var $objPostData = array();
		var $objError    = "";

		function TransactionRequest() {
		}

		function setProperty($argKey, $argValue) {
			$this->objPostData[$argKey] = $argValue;
		}

		function getProperty($argKey) {
			return ($this->objPostData[$argKey]);
		}

		function getPostString() {
			$varPostString = "";

			// Reset array pointer
			reset($this->objPostData);

			// Iterate through all keys and values
			foreach($this->objPostData as $varKey => $varValue) {
				$varPostString .= $varKey . "=" . $varValue . PARAMETER_SEPERATOR;
			}

			// Remove trailing ampersand
			$varLastIndex = strlen($varPostString) - 1;
			if($varPostString[$varLastIndex] == PARAMETER_SEPERATOR) {
				$varPostString = substr($varPostString, 0, $varLastIndex);
			}
			return $varPostString;
		}

		function doTransaction() {
			$this->setTransactionType(CREDIT_CARD);
			return $this->executeTransaction();
		}

		function doBatchTransaction() {
			$this->setTransactionType(BATCH);
			return $this->executeTransaction();
		}

		function executeTransaction() {
			$this->setVersionID(VERSION);
			$postFields = $this->getPostString();

			if($curled = curl_init(POST_URL)) {
				curl_setopt($curled, CURLOPT_POST, 1);
				curl_setopt($curled, CURLOPT_POSTFIELDS, $postFields);
				curl_setopt($curled, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curled, CURLOPT_TIMEOUT, 270);  // 4.5 minute timeout
				curl_setopt($curled, CURLOPT_USERAGENT, $this->getVersionID());
				$varResponse = curl_exec($curled);				

				if($varResponse == "") {
					$this->setError(curl_error($curled));
					curl_close($curled);
					return false;
				} else {
					curl_close($curled);
					return new TransactionResponse($varResponse);
				}
			} else {
				print("ERROR: cURL initialization failed.  Check your cURL/PHP configuration.<br>");
			}
		}

		function setError($argError) {
			$this->objError = $argError;
		}

		function getError() {
			return $this->objError;
		}

		function clearError() {
			$this->setError("");
		}

		// Credit card request setters
		function setAccountToken($argAccountToken) {
			$this->setProperty(ACCOUNT_TOKEN, $argAccountToken);
			$this->clearError();
			return true;
		}

		function setTransactionType($argTransactionType) {
			$result = false;

			if($argTransactionType == BATCH ||
			   $argTransactionType == CREDIT_CARD) {
				// Good transaction type
				$this->setProperty(TRANSACTION_TYPE, $argTransactionType);
				$this->clearError();
				$result = true;
			} else {
				// Invalid transaction type
				$this->setError("Invalid transaction type.");
			}
			return $result;


		}

		function setBillAddressOne($argBillAddressOne)  {
			$this->setProperty(BILL_ADDRESS_ONE, $argBillAddressOne);
			$this->clearError();
			return true;
		}

		function setBillAddressTwo($argBillAddressTwo) {
			$this->setProperty(BILL_ADDRESS_TWO, $argBillAddressTwo);
			$this->clearError();
			return true;
		}

		function setBillCity($argBillCity) {
			$this->setProperty(BILL_CITY, $argBillCity);
			$this->clearError();
			return true;
		}

		function setBillCompany($argBillCompany) {
			$this->setProperty(BILL_COMPANY, $argBillCompany);
			$this->clearError();
			return true;
		}

		function setBillCountryCode($argBillCountryCode) {
			$result = false;

			if (strlen($argBillCountryCode) == 2) {
				// Valid code
				$this->setProperty(BILL_COUNTRY_CODE, $argBillCountryCode);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid bill country code.");
			}

			return $result;
		}

		function setBillCustomerTitle($argBillCustomerTitle) {
			$this->setProperty(BILL_CUSTOMER_TITLE, $argBillCustomerTitle);
			$this->clearError();
			return true;
		}

		function setBillEmail($argBillEmail) {
			$this->setProperty(BILL_EMAIL, $argBillEmail);
			$this->clearError();
			return true;
		}

		function setBillFax($argBillFax) {
			$this->setProperty(BILL_FAX, $argBillFax);
			$this->clearError();
			return true;
		}

		function setBillFirstName($argBillFirstName) {
			$this->setProperty(BILL_FIRST_NAME, $argBillFirstName);
			$this->clearError();
			return true;
		}

		function setBillLastName($argBillLastName) {
			$this->setProperty(BILL_LAST_NAME, $argBillLastName);
			$this->clearError();
			return true;
		}

		function setBillMiddleName($argBillMiddleName) {
			$this->setProperty(BILL_MIDDLE_NAME, $argBillMiddleName);
			$this->clearError();
			return true;
		}

		function setBillNote($argBillNote) {
			$this->setProperty(BILL_NOTE, $argBillNote);
			$this->clearError();
			return true;
		}

		function setBillPhone($argBillPhone) {
			$this->setProperty(BILL_PHONE, $argBillPhone);
			$this->clearError();
			return true;
		}

		function setBillZipOrPostalCode($argBillPostalCode) {
			$this->setProperty(BILL_ZIP_OR_POSTAL_CODE, $argBillPostalCode);
			$this->clearError();
			return true;
		}

		function setBillStateOrProvince($argBillStateOrProvince) {
			$this->setProperty(BILL_STATE_OR_PROVINCE, $argBillStateOrProvince);
			$this->clearError();
			return true;
		}

		function setReferenceID($argReferenceID) {
			$this->setProperty(REFERENCE_ID, $argReferenceID);
			$this->clearError();
			return true;
		}

		function setCardBrand($argCardBrand) {
			$result = false;

			if ($argCardBrand == VISA       ||
				$argCardBrand == MASTERCARD ||
				$argCardBrand == DISCOVER   ||
				$argCardBrand == NOVA       ||
				$argCardBrand == AMEX       ||
				$argCardBrand == DINERS     ||
				$argCardBrand == EUROCARD) {
				// Valid
				$this->setProperty(CARD_BRAND, $argCardBrand);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid card brand.");
			}
			return $result;
		}

		function setCartridgeType($argCartridgeType) {
			$this->setProperty(CARTRIDGE_TYPE, $argCartridgeType);
			$this->clearError();
			return true;
		}

		function setChargeTotal($argChargeTotal) {
			$result = false;

			if(is_numeric($argChargeTotal)) {
				// Valid
				$this->setProperty(CHARGE_TOTAL, $argChargeTotal);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid charge total");
			}
			return $result;
		}

		function setChargeType($argChargeType) {
			$result = false;

			if($argChargeType == AUTH         ||
			   $argChargeType == CAPTURE      ||
			   $argChargeType == SALE         ||
			   $argChargeType == VOID         ||
			   $argChargeType == CREDIT       ||
			   $argChargeType == VOID_AUTH    ||
			   $argChargeType == VOID_CAPTURE ||
			   $argChargeType == VOID_CREDIT  ||
			   $argChargeType == CREATE_ORDER ||
			   $argChargeType == CANCEL_ORDER ||
			   $argChargeType == CLOSE_ORDER  ||
			   $argChargeType == SETTLE       ||
			   $argChargeType == PURGE        ||
			   $argChargeType == TOTALS) {
				// Good charge type
				$this->setProperty(CHARGE_TYPE, $argChargeType);
				$this->clearError();
				$result = true;
			} else {
				// Invalid charge type
				$this->setError("Invalid charge type.");
			}
			return $result;
		}

		function setCreditCardNumber($argCreditCardNumber) {
			$result = false;

			// one or more digit,
			// no spaces,
			// no letters
			if(is_numeric($argCreditCardNumber)) {
				// Valid
				$this->setProperty(CREDIT_CARD_NUMBER, $argCreditCardNumber);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid credit card number");
			}

			return $result;
		}

		function setCreditCardVerificationNumber($argCreditCardVerificationNumber) {
			$this->setProperty(CREDIT_CARD_VERIFICATION_NUMBER, $argCreditCardVerificationNumber);
			$this->clearError();
			return true;
		}

		function setCurrency($argCurrency) {
			$result = false;

			if (strlen($argCurrency) == 3 && is_numeric($argCurrency)) {
				// Valid
				$this->setProperty(CURRENCY, $argCurrency);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid currency code");
			}

			return $result;
		}

		function setEcommerceIndicator($argEcommerceIndicator) {
			$this->setProperty(ECOMMERCE_INDICATOR, $argEcommerceIndicator);
			$this->clearError();
			return true;
		}

		function setExpireMonth($argExpireMonth) {
			$result = false;

			if ((strlen($argExpireMonth) == 1 ||
				strlen($argExpireMonth) == 2) &&
				is_numeric($argExpireMonth) &&
				settype($argExpireMonth, "integer") &&
				$argExpireMonth > 0 &&
				$argExpireMonth < 13) {
				// Valid
				$this->setProperty(EXPIRE_MONTH, $argExpireMonth);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid expire month");
			}

			return $result;
		}

		function setExpireYear($argExpireYear) {
			$result = false;

			if (strlen($argExpireYear) == 4 &&
				is_numeric($argExpireYear)) {
				// Valid
				$this->setProperty(EXPIRE_YEAR, $argExpireYear);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid expire year");
			}

			return $result;
		}

		function setOrderDescription($argOrderDescription) {
			$this->setProperty(ORDER_DESCRIPTION, $argOrderDescription);
			$this->clearError();
			return true;
		}

		function setOrderID($argOrderID) {
			$this->setProperty(ORDER_ID, $argOrderID);
			$this->clearError();
			return true;
		}

		function setOrderUserID($argOrderUserID) {
			$this->setProperty(ORDER_USER_ID, $argOrderUserID);
			$this->clearError();
			return true;
		}

		function setShipAddressOne($argShipAddressOne) {
			$this->setProperty(SHIP_ADDRESS_ONE, $argShipAddressOne);
			$this->clearError();
			return true;
		}

		function setShipAddressTwo($argShipAddressTwo) {
			$this->setProperty(SHIP_ADDRESS_TWO, $argShipAddressTwo);
			$this->clearError();
			return true;
		}

		function setShipCity($argShipCity) {
			$this->setProperty(SHIP_CITY, $argShipCity);
			$this->clearError();
			return true;
		}

		function setShipCompany($argShipCompany) {
			$this->setProperty(SHIP_COMPANY, $argShipCompany);
			$this->clearError();
			return true;
		}

		function setShipCountryCode($argShipCountryCode) {
			$result = false;

			if (strlen($argShipCountryCode) == 2) {
				// Valid code
				$this->setProperty(SHIP_COUNTRY_CODE, $argShipCountryCode);
				$this->clearError();
				$result = true;
			} else {
				// Invalid
				$this->setError("Invalid ship country code.");
			}

			return $result;
		}

		function setShipCustomerTitle($argShipCustomerTitle) {
			$this->setProperty(SHIP_CUSTOMER_TITLE, $argShipCustomerTitle);
			$this->clearError();
			return true;
		}

		function setShipEmail($argShipEmail) {
			$this->setProperty(SHIP_EMAIL, $argShipEmail);
			$this->clearError();
			return true;
		}

		function setShipFax($argShipFax) {
			$this->setProperty(SHIP_FAX, $argShipFax);
			$this->clearError();
			return true;
		}

		function setShipFirstName($argShipFirstName) {
			$this->setProperty(SHIP_FIRST_NAME, $argShipFirstName);
			$this->clearError();
			return true;
		}

		function setShipLastName($argShipLastName) {
			$this->setProperty(SHIP_LAST_NAME, $argShipLastName);
			$this->clearError();
			return true;
		}

		function setShipMiddleName($argShipMiddleName) {
			$this->setProperty(SHIP_MIDDLE_NAME, $argShipMiddleName);
			$this->clearError();
			return true;
		}

		function setShipNote($argShipNote) {
			$this->setProperty(SHIP_NOTE, $argShipNote);
			$this->clearError();
			return true;
		}

		function setShipPhone($argShipPhone) {
			$this->setProperty(SHIP_PHONE, $argShipPhone);
			$this->clearError();
			return true;
		}

		function setShippingCharge($argShippingCharge) {
			$result = false;

			if(is_numeric($argShippingCharge)) {
				$this->setProperty(SHIPPING_CHARGE, $argShippingCharge);
				$this->clearError();
				$result = true;
			} else {
				$this->setError("Invalid shipping charge");
			}

			return $result;
		}

		function setShipStateOrProvince($argShipStateOrProvince) {
			$this->setProperty(SHIP_STATE_OR_PROVINCE, $argShipStateOrProvince);
			$this->clearError();
			return true;
		}

		function setShipZipOrPostalCode($argShipZipOrPostalCode) {
			$this->setProperty(SHIP_ZIP_OR_POSTAL_CODE, $argShipZipOrPostalCode);
			$this->clearError();
			return true;
		}

		function setTaxAmount($argTaxAmount) {
			$result = false;

			if(is_numeric($argTaxAmount)) {
				$this->setProperty(TAX_AMOUNT, $argTaxAmount);
				$this->clearError();
				$result = true;
			} else {
				$this->setError("Invalid tax amount");
			}

			return $result;
		}

		function setVersionID($argVersionID) {
			$this->setProperty(VERSION_ID, $argVersionID);
			$this->clearError();
			return true;
		}

		// Batch request setters
		function setAction($argAction) {
			$result = false;

			if ($argAction == SETTLE ||
				$argAction == TOTALS ||
				$argAction == PURGE) {

				$this->setProperty(ACTION, $argAction);
				$this->clearError();
				$result = true;

			} else {
				$this->setError("Invalid batch action");
			}

			return $result;
		}

		function setBatchID($argBatchID) {
			$this->setProperty(BATCH_ID, $argBatchID);
			$this->clearError();
			return true;
		}

		// Credit card request getters
		function getAccountToken() {
			return $this->getProperty(ACCOUNT_TOKEN);
		}

		function getTransactionType() {
			return $this->getProperty(TRANSACTION_TYPE);
		}

		function getBillAddressOne()  {
			return $this->getProperty(BILL_ADDRESS_ONE);
		}

		function getBillAddressTwo() {
			return $this->getProperty(BILL_ADDRESS_TWO);
		}

		function getBillCity() {
			return $this->getProperty(BILL_CITY);
		}

		function getBillCompany() {
			return $this->getProperty(BILL_COMPANY);
		}

		function getBillCountryCode() {
			return $this->getProperty(BILL_COUNTRY_CODE);
		}

		function getBillCustomerTitle() {
			return $this->getProperty(BILL_CUSTOMER_TITLE);
		}

		function getBillEmail() {
			return $this->getProperty(BILL_EMAIL);
		}

		function getBillFax() {
			return $this->getProperty(BILL_FAX);
		}

		function getBillFirstName() {
			return $this->getProperty(BILL_FIRST_NAME);
		}

		function getBillLastName() {
			return $this->getProperty(BILL_LAST_NAME);
		}

		function getBillMiddleName() {
			return $this->getProperty(BILL_MIDDLE_NAME);
		}

		function getBillNote() {
			return $this->getProperty(BILL_NOTE);
		}

		function getBillPhone() {
			return $this->getProperty(BILL_PHONE);
		}

		function getBillZipOrPostalCode() {
			return $this->getProperty(BILL_ZIP_OR_POSTAL_CODE);
		}

		function getBillStateOrProvince() {
			return $this->getProperty(BILL_STATE_OR_PROVINCE);
		}

		function getReferenceID() {
			return $this->getProperty(BILL_REFERENCE_ID);
		}

		function getCardBrand() {
			return $this->getProperty(CARD_BRAND);
		}

		function getCartridgeType() {
			return $this->getProperty(CARTRIDGE_TYPE);
		}

		function getChargeTotal() {
			return $this->getProperty(CHARGE_TOTAL);
		}

		function getChargeType() {
			return $this->getProperty(CHARGE_TYPE);
		}

		function getCreditCardNumber() {
			return $this->getProperty(CREDIT_CARD_NUMBER);
		}

		function getCreditCardVerificationNumber() {
			return $this->getProperty(CREDIT_CARD_VERIFICATION_NUMBER);
		}

		function getCurrency() {
			return $this->getProperty(CURRENCY);
		}

		function getEcommerceIndicator() {
			return $this->getProperty(ECOMMERCE_INDICATOR);
		}

		function getExpireMonth() {
			return $this->getProperty(EXPIRE_MONTH);
		}

		function getExpireYear() {
			return $this->getProperty(EXPIRE_YEAR);
		}

		function getOrderDescription() {
			return $this->getProperty(ORDER_DESCRIPTION);
		}

		function getOrderID() {
			return $this->getProperty(ORDER_ID);
		}

		function getOrderUserID() {
			return $this->getProperty(ORDER_USER_ID);
		}

		function getShipAddressOne() {
			return $this->getProperty(SHIP_ADDRESS_ONE);
		}

		function getShipAddressTwo() {
			return $this->getProperty(SHIP_ADDRESS_TWO);
		}

		function getShipCity() {
			return $this->getProperty(SHIP_CITY);
		}

		function getShipCompany() {
			return $this->getProperty(SHIP_COMPANY);
		}

		function getShipCountryCode() {
			return $this->getProperty(SHIP_COUNTRY_CODE);
		}

		function getShipCustomerTitle() {
			return $this->getProperty(SHIP_CUSTOMER_TITLE);
		}

		function getShipEmail() {
			return $this->getProperty(SHIP_EMAIL);
		}

		function getShipFax() {
			return $this->getProperty(SHIP_FAX);
		}

		function getShipFirstName() {
			return $this->getProperty(SHIP_FIRST_NAME);
		}

		function getShipLastName() {
			return $this->getProperty(SHIP_LAST_NAME);
		}

		function getShipMiddleName() {
			return $this->getProperty(SHIP_MIDDLE_NAME);
		}

		function getShipNote() {
			return $this->getProperty(SHIP_NOTE);
		}

		function getShipPhone() {
			return $this->getProperty(SHIP_PHONE);
		}

		function getShippingCharge() {
			return $this->getProperty(SHIPPING_CHARGE);
		}

		function getShipStateOrProvince() {
			return $this->getProperty(SHIP_STATE_OR_PROVINCE);
		}

		function getShipZipOrPostalCode() {
			return $this->getProperty(SHIP_ZIP_OR_POSTAL_CODE);
		}

		function getTaxAmount() {
			return $this->getProperty(TAX_AMOUNT);
		}

		function getVersionID() {
			return $this->getProperty(VERSION_ID);
		}

		// Batch request getters
		function getAction() {
			return $this->getProperty(ACTION);
		}

		function getBatchID() {
			return $this->getProperty(BATCH_ID);
		}
	} // end TransactionRequest

	class TransactionResponse {
		// Object variables
		var $objResponseFields = array();

		function TransactionResponse($argResponseString) {
			// Parse response string and set hashtable values
			$varResponseLinesArray = explode(chr(10), $argResponseString);

			foreach($varResponseLinesArray as $varElement) {
				$varKeyValueArray = explode("=", $varElement);
				// There may be equal signs in the value, so we 
				// must add all the elements after the first one 
				// as the value
				$varFirstElement = true;
				$varValue = "";
				$varValueArray = array();
				foreach($varKeyValueArray as $varKeyValueElement) {
					if(!$varFirstElement) {	
						$varValueArray[] = $varKeyValueElement;				
					}
					$varFirstElement = false;
				}
				$varValue = implode("=", $varValueArray);
				$this->objResponseFields[$varKeyValueArray[0]] = $varValue;
			}
		}

		function setProperty($argKey, $argValue) {
			$this->objResponseFields[$argKey] = $argValue;
		}

		function getProperty($argKey) {
			return $this->objResponseFields[$argKey];
		}

		// Response Fields getters
		function getResponseCode() {
			return $this->getProperty(RESPONSE_CODE);
		}

		function getResponseCodeText() {
			return $this->getProperty(RESPONSE_CODE_TEXT);
		}

		function getTimeStamp() {
			return $this->getProperty(TIME_STAMP);
		}
		
		function getTimeString() {
			$utcTime = $this->getProperty(TIME_STAMP);
			$utcTime = substr($utcTime, 0, strlen($utcTime) - 3); 
			
			return date("l F j, Y H:i:s", $utcTime);
		}

		function getRetryRecommended() {
			return $this->getProperty(RETRY_RECOMMENDED);
		}

		function getBatchID() {
			return $this->getProperty(BATCH_ID);
		}

		// Credit Card Response field getters
		function getReferenceId() {
			return $this->getProperty(REFERENCE_ID);
		}

		function getOrderID() {
			return $this->getProperty(ORDER_ID);
		}

		function getISOCode() {
			return $this->getProperty(ISO_CODE);
		}

		function getBankApprovalCode() {
			return $this->getProperty(BANK_APPROVAL_CODE);
		}

		function getBankTransactionID() {
			return $this->getProperty(BANK_TRANSACTION_ID);
		}

		function getAVSCode() {
			return $this->getProperty(AVS_CODE);
		}

		function getCreditCardVerificationResponse() {
			return $this->getProperty(CREDIT_CARD_VERIFICATION_RESPONSE);
		}

		// Batch response field getters
		function getPaymentTotal() {
			return $this->getProperty(PAYMENT_TOTAL);
		}

		function getCreditTotal() {
			return $this->getProperty(CREDIT_TOTAL);
		}

		function getNumberOfPayments() {
			return $this->getProperty(NUMBER_OF_PAYMENTS);
		}

		function getNumberOfCredits() {
			return $this->getProperty(NUMBER_OF_CREDITS);
		}

		function getBatchState() {
			return $this->getProperty(BATCH_STATE);
		}

		function getBatchBalanceState() {
			return $this->getProperty(BATCH_BALANCE_STATE);
		}
	} // end TransactionResponse
?>
