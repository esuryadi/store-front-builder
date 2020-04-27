<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if (isset($password))
	$pwd = crypt($password,'$1$d9lb2yxt$');
if ($Action == "Add")
	$query = "INSERT INTO SALES_ASSOCIATE (sales_id,sales_first_name,sales_middle_initial,sales_last_name,sales_address_1,sales_address_2,sales_city,sales_state,sales_zip,sales_country,sales_home_phone,sales_business_phone,sales_cellular_phone,sales_fax,sales_email,sales_ssn,sales_dob,sales_married_status,sales_commission) VALUES ('$sales_id','$sales_first_name','$sales_middle_initial','$sales_last_name','$sales_address_1','$sales_address_2','$sales_city','$sales_state','$sales_zip','$sales_country','$sales_home_phone','$sales_business_phone','$sales_cell_phone','$sales_fax','$sales_email','$sales_ssn','$sales_dob','$sales_married_status','$sales_commission')";
else if ($Action == "Update")
	$query = "UPDATE SALES_ASSOCIATE SET sales_id = '$sales_id',sales_first_name = '$sales_first_name',sales_middle_initial = '$sales_middle_initial',sales_last_name = '$sales_last_name',sales_address_1 = '$sales_address_1',sales_address_2 = '$sales_address_2',sales_city = '$sales_city',sales_state = '$sales_state',sales_zip = '$sales_zip',sales_country = '$sales_country',sales_home_phone = '$sales_home_phone',sales_business_phone = '$sales_business_phone',sales_cellular_phone = '$sales_cell_phone',sales_fax = '$sales_fax',sales_email = '$sales_email',sales_ssn = '$sales_ssn',sales_dob = '$sales_dob',sales_married_status = '$sales_married_status',sales_commission = '$sales_commission' WHERE sales_id = '$old_sales_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM SALES_ASSOCIATE WHERE sales_id = '$sales_id_id'";
mysql_select_db(_ADMIN_DATABASE);

$num_rows = 0;
if ($Action == "Create")
	$num_rows = mysql_num_rows(mysql_query("SELECT * FROM SALES_ASSOCIATE WHERE sales_id = '$sales_id'"));

if ($num_rows == 0) {
	$isSuccess = mysql_query($query);
	Log::writeToFile("log.txt",$query . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$db_connect->close();
?>
<html>
<head>
<title>
<?=$Action?>
Sales Associate Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($num_rows == 0 && $isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_sales_associate.php">
<? } else {?>
<meta http-equiv="refresh" content="0;URL=manage_sales_associate.php?Action=Create&Status=failed">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
