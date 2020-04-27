<?php
class ShoppingCart
{
	var $dbconnect;
	var $product_id = "";
	var $product_qty;
	var $product_color;
	var $product_size;
	var $product_choices;
	var $err_msg = Array();
	
	function ShoppingCart()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function addItem($user_id, $product_id, $color, $size, $choice)
	{	
		$this->err_msg = Array();
		$product = new Product();
		$prod = $product->getProduct($product_id);
		
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			//Check if item is already exist. If exist just update the quantity.
			$query = "SELECT SHOPPING_CART_QUANTITY FROM SHOPPING_CART WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id AND PRODUCT_COLOR = '$color' AND PRODUCT_SIZE = '$size' AND PRODUCT_CHOICE = '$choice'";
			$query_result = mysql_query($query);
			$rs = mysql_fetch_row($query_result);
			if (($rs[0] + 1) > $prod["qty"]) {
				$this->err_msg[] = "We only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
			} else {
				if (mysql_num_rows($query_result) > 0)
					$query = "UPDATE SHOPPING_CART SET SHOPPING_CART_QUANTITY = " . ($rs[0] + 1) . " WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
				else
					$query = "INSERT INTO SHOPPING_CART (USER_ID,PRODUCT_ID,PRODUCT_COLOR,PRODUCT_SIZE,PRODUCT_CHOICE,SHOPPING_CART_QUANTITY) VALUES ('$user_id',$product_id,'$color','$size','$choice',1)";
				mysql_query($query);
				
				$this->dbconnect->close();
			
				$this->updateInventory($product_id,-1);
			}
		} else {
			if ($this->product_id == "")
				$this->product_id = Array();			
			$i = array_search($product_id,$this->product_id);
			if ($i > -1 && $this->product_color[$i] == $color && $this->product_size[$i] == $size && $this->product_choice[$i] == $choice) {
				$qty = $this->product_qty[$i] + 1;
				if ($qty > $prod["qty"]) 
					$this->err_msg[] = "We only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
				else
					$this->product_qty[$i] = $qty;
			} else {
				$this->product_id [] = $product_id;
				$this->product_color [] = $color;
				$this->product_size [] = $size;
				$this->product_choices [] = $choice;
				$this->product_qty [] = 1;
			}
		}
	}
	
	function addItems($user_id, $product_id, $color, $size, $choice, $quantity)
	{
		$this->err_msg = Array();
		$product = new Product();
		$prod = $product->getProduct($product_id);
		
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			//Check if item is already exist. If exist just update the quantity.
			$query = "SELECT SHOPPING_CART_QUANTITY FROM SHOPPING_CART WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id AND PRODUCT_COLOR = '$color' AND PRODUCT_SIZE = '$size' AND PRODUCT_CHOICE = '$choice'";
			$query_result = mysql_query($query);
			$rs = mysql_fetch_row($query_result);
			if (($rs[0] + 1) > $prod["qty"]) {
				$this->err_msg[] = "We only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
			} else {
				if (mysql_num_rows($query_result) > 0)
					$query = "UPDATE SHOPPING_CART SET SHOPPING_CART_QUANTITY = " . ($rs[0] + $quantity) . " WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
				else
					$query = "INSERT INTO SHOPPING_CART (USER_ID,PRODUCT_ID,PRODUCT_COLOR,PRODUCT_SIZE,PRODUCT_CHOICE,SHOPPING_CART_QUANTITY) VALUES ('$user_id',$product_id,'$color','$size','$choice',$quantity)";
				mysql_query($query);
				
				$this->dbconnect->close();
				
				$this->updateInventory($product_id,-($quantity));
			}
		} else {
			$this->product_id [] = $product_id;
			$this->product_color [] = $color;
			$this->product_size [] = $size;
			$this->product_choices [] = $choice;
			if ($quantity > $prod["qty"]) { 
				$this->product_qty [] = 0;
				$this->err_msg[] = "We only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
			} else
				$this->product_qty [] = $quantity;
		}
	}
	
	function addMultipleItems($user_id, $product_id, $color, $size, $choice)
	{
		$this->err_msg = Array();
		
		for ($i=0;$i<count($product_id);$i++) {
			$product = new Product();
			$prod = $product->getProduct($product_id[$i]);
			
			if ($user_id != "") {
				$this->dbconnect->open();
				mysql_select_db(_DATABASE);
				
				//Check if item is already exist. If exist just update the quantity.
				$query = "SELECT SHOPPING_CART_QUANTITY FROM SHOPPING_CART WHERE USER_ID = '$user_id' AND PRODUCT_ID = " . $product_id[$i] . " AND PRODUCT_COLOR = '$color' AND PRODUCT_SIZE = '$size' AND PRODUCT_CHOICE = '$choice'";
				$query_result = mysql_query($query);
				$rs = mysql_fetch_row($query_result);
				if (($rs[0] + 1) > $prod["qty"]) {
					$this->err_msg[] = "We only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
				} else {
					if (mysql_num_rows($query_result) > 0)
						$query = "UPDATE SHOPPING_CART SET SHOPPING_CART_QUANTITY = " . ($rs[0] + 1) . " WHERE USER_ID = '$user_id' AND PRODUCT_ID = " . $product_id[$i];
					else
						$query = "INSERT INTO SHOPPING_CART (USER_ID,PRODUCT_ID,PRODUCT_COLOR,PRODUCT_SIZE,PRODUCT_CHOICE,SHOPPING_CART_QUANTITY) VALUES ('$user_id'," . $product_id[$i] . ",'$color','$size','$choice',1)";
					mysql_query($query);
					
					$this->dbconnect->close();
					
					$this->updateInventory($product_id[$i],-1);
				}
			} else {
				if ($this->product_id == "")
					$this->product_id = Array();			
				$n = array_search($product_id[$i],$this->product_id);
				if ($n > -1 && $this->product_color[$n] == $color && $this->product_size[$n] == $size && $this->product_choice[$n] == $choice) {
					$qty = $this->product_qty[$n] + 1;
					if ($qty > $prod["qty"]) 
						$this->err_msg[] = "We only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
					else
						$this->product_qty[$n] = $qty;
				} else {
					$this->product_id [] = $product_id[$i];
					$this->product_color [] = $color;
					$this->product_size [] = $size;
					$this->product_choices [] = $choice;
					$this->product_qty [] = 1;
				}
			}
		} 
	}
	
	function getItems($user_id)
	{
		$cart = Array();
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT * FROM SHOPPING_CART WHERE USER_ID = '$user_id'";
			$query_result = mysql_query($query);
	
			while ($rs = mysql_fetch_row($query_result)) {
				$item["product_id"] = $rs[2];
				$item["product_color"] = $rs[3];
				$item["product_size"] = $rs[4];
				$item["product_choices"] = $rs[5];
				$item["quantity"] = $rs[6];
				$cart[] = $item;
			}
			
			$this->dbconnect->close();
		} else {
			if ($this->product_id != "") { 
				for ($i=0;$i<count($this->product_id);$i++) {
					$item["product_id"] = $this->product_id[$i];
					$item["product_color"] = $this->product_color[$i];
					$item["product_size"] = $this->product_size[$i];
					$item["product_choices"] = $this->product_choices[$i];
					$item["quantity"] = $this->product_qty[$i];
					$cart[] = $item;
				}
			}
		}
		
		return $cart;
	}
	
	function getItemCount($user_id)
	{
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT * FROM SHOPPING_CART WHERE USER_ID = '$user_id'";
			$query_result = mysql_query($query);
			$count = mysql_num_rows($query_result);
				
			$this->dbconnect->close();
		} else {
			if (isset($this->product_id) && $this->product_id != "")
				$count = count($this->product_id);
			else
				$count = 0;
		}
	
		return $count;
	}
	
	function getTotalQuantity($user_id)
	{
		$count = 0;
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT shopping_cart_quantity FROM SHOPPING_CART WHERE USER_ID = '$user_id'";
			$query_result = mysql_query($query);
			
			while($rs = mysql_fetch_row($query_result))
				$count = $count + $rs[0];
				
			$this->dbconnect->close();
		} else {
			if (isset($this->product_qty) && $this->product_qty != "") {
				for($i=0;$i<count($this->product_qty);$i++)
					$count = $count + $this->product_qty[$i];
			}
		}
	
		return $count;
	}
	
	function getSubTotal($user_id)
	{
		$subtotal = 0;
		$count = 0;
		$product = new Product();
		
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT product_id, shopping_cart_quantity FROM SHOPPING_CART WHERE USER_ID = '$user_id'";
			$query_result = mysql_query($query);
			
			$this->dbconnect->close();
			
			while($rs = mysql_fetch_row($query_result)) {
				$prod = $product->getProduct($rs[0]);
				$price = $prod["price"] * $rs[1];
				$subtotal = $subtotal + $price;
			}			
		} else {
			if (isset($this->product_qty) && $this->product_qty != "") {
				for($i=0;$i<count($this->product_qty);$i++) {
					$prod = $product->getProduct($this->product_id[$i]);
					$price = $prod["price"] * $this->product_qty[$i];
					$subtotal = $subtotal + $price;
				}
			}
		}
	
		return $subtotal;
	}
	
	function updateItem($user_id, $product_id, $quantity, $color, $size, $choice)
	{
		if ($quantity == 0) {
			$this->deleteItem($user_id,$product_id,$quantity);
		} else {
			if ($user_id != "") {
				$this->dbconnect->open();
				
				$query_result = "";
				for ($i=0;$i<count($product_id);$i++) {
					mysql_select_db(_DATABASE);
					if ($i == 0 || ($i > 0 && $product_id[$i] != $product_id[$i-1])) { 
						$query = "SELECT ID, SHOPPING_CART_QUANTITY FROM SHOPPING_CART WHERE USER_ID = '$user_id' AND PRODUCT_ID = " . $product_id[$i];
						$query_result = mysql_query($query);
					}
					$rs = mysql_fetch_row($query_result);
					$qty = $quantity[$i] - $rs[1];
					$query = "UPDATE SHOPPING_CART SET SHOPPING_CART_QUANTITY = " . $quantity[$i] . ", PRODUCT_COLOR = '" . $color[$i] . "', PRODUCT_SIZE = '" . $size[$i] . "', PRODUCT_CHOICE = '" . $choice[$i] . "' WHERE USER_ID = '$user_id' AND ID = " . $rs[0];
					mysql_query($query);
					echo mysql_error();
					$this->dbconnect->close();
					$this->updateInventory($product_id[$i],-($qty));
					$this->dbconnect->open();
				}
				$this->dbconnect->close();
			} else {
				//$i = array_search($product_id,$this->product_id);
				$this->product_id = $product_id;				
				$this->product_color = $color;
				$this->product_size = $size;
				$this->product_choices = $choice;
				$this->product_qty = $quantity;
			}
		}
	}
	
	function deleteItem($user_id, $product_id, $quantity)
	{
		$this->err_msg = Array();
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "DELETE FROM SHOPPING_CART WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
			mysql_query($query);
			
			$this->dbconnect->close();
			
			$this->updateInventory($product_id,$quantity);
		} else {
			$i = array_search($product_id,$this->product_id);
			array_splice($this->product_id,$i,1);
			array_splice($this->product_color,$i,1);
			array_splice($this->product_size,$i,1);
			array_splice($this->product_choices,$i,1);
			array_splice($this->product_qty,$i,1);
		}
	}	
	
	function emptyCart($user_id)
	{
		if ($user_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "DELETE FROM SHOPPING_CART WHERE USER_ID = '$user_id'";
			mysql_query($query);
			
			$this->dbconnect->close();
		} else {
			for ($i=0;$i<count($this->product_id);$i++)
				$this->updateInventory($this->product_id[$i],-($this->product_qty[$i]));
			array_splice($this->product_id,0,count($this->product_id));
			array_splice($this->product_color,$i,count($this->product_color));
			array_splice($this->product_size,$i,count($this->product_size));
			array_splice($this->product_choices,$i,count($this->product_choices));
			array_splice($this->product_qty,0,count($this->product_qty));
		}
	}	
	
	function updateInventory($product_id, $quantity)
	{
		$product = new Product();
		$product = $product->getProduct($product_id);
		
		$this->dbconnect->open();
		if(defined("_DATABASE"))
			$database = _DATABASE;
		else 
			$database = _DB;
		mysql_select_db($database);
		
		$qty = $product["qty"] + $quantity;
		$query = "UPDATE PRODUCT SET PRODUCT_QUANTITY = $qty WHERE PRODUCT_ID = $product_id";
		mysql_query($query);
		
		$this->dbconnect->close();
	}
	
	function isItemsInStock($product_id, $quantity) { 
		$this->err_msg = Array();
		$status = true;
		$product = new Product();
		for ($i=0;$i<count($product_id);$i++) {
			$prod = $product->getProduct($product_id[$i]);			
			if ($quantity[$i] > $prod["qty"]) {
				$status = false;
				$this->err_msg[] = "Sorry, we only have " . $prod["qty"] . " \"" . $prod["name"] . "\" left in our inventory.";
			}
		}
		
		return $status;
	}
	
	function getErrorMessages() {
		return $this->err_msg;
	}
}
