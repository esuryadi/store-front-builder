<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	$query = "SELECT SHOPPING_CART.ID, SHOPPING_CART.USER_ID, PRODUCT.PRODUCT_NAME, SHOPPING_CART.PRODUCT_COLOR, SHOPPING_CART.PRODUCT_SIZE, SHOPPING_CART.PRODUCT_CHOICE, SHOPPING_CART.SHOPPING_CART_QUANTITY FROM SHOPPING_CART, PRODUCT WHERE PRODUCT.PRODUCT_ID = SHOPPING_CART.PRODUCT_ID";	
	$query_result = mysql_query($query);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Shopping Cart</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function deleteItem(id) {
	var url = "shopping_cart_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function emptyShoppingCart() {
	var url = "shopping_cart_result.php?Action=Empty";
	open(url,"_self");
}
</script>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<strong><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
Shopping Cart</font></strong> 
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#shopping_cart','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellpadding="8" cellspacing="0" align="center">
        <tr> 
          <th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">USER 
            ID</font></th>
          <th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">ITEM</font></th>
          <th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">PRODUCT COLOR</font></th>
					<th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">PRODUCT SIZE</font></th>
					<th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">PRODUCT CHOICE</font></th>
					<th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">QUANTITY</font></th>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<? if ($i != 0) {?>
			<td align="<? if (stristr(mysql_field_type($query_result,$i),"INT") || stristr(mysql_field_type($query_result,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">       
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<?=$rs[$i]?>
        </font>			
			</td>
			<? }?>
		<? }?>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteItem('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <center>
    <input type="button" name="empty" value="Empty Shopping Cart" onClick="emptyShoppingCart();">
      </center></td>
  </tr>
</table>
</body>
</html>
