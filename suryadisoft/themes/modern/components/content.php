<HTML>
<HEAD>
<TITLE>
<? if(WebContent::getPropertyValue("site_title") != "") {?>
<?=WebContent::getPropertyValue("site_title")?>
<? } else {?>
<?=$adminuser->getCompanyName()?>
<? }?>
</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
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
<? include (_TEMPLATEPATH . "modern/components/layer.php");?>
<? include (_TEMPLATEPATH . "modern/components/javascript.php");?>
</HEAD>
<? include (_TEMPLATEPATH . "modern/components/css.php");?>
<? include (_TEMPLATEPATH . "modern/components/body_tag.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <? if (count($links)) {?> 
  <tr align="center" bgcolor="<?=WebContent::getPropertyValue("modern_bar_1_color")?>"> 
     <td height="30" colspan="4"><? include (_TEMPLATEPATH . "modern/components/top_link.php");?></td> 
   </tr> 
  <? }?> 
  <? if(WebContent::getPropertyValue("logo_img_src") != "") {?> 
  <tr> 
     <td colspan="4">&nbsp;</td> 
   </tr> 
  <tr> 
     <td colspan="4"><table> 
         <tr> 
          <td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" height="<?=WebContent::getPropertyValue("modern_logo_height")?>" id="logo"></td> 
          <? if(WebContent::getPropertyValue("show_logo_img_txt") == "yes") {?> 
          <td><font size="+1"><strong> 
            <?=WebContent::getPropertyValue("logo_img_text")?> 
            </strong></font></td> 
          <? }?> 
        </tr> 
       </table></td> 
   </tr> 
  <? } else {?> 
  <tr> 
     <td colspan="4">&nbsp;</td> 
   </tr> 
  <tr> 
     <td colspan="4"><font size="+1"><strong> 
      <?=WebContent::getPropertyValue("logo_img_text")?> 
      </strong></font></td> 
   </tr> 
  <? }?> 
  <tr> 
     <td width="69%" valign="bottom" background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_02.gif">&nbsp;</td> 
     <td width="2%" valign="bottom"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_03.gif" width="22" height="50"></td> 
     <td width="29%" valign="bottom" background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_04.gif"> <font  size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
       <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
       <font color="#FFFFFF" size="-1">Welcome Back <strong> 
       <?=$user->getFirstName()?> 
       !</strong></font> 
       <? }?> 
       </font> </td> 
   </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_09_bg.gif"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_07.gif" width="187" height="96"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_08.gif" width="295" height="96"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_09.gif" width="201" height="96"></td> 
  </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td align="right" height="30" background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_10.gif"> <? if (array_search("Shopping Cart",$comp) > -1) {?> 
      <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a> 
      <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
      - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a> 
      <? }?> 
      <? }?> 
      <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
&nbsp;| <a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish List</a> 
      <? }?> 
      <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
&nbsp;| <a class="InstantLink" href="mystore.php?Page=Account">Your Account</a> 
      <? if (isset($user)) {?> 
&nbsp;| <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a> 
      <? } else {?> 
&nbsp;| <a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a> 
      <? }?> 
      <? }?> 
