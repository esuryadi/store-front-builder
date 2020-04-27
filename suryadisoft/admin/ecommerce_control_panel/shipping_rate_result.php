<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
define("_DB",$HTTP_SESSION_VARS["selected_db"]);

$calc_method = WebContent::getPropertyValue("ship_rate_calc_method");

if ($Action == "Add") {
	if ($calc_method == "by product") 
		$query = "INSERT INTO SHIPPING_RATE (product_id,shipping_vendor,shipping_method,one_item_rate,additional_item_rate,state,city,zip,country) VALUES ($product_id,'$shipping_vendor','$shipping_method',$one_item_rate,$additional_item_rate,'$state','$city','$zip','$country')";
	else if ($calc_method == "by total purchase") 
		$query = "INSERT INTO SHIPPING_RATE_2 (shipping_vendor,shipping_method,total_purchase_low,total_purchase_high,zip_code_low,zip_code_high,rate_type,shipping_rate,shipping_destination) VALUES ('$shipping_vendor','$shipping_method','$total_purchase_low','$total_purchase_high','$zip_code_low','$zip_code_high','$rate_type','$shipping_rate','$shipping_destination')";
	else
		$query = "INSERT INTO SHIPPING_RATE_3 (weight,shipping_vendor,shipping_method,shipping_rate,rate_type,state,city,zip,country) VALUES ($weight,'$shipping_vendor','$shipping_method',$shipping_rate,'$rate_type','$state','$city','$zip','$country')";
} else if ($Action == "Update") {
	if ($calc_method == "by product") 
		$query = "UPDATE SHIPPING_RATE SET product_id = $product_id, shipping_vendor = '$shipping_vendor', shipping_method = '$shipping_method', one_item_rate = $one_item_rate, additional_item_rate = $additional_item_rate, state = '$state', city = '$city', zip = '$zip', country = '$country' WHERE id = $id";
	else if ($calc_method == "by total purchase")
		$query = "UPDATE SHIPPING_RATE_2 SET shipping_vendor = '$shipping_vendor', shipping_method = '$shipping_method', total_purchase_low = '$total_purchase_low', total_purchase_high = '$total_purchase_high', zip_code_low = '$zip_code_low', zip_code_high = '$zip_code_high', rate_type = '$rate_type', shipping_rate = '$shipping_rate', shipping_destination = '$shipping_destination' WHERE id = $id";
	else
		$query = "UPDATE SHIPPING_RATE_3 SET weight = $weight, shipping_vendor = '$shipping_vendor', shipping_method = '$shipping_method', shipping_rate = $shipping_rate, rate_type = '$rate_type', state = '$state', city = '$city', zip = '$zip', country = '$country' WHERE id = $id";
} else if ($Action == "Delete") {
	if ($calc_method == "by product") 
		$query = "DELETE FROM SHIPPING_RATE WHERE id = $id";
	else if ($calc_method == "by total purchase")
		$query = "DELETE FROM SHIPPING_RATE_2 WHERE id = $id";
	else 
		$query = "DELETE FROM SHIPPING_RATE_3 WHERE id = $id";
}

$HTTP_SESSION_VARS["db_connect"]->open();
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
Shipping Rate Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=shipping_rate.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
