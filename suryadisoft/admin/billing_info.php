<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT * FROM BILLING WHERE user_id = '$user_id'";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);

$db_connect->close();
?>
<html>
<head>
<title>Billing Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>



<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Billing 
Info</strong></font> 
<blockquote> 
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> <b>
    <?=$rs["billing_first_name"]?>
    <?=$rs["billing_last_name"]?>
    </b><br>
    <b>Address:</b><br>
    </font> </p>
  <blockquote>
    <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">
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
      </font> 
		</blockquote>
			
  <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Phone:</b> 
  <?=$rs["billing_phone"]?>
  </font> <br>
  <b>Payment Type:</b> 
  <?=$rs["payment_type"]?>
  <br>
  <b>Account Number:</b> 
  <?=$rs["account_number"]?>
  <br>
  <b>Credit Card Exp. Date:</b> 
  <?=$rs["cc_exp_date"]?></p>
  </blockquote>
</blockquote> 
<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">|<a href="manage_billing.php">Back</a>|</font> 
</body>
</html>
