<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (!session_is_registered("db_connect")) {
	$db_connect = new DBConnect(_HOST, _USERID, _PASSWORD);
	session_register("db_connect");
} else {
	$db_connect = $HTTP_SESSION_VARS["db_connect"];
}
$db_connect->open();
$isSuccess = $db_connect->getConnection();
$db_connect->close();
?>
<title>initialize...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=index.htm">
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
