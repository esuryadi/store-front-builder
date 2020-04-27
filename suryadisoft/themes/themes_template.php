<?php
/********************************************************************************
*                                                                               *
* Script Title: Themes Template                                                 *
*                                                                               *
* Description: This is a theme template that will be used for themes creation.  *
*              Please pay attention to the comments on this templates for       *
*              required components that shouldn't be removed. When develop      *
*              themes, please remove all the comments on this template, except  *
*              this header comments. Please use these header comments for any   *
*              new creation of themes.                                          *
*                                                                               *
* Author: Edward Suryadi                                                        *
*                                                                               *
* Date: July 16, 2002                                                           *
*                                                                               *
*********************************************************************************/

/****************************** Do not remove this part ****************************/
 
$payment = new Payment();
$theme = new Themes();
$adminuser = new Admin();
$adminuser->retrieveAdminInfo(_USER);
if (!isset($Page))
	$Page = "Home";

if ($adminuser->getStatus() == "Suspended") {
	print "<br><br>";
	print "<center><h2>Your account has been suspended!</h2></center>";
	print "<center><h2>Please contact the Administrator (<a href=\"mailto:webmaster@suryadisoft.net\">webmaster@suryadisoft.net</a>)</h2></center>";
} else if ($adminuser->getStatus() == "Inactive") {
	print "<br><br>";
	print "<center><h2>Your account is not active!</h2></center>";
	print "<center><h2>Please contact the Administrator (<a href=\"mailto:webmaster@suryadisoft.net\">webmaster@suryadisoft.net</a>)</h2></center>";
} else {
	if ($Page == "Home") {
		include(_COMPONENTPATH . "header/home_header.php");
	} else if ($Page == "ShoppingCart") {
		include(_COMPONENTPATH . "header/shopping_cart_header.php");
	} else if ($Page == "WishList") {
		include(_COMPONENTPATH . "header/wish_list_header.php");
	} else if ($Page == "FindWishList") {
		include(_COMPONENTPATH . "header/find_wish_list_header.php");
	} else if ($Page == "Account") {
		include(_COMPONENTPATH . "header/account_header.php");
	} else if ($Page == "SearchResult") {
		include(_COMPONENTPATH . "header/search_result_header.php");
	} else if ($Page == "RegistrationResult") {
		include(_COMPONENTPATH . "header/registration_result_header.php");
	} else if ($Page == "SignOut") {
		include(_COMPONENTPATH . "header/sign_out_header.php");
	} else if ($Page == "ForgetPassword") {
		include(_COMPONENTPATH . "header/forget_password_header.php");
	} else if ($Page == "Product") {
		include(_COMPONENTPATH . "header/product_header.php");
	} else if ($Page == "CheckOut1") {
		include(_COMPONENTPATH . "header/check_out_step_1_header.php");
	} else if ($Page == "CheckOut2") {
		include(_COMPONENTPATH . "header/check_out_step_2_header.php");
	} else if ($Page == "ReviewOrder") {
		include(_COMPONENTPATH . "header/review_order_header.php");
	} else if ($Page == "ProcessOrder") {
		include(_COMPONENTPATH . "header/process_order_header.php");
	}
	
	if (isset($user))
		$shopping_cart = new ShoppingCart();
	/*********************************************************************************/
	?>
	
	<html>
	<head>
	<title><? if(WebContent::getPropertyValue("site_title") != "") {?><?=WebContent::getPropertyValue("site_title")?><? } else {?><?=$adminuser->getCompanyName()?><? }?></title>
	<meta name="keywords" content="<? if(WebContent::getPropertyValue("keywords") != "") {?><?=WebContent::getPropertyValue("keywords")?><? }?>">
	<meta name="description" content="<? if(WebContent::getPropertyValue("description") != "") {?><?=WebContent::getPropertyValue("description")?><? }?>">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<? if (WebContent::getPropertyValue("other_meta_tags") != "") {?><?=WebContent::getPropertyValue("other_meta_tags")?><? }?>
	<? if (WebContent::getPropertyValue("bg_sound_src") != "") {?><bgsound src="<?=WebContent::getPropertyValue("bg_sound_src")?>" loop="true"><? }?>
	<? if (WebContent::getPropertyValue("css_file") != "") {?><link rel="stylesheet" type="text/css" href="<?=WebContent::getPropertyValue("css_file")?>"><? }?>
	<script language="JavaScript">
	
	var coldColor = "<?=WebContent::getPropertyValue("classic_2_link_color")?>"
	var hotColor  = "<?=WebContent::getPropertyValue("classic_2_active_link_color")?>"
	var motionPix = "0"
	var a='<style>'+
	'A.InstantLink:link {'+
	'  color:'+coldColor+';'+
	'  text-decoration:none;'+
	'  padding:0 '+motionPix+' 0 0;'+
	'  }'+  
	'A.InstantLink:visited {'+
	'  color:'+coldColor+';'+
	'  text-decoration:none;'+
	'  padding:0 '+motionPix+' 0 0;}'+  
	'A.InstantLink:active {'+
	'  color:'+coldColor+';'+
	'  text-decoration:none;'+
	'  padding:0 '+motionPix+' 0 0;'+
	'  }'+  
	'A.InstantLink:hover {'+
	'  color:'+hotColor+';'+
	'  text-decoration:underline;'+
	'  padding:0 0 0 '+motionPix+';'+
	'  }'+
	'</style>'

	if (document.all || document.getElementById) {
			document.write(a);
	}

	function openURL(url) {
		open(url,"_self");
	}
	
	<?php
	/***************************** Do not remove this part ***************************/
	if ($Page == "Home") {
		include(_COMPONENTPATH . "script/home_script.js");
	} else if ($Page == "ShoppingCart") {
		include(_COMPONENTPATH . "script/shopping_cart_script.js");
	} else if ($Page == "WishList") {
		include(_COMPONENTPATH . "script/wish_list_script.js");
	} else if ($Page == "FindWishList") {
		include(_COMPONENTPATH . "script/find_wish_list_script.js");
	} else if ($Page == "Account") {
		include(_COMPONENTPATH . "script/account_script.js");
	} else if ($Page == "SignIn") {
		include(_COMPONENTPATH . "script/sign_in_script.js");
	} else if ($Page == "SignOut") {
		include(_COMPONENTPATH . "script/sign_out_script.js");
	} else if ($Page == "Registration") {
		include(_COMPONENTPATH . "script/registration_script.js");
	} else if ($Page == "RegistrationResult") {
		include(_COMPONENTPATH . "script/registration_result_script.js");
	} else if ($Page == "ForgetPassword") {
		include(_COMPONENTPATH . "script/forget_password_script.js");
	} else if ($Page == "CheckOut1") {
		include(_COMPONENTPATH . "script/check_out_step_1_script.js");
	} else if ($Page == "CheckOut2") {
		include(_COMPONENTPATH . "script/check_out_step_2_script.js");
	} else if ($Page == "ReviewOrder") {
		include(_COMPONENTPATH . "script/review_order_script.js");
	}
	/*********************************************************************************/
	?>
	
	</script>
	</head>
	
	<style type="text/css">
		.cursor {
			cursor: hand
		}
		
		body {  
			font-family: <?=WebContent::getPropertyValue("classic_2_font_face")?>; 
			font-size: <?=WebContent::getPropertyValue("classic_2_font_size")?>; 
			color: <?=WebContent::getPropertyValue("classic_2_font_color")?>
		}
		
		td {  
			font-family: <?=WebContent::getPropertyValue("classic_2_font_face")?>; 
			font-size: <?=WebContent::getPropertyValue("classic_2_font_size")?>; 
			color: <?=WebContent::getPropertyValue("classic_2_font_color")?>
		}
		
		.tabfont {  
			font-family: <?=WebContent::getPropertyValue("classic_2_tab_font_face")?>; 
			font-size: <?=WebContent::getPropertyValue("classic_2_tab_font_size")?>; 
			color: <?=WebContent::getPropertyValue("classic_2_tab_font_color")?>
		}
		
		.tableheaderfont {  
			font-family: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_face")?>; 
			font-size: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_size")?>; 
			color: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>
		}
	</style>

	<?php 
	/***************************** Do not remove this part ***************************/
	$comp = $adminuser->getComponent(_USER);?>
	<? if ($Page == "Home") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="<? if (isset($isVerified) && !$isVerified) {?>loginFailed();<? }?><? if (isset($GoTo)) {?>goTo('<?=$GoTo?>');<? }?>">
	<? } else if ($Page == "ShoppingCart") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes") && !isset($user)) {?>signIn();<? }?>">
	<? } else if ($Page == "WishList") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes") && $Action == "Add" && !isset($user)) {?>signIn();<? }?>">
	<? } else if ($Page == "FindWishList") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="<? if ($found) {?>goToWishList();<? }?>">
	<? } else if ($Page == "Account") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="<? if (!isset($user)) {?>signIn();<? }?>">
	<? } else if ($Page == "RegistrationResult") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="<? if ($isSuccess) {?>signIn();<? } else {?>registrationFailed();<? }?>">
	<? } else if ($Page == "SignOut") {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>" onLoad="signOut();">
	<? } else {?>
	<body bgcolor="<?=WebContent::getPropertyValue("classic_2_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("classic_2_bg_img")?>" text="<?=WebContent::getPropertyValue("classic_2_font_color")?>" link="<?=WebContent::getPropertyValue("classic_2_link_color")?>" vlink="<?=WebContent::getPropertyValue("classic_2_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("classic_2_link_color")?>">
	/*********************************************************************************/
	?>
	
	<?php
	/***************************** Do not remove this part ***************************/
	// This is the code to place company logo.
	?>
	
	<table border="0" cellspacing="0" cellpadding="3">
  <tr>
		<? if(WebContent::getPropertyValue("logo_img_src") != "") {?><td><img src="<?=WebContent::getPropertyValue("logo_img_src")?>" alt="<?=WebContent::getPropertyValue("logo_img_alt_text")?>" name="logo" border="0" id="logo"></td><? if(WebContent::getPropertyValue("show_logo_img_txt") == "yes") {?><td><font size="+1"><strong><?=WebContent::getPropertyValue("logo_img_text")?></strong></font></td><? }?><? } else {?><td><font size="+1"><strong><?=WebContent::getPropertyValue("logo_img_text")?></strong></font></td><? }?>
	</tr>
	</table>
		
	<?php
	/*********************************************************************************/
	?>
	
	<?php
	/***************************** Do not remove this part ***************************/
	// This is the code to place shopping cart, wish list, user account icon.
	?>
	
	<? if (array_search("Shopping Cart",$comp) > -1) {?>
		<a href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=View">Shopping Cart</a><? if (isset($shopping_cart) && $shopping_cart->getItemCount((isset($user) && is_object($user))?$user->getUserId():"") > 0) {?> - <a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=CheckOut1&sub_total=<?=$shopping_cart->getSubTotal((isset($user) && is_object($user))?$user->getUserId():"")?>">Check Out</a><? }?> 
	<? }?>
	<? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?>
		<a href="mystore.php?Page=WishList&Action=View">Wish List</a> 
	<? }?>
	<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes")) {?>
		<a href="mystore.php?Page=Account">Your Account</a> 
		<? if (isset($user)) {?>
			<a href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>http://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=SignOut">Sign Out</a> 
		<? } else {?>
			<a href="mystore.php?Page=SignIn">Sign In</a> 
		<? }?>
	<? }?>
	
	<?php
	/*********************************************************************************/
	?>

	<?php
	/***************************** Do not remove this part ***************************/
	// This is the code to place user url links on the top.
	?>
	
	<?$links = WebContent::getLinks("Top");?>
	<strong>
	<? for ($i=0;$i<count($links);$i++) {
		$link = $links[$i];?>
		<? if ($link["target"] == "Self") {?>	
		<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="mystore.php?Page=Link&Link=<?=urlencode($link["url"])?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
		<? } else if ($link["target"] == "Parent") {?>
		<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="<?=$link["url"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
		<? } else if ($link["target"] == "New Window") {?>
		<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="<?=$link["url"]?>" target="<?=$link["target"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
		<? }?>
	<? }?>
	</strong>

	<?php
	/*********************************************************************************/
	?>
	
	<?php
	/***************************** Do not remove this part ***************************/
	// This is the code to generate main category. This is the main navigation menu.
	?>
	
	<? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?>
	Home
	<? $main_cat = WebContent::getMainCategory();?>
	<? if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
		$Category = $main_cat[0];?>
	<? for($z=0;$z<count($main_cat);$z++) {?>
		<? if ($main_cat[$z] != "Home") {?>
		<?=$main_cat[$z]?>
		<? }?>
	<? }?>
	<? }?>
				
	<?php
	/*********************************************************************************/
	?>
	
	<?php
	/* This is the code if you want to show the sub category. 
	 * You can place wherever you want. 
	 */
	if (isset($Category) && $Category != "ALL") {
		$sub_cat_1 = WebContent::getSubCategory1($Category);?>
		<center>
			<? for($x=0;$x<count($sub_cat_1);$x++) {?>
			<? if ($sub_cat_1[$x] != "") {?>
			<a href="mystore.php?Page=Home&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"><?=$sub_cat_1[$x]?></a>
			<? }?>
			<? }?>
		</center>
	<? } else if (WebContent::getPropertyValue("HomeRemoved") != "yes") {
		$sub_cat_1 = WebContent::getSubCategory1("Home");?>
		<? for($x=0;$x<count($sub_cat_1);$x++) {?>								
		<? if ($sub_cat_1[$x] != "") {?>
		<a href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>" style="text-decoration:none"><font color="<?=WebContent::getPropertyValue("classic_3_tab_font_color")?>" size="-1"><?=$sub_cat_1[$x]?></a> <? if ($x < count($sub_cat_1)-1) {?>|<? }?>
		<? }?>
		<? }?>
	<? }
	/*********************************************************************************/
	?>
	
	<?php
	/* This is an optional component to search product. 
	 * You can place wherever you want. 
	 */
 	include(_COMPONENTPATH . "search.php");
	/*********************************************************************************/
	?>

	<?php 
	/***************************** Do not remove this part ***************************/
	// This is the main body content. Please put this part accordingly. If you have a
	// custom component for the body, please create components sub directory under your
	// theme directory and change the path reference to _TEMPLATEPATH.
	// For example: include(_TEMPLATEPATH . "classic/components/home.php);
	
	if ($Page == "Home") {
		include(_COMPONENTPATH . "body/home.php");
	} else if ($Page == "ShoppingCart") {
		include(_COMPONENTPATH . "body/shopping_cart.php");
	} else if ($Page == "WishList") {
		include(_COMPONENTPATH . "body/wish_list.php");
	} else if ($Page == "FindWishList") {
		include(_COMPONENTPATH . "body/find_wish_list.php");
	} else if ($Page == "Account") {
		include(_COMPONENTPATH . "body/account.php");
	} else if ($Page == "SignIn") {
		include(_COMPONENTPATH . "body/sign_in.php");
	} else if ($Page == "SearchResult") {
		include(_COMPONENTPATH . "body/search_result.php");
	} else if ($Page == "Registration") {
		include(_COMPONENTPATH . "body/registration.php");
	} else if ($Page == "ForgetPassword") {
		include(_COMPONENTPATH . "body/forget_password.php");
	} else if ($Page == "Product") {
		include(_COMPONENTPATH . "body/product.php");
	} else if ($Page == "CheckOut1") {
		include(_COMPONENTPATH . "body/check_out_step_1.php");
	} else if ($Page == "CheckOut2") {
		include(_COMPONENTPATH . "body/check_out_step_2.php");
	} else if ($Page == "ReviewOrder") {
		include(_COMPONENTPATH . "body/review_order.php");
	} else if ($Page == "ProcessOrder") {
		include(_COMPONENTPATH . "body/process_order.php");
	} else if ($Page == "MoreProducts") {
		include(_COMPONENTPATH . "body/more_products.php");
	} else if ($Page == "Link") {
		include realpath(urldecode($Link));
	}
	/*********************************************************************************/
	?>

	<?php 
	/***************************** Do not remove this part ***************************/
	// This code is for the bottom url links. Usually it displays link such as about us, help, etc.
	// Please place this link accordingly.
	?>
	
	<?$links = WebContent::getLinks("Bottom");?>
	<strong>
	<? for ($i=0;$i<count($links);$i++) {
		$link = $links[$i];?>
		<? if ($link["target"] == "Self") {?>	
		<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="mystore.php?Page=Link&Link=<?=urlencode($link["url"])?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
		<? } else if ($link["target"] == "Parent") {?>
		<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="<?=$link["url"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
		<? } else if ($link["target"] == "New Window") {?>
		<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="<?=$link["url"]?>" target="<?=$link["target"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
		<? }?>
	<? }?>
	</strong>
		
	<?
	/*********************************************************************************/
	?>
	
	<?php 
	/***************************** Do not remove this part ***************************/
	// This is the "powered by suryadisoft" logo. 
	?>
	
	<? if (WebContent::getPropertyValue("LogoRemoved") != "yes") {?>
	<p align="left"><a href="http://www.suryadisoft.net"><img src="<?=(_URLPATH . "themes/classic_2/")?>images/poweredby_suryadisoft.gif" width="125" height="23" border="0"></a></p>
	<? }?>
		
	<?
	/*********************************************************************************/
	?>

	</body>
	</html>

<?
/****************************** Do not remove this part ****************************/
// Do not remove this closing bracket.
?>

<? }?>

<?
/***********************************************************************************/
?>
