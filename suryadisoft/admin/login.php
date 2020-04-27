<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once "config.php";

if (isset($Action) && ($Action == "Logout" || $Action == "DBConnectionFailed")) {
	//session_start();
	session_destroy();
	Log::writeToFile("log.txt","*** End Log: " . date("l, d F Y: h:i:s a T") . " ***\n\n");
}
$user_id = "";
$user_password = "";
if (isset($HTTP_COOKIE_VARS["admin_user"])) {
	$admin_user = unserialize(stripslashes($HTTP_COOKIE_VARS["admin_user"]));
	$user_id = $admin_user->getUserId();
	$user_password = $admin_user->getPassword();
}
?>
<html>
<head>
<title>Administrator Control Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function validateForm(form) {
	var valid = true;
	var err_msg = "";
	
	if (form.userid.value == "") {
		valid = false;
		err_msg = "Username cannot be empty!\n";
	}
	if (form.password.value == "") {
		valid = false;
		err_msg = "Password cannot be empty!\n";
	}
	
	if (!valid)
		alert(err_msg);
		
	event.returnValue = valid;
}
</script>
</head>
<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<center>
  <p align="left"><a href="http://www.suryadisoft.net"><img src="../images/logo_sm_w.png" border="0" alt="suryadisoft"></a></p>
  <table border="0" cellpadding="0" cellspacing="0" bgcolor="#dadada">
    <tr> 
      <td><img src="../images/admin_login_corner-tl.gif" width="15" height="61"></td>
      <td><img src="../images/admin_login_header.gif" width="381" height="61"></td>
      <td><img src="../images/admin_login_corner-tr.gif" width="17" height="61"></td>
    </tr>
    <tr> 
      <td background="../images/admin_login_side-l.gif">&nbsp;</td>
      <td><br>
        <form action="initialize.php" method="post" name="form_login" id="form_login">
          <table width="80%" border="0" align="center" cellpadding="7" cellspacing="0">
            <tr> 
              <td align="right" valign="bottom"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Username:</strong></font></td>
              <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <input name="userid" type="text" id="userid" value="<?=$user_id?>" size="16">
                </font></td>
            </tr>
            <tr> 
              <td align="right" valign="bottom"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Password:</strong></font></td>
              <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <input name="password" type="password" id="password" value="<?=$user_password?>" size="16">
                </font></td>
            </tr>
            <tr align="center"> 
              <td colspan="2"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <input name="isStored2" type="checkbox" id="isStored2">
                <strong><font size="-2">Remember my login and password</font></strong></font></td>
            </tr>
            <tr align="center"> 
              <td colspan="2"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <input type="submit" name="Submit3" value="Login" onClick="validateForm(this.form);">
                <input type="reset" name="Submit22" value="Reset">
                </font></td>
            </tr>
          </table>
        </form></td>
      <td background="../images/admin_login_side-r.gif">&nbsp;</td>
    </tr>
    <tr> 
      <td><img src="../images/admin_login_corner-bl.gif" width="15" height="19"></td>
      <td background="../images/admin_login_bottom.gif">&nbsp;</td>
      <td><img src="../images/admin_login_corner-br.gif" width="17" height="19"></td>
    </tr>
  </table>
  <p><font color="#0000FF" size="-1"><strong><font face="Verdana, Arial, Helvetica, sans-serif">WARNING:
          If you have a Pop Up Blocker installed on your computer, please TURN
          IT OFF.<br>
    This Site Manager requires Pop Up to be enable.</font></strong> </font></p>
  <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">For site
        manager demo: </font></b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><br>
      <b>username:</b> demo<br>
  <b>password:</b> demo</font> </p>
</center>
<p align="center"><a href="http://www.comodogroup.com" target="comodogroup"><img src="../images/site_seal.gif" width="100" height="60" border="0"></a></p>
<p align="right"><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Copyright 
  &copy; 2002 SuryadiSoft. All rights reserved.</font></strong></p>
<script language="JavaScript">
<? if (isset($Status) && $Status == "Failed") {?>
alert("Your user id and password doesn't match!\nPlease try again.");
<? } else if (isset($session_out) && $session_out == "true") {?>
alert("Sorry, session timed-out!\nPlease try to login again.");
<? }?>
window.document.form_login.userid.focus();
</script>
</body>
</html>
