<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
	<td>
	<? $main_cat = WebContent::getMainCategory();?>
	<? for($z=0;$z<count($main_cat);$z++) {
		$sub_cat_1 = WebContent::getSubCategory1($main_cat[$z]);?>
	<p><font><strong><a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>"><?=$main_cat[$z]?></a></strong></font><br>
		<? for($x=0;$x<count($sub_cat_1);$x++) {
			$sub_cat_2 = WebContent::getSubCategory2($main_cat[$z],$sub_cat_1[$x]);?>
  	<? if ($sub_cat_1[$x] != "") {?>
		<table>
		<tr>
			<td>&nbsp;&nbsp;</td>
			<td><font size="-1"><strong><a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>"><?=$sub_cat_1[$x]?></a></strong></font><br></td>
		</tr>
		</table>				 
		<? }?>
			<? for($y=0;$y<count($sub_cat_2);$y++) {?>
				<? if ($sub_cat_2[$y] != "") {?>
				<table>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><font size="-1"><a class="InstantLink" href="mystore.php?Page=Home&Category=<?=urlencode($main_cat[$z])?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>&SubCategory2=<?=urlencode($sub_cat_2[$y])?>"><?=$sub_cat_2[$y]?></a></font><br></td>
				</tr>
				</table>				 
				<? }?>
			<? }?>
		<? }?>
	</p>
	<? }?>
	</td>
 </tr>
</table>
