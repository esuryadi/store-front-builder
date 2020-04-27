<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Add")
	$query = "INSERT INTO VOLUME_DISCOUNT (discount_by,volume_low,volume_high,discount_type,discount_rate) VALUES ('$discount_by','$volume_low','$volume_high','$discount_type','$discount_rate')";
else if ($Action == "Update")
	$query = "UPDATE VOLUME_DISCOUNT SET discount_by = '$discount_by', volume_low = '$volume_low', volume_high = '$volume_high', discount_type = '$discount_type', discount_rate = '$discount_rate' WHERE id = id";
else if ($Action == "Delete")
	$query = "DELETE FROM VOLUME_DISCOUNT WHERE id = $id";
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
<?=$Action?> Volume Discount Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=volume_discount.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
