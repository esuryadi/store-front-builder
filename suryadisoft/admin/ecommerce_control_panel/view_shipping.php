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
$query = "SELECT * FROM SHIPPING WHERE SHIPPING_ID = $shipping_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>View Shipping</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<b><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Ship To:</font></b> 
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
  </font> </blockquote>

<p align="center"><a href="transaction.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a></p>

</body>
</html>
