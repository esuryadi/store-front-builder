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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<? include (_TEMPLATEPATH . "outlook_2/components/header.php");?>
</head>
<? include (_TEMPLATEPATH . "outlook_2/components/layer.php");?>
<? include (_TEMPLATEPATH . "outlook_2/components/javascript.php");?>
<? include (_TEMPLATEPATH . "outlook_2/components/css.php");?>
<? include (_TEMPLATEPATH . "outlook_2/components/body_tag.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
     <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="3"> 
         <tr> 
          <td> <table> 
              <tr> 
                <? if(WebContent::getPropertyValue("logo_img_src") != "") {?> 
                <td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" height="<?=WebContent::getPropertyValue("outlook_2_logo_height")?>" id="logo"></td> 
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
            </table></td> 
          <td align="right" valign="bottom"> <table cellpadding="1"> 
              <tr> 
                <? if (array_search("Shopping Cart",$comp) > -1) {?> 
                <td nowrap><table cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("outlook_2_icon_color")?>"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_shopping_cart.gif<? } else {?>icon_shopping_cart_bl.gif<? }?>" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><font size="-1"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a> 
                  <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
                  - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
                  <? }?> 
                  </font></td> 
                <td width="1">&nbsp;</td> 
                <? }?> 
                <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
                <td nowrap><table cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("outlook_2_icon_color")?>"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_wish_list.gif<? } else {?>icon_wish_list_bl.gif<? }?>" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><font size="-1"><a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish List</a></font></td> 
                <td width="1">&nbsp;</td> 
                <? }?> 
                <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
                <td nowrap><table cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("outlook_2_icon_color")?>"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_account.gif<? } else {?>icon_account_bl.gif<? }?>" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><font size="-1"><a class="InstantLink" href="mystore.php?Page=Account">Your Account</a></font></td> 
                <td width="1">&nbsp;</td> 
                <td nowrap><table cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("outlook_2_icon_color")?>"> 
                    <tr> 
                      <td><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_sign_in.gif<? } else {?>icon_sign_in_bl.gif<? }?>" width="16" height="12"></td> 
                    </tr> 
                  </table></td> 
                <td nowrap><font size="-1"> 
                  <? if (isset($user)) {?> 
                  <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a> 
                  <? } else {?> 
                  <a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a> 
                  <? }?> 
                  </font></td> 
                <? }?> 
              </tr> 
            </table></td> 
        </tr> 
       </table></td> 
   </tr> 
  <tr> 
     <td width="150" valign="top"> <table width="100%" cellpadding="0" cellspacing="0"> 
         <tr> 
          <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
              <tr bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_2_color")?>"> 
                <td width="5" height="5"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_left.gif<? } else {?>tab_corner_left_bl.gif<? }?>" width="5" height="5"></td> 
                <td width="145" height="5"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/spacer.gif" width="145" height="5"></td> 
              </tr> 
              <tr class="cursor" bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_2_color")?>"> 
                <td width="5"></td> 
                <? $sub_cat_1 = WebContent::getSubCategory1("Home");?> 
                <td id="ALL" onClick="openURL('mystore.php?Page=Home&Category=ALL');"> &nbsp;<font size="-1" color="#FFFFFF"> 
                  <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
                  <a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a> 
                  <? }?> 
                  </font> </td> 
              </tr> 
              <tr bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_1_color")?>"> 
                <td width="5"></td> 
                <td> <table width="100%" cellpadding="5"> 
                    <tr> 
                      <td> <form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm"> 
                          <strong>Search:<br> 
                          </strong> 
                          <input type="hidden" name="Category" value="ALL"> 
                          <br> 
                          <input name="Keyword" type="text" id="Keyword" size="12"> 
                          <input name="SearchButton" type="submit" id="SearchButton3" value="Go"> 
                        </form></td> 
                    </tr> 
                  </table></td> 
              </tr> 
              <tr bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_1_color")?>"> 
                <td width="5" height="5"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_bleft.gif<? } else {?>tab_corner_bleft_bl.gif<? }?>" width="5" height="5"></td> 
                <td height="5"></td> 
              </tr> 
            </table></td> 
        </tr> 
         <tr> 
          <td height="4" valign="top"></td> 
        </tr> 
         <tr> 
          <td valign="top"> <table width="100%" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_table_header_background")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_left.gif<? } else {?>tab_corner_left_bl.gif<? }?>" width="5" height="5"></td> 
                <td bgcolor="<?=WebContent::getPropertyValue("outlook_2_table_header_background")?>"></td> 
              </tr> 
              <tr onMouseOver="setVisibility('','hidden',0,0);"> 
                <td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_table_header_background")?>"></td> 
                <td bgcolor="<?=WebContent::getPropertyValue("outlook_2_table_header_background")?>">&nbsp;<strong><font color="#FFFFFF">BROWSE</font></strong></td> 
              </tr> 
              <tr onMouseOver="setVisibility('','hidden',0,0);"> 
                <td height="1" bgcolor="#FFFFFF"></td> 
                <td height="1" bgcolor="#FFFFFF"></td> 
              </tr> 
              <tr> 
                <td colspan="2"> <table width="100%" border="0" cellpadding="5" cellspacing="0"> 
                    <? $main_cat = WebContent::getMainCategory();?> 
                    <? $d = 1;?> 
                    <? for($z=0;$z<count($main_cat);$z++) {?> 
                    <tr class="cursor"> 
                      <? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);
										if ($d-1 == 0)
											$line[$d-1] = floor(strlen($main_cat[$z])/22) * 16;
										else
											$line[$d-1] = $line[$d-2] + floor(strlen($main_cat[$z])/22) * 16;?> 
                      <td id="cat<?=$z?>" class="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?>active<? } else {?>inactive<? }?>" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');" bgcolor="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?><?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_1")?><? } else {?><?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?><? }?>" width="120" <? if (!isset($Category) || (isset($Category) && $Category != $main_cat[$z])) {?>onMouseOver="changeBGColor('cat<?=$z?>','over');<? if (count($sub_cat_1) > 0) {?>setVisibility('<?=$main_cat[$z]?>','visible',<?=($d*26)?>,<?=(($d-2)!=-1)?$line[$d-2]:0?>);<? } else {?>setVisibility('','hidden',<?=$d*26?>,0);<? }?>" onMouseOut="changeBGColor('cat<?=$z?>','inactive');"<? } else {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('<?=$main_cat[$z]?>','visible',<?=$d*26?>,<?=(($d-2)!=-1)?$line[$d-2]:0?>);<? } else {?>setVisibility('','hidden',<?=$d*26?>,0);<? }?>"<? }?>><font color="<?=WebContent::getPropertyValue("outlook_2_menu_font_color")?>" size="-1"><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                        <?=$main_cat[$z]?> 
                        </a></font></td> 
                    </tr> 
                    <? $d++;?> 
                    <? }?> 
                  </table></td> 
              </tr> 
              <tr onMouseOver="setVisibility('','hidden',0,0);"> 
                <td width="5"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_bleft.gif<? } else {?>tab_corner_bleft_bl.gif<? }?>" width="5" height="5"></td> 
                <td></td> 
              </tr> 
            </table> 
             <? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
             <p align="left"><a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a></p> 
             <? }?> </td> 
        </tr> 
       </table></td> 
     <td width="90%" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
         <tr> 
          <td height="1" bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_1_color")?>"></td> 
        </tr> 
         <tr bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_1_color")?>"> 
          <td> <table width="100%" cellpadding="0"> 
              <tr> 
                <td align="right"><? include (_TEMPLATEPATH . "outlook_2/components/top_link.php");?> </td> 
              </tr> 
            </table></td> 
        </tr> 
         <tr> 
          <td bgcolor="<?=WebContent::getPropertyValue("outlook_2_bar_2_color")?>"> <table border="0" cellspacing="0" cellpadding="3"> 
              <tr> 
                <td> <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
                  <font color="#FFFFFF" size="-1">Welcome Back <strong> 
                  <?=$user->getFirstName()?> 
                  !</strong></font> 
                  <? } else {?> 
&nbsp; 
                  <? }?> </td> 
              </tr> 
            </table></td> 
        </tr> 
         <tr> 
          <td valign="top" height="300"> <table width="100%" cellpadding="5"> 
              <tr> 
                <td width="1"></td> 
                <td onMouseOver="setVisibility('','hidden',0,0);"> <? include (_TEMPLATEPATH . "outlook_2/components/body_content.php");?> </td> 
              </tr> 
            </table></td> 
        </tr> 
         <tr> 
          <td align="center"> <? include (_TEMPLATEPATH . "outlook_2/components/bottom_link.php");?> </td> 
        </tr> 
       </table></td> 
   </tr> 
</table> 
</body></html>
