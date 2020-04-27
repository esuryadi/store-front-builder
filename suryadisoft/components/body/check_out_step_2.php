<form name="ShippingForm" method="post" action="mystore.php?Page=ReviewOrder">
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr> 
	<td colspan="6"> 
	<? if (WebContent::getPropertyValue("ask_shipping_info") == "" || WebContent::getPropertyValue("ask_shipping_info") == "yes") {?>
	<font size="-1">&nbsp; </font>	
	<p><font size="-1"><b>Select your shipping options:</b></font></p>
	<table width="65%" border="1" cellspacing="0" cellpadding="5" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
	<tr> 
		<th width="50%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Shipping Method</font></th>
		<th width="15%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Rate</font></th>
	</tr>
	<? $n = 0; 
	for($i=0;$i<count($shipping_method);$i++) {?>
	<? if ($shipping_rate[$i] !== "-") {?> 
	<tr> 
		<td width="50%">
			<font size="-1"> 
			<input type="radio" name="ShippingMethod" value="<?=$i?>" <? if($customer->getShippingMethod() == $shipping_method[$i]) {?>CHECKED<? } else if ($n == 0) {?>CHECKED<? }?>>
			<?=$shipping_method[$i]?>
			</font>
		</td>
		<td width="15%" align="right"><font size="-1"> $ <? printf("%01.2f",$shipping_rate[$i]);?></font></td>
	</tr>
	<? if ($i == (count($shipping_method)-1) && WebContent::getPropertyValue("additional_services") != "") {?>
		<? $add_svc = explode(",",WebContent::getPropertyValue("additional_services"));?>
		<? for ($z=0;$z<count($add_svc);$z++) {?>
		<tr> 
			<td colspan="2">
				<font size="-1"> 
				<input type="checkbox" name="AdditionalServices[]" value="<?=$add_svc[$z]?>">
				<?=$add_svc[$z]?> (Additional Charge $12.50)
				</font>
			</td>
		</tr>
		<? }?>
	<? }?>
	<? if ($weight == 0 && WebContent::getPropertyValue("shipping_mode") == "auto") break;?>
	<? $n++; 
	}?>
	<? }?>
	</table>
	<font size="-1"> Please note that some orders might be required to be sent by other mail options such as Postal Service".</font>
	<? }?>
	      <p> <font size="-1"><b>Enter coupon(s)/gift certificate(s) if there are 
          any:</b></font> 
          <input name="coupon" type="text" id="coupon">
					<input name="test" type="hidden" value="testing">
          <input name="addButton" type="button" id="addButton" value="Add Coupon/Gift Certificate" onClick="addCoupon(this.form);">
        </p>
	<table width="0%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td>
							<select name="coupons" size="5" id="coupons">
              </select>
							<input type="hidden" name="prod_coupons" value="">
			</td>
            <td><input name="deleteButton" type="button" id="deleteButton" value="Delete" onClick="deleteCoupon(this.form);"></td>
          </tr>
        </table>
		<? if (WebContent::getPropertyValue("agreement") == "yes") {?>
		<p><strong>Terms and Agreement:</strong><br>
	    <textarea name="agreement" cols="60" rows="10" readonly="readonly"><?=WebContent::getPropertyValue("agreement_text")?></textarea></p>
		<p><strong>Do you agree with the terms and agreement stated above: </strong></p>
		<p><input name="answer" type="radio" value="agree" onClick="disableButton(this.form,false);">
		  <strong>I Agree</strong>		  <input name="answer" type="radio" value="disagree" onClick="disableButton(this.form,true);" checked>
		  <strong>I Disagree</strong></p>
		<? }?>
		<p><strong>Optional Message if this is a gift purchase:</strong>
		<textarea name="message" rows="10" cols="60"><?=$customer->getMessage()?></textarea>
		</p>
        <p align="center"> 
					<? if (WebContent::getPropertyValue("show_review_order") == "yes" || WebContent::getPropertyValue("show_review_order") == "") {?>
          <input type="submit" name="reviewOrderButton" value="Review Order" <? if (WebContent::getPropertyValue("agreement") == "yes" && WebContent::getPropertyValue("button_status") == "disabled") {?>disabled<? }?>>
          <? }?>
		  <input type="button" name="back" value="Back" onClick="window.open('mystore.php?Page=CheckOut1&sub_total=<?=$price?>','_self');">
					<input name="processOrderButton" type="button" id="processOrderButton" value="Process Order" onClick="processOrder(this.form);" <? if (WebContent::getPropertyValue("agreement") == "yes" && WebContent::getPropertyValue("button_status") == "disabled") {?>disabled<? }?>>
          <input type="button" name="CancelButton" value="Cancel Order" onClick="window.open('mystore.php?Page=Home','_self');">
					<input name="Reset" type="reset" id="Reset" value="Reset">
        </p>
	</td>
</tr>
</table>
  <p><font size="-1"><strong>Note: </strong>If you click Process Order button, you will complete 
    the order without having a chance to review your order and making necessary 
    changes.</font></p>
</form>