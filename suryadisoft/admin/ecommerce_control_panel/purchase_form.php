<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Product.php";
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
	define("_DB",$HTTP_SESSION_VARS["selected_db"]);
	
	$query1 = "SELECT PRODUCT_ID, PRODUCT_NAME FROM PRODUCT ORDER BY PRODUCT_NAME";
	$query_result1 = mysql_query($query1);
	$products = Array();
	while ($rs = mysql_fetch_row($query_result1)) {
		$product["id"] = $rs[0];
		$product["name"] = $rs[1];
		$products[] = $product;
	}
	
	if (isset($Action) && $Action == "Update") {
	
		$query = "SELECT PRODUCT.PRODUCT_ID, PURCHASE.PRODUCT_COLOR, PURCHASE.PRODUCT_SIZE, PURCHASE.PRODUCT_CHOICE, PURCHASE_QUANTITY, PURCHASE_CHARGE FROM PURCHASE, PRODUCT WHERE PRODUCT.PRODUCT_ID = PURCHASE.PRODUCT_ID AND TRANSACTION_ID = $transaction_id AND PURCHASE_ID = $purchase_id";
	
		$query_result = mysql_query($query);
		
		$rs = mysql_fetch_row($query_result);
		$purchase["product_id"] = $rs[0];
		$purchase["product_color"] = $rs[1];
		$purchase["product_size"] = $rs[2];
		$purchase["product_choice"] = $rs[3];
		$purchase["qty"] = $rs[4];
		$purchase["charge"] = $rs[5];
								
	}		
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Product Coupon</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.purchaseQuantity.value == "") {
		is_valid = false;
		err_msg = err_msg + "Purchase quantity is required\n";
	}
	if (form.purchaseCharge.value == "") {
		is_valid = false;
		err_msg = err_msg + "Purchase charge is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Purchase Detail Information</strong></font> </p>
<p></p>
<form action="purchase_form_action.php?" method="post" name="userForm" id="userForm">
<input type="hidden" name="Action" value="<?=$Action?>">
<input type="hidden" name="customerId" value="<?=$customer_id?>">
<input type="hidden" name="transactionId" value="<?=$transaction_id?>">
<input type="hidden" name="purchaseId" value="<?=$purchase_id?>">
<table cellpadding="5" cellspacing="5">
<tr>
	<td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		Product Name:
		</font>
	</td>
	<td>
		<select name="productId">
			<option value="">- Select Product -</option>
			<? for ($n=0;$n<count($products);$n++) {
				$product = $products[$n]?>
			<option value="<?=$product["id"]?>" <? if ($Action == "Update" && $purchase["product_id"] == $product["id"]) {?>selected<? }?>> 
			<?=$product["name"]?>
			</option>
			<? }?>
       	</select>
	</td>
</tr>
<tr>
	<td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		Product Color:
		</font>
	</td>
	<td>
		<input type="text" name="productColor" value="<? if ($Action == "Update") {?><?=$purchase["product_color"]?><? }?>"/>
	</td>
</tr>
<tr>
	<td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		Product Size:
		</font>
	</td>
	<td>
		<input type="text" name="productSize" value="<? if ($Action == "Update") {?><?=$purchase["product_size"]?><? }?>"/>
	</td>
</tr>
<tr>	
	<td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		Product Choice:
		</font>
	</td>
	<td>
		<input type="text" name="productChoice" value="<? if ($Action == "Update") {?><?=$purchase["product_choice"]?><? }?>"/>
	</td>
</tr>
<tr>
	<td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		Purchase Quantity:
		</font>
	</td>
	<td>
		<input type="text" name="purchaseQuantity" value="<? if ($Action == "Update") {?><?=$purchase["qty"]?><? }?>"/>
	</td>
</tr>
<tr>	
	<td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		Purchase Charge:
		</font>
	</td>
	<td>
		<input type="text" name="purchaseCharge" value="<? if ($Action == "Update") {?><?=$purchase["charge"]?><? }?>"/>
	</td>
</tr>
</table>
<p> 
<input type="submit" name="Submit" value="<?=$Action?>" onClick="validateForm(this.form);">
<input name="Reset" type="reset" id="Reset" value="Reset">
</p>
</form>
</body>
</html>
