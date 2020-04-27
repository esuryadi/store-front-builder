<?php
class Customer
{
	var $dbconnect;
	var $id = 0;
	var $user_id = "";
	var $first_name = "";
	var $last_name = "";
	var $middle_initial = "";
	var $email = "";
	var $day_phone = "";
	var $evening_phone = "";
	var $fax = "";
	var $address1 = "";
	var $address2 = "";
	var $city = "";
	var $state = "";
	var $zip = "";
	var $province = "";
	var $country = "";
	var $shipping_id = "";
	var $shipping_method = "";
	var $shipping_rate = 0;
	var $shipping_first_name = "";
	var $shipping_mi_name = "";
	var $shipping_last_name = "";
	var $shipping_address1 = "";
	var $shipping_address2 = "";
	var $shipping_city = "";
	var $shipping_state = "";
	var $shipping_zip = "";
	var $shipping_province = "";
	var $shipping_country = "";
	var $billing_first_name = "";
	var $billing_mi_name = "";
	var $billing_last_name = "";
	var $billing_address1 = "";
	var $billing_address2 = "";
	var $billing_city = "";
	var $billing_state = "";
	var $billing_zip = "";
	var $billing_province = "";
	var $billing_country = "";
	var $billing_phone = "";
	var $billing_id = "";
	var $payment_method = "";
	var $payment_type = "";
	var $account_number = "";
	var $cc_exp_date = "";
	var $cc_ver_code = "";
	var $message = "";
	
