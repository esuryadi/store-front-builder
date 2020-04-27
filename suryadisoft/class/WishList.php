<?php
class WishList
{
	var $dbconnect;
	
	function WishList()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function addItem($user_id, $product_id, $color, $size, $choice)
	{	
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		//Check if item is already exist. If exist just update the quantity.
		$query = "SELECT WISH_LIST_QUANTITY FROM WISH_LIST WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
		$query_result = mysql_query($query);
		$rs = mysql_fetch_row($query_result);
		if (mysql_num_rows($query_result) > 0)
			$query = "UPDATE WISH_LIST SET WISH_LIST_QUANTITY = " . ($rs[0] + 1) . " WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
		else
			$query = "INSERT INTO WISH_LIST (USER_ID,PRODUCT_ID,PRODUCT_COLOR,PRODUCT_SIZE,PRODUCT_CHOICE,WISH_LIST_QUANTITY) VALUES ('$user_id',$product_id,'$color','$size','$choice',1)";
		mysql_query($query);
		
		$this->dbconnect->close();
	}
	
	function getItems($user_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT * FROM WISH_LIST WHERE USER_ID = '$user_id'";
		$query_result = mysql_query($query);

		$list = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$item["product_id"] = $rs[2];
			$item["product_color"] = $rs[3];
			$item["product_size"] = $rs[4];
			$item["product_choices"] = $rs[5];
			$item["quantity"] = $rs[6];
			$list[] = $item;
		}
		
		$this->dbconnect->close();
		
		return $list;
	}
	
	function getItemCount($user_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT * FROM WISH_LIST WHERE USER_ID = '$user_id'";
		$query_result = mysql_query($query);
		$count = mysql_num_rows($query_result);
			
		$this->dbconnect->close();
	
		return $count;
	}
	
	function updateItem($user_id, $product_id, $quantity, $color, $size, $choice)
	{
		if ($quantity == 0) {
			$this->deleteItem($user_id,$product_id,$quantity);
		} else {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT WISH_LIST_QUANTITY FROM WISH_LIST WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
			$rs = mysql_fetch_row(mysql_query($query));
			$qty = $quantity - $rs[0];
			$query = "UPDATE WISH_LIST SET WISH_LIST_QUANTITY = $quantity, PRODUCT_COLOR = '$color', PRODUCT_SIZE = '$size', PRODUCT_CHOICE = '$choice' WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
			mysql_query($query);
			echo mysql_error();
			
			$this->dbconnect->close();
		}
	}
	
	function deleteItem($user_id, $product_id, $quantity)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT WISH_LIST_QUANTITY FROM WISH_LIST WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
		$rs = mysql_fetch_row(mysql_query($query));
		if ($rs[0] <= $quantity)
			$query = "DELETE FROM WISH_LIST WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
		else
			$query = "UPDATE WISH_LIST SET WISH_LIST_QUANTITY = " . ($rs[0] - $quantity) . " WHERE USER_ID = '$user_id' AND PRODUCT_ID = $product_id";
		mysql_query($query);
		
		$this->dbconnect->close();
	}	
	
	function isFound($user_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT * FROM WISH_LIST WHERE USER_ID = '$user_id'";
		$num_row = mysql_num_rows(mysql_query($query));
		
		$this->dbconnect->close();
		
		if ($num_row > 0)
			return true;
		else
			return false;
	}
	
	function getWishListEmailFrom()
	{
		return "\$user_first_name \$user_last_name <\$user_email>";
	}
	
	function getWishListEmailSubject()
	{
		return "A Message from \$company_name About My New Wish List";
	}
	
	function getWishListEmailBody()
	{		
		$filename = _COMPONENTPATH . "mail/wish_list.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));		
		
		return $str;
	}
	
	function getDefaultMailSubject()
	{
		$admin = new Admin();
		$admin->retrieveAdminInfo(_USER);
		$admin_first_name = $admin->getFirstName();
		$admin_last_name = $admin->getLastName();
		$admin_email = $admin->getEmail();
		$company_name = $admin->getCompanyName();
		$company_url = $admin->getCompanyURL();
		$company_address1 = $admin->getCompanyAddress1();
		$company_address2 = $admin->getCompanyAddress2();
		$company_city = $admin->getCompanyCity();
		$company_state = $admin->getCompanyState();
		$company_zip = $admin->getCompanyZip();
		$company_country = $admin->getCompanyCountry();
		$company_phone = $admin->getCompanyPhone();
		$company_fax = $admin->getCompanyFax();
		$company_email = $admin->getCompanyEmail();

		$str = (WebContent::getPropertyValue("wish_list_email_subject") != "")?WebContent::getPropertyValue("wish_list_email_subject"):$this->getWishListEmailSubject();
		eval ("\$str = \"$str\";");
		
		return $str;
	}
	
	function getDefaultMailBody($user_first_name,$user_last_name)
	{
		$admin = new Admin();
		$admin->retrieveAdminInfo(_USER);
		$admin_first_name = $admin->getFirstName();
		$admin_last_name = $admin->getLastName();
		$admin_email = $admin->getEmail();
		$company_name = $admin->getCompanyName();
		$company_url = $admin->getCompanyURL();
		$company_address_1 = $admin->getCompanyAddress1();
		$company_address_2 = $admin->getCompanyAddress2();
		$company_city = $admin->getCompanyCity();
		$company_state = $admin->getCompanyState();
		$company_zip = $admin->getCompanyZip();
		$company_country = $admin->getCompanyCountry();
		$company_phone = $admin->getCompanyPhone();
		$company_fax = $admin->getCompanyFax();
		$company_email = $admin->getCompanyEmail();

		$str = (WebContent::getPropertyValue("wish_list_email_body") != "")?WebContent::getPropertyValue("wish_list_email_body"):$this->getWishListEmailBody();
		$str = htmlspecialchars($str);
		eval ("\$str = \"$str\";");
		$str = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $str);
		
		return $str;
	}
	
	function mailWishList($user,$mail_to,$mail_subject,$mail_body)
	{	
		$user_first_name = $user->getFirstName();
		$user_last_name = $user->getLastName();
		$user_email = $user->getEmail();
		$user_id = $user->getUserId();
		$user_password = $user->getPassword();
		$mail_from = (WebContent::getPropertyValue("wish_list_email_from") != "")?WebContent::getPropertyValue("wish_list_email_from"):$this->getWishListEmailFrom();
		eval ("\$mail_headers = \"From: $mail_from\n\";");
		$mail_cc = (WebContent::getPropertyValue("wish_list_email_cc") != "")?WebContent::getPropertyValue("wish_list_email_cc"):"";
		if ($mail_cc != "")
			$mail_headers = $mail_headers . "Cc: $mail_cc";
		$mail_bcc = (WebContent::getPropertyValue("wish_list_email_bcc") != "")?WebContent::getPropertyValue("wish_list_email_bcc"):"";
		if ($mail_bcc != "")
			$mail_headers = $mail_headers . "\nBcc: $mail_bcc";
		$mail_headers = "Content-type: text/html\n" . $mail_headers;
		$mail_body = str_replace("\\","",$mail_body);
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
}
