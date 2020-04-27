<?php
$message_type = urldecode($message_type);
?>
<html>
<head>
<title>Dynamic Variable</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#99CCCC">
  <tr> 
    <th width="50%" bgcolor="#99CCCC">Variable</th>
    <th width="50%" bgcolor="#99CCCC">Description</th>
  </tr>
  <tr> 
    <td>$admin_first_name</td>
    <td>Your administrator first name</td>
  </tr>
  <tr> 
    <td>$admin_last_name</td>
    <td>Your administrator last name</td>
  </tr>
  <tr> 
    <td>$admin_email</td>
    <td>Your administrator email</td>
  </tr>
  <tr> 
    <td>$company_name</td>
    <td>Your company name</td>
  </tr>
  <tr> 
    <td>$company_url</td>
    <td>Your company URL address</td>
  </tr>
  <tr> 
    <td>$company_address1</td>
    <td>Your company address 1</td>
  </tr>
  <tr> 
    <td>$company_address2</td>
    <td>Your company address 2</td>
  </tr>
  <tr> 
    <td>$company_city</td>
    <td>Your company city</td>
  </tr>
  <tr> 
    <td>$company_state</td>
    <td>Your company state</td>
  </tr>
  <tr> 
    <td>$company_zip</td>
    <td>Your company zip code</td>
  </tr>
  <tr> 
    <td>$company_country</td>
    <td>Your company country</td>
  </tr>
  <tr> 
    <td>$company_phone</td>
    <td>Your company phone number</td>
  </tr>
  <tr> 
    <td>$company_fax</td>
    <td>Your company fax number</td>
  </tr>
  <tr> 
    <td>$company_email</td>
    <td>Your company email</td>
  </tr>
	<? if ($message_type != "" && $message_type == "Affiliate Program") {?>
  <tr> 
    <td>$id</td>
    <td>Your customer affiliate id</td>
  </tr>
  <tr> 
    <td>$name</td>
    <td>Your customer affiliate name</td>
  </tr>
  <tr> 
    <td>$logo_img_src</td>
    <td>Your company logo image source</td>
  </tr>
  <? }?>
  <? if ($message_type == "" || $message_type != "Customer Invoice") {?>
  <tr> 
    <td>$user_email</td>
    <td>Your customer email</td>
  </tr>
  <tr> 
    <td>$user_first_name</td>
    <td>Your customer first name</td>
  </tr>
  <tr> 
    <td>$user_last_name</td>
    <td>Your customer last name</td>
  </tr>
  <tr> 
    <td>$user_id</td>
    <td>Your customer user id</td>
  </tr>
  <tr> 
    <td>$user_password</td>
    <td>Your customer password</td>
  </tr>
  <? }?>
  <? if ($message_type != "" && ($message_type == "Customer Invoice" || $message_type == "Partial Shipped Order" || $message_type == "Complete Shipped Order")) {?>
  <tr> 
    <td>$customer_first_name</td>
    <td>Your customer first name</td>
  </tr>
  <tr> 
    <td>$customer_middle_initial</td>
    <td>Your customer middle initial</td>
  </tr>
  <tr> 
    <td>$customer_last_name</td>
    <td>Your customer last name</td>
  </tr>
  <tr> 
    <td>$customer_phone_day</td>
    <td>Your customer day phone number</td>
  </tr>
  <tr> 
    <td>$customer_phone_evening</td>
    <td>Your customer evening phone number</td>
  </tr>
  <tr> 
    <td>$customer_fax</td>
    <td>Your customer fax number</td>
  </tr>
  <tr> 
    <td>$customer_email</td>
    <td>Your customer email</td>
  </tr>
  <tr> 
    <td>$customer_address_1</td>
    <td>Your customer address 1</td>
  </tr>
  <tr> 
    <td>$customer_address_2</td>
    <td>Your customer address 2</td>
  </tr>
  <tr> 
    <td>$customer_city</td>
    <td>Your customer city</td>
  </tr>
  <tr> 
    <td>$customer_state</td>
    <td>Your customer state</td>
  </tr>
  <tr> 
    <td>$customer_zip</td>
    <td>Your customer zip code</td>
  </tr>
  <tr> 
    <td>$customer_country</td>
    <td>Your customer country</td>
  </tr>
  <tr> 
    <td>$shipping_first_name</td>
    <td>Your customer shipping first name</td>
  </tr>
  <tr> 
    <td>$shipping_middle_initial</td>
    <td>Your customer shipping middle initial</td>
  </tr>
  <tr> 
    <td>$shipping_last_name</td>
    <td>Your customer shipping last name</td>
  </tr>
  <tr> 
    <td>$shipping_address_1</td>
    <td>Your customer shipping address 1</td>
  </tr>
  <tr> 
    <td>$shipping_address_2</td>
    <td>Your customer shipping address 2</td>
  </tr>
  <tr> 
    <td>$shipping_city</td>
    <td>Your customer shipping city</td>
  </tr>
  <tr> 
    <td>$shipping_state</td>
    <td>Your customer shipping state</td>
  </tr>
  <tr> 
    <td>$shipping_zip</td>
    <td>Your customer shipping zip</td>
  </tr>
  <tr> 
    <td>$shipping_country</td>
    <td>Your customer shipping country</td>
  </tr>
  <tr> 
    <td>$billing_first_name</td>
    <td>Your customer billing first name</td>
  </tr>
  <tr> 
    <td>$billing_middle_initial</td>
    <td>Your customer billing middle initial</td>
  </tr>
  <tr> 
    <td>$billing_last_name</td>
    <td>Your customer billing last name</td>
  </tr>
  <tr> 
    <td>$billing_address_1</td>
    <td>Your customer billing address 1</td>
  </tr>
  <tr> 
    <td>$billing_address_2</td>
    <td>Your customer billing address 2</td>
  </tr>
  <tr> 
    <td>$billing_city</td>
    <td>Your customer billing city</td>
  </tr>
  <tr> 
    <td>$billing_state</td>
    <td>Your customer billing state</td>
  </tr>
  <tr> 
    <td>$billing_zip</td>
    <td>Your customer billing zip</td>
  </tr>
  <tr> 
    <td>$billing_country</td>
    <td>Your customer billing country</td>
  </tr>
  <tr> 
    <td>$billing_phone</td>
    <td>Your customer billing state</td>
  </tr>
  <tr> 
    <td>$invoice_number</td>
    <td>Invoice number</td>
  </tr>
  <tr> 
    <td>$date_time</td>
    <td>Transaction date and time</td>
  </tr>
  <tr> 
    <td>$tracking_number</td>
    <td>Shipping Tracking Number</td>
  </tr>
  <tr> 
    <td>$coupon_code</td>
    <td>Coupon Code</td>
  </tr>
	<? if ($message_type == "Customer Invoice") {?>
  <tr> 
    <td>$items</td>
    <td>The list of items that your customer purchase</td>
  </tr>
	<? } else {?>
	<tr> 
    <td>$shipped_items</td>
    <td>The list of items that are shipped to your customer</td>
  </tr>
	<tr> 
    <td>$back_ordered_items</td>
    <td>The list of items that are back ordered</td>
  </tr>
	<? }?>
  <tr> 
    <td>$transaction_id</td>
    <td>Transaction id</td>
  </tr>
  <tr> 
    <td>$customer_id</td>
    <td>Customer id</td>
  </tr>
  <tr> 
    <td>$shipping_id</td>
    <td>Shipping id</td>
  </tr>
  <tr> 
    <td>$billing_id</td>
    <td>Billing id</td>
  </tr>
  <tr> 
    <td>$subtotal</td>
    <td>Total charges before shipping and tax charges</td>
  </tr>
  <tr> 
    <td>$shipping_charges</td>
    <td>Shipping charges</td>
  </tr>
  <tr> 
    <td>$sales_tax</td>
    <td>Sales tax charges</td>
  </tr>
  <tr> 
    <td>$total_charges</td>
    <td>Total charges after shipping and tax charges</td>
  </tr>
  <tr> 
    <td>$message</td>
    <td>Gift Message</td>
  </tr>
  <tr> 
    <td>$address_type</td>
    <td>Shipping address type (residential or commercial)</td>
  </tr>
  <? }?>
</table>
<p align="center">
  <input name="CloseButton" type="button" id="CloseButton" value="Close" onClick="window.close();">
</p>
</body>
</html>
