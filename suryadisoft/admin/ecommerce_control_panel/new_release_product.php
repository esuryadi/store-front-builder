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
		$query = "UPDATE NEW_RELEASE_PRODUCT SET SEQUENCE = $sequence[$i] WHERE PRODUCT_ID = $product_id[$i]";
		mysql_query($query);
	}
}
$query = "SELECT PRODUCT.PRODUCT_ID, PRODUCT.PRODUCT_NAME, NEW_RELEASE_PRODUCT.SEQUENCE FROM PRODUCT, NEW_RELEASE_PRODUCT WHERE PRODUCT.PRODUCT_ID = NEW_RELEASE_PRODUCT.PRODUCT_ID ORDER BY NEW_RELEASE.SEQUENCE";
$query_result = mysql_query($query);
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>New Release Product</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<strong><font face="Verdana, Arial, Helvetica, sans-serif"><a href="product.php"><font size="-1">Manage 
Product/Inventory</font></a> <font size="-1">&gt; <font color="00AEEF">New Release 
Product</font></font></font></strong> 
<form name="newReleaseProductForm" method="post" action="new_release_product.php">

  <table border="1" cellpadding="3" cellspacing="0" bordercolor="#dddddd">

    <tr>

			
      <td nowrap bgcolor="#dddddd"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Product 
        Name</strong></font></td>

			
      <td bgcolor="#dddddd"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Order</strong></font></td>

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
