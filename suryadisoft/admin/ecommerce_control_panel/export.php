<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../../class/Node.php";
require_once "../../class/XML.php";
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
$query_result = mysql_query($query) or die(mysql_error());

$field_list = $query_result;
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
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
$rootpath = _ROOTDIR . $str . "/" . $url;

//$export_file = $rootpath . "/" . $filename ;
$export_file = "/www/" . $url . "/httpdocs/" . $filename;

touch($export_file);
chmod($export_file,0666);
$file = fopen($export_file,"w");
if ($format != "xml") {
	fwrite($file,implode($format,$field_name) . "\n");
} else {
	$root = new Node("XMLDOCS",null,false);
	$row = Array();
	$col = Array();
}
for($n=0;$rs = mysql_fetch_row($query_result);$n++) {
	if ($format == "xml") {
		$row[$n] = new Node($Table,null,false);
		$col = array();
	} else
		$str = "";
	for ($i=0;$i<count($rs);$i++) {
		if ($format != "xml")
			$str = $str . str_replace($format,"~",str_replace("\r\n", "", $rs[$i])) . $format;
		else {
			if ($field_name[$i] == "product_description" || $field_name[$i] == "product_name" 
			   || $field_name[$i] == "product_main_category" || $field_name[$i] == "product_sub_category_1"
			   || $field_name[$i] == "product_sub_category_2" || $field_name[$i] == "product_other_category"
			   || $field_name[$i] == "product_image_small" || $field_name[$i] == "product_image_medium"
			   || $field_name[$i] == "product_image_large" || $field_name[$i] == "categories_main"
			   || $field_name[$i] == "categories_sub_1" || $field_name[$i] == "categories_sub_2" 
			   || $field_name[$i] == "shipping_vendor") 
				$col[$i] = new Node($field_name[$i],$rs[$i],true); 
			else
				$col[$i] = new Node($field_name[$i],$rs[$i],false); 
		}			
	}
	if ($format != "xml")
		fwrite($file,$str . "\n");
	else
		$row[$n]->addChildrenNode($col);
}
if ($format == "xml") {
	$root->addChildrenNode($row);
	$xml = new XML();
	fwrite($file,$xml->createXMLHeader());
	$xml->createXMLFile($root,$export_file);
}

fclose($file);
?> 
<strong>Your catalog has been exported to file <?=$filename?>.</strong>