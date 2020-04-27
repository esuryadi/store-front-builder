<?php
class Clients
{
	var $dbconnect;
	var $options = Array();
	var $option_str = "";
	var $sales_id = "";
	var $referral_id = "";
	var $domain_name = "";
	var $domain_status = "";
	var $first_name = "";
	var $middle_initial = "";
	var $last_name = "";
	var $company_name = "";
	var $company_address_1 = "";
	var $company_address_2 = "";
	var $company_city = "";
	var $company_state = "";
	var $company_province = "";
	var $company_zip = "";
	var $company_country = "";
	var $company_phone = "";
	var $company_fax = "";
	var $company_email = "";
	var $billing_first_name = "";
	var $billing_middle_initial = "";
	var $billing_last_name = "";
	var $billing_address_1 = "";
	var $billing_address_2 = "";
	var $billing_city = "";
	var $billing_state = "";
	var $billing_province = "";
	var $billing_zip = "";
	var $billing_country = "";
	var $billing_phone = "";
	var $payment_type = "";
	var $cc_number = "";
	var $cc_exp_date = "";
	var $cc_ver_code = "";
	var $one_time_setup_fee = 0;
	var $recurring_monthly_fee = 0;
	var $invoice_number = 1000;
	var $date_time = "";
	var $subscription_package = "";
	var $service_type = "";
	var $basic_page_desc = "";
	var $additional_page = 0;
	var $additional_page_desc = "";
	var $form_page = 0;
	var $web_form_desc = "";
	var $dynamic_page = 0;
	var $dynamic_page_desc = "";
	var $special_instruction = "";
	var $payment_gateway = "";
	var $other_payment_gateway = "";
	var $database_added = false;
	var $order_type = "";
	var $support_level = "";
	var $trial_id = "";
	
	function Clients()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function addOption($item,$price)
	{
		$option["item"] = $item;
		$option["price"] = $price;
		$this->options[] = $option;
	}
	
	function setOptions($options)
	{
		$this->option_str = $options;
	}
	
	function getOptions()
	{
		return $this->options;
	}
	
	function setSalesID($sales_id)
	{
		$this->sales_id = $sales_id;
	}
	
	function getSalesID()
	{
		return $this->sales_id;
	}
	
	function setReferralID($referral_id)
	{
		$this->referral_id = $referral_id;
	}
	
	function getReferralID()
	{
		return $this->referral_id;
	}
	
	function setSubscriptionPackage($subscription_package)
	{
		$this->subscription_package = $subscription_package;
	}
	
	function getSubscriptionPackage()
	{
		return $this->subscription_package;
	}
	
	function setDomainName($domain_name)
	{
		$this->domain_name = $domain_name;
	}
	
	function getDomainName()
	{
		return $this->domain_name;
	}
	
	function setDomainStatus($domain_status)
	{
		$this->domain_status = $domain_status;
	}
	
	function getDomainStatus()
	{
		return $this->domain_status;
	}
	
	function setOneTimeSetupFee($one_time_setup_fee)
	{
		$this->one_time_setup_fee = $one_time_setup_fee;
	}
	
	function getOneTimeSetupFee()
	{
		return $this->one_time_setup_fee;
	}
	
	function setRecurringMonthlyFee($recurring_monthly_fee)
	{
		$this->recurring_monthly_fee = $recurring_monthly_fee;
	}
	
