<center>
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr> 
      <td> 
				<center>
        <p>&nbsp;</p>
				  <? if (isset($Action) && ($Action == "SendWishList" || $Action == "MailWishList")) {?>
          <table cellpadding="20" cellspacing="0">
            <tr> 
              <td valign="top" width="72%"> 
								<? if ($Action == "SendWishList") {?>
									<p><font size="-1"><b>Send Wish List:</b></font></p>
									<form method="POST" action="mystore.php?Page=WishList&Action=MailWishList">
										<p><b>To:</b> 
											<input type="text" name="mail_to" size="40">
											(comma separated, for e.g. john@domain.com, ed@domain.com)</p>
										<p><b>Subject:</b> 
											<input type="text" name="mail_subject" value="<?=$wish_list->getDefaultMailSubject()?>" size="40">
										</p>
										<p><b>Message:</b><br>
											<textarea name="mail_body" rows="5" cols="40"><?=$wish_list->getDefaultMailBody($user->getFirstName(),$user->getLastName())?></textarea>
										</p>
										<p align="center">
											<input type="submit" name="Submit" value="Send Wish List">
										</p>
									</form>
								<? } else {?>
									<font size="-1">Your wish list has been sent successfully.</font>
								<? }?>
              </td>
              <td valign="top" width="28%"> <font size="-1">&nbsp; 
                </font> 
                <table border="0" cellpadding="0" cellspacing="1" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
                  <tr> 
                    <td>
                      <table border="0" cellpadding="5" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
                        <tr> 
                          <td align="center" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>" size="-1"><strong>Find 
                            Wish List</strong></font></td>
                        </tr>
                        <tr> 
                          <td>
                            <form name="findWishListForm" method="post" action="mystore.php?Page=FindWishList">
                              <table border="0" cellspacing="5" cellpadding="5">
                                <tr> 
                                  <td align="right" nowrap><font size="-1">First 
                                    Name:</font></td>
                                  <td> <font size="-1"> 
                                    <input type="text" name="FirstName" size="12">
                                    </font></td>
                                </tr>
                                <tr> 
                                  <td align="right" nowrap><font size="-1">Last 
                                    Name:</font></td>
                                  <td> <font size="-1"> 
                                    <input type="text" name="LastName" size="12">
                                    </font></td>
                                </tr>
                                <tr> 
                                  <td colspan="2"> 
                                    <div align="center"> <font size="-1"> 
                                      <input type="submit" name="Find2" value="Find">
                                      <input type="reset" name="Reset2" value="Reset">
                                      </font></div>
                                  </td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <font size="-1">&nbsp; 
                </font></td>
            </tr>
          </table>
          <? } else {?>
          <? if (isset($user) || isset($wish_list_user)) {?>
          <p><font size="-1"><strong>Wish List for <?=$first_name?> <?=$last_name?></strong></font><br></p>
					<? }?>
      <? if (!isset($user) && !isset($wish_list_user)) {?>
  <table border="0" cellpadding="0" cellspacing="1" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
          <tr> 
      <td><table border="0" cellpadding="5" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
          <tr> 
            <td align="center" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>" size="-1"><strong>Find Wish 
              List</strong></font></td>
          </tr>
          <tr> 
            <td><form name="findWishListForm" method="post" action="mystore.php?Page=FindWishList">
                <table border="0" cellspacing="5" cellpadding="5">
          <tr> 
                    <td align="right" nowrap><font size="-1">First Name:</font></td>
                    <td> <font size="-1"> 
                      <input type="text" name="FirstName" size="12">
                      </font></td>
                  </tr>
                  <tr> 
                    <td align="right" nowrap><font size="-1">Last Name:</font></td>
                    <td> <font size="-1"> 
                      <input type="text" name="LastName" size="12">
                      </font></td>
                  </tr>
                  <tr> 
                    <td colspan="2"> <div align="center"> <font size="-1"> 
                <input type="submit" name="Find" value="Find">
                <input type="reset" name="Reset" value="Reset">
                        </font></div></td>
          </tr>
        </table>
              </form></td>
          </tr>
        </table></td>
    </tr>
  </table>
			<? }?>
  <p>
  </p>
  <table cellpadding="20" cellspacing="0">
        <tr>
      <td valign="top" width="72%"> <font size="-1"> 
            <? if (isset($user) || isset($wish_list_user)) {?>
            <? if ($wish_list->getItemCount($user_id) > 0) {?>
        </font> <form name="wishListForm" method="post" action="mystore.php?Page=WishList">
          <font size="-1"> 
				<input type="hidden" name="Action" value="Update">
          </font> 
					<table width="100%" border="0" cellspacing="0" cellpadding="5">
							<tr> 								
              <td width="*" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1"><b>Item</b></font></div></td>
              <? if ($product_color_exist) {?>
							<td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1"><b>Color</b></font></div></td>
							<? }?>
							<? if ($product_size_exist) {?>
							<td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1"><b>Size</b></font></div></td>
							<? }?>
							<? if ($product_choices_exist) {?>
							<td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1"><b>Choices</b></font></div></td>
							<? }?>
							<td width="5%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1"><b>Quantity</b></font></div></td>
              <td width="10%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1"><b>Price</b></font></div></td>
              <td width="4%"> <div align="center"></div></td>
							</tr>
							<? $list = $wish_list->getItems($user_id);
							$subtotal = 0;
							$idx = 2;
							if ($product_color_exist)
								$idx++;
							if ($product_size_exist)
								$idx++;
							if ($product_choices_exist)
								$idx++;
							for ($i=0;$i<count($list);$i++) {
								$item = $list[$i];
								$product->setUser((isset($user))?$user:"");
								$prod = $product->getProduct($item["product_id"]);
								$price = $prod["price"] * $item["quantity"];
								$subtotal = $subtotal + $price?>
							<tr>        
								<input type="hidden" name="ProductId[]" value="<?=$item["product_id"]?>"> 
              <td width="55%"> <font size="-1"> 
                    <?=$prod["name"]?>
                </font></td>
							<? if ($product_color_exist) {?>
								<? if ($Action != "Find" && $prod["color"] != "") {?>
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
								<input type="hidden" name="color[]" value="<? if ($Action == "Find") {?><?=$item["product_color"]?><? }?>">
								<td width="5%" align="center"><? if ($Action == "Find") {?><?=$item["product_color"]?><? } else {?>&nbsp;<? }?></td>
								<? }?>
							<? }?>
							<? if ($product_size_exist) {?>
								<? if ($Action != "Find" && $prod["size"] != "") {?>
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
								<input type="hidden" name="size[]" value="<? if ($Action == "Find") {?><?=$item["product_size"]?><? }?>">
								<td width="5%" align="center"><? if ($Action == "Find") {?><?=$item["product_size"]?><? } else {?>&nbsp;<? }?></td>
								<? }?>
							<? }?>
							<? if ($product_choices_exist) {?>
								<? if ($Action != "Find" && $prod["choices"] != "") {?>
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
								<input type="hidden" name="choices[]" value="<? if ($Action == "Find") {?><?=$item["product_color"]?><? }?>">
								<td width="5%" align="center"><? if ($Action == "Find") {?><?=$item["product_choices"]?><? } else {?>&nbsp;<? }?></td>
								<? }?>
							<? }?>
              <td width="5%" align="center"> <font size="-1"> 
                    <input type="text" name="quantity[]" value="<?=$item["quantity"]?>" size="3">
                </font></td>
                      <td width="10%" align="right" nowrap><font size="-1"> $ 
                        <? printf("%01.2f",$price);?> </font></td>
              <td width="4%"> <font size="-1"> 
                    <input type="button" name="AddToShoppingCart" value="Add To Cart" onClick="addToShoppingCart('<?=$user_id?>',<?=$item["product_id"]?>,'<?=$item["product_color"]?>','<?=$item["product_size"]?>','<?=$item["product_choices"]?>',this.form.elements[<?=($idx)?>].value);">
                    <br>
									<input type="button" name="Button" value="Delete" onClick="deleteItem(<?=$item["product_id"]?>,<?=$item["quantity"]?>);">
                </font></td>
							</tr>
							<? 
							$z = 4;
							if ($product_color_exist)
								$z++;
							if ($product_size_exist)
								$z++;
							if ($product_choices_exist)
								$z++;
							$idx = $idx + $z;
							}?>
						</table> 
                  <font size="-1"> 
                  <? } else {?>
                  There are no item(s) in your wish list. 
                  <? }?>
                  </font> 
                  <p align="center"> <font size="-1"> 
                    <? if ($wish_list->getItemCount($user_id) > 0 && $user_password != "") {?>
                    <input type="submit" name="UpdateList" value="Update List">
                    <input type="button" name="SendListButton" value="Send Wish List" onClick="MM_goToURL('parent','mystore.php?Page=WishList&amp;Action=SendWishList');return document.MM_returnValue">
                    <input type="reset" name="Reset" value="Reset">
                    <? }?>
                    <input type="button" name="contShop" value="Continue Shopping" onClick="MM_goToURL('parent','mystore.php?Page=Home');return document.MM_returnValue">
                    </font></p>
        </form>
				<? }?>
        <font size="-1">&nbsp; 
        </font></td>
      <td valign="top" width="28%"> <font size="-1"> 
            <? if (isset($user) || isset($wish_list_user)) {?>
        </font> <table border="0" cellpadding="0" cellspacing="1" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
              <tr>
            <td><table border="0" cellpadding="5" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
                <tr> 
                  <td align="center" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>" size="-1"><strong>Find 
                    Wish List</strong></font></td>
                </tr>
								<tr> 
                  <td><form name="findWishListForm" method="post" action="mystore.php?Page=FindWishList">
                      <table border="0" cellspacing="5" cellpadding="5">
                        <tr> 
                          <td align="right" nowrap><font size="-1">First Name:</font></td>
                          <td> <font size="-1"> 
										      <input type="text" name="FirstName" size="12">
                            </font></td>
								</tr>
								<tr> 
                          <td align="right" nowrap><font size="-1">Last Name:</font></td>
                          <td> <font size="-1"> 
										      <input type="text" name="LastName" size="12">
                            </font></td>
								</tr>
								<tr> 
                          <td colspan="2"> <div align="center"> <font size="-1"> 
											<input type="submit" name="Find" value="Find">
											<input type="reset" name="Reset" value="Reset">
                              </font></div></td>
								</tr>
							</table>
                    </form></td>
                </tr>
              </table></td>
          </tr>
					</table>
        <font size="-1"> 
					<? }?>
        </font></td>
    </tr>
				</table> 
			<? }?>
        <p>&nbsp;</p>
        </center>
			</td>
    </tr>
  </table>
</center>
