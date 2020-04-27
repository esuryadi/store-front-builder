<? if (WebContent::getPropertyValue("HomeRemoved") != "yes") {?>
<div id="Home" class="hide"> 
<table border="0" bgcolor="<?=WebContent::getPropertyValue("stylish_menu_bgcolor_1")?>">
<tr><td>
<table cellspacing="0" cellpadding="5">
<? $sub_cat_1 = WebContent::getSubCategory1("Home");?>
<? for($x=0;$x<count($sub_cat_1);$x++) {?>								
	<? if ($sub_cat_1[$x] != "") {?>
	<tr>
	<td width="166" nowrap>
	<div class="cursor">
	<font color="<?=WebContent::getPropertyValue("stylish_menu_font_color")?>">
	<a class="InstantLink" href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"><?=$sub_cat_1[$x]?></a>
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
	<? if ($main_cat[$z] != "Home" || ($main_cat[$z] && WebContent::getPropertyValue("HomeRemoved") == "yes")) {?>
	<div id="<?=$main_cat[$z]?>" class="hide"> 
	<table border="0" bgcolor="<?=WebContent::getPropertyValue("stylish_menu_bgcolor_1")?>">
	<tr><td>		
	<table cellspacing="0" cellpadding="5">
	<? $sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);?>
	<? for($x=0;$x<count($sub_cat_1);$x++) {?>
		<? if ($sub_cat_1[$x] != "") {?>
		<tr>
		<td width="166" nowrap>
		<div class="cursor">
		<font color="<?=WebContent::getPropertyValue("stylish_menu_font_color")?>">
		<a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"><?=$sub_cat_1[$x]?></a>
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