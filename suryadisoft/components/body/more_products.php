<?php
$Title = str_replace("_","&",urldecode($Title));
$product = new Product();
if (isset($HTTP_COOKIE_VARS["user"])) 
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
$product->setUser((isset($user))?$user:"");
if (!isset($SubCategory1))
	$SubCategory1 = "";
else
	$SubCategory1 = urldecode($SubCategory1);
if (!isset($SubCategory2))
	$SubCategory2 = "";
else
	$SubCategory2 = urldecode($SubCategory2);
	
if ($ProductType == "AllProducts")
	$product->getAllProducts((isset($user))?$user:"",urldecode($Category),urldecode($SubCategory1),urldecode($SubCategory2));
else if ($ProductType == "NewItems")
	$product->getNewItems((isset($user))?$user:"",urldecode($Category),urldecode($SubCategory1),urldecode($SubCategory2));
else if ($ProductType == "UsedItems")
	$product->getUsedItems((isset($user))?$user:"",urldecode($Category),urldecode($SubCategory1),urldecode($SubCategory2));
else if ($ProductType == "RefurbishedItems")
	$product->getRefurbishedItems((isset($user))?$user:"",urldecode($Category),urldecode($SubCategory1),urldecode($SubCategory2));
else if ($ProductType == "ProductGroup")
	$product->getProductGroup((isset($user))?$user:"",stripslashes($Title),urldecode($Category),urldecode($SubCategory1),urldecode($SubCategory2));
?>
<p>
<center><font size="+1"><strong>
	<? if (isset($Title) && $Title != "") {?><?=stripslashes($Title)?><? } else {?>Products<? }?>
</strong></font></center>
<p>
<? if ($Style == "ImagesList") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<center>
<table border="0" cellspacing="0" cellpadding="10">
<tr>
	<td>
		<table width="100%" cellpadding="5" cellspacing="5">
			<? for($i=$start;$i<$end;$i++) {?>
			<tr>
				<td valign="top"> <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getSmallImage($i) != "") {?><?=$product->getSmallImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_sm_img") == "") {?>height="75"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? }?>></a> 
				</td>
				<td valign="top">
				<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b><?=$product->getProductName($i)?></b></a>
				<br><?=substr($product->getProductDescription($i),0,100)?> <? if(strlen($product->getProductDescription($i)) > 100) {?>... <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>">(more)</a><? }?>
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
		<hr>
		<center>
		<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ImagesList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ImagesList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
		<? for($i=0;$i<$total_page;$i++) {?>
		| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ImagesList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
		<? }?>
		| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ImagesList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
		</center>
	</td>
</tr>
</table>
</center>
<? } else if ($Style == "PlainList") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems5)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<table border="0" cellspacing="0" cellpadding="10">
	<tr>
		<td>
			<? for($i=$start;$i<$end;$i++) {?>
			<table>
			<tr>
				<td valign="top"><li></li></td>
				<td>
				<a class="InstantLink" href="mystore.php?Page=Product&ProductId=<?=$product->getProductId($i)?>">
				<?=$product->getProductName($i)?>
				</a>
				</td>
			</tr>
			</table>
			<? }?>
			<hr>
			<center>
			<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=PlainList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=PlainList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
			<? for($i=0;$i<$total_page;$i++) {?>
			| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=PlainList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
			<? }?>
			| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=PlainList&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
			</center>
		</td>
	</tr>
</table>
<? } else if ($Style == "ExpressCheckOut") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems5)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
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
			<? for($i=$start;$i<$end;$i++) {
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
			<hr>
			<center>
			<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ExpressCheckOut&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ExpressCheckOut&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
			<? for($i=0;$i<$total_page;$i++) {?>
			| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ExpressCheckOut&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
			<? }?>
			| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=ExpressCheckOut&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
			</center>
		</td>
	</tr>
</table>
</form>
<? } else if ($Style == "TableImages") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<center>
<table cellpadding="5" cellspacing="5">
	<? for($i=$start;$i<$end;$i++) {?>
	<? if ($i%$NumCol == 0) {?>
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
					<td colspan="2" nowrap>Retail Price: $<? printf("%01.2f",$product->getRetailPrice($i));?></td>
				</tr>
				<? }?>
				<tr>
					<td colspan="2" ><font color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><strong><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price:</strong> $<? printf("%01.2f",$product->getPrice($i));?></font></td>
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
	<? if ($i%$NumCol == ($NumCol-1) || $i == $end-1) {?>
	</tr>
	<? }?>
	<? }?>
