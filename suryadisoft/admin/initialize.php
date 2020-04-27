<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once("config.php");

if (isset($HTTP_SESSION_VARS["admin_user"])) {
	$admin_user = $HTTP_SESSION_VARS["admin_user"];
	$admin_user->retrieveAdminInfo($admin_user->getUserId());
} else {	
	$admin_user = new Admin();
	$admin_user->setUserId($userid);
	$admin_user->setPassword($password);
	$admin_user->retrieveAdminInfo($userid);
}

if (!isset($HTTP_SESSION_VARS["admin_user"]) && $admin_user->getStatus() == "Active" && $admin_user->verify()) {
	if (isset($isStored)) {
		setcookie("admin_user",serialize($admin_user),time() + 100000,"","",0);
	}

	if (!session_is_registered("admin_user"))
		session_register("admin_user");

	Log::writeToFile("log.txt","*** Begin Log: " . date("l, d F Y: h:i:s a T") . " ***\n\n");
}
?>
<html>
<head>
<title>Administrator Control Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if (isset($admin_user) && $admin_user->verify()) {?>
	<? if ($admin_user->getStatus() == "Active") {?>
		<? if ($admin_user->getRole() == "Administrator" || $admin_user->getRole() == "Sales") {?>
			<meta http-equiv="refresh" content="0;URL=control_panel.php">
		<? } else if ($admin_user->getRole() == "User") {?>
			<meta http-equiv="refresh" content="0;URL=ecommerce_control_panel/initialize.php">
		<? }?>
	<? }?>
<? } else {?>
	<meta http-equiv="refresh" content="0;URL=login.php?Status=Failed">
<? }?>

</head>

<body vlink="00aeef">

<? if ($admin_user->getStatus() == "Suspended") {?>
<br><br>

<center>
  <h3><font face="Verdana, Arial, Helvetica, sans-serif">Your account has been 
    suspended!</font></h3>
</center>
<center>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Please contact the Administrator 
  (<a href="mailto:webmaster@suryadisoft.net">webmaster@suryadisoft.net</a>)</font>
</center>
<h3><br>
  <br>
</h3>
<center>
  <a href="login.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back 
  To Login</font></a> 
</center>

<? } else if ($admin_user->getStatus() == "Inactive") {?>
<br><br>

<center>
  <h3><font face="Verdana, Arial, Helvetica, sans-serif">Your account is not active!</font></h3>
</center>
<center>
  <h3><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Please contact 
    the Administrator (<a href="mailto:webmaster@suryadisoft.net">webmaster@suryadisoft.net</a>)</font></h3>
</center>
<h3><br>
  <br>
</h3>
<center>
  <a href="login.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back To Login</font></a> 
</center>

<? }?>
</body>
</html>