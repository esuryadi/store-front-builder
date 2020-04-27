<?php
class Themes
{
	var $dbconnect;
	
	function Themes() 
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}

	function getDirectory($theme_name)
	{
		$dir = "";
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT theme_directory FROM THEMES WHERE theme_name = '" . $theme_name . "'";	
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$dir = $rs[0];
		}
		$this->dbconnect->close();
		
		return $dir;
	}
	
	function getFilename($theme_name)
	{
		$filename = "";
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT theme_filename FROM THEMES WHERE theme_name = '" . $theme_name . "'";	
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$filename = $rs[0];
		}
		$this->dbconnect->close();
		
		return $filename;
	}
	
	function getProperties($theme_name,$color_scheme)
	{
		$properties = Array();
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT * FROM THEMES_PROPERTY WHERE theme_name = '$theme_name' AND theme_color_scheme = '$color_scheme' ORDER BY theme_property_name";	
		$query_result = mysql_query($query);
		while ($rs = mysql_fetch_row($query_result)) {
			$prop["name"] = $rs[2];
			$prop["value"] = $rs[3];
			$properties[] = $prop;
		}
		$this->dbconnect->close();
		
		return $properties;
	}
	
	function getProperty($property_name)
	{
		$value = "";
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT PROPERTY_VALUE FROM PROPERTY WHERE PROPERTY_NAME = '" . $property_name . "'";	
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$value = $rs[0];
		}
		$this->dbconnect->close();
		
		return $value;
	}
	
	function getDefaultProperty($theme_name,$property_name)
	{
		$value = "";
		$this->dbconnect->open();
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT theme_property_value FROM THEMES_PROPERTY WHERE theme_name = '$theme_name' AND theme_color_scheme = 'brown' AND theme_property_name = '" . $property_name . "'";	
		$query_result = mysql_query($query);
		$num_rows = mysql_num_rows($query_result);
		if ($num_rows > 0) {
			$rs = mysql_fetch_row($query_result);
			$value = $rs[0];
		}
		$this->dbconnect->close();
		
		return $value;
	}
}	
?>