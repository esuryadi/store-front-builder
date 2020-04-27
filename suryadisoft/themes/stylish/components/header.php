<?php
if ($Page == "Home") {
	include(_COMPONENTPATH . "header/home_header.php");
} else if ($Page == "ShoppingCart") {
	include(_COMPONENTPATH . "header/shopping_cart_header.php");
} else if ($Page == "WishList") {
	include(_COMPONENTPATH . "header/wish_list_header.php");
} else if ($Page == "FindWishList") {
	include(_COMPONENTPATH . "header/find_wish_list_header.php");
} else if ($Page == "Account") {
	include(_COMPONENTPATH . "header/account_header.php");
} else if ($Page == "SearchResult") {
	include(_COMPONENTPATH . "header/search_result_header.php");
} else if ($Page == "RegistrationResult") {
	include(_COMPONENTPATH . "header/registration_result_header.php");
} else if ($Page == "SignOut") {
	include(_COMPONENTPATH . "header/sign_out_header.php");
} else if ($Page == "ForgetPassword") {
	include(_COMPONENTPATH . "header/forget_password_header.php");
} else if ($Page == "Product") {
	include(_COMPONENTPATH . "header/product_header.php");
} else if ($Page == "CheckOut1") {
	include(_COMPONENTPATH . "header/check_out_step_1_header.php");
} else if ($Page == "CheckOut2") {
	include(_COMPONENTPATH . "header/check_out_step_2_header.php");
} else if ($Page == "ReviewOrder") {
	include(_COMPONENTPATH . "header/review_order_header.php");
} else if ($Page == "ProcessOrder") {
	include(_COMPONENTPATH . "header/process_order_header.php");
}
?>