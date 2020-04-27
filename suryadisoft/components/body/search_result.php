	<? $main_cat = WebContent::getMainCategory();?>
    <h1 align="center">Search Result</h1>
      <p align="left">
			<? if ($product->getCount() > 0) {?>
			<strong>There are <?=$product->getCount()?> product(s) found.</strong>
			<? } else {?>
			<strong>No product(s) match with your search criteria.</strong>
			<? }?>
			</p>
			<p>
			<table width="100%" cellpadding="5" cellspacing="5">
				<? for($i=0;$i<$product->getCount();$i++) {?>
				<tr>
    <td valign="top"> <font size="-1"><a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<?=$product->getSmallImage($i)?>" border="0" <? if (WebContent::getPropertyValue("resize_sm_img") == "") {?>height="75"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? }?>></a> 
      </font></td>
    <td valign="top"> <font size="-1"><a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b> 
      <?=$product->getProductName($i)?>
      </b></a> <br>
      <?=substr($product->getProductDescription($i),0,100)?>
      <? if(strlen($product->getProductDescription($i)) > 100) {?>
      ... <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>">(more)</a> 
      <? }?>
      </font></td>
				</tr>
				<? }?>
			</table>
	<hr>
	<form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm">
	<table align="center" border="0" cellspacing="0" cellpadding="3">
	<tr> 
		<td><strong>Search:</strong></td>
		<td align="right"><strong>Category:</strong></td>
		<td> <select name="Category" id="Category">
				<option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All 
				Products</option>
				<? for($z=0;$z<count($main_cat);$z++) {?>
				<option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>> 
				<?=$main_cat[$z]?>
				</option>
				<? }?>
			</select> </td>
		<td align="right"><b>Keywords</b>: </td>
		<td nowrap><input name="Keyword" type="text" id="Keyword" size="12"> <input name="SearchButton" type="submit" id="SearchButton3" value="Go"></td>
	</tr>
	</table>
	</form