<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

$query = "UPDATE SALES_ASSOCIATE SET sales_first_name = '$sales_first_name',sales_middle_initial = '$sales_middle_initial',sales_last_name = '$sales_last_name',sales_address_1 = '$sales_address_1',sales_address_2 = '$sales_address_2',sales_city = '$sales_city',sales_state = '$sales_state',sales_zip = '$sales_zip',sales_country = '$sales_country',sales_home_phone = '$sales_home_phone',sales_business_phone = '$sales_business_phone',sales_cellular_phone = '$sales_cell_phone',sales_fax = '$sales_fax',sales_email = '$sales_email',sales_ssn = '$sales_ssn',sales_dob = '$sales_dob',sales_married_status = '$sales_married_status' WHERE sales_id = '$sales_id'";
mysql_select_db(_ADMIN_DATABASE);

$isSuccess = mysql_query($query);
Log::writeToFile("log.txt",$query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Sales Associate Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="0;URL=sales_associate_data.php">
</head>



<body vlink="00aeef">



</body>
</html>
