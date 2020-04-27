<?php
$product = new Product();
if ($Action != "View" && $Action != "Update")
	$prd = $product->getProduct(is_array($ProductId)?$ProductId[0]:$ProductId);

if ($Action != "View" && $Action != "Update" && isset($Quantity) && $Quantity > $prd["qty"] && $prd["qty"] > 0) {
} else if ($Action != "View" && $Action != "Update" && isset($Quantity) && $Quantity < 1) {
} else if ($Action != "View" && $Action != "Update" && $prd["qty"] <= 0) {
} else {
	$admin = new Admin();
	$comp = $adminuser->getComponent(_USER);
	$adminuser->retrieveAdminInfo(_USER);
	if (isset($HTTP_COOKIE_VARS["user"])) {
		$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
		$user_id = $user->getUserId();
		$shopping_cart = new ShoppingCart();
		if ($Action == "Add") {
			$color_str = (isset($Color))?$Color:"";
			$size_str = (isset($Size))?$Size:"";
			$choice_str = (isset($Choice))?$Choice:"";
			if (is_array($ProductId)) {
				$shopping_cart->addMultipleItems($user->getUserId(),$ProductId,$color_str,$size_str,$choice_str);
			} else if (isset($Quantity)) {
				if (isset($UserId)) {
					$wish_list = new WishList();
					$wish_list->deleteItem($UserId,$ProductId,$Quantity);
				}
				$shopping_cart->addItems($user->getUserId(),$ProductId,$color_str,$size_str,$choice_str,$Quantity);
			} else {
				$shopping_cart->addItem($user->getUserId(),$ProductId,$color_str,$size_str,$choice_str);
			}
		} else if ($Action == "Update") {
			//for ($n=0;$n<count($ProductId);$n++) {
				if (!isset($color))
					for ($i=0;$i<count($ProductId);$i++)
						$color[] = "";
				if (!isset($size))
					for ($i=0;$i<count($ProductId);$i++)
						$size[] = "";
				if (!isset($choices))
					for ($i=0;$i<count($ProductId);$i++)
						$choices[] = ""; 	
				if ($shopping_cart->isItemsInStock($ProductId,$quantity))
					$shopping_cart->updateItem($user->getUserId(),$ProductId,$quantity,$color,$size,$choices);
			//}
		} else if ($Action == "Delete") 
			$shopping_cart->deleteItem($user->getUserId(),$ProductId,$Quantity);
	} else if (array_search("User Account",$comp) < 0 || array_search("User Account",$comp) == "" || WebContent::getPropertyValue("user_account") == "no") {
		$user_id = "";
		if (session_is_registered("shopping_cart")) {
			$shopping_cart = $HTTP_SESSION_VARS["shopping_cart"];
		} else {
			$shopping_cart = new ShoppingCart();
			session_register("shopping_cart");
		}
	
		if ($Action == "Add") {
			$color_str = (isset($Color))?$Color:"";
			$size_str = (isset($Size))?$Size:"";
			$choice_str = (isset($Choice))?$Choice:"";
			if (is_array($ProductId)) {
				$shopping_cart->addMultipleItems("",$ProductId,$color_str,$size_str,$choice_str);
			} else if (isset($Quantity)) {
				$shopping_cart->addItems("",$ProductId,$color_str,$size_str,$choice_str,$Quantity);
			} else {
				$shopping_cart->addItem("",$ProductId,$color_str,$size_str,$choice_str);
			}
		} else if ($Action == "Update") { 
			//for ($i=0;$i<count($ProductId);$i++) {
				if (!isset($color))
					for ($i=0;$i<count($ProductId);$i++)
						$color[] = "";
				if (!isset($size))
					for ($i=0;$i<count($ProductId);$i++)
						$size[] = "";
				if (!isset($choices))
					for ($i=0;$i<count($ProductId);$i++)
						$choices[] = ""; 	
				if ($shopping_cart->isItemsInStock($ProductId,$quantity))
					$shopping_cart->updateItem("",$ProductId,$quantity,$color,$size,$choices);
			//}
		} else if ($Action == "Delete") 
			$shopping_cart->deleteItem("",$ProductId,$Quantity);
	}
	
	if (isset($shopping_cart)) {
		$cart = $shopping_cart->getItems($user_id);
		$product_color_exist = false;
		for ($i=0;$i<count($cart);$i++) {
			$item = $cart[$i];
			$prod = $product->getProduct($item["product_id"]);
			if ($prod["color"] != "") {
				$product_color_exist = true;
				break;
			}		
		}
		$product_size_exist = false;
		for ($i=0;$i<count($cart);$i++) {
			$item = $cart[$i];
			$prod = $product->getProduct($item["product_id"]);
			if ($prod["size"] != "") {
				$product_size_exist = true;
				break;
			}		
		}
		$product_choices_exist = false;
		for ($i=0;$i<count($cart);$i++) {
			$item = $cart[$i];
			$prod = $product->getProduct($item["product_id"]);
			if ($prod["choices"] != "") {
				$product_choices_exist = true;
				break;
			}		
		}
	}
	$company_url = $adminuser->getCompanyURL();
}
if (isset($shopping_cart) && count($shopping_cart->getErrorMessages()) > 0)
	$err_msg = implode("\\n",$shopping_cart->getErrorMessages());
?>

