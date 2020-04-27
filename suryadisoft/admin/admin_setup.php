<?php
require_once "../class/Log.php";
require_once "config.php";

$log = new Log();
$conn = mysql_connect(_HOST,_USERID,_PASSWORD);
if (!$conn) {
	echo mysql_error();
	$log->write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}	
?>
<html>
<head>
<title>Admin Setup</title>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Admin 
  Setup</strong></font> 
<?php
echo "<p><b>Create Admin Database<b><p>";

$success = mysql_create_db(_ADMIN_DATABASE,$conn);
if (!$success) {
	echo mysql_error();
	$log->write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

echo "<blockquote>Admin Database has been created successfully</blockquote>";

$success = mysql_select_db(_ADMIN_DATABASE);

if ($success) {
	echo "<p><b>Create mini Admin table</b></p>";
	echo "<ul>";
	
	$file_in = fopen("script/admin_db.txt","r");
	$i = 0;
	$query = "";
	while(!feof($file_in)) {
		$str = fgets($file_in,10000);
		if (trim($str) != "") {
			$query = $query . $str;
		} else {
			$isSuccess = mysql_query($query);
			$log->write($query . "\n\n");
			if(!$isSuccess) {
				print("<li>Cannot create table.</li>\n");
				echo "<blockquote><b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error() . "</blockquote>";
				print("<p>");
				$log->write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			$i++;
			$query = "";
		}
	}
	$list_tables = mysql_list_tables(_ADMIN_DATABASE);
	for ($i=0;$i<mysql_num_rows($list_tables);$i++) {
		echo "<li>Table " . mysql_tablename($list_tables,$i) . " has been created.</li>\n";
		$log->write("Table " . mysql_tablename($list_tables,$i) . " has been created.\n\n");
	}		
	fclose($file_in);
	
	echo "</ul>";
	echo "<p><b>Inserting Admin Data</b></p>";
	
	$pwd = crypt("admin",'$1$d9lb2yxt$');
	$query = "INSERT INTO USER (user_id,password,first_name,last_name,email,role,status) VALUES ('admin','" . $pwd . "','Edward','Suryadi','webmaster@suryadisoft.net','Administrator','Active')";
	mysql_query($query);
	
	echo "<p><b>Admin Data has been inserted successfully</b></p>";
}

mysql_close($conn);
?>
</p>
<p><a href="login.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Login</font></a> 
</p>
</body>
</html>
