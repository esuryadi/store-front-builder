<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = "SELECT product_id,product_name FROM PRODUCT ORDER BY product_name";
$query_result = mysql_query($query);
while ($rs = mysql_fetch_row($query_result)) {
	$product ["id"] = $rs[0];
	$product ["name"] = $rs[1];
	$products[] = $product;
}

if (isset($action) && $action == "update") {
	$query = "SELECT * from GROUP_SHIPPING_RATE WHERE group_name = '$groupName'";
	$query_result = mysql_query($query);
	$rs = mysql_fetch_row($query_result);
	$prod = split(",", $rs[1]);
	for ($i=0;$i<count($prod);$i++) {
		$sql = "SELECT product_name FROM PRODUCT WHERE product_id = " . $prod[$i];
		$rs2 = mysql_fetch_row(mysql_query($sql));
		$selectedProduct ["id"] = $prod[$i];
		$selectedProduct ["name"] = $rs2[0];
		$selectedProducts [$i] = $selectedProduct;
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Group Shipping Rate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<script language="javascript">
<!--

function addProduct(form) {
	if (form.products.selectedIndex != -1) {
		var text = form.products.options[form.products.selectedIndex].text;
		var value = form.products.options[form.products.selectedIndex].value;
		var selectedProducts = new Option(text, value);
		form["selectedProducts[]"].options[form["selectedProducts[]"].options.length] = selectedProducts;
	}
}

function removeProduct(form) {
	if (form["selectedProducts[]"].selectedIndex != -1) {
		form["selectedProducts[]"].options[form["selectedProducts[]"].selectedIndex] = null;
	}
}

function selectProducts(form) {
	for (i=0;i<form["selectedProducts[]"].options.length;i++) {
		form["selectedProducts[]"].options[i].selected = true;
	}
	event.returnValue = true;
}

-->
</script>

<body vlink="00aeef">

<p>
  <font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Group Shipping</strong></font> 
</p>

<p>
  <form name="groupShippingRateForm" action="group_shipping_rate_action.php" method="post">
  <input name="action" type="hidden" value="<?=$action?>">
  <table align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><strong>Group Name:</strong></td>
	<td><input type="text" name="groupName" value="<? if (isset($action) && $action == "update") {?><?=$rs[0]?><? }?>" size="40"></td>
  </tr>
  <tr>
    <td valign="top"><strong>Group Products:</strong></td>
	<td>
	  <table cellpadding="5" cellspacing="0">
	  <tr>
	    <td>
		  <select name="products" size="10">
		  <? for($i=0;$i<count($products);$i++) {
			$product = $products[$i];?>
		  <option value="<?=$product["id"]?>"><?=$product["name"]?></option>
	 	  <? }?>
		  </select>
		</td>
		<td valign="middle">
		  <input type="button" name="addButton" value=">>" onClick="addProduct(this.form);"><br>
		  <input type="button" name="removeButton" value="<<" onClick="removeProduct(this.form);">
		</td>
		<td>
		  <select name="selectedProducts[]" size="10" multiple>
		  <? if (isset($action) && $action == "update") {?>
		  <? for($i=0;$i<count($selectedProducts);$i++) {
			$selectedProduct = $selectedProducts[$i];?>
		  <option value="<?=$selectedProduct["id"]?>"><?=$selectedProduct["name"]?></option>
		  <? }?>
		  <? }?>
		  </select>
		</td>
	  </tr>
	  </table>
	</td>
  </tr>
  <tr>
    <td><strong>Group Shipping Rate:</strong></td>
	<td>$ <input type="text" name="groupShippingRate" value="<? if (isset($action) && $action == "update") {?><?=$rs[2]?><? }?>" size="5"></td>
  </tr>
  <tr>
    <td><strong>Minimum Order:</strong></td>
	<td>$ <input type="text" name="minimumOrder" value="<? if (isset($action) && $action == "update") {?><?=$rs[3]?><? }?>" size="5"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2">
	  <? if (isset($action) && $action == "add") {?>
	  <input type="submit" name="addGroupButton" value="Add Group" onClick="selectProducts(form);"> 
	  <? } else if (isset($action) && $action == "update") {?>
	  <input type="submit" name="updateGroupButton" value="Update Group" onClick="selectProducts(form);">	
	  <? }?>
	</td>
  </tr>
  </table>
  </form>
</p>

</body>
</html>