</table>
</center>
<hr>
<center>
<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
<? for($i=0;$i<$total_page;$i++) {?>
| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
<? }?>
| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
</center>
<? } else if ($Style == "TableImages2") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<center>
<table cellpadding="5" cellspacing="0">
	<? for($i=$start;$i<$end;$i++) {?>
	<? if ($i%$NumCol == 0) {?>
	<tr>
	<? }?>
		<td valign="top" width="250">
			<form name="AddToCart" method="get" action="mystore.php">
			<input type="hidden" name="Page" value="ShoppingCart">
			<input type="hidden" name="Action" value="Add">
			<input type="hidden" name="ProductId" value="<?=$product->getProductId($i)?>">
			<table width="100%">
				<tr>
					<td align="center" colspan="2" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
					<a class="InstantLink" href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b><?=$product->getProductName($i)?></b></font></a>
					</td>
				</tr>
				<tr>
					<td valign="top"> 
					<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getSmallImage($i) != "") {?><?=$product->getSmallImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_sm_img") == "") {?>height="75"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? }?>></a> 
					</td>
					<td valign="center">
						<table cellpadding="1" cellspacing="0">
						<? if ($product->getColors($i) != "") {
							$color = explode(",",$product->getColors($i));?>
						<tr>
							<td nowrap>							
								Color:
								<select name="Color">
								<? for($n=0;$n<count($color);$n++) {?>
								<option value="<?=$color[$n]?>"><?=$color[$n]?></option>
								<? }?>
								</select>
							</td>
						</tr>
						<? }?>
						<? if ($product->getSizes($i) != "") {
							$size = explode(",",$product->getSizes($i));?>
						<tr>
							<td nowrap>
							Size:         
							<select name="Size">
							<? for($n=0;$n<count($size);$n++) {?>
							<option value="<?=$size[$n]?>"><?=$size[$n]?></option>
							<? }?>
							</select>
							</td>
						</tr>
						<? }?>
						<? if ($product->getChoices($i) != "") {
							$choices = explode(",",$product->getChoices($i));?>
						<tr>
							<td nowrap>
							Choices:
							<select name="Choice">
							<? for($n=0;$n<count($choices);$n++) {?>
							<option value="<?=$choices[$n]?>"><?=$choices[$n]?></option>
							<? }?>
							</select>
							</td>
						</tr>
						<? }?>
						<tr>
							<td nowrap>Quantity: <input name="Quantity" type="text" value="1" size="1"></td>
						</tr>
						<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>
						<tr>
							<td nowrap>Retail Price: $<? printf("%01.2f",$product->getRetailPrice($i));?></td>
						</tr>
						<? }?>
						<tr>
							<td nowrap><font color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price: $<? printf("%01.2f",$product->getPrice($i));?></font></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
					<? if (array_search("Shopping Cart",$comp) > -1) {?>
						<a class="InstantLink" href="#" onClick="submit();"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong>Buy Now</strong></font></a>
					<? }?>
					</td>
				</tr>
			</table>
			</form>
		</td>
	<? if ($i%$NumCol == ($NumCol-1) || $i == $end-1) {?>
	</tr>
	<? }?>
	<? }?>
</table>
</center>
<hr>
<center>
<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
<? for($i=0;$i<$total_page;$i++) {?>
| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
<? }?>
| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
</center>
<? } else if ($Style == "TableImages3") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<center>
<table cellpadding="5" cellspacing="0">
	<? $n = 0;?>
	<? for($i=$start;$i<$end;$i++) {?>
	<? if ($n%$NumCol == 0) {?>
	<tr>
	<? }?>
		<td valign="top" width="250">
			<table width="100%">
				<tr>
					<td align="center" colspan="2" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
					<a class="InstantLink" href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><b><?=$product->getProductName($i)?></b></font></a>
					</td>
				</tr>
				<tr>
					<td valign="top"> 
					<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getSmallImage($i) != "") {?><?=$product->getSmallImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_sm_img") == "") {?>height="75"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_sm_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_sm_img_value")?>"<? }?>></a> 
					</td>
					<td valign="center">
						<table cellpadding="1" cellspacing="0">
						<tr>
							<td><?=substr($product->getProductDescription($i),0,80)?> <? if(strlen($product->getProductDescription($i)) > 100) {?>... <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>">(more)</a><? }?></td>
						</tr>						
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>
						<font size=-2>Retail Price: $<? printf("%01.2f",$product->getRetailPrice($i));?></font><br>
					<? }?>
					<font size=-2 color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price: $<? printf("%01.2f",$product->getPrice($i));?></font>
					</td>
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
	<? if ($n%$NumCol == ($NumCol-1) || $i == $end-1) {?>
	</tr>
	<? }?>
	<? $n++;?>
	<? }?>
</table>
</center>
<hr>
<center>
<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages3&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages3&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
<? for($i=0;$i<$total_page;$i++) {?>
| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages3&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
<? }?>
| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=TableImages3&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
</center>
<? } else if ($Style == "Headlines") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<center>
<table cellpadding="5" cellspacing="5">
	<? $n = 0;?>
	<? for($i=$start;$i<$end;$i++) {?>
	<form name="AddToCart" method="get" action="mystore.php">
	<input type="hidden" name="Page" value="ShoppingCart">
	<input type="hidden" name="Action" value="Add">
	<input type="hidden" name="ProductId" value="<?=$product->getProductId($i)?>">
	<? if ($n%$NumCol == 0) {?>
	<tr>
	<? }?>
		<td valign="top"> <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getMediumImage($i) != "") {?><?=$product->getMediumImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_md.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_md_img") == "") {?>height="200"<? } else if (WebContent::getPropertyValue("resize_md_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_md_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? }?>></a> 
		</td>
		<td valign="top">
		<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b><?=$product->getProductName($i)?></b></a>
		<br><?=substr($product->getProductDescription($i),0,100)?> <? if(strlen($product->getProductDescription($i)) > 100) {?>... <a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>">(more)</a><? }?>
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
	<? if ($n%$NumCol == ($NumCol-1) || $i == $end-1) {?>
	</tr>
	<? }?>
	<? $n++;?>
	</form>
	<? }?>
