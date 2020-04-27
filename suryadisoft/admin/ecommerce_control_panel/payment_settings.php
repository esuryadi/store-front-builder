<?php
require_once "../config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; 
</font> <form name="updateSettings" enctype="multipart/form-data" method="post" action="update_settings.php?Tab=<?=$Tab?>">
	<input type="hidden" name="user_id" value="<?=$userid?>">
	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
	<p>Payment Gateways: 
		<select name="payment_service" onChange="changePaymentService(this.value);">
			<option value="Manual" <? if ($payment_service == "Manual") {?>selected<? }?>>Manual</option>
			<option value="PayPal" <? if ($payment_service == "PayPal") {?>selected<? }?>>PayPal</option>
			<option value="VeriSign PayFlow Link" <? if ($payment_service == "VeriSign PayFlow Link") {?>selected<? }?>>VeriSign 
			PayFlow Link</option>
			<option value="VeriSign PayFlow Pro" <? if ($payment_service == "VeriSign PayFlow Pro") {?>selected<? }?>>VeriSign 
			PayFlow Pro</option>
			<option value="Paradata" <? if ($payment_service == "Paradata") {?>selected<? }?>>Paradata OpenConnect</option>	
			<option value="Authorize.Net" <? if ($payment_service == "Authorize.Net") {?>selected<? }?>>Authorize.Net</option>			
		</select>
	</p>
	<? if ($payment_service == "PayPal") {?>
  </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
  <p><font size="-1">PayPal Email Account: 
    <input type="text" name="paypal_account" value="<? if (isset($prop["paypal_account"])) {?><?=$prop["paypal_account"]?><? }?>" size="30">
    </font></p>
  <p><font size="-1">
    <input name="skip_to_paypal" type="checkbox" id="skip_to_paypal" value="yes" <? if (isset($prop["skip_to_paypal"]) && $prop["skip_to_paypal"] == "yes") {?>checked<? }?>>
    Skip to PayPal Website when customer click the process order button</font></p>
  <font size="-1"> 
  <? } else if ($payment_service == "VeriSign PayFlow Link") {?>
  <p>Method: 
    <select name="verisign_method">
      <option value="C" <? if (isset($prop["verisign_method"]) && $prop["verisign_method"] == "C") {?>selected<? } else if (!isset($prop["verisign_method"])) {?>selected<? }?>>Credit 
      Card</option>
      <option value="D" <? if (isset($prop["verisign_method"]) && $prop["verisign_method"] == "D") {?>selected<? }?>>Debit 
      Card</option>
      <option value="ECHECK" <? if (isset($prop["verisign_method"]) && $prop["verisign_method"] == "ECHECK") {?>selected<? }?>>Electronic 
      Check</option>
    </select>
  </p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Transaction 
    Type: 
    <select name="verisign_trxtype">
      <option value="S" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "S") {?>selected<? } else if (!isset($prop["verisign_trxtype"])) {?>selected<? }?>>Payment/Sale</option>
      <option value="A" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "A") {?>selected<? }?>>Authorization</option>
      <option value="D" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "D") {?>selected<? }?>>Delayed 
      Capture</option>
    </select>
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">VeriSign User 
    ID: 
    <input type="text" name="verisign_user_id" value="<? if (isset($prop["verisign_user_id"])) {?><?=$prop["verisign_user_id"]?><? }?>" size="30">
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">VeriSign Partner 
    ID: 
    <input type="text" name="verisign_partner" value="<? if (isset($prop["verisign_partner"])) {?><?=$prop["verisign_partner"]?><? } else {?>VeriSign<? }?>" size="30">
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Redirect Billing 
    Information to VeriSign Secure Site: 
    <select name="verisign_order_form" id="verisign_order_form">
      <option value="True" <? if (!isset($prop["verisign_order_form"]) || (isset($prop["verisign_order_form"]) && $prop["verisign_order_form"] == "True")) {?>selected<? }?>>Yes</option>
      <option value="False" <? if (isset($prop["verisign_order_form"]) && $prop["verisign_order_form"] == "False") {?>selected<? }?>>No</option>
    </select>
    </font></p>
  <p>Show Make Payment button before redirecting to VeriSign Secure Site: 
    <select name="show_payment_button" id="show_payment_button">
      <option value="yes" <? if (isset($prop["show_payment_button"]) && $prop["show_payment_button"] == "yes") {?>selected<? }?>>Yes</option>
      <option value="no" <? if (!isset($prop["show_payment_button"]) || (isset($prop["show_payment_button"]) && $prop["show_payment_button"] == "no")) {?>selected<? }?>>No</option>
    </select>
  </p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Email Customer: 
    <select name="verisign_email_customer">
      <option value="True" <? if (isset($prop["verisign_email_customer"]) && $prop["verisign_email_customer"] == "True") {?>selected<? }?>>Yes</option>
      <option value="False" <? if (isset($prop["verisign_email_customer"]) && $prop["verisign_email_customer"] == "False") {?>selected<? } else if (!isset($prop["verisign_email_customer"])) {?>selected<? }?>>No</option>
    </select>
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Show Confirmation: 
    <select name="verisign_show_confirmation">
      <option value="True" <? if (isset($prop["verisign_show_confirmation"]) && $prop["verisign_show_confirmation"] == "True") {?>selected<? }?>>Yes</option>
      <option value="False" <? if (isset($prop["verisign_show_confirmation"]) && $prop["verisign_show_confirmation"] == "False") {?>selected<? } else if (!isset($prop["verisign_show_confirmation"])) {?>selected<? }?>>No</option>
    </select>
    </font></p>
  </font></font> 
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Record 
    Transaction Before Credit Card Approval: 
    <select name="record_transaction">
      <option value="yes" <? if (isset($prop["record_transaction"]) && $prop["record_transaction"] == "yes") {?>selected<? }?>>Yes</option>
      <option value="no" <? if (!isset($prop["record_transaction"]) || (isset($prop["record_transaction"]) && $prop["record_transaction"] == "no")) {?>selected<? }?>>No</option>
    </select>
    </font></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">Are you 
    using SSL? 
    <select name="use_ssl" id="use_ssl">
      <option value="Yes" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "Yes") {?>selected<? }?>>Yes</option>
      <option value="No" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "No") {?>selected<? }?>>No</option>
    </select>
    </font><font size="-1"> </font></font></p>
  <font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1"><p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Important 
    Notes:</b></font></p>
  <blockquote><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> Please 
    set the Return URL and Silent Post URL on your PayFlow Link Configuration 
    in VeriSign Manager (go to Account Info and click on PayFlow Link Info) to 
    http://www. 
    <?=$admin->getCompanyURL()?>
    /mystore.php?Page=ProcessOrder </font></blockquote>
  <? } else if ($payment_service == "VeriSign PayFlow Pro") {?>
  <p>Transaction Mode: 
    <select name="verisign_trxmode">
      <option value="test-payflow.verisign.com" <? if (isset($prop["verisign_trxmode"]) && $prop["verisign_trxmode"] == "test-payflow.verisign.com") {?>selected<? } else if (count($prop) == 0) {?>selected<? }?>>Test</option>
      <option value="payflow.verisign.com" <? if (isset($prop["verisign_trxmode"]) && $prop["verisign_trxmode"] == "payflow.verisign.com") {?>selected<? }?>>Live</option>
    </select>
  </p>
  <p>Tender Type: 
    <select name="verisign_tender">
      <option value="A" <? if (isset($prop["verisign_tender"]) && $prop["verisign_tender"] == "A") {?>selected<? }?>>ACH</option>
      <option value="C" <? if (isset($prop["verisign_tender"]) && $prop["verisign_tender"] == "C") {?>selected<? } else if (count($prop) == 0) {?>selected<? }?>>Credit 
      Card</option>
      <option value="K" <? if (isset($prop["verisign_tender"]) && $prop["verisign_tender"] == "K") {?>selected<? }?>>Electronic 
      Check</option>
    </select>
  </p>
  <p>Transaction Type: 
    <select name="verisign_trxtype">
      <option value="S" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "S") {?>selected<? }?>>Sale</option>
      <option value="C" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "C") {?>selected<? } else if (count($prop) == 0) {?>selected<? }?>>Credit</option>
      <option value="A" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "A") {?>selected<? }?>>Authorization</option>
      <option value="D" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "D") {?>selected<? }?>>Delayed 
      Capture</option>
      <option value="V" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "V") {?>selected<? }?>>Void</option>
      <option value="F" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "F") {?>selected<? }?>>Voice 
      Authorization</option>
      <option value="I" <? if (isset($prop["verisign_trxtype"]) && $prop["verisign_trxtype"] == "I") {?>selected<? }?>>Inquiry</option>
    </select>
  </p>
  <p>VeriSign User ID: 
    <input type="text" name="verisign_user_id" value="<? if (isset($prop["verisign_user_id"])) {?><?=$prop["verisign_user_id"]?><? }?>" size="30">
  </p>
  <p>VeriSign Password: 
    <input type="password" name="verisign_password" value="<? if (isset($prop["verisign_password"])) {?><?=$prop["verisign_password"]?><? }?>" size="30">
  </p>
  <p>VeriSign Vendor ID: 
    <input type="text" name="verisign_vendor" value="<? if (isset($prop["verisign_vendor"])) {?><?=$prop["verisign_vendor"]?><? }?>" size="30">
  </p>
  <p>VeriSign Partner ID: 
    <input type="text" name="verisign_partner" value="<? if (isset($prop["verisign_partner"])) {?><?=$prop["verisign_partner"]?><? } else {?>VeriSign<? }?>" size="30">
  </p>
  <p>Are you using SSL? 
    <select name="use_ssl" id="use_ssl">
      <option value="Yes" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "Yes") {?>selected<? }?>>Yes</option>
      <option value="No" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "No") {?>selected<? }?>>No</option>
    </select>
  </p>
  </font></font> 
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">
    <? } else if ($payment_service == "Paradata") {?>
	</font></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">Transaction Mode:
	<select name="paradata_trxmode">
	  <option value="test" <? if (isset($prop["paradata_trxmode"]) && $prop["paradata_trxmode"] == "test") {?>selected<? } else if (!isset($prop["paradata_trxmode"])) {?>selected<? }?>>Test</option>
	  <option value="live" <? if (isset($prop["paradata_trxmode"]) && $prop["paradata_trxmode"] == "live") {?>selected<? }?>>Live</option>
	</select>
</font></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">Transaction Type:
        <select name="paradata_trxtype">
          <option value="AUTH" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "AUTH") {?>selected<? }?>>AUTH</option>
          <option value="CAPTURE" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "CAPTURE") {?>selected<? }?>>CAPTURE</option>
          <option value="SALE" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "SALE") {?>selected<? } else if (!isset($prop["paradata_trxtype"])) {?>selected<? }?>>SALE</option>
          <option value="VOID" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "VOID") {?>selected<? }?>>VOID</option>
          <option value="CREDIT" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "CREDIT") {?>selected<? }?>>CREDIT</option>
          <option value="VOID_AUTH" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "VOID_AUTH") {?>selected<? }?>>VOID_AUTH</option>
          <option value="VOID_CAPTURE" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "VOID_CAPTURE") {?>selected<? }?>>VOID_CAPTURE</option>
          <option value="VOID_CREDIT" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "VOID_CREDIT") {?>selected<? }?>>VOID_CREDIT</option>
          <option value="CREATE_ORDER" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "CREATE_ORDER") {?>selected<? }?>>CREATE_ORDER</option>
          <option value="CANCEL_ORDER" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "CANCEL_ORDER") {?>selected<? }?>>CANCEL_ORDER</option>
          <option value="CLOSE_ORDER" <? if (isset($prop["paradata_trxtype"]) && $prop["paradata_trxtype"] == "CLOSE_ORDER") {?>selected<? }?>>CLOSE_ORDER</option>
		</select>
  </font></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">Token ID: 
    <input name="token_id" type="text" id="token_id" size="80" value="<? if (isset($prop["token_id"])) {?><?=$prop["token_id"]?><? }?>">
