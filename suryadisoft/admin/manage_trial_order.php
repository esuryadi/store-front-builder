<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Admin.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM TRIAL_ORDER WHERE id = '$id'";
else if (isset($Action) && $Action == "Create")
	$query = "SELECT * FROM TRIAL_ORDER";
else
	$query = "SELECT id,user_id,first_name,last_name,email,order_date FROM TRIAL_ORDER";	
$query_result = mysql_query($query);

$field_list = $query_result;
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();

$admin = new Admin();
?>
<title>Manage Trial Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editUser(id) {
	var url = "manage_trial_order.php?Action=Update&id=" + id;
	open(url,"_self");
}

function deleteUser(id) {
	var url = "manage_trial_order_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.first_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "First Name is required\n";
	}
	if (form.last_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Last Name is required\n";
	}
	if (form.address_1.value == "") {
		is_valid = false;
		err_msg = err_msg + "Address 1 is required\n";
	}
	if (form.city.value == "") {
		is_valid = false;
		err_msg = err_msg + "City is required\n";
	}
	if (form.zip.value == "") {
		is_valid = false;
		err_msg = err_msg + "Zip is required\n";
	}
	if (form.country.value == "") {
		is_valid = false;
		err_msg = err_msg + "Country is required\n";
	}
	if (form.phone.value == "") {
		is_valid = false;
		err_msg = err_msg + "Phone is required\n";
	}
	if (form.email.value == "") {
		is_valid = false;
		err_msg = err_msg + "Email is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<table width="100%"  border="0">
<tr> 
	<td>
	<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Trial Order</strong></font> 
	<p> 
  <? if (isset($Action)) {?>
  <form action="manage_trial_order_result.php" method="post" name="adminForm" id="adminForm">
	<input type="hidden" name="Action" value="<?=$Action?>">
	<table cellpadding="5" cellspacing="5">
	<? if ($Action == "Update") {
	$rs = mysql_fetch_row($query_result);?>
	<? }?>			 
	<? for($i=0;$i<count($field_name);$i++) {?>
	<? if ($field_name[$i] != "user_id" && $field_name[$i] != "build_status") {?> 
	<tr>
		<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
    <td align="right" nowrap>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
    <?=str_replace("_"," ",$field_name[$i])?>:</font></td>
    <td>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
		<? if ($field_name[$i] == "state") {
			$state = $admin->getState("United States");?>
			<select name="<?=$field_name[$i]?>">
			<? for ($n=0;$n<count($state);$n++) {
				$name = $state[$n];?>
			<option value="<?=$name["short"]?>" <? if ($Action == "Update" && $rs[$i] == $name["short"]) {?>selected<? }?>><?=$name["short"]?>-<?=$name["long"]?></option>
			<? }?>
			</select>
		<? } else if ($field_name[$i] == "order_date") {?>
			<?=date("Y-m-d")?>
			<input type="hidden" name="<?=$field_name[$i]?>" value="<?=date("Y-m-d")?>">
		<? } else {?>
			<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? } else if ($field_name[$i] == "country") {?>United States<? }?>" <? if ($i == 4) {?>size="40"<? } else if ($i == 5) {?>size="40"<? }?>>
		<? }?>
    </font>
		</td>
		<? } else {?>
		<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
		<? }?>
	</tr>
	<? }?>
	<? }?>
	</table>
	<p> 
	<input type="submit" name="Submit" value="<?=$Action?> Trial Order" onClick="validateForm(this.form);">
	<input name="Reset" type="reset" id="Reset" value="Reset">
	</form>
	<? } else {?>
	<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
  	      <td><a href="manage_trial_order.php?Action=Create"><img src="../images/new_trail_order.gif" alt="New Trial Order" width="111" height="21" border="0"></a></td>
  </tr>
  </table>
	<p align="center">
  <table border="0" align="center" cellpadding="8" cellspacing="0">
	<tr>
	<? for($i=0;$i<count($field_name);$i++) {?>
	<? if ($field_name[$i] != "id") {?>
	  <th valign="bottom" bgcolor="#999999"> 
		<font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
    </font>
		</th>
	<? }?>
	<? }?>
		<th valign="bottom" bgcolor="#999999"><font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif">STATUS</font></th>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<? $order_date = strtotime($rs[5]);
		 $cur_date = strtotime(date("Y-m-d"));
		 $days = ($cur_date - $order_date)/(60*60*24);?>	
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
		<? if ($field_name[$i] != "id") {?>
		<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
		<? if	($field_name[$i] == "email") {?>
		<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a> 
		<? } else if($field_name[$i] == "user_id") {?>
		<a href="trial_order_info.php?id=<?=$rs[0]?>"><?=$rs[$i]?></a> 
		<? } else {?>
		<?=$rs[$i]?>
		<? }?>
		</font>
		</td>
		<? }?>
    <? }?>
		<td>
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<? if ($days > 10) {?>Expired<? } else {?>Active<? }?>
			</font>
		</td>
    <td><input name="Update" type="button" id="Update" value="Edit" onClick="editUser('<?=$rs[0]?>');"></td>
		<? if ($rs[0] != "admin") {?>
    <td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteUser('<?=$rs[0]?>');"></td>
		<? }?>
	</tr>
	<? }?>
	</table>
	<p>
	<center>
  <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
  	        <td><a href="manage_trial_order.php?Action=Create"><img src="../images/new_trail_order.gif" alt="New Trial Order" width="111" height="21" border="0"></a></td>
   </tr>
   </table>
   </center>
	<? }?>
	</td>
</tr>
</table>
</body>
</html>
