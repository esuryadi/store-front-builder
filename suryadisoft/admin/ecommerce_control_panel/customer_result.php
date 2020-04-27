<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Add")
	$query = "INSERT INTO CUSTOMER (user_id,customer_first_name,customer_mi_name,customer_last_name,customer_email,customer_phone_day,customer_phone_evening,customer_fax,customer_address_1,customer_address_2,customer_city,customer_state,customer_zip,customer_country) VALUES ('$user_id','$customer_first_name','$customer_mi_name','$customer_last_name','$customer_email','$customer_phone_day','$customer_phone_evening','$customer_fax','$customer_address_1','$customer_address_2','$customer_city','$customer_state','$customer_zip','$customer_country')";
else if ($Action == "Update")
	$query = "UPDATE CUSTOMER SET user_id = '$user_id', customer_first_name = '$customer_first_name', customer_mi_name = '$customer_mi_name', customer_last_name = '$customer_last_name', customer_email = '$customer_email', customer_phone_day = '$customer_phone_day', customer_phone_evening = '$customer_phone_evening', customer_fax = '$customer_fax', customer_address_1 = '$customer_address_1', customer_address_2 = '$customer_address_2', customer_city = '$customer_city', customer_state = '$customer_state', customer_zip = '$customer_zip', customer_country = '$customer_country' WHERE CUSTOMER_ID = $customer_id";
else if ($Action == "Delete")
	$query = "DELETE FROM CUSTOMER WHERE CUSTOMER_ID = $customer_id";
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
Customer Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=customer.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
