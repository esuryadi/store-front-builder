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
$name = "image" . $id . "_";
$component_properties = WebContent::getComponentProperties("Image");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$img_src = (WebContent::getPropertyValue($name . "image_source") != "")?WebContent::getPropertyValue($name . "image_source"):$prop["image_source"];
$img_align = (WebContent::getPropertyValue($name . "align") != "")?WebContent::getPropertyValue($name . "align"):$prop["align"];
$img_border = (WebContent::getPropertyValue($name . "border") != "")?WebContent::getPropertyValue($name . "border"):$prop["border"];
$img_alt = (WebContent::getPropertyValue($name . "alt") != "")?WebContent::getPropertyValue($name . "alt"):$prop["alt"];
$img_width = (WebContent::getPropertyValue($name . "width") != "")?WebContent::getPropertyValue($name . "width"):$prop["width"];
$img_height = (WebContent::getPropertyValue($name . "height") != "")?WebContent::getPropertyValue($name . "height"):$prop["height"];
$img_hspace = (WebContent::getPropertyValue($name . "horizontal_space") != "")?WebContent::getPropertyValue($name . "horizontal_space"):$prop["horizontal_space"];
$img_vspace = (WebContent::getPropertyValue($name . "vertical_space") != "")?WebContent::getPropertyValue($name . "vertical_space"):$prop["vertical_space"];
$img_url = (WebContent::getPropertyValue($name . "url_link") != "")?WebContent::getPropertyValue($name . "url_link"):$prop["url_link"];
?>
<? if ($img_url != "") {?>
<a href="<?=$img_url?>">
<? }?>
<? if ($img_src != "") {?>
<? if ($img_align == "center") {?>
<center>
<? }?>
<img src="<?=$img_src?>" 
		 <? if ($img_align != "") {?>align="<?=$img_align?>"<? }?> 
		 <? if ($img_border != "") {?>border="<?=$img_border?>"<? }?> 
		 <? if ($img_alt != "") {?>alt="<?=$img_alt?>"<? }?> 
		 <? if ($img_width != "") {?>width="<?=$img_width?>"<? }?> 
		 <? if ($img_height != "") {?>height="<?=$img_height?>"<? }?> 
		 <? if ($img_hspace != "") {?>hspace="<?=$img_hspace?>"<? }?> 
		 <? if ($img_vspace != "") {?>vspace="<?=$img_vspace?>"><? }?>
<? if ($img_align == "center") {?>
</center>
<? }?>
<? }?> 
<? if ($img_url != "") {?>
</a>
<? }?>