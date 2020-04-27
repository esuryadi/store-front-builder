<?php
class WebUser 
	extends User
{
	var $first_name;
	var $last_name;
	var $email;
	
	function WebUser($user_id, $password) 
	{
		$this->user_id = $user_id;
		$this->password = $password;
	}
	
	function setFirstName($first_name) 
	{
		$this->first_name = $first_name;
	}
	
	function setLastName($last_name) 
	{
		$this->last_name = $last_name;
	}
	
	function setEmail($email) 
	{
		$this->email = $email;
	}
	
	function getFirstName() 
	{
		return $this->first_name;
	}
	
	function getLastName() 
	{
		return $this->last_name;
	}
	
	function getEmail() 
	{
		return $this->email;
	}
	
	function verify() 
	{
		$pwd = $this->password; //crypt($this->password,'$1$sweetchi$');
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT USER_FIRST_NAME, USER_LAST_NAME, USER_EMAIL FROM USER WHERE USER_ID = '$this->user_id' AND USER_PASSWORD = '$pwd'";
		$query_result = mysql_query($query);
		$i = 0;
		while ($rs = mysql_fetch_row($query_result)) {
			$this->first_name = $rs[0];
			$this->last_name = $rs[1];
			$this->email = $rs[2];
			$i++;
		}		
		$dbconnect->close();
		
		return (($i > 0)?true:false);
	}
	
	function record() 
	{
		$pwd = $this->password; //crypt($this->password,'$1$sweetchi$');
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT USER_ID FROM USER WHERE USER_ID = '$this->user_id'";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows == 0) {
			$query = "INSERT INTO USER (user_id,user_password,user_email,user_first_name,user_last_name) VALUES ('$this->user_id','$pwd','$this->email','$this->first_name','$this->last_name')";
			mysql_query($query);
		}
		$dbconnect->close();
		
		return (($num_rows > 0)?false:true);
	}
	
	function getPasswordEmailFrom()
	{
		return "\$company_name <\$company_email>";
	}
	
	function getPasswordEmailSubject()
	{
		return "Password";
	}
	
	function getPasswordEmailBody()
	{		
		$filename = _COMPONENTPATH . "mail/password.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));		
		
		return $str;
	}
	
	function mailPassword()
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT * FROM USER WHERE USER_ID = '$this->user_id'";
		$query_result = mysql_query($query);
		$i = 0;
		while ($rs = mysql_fetch_row($query_result)) {
			$user_id = $this->user_id;
			$user_password = $rs[1];
			$user_first_name = $rs[3];
			$user_last_name = $rs[4];
			$user_email = $rs[2];
			$i++;
		}		
		$dbconnect->close();
		
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
		
		if ($i > 0) {
			$mail_from = (WebContent::getPropertyValue("password_email_from") != "")?WebContent::getPropertyValue("password_email_from"):$this->getPasswordEmailFrom();
			eval ("\$mail_headers = \"From: $mail_from\n\";");
			$mail_cc = (WebContent::getPropertyValue("password_email_cc") != "")?WebContent::getPropertyValue("password_email_cc"):"";
			if ($mail_cc != "")
				$mail_headers = $mail_headers . "Cc: $mail_cc";
			$mail_bcc = (WebContent::getPropertyValue("password_email_bcc") != "")?WebContent::getPropertyValue("password_email_bcc"):"";
			if ($mail_bcc != "")
				$mail_headers = $mail_headers . "\nBcc: $mail_bcc";
			$mail_headers = "Content-type: text/html\n" . $mail_headers;
			$mail_subject = (WebContent::getPropertyValue("password_email_subject") != "")?WebContent::getPropertyValue("password_email_subject"):$this->getPasswordEmailSubject();
			eval ("\$mail_subject = \"$mail_subject\";");
			$mail_body = (WebContent::getPropertyValue("password_email_body") != "")?WebContent::getPropertyValue("password_email_body"):$this->getPasswordEmailBody();
			$mail_body = htmlspecialchars($mail_body);
			eval ("\$mail_body = \"$mail_body\";");
			$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
			mail($user_email , $mail_subject , $mail_body, $mail_headers);
		}
		
		return (($i > 0)?true:false);
	}
	
	function getUserAccountEmailFrom()
	{
		return "\$company_name <\$company_email>";
	}
	
	function getUserAccountEmailSubject()
	{
		return "New User Account";
	}
	
	function getUserAccountEmailBody()
	{		
		$filename = _COMPONENTPATH . "mail/user_account.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));		
		
		return $str;
	}
	
	function mailNewUserInfo()
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
		$user_email = $this->email;
		$user_first_name = $this->first_name;
		$user_last_name = $this->last_name;
		$user_id = $this->user_id;
		$user_password = $this->password;
		
		$mail_to = $this->email;
		if (WebContent::getPropertyValue("cc_user_reg_email") == "yes")
			$mail_to = $mail_to . "," . $company_email;
		$mail_from = (WebContent::getPropertyValue("user_account_email_from") != "")?WebContent::getPropertyValue("user_account_email_from"):$this->getUserAccountEmailFrom();
		eval ("\$mail_headers = \"From: $mail_from\n\";");
		$mail_cc = (WebContent::getPropertyValue("user_account_email_cc") != "")?WebContent::getPropertyValue("user_account_email_cc"):"";
		if ($mail_cc != "")
			$mail_headers = $mail_headers . "Cc: $mail_cc";
		$mail_bcc = (WebContent::getPropertyValue("user_account_email_bcc") != "")?WebContent::getPropertyValue("user_account_email_bcc"):"";
		if ($mail_bcc != "")
			$mail_headers = $mail_headers . "\nBcc: $mail_bcc";
		$mail_headers = "Content-type: text/html\n" . $mail_headers;
		$mail_subject = (WebContent::getPropertyValue("user_account_email_subject") != "")?WebContent::getPropertyValue("user_account_email_subject"):$this->getUserAccountEmailSubject();
		eval ("\$mail_subject = \"$mail_subject\";");
		$mail_body = (WebContent::getPropertyValue("user_account_email_body") != "")?WebContent::getPropertyValue("user_account_email_body"):$this->getUserAccountEmailBody();
		$mail_body = htmlspecialchars($mail_body);
		eval ("\$mail_body = \"$mail_body\";");
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		mail($this->email , $mail_subject , $mail_body, $mail_headers);
	}
	
	function retrieveUserId($first_name, $last_name)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT USER_ID FROM USER WHERE USER_FIRST_NAME = '$first_name' AND USER_LAST_NAME = '$last_name'";
		$rs = mysql_fetch_row(mysql_query($query));
		$user_id = $rs[0];
		
		$dbconnect->close();
		
		return $user_id;
	}
}
?>
