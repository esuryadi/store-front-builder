<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Transaction.php";
require_once "../../class/Admin.php";
require_once "../../class/WebContent.php";
require_once "../../class/Log.php";
require_once "../config.php";
require_once "../../path_config.php";

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

if ($Action == "Delete") {
	for ($i=0;$i<count($id);$i++) {
		$query2 = "SELECT customer_id, billing_id, shipping_id FROM TRANSACTION WHERE transaction_id = $id[$i]";
		$rs = mysql_fetch_row(mysql_query($query2));
		$query[] = "DELETE FROM CUSTOMER WHERE customer_id = " . $rs[0] . " AND user_id = ''";	
		$query[] = "DELETE FROM BILLING WHERE billing_id = " . $rs[1];
		$query[] = "DELETE FROM SHIPPING WHERE shipping_id = ". $rs[2];
		$query[] = "DELETE FROM PURCHASE WHERE transaction_id = $id[$i]";
		$query[] = "DELETE FROM TRANSACTION WHERE transaction_id = $id[$i]";
	}
}
else if ($Action == "UpdateStatus") {
	$query2 = "SELECT * FROM PURCHASE WHERE transaction_id = $transaction_id AND (purchase_status = 'Back Order' OR purchase_status = 'Shipped' OR purchase_status = 'Cancelled')";
	$num_row = mysql_num_rows(mysql_query($query2));
	$query = Array();
	if ($num_row > 0) {
		$query[] = "UPDATE TRANSACTION SET transaction_status = '$transaction_status' WHERE transaction_id = $transaction_id";
		if ($transaction_status == 'Partially Completed' || $transaction_status == "Completed") {
			$transaction = new Transaction();
			$transaction->mailShippedOrder($transaction_id,$transaction_status,$HTTP_SESSION_VARS["selected_db"]);
		}
		$status = "success";
	} else {
		$status = "failed";
		$isSuccess = true;
	}
} else if ($Action == "UpdateTrackingNumber")
	$query[] = "UPDATE TRANSACTION SET transaction_tracking_number = '$transaction_tracking_number' WHERE transaction_id = $transaction_id";

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

for ($i=0;$i<count($query);$i++) {
	$isSuccess = mysql_query($query[$i]);
	Log::write($query[$i] . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
Transaction Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=transaction_frame.php?status=<?=$status?>">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
