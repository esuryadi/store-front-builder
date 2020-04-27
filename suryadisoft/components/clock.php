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
$name = "clock_applet" . $id . "_";
$component_properties = WebContent::getComponentProperties("Clock Applet");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$width = (WebContent::getPropertyValue($name . "width") != "")?WebContent::getPropertyValue($name . "width"):$prop["width"];
$height = (WebContent::getPropertyValue($name . "height") != "")?WebContent::getPropertyValue($name . "height"):$prop["height"];
$font_type = (WebContent::getPropertyValue($name . "font_type") != "")?WebContent::getPropertyValue($name . "font_type"):$prop["font_type"];
$font_style = (WebContent::getPropertyValue($name . "font_style") != "")?WebContent::getPropertyValue($name . "font_style"):$prop["font_style"];
$font_size = (WebContent::getPropertyValue($name . "font_size") != "")?WebContent::getPropertyValue($name . "font_size"):$prop["font_size"];
$foreground = (WebContent::getPropertyValue($name . "foreground") != "")?WebContent::getPropertyValue($name . "foreground"):$prop["foreground"];
$background = (WebContent::getPropertyValue($name . "background") != "")?WebContent::getPropertyValue($name . "background"):$prop["background"];
$base_url = (WebContent::getPropertyValue($name . "base_url") != "")?WebContent::getPropertyValue($name . "base_url"):$prop["base_url"];
$clock_display = (WebContent::getPropertyValue($name . "clock_display") != "")?WebContent::getPropertyValue($name . "clock_display"):$prop["clock_display"];
$clock_type = (WebContent::getPropertyValue($name . "clock_type") != "")?WebContent::getPropertyValue($name . "clock_type"):$prop["clock_type"];
$digital_style = (WebContent::getPropertyValue($name . "digital_style") != "")?WebContent::getPropertyValue($name . "digital_style"):$prop["digital_style"];
$date_style = (WebContent::getPropertyValue($name . "date_style") != "")?WebContent::getPropertyValue($name . "date_style"):$prop["date_style"];
$alarm_time = (WebContent::getPropertyValue($name . "alarm_time") != "")?WebContent::getPropertyValue($name . "alarm_time"):$prop["alarm_time"];
$alarm_sound = (WebContent::getPropertyValue($name . "alarm_sound") != "")?WebContent::getPropertyValue($name . "alarm_sound"):$prop["alarm_sound"];
$border_status = (WebContent::getPropertyValue($name . "border_status") != "")?WebContent::getPropertyValue($name . "border_status"):$prop["border_status"];
$border_size = (WebContent::getPropertyValue($name . "border_size") != "")?WebContent::getPropertyValue($name . "border_size"):$prop["border_size"];
$border_color = (WebContent::getPropertyValue($name . "border_color") != "")?WebContent::getPropertyValue($name . "border_color"):$prop["border_color"];
$border_3d = (WebContent::getPropertyValue($name . "border3d") != "")?WebContent::getPropertyValue($name . "border3d"):$prop["border3d"];
$img_background = (WebContent::getPropertyValue($name . "img_background") != "")?WebContent::getPropertyValue($name . "img_background"):$prop["img_background"];
$bg_sound = (WebContent::getPropertyValue($name . "bg_sound") != "")?WebContent::getPropertyValue($name . "bg_sound"):$prop["bg_sound"];
$clock_frame = (WebContent::getPropertyValue($name . "clock_frame") != "")?WebContent::getPropertyValue($name . "clock_frame"):$prop["clock_frame"];
?>
<center>
<applet code=com.suryadisoft.applet.clock.EdClock codebase="http://suryadisoft.net/class" archive="suryadisoft.jar" name=EdClock width=<?=$width?> height=<?=$height?>>
<? if ($font_type != "") {?>
<param name=FONT_TYPE value="<?=$font_type?>">
<? }?>
<? if ($font_style != "") {?>
<param name=FONT_STYLE value="<?=$font_style?>">
<? }?>
<? if ($font_size != "") {?>
<param name=FONT_SIZE value="<?=$font_size?>">
<? }?>
<? if ($foreground != "") {?>
<param name=FOREGROUND value="<?=$foreground?>">
<? }?>
<? if ($background != "") {?>
<param name=BACKGROUND value="<?=$background?>">
<? }?>
<? if ($base_url != "") {?>
<param name=BASE_URL value="<?=$base_url?>">
<? }?>
<? if ($clock_display != "") {?>
<param name=CLOCK_DISPLAY value="<?=$clock_display?>">
<? }?>
<? if ($clock_type != "") {?>
<param name=CLOCK_TYPE value="<?=$clock_type?>">
<? }?>
<? if ($digital_style != "") {?>
<param name=DIGITAL_STYLE value="<?=$digital_style?>">
<? }?>
<? if ($date_style != "") {?>
<param name=DATE_STYLE value="<?=$date_style?>">
<? }?>
<? if ($alarm_time != "") {?>
<param name=ALARM_TIME value="<?=$alarm_time?>">
<? }?>
<? if ($alarm_sound != "") {?>
<param name=ALARM_SOUND value="<?=$alarm_sound?>">
<? }?>
<? if ($border_status != "") {?>
<param name=BORDER_STATUS value="<?=$border_status?>">
<? }?>
<? if ($border_size != "") {?>
<param name=BORDER_SIZE value="<?=$border_size?>">
<? }?>
<? if ($border_color != "") {?>
<param name=BORDER_COLOR value="<?=$border_color?>">
<? }?>
<? if ($border_3d != "") {?>
<param name=3DBORDER value="<?=$border_3d?>">
<? }?>
<? if ($img_background != "") {?>
<param name=IMG_BACKGROUND value="<?=$img_background?>">
<? }?>
<? if ($bg_sound != "") {?>
<param name=BG_SOUND value="<?=$bg_sound?>">
<? }?>
<? if ($clock_frame != "") {?>
<param name=CLOCK_FRAME value="<?=$clock_frame?>">
<? }?>
</applet>
</center>
