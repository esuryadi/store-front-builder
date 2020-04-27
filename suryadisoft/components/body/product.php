<p>
<form name="product" action="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart" method="post">
<input type="hidden" name="Action" value="Add">
<input type="hidden" name="ProductId" value="<?=$ProductId?>">
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td> 
<h3> <font size="-1"> 
        <?=$product["name"]?>
  </font></h3>
		  <table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
    <td width="23%" valign="top">
			<? if (count($images) > 0) {?>
			<applet code=com.suryadisoft.applet.imagesviewer.PhotoViewer codebase="<?=_URLPATH?>class" archive="suryadisoft.jar" name=PhotoViewer width=<? if (WebContent::getPropertyValue("img_md_w") == "") {?>255<? } else {?><?=WebContent::getPropertyValue("img_md_w")?><? }?> height=<? if (WebContent::getPropertyValue("img_md_h") != "") {?><?=(WebContent::getPropertyValue("img_md_h") + 32)?><? } else {?>287<? }?>>
			<param name=BACKGROUND value="#FFFFFF">
			<? for($z=0;$z<count($images);$z++) {?>
			<param name=PHOTO<?=$z?> value="<?=_URLPATH?><? if (substr(_USER,0,5) == "trial") {?>trial/<?=_USER?>/<? } else {?>client_img_src/<? }?><?=$images[$z]?>">
			<? }?>
			<param name=BUTTON_BGCOLOR value="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_body_bgcolor")?>">
			<param name=NO_BORDER value="true">
			<param name=NO_TITLE value="true">
			<param name=NO_LABEL value="true">
			<param name=NO_CONTROL_PANEL value="false">
			<param name=NO_SCROLL_BAR value="true">
			</applet>
			<? } else {?>
			<img src="<? if ($product["img_md"] != "") {?><?=$product["img_md"]?><? } else {?>http://www.suryadisoft.net/images/blank_img_md.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_md_img") == "") {?>width="255"<? } else if (WebContent::getPropertyValue("resize_md_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_md_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? }?>> 
      <? }?>
			<p align="center"><font size="-1">[<a class="InstantLink" href="#" onClick="open('<? if ($product["img_lg"] != "") {?><?=$product["img_lg"]?><? } else {?>http://www.suryadisoft.net/images/blank_img_md.gif<? }?>','large_image','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=500,height=500');">Click 
        here to zoom</a>] </font>
			<? if (WebContent::getPropertyValue("showCondition") == "" || WebContent::getPropertyValue("showCondition") == "yes") {?>
      <p><font size="-1"><b>Condition:</b> 
        <?=$product["cond"]?>
        </font></p>
			<? }?>
			<? if (WebContent::getPropertyValue("showCatNum") == "" || WebContent::getPropertyValue("showCatNum") == "yes") {?>
      <font size="-1"> 
					<? if ($product["isbn"] != "") {?>
      <p><font size="-1"><b>Catalog Number:</b> 
        <?=$product["isbn"]?>
        </font></p>
			<? }?>
      <font size="-1">
					<? }?>
			<? if (WebContent::getPropertyValue("showStockStatus") == "" || WebContent::getPropertyValue("showStockStatus") == "yes") {?>
      <font face="Verdana, Arial, Helvetica, sans-serif">
              <p><b>Stock Status:</b> 
                <? if($product["qty"] > 0) {?>
                In Stock 
                <? } else {?>
                Out Of Stock 
                <? }?>
              </font></font></font>
			<? }?>
		</td>
    <td width="54%" valign="top"> <font size="-1"> 
			<? if (WebContent::getPropertyValue("showSubCat") == "" || WebContent::getPropertyValue("showSubCat") == "yes") {?>
						<? if ($product["sub_cat_1"] != "") {?>
      </font> <p><font size="-1"><b>Sub Category:</b> 
        <?=$product["sub_cat_1"]?>
        <? if ($product["sub_cat_2"]) {?>
        , 
        <?=$product["sub_cat_2"]?>
						<? }?>
        </font></p>
      <font size="-1"> 
      <? }?>
			<? }?>
      </font> <p><font size="-1"><b>Description:</b></font></p>
      <p> <font size="-1"> 
        <?=$product["desc"]?>
        </font></p>
		<? if (WebContent::getPropertyValue("showRetailPrice") == "" || WebContent::getPropertyValue("showRetailPrice") == "yes") {?>
		<? if ($product["retail_price"] != "" && $product["retail_price"] > 0) {?>
		<p><font size="-1"><b>Retail Price:</b> $ 
						<? printf("%01.2f",$product["retail_price"]);?>
			</font></p>
		<? }?>
		<? }?>
		<p><font size="-1" color="<? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?>"><b><? if ($product["retail_price"] != "" && $product["retail_price"] > 0) {?>Our <? }?>Price:</b> $ 
						<? printf("%01.2f",$product["price"]);?>
			</font></p>
		<? if ($product["color"] != "") {
			$color = explode(",",$product["color"]);?>
		<p><font size="-1"><b>Color Choices:</b></font>
			<select name="Color">
			<? for($i=0;$i<count($color);$i++) {?>
			<option value="<?=$color[$i]?>"><?=$color[$i]?></option>
			<? }?>
			</select>
			</p>
		<? }?>
		<? if ($product["size"] != "") {
			$size = explode(",",$product["size"]);?>
			<p><font size="-1"><strong>Size Choices:</strong></font>         
			<select name="Size">
			<? for($i=0;$i<count($size);$i++) {?>
			<option value="<?=$size[$i]?>"><?=$size[$i]?></option>
			<? }?>
			</select>
			</p>
		<? }?>
		<? if ($product["choices"] != "") {
			$choices = explode(",",$product["choices"]);?>
			<p><font size="-1"><strong>Choice:</strong></font>
			<select name="Choice">
			<? for($i=0;$i<count($choices);$i++) {?>
			<option value="<?=$choices[$i]?>"><?=$choices[$i]?></option>
			<? }?>
			</select>
			</p>
		<? }?>
		<table cellpadding="10" cellspacing="0">
		<tr>
			<td align="center">						 
				<? if (array_search("Shopping Cart",$comp) > -1) {?>
					<table border="0" cellspacing="0" cellpadding="3">
						<tr>
							<td><table cellpadding="0" cellspacing="0" border="0" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_icon_color"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_icon_color")?>"><tr>
							<td nowrap><font size="-1"><a href="#" onClick="document.product.submit();"><img src="<? if (WebContent::getPropertyValue("selected_theme") == "custom") {?>http://<?=$adminuser->getCompanyURL()?>/images/add_to_cart.gif<? } else {?><?=_URLPATH?>themes/<?=WebContent::getPropertyValue("selected_theme")?>/images/<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_body_bgcolor") == "" || WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_body_bgcolor") == "#FFFFFF") {?>add_to_cart.gif<? } else if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_body_bgcolor") == "#000000") {?>add_to_cart_bl.gif<? } else {?>add_to_cart.gif<? }?><? }?>" alt="Add To Shopping Cart" border="0" align="middle"></a></font></td>
						</tr></table></td>
							<td nowrap><font size="-1"> <a class="InstantLink" href="#" onClick="document.product.submit();">Add 
								to cart</a></font></td>
						</tr>
					</table>
				<? }?>
			</td>
				<? if (array_search("Wish List",$comp) > -1 && (WebContent::getPropertyValue("wish_list") == "" || WebContent::getPropertyValue("wish_list") == "yes")) {?>
				<td align="center">
					<table border="0" cellspacing="0" cellpadding="3">
						<tr>
							<td><table cellpadding="0" cellspacing="0" border="0" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_icon_color"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_icon_color")?>"><tr>
							<td nowrap><font size="-1"><a href="#" onClick="document.product.action='mystore.php?Page=WishList';document.product.submit();"><img src="<? if (WebContent::getPropertyValue("selected_theme") == "custom") {?>http://<?=$adminuser->getCompanyURL()?>/images/add_to_wish_list.gif<? } else {?><?=_URLPATH?>themes/<?=WebContent::getPropertyValue("selected_theme")?>/images/<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_body_bgcolor") == "" || WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_body_bgcolor") == "#FFFFFF") {?>add_to_wish_list.gif<? } else {?>add_to_wish_list_bl.gif<? }?><? }?>" alt="Add To Wish List" border="0" align="middle"></a></font></td>
						</tr></table></td>
							<td> <font size="-1"><a class="InstantLink" href="#" onClick="document.product.action='mystore.php?Page=WishList';document.product.submit();">Add 
								to Wish List</a></font></td>
						</tr>
					</table>
				</td>  
				<? }?>
			</tr>
		</table>
		</td>
       </tr>
      </table>
		</td>
	</tr>
