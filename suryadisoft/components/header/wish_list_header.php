<?php
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$wish_list = new WishList();
	$product = new Product();
	if ($Action == "Add") {
		$color_str = (isset($Color))?$Color:"";
		$size_str = (isset($Size))?$Size:"";
		$choice_str = (isset($Choice))?$Choice:"";
		$wish_list->addItem($user->getUserId(),$ProductId,$color_str,$size_str,$choice_str);
	} else if ($Action == "Update") {
		for ($i=0;$i<count($ProductId);$i++) {
			$color_str = (isset($color))?$color[$i]:"";
			$size_str = (isset($size))?$size[$i]:"";
			$choice_str = (isset($choices))?$choices[$i]:"";
			$wish_list->updateItem($user->getUserId(),$ProductId[$i],$quantity[$i],$color_str,$size_str,$choice_str);
		}
	} else if ($Action == "Delete") 
		$wish_list->deleteItem($user->getUserId(),$ProductId,$Quantity);
} 
if (isset($UserId)) {
	$wish_list_user = new WebUser($UserId,"");
	$wish_list_user->setFirstName($FirstName);
	$wish_list_user->setLastName($LastName);
	$wish_list = new WishList();
	$product = new Product();
}
if (isset($Action) && $Action == "MailWishList") {
	$wish_list = new WishList();
	$wish_list->mailWishList($user,$mail_to,$mail_subject,$mail_body);
}

if (isset($user)) {
	$user_id = $user->getUserId();
	$first_name = $user->getFirstName();
	$last_name = $user->getLastName();
	$user_password = $user->getPassword();
} else if (isset($wish_list_user)) {
	$user_id = $wish_list_user->getUserId();
	$first_name = $wish_list_user->getFirstName();
	$last_name = $wish_list_user->getLastName();
	$user_password = $wish_list_user->getPassword();
}
		
if (isset($wish_list) || isset($wish_list_user)) {
	$list = $wish_list->getItems($user_id);
	$product_color_exist = false;
	for ($i=0;$i<count($list);$i++) {
		$item = $list[$i];
		$prod = $product->getProduct($item["product_id"]);
		if ($prod["color"] != "") {
			$product_color_exist = true;
			break;
		}		
	}
	$product_size_exist = false;
	for ($i=0;$i<count($list);$i++) {
		$item = $list[$i];
		$prod = $product->getProduct($item["product_id"]);
		if ($prod["size"] != "") {
			$product_size_exist = true;
			break;
		}		
	}
	$product_choices_exist = false;
	for ($i=0;$i<count($list);$i++) {
		$item = $list[$i];
		$prod = $product->getProduct($item["product_id"]);
		if ($prod["choices"] != "") {
			$product_choices_exist = true;
			break;
		}		
	}
}
$admin = new Admin();
$adminuser->retrieveAdminInfo(_USER);
$company_name = $adminuser->getCompanyName();
$company_url = $adminuser->getCompanyURL();
?>
<? if ($payment->getPaymentService(_USER) == "PayPal") {?>
	<form name="PayPalCart" action="mystore.php?Page=<? if (isset($HTTP_SESSION_VARS["customer"])) {?>CheckOut2<? } else {?>CheckOut1<? }?>" method="post">
	<input type="hidden" name="ProductId" value="<?=$item["product_id"]?>">
	<input type="hidden" name="Color" value="<?=$item["product_color"]?>">
	<input type="hidden" name="Size" value="<?=$item["product_size"]?>">
	<input type="hidden" name="Choice" value="<?=$item["product_choice"]?>">
	</form>
<? }?>