<html>
<head>
<title><? if(WebContent::getPropertyValue("site_title") != "") {?><?=WebContent::getPropertyValue("site_title")?><? } else {?><?=$adminuser->getCompanyName()?><? }?></title>
<meta name="keywords" content="<? if(WebContent::getPropertyValue("keywords") != "") {?><?=WebContent::getPropertyValue("keywords")?><? }?>">
<meta name="description" content="<? if(WebContent::getPropertyValue("description") != "") {?><?=WebContent::getPropertyValue("description")?><? }?>">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if (WebContent::getPropertyValue("other_meta_tags") != "") {?><?=WebContent::getPropertyValue("other_meta_tags")?><? }?>
<? if (WebContent::getPropertyValue("bg_sound_src") != "") {?><bgsound src="<?=WebContent::getPropertyValue("bg_sound_src")?>" loop="true"><? }?>
<? if (WebContent::getPropertyValue("css_file") != "") {?><link rel="stylesheet" type="text/css" href="<?=WebContent::getPropertyValue("css_file")?>"><? }?>
<? include (_TEMPLATEPATH . "techno/components/javascript.php");?>
</head>
<? include (_TEMPLATEPATH . "techno/components/css.php");?>
<? include (_TEMPLATEPATH . "techno/components/body_tag.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr> 
<td><table border="0" cellspacing="0" cellpadding="5">
	<tr> 
	  <? if(WebContent::getPropertyValue("logo_img_src") != "") {?><td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" id="logo"></td><? if(WebContent::getPropertyValue("show_logo_img_txt") == "yes") {?><td><font size="+1"><strong><?=WebContent::getPropertyValue("logo_img_text")?></strong></font></td><? }?><? } else {?><td><font size="+1"><strong><?=WebContent::getPropertyValue("logo_img_text")?></strong></font></td><? }?>
	</tr>
  </table></td>

<td align="right" valign="top"> <table border="0" cellspacing="0" cellpadding="3">
	<tr>
	  <td><table border="0" cellspacing="0" cellpadding="3">
	<tr valign="top"> 
				<? if (array_search("Shopping Cart",$comp) > -1) {?>
	  <td>
					<table bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>"><img src="<?=(_URLPATH . "themes/techno/")?>images/icon_shopping_cart.gif" width="16" height="12"></td>
		  </tr>
			  </table></td>
			<td nowrap> 
			  <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping 
			  Cart</a><? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a><? }?> 				
				</td>
	  <td>&nbsp;</td>
				<? }?>
				<? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?>
	  <td>
					<table bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>"><img src="<?=(_URLPATH . "themes/techno/")?>images/icon_wish_list.gif" width="16" height="12"></td>
		  </tr>
			  </table></td>
			<td nowrap><a class="InstantLink" href="mystore.php?Page=WishList&Action=View">Wish 
			  List</a></td>
	  <td>&nbsp;</td>
				<? }?>
				<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?>
	  <td>
					<table bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>"><img src="<?=(_URLPATH . "themes/techno/")?>images/icon_account.gif" width="16" height="12"></td>
		  </tr>
			  </table></td>
			<td nowrap><a class="InstantLink" href="mystore.php?Page=Account">Account</a></td>
	  <td>&nbsp;</td>
	  <td><table bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td bgcolor="<?=WebContent::getPropertyValue("techno_icon_color")?>"><img src="<?=(_URLPATH . "themes/techno/")?>images/icon_sign_in.gif" width="16" height="12"></td>
		  </tr>
		</table></td>
			<td nowrap>
					<? if (isset($user)) {?>
			  <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a> 
					<? } else {?>
			  <a class="InstantLink" href="mystore.php?Page=SignIn">Sign In</a> 
					<? }?>
				</td>
			<td nowrap>&nbsp; </td>
				<? }?>
		  </tr>
		</table></td>
	</tr>
  </table>
	</td>
