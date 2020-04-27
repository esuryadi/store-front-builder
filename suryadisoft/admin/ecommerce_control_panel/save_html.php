<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";

$selected_db = $HTTP_SESSION_VARS["selected_db"];
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

$rootpath = "/www/" . $str . "/" . $url . "/";

if (strstr($filename,".htm") == "" && strstr($filename,".html"))
	$filename = $filename . "htm";

$file_path = $rootpath . $filename; 

if (!file_exists($file_path)) {
	touch($file_path);
	chmod($file_path,0777);
}
$out = fopen($file_path,"w");
fwrite($out,stripslashes($contents));
fclose($out);
?>
<meta http-equiv="refresh" content="0;URL=html_editor.php?filename=<?=$filename?>">