	function Customer($user_id)
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
		$this->user_id = $user_id;
	}
	
	function getCustomerId()
	{		
		return $this->id;
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
	
	function setEmail($email)
	{
		$this->email = $email;
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function setDayPhone($day_phone)
	{
		$this->day_phone = $day_phone;
	}
	
	function getDayPhone()
	{
		return $this->day_phone;
	}
	
	function setEveningPhone($evening_phone)
	{
		$this->evening_phone = $evening_phone;
	}
	
	function getEveningPhone()
	{
		return $this->evening_phone;
	}
	
	function setFax($fax)
	{
		$this->fax = $fax;
	}
	
	function getFax()
	{
		return $this->fax;
	}
	
	function setAddress1($address1)
	{
		$this->address1 = $address1;
	}
	
	function getAddress1()
	{
		return $this->address1;
	}
	
	function setAddress2($address2)
	{
		$this->address2 = $address2;
	}
	
	function getAddress2()
	{
		return $this->address2;
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
	
	function setZip($zip)
	{
		$this->zip = $zip;
	}
	
	function getZip()
	{
		return $this->zip;
	}
	
	function setProvince($province)
	{
		$this->province = $province;
	}
	
	function getProvince()
	{
		return $this->province;
	}
	
	function setCountry($country)
	{
		$this->country = $country;
	}
	
	function getCountry()
	{
		return $this->country;
	}
	
	function getShippingId()
	{
		return $this->shipping_id;
	}
	
	function setShippingMethod($shipping_method)
	{
		$this->shipping_method = $shipping_method;
	}
	
	function getShippingMethod()
	{
		return $this->shipping_method;
	}
	
	function setShippingRate($shipping_rate)
	{
		$this->shipping_rate = $shipping_rate;
	}
	
	function getShippingRate()
	{
		return $this->shipping_rate;
	}
	
	function setShippingFirstName($shipping_first_name)
	{
		$this->shipping_first_name = $shipping_first_name;
	}
	
	function getShippingFirstName()
	{
		return $this->shipping_first_name;
	}
	
	function setShippingMiddleInitial($shipping_mi_name)
	{
		$this->shipping_mi_name = $shipping_mi_name;
	}
	
	function getShippingMiddleInitial()
	{
		return $this->shipping_mi_name;
	}
	
	function setShippingLastName($shipping_last_name)
	{
		$this->shipping_last_name = $shipping_last_name;
	}
	
	function getShippingLastName()
	{
		return $this->shipping_last_name;
	}
	
	function setShippingAddress1($shipping_address1)
	{
		$this->shipping_address1 = $shipping_address1;
	}
	
	function getShippingAddress1()
	{
		return $this->shipping_address1;
	}
	
	function setShippingAddress2($shipping_address2)
	{
		$this->shipping_address2 = $shipping_address2;
	}
	
	function getShippingAddress2()
	{
		return $this->shipping_address2;
	}	
	
	function setShippingCity($shipping_city)
	{
		$this->shipping_city = $shipping_city;
	}
	
	function getShippingCity()
	{
		return $this->shipping_city;
	}
	
	function setShippingState($shipping_state)
	{
		$this->shipping_state = $shipping_state;
	}
	
	function getShippingState()
	{
		return $this->shipping_state;
	}
	
	function setShippingZip($shipping_zip)
	{
		$this->shipping_zip = $shipping_zip;
	}
	
	function getShippingZip()
	{
		return $this->shipping_zip;
	}
	
	function setShippingProvince($shipping_province)
	{
		$this->shipping_province = $shipping_province;
	}
	
	function getShippingProvince()
	{
		return $this->shipping_province;
	}
	
	function setShippingCountry($shipping_country)
	{
		$this->shipping_country = $shipping_country;
	}
	
	function getShippingCountry()
	{
		return $this->shipping_country;
	}
	
	function setBillingFirstName($billing_first_name)
	{
		$this->billing_first_name = $billing_first_name;
	}
	
	function getBillingFirstName()
	{
		return $this->billing_first_name;
	}
	
	function setBillingMiddleInitial($billing_mi_name)
	{
		$this->billing_mi_name = $billing_mi_name;
	}
	
	function getBillingMiddleInitial()
	{
		return $this->billing_mi_name;
	}
	
	function setBillingLastName($billing_last_name)
	{
		$this->billing_last_name = $billing_last_name;
	}
	
	function getBillingLastName()
	{
		return $this->billing_last_name;
	}
	
	function setBillingAddress1($billing_address1)
	{
		$this->billing_address1 = $billing_address1;
	}
	
	function getBillingAddress1()
	{
		return $this->billing_address1;
	}
	
	function setBillingAddress2($billing_address2)
	{
		$this->billing_address2 = $billing_address2;
	}
	
	function getBillingAddress2()
	{
		return $this->billing_address2;
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
	
	function setBillingZip($billing_zip)
	{
		$this->billing_zip = $billing_zip;
	}
	
	function getBillingZip()
	{
		return $this->billing_zip;
	}
	
	function setBillingProvince($billing_province)
	{
		$this->billing_province = $billing_province;
	}
	
	function getBillingProvince()
	{
		return $this->billing_province;
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
	
	function getBillingId()
	{
		return $this->billing_id;
	}
	
	function setPaymentMethod($payment_method)
	{
		$this->payment_method = $payment_method;
	}
	
	function getPaymentMethod()
	{
		return $this->payment_method;
	}
	
	function setPaymentType($payment_type)
	{
		$this->payment_type = $payment_type;
	}
	
	function getPaymentType()
	{
		return $this->payment_type;
	}
	
	function setAccountNumber($account_number)
	{
		$this->account_number = $account_number;
	}
	
	function getAccountNumber()
	{
		return $this->account_number;
	}
	
	function setCreditCardExpDate($cc_exp_date)
	{
		$this->cc_exp_date = $cc_exp_date;
	}
	
	function getCreditCardExpDate()
	{
		return $this->cc_exp_date;
	}
	
	function setCreditCardVerCode($cc_ver_code)
	{
		$this->cc_ver_code = $cc_ver_code;
	}
	
	function getCreditCardVerCode()
	{
		return $this->cc_ver_code;
	}
	
	function setMessage($message)
	{
		$this->message = $message;
	}
	
	function getMessage() 
	{
		return $this->message;
	}
	
	function retrieveCustomerData()
	{
		if ($this->user_id != "") { 
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT * FROM CUSTOMER WHERE USER_ID = '$this->user_id'";
			$rs = mysql_fetch_array(mysql_query($query));
			$this->id = $rs["customer_id"];
			$this->first_name = $rs["customer_first_name"];
			$this->last_name = $rs["customer_last_name"];
			$this->middle_initial = $rs["customer_mi_name"];
			$this->email = $rs["customer_email"];
			$this->day_phone = $rs["customer_phone_day"];
			$this->evening_phone = $rs["customer_phone_evening"];
			$this->fax = $rs["customer_fax"];
			$this->address1 = $rs["customer_address_1"];
			$this->address2 = $rs["customer_address_2"];
			$this->city = $rs["customer_city"];
			$this->state = $rs["customer_state"];
			$this->zip = $rs["customer_zip"];
			$this->country = $rs["customer_country"];
			if ($this->country != "United States")
				$this->province = $this->state;
			
			$this->dbconnect->close();
		}
	}
	
	function storeCustomerData()
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_FIRST_NAME = '$this->first_name' AND CUSTOMER_LAST_NAME = '$this->last_name'";
		$num_rows = mysql_num_rows(mysql_query($query));
		
		if ($num_rows == 0) {
			$query = "INSERT INTO CUSTOMER(USER_ID,CUSTOMER_FIRST_NAME,CUSTOMER_MI_NAME,CUSTOMER_LAST_NAME,CUSTOMER_EMAIL,CUSTOMER_PHONE_DAY,CUSTOMER_PHONE_EVENING,CUSTOMER_FAX,CUSTOMER_ADDRESS_1,CUSTOMER_ADDRESS_2,CUSTOMER_CITY,CUSTOMER_STATE,CUSTOMER_ZIP,CUSTOMER_COUNTRY) VALUES ('$this->user_id','$this->first_name','$this->middle_initial','$this->last_name','$this->email','$this->day_phone','$this->evening_phone','$this->fax','$this->address1','$this->address2','$this->city','" . (($this->state != "")?$this->state:$this->province) . "','$this->zip','$this->country')";
		} else {
			if (trim($this->user_id) == "")
				$query = "UPDATE CUSTOMER SET CUSTOMER_FIRST_NAME = '$this->first_name', CUSTOMER_MI_NAME = '$this->middle_initial', CUSTOMER_LAST_NAME = '$this->last_name', CUSTOMER_EMAIL = '$this->email', CUSTOMER_PHONE_DAY = '$this->day_phone', CUSTOMER_PHONE_EVENING = '$this->evening_phone', CUSTOMER_FAX = '$this->fax', CUSTOMER_ADDRESS_1 = '$this->address1', CUSTOMER_ADDRESS_2 = '$this->address2', CUSTOMER_CITY = '$this->city', CUSTOMER_STATE = '" . (($this->state != "")?$this->state:$this->province) . "', CUSTOMER_ZIP = '$this->zip', CUSTOMER_COUNTRY = '$this->country' WHERE CUSTOMER_FIRST_NAME = '$this->first_name' AND CUSTOMER_LAST_NAME = '$this->last_name'";			
			else
				$query = "UPDATE CUSTOMER SET CUSTOMER_FIRST_NAME = '$this->first_name', CUSTOMER_MI_NAME = '$this->middle_initial', CUSTOMER_LAST_NAME = '$this->last_name', CUSTOMER_EMAIL = '$this->email', CUSTOMER_PHONE_DAY = '$this->day_phone', CUSTOMER_PHONE_EVENING = '$this->evening_phone', CUSTOMER_FAX = '$this->fax', CUSTOMER_ADDRESS_1 = '$this->address1', CUSTOMER_ADDRESS_2 = '$this->address2', CUSTOMER_CITY = '$this->city', CUSTOMER_STATE = '" . (($this->state != "")?$this->state:$this->province) . "', CUSTOMER_ZIP = '$this->zip', CUSTOMER_COUNTRY = '$this->country' WHERE USER_ID = '$this->user_id'";
		}
		mysql_query($query);		
		$query = "SELECT CUSTOMER_ID FROM CUSTOMER WHERE CUSTOMER_FIRST_NAME = '$this->first_name' AND CUSTOMER_LAST_NAME = '$this->last_name'";
		$rs = mysql_fetch_row(mysql_query($query));
		$this->id = $rs[0];
		
		if ($this->shipping_method != "") {
			$query = "INSERT INTO SHIPPING(CUSTOMER_ID,SHIPPING_METHOD,SHIPPING_RATE,SHIPPING_FIRST_NAME,SHIPPING_MI_NAME,SHIPPING_LAST_NAME,SHIPPING_ADDRESS_1,SHIPPING_ADDRESS_2,SHIPPING_CITY,SHIPPING_STATE,SHIPPING_ZIP,SHIPPING_COUNTRY) VALUES ('$this->id','$this->shipping_method','$this->shipping_rate','$this->shipping_first_name','$this->shipping_mi_name','$this->shipping_last_name','$this->shipping_address1','$this->shipping_address2','$this->shipping_city','" . (($this->shipping_state != "")?$this->shipping_state:$this->shipping_province) . "','$this->shipping_zip','$this->shipping_country')";
			mysql_query($query);
			$query = "SELECT SHIPPING_ID FROM SHIPPING WHERE CUSTOMER_ID = $this->id";
			$query_result = mysql_query($query);
			while ($rs = mysql_fetch_row($query_result)) {
				$this->shipping_id = $rs[0];
			}
		}
		
		if ($this->billing_last_name != "") {
			$query = "INSERT INTO BILLING(CUSTOMER_ID,BILLING_FIRST_NAME,BILLING_MI_NAME,BILLING_LAST_NAME,ACCOUNT_NUMBER,CC_EXP_DATE,CC_VER_CODE,PAYMENT_TYPE,BILLING_ADDRESS_1,BILLING_ADDRESS_2,BILLING_CITY,BILLING_STATE,BILLING_ZIP,BILLING_COUNTRY,BILLING_PHONE) VALUES ('$this->id','$this->billing_first_name','$this->billing_mi_name','$this->billing_last_name','$this->account_number','$this->cc_exp_date','$this->cc_ver_code','$this->payment_type','$this->billing_address1','$this->billing_address2','$this->billing_city','" . (($this->billing_state != "")?$this->billing_state:$this->billing_province) . "','$this->billing_zip','$this->billing_country','$this->billing_phone')";
			mysql_query($query);
			$query = "SELECT BILLING_ID FROM BILLING WHERE CUSTOMER_ID = $this->id";
			$query_result = mysql_query($query);
			while ($rs = mysql_fetch_row($query_result)) {
				$this->billing_id = $rs[0];
			}
		}
		
		$this->dbconnect->close();
	}
}
?>