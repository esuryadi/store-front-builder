<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
</head>
<? include (_TEMPLATEPATH . "outlook/components/javascript.php");?>
<? include (_TEMPLATEPATH . "outlook/components/css.php");?>
<? include (_TEMPLATEPATH . "outlook/components/body_tag.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
     <td><table border="0" cellspacing="0" cellpadding="4"> 
         <tr> 
          <td><strong><font size="-1"> 
            <? if(WebContent::getPropertyValue("logo_img_src") != "") {?> 
            </font></strong> 
             <table border="0" cellspacing="0" cellpadding="10"> 
              <tr> 
                 <td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" id="logo"></td> 
                 <? if(WebContent::getPropertyValue("show_logo_img_txt") == "yes") {?> 
                 <td><font size="+1"><strong> 
                  <?=WebContent::getPropertyValue("logo_img_text")?> 
                  </strong></font></td> 
                 <? }?> 
               </tr> 
            </table> 
             <strong><font size="-1"> 
             <? } else {?> 
             <table border="0" cellspacing="0" cellpadding="10"> 
               <tr> 
                 <td><font size="+1"><strong> 
                  <?=WebContent::getPropertyValue("logo_img_text")?> 
                  </strong></font></td> 
               </tr> 
             </table> 
             <? }?> 
             </font></strong></td> 
        </tr> 
       </table> 
      <strong></strong></td> 
     <td align="right" valign="bottom"><table border="0" cellspacing="0" cellpadding="3"> 
         <tr> 
          <? if (array_search("Shopping Cart",$comp) > -1) {?> 
          <td nowrap><table bgcolor="<?=WebContent::getPropertyValue("outlook_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/<? if (WebContent::getPropertyValue("outlook_body_bgcolor") == "" || WebContent::getPropertyValue("outlook_body_bgcolor") == "#FFFFFF") {?>icon_shopping_cart.gif<? } else {?>icon_shopping_cart_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a> 
            <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
            - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
            <? }?> 
            </font></strong></td> 
          <td nowrap>&nbsp;&nbsp;</td> 
          <? }?> 
          <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
          <td nowrap><table bgcolor="<?=WebContent::getPropertyValue("outlook_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/<? if (WebContent::getPropertyValue("outlook_body_bgcolor") == "" || WebContent::getPropertyValue("outlook_body_bgcolor") == "#FFFFFF") {?>icon_wish_list.gif<? } else {?>icon_wish_list_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish List</a></font></strong></td> 
          <td nowrap>&nbsp;&nbsp;</td> 
          <? }?> 
          <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
          <td nowrap><table bgcolor="<?=WebContent::getPropertyValue("outlook_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/<? if (WebContent::getPropertyValue("outlook_body_bgcolor") == "" || WebContent::getPropertyValue("outlook_body_bgcolor") == "#FFFFFF") {?>icon_account.gif<? } else {?>icon_account_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=Account">Account</a></font></strong></td> 
          <td nowrap>&nbsp;&nbsp;</td> 
          <? if (isset($user)) {?> 
          <td nowrap><table bgcolor="<?=WebContent::getPropertyValue("outlook_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/<? if (WebContent::getPropertyValue("outlook_body_bgcolor") == "" || WebContent::getPropertyValue("outlook_body_bgcolor") == "#FFFFFF") {?>icon_sign_in.gif<? } else {?>icon_sign_in_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a></font></strong></td> 
          <? } else {?> 
          <td nowrap><table bgcolor="<?=WebContent::getPropertyValue("outlook_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/<? if (WebContent::getPropertyValue("outlook_body_bgcolor") == "" || WebContent::getPropertyValue("outlook_body_bgcolor") == "#FFFFFF") {?>icon_sign_in.gif<? } else {?>icon_sign_in_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a></font></strong></td> 
          <? }?> 
          <? }?> 
        </tr> 
       </table></td> 
   </tr> 
</table> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>"> 
  <tr> 
    <td bgcolor="<?=WebContent::getPropertyValue("outlook_bar_1_color")?>"> <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
        <tr> 
          <td> <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="4" height="1"></td> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="151" height="1"></td> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" height="1" width="1"></td> 
                <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" height="1" width="645"></td> 
              </tr> 
              <tr> 
                <td width="0%"></td> 
                <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
                <td width="0%" onClick="openURL('mystore.php?Page=Home&Category=ALL');"><div class="cursor"><strong> 
                    <div class="menufont"><a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a></div> 
                    </strong></div></td> 
                <? } else {?> 
                <td width="0%">&nbsp;</td> 
                <? }?> 
                <td width="0%" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>"><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="1" height="22"></td> 
                <td width="100%"> <table width="100%"> 
                    <tr> 
                      <td align="left"> <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
                        <font color="<?=WebContent::getPropertyValue("outlook_menu_font_color")?>" size="-1">Welcome back <strong> 
                        <?=$user->getFirstName()?> 
                        !</strong></font> 
                        <? } else if (isset($Category) && $Category != "ALL") {?> 
                        <font color="<?=WebContent::getPropertyValue("outlook_menu_font_color")?>" size="-1"><strong> 
                        <?=stripslashes($Category)?> 
                        </strong> 
                        <? if (isset($SubCategory1) && trim($SubCategory1) != "") {?> 
                        -
                        <?=stripslashes($SubCategory1)?> 
                        <? }?> 
                        </font> 
                        <? }?> </td> 
                      <td align="right"><? include (_TEMPLATEPATH . "outlook/components/top_link.php");?></td> 
                    </tr> 
                  </table> 
              </tr> 
              <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
              <? $sub_cat_1 = WebContent::getSubCategory1("Home");
							if (count($sub_cat_1) > 0) {?> 
              <tr bgcolor="<?=WebContent::getPropertyValue("outlook_menu_bgcolor")?>"> 
                <td width="4"><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" height="4" width="4"></td> 
                <td> <div class="menufont"> 
                    <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
                    <? if ($sub_cat_1[$x] != "") {?> 
                    <a class="InstantLink" href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"> 
                    <?=$sub_cat_1[$x]?> 
                    </a> <br> 
                    <? }?> 
                    <? }?> 
                  </div></td> 
                <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td> 
              </tr> 
              <? }?> 
              <? }?> 
            </table></td> 
          <td>&nbsp;</td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr> 
    <td> <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
        <tr> 
          <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="4" height="1"></td> 
          <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="151" height="1"></td> 
          <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" height="1" width="1"></td> 
          <td><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" height="1" width="645"></td> 
        </tr> 
        <tr> 
          <td width="0%" colspan="2" align="left" valign="top"> <? $main_cat = WebContent::getMainCategory();?> 
            <? if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
							$Category = $main_cat[0];?> 
            <? for($z=0;$z<count($main_cat);$z++) {?> 
            <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
            <table width="155" border="0" cellpadding="2" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>"> 
              <tr> 
                <td width="1" bgcolor="<?=WebContent::getPropertyValue("outlook_bar_1_color")?>">&nbsp;</td> 
                <td colspan="2" bgcolor="<?=WebContent::getPropertyValue("outlook_bar_1_color")?>" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');"><div class="cursor"><strong> 
                    <div class="menufont"><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                      <?=$main_cat[$z]?> 
                      </a></div> 
                    </strong></div></td> 
                <td align="right" bgcolor="<?=WebContent::getPropertyValue("outlook_bar_1_color")?>"><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="1" height="22"></td> 
              </tr> 
              <tr bgcolor="<?=WebContent::getPropertyValue("outlook_menu_bgcolor")?>"> 
                <td width="4"><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" height="4" width="4"></td> 
                <td width="10"><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="10" height="1"></td> 
                <td> <?php
										$sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);?> 
                  <div class="menufont"> 
                    <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
                    <? if ($sub_cat_1[$x] != "") {?> 
                    <a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"> 
                    <?=$sub_cat_1[$x]?> 
                    </a> <br> 
                    <? }?> 
                    <? }?> 
                  </div></td> 
                <td>&nbsp;</td> 
              </tr> 
              <tr> 
                <td colspan="3" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>"></td> 
                <td bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>"></td> 
              </tr> 
            </table> 
            <? }?> 
            <? }?> 
            <table border="0" cellspacing="0" cellpadding="10"> 
              <tr> 
                <td><strong> 
                  <? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
                  <a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/outlook/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a> 
                  <? }?> 
                  </strong></td> 
              </tr> 
            </table></td> 
          <td width="0%" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>"><img src="<?=(_URLPATH . "themes/outlook/")?>images/spacer.gif" width="1" height="22"></td> 
          <td width="100%" align="left" valign="top" height="300"> <table width="100%" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td> <? include (_TEMPLATEPATH . "outlook/components/body_content.php");?> </td> 
              </tr> 
            </table></td> 
        </tr> 
      </table></td> 
  </tr> 
</table> 
<? include (_TEMPLATEPATH . "outlook/components/bottom_link.php");?> 
</body>
</html>