	function getRecurringMonthlyFee()
	{
		return $this->recurring_monthly_fee;
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
	
	function setCompanyName($company_name)
	{
		$this->company_name = $company_name;
	}
	
	function getCompanyName()
	{
		return $this->company_name;
	}
	
	function setCompanyAddress1($company_address_1)
	{
		$this->company_address_1 = $company_address_1;
	}
	
	function getCompanyAddress1()
	{
		return $this->company_address_1;
	}
	
	function setCompanyAddress2($company_address_2)
	{
		$this->company_address_2 = $company_address_2;
	}
	
	function getCompanyAddress2()
	{
		return $this->company_address_2;
	}
	
	function setCompanyCity($company_city)
	{
		$this->company_city = $company_city;
	}
	
	function getCompanyCity()
	{
		return $this->company_city;
	}
	
	function setCompanyState($company_state)
	{
		$this->company_state = $company_state;
	}
	
	function getCompanyState()
	{
		return $this->company_state;
	}
	
	function setCompanyProvince($company_province)
	{
		$this->company_province = $company_province;
	}
	
	function getCompanyProvince()
	{
		return $this->company_province;
	}
	
	function setCompanyZip($company_zip)
	{
		$this->company_zip = $company_zip;
	}
	
	function getCompanyZip()
	{
		return $this->company_zip;
	}
	
	function setCompanyCountry($company_country)
	{
		$this->company_country = $company_country;
	}
	
	function getCompanyCountry()
	{
		return $this->company_country;
	}
	
	function setCompanyPhone($company_phone)
	{
		$this->company_phone = $company_phone;
	}
	
	function getCompanyPhone()
	{
		return $this->company_phone;
	}
	
	function setCompanyFax($company_fax)
	{
		$this->company_fax = $company_fax;
	}
	
	function getCompanyFax()
	{
		return $this->company_fax;
	}
	
	function setCompanyEmail($company_email)
	{
		$this->company_email = $company_email;
	}
	
	function getCompanyEmail()
	{
		return $this->company_email;
	}
	
	function setBillingFirstName($billing_first_name)
	{
		$this->billing_first_name = $billing_first_name;
	}
	
	function getBillingFirstName()
	{
		return $this->billing_first_name;
	}
	
	function setBillingMiddleInitial($billing_middle_initial)
	{
		$this->billing_middle_initial = $billing_middle_initial;
	}
	
	function getBillingMiddleInitial()
	{
		return $this->billing_middle_initial;
	}
	
	function setBillingLastName($billing_last_name)
	{
		$this->billing_last_name = $billing_last_name;
	}
	
	function getBillingLastName()
	{
		return $this->billing_last_name;
	}
	
	function setBillingAddress1($billing_address_1)
	{
		$this->billing_address_1 = $billing_address_1;
	}
	
	function getBillingAddress1()
	{
		return $this->billing_address_1;
	}
	
	function setBillingAddress2($billing_address_2)
	{
		$this->billing_address_2 = $billing_address_2;
	}
	
	function getBillingAddress2()
	{
		return $this->billing_address_2;
	}
	
	function setBillingCity($billing_city)
	{
		$this->billing_city = $billing_city;
	}
	
	function getBillingCity()
	{
		return $this->billing_city;
	}
	
	function setBillingState($billing_state)
	{
		$this->billing_state = $billing_state;
	}
	
	function getBillingState()
	{
		return $this->billing_state;
	}
	
	function setBillingProvince($billing_province)
	{
		$this->billing_province = $billing_province;
	}
	
	function getBillingProvince()
	{
		return $this->billing_province;
	}
	
	function setBillingZip($billing_zip)
	{
		$this->billing_zip = $billing_zip;
	}
	
	function getBillingZip()
	{
		return $this->billing_zip;
	}
	
	function setBillingCountry($billing_country)
	{
		$this->billing_country = $billing_country;
	}
	
	function getBillingCountry()
	{
		return $this->billing_country;
	}
	
	function setBillingPhone($billing_phone)
	{
		$this->billing_phone = $billing_phone;
	}
	
	function getBillingPhone()
	{
		return $this->billing_phone;
	}
	
	function setBillingFax($billing_fax)
	{
		$this->billing_fax = $billing_fax;
	}
	
	function getBillingFax()
	{
		return $this->billing_fax;
	}
	
	function setBillingEmail($billing_email)
	{
		$this->billing_email = $billing_email;
	}
	
	function getBillingEmail()
	{
		return $this->billing_email;
	}
	
	function setPaymentType($payment_type)
	{
		$this->payment_type = $payment_type;
	}
	
	function getPaymentType()
	{
		return $this->payment_type;
	}
	
	function setCCNumber($cc_number)
	{
		$this->cc_number = $cc_number;
	}
	
	function getCCNumber()
	{
		return $this->cc_number;
	}
	
	function setCCExpDate($cc_exp_date)
	{
		$this->cc_exp_date = $cc_exp_date;
	}
	
	function getCCExpDate()
	{
		return $this->cc_exp_date;
	}
	
	function setCCVerCode($cc_ver_code)
	{
		$this->cc_ver_code = $cc_ver_code;
	}
	
	function getCCVerCode()
	{
		return $this->cc_ver_code;
	}
	
	function setDateTime($date_time)
	{
		$this->date_time = $date_time;
	}
	
	function getDateTime()
	{
		return $this->date_time;
	}
	
	function setTrialID($trial_id)
	{
		$this->trial_id = $trial_id;
	}
	
	function getTrialID()
	{
		return $this->trial_id;
	}
	
	function getOrderId()
	{
		$order_id = 1;
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT MAX(order_id) FROM PURCHASE_ORDER";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$order_id = $order_id + $rs[0];
		} 
		
		$this->dbconnect->close();
		
		return $order_id;
	}
	
