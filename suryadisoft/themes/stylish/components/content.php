<HTML>
<HEAD>
<TITLE>
<? if(WebContent::getPropertyValue("site_title") != "") {?>
<?=WebContent::getPropertyValue("site_title")?>
<? } else {?>
<?=$adminuser->getCompanyName()?>
<? }?>
</TITLE>
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
<? include (_TEMPLATEPATH . "stylish/components/javascript.php");?>
</head>
<? include (_TEMPLATEPATH . "stylish/components/css.php");?>
<? include (_TEMPLATEPATH . "stylish/components/layer.php");?>
<? include (_TEMPLATEPATH . "stylish/components/body_tag.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
     <td width="1%" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_02.gif"><IMG SRC="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_01.gif" WIDTH=7 HEIGHT=101 ALT=""></td> 
     <td <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?>width="79%"<? } else {?>width="89%" colspan="2"<? }?> nowrap background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_02.gif"> <table cellpadding="0" cellspacing="0"> 
         <tr> 
          <? if(WebContent::getPropertyValue("logo_img_src") != "") {?> 
          <td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" height="100" name="logo" border="0" id="logo"></td> 
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
     <td width="14%" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_02.gif"><br> 
      <table cellpadding="5"> 
         <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
         <tr> 
          <td nowrap><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>"><strong>Check Out</strong></a></td> 
        </tr> 
         <? }?> 
         <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
         <tr> 
          <td nowrap> <a class="InstantLink" href="mystore.php?Page=WishList&Action=View"><strong>Wish List</strong></a> </td> 
        </tr> 
         <? }?> 
         <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
         <tr> 
          <td nowrap> <a class="InstantLink" href="mystore.php?Page=Account"><strong>Your Account</strong></a> </td> 
        </tr> 
         <? }?> 
       </table></td> 
     <td width="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?>20%<? } else {?>10%<? }?>" align="left" valign="top" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_02.gif"> <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
         <tr> 
          <td width="10" rowspan="2" bgcolor="#FFFFFF"><IMG SRC="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_04.gif" WIDTH=10 HEIGHT=101 ALT=""></td> 
          <td width="166" bgcolor="#FFFFFF"> <?php
						if (session_is_registered("shopping_cart")) {
							$cart = $HTTP_SESSION_VARS["shopping_cart"];
						} else {
							$cart = new ShoppingCart();
						}
						if (isset($HTTP_COOKIE_VARS["user"])) {
							$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
							$user_id = $user->getUserId();
						} else {
							$user_id = "";
						}
						?> 
             <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br> 
            <? if ($cart->getTotalQuantity($user_id) > 0) {?> 
            You have
            <?=$cart->getTotalQuantity($user_id)?> 
            item(s) in your shopping cart.
            <? } else {?> 
            You currently have no item(s) in your shopping cart.
            <? }?> 
            </font> </td> 
          <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
          <td width="10" rowspan="2" bgcolor="#FFFFFF"><IMG SRC="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_06.gif" WIDTH=10 HEIGHT=101 ALT=""></td> 
          <td width="166" bgcolor="#FFFFFF"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br> 
            Please click below to access your account.</font> </td> 
          <? }?> 
        </tr> 
         <tr> 
          <td width="166" height="61" valign="bottom" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/bg2.gif" bgcolor="#FFFFFF"> <? if (array_search("Shopping Cart",$comp) > -1) {?> 
             <a href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View"><img src="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/shoppingCart.gif" align="absbottom" width="166" height="56" border="0"></a> 
             <? }?> </td> 
          <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
          <td width="166" height="61" valign="bottom" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/bg2.gif" bgcolor="#FFFFFF"> <? if (isset($user)) {?> 
             <a href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut"><img src="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/logout.gif" align="absbottom" width="121" height="56" border="0"></a> 
             <? } else {?> 
             <a href="mystore.php?Page=SignIn"><img src="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/login.gif" align="absbottom" width="121" height="56" border="0"></a> 
             <? }?> </td> 
          <? }?> 
        </tr> 
       </table></td> 
   </tr> 
  <tr> 
     <td height="51" valign="top" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_19.gif"><IMG SRC="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_19.gif" WIDTH=10 HEIGHT=51 ALT=""></td> 
     <td height="51" colspan="2" align="center" valign="top" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_19.gif"> <? include (_TEMPLATEPATH . "stylish/components/top_link.php");?> </td> 
     <td height="51" align="left" valign="top" colspan="2"> <table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/bg1.gif"> 
         <form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm"> 
          <tr> 
             <td width="257" rowspan="2"><img src="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_25.gif" width=180 height=51 alt=""></td> 
             <td colspan="2"> <select name="Category" id="Category"> 
                 <? $main_cat = WebContent::getMainCategory();?> 
                 <option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All Products</option> 
                 <? for($z=0;$z<count($main_cat);$z++) {?> 
                 <option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>> 
                <?=$main_cat[$z]?> 
                </option> 
                 <? }?> 
               </select> </td> 
           </tr> 
          <tr> 
             <td width="144"> <input name="Keyword" type="text" id="Keyword"> </td> 
             <td width="26"> <div align="right"><a href="#" onClick="this.form.submit();"><img src="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_28.gif" alt="" width=25 height=27 border="0"></a></div></td> 
           </tr> 
        </form> 
       </table></td> 
   </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td width="1%" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_30.gif"><IMG SRC="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_29.gif" WIDTH=5 HEIGHT=59 ALT=""></td> 
    <td width="97%" valign="bottom" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_30.gif"> <div align="right" onMouseOver="setVisibility('','hidden',0,0);"> 
        <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
        <font color="#FFFFFF" size="-1"> Welcome Back <strong> 
        <?=$user->getFirstName()?> 
        !</strong> </font> 
        <? }?> 
      </div> 
      <br> 
      <table height="22" border="0" cellpadding="5" cellspacing="0"> 
        <tr> 
          <? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
          <? $sub_cat_1 = WebContent::getSubCategory1("Home");?> 
          <td align="center" valign="bottom" nowrap id="ALL" <? if (!isset($Category) || (isset($Category) && $Category != "ALL" && $Category != "Home")) {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('Home','visible',0,0);<? } else {?>setVisibility('','hidden',0,0);<? }?>"<? } else {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('Home','visible',0,0);<? } else {?>setVisibility('','hidden',0,0);<? }?>"<? }?>> <div class="cursor"> <font color="<?=WebContent::getPropertyValue("stylish_menu_font_color")?>"> 
              <? if (isset($Category) && $Category == "ALL") {?> 
              <font color="<?=WebContent::getPropertyValue("stylish_active_link_color")?>"><strong>Home</strong></font> 
              <? } else {?> 
              <a class="InstantLink" href="mystore.php?Page=Home&Category=ALL"><strong>Home</strong></a> 
              <? }?> 
              </font> </div></td> 
          <? }?> 
          <? $main_cat = WebContent::getMainCategory();?> 
          <? $d = 1;?> 
          <? for($z=0;$z<count($main_cat);$z++) {?> 
          <? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
          <? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);
			if ($d-1 == 0) {
				if (WebContent::getPropertyValue("HomeRemoved") == "yes")
					$line[$d-1] = (strlen($main_cat[$z]) * 9) + 3;
				else
					$line[$d-1] = 54 + (strlen($main_cat[$z]) * 9) + 3;
			} else
				$line[$d-1] = 	$line[$d-2] + (strlen($main_cat[$z]) * 9) + 3;?> 
          <td align="center" valign="bottom" nowrap id="cat<?=$z?>" <? if (!isset($Category) || (isset($Category) && $Category != $main_cat[$z])) {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('<?=$main_cat[$z]?>','visible',<?=(($d-2)!=-1)?$line[$d-2]:((WebContent::getPropertyValue("HomeRemoved") == "yes")?0:54)?>,0);<? } else {?>setVisibility('','hidden',0,0);<? }?>"<? } else {?>onMouseOver="<? if (count($sub_cat_1) > 0) {?>setVisibility('<?=$main_cat[$z]?>','visible',<?=(($d-2)!=-1)?$line[$d-2]:((WebContent::getPropertyValue("HomeRemoved") == "yes")?0:54)?>,0);<? } else {?>setVisibility('','hidden',0,0);<? }?>"<? }?>> <div class="cursor"> <font color="<?=WebContent::getPropertyValue("stylish_menu_font_color")?>"> 
              <? if (isset($Category) && $Category == $main_cat[$z]) {?> 
              <font color="<?=WebContent::getPropertyValue("stylish_active_link_color")?>"><strong> 
              <?=$main_cat[$z]?> 
              </strong></font> 
              <? } else {?> 
              <a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> <strong> 
              <?=$main_cat[$z]?> 
              </strong> </a> 
              <? }?> 
              </font> </div></td> 
          <? $d++;?> 
          <? }?> 
          <? }?> 
        </tr> 
      </table></td> 
    <td width="2%" background="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_30.gif"><div align="right"><IMG SRC="<?=_URLPATH?>themes/stylish/images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/index_32.gif" WIDTH=6 HEIGHT=59 ALT=""></div></td> 
  </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr onMouseOver="setVisibility('','hidden',0,0);"> 
    <td valign="top" height="300"> <? include (_TEMPLATEPATH . "stylish/components/body_content.php");?> </td> 
  </tr> 
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td align="center" bgcolor="<?=WebContent::getPropertyValue("stylish_bar_1_color")?>"> <table cellpadding="5"> 
        <tr> 
          <td align="center"> <? include (_TEMPLATEPATH . "stylish/components/bottom_link.php");?> </td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr> 
    <td bgcolor="<?=WebContent::getPropertyValue("stylish_bar_2_color")?>"> <table cellpadding="5"> 
        <tr> 
          <td> <? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
            <p align="left"><a href="http://www.suryadisoft.net"><img src="<?=_URLPATH?>themes/stylish/images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a></p> 
            <? }?> </td> 
        </tr> 
      </table></td> 
  </tr> 
</table> 
<p>&nbsp; </p> 
</BODY></HTML>
