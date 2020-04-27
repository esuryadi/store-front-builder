<?php 			
if ($Page == "Home") {
	include(_TEMPLATEPATH . "cool_3D/components/home.php");
} else if ($Page == "ShoppingCart") {
	include(_COMPONENTPATH . "body/shopping_cart.php");
} else if ($Page == "WishList") {
	include(_COMPONENTPATH . "body/wish_list.php");
} else if ($Page == "FindWishList") {
	include(_COMPONENTPATH . "body/find_wish_list.php");
} else if ($Page == "Account") {
	include(_COMPONENTPATH . "body/account.php");
} else if ($Page == "SignIn") {
	include(_COMPONENTPATH . "body/sign_in.php");
} else if ($Page == "SearchResult") {
	include(_COMPONENTPATH . "body/search_result.php");
} else if ($Page == "Registration") {
	include(_COMPONENTPATH . "body/registration.php");
} else if ($Page == "ForgetPassword") {
	include(_COMPONENTPATH . "body/forget_password.php");
} else if ($Page == "Product") {
	include(_COMPONENTPATH . "body/product.php");
} else if ($Page == "CheckOut1") {
	include(_COMPONENTPATH . "body/check_out_step_1.php");
} else if ($Page == "CheckOut2") {
	include(_COMPONENTPATH . "body/check_out_step_2.php");
} else if ($Page == "ReviewOrder") {
	include(_COMPONENTPATH . "body/review_order.php");
} else if ($Page == "ProcessOrder") {
	include(_COMPONENTPATH . "body/process_order.php");
} else if ($Page == "MoreProducts") {
	include(_COMPONENTPATH . "body/more_products.php");
} else if ($Page == "Link") {
	include realpath(urldecode($Link));
}
?>