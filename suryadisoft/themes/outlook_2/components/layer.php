<?php
$top = 119;
if(WebContent::getPropertyValue("logo_img_src") != "")
	$top = $top + WebContent::getPropertyValue("outlook_2_logo_height") + 17;

if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?>
<div id="Home" class="hide"> 
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr> 
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_left.gif<? } else {?>tab_corner_left_bl.gif<? }?>" width="5" height="5"></td>
		<td width="95%" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"></td>
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_right.gif<? } else {?>tab_corner_right_bl.gif<? }?>" width="5" height="5"></td>
	</tr>
	<tr>
		<td colspan="3">
			<table width="100%" cellpadding="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>">
<? $sub_cat_1 = WebContent::getSubCategory1("Home");?>
<? for($x=0;$x<count($sub_cat_1);$x++) {?>								
	<? if ($sub_cat_1[$x] != "") {?>
	<tr>
	<td colspan="3" width="150" nowrap id="cat:<?=$sub_cat_1[$x]?>" class="inactive" onClick="openURL('mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>');" onMouseOver="changeBGColor('cat:<?=$sub_cat_1[$x]?>','over');" onMouseOut="changeBGColor('cat:<?=$sub_cat_1[$x]?>','inactive');">
	<div class="cursor">
	<font color="<?=WebContent::getPropertyValue("outlook_2_menu_font_color")?>">
	<?=$sub_cat_1[$x]?>
	</font>
	</div>
	</td>
	</tr>
	<? }?>
<? }?>
			</table>
		</td>
	</tr>
	<tr> 
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_bleft.gif<? } else {?>tab_corner_bleft_bl.gif<? }?>" width="5" height="5"></td>
		<td width="95%" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"></td>
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_bright.gif<? } else {?>tab_corner_bright_bl.gif<? }?>" width="5" height="5"></td>
	</tr>
</table>
</div>
<? }?>
<? $main_cat = WebContent::getMainCategory();?>
<? if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
	$Category = $main_cat[0];?>
<? for($z=0;$z<count($main_cat);$z++) {?>
	<? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?>
	<div id="<?=$main_cat[$z]?>" class="hide"> 
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr> 
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/<? if (WebContent::getPropertyValue("classic_body_bgcolor") == "" || WebContent::getPropertyValue("classic_body_bgcolor") == "#FFFFFF") {?>tab_corner_left.gif<? } else {?>tab_corner_left_bl.gif<? }?>" width="5" height="5"></td>
		<td width="95%" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"></td>
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/tab_corner_right.gif" width="5" height="5"></td>
	</tr>
	<tr>
		<td colspan="3">
			<table width="100%" cellpadding="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>">
			<? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);?>
			<? for($x=0;$x<count($sub_cat_1);$x++) {?>
				<? if ($sub_cat_1[$x] != "") {?>
				<tr>
				<td width="150" nowrap id="cat:<?=$sub_cat_1[$x]?>" class="inactive" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>');" onMouseOver="changeBGColor('cat:<?=$sub_cat_1[$x]?>','over');" onMouseOut="changeBGColor('cat:<?=$sub_cat_1[$x]?>','inactive');">
				<div class="cursor">
				<font color="<?=WebContent::getPropertyValue("outlook_2_menu_font_color")?>">
				<?=$sub_cat_1[$x]?>
				</font>
				</div>
				</td>
				</tr>
				<? }?>
			<? }?>
			</table>
		</td>
	</tr>
	<tr> 
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/tab_corner_bleft.gif" width="5" height="5"></td>
		<td width="95%" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"></td>
		<td width="5" bgcolor="<?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>"><img src="<?=(_URLPATH . "themes/outlook_2/")?>images/tab_corner_bright.gif" width="5" height="5"></td>
	</tr>			
	</table>
	</div>
	<? }?>
<? }?>