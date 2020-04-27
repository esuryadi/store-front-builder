<?php
if (session_is_registered("shopping_cart")) {
	$cart = $HTTP_SESSION_VARS["shopping_cart"];
} else {
	$cart = new ShoppingCart();
}
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$user_id = $user->getUserId();
} else {
	$user_id = "";
}
?> 
<strong>
You have <?=$cart->getTotalQuantity($user_id)?> item(s) in your <a href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$company_url?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">shopping cart</a>. 
</strong>