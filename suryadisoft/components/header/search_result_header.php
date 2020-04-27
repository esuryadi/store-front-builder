<?php
$product = new Product();
$product->setMainCategory($Category);
$product->setKeyword($Keyword);
if (isset($HTTP_COOKIE_VARS["user"])) 
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
$product->search((isset($user))?$user:"");
?>
