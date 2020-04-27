<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT user_id FROM USER";
$query_result = mysql_query($query);

while ($rs = mysql_fetch_row($query_result)) {
	$users[] = $rs[0];
}

$db_connect->close();
?>
<title>Change Administrator Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.password.value != form.password2.value) {
		is_valid = false;
		err_msg = err_msg + "Your Re-Enter Password doesn't match with your password\n";
		form.password.value = "";
		form.password2.value = "";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}

</script>
</head>



<body vlink="00aeef">

<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Change 

  Administrator Password</strong></font></p>
<p>
<form action="change_admin_password_result.php?" method="post" name="changePasswordForm" id="changePasswordForm">
	<input type="hidden" name="Action" value="<?=$Action?>">
	<table cellpadding="5" cellspacing="5">
	<tr>
		<td nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">User ID:</font></td>
		<td>
			<select name="user_id">
			<? for($n=0;$n<count($users);$n++) {?>
				<option value="<?=$users[$n]?>"><?=$users[$n]?></option>
			<? }?>
			</select>
		</td>
	</tr>
	<tr>
		<td nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Password:</font></td>
		<td>
			<input type="password" name="password" value="">
		</td>
	</tr>
	<tr>
		  <td nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Re-enter 
        Password:</font></td>
		<td>
			<input type="password" name="password2" value="">
		</td>
	</tr>
	</table>
	<p>
	  <input type="submit" name="Submit" value="Change Password" onClick="validateForm(this.form);">
		<input name="Reset" type="reset" id="Reset" value="Reset">
</form>
</body>
</html>
