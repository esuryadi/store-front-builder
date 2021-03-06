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
	if (isset($Action) && $Action == "Update")
		$query = "SELECT * FROM PRODUCT_COUPON WHERE COUPON_ID = '$coupon_id'";
	else
		$query = "SELECT * FROM PRODUCT_COUPON";	
	$query_result = mysql_query($query);
	
	$query1 = "SELECT PRODUCT_ID, PRODUCT_NAME FROM PRODUCT ORDER BY PRODUCT_NAME";
	$query_result1 = mysql_query($query1);
	$products = Array();
	while ($rs = mysql_fetch_row($query_result1)) {
		$product["id"] = $rs[0];
		$product["name"] = $rs[1];
		$products[] = $product;
	}
						
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"PRODUCT_COUPON");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Product Coupon</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editProductCoupon(id) {
	var url = "product_coupon.php?Action=Update&coupon_id=" + id;
	open(url,"_self");
}

function deleteProductCoupon(id) {
	var url = "product_coupon_result.php?Action=Delete&coupon_id=" + id;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.coupon_id.value == "") {
		is_valid = false;
		err_msg = err_msg + "Coupon ID is required\n";
	}
	if (form.product_id.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product ID is required\n";
	}
	if (form.discount_type.value == "") {
		is_valid = false;
		err_msg = err_msg + "Discount Type is required\n";
	}
	if (form.coupon_value.value == "") {
		is_valid = false;
		err_msg = err_msg + "User First Name is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
  Product Coupon</strong></font> </p>
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#user','user','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p></p>
<? if (isset($Action)) {?>
<form action="product_coupon_result.php?" method="post" name="userForm" id="userForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
	<table cellpadding="5" cellspacing="5">
	<? if ($Action == "Update") {
		$rs = mysql_fetch_row($query_result);?>
		<input type="hidden" name="old_coupon_id" value="<?=$rs[0]?>">
	<? }?>			 
	<? for($i=0;$i<count($field_name);$i++) {?>
	<tr>
		<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
		<td align="right">
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<?=ucwords(str_replace("_"," ",$field_name[$i]))?>:
			</font>
		</td>
		<td>
			<? if ($field_name[$i] == "discount_type") {?>
			<select name="<?=$field_name[$i]?>">
			<option value="percentage" <? if ($Action == "Update" && $rs[$i] == "percentage") {?>selected<? }?>>percentage</option>
			<option value="fixed value" <? if ($Action == "Update" && $rs[$i] == "fixed value") {?>selected<? }?>>fixed value</option>
			</select>
			<? } else if ($field_name[$i] == "product_id") {?>
			<select name="<?=$field_name[$i]?>">
			<option value="">- Select Product -</option>
			<option value="0" <? if ($Action == "Update" && $rs[$i] == 0) {?>selected<? }?>>All Products</option>
			<? for ($n=0;$n<count($products);$n++) {
				$product = $products[$n]?>
			<option value="<?=$product["id"]?>" <? if ($Action == "Update" && $product["id"] == $rs[$i]) {?>selected<? }?>> 
			<?=$product["name"]?>
			</option>
			<? }?>
       </select>
			<? } else {?> 
			<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>" <? if ($field_name[$i] == "exp_date") {?>size="10" maxlength="10"<? }?>> 
			<? }?>
			<? if ($field_name[$i] == "exp_date") {?>
			(Date Format is YYYY-MM-DD, e.g. 2003-12-31)
			<? }?>
		</td>
		<? } else {?>
		<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
		<? }?>
	</tr>
	<? }?>
	</table>
	<p>* If you want the product coupon to be deleted as soon as it is used, just leave the Exp Date field blank</p>
  <p> 
	<input type="submit" name="Submit" value="<?=$Action?> Product Coupon" onClick="validateForm(this.form);">
	<input name="Reset" type="reset" id="Reset" value="Reset">
	</p>
</form>
<? } else {?>
<p align="center"><a href="product_coupon.php?Action=Add">New Coupon</a></p>
<p align="center">
<table border="0" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
		<th bgcolor="#999999" nowrap> 
      <font size="-1" color="#ffffff" face="Verdana, Arial, Helvetica, sans-serif">
			<? if ($i == 1) {?>
			PRODUCT NAME
			<? } else {?>
			<?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
			<? }?>
			</font>
    </th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if ((stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) && $i != 1) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
     	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		 	<? if ($i == 1) {?>
				<? if ($rs[$i] != 0) {?>
			 	<? $product = new Product();			
				$prod = $product->getProduct($rs[$i]);?>
				<?=$prod["name"]?>
				<? } else {?>
				All Products
				<? }?>
			<? } else {?>
		 	<?=$rs[$i]?>
		 	<? }?>
		 	</font>
			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editProductCoupon('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteProductCoupon('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
    <a href="product_coupon.php?Action=Add">New Coupon</a>
  </center>
</p>
<? }?>
</body>
</html>
