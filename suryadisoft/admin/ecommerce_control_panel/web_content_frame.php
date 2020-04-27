<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (!session_is_registered("db_connect") || $HTTP_SESSION_VARS["db_connect"] == NULL) {
	$db_connect = new DBConnect("localhost", _USERID, _PASSWORD);
	session_register("db_connect");
} 
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

if (!isset($cat))
	$cat = 'Home';
	
$query = "SELECT id FROM WEB_CONTENT where category = 'All Category' OR category = '$cat' ORDER BY sequence LIMIT 1";	
$query_result = mysql_query($query);
$rs = mysql_fetch_row($query_result);
$id = $rs[0];

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<frameset rows="*,44" cols="*" frameborder="NO" border="0" framespacing="0">
  <frameset rows="*" cols="70%,30%" framespacing="0" frameborder="YES" border="1">
    <frame src="web_content.php?cat=<?=urlencode($cat)?>" name="leftFrame">
    <frame src="web_content_info.php?id=<?=$id?>" name="rightFrame">
  </frameset>
  <frame src="web_content_button.php?cat=<?=urlencode($cat)?>" name="buttonFrame" scrolling="NO" noresize>
</frameset>
<noframes><body>

</body></noframes>
</html>
