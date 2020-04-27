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
	$query = "SELECT group_name FROM PRODUCT_GROUP ORDER BY group_name";
	$query_result = mysql_query($query);
	while ($rs = mysql_fetch_row($query_result))
		$product_group[] = $rs[0];
	$query = "SELECT product_id,product_name FROM PRODUCT ORDER BY product_name";
	$query_result = mysql_query($query);
	while ($rs = mysql_fetch_row($query_result)) {
		$product ["id"] = $rs[0];
		$product ["name"] = $rs[1];
		$products[] = $product;
	}
	
	if (!isset($selected_product_group)) {
		if (isset($product_group))
			$selected_product_group = $product_group[0];
		else
			$selected_product_group = "";
	} else {
		$selected_product_group = stripslashes(urldecode($selected_product_group));
	}
	
	if ($selected_product_group != "") {
		$product_group_table = strtoupper(str_replace(" ","_",$selected_product_group));
		$product_group_table = strtoupper(str_replace("(","",$product_group_table));
		$product_group_table = strtoupper(str_replace(")","",$product_group_table));
		$product_group_table = strtoupper(str_replace("&","",$product_group_table));
		$product_group_table = strtoupper(str_replace("'","",$product_group_table));
		$product_group_table = strtoupper(str_replace("\\","",$product_group_table));
		$product_group_table = strtoupper(str_replace("?","",$product_group_table));
		$product_group_table = strtoupper(str_replace("!","",$product_group_table));
		$query = "SELECT " . $product_group_table . ".product_id, PRODUCT.product_name FROM $product_group_table, PRODUCT WHERE " . $product_group_table . ".product_id = PRODUCT.product_id ORDER BY " . $product_group_table . ".sequence";
		$query_result = mysql_query($query);
		while ($rs = mysql_fetch_row($query_result)) {
			$group_product ["id"] = $rs[0];
			$group_product ["name"] = $rs[1];
			$group_products[] = $group_product;
		}
	}
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Feature Product</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function changeProductGroup(form,value) {
	form.selected_product_group.value = value;
	form.action = "group_product.php";
	form.method = "POST";
	form.submit();
}
function setAction(form,action) {
	form.Action.value = action;
}
</script>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<p><strong><a href="product_group.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
  Product Group</font></a> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&gt; 
  <font color="00AEEF">Add Product To Group</font></font></strong> </p>
<p align="center"><a href="order_group_product.php?Action=Add"><img src="../../images/order_product_in_group.gif" alt="Order Product In Group" border="0"></a> 
</p>
<form name="featureProductForm" method="post" action="group_product_result.php">
	<input type="hidden" name="Action" value="Add">
	<input type="hidden" name="selected_product_group" value="<?=$selected_product_group?>">
  <p><strong>Product Group:</strong> 
    <select name="select" onChange="changeProductGroup(this.form,this.value);">
			<? for($i=0;$i<count($product_group);$i++) {?>
			<option value="<?=$product_group[$i]?>" <? if (stripslashes($selected_product_group) == $product_group[$i]) {?>selected<? }?>><?=$product_group[$i]?></option>
			<? }?>
    </select>
  </p>
  <table border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td align="center" nowrap><strong>Product List</strong></td>
      <td>&nbsp;</td>
      <td align="center" nowrap><strong> 
        <?=stripslashes($selected_product_group)?>
        </strong></td>
    </tr>
    <tr> 
      <td>
				<select name="product_list[]" size="20" multiple>
      		<? for($i=0;$i<count($products);$i++) {
						$product = $products[$i];?>
					<option value="<?=$product["id"]?>"><?=$product["name"]?></option>
					<? }?>
				</select>
			</td>
      <td align="center">
<p> 
          <input name="AddButton" type="submit" id="AddButton" value="Add &gt;&gt;" onClick="setAction(this.form,'Add');">
        </p>
        <p> 
          <input name="DeleteButton" type="submit" id="DeleteButton" value="&lt;&lt; Delete" onClick="setAction(this.form,'Delete');">
        </p></td>
      <td>
				<select name="group_product_list[]" size="20" multiple>
        	<? for($i=0;$i<count($group_products);$i++) {
						$group_product = $group_products[$i];?>
					<option value="<?=$group_product["id"]?>"><?=$group_product["name"]?></option>
					<? }?>
				</select>
			</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p align="center"><a href="order_group_product.php?Action=Add"><img src="../../images/order_product_in_group.gif" alt="Order Product In Group" border="0"></a> 
</p>
</body>
</html>
