<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

if ($Action == "Set") {	
	if (isset($ShoppingCart) && $ShoppingCart != "") {
		$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CLIENT_COMPONENTS WHERE user_id = '$user_id' AND component = '$ShoppingCart'"));
		if ($num_rows == 0)			
			$query[] = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','$ShoppingCart')";
	} else
		$query[] = "DELETE FROM CLIENT_COMPONENTS WHERE user_id = '$user_id' AND component = 'Shopping Cart'";	

	if (isset($WishList) && $WishList != "") {
		$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CLIENT_COMPONENTS WHERE user_id = '$user_id' AND component = '$WishList'"));
		if ($num_rows == 0)
			$query[] = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','$WishList')";
	} else
		$query[] = "DELETE FROM CLIENT_COMPONENTS WHERE user_id = '$user_id' AND component = 'Wish List'";
	
	if (isset($UserAccount) && $UserAccount != "") {
		$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CLIENT_COMPONENTS WHERE user_id = '$user_id' AND component = '$UserAccount'"));
		if ($num_rows == 0)
			$query[] = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','$UserAccount')";
	} else
		$query[] = "DELETE FROM CLIENT_COMPONENTS WHERE user_id = '$user_id' AND component = 'User Account'";
} 

$success = true;
for ($i=0;$i<count($query);$i++) {
	$isSuccess = mysql_query($query[$i]);
	Log::writeToFile("log.txt",$query[$i] . "\n\n");
	if(!$isSuccess) {
		$success = false;
		print("<h1>Data cannot be " . $Action . "!</h1><p>\n");
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
Client Components Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($success) {?>
<meta http-equiv="refresh" content="0;URL=manage_client_com.php">
<? }?>
</head>



<body vlink="00aeef">



</body>
</html>
