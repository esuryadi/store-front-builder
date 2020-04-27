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
$num_show_items = (WebContent::getPropertyValue("show_items_" . $id) != "")?WebContent::getPropertyValue("show_items_" . $id):1;
$num_col = (WebContent::getPropertyValue("num_col_" . $id) != "")?WebContent::getPropertyValue("num_col_" . $id):1;
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
	<form name="AddToCart" method="get" action="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php">
	<input type="hidden" name="Page" value="ShoppingCart">
	<input type="hidden" name="Action" value="Add">
	<input type="hidden" name="ProductId" value="<?=$product->getProductId($i)?>">
	<? if ($i%$num_col == 0) {?>
	<tr>
	<? }?>
		<td valign="top"> <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getMediumImage($i) != "") {?><?=$product->getMediumImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_md.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_md_img") == "") {?>height="200"<? } else if (WebContent::getPropertyValue("resize_md_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_md_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? }?>></a> 
		</td>
		<td valign="top">
		<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b><?=$product->getProductName($i)?></b></a>
		<br><?=substr(strip_tags($desc),0,100)?> <? if(strlen($desc) > 100) {?>... <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>">(more)</a><? }?>
		<p>
		Quantity: <input name="Quantity" type="text" value="1" size="1">
		<p>
		<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>
		Retail Price: $<? printf("%01.2f",$product->getRetailPrice($i));?>
		<? }?>
		<br>
		<font color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><strong><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price:</strong> $<? printf("%01.2f",$product->getPrice($i));?></font>
		<p>
		<? if (array_search("Shopping Cart",$comp) > -1) {?>
			<a class="InstantLink" href="#" onClick="submit();"><font size="+1"><strong>Buy Now</strong></font></a>
		<? }?>
		</td>
	<? if ($i%$num_col == ($num_col-1) || $i == $count-1) {?>
	</tr>
	<? }?>
	</form>
	<? }?>
</table>
<? if ($product->getCount() > $num_show_items) {?>
<p>
<center><a href="mystore.php?Page=MoreProducts&Style=Headlines&Count=<?=$count?>&NumShowItems=<?=$num_show_items?>&NumCol=<?=$num_col?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$product_type?>&Title=<?=urlencode(str_replace("&","_",$title))?>">See More Products</a></center>
<p>
<? }?>