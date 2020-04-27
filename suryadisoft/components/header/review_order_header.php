<?php
if (!isset($HTTP_COOKIE_VARS["user"]) && !session_is_registered("shopping_cart"))
	header("Location:mystore.php?Page=ShoppingCart");

if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$user_id = $user->getUserId();
	$shopping_cart = new ShoppingCart();
} else {
	$user_id = "";
	$shopping_cart = $HTTP_SESSION_VARS["shopping_cart"];
}	
$transaction = new Transaction();
$product = new Product();
$customer = $HTTP_SESSION_VARS["customer"];
$customer->setMessage($message);
if (WebContent::getPropertyValue("ask_shipping_info") == "" || WebContent::getPropertyValue("ask_shipping_info") == "yes") {
	$shipping = $HTTP_SESSION_VARS["shipping"];
	$shipping_method = $shipping->getShippingMethod();
	$shipping_rate = $shipping->getShippingRate();	
	if (isset($AdditionalServices)) {
		if (array_search("Saturday Delivery",$AdditionalServices) > -1) {
			$customer->setShippingMethod($shipping_method[$ShippingMethod] . " with Saturday Delivery");
			$customer->setShippingRate($shipping_rate[$ShippingMethod] + 12.50);
		}
	} else {
		$customer->setShippingMethod($shipping_method[$ShippingMethod]);
		$customer->setShippingRate($shipping_rate[$ShippingMethod]);
	}
}
session_unregister("customer");
session_register("customer");
$cart = $shopping_cart->getItems($user_id);
$discounts = Array();
$product_coupons = Array();
$coupon_expired = false;
if (isset($prod_coupons) && $prod_coupons != "") {
	$product_coupons = explode(";",$prod_coupons);
	for ($i=0;$i<count($cart);$i++) {
		$item = $cart[$i];
		$z = 0;
		for ($n=0;$n<count($product_coupons);$n++) {
			$coupon = $product->getCoupons($product_coupons[$n]);
			if ($coupon["exp_date"] == "0000-00-00" || strtotime($coupon["exp_date"]) >= strtotime(date("Y-m-d"))) {
				if ($coupon["product_id"] == 0) {
					if ($i == 0) {
						if ($coupon["discount_type"] == "percentage")
							$discounts [] = $coupon["coupon_value"]/100 * $HTTP_SESSION_VARS["sub_total"];
						else
							$discounts [] = $coupon["coupon_value"];
					}
				} else {
					if ($item["product_id"] == $coupon["product_id"]) {
						$prod = $product->getProduct($item["product_id"]);
						$z++;
						if ($z <= $item["quantity"]) {
							if ($coupon["discount_type"] == "percentage")
								$discounts [] = $coupon["coupon_value"]/100 * $prod["price"];
							else
								$discounts [] = $coupon["coupon_value"];
						}
					}
				}
			} else {
				$coupon_expired = true;
			}
		}
	}
}

if (!session_is_registered("product_coupons"))
	session_register("product_coupons");
				
$product_color_exist = false;
for ($i=0;$i<count($cart);$i++) {
	$item = $cart[$i];
	if ($item["product_color"] != "") {
		$product_color_exist = true;
		break;
	}		
}
$product_size_exist = false;
for ($i=0;$i<count($cart);$i++) {
	$item = $cart[$i];
	if ($item["product_size"] != "") {
		$product_size_exist = true;
		break;
	}		
}
$product_choices_exist = false;
for ($i=0;$i<count($cart);$i++) {
	$item = $cart[$i];
	if ($item["product_choices"] != "") {
		$product_choices_exist = true;
		break;
	}		
}

$cart = $shopping_cart->getItems($user_id);
$subtotal = 0;
$total_quantity = 0;
$sales_tax_rate = SalesTax::getSalesTaxRate($customer->getState());
for ($i=0;$i<count($cart);$i++) {
	$item = $cart[$i];
	$product->setUser((isset($user))?$user:"");
	$prod = $product->getProduct($item["product_id"]);
	$price = $prod["price"] * $item["quantity"];
	$total_quantity += $item["quantity"];
	$subtotal = $subtotal + $price;
}
$discount_value = 0; 
for ($i=0;$i<count($discounts);$i++) {
	$discount_value = $discount_value + $discounts[$i];
}
$volume_discount = $product->getVolumeDiscount($subtotal,$total_quantity);
$discount_value = $discount_value + $volume_discount;

if (WebContent::getPropertyValue("TaxShipping") == "yes")
	$sales_tax = $sales_tax_rate * ($subtotal - $discount_value + $customer->getShippingRate());
