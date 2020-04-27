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
<? include (_TEMPLATEPATH . "cool_3D/components/javascript.php");?>
<? include (_TEMPLATEPATH . "cool_3D/components/css.php");?>
<? include (_TEMPLATEPATH . "cool_3D/components/body_tag.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
     <td width="175"><table> 
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
     <td valign="top"><table width="98%" border="0" cellpadding="0" cellspacing="0"> 
         <tr> 
          <td width="9" valign="top"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-topbar_indent-corner.gif" width="9" height="9"></td> 
          <td width="9" bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"></td> 
          <td width="1033" bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"></td> 
          <td width="9" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-topbar_side-r.gif"></td> 
        </tr> 
         <tr> 
          <td width="9"></td> 
          <td width="9" bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"></td> 
          <td bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"> <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
              <tr> 
                <form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm"> 
                  <td valign="bottom" nowrap> <br> 
                    <font color="<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>" size="-1"><strong>Search...</strong></font><br> 
                    <input name="Keyword" type="text" id="Keyword" size="17"> 
                    <select name="Category" id="Category"> 
                      <? $main_cat = WebContent::getMainCategory();?> 
                      <option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All Products</option> 
                      <? for($z=0;$z<count($main_cat);$z++) {?> 
                      <option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>> 
                      <?=$main_cat[$z]?> 
                      </option> 
                      <? }?> 
                    </select> 
                    <input name="SearchButton" type="submit" id="SearchButton3" value="Go"> </td> 
                </form> 
                <td align="right" valign="bottom"> <table border="0" cellpadding="5" cellspacing="0"> 
                    <tr> 
                      <td align="right" colspan="8"> <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
                        <font color="<?=WebContent::getPropertyValue("cool_3D_icon_color")?>" size="-1">Welcome Back <strong> 
                        <?=$user->getFirstName()?> 
                        !</strong></font> 
                        <? } else {?> 
&nbsp; 
                        <? }?> </td> 
                    </tr> 
                    <tr> 
                      <? if (array_search("Shopping Cart",$comp) > -1) {?> 
                      <td><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/icon-shoppingcart.gif" width="16" height="12"></td> 
                      <td nowrap><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View"><font color="<?=WebContent::getPropertyValue("cool_3D_icon_color")?>">Shopping Cart</font></a> 
                        <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
                        - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
                        <? }?></td> 
                      <? }?> 
                      <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
                      <td><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/icon-wishlist.gif" width="16" height="12"></td> 
                      <td nowrap><a class="InstantLink" href="mystore.php?Page=WishList&Action=View"><font color="<?=WebContent::getPropertyValue("cool_3D_icon_color")?>">Wish List</font></a></td> 
                      <? }?> 
                      <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
                      <td><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/icon-account.gif" width="16" height="12"></td> 
                      <td nowrap><a class="InstantLink" href="mystore.php?Page=Account"><font color="<?=WebContent::getPropertyValue("cool_3D_icon_color")?>">Your Account</font></a></td> 
                      <td><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/icon-signin.gif" width="16" height="12"></td> 
                      <? if (isset($user)) {?> 
                      <td nowrap><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut"><font color="<?=WebContent::getPropertyValue("cool_3D_icon_color")?>">Sign Out</font></a></td> 
                      <? } else {?> 
                      <td nowrap><a class="InstantLink" href="mystore.php?Page=SignIn"><font color="<?=WebContent::getPropertyValue("cool_3D_icon_color")?>">Sign In</font></a></td> 
                      <? }?> 
                      <? }?> 
                    </tr> 
                  </table></td> 
              </tr> 
            </table></td> 
          <td width="9" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-topbar_side-r.gif"> </td> 
        </tr> 
         <tr> 
          <td width="9"></td> 
          <td width="9" valign="bottom"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-topbar_corner-bl.gif" width="9" height="9"></td> 
          <td background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-topbar_bottom.gif"></td> 
          <td width="9" valign="bottom"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-topbar_corner-br.gif" width="9" height="9"></td> 
        </tr> 
       </table></td> 
   </tr> 
  <tr> 
     <td>&nbsp;</td> 
     <td align="right"> <table cellpadding="5"> 
         <tr> 
          <td><? include (_TEMPLATEPATH . "cool_3D/components/top_link.php");?></td> 
          <td>&nbsp;</td> 
        </tr> 
       </table></td> 
   </tr> 
  <tr> 
     <td width="175" valign="top"> <br> 
      <br> 
      <table width="100%"  border="0" cellpadding="0" cellspacing="0"> 
         <tr> 
          <td background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-bracket_top.gif"></td> 
          <td width="13" bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-bracket_corner-tr.gif"></td> 
        </tr> 
         <tr> 
          <td width="161" bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"></td> 
          <td width="13" align="right" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-bracket_side-r.gif"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/spacer.gif" width="1" height="7"></td> 
        </tr> 
       </table> 
      <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_menu_bgcolor_1")?>" class="cursor" onClick="openURL('mystore.php?Page=Home&Category=ALL');"> 
         <tr> 
          <td background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_top.gif"></td> 
          <td width="13"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_corner-tr.gif" width="13" height="6"></td> 
        </tr> 
         <tr> 
          <td> <table border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td>&nbsp;&nbsp;</td> 
                <td><font color="<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>"><strong><a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a></strong></font></td> 
              </tr> 
            </table></td> 
          <td width="13" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_side-r.gif"></td> 
        </tr> 
         <tr> 
          <td background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_bottom.gif"></td> 
          <td width="13"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_corner-br.gif" width="13" height="5"></td> 
        </tr> 
       </table> 
      <? $sub_cat_1 = WebContent::getSubCategory1("Home");
			if ($Page == "Home" && isset($Category) && $Category =="ALL" && count($sub_cat_1) > 0) {?> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_menu_bgcolor_2")?>"> 
         <tr> 
          <td><table width="100%" border="0" cellpadding="8" cellspacing="0"> 
              <tr> 
                <td>&nbsp;</td> 
                <td> <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
                  <? if ($sub_cat_1[$x] != "") {?> 
                  <a class="InstantLink" href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"> 
                  <?=$sub_cat_1[$x]?> 
                  </a> 
                  <? if ($x < count($sub_cat_1)-1) {?> 
                  <br> 
                  <? }?> 
                  <? }?> 
                  <? }?> </td> 
              </tr> 
            </table></td> 
          <td width="13" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-subnav_side-r.gif"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/spacer.gif" height="0" width="13"></td> 
        </tr> 
       </table> 
      <? }?> 
      <? }?> 
      <? $main_cat = WebContent::getMainCategory();?> 
      <? if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
				$Category = $main_cat[0];?> 
      <? for($z=0;$z<count($main_cat);$z++) {?> 
      <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_menu_bgcolor_1")?>" class="cursor" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');"> 
         <tr> 
          <td background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_top.gif"></td> 
          <td width="13"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_corner-tr.gif" width="13" height="6"></td> 
        </tr> 
         <tr> 
          <td> <table border="0" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td>&nbsp;&nbsp;</td> 
                <td><font color="<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>"><strong><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                  <?=$main_cat[$z]?> 
                  </a></strong></font></td> 
              </tr> 
            </table></td> 
          <td width="13" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_side-r.gif"></td> 
        </tr> 
         <tr> 
          <td background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_bottom.gif"></td> 
          <td width="13"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-category_corner-br.gif" width="13" height="5"></td> 
        </tr> 
       </table> 
      <? if (isset($Category) && $Category == $main_cat[$z]) {
				$sub_cat_1 = WebContent::getSubCategory1($Category);?> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_menu_bgcolor_2")?>"> 
         <tr> 
          <td><table width="100%" border="0" cellpadding="8" cellspacing="0"> 
              <tr> 
                <td>&nbsp;</td> 
                <td> <? for($x=0;$x<count($sub_cat_1);$x++) {?> 
                  <? if ($sub_cat_1[$x] != "") {?> 
                  <a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"> 
                  <?=$sub_cat_1[$x]?> 
                  </a> 
                  <? if ($x < count($sub_cat_1)-1) {?> 
                  <br> 
                  <? }?> 
                  <? }?> 
                  <? }?> </td> 
              </tr> 
            </table></td> 
          <td width="13" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-subnav_side-r.gif"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/spacer.gif" height="0" width="13"></td> 
        </tr> 
       </table> 
      <? }?> 
      <? }?> 
      <? }?> 
      <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_bar_1_color")?>"> 
         <tr> 
          <td width="162"></td> 
          <td width="13" align="right" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-bracket_side-r.gif"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/spacer.gif" width="1" height="7
			"></td> 
        </tr> 
         <tr> 
          <td width="162" background="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-bracket_bottom.gif"></td> 
          <td width="13"><img src="<?=(_URLPATH . "themes/cool_3D/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/3d-bracket_corner-br.gif"></td> 
        </tr> 
       </table></td> 
     <td valign="top" height="300"> <br> 
      <? include (_TEMPLATEPATH . "cool_3D/components/body_content.php");?> </td> 
   </tr> 
</table> 
<? include (_TEMPLATEPATH . "cool_3D/components/bottom_link.php");?>
</body>
</html>