</font></font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Are you using SSL?
      <select name="use_ssl" id="use_ssl">
        <option value="Yes" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "Yes") {?>selected<? }?>>Yes</option>
        <option value="No" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "No") {?>selected<? }?>>No</option>
      </select>
  </font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">
    <? } else if ($payment_service == "Authorize.Net") {?>
    </font></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">Login 
    ID: 
    <input name="login_id" type="text" id="login_id" value="<? if (isset($prop["login_id"])) {?><?=$prop["login_id"]?><? }?>">
    </font></font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Transaction 
    Key: 
    <input name="transaction_key" type="text" id="transaction_key" value="<? if (isset($prop["transaction_key"])) {?><?=$prop["transaction_key"]?><? }?>">
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Transaction 
    Method: 
    <select name="transaction_method" id="transaction_method">
		<option value="CC" <? if (isset($prop["transaction_method"]) && $prop["transaction_method"] == "CC") {?>selected<? } else if (!isset($prop["transaction_method"])) {?>selected<? }?>>Credit 
    Card</option>
    <option value="ECHECK" <? if (isset($prop["transaction_method"]) && $prop["transaction_method"] == "ECHECK") {?>selected<? }?>>Electronic 
    Check</option>
    </select>
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Transaction 
    Type: 
    <select name="transaction_type" id="transaction_type">
      <option value="AUTH_CAPTURE" <? if (isset($prop["transaction_type"]) && $prop["transaction_type"] == "AUTH_CAPTURE") {?>selected<? }?>>Authorization 
      Capture</option>
      <option value="AUTH_ONLY" <? if (isset($prop["transaction_type"]) && $prop["transaction_type"] == "AUTH_ONLY") {?>selected<? }?>>Authorization 
      Only</option>
      <option value="CAPTURE_ONLY" <? if (isset($prop["transaction_type"]) && $prop["transaction_type"] == "CAPTURE_ONLY") {?>selected<? }?>>Capture 
      Only</option>
      <option value="CREDIT" <? if (isset($prop["transaction_type"]) && $prop["transaction_type"] == "CREDIT") {?>selected<? } else if (!isset($prop["transaction_type"])) {?>selected<? }?>>Credit</option>
      <option value="VOID" <? if (isset($prop["transaction_type"]) && $prop["transaction_type"] == "VOID") {?>selected<? }?>>Void</option>
      <option value="PRIOR_AUTH_CAPTURE" <? if (isset($prop["transaction_type"]) && $prop["transaction_type"] == "PRIOR_AUTH_CAPTURE") {?>selected<? }?>>Prior 
      Authorization Capture</option>
    </select>
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Send Confirmation 
    Email to Customer: 
    <select name="email_customer" id="email_customer">
      <option value="TRUE" <? if (isset($prop["email_customer"]) && $prop["email_customer"] == "TRUE") {?>selected<? }?>>Yes</option>
      <option value="FALSE" <? if (isset($prop["email_customer"]) && $prop["email_customer"] == "FALSE") {?>selected<? } else if (!isset($prop["email_customer"])) {?>selected<? }?>>No</option>
    </select>
    </font></p>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Are you using SSL? 
    <select name="use_ssl" id="use_ssl">
      <option value="Yes" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "Yes") {?>selected<? }?>>Yes</option>
      <option value="No" <? if (isset($prop["use_ssl"]) && $prop["use_ssl"] == "No") {?>selected<? }?>>No</option>
    </select>
  </font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1"> 
    <? } else {?>
    Payment Method: 
    <select name="payment_method" onChange="changePaymentMethod(this.value);">
      <option selected>NONE</option>
      <option value="Credit Card" <? if ((isset($payment_method) && $payment_method == "Credit Card") || (!isset($payment_method) && isset($prop["payment_method"]) && $prop["payment_method"] == "Credit Card")) {?>selected<? }?>>Credit 
      Card</option>
      <option value="Check" <? if ((isset($payment_method) && $payment_method == "Check") || (!isset($payment_method) && isset($prop["payment_method"]) && $prop["payment_method"] == "Check")) {?>selected<? }?>>Check</option>
      <option value="Wire Transfer" <? if ((isset($payment_method) && $payment_method == "Wire Transfer") || (!isset($payment_method) && isset($prop["payment_method"]) && $prop["payment_method"] == "Wire Transfer")) {?>selected<? }?>>Wire 
      Transfer</option>
    </select>
    </font></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><font size="-1">Messages 
    to your customer (such as "make the check payable to"):<br>
    <textarea name="payment_message" cols="80" rows="10" id="payment_message"><? if (isset($prop["payment_message"])) {?><?=$prop["payment_message"]?><? }?></textarea>
    <? }?>
    </font></font></p>
	<? if ($payment_service == "VeriSign PayFlow Pro" || ($payment_service == "VeriSign PayFlow Link" && isset($prop["verisign_order_form"]) && $prop["verisign_order_form"] == "False") || $payment_service == "Authorize.Net" || (isset($payment_method) && $payment_method == "Credit Card") || (!isset($payment_method) && isset($prop["payment_method"]) && $prop["payment_method"] == "Credit Card")) {?>
  <p><input name="ask_cvv" type="checkbox" value="yes" <? if (isset($prop["ask_cvv"]) && $prop["ask_cvv"] == "yes") {?>checked<? }?>>
    <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Ask 3 Digit Credit 
    Card Security code</font></p>
	<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Accepted Credit 
    Card: 
    <input name="payment_type[]" type="checkbox" id="payment_type" value="Visa" <? if (!isset($prop["payment_type"]) || (isset($prop["payment_type"]) && strstr($prop["payment_type"],"Visa") != "")) {?>checked<? }?>>
    Visa 
    <input name="payment_type[]" type="checkbox" id="payment_type" value="MasterCard" <? if (!isset($prop["payment_type"]) || (isset($prop["payment_type"]) && strstr($prop["payment_type"],"MasterCard") != "")) {?>checked<? }?>>
    Master Card 
    <input name="payment_type[]" type="checkbox" id="payment_type" value="Amex" <? if (isset($prop["payment_type"]) && strstr($prop["payment_type"],"Amex") != "") {?>checked<? }?>>
    American Express 
    <input name="payment_type[]" type="checkbox" id="payment_type" value="Discover" <? if (isset($prop["payment_type"]) && strstr($prop["payment_type"],"Discover") != "") {?>checked<? }?>>
    Discover 
    <input name="payment_type[]" type="checkbox" id="payment_type" value="Diners" <? if (isset($prop["payment_type"]) && strstr($prop["payment_type"],"Diners") != "") {?>checked<? }?>>
    Diners </font></p>
	<? if ($payment_service != "PayPal") {?>
  <table border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Accepting 
        Other Type of Payment:</font></td>
      <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="other_payment_type[]" type="checkbox" id="other_payment_type[]" value="PayPal" <? if (isset($prop["other_payment_type"]) && strstr($prop["other_payment_type"],"PayPal") != "") {?>checked<? }?>>
        PayPal 
        <input name="paypal_account" type="text" id="paypal_account" value="<? if (isset($prop["paypal_account"])) {?><?=$prop["paypal_account"]?><? }?>">
        <font size="-2"><strong><- enter your PayPal account id</strong></font></font></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
          <input name="other_payment_type[]" type="checkbox" id="other_payment_type[]" value="Check" <? if (isset($prop["other_payment_type"]) && strstr($prop["other_payment_type"],"Check") != "") {?>checked<? }?>>
        Check</font> 
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          <textarea name="check_message" cols="40" rows="5" id="check_message"><? if (isset($prop["check_message"])) {?><?=$prop["check_message"]?><? } else {?>Please Make Check Payable to:<? }?>
</textarea>
        </p></td>
    </tr>
  </table>
	<? }?>
  <? }?>
	<p align="center"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
		<input type="submit" name="Submit" value="Update Settings">
		<input type="reset" name="Submit2" value="Reset">
		<input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#payment_setting','help');">
		<? if ($payment_service == "PayPal") {?>
		<input type="button" name="GoToPayPal" value="Go To PayPal" onClick="MM_goToURL('self','http://www.paypal.com');return document.MM_returnValue">
		<? } else if ($payment_service == "VeriSign PayFlow Link" || $payment_service == "VeriSign PayFlow Pro") {?>
		<input name="verisign_manager" type="button" onClick="window.open('https://manager.verisign.com','verisign')" value="VeriSign Manager">
		<? } else if ($payment_service == "Authorize.Net") {?>
		<input name="authorize" type="button" onClick="window.open('https://merchant.authorize.net','authorize')" value="Authorize.Net Merchant">
		<? }?>
		</font></p>
</form>
