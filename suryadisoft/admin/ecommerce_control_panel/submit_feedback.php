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
$mail_to = "webmaster@suryadisoft.net";
$mail_from = "From: " . $admin->getCompanyName() . "<" . $admin->getEmail() . ">";
$mail_subject = "Feedback from " . $admin->getCompanyName();
$mail_body = $Feedback;
mail($mail_to , $mail_subject , $mail_body, $mail_from);
?>
<html>
<head>
<title>Submit Feedback</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Your feedback 
  means a lot to us, as we are continually enhancing our services.</font></p>

<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Thank You,</font></p>
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">SURYADISOFT</font></p>

</body>
</html>
