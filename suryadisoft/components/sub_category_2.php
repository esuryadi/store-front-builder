<?php
$sub_cat_2 = WebContent::getSubCategory2($Category,$SubCategory1);
?>
<? for($y=0;$y<count($sub_cat_2);$y++) {?>
	<? if ($sub_cat_2[$y] != "") {?>
	<font size="-1"><a class="InstantLink" href="mystore.php?Page=Home&Category=<?=$Category?>&SubCategory1=<?=$SubCategory1?>&SubCategory2=<?=urlencode($sub_cat_2[$y])?>"><?=$sub_cat_2[$y]?></a></font><br>
	<? }?>
<? }?>
