<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "config.php";

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

$pwd = crypt($password,'$1$d9lb2yxt$');
$query = "UPDATE USER SET password = '$pwd' WHERE user_id = '$user_id'";
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
Change Admin Password Result</title>
<!meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>



<body vlink="00aeef">

<? if($isSuccess) {?>
</font>
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Administrator 
  <?=$user_id?>
  password has been changed.</font></p>
<? }?>
  </font></p>
</body>
</html>
