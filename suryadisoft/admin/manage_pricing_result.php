<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if ($Action == "Add")
	$query = "INSERT INTO PRICING (pricing_plan,pricing_category,pricing_price,pricing_term) VALUES ('$pricing_plan','$pricing_category',$pricing_price,'$pricing_term')";
else if ($Action == "Update")
	$query = "UPDATE PRICING SET pricing_plan = '$pricing_plan', pricing_category = '$pricing_category', pricing_price = $pricing_price, pricing_term = '$pricing_term' WHERE pricing_id = $pricing_id";
else if ($Action == "Delete")
	$query = "DELETE FROM PRICING WHERE pricing_id = $pricing_id";
mysql_select_db(_ADMIN_DATABASE);
$isSuccess = mysql_query($query);
Log::writeToFile("log.txt",$query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Pricing Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_pricing.php">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
