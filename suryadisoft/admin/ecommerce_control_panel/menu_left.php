<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../../class/Payment.php";
require_once "../../class/WebContent.php";
require_once "../config.php";
define("_DB",$HTTP_SESSION_VARS["selected_db"]);

if (!session_is_registered("db_connect") || $HTTP_SESSION_VARS["db_connect"] == NULL) {
	$logout = true;
} else {
	$payment = new Payment();
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$query_result = mysql_query($query);
	$rs = mysql_fetch_row($query_result);
	$userid = $rs[0];
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT PROPERTY_NAME, PROPERTY_VALUE FROM PROPERTY";
	$query_result = mysql_query($query);
	$prop = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$prop[$rs[0]] = $rs[1];
	}
	$HTTP_SESSION_VARS["db_connect"]->close();
	$logout = false;
}
?>
<html>
<head>
<title>Menu Left</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if ($logout) {?>
<script language="JavaScript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
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
'  text-decoration:underline;'+
'  padding:0 0 0 '+motionPix+';'+
'  }'+
'</style>'
if (document.all || document.getElementById){
    document.write(a)
}

var width = screen.width - 100;
var height = screen.height - 150;
</script>

<body vlink="00aeef" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<br>

<table width="150" border="0" cellpadding="0" cellspacing="0" bgcolor="#eeeeee">
  <tr> 
    <td></td>
    <td></td>
    <td align="right" valign="top"><img src="../../images/corner-tr.gif"></td>
  </tr>
  <tr> 
    <td>&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<? if ($page == "tools") {?>
      <p><b><a class="InstantLink" href="ftp.php" target="mainFrame">Upload Files</a></b></p>
      <p><b><a class="InstantLink" href="ups_tool.htm" target="mainFrame">UPS Tool</a></b></p>
      <p><b><a href="export_form.php" target="mainFrame" class="InstantLink">Export 
        Catalog</a></b></p>
      <p><b><a href="import_form.php" target="mainFrame" class="InstantLink">Import 
        Catalog</a></b></p>
      <p><b><a class="InstantLink" href="http://72.3.139.160:55970/" target="mainFrame">Web 
        Hosting Control Panel</a></b></p>
      <p><b><a href="http://<?=$HTTP_SESSION_VARS["admin_user"]->getCompanyURL()?>/webalizer/index.html" target="mainFrame" class="InstantLink">Statistic</a></b></p>
			<p><b><a href="http://www.submitnet.net/affiliates.asp?aid=109&pid=1" target="mainFrame" class="InstantLink">Search 
        Engine Submission</a></b></p>
			<p><b><a href="affiliate.php" target="mainFrame" class="InstantLink">Affiliates 
        Program</a></b></p>
      <p><b><a href="html_editor.php" target="mainFrame" class="InstantLink">HTML Editor</a></b></p>
      <p></p>
      <? } else if ($page == "support") {?>
      <p><b><a class="InstantLink" href="support.php" target="mainFrame">Technical 
        Support</a></b></p>
      <? if ($HTTP_SESSION_VARS["admin_user"]->getRole() != "Administrator") {?>
      <p><b><a class="InstantLink" href="change_password.php" target="mainFrame">Change Store Manager
        Password</a></b></p>
	  <p><b><a class="InstantLink" href="change_ftp_password.php" target="mainFrame">Change FTP
        Password</a></b></p>
      <? }?>
      <p><b><a class="InstantLink" href="feedback_form.php" target="mainFrame">Feeback/Suggestion</a></b></p>
      <p><b><a class="InstantLink" href="upgrade_request_form.php" target="mainFrame">Upgrade 
        Requests</a></b></p>
      <p></p>
      <? } else if ($page == "manage_store") {?>
      <strong><b>Manage:</b></strong> </font></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="../../images/spacer.gif" width="10"></td>
          <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <? if (($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator" || 
							 array_search("User Account",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1 &&
							 WebContent::getPropertyValue("user_account") != "no")) {?>
            <a class="InstantLink" href="user.php" target="mainFrame">User</a> 
            <br>
            <? }?>
            <a class="InstantLink" href="web_content_frame.php?" target="mainFrame">Store 
            Components<b> </b></a><br>
            &nbsp;&nbsp;<a class="InstantLink" href="categories_frame.php?" target="mainFrame">Categories</a><br>
						&nbsp;&nbsp;&nbsp;&nbsp;<a class="InstantLink" href="order_categories.php?cat=main" target="mainFrame">Order Main Cat</a><br>
            &nbsp;&nbsp;<a class="InstantLink" href="links.php?" target="mainFrame">Links</a><br>
            <a class="InstantLink" href="product_frame.php" target="mainFrame">Products/Inventory</a><br>
						<? if (($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator" || 
						  array_search("User Account",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1)) {?>
						&nbsp;&nbsp;<a class="InstantLink" href="special_pricing.php" target="mainFrame">Special Pricing</a><br>
						<? }?>
						&nbsp;&nbsp;<a class="InstantLink" href="product_coupon.php" target="mainFrame">Product Coupons</a><br>
            &nbsp;&nbsp;<a class="InstantLink" href="volume_discount.php" target="mainFrame">Volume Discount</a><br>
						&nbsp;&nbsp;<a class="InstantLink" href="product_images_gallery.php" target="mainFrame">Images Gallery</a><br>
						<a href="product_group.php" target="mainFrame" class="InstantLink">Product 
            Group</a><br>
            <a class="InstantLink" href="customer.php" target="mainFrame">Customer</a><br>
            <? if (($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator" || 
						  array_search("User Account",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1)) {?>
            <? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator" || 
								array_search("Shopping Cart",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1 &&
								WebContent::getPropertyValue("user_account") != "no") {?>
            <a class="InstantLink" href="shopping_cart.php" target="mainFrame">Shopping 
            Cart</a><br>
            <? }?>
            <? }?>
            <? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator" || 
						 (array_search("Wish List",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1 
						  && array_search("User Account",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1
							&& WebContent::getPropertyValue("user_account") != "no"
							&& WebContent::getPropertyValue("wish_list") != "no")) {?>
            <a class="InstantLink" href="wish_list.php" target="mainFrame">Wish 
            List</a><br>
            <? }?>
            <? if (isset($prop["shipping_mode"]) && $prop["shipping_mode"] == "manual") {?>
            <a class="InstantLink" href="shipping_rate.php" target="mainFrame">Shipping 
            Rate</a><br>
            &nbsp;&nbsp;<a class="InstantLink" href="shipping_vendor.php" target="mainFrame">Shipping 
            Vendor</a><br>
            <? }?>
			<a class="InstantLink" href="group_shipping_rate.php" target="mainFrame">Group Shipping Rate</a><br>
            <a class="InstantLink" href="sales_tax.php" target="mainFrame">Sales 
            Tax</a><br>
            <a class="InstantLink" href="transaction_frame.php" target="mainFrame">Transactions/Orders</a> 
            <? }?>
            </font> </td>
  </tr>
</table>
      </b></font></td>
    <td></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr> 
    <td></td>
    <td></td>
    <td align="right" valign="bottom"><img src="../../images/corner-br.gif" width="8" height="8"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>