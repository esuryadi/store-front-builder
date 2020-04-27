<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";

$admin = $HTTP_SESSION_VARS["admin_user"];
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();
mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
$rs = mysql_fetch_row(mysql_query($query));
$userid = $rs[0];
$db_connect->close();
$admin->retrieveAdminInfo($userid);

if (substr($admin->getUserId(),0,4) == "test" || substr($admin->getUserId(),0,5) == "trial" || $admin->getUserId() == "demo1" || $admin->getUserId() == "demo2" || $admin->getUserId() == "demo")
	$str = "wwwuser";
else
	$str = substr($admin->getUserId(),0,8);
if (substr($admin->getCompanyURL(),0,3) == "www")
	$url = substr($admin->getCompanyURL(),4);
else
	$url = $admin->getCompanyURL();
$rootpath = "/www/" . $url . "/httpdocs/";

if (isset($dirpath))
	$dirpath = urldecode($dirpath);
else if (isset($parentdir))
	$dirpath = urldecode($parentdir);
else
	$dirpath = $rootpath;
if (!isset($parentdir))
	$parentdir = urldecode($rootpath);
if (isset($updir)) {
	$dirpath = $updir;
	$dir = opendir($updir);
	$n = 0;
	do {
		$n = strpos($updir,"/",$n);
		$n++;
	} while (strpos($updir,"/",$n));
	$updir = substr($updir,0,$n); 
} else {
	$updir = $parentdir;
	$dir = opendir($dirpath);
}
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table>
<tr>
	<td nowrap>
	<a href="file_tree.php?updir=<?=urlencode($updir)?>"><img src="images/up_dir.gif" border="0"></a> 
	<img src="images/folder_open.gif">
	</td>
	<td nowrap><b><?=$dirpath?></b></td>
</tr>
</table>

<table border="0" cellpadding="3" cellspacing="1">
<tr>
	  <th colspan="2" bgcolor="#CCCCCC">Directory/Filename</th>
	  <th bgcolor="#CCCCCC">Size</th>
</tr>
<? while ($filename = readdir($dir)) {?>
	<tr>
	<? if (is_file($dirpath . "/" . $filename)) {?>
		<td align="right"><img src="images/file.gif"></td>
		<td width="100"><?=$filename?></td>
	<? } else {?>
		<td><img src="images/folder_close.gif"></td>
		<td width="300"><b><a href="file_tree.php?parentdir=<?=urlencode($dirpath)?>&dirpath=<?=urlencode($dirpath . "/" . $filename)?>"><?=$filename?></a></b></td>
	<? }?>
	<td align="right"><?=filesize($dirpath . "/" . $filename)?></td>
	</tr>
<? }?>
</table>
</body>
</html>
<? closedir($dir);?>