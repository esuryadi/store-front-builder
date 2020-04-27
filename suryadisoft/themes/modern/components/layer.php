<?php
$links = WebContent::getLinks("Top");
$top = 286;
if (count($links) > 0)
	$top = $top + 29;
if(WebContent::getPropertyValue("logo_img_src") != "")
	$top = $top + WebContent::getPropertyValue("modern_logo_height") + 17;
?>
		
<? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?>
<div id="Home" class="hide"> 
<table border="1" bgcolor="<?=WebContent::getPropertyValue("modern_menu_bgcolor_2")?>">
<tr><td>
<table cellspacing="0" cellpadding="5">
<? $sub_cat_1 = WebContent::getSubCategory1("Home");?>
<? for($x=0;$x<count($sub_cat_1);$x++) {?>								
	<? if ($sub_cat_1[$x] != "") {?>
	<tr>
	<td width="166" nowrap id="cat:<?=$sub_cat_1[$x]?>" class="inactive" onClick="openURL('mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>');" onMouseOver="changeBGColor('cat:<?=$sub_cat_1[$x]?>','over');" onMouseOut="changeBGColor('cat:<?=$sub_cat_1[$x]?>','inactive');">
	<div class="cursor">
	<font color="<?=WebContent::getPropertyValue("modern_menu_font_color")?>">
	<?=$sub_cat_1[$x]?>
	</font>
	</div>
	</td>
	</tr>
	<? }?>
<? }?>
</table>
</td></tr>
</table>
</div>
<? }?>
<? $main_cat = WebContent::getMainCategory();?>
<? if ((!isset($Category) || (isset($Category) && $Category == "ALL")) && WebContent::getPropertyValue("HomeRemoved") == "yes")
	$Category = $main_cat[0];?>
<? for($z=0;$z<count($main_cat);$z++) {?>
	<? if ($main_cat[$z] != "Home" || ($main_cat[$z] == "Home" && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?>
	<div id="<?=$main_cat[$z]?>" class="hide"> 
	<table border="1" bgcolor="<?=WebContent::getPropertyValue("modern_menu_bgcolor_2")?>">
	<tr><td>		
	<table cellspacing="0" cellpadding="5">
	<? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);?>
	<? for($x=0;$x<count($sub_cat_1);$x++) {?>
		<? if ($sub_cat_1[$x] != "") {?>
		<tr>
		<td width="166" nowrap id="cat:<?=$sub_cat_1[$x]?>" class="inactive" onClick="openURL('mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>');" onMouseOver="changeBGColor('cat:<?=$sub_cat_1[$x]?>','over');" onMouseOut="changeBGColor('cat:<?=$sub_cat_1[$x]?>','inactive');">
		<div class="cursor">
		<font color="<?=WebContent::getPropertyValue("modern_menu_font_color")?>">
		<?=$sub_cat_1[$x]?>
		</font>
		</div>
		</td>
		</tr>
		<? }?>
	<? }?>			
	</table>
	</td></tr>
	</table>
	</div>
	<? }?>
<? }?>