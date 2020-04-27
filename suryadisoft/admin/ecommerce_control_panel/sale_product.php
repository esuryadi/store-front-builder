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
if (isset($Action) && $Action == "Update") {
	for ($i=0;$i<count($product_id);$i++) {
		$query = "UPDATE SALE_PRODUCT SET SEQUENCE = $sequence[$i] WHERE PRODUCT_ID = $product_id[$i]";
		mysql_query($query);
	}
}
$query = "SELECT PRODUCT.PRODUCT_ID, PRODUCT.PRODUCT_NAME, SALE_PRODUCT.SEQUENCE FROM PRODUCT, SALE_PRODUCT WHERE PRODUCT.PRODUCT_ID = SALE_PRODUCT.PRODUCT_ID ORDER BY SALE_PRODUCT.SEQUENCE";
$query_result = mysql_query($query);
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>On Sale Product</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<strong><a href="product.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
Product/Inventory</font></a> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&gt; 
<font color="00AEEF">On Sale Product</font></font></strong> 
<form name="saleProductForm" method="post" action="sale_product.php">

  <table border="1" cellpadding="3" cellspacing="0" bordercolor="#dddddd">

    <tr>

			
      <td nowrap bgcolor="#dddddd"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Product 
        Name</strong></font></td>

			
      <td nowrap bgcolor="#dddddd"><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Order</font></strong></td>

		</tr>
		<? while($rs = mysql_fetch_row($query_result)) {?>
		<tr>
		<input type="hidden" name="Action" value="Update">
		<input type="hidden" name="product_id[]" value="<?=$rs[0]?>">
      <td nowrap>

        <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$rs[1]?></font>

      </td>
      <td align="center"> 
        <input type="text" name="sequence[]" value=<?=$rs[2]?> size="2">
      </td>
		</tr>
		<? }?>
</table>

  <p> 
  <input type="submit" name="Submit" value="Update">
  <input type="reset" name="Submit2" value="Reset">
</p>
</form>

<a href="product.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a>
</body>
</html>
