<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT order_id,company_name FROM PURCHASE_ORDER WHERE build_status = 'in process'";	
$query_result = mysql_query($query);

$clients = Array();
while($rs = mysql_fetch_row($query_result)) {
	$client["id"] = $rs[0];
	$client["name"] = $rs[1];
	$client["order_type"] = "purchase";
	$clients [] = $client;
}

$query = "SELECT id,first_name,last_name FROM TRIAL_ORDER WHERE build_status = 'pending'";	
$query_result = mysql_query($query);

while($rs = mysql_fetch_row($query_result)) {
	$client["id"] = $rs[0];
	$client["name"] = $rs[1] . " " . $rs[2];
	$client["order_type"] = "trial";
	$clients [] = $client;
}
	
if (isset($order_id) && $order_id != "") {
	if ($order_type == "purchase") {
		$query = "SELECT * FROM PURCHASE_ORDER WHERE build_status = 'in process' AND order_id = $order_id";	
		$rs2 = mysql_fetch_array(mysql_query($query));
	} else if ($order_type == "trial") {
		$query = "SELECT * FROM TRIAL_ORDER WHERE build_status = 'pending' AND id = $order_id";	
		$rs2 = mysql_fetch_array(mysql_query($query));
	}
}

$db_connect->close();
?>
<html>
<head>
<title>Mini eCommerce Setup</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--

function getClientData(value) {
	var order_id = value.substring(0,value.indexOf(";"));
	var order_type = value.substr(value.indexOf(";")+1);
	open("moderate_clients.php?order_id=" + order_id + "&order_type=" + order_type,"_self");
}

function selectUserAccount(form) {
	if (form.wishlist.checked)
		form.useraccount.checked = true;
}

