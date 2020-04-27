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
<? include (_TEMPLATEPATH . "classic_3/components/javascript.php");?>
<? include (_TEMPLATEPATH . "classic_3/components/css.php");?>
<? include (_TEMPLATEPATH . "classic_3/components/body_tag.php");?>
<? if(WebContent::getPropertyValue("logo_img_src") != "") {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
     <td> <table border="0" cellspacing="0" cellpadding="10"> 
         <tr> 
          <td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" id="logo"></td> 
          <? if(WebContent::getPropertyValue("show_logo_img_txt") == "yes") {?> 
          <td><font size="+1"><strong> 
            <?=WebContent::getPropertyValue("logo_img_text")?> 
            </strong></font></td> 
          <? }?> 
        </tr> 
       </table></td> 
     <td align="right" valign="top">&nbsp; </td> 
   </tr> 
</table> 
<? } else {?> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td> <table border="0" cellspacing="0" cellpadding="10"> 
        <tr> 
          <td><font size="+1"><strong> 
            <?=WebContent::getPropertyValue("logo_img_text")?> 
            </strong></font></td> 
        </tr> 
      </table></td> 
    <td align="right" valign="top">&nbsp; </td> 
  </tr> 
</table> 
<? }?> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <? $main_cat = WebContent::getMainCategory();
	if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
		$Category = $main_cat[0];
	$r = floor(count($main_cat)/6) + 1;
	$firsttime = true;
	$init_value = 0;
	if ($r > 1)
		$num_tabs = count($main_cat)%6;
	else
		$num_tabs = count($main_cat);
	?> 
  <? for($n=0;$n<$r;$n++) {?> 
  <tr> 
    <td> <table border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <? if ($firsttime && WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
          <td> <table border="0" cellpadding="0" cellspacing="0" bgcolor="<? if ($Page == "Home" && isset($Category) && ($Category == "ALL" || $Category == "Home")) {?><?=WebContent::getPropertyValue("classic_3_tab_active_color")?><? } else {?><?=WebContent::getPropertyValue("classic_3_tab_inactive_color")?><? }?>"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="4" height="4"></td> 
                <td></td> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/corner_top_right.gif" width="4" height="4"></td> 
                <td bgcolor="#FFFFFF"></td> 
                <td bgcolor="#FFFFFF"></td> 
              </tr> 
              <tr> 
                <td></td> 
                <td onClick="openURL('mystore.php?Page=Home&Category=ALL');"><div class="cursor"><strong> 
                    <div class="tabfont"><a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a></div> 
                    </strong></div></td> 
                <td></td> 
                <td bgcolor="#FFFFFF"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="22"></td> 
                <td bgcolor="#FFFFFF"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="22"></td> 
              </tr> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="2"></td> 
                <td></td> 
                <td></td> 
                <td bgcolor="#FFFFFF"></td> 
                <td bgcolor="#FFFFFF"></td> 
              </tr> 
            </table></td> 
          <? $firsttime = false;?> 
          <? }?> 
          <? for($z=$init_value;$z<$num_tabs;$z++) {?> 
          <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
          <td><table border="0" cellpadding="0" cellspacing="0" bgcolor="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?><?=WebContent::getPropertyValue("classic_3_tab_active_color")?><? } else {?><?=WebContent::getPropertyValue("classic_3_tab_inactive_color")?><? }?>"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="4" height="4"></td> 
                <td></td> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/corner_top_right.gif"></td> 
                <td bgcolor="#FFFFFF"></td> 
                <td bgcolor="#FFFFFF"></td> 
              </tr> 
              <tr> 
                <td></td> 
                <td nowrap onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');"><div class="cursor"><strong> 
                    <div class="tabfont"><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                      <?=$main_cat[$z]?> 
                      </a></div> 
                    </strong></div></td> 
                <td></td> 
                <td bgcolor="#FFFFFF"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="22"></td> 
                <td bgcolor="#FFFFFF"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="22"></td> 
              </tr> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="2"></td> 
                <td></td> 
                <td></td> 
                <td bgcolor="#FFFFFF"></td> 
                <td bgcolor="#FFFFFF"></td> 
              </tr> 
            </table></td> 
          <? }?> 
          <? }?> 
        </tr> 
      </table></td> 
    <? if ($num_tabs == count($main_cat)) {?> 
    <td colspan="2" align="right"> <table border="0" cellspacing="0" cellpadding="3"> 
        <tr> 
          <? if (array_search("Shopping Cart",$comp) > -1) {?> 
          <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("classic_3_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/icon_shopping_cart.gif" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a> 
            <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
            - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
            <? }?> 
            </font></strong></td> 
          <td nowrap>&nbsp;</td> 
          <? }?> 
          <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
          <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("classic_3_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/icon_wish_list.gif" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap> <strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish List</a></font></strong> </td> 
          <td nowrap>&nbsp;</td> 
          <? }?> 
          <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
          <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("classic_3_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/icon_account.gif" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=Account">Account</a></font></strong></td> 
          <td nowrap>&nbsp;</td> 
          <? if (isset($user)) {?> 
          <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("classic_3_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/icon_sign_in.gif" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a></font></strong></td> 
          <? } else {?> 
          <td nowrap> <table bgcolor="<?=WebContent::getPropertyValue("classic_3_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td><img src="<?=(_URLPATH . "themes/classic_3/")?>images/icon_sign_in.gif" width="16" height="12"></td> 
              </tr> 
            </table></td> 
          <td nowrap><strong><font size="-1"><a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a></font></strong></td> 
          <? }?> 
          <? }?> 
        </tr> 
      </table></td> 
    <? }?> 
    <? $init_value = $num_tabs;
		if (($num_tabs + 6) < count($main_cat))
			$num_tabs = $num_tabs + 6;
		else
			$num_tabs = count($main_cat);
		?> 
  </tr> 
  <? }?> 
  <tr> 
    <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#999999"> 
        <tr> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="4" height="1"></td> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"></td> 
          <td align="right" bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/corner_top_right.gif"></td> 
        </tr> 
        <tr> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>">&nbsp;</td> 
          <td nowrap bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"> <? if (isset($Category) && $Category != "ALL") {
							$sub_cat_1 = WebContent::getSubCategory1($Category);?> 
            <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
            <? if ($sub_cat_1[$x] != "") {?> 
            <a href="mystore.php?Page=Home&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>" style="text-decoration:none"><font color="<?=WebContent::getPropertyValue("classic_3_tab_font_color")?>" size="-1"> 
            <?=$sub_cat_1[$x]?> 
            </a> 
            <? if ($x < count($sub_cat_1)-1) {?> 
            | 
            <? }?> 
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
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>">&nbsp;</td> 
        </tr> 
        <tr> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"></td> 
          <td align="center" bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/spacer.gif" width="1" height="3" ></td> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"></td> 
        </tr> 
        <tr> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"></td> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"></td> 
          <td bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_1_color")?>"></td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_2_color")?>"> 
    <td colspan="3" align="right"> <table cellpadding="5"> 
        <tr> 
          <td><? include (_TEMPLATEPATH . "classic_3/components/top_link.php");?></td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr bgcolor="<?=WebContent::getPropertyValue("classic_3_bar_2_color")?>"> 
    <td valign="top" width="30%"><table border="0" cellspacing="0" cellpadding="6"> 
        <tr> 
          <td nowrap><form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm"> 
              <font size="-1"><strong>Search:</strong></font> 
              <select name="Category" id="Category"> 
                <? $main_cat = WebContent::getMainCategory();?> 
                <option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All Products</option> 
                <? for($z=0;$z<count($main_cat);$z++) {?> 
                <option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>> 
                <?=$main_cat[$z]?> 
                </option> 
                <? }?> 
              </select> 
              <input name="Keyword" type="text" id="Keyword"> 
              <input name="SearchButton" type="submit" id="SearchButton3" value="Go"> 
            </form></td> 
        </tr> 
      </table></td> 
    <td align="center" width="40%" valign="middle"> <table border="0" cellspacing="0" cellpadding="6"> 
        <tr> 
          <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
          <td><font size="-1">Welcome back <strong> 
            <?=$user->getFirstName()?> 
            !</strong></font></td> 
          <? }?> 
          <td>&nbsp;&nbsp;</td> 
        </tr> 
      </table></td> 
    <td width="30%" align="right" valign="top" nowrap><table border="0" cellspacing="0" cellpadding="6"> 
        <tr> 
          <td><? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
            <a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/classic_3/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a> 
            <? }?></td> 
          <td>&nbsp;&nbsp;</td> 
        </tr> 
      </table></td> 
  </tr> 
</table> 
<br> 
<? include (_TEMPLATEPATH . "classic_3/components/body_content.php");?> 
<br> 
<? include (_TEMPLATEPATH . "classic_3/components/bottom_link.php");?> 
</body>
</html>
