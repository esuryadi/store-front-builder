<style type="text/css">
<!--
.menulink:link { color:<?=WebContent::getPropertyValue("classic_tab_font_color")?>; text-decoration:none; padding:0 0 0 0 }
.menulink:visited { color:<?=WebContent::getPropertyValue("classic_tab_font_color")?>; text-decoration:none; padding:0 0 0 0; }  
.menulink:active { color:<?=WebContent::getPropertyValue("classic_tab_font_color")?>; text-decoration:none; padding:0 0 0 0; }
.menulink:hover { color:<?=WebContent::getPropertyValue("classic_tab_font_color")?>; text-decoration:none; padding:0 0 0 0; }

td.active {
	background-color: <? if (WebContent::getPropertyValue("classic_tab_active_color") != "") {?><?=$theme->getProperty("classic_tab_active_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Tab Active Color")?><? }?>
}
td.inactive {
	background-color: <? if (WebContent::getPropertyValue("classic_tab_inactive_color") != "") {?><?=$theme->getProperty("classic_tab_inactive_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Tab Inactive Color")?><? }?>
}
td.over {
	background-color: <? if (WebContent::getPropertyValue("classic_tab_over_color") != "") {?><?=$theme->getProperty("classic_tab_over_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Tab Over Color")?><? }?>
}
.cursor {
	cursor: hand
}

body {  
	font-family: <? if (WebContent::getPropertyValue("classic_font_face") != "") {?><?=WebContent::getPropertyValue("classic_font_face")?><? } else {?><?=$theme->getDefaultProperty("classic","Font Face")?><? }?>; 
	font-size: <? if (WebContent::getPropertyValue("classic_font_face") != "") {?><?=WebContent::getPropertyValue("classic_font_size")?><? } else {?><?=$theme->getDefaultProperty("classic","Font Size")?><? }?>; 
	color: <? if (WebContent::getPropertyValue("classic_font_color") != "") {?><? if (WebContent::getPropertyValue("classic_font_color") != "") {?><?=WebContent::getPropertyValue("classic_font_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Font Color")?><? }?><? } else {?><?=$theme->getDefaultProperty("classic","Font Color")?><? }?>
}

td {  
	font-family: <? if (WebContent::getPropertyValue("classic_font_face") != "") {?><?=WebContent::getPropertyValue("classic_font_face")?><? } else {?><?=$theme->getDefaultProperty("classic","Font Face")?><? }?>; 
	font-size: <? if (WebContent::getPropertyValue("classic_font_face") != "") {?><?=WebContent::getPropertyValue("classic_font_size")?><? } else {?><?=$theme->getDefaultProperty("classic","Font Size")?><? }?>; 
	color: <? if (WebContent::getPropertyValue("classic_font_color") != "") {?><? if (WebContent::getPropertyValue("classic_font_color") != "") {?><?=WebContent::getPropertyValue("classic_font_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Font Color")?><? }?><? } else {?><?=$theme->getDefaultProperty("classic","Font Color")?><? }?>
}

.tabfont {  
	font-family: <? if (WebContent::getPropertyValue("classic_tab_font_face") != "") {?><?=WebContent::getPropertyValue("classic_tab_font_face")?><? } else {?><?=$theme->getDefaultProperty("classic","Tab Font Face")?><? }?>; 
	font-size: <? if (WebContent::getPropertyValue("classic_tab_font_size") != "") {?><?=WebContent::getPropertyValue("classic_tab_font_size")?><? } else {?><?=$theme->getDefaultProperty("classic","Tab Font Size")?><? }?>; 
	color: <? if (WebContent::getPropertyValue("classic_tab_font_color") != "") {?><?=WebContent::getPropertyValue("classic_tab_font_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Tab Font Color")?><? }?>
}

.tableheaderfont {  
	font-family: <? if (WebContent::getPropertyValue("classic_table_header_font_face") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_face")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Font Face")?><? }?>; 
	font-size: <? if (WebContent::getPropertyValue("classic_table_header_font_size") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_size")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Font Size")?><? }?>; 
	color: <? if (WebContent::getPropertyValue("classic_table_header_font_color") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Font Color")?><? }?>
}
-->
</style>