</tr>
<tr> 
<td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="4">
			<? $main_cat = WebContent::getMainCategory();
			if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
				$Category = $main_cat[0];
			$r = floor(count($main_cat)/10) + 1;
			$firsttime = true;
			$init_value = 0;
			if ($r > 1)
				$num_tabs = count($main_cat)%10;
			else
				$num_tabs = count($main_cat);
			?>
			<? for($n=0;$n<$r;$n++) {?>
	<tr> 
	  <td align="center" valign="bottom">
					<? if ($firsttime && WebContent::getPropertyValue("HomeRemoved") != "yes") {?>
					<b><a class="InstantLink" href="mystore.php?Page=Home&Category=ALL"><? if (isset($Category) && ($Category == "ALL" || $Category == "Home")) {?><font color="<?=WebContent::getPropertyValue("techno_icon_color")?>"><? }?>Home<? if (isset($Category) && ($Category == "ALL" || $Category == "Home")) {?></font><? }?></a></b> 
		<? }?>
					<? for($z=$init_value;$z<$num_tabs;$z++) {?>
						<? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?>
						<? if (($firsttime && WebContent::getPropertyValue("HomeRemoved") != "yes") || $z != $init_value) {?>|<? $firsttime = false;?><? }?> <b><a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"><? if (isset($Category) && $Category == urldecode($main_cat[$z])) {?><font color="<?=WebContent::getPropertyValue("techno_icon_color")?>"><? }?><?=$main_cat[$z]?><? if (isset($Category) && $Category == urldecode($main_cat[$z])) {?></font><? }?></a></b>
						<? }?>
					<? }?>
					<? $init_value = $num_tabs;
					if (($num_tabs + 10) < count($main_cat))
						$num_tabs = $num_tabs + 10;
					else
						$num_tabs = count($main_cat);
					?>
				</td>
	</tr>
			<? }?>
  </table></td>
</tr>
<tr align="center"> 
<td background="<?=(_URLPATH . "themes/techno/")?>images/<?=WebContent::getPropertyValue("techno_bar_1_color")?>" height="26" colspan="2">
		<?php
		if (isset($Category) && $Category != "ALL") {
			$sub_cat_1 = WebContent::getSubCategory1($Category);?>
			<center>
				<? for($x=0;$x<count($sub_cat_1);$x++) {?>
				<? if ($sub_cat_1[$x] != "") {?>
				<a href="mystore.php?Page=Home&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"><font color="#000000" style="text-decoration:none"><?=$sub_cat_1[$x]?></font></a> <? if ($x<count($sub_cat_1)-1) {?>|<? }?>
				<? }?>
				<? }?>
			</center>
		<? } else if (WebContent::getPropertyValue("HomeRemoved") != "yes") {
	$sub_cat_1 = WebContent::getSubCategory1("Home");?>
			<? for($x=0;$x<count($sub_cat_1);$x++) {?>								
			<? if ($sub_cat_1[$x] != "") {?>
			<a href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>" style="text-decoration:none"><font color="#000000" style="text-decoration:none"><?=$sub_cat_1[$x]?></a> <? if ($x < count($sub_cat_1)-1) {?>|<? }?>
			<? }?>	
			<? }?>
		<? }?>
	</td>
</tr>
<tr>
	<td align="center" colspan="2" height="26" background="<?=(_URLPATH . "themes/techno/")?>images/<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
	<? include (_TEMPLATEPATH . "techno/components/top_link.php");?>
	</td>
</tr>
<? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?>
<tr>
	<td colspan="2" align="right">
	<b><font size="-1">Welcome Back <?=$user->getFirstName()?>!</font></b>
	</td>
</tr>
<? }?>
<tr align="center"> 
<td valign="top" colspan="2" height="300">
<? include (_TEMPLATEPATH . "techno/components/body_content.php");?>
	</td>
</tr>
</table>
<p>
<? include (_TEMPLATEPATH . "techno/components/bottom_link.php");?>
<? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?>
<p align="left"><a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/techno/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a></p>
<? }?>
</body>
</html>