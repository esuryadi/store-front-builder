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

$admin = new Admin();

$admin->mailCanceledTrialAccount($trial_id);
$admin->deleteExpiredAccount($trial_id);

$db_connect->close();
?>
<p><strong>Thank You For trying our online store Product.</strong></p>
<p><strong>Edward Suryadi<br>
  President &amp; CEO<br>
  <a href="http://www.suryadisoft.net">SuryadiSoft</a>  </strong></p>
