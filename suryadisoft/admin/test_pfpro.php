<?php
$pfpro["TRXTYPE"] = "S";
$pfpro["TENDER"] = "C";
$pfpro["USER"] = "es7911ca";
$pfpro["PWD"] = "sweetchien76";
$pfpro["VENDOR"] = "es7911ca";
$pfpro["PARTNER"] = "tmerchant";
$pfpro["ORDERDATE"] = date("mdy");
$pfpro["DESC"] = "test";;
$pfpro["ACCT"] = "4111111111111111";
$pfpro["EXPDATE"] = "1207";
$pfpro["AMT"] = 20.00;
pfpro_init();
$trx = pfpro_process($pfpro,"test-payflow.verisign.com",443,30);
		
$result = $trx["RESULT"];
$message = $trx["RESPMSG"];
		
if ($result != 0) {
	$msg = system("service httpd restart");
	mail("edward@suryadisoft.net" , "PFPRO Module Error" , $message . "\n\n" . "Try to restart the httpd service:\n\n" . $msg);
}
?>