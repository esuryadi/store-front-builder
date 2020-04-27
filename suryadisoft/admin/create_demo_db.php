<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "config.php";
?>
<html>
<head>
<title>Create eCommerce Demo Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>



<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="00aeef" size="-1">Create 
eCommerce Demo Database</font><br>

<br>
</strong></font> 
<?php
$db_connect = new DBConnect(_HOST, _USERID, _PASSWORD);
$db_connect->open();
$success = mysql_create_db("ecommerce_demo1",$db_connect->getConnection());
if($success) {
	print ("<p><b>ecommerce_demo1 has been successfully created.</b></p>\n");
	Log::writeToFile("log.txt","ecommerce_demo1 has been successfully created.\n\n");
} else {
	print("<p><b>ecommerce_demo1 cannot be created.</b></p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

if($success) {
	mysql_select_db("ecommerce_demo1");
	
	/***************** Create eCommerce_demo1 database table ********************/
	
	$file_in = fopen("script/ecommerce_demo_db.txt","r");
	$i = 0;
	$query = "";
	while(!feof($file_in)) {
		$str = fgets($file_in,10000);
		if (trim($str) != "") {
			$query = $query . $str;
		} else {
			$isSuccess = mysql_query($query);
			Log::writeToFile("log.txt",$query . "\n\n");
			if($isSuccess) {
				print ("<p><b>SQL Statement $i has been successfully executed.</b></p>\n");
				Log::writeToFile("log.txt","SQL Statement $i has been successfully executed.\n\n");
			} else {
				print("<p><b>SQL Statement $i cannot be executed.</b></p>\n");
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				print("<p>");
				Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			$i++;
			$query = "";
		}
	}
	fclose($file_in);
	
	/***************** Create eCommerce_demo1 sample data ********************/
	
	$file_in = fopen("script/ecommerce_demo_data.txt","r");
	$query = "";
	while(!feof($file_in)) {
		$str = fgets($file_in,10000);
		if (trim($str) != "") {
			$query = $query . $str;
		} else {
			$isSuccess = mysql_query($query);
			Log::writeToFile("log.txt",$query . "\n\n");
			if($isSuccess) {
				print ("<p><b>SQL Statement $i has been successfully executed.</b></p>\n");
				Log::writeToFile("log.txt","SQL Statement $i has been successfully executed.\n\n");
			} else {
				print("<p><b>SQL Statement $i cannot be executed.</b></p>\n");
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				print("<p>");
				Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			$i++;
			$query = "";
		}
	}
	fclose($file_in);
}
$db_connect->close();
?>
<p><a href="control_panel.php" target="_parent"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a></p>
</body>
</html>
