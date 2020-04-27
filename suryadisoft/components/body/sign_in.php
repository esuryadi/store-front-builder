				<div align="center">
  <p>&nbsp;</p>
  <table border="0" cellspacing="0" cellpadding="10">
    <tr> 
      <td> <font size="-1"> 
				<? if (isset($Login) && $Login == "failed") {?>
        Your User Id and Password don't match. Please try again.</font> <font size="-1"> 
				<? }?>
        <br>
        </font>
        <form action="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=Home" method="post" name="loginForm" id="loginForm">
          <font size="-1">
          <input name="Action" type="hidden" id="Action" value="login">
					<? if (isset($GoTo) && $GoTo == "ShoppingCart") {?>
					<input name="GoTo" type="hidden" value="ShoppingCart">
					<input name="ShoppingCartAction" type="hidden" value="<?=$Action?>">					
					<input name="ProductId" type="hidden" value="<? if (isset($ProductId)) {?><?=$ProductId?><? }?>">
					<input name="Color" type="hidden" value="<? if (isset($Color)) {?><?=$Color?><? }?>">
					<input name="Size" type="hidden" value="<? if (isset($Size)) {?><?=$Size?><? }?>">
					<input name="Choice" type="hidden" value="<? if (isset($Choice)) {?><?=$Choice?><? }?>">
					<? if (isset($Quantity)) {?>
					<input name="Quantity" type="hidden" value="<?=$Quantity?>">
					<? }?>
					<? if (isset($UserId)) {?>
					<input name="UserId" type="hidden" value="<?=$UserId?>">
					<? }?>
					<? } else if (isset($GoTo) && $GoTo == "WishList") {?>
					<input name="GoTo" type="hidden" value="WishList">
					<input name="WishListAction" type="hidden" value="<?=$Action?>">					
					<input name="ProductId" type="hidden" value="<? if (isset($ProductId)) {?><?=$ProductId?><? }?>">
					<input name="Color" type="hidden" value="<? if (isset($Color)) {?><?=$Color?><? }?>">
					<input name="Size" type="hidden" value="<? if (isset($Size)) {?><?=$Size?><? }?>">
					<input name="Choice" type="hidden" value="<? if (isset($Choice)) {?><?=$Choice?><? }?>">
					<? } else if (isset($GoTo) && $GoTo == "Account") {?>
					<input name="GoTo" type="hidden" value="Account">
					<? }?>
          </font>
          <table border="0" cellpadding="0" cellspacing="1" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
            <tr>
              <td><table border="0" cellpadding="5" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
                  <tr> 
                    <td align="center" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>" size="-1"><strong>User 
                      Sign-In </strong></font></td>
                  </tr>
                  <tr> 
                    <td><table border="0" cellpadding="10" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
                  <tr> 
                          <td width="221"><table width="50" border="0" cellpadding="2" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
                              <tr> 
                                <td align="right"><font size="-1">User Id:</font></td>
                                <td><font size="-1">
                                  <input name="UserId" type="text" id="UserId">
                                  </font></td>
                              </tr>
                              <tr> 
                                <td align="right"><font size="-1">Password:</font></td>
                                <td><font size="-1">
                                  <input name="Password" type="password" id="Password">
                                  </font></td>
                              </tr>
                            </table></td>
                        </tr>
                        <tr> 
                          <td align="center"><font size="-1">
                        <input type="submit" name="Submit" value="Login" onClick="validateForm(this.form);">
                        <input type="reset" name="Submit2" value="Reset">
                            </font></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </form>
        <p><font size="-1"><strong>New users</strong> register <a href="mystore.php?Page=Registration">here</a>.<br>
          <br>
          Forgot your <a href="mystore.php?Page=ForgetPassword">Password</a>?<br>
          <br>
          </font></p></td>
    </tr>
  </table>
  <font size="-1"></p> </font></div>
        
