<?php
class GroupShippingRate {
	var $groups = Array();
	var $groupPrice = Array();
	
	function GroupShippingRate() {
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT * FROM GROUP_SHIPPING_RATE";
		$query_result = mysql_query($query);
		while ($rs = mysql_fetch_row($query_result)) {
			$group ["name"] = $rs[0];
			$this->groupPrice[$rs[0]] = 0;
			$group ["products"] = $rs[1];
			$group ["rate"] = $rs[2];
			$group ["minorder"] = $rs[3];
			$this->groups[] = $group;
		} 
		$dbconnect->close();
	}
	
	function getMinimumOrder($productId) {
		for ($i=0;$i<count($this->groups);$i++) {
		  $group = $this->groups[$i];
		  $products = split(",", $group["products"]);
		  if (in_array($productId, $products))
		  	return $group["minorder"];
		}
		
		return null;
	}
	
	function getRate($productId) {
		for ($i=0;$i<count($this->groups);$i++) {
		  $group = $this->groups[$i];
		  $products = split(",", $group["products"]);
		  if (in_array($productId, $products))
		  	return $group["rate"];
		}
		
		return null;
	}
	
	function createGroupPrice($productId, $price) {
		if ($this->getGroupName($productId) != null) {
			$this->groupPrice[$this->getGroupName($productId)] = $this->groupPrice[$this->getGroupName($productId)] + $price;
		}
	}
	
	function getGroupPrice($productId) {
		for ($i=0;$i<count($this->groups);$i++) {
		  $group = $this->groups[$i];
		  $products = split(",", $group["products"]);
		  if (in_array($productId, $products)) {
		  	return $this->groupPrice[$group["name"]];
		  }
		}
		
		return 0;
	}
	
	function isInGroup($productId) {
		for ($i=0;$i<count($this->groups);$i++) {
		  $group = $this->groups[$i];
		  $products = split(",", $group["products"]);
		  if (in_array($productId, $products))
		  	return true;
		}
		
		return false;
	}
	
	function getGroupName($productId) {
		for ($i=0;$i<count($this->groups);$i++) {
		  $group = $this->groups[$i];
		  $products = split(",", $group["products"]);
		  if (in_array($productId, $products))
		  	return $group["name"];
		}
		
		return null;
	}
}