<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
define("_DB",$HTTP_SESSION_VARS["selected_db"]);

if ($Action == "Add") {
	$query = "INSERT INTO SPECIAL_PRICING (user_id,product_id,product_price) VALUES ('$user_id','$product_id','$product_price')";
} else if ($Action == "Update") { 
	$query = "UPDATE SPECIAL_PRICING SET user_id = '$user_id', product_id = '$product_id', product_price = '$product_price' WHERE id = $id";
} else if ($Action == "Delete") {
	$query = "DELETE FROM SPECIAL_PRICING WHERE id = $id";
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
<title><?=$Action?> Special Pricing Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=special_pricing.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
