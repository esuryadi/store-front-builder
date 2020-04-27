<style type="text/css">
.cursor {
	cursor: hand
}

body {  
	font-family: <?=WebContent::getPropertyValue("stylish_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("stylish_font_size")?>; 
	color: <?=WebContent::getPropertyValue("stylish_font_color")?>
}

td {  
	font-family: <?=WebContent::getPropertyValue("stylish_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("stylish_font_size")?>; 
	color: <?=WebContent::getPropertyValue("stylish_font_color")?>
}

.tabfont {  
	font-family: <?=WebContent::getPropertyValue("stylish_tab_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("stylish_tab_font_size")?>; 
	color: <?=WebContent::getPropertyValue("stylish_tab_font_color")?>
}

.tableheaderfont {  
	font-family: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_size")?>; 
	color: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>
}

.show	{ position: absolute; visibility: visible; left:116px; top:95px; width:156px; height:170px; z-index:1}
.hide { position: absolute; visibility: hidden; left:116px; top:95px; width:156px; height:170px; z-index:1}

</style>