&nbsp;&nbsp; </td> 
  </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td colspan="2" background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_17_bg.gif"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_16.gif" width="144" height="43"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_17.gif" width="130" height="43"></td> 
    <td width="6%" rowspan="2" align="left" valign="top" nowrap background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_19.gif"><table width="20" border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_18.gif" width="63" height="43"></td> 
        </tr> 
        <tr> 
          <td><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_24.gif" width="63" height="38"></td> 
        </tr> 
      </table></td> 
    <form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm"> 
      <td width="39%" rowspan="2" align="left" valign="top" nowrap background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_19.gif"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><br> 
        <font color="<?=WebContent::getPropertyValue("modern_menu_font_color")?>" size="-1">SEARCH</font></strong></font> 
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
  </tr> 
  <tr> 
    <td width="16%"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_21.gif" width="144" height="38"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_22.gif" width="43" height="38"></td> 
    <td width="39%" valign="bottom"> </td> 
  </tr> 
  <tr> 
    <td align="left" valign="top"> <table width="100" border="0" cellspacing="0" cellpadding="0"> 
        <tr onMouseOver="setVisibility('','hidden',0,0);"> 
          <td background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_32.gif"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_26.gif" width="187" height="12"></td> 
        </tr> 
        <tr> 
          <td valign="top" background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_32.gif"> <table width="166" cellpadding="5" cellspacing="3"> 
              <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
              <tr> 
                <? $sub_cat_1 = WebContent::getSubCategory1("Home");?> 
                <td id="ALL" class="<? if ($Page == "Home" && (isset($Category) && ($Category == "ALL" || $Category == "Home")) || !isset($Category)) {?>active<? } else {?>inactive<? }?>" onClick="openURL('mystore.php?Page=Home&Category=ALL');" <? if (!isset($Category) || (isset($Category) && $Category != "ALL" && $Category != "Home")) {?>onMouseOver="changeBGColor('ALL','over');<? if (count($sub_cat_1) > 0) {?>setVisibility('Home','visible',0,0);<? } else {?>setVisibility('','hidden',0,0);<? }?>" onMouseOut="changeBGColor('ALL','inactive');"<? } else {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('Home','visible',0,0);<? } else {?>setVisibility('','hidden',0,0);<? }?>"<? }?>> <div class="cursor"> <font color="<?=WebContent::getPropertyValue("modern_menu_font_color")?>"> <a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a> </font> </div></td> 
              </tr> 
              <? }?> 
              <? $main_cat = WebContent::getMainCategory();?> 
              <? $d = 1;?> 
              <? for($z=0;$z<count($main_cat);$z++) {?> 
              <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
              <tr> 
                <? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);
							if ($d-1 == 0)
								$line[$d-1] = floor(strlen($main_cat[$z])/22) * 16;
							else
								$line[$d-1] = $line[$d-2] + floor(strlen($main_cat[$z])/22) * 16;?> 
                <td id="cat<?=$z?>" class="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?>active<? } else {?>inactive<? }?>" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');" <? if (!isset($Category) || (isset($Category) && $Category != $main_cat[$z])) {?>onMouseOver="changeBGColor('cat<?=$z?>','over');<? if (count($sub_cat_1) > 0) {?>setVisibility('<?=addslashes($main_cat[$z])?>','visible',<?=(WebContent::getPropertyValue("HomeRemoved") == "yes")?($d-1)*29:($d*29)?>,<?=(($d-2)!=-1)?$line[$d-2]:0?>);<? } else {?>setVisibility('','hidden',<?=(WebContent::getPropertyValue("HomeRemoved") == "yes")?($d-1)*29:$d*29?>,0);<? }?>" onMouseOut="changeBGColor('cat<?=$z?>','inactive');"<? } else {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('<?=addslashes($main_cat[$z])?>','visible',<?=(WebContent::getPropertyValue("HomeRemoved") == "yes")?($d-1)*29:$d*29?>,<?=(($d-2)!=-1)?$line[$d-2]:0?>);<? } else {?>setVisibility('','hidden',<?=(WebContent::getPropertyValue("HomeRemoved") == "yes")?($d-1)*29:$d*29?>,0);<? }?>"<? }?>> <div class="cursor"> <font color="<?=WebContent::getPropertyValue("modern_menu_font_color")?>"> <a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
                    <?=$main_cat[$z]?> 
                    </a> </font> </div></td> 
              </tr> 
              <? $d++;?> 
              <? }?> 
              <? }?> 
            </table></td> 
        </tr> 
        <tr onMouseOver="setVisibility('','hidden',0,0);"> 
          <td background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_32.gif"><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_34.gif" width="187" height="20"></td> 
        </tr> 
      </table></td> 
    <td colspan="3" align="left" valign="top" height="300" onMouseOver="setVisibility('','hidden',0,0);"> <? include (_TEMPLATEPATH . "modern/components/body_content.php");?> </td> 
  </tr> 
  <tr> 
    <td colspan="4" background="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_39.gif"> <? include (_TEMPLATEPATH . "modern/components/bottom_link.php");?> </td> 
  </tr> 
  <tr> 
    <td bgcolor="<?=WebContent::getPropertyValue("modern_bar_1_color")?>"> <? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
      <table cellspacing="0" cellpadding="10"> 
        <tr> 
          <td> <a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/modern/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a> 
            </p> </td> 
        </tr> 
      </table> 
      <? }?> </td> 
    <td colspan="3" bgcolor="<?=WebContent::getPropertyValue("modern_bar_1_color")?>">&nbsp;</td> 
  </tr> 
</table> 
</BODY>
</HTML>