function unselectWishList(form) {
	if (form.useraccount.checked == false)
		form.wishlist.checked = false;
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";

	if (form.user_id.value == "") {
		is_valid = false;
		err_msg = err_msg + "User ID cannot be empty\n";
	}

	if (form.password.value == "") {
		is_valid = false;
		err_msg = err_msg + "Password cannot be empty\n";
	}

	if (form.email.value == "") {
		is_valid = false;
		err_msg = err_msg + "Email cannot be empty\n";
	}
	
	if (form.company_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Company Name cannot be empty\n";
	}

	if (form.company_url.value == "") {
		is_valid = false;
		err_msg = err_msg + "Company URL cannot be empty\n";
	}

	if (form.company_email.value == "") {
		is_valid = false;
		err_msg = err_msg + "Company Email cannot be empty\n";
	}
		
	if (form.dbname.value == "") {
		is_valid = false;
		err_msg = err_msg + "Database Name cannot be empty\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
//-->
</script>
</head>



<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Moderate 
  Clients</strong></font></p>
<form name="minieCommerceSetupForm" method="post" action="moderate_clients_result.php" enctype="multipart/form-data">
  <? if (isset($order_type)) {?>
	<input type="hidden" name="order_type" value="<?=$order_type?>">
	<? }?>
	<p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1"><strong>Clients:</strong></font></font> 
    <select name="order_id" onChange="getClientData(this.value);">
      <option value="">-Select Client-</option>
			<? for($i=0;$i<count($clients);$i++) {
				$client = $clients[$i];?>
			<option value="<?=$client["id"]?>;<?=$client["order_type"]?>" <? if(isset($order_id) && $order_id == $client["id"]) {?>selected<? }?>><?=$client["name"]?></option>
			<? }?>
    </select>
  </p>

  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>User 
    Information:</strong></font></p>

  <blockquote> 

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">User ID:<b> 
      <input type="text" name="user_id" value="<? if (isset($rs2) && $order_type == "trial") {?><?=$rs2["user_id"]?><? }?>">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Password: 
      <b> 
      <input type="text" name="password" value="<? if (isset($rs2) && $order_type == "trial") {?><?=$rs2["user_id"]?><? }?>">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">First Name:<b> 
      <input type="text" name="first_name" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["client_first_name"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["first_name"]?><? }?>">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Last Name: 
      <b> 
      <input type="text" name="last_name" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["client_last_name"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["last_name"]?><? }?>">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Email: <b> 
      <input type="text" name="email" value="<? if (isset($rs2) && $order_type == "trial") {?><?=$rs2["email"]?><? }?>">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Role:<b> 
      <select name="role">
        <option value="Administrator">Administrator</option>
        <option value="User" selected>User</option>
      </select>
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Status:<b> 
      <select name="status">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
        <option value="Suspended">Suspended</option>
      </select>
      </b></font></p>
  </blockquote>

  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Client Information:</b></font></p>

  <blockquote> 
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Company Name:<b> 
      <input type="text" name="company_name" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_name"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["last_name"]?><? }?>">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Company URL: 
      <b> 
      <input type="text" name="company_url" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["domain_name"]?><? } else if (isset($rs2) && $order_type == "trial") {?>www.suryadisoft.net/trial/<?=$rs2["user_id"]?><? }?>">
      </b></font></p>
    <table width="421" border="0" cellspacing="5" cellpadding="0">
      <tr> 

        <td width="158"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Company 
          Address:</font></td>

        <td width="248"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
          <input type="text" name="company_address_1" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_address_1"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["address_1"]?><? }?>" size="40">
          </font></td>
      </tr>
      <tr> 
        <td width="158">&nbsp;</td>
        <td width="248"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
          <input type="text" name="company_address_2" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_address_2"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["address_2"]?><? }?>" size="40">
          </font></td>
      </tr>
      <tr> 
        <td width="158">&nbsp;</td>

        <td width="248"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">City:<b> 
          <input type="text" name="company_city" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_city"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["city"]?><? }?>" size="15">
          </b>State:<b> 
          <input type="text" name="company_state" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_state"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["state"]?><? }?>" size="2">
          </b> Zip:<b> 
          <input type="text" name="company_zip" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_zip"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["zip"]?><? }?>" size="5">
          </b></font></td>
      </tr>
      <tr> 
        <td width="158">&nbsp;</td>

        <td width="248"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Country: 
          <b> 
          <input type="text" name="company_country" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_country"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["country"]?><? } else {?>United States<? }?>">
          </b></font></td>
      </tr>
    </table>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Company Phone:<b> 
      <input type="text" name="company_phone" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_phone"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["phone"]?><? }?>" size="12">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Company Fax:<b> 
      <input type="text" name="company_fax" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_fax"]?><? }?>" size="12">
      </b></font></p>

    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Company Email:<b> 
      <input type="text" name="company_email" value="<? if (isset($rs2) && $order_type == "purchase") {?><?=$rs2["company_email"]?><? } else if (isset($rs2) && $order_type == "trial") {?><?=$rs2["email"]?><? }?>">
      </b></font></p>
  </blockquote>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Trial 
    ID:</strong>
	<? if (isset($rs2) && $order_type == "purchase" && $rs2["trial_id"] != "") {?>
	<b> 
    <input type="hidden" name="trial_id" value="<?=$rs2["trial_id"]?>"><?=$rs2["trial_id"]?>
    </b></font>
	<? } else {?>
	<input type="text" name="trial_id" value="">
	<? }?>
	</p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Database 
    Name:</strong><b> 
    <input type="text" name="dbname" value="<? if (isset($rs2) && $order_type == "trial") {?><?=$rs2["user_id"]?>_db<? }?>">
    </b></font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Built-in 
    Components: </b></font></p>
  <blockquote> 
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="shoppingcart" value="Shopping Cart" checked>
      Shopping Cart</font></p>
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="wishlist" value="Wish List" onClick="selectUserAccount(this.form);" <? if (isset($rs2) && $order_type == "purchase" && strlen(strstr($rs2["additional_options"],"Wish List")) > 0) {?>checked<? }?>>
      Wish List</font></p>
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="useraccount" value="User Account" onClick="unselectWishList(this.form);" <? if (isset($rs2) && $order_type == "purchase" && strlen(strstr($rs2["additional_options"],"User Account")) > 0) {?>checked<? }?>>
      User Account</font></p>
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="helpdesk" value="Help Desk">
      Help Desk</font></p>
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="instantmessaging" value="Instant Messaging">
      Instant Messaging</font></p>
  </blockquote>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Client Payment 
    Service:</b></font></p>
  <blockquote> 
    <p>
      <input type="radio" name="PaymentService" value="Manual">
      Manual </p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="radio" name="PaymentService" value="PayPal" checked>
      PayPal</font></p>
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="radio" name="PaymentService" value="VeriSign PayFlow Link" <? if (isset($rs2) && $order_type == "purchase" && strlen(strstr($rs2["additional_options"],"VeriSign PayFlow Link")) > 0) {?>checked<? }?>>
      VeriSign PayFlow Link</font></p>
    <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="radio" name="PaymentService" value="VeriSign PayFlow Pro" <? if (isset($rs2) && $order_type == "purchase" && strlen(strstr($rs2["additional_options"],"VeriSign PayFlow Pro")) > 0) {?>checked<? }?>>
      VeriSign PayFlow Pro</font></p>
  </blockquote>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Document/Root 
    Path: 
    <input type="text" name="path" size="60" value="<?=realpath("../") . "/"?>">
    </b></font></p>
  <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <input type="checkbox" name="demo_data" value="Insert Demo Data">
    Insert Demo Data</font></p>

  <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <input type="submit" name="Submit" value="Create eCommerce Package" onClick="validateForm(this.form);">
    <input type="reset" name="Submit2" value="Reset">
    </font></p>
</form>
<p align="left">&nbsp;</p>
</body>
</html>
