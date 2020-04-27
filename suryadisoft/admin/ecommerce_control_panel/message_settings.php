<?php
if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$body_name = "process_order_body";
	$body_value = (isset($prop["process_order_body"]))?$prop["process_order_body"]:"Thank you for shopping with us. We will process your order within 24 hours.";
	if (isset($message_type) && $message_type == "Customer Invoice") {
		$from_name = "invoice_email_from";
		$cc_name = "invoice_email_cc";
		$bcc_name = "invoice_email_bcc";
		$from_value = (isset($prop["invoice_email_from"]))?$prop["invoice_email_from"]:Transaction::getInvoiceEmailFrom();
		$cc_value = (isset($prop["invoice_email_cc"]))?$prop["invoice_email_cc"]:"";
		$bcc_value = (isset($prop["invoice_email_bcc"]))?$prop["invoice_email_bcc"]:"";
		$subject_name = "invoice_email_subject";
		$subject_value = (isset($prop["invoice_email_subject"]))?$prop["invoice_email_subject"]:Transaction::getInvoiceEmailSubject();
		$body_name = "invoice_email_body";
		$body_value = (!isset($default_message) && isset($prop["invoice_email_body"]))?$prop["invoice_email_body"]:Transaction::getInvoiceEmailBody();
	} else if (isset($message_type) && $message_type == "Partial Shipped Order") {
		$from_name = "partial_shipped_order_email_from";
		$cc_name = "partial_shipped_order_email_cc";
		$bcc_name = "partial_shipped_order_email_bcc";
		$from_value = (isset($prop["partial_shipped_order_email_from"]))?$prop["partial_shipped_order_email_from"]:Transaction::getShippedOrderEmailFrom();
		$cc_value = (isset($prop["partial_shipped_order_email_cc"]))?$prop["partial_shipped_order_email_cc"]:"";
		$bcc_value = (isset($prop["partial_shipped_order_email_bcc"]))?$prop["partial_shipped_order_email_bcc"]:"";
		$subject_name = "partial_shipped_order_email_subject";
		$subject_value = (isset($prop["partial_shipped_order_email_subject"]))?$prop["partial_shipped_order_email_subject"]:Transaction::getShippedOrderEmailSubject("partial");
		$body_name = "partial_shipped_order_email_body";
		$body_value = (!isset($default_message) && isset($prop["partial_shipped_order_email_body"]))?$prop["partial_shipped_order_email_body"]:Transaction::getShippedOrderEmailBody("partial");
	} else if (isset($message_type) && $message_type == "Complete Shipped Order") {
		$from_name = "complete_shipped_order_email_from";
		$cc_name = "complete_shipped_order_email_cc";
		$bcc_name = "complete_shipped_order_email_bcc";
		$from_value = (isset($prop["complete_shipped_order_email_from"]))?$prop["complete_shipped_order_email_from"]:Transaction::getShippedOrderEmailFrom();
		$cc_value = (isset($prop["complete_shipped_order_email_cc"]))?$prop["complete_shipped_order_email_cc"]:"";
		$bcc_value = (isset($prop["complete_shipped_order_email_bcc"]))?$prop["complete_shipped_order_email_bcc"]:"";
		$subject_name = "complete_shipped_order_email_subject";
		$subject_value = (isset($prop["complete_shipped_order_email_subject"]))?$prop["complete_shipped_order_email_subject"]:Transaction::getShippedOrderEmailSubject("complete");
		$body_name = "complete_shipped_order_email_body";
		$body_value = (!isset($default_message) && isset($prop["complete_shipped_order_email_body"]))?$prop["complete_shipped_order_email_body"]:Transaction::getShippedOrderEmailBody("complete");
	} else if (isset($message_type) && $message_type == "Account Registration") {
		$from_name = "user_account_email_from";
		$cc_name = "user_account_email_cc";
		$bcc_name = "user_account_email_bcc";
		$from_value = (isset($prop["user_account_email_from"]))?$prop["user_account_email_from"]:WebUser::getUserAccountEmailFrom();
		$cc_value = (isset($prop["user_account_email_cc"]))?$prop["user_account_email_cc"]:"";
		$bcc_value = (isset($prop["user_account_email_bcc"]))?$prop["user_account_email_bcc"]:"";
		$subject_name = "user_account_email_subject";
		$subject_value = (isset($prop["user_account_email_subject"]))?$prop["user_account_email_subject"]:WebUser::getUserAccountEmailSubject();
		$body_name = "user_account_email_body";
		$body_value = (!isset($default_message) && isset($prop["user_account_email_body"]))?$prop["user_account_email_body"]:WebUser::getUserAccountEmailBody();
	} else if (isset($message_type) && $message_type == "Share Wish List") {
		$from_name = "wish_list_email_from";
		$cc_name = "wish_list_email_cc";
		$bcc_name = "wish_list_email_bcc";
		$from_value = (isset($prop["wish_list_email_from"]))?$prop["wish_list_email_from"]:WishList::getWishListEmailFrom();
		$cc_value = (isset($prop["wish_list_email_cc"]))?$prop["wish_list_email_cc"]:"";
		$bcc_value = (isset($prop["wish_list_email_bcc"]))?$prop["wish_list_email_bcc"]:"";
		$subject_name = "wish_list_email_subject";
		$subject_value = (isset($prop["wish_list_email_subject"]))?$prop["wish_list_email_subject"]:WishList::getWishListEmailSubject();
		$body_name = "wish_list_email_body";
		$body_value = (!isset($default_message) && isset($prop["wish_list_email_body"]))?$prop["wish_list_email_body"]:WishList::getWishListEmailBody();
	} else if (isset($message_type) && $message_type == "Send Password") {
		$from_name = "password_email_from";
		$cc_name = "password_email_cc";
		$bcc_name = "password_email_bcc";
		$from_value = (isset($prop["password_email_from"]))?$prop["password_email_from"]:WebUser::getPasswordEmailFrom();
		$cc_value = (isset($prop["password_email_cc"]))?$prop["password_email_cc"]:"";
		$bcc_value = (isset($prop["password_email_bcc"]))?$prop["password_email_bcc"]:"";
		$subject_name = "password_email_subject";
		$subject_value = (isset($prop["password_email_subject"]))?$prop["password_email_subject"]:WebUser::getPasswordEmailSubject();
		$body_name = "password_email_body";
		$body_value = (!isset($default_message) && isset($prop["password_email_body"]))?$prop["password_email_body"]:WebUser::getPasswordEmailBody();
	} else if (isset($message_type) && $message_type == "Affiliate Program") {
		$from_name = "affiliate_email_from";
		$cc_name = "affiliate_email_cc";
		$bcc_name = "affiliate_email_bcc";
		$from_value = (isset($prop["affiliate_email_from"]))?$prop["affiliate_email_from"]:Affiliate::getAffiliateEmailFrom();
		$cc_value = (isset($prop["affiliate_email_cc"]))?$prop["affiliate_email_cc"]:"";
		$bcc_value = (isset($prop["affiliate_email_bcc"]))?$prop["affiliate_email_bcc"]:"";
		$subject_name = "affiliate_email_subject";
		$subject_value = (isset($prop["affiliate_email_subject"]))?$prop["affiliate_email_subject"]:Affiliate::getAffiliateEmailSubject();
		$body_name = "affiliate_email_body";
		$body_value = (!isset($default_message) && isset($prop["affiliate_email_body"]))?$prop["affiliate_email_body"]:Affiliate::getAffiliateEmailBody();
	} 
}
?>
<script language="JavaScript">
<!--
function setDefaultMessage() {
	open("settings.php?Tab=<?=$Tab?><? if (isset($message_type)) {?>&message_type=<?=$message_type?><? }?>&default_message=true","_self");
}
-->
</script>
<form name="updateSettings" enctype="multipart/form-data" method="post" action="update_settings.php?Tab=<?=$Tab?>">
  <p>Message Type: 
    <select name="message_type" onChange="changeMessageType(this.value);">
			<option value="Process Order" <? if (isset($message_type) && $message_type == "Process Order") {?>selected<? }?>>Process Order Message</option>
			<option value="Customer Invoice" <? if (isset($message_type) && $message_type == "Customer Invoice") {?>selected<? }?>>Customer Invoice Email</option>
			<option value="Partial Shipped Order" <? if (isset($message_type) && $message_type == "Partial Shipped Order") {?>selected<? }?>>Partial Shipped Order Email</option>
			<option value="Complete Shipped Order" <? if (isset($message_type) && $message_type == "Complete Shipped Order") {?>selected<? }?>>Complete Shipped Order Email</option>
			<? if (array_search("User Account",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1 || $HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {?>
			<option value="Account Registration" <? if (isset($message_type) && $message_type == "Account Registration") {?>selected<? }?>>Account Registration Email</option>
			<option value="Send Password" <? if (isset($message_type) && $message_type == "Send Password") {?>selected<? }?>>Send Password Email</option>
			<? }?>
			<? if ((array_search("Wish List",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1 
							&& array_search("User Account",$HTTP_SESSION_VARS["admin_user"]->getComponent($HTTP_SESSION_VARS["admin_user"]->getUserId())) > -1)
							|| $HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {?>			
			<option value="Share Wish List" <? if (isset($message_type) && $message_type == "Share Wish List") {?>selected<? }?>>Share Wish List Email</option>            
			<? }?>
			<option value="Affiliate Program" <? if (isset($message_type) && $message_type == "Affiliate Program") {?>selected<? }?>>Affiliate Program Email</option>
		</select>
  </p>
		
	<? if (isset($message_type) && $message_type != "Process Order") {?>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">From: 
    <input type="text" name="<?=$from_name?>" value="<?=$from_value?>" size="40">
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Cc: 
    <input name="<?=$cc_name?>" type="text" value="<?=$cc_value?>" size="40">
    <em>(separated by comma)</em></font></p>
	<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Bcc: 
    <input name="<?=$bcc_name?>" type="text" value="<?=$bcc_value?>" size="40">
    <em>(separated by comma)</em></font></p>	
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Subject: 
    <input type="text" name="<?=$subject_name?>" value="<?=$subject_value?>" size="60">
			</font></p>
	<? }?>
	
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Message: </font> 
  </p>
		<blockquote> 
			<p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				
      <textarea name="<?=$body_name?>" cols="100" rows="20"><?=$body_value?></textarea>
				</font></p>
		</blockquote>

  <p>* You can format your message using HTML code.</p>
  <p align="center"> 
    <input type="submit" name="Submit9" value="Update Messages">
    <input name="DefaultMessageButton" type="button" id="DefaultMessageButton" value="Default Message" onClick="setDefaultMessage();">
    <input type="reset" name="Submit10" value="Reset">
    <input type="button" name="varButton" value="Dynamic Variable" onClick="window.open('dynamic_variable.php?message_type=<?=(isset($message_type))?urlencode($message_type):""?>','Dynamic_Variable','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=500,height=300');">
    <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#message_setting','help');">
  </p>
</form>
