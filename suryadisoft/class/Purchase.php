<?php
class Purchase
{
	var $dbconnect;
	var $purchase_id;
	var $customer_id;
	var $transaction_id;
	var $product_id;
	var $quantity;
	var $charges;
	var $status;
	
	function Purchase()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function getPurchaseId()
	{
		return $this->purchase_id;
	}

	function setCustomerId($customer_id)
	{
		$this->customer_id = $customer_id;
	}
	
	function getCustomerId()
	{
		return $this->customer_id;
	}
	
	function setTransactionId($transaction_id)
	{
		$this->transaction_id = $transaction_id;
	}
	
	function getTransactionId()
	{
		return $this->transaction_id;
	}
	
	function getProductId()
	{
		return $this->product_id;
	}
	
	function getQuantity()
	{
		return $this->quantity;
	}
	
	function getCharges()
	{
		return $this->charges;
	}
	
	function getStatus()
	{
		return $this->status;
	}
	
	function retrievePurchase()
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT PURCHASE_ID, CUSTOMER_ID, PRODUCT_ID, PURCHASE_QUANTITY, PURCHASE_CHARGE, PURCHASE_STATUS FROM PURCHASE WHERE TRANSACTION_ID = $this->transaction_id";
		$query_result = mysql_query($query);
		while ($rs = mysql_fetch_row($query_result)) {
			$this->purchase_id[] = $rs[0];
			$this->customer_id[] = $rs[1];
			$this->product_id[] = $rs[2];
			$this->quantity[] = $rs[3];
			$this->charges[] = $rs[4];
			$this->status[] = $rs[5];
		}
		
		$this->dbconnect->close();
	}
	
	function storePurchase($shopping_cart,$user)
	{	
		$prod = new Product();
		$prod->setUser((isset($user))?$user:"");
		for ($i=0;$i<count($shopping_cart);$i++) {
			$item = $shopping_cart[$i];
			$product = $prod->getProduct($item["product_id"]);
			$purchase_charge = $product["price"] * $item["quantity"];
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			$query = "INSERT INTO PURCHASE (CUSTOMER_ID,TRANSACTION_ID,PRODUCT_ID,PRODUCT_COLOR,PRODUCT_SIZE,PRODUCT_CHOICE,PURCHASE_QUANTITY,PURCHASE_CHARGE,PURCHASE_STATUS) VALUES ('$this->customer_id','$this->transaction_id','" . $item["product_id"] . "','" . $item["product_color"] . "','" . $item["product_size"] . "','" . $item["product_choices"] . "','" . $item["quantity"] . "','$purchase_charge','In Process')";
			mysql_query($query);
			$this->dbconnect->close();
		}	
	}
}
?>
