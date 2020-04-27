<?php
class Admin 
	extends User
{
	var $user_id = "";
	var $trial_user_id = "";
	var $first_name = "";
	var $last_name = "";
	var $email = "";
	var $role = "";
	var $status = "";
	var $company_name = "";
	var $company_url = "";
	var $company_address1 = "";
	var $company_address2 = "";
	var $company_city = "";
	var $company_state = "";
	var $company_zip = "";
	var $company_country = "";
	var $company_phone = "";
	var $company_fax = "";
	var $company_email = "";
	var $client_db = "";
	
	function Admin() 
	{
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
	
	function setRole($role)
	{
		$this->role = $role;
	}
	
	function getRole()
	{
		return $this->role;
	}
	
	function setStatus($status)
	{
		$this->status = $status;
	}
	
	function getStatus()
	{
		return $this->status;
	}
	
	function setCompanyName($company_name)
	{
		$this->company_name = $company_name;
	}
	
	function getCompanyName()
	{
		return $this->company_name;
	}
	
	function setCompanyURL($company_url)
	{
		$this->company_url = $company_url;
	}
	
	function getCompanyURL()
	{
		return $this->company_url;
	}
	
	function setCompanyAddress1($company_address1)
	{
		$this->company_address1 = $company_address1;
	}
	
	function getCompanyAddress1()
	{
		return $this->company_address1;
	}
	
	function setCompanyAddress2($company_address2)
	{
		$this->company_address2 = $company_address2;
	}
	
	function getCompanyAddress2()
	{
		return $this->company_address2;
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
	
	function setClientDB($client_db)
	{
		$this->client_db = $client_db;
	}
	
	function getClientDB()
	{
		return $this->client_db;
	}
	
	function getTrialUserId($first_name,$last_name)
	{
		if ($this->trial_user_id != "") {
			return $this->trial_user_id;
		} else {
			$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
			$dbconnect->open();
			mysql_select_db(_ADMIN_DATABASE);
			$query = "SELECT user_id FROM TRIAL_ORDER WHERE first_name = '$first_name' AND last_name = '$last_name'";
			$rs = mysql_fetch_row(mysql_query($query));
			$dbconnect->close();

			return $rs[0];
		}
	}
	
	function verify() 
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$pwd = crypt($this->password,'$1$d9lb2yxt$');
		$query = "SELECT FIRST_NAME, LAST_NAME, EMAIL FROM USER WHERE USER_ID = '$this->user_id' AND PASSWORD = '$pwd'";
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
	
	function retrieveAdminInfo($user_id)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT * FROM USER WHERE USER_ID = '$user_id'";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_array($query_result);
			$this->first_name = $rs["first_name"];
			$this->last_name = $rs["last_name"];
			$this->email = $rs["email"];
			$this->role = $rs["role"];
			$this->status = $rs["status"];
		}
		$query = "SELECT * FROM CLIENTS WHERE USER_ID = '$user_id'";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_array($query_result);
			$this->company_name = $rs["company_name"];
			$this->company_url = $rs["company_url"];
			$this->company_address1 = $rs["company_address1"];
			$this->company_address2 = $rs["company_address2"];
			$this->company_city = $rs["company_city"];
			$this->company_state = $rs["company_state"];
			$this->company_zip = $rs["company_zip"];
			$this->company_country = $rs["company_country"];
			$this->company_phone = $rs["company_phone"];
			$this->company_fax = $rs["company_fax"];
			$this->company_email = $rs["company_email"];
		}
		$query = "SELECT * FROM CLIENT_DATABASE WHERE USER_ID = '$user_id'";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_array($query_result);
			$this->client_db = $rs["database_name"];
		}
		$dbconnect->close();
	}
	
	function getClientDBs()
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT database_name FROM CLIENT_DATABASE";
		$query_result = mysql_query($query);
		$db = Array();
		while ($rs = mysql_fetch_row($query_result))
			$db[] = $rs[0];
		
		return $db;
	}
	
	function getComponent($user_id)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT component FROM CLIENT_COMPONENTS WHERE user_id = '$user_id'";
		$query_result = mysql_query($query);
		$component = Array();
		while ($rs = mysql_fetch_row($query_result))
			$component[] = $rs[0];
		
		return $component;
	}
	
	function getState($country) 
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT * FROM STATE WHERE country = '$country'";
		$query_result = mysql_query($query);
		$state = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$name["short"] = $rs[0];
			$name["long"] = $rs[1];
			$state[] = $name;
		}
		
		$dbconnect->close();
		
		return $state;
	}
	
	function createTrialOrder($first_name,$last_name,$address_1,$address_2,$city,$state,$zip,$country,$phone,$email) 
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);

		$order_date = date("Y-m-d");
		//$query = "INSERT INTO TRIAL_ORDER (first_name,last_name,address_1,address_2,city,state,zip,country,phone,email,order_date,build_status) VALUES ('$first_name','$last_name','$address_1','$address_2','$city','$state','$zip','$country','$phone','$email','$order_date','pending')";		
		$query = "INSERT INTO TRIAL_ORDER (first_name,last_name,address_1,address_2,city,state,zip,country,phone,email,order_date,build_status) VALUES ('$first_name','$last_name','$address_1','$address_2','$city','$state','$zip','$country','$phone','$email','$order_date','completed')";
		mysql_query($query);

		$query = "SELECT id FROM TRIAL_ORDER WHERE first_name = '$first_name' AND last_name = '$last_name' ORDER BY id DESC";
		$rs = mysql_fetch_row(mysql_query($query));
		$query_update = "UPDATE TRIAL_ORDER SET user_id = 'trial" . $rs[0] . "' WHERE id = " . $rs[0];
		mysql_query($query_update);
		
		$dbconnect->close();
	}
	
	function createTrialAccount($first_name,$last_name,$address_1,$address_2,$city,$state,$zip,$country,$phone,$email)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT user_id, id FROM TRIAL_ORDER WHERE first_name = '$first_name' AND last_name = '$last_name' ORDER BY id DESC";
		$rs = mysql_fetch_row(mysql_query($query));
		$dbname = $rs[0] . "_db";
		$user_id = $rs[0];
		$this->trial_user_id = $user_id;
		$order_id = $rs[1];
		
		mysql_create_db($dbname,$dbconnect->getConnection());
		
		$pwd = crypt($user_id,'$1$d9lb2yxt$');
		$query = "INSERT INTO USER (user_id,password,first_name,last_name,email,role,status) VALUES ('$user_id','" . $pwd . "','$first_name','$last_name','$email','User','Active')";
		mysql_query($query);
		
		$query = "INSERT INTO CLIENTS (user_id,company_name,company_url,company_address1,company_address2,company_city,company_state,company_zip,company_country,company_phone,company_fax,company_email) VALUES ('$user_id','$last_name','www.suryadisoft.net/trial/$user_id','$address_1','$address_2','$city','$state','$zip','$country','$phone','','$email')";
		mysql_query($query);
		
		$query = "INSERT INTO CLIENT_DATABASE (user_id,database_name) VALUES ('$user_id','$dbname')";
		mysql_query($query);
	
		$query = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','Shopping Cart')";
		mysql_query($query);
	
		//$query = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','Wish List')";
		//mysql_query($query);
		
		//$query = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','User Account')";
		//mysql_query($query);

		$query = "INSERT INTO CLIENT_PAYMENT_SERVICE (user_id,payment_service) VALUES ('$user_id','PayPal')";
		mysql_query($query);
		
		mysql_select_db($dbname);
		
		$file_in = fopen(_ROOTPATH . "admin/script/mini_ecommerce_db.txt","r");
		$i = 0;
		$query = "";
		while(!feof($file_in)) {
			$str = fgets($file_in,10000);
			if (trim($str) != "") {
				$query = $query . $str;
			} else {
				$isSuccess = mysql_query($query);
				$i++;
				$query = "";
			}
		}		
		fclose($file_in);
			
		$file_in = fopen(_ROOTPATH . "admin/script/mini_ecommerce_data.txt","r");
		$i = 0;
		$query = "";
		$success = true;
		while(!feof($file_in)) {
			$str = fgets($file_in,10000);
			if (trim($str) != "") {
				$query = $query . $str;
			} else {
				mysql_query($query);
				$i++;
				$query = "";
			}
		}
		fclose($file_in);

		$file_in = fopen(_ROOTPATH . "admin/script/mini_ecommerce_demo_data.txt","r");
		$i = 0;
		$query = "";
		$success = true;
		while(!feof($file_in)) {
			$str = fgets($file_in,10000);
			if (trim($str) != "") {
				$query = $query . $str;
			} else {
				mysql_query($query);
				$i++;
				$query = "";
			}
		}
		fclose($file_in);
		
		$dbconnect->close();
		
		$this->createTrialSites($order_id);
		$this->mailTrialAccount($order_id);
	}
	
	function mailTrialAccount($order_id)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT * FROM TRIAL_ORDER WHERE id = '$order_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["first_name"];
		$email = $rs["email"];
		
		$dbconnect->close();
		
		$filename = _ROOTPATH . "mail/trial.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $email . ",seancarr@sbcglobal.net";
		$mail_from = "From: Webmaster at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_subject = "Your trial account";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function mailExpiredTrialNote($order_id)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT * FROM TRIAL_ORDER WHERE id = '$order_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["first_name"];
		$email = $rs["email"];
		
		$dbconnect->close();
		
		$filename = _ROOTPATH . "mail/trial_expired.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $email . ",seancarr@sbcglobal.net";
		$mail_from = "From: Webmaster at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_subject = "Your trial has expired";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function mailBillingResult($user_id,$result)
	{
		$query = "SELECT * FROM BILLING, USER WHERE BILLING.user_id = USER.user_id AND BILLING.user_id = '$user_id'";
		$rs = mysql_fetch_array(mysql_query($query));
	
		$first_name = $rs["billing_first_name"];
		$last_name = $rs["billing_last_name"];
		$email = $rs["email"];
		$date = date("m/d/Y");
			
		$filename = _ROOTPATH . "mail/charge_result.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = "seancarr@sbcglobal.net";
		$mail_from = "From: Sales at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_subject = "Auto Billing Result";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function mailMonthlyBillingInvoice($user_id)
	{
		$query = "SELECT * FROM BILLING, USER, CLIENTS WHERE BILLING.user_id = USER.user_id AND BILLING.user_id = CLIENTS.user_id AND BILLING.user_id = '$user_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["billing_first_name"];
		$last_name = $rs["billing_last_name"];
		$address_1 = $rs["billing_address_1"];
		$address_2 = $rs["billing_address_2"];
		$city = $rs["billing_city"];
		$state = $rs["billing_state"];
		$zip = $rs["billing_zip"];
		$country = $rs["billing_country"];
		$email = $rs["email"];
		$monthly_fee = $rs["monthly_fee"];
		$cc_type = $rs["payment_type"];
		$cc_num = substr($rs["account_number"],12,4);
		$date = date("m/d/Y");
		$domain_name = $rs["company_url"];
		
		$filename = _ROOTPATH . "mail/billing_invoice.htm";
		echo $filename . "<br>";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		$str = htmlspecialchars($str);
		eval ("\$str = \"$str\";");
		
		$mail_to = $email . ",seancarr@sbcglobal.net";
		$mail_from = "From: Sales at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_headers = "Content-type: text/html\n" . $mail_from;
		$mail_subject = "Your online store monthly statement";
		$mail_body = $str;
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function mailUnpaidBalance($user_id,$errMsg)
	{
		$query = "SELECT * FROM BILLING, USER, CLIENTS WHERE BILLING.user_id = USER.user_id AND BILLING.user_id = CLIENTS.user_id AND BILLING.user_id = '$user_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["billing_first_name"];
		$last_name = $rs["billing_last_name"];
		$email = $rs["email"];
		$monthly_fee = $rs["monthly_fee"];
		$cc_type = $rs["payment_type"];
		$cc_num = substr($rs["account_number"],12,4);
		$due_date = date("M") . " " . substr($rs["order_date"],8,2) . " " . date("Y");
		$past_due = ceil((mktime(0,0,0,date("m"),date("d"),date("Y")) - mktime(0,0,0,date("m"),substr($rs["order_date"],8,2),date("Y")))/86400);
		$domain_name = $rs["company_url"];

		$filename = _ROOTPATH . "mail/unpaid_balance.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $email . ",seancarr@sbcglobal.net";
		$mail_from = "From: Sales at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_headers = $mail_from;
		$mail_subject = "Unpaid Balance";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function mailAccountActivation($trial_id,$elapsed)
	{
		$query = "SELECT * FROM TRIAL_ORDER WHERE user_id = '$trial_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["first_name"];
		$last_name = $rs["last_name"];
		$email = $rs["email"];
		$days = 10 - $elapsed;
		
		$filename = _ROOTPATH . "mail/activation.htm";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		$str = htmlspecialchars($str);
		eval ("\$str = \"$str\";");
		
		$mail_to = $email;
		$mail_from = "From: Sales at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_headers = "Content-type: text/html\n" . $mail_from;
		$mail_subject = "Online Store Trial Activation";
		$mail_body = $str;
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function mailAccountActivation2($trial_id)
	{
		$query = "SELECT * FROM TRIAL_ORDER WHERE user_id = '$trial_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["first_name"];
		$last_name = $rs["last_name"];
		$email = $rs["email"];
		
		$filename = _ROOTPATH . "mail/activation2.htm";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		$str = htmlspecialchars($str);
		eval ("\$str = \"$str\";");
		
		$mail_to = $email;
		$mail_from = "From: Sales at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_headers = "Content-type: text/html\n" . $mail_from;
		$mail_subject = "Online Store Trial Activation";
		$mail_body = $str;
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);	
	}
	
	function mailCanceledTrialAccount($trial_id)
	{
		$query = "SELECT * FROM TRIAL_ORDER WHERE user_id = '$trial_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["first_name"];
		$email = $rs["email"];
		
		$filename = _ROOTPATH . "mail/trial_cancel.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $email . ",webmaster@suryadisoft.net";
		$mail_from = "From: Webmaster at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_subject = "Your trial has been cancelled";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function mailExpiredNotification($order_id)
	{
		$query = "SELECT * FROM TRIAL_ORDER WHERE id = '$order_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		$first_name = $rs["first_name"];
		$email = $rs["email"];
		
		$filename = _ROOTPATH . "mail/trial_expired.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
		eval ("\$str = \"$str\";");
		
		$mail_to = $email . ",seancarr@sbcglobal.net";
		$mail_from = "From: Webmaster at SURYADISOFT <seancarr@sbcglobal.net>";
		$mail_subject = "Your trial has expired";
		$mail_body = $str;
		mail($mail_to , $mail_subject , $mail_body, $mail_from);
	}
	
	function deleteExpiredAccount($trial_id)
	{
		$query = Array();
		$query [] = "DELETE FROM TRIAL_ORDER WHERE user_id = '$trial_id'";
		$query [] = "DELETE FROM USER WHERE user_id = '$trial_id'";
		$query [] = "DELETE FROM CLIENTS WHERE user_id = '$trial_id'";
		$query [] = "DELETE FROM CLIENT_COMPONENTS WHERE user_id = '$trial_id'";
		$query [] = "DELETE FROM CLIENT_DATABASE WHERE user_id = '$trial_id'"; 
		$query [] = "DELETE FROM CLIENT_PAYMENT_SERVICE WHERE user_id = '$trial_id'";
		for ($i=0;$i<count($query);$i++)
			mysql_query($query[$i]);
		mysql_drop_db($trial_id . "_db");	
		$this->removeTrialDirectory($trial_id);
	}
	
	function removeTrialDirectory($trial_id) 
	{
		$dest_file = _ROOTPATH . "trial/$trial_id";
		$this->deldir($dest_file);
	}
	
	function deldir($dir)
	{
		$current_dir = opendir($dir);
		while($entryname = readdir($current_dir)){
			 if(is_dir("$dir/$entryname") and ($entryname != "." and $entryname!="..")){
					$this->deldir("${dir}/${entryname}");
			 }elseif($entryname != "." and $entryname!=".."){
					unlink("${dir}/${entryname}");
			 }
		}
		closedir($current_dir);
		rmdir(${dir});
	} 
	
	function addBillingRecord($user_id,$status)
	{
		$query = "SELECT * FROM BILLING WHERE user_id = '$user_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$query2 = "INSERT INTO BILLING_RECORD(user_id,date,description,amount,status) VALUES ('$user_id','" . date("Y-m-d H:i:s") . "','Online Store Monthly Fee','" . $rs["monthly_fee"] . "','$status')";
		mysql_query($query2);
	}
	
	function updateBillingRecord($id,$status)
	{	
		$query = "UPDATE BILLING_RECORD SET status = '$status' WHERE id = $id";
		mysql_query($query);
	}
	
	function createTrialSites($order_id)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		
		$query = "SELECT * FROM TRIAL_ORDER WHERE id = '$order_id'";
		$rs = mysql_fetch_array(mysql_query($query));

		$user_id = $rs["user_id"];		
		
		$dbconnect->close();
		
		$oldumask = umask(0); 
		mkdir(_ROOTPATH . "trial/" . $user_id,0777);
		umask($oldumask);
		$oldumask = umask(0);  
		mkdir(_ROOTPATH . "trial/" . $user_id . "/images/",0777);
		umask($oldumask);
		$oldumask = umask(0); 
		mkdir(_ROOTPATH . "trial/" . $user_id . "/images/product/",0777);
		umask($oldumask);
		$oldumask = umask(0);
		mkdir(_ROOTPATH . "trial/" . $user_id . "/export/",0777);
		umask($oldumask);
		
		$source_file = _ROOTPATH . "admin/mini_ecommerce/index.htm";
		$dest_file = _ROOTPATH . "trial/$user_id/index.htm";
		copy($source_file,$dest_file);
		
		$config_file = _ROOTPATH . "trial/" . $user_id . "/config.php";
		touch($config_file);
		chmod($config_file,0666);
		$file = fopen($config_file,"w");
		fwrite($file,"<?php\n");
		fwrite($file,"include(\"/www/wwwuser/suryadisoft.net/path_config.php\");\n");
		fwrite($file,"define(\"_DATABASE\",\"" . $user_id . "_db\");\n");
		fwrite($file,"define(\"_USER\",\"$user_id\");\n");
		fwrite($file,"define(\"_URLPATH\",\"http://www.suryadisoft.net/\");\n");
		fwrite($file,"?>\n");
		fclose($file);
		
		$source_file = _ROOTPATH . "admin/mini_ecommerce/mystore.php";
		$dest_file = _ROOTPATH . "trial/$user_id/mystore.php";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/fushigi_yugi_sm.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/fushigi_yugi_sm.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/fushigi_yugi_md.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/fushigi_yugi_md.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/fushigi_yugi_lg.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/fushigi_yugi_lg.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/lunar_sm.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/lunar_sm.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/lunar_md.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/lunar_md.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/lunar_lg.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/lunar_lg.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/lunar2_sm.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/lunar2_sm.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/lunar2_md.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/lunar2_md.jpg";
		copy($source_file,$dest_file);
		
		$source_file = _ROOTPATH . "demo1/images/product/lunar2_lg.jpg";
		$dest_file = _ROOTPATH . "trial/$user_id/images/product/lunar2_lg.jpg";
		copy($source_file,$dest_file);		
	}
	
	function createSites($user_id)
	{
		$this->retrieveAdminInfo($user_id);
		$str = substr($user_id,0,8);
		if (substr($this->company_url,0,3) == "www")
			$url = substr($this->company_url,4);
		else
			$url = $this->company_url;
		$rootpath = "/www/" . $str . "/" . $url;
		if (!file_exists($rootpath . "/images/")) {
			$oldumask = umask(0);  
			mkdir($rootpath . "/images/",0777);
			umask($oldumask);
		}
		$oldumask = umask(0); 
		mkdir($rootpath . "/images/product/",0777);
		chmod($rootpath . "/images/product/",0777);
		umask($oldumask);
		$oldumask = umask(0);
		mkdir($rootpath . "/export/",0777);
		chmod($rootpath . "/export/",0777);
		umask($oldumask);
		
		$source_file = _ROOTPATH . "/admin/mini_ecommerce/index.htm";
		$dest_file = $rootpath . "/index.htm";
		copy($source_file,$dest_file);
		
		$config_file = $rootpath . "/config.php";
		touch($config_file);
		chmod($config_file,0666);
		$file = fopen($config_file,"w");
		fwrite($file,"<?php\n");
		fwrite($file,"include(\"/www/wwwuser/suryadisoft.net/path_config.php\");\n");
		fwrite($file,"define(\"_DATABASE\",\"" . $user_id . "_db\");\n");
		fwrite($file,"define(\"_USER\",\"$user_id\");\n");
		fwrite($file,"?>\n");
		fclose($file);
		
		$source_file = _ROOTPATH . "/admin/mini_ecommerce/mystore.php";
		$dest_file = $rootpath . "/mystore.php";
		copy($source_file,$dest_file);		
	}
}
?>
