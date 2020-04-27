<?php
$payment = new Payment();
$theme = new Themes();
$adminuser = new Admin();
$adminuser->retrieveAdminInfo(_USER);
if (!isset($Page))
	$Page = "Home";

if ($adminuser->getStatus() == "Suspended") {
	print "<br><br>";
	print "<center><h2>Your account has been suspended!</h2></center>";
	print "<center><h2>Please contact the Administrator (<a href=\"mailto:webmaster@suryadisoft.net\">webmaster@suryadisoft.net</a>)</h2></center>";
} else if ($adminuser->getStatus() == "Inactive") {
	print "<br><br>";
	print "<center><h2>Your account is not active!</h2></center>";
	print "<center><h2>Please contact the Administrator (<a href=\"mailto:webmaster@suryadisoft.net\">webmaster@suryadisoft.net</a>)</h2></center>";
} else {
	include (_TEMPLATEPATH . "cool_3D/components/header.php");		
	if (isset($user)) $shopping_cart = new ShoppingCart();
	include (_TEMPLATEPATH . "cool_3D/components/content.php");	
}
?>
