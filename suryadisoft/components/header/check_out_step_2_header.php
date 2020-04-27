<?php
$msg = "";
if (isset($HTTP_SESSION_VARS["customer"])) {
	$cust = $HTTP_SESSION_VARS["customer"];
	$msg = $cust->getMessage();
}
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$user_id = $user->getUserId();
	$shopping_cart = new ShoppingCart();
} else {
	$user_id = "";
	if (isset($HTTP_SESSION_VARS["shopping_cart"]))
		$shopping_cart = $HTTP_SESSION_VARS["shopping_cart"];
	else
		$shopping_cart = new ShoppingCart();
}	
$transaction = new Transaction();
$product = new Product();

$customer = new Customer($user_id);
if (WebContent::getPropertyValue("ask_cust_info") == "" || WebContent::getPropertyValue("ask_cust_info") == "yes") {
	$customer->setFirstName($FirstName);
	$customer->setMiddleInitial($MiddleInitial);
	$customer->setLastName($LastName);
	$customer->setAddress1($Address1);
	$customer->setAddress2($Address2);
	$customer->setCity($City);
	$customer->setState($State);
	$customer->setProvince($Province);
	$customer->setZip($Zip);
	$customer->setCountry($Country);
	$customer->setDayPhone($DayPhone);
	$customer->setEveningPhone($EveningPhone);
	$customer->setFax($Fax);
	$customer->setEmail($Email);
}
if (WebContent::getPropertyValue("ask_shipping_info") == "" || WebContent::getPropertyValue("ask_shipping_info") == "yes") {
	$customer->setShippingFirstName($ShippingFirstName);
	$customer->setShippingMiddleInitial($ShippingMiddleInitial);
	$customer->setShippingLastName($ShippingLastName);
	$customer->setShippingAddress1($ShippingAddress1);
	$customer->setShippingAddress2($ShippingAddress2);
	$customer->setShippingCity($ShippingCity);
	$customer->setShippingState($ShippingState);
	$customer->setShippingProvince($ShippingProvince);
	$customer->setShippingZip($ShippingZip);
	$customer->setShippingCountry($ShippingCountry);
}

if (WebContent::getPropertyValue("ask_billing_info") == "" || WebContent::getPropertyValue("ask_billing_info") == "yes") {
	$customer->setBillingFirstName($BillingFirstName);
	$customer->setBillingMiddleInitial($BillingMiddleInitial);
	$customer->setBillingLastName($BillingLastName);
	$customer->setBillingAddress1($BillingAddress1);
	$customer->setBillingAddress2($BillingAddress2);
	$customer->setBillingCity($BillingCity);
	$customer->setBillingState($BillingState);
	$customer->setBillingProvince($BillingProvince);
	$customer->setBillingZip($BillingZip);
	$customer->setBillingCountry($BillingCountry);
	$customer->setBillingPhone($BillingPhone);
	if ((($payment->getPaymentService(_USER) == "Manual" && WebContent::getPropertyValue("payment_method") == "Credit Card") || $payment->getPaymentService(_USER) == "VeriSign PayFlow Pro" || $payment->getPaymentService(_USER) == "Paradata") || ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && (WebContent::getPropertyValue("verisign_order_form") == "" || WebContent::getPropertyValue("verisign_order_form") == "False"))) {
		if (WebContent::getPropertyValue("other_payment_type") != "") {
			$customer->setPaymentMethod($PaymentMethod);
			if ($PaymentMethod == "credit card") {
				$customer->setPaymentType($PaymentType);
				$customer->setAccountNumber($AccountNumber);
				$customer->setCreditCardExpDate($cc_exp_mm . $cc_exp_yyyy);
				$customer->setCreditCardVerCode($CreditCardVerCode);
			} else
				$customer->setPaymentType($PaymentMethod);
		} else {
			$customer->setPaymentType($PaymentType);
			$customer->setAccountNumber($AccountNumber);
			$customer->setCreditCardExpDate($cc_exp_mm . $cc_exp_yyyy);
			$customer->setCreditCardVerCode($CreditCardVerCode);
		}
	}
}

if ($msg <> "") {
	$customer->setMessage($msg);
}

session_register("customer");

$shipping = new ShippingRate($user_id);
$shipping->setShippingState($customer->getShippingState());
$shipping->setShippingCity($customer->getShippingCity());
$shipping->setShippingZip($customer->getShippingZip());
$shipping->setShippingCountry($customer->getShippingCountry());
if (WebContent::getPropertyValue("shipping_mode") == "auto")
	$shipping->setAddressType($address_type);