	function getInvoiceNumber()
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT MAX(order_id) FROM PURCHASE_ORDER";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$this->invoice_number = $this->invoice_number + $rs[0] + 1;
		} else {
			$this->invoice_number = $this->invoice_number + 1;
		}
		
		$this->dbconnect->close();
		
		return $this->invoice_number;
	}
	
	function setServiceType($service_type)
	{
		$this->service_type = $service_type;
	}
	
	function getServiceType()
	{
		return $this->service_type;
	}
	
	function setBasicPageDescription($basic_page_desc) 
	{
		$this->basic_page_desc = $basic_page_desc;
	}
	
	function getBasicPageDescription()
	{
		return $this->basic_page_desc;
	}
	
	function setAdditionalPage($additional_page)
	{
		$this->additional_page = $additional_page;
	}
	
	function getAdditionalPage()
	{
		return $this->additional_page;
	}
	
	function setAdditionalPageDescription($additional_page_desc)
	{
		$this->additional_page_desc = $additional_page_desc;
	}
	
	function getAdditionalPageDescription()
	{
		return	$this->additional_page_desc;
	}
	
	function setFormPage($form_page)
	{
		$this->form_page = $form_page;
	}
	
	function getFormPage()
	{
		return $this->form_page;
	}
	
	function setWebFormDescription($web_form_desc)
	{
		$this->web_form_desc = $web_form_desc;
	}
	
	function getWebFormDescription()
	{
		return $this->web_form_desc;
	}
	
	function setDynamicPage($dynamic_page)
	{
		$this->dynamic_page = $dynamic_page;
	}
	
	function getDynamicPage()
	{
		return $this->dynamic_page;
	}
	
	function setDynamicPageDescription($dynamic_page)
	{
		$this->dynamic_page = $dynamic_page;
	}
	
	function getDynamicPageDescription()
	{
		return $this->dynamic_page_desc;
	}
	
	function setSpecialInstruction($special_instruction)
	{
		$this->special_instruction = $special_instruction;
	}
	
	function getSpecialInstruction()
	{
		return $this->special_instruction;
	}
	
	function setPaymentGateway($payment_gateway)
	{
		$this->payment_gateway = $payment_gateway;
	}
	
	function getPaymentGateway()
	{
		return $this->payment_gateway;
	}
	
	function setOtherPaymentGateway($other_payment_gateway)
	{
		$this->other_payment_gateway = $other_payment_gateway;
	}
	
	function getOtherPaymentGateway()
	{
		return $this->other_payment_gateway;
	}
	
	function setDatabase($database_added)
	{
		$this->database_added = $database_added;
	}
	
	function isDatabaseAdded()
	{
		return $this->database_added;
	}
	
	function setOrderType($order_type)
	{
		$this->order_type = $order_type;
	}
	
	function getOrderType()
	{
		return $this->order_type;
	}
	
	function setSupportLevel($support_level)
	{
		$this->support_level = $support_level;
	}
	
	function getSupportLevel()
	{
		return $this->support_level;
	}
	
	function record()
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		if ($this->order_type == "website builder") {
			$company_state = ($this->company_state != "")?$this->company_state:$this->company_province;
			$billing_state = ($this->billing_state != "")?$this->billing_state:$this->billing_province;
			$query = "INSERT INTO WEB_HOSTING_ORDER (order_date,sales_id,domain_name,domain_status,subscription_package,company_name,client_first_name,client_middle_initial,client_last_name,client_address_1,client_address_2,client_city,client_state,client_zip,client_country,client_phone,client_fax,client_email,billing_first_name,billing_middle_initial,billing_last_name,billing_address_1,billing_address_2,billing_city,billing_state,billing_zip,billing_country,billing_phone,payment_type,account_number,cc_exp_date,cc_ver_code,recurring_monthly_fee,order_status)
																		   VALUES ('$this->date_time','$this->sales_id','$this->domain_name','$this->domain_status','$this->subscription_package','$this->company_name','$this->first_name','$this->middle_initial','$this->last_name','$this->company_address_1','$this->company_address_2','$this->company_city','$company_state','$this->company_zip','$this->company_country','$this->company_phone','$this->company_fax','$this->company_email','$this->billing_first_name','$this->billing_middle_initial','$this->billing_last_name','$this->billing_address_1','$this->billing_address_2','$this->billing_city','$billing_state','$this->billing_zip','$this->billing_country','$this->billing_phone','$this->payment_type','$this->cc_number','$this->cc_exp_date','$this->cc_ver_code','$this->recurring_monthly_fee','pending')";
		} else {
			if ($this->option_str == "") {
				$option_str = "";
				for ($i=0;$i<count($this->options);$i++) {
					$opt = $this->options[$i];
					$option_str = $option_str . "<li>" . $opt["item"] . " - $ " . $opt["price"] . "</li>";
				}
			} else
				$option_str = $this->option_str;
				
			$company_state = ($this->company_state != "")?$this->company_state:$this->company_province;
			$billing_state = ($this->billing_state != "")?$this->billing_state:$this->billing_province;
			$query = "INSERT INTO PURCHASE_ORDER (order_date,invoice_number,sales_id,referral_id,trial_id,client_first_name,client_middle_initial,client_last_name,company_name,company_address_1,company_address_2,company_city,company_state,company_zip,company_country,company_phone,company_fax,company_email,billing_first_name,billing_middle_initial,billing_last_name,billing_address_1,billing_address_2,billing_city,billing_state,billing_zip,billing_country,billing_phone,payment_type,account_number,cc_exp_date,cc_ver_code,domain_name,domain_status,subscription_package,additional_options,one_time_setup_fee,recurring_monthly_fee,order_status,build_status)
																		VALUES ('$this->date_time','$this->invoice_number','$this->sales_id','$this->referral_id','$this->trial_id','$this->first_name','$this->middle_initial','$this->last_name','$this->company_name','$this->company_address_1','$this->company_address_2','$this->company_city','$company_state','$this->company_zip','$this->company_country','$this->company_phone','$this->company_fax','$this->company_email','$this->billing_first_name','$this->billing_middle_initial','$this->billing_last_name','$this->billing_address_1','$this->billing_address_2','$this->billing_city','$billing_state','$this->billing_zip','$this->billing_country','$this->billing_phone','$this->payment_type','$this->cc_number','$this->cc_exp_date','$this->cc_ver_code','$this->domain_name','$this->domain_status','$this->subscription_package','$option_str','$this->one_time_setup_fee','$this->recurring_monthly_fee','pending','in process')";
		}
		mysql_query($query);
		echo mysql_error();
		
		$this->dbconnect->close();
	}
	
	function addBilling()
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		if ($this->support_level == "light")
			$monthly_fee = 50;
		else if ($this->support_level == "medium")
			$monthly_fee = 100;
		else
			$monthly_fee = 200;
		$query2 = "INSERT INTO BILLING (user_id,billing_first_name,billing_last_name,billing_address_1,billing_address_2,billing_city,billing_state,billing_zip,billing_country,billing_phone,payment_type,account_number,cc_exp_date,monthly_fee,order_date,sales_id) VALUES ('" . $this->billing_first_name . "_" . $this->billing_last_name . "','$this->billing_first_name','$this->billing_last_name','$this->billing_address_1','$this->billing_address_2','$this->billing_city','$this->billing_state','$this->billing_zip','$this->billing_country','$this->billing_phone','$this->payment_type','$this->cc_number','$this->cc_exp_date','$monthly_fee','" . date("Y-m-d H:i:s") . "','')";
		mysql_query($query2);
		
		$this->dbconnect->close();
	}
	
	function mailReceipt()
	{
		if ($this->service_type == "web_design") {
			$filename = _ROOTPATH . "mail/web_design_receipt.htm";
			$additional_page_cost = sprintf("%01.2f",$this->additional_page * 30);
			$form_page_cost = sprintf("%01.2f",$this->form_page * 50);
			$dynamic_page_cost = sprintf("%01.2f",$this->dynamic_page * 50);
			$total = sprintf("%01.2f",200 + ($this->additional_page * 30) + ($this->form_page * 50) + ($this->dynamic_page * 50));
		} else if ($this->service_type == "shopping_cart") {
			$filename = _ROOTPATH . "mail/shopping_cart_receipt.htm";
			$payment_gateway_cost = sprintf("%01.2f",($this->payment_gateway == "Other")?75.00:0.00);
			$additional_page_cost = sprintf("%01.2f",$this->additional_page * 50);
			$database_cost = sprintf("%01.2f",($database_added)?100.00:0.00);
			$total = sprintf("%01.2f",200 + $payment_gateway_cost + ($this->additional_page * 50) + $database_cost); 
		} else if ($this->service_type == "payment_page") {
			$filename = _ROOTPATH . "mail/payment_page_receipt.htm";
			$payment_gateway_cost = sprintf("%01.2f",($this->payment_gateway == "Other")?75.00:0.00);
			$additional_page_cost = sprintf("%01.2f",$this->additional_page * 50);
			$database_cost = sprintf("%01.2f",($database_added)?100.00:0.00);
			$total = sprintf("%01.2f",100 + $payment_gateway_cost + ($this->additional_page * 50) + $database_cost); 
		} else {
			$filename = _ROOTPATH . "mail/web_maintenance_receipt.htm";
			if ($this->support_level == "light")
				$total = sprintf("%01.2f",50); 
			if ($this->support_level == "medium")
				$total = sprintf("%01.2f",100);
			else
				$total = sprintf("%01.2f",200);
		}
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		$str = htmlspecialchars($str);
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $str);
		
		$mail_to = $this->company_email . ",sales@suryadisoft.net";
		$mail_headers = "Content-type: text/html\n";
		$mail_headers = $mail_headers . "From: Sales at SURYADISOFT <sales@suryadisoft.net>";
		$mail_subject = "Service Order";
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function mailInvoice()
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT sales_email FROM SALES_ASSOCIATE WHERE sales_id = '" . $this->sales_id . "'";
		$query_result = mysql_query($query);
		if (mysql_num_rows($query_result) > 0) {
			$rs = mysql_fetch_row($query_result);
			$sales_id = $rs[0];
		}
		$this->dbconnect->close();
		
		$option_str = "";
		for ($i=0;$i<count($this->options);$i++) {
			$opt = $this->options[$i];
			$option_str = $option_str . "\t- " . $opt["item"] . " - $ " . $opt["price"] . "\n";
		}
		if ($this->order_type == "website builder")
			$filename = _ROOTPATH . "mail/web_hosting_invoice.txt";
		else
			$filename = _ROOTPATH . "mail/invoice.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		$str = str_replace("<li>","-",$str);
		$str = str_replace("</li>","\n",$str);
		
		if (isset($sales_id) && $sales_id != "") 
			$mail_to = $this->company_email . ",sales@suryadisoft.net,$sales_email";
		else
			$mail_to = $this->company_email . ",sales@suryadisoft.net";
		$mail_from = "From: Sales at SURYADISOFT <sales@suryadisoft.net>";
		$mail_subject = "Invoice number: " . $this->invoice_number;
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function mailNotification($order_id)
	{
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT * FROM PURCHASE_ORDER WHERE order_id = '$order_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$client_first_name = $rs["client_first_name"];
		$client_last_name = $rs["client_last_name"];
		$domain_name = $rs["domain_name"];
		$company_email = $rs["company_email"];
		$invoice_number = $rs["invoice_number"];
		
		$query = "SELECT * FROM USER WHERE first_name = '$client_first_name' AND last_name = '$client_last_name' AND user_id NOT REGEXP '^trial'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$username = $rs["user_id"];
		$password = $rs["user_id"] . "123";
		
		$this->dbconnect->close();
		
		$filename = _ROOTPATH . "mail/notification.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $company_email . ",webmaster@suryadisoft.net";
		$mail_from = "From: Webmaster at SURYADISOFT <webmaster@suryadisoft.net>";
		$mail_subject = "Your eCommerce site has been built";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function getLicenseAgreement()
	{
		$filename = _ROOTPATH . "mail/contract_agreement.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		
		return $str;
	}
}
?>