</table>
</form>
<p></p>
<? $related_product = new Product(); 
$related_products = explode(",",stripslashes($product["related_products"])); 
$count = count($related_products);?>
<? if ($count > 0 && $related_products[0] != "") {?>
<table width="100%" cellpadding="5" cellspacing="0">
<tr>
	<td <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <div align="center"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b>Related Product(s)</b></font></div></td>
</tr>
<tr>
	<td>
		<table width="100%" cellpadding="5" cellspacing="5">
			<? for($i=0;$i<$count;$i++) {?>
			<? if ($related_products[$i] != "") {?>	
			<? $rel_prod = $related_product->getProduct($related_products[$i]);?>
			<? if ($i%4 == 0) {?>
			<tr>
			<? }?>
				<td valign="top" width="180">
					<table width="100%">
						<tr>
							<td valign="top"> 
							<a href="mystore.php?Page=Product&Category=<?=urlencode($rel_prod["main_cat"])?>&SubCategory1=<?=urlencode($rel_prod["sub_cat_1"])?>&SubCategory2=<?=urlencode($rel_prod["sub_cat_2"])?>&ProductId=<?=$rel_prod["id"]?>"><img src="<? if ($rel_prod["img_sm"] != "") {?><?=$rel_prod["img_sm"]?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" width="<? if (WebContent::getPropertyValue("img_sm_w") == "") {?>75<? } else {?><?=WebContent::getPropertyValue("img_sm_w")?><? }?>" <? if (WebContent::getPropertyValue("img_sm_h") != "") {?>height="<?=WebContent::getPropertyValue("img_sm_h")?>"<? }?>></a> 
							</td>
							<td valign="top">
							<a class="InstantLink" href="mystore.php?Page=Product&Category=<?=urlencode($rel_prod["main_cat"])?>&SubCategory1=<?=urlencode($rel_prod["sub_cat_1"])?>&SubCategory2=<?=urlencode($rel_prod["sub_cat_2"])?>&ProductId=<?=$rel_prod["id"]?>"><b><?=$rel_prod["name"]?></b></a>
							</td>
						</tr>
					</table>
				</td>
			<? if ($i%4 == 3 || $i == $count-1) {?>
			</tr>
			<? }?>
			<? }?>
			<? }?>
		</table>
	</td>
</tr>
</table>
<? }?>