if (WebContent::getPropertyValue("free_shipping") == "true") {
	$free_shipping = "true";
	$free_shipping_method = WebContent::getPropertyValue("free_shipping_category");
} else
	$free_shipping = "false";

if (WebContent::getPropertyValue("shipping_mode") == "manual") {
	if (WebContent::getPropertyValue("ship_rate_calc_method") == "by product")
		$shipping->calculateShippingRate($shopping_cart->getItems($user_id));
	else if (WebContent::getPropertyValue("ship_rate_calc_method") == "by total purchase")
		$shipping->calculateShippingRate2($shopping_cart->getItems($user_id));
	else
		$shipping->calculateShippingRate3($shopping_cart->getItems($user_id));
	$shipping_method = $shipping->getShippingMethod();
	$shipping_rate = $shipping->getShippingRate();
} else {
	$ups = new UPS();
	if (strtolower($customer->getShippingCountry()) == "united states") {
		if (WebContent::getPropertyValue("shipping_method") != "") 
			$shipping_method = explode(",",WebContent::getPropertyValue("shipping_method"));
		else
			$shipping_method = array("Ground","3 Day Select","2nd Day Air","2nd Day Air A.M.","Next Day Air Saver","Next Day Air");
	} else {
		if (WebContent::getPropertyValue("international_shipping_method") != "") 
			$shipping_method = explode(",",WebContent::getPropertyValue("international_shipping_method"));
		else {
			if (strtolower($customer->getShippingCountry()) == "canada")
				$shipping_method = array("Canada Standard","Worldwide Expedited","Worldwide Express");
			else
				$shipping_method = array("Worldwide Expedited","Worldwide Express");
		}
	}
	if (WebContent::getPropertyValue("origin_zipcode") != "")
		$origin_zipcode = WebContent::getPropertyValue("origin_zipcode");
	else
		$origin_zipcode = $adminuser->getCompanyZip();
	$itemsincart = $shopping_cart->getItems($user_id);
	$weight = 0;
	$price = 0;
	$groupRate = 0;
	$anyItemsInGroup = false;
	$groupShippingRate = new GroupShippingRate($user_id);
	for ($i=0;$i<count($itemsincart);$i++) {
		$item = $itemsincart[$i];
		$product->setUser((isset($user))?$user:"");
		$prod = $product->getProduct($item["product_id"]);
		$price = $price + ($prod["price"] * $item["quantity"]);
	}
	for ($i=0;$i<count($itemsincart);$i++) {
		$item = $itemsincart[$i];
		$product->setUser((isset($user))?$user:"");
		$prod = $product->getProduct($item["product_id"]);
		$groupShippingRate->createGroupPrice($item["product_id"], ($prod["price"] * $item["quantity"]));
	}
	for ($i=0;$i<count($itemsincart);$i++) {
		$item = $itemsincart[$i];
		$product->setUser((isset($user))?$user:"");
		$prod = $product->getProduct($item["product_id"]);
		if ($groupShippingRate->isInGroup($item["product_id"]) == true) {
			$anyItemsInGroup = true;
			break;
		}
	}
	
	if (WebContent::getPropertyValue("group_shipping") == "true" && $price > WebContent::getPropertyValue("free_shipping_price") && $anyItemsInGroup == true) {
		$groupRate = WebContent::getPropertyValue("extra_shipping_fee");
	} else {
		for ($i=0;$i<count($itemsincart);$i++) {
			$item = $itemsincart[$i];
			$product->setUser((isset($user))?$user:"");
			$prod = $product->getProduct($item["product_id"]);
			if ($groupShippingRate->getRate($item["product_id"]) != null 
				  && $groupShippingRate->getGroupPrice($item["product_id"]) >= $groupShippingRate->getMinimumOrder($item["product_id"])) {
				$groupRate = $groupRate + ($groupShippingRate->getRate($item["product_id"]) * $item["quantity"]);
			} else {
				$weight = $weight + ($prod["weight"] * $item["quantity"]);
			}
		}
	}
	
	for ($i=0;$i<count($shipping_method);$i++) {
		if (strtolower($customer->getShippingCountry()) == "united states")
			$zone = $ups->getZone($origin_zipcode,$customer->getShippingZip(),$shipping_method[$i]);
		else if (strtolower($customer->getShippingCountry()) == "canada")
			$zone = $ups->getCanadaZone(WebContent::getPropertyValue("origin_state"),$customer->getShippingZip(),$shipping_method[$i]);
		else
			$zone = $ups->getWorldWideZone(WebContent::getPropertyValue("origin_region"),$customer->getShippingCountry(),$shipping_method[$i]);

		if ($free_shipping == "true" && $shipping_method[$i] == "Ground") {
			if (strtolower($customer->getShippingCountry()) == "united states") 
				$rate = $ups->getRate($origin_zipcode,$customer->getShippingZip(),$zone,$shipping_method[$i],$weight,$shipping->getAddressType());
			else if (strtolower($customer->getShippingCountry()) == "canada")
				$rate = $ups->getCanadaRate($zone,$shipping_method[$i],$weight);
			else
				$rate = $ups->getWorldWideRate($zone,$shipping_method[$i],$weight);
			
			if (is_numeric($rate) && $free_shipping_method == "by price" && $price >= WebContent::getPropertyValue("free_shipping_price"))
				$rate = 0.00;
			else if (is_numeric($rate) && $free_shipping_method == "by city" && $customer->getShippingCity() == WebContent::getPropertyValue("free_shipping_city"))
				$rate = 0.00;
			else if (is_numeric($rate) && $free_shipping_method == "by zip" && $customer->getShippingZip() >= strtok(WebContent::getPropertyValue("free_shipping_zip"),"-") && $customer->getShippingZip() <= strtok("-"))
				$rate = 0.00;
			
			if ($weight == 0)
				$rate = 0.00;
				
			$rate = $rate + $groupRate;

			if (WebContent::getPropertyValue("extra_shipping") == "true") { 
				if (is_numeric($rate) && WebContent::getPropertyValue("extra_shipping_category") == "by weight" && $weight > WebContent::getPropertyValue("extra_shipping_weight")) {
					$rate = $rate + WebContent::getPropertyValue("extra_shipping_fee");
				} else if (is_numeric($rate) && WebContent::getPropertyValue("extra_shipping_category") == "by city" && $customer->getShippingCity() == WebContent::getPropertyValue("extra_shipping_city"))
					$rate = $rate + WebContent::getPropertyValue("extra_shipping_fee");
				else if (is_numeric($rate) && WebContent::getPropertyValue("extra_shipping_category") == "by zip" && $customer->getShippingZip() >= strtok(WebContent::getPropertyValue("extra_shipping_zip"),"-") && $customer->getShippingZip() <= strtok("-"))
					$rate = $rate + WebContent::getPropertyValue("extra_shipping_fee");
			}
			
			$shipping_rate [] = $rate;
		} else {
			if (strtolower($customer->getShippingCountry()) == "united states")
				$rate = $ups->getRate($origin_zipcode,$customer->getShippingZip(),$zone,$shipping_method[$i],$weight,$shipping->getAddressType());
			else if (strtolower($customer->getShippingCountry()) == "canada")
				$rate = $ups->getCanadaRate($zone,$shipping_method[$i],$weight);
			else
				$rate = $ups->getWorldWideRate($zone,$shipping_method[$i],$weight);
				
			if ($weight == 0)
				$rate = 0.00;
				
			$rate = $rate + $groupRate;
				
			if (WebContent::getPropertyValue("extra_shipping") == "true") {
				if ($rate != "-" && WebContent::getPropertyValue("extra_shipping_category") == "by weight" && $weight > WebContent::getPropertyValue("extra_shipping_weight"))
					$rate = $rate + WebContent::getPropertyValue("extra_shipping_fee");
				else if ($rate != "-" && WebContent::getPropertyValue("extra_shipping_category") == "by city" && $customer->getShippingCity() == WebContent::getPropertyValue("extra_shipping_city"))
					$rate = $rate + WebContent::getPropertyValue("extra_shipping_fee");
				else if ($rate != "-" && WebContent::getPropertyValue("extra_shipping_category") == "by zip" && $customer->getShippingZip() >= strtok(WebContent::getPropertyValue("extra_shipping_zip"),"-") && $customer->getShippingZip() <= strtok("-"))
					$rate = $rate + WebContent::getPropertyValue("extra_shipping_fee");
			} 
			$shipping_rate [] = $rate;
		}
		$shipping_method [$i] = "UPS " . $shipping_method[$i];
	}
	$shipping->setShippingMethod($shipping_method);
	$shipping->setShippingRate($shipping_rate);
}
session_register("shipping");
?>
