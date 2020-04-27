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
<? include (_TEMPLATEPATH . "classic/components/javascript.php");?>
<? include (_TEMPLATEPATH . "classic/components/css.php");?>
</head>
<? include (_TEMPLATEPATH . "classic/components/body_tag.php");?>
 <a name="top"></a> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td width="60%" height="80"><table width="100%"> 
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
      </table></td> 
    <td width="40%" align="right" valign="top"> <table border="0" cellspacing="0" cellpadding="3"> 
        <tr> 
          <? if (array_search("Shopping Cart",$comp) > -1) {?> 
          <td nowrap><table bgcolor="<? if (WebContent::getPropertyValue("classic_icon_color") != "") {?><?=WebContent::getPropertyValue("classic_icon_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Icon Color")?><? }?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_shopping_cart.gif<? } else {?>icon_shopping_cart_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"> <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a> 
            <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
            - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
            <? }?> 
            </font></strong></td> 
          <td nowrap>&nbsp;&nbsp;</td> 
          <? }?> 
          <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
          <td nowrap><table bgcolor="<? if (WebContent::getPropertyValue("classic_icon_color") != "") {?><?=WebContent::getPropertyValue("classic_icon_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Icon Color")?><? }?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_wish_list.gif<? } else {?>icon_wish_list_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish List</a></font></strong></td> 
          <td nowrap>&nbsp;&nbsp;</td> 
          <? }?> 
          <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
          <td nowrap><table bgcolor="<? if (WebContent::getPropertyValue("classic_icon_color") != "") {?><?=WebContent::getPropertyValue("classic_icon_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Icon Color")?><? }?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_account.gif<? } else {?>icon_account_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=Account">Account</a></font></strong></td> 
          <td nowrap>&nbsp;&nbsp;</td> 
          <? if (isset($user)) {?> 
          <td nowrap><table bgcolor="<? if (WebContent::getPropertyValue("classic_icon_color") != "") {?><?=WebContent::getPropertyValue("classic_icon_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Icon Color")?><? }?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_sign_in.gif<? } else {?>icon_sign_in_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a></font></strong></td> 
          <? } else {?> 
          <td nowrap><table bgcolor="<? if (WebContent::getPropertyValue("classic_icon_color") != "") {?><?=WebContent::getPropertyValue("classic_icon_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Icon Color")?><? }?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>icon_sign_in.gif<? } else {?>icon_sign_in_bl.gif<? }?>" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a></font></strong></td> 
          <? }?> 
          <? }?> 
        </tr> 
      </table></td> 
  </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td align="center"> <? $main_cat = WebContent::getMainCategory();
	if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
		$Category = $main_cat[0];
		$r = floor(count($main_cat)/9) + 1;
		$firsttime = true;
		$init_value = 0;
		if ($r > 1)
			$num_tabs = count($main_cat)%9;
		else
			$num_tabs = count($main_cat);
		?> 
      <? for($n=0;$n<$r;$n++) {?> 
      <table border="0" cellpadding="0" cellspacing="0"> 
        <tr> 
          <? if ($firsttime && WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
          <td id="ALL" class="<? if ($Page == "Home" && (isset($Category) && ($Category == "ALL" || $Category == "Home")) || !isset($Category)) {?>active<? } else {?>inactive<? }?>" onClick="openURL('mystore.php?Page=Home&Category=ALL');" <? if (!isset($Category) || (isset($Category) && $Category != "ALL" && $Category != "Home")) {?>onMouseOver="changeBGColor('ALL','over');" onMouseOut="changeBGColor('ALL','inactive');"<? }?>> <div class="cursor"> 
              <table border="0" cellpadding="5"> 
                <tr> 
                  <td> <div class= "tabfont"><b><a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a></b></div></td> 
                </tr> 
              </table> 
            </div></td> 
          <td width="1"></td> 
          <? $firsttime = false;?> 
          <? }?> 
          <? for($z=$init_value;$z<$num_tabs;$z++) {?> 
          <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
          <td id="cat<?=$z?>" class="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?>active<? } else {?>inactive<? }?>" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');" <? if (!isset($Category) || (isset($Category) && $Category != $main_cat[$z])) {?>onMouseOver="changeBGColor('cat<?=$z?>','over');" onMouseOut="changeBGColor('cat<?=$z?>','inactive');"<? }?>> <div class="cursor"> 
              <table border="0" cellpadding="5"> 
                <tr> 
                  <td nowrap> <b> 
                    <div class="tabfont"><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                      <?=$main_cat[$z]?> 
                      </a></div> 
                    </b> </td> 
                </tr> 
              </table> 
            </div></td> 
          <td width="1"><img src="<?=(_URLPATH . "themes/classic/")?>images/spacer.gif"></td> 
          <? }?> 
          <? }?> 
          <? $init_value = $num_tabs;
				if (($num_tabs + 9) < count($main_cat))
					$num_tabs = $num_tabs + 9;
				else
					$num_tabs = count($main_cat);
				?> 
        </tr> 
        <? }?> 
      </table></td> 
  </tr> 
  <tr bgcolor="<? if ($theme->getProperty("classic_bar_1_color") != "") {?><?=$theme->getProperty("classic_bar_1_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Bar 1 Color")?><? }?>"> 
    <td align="center" bgcolor="<? if ($theme->getProperty("classic_bar_1_color") != "") {?><?=$theme->getProperty("classic_bar_1_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Bar 1 Color")?><? }?>"> <table border="0" cellpadding="8" cellspacing="0"> 
        <tr> 
          <td height="30"> <? if (isset($Category) && $Category != "ALL") {?> 
            <? $sub_cat_1 = WebContent::getSubCategory1($Category);?> 
            <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
            <? if ($sub_cat_1[$x] != "") {?> 
            <font color="<?=WebContent::getPropertyValue("classic_tab_font_Color")?>"> <a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"><font color="<?=WebContent::getPropertyValue("classic_tab_font_Color")?>"> 
            <?=$sub_cat_1[$x]?> 
            </a> 
            <? if ($x <count($sub_cat_1)-1) {?> 
            | 
            <? }?> 
            </font> 
            <? }?> 
            <? }?> 
            <? } else {
						$sub_cat_1 = WebContent::getSubCategory1("Home");?> 
            <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
            <? if ($sub_cat_1[$x] != "") {?> 
            <a href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>" style="text-decoration:none"><font color="<?=WebContent::getPropertyValue("classic_3_tab_font_color")?>" size="-1"> 
            <?=$sub_cat_1[$x]?> 
            </a> 
            <? if ($x < count($sub_cat_1)-1) {?> 
            | 
            <? }?> 
            <? }?> 
            <? }?> 
            <? }?> </td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr bgcolor="<? if ($theme->getProperty("classic_bar_2_color") != "") {?><?=$theme->getProperty("classic_bar_2_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Bar 2 Color")?><? }?>"> 
    <td align="center"> <table cellpadding="5"> 
        <tr> 
          <td><? include (_TEMPLATEPATH . "classic/components/top_link.php");?></td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr bgcolor="<? if ($theme->getProperty("classic_bar_2_color") != "") {?><?=$theme->getProperty("classic_bar_2_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Bar 2 Color")?><? }?>"> 
    <td nowrap height="25"> <? include(_COMPONENTPATH . "search.php");?> </td> 
  </tr> 
  <tr> 
    <td valign="top" height="300"><? include (_TEMPLATEPATH . "classic/components/body_content.php");?></td> 
  </tr> 
  <tr bgcolor="<? if ($theme->getProperty("classic_bar_3_color") != "") {?><?=$theme->getProperty("classic_bar_3_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Bar 3 Color")?><? }?>"> 
    <td align="center" height="30"><? include (_TEMPLATEPATH . "classic/components/bottom_link.php");?></td> 
  </tr> 
</table> 
<? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
<p align="left"><a href="http://www.suryadisoft.net"><img src="<?=_URLPATH?>components/images/poweredby_logo.gif" border=0></a></p> 
<? }?> 
<p align="right">[<a href="#top">Top Page</a>]</p> 
</body></html>
