<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Add")
	$query = "INSERT INTO SHIPPING_VENDOR (shipping_vendor_name,shipping_vendor_method) VALUES ('$shipping_vendor_name','$shipping_vendor_method')";
else if ($Action == "Update")
	$query = "UPDATE SHIPPING_VENDOR SET shipping_vendor_name = '$shipping_vendor_name', shipping_vendor_method = '$shipping_vendor_method' WHERE shipping_vendor_id = $shipping_vendor_id";
else if ($Action == "Delete")
	$query = "DELETE FROM SHIPPING_VENDOR WHERE shipping_vendor_id = $shipping_vendor_id";
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
Shipping Vendor Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=shipping_vendor.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
