<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT product_id FROM PRODUCT ORDER BY product_name LIMIT 1";	
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

<frameset rows="80,*,44" cols="*" framespacing="1" frameborder="NO" border="1">
  <frame src="product_navigation.php" name="topFrame" scrolling="NO" noresize>
  <frameset rows="*" cols="40%,60%" framespacing="2" frameborder="yes" border="2" bordercolor="#CCCCCC">
    <frame src="product.php" name="leftFrame">
    <frame src="product_info.php?product_id=<?=$id?>" name="rightFrame">
  </frameset>
  <frame src="product_button.php" name="bottomFrame" scrolling="NO" noresize>
</frameset>
<noframes><body>

</body></noframes>
</html>
