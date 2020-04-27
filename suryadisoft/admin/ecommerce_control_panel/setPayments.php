<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once "../../class/Themes.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "UPDATE CLIENT_PAYMENT_SERVICE SET payment_service = '$payment_service' WHERE user_id = '$user_id'";
$isSuccess = mysql_query($query);		
if(!$isSuccess) {
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	Log::write($query . "\n\n");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
if ($payment_service == "PayPal") {
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'paypal_account'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('paypal_account','$paypal_account')";
	else
		$query = "UPDATE PROPERTY SET property_value = '$paypal_account' WHERE property_name = 'paypal_account'";
	$isSuccess = mysql_query($query);		
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
} else if ($payment_service == "VeriSign PayFlow Link") {
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_method'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_method','$verisign_method')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_method' WHERE property_name = 'verisign_method'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_trxtype'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_trxtype','$verisign_trxtype')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_trxtype' WHERE property_name = 'verisign_trxtype'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_user_id'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_user_id','$verisign_user_id')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_user_id' WHERE property_name = 'verisign_user_id'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_partner'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_partner','$verisign_partner')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_partner' WHERE property_name = 'verisign_partner'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_order_form'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_order_form','$verisign_order_form')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_order_form' WHERE property_name = 'verisign_order_form'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_email_customer'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_email_customer','$verisign_email_customer')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_email_customer' WHERE property_name = 'verisign_email_customer'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_show_confirmation'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_show_confirmation','$verisign_show_confirmation')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_show_confirmation' WHERE property_name = 'verisign_show_confirmation'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'record_transaction'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('record_transaction','$record_transaction')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$record_transaction' WHERE property_name = 'record_transaction'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'use_ssl'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('use_ssl','$use_ssl')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$use_ssl' WHERE property_name = 'use_ssl'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'show_payment_button'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_payment_button','$show_payment_button')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$show_payment_button' WHERE property_name = 'show_payment_button'";

	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else if ($payment_service == "VeriSign PayFlow Pro") {
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_trxmode'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_trxmode','$verisign_trxmode')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_trxmode' WHERE property_name = 'verisign_trxmode'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_tender'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_tender','$verisign_tender')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_tender' WHERE property_name = 'verisign_tender'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_trxtype'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_trxtype','$verisign_trxtype')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_trxtype' WHERE property_name = 'verisign_trxtype'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_user_id'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_user_id','$verisign_user_id')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_user_id' WHERE property_name = 'verisign_user_id'";
	
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_password'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_password','$verisign_password')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_password' WHERE property_name = 'verisign_password'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_vendor'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_vendor','$verisign_vendor')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_vendor' WHERE property_name = 'verisign_vendor'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_partner'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_partner','$verisign_partner')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_partner' WHERE property_name = 'verisign_partner'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'use_ssl'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('use_ssl','$use_ssl')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$use_ssl' WHERE property_name = 'use_ssl'";

	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else if ($payment_service == "Authorize.Net") {
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'login_id'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('login_id','$login_id')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$login_id' WHERE property_name = 'login_id'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'transaction_key'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('transaction_key','$transaction_key')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$transaction_key' WHERE property_name = 'transaction_key'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'transaction_method'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('transaction_method','$transaction_method')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$transaction_method' WHERE property_name = 'transaction_method'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'transaction_type'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('transaction_type','$transaction_type')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$transaction_type' WHERE property_name = 'transaction_type'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'email_customer'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('email_customer','$email_customer')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$email_customer' WHERE property_name = 'email_customer'";

	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else {
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'payment_method'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('payment_method','$payment_method')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$payment_method' WHERE property_name = 'payment_method'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'payment_message'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('payment_message','$payment_message')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$payment_message' WHERE property_name = 'payment_message'";

	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
}

if (isset($payment_type)) {
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'ask_cvv'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_cvv','$ask_cvv')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$ask_cvv' WHERE property_name = 'ask_cvv'";

	$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'payment_type'";
	$type = implode(",",$payment_type);
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('payment_type','$type')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$type' WHERE property_name = 'payment_type'";
	
	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
}
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>

<script language="JavaScript">
<? if ($HTTP_SESSION_VARS["wizard_mode"] == "beginner") {?>
window.open("wizard.php?step=6","_parent");
<? } else if ($HTTP_SESSION_VARS["wizard_mode"] == "advance") {?>
window.open("wizard.php?step=8","_parent");
<? }?>
</script>
