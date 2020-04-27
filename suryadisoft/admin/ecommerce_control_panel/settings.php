<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../../class/Payment.php";
require_once "../../class/Themes.php";
require_once "../../class/WebUser.php";
require_once "../../class/Transaction.php";
require_once "../../class/WishList.php";
require_once "../../class/Affiliate.php";
require_once "../config.php";
require_once "../../path_config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {
	$logout = true;
} else {
	if (!isset($Tab))
		$Tab = "General";
	$payment = new Payment();
	$admin = $HTTP_SESSION_VARS["admin_user"];
	
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT PROPERTY_NAME, PROPERTY_VALUE FROM PROPERTY";
	$query_result = mysql_query($query);
	$prop = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$prop[$rs[0]] = $rs[1];
	}
	
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	
	if ($Tab == "Themes") {
		$query = "SELECT * FROM THEMES ORDER BY theme_name";
		$query_result = mysql_query($query);
		$themes = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$themes[] = $rs[0]; 
		}
		if (!isset($selected_theme)) {
			if (isset($prop["selected_theme"]))
				$selected_theme = $prop["selected_theme"];
			else
				$selected_theme = $themes[0];
		}
		$query = "SELECT * FROM THEMES_COLOR_SCHEME WHERE theme_name = '$selected_theme' ORDER BY theme_color_scheme";
		$query_result = mysql_query($query);
		$color_schemes = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$color_schemes[] = $rs[1]; 
		}
		if (!isset($selected_color_scheme)) {
			if (isset($prop["selected_color_scheme"]))
				$selected_color_scheme = $prop["selected_color_scheme"];
			else
				$selected_color_scheme = $color_schemes[0];
		} else if (isset($ChangeTheme)) {
			$selected_color_scheme = $color_schemes[0];
		}
		$theme = new Themes();
		$properties = $theme->getProperties($selected_theme,$selected_color_scheme);
	} else if ($Tab == "PaymentServices") {
		if (!isset($payment_service))
			$payment_service = $payment->getPaymentService($userid);
	} else if ($Tab == "Messages") {
	
	} else if ($Tab == "AccountInfo") {
		$query = "SELECT CLIENTS.*, USER.first_name, USER.last_name FROM CLIENTS, USER WHERE CLIENTS.user_id = USER.user_id AND CLIENTS.user_id = '$userid'";
		$query_result = mysql_query($query);
		$rs = mysql_fetch_row($query_result);
		for ($i=0;$i<mysql_num_fields($query_result);$i++)
			$client [mysql_field_name($query_result,$i)] = $rs[$i];
			
		$query = "SELECT * FROM BILLING WHERE user_id = '$userid'";
		$query_result = mysql_query($query);
		$rs = mysql_fetch_row($query_result);
		for ($i=0;$i<mysql_num_fields($query_result);$i++)
			$billing [mysql_field_name($query_result,$i)] = $rs[$i];
			
		$query = "SELECT COMPONENT FROM CLIENT_COMPONENTS WHERE USER_ID = '" . $userid . "'";
		$query_result = mysql_query($query);
		$component = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$component[] = $rs[0];
		}
		if (isset($prop["payment_service"]))
			$payment_service = $prop["payment_service"];
		else {
			$query = "SELECT PAYMENT_SERVICE FROM CLIENT_PAYMENT_SERVICE WHERE USER_ID = '" . $userid . "'";
			$payment_service = mysql_fetch_row(mysql_query($query));
		}
	}
	
	$db_connect->close();
	
	$admin->retrieveAdminInfo($userid);
	
	$logout = false;
}
?>
<html>
<head>
<title>Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if ($logout) {?>
<script language="JavaScript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<script language="JavaScript" src="../../components/script/findDOM.js"></script>
<script language="JavaScript">
<!--
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function openURL(url) {
	open(url,"_self");
}

function changeBGColor(objectID,classname) {
	var dom = findDOM(objectID,0);
	dom.className = classname;
}

function changeThemes(form) {
	form.action = "settings.php?Tab=<?=$Tab?>&ChangeTheme=yes";
	form.method = "POST";
	form.submit();
}

function changeColorSchemes(form) {
	form.action = "settings.php?Tab=<?=$Tab?>&ChangeColorScheme=yes";
	form.method = "POST";
	form.submit();
}

function changePaymentService(payment_service) {
	url = "settings.php?Tab=<?=$Tab?>&payment_service=" + payment_service;
	open(url,"_self");
}

function changePaymentMethod(payment_method) {
	url = "settings.php?Tab=<?=$Tab?>&payment_service=Manual&payment_method=" + payment_method;
	open(url,"_self");
}

function changeMessageType(message_type) {
	url = "settings.php?Tab=<?=$Tab?>&message_type=" + message_type;
	open(url,"_self");
}

function changeSettingType(setting_type) {
	url = "settings.php?Tab=<?=$Tab?>&setting_type=" + setting_type;
	open(url,"_self");
}

function changeShippingMode(shipping_mode) {
	url = "settings.php?Tab=<?=$Tab?>&shipping_mode=" + shipping_mode;
	open(url,"_self");
}

function changeRateCalcMethod(form) {
	form.action = "settings.php?Tab=<?=$Tab?>";
	form.method = "POST";
	form.submit();
}

function setDefaultSettings(form) {
	form.action = "settings.php?Tab=<?=$Tab?>&DefaultSettings=true&AdvanceSettings=true";
	form.method = "POST";
	form.submit();
}

function setAdvanceSettings(form) {
	form.action = "settings.php?Tab=<?=$Tab?>&AdvanceSettings=true";
	form.method = "POST";
	form.submit();
}

function setBasicSettings(form) {
	form.action = "settings.php?Tab=<?=$Tab?>&AdvanceSettings=false";
	form.method = "POST";
	form.submit();
}

function refreshLeftMenu() {
	open("menu_middle.php?page=settings","middleFrame");
}

function selectUserAccount(form) {
	if (form.wish_list.checked)
		form.user_account.checked = true;
}

function unselectWishList(form) {
	if (form.user_account.checked == false)
		form.wish_list.checked = false;
}

function uploadImage(form,img_size) {
	form.action = "update_settings.php?Tab=<?=$Tab?>&Action=UploadImage";
	form.method = "POST";
	form.submit();
}

function uploadFile(form,file_type) {
	form.action = "update_settings.php?Tab=<?=$Tab?>&Action=UploadFile<? if (isset($setting_type)) {?>&setting_type=<?=$setting_type?><? }?>&file_type=" + file_type;
	form.method = "POST";
	form.submit();
}
// -->

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<style type="text/css">
<!--

td.active {
	background-color: #dddddd
}
td.inactive {
	background-color: #aaaaaa
}
td.over {
	background-color: #cccccc
}
.cursor {
	cursor: hand
}

-->
</style>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000" <? if ($Tab == "PaymentServices") {?>onLoad="refreshLeftMenu();"<? }?>>
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Settings</strong></font></p>
<table width="0" border="0" cellspacing="0" cellpadding="0">
    <tr>
  	<td id="General" class="<? if (isset($Tab) && $Tab == "General") {?>active<? } else {?>inactive<? }?>" onClick="openURL('settings.php?Tab=General');" <? if (!isset($Tab) || (isset($Tab) && $Tab != "General")) {?>onMouseOver="changeBGColor('General','over');" onMouseOut="changeBGColor('General','inactive');"<? }?> nowrap><img src="../../images/tab-general.gif"></td>
    <td id="Themes" class="<? if (isset($Tab) && $Tab == "Themes") {?>active<? } else {?>inactive<? }?>" onClick="openURL('settings.php?Tab=Themes');" <? if (!isset($Tab) || (isset($Tab) && $Tab != "Themes")) {?>onMouseOver="changeBGColor('Themes','over');" onMouseOut="changeBGColor('Themes','inactive');"<? }?> nowrap><img src="../../images/tab-themes-.gif"></td>
    <td nowrap class="<? if (isset($Tab) && $Tab == "PaymentServices") {?>active<? } else {?>inactive<? }?>" id="PaymentServices" onClick="openURL('settings.php?Tab=PaymentServices');" <? if (!isset($Tab) || (isset($Tab) && $Tab != "PaymentServices")) {?>onMouseOver="changeBGColor('PaymentServices','over');" onMouseOut="changeBGColor('PaymentServices','inactive');"<? }?>><img src="../../images/tab-payment_services.gif"></td>
		<td nowrap class="<? if (isset($Tab) && $Tab == "Shipping") {?>active<? } else {?>inactive<? }?>" id="Shipping" onClick="openURL('settings.php?Tab=Shipping');" <? if (!isset($Tab) || (isset($Tab) && $Tab != "Shipping")) {?>onMouseOver="changeBGColor('Shipping','over');" onMouseOut="changeBGColor('Shipping','inactive');"<? }?>><img src="../../images/tab-shipping.gif" alt="Shipping"></td>
		<td id="Messages" class="<? if (isset($Tab) && $Tab == "Messages") {?>active<? } else {?>inactive<? }?>" onClick="openURL('settings.php?Tab=Messages');" <? if (!isset($Tab) || (isset($Tab) && $Tab != "Messages")) {?>onMouseOver="changeBGColor('Messages','over');" onMouseOut="changeBGColor('Messages','inactive');"<? }?> nowrap><img src="../../images/tab-messages.gif" alt="Messages"></td>
		<td id="AccountInfo" class="<? if (isset($Tab) && $Tab == "AccountInfo") {?>active<? } else {?>inactive<? }?>" onClick="openURL('settings.php?Tab=AccountInfo');" <? if (!isset($Tab) || (isset($Tab) && $Tab != "AccountInfo")) {?>onMouseOver="changeBGColor('AccountInfo','over');" onMouseOut="changeBGColor('AccountInfo','inactive');"<? }?> nowrap><img src="../../images/tab-account_info.gif"></td>
    </tr>
  </table>
<table width="100%" border="5" cellspacing="0" cellpadding="5" bordercolor="dddddd">
  <tr>
    <td bgcolor="#dddddd">&nbsp;</td>
  </tr>
  <tr> 
    <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font>  
      <? if ($Tab == "General") {
      	include "general_settings.php";
      } else if ($Tab == "Themes") {
				include "theme_settings.php";
			} else if ($Tab == "PaymentServices") {
				include "payment_settings.php";			
      } else if ($Tab == "Shipping") {
				include "shipping_settings.php"; 
			} else if ($Tab == "Messages") {
      	include "message_settings.php"; 
      } else if ($Tab == "AccountInfo") {
      	include "client_info_settings.php";
      }?>
    </td>
  </tr>
</table>
</body>
</html>
<? if (isset($Mode) && $Mode == "wizard") {?>
<script language="JavaScript">
window.open("wizard_title.php?step=4","wizard_title");
window.open("wizard_button.php?step=4","wizard_button");
</script>
<? }?>