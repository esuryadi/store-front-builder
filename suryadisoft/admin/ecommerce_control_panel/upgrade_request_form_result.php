<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
$rs = mysql_fetch_row(mysql_query($query));
$userid = $rs[0];
$HTTP_SESSION_VARS["db_connect"]->close();	

$admin = new Admin();
$admin->retrieveAdminInfo($userid);
$mail_to = "sales@suryadisoft.net";
$mail_from = "From: " . $admin->getCompanyName() . "<" . $admin->getEmail() . ">";
$mail_subject = "Upgrade Request from " . $admin->getCompanyName();
$mail_body = $admin->getCompanyName() . " request for upgrade:\n\n";

if (isset($UpgradeDiskSpace)) 
	$mail_body = $mail_body . "  - Additional disk space: " . $DiskSpace . " + extra: " . $ExtraDiskSpace . " MB\n";

if (isset($UpgradeMailQuota))
	$mail_body = $mail_body . "  - Additional mail quota: " . $MailQuota . " + extra: " . $MailQuota . " MB\n";

if (isset($UpgradeDBQuota))
	$mail_body = $mail_body . "  - Additional database quota: " . $DBQuota . " + extra: " . $DBQuota . " MB\n";

if (isset($UserAccount))
	$mail_body = $mail_body . "  - Additional eCommerce component: " . $UserAccount . "\n";
		
if (isset($WishList))
	$mail_body = $mail_body . "  - Additional eCommerce component: " . $WishList . "\n";
	
$mail_body = $mail_body . "\nTotal fee: $" . $total_fee . "\n";
$mail_body = $mail_body . "One time fee: $" . $one_time_fee . "\n";
$mail_body = $mail_body . "Recurring fee: $" . $recurring_fee . "\n";

mail($mail_to , $mail_subject , $mail_body, $mail_from);
?>
<html>
<head>
<title>Upgrade Request Form Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<h2>Your upgrade request will be processed within 48 hours.</h2>
<h2>- SURYADISOFT -</h2>
</body>
</html>
