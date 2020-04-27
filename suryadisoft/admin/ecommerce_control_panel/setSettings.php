<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once "../../class/Themes.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = "SELECT * FROM PROPERTY WHERE property_name = 'site_title'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('site_title','$site_title')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$site_title' WHERE property_name = 'site_title'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'keywords'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('keywords','$keywords')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$keywords' WHERE property_name = 'keywords'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'description'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('description','$description')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$description' WHERE property_name = 'description'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'logo_img_src'";
$num_rows = mysql_num_rows(mysql_query($query));
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('logo_img_src','$logo_img_src')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$logo_img_src' WHERE property_name = 'logo_img_src'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_cust_info'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($ask_cust_info))
	$ask_cust_info = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_cust_info','$ask_cust_info')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$ask_cust_info' WHERE property_name = 'ask_cust_info'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_info'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($ask_shipping_info))
	$ask_shipping_info = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_info','$ask_shipping_info')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_info' WHERE property_name = 'ask_shipping_info'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_info'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($ask_billing_info))
	$ask_billing_info = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_info','$ask_billing_info')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_info' WHERE property_name = 'ask_billing_info'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'show_review_order'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($show_review_order))
	$show_review_order = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_review_order','$show_review_order')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$show_review_order' WHERE property_name = 'show_review_order'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'cc_cust_inv_email'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($cc_cust_inv_email))
	$cc_cust_inv_email = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('cc_cust_inv_email','$cc_cust_inv_email')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$cc_cust_inv_email' WHERE property_name = 'cc_cust_inv_email'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'cc_user_reg_email'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($cc_user_reg_email))
	$cc_user_reg_email = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('cc_user_reg_email','$cc_user_reg_email')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$cc_user_reg_email' WHERE property_name = 'cc_user_reg_email'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'cc_shipped_order_email'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($cc_shipped_order_email))
	$cc_shipped_order_email = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('cc_shipped_order_email','$cc_shipped_order_email')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$cc_shipped_order_email' WHERE property_name = 'cc_shipped_order_email'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'user_account'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($user_account))
	$user_account = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('user_account','$user_account')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$user_account' WHERE property_name = 'user_account'";

$query = "SELECT * FROM PROPERTY WHERE property_name = 'wish_list'";
$num_rows = mysql_num_rows(mysql_query($query));
if (!isset($wish_list))
	$wish_list = "no";
if ($num_rows == 0)
	$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list','$wish_list')";
else
	$query2[] = "UPDATE PROPERTY SET property_value = '$wish_list' WHERE property_name = 'wish_list'";

for ($i=0;$i<count($query2);$i++) {
	$isSuccess = mysql_query($query2[$i]);
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query[$i] . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>

<script language="JavaScript">
<? if (isset($Action) && $Action == "Upload") {?>
	window.open("file_upload.php?file_type=image&page=wizard","_self");
<? } else {?>
	<? if ($HTTP_SESSION_VARS["wizard_mode"] == "beginner") {?>
	window.open("wizard.php?step=7","_parent");
	<? } else if ($HTTP_SESSION_VARS["wizard_mode"] == "advance") {?>
	window.open("wizard.php?step=9","_parent");
	<? }?>	
<? }?>
</script>
