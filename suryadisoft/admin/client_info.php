<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT * FROM PURCHASE_ORDER WHERE order_id = $order_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);

$db_connect->close();
?>
<html>
<head>
<title>Client Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>



<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Client 
Info</strong></font> 
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Invoice number</b>: 
  <?=$rs["invoice_number"]?>
  </font></p>
<h3><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><u>Client Information</u></font></h3>
<p> 
<blockquote><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
  <?=$rs["client_first_name"]?>
  <? if ($rs["client_middle_initial"] != "") {?>
  <?=$rs["client_middle_initial"]?>
  <? }?>
  <?=$rs["client_last_name"]?>
  <br>
  <? if ($rs["company_name"] != "") {?>
  <?=$rs["company_name"]?>
  <br>
  <? }?>
  Address:<br>
  </font> 
  <blockquote> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
    <?=$rs["company_address_1"]?>
    <br>
    <? if ($rs["company_address_2"] != "") {?>
    <?=$rs["company_address_2"]?>
    <br>
    <? }?>
    <?=$rs["company_city"]?>
    , 
    <? if ($rs["company_state"] != "") {?>
    <?=$rs["company_state"]?>
    <? } else {?>
    <?=$rs["company_province"]?>
    <? }?>
    <?=$rs["company_zip"]?>
    <br>
    <?=$rs["company_country"]?>
    </font></blockquote>
  <font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Phone: 
  <?=$rs["company_phone"]?>
  <br>
  <? if ($rs["company_fax"] != "") {?>
  <?=$rs["company_fax"]?>
  <br>
  <? }?>
  Email: 
  <a href="mailto:<?=$rs["company_email"]?>"><?=$rs["company_email"]?></a>
  </font></blockquote>
<h3><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><u>Billing Information</u></font></h3>
<p> 
<blockquote> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
  <?=$rs["billing_first_name"]?>
  <? if ($rs["billing_middle_initial"] != "") {?>
  <?=$rs["billing_middle_initial"]?>
  <? }?>
  <?=$rs["billing_last_name"]?>
  <br>
  Address:<br>
  </font> 
  <blockquote> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
    <?=$rs["billing_address_1"]?>
    <br>
    <? if ($rs["billing_address_2"] != "") {?>
    <?=$rs["billing_address_2"]?>
    <br>
    <? }?>
    <?=$rs["billing_city"]?>
    , 
    <? if ($rs["billing_state"] != "") {?>
    <?=$rs["billing_state"]?>
    <? } else {?>
    <?=$rs["billing_province"]?>
    <? }?>
    <?=$rs["billing_zip"]?>
    <br>
    <?=$rs["billing_country"]?>
    </font></blockquote>
  <font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Phone: 
  <?=$rs["billing_phone"]?>
  <br>
  Payment Type: 
  <?=$rs["payment_type"]?>
  <br>
  Account Number: 
  <?=$rs["account_number"]?>
  <br>
  Credit Card Exp. Date: 
  <?=$rs["cc_exp_date"]?>
  <br>
  Credit Card Ver Code: 
  <?=$rs["cc_ver_code"]?>
  </font></blockquote> 
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Additional 
  Options</b></font></p>
<ul>
  <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
  <? for($i=0;$i<count($rs["additional_options"]);$i++) {?>
  <?=$rs["additional_options"]?>
  <? }?>
  </font> 
</ul>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Package:</b> 
  <?=$rs["subscription_package"]?></font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Domain name:</b> <a href="http://<?=$rs["domain_name"]?>" target="new_window"><?=$rs["domain_name"]?></a>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Domain status:</b> 
  <?=$rs["domain_status"]?>
  </font>
<p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Sales ID: </font></strong>
	<font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
  <? if (isset($rs["sales_id"])) {?><?=$rs["sales_id"]?><? }?>
  </font></p>
<p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Referral ID:</font></b> 
  <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
  <?=$rs["referral_id"]?>
  </font></p>
<p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Trial ID:</font></b> 
  <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
  <?=$rs["trial_id"]?>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>One time setup 
  fee</b>: $ 
  <? printf("%01.2f",$rs["one_time_setup_fee"]);?>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Recurring monthly 
  fee</b>: $ 
  <? printf("%01.2f",$rs["recurring_monthly_fee"]);?>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Total:</b> 
  $ 
  <? printf("%01.2f",($rs["one_time_setup_fee"] + $rs["recurring_monthly_fee"]));?>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Order status:</b> 
  <?=$rs["order_status"]?>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Build status:</b> <?=$rs["build_status"]?>
  </font>
<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">|<a href="manage_order.php">Back</a>|</font> 
</body>
</html>
