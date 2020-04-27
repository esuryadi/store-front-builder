<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";

$selected_db = $HTTP_SESSION_VARS["selected_db"];
$admin = $HTTP_SESSION_VARS["admin_user"];
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db($selected_db);
if ($Table == "TRANSACTION")
	$query = "SELECT * FROM TRANSACTION, CUSTOMER, BILLING, SHIPPING, PURCHASE WHERE TRANSACTION.customer_id = CUSTOMER.customer_id AND TRANSACTION.billing_id = BILLING.billing_id AND TRANSACTION.shipping_id = SHIPPING.shipping_id AND TRANSACTION.transaction_id = PURCHASE.transaction_id"; 
else
	$query = "SELECT * FROM " . $Table;
$query_result = mysql_query($query);

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
$rs = mysql_fetch_row(mysql_query($query));
$userid = $rs[0];
$db_connect->close();
$admin->retrieveAdminInfo($userid);

if (substr($admin->getUserId(),0,4) == "test" || substr($admin->getUserId(),0,5) == "trial" || $admin->getUserId() == "demo1" || $admin->getUserId() == "demo2" || $admin->getUserId() == "demo")
	$str = "wwwuser";
else
	$str = substr($admin->getUserId(),0,8);
if (substr($admin->getCompanyURL(),0,3) == "www")
	$url = substr($admin->getCompanyURL(),4);
else
	$url = $admin->getCompanyURL();
//$rootpath = _ROOTDIR . $str . "/" . $url;
$rootpath = _ROOTDIR . "test2";

//$export_file = $rootpath . "/" . $filename ;
$export_file = $rootpath . "\\" . $filename;

if ($format == "XML") {
	touch($export_file);
	chmod($export_file,0666);
	$file = fopen($export_file,"w");
	while($rs = mysql_fetch_row($query_result)) {
		$str = "";
		for ($i=0;$i<count($rs);$i++) {
			$str = $str . str_replace($format,"~",str_replace("\r\n", "", $rs[$i])) . $format;			
		}
		fwrite($file,$str . "\n");
	}
	fclose($file);
} else {
	/*$doc = domxml_new_doc("1.0");
	$root = $doc->create_element($Table);
	$root = $doc->append_child($root);
	//$head = $doc->create_element("HEAD");
	//$head = $root->append_child($head);
	//$title = $doc->create_element("TITLE");
	//$title = $head->append_child($title);
	//$text = $doc->create_text_node("This is the title");
	//$text = $title->append_child($text);
	$doc->dump_file("/tmp/test.xml");*/
}
?> 
<strong>Your catalog has been exported to file <?=$filename?>.</strong>