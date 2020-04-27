<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT transaction_id, customer_id FROM TRANSACTION ORDER BY transaction_date_time DESC LIMIT 1";	
$query_result = mysql_query($query);
$rs = mysql_fetch_row($query_result);
$id = $rs[0];
$customer_id = $rs[1];

$HTTP_SESSION_VARS["db_connect"]->close();
?>

<frameset rows="80,*,44" cols="*" framespacing="1" frameborder="NO" border="1">
  <frame src="transaction_navigation.php" name="topFrame" scrolling="NO" noresize>
  <frameset rows="*,119" cols="*" framespacing="1" frameborder="yes" border="1">	
	<frameset rows="*" cols="62%,38%" framespacing="2" frameborder="yes" border="2" bordercolor="#CCCCCC">
  		<frame src="transaction.php<? if (isset($status)) {?>?status=<?=$status?><? }?>" name="leftFrame">
    	<frame src="transaction_info.php?transaction_id=<?=$id?>" name="rightFrame">
  	</frameset>
	<frame src="purchase_info.php?transaction_id=<?=$id?>&customer_id=<?=$customer_id?>" name="middleFrame">
  </frameset>
  <frame src="transaction_button.php?transaction_id=<?=$id?>" name="bottomFrame" scrolling="NO" noresize>
</frameset><noframes></noframes>

