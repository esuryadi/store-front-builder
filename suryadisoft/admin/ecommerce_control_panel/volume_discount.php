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
		$query = "SELECT * FROM VOLUME_DISCOUNT WHERE id = '$id'";
	else
		$query = "SELECT * FROM VOLUME_DISCOUNT";	
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"VOLUME_DISCOUNT");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Volume Discount</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editVolumeDiscount(id) {
	var url = "volume_discount.php?Action=Update&id=" + id;
	open(url,"_self");
}

function deleteVolumeDiscount(id) {
	var url = "volume_discount_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.volume_low.value == "") {
		is_valid = false;
		err_msg = err_msg + "Volume Low is required\n";
	}
	if (form.volume_high.value == "") {
		is_valid = false;
		err_msg = err_msg + "Volume High is required\n";
	}
	if (form.discount_rate.value == "") {
		is_valid = false;
		err_msg = err_msg + "Discount Rate is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Volume Discount</strong></font> </p>
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#volume_discount','volume_discount','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p></p>
<? if (isset($Action)) {?>
<form action="volume_discount_result.php?" method="post" name="volumeDiscountForm" id="volumeDiscountForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
	<table cellpadding="5" cellspacing="5">
	<? if ($Action == "Update") {
		$rs = mysql_fetch_row($query_result);?>
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
			<option value="percentage" <? if ($Action == "Update" && $rs[$i] == "percentage") {?>selected<? }?>>Percentage</option>
			<option value="fixed value" <? if ($Action == "Update" && $rs[$i] == "fixed value") {?>selected<? }?>>Fixed Value</option>
			</select>
			<? } else if ($field_name[$i] == "discount_by") {?>
			<select name="<?=$field_name[$i]?>">
			<option value="total purchase" <? if ($Action == "Update" && $rs[$i] == "total purchase") {?>selected<? }?>>Total Purchase</option>
			<option value="total quantity" <? if ($Action == "Update" && $rs[$i] == "total quantity") {?>selected<? }?>>Total Quantity</option>
			</select>
			<? } else {?> 
			<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>"> 
			<? }?>
			<? if ($field_name[$i] == "discount_rate") {?>
			(for percentage, please use the decimal, e.g. 0.05 as 5%)
			<? }?>
		</td>
		<? } else {?>
		<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
		<? }?>
	</tr>
	<? }?>
	</table>
	<p>&nbsp;</p>
  <p> 
	<input type="submit" name="Submit" value="<?=$Action?> Volume Discount" onClick="validateForm(this.form);">
	<input name="Reset" type="reset" id="Reset" value="Reset">
	</p>
</form>
<? } else {?>
<p align="center"><a href="volume_discount.php?Action=Add">New Volume Discount</a></p>
<p align="center">
<table border="0" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
		<th bgcolor="#999999" nowrap> 
      <font size="-1" color="#ffffff" face="Verdana, Arial, Helvetica, sans-serif">
			<?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
			</font>
    </th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if ((stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) && $i != 1) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
     	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		 	<?=$rs[$i]?>
		 	</font>
			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editVolumeDiscount('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteVolumeDiscount('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
    <a href="volume_discount.php?Action=Add">New Volume Discount</a>
  </center>
</p>
<? }?>
</body>
</html>
