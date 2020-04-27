<?php
class Pricing
{
	var $dbconnect;
	
	function Pricing() 
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}

	function getPrice($plan,$category)
	{
		$price = 0;
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT pricing_price FROM PRICING WHERE pricing_plan = '" . ucwords($plan) . "' AND pricing_category = '" . $category . "'";	
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$price = $rs[0];
		}
		$this->dbconnect->close();
		
		return $price;
	}
}	
?>