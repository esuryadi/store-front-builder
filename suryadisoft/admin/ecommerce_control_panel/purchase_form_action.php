<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Add")
	$query = "INSERT INTO PURCHASE (CUSTOMER_ID,TRANSACTION_ID,PRODUCT_ID,PRODUCT_COLOR,PRODUCT_SIZE,PRODUCT_CHOICE,PURCHASE_QUANTITY,PURCHASE_CHARGE,PURCHASE_STATUS) VALUES ('$customerId','$transactionId','$productId','$productColor','$productSize','$productChoice','$purchaseQuantity','$purchaseCharge','In Process')";
else if ($Action == "Update")
	$query = "UPDATE PURCHASE SET product_id = '$productId', product_color = '$productColor', product_size = '$productSize', product_choice = '$productChoice', purchase_quantity = '$purchaseQuantity', purchase_charge = '$purchaseCharge' WHERE purchase_id = '$purchaseId'";
else if ($Action == "Delete")
	$query = "DELETE FROM PURCHASE WHERE purchase_id = '$purchaseId'";
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
<script language="javascript">
window.opener.open("purchase_info.php?transaction_id=<?=$transactionId?>&customer_id=<?=$customerId?>","middleFrame");
window.close();
</script>
