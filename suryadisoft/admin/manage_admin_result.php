<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

if (isset($password))
	$pwd = crypt($password,'$1$d9lb2yxt$');
if ($Action == "Create")
	$query = "INSERT INTO USER (user_id,password,email,first_name,last_name,role,status) VALUES ('$user_id','$pwd','$email','$first_name','$last_name','$role','$status')";
else if ($Action == "Update")
	$query = "UPDATE USER SET email = '$email', first_name = '$first_name', last_name = '$last_name', role = '$role', status = '$status' WHERE user_id = '$old_user_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM USER WHERE user_id = '$user_id'";
mysql_select_db(_ADMIN_DATABASE);

$num_rows = 0;
if ($Action == "Create")
	$num_rows = mysql_num_rows(mysql_query("SELECT * FROM USER WHERE user_id = '$user_id'"));

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
Admin Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($num_rows == 0 && $isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=manage_admin.php">
<? } else {?>
<meta http-equiv="refresh" content="0;URL=manage_admin.php?Action=Create&Status=failed">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
