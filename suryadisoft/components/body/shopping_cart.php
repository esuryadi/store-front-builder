<? if ($Action != "View" && $Action != "Update" && isset($Quantity) && $Quantity > $prd["qty"] && $prd["qty"] > 0) {?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>

<br><br>
<font size="+1">We only have <?=$prd["qty"]?> item(s) left in our inventory. Please update your quantity.</font>
<p align="center"><input name="contShop" type="button" value="Continue Shopping" onClick="MM_goToURL('parent','mystore.php?Page=Home');return document.MM_returnValue"></p>
<? } else if ($Action != "View" && $Action != "Update" && isset($Quantity) && $Quantity < 1) {?>
<br><br>
<font size="+1">You cannot enter 0 or negative number on quantity.</font>
<p align="center"><input name="contShop" type="button" value="Continue Shopping" onClick="MM_goToURL('parent','mystore.php?Page=Home');return document.MM_returnValue"></p>

<? } else if ($Action != "View" && $Action != "Update" && $prd["qty"] <= 0) {?>
<br><br>
<font size="+1">We're sorry, "<?=$prd["name"]?>" is currently out of stock.</font>
<p align="center"><input name="contShop" type="button" value="Continue Shopping" onClick="MM_goToURL('parent','mystore.php?Page=Home');return document.MM_returnValue"></p>
<? } else {?>
<center>
  <p>&nbsp;</p><table width="100%" border="0" cellspacing="0" cellpadding="10">
    <tr> 
      <td><center>
  <font size="-1"><strong>Shopping Cart</strong><br>
			<? if (isset($shopping_cart) && $shopping_cart->getItemCount($user_id) > 0) {?>
  </font>
      <form name="shoppingCartForm" method="post" action="mystore.php?Page=ShoppingCart">
    <font size="-1">
				<input type="hidden" name="Action" value="Update">
    </font>
        <table width="75%" border="0" cellspacing="0" cellpadding="5">
            <tr> 
        <td width="*" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Item</b></font></div></td>
				<? if ($product_color_exist) {?>
				<td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Color</b></font></div></td>
				<? }?>
				<? if ($product_size_exist) {?>
				<td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Size</b></font></div></td>
				<? }?>
				<? if ($product_choices_exist) {?>
				<td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Choices</b></font></div></td>
				<? }?>
        <td width="5%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Quantity</b></font></div></td>
        <td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Price</b></font></div></td>
        <td width="4%"> <div align="center"></div></td>
            </tr>
						<? $cart = $shopping_cart->getItems($user_id);
						$subtotal = 0;
						for ($i=0;$i<count($cart);$i++) {
							$item = $cart[$i];
							$product->setUser((isset($user))?$user:"");
							$prod = $product->getProduct($item["product_id"]);
							$price = $prod["price"] * $item["quantity"];
							$subtotal = $subtotal + $price;?>
            <tr>        
							<input type="hidden" name="ProductId[]" value="<?=$item["product_id"]?>"> 
        <td width="*"><font size="-1"> 
          <?=$prod["name"]?>
          </font></td>
				<? if ($product_color_exist) {?>
					<? if ($prod["color"] != "") {?>
						<? $color = explode(",",$prod["color"]);?>
						<td width="5%" align="center"> <font size="-1"> 
							<select name="color[]" onChange="updateChoices(this.form);">
							<? for($n=0;$n<count($color);$n++) {?>
							<option value="<?=$color[$n]?>" <? if ($item["product_color"] == $color[$n]) {?>selected<? }?>><?=$color[$n]?></option>
							<? }?>
							</select>
							</font>
						</td>
					<? } else {?>
					<input type="hidden" name="color[]" value="">
					<td width="5%" align="center">&nbsp;</td>
					<? }?>
				<? }?>
				<? if ($product_size_exist) {?>
					<? if ($prod["size"] != "") {?>
						<? $size = explode(",",$prod["size"]);?>
						<td width="5%" align="center"> <font size="-1"> 
							<select name="size[]" onChange="updateChoices(this.form);">
							<? for($n=0;$n<count($size);$n++) {?>
							<option value="<?=$size[$n]?>" <? if ($item["product_size"] == $size[$n]) {?>selected<? }?>><?=$size[$n]?></option>
							<? }?>
							</select>
							</font>
						</td>
					<? } else {?>
					<input type="hidden" name="size[]" value="">
					<td width="5%" align="center">&nbsp;</td>
					<? }?>
				<? }?>
				<? if ($product_choices_exist) {?>
					<? if ($prod["choices"] != "") {?>
						<? $choices = explode(",",$prod["choices"]);?>
						<td width="5%" align="center"> <font size="-1"> 
							<select name="choices[]" onChange="updateChoices(this.form);">
							<? for($n=0;$n<count($choices);$n++) {?>
							<option value="<?=$choices[$n]?>" <? if ($item["product_choices"] == $choices[$n]) {?>selected<? }?>><?=$choices[$n]?></option>
							<? }?>
							</select>
							</font>
						</td>
					<? } else {?>
					<input type="hidden" name="choices[]" value="">
					<td width="5%" align="center">&nbsp;</td>
					<? }?>
				<? }?>
        <td width="5%" align="center"> <font size="-1"> 
								<input type="text" name="quantity[]" value="<?=$item["quantity"]?>" size="3">
          </font></td>
                <td width="10%" align="right" nowrap><font size="-1"> $ <? printf("%01.2f",$price);?> 
                  </font></td>
        <td width="4%"> <font size="-1">
								<input type="button" name="Button" value="Delete" onClick="deleteItem(<?=$item["product_id"]?>,<?=$item["quantity"]?>);">
          </font></td>
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
        <td colspan="<?=$colspan?>" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Sub-Total</b></font></td>
                <td width="10%" align="right" nowrap <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"> 
                  $ <? printf("%01.2f",$subtotal);?> </font></td>
            <td width="4%">&nbsp;</td>
            </tr>
          </table>  
            <font size="-1"> 
            <? } else {?>
            There are no items in your shopping cart.</font> <font size="-1"> 
            <? }?>
            </font> 
            <p align="center"> <font size="-1"> 
			  <input type="button" name="back" value="Back" onClick="history.go(-1);">
              <? if (isset($shopping_cart) && $shopping_cart->getItemCount($user_id) > 0) {?>
              <input type="submit" name="UpdateCart" value="Update Cart">
              <input type="reset" name="Reset" value="Reset">
              <input type="button" name="CheckOut" value="Check Out" onClick="MM_goToURL('parent','<? if (($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && WebContent::getPropertyValue("verisign_order_form") == "False" && WebContent::getPropertyValue("use_ssl") == "Yes") || ($payment->getPaymentService(_USER) == "VeriSign PayFlow Pro" && (WebContent::getPropertyValue("use_ssl") == "Yes" || WebContent::getPropertyValue("use_ssl") == ""))) {?>https://<?=$company_url?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$subtotal?>');return document.MM_returnValue">
              <? }?>
              <input type="button" name="contShop" value="Continue Shopping" onClick="MM_goToURL('parent','mystore.php?Page=Home');return document.MM_returnValue">
              </font></p>
            <p align="left"><font size="-1"><a href="mystore.php?Page=Product&ProductId=<?=$ProductId?>"><? if (WebContent::getPropertyValue("shopping_cart_message") != "") {?><?=WebContent::getPropertyValue("shopping_cart_message")?><? } else {?>Click Here - To add additional size/color combinations of the last item placed in the shopping cart.<? }?></a></font></p>
        </form>
        </center></td>
    </tr>
  </table>
</center>
<? if (isset($err_msg)) {?>
<script language="javascript">
<!--
alert('<?=$err_msg?>');
-->
</script>
<? }?>
<? }?>