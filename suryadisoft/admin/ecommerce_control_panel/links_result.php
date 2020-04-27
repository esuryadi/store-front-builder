<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Create")
	$query = "INSERT INTO LINK (link_type,link_text,link_img_src,link_url,link_position,link_target,sequence) VALUES ('$link_type','$link_text','$link_img_src','$link_url','$link_position','$link_target','$sequence')";
else if ($Action == "Update")
	$query = "UPDATE LINK SET link_type = '$link_type', link_text = '$link_text', link_img_src = '$link_img_src', link_url = '$link_url', link_position = '$link_position', link_target = '$link_target', sequence = '$sequence' WHERE link_id = $link_id";
else if ($Action == "Delete")
	$query = "DELETE FROM LINK WHERE link_id = $link_id";
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
Link Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=links.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
