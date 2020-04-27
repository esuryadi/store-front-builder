<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Add")
	$query = "INSERT INTO PRODUCT_COUPON (coupon_id,product_id,discount_type,coupon_value,exp_date) VALUES ('$coupon_id','$product_id','$discount_type','$coupon_value','$exp_date')";
else if ($Action == "Update")
	$query = "UPDATE PRODUCT_COUPON SET coupon_id = '$coupon_id', product_id = '$product_id', discount_type = '$discount_type', coupon_value = '$coupon_value', exp_date = '$exp_date' WHERE coupon_id = '$old_coupon_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM PRODUCT_COUPON WHERE coupon_id = '$coupon_id'";
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
Product Coupon Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=product_coupon.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
