<?php
require_once "../class/Log.php";
require_once "config.php";
	
$log = new Log();
$conn = mysql_connect(_HOST,_USERID,_PASSWORD);
if (!$conn) {
	echo mysql_error();
	$log->write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}	

$success = mysql_select_db(_ADMIN_DATABASE);

if ($success) {
	echo "<p><b>Reset Admin Password</b></p>";
	
	$pwd = crypt("kkotan",'$1$d9lb2yxt$');
	$query = "UPDATE USER SET password = '$pwd'  where user_id = 'admin'";
	mysql_query($query);
	
	echo "<p><b>Admin has been reset successfully</b></p>";
}

mysql_close($conn);
?>
</p>
<p><a href="login.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Login</font></a> 
</p>
</body>
</html>
