<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once "config.php";
require_once "../path_config.php";

$admin = new Admin();
$admin->retrieveAdminInfo($user_id);

function my_copy($oldname, $newname)
{
	if(is_file($oldname)){
		$perms = fileperms($oldname);
		return copy($oldname, $newname) && chmod($newname, $perms);
	}
	else if(is_dir($oldname)){
		my_dir_copy($oldname, $newname);
	}
	else{
		die("Cannot copy file: $oldname (it's neither a file nor a directory)");
	} 
}
		
function my_dir_copy($oldname, $newname) 
{
	if(!is_dir($newname)){
		mkdir($newname);
	}
	$dir = opendir($oldname);
	while($file = readdir($dir)){
		if($file == "." || $file == ".."){
			continue;
		}
		my_copy("$oldname/$file", "$newname/$file");
	}
	closedir($dir);
} 
?>
<html>
<head>
<title>Mini eCommerce Setup Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>



<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Mini eCommerce Setup Result 
<?php
require_once "config.php";

$db_connect = new DBConnect(_HOST, _USERID, _PASSWORD);
$db_connect->open();

/******************* Create mini eCommerce database ************************/

echo "<p><b>Create mini eCommerce database</b></p>";
echo "<blockquote>";

$success = mysql_create_db($dbname,$db_connect->getConnection());
if($success) {
	print ("<p><b>Database $dbname has been successfully created.</b></p>\n");
	Log::writeToFile("log.txt","$dbname has been successfully created.\n\n");
} else {
	print("<p><b>$dbname cannot be created.</b></p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

echo "</blockquote>";

$success = mysql_select_db(_ADMIN_DATABASE);

if ($success) {
	/***************** Insert User Information *********************************/
	
	echo "<p><b>Insert User Information</b></p>";
	echo "<blockquote>";
	
	$pwd = crypt($password,'$1$d9lb2yxt$');
	$query = "INSERT INTO USER (user_id,password,first_name,last_name,email,role,status) VALUES ('$user_id','" . $pwd . "','$first_name','$last_name','$email','$role','$status')";
	$success = mysql_query($query);
	
	if($success) {
		print ("<p><b>User information has been inserted successfully.</b></p>\n");
		Log::writeToFile("log.txt","User information has been inserted successfully.\n\n");
	} else {
		print("<p><b>User information cannot be inserted.</b></p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	
	echo "</blockquote>";
	
	/***************** Insert Client Information *******************************/
	
	echo "<p><b>Insert Client Information</b></p>";
	echo "<blockquote>";
	
	$query = "INSERT INTO CLIENTS (user_id,company_name,company_url,company_address1,company_address2,company_city,company_state,company_zip,company_country,company_phone,company_fax,company_email) VALUES ('$user_id','$company_name','$company_url','$company_address_1','$company_address_2','$company_city','$company_state','$company_zip','$company_country','$company_phone','$company_fax','$company_email')";
	$success = mysql_query($query);
	
	if($success) {
		print ("<p><b>Client information has been inserted successfully.</b></p>\n");
		Log::writeToFile("log.txt","Client information has been inserted successfully.\n\n");
	} else {
		print("<p><b>Client information cannot be inserted.</b></p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	
	echo "</blockquote>";
	
	/***************** Insert Client Database **********************************/
	
	echo "<p><b>Insert Client Database</b></p>";
	echo "<blockquote>";
	
	$query = "INSERT INTO CLIENT_DATABASE (user_id,database_name) VALUES ('$user_id','$dbname')";
	$success = mysql_query($query);
	
	if($success) {
		print ("<p><b>Client database has been inserted successfully.</b></p>\n");
		Log::writeToFile("log.txt","Client database has been inserted successfully.\n\n");
	} else {
		print("<p><b>Client database cannot be inserted.</b></p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	
	echo "</blockquote>";
	
	/***************** Insert Client Component Information **********************/
	
	echo "<p><b>Insert Client Component Information</b></p>";
	echo "<blockquote>";
	
	if (isset($shoppingcart) && $shoppingcart != "") {
		$query = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','$shoppingcart')";
		$success = mysql_query($query);
		
		if($success) {
			print ("<p><b>Shopping Cart has been inserted successfully.</b></p>\n");
			Log::writeToFile("log.txt","Shopping Cart has been inserted successfully.\n\n");
		} else {
			print("<p><b>Shopping Cart cannot be inserted.</b></p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
	
	if (isset($wishlist) && $wishlist != "") {
		$query = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','$wishlist')";
		$success = mysql_query($query);
		
		if($success) {
			print ("<p><b>Wish List has been inserted successfully.</b></p>\n");
			Log::writeToFile("log.txt","Wish List has been inserted successfully.\n\n");
		} else {
			print("<p><b>Wish List cannot be inserted.</b></p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
	
	if (isset($useraccount) && $useraccount != "") {
		$query = "INSERT INTO CLIENT_COMPONENTS (user_id,component) VALUES ('$user_id','$useraccount')";
		$success = mysql_query($query);
		
		if($success) {
			print ("<p><b>User Account has been inserted successfully.</b></p>\n");
			Log::writeToFile("log.txt","User Account has been inserted successfully.\n\n");
		} else {
			print("<p><b>User Account cannot be inserted.</b></p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
	
	echo "</blockquote>";
	
	/***************** Insert Client Payment Service Information *****************/
	
	echo "<p><b>Insert Client Payment Service Information</b></p>";
	echo "<blockquote>";
	
	if (isset($PaymentService) && $PaymentService != "") {
		$query = "INSERT INTO CLIENT_PAYMENT_SERVICE (user_id,payment_service) VALUES ('$user_id','$PaymentService')";
		$success = mysql_query($query);
		
		if($success) {
			print ("<p><b>Payment Service has been inserted successfully.</b></p>\n");
			Log::writeToFile("log.txt","Shopping Cart has been inserted successfully.\n\n");
		} else {
			print("<p><b>Shopping Cart cannot be inserted.</b></p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
	
	echo "</blockquote>";
	
	mysql_select_db($dbname);
	
	/***************** Create mini eCommerce database table ********************/
	
	echo "<p><b>Create mini eCommerce table</b></p>";
	echo "<ul>";
	
	$file_in = fopen("script/mini_ecommerce_db.txt","r");
	$i = 0;
	$query = "";
	while(!feof($file_in)) {
		$str = fgets($file_in,10000);
		if (trim($str) != "") {
			$query = $query . $str;
		} else {
			$isSuccess = mysql_query($query);
			Log::writeToFile("log.txt",$query . "\n\n");
			if(!$isSuccess) {
				print("<li>Cannot create table.</li>\n");
				echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
				print("<p>");
				Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			$i++;
			$query = "";
		}
	}
	$list_tables = mysql_list_tables($dbname);
	for ($i=0;$i<mysql_num_rows($list_tables);$i++) {
		echo "<li>Table " . mysql_tablename($list_tables,$i) . " has been created.</li>\n";
		Log::writeToFile("log.txt","Table " . mysql_tablename($list_tables,$i) . " has been created.\n\n");
	}		
	fclose($file_in);
	
	echo "</ul>";
	
	if ($order_type == "trial") {
		echo "<p><b>Insert mini eCommerce initial data</b></p>";
		echo "<blockquote>";
		
		$file_in = fopen("script/mini_ecommerce_data.txt","r");
		$i = 0;
		$query = "";
		$success = true;
		while(!feof($file_in)) {
			$str = fgets($file_in,10000);
			if (trim($str) != "") {
				$query = $query . $str;
			} else {
				$isSuccess = mysql_query($query);
				Log::writeToFile("log.txt",$query . "\n\n");
				if(!$isSuccess) {
					$success = false;
					print("<li>SQL Statement $i cannot be executed.</li>\n");
					echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
					print("<p>");
					Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
				$i++;
				$query = "";
			}
		}
		if ($success) {
			echo "Initial data has been succesfully inserted.";
			Log::writeToFile("log.txt","Initial data has been succesfully inserted.\n\n");
		}
		fclose($file_in);
		
		echo "</blockquote>";
	} else {
		mysql_query("insert into PROPERTY (property_name, property_value) values ('ftp_username','$user_id')");
		mysql_query("insert into PROPERTY (property_name, property_value) values ('ftp_password','" . $user_id . "123')");
	}
	
	if (isset($demo_data) && $demo_data != "") {
		/***************** Create mini eCommerce database table ********************/
		
		echo "<p><b>Create mini eCommerce demo data</b></p>";
		echo "<blockquote>";
		
		$file_in = fopen("script/mini_ecommerce_demo_data.txt","r");
		$i = 0;
		$query = "";
		$success = true;
		while(!feof($file_in)) {
			$str = fgets($file_in,10000);
			if (trim($str) != "") {
				$query = $query . $str;
			} else {
				$isSuccess = mysql_query($query);
				Log::writeToFile("log.txt",$query . "\n\n");
				if(!$isSuccess) {
					$success = false;
					print("<li>SQL Statement $i cannot be executed.</li>\n");
					echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
					print("<p>");
					Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
				$i++;
				$query = "";
			}
		}
		if ($success) {
			echo "Demo data has been succesfully inserted.";
			Log::writeToFile("log.txt","Initial data has been succesfully inserted.\n\n");
		}
		fclose($file_in);
		
		echo "</blockquote>";
	}
	
	if (isset($order_type)) {
	
		$order_id = substr($order_id,0,strpos($order_id,";",0));
		
		/***************** Update Build Status ********************/
		
		echo "<p><b>Update build status</b></p>";
		echo "<blockquote>";
		
		mysql_select_db(_ADMIN_DATABASE);
		if ($order_type == "purchase")
			$query = "UPDATE PURCHASE_ORDER SET build_status = 'completed' WHERE order_id = $order_id";
		else
			$query = "UPDATE TRIAL_ORDER SET build_status = 'completed' WHERE id = $order_id";
		$success = mysql_query($query);
		
		if($success) {
			print ("<p><b>Build status has been updated successfully.</b></p>\n");
			Log::writeToFile("log.txt","Build status has been updated successfully.\n\n");
			if ($order_type == "trial") {
				$admin->mailTrialAccount($order_id);
				$admin->createTrialSites($order_id);
			} else {
				$admin->createSites($user_id);
			}
			$db_connect->open();
		} else {
			print("<p><b>Build status cannot be updated.</b></p>\n");
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			print("<p>");
			Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	
	echo "</blockquote>";
	
	}
	
	if (isset($trial_id) && $trial_id != "") {
		echo "<p><b>Transfer data from trial database</b></p>";
		echo "<blockquote>";
		
		mysql_select_db($dbname);
		$file_in = fopen("script/transfer_data.txt","r");
		$i = 0;
		$query = "";
		$success = true;
		$trial_db = $trial_id . "_db";
		while(!feof($file_in)) {
			$str = fgets($file_in,10000);
			eval ("\$str = \"$str\";");
			if (trim($str) != "") {
				$query = $query . $str;
			} else {
				$isSuccess = mysql_query($query);
				Log::writeToFile("log.txt",$query . "\n\n");
				if(!$isSuccess) {
					$success = false;
					print("<li>SQL Statement $i cannot be executed.</li>\n");
					echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
					print("<p>");
					Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
				$i++;
				$query = "";
			}
		}
		
		$query2 = "SELECT group_name FROM PRODUCT_GROUP";
		$query_result_2 = mysql_query($query2);
		while ($rs2 = mysql_fetch_row($query_result_2)) {
			$product_group_table = $rs2[0];
			$product_group_table = strtoupper(str_replace(" ","_",$product_group_table));
			$product_group_table = strtoupper(str_replace("(","",$product_group_table));
			$product_group_table = strtoupper(str_replace(")","",$product_group_table));
			$product_group_table = strtoupper(str_replace("&","",$product_group_table));
			$product_group_table = strtoupper(str_replace("'","",$product_group_table));
			$product_group_table = strtoupper(str_replace("\\","",$product_group_table));
			$product_group_table = strtoupper(str_replace("?","",$product_group_table));
			$product_group_table = strtoupper(str_replace("!","",$product_group_table));
			$query = "CREATE TABLE $product_group_table (id INT UNSIGNED NOT NULL AUTO_INCREMENT, product_id INT UNSIGNED NOT NULL , sequence INT UNSIGNED NOT NULL , PRIMARY KEY(id))";
			$isSuccess = mysql_query($query);
			Log::writeToFile("log.txt",$query . "\n\n");
			if(!$isSuccess) {
				$success = false;
				echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
				Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			$query = "INSERT INTO $product_group_table (id,product_id,sequence) SELECT id, product_id, sequence FROM " . $trial_id . "_db." . $product_group_table;
			$isSuccess = mysql_query($query);
			Log::writeToFile("log.txt",$query . "\n\n");
			if(!$isSuccess) {
				$success = false;
				echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
				Log::writeToFile("log.txt","ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		
		$str = substr($user_id,0,8);
		if (substr($admin->company_url,0,3) == "www")
			$url = substr($admin->company_url,4);
		else
			$url = $admin->company_url;
		
		mysql_select_db($trial_db);
		$query = "SELECT filename FROM WEB_CONTENT WHERE component_type = 'custom'";
		$query_result = mysql_query($query);
		while($rs = mysql_fetch_row($query_result)) {
			$source_file = _ROOTPATH . "trial/$trial_id/" . $rs[0];
			$dest_file = "/www/" . $str . "/" . $url . "/" . $rs[0];
			copy($source_file,$dest_file);
		}
				
		$source_file = _ROOTPATH . "trial/$trial_id/images/";
		$dest_file = "/www/" . $str . "/" . $url . "/images/";
		if (file_exists($dest_file . "product/"))
			rmdir($dest_file . "product/");
		my_copy($source_file,$dest_file);
		
		if ($success) {
			echo "<p><b>Transfer Complete.</b></p>";
			Log::writeToFile("log.txt","Transfer Complete.\n\n");
		}
		fclose($file_in);
		
		echo "</blockquote>";		
	}
}

$db_connect->close();
?>
  </font></p>
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="control_panel.php" target="_parent">Back</a></font></p>
</body>
</html>
