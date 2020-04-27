<?php
class XML
{
	var $xml_str;
	var $table_name;
	var $start_element;
	var $close_element;
	var $col_data = Array();
	var $data = Array();
	
	function XML() {
		$this->xml_str = "";
	}
	
	function createXMLHeader() {
		return "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" standalone=\"yes\"?>\n\n";
	}
	
	function createXMLString($node) {
		if (is_object($node)) {
			$this->xml_str .= "<" . $node->getNodeName();
			if ($node->hasAttributes()) {
				$this->xml_str .= $node->getNodeAttributeString(); 
			}
			if ($node->hasChildren()) {
				$this->xml_str .= ">\n";
				$children_node = $node->getNodeChildren();
				for($i=0;$i<count($children_node);$i++)
					$this->createXMLString($children_node[$i]);
				$this->xml_str .= "</" . $node->getNodeName() . ">\n";
			} else if (!is_null($node->getNodeValue()) && $node->getNodeValue() != "") {
				$this->xml_str .= ">";
				$this->xml_str .= $node->getNodeValue();
				$this->xml_str .= "</" . $node->getNodeName() . ">\n";
			} else {
				$this->xml_str .= "/>\n";
			}
		}
				
		return $this->xml_str;
	}
	
	function createXMLFile($node, $export_file) {
		$file = fopen($export_file,"a");
		
		if (is_object($node)) {
			fwrite($file,"<" . $node->getNodeName());
			if ($node->hasAttributes()) {
				fwrite($file,$node->getNodeAttributeString()); 
			}
			if ($node->hasChildren()) {
				fwrite($file,">\n");
				$children_node = $node->getNodeChildren();
				for($i=0;$i<count($children_node);$i++)
					$this->createXMLFile($children_node[$i], $export_file);
				fwrite($file,"</" . $node->getNodeName() . ">\n");
			} else if (!is_null($node->getNodeValue()) && $node->getNodeValue() != "") {
				fwrite($file,">");
				fwrite($file,$node->getNodeValue());
				fwrite($file,"</" . $node->getNodeName() . ">\n");
			} else {
				fwrite($file,"/>\n");
			}
		}
		
		fclose($file);
	}
	
	function handle_open_element ($parser, $element, $attributes) {
		$this->start_element = $element;
	}
	
	function handle_close_element ($parser, $element) {
		$this->close_element = $element;
	}
	
	function handle_character_data ($parser, $cdata) {
		if ($this->start_element != "XMLDOCS") {
			if ($this->start_element ==  $this->table_name)
				$this->col_data = Array();
			else if ($this->close_element == $this->table_name && $this->start_element != $this->close_element)
				$this->data [] = $this->col_data;
			else if (!array_key_exists(strtolower($this->start_element),$this->col_data)) { 
				$this->col_data [strtolower($this->start_element)] = addslashes($cdata);
			}				
		}
	}
	
	function parseXMLFile ($file, $length, $table_name) {
		$this->table_name = $table_name;
		$parser = xml_parser_create();
		xml_set_object($parser, &$this);
		xml_set_element_handler ($parser, "handle_open_element", "handle_close_element");
		xml_set_character_data_handler ($parser, "handle_character_data");
		
		while ($data = fread ($file, $length)) {
			xml_parse ($parser, $data, feof($file));
		}
		
		xml_parser_free($parser);
	}
	
	function getData() {
		return $this->data;
	}
}
?>
