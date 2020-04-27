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
$name = "photo_viewer_applet" . $id . "_";
$component_properties = WebContent::getComponentProperties("Photo Viewer Applet");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$width = (WebContent::getPropertyValue($name . "width") != "")?WebContent::getPropertyValue($name . "width"):$prop["width"];
$height = (WebContent::getPropertyValue($name . "height") != "")?WebContent::getPropertyValue($name . "height"):$prop["height"];
$background = (WebContent::getPropertyValue($name . "background") != "")?WebContent::getPropertyValue($name . "background"):$prop["background"];
$img_url_base = (WebContent::getPropertyValue($name . "img_url_base") != "")?WebContent::getPropertyValue($name . "img_url_base"):$prop["img_url_base"];
$images = Array();
$images = (WebContent::getPropertyValue($name . "photo") != "")?explode(";",WebContent::getPropertyValue($name . "photo")):explode(";",$prop["photo"]);
$label = Array();
$label = (WebContent::getPropertyValue($name . "photo_label") != "")?explode(";",WebContent::getPropertyValue($name . "photo_label")):explode(";",$prop["photo_label"]);
$url = Array();
$url = (WebContent::getPropertyValue($name . "url") != "")?explode(";",WebContent::getPropertyValue($name . "url")):explode(";",$prop["url"]);
$url_target = (WebContent::getPropertyValue($name . "url_target") != "")?WebContent::getPropertyValue($name . "url_target"):$prop["url_target"];
$title = (WebContent::getPropertyValue($name . "title") != "")?WebContent::getPropertyValue($name . "title"):$prop["title"];
$title_bgcolor = (WebContent::getPropertyValue($name . "title_bgcolor") != "")?WebContent::getPropertyValue($name . "title_bgcolor"):$prop["title_bgcolor"];
$title_font = (WebContent::getPropertyValue($name . "title_font") != "")?WebContent::getPropertyValue($name . "title_font"):$prop["title_font"];
$title_fontcolor = (WebContent::getPropertyValue($name . "title_fontcolor") != "")?WebContent::getPropertyValue($name . "title_fontcolor"):$prop["title_fontcolor"];
$border_color = (WebContent::getPropertyValue($name . "border_color") != "")?WebContent::getPropertyValue($name . "border_color"):$prop["border_color"];
$button_bgcolor = (WebContent::getPropertyValue($name . "button_bgcolor") != "")?WebContent::getPropertyValue($name . "button_bgcolor"):$prop["button_bgcolor"];
$no_border = (WebContent::getPropertyValue($name . "no_border") != "")?WebContent::getPropertyValue($name . "no_border"):$prop["no_border"];
$no_title = (WebContent::getPropertyValue($name . "no_title") != "")?WebContent::getPropertyValue($name . "no_title"):$prop["no_title"];
$no_label = (WebContent::getPropertyValue($name . "no_label") != "")?WebContent::getPropertyValue($name . "no_label"):$prop["no_label"];
$no_control_panel = (WebContent::getPropertyValue($name . "no_control_panel") != "")?WebContent::getPropertyValue($name . "no_control_panel"):$prop["no_control_panel"];
$no_scroll_bar = (WebContent::getPropertyValue($name . "no_scroll_bar") != "")?WebContent::getPropertyValue($name . "no_scroll_bar"):$prop["no_scroll_bar"];
$loop = (WebContent::getPropertyValue($name . "loop") != "")?WebContent::getPropertyValue($name . "loop"):$prop["loop"];
$frame_rate = (WebContent::getPropertyValue($name . "frame_rate") != "")?WebContent::getPropertyValue($name . "frame_rate"):$prop["frame_rate"];
?>
<center>
<applet code=com.suryadisoft.applet.imagesviewer.PhotoViewer codebase="<?=_URLPATH?>class" archive="suryadisoft.jar" name=PhotoViewer width=<?=$width?> height=<?=$height?>>
<? if ($background != "") {?>
<param name=BACKGROUND value="<?=$background?>">
<? }?>
<? if (count($images) > 0) {?>
<? for($z=0;$z<count($images);$z++) {?>
<param name=PHOTO<?=$z?> value="<?=_URLPATH?><? if (substr(_USER,0,5) == "trial") {?>trial/<? } else {?>client_img_src/<? }?><?=_USER?>/images/<?=$images[$z]?>">
<? }?>
<? }?>
<? if (count($label) > 0) {?>
<? for($z=0;$z<count($label);$z++) {?>
<param name=PHOTO_LABEL<?=$z?> value="<?=$label[$z]?>">
<? }?>
<? }?>
<? if (count($url) > 0) {?>
<? for($z=0;$z<count($url);$z++) {?>
<param name=URL<?=$z?> value="<?=$url[$z]?>">
<? }?>
<? }?>
<? if ($url_target != "") {?>
<param name=URL_TARGET value="<?=$url_target?>">
<? }?>
<? if ($title != "") {?>
<param name=TITLE value="<?=$title?>">
<? }?>
<? if ($title_bgcolor != "") {?>
<param name=TITLE_BGCOLOR value="<?=$title_bgcolor?>">
<? }?>
<? if ($title_font != "") {?>
<param name=TITLE_FONT value="<?=$title_font?>">
<? }?>
<? if ($title_fontcolor != "") {?>
<param name=TITLE_FONTCOLOR value="<?=$title_fontcolor?>">
<? }?>
<? if ($border_color != "") {?>
<param name=BORDER_COLOR value="<?=$border_color?>">
<? }?>
<? if ($button_bgcolor != "") {?>
<param name=BUTTON_BGCOLOR value="<?=$button_bgcolor?>">
<? }?>
<? if ($no_border != "") {?>
<param name=NO_BORDER value="<?=$no_border?>">
<? }?>
<? if ($no_title != "") {?>
<param name=NO_TITLE value="<?=$no_title?>">
<? }?>
<? if ($no_label != "") {?>
<param name=NO_LABEL value="<?=$no_label?>">
<? }?>
<? if ($no_control_panel != "") {?>
<param name=NO_CONTROL_PANEL value="<?=$no_control_panel?>">
<? }?>
<? if ($no_control_panel != "") {?>
<param name=NO_SCROLL_BAR value="<?=$no_scroll_bar?>">
<? }?>
<? if ($loop != "") {?>
<param name=LOOP value="<?=$loop?>">
<? }?>
<? if ($frame_rate != "") {?>
<param name=FRAME_RATE value="<?=$frame_rate?>">
<? }?>
</applet>
</center>
