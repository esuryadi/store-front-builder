<style type="text/css">

.menulink:link { color:<?=WebContent::getPropertyValue("outlook_2_tab_font_color")?>; text-decoration:none; padding:0 0 0 0 }
.menulink:visited { color:<?=WebContent::getPropertyValue("outlook_2_tab_font_color")?>; text-decoration:none; padding:0 0 0 0; }  
.menulink:active { color:<?=WebContent::getPropertyValue("outlook_2_tab_font_color")?>; text-decoration:none; padding:0 0 0 0; }
.menulink:hover { color:<?=WebContent::getPropertyValue("outlook_2_tab_font_color")?>; text-decoration:none; padding:0 0 0 0; }

td.active {
	background-color: <?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_1")?>
}

td.inactive {
	background-color: <?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_2")?>
}

td.over {
	background-color: <?=WebContent::getPropertyValue("outlook_2_menu_bgcolor_1")?>
}

.cursor {
	cursor: hand
}

body {  
	font-family: <?=WebContent::getPropertyValue("outlook_2_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("outlook_2_font_size")?>; 
	color: <?=WebContent::getPropertyValue("outlook_2_font_color")?>
}

td {  
	font-family: <?=WebContent::getPropertyValue("outlook_2_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("outlook_2_font_size")?>; 
	color: <?=WebContent::getPropertyValue("outlook_2_font_color")?>
}

.tabfont {  
	font-family: <?=WebContent::getPropertyValue("outlook_2_tab_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("outlook_2_tab_font_size")?>; 
	color: <?=WebContent::getPropertyValue("outlook_2_tab_font_color")?>
}

.tableheaderfont {  
	font-family: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_size")?>; 
	color: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>
}

.show	{ position: absolute; visibility: visible; left:116px; top:95px; width:156px; height:170px; z-index:1}
.hide { position: absolute; visibility: hidden; left:116px; top:95px; width:156px; height:170px; z-index:1}

</style>