<?php
switch($position) {
	case "top": $id = $top_content->getID($n);
							break;
	case "left": $id = $left_content->getID($n);
							 break;
	case "center": $id = $middle_content->getID($n);
								 break;
	case "right": $id = $right_content->getID($n);
								break;
	case "bottom": $id = $bottom_content->getID($n);
								 break;
}
$num_show_items = (WebContent::getPropertyValue("show_items_" . $id) != "")?WebContent::getPropertyValue("show_items_" . $id):7;
if ($product->getCount() > $num_show_items)
	$count = $num_show_items;
else
	$count = $product->getCount();
?>
<? if ($count == 0) {?>
There are no products in this category. Click this <input name="addProductButton" type="button" value="Add Product" onClick="window.open('<?=_URLPATH?>admin/ecommerce_control_panel/login.php?Action=Add&Mode=wizard&component=product&page_name=<?=urlencode($Category)?><? if (isset($SubCategory1)) {?>&page_category=main&main_category=<?=urlencode($Category)?><? }?>&comp_type=<?=$product_type?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');"> button to add a product, then refresh this page. To Add more products, go to your store manager control panel.
<? }?>
<table cellpadding="5" cellspacing="5">
	<? for($i=0;$i<$count;$i++) {
		$desc = substr($product->getProductDescription($i),strpos($product->getProductDescription($i),"</STYLE>"));?>
	<tr>
		<td valign="top"> <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getSmallImage($i) != "") {?><?=$product->getSmallImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_sm_img") == "") {?>height="75"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? }?>></a> 
		</td>
		<td valign="top">
		<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b><?=$product->getProductName($i)?></b></a>
		<br><?=substr(strip_tags($desc),0,100)?> <? if(strlen($desc) > 100) {?>... <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>">(more)</a><? }?>
		<table width="100%">
		<tr>
			<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>
			<td><font size="-2">Retail Price: $<? printf("%01.2f",$product->getRetailPrice($i));?></font></td>
			<? }?>
			<td><font size="-2" color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><strong><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price:</strong> $<? printf("%01.2f",$product->getPrice($i));?></font></td>
			<td align="right">
			<? if (array_search("Shopping Cart",$comp) > -1) {?>
				<font size="-2"><a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=Add&ProductId=<?=$product->getProductId($i)?>">Add to cart</a></font>
			<? }?>
			</td>
		</tr>
		</table>
		</td>
	</tr>
	<? }?>
</table>
<? if ($product->getCount() > $num_show_items) {?>
<p>
<center><a href="mystore.php?Page=MoreProducts&Style=ImagesList&Count=<?=$count?>&NumShowItems=<?=$num_show_items?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$product_type?>&Title=<?=urlencode(str_replace("&","_",$title))?>">See More Products</a></center>
<p>
<? }?>