<?php
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$user_id = $user->getUserId();
	$shopping_cart = new ShoppingCart();
} else {
	$user_id = "";
	if (session_is_registered("shopping_cart")) {
		$shopping_cart = $HTTP_SESSION_VARS["shopping_cart"];
	}
}
if (session_is_registered("customer")) {
	$customer = $HTTP_SESSION_VARS["customer"];
} else {
	$customer = new Customer($user_id);
	$customer->retrieveCustomerData();
}
if (!session_is_registered("sub_total"))
	session_register("sub_total");
else 
	$HTTP_SESSION_VARS["sub_total"] = $HTTP_GET_VARS["sub_total"];
if (isset($user) && $customer->getFirstName() == "") {
	$first_name = $user->getFirstName();
	$last_name = $user->getLastName();
	$email = $user->getEmail();
} else {
	$first_name = $customer->getFirstName();
	$last_name = $customer->getLastName();
	$email = $customer->getEmail();
}

if (WebContent::getPropertyValue("shipping_mode") == "manual" && WebContent::getPropertyValue("ship_rate_calc_method") == "by total purchase" && WebContent::getPropertyValue("express_checkout") == "yes") {
	if (isset($HTTP_COOKIE_VARS["user"])) {
		$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
		$user_id = $user->getUserId();
		$shopping_cart = new ShoppingCart();
	} else {
		$user_id = "";
		if (isset($HTTP_SESSION_VARS["shopping_cart"]))
			$shopping_cart = $HTTP_SESSION_VARS["shopping_cart"];
		else
			$shopping_cart - new ShoppingCart();
	}
	$shipping = new ShippingRate($user_id);
	$shipping->setShippingZip(0);
	$shipping->calculateShippingRate2($shopping_cart->getItems($user_id));
	$shipping_method = $shipping->getShippingMethod();
	$shipping_rate = $shipping->getShippingRate();
}
?>