else
	$sales_tax = $sales_tax_rate * ($subtotal - $discount_value);
$total = $subtotal - $discount_value + $sales_tax + $customer->getShippingRate();
?>

<? if ($payment->getPaymentService(_USER) == "PayPal" || $customer->getPaymentMethod() == "PayPal" || $customer->getPaymentMethod() == "Check") {?>
	<form name="processOrderForm" action="mystore.php?Page=ProcessOrder" method="POST">
		<!-- <input type="image" src="https://www.suryadisoft.net/images/spacer.gif"> -->
		<input type="hidden" name="coupon_code" value="<? if (isset($prod_coupons)) {?><?=$prod_coupons?><? }?>">
		<input type="hidden" name="business" value="<?=WebContent::getPropertyValue("paypal_account")?>">
		<input type="hidden" name="item_name" value="<?=$adminuser->getCompanyName() . " purchase order"?>">
		<input type="hidden" name="item_number" value="<?=$transaction->getTransactionId()?>">
		<input type="hidden" name="amount" value="<? printf("%01.2f",$total);?>">
		<input type="hidden" name="return" value="http://<?=$adminuser->getCompanyURL()?>">
		<input type="hidden" name="cancel_return" value="http://<?=$adminuser->getCompanyURL()?>">
		<? if (WebContent::getPropertyValue("ask_cust_info") == "" || WebContent::getPropertyValue("ask_cust_info") == "yes") {?>
		<input type="hidden" name="first_name" value="<?=$customer->getFirstName()?>">
		<input type="hidden" name="last_name" value="<?=$customer->getLastName()?>">
		<input type="hidden" name="address1" value="<?=$customer->getAddress1()?>">
		<input type="hidden" name="address2" value="<?=$customer->getAddress2()?>">
		<input type="hidden" name="city" value="<?=$customer->getCity()?>">
		<input type="hidden" name="state" value="<?=$customer->getState()?>">
		<input type="hidden" name="zip" value="<?=$customer->getZip()?>">
		<input type="hidden" name="day_phone_a" value="<?=$customer->getDayPhone()?>">
		<input type="hidden" name="night_phone_a" value="<?=$customer->getEveningPhone()?>">
		<? }?>
		<? if(WebContent::getPropertyValue("logo_img_src") != "") {?>
		<!input type="hidden" name="image_url" value="http://<?=$adminuser->getCompanyURL()?>/<?=WebContent::getPropertyValue("logo_img_src")?>"> 
		<? }?>
	<?php
	$TotalCharges = sprintf("%01.2f",$total);
	$SubTotalCharges = sprintf("%01.2f",$subtotal);
	$SalesTax = sprintf("%01.2f",$sales_tax);
	$Shipping = sprintf("%01.2f",$customer->getShippingRate());
	$DiscountValue = sprintf("%01.2f",$discount_value);
	if (!session_is_registered("TotalCharges"))
		session_register("TotalCharges");
	if (!session_is_registered("SubTotalCharges"))
		session_register("SubTotalCharges");
	if (!session_is_registered("SalesTax"))
		session_register("SalesTax");
	if (!session_is_registered("Shipping"))
		session_register("Shipping");
	if (!session_is_registered("DiscountValue"))
		session_register("DiscountValue");
	?>
<? } else if ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link") {?>
	<? if (WebContent::getPropertyValue("record_transaction") == "yes") {?>
	<form name="processOrderForm" method="post" action="mystore.php?Page=ProcessOrder">
	<? } else {?>
	<form name="processOrderForm" method="POST" action="https://payflowlink.verisign.com/payflowlink.cfm">
	<? }?>
	<!-- <input type="image" src="https://www.suryadisoft.net/images/spacer.gif"> -->
	<input type="hidden" name="coupon_code" value="<? if (isset($prod_coupons)) {?><?=$prod_coupons?><? }?>">
	<input type="hidden" name="TYPE" value="<?=WebContent::getPropertyValue("verisign_trxtype")?>">
	<input type="hidden" name="LOGIN" value="<?=WebContent::getPropertyValue("verisign_user_id")?>">
	<input type="hidden" name="PARTNER" value="<?=WebContent::getPropertyValue("verisign_partner")?>">
	<input type="hidden" name="METHOD" value="<?=WebContent::getPropertyValue("verisign_method")?>">
	<input type="hidden" name="INVOICE" value="<?=$transaction->getInvoiceNumber()?>">
	<input type="hidden" name="PONUM" value="<?=$transaction->getTransactionId()?>">
	<input type="hidden" name="DESCRIPTION" value="<?=$adminuser->getCompanyName() . " sales"?>">
	<input type="hidden" name="NAME" value="<?=$customer->getBillingFirstName() . " " . $customer->getBillingLastName()?>">
	<input type="hidden" name="ADDRESS" value="<?=$customer->getBillingAddress1() . " " . $customer->getBillingAddress2()?>">
	<input type="hidden" name="CITY" value="<?=$customer->getBillingCity()?>">
	<input type="hidden" name="STATE" value="<?=$customer->getBillingState()?>">
	<input type="hidden" name="ZIP" value="<?=$customer->getBillingZip()?>">
	<input type="hidden" name="PHONE" value="<?=$customer->getBillingPhone()?>">
	<? if (WebContent::getPropertyValue("verisign_order_form") == "" || WebContent::getPropertyValue("verisign_order_form") == "False") {?>
	<input type="hidden" name="CARDNUM" value="<?=$customer->getAccountNumber()?>">
	<input type="hidden" name="EXPDATE" value="<?=$customer->getCreditCardExpDate()?>">
	<? }?>
	<input type="hidden" name="AMOUNT" value="<? printf("%01.2f",$total);?>">
	<input type="hidden" name="TAX" value="<? printf("%01.2f",$sales_tax);?>">
	<input type="hidden" name="SHIPAMOUNT" value="<? printf("%01.2f",$customer->getShippingRate());?>">
	<input type="hidden" name="ADDRESSTOSHIP" value="<?=$customer->getShippingAddress1() . " " . $customer->getShippingAddress2()?>">
	<input type="hidden" name="CITYTOSHIP" value="<?=$customer->getShippingCity()?>">
	<input type="hidden" name="STATETOSHIP" value="<?=$customer->getShippingState()?>">
	<input type="hidden" name="ZIPTOSHIP" value="<?=$customer->getShippingZip()?>">
	<input type="hidden" name="EMAIL" value="<?=$customer->getEmail()?>">
	<input type="hidden" name="EMAILTOSHIP" value="<?=$customer->getEmail()?>">
	<input type="hidden" name="NAMETOSHIP" value="<?=$customer->getShippingFirstName() . " " . $customer->getShippingLastName()?>">
	<input type="hidden" name="ECHODATA" value="True">
	<input type="hidden" name="EMAILCUSTOMER" value="<?=WebContent::getPropertyValue("verisign_email_customer")?>">
	<input type="hidden" name="ORDERFORM" value="<?=WebContent::getPropertyValue("verisign_order_form")?>">
	<input type="hidden" name="SHOWCONFIRM" value="<?=WebContent::getPropertyValue("verisign_show_confirmation")?>">
	</form>
	<?php
	$TotalCharges = sprintf("%01.2f",$total);
	$SubTotalCharges = sprintf("%01.2f",$subtotal);
	$SalesTax = sprintf("%01.2f",$sales_tax);
	$Shipping = sprintf("%01.2f",$customer->getShippingRate());
	$DiscountValue = sprintf("%01.2f",$discount_value);
	if (!session_is_registered("TotalCharges"))
		session_register("TotalCharges");
	if (!session_is_registered("SubTotalCharges"))
		session_register("SubTotalCharges");
	if (!session_is_registered("SalesTax"))
		session_register("SalesTax");
	if (!session_is_registered("Shipping"))
		session_register("Shipping");
	if (!session_is_registered("DiscountValue"))
		session_register("DiscountValue");
	?>
