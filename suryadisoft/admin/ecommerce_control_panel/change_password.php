<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<html>
<head>
<title>Change Password</title>
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
  Password</strong></font></p>
<p>
<form action="../change_admin_password_result.php?" method="post" name="changePasswordForm" id="changePasswordForm">
	<input type="hidden" name="user_id" value="<?=$HTTP_SESSION_VARS["admin_user"]->getUserId()?>">
	<table cellpadding="5" cellspacing="5">
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
