<?php
$product = new Product();
if (isset($HTTP_COOKIE_VARS["user"])) 
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
$product->setUser((isset($user))?$user:"");
$images = $product->getProductImagesGallery($ProductId);
$product = $product->getProduct($ProductId);
$payment = new Payment();
?>