<? } else if ($payment->getPaymentService(_USER) == "Authorize.Net") {
	include(_CLASSPATH . "simlib.php");
	srand(time());
	$sequence = rand(1, 1000);?>
	<form name="processOrderForm" method="POST" action="https://secure.authorize.net/gateway/transact.dll">
	<? $ret = InsertFP (WebContent::getPropertyValue("login_id"), WebContent::getPropertyValue("transaction_key"), $total, $sequence);?>
	<!-- <input type="image" src="https://www.suryadisoft.net/images/spacer.gif"> -->
	<input type="hidden" name="coupon_code" value="<? if (isset($prod_coupons)) {?><?=$prod_coupons?><? }?>">
	<input type="hidden" name="x_Login" value="<?=WebContent::getPropertyValue("login_id")?>">
	<input type="hidden" name="x_Method" value="<?=WebContent::getPropertyValue("transaction_method")?>">
	<input type="hidden" name="x_Type" value="<?=WebContent::getPropertyValue("transaction_type")?>">
	<input type="hidden" name="x_Show_Form" value="PAYMENT_FORM">
	<input type="hidden" name="x_Invoice_Num" value="<?=$transaction->getInvoiceNumber()?>">
	<input type="hidden" name="x_PO_Num" value="<?=$transaction->getTransactionId()?>">
	<input type="hidden" name="x_Description" value="<?=$adminuser->getCompanyName() . " sales"?>">
	<input type="hidden" name="x_First_name" value="<?=$customer->getBillingFirstName()?>">
	<input type="hidden" name="x_Last_name" value="<?=$customer->getBillingLastName()?>">
	<input type="hidden" name="x_Address" value="<?=$customer->getBillingAddress1() . " " . $customer->getBillingAddress2()?>">
	<input type="hidden" name="x_City" value="<?=$customer->getBillingCity()?>">
	<input type="hidden" name="x_State" value="<?=$customer->getBillingState()?>">
	<input type="hidden" name="x_Zip" value="<?=$customer->getBillingZip()?>">
	<input type="hidden" name="x_Country" value="<?=$customer->getBillingCountry()?>">
	<input type="hidden" name="x_Phone" value="<?=$customer->getBillingPhone()?>">
	<input type="hidden" name="x_Fax" value="<?=$customer->getFax()?>">
	<input type="hidden" name="x_Amount" value="<? printf("%01.2f",$total);?>">
	<input type="hidden" name="x_Tax" value="<? printf("%01.2f",$sales_tax);?>">
	<input type="hidden" name="x_Ship_To_First_Name" value="<?=$customer->getShippingFirstName()?>">
	<input type="hidden" name="x_Ship_To_Last_Name" value="<?=$customer->getShippingLastName()?>">
	<input type="hidden" name="x_Ship_To_Address" value="<?=$customer->getShippingAddress1() . " " . $customer->getShippingAddress2()?>">
	<input type="hidden" name="x_Ship_To_City" value="<?=$customer->getShippingCity()?>">
	<input type="hidden" name="x_Ship_To_State" value="<?=$customer->getShippingState()?>">
	<input type="hidden" name="x_Ship_To_Zip" value="<?=$customer->getShippingZip()?>">
	<input type="hidden" name="x_Email" value="<?=$customer->getEmail()?>">
	<input type="hidden" name="x_Email_Customer" value="<?=WebContent::getPropertyValue("email_customer")?>">
	<!input type="hidden" name="X_Relay_Response" value="TRUE">
	<!input type="hidden" name="X_Relay_URL" value="http://www.<?=$adminuser->getCompanyURL()?>/mystore.php?Page=ProcessOrder">
	<input type="hidden" name="x_Test_Request" value="TRUE">
	</form>
	<?php
	$TotalCharges = sprintf("%01.2f",$total);
	$SubTotalCharges = sprintf("%01.2f",$subtotal);
	$SalesTax = sprintf("%01.2f",$sales_tax);
	$Shipping = sprintf("%01.2f",$customer->getShippingRate());
	$DiscountValue = sprintf("%01.2f",$discount_value);
	if (!session_is_registered("TotalCharges"))
		session_register("TotalCharges");
	if (!session_is_registered("SubTotalCharges"))
		session_register("SubTotalCharges");
	if (!session_is_registered("SalesTax"))
		session_register("SalesTax");
	if (!session_is_registered("Shipping"))
		session_register("Shipping");
	if (!session_is_registered("DiscountValue"))
		session_register("DiscountValue");
	?>
<? } else {?>
	<form name="processOrderForm" method="post" action="mystore.php?Page=ProcessOrder">
	<font size="-1"> 
	<!-- <input type="image" src="https://www.suryadisoft.net/images/spacer.gif"> -->
	<input type="hidden" name="coupon_code" value="<? if (isset($prod_coupons)) {?><?=$prod_coupons?><? }?>">
	<input type="hidden" name="SubTotalCharges" value="<? printf("%01.2f",$subtotal);?>">
	<input type="hidden" name="SalesTax" value="<? printf("%01.2f",$sales_tax);?>">
	<input type="hidden" name="Shipping" value="<? printf("%01.2f",$customer->getShippingRate());?>">
	<input type="hidden" name="TotalCharges" value="<? printf("%01.2f",$total);?>">
	<input type="hidden" name="DiscountValue" value="<? printf("%01.2f",$discount_value);?>">
	</font> 			
	</form>
<? }?>
