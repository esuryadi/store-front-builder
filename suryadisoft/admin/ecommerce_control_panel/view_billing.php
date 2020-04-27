<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT * FROM BILLING WHERE billing_id = $billing_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>View Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Bill To:</b> </font> 
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
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="transaction.php">Back</a></font></p>

</body>
</html>
