<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

if ($Action == "Add")
	$query = "INSERT INTO SALES_TAX (sales_tax_state,sales_tax_rate) VALUES ('$sales_tax_state',$sales_tax_rate)";
else if ($Action == "Update")
	$query = "UPDATE SALES_TAX SET sales_tax_state = '$sales_tax_state', sales_tax_rate = $sales_tax_rate WHERE sales_tax_id = $sales_tax_id";
else if ($Action == "Delete")
	$query = "DELETE FROM SALES_TAX WHERE sales_tax_id = $sales_tax_id";
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$isSuccess = mysql_query($query);
Log::write($query . "\n\n");
if(!$isSuccess) {
	print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
	echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
	print("<p>");
	Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
Sales Tax Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=sales_tax.php">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
