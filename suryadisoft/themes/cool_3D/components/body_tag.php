<?php 
$comp = $adminuser->getComponent(_USER);?>
<? if ($Page == "Home") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="<? if (isset($isVerified) && !$isVerified) {?>loginFailed();<? }?><? if (isset($GoTo)) {?>goTo('<?=$GoTo?>');<? }?>">
<? } else if ($Page == "ShoppingCart") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes") && !isset($user)) {?>signIn();<? }?>">
<? } else if ($Page == "WishList") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="<? if (array_search("User Account",$comp) > -1 && (WebContent::getPropertyValue("user_account") == "" || WebContent::getPropertyValue("user_account") == "yes") && $Action == "Add" && !isset($user)) {?>signIn();<? }?>">
<? } else if ($Page == "FindWishList") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="<? if ($found) {?>goToWishList();<? }?>">
<? } else if ($Page == "Account") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="<? if (!isset($user)) {?>signIn();<? }?>">
<? } else if ($Page == "RegistrationResult") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="<? if ($isSuccess) {?>signIn();<? } else {?>registrationFailed();<? }?>">
<? } else if ($Page == "SignOut") {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" onLoad="signOut();">
<? } else {?>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="<?=WebContent::getPropertyValue("cool_3D_body_bgcolor")?>" background="<?=WebContent::getPropertyValue("cool_3D_bg_img")?>" text="<?=WebContent::getPropertyValue("cool_3D_font_color")?>" link="<?=WebContent::getPropertyValue("cool_3D_link_color")?>" vlink="<?=WebContent::getPropertyValue("cool_3D_visited_link_color")?>" alink="<?=WebContent::getPropertyValue("cool_3D_link_color")?>">
<? }?>