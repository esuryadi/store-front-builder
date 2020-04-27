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
	if ($Action == "Delete") {
		$HTTP_SESSION_VARS["db_connect"]->open();
		mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
		$query = "SELECT PRODUCT_ID, SHOPPING_CART_QUANTITY FROM SHOPPING_CART WHERE ID = $id";
		$query_result = mysql_query($query);
		$rs = mysql_fetch_row($query_result);
		$HTTP_SESSION_VARS["db_connect"]->close();
		$cart->updateInventory($rs[0],$rs[1]);
		$HTTP_SESSION_VARS["db_connect"]->open();
		$query = "DELETE FROM SHOPPING_CART WHERE ID = $id";
	} else if ($Action == "Empty") {
		$HTTP_SESSION_VARS["db_connect"]->open();
		mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
		$query = "SELECT PRODUCT_ID, SHOPPING_CART_QUANTITY FROM SHOPPING_CART";
		$query_result = mysql_query($query);
		$HTTP_SESSION_VARS["db_connect"]->close();
		while ($rs = mysql_fetch_row($query_result)) {
			$cart->updateInventory($rs[0],$rs[1]);
			$HTTP_SESSION_VARS["db_connect"]->open();
		}
		$query = "DELETE FROM SHOPPING_CART";
	}
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	mysql_query($query);
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Shopping Cart Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="0;URL=shopping_cart.php">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

</body>
</html>
