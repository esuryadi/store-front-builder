<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (!session_is_registered("db_connect") || $HTTP_SESSION_VARS["db_connect"] == NULL) {
	$db_connect = new DBConnect("localhost", _USERID, _PASSWORD);
	session_register("db_connect");
} else {
	$db_connect = $HTTP_SESSION_VARS["db_connect"];
}
$db_connect->open();
$isSuccess = $db_connect->getConnection();
$db_connect->close();

if (isset($Action) && !session_is_registered("admin_user")) {
	$admin_user = new Admin();
	$admin_user->setUserId($userid);
	$admin_user->setPassword($password);
	$admin_user->retrieveAdminInfo($userid);
	session_register("admin_user");
}

if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {
	$client_db = $HTTP_SESSION_VARS["admin_user"]->getClientDBs();
	if (!session_is_registered("client_db"))
		session_register("client_db");
	if (count($client_db) > 0)
		$selected_db = $client_db[0];
	else
		$selected_db = "";
} else
	$selected_db = $HTTP_SESSION_VARS["admin_user"]->getClientDB();

if (!session_is_registered("selected_db") && $selected_db != "")
	session_register("selected_db");
?>
<title>initialize...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($selected_db == "") {?>
<meta http-equiv="refresh" content="0;URL=../initialize.php">
<? } else if($isSuccess) {?>
	<? if (isset($component) && $component == "product") {?>
	<meta http-equiv="refresh" content="0;URL=product.php?Action=Add&Mode=wizard&component=<?=$component?>&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<?=$comp_type?>">
	<? } else if (isset($component) && $component == "other") {?>
	<meta http-equiv="refresh" content="0;URL=component_properties_frame.php?Action=Update&component=<?=$component?>&selected_component=<?=$selected_component?>&id=<?=$id?>">
	<? } else {?>
	<meta http-equiv="refresh" content="0;URL=index.htm">
	<? }?>
<? } else {?>
<meta http-equiv="refresh" content="0;URL=../login.php?Action=DBConnectionFailed">
<? }?>
</head>

<body vlink="00aeef">

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? if($isSuccess) {?>

<h2 align="center"><font color="00aeef" face="Verdana, Arial, Helvetica, sans-serif">Initialize 
  ...</font></h2>

<? } else {?>
<script language="JavaScript">alert("Database Connection is Failed!");</script>
<? }?>
</body>
</html>
