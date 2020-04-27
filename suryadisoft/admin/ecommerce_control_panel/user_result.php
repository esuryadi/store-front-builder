<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Create")
	$query = "INSERT INTO USER (user_id,user_password,user_email,user_first_name,user_last_name) VALUES ('$user_id','$user_password','$user_email','$user_first_name','$user_last_name')";
else if ($Action == "Update")
	$query = "UPDATE USER SET user_id = '$user_id', user_password = '$user_password', user_email = '$user_email', user_first_name = '$user_first_name', user_last_name = '$user_last_name' WHERE user_id = '$old_user_id'";
else if ($Action == "Delete")
	$query = "DELETE FROM USER WHERE user_id = '$user_id'";
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$isSuccess = mysql_query($query);
Log::write($query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
User Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=user.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
