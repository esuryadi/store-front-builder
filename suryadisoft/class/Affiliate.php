<?php

class Affiliate {
	var $dbconnect;
	var $id = "";
	var $name = "";
	var $address = "";
	var $city = "";
	var $state = "";
	var $zip = "";
	var $country = "";
	var $phone = "";
	var $email = "";
	var $url = "";
	var $hits = 0;
	var $purchase = 0;
	var $commission = 0;
	var $total_commission = 0;
	var $paid_commission = 0;
	var $total_sales = 0;
	
	function Affiliate() {
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function setId($id) {
		$this->id = $id;
	}
	
	function getId() {
		return $this->id;
	}
	
	function setName($name) {
		$this->name = $name;
	}
	
	function getName() {
		return $this->name;
	}
	
	function setAddress($address) {
		$this->address = $address;
	}
	
	function getAddress() {
		return $this->address;
	}
	
	function setCity($city) {
		$this->city = $city;
	}
	
	function getCity() {
		return $this->city;
	}
	
	function setState($state) {
		$this->state = $state;
	}
	
	function getState() {
		return $this->state;
	}
	
	function setZip($zip) {
		$this->zip = $zip;
	}
	
	function getZip() {
		return $this->zip;
	}
	
	function setCountry($country) {
		$this->country = $country;
	}
	
	function getCountry() {
		return $this->country;
	}
	
	function setPhone($phone) {
		$this->phone = $phone;
	}
	
	function getPhone() {
		return $this->phone;
	}
	
	function setEmail($email) {
		$this->email = $email;
	}
	
	function getEmail() {
		return $this->email;
	}
	
	function setURL($url) {
		$this->url = $url;
	}
	
	function getURL() {
		return $this->url;
	}
	
	function getHits() {
		return $this->hits;
	}
	
	function getPurchase() {
		return $this->purchase;
	}
	
	function getCommission() {
		return $this->commission;
	}
	
	function getTotalCommission() {
		return $this->total_commission;
	}
	
	function getPaidCommission() {
		return $this->paid_commission;
	}
	
	function setTotalSales($total_sales) {
		$this->total_sales = $total_sales;
	}
	
	function getAffiliateEmailFrom()
	{
		return "\$company_name <\$company_email>";
	}
	
	function getAffiliateEmailSubject()
	{
		return "Affiliate Program";
	}
	
	function getAffiliateEmailBody()
	{		
		$filename = _COMPONENTPATH . "mail/affiliate.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));		
		
		return $str;
	}
	
	function getAffiliateInfo($affiliate_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT * FROM AFFILIATE WHERE affiliate_id = '$affiliate_id'";
		$query_result = mysql_query($query);
		while ($rs = mysql_fetch_array($query_result)) {
			$this->id = $rs["affiliate_id"];
			$this->name = $rs["affiliate_name"];
			$this->address = $rs["affiliate_address"];
			$this->city = $rs["affiliate_city"];
			$this->state = $rs["affiliate_state"];
			$this->zip = $rs["affiliate_zip"];
			$this->country = $rs["affiliate_country"];
			$this->email = $rs["affiliate_email"];
			$this->url = $rs["affiliate_url"];
			$this->hits = $rs["affiliate_referral_hits"];
			$this->purchase = $rs["affiliate_referral_purchase"];
			$this->commission = $rs["affiliate_commission"];
			$this->total_commission = $rs["affiliate_total_commission"];
			$this->paid_commission = $rs["affiliate_paid_commission"];
		}
		
		$this->dbconnect->close();
	}

	function isAffiliateExists($id) {
		$num_rows = 0;

		if ($id != "") {
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT * FROM AFFILIATE WHERE affiliate_id = '$id'";
			$query_result = mysql_query($query);
			$num_rows = mysql_num_rows($query_result);
			
			$this->dbconnect->close();
		}
		
		return ($num_rows > 0);
	}
	
	function addNewAffiliate() {
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "INSERT INTO AFFILIATE (affiliate_id,affiliate_name,affiliate_address,affiliate_city,affiliate_state,affiliate_zip,affiliate_country,affiliate_phone,affiliate_email,affiliate_url,affiliate_referral_hits,affiliate_referral_purchase,affiliate_paid_commission) VALUES ('$this->id','$this->name','$this->address','$this->city','$this->state','$this->zip','$this->country','$this->phone','$this->email','$this->url','','','')";
		$success = mysql_query($query);
		
		$this->dbconnect->close();
	}
	
	function mailAffiliate() {
		$adm = new Admin();
		$adm->retrieveAdminInfo(_USER);
		$id = $this->id;
		$name = $this->name;
		$admin_first_name = $adm->getFirstName();
		$admin_last_name = $adm->getLastName();
		$admin_email = $adm->getEmail();
		$company_name = $adm->getCompanyName();
		$company_url = $adm->getCompanyURL();
		$company_address_1 = $adm->getCompanyAddress1();
		$company_address_2 = $adm->getCompanyAddress2();
		$company_city = $adm->getCompanyCity();
		$company_state = $adm->getCompanyState();
		$company_zip = $adm->getCompanyZip();
		$company_country = $adm->getCompanyCountry();
		$company_phone = $adm->getCompanyPhone();
		$company_fax = $adm->getCompanyFax();
		$company_email = $adm->getCompanyEmail();
		$logo_img_src = str_replace(" ","%20",WebContent::getPropertyValue("logo_img_src"));
		
		$mail_to = $this->email;
		$mail_from = (WebContent::getPropertyValue("affiliate_email_from") != "")?WebContent::getPropertyValue("affiliate_email_from"):$this->getAffiliateEmailFrom();
		eval ("\$mail_headers = \"From: $mail_from\n\";");
		$mail_cc = (WebContent::getPropertyValue("affiliate_email_cc") != "")?WebContent::getPropertyValue("affiliate_email_cc"):"";
		if ($mail_cc != "")
			$mail_headers = $mail_headers . "Cc: $mail_cc";
		$mail_bcc = (WebContent::getPropertyValue("affiliate_email_bcc") != "")?WebContent::getPropertyValue("affiliate_email_bcc"):"";
		if ($mail_bcc != "")
			$mail_headers = $mail_headers . "\nBcc: $mail_bcc";
		$mail_headers = "Content-type: text/html\n" . $mail_headers;
		$mail_subject = (WebContent::getPropertyValue("affiliate_email_subject") != "")?WebContent::getPropertyValue("affiliate_email_subject"):$this->getAffiliateEmailSubject();
		eval ("\$mail_subject = \"$mail_subject\";");
		$mail_body = (WebContent::getPropertyValue("affiliate_email_body") != "")?WebContent::getPropertyValue("affiliate_email_body"):$this->getAffiliateEmailBody();
		$mail_body = htmlspecialchars($mail_body);
		eval ("\$mail_body = \"$mail_body\";");
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function increaseTotalHit() {
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT affiliate_referral_hits FROM AFFILIATE WHERE affiliate_id = '" . $this->id . "'";
		$rs = mysql_fetch_row(mysql_query($query));
		$hits = $rs[0] + 1;
		$query = "UPDATE AFFILIATE SET affiliate_referral_hits = $hits";
		mysql_query($query);
		
		$this->dbconnect->close();
	}
	
	function increaseTotalPurchase() {
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT affiliate_referral_purchase FROM AFFILIATE WHERE affiliate_id = '" . $this->id . "'";
		$rs = mysql_fetch_row(mysql_query($query));
		$purchase = $rs[0] + 1;
		$query = "UPDATE AFFILIATE SET affiliate_referral_purchase = $purchase";
		mysql_query($query);
		
		$query = "SELECT affiliate_commission_type, affiliate_commission, affiliate_total_commission FROM AFFILIATE WHERE affiliate_id = '" . $this->id . "'";
		$rs = mysql_fetch_array(mysql_query($query));
		if ($rs["affiliate_commission_type"] == "fixed")
			$commission = $rs["affiliate_commission"];
		else
			$commission = $rs["affiliate_commission"] * $this->total_sales;
		$total_commission = $rs["affiliate_total_commission"] + $commission;
		
		$query = "UPDATE AFFILIATE SET affiliate_total_commission = '$total_commission'";
		mysql_query($query);			
		
		$this->dbconnect->close();
	}
}
?>