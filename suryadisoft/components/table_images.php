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
$num_show_items = (WebContent::getPropertyValue("show_items_" . $id) != "")?WebContent::getPropertyValue("show_items_" . $id):12;
$num_col = (WebContent::getPropertyValue("num_col_" . $id) != "")?WebContent::getPropertyValue("num_col_" . $id):3;
if ($product->getCount() > $num_show_items)
	$count = $num_show_items;
else
	$count = $product->getCount();
?>
<? if ($count == 0) {?>
There are no products in this category. Click this <input name="addProductButton" type="button" value="Add Product" onClick="window.open('<?=_URLPATH?>admin/ecommerce_control_panel/login.php?Action=Add&Mode=wizard&component=product&page_name=<?=urlencode($Category)?><? if (isset($SubCategory1)) {?>&page_category=main&main_category=<?=urlencode($Category)?><? }?>&comp_type=<?=$product_type?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');"> button to add a product, then refresh this page. To Add more products, go to your store manager control panel.
<? }?>
<center>
<table cellpadding="5" cellspacing="5">
	<? for($i=0;$i<$count;$i++) {?>
	<? if ($i%$num_col == 0) {?>
	<tr>
	<? }?>
		<td valign="top" width="180">
			<table width="100%">
				<tr>
					<td valign="top"> 
					<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getSmallImage($i) != "") {?><?=$product->getSmallImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_sm_img") == "") {?>height="75"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? }?>></a> 
					</td>
					<td valign="top">
					<a class="InstantLink" href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b><?=$product->getProductName($i)?></b></a>
					</td>
				</tr>
				<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>
				<tr>
					<td colspan="2">Retail Price: $<? printf("%01.2f",$product->getRetailPrice($i));?></td>
				</tr>
				<? }?>
				<tr>
					<td colspan="2"><font color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><strong><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price:</strong> $<? printf("%01.2f",$product->getPrice($i));?></font></td>
				</tr>
				<tr>
					<td align="center" colspan="2" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
					<? if (array_search("Shopping Cart",$comp) > -1) {?>
						<a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=Add&ProductId=<?=$product->getProductId($i)?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong>Buy Now</strong></font></a>
					<? }?>
					</td>
				</tr>
			</table>
		</td>
	<? if ($i%$num_col == ($num_col-1) || $i == $count-1) {?>
	</tr>
	<? }?>
	<? }?>
</table>
</center>
<? if ($product->getCount() > $num_show_items) {?>
<p>
<center><a href="mystore.php?Page=MoreProducts&Style=TableImages&Title=<?=urlencode(str_replace("&","_",$title))?>&Count=<?=$count?>&NumShowItems=<?=$num_show_items?>&NumCol=<?=$num_col?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$product_type?>">See More Products</a></center>
<p>
<? }?>