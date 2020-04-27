<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$admin = $HTTP_SESSION_VARS["admin_user"];
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	$HTTP_SESSION_VARS["db_connect"]->close();
	$admin->retrieveAdminInfo($userid);
	
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT PROPERTY_NAME, PROPERTY_VALUE FROM PROPERTY";
	$query_result = mysql_query($query);
	$prop = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$prop[$rs[0]] = $rs[1];
	}
	$HTTP_SESSION_VARS["db_connect"]->close();
} ?>
<html>
<head>
<title>Technical Support</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Change FTP  Password 
</strong></font> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  </font><form name="supportForm" method="post" action="change_ftp_password_result.php">
  <p align="left"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>FTP Username:</strong>    
    <input name="ftp_username" type="text" id="ftp_username" value="<?=(isset($prop["ftp_username"]))?$prop["ftp_username"]:substr($admin->getUserId(),0,8) . ((substr($admin->getUserId(),0,8) == "demo")?"0":"")?>">
    </font></p>
  <p align="left"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>FTP Password:</strong>    
    <input name="ftp_password" type="text" id="ftp_password" value="<?=(isset($prop["ftp_password"]))?$prop["ftp_password"]:$admin->getPassword() . ((substr($admin->getUserId(),0,8) == "demo")?"0":"")?>">
    </font>  </p>
  <p> 
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><input type="submit" name="Submit" value="Change FTP Password">
      <input type="reset" name="Submit2" value="Reset">
    </font></p>
  </form>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><p align="left">&nbsp;</p>
</font> 
</body>
</html>
