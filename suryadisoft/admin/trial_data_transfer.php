<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once "config.php";
require_once "../path_config.php";

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

$admin = new Admin();
$admin->retrieveAdminInfo($user_id);

$db_connect = new DBConnect(_HOST, _USERID, _PASSWORD);
$db_connect->open();

	if (isset($trial_id)) {
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
	
$db_connect->close();
?>
