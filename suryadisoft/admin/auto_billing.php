<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once("config.php");
require_once("../path_config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

$query = "SELECT * FROM BILLING";
$query_result = mysql_query($query);
$success = true;
$transaction = Array();
$admin = new Admin();

while ($rs = mysql_fetch_array($query_result)) {
	if (date("d") == substr($rs["order_date"],8,2)) {
		$pfpro["TRXTYPE"] = "S";
		$pfpro["TENDER"] = "C";
		$pfpro["USER"] = "sc7864ok";
		$pfpro["PWD"] = "blessed1";
		$pfpro["VENDOR"] = "sc7864ok";
		$pfpro["PARTNER"] = "tmerchant";
		$pfpro["ORDERDATE"] = $rs["order_date"];
		$pfpro["FIRSTNAME"] = $rs["billing_first_name"];
		$pfpro["LASTNAME"] = $rs["billing_last_name"];
		$pfpro["STREET"] = $rs["billing_address_1"] . " " . $rs["billing_address_2"];
		$pfpro["CITY"] = $rs["billing_city"];
		$pfpro["STATE"] = $rs["billing_state"];
		$pfpro["ZIP"] = $rs["billing_zip"];
		$pfpro["ACCT"] = $rs["account_number"];
		$pfpro["EXPDATE"] = $rs["cc_exp_date"];
		$pfpro["AMT"] = $rs["monthly_fee"];
		$pfpro["DESC"] = "SuryadiSoft Online Store Subscription Monthly Fee. Question about this charge? Call 925-463-7911";
		$pfpro["COMMENT1"] = "SuryadiSoft Online Store Subscription Monthly Fee";
		$pfpro["COMMENT2"] = "Question about this charge? Call 925-463-7911";
		pfpro_init();
		$transaction = pfpro_process($pfpro,"payflow.verisign.com",443,30);
		
		if ($transaction["RESULT"] == 0) {
			$admin->mailMonthlyBillingInvoice($rs["user_id"]);
			$admin->addBillingRecord($rs["user_id"],"paid");
		} else {
			$admin->addBillingRecord($rs["user_id"],"unpaid");
			$admin->mailUnpaidBalance($rs["user_id"],$transaction["RESPMSG"]);
		}
		$admin->mailBillingResult($rs["user_id"],$transaction["RESPMSG"]);
	}
}

$db_connect->close();
?>
