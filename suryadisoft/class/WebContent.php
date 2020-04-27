<?php
class WebContent
{
	var $dbconnect;
	var $section;
	var $id = Array();
	var $name = Array();
	var $title = Array();
	var $filename = Array();
	var $type = Array();
	var $component_type = Array();
	var $style = Array();
	var $content_count = 0;
	
	function WebContent($section,$category,$sub_category_1,$sub_category_2)
	{
		if ($category == "ALL")
			$category = "Home";
		else 
			$category = urldecode($category);
		$this->section = $section;
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$where_sql = "";
		if ($category != "")
			$where_sql = "CATEGORY = '$category'";
		if ($sub_category_1 != "")
			$where_sql = "CATEGORY = '$sub_category_1'";
		if ($sub_category_2 != "")
			$where_sql = "CATEGORY = '$sub_category_2'";
		$where_sql = $where_sql . " OR CATEGORY = 'All Category'";
		if ($where_sql != "")
			$where_sql = "AND (" . $where_sql . ")";	
		
		$query = "SELECT * FROM WEB_CONTENT WHERE POSITION = '$section' " . $where_sql . " ORDER BY SEQUENCE";
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$this->id [] = $rs[0];
			$this->name [] = $rs[1];
			$this->title [] = $rs[2];
			$this->filename [] = $rs[3];
			$this->type [] = $rs[4];
			$this->component_type [] = $rs[7];
			$this->style [] = $rs[9];
			$this->content_count = $i + 1;
		}		
		$dbconnect->close();
	}
	
	function getMainCategory()
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT CATEGORIES_MAIN FROM CATEGORIES LEFT JOIN MAIN_CATEGORY ON CATEGORY = CATEGORIES_MAIN GROUP BY CATEGORIES_MAIN ORDER BY SEQUENCE, CATEGORIES_ID";
		$query_result = mysql_query($query);
		$main_categories = Array();
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++)
			if ($rs[0] != "")
				$main_categories [] = $rs[0];
			
		$dbconnect->close();
		
		return $main_categories;
	}
	
	function getSubCategory1($main_categories)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT CATEGORIES_SUB_1 FROM CATEGORIES WHERE CATEGORIES_MAIN = '" . str_replace("'","''",$main_categories) . "' GROUP BY CATEGORIES_SUB_1 ORDER BY CATEGORIES_SUB_1";
		$query_result = mysql_query($query);
		$sub_categories_1 = Array();
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++)
			if ($rs[0] != "")
				$sub_categories_1 [] = $rs[0];
			
		$dbconnect->close();
		
		return $sub_categories_1;
	}
	
	function getSubCategory2($main_categories,$sub_categories_1)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT CATEGORIES_SUB_2 FROM CATEGORIES WHERE CATEGORIES_MAIN = '" . str_replace("'","''",$main_categories) . "' AND CATEGORIES_SUB_1 = '" . str_replace("'","''",$sub_categories_1) . "' GROUP BY CATEGORIES_SUB_2 ORDER BY CATEGORIES_SUB_2";
		$query_result = mysql_query($query);
		$sub_categories_2 = Array();
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++)
			if ($rs[0] != "")
				$sub_categories_2 [] = $rs[0];
			
		$dbconnect->close();

		return $sub_categories_2;
	}
	
	function getLinks($position)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT * FROM LINK WHERE link_position = '$position' ORDER BY sequence";
		$query_result = mysql_query($query);
		$links = array();
		for ($i=0;$rs = mysql_fetch_array($query_result);$i++) {
			$link ["type"] = $rs["link_type"];
			$link ["text"] = $rs["link_text"];
			$link ["img_src"] = $rs["link_img_src"];
			$link ["url"] = $rs["link_url"];
			$link ["target"] = $rs["link_target"];
			$links [] = $link;
		}
			
		$dbconnect->close();
		
		return $links;
	}
	
	function getPropertyValue($property_name)
	{
		if(defined("_DATABASE"))
			$database = _DATABASE;
		else 
			$database = _DB;
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db($database);
		$query = "SELECT PROPERTY_VALUE FROM PROPERTY WHERE PROPERTY_NAME = '$property_name'";
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$property_value = $rs[0];
		} else
			$property_value = "";
		$dbconnect->close();
		
		return $property_value;
	}
	
	function getBuiltInWebContent()
	{
		$web_contents = Array();
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT * FROM BUILT_IN_WEB_CONTENT order by component_name";
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$web_content ["component_name"] = $rs[1];
			$web_content ["title"] = $rs[2];
			$web_content ["filename"] = $rs[3];
			$web_content ["type"] = $rs[4];
			$web_content ["position"] = $rs[5];
			$web_content ["sequence"] = $rs[6];
			$web_content ["display_name"] = $rs[7];
			$web_content ["description"] = $rs[8];
			$web_contents [] = $web_content;
		}		
		$dbconnect->close();
		
		return $web_contents;
	}
	
	function getComponentStyleFilename($component_name,$design_style)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT filename FROM COMPONENT_DESIGN WHERE component_name = '$component_name' AND design_style = '$design_style'";
		$rs = mysql_fetch_row(mysql_query($query));
		$filename = $rs[0];
		$dbconnect->close();
		
		return $filename;
	}
	
	function getComponentStylePreviewImages($component_name,$design_style)
	{
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT preview_images FROM COMPONENT_DESIGN WHERE component_name = '$component_name' AND design_style = '$design_style'";
		$rs = mysql_fetch_row(mysql_query($query));
		$image_filename = $rs[0];
		$dbconnect->close();
		
		return $image_filename;
	}
	
	function getDesignStyle($component_name)
	{
		$design_styles = Array();
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT * FROM COMPONENT_DESIGN WHERE component_name = '$component_name' ORDER BY design_style";
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$design_style ["design_style"] = $rs[1];
			$design_style ["filename"] = $rs[2];
			$design_style ["preview_images"] = $rs[3];
			$design_styles [] = $design_style;
		}		
		$dbconnect->close();
		
		return $design_styles;
	}
	
	function getComponentProperties($component_name)
	{
		$component_properties = Array();
		$dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);		
		$dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT * FROM COMPONENT_PROPERTIES WHERE component_name = '$component_name' order by property_name";
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$prop ["name"] = $rs[1];
			$prop ["type"] = $rs[2];
			$prop ["default_value"] = $rs[3];
			$prop ["option_values"] = $rs[4];
			$prop ["description"] = $rs[5];
			$component_properties [] = $prop;
		}		
		$dbconnect->close();
		
		return $component_properties;
	}
	
	function getID($i) 
	{
		return $this->id[$i];
	}
	
	function getName($i)
	{
		return $this->name[$i];
	}
	
	function getTitle($i)
	{
		return $this->title[$i];
	}
	
	function getFilename($i) 
	{
		return $this->filename[$i];
	}
	
	function getType($i)
	{
		return $this->type[$i];
	}
	
	function getComponentType($i)
	{
		return $this->component_type[$i];
	}
	
	function getComponentStyle($i)
	{
		return $this->style[$i];
	}
	
	function getContentCount()
	{
		return $this->content_count;
	}
	
	function TOP_SECTION()
	{
		return "Top";
	}
	
	function BOTTOM_SECTION()
	{
		return "Bottom";
	}
	
	function LEFT_SECTION()
	{
		return "Left";
	}
	
	function MIDDLE_SECTION()
	{
		return "Center";
	}
	
	function RIGHT_SECTION()
	{
		return "Right";
	}
}
?>
