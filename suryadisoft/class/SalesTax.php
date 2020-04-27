<?php
class SalesTax
{
	function getSalesTaxRate($state) 
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT SALES_TAX_RATE FROM SALES_TAX WHERE SALES_TAX_STATE = '$state'";
		$rs = mysql_fetch_row(mysql_query($query));
		if ($rs[0] != "")
			$tax_rate = $rs[0];
		else
			$tax_rate = 0;

		$dbconnect->close();
		
		return $tax_rate;
	}
}
?>
