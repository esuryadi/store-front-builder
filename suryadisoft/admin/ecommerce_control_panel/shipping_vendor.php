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
		$query = "SELECT * FROM SHIPPING_VENDOR WHERE SHIPPING_VENDOR_ID = $shipping_vendor_id";
	else
		$query = "SELECT * FROM SHIPPING_VENDOR";
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"SHIPPING_VENDOR");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Shipping Vendor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editShippingVendor(id) {
	var url = "shipping_vendor.php?Action=Update&shipping_vendor_id=" + id;
	open(url,"_self");
}

function deleteShippingVendor(id) {
	var url = "shipping_vendor_result.php?Action=Delete&shipping_vendor_id=" + id;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.shipping_vendor_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping Vendor Name is required\n";
	}
	if (form.shipping_vendor_method.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping Vendor Method is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><strong><a href="shipping_rate.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
  Shipping Rates</font></a> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&gt; 
  <font color="00AEEF">Manage Shipping Vendor</font></font></strong> </p>
<p align="right">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#shipping_vendor','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>
  <? if (isset($Action)) {?>
</p>
<form action="shipping_vendor_result.php?" method="post" name="shippingVendorForm" id="userForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update")
				$rs = mysql_fetch_row($query_result);?>
			<? for($i=0;$i<count($field_name);$i++) {?>
			<tr>
				<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?=str_replace("_"," ",$field_name[$i])?>
        :</font></td>
      <td> <input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>"> 
					</td>
				<? } else {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
				<? }?>
			</tr>
			<? }?>
		</table>
		<p>&nbsp;</p>
  <p> 
			<input type="submit" name="Submit" value="<?=$Action?> Shipping Vendor" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<p align="center"><a href="shipping_vendor.php?Action=Add"><img src="../../images/add_new_vendors.gif" width="118" height="21" border="0"></a></p>
<table border="0" align="center" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
			<? if ($i != 0) {?>
    	<td bgcolor="#999999"> <font size="-1" color="#FFFFFF"face="Verdana, Arial, Helvetica, sans-serif"><b>
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?></b>
      </font> </td>
			<? }?>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<? if ($i != 0) {?>
	    <td bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"> 
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$rs[$i]?></font>
			</td>
			<? }?>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editShippingVendor('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteShippingVendor('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
    <a href="shipping_vendor.php?Action=Add"><img src="../../images/add_new_vendors.gif" width="118" height="21" border="0"></a>
  </center>
</p>
<? }?>
</body>
</html>
