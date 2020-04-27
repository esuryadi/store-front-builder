<?php
class Transaction
{
	var $dbconnect;
	var $transaction_id = 0;
	var $customer_id = "";
	var $shipping_id = "";
	var $billing_id = "";
	var $subtotal_charges = "";
	var $total_charges = "";
	var $tax_charges = "";
	var $shipping_charges = "";
	var $coupon_code = "";
	var $discount_value = "";
	var $date_time = "";
	var $status = "";
	var $tracking_number = "";
	var $invoice_number = 1000;
	
	function Transaction()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}

	function getTransactionId()
	{
		if ($this->transaction_id == 0) {
			$transaction_id = 1;
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			
			$query = "SELECT MAX(transaction_id) FROM TRANSACTION";
			$query_result = mysql_query($query);
			$num_rows = mysql_num_rows($query_result);
			if ($num_rows > 0) {
				$rs = mysql_fetch_row($query_result);
				$transaction_id = $transaction_id + $rs[0];
			} 
			
			$this->dbconnect->close();
			
			return $transaction_id;
		} else
			return $this->transaction_id;
	}
	
	function setCustomerId($customer_id)
	{
		$this->customer_id = $customer_id;
	}
	
	function getCustomerId()
	{
		return $this->customer_id;
	}

	function setShippingId($shipping_id)
	{
		$this->shipping_id = $shipping_id;
	}
	
	function getShippingId()
	{
		return $this->shipping_id;
	}

	function setBillingId($billing_id)
	{
		$this->billing_id = $billing_id;
	}
	
	function getBillingId()
	{
		return $this->billing_id;
	}

	function setSubTotalCharges($subtotal_charges)
	{
		$this->subtotal_charges = $subtotal_charges;
	}
	
	function getSubTotalCharges()
	{
		return $this->subtotal_charges;
	}

	function setTotalCharges($total_charges)
	{
		$this->total_charges = $total_charges;
	}
	
	function getTotalCharges()
	{
		return $this->total_charges;
	}

	function setTaxCharges($tax_charges)
	{
		$this->tax_charges = $tax_charges;
	}
	
	function getTaxCharges()
	{
		return $this->tax_charges;
	}

	function setShippingCharges($shipping_charges)
	{
		$this->shipping_charges = $shipping_charges;
	}
	
	function getShippingCharges()
	{
		return $this->shipping_charges;
	}
	
	function setCouponCode($coupon_code)
	{
		$this->coupon_code = $coupon_code;
	}
	
	function getCouponCode()
	{
		return $this->coupon_code;
	}
	
	function setDiscountValue($discount_value)
	{
		$this->discount_value = $discount_value;
	}
	
	function getDiscountValue()
	{
		return $this->discount_value;
	}

	function setDateTime($date_time)
	{
		$this->date_time = $date_time;
	}
	
	function getDateTime()
	{
		return $this->date_time;
	}
	
	function getStatus()
	{
		return $this->status;
	}
	
	function getTrackingNumber()
	{
		return $this->tracking_number;
	}
	
	function getInvoiceNumber()
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query = "SELECT MAX(transaction_id) FROM TRANSACTION";
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
	
	function retrieveTransaction()
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		if ($this->date_time != "")
			$where_clause = "AND TRANSACTION_DATE_TIME = '$this->date_time'";
		else
			$where_clause = "ORDER BY TRANSACTION_DATE_TIME DESC";
		$query = "SELECT * FROM TRANSACTION WHERE CUSTOMER_ID = $this->customer_id $where_clause";
		if ($this->date_time != "") {
			$rs = mysql_fetch_row(mysql_query($query));
			$this->transaction_id = $rs[0];
			$this->invoice_number = $rs[1];
			$this->billing_id = $rs[3];
			$this->shipping_id = $rs[4];
			$this->subtotal_charges = $rs[5];
			$this->shipping_charges = $rs[6];
			$this->tax_charges = $rs[7];
			$this->total_charges = $rs[8];
			$this->date_time = $rs[9];
			$this->status = $rs[10];
			$this->tracking_number = $rs[11];
		} else {
			if ($this->customer_id != "") {
				$query_result = mysql_query($query);
				while ($rs = mysql_fetch_row($query_result)) {
					$transaction_id[] = $rs[0];
					$invoice_number[] = $rs[1];
					$billing_id[] = $rs[3];
					$shipping_id[] = $rs[4];
					$subtotal_charges[] = $rs[5];
					$shipping_charges[] = $rs[6];
					$tax_charges[] = $rs[7];
					$total_charges[] = $rs[8];
					$date_time[] = $rs[9];
					$status[] = $rs[10];
					$tracking_number[] = $rs[11];
					$this->transaction_id = $transaction_id;
					$this->invoice_number = $invoice_number;
					$this->billing_id = $billing_id;
					$this->shipping_id = $shipping_id;
					$this->subtotal_charges = $subtotal_charges;
					$this->shipping_charges = $shipping_charges;
					$this->tax_charges = $tax_charges;
					$this->total_charges = $total_charges;
					$this->date_time = $date_time;
					$this->status = $status;
					$this->tracking_number = $tracking_number;		
				}
			} else {
				$this->transaction_id = Array();
				$this->invoice_number = Array();
				$this->billing_id = Array();
				$this->shipping_id = Array();
				$this->subtotal_charges = Array();
				$this->shipping_charges = Array();
				$this->tax_charges = Array();
				$this->total_charges = Array();
				$this->date_time = Array();
				$this->status = Array();
				$this->tracking_number = Array();		
			}
		}	
		$this->dbconnect->close();
	}
	
	function storeTransaction()
	{		
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "INSERT INTO TRANSACTION (CUSTOMER_ID,INVOICE_NUMBER,BILLING_ID,SHIPPING_ID,TRANSACTION_SUBTOTAL_CHARGE,TRANSACTION_SHIPPING_CHARGE,TRANSACTION_TAX_CHARGE,TRANSACTION_TOTAL_CHARGE,TRANSACTION_DATE_TIME,TRANSACTION_STATUS,COUPON_CODE) VALUES ('$this->customer_id','$this->invoice_number','$this->billing_id','$this->shipping_id','$this->subtotal_charges','$this->shipping_charges','$this->tax_charges','$this->total_charges','$this->date_time','Pending','$this->coupon_code')";
		mysql_query($query);
		echo mysql_error();
		$this->dbconnect->close();
	}
	
	function getInvoiceEmailFrom()
	{
		return "\$company_name <\$company_email>";
	}
	
	function getInvoiceEmailSubject()
	{
		return "Invoice number: \$invoice_number";
	}
	
	function getInvoiceEmailBody()
	{		
		$filename = _COMPONENTPATH . "mail/invoice.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));		
		
		return $str;
	}
	
	function mailInvoice($message, $address_type)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$invoice_number = $this->invoice_number;
		$date_time = $this->date_time;
		$sub_total = $this->subtotal_charges;
		$shipping_charges = $this->shipping_charges;
		$sales_tax = $this->tax_charges;
		$total_charges = $this->total_charges;
		$coupon_code = $this->coupon_code;
		$discount_value = $this->discount_value;

		$query = "SELECT * FROM TRANSACTION WHERE invoice_number = '$this->invoice_number'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$transaction_id = $rs["transaction_id"];
		$customer_id = $rs["customer_id"];
		$shipping_id = $rs["shipping_id"];
		$billing_id = $rs["billing_id"];
		
		$query = "SELECT * FROM CUSTOMER WHERE customer_id = '$customer_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$customer_first_name = $rs["customer_first_name"];
		$customer_middle_initial = $rs["customer_mi_name"];
		$customer_last_name = $rs["customer_last_name"];
		$customer_email = $rs["customer_email"];
		$customer_phone_day = $rs["customer_phone_day"];
		$customer_phone_evening = $rs["customer_phone_evening"];
		$customer_fax = $rs["customer_fax"];
		$customer_address_1 = $rs["customer_address_1"];
		$customer_address_2 = $rs["customer_address_2"];
		$customer_city = $rs["customer_city"];
		$customer_state = $rs["customer_state"];
		$customer_zip = $rs["customer_zip"];
		$customer_country = $rs["customer_country"];
		
		$query = "SELECT SALES_TAX_RATE FROM SALES_TAX WHERE SALES_TAX_STATE = '$customer_state'";
		$rs = mysql_fetch_row(mysql_query($query));
		
		if ($rs[0] != "")
			$sales_tax_rate = $rs[0] * 100;
		else
			$sales_tax_rate = 0;
		
		$query = "SELECT * FROM SHIPPING WHERE shipping_id = '$shipping_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$shipping_first_name = $rs["shipping_first_name"];
		$shipping_middle_initial = $rs["shipping_mi_name"];
		$shipping_last_name = $rs["shipping_last_name"];
		$shipping_address_1 = $rs["shipping_address_1"];
		$shipping_address_2 = $rs["shipping_address_2"];
		$shipping_city = $rs["shipping_city"];
		$shipping_state = $rs["shipping_state"];
		$shipping_zip = $rs["shipping_zip"];
		$shipping_country = $rs["shipping_country"];
		$shipping_method = $rs["shipping_method"];
		
		$query = "SELECT * FROM BILLING WHERE billing_id = '$billing_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$billing_first_name = $rs["billing_first_name"];
		$billing_middle_initial = $rs["billing_mi_name"];
		$billing_last_name = $rs["billing_last_name"];
		$billing_address_1 = $rs["billing_address_1"];
		$billing_address_2 = $rs["billing_address_2"];
		$billing_city = $rs["billing_city"];
		$billing_state = $rs["billing_state"];
		$billing_zip = $rs["billing_zip"];
		$billing_country = $rs["billing_country"];
		$billing_phone = $rs["billing_phone"];
		$payment_type = $rs["payment_type"];
		$account_number = $rs["account_number"];
		$cc_last_four_digit = substr($account_number,12,4);
		$cc_exp_date = $rs["cc_exp_date"];
		$cc_ver_code = $rs["cc_ver_code"];
		
		$query = "SELECT PRODUCT.product_name, PRODUCT.product_isbn, PURCHASE.* FROM PURCHASE,PRODUCT WHERE PURCHASE.product_id = PRODUCT.product_id AND transaction_id = $transaction_id";
		$query_result = mysql_query($query);

		$i = 0;
		$items = "";
		while($rs = mysql_fetch_array($query_result)) {
			$options_str = "";
			if ($rs["product_color"] != "")
				$options_str = $options_str . "Color: " . $rs["product_color"] . ";";
			if ($rs["product_size"] != "")
				$options_str = $options_str . "Size: " . $rs["product_size"] . ";";
			if ($rs["product_choice"] != "")
				$options_str = $options_str . "Size: " . $rs["product_choice"] . ";";
			if ($options_str != "")
				$options_str = " (" . $options_str . ")";
			if ($rs["product_isbn"] == "")
				$items = $items . "<tr><td>" . ($i+1) . ". " . $rs["product_name"] . $options_str . "</td><td align=\"right\">" . $rs["purchase_quantity"] . "</td><td align=\"right\">" . "\$ " . $rs["purchase_charge"] . "</td></tr>";
			else
				$items = $items . "<tr><td>" . ($i+1) . ". " . $rs["product_name"] . $options_str . " - Item Number: " . $rs["product_isbn"] . "</td><td align=\"right\">" . $rs["purchase_quantity"] . "</td><td align=\"right\">" . "\$ " . $rs["purchase_charge"] . "</td></tr>";
			$i++;
		}
		
		$this->dbconnect->close();
		
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
			
		$mail_from = (WebContent::getPropertyValue("invoice_email_from") != "")?WebContent::getPropertyValue("invoice_email_from"):$this->getInvoiceEmailFrom();
		eval ("\$mail_headers = \"From: $mail_from\n\";");
		if (WebContent::getPropertyValue("email_cust_inv") == "yes" || WebContent::getPropertyValue("email_cust_inv") == "") {
			$mail_to = $customer_email;
			if (WebContent::getPropertyValue("cc_cust_inv_email") == "yes")
				$mail_to = $mail_to . "," . $company_email;
		} else {
			if (WebContent::getPropertyValue("cc_cust_inv_email") == "yes")
				$mail_to = $company_email;
		}
		$mail_cc = (WebContent::getPropertyValue("invoice_email_from") != "")?WebContent::getPropertyValue("invoice_email_cc"):"";
		if ($mail_cc != "")
			$mail_headers = $mail_headers . "Cc: $mail_cc";
		$mail_bcc = (WebContent::getPropertyValue("invoice_email_from") != "")?WebContent::getPropertyValue("invoice_email_bcc"):"";
		if ($mail_bcc != "")
			$mail_headers = $mail_headers . "\nBcc: $mail_bcc";
		$mail_headers = "Content-type: text/html\n" . $mail_headers;
		$mail_subject = (WebContent::getPropertyValue("invoice_email_subject") != "")?WebContent::getPropertyValue("invoice_email_subject"):$this->getInvoiceEmailSubject();
		eval ("\$mail_subject = \"$mail_subject\";");
		$mail_body = (WebContent::getPropertyValue("invoice_email_body") != "")?WebContent::getPropertyValue("invoice_email_body"):$this->getInvoiceEmailBody();
		$mail_body = htmlspecialchars($mail_body);
		eval ("\$mail_body = \"$mail_body\";");
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		if (isset($mail_to))
			mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function getShippedOrderEmailFrom()
	{
		return "\$company_name <\$company_email>";
	}
	
	function getShippedOrderEmailSubject($status)
	{
		if ($status == "partial" || $status == "Partially Completed")
			return "Your Order has been partially shipped";
		else
			return "Your Order has been shipped";
	}
	
	function getShippedOrderEmailBody($status)
	{		
		if ($status == "partial" || $status == "Partially Completed")
			$filename = _COMPONENTPATH . "mail/partial_shipped_order.txt";
		else
			$filename = _COMPONENTPATH . "mail/complete_shipped_order.txt";
		$file_in = fopen($filename,"r");
		$str = fread($file_in,filesize($filename));
	
		return $str;
	}
	
	function mailShippedOrder($transaction_id,$status,$database)
	{
		$this->dbconnect->open();
		mysql_select_db($database);
		
		$query = "SELECT * FROM TRANSACTION WHERE transaction_id = $transaction_id";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$customer_id = $rs["customer_id"];
		$shipping_id = $rs["shipping_id"];
		$billing_id = $rs["billing_id"];
		$invoice_number = $rs["invoice_number"];
		$date_time = $rs["transaction_date_time"];
		$sub_total = $rs["transaction_subtotal_charge"];
		$shipping_charges = $rs["transaction_shipping_charge"];
		$sales_tax = $rs["transaction_tax_charge"];
		$total_charges = $rs["transaction_total_charge"];
		$tracking_number = $rs["transaction_tracking_number"];
		
		$query = "SELECT * FROM CUSTOMER WHERE customer_id = '$customer_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$customer_first_name = $rs["customer_first_name"];
		$customer_middle_initial = $rs["customer_mi_name"];
		$customer_last_name = $rs["customer_last_name"];
		$customer_email = $rs["customer_email"];
		$customer_phone_day = $rs["customer_phone_day"];
		$customer_phone_evening = $rs["customer_phone_evening"];
		$customer_fax = $rs["customer_fax"];
		$customer_address_1 = $rs["customer_address_1"];
		$customer_address_2 = $rs["customer_address_2"];
		$customer_city = $rs["customer_city"];
		$customer_state = $rs["customer_state"];
		$customer_zip = $rs["customer_zip"];
		$customer_country = $rs["customer_country"];
		
		$query = "SELECT * FROM SHIPPING WHERE shipping_id = '$shipping_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$shipping_first_name = $rs["shipping_first_name"];
		$shipping_middle_initial = $rs["shipping_mi_name"];
		$shipping_last_name = $rs["shipping_last_name"];
		$shipping_address_1 = $rs["shipping_address_1"];
		$shipping_address_2 = $rs["shipping_address_2"];
		$shipping_city = $rs["shipping_city"];
		$shipping_state = $rs["shipping_state"];
		$shipping_zip = $rs["shipping_zip"];
		$shipping_country = $rs["shipping_country"];
		
		$query = "SELECT * FROM BILLING WHERE billing_id = '$billing_id'";
		$rs = mysql_fetch_array(mysql_query($query));
		
		$billing_first_name = $rs["billing_first_name"];
		$billing_middle_initial = $rs["billing_mi_name"];
		$billing_last_name = $rs["billing_last_name"];
		$billing_address_1 = $rs["billing_address_1"];
		$billing_address_2 = $rs["billing_address_2"];
		$billing_city = $rs["billing_city"];
		$billing_state = $rs["billing_state"];
		$billing_zip = $rs["billing_zip"];
		$billing_country = $rs["billing_country"];
		$billing_phone = $rs["billing_phone"];
		$payment_type = $rs["payment_type"];
		$account_number = $rs["account_number"];
		$cc_exp_date = $rs["cc_exp_date"];
		$cc_ver_code = $rs["cc_ver_code"];
		
		$query = "SELECT PRODUCT.product_name, PRODUCT.product_isbn, PURCHASE.* FROM PURCHASE,PRODUCT WHERE PURCHASE.product_id = PRODUCT.product_id AND transaction_id = $transaction_id AND purchase_status = 'Shipped'";
		$query_result = mysql_query($query);
		
		$i = 0;
		$shipped_items = "";
		while($rs = mysql_fetch_array($query_result)) {
			$options_str = "";
			if ($rs["product_color"] != "")
				$options_str = $options_str . "Color: " . $rs["product_color"] . ";";
			if ($rs["product_size"] != "")
				$options_str = $options_str . "Size: " . $rs["product_size"] . ";";
			if ($rs["product_choice"] != "")
				$options_str = $options_str . "Size: " . $rs["product_choice"] . ";";
			if ($options_str != "")
				$options_str = " (" . $options_str . ")";
			if ($rs["product_isbn"] == "")
				$shipped_items = $shipped_items . "<tr><td>" . ($i+1) . ". " . $rs["product_name"] . $options_str . "</td><td>" . $rs["purchase_quantity"] . "</td></tr>";
			else
				$shipped_items = $shipped_items . "<tr><td>" . ($i+1) . ". " . $rs["product_name"] . $options_str . " - Item Number: " . $rs["product_isbn"] . "</td><td>" . $rs["purchase_quantity"] . "</td></tr>";
			$i++;
		}
		if ($shipped_items == "")
			$shipped_items = "NONE";
		
		$query = "SELECT PRODUCT.product_name, PRODUCT.product_isbn, PURCHASE.* FROM PURCHASE,PRODUCT WHERE PURCHASE.product_id = PRODUCT.product_id AND transaction_id = $transaction_id AND purchase_status = 'Back Order'";
		$query_result = mysql_query($query);
		
		$i = 0;
		$back_ordered_items = "";
		while($rs = mysql_fetch_array($query_result)) {
			$options_str = "";
			if ($rs["product_color"] != "")
				$options_str = $options_str . "Color: " . $rs["product_color"] . ";";
			if ($rs["product_size"] != "")
				$options_str = $options_str . "Size: " . $rs["product_size"] . ";";
			if ($rs["product_choice"] != "")
				$options_str = $options_str . "Size: " . $rs["product_choice"] . ";";
			if ($options_str != "")
				$options_str = " (" . $options_str . ")";
			if ($rs["product_isbn"] == "")
				$back_ordered_items = $back_ordered_items . "<tr><td>" . ($i+1) . ". " . $rs["product_name"] . $options_str . "</td><td>" . $rs["purchase_quantity"] . "</td></tr>";
			else
				$back_ordered_items = $back_ordered_items . "<tr><td>" . ($i+1) . ". " . $rs["product_name"] . $options_str . " - Item Number: " . $rs["product_isbn"] . "</td><td>" . $rs["purchase_quantity"] . "</td></tr>";
			$i++;
		}
		
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $database . "'";
		$rs = mysql_fetch_row(mysql_query($query));
		$userid = $rs[0];

		$this->dbconnect->close();
				
		$admin = new Admin();
		$admin->retrieveAdminInfo($userid);
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
			
		if ($status == "partial" || $status == "Partially Completed")
			$status = "partial";
		else
			$status = "complete";
		$mail_to = $customer_email;
		if ($this->getPropertyValue("cc_shipped_order_email",$database) == "yes")
			$mail_to = $mail_to . "," . $company_email;
		$mail_from = ($this->getPropertyValue($status . "_shipped_order_email_from",$database) != "")?$this->getPropertyValue($status . "_shipped_order_email_from",$database):$this->getShippedOrderEmailFrom();
		eval ("\$mail_headers = \"From: $mail_from\n\";");
		$mail_cc = ($this->getPropertyValue($status . "_shipped_order_email_cc",$database) != "")?$this->getPropertyValue($status . "_shipped_order_email_cc",$database):"";
		if ($mail_cc != "")
			$mail_headers = $mail_headers . "Cc: $mail_cc";
		$mail_bcc = ($this->getPropertyValue($status . "_shipped_order_email_bcc",$database) != "")?$this->getPropertyValue($status . "_shipped_order_email_bcc",$database):"";
		if ($mail_bcc != "")
			$mail_headers = $mail_headers . "\nBcc: $mail_bcc";
		$mail_headers = "Content-type: text/html\n" . $mail_headers;
		$mail_subject = ($this->getPropertyValue($status . "_shipped_order_email_subject",$database) != "")?$this->getPropertyValue($status . "_shipped_order_email_subject",$database):$this->getShippedOrderEmailSubject($status);
		eval ("\$mail_subject = \"$mail_subject\";");
		$mail_body = ($this->getPropertyValue($status . "_shipped_order_email_body",$database) != "")?$this->getPropertyValue($status . "_shipped_order_email_body",$database):$this->getShippedOrderEmailBody($status);
		$mail_body = htmlspecialchars($mail_body);
		eval ("\$mail_body = \"$mail_body\";");
		$mail_body = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;"), array(">", "<", "\"", "&"), $mail_body);
		mail($mail_to , $mail_subject , $mail_body, $mail_headers);
	}
	
	function getPropertyValue($property_name,$database)
	{
		$this->dbconnect->open();
		mysql_select_db($database);
		
		$query = "SELECT PROPERTY_VALUE FROM PROPERTY WHERE PROPERTY_NAME = '$property_name'";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$property_value = $rs[0];
		} else
			$property_value = "";
		$this->dbconnect->close();
	
		return $property_value;
	}
}
?>
