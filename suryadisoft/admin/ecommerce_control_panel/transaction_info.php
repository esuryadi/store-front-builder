<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");

if (isset($transaction_id) && $transaction_id != "") {
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT * FROM TRANSACTION WHERE transaction_id = $transaction_id";	
	$query_result = mysql_query($query);
	$rs = mysql_fetch_array($query_result);
	
	$customer_id = $rs["customer_id"];
	$billing_id = $rs["billing_id"];
	$shipping_id = $rs["shipping_id"];
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$db_connect->close();
}
?>
<html>
<head>
<title>Transaction Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript">
<!--
window.open("purchase_info.php?transaction_id=<?=$transaction_id?>&customer_id=<?=$customer_id?>","middleFrame");
-->
</script>
<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Transaction Detail Information</strong>
</font> 
<p>
<? if (isset($transaction_id) && $transaction_id != "") {?>
<table cellspacing="0" cellpadding="5">
<? for ($i=0;$i<count($field_name);$i++) {?>
<tr>
	<td valign="top" width="120"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=str_replace("_"," ",$field_name[$i])?>:</font></td>
	<td valign="top">
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<? if ($field_name[$i] == "customer_email") {?>
				<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a>
			<? } else {?>
				<?=$rs[$i]?>
			<? }?>
		</font></td>
</tr>
<? }?>
</table>

<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = $customer_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>

<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Customer Info</strong>
</font> 
<p>
<blockquote>

  <p><b> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?=$rs["customer_first_name"]?>
    <? if ($rs["customer_mi_name"] != "") {?>
    <?=$rs["customer_mi_name"]?>
    <? }?>
    <?=$rs["customer_last_name"]?>
    </font></b><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><br>
    <?=$rs["customer_address_1"]?>
    <br>
    <? if ($rs["customer_address_2"]) {?>
    <?=$rs["customer_address_2"]?>
    <br>
    <? }?>
    <?=$rs["customer_city"]?>
    , 
    <?=$rs["customer_state"]?>
    <?=$rs["customer_zip"]?>
    <br>
    <?=$rs["customer_country"]?>
    <br>
    <b>Phone:</b> 
    <?=$rs["customer_phone_day"]?>
    <br>
    <? if ($rs["customer_phone_evening"] != "") {?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <?=$rs["customer_phone_evening"]?>
    <br>
    <? }?>
    <? if ($rs["customer_fax"] != "") {?>
    <b>Fax:</b> 
    <?=$rs["customer_fax"]?>
    <br>
    <? }?>
    <b>Email:</b> 
    <?=$rs["customer_email"]?>
    </font></p>
  <p>
</blockquote>

<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT * FROM BILLING WHERE billing_id = $billing_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Billing Info</strong>
</font> 
<p>
<blockquote> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?=$rs["billing_first_name"]?>
  <? if ($rs["billing_mi_name"] != "") {?>
  <?=$rs["billing_mi_name"]?>
  <? }?>
  <?=$rs["billing_last_name"]?>
  <br>
  <?=$rs["billing_address_1"]?>
  <br>
  <? if ($rs["billing_address_2"]) {?>
  <?=$rs["billing_address_2"]?>
  <br>
  <? }?>
  <?=$rs["billing_city"]?>
  , 
  <?=$rs["billing_state"]?>
  <?=$rs["billing_zip"]?>
  <br>
  <?=$rs["billing_country"]?>
  <br>
  Phone: 
  <?=$rs["billing_phone"]?>
  </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <p><font size="-1"> Credit Card Type: 
    <?=$rs["payment_type"]?>
    <br>
    Credit Card Number: 
    <?=$rs["account_number"]?>
    <br>
    Expiration Date: 
    <?=$rs["cc_exp_date"]?>
    <br>
    Verification Code: 
    <?=$rs["cc_ver_code"]?>
    </font></font></blockquote>
		
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT * FROM SHIPPING WHERE SHIPPING_ID = $shipping_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Shipping Info</strong>
</font> 
<p>
<blockquote> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?=$rs["shipping_first_name"]?>
  <? if ($rs["shipping_mi_name"] != "") {?>
  <?=$rs["shipping_mi_name"]?>
  <? }?>
  <?=$rs["shipping_last_name"]?>
  <br>
  <?=$rs["shipping_address_1"]?>
  <br>
  <? if ($rs["shipping_address_2"]) {?>
  <?=$rs["shipping_address_2"]?>
  <br>
  <? }?>
  <?=$rs["shipping_city"]?>
  , 
  <?=$rs["shipping_state"]?>
  <?=$rs["shipping_zip"]?>
  <br>
<?=$rs["shipping_country"]?>
  <p><strong>Shipping Method:</strong> <?=$rs["shipping_method"]?></p>
  </font> 
</blockquote>

<? }?>
<p>
</body>
</html>
<? if (isset($status) && $status == "failed") {?>
<script language="JavaScript">
alert("Please update purchase status before updating the transaction status");
</script>
<? }?>