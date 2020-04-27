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
<? include (_TEMPLATEPATH . "brushed_steel/components/javascript.php");?>
</head>
<? include (_TEMPLATEPATH . "brushed_steel/components/css.php");?>
<? include (_TEMPLATEPATH . "brushed_steel/components/body_tag.php");?>
 <table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
	 <td><table border="0" cellspacing="0" cellpadding="5"> 
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
	 <td align="right" valign="top"><table border="0" cellspacing="0" cellpadding="3"> 
		 <tr valign="top"> 
		  <? if (array_search("Shopping Cart",$comp) > -1) {?> 
		  <td> <table background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
			  <tr> 
				<td><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/icon_shopping_cart.gif" width="16" height="12"></td> 
			  </tr> 
			</table></td> 
		  <td> <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View"><b>Shopping Cart</b></a> 
			 <? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> 
			 - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>"><b>Check Out</b></a> 
			 <? }?> </td> 
		  <td>&nbsp;</td> 
		  <? }?> 
		  <? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?> 
		  <td><table background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
			  <tr> 
				<td><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/icon_wish_list.gif" width="16" height="12"></td> 
			  </tr> 
			</table></td> 
		  <td><a class="InstantLink" href="mystore.php?Page=WishList&Action=View"><b>Wish List</b></a></td> 
		  <td>&nbsp;</td> 
		  <? }?> 
		  <? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?> 
		  <td><table background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
			  <tr> 
				<td><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/icon_account.gif" width="16" height="12"></td> 
			  </tr> 
			</table></td> 
		  <td><a class="InstantLink" href="mystore.php?Page=Account"><b>Account</b></a></td> 
		  <td>&nbsp;</td> 
		  <td><table background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_icon_color")?>" border="0" cellspacing="0" cellpadding="0"> 
			  <tr> 
				<td><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/icon_sign_in.gif" width="16" height="12"></td> 
			  </tr> 
			</table></td> 
		  <td> <? if (isset($user)) {?> 
			 <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut"><b>Sign Out</b></a> 
			 <? } else {?> 
			 <a class="InstantLink" href="mystore.php?Page=SignIn"><b>Sign In</b></a> 
			 <? }?> </td> 
		  <? }?> 
		</tr> 
	   </table></td> 
   </tr> 
  <tr> 
	 <td colspan="2"> <table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
		 <? $main_cat = WebContent::getMainCategory();
				if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
					$Category = $main_cat[0];
				$r = floor(count($main_cat)/8) + 1;
				$firsttime = true;
				$init_value = 0;
				if ($r > 1)
					$num_tabs = count($main_cat)%8;
				else
					$num_tabs = count($main_cat);
				?> 
		 <? for($n=0;$n<$r;$n++) {?> 
		 <tr> 
		  <td valign="bottom"> <table border="0" cellspacing="0" cellpadding="0"> 
			  <tr> 
				<? if ($firsttime && WebContent::getPropertyValue("HomeRemoved") != "yes") {?> 
				<td onClick="openURL('mystore.php?Page=Home&Category=ALL');"> <div class="cursor"> 
					<table border="0" cellpadding="0" cellspacing="0" background="<? if ($Page == "Home" && isset($Category) && ($Category == "ALL" || $Category == "Home")) {?><?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_tab_active_color")?><? } else {?><?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_tab_inactive_color")?><? }?>"> 
					  <tr> 
						<td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td> 
						<td rowspan="2"><table border="0" cellspacing="0" cellpadding="5"> 
							<tr> 
							  <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_tab_font_color")?>"><b><a class="menulink" href="mystore.php?Page=Home&Category=ALL">Home</a></b></font></td> 
							</tr> 
						  </table></td> 
						<td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td> 
					  </tr> 
					  <tr> 
						<td></td> 
					  </tr> 
					</table> 
				  </div></td> 
				<? $firsttime = false;?> 
				<? }?> 
				<? for($z=$init_value;$z<$num_tabs;$z++) {?> 
				<? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?> 
				<td onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>');"> <div class="cursor"> 
					<table border="0" cellpadding="0" cellspacing="0" background="<? if ($Page == "Home" && isset($Category) && $Category == $main_cat[$z]) {?><?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_tab_active_color")?><? } else {?><?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_tab_inactive_color")?><? }?>"> 
					  <tr> 
						<td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td> 
						<td rowspan="2"><table border="0" cellspacing="0" cellpadding="5"> 
							<tr> 
							  <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_tab_font_color")?>"><b><a class="menulink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"> 
								<?=$main_cat[$z]?> 
								</a></b></font></td> 
							</tr> 
						  </table></td> 
						<td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td> 
					  </tr> 
					  <tr> 
						<td></td> 
					  </tr> 
					</table> 
				  </div></td> 
				<? }?> 
				<? }?> 
			  </tr> 
			</table></td> 
		  <? if ($num_tabs == count($main_cat)) {?> 
		  <td align="right" valign="bottom"> <? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?> 
			 <font size="-1">Welcome Back
			<?=$user->getFirstName()?> 
			!</font> 
			 <? } else {?> 
&nbsp; 
			 <? }?> </td> 
		  <? }?> 
		  <? $init_value = $num_tabs;
					if (($num_tabs + 8) < count($main_cat))
						$num_tabs = $num_tabs + 8;
					else
						$num_tabs = count($main_cat);
					?> 
		</tr> 
		 <? }?> 
		 <tr> 
		  <td colspan="2" bgcolor="<?=WebContent::getPropertyValue("brushed_steel_bar_1_color")?>"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/spacer.gif" width="1" height="2"></td> 
		</tr> 
	   </table></td> 
   </tr> 
  <tr> 
	 <td colspan="2" valign="top" height="300"><? include (_TEMPLATEPATH . "brushed_steel/components/body_content.php");?></td> 
   </tr> 
</table> 
<br> 
<center><? include (_TEMPLATEPATH . "brushed_steel/components/bottom_link.php");?></center> 
<p> 
  <? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?> 
  <a href="http://www.suryadisoft.net"><img align="left" src="<?=(_URLPATH . "themes/brushed_steel/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a> 
  </td> 
  <? }?> 
</body>
</html>
