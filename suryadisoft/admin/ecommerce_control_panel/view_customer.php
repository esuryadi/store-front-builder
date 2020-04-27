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
$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = $customer_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>View Customer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
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
  <p><a href="transaction.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a></p>
</blockquote>
</body>
</html>
