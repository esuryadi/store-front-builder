<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td><font size="-1"> 
			<? if ($success) {?>
      </font> <p><font size="-1">
			<? if (WebContent::getPropertyValue("process_order_body") != "") {
				eval ("\$message = \"" . addslashes(WebContent::getPropertyValue("process_order_body")) . "\";");?>
				<?=$message?>
			<? } else {?>
				Thank you for shopping with us. We will process your order within 24 hours. 
			<? }?>
			</font></p>
<font size="-1">
      <? } else {?>
<h2>ERROR (<?=$result?>): 
  <?=$message?>
</h2>
      <p>Please make sure the billing information that you enter is correct and 
        accurate.</p>
      <p><a href="mystore.php?Page=CheckOut1">Return to fix error</a></p>
			<? }?>
</font> 
      <p>&nbsp;</p></td>
  </tr>
</table>
<? if ($payment->getPaymentService(_USER) == "PayPal" || $customer->getPaymentMethod() == "PayPal") {?>
<form name="paypal2" target="_parent" action="https://www.paypal.com/cgi-bin/webscr" method="POST">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="<?=$business?>">
	<input type="hidden" name="item_name" value="<?=$item_name?>">
	<input type="hidden" name="item_number" value="<?=$item_number?>">
	<input type="hidden" name="amount" value="<?=$amount?>">
	<input type="hidden" name="return" value="<?=$return?>">
	<input type="hidden" name="cancel_return" value="<?=$cancel_return?>">
	<? if (WebContent::getPropertyValue("ask_cust_info") == "" || WebContent::getPropertyValue("ask_cust_info") == "yes") {?>
	<input type="hidden" name="first_name" value="<?=$first_name?>">
	<input type="hidden" name="last_name" value="<?=$last_name?>">
	<input type="hidden" name="address1" value="<?=$address1?>">
	<input type="hidden" name="address2" value="<?=$address2?>">
	<input type="hidden" name="city" value="<?=$city?>">
	<input type="hidden" name="state" value="<?=$state?>">
	<input type="hidden" name="zip" value="<?=$zip?>">
	<input type="hidden" name="day_phone_a" value="<?=$day_phone_a?>">
	<input type="hidden" name="night_phone_a" value="<?=$night_phone_a?>">
	<? }?>
	<? if(WebContent::getPropertyValue("logo_img_src") != "") {?>
	<!input type="hidden" name="image_url" value="<?=$image_url?>"> 
	<? }?>
	<center><input type="submit" name="makePaymentButton" value="Make Payment with PayPal"></center>
</form>
<? if(WebContent::getPropertyValue("skip_to_paypal") != "") {?>
<script language="JavaScript">
<!--
document.paypal2.submit();
-->
</script>
<? }?>
<? } else if ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && WebContent::getPropertyValue("show_payment_button") == "yes") {?>
<form name="verisign" method="POST" action="https://payflowlink.verisign.com/payflowlink.cfm">
<input type="hidden" name="TYPE" value="<?=$TYPE?>">
<input type="hidden" name="LOGIN" value="<?=$LOGIN?>">
<input type="hidden" name="PARTNER" value="<?=$PARTNER?>">
<input type="hidden" name="METHOD" value="<?=$METHOD?>">
<input type="hidden" name="INVOICE" value="<?=$INVOICE?>">
<input type="hidden" name="PONUM" value="<?=$PONUM?>">
<input type="hidden" name="DESCRIPTION" value="<?=$DESCRIPTION?>">
<input type="hidden" name="NAME" value="<?=$NAME?>">
<input type="hidden" name="ADDRESS" value="<?=$ADDRESS?>">
<input type="hidden" name="CITY" value="<?=$CITY?>">
<input type="hidden" name="STATE" value="<?=$STATE?>">
<input type="hidden" name="ZIP" value="<?=$ZIP?>">
<input type="hidden" name="PHONE" value="<?=$PHONE?>">
<input type="hidden" name="AMOUNT" value="<?=$AMOUNT?>">
<input type="hidden" name="TAX" value="<?=$TAX?>">
<input type="hidden" name="SHIPAMOUNT" value="<?=$SHIPAMOUNT?>">
<input type="hidden" name="ADDRESSTOSHIP" value="<?=$ADDRESSTOSHIP?>">
<input type="hidden" name="CITYTOSHIP" value="<?=$CITYTOSHIP?>">
<input type="hidden" name="STATETOSHIP" value="<?=$STATETOSHIP?>">
<input type="hidden" name="ZIPTOSHIP" value="<?=$ZIPTOSHIP?>">
<input type="hidden" name="EMAIL" value="<?=$EMAIL?>">
<input type="hidden" name="EMAILTOSHIP" value="<?=$EMAILTOSHIP?>">
<input type="hidden" name="NAMETOSHIP" value="<?=$NAMETOSHIP?>">
<input type="hidden" name="ECHODATA" value="True">
<input type="hidden" name="EMAILCUSTOMER" value="<?=$EMAILCUSTOMER?>">
<input type="hidden" name="ORDERFORM" value="<?=$ORDERFORM?>">
<input type="hidden" name="SHOWCONFIRM" value="<?=$SHOWCONFIRM?>">
<center><input type="submit" name="makePaymentButton" value="Make Payment with VeriSign"></center>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td>
			<p><strong>Important Notes:</strong></p>
			<p><blockquote><strong>Do not click the back button on your Internet browser after clicking "Make Payment with Verisign" button. Doing so, could cause some problems. If you get an error message from VeriSign, you need to close the browser and start the whole process again.</strong></blockquote></p>
		</td>
	</tr>
</table>
<? } else if ($customer->getPaymentMethod() == "Check") {?>
<pre>
<?=WebContent::getPropertyValue("check_message")?>
</pre>
<? }?>