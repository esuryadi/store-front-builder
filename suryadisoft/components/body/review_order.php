
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td> <p><b>Review your order (print this page as your receipt):</b></p>
			<table cellpadding="0" cellspacing="10">
			<tr><td valign="top">
			<? if (WebContent::getPropertyValue("ask_cust_info") == "" || WebContent::getPropertyValue("ask_cust_info") == "yes") {?>
      	<table cellpadding="5" cellspacing="0" border="1" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<tr><td <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
				<strong>Customer Information</strong>
				</font>
				</td></tr>
				<tr><td>	
				<p> <b> 
        <?=$customer->getFirstName()?>
        <? if ($customer->getMiddleInitial() != "") {?>
        <?=$customer->getMiddleInitial()?>
        <? }?>
        <?=$customer->getLastName()?>
        </b><br>
        &nbsp;<?=$customer->getAddress1()?>
        <br>
        <? if ($customer->getAddress2()) {?>
        &nbsp;<?=$customer->getAddress2()?>
        <br>
        <? }?>
        &nbsp;<?=$customer->getCity()?>, <?=$customer->getState()?> <?=$customer->getZip()?>
        <br>
        &nbsp;<?=$customer->getCountry()?>
        <br>
        <b>Phone:</b> 
        <?=$customer->getDayPhone()?> (Day)
        <br>
        <? if ($customer->getEveningPhone() != "") {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$customer->getEveningPhone()?> (Evening)<br><? }?>
				<? if ($customer->getFax() != "") {?><b>Fax:</b> <?=$customer->getFax()?><br><? }?>
				<b>Email:</b> <?=$customer->getEmail()?> 
				</p>
				</td></tr>
				</table>
			<? }?>
			</td><td valign="top">
			<? if (WebContent::getPropertyValue("ask_billing_info") == "" || WebContent::getPropertyValue("ask_billing_info") == "yes") {?>
				<table cellpadding="5" cellspacing="0" border="1" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<tr><td <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
				<strong>Billing Information</strong>
				</font>
				</td></tr>
				<tr><td>	 
				<font size="-1"> 
					<strong>
					<?=$customer->getBillingFirstName()?>
					<? if ($customer->getBillingMiddleInitial() != "") {?>
					<?=$customer->getBillingMiddleInitial()?>
					<? }?>
					<?=$customer->getBillingLastName()?>
					</strong>
					<br>
					&nbsp;<?=$customer->getBillingAddress1()?>
					<br>
					<? if ($customer->getBillingAddress2()) {?>
					&nbsp;<?=$customer->getBillingAddress2()?>
					<br>
					<? }?>
					&nbsp;<?=$customer->getBillingCity()?>, <?=$customer->getBillingState()?> <?=$customer->getBillingZip()?>
					<br>
					&nbsp;<?=$customer->getBillingCountry()?>
					<br>
					<strong>Billing Phone:</strong>
					<?=$customer->getBillingPhone()?>
					</font> 
					<? if (($payment->getPaymentService(_USER) == "Manual" || $payment->getPaymentService(_USER) == "VeriSign PayFlow Pro") || ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && (WebContent::getPropertyValue("verisign_order_form") == "" || WebContent::getPropertyValue("verisign_order_form") == "False"))) {?>
						<? if ($customer->getPaymentMethod() == "" || $customer->getPaymentMethod() == "credit card") {?>
						<br><font size="-1"><strong>Credit Card Type:</strong>
						<?=$customer->getPaymentType()?>
						<br>
						<strong>Credit Card Number:</strong> 
						<?=str_repeat("*",12) . substr($customer->getAccountNumber(),12)?>
						<br>
						<strong>Expiration Date:</strong> 
						<?=substr($customer->getCreditCardExpDate(),0,2)?>/<?=substr($customer->getCreditCardExpDate(),2,2)?>
						<br>
						<? if ($customer->getCreditCardVerCode() != "") {?>
						<strong>Security Code:</strong> 
						<?=$customer->getCreditCardVerCode()?>
						<? }?>
						</font> 
						<? }?>
						<? }?>
					</td>
				</tr>
				</table>
			<? }?>
			</td></tr>
			<tr><td colspan="2">
      <table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
        <tr> 
          <td width="*" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
            <font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
						<div align="center"><b>Item</b></div>
						</font>
          </td>
					<? if ($product_color_exist) {?>
					<td width="15%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
						<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
            <div align="center"><b>Color</b></div>
						</font>
          </td>
					<? }?>
					<? if ($product_size_exist) {?>
					<td width="15%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
						<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
            <div align="center"><b>Size</b></div>
						</font>
          </td>
					<? }?>
					<? if ($product_choices_exist) {?>
					<td width="15%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
						<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
            <div align="center"><b>Choices</b></div>
						</font>
          </td>
					<? }?>
          <td width="5%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
						<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
            <div align="center"><b>Quantity</b></div>
						</font>
          </td>
          <td width="15%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
						<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
            <div align="center"><b>Price</b></div>
						</font>
          </td>
        </tr>
				<? for ($i=0;$i<count($cart);$i++) {
					$item = $cart[$i];
					$product->setUser((isset($user))?$user:"");
					$prod = $product->getProduct($item["product_id"]);
					$price = $prod["price"] * $item["quantity"];?>
				<tr> 
          <td width="*" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"><?=$prod["name"]?></td>
          <? if ($product_color_exist) {?>
					<td width="15%" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"><? if ($item["product_color"] != "") {?><?=$item["product_color"]?><? } else {?>&nbsp;<? }?></td>
					<? }?>
					<? if ($product_size_exist) {?>
					<td width="15%" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"><? if ($item["product_size"] != "") {?><?=$item["product_size"]?><? } else {?>&nbsp;<? }?></td>
					<? }?>
					<? if ($product_choices_exist) {?>
					<td width="15%" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"><? if ($item["product_choices"] != "") {?><?=$item["product_choices"]?><? } else {?>&nbsp;<? }?></td>
					<? }?>
					<td width="5%" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>" align="right"><?=$item["quantity"]?></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">$ 
                  <? printf("%01.2f",$price);?> </td>
					<td width="5%" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>" align="right"><input type="button" name="editItem" value="Edit" onClick="window.open('mystore.php?Page=ShoppingCart&Action=View','_self');"></td>
        </tr>
				<? }?>
        <tr> 
					<? $colspan = 2;
					if ($product_color_exist)
						$colspan++;
					if ($product_size_exist)
						$colspan++;
					if ($product_choices_exist)
						$colspan++;
					?>
          <td colspan="<?=$colspan?>"> 
            <div align="right"><b>Sub Total</b></div>
          </td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">$ 
                  <? printf("%01.2f",$subtotal);?> </td>
        </tr>
				<tr> 
          <td colspan="<?=$colspan?>" align="right"><b>Discount</b></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"><font color="#FF0000">($ 
                  <? printf("%01.2f",$discount_value);?>)</font> </td>
        </tr>
		<? if (WebContent::getPropertyValue("TaxShipping") == "yes") {?>
		<tr> 
          <td colspan="<?=$colspan?>" align="right"><b>Shipping via <?=$customer->getShippingMethod()?></b></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">$ 
                  <? printf("%01.2f",$customer->getShippingRate());?> </td>
        </tr>
		<tr> 
          <td colspan="<?=$colspan?>" align="right"><b><?=$customer->getState()?> Sales Tax (<?=($sales_tax_rate * 100)?>%)</b></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
                  $ <? printf("%01.2f",$sales_tax);?> </td>
        </tr>
		<? } else {?>
				<tr> 
          <td colspan="<?=$colspan?>" align="right"><b><?=$customer->getState()?> Sales Tax (<?=($sales_tax_rate * 100)?>%)</b></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
                  $ <? printf("%01.2f",$sales_tax);?> </td>
        </tr>
        <tr> 
          <td colspan="<?=$colspan?>" align="right"><b>Shipping via <?=$customer->getShippingMethod()?></b></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">$ 
                  <? printf("%01.2f",$customer->getShippingRate());?> </td>
        </tr>        
		<? }?>
				<tr> 
          <td colspan="<?=$colspan?>" align="right"><b>Total</b></td>
                <td width="15%" align="right" nowrap bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>"> 
                  $ <? printf("%01.2f",$total);?> </td>
        </tr>
      </table>
			</td></tr>
			<tr><td colspan="2">
			<? if (WebContent::getPropertyValue("ask_shipping_info") == "" || WebContent::getPropertyValue("ask_shipping_info") == "yes") {?>
				<table cellpadding="5" cellspacing="0" border="1" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<tr><td <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
				<strong>Shipping Information</strong>
				</font>
				</td></tr>
				<tr><td>
				<font size="-1"> 
				<strong>
				<?=$customer->getShippingFirstName()?>
				<? if ($customer->getShippingMiddleInitial() != "") {?>
				<?=$customer->getShippingMiddleInitial()?>
				<? }?>
				<?=$customer->getShippingLastName()?>
				</strong>
				<br>
				&nbsp;<?=$customer->getShippingAddress1()?>
				<br>
				<? if ($customer->getShippingAddress2()) {?>
				&nbsp;<?=$customer->getShippingAddress2()?>
				<br>
				<? }?>
				&nbsp;<?=$customer->getShippingCity()?>, <?=$customer->getShippingState()?> <?=$customer->getShippingZip()?>
				<br>
				&nbsp;<?=$customer->getShippingCountry()?>
				</font>
				</td></tr>
				</table>
			<? }?>
			</td></tr>
			<tr><td colspan="2">
			<? if (trim($customer->getMessage()) <> "") {?>
				<table cellpadding="5" cellspacing="0" border="1" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<tr><td <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
				<font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">
				<strong>Gift Message</strong>
				</font>
				</td></tr>
				<tr><td>
				<font size="-1"> 
				<?=$customer->getMessage()?>
				</font>
				</td></tr>
				</table>
			<? }?>
			</td></tr>
			</table>
			<p align="left"><font size="-1"><b>Make sure all the above information are correct.</b></font></p>
			<div align="center"> 
			<input type="button" name="back" value="Back" onClick="window.open('mystore.php?Page=CheckOut1&sub_total=<?=$subtotal?>','_self');">
			<input type="button" name="ProcessOrderButton" value="Process Order" onClick="processOrder();">
			<input type="button" name="EditInfoButton" value="Edit Order Information" onClick="MM_goToURL('parent','mystore.php?Page=CheckOut1');return document.MM_returnValue">
			<input type="button" name="CancelButton" value="Cancel Order" onClick="window.open('mystore.php?Page=Home','_self');">
			</div>
		</td>
  </tr>
</table>