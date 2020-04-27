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
	if (!isset($selected_product_group)) {
		if (isset($product_group))
			$selected_product_group = $product_group[0];
		else
			$selected_product_group = "";
	} else {
		$selected_product_group = urldecode($selected_product_group);
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
		if (isset($Action) && $Action == "Update") {
			for ($i=0;$i<count($product_id);$i++) {
				$query = "UPDATE $product_group_table SET SEQUENCE = $sequence[$i] WHERE PRODUCT_ID = $product_id[$i]";
				mysql_query($query);
			}
		}
		$query = "SELECT PRODUCT.product_id, PRODUCT.product_name, " . $product_group_table . ".sequence FROM PRODUCT, $product_group_table WHERE PRODUCT.product_id = " . $product_group_table . ".product_id ORDER BY " . $product_group_table . ".sequence";
		$query_result = mysql_query($query);
	}
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title><?=$selected_product_group?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function changeProductGroup(form,value) {
	form.selected_product_group.value = value;
	form.action = "order_group_product.php";
	form.method = "POST";
	form.submit();
}
</script>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<p><strong><a href="product_group.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
  Product Group</font></a> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&gt; 
  <font color="00AEEF">Order Product In Group</font></font></strong> </p>
<p align="center"><a href="group_product.php?Action=Add"><img src="../../images/add_product_to_group.gif" alt="Add Product To Group" border="0"></a></p>
<form name="featureProductForm" method="post" action="order_group_product.php">
	<input type="hidden" name="selected_product_group" value="<?=$selected_product_group?>">
  <p><strong>Product Group:</strong> 
    <select name="select" onChange="changeProductGroup(this.form,this.value);">
      <? for($i=0;$i<count($product_group);$i++) {?>
      <option value="<?=$product_group[$i]?>" <? if ($selected_product_group == $product_group[$i]) {?>selected<? }?>> 
      <?=$product_group[$i]?>
      </option>
      <? }?>
    </select>
  </p>
	<? if ($selected_product_group != "") {?>
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
      <td align="center"> <input type="text" name="sequence[]" value=<?=$rs[2]?> size="2"> 
      </td>
		</tr>
		<? }?>
</table>
  <p> 
  <input type="submit" name="Submit" value="Update">
  <input type="reset" name="Submit2" value="Reset">
</p>
</form>
	<? }?>
<p align="center"><a href="group_product.php?Action=Add"><img src="../../images/add_product_to_group.gif" alt="Add Product To Group" border="0"></a></p>
</body>
</html>
