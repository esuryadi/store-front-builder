<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Log.php";
require_once "../class/Admin.php";
require_once("config.php");
require_once("../path_config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

$query = "SELECT * FROM TRIAL_ORDER";
$query_result = mysql_query($query);
$admin = new Admin();

while ($rs = mysql_fetch_array($query_result)) {
	$secs1 = mktime(0,0,0,date("m"),date("d"),date("Y"));
	$secs2 = mktime(0,0,0,substr($rs["order_date"],5,2),substr($rs["order_date"],8,2),substr($rs["order_date"],0,4));
	$elapsed = floor(($secs1 - $secs2)/86400);
	if ($elapsed < 10) {
		$admin->mailAccountActivation($rs["user_id"],$elapsed);
	} else if ($elapsed == 10) {
		$admin->mailAccountActivation2($rs["user_id"]);
	} else {
		$admin->mailExpiredNotification($rs["id"]);
		$admin->deleteExpiredAccount($rs["user_id"]);
	}
}

$db_connect->close();
?>
