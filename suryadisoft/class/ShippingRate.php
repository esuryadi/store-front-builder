<?php
class ShippingRate
{
	var $dbconnect;
	var $user_id;
	var $shipping_rate = Array();
	var $shipping_method = Array();
	var $shipping_state = "All States";
	var $shipping_city = "All Cities";
	var $shipping_zip = "All Zip";
	var $shipping_country = "United States";
	var $address_type = "residential";
	
	function ShippingRate($user_id)
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
		$this->user_id = $user_id;
	}
	
	function setShippingMethod($shipping_method)
	{
		$this->shipping_method = $shipping_method;
	}
	
	function getShippingMethod()
	{
		return $this->shipping_method;
	}
	
	function setShippingRate($shipping_rate)
	{
		$this->shipping_rate = $shipping_rate;
	}
	
	function getShippingRate()
	{
		return $this->shipping_rate;
	}
	
	function setAddressType($address_type)
	{
		$this->address_type = $address_type;
	}
	
	function getAddressType()
	{
		return $this->address_type;
	}
	
	function calculateShippingRate($shopping_cart_items)
	{
		$item = $shopping_cart_items;
		for ($i=0;$i<count($item);$i++) {
			$product = $item[$i];
			$rate = $this->getRate($product["product_id"],$product["quantity"],$i);
			for ($n=0;$n<count($rate);$n++) {
				$shipping = $rate[$n];
				if ($i == 0)
					$this->shipping_rate[$n] = $shipping["rate"];
				else
					$this->shipping_rate[$n] = $this->shipping_rate[$n] + $shipping["rate"];
				$this->shipping_method[$n] = $shipping["method"];
			}
		}
	}
	
	function calculateShippingRate2($shopping_cart_items)
	{
		$items = $shopping_cart_items;
		$total_purchase = 0;
		for ($i=0;$i<count($items);$i++) {
			$item = $items[$i];
			$product = new Product();
			$product = $product->getProduct($item["product_id"]);
			$sub_total = $product["price"] * $item["quantity"];
			$total_purchase = $total_purchase + $sub_total;
		}
		$this->getRate2($total_purchase);
	}
	
	function calculateShippingRate3($shopping_cart_items)
	{
		$items = $shopping_cart_items;
		$total_weight = 0;
		for ($i=0;$i<count($items);$i++) {
			$item = $items[$i];
			$product = new Product();
			$product = $product->getProduct($item["product_id"]);
			$weight = $product["weight"] * $item["quantity"];
			$total_weight = $total_weight + $weight;
		}
		$this->getRate3($total_weight);
	}
	
	function getRate($product_id,$product_qty,$index)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$where_clause = "";
		if ($this->shipping_state != "All States")
			$where_clause = $where_clause . " AND (STATE = '$this->shipping_state' OR STATE = 'All States')";
		if ($this->shipping_city != "All Cities")
			$where_clause = $where_clause . " AND (CITY = '$this->shipping_city' OR CITY = 'All Cities')";
		if ($this->shipping_zip != "All Zip")
			$where_clause = $where_clause . " AND (ZIP = '$this->shipping_zip' OR ZIP = 'All Zip')";
		if ($this->shipping_country != "United States")
			$where_clause = $where_clause . " AND (COUNTRY = '$this->shipping_country' OR COUNTRY = 'United States')";
		
		$query = "SELECT PRODUCT_ID, SHIPPING_VENDOR, SHIPPING_METHOD, ONE_ITEM_RATE, ADDITIONAL_ITEM_RATE FROM SHIPPING_RATE WHERE PRODUCT_ID = '$product_id' || PRODUCT_ID = '0'" . $where_clause;

		$query_result = mysql_query($query);
		$rate = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$shipping["method"] = $rs[1] . " " . $rs[2];
			if ($rs[0] == "0" && $index > 0)
				$shipping["rate"] = $product_qty * $rs[4];
			else 
				$shipping["rate"] = $rs[3] + (($product_qty - 1) * $rs[4]);
			$rate[] = $shipping;
		}
		if (count($rate) < 1) {
			$shipping["method"] = "FREE SHIPPING";
			$shipping["rate"] = 0.00;
			$rate[] = $shipping;
		}
		
		return $rate;
	}
	
	function getRate2($total_purchase)
	{
		$zip_code = substr($this->shipping_zip,0,3);
		$shipping_destination = (strtolower($this->shipping_country) == "united states")?"domestic":"international";
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$groupShippingRate = new GroupShippingRate();
		$groupRate = $groupShippingRate->getRate($product_id);
				
		if ($shipping_destination == "domestic")
			$zip_code_condition = "AND zip_code_low <= '$zip_code' AND zip_code_high >= '$zip_code'";
		else
			$zip_code_condition = "";
			
		$query = "SELECT * FROM SHIPPING_RATE_2 WHERE total_purchase_low <= $total_purchase AND total_purchase_high >= $total_purchase $zip_code_condition AND (shipping_destination = '$shipping_destination' OR shipping_destination = 'domestic and international' OR shipping_destination IS NULL)";
		$query_result = mysql_query($query);
		while ($rs = mysql_fetch_array($query_result)) {
			$this->shipping_method [] = $rs["shipping_vendor"] . " " . $rs["shipping_method"];
			if ($rs["rate_type"] == "fixed value")
				$this->shipping_rate [] = $rs["shipping_rate"];
			else
				$this->shipping_rate [] = $rs["shipping_rate"] * $total_purchase;
		}
		if (count($this->shipping_rate) < 1) {
			$this->shipping_method [] = "FREE SHIPPING";
			$this->shipping_rate [] = 0.00;
		}
	}
	
	function getRate3($total_weight)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$where_clause = "";
		if ($this->shipping_state != "All States")
			$where_clause = $where_clause . " AND (STATE = '$this->shipping_state' OR STATE = 'All States')";
		if ($this->shipping_city != "All Cities")
			$where_clause = $where_clause . " AND (CITY = '$this->shipping_city' OR CITY = 'All Cities')";
		if ($this->shipping_zip != "All Zip")
			$where_clause = $where_clause . " AND (ZIP = '$this->shipping_zip' OR ZIP = 'All Zip')";
		if ($this->shipping_country != "United States")
			$where_clause = $where_clause . " AND (COUNTRY = '$this->shipping_country' OR COUNTRY = 'United States')";
				
		$query = "SELECT * FROM SHIPPING_RATE_3 WHERE rate_type = 'multiple' $where_clause";
		$query_result = mysql_query($query);
		
		if (mysql_num_rows($query_result) > 0) {
			while ($rs = mysql_fetch_array($query_result)) {
				$this->shipping_method [] = $rs["shipping_vendor"] . " " . $rs["shipping_method"];
				$this->shipping_rate [] = $rs["shipping_rate"] * $total_weight;
			}
			if (count($this->shipping_rate) < 1) {
				$this->shipping_method [] = "FREE SHIPPING";
				$this->shipping_rate [] = 0.00;
			}
		} else {
			$query = "SELECT * FROM SHIPPING_RATE_3 WHERE rate_type = 'fixed value' AND weight = $total_weight $where_clause";
			$query_result = mysql_query($query);
			while ($rs = mysql_fetch_array($query_result)) {
				$this->shipping_method [] = $rs["shipping_vendor"] . " " . $rs["shipping_method"];
				$this->shipping_rate [] = $rs["shipping_rate"];
			}
			if (count($this->shipping_rate) < 1) {
				$this->shipping_method [] = "FREE SHIPPING";
				$this->shipping_rate [] = 0.00;
			}
		}
	}
	
	function getPayPalShippingRate($product_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$where_clause = "";
		if ($this->shipping_state != "All States")
			$where_clause = $where_clause . " AND (STATE = '$this->shipping_state' OR STATE = 'All States')";
		if ($this->shipping_city != "All Cities")
			$where_clause = $where_clause . " AND (CITY = '$this->shipping_city' OR CITY = 'All Cities')";
		if ($this->shipping_zip != "All Zip")
			$where_clause = $where_clause . " AND (ZIP = '$this->shipping_zip' OR ZIP = 'All Zip')";
		if ($this->shipping_country != "United States")
			$where_clause = $where_clause . " AND (COUNTRY = '$this->shipping_country' OR COUNTRY = 'United States')";
		
		$query = "SELECT SHIPPING_VENDOR, SHIPPING_METHOD, ONE_ITEM_RATE, ADDITIONAL_ITEM_RATE FROM SHIPPING_RATE WHERE PRODUCT_ID = '$product_id'" . $where_clause;
		$query_result = mysql_query($query);
		$rate = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$shipping["method"] = $rs[0] . " " . $rs[1];
			$shipping["rate"] = $rs[2];
			$shipping["extra_rate"] = $rs[3];
			$rate[] = $shipping;
		}
		
		return $rate;
	}
	
	function setShippingState($shipping_state)
	{
		$this->shipping_state = $shipping_state;
	}
	
	function setShippingCity($shipping_city)
	{
		$this->shipping_city = $shipping_city;
	}
	
	function setShippingZip($shipping_zip)
	{
		$this->shipping_zip = $shipping_zip;
	}
	
	function setShippingCountry($shipping_country)
	{
		$this->shipping_country = $shipping_country;
	}
}
?>