<?php
class Payment
{
	var $dbconnect;
	
	function Payment() 
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}

	function getPaymentService($user_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT PAYMENT_SERVICE FROM CLIENT_PAYMENT_SERVICE WHERE USER_ID = '" . $user_id . "'";	
		$rs = mysql_fetch_row(mysql_query($query));
		$this->dbconnect->close();
		
		return $rs[0];
	}
}	
?>