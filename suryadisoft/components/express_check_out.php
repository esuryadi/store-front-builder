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
$num_show_items = (WebContent::getPropertyValue("show_items_" . $id) != "")?WebContent::getPropertyValue("show_items_" . $id):15;
if ($product->getCount() > $num_show_items)
	$count = $num_show_items;
else
	$count = $product->getCount();
?>
<? if ($count == 0) {?>
There are no products in this category. Click this <input name="addProductButton" type="button" value="Add Product" onClick="window.open('<?=_URLPATH?>admin/ecommerce_control_panel/login.php?Action=Add&Mode=wizard&component=product&page_name=<?=urlencode($Category)?><? if (isset($SubCategory1)) {?>&page_category=main&main_category=<?=urlencode($Category)?><? }?>&comp_type=<?=$product_type?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');"> button to add a product, then refresh this page. To Add more products, go to your store manager control panel.
<? }?>
<? if ($count > 0 ) {?>
<form name="ExpressCheckOutForm" action="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php" method="post">
<input type="hidden" name="Page" value="ShoppingCart">
<input type="hidden" name="Action" value="Add">
<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>
		<td>
			<table width="100%" cellspacing="0" cellpadding="3">
			<tr>
				<th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1">Products</font></th>
				<th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1">Price</font></th>
				<th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" nowrap><font size="-1">Add To Cart</font></th>
			</tr>
			<? for($i=0;$i<$count;$i++) {
				$prd = $product->getProduct($product->getProductId($i));?>			
			<tr>
				<td width="*">
				<a class="InstantLink" href="mystore.php?Page=Product&ProductId=<?=$product->getProductId($i)?>">
				<?=$product->getProductName($i)?>
				</a>
				</td>
				<td align="right">$<? printf("%01.2f",$product->getPrice($i));?></td>
				<td width="100" align="center" nowrap>
				<? if ($prd["qty"] > 0) {?>
				<input type="checkbox" name="ProductId[]" value="<?=$product->getProductId($i)?>">
				<? } else {?>
				<b><font color="red">Out of Stock</font></b>
				<? }?>
				</td>
			</tr>
			<? }?>
			<tr>
				<td align="right" colspan="4"><input type="submit" name="buyNowButton" value="Buy Now"></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</form>
<? }?>
<? if ($product->getCount() > $num_show_items) {?>
<p>
<center><a href="mystore.php?Page=MoreProducts&Style=ExpressCheckOut&Title=<?=urlencode(str_replace("&","_",$title))?>&Count=<?=$count?>&NumShowItems=<?=$num_show_items?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$product_type?>">See More Products</a></center>
<p>
<? }?>