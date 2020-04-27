<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/ShoppingCart.php";
require_once "../../class/Product.php";
require_once("../config.php");
define("_DB",$HTTP_SESSION_VARS["selected_db"]);
?>
<html>
<head>
<?php
$cart = new ShoppingCart();

if (isset($Action)) {
	$HTTP_SESSION_VARS["db_connect"]->open();
	if ($Action == "Delete") {
		mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
		$query = "SELECT PRODUCT_ID, WISH_LIST_QUANTITY FROM WISH_LIST WHERE ID = $id";
		$query_result = mysql_query($query);
		$rs = mysql_fetch_row($query_result);
		$query = "DELETE FROM WISH_LIST WHERE ID = $id";
	} else if ($Action == "Empty") {
		mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
		$query = "SELECT PRODUCT_ID, WISH_LIST_QUANTITY FROM WISH_LIST";
		$query_result = mysql_query($query);
		$query = "DELETE FROM WISH_LIST";
	}
	mysql_query($query);
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Wish List Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="0;URL=wish_list.php">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

</body>
</html>
