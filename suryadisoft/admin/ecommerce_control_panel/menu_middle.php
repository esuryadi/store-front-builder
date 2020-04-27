<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../../class/Payment.php";
require_once "../config.php";

if (!session_is_registered("db_connect") || $HTTP_SESSION_VARS["db_connect"] == NULL) {
	$logout = true;
} else {
	$payment = new Payment();
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	$HTTP_SESSION_VARS["db_connect"]->close();
	$logout = false;
}
//onclick="window.open('wizard.php','wizard','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=50,left=50,width=' + width + ',height=' + height);"
?>
<html>
<head>
<title>menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if ($logout) {?>
<script language="JavaScript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: smaller;
}
-->
</style>
</head>
<script language="JavaScript">

var coldColor = "#000000"
var hotColor  = "#00AEEF"
var motionPix = "0"
var a='<style>'+
'A.InstantLink:link {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;'+
'  }'+  
'A.InstantLink:visited {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;}'+  
'A.InstantLink:active {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;'+
'  }'+  
'A.InstantLink:hover {'+
'  color:'+hotColor+';'+
'  text-decoration:none;'+
'  padding:0 0 0 '+motionPix+';'+
'  }'+
'</style>'
if (document.all || document.getElementById){
    document.write(a)
}

var width = screen.width - 100;
var height = screen.height - 150;

function refreshPage(page) {	
	window.open("menu_middle.php?page=" + page,"middleFrame");
}
</script>
<body leftmargin="0" topmargin="0">
<table width="100%" border="0" cellpadding="1" bgcolor="#333333">
  <tr align="center"> 
    <td width="90" bgcolor="<? if($page == "settings") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="settings.php" target="bottomFrame" onClick="refreshPage('settings');">Settings</a></strong></td>
    <td width="170" bgcolor="<? if($page == "wizard") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="wizard_step_1.php" target="bottomFrame" onClick="refreshPage('wizard');">Store Builder Wizard</a></strong></td>
		<td width="130" bgcolor="<? if($page == "manage_store") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="menu_bottom.php?page=manage_store" target="bottomFrame" onClick="refreshPage('manage_store');">Manage Store</a></strong></td>
    <td width="90" bgcolor="<? if($page == "support") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="menu_bottom.php?page=support" target="bottomFrame" onClick="refreshPage('support');">Support</a></strong></td>
    <td width="70" bgcolor="<? if($page == "tools") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="menu_bottom.php?page=tools" target="bottomFrame" onClick="refreshPage('tools');">Tools</a></strong></td>
    <td width="110" bgcolor="<? if($page == "view_store") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="http://<?=$HTTP_SESSION_VARS["admin_user"]->getCompanyURL()?>" target="bottomFrame" onClick="refreshPage('view_store');">View Store</a></strong></td>
		<? if ($payment->getPaymentService($userid) != "" && $payment->getPaymentService($userid) != "Manual") {?>
		<td width="<? if ($payment->getPaymentService($userid) == "PayPal") {?>80<? } else if ($payment->getPaymentService($userid)== "VeriSign PayFlow Link" || $payment->getPaymentService($userid) == "VeriSign PayFlow Pro") {?>150<? } else {?>140<? }?>" bgcolor="<? if($page == "payment") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="<? if ($payment->getPaymentService($userid) == "PayPal") {?>http://www.paypal.com<? } else if ($payment->getPaymentService($userid)== "VeriSign PayFlow Link" || $payment->getPaymentService($userid) == "VeriSign PayFlow Pro") {?>https://manager.verisign.com<? } else {?>https://merchant.authorize.net/<? }?>" target="_blank" onClick="refreshPage('payment');">
      <? if ($payment->getPaymentService($userid) == "PayPal") {?>
      PayPal
      <? } else if ($payment->getPaymentService($userid)== "VeriSign PayFlow Link" || $payment->getPaymentService($userid) == "VeriSign PayFlow Pro") {?>
      VeriSign Manager
			<? } else {?>
			Authorize.Net
      <? }?>
      </a></strong></td>
		<? }?>
	<? if (substr($HTTP_SESSION_VARS["admin_user"]->getUserId(),0,5) == "trial") {?>
	<td width="*" bgcolor="<? if($page == "activate") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>" nowrap><strong><a class="InstantLink" href="http://www.suryadisoft.net/suryadisoft.php?page=Pricing&subpage=StorePricing&trial_id=<?=$HTTP_SESSION_VARS["admin_user"]->getUserId()?>" target="activate" onClick="refreshPage('activate');">Activate Trial Account</a></strong></td>
	<? } else {?>
		<td width="*" bgcolor="#EEEEEE">&nbsp;</td>
	<? }?>
    <td width="70" bgcolor="<? if($page == "help") {?>#FFFF66"<? } else {?>#EEEEEE<? }?>"><strong><a class="InstantLink" href="help/index.htm" target="bottomFrame" onClick="refreshPage('help');">Help</a></strong></td>
  </tr>
</table>
</body>
</html>