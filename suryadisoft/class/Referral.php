<?php
class Referral
{
	var $dbconnect;
	var $first_name = "";
	var $middle_initial = "";
	var $last_name = "";
	var $address_1 = "";
	var $address_2 = "";
	var $city = "";
	var $state = "";
	var $zip = "";
	var $country = "";
	var $phone = "";
	var $email = "";
	
	function Referral()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function setFirstName($first_name)
	{
		$this->first_name = $first_name;
	}
	
	function getFirstName()
	{
		return $this->first_name;
	}
	
	function setMiddleInitial($middle_initial)
	{
		$this->middle_initial = $middle_initial;
	}
	
	function getMiddleInitial()
	{
		return $this->middle_initial;
	}
	
	function setLastName($last_name)
	{
		$this->last_name = $last_name;
	}
	
	function getLastName()
	{
		return $this->last_name;
	}
	
	function setAddress1($address_1)
	{
		$this->address_1 = $address_1;
	}
	
	function getAddress1()
	{
		return $this->address_1;
	}
	
	function setAddress2($address_2)
	{
		$this->address_2 = $address_2;
	}
	
	function getAddress2()
	{
		return $this->address_2;
	}
	
	function setCity($city)
	{
		$this->city = $city;
	}
	
	function getCity()
	{
		return $this->city;
	}
	
	function setState($state)
	{
		$this->state = $state;
	}
	
	function getState()
	{
		return $this->state;
	}
	
	function setZip()
	{
		$this->zip = $zip;
	}
	
	function getZip()
	{
		return $this->zip;
	}
	
	function setCountry($country)
	{
		$this->country = $country;
	}
	
	function getCountry()
	{
		return $this->country;
	}
	
	function setPhone($phone)
	{
		$this->phone = $phone;
	}
	
	function getPhone()
	{
		return $this->phone;
	}
	
	function setEmail($email)
	{
		$this->email = $email;
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function isReferralExists($referral_id)
	{
		$num_rows = 0;

		if ($referral_id != "") {
			$this->dbconnect->open();
			mysql_select_db(_ADMIN_DATABASE);
			
			$query = "SELECT * FROM REFERRAL WHERE referral_id = '$referral_id'";
			$query_result = mysql_query($query);
			$num_rows = mysql_num_rows($query_result);
			
			$this->dbconnect->close();
		}
		
		return ($num_rows > 0);
	}
	
	function record()
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "INSERT INTO REFERRAL (referral_id,first_name,middle_initial,last_name,address_1,address_2,city,state,zip,country,phone) VALUES ('$this->email','$this->first_name','$this->middle_initial','$this->last_name','$this->address_1','$this->address_2','$this->city','$this->state','$this->zip','$this->country','$this->phone')";
		$success = mysql_query($query);
		
		$this->dbconnect->close();
		
		return $success;
	}	
	
	function mailReferral()
	{
		$first_name = $this->first_name;
		$last_name = $this->last_name;
		$email = $this->email;
		
		$filename = "/www/wwwuser/suryadisoft.net/mail/referral.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $this->email . ",webmaster@suryadisoft.net";
		$mail_from = "From: Webmaster at SURYADISOFT <webmaster@suryadisoft.net>";
		$mail_subject = "SURYADISOFT Referral Program";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
}
?>
