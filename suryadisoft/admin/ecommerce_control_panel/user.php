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
		$query = "SELECT * FROM USER WHERE USER_ID = '$user_id'";
	else
		$query = "SELECT * FROM USER";	
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"USER");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editUser(id) {
	var url = "user.php?Action=Update&user_id=" + id;
	open(url,"_self");
}

function deleteUser(id) {
	var url = "user_result.php?Action=Delete&user_id=" + id;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.user_id.value == "") {
		is_valid = false;
		err_msg = err_msg + "User ID is required\n";
	}
	if (form.user_password.value == "") {
		is_valid = false;
		err_msg = err_msg + "User Password is required\n";
	}
	if (form.user_email.value == "") {
		is_valid = false;
		err_msg = err_msg + "User Password is required\n";
	}
	if (form.user_first_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "User First Name is required\n";
	}
	if (form.user_last_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "User Last Name is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
  User</strong></font> </p>
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#user','user','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>
  <? if (isset($Action)) {?>
</p>
<form action="user_result.php?" method="post" name="userForm" id="userForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_user_id" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
			<tr>
				<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=str_replace("_"," ",$field_name[$i])?>
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
			<input type="submit" name="Submit" value="<?=$Action?> User" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<p align="center"><a href="user.php?Action=Create"><img src="../../images/new_user.gif" width="72" height="21" border="0"></a></p>
<p align="center">
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
     <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$rs[$i]?></font>
			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editUser('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteUser('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
    <a href="user.php?Action=Create"><img src="../../images/new_user.gif" width="72" height="21" border="0"></a>
  </center>
</p>
<? }?>
</body>
</html>