</table>
</center>
<hr>
<center>
<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
<? for($i=0;$i<$total_page;$i++) {?>
| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
<? }?>
| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
</center>
<? } else if ($Style == "Headlines2") {
$total_page = ceil(($product->getCount() - $Count)/$NumShowItems);
if (!isset($start))
	$start = $Count;
if (($product->getCount() - $start) > $NumShowItems)
	$end = $start + $NumShowItems;
else
	$end = $product->getCount();
if (!isset($PageNo))
	$PageNo = 2;
?>
<center>
<table cellpadding="5" cellspacing="5">
	<? for($i=$start;$i<$end;$i++) {?>
	<? if ($i%$NumCol == 0) {?>
	<tr>
	<? }?>
		<td valign="top">
			<table width="100%" cellpadding="3">
				<tr>
					<td align="center" colspan="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>4<? } else {?>2<? }?>"> 
					<a href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><img src="<? if ($product->getMediumImage($i) != "") {?><?=$product->getMediumImage($i)?><? } else {?>http://www.suryadisoft.net/images/blank_img_sm.gif<? }?>" border="0" <? if (WebContent::getPropertyValue("resize_md_img") == "") {?>height="150"<? } else if (WebContent::getPropertyValue("resize_md_img") == "width") {?>width="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? } else if (WebContent::getPropertyValue("resize_md_img") == "height") {?> height="<?=WebContent::getPropertyValue("resize_md_img_value")?>"<? }?>></a> 
					</td>
				</tr>
				<tr>
					<td align="center" colspan="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>4<? } else {?>2<? }?>">
					<a class="InstantLink" href="mystore.php?Page=Product&Category=<?=urlencode($product->getMainCategory($i))?>&SubCategory1=<?=urlencode($product->getSubCategory1($i))?>&SubCategory2=<?=urlencode($product->getSubCategory2($i))?>&ProductId=<?=$product->getProductId($i)?>"><b><?=$product->getProductName($i)?></b></a>
					</td>
				</tr>
				<tr>
				<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>
				<td width="25%"><font size="-2">Retail Price:</font></td> 
				<td width="25%" nowrap><font size="-2">$<? printf("%01.2f",$product->getRetailPrice($i));?></font></td>
				<? }?>
				<td width="25%"><font size="-2" color="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?><? if (WebContent::getPropertyValue("our_price_color") != "") {?><?=WebContent::getPropertyValue("our_price_color")?><? } else {?>#FF0000<? }?><? }?>"><strong><? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>Our <? }?>Price:</strong></font></td>
				<td width="25%" nowrap><font size="-2">$<? printf("%01.2f",$product->getPrice($i));?></font></td>
				</tr>
				<tr>
					<td align="center" colspan="<? if ($product->getRetailPrice($i) != "" && $product->getRetailPrice($i) > 0) {?>4<? } else {?>2<? }?>" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
					<? if (array_search("Shopping Cart",$comp) > -1) {?>
						<a class="InstantLink" href="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=ShoppingCart&Action=Add&ProductId=<?=$product->getProductId($i)?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong>Buy Now</strong></font></a>
					<? }?>
					</td>
				</tr>
			</table>
		</td>
	<? if ($i%$NumCol == ($NumCol-1) || $i == $end-1) {?>
	</tr>
	<? }?>
	<? }?>
</table>
</center>
<hr>
<center>
<? if ($PageNo != 1) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo-2))?>&PageNo=<?=($PageNo-1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Prev<? if ($PageNo != 1) {?></a><? }?> | <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=0&PageNo=1&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == 1) {?><font color="#FF0000"><? }?>1<? if ($PageNo == 1) {?></font><? }?></a>
<? for($i=0;$i<$total_page;$i++) {?>
| <a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($i+1))?>&PageNo=<?=($i+2)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? if ($PageNo == ($i + 2)) {?><font color="#FF0000"><? }?><?=($i+2)?><? if ($PageNo == ($i + 2)) {?></font><? }?></a> 
<? }?>
| <? if ($PageNo != ($total_page+1)) {?><a class="InstantLink" href="mystore.php?Page=MoreProducts&Style=Headlines2&Count=<?=$Count?>&NumShowItems=<?=$NumShowItems?>&NumCol=<?=$NumCol?>&start=<?=($Count*($PageNo))?>&PageNo=<?=($PageNo+1)?>&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($SubCategory1)?>&SubCategory2=<?=urlencode($SubCategory2)?>&ProductType=<?=$ProductType?>&Title=<?=str_replace("&","_",stripslashes($Title))?>"><? }?>Next<? if ($PageNo != ($total_page+1)) {?></a><? }?>
</center>
<? }?>
<p></p>