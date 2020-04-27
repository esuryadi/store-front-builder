<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$productsStr = "";
for ($i=0;$i<count($selectedProducts);$i++) {
	if ($i == 0)
		$productsStr = $selectedProducts[$i];
	else
		$productsStr = $productsStr . "," . $selectedProducts[$i];
}

if (isset($action) && $action == "add")  {
	$query = "INSERT INTO GROUP_SHIPPING_RATE (group_name, group_products, group_rate, min_order) VALUES ('$groupName','$productsStr',$groupShippingRate,$minimumOrder)";
} else if (isset($action) && $action == "update") {
	$query = "UPDATE GROUP_SHIPPING_RATE SET group_products = '$productsStr', group_rate = $groupShippingRate, min_order = $minimumOrder WHERE group_name = '$groupName'";
} else if (isset($action) && $action == "delete") {
	$query = "DELETE FROM GROUP_SHIPPING_RATE WHERE group_name = '$groupName'";
}
$success = mysql_query($query) or die (mysql_errno() . ": " . mysql_error());

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Group Shipping Rate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($success) {?>
<meta http-equiv="refresh" content="0;URL=group_shipping_rate.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
