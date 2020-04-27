<style type="text/css">
.cursor {
	cursor: hand
}

body {  
	font-family: <?=WebContent::getPropertyValue("techno_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("techno_font_size")?>; 
	color: <?=WebContent::getPropertyValue("techno_font_color")?>
}

td {  
	font-family: <?=WebContent::getPropertyValue("techno_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("techno_font_size")?>; 
	color: <?=WebContent::getPropertyValue("techno_font_color")?>
}

.tabfont {  
	font-family: <?=WebContent::getPropertyValue("techno_tab_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("techno_tab_font_size")?>; 
	color: <?=WebContent::getPropertyValue("techno_tab_font_color")?>
}

.tableheaderfont {  
	font-family: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_size")?>; 
	color: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>
}
</style>