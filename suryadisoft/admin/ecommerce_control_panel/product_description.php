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
$query = "SELECT PRODUCT_NAME, PRODUCT_DESCRIPTION FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
$query_result = mysql_query($query);
$rs = mysql_fetch_row($query_result);
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Product Description</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

<h1><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product 
  Description</font> </h1>

<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Name:</font> 
  <?=$rs[0]?>
</p>

<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Description:</font></p>

<p>
  <?=$rs[1]?>
</p>

<p align="center"><a href="product.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a></p>

</body>
</html>
