<?php 
$comp = $adminuser->getComponent(_USER);?>
<? if ($Page == "Home") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="<? if (isset($isVerified) && !$isVerified) {?>loginFailed();<? }?><? if (isset($GoTo)) {?>goTo('<?=$GoTo?>');<? }?>">
<? } else if ($Page == "ShoppingCart") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes") && !isset($user)) {?>signIn();<? }?>">
<? } else if ($Page == "WishList") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes") && $Action == "Add" && !isset($user)) {?>signIn();<? }?>">
<? } else if ($Page == "FindWishList") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="<? if ($found) {?>goToWishList();<? }?>">
<? } else if ($Page == "Account") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="<? if (!isset($user)) {?>signIn();<? }?>">
<? } else if ($Page == "RegistrationResult") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="<? if ($isSuccess) {?>signIn();<? } else {?>registrationFailed();<? }?>">
<? } else if ($Page == "SignOut") {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>" onLoad="signOut();">
<? } else {?>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" text="<?=WebContent::getPropertyValue("outlook_font_color")?>" link="<?=WebContent::getPropertyValue("outlook_font_color")?>" vlink="<?=WebContent::getPropertyValue("outlook_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("outlook_active_link_color")?>" bgcolor="<?=WebContent::getPropertyValue("outlook_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("outlook_bg_img")?>">
<? }?>