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
	if (isset($Action) && $Action == "Update")
		$query = "SELECT * FROM PRODUCT_GROUP WHERE group_name = '$group_name'";
	else
		$query = "SELECT * FROM PRODUCT_GROUP";	
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"PRODUCT_GROUP");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editProductGroup(form,group_name) {
	form.Action.value = "Update";
	form.group_name.value = group_name;
	form.submit();
}

function deleteProductGroup(form,group_name) {
	form.action = "product_group_result.php";
	form.Action.value = "Delete";
	form.group_name.value = group_name;
	form.submit();
}

function cleanProductGroup(form,group_name) {
	form.action = "product_group_result.php";
	form.Action.value = "Clean";
	form.group_name.value = group_name;
	form.submit();
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.group_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Group Name is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td>
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
  Product Group</strong></font>
</td><td align="right">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#product_group','user','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</td></tr>
</table>
<p>
  <? if (isset($Action)) {?>
</p>
<form action="product_group_result.php" method="post" name="productGroupForm" id="productGroupForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
	<? if (isset($Mode)) {?>
	<input type="hidden" name="Mode" value="<?=$Mode?>">
	<? }?>
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_group_name" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
			<tr>
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=ucwords(str_replace("_"," ",$field_name[$i]))?>:</font></td>
      <td><input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>"></td>
			</tr>
			<? }?>
		</table>
		<p>&nbsp;</p>
  <p> 
			
    <input type="submit" name="Submit" value="<?=$Action?> Product Group" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<p align="center"> <a href="product_group.php?Action=Add"><img src="../../images/new_product_group.gif" alt="New Product Group" border="0"></a>&nbsp; 
  <a href="group_product.php?Action=Add"><img src="../../images/add_product_to_group.gif" alt="Add Product To Group" border="0"></a>&nbsp; 
  <a href="order_group_product.php?Action=Add"><img src="../../images/order_product_in_group.gif" alt="Order Product In Group" border="0"></a> 
</p>
<p align="center">
<form method="post" action="product_group.php">
<input type="hidden" name="Action" value="">
<input type="hidden" name="group_name" value="">
<? if (isset($Mode)) {?>
<input type="hidden" name="Mode" value="<?=$Mode?>">
<? }?>
<table border="0" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
		<th bgcolor="#999999" nowrap> 
      <font size="-1" color="#ffffff" face="Verdana, Arial, Helvetica, sans-serif"><?=strtoupper(str_replace("_"," ",$field_name[$i]))?></font>
    </th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
     		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<a href="group_product.php?selected_product_group=<?=urlencode($rs[$i])?>"><?=$rs[$i]?></a>
				</font>
			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editProductGroup(this.form,'<?=addslashes($rs[0])?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteProductGroup(this.form,'<?=addslashes($rs[0])?>');"></td>
		<td><input name="Clean" type="button" id="Clean" value="Clean" onClick="cleanProductGroup(this.form,'<?=addslashes($rs[0])?>');"></td>
	</tr>
	<? }?>
</form>
</table>
<p>
<center>
    <a href="product_group.php?Action=Add"><img src="../../images/new_product_group.gif" alt="New Product Group" border="0"></a>&nbsp; 
    <a href="group_product.php?Action=Add"><img src="../../images/add_product_to_group.gif" alt="Add Product To Group" border="0"></a>&nbsp; 
    <a href="order_group_product.php?Action=Add"><img src="../../images/order_product_in_group.gif" alt="Order Product In Group" border="0"></a> 
  </center>
</p>
<? }?>
</body>
</html>
