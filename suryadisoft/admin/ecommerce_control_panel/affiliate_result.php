<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Create")
	$query = "INSERT INTO AFFILIATE (affiliate_id,affiliate_name,affiliate_address,affiliate_city,affiliate_state,affiliate_zip,affiliate_phone,affiliate_email,affiliate_url,affiliate_referral_hits,affiliate_referral_purchase,affiliate_commission_type,affiliate_commission,affiliate_total_commission,affiliate_paid_commission) VALUES ('$affiliate_id','$affiliate_name','$affiliate_address','$affiliate_city','$affiliate_state','$affiliate_zip','$affiliate_phone','$affiliate_email','$affiliate_url','$affiliate_referral_hits','$affiliate_referral_purchase','$affiliate_commission_type','$affiliate_commission','$affiliate_total_commission','$affiliate_paid_commission')";
else if ($Action == "Update")
	$query = "UPDATE AFFILIATE SET affiliate_id = '$affiliate_id', affiliate_name = '$affiliate_name', affiliate_address = '$affiliate_address', affiliate_city = '$affiliate_city', affiliate_state = '$affiliate_state', affiliate_zip = '$affiliate_zip', affiliate_phone = '$affiliate_phone', affiliate_email = '$affiliate_email', affiliate_url = '$affiliate_url', affiliate_referral_hits = '$affiliate_referral_hits', affiliate_referral_purchase = '$affiliate_referral_purchase', affiliate_commission_type = '$affiliate_commission_type', affiliate_commission = '$affiliate_commission', affiliate_total_commission = '$affiliate_total_commission', affiliate_paid_commission = '$affiliate_paid_commission' WHERE affiliate_id = '$old_affiliate_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM AFFILIATE WHERE affiliate_id = '$affiliate_id'";
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$isSuccess = mysql_query($query);
Log::write($query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
Affiliate Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=affiliate.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
