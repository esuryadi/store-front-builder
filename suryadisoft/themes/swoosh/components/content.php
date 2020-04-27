<html>
<head>
<title>
<? if(WebContent::getPropertyValue("site_title") != "") {?>
<?=WebContent::getPropertyValue("site_title")?>
<? } else {?>
<?=$adminuser->getCompanyName()?>
<? }?>
</title>
<meta name="keywords" content="<? if(WebContent::getPropertyValue("keywords") != "") {?><?=WebContent::getPropertyValue("keywords")?><? }?>">
<meta name="description" content="<? if(WebContent::getPropertyValue("description") != "") {?><?=WebContent::getPropertyValue("description")?><? }?>">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if (WebContent::getPropertyValue("other_meta_tags") != "") {?>
<?=WebContent::getPropertyValue("other_meta_tags")?>
<? }?>
<? if (WebContent::getPropertyValue("bg_sound_src") != "") {?>
<bgsound src="<?=WebContent::getPropertyValue("bg_sound_src")?>" loop="true">
<? }?>
<? if (WebContent::getPropertyValue("css_file") != "") {?>
<link rel="stylesheet" type="text/css" href="<?=WebContent::getPropertyValue("css_file")?>">
<? }?>
<? include (_TEMPLATEPATH . "swoosh/components/javascript.php");?>
</head>
<? include (_TEMPLATEPATH . "swoosh/components/css.php");?>
<? include (_TEMPLATEPATH . "swoosh/components/body_tag.php");?>
<table width="800" border="0" cellpadding="0" cellspacing="0"> 
  <tr> 
     <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="4"> 
         <tr> 
          <td><table> 
              <tr> 
                <? if(WebContent::getPropertyValue("logo_img_src") != "") {?> 
                <td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" id="logo"></td> 
                <? if(WebContent::getPropertyValue("show_logo_img_txt") == "yes") {?> 
                <td><font size="+1"><strong> 
                  <?=WebContent::getPropertyValue("logo_img_text")?> 
                  </strong></font></td> 
                <? }?> 
                <? } else {?> 
                <td><font size="+1"><strong> 
                  <?=WebContent::getPropertyValue("logo_img_text")?> 
                  </strong></font></td> 
                <? }?> 
              </tr> 
            </table> 
           <td align="right" valign="bottom"> <table> 
               <tr> 
                <? if (array_search("Shopping Cart",$comp) > -1) {?> 
                <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("swoosh_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/icon_shopping_cart.gif" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a> 
                   <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
                   - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
                   <? }?></td> 
                <td nowrap>&nbsp;&nbsp;</td> 
                <? }?> 
                <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
                <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("swoosh_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/icon_wish_list.gif" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish List</a></td> 
                <td nowrap>&nbsp;&nbsp;</td> 
                <? }?> 
                <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
                <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("swoosh_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/icon_account.gif" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><a class="InstantLink" href="mystore.php?Page=Account">Your Account</a></td> 
                <td nowrap>&nbsp;&nbsp;</td> 
                <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("swoosh_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/icon_sign_in.gif" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <? if (isset($user)) {?> 
                <td nowrap><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a></td> 
                <? } else {?> 
                <td nowrap><a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a></td> 
                <? }?> 
                <? }?> 
              </tr> 
             </table></td> 
        </tr> 
       </table></td> 
   </tr> 
  <tr> 
     <td> <table border="0" cellspacing="0" cellpadding="0"> 
         <tr> 
          <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="150" height="1"></td> 
          <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="12" height="1"></td> 
          <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="638" height="1"></td> 
        </tr> 
         <tr valign="bottom"> 
          <td colspan="3"> <table width="800" border="0" cellpadding="0" cellspacing="0"> 
              <tr> 
                <td width="150" bgcolor="<?=WebContent::getPropertyValue("swoosh_menu_bgcolor_1")?>"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/long.gif" width="150" height="14"></td> 
                <td width="12" bgcolor="<?=WebContent::getPropertyValue("swoosh_menu_bgcolor_1")?>"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/square.gif" width="12" height="14"></td> 
                <td width="638"> <table width="638" border="0" cellspacing="0" cellpadding="0"> 
                    <tr> 
                      <td bgcolor="<?=WebContent::getPropertyValue("swoosh_menu_bgcolor_1")?>"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="2"></td> 
                    </tr> 
                    <tr> 
                      <td bgcolor="<?=WebContent::getPropertyValue("swoosh_menu_bgcolor_1")?>"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="1"></td> 
                    </tr> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="11"></td> 
                    </tr> 
                  </table></td> 
              </tr> 
            </table></td> 
        </tr> 
         <tr> 
          <td valign="top"> <table width="150" border="0" cellspacing="0" cellpadding="0"> 
              <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
              <tr> 
                <td class="cursor" onClick="openURL('mystore.php?Page=Home&Category=ALL');"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("swoosh_menu_bgcolor_1")?>"> 
                    <tr> 
                      <td> <table width="100%" border="0" cellspacing="0" cellpadding="2"> 
                          <tr> 
                            <td> <table border="0" cellspacing="0" cellpadding="0"> 
                                <tr> 
                                  <td>&nbsp;</td> 
                                  <td><strong> 
                                    <div class="tabfont"><font color="<?=WebContent::getPropertyValue("swoosh_menu_font_color")?>" size="-1"><b><a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a></b></font></div> 
                                    </strong> 
                                    </div></td> 
                                </tr> 
                              </table> 
                              <? $sub_cat_1 = WebContent::getSubCategory1("Home");?> 
                              <? if ($Page == "Home" && isset($Category) && $Category =="ALL" && count($sub_cat_1) > 0) {?> 
                              <table border="0" cellspacing="0" cellpadding="4"> 
                                <tr> 
                                  <td>&nbsp;</td> 
                                  <td> <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
                                    <? if ($sub_cat_1[$x] != "") {?> 
                                    <a class="InstantLink" href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"> <font color="<?=WebContent::getPropertyValue("swoosh_menu_font_color")?>" size="-1"> 
                                    <?=$sub_cat_1[$x]?> 
                                    </font></a> <br> 
                                    <? }?> 
                                    <? }?> </td> 
                                </tr> 
                              </table> 
                              <? }?> </td> 
                          </tr> 
                        </table></td> 
                      <td width="3" background="<?=(_URLPATH . "themes/swoosh/")?>images/side-r.gif"></td> 
                    </tr> 
                    <tr> 
                      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                          <tr> 
                            <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="2"></td> 
                          </tr> 
                          <tr> 
                            <td bgcolor="#666666"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="1"></td> 
                          </tr> 
                        </table></td> 
                      <td width="3"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/corner-br.gif"></td> 
                    </tr> 
                  </table></td> 
              </tr> 
              <? }?> 
              <tr> 
                <td align="center"> <? $main_cat = WebContent::getMainCategory();?> 
                  <? if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
										$Category = $main_cat[0];?> 
                  <? for($z=0;$z<count($main_cat);$z++) {?> 
                  <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?><?=WebContent::getPropertyValue("swoosh_menu_bgcolor_2")?><? } else {?><?=WebContent::getPropertyValue("swoosh_menu_bgcolor_1")?><? }?>"> 
                    <tr> 
                      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                          <tr> 
                            <td bgcolor="<?=WebContent::getPropertyValue("swoosh_body_bgcolor")?>"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="1"></td> 
                          </tr> 
                          <tr> 
                            <td bgcolor="bbbbbb"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="1"></td> 
                          </tr> 
                          <tr> 
                            <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="2"></td> 
                          </tr> 
                        </table></td> 
                      <td width="3"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/corner-tr.gif"></td> 
                    </tr> 
                    <tr> 
                      <td class="cursor" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');"> <table width="100%" border="0" cellspacing="0" cellpadding="2"> 
                          <tr> 
                            <td> <table border="0" cellspacing="0" cellpadding="0"> 
                                <tr> 
                                  <td>&nbsp;</td> 
                                  <td><strong> 
                                    <div class="menufont"><font <? if ($Page != "Home" || !isset($Category) || (isset($Category) && $Category != $main_cat[$z])) {?>color="<?=WebContent::getPropertyValue("swoosh_menu_font_color")?>"<? }?> size="-1"><b><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                                      <?=$main_cat[$z]?> 
                                      </a></b></font></strong></div></td> 
                                </tr> 
                              </table> 
                              <? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?> 
                              <table border="0" cellspacing="0" cellpadding="4"> 
                                <tr> 
                                  <td>&nbsp;</td> 
                                  <td> <font class="menufont" size="-1"> 
                                    <? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);?> 
                                    <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
                                    <? if ($sub_cat_1[$x] != "") {?> 
                                    <a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"> 
                                    <?=$sub_cat_1[$x]?> 
                                    </a> <br> 
                                    <? }?> 
                                    <? }?> 
                                    </font> </td> 
                                </tr> 
                              </table> 
                              <? }?> </td> 
                          </tr> 
                        </table></td> 
                      <td width="3" background="<?=(_URLPATH . "themes/swoosh/")?>images/side-r.gif"></td> 
                    </tr> 
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                          <tr> 
                            <td><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="2"></td> 
                          </tr> 
                          <tr> 
                            <td bgcolor="#666666"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/spacer.gif" width="1" height="1"></td> 
                          </tr> 
                        </table></td> 
                      <td width="3"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/corner-br.gif"></td> 
                    </tr> 
                  </table> 
                  <? }?> 
                  <? }?> 
                  <table border="0" cellspacing="0" cellpadding="10"> 
                    <tr> 
                      <td><? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
                        <a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/swoosh/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a> 
                        <? }?></td> 
                    </tr> 
                  </table></td> 
              </tr> 
            </table></td> 
          <td>&nbsp;</td> 
          <td valign="top" height="300"> <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
             <div align="right"><font size="-1">Welcome Back <strong> 
              <?=$user->getFirstName()?> 
              !</strong></font></div> 
             <? }?> 
             <table width="100%" cellpadding="5"> 
              <tr> 
                 <td align="right"> <? include (_TEMPLATEPATH . "swoosh/components/top_link.php");?> </td> 
               </tr> 
            </table> 
             <? include (_TEMPLATEPATH . "swoosh/components/body_content.php");?> </td> 
        </tr> 
       </table> 
    <td>&nbsp;</td> 
   </tr> 
</table> 
<? include (_TEMPLATEPATH . "swoosh/components/bottom_link.php");?> 
</body></html>
