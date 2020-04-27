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
$name = "ticker_applet" . $id . "_";
$component_properties = WebContent::getComponentProperties("Ticker Applet");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$width = (WebContent::getPropertyValue($name . "width") != "")?WebContent::getPropertyValue($name . "width"):$prop["width"];
$height = (WebContent::getPropertyValue($name . "height") != "")?WebContent::getPropertyValue($name . "height"):$prop["height"];
$text = (WebContent::getPropertyValue($name . "text") != "")?WebContent::getPropertyValue($name . "text"):$prop["text"];
$font_type = (WebContent::getPropertyValue($name . "font_type") != "")?WebContent::getPropertyValue($name . "font_type"):$prop["font_type"];
$font_style = (WebContent::getPropertyValue($name . "font_style") != "")?WebContent::getPropertyValue($name . "font_style"):$prop["font_style"];
$font_size = (WebContent::getPropertyValue($name . "font_size") != "")?WebContent::getPropertyValue($name . "font_size"):$prop["font_size"];
$font_color = (WebContent::getPropertyValue($name . "font_color") != "")?WebContent::getPropertyValue($name . "font_color"):$prop["font_color"];
$background = (WebContent::getPropertyValue($name . "background") != "")?WebContent::getPropertyValue($name . "background"):$prop["background"];
$no_border = (WebContent::getPropertyValue($name . "no_border") != "")?WebContent::getPropertyValue($name . "no_border"):$prop["no_border"];
$border_size = (WebContent::getPropertyValue($name . "border_size") != "")?WebContent::getPropertyValue($name . "border_size"):$prop["border_size"];
$border_color = (WebContent::getPropertyValue($name . "border_color") != "")?WebContent::getPropertyValue($name . "border_color"):$prop["border_color"];
$url_link = (WebContent::getPropertyValue($name . "url_link") != "")?WebContent::getPropertyValue($name . "url_link"):$prop["url_link"];
$url_target = (WebContent::getPropertyValue($name . "url_target") != "")?WebContent::getPropertyValue($name . "url_target"):$prop["url_target"];
$speed = (WebContent::getPropertyValue($name . "speed") != "")?WebContent::getPropertyValue($name . "speed"):$prop["speed"];
$type = (WebContent::getPropertyValue($name . "type") != "")?WebContent::getPropertyValue($name . "type"):$prop["type"];
$img_url_base = (WebContent::getPropertyValue($name . "img_url_base") != "")?WebContent::getPropertyValue($name . "img_url_base"):$prop["img_url_base"];
$show_button = (WebContent::getPropertyValue($name . "show_button") != "")?WebContent::getPropertyValue($name . "show_button"):$prop["show_button"];
$images = Array();
$images = (WebContent::getPropertyValue($name . "images") != "")?explode(";",WebContent::getPropertyValue($name . "images")):explode(";",$prop["images"]);
$img_url_link = Array();
$img_url_link = (WebContent::getPropertyValue($name . "img_url_link") != "")?explode(";",WebContent::getPropertyValue($name . "img_url_link")):explode(";",$prop["img_url_link"]);
?>
<center>
<applet code=com.suryadisoft.applet.EdTicker codebase="<?=_URLPATH?>class" archive="suryadisoft.jar" name=EdTicker width=<?=$width?> height=<?=$height?>>
<? if ($text != "") {?>
<param name=TEXT value="<?=$text?>">
<? }?>
<? if ($font_type != "") {?>
<param name=FONT_TYPE value="<?=$font_type?>">
<? }?>
<? if ($font_style != "") {?>
<param name=FONT_STYLE value="<?=$font_style?>">
<? }?>
<? if ($font_size != "") {?>
<param name=FONT_SIZE value="<?=$font_size?>">
<? }?>
<? if ($font_color != "") {?>
<param name=FONT_COLOR value="<?=$font_color?>">
<? }?>
<? if ($background != "") {?>
<param name=BACKGROUND value="<?=$background?>">
<? }?>
<? if ($no_border != "") {?>
<param name=NO_BORDER value="<?=$no_border?>">
<? }?>
<? if ($border_size != "") {?>
<param name=BORDER_SIZE value="<?=$border_size?>">
<? }?>
<? if ($border_color != "") {?>
<param name=BORDER_COLOR value="<?=$border_color?>">
<? }?>
<? if ($url_link != "") {?>
<param name=URL_LINK value="<?=$url_link?>">
<? }?>
<? if ($url_target != "") {?>
<param name=URL_TARGET value="<?=$url_target?>">
<? }?>
<? if ($speed != "") {?>
<param name=SPEED value="<?=$speed?>">
<? }?>
<? if ($type != "") {?>
<param name=TYPE value="<?=$type?>">
<? }?>
<? if ($show_button != "") {?>
<param name=SHOW_BUTTON value="<?=$show_button?>">
<? }?>
<? if (count($images) > 0) {?>
<? for($z=0;$z<count($images);$z++) {?>
<? if ($images[$z] != "") {?>
<param name=IMAGE<?=$z?> value="<?=_URLPATH?><? if (substr(_USER,0,5) == "trial") {?>trial/<? } else {?>client_img_src/<? }?><?=_USER?>/images/<?=$images[$z]?>">
<? }?>
<? }?>
<? }?>
<? if (count($img_url_link) > 0) {?>
<? for($z=0;$z<count($img_url_link);$z++) {?>
<? if ($img_url_link[$z] != "") {?>
<param name=IMAGE_URL_LINK<?=$z?> value="<?=$img_url_link[$z]?>">
<? }?>
<? }?>
<? }?>
</applet>
</center>
