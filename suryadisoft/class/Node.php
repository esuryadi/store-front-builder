<?php
class Node 
{
	var $node_name;
	var $node_value;
	var $cdata = false;
	var $attributes = array();
	var $childs = Array();
	
	function Node($node_name, $node_value, $cdata) {
		$this->node_name = $node_name;
		if ($cdata)
			$this->node_value = "<![CDATA[ " . $node_value . " ]]>";
		else
			$this->node_value = $node_value;
		$this->cdata = $cdata;
	}
	
	function setNodeName($node_name) {
		$this->node_name = $node_name;
	}
	
	function getNodeName() {
		return $this->node_name;
	}
	
	function setNodeValue($node_value) {
		if ($cdata)
			$this->node_value = "<![CDATA[ " . $node_value . " ]]>";
		else
			$this->node_value = $node_value;
	}
	
	function getNodeValue() {
		return $this->node_value;
	}	
	
	function isCDATA() {
		return $this->cdata;
	}
	
	function addNodeAttribute($attribute_name, $attribute_value) {
		$this->attributes[$attribute_name] = $attribute_value; 
	}
	
	function getNodeAttribute() {
		return $this->attributes;
	}
	
	function addChildNode($child_node) {
		$this->childs[] = $child_node;
	}
	
	function addChildrenNode($children) {
		$this->childs = $children;
	}
	
	function getNodeChildren() {
		return $this->childs;
	}
	
	function hasAttributes() {
		if (is_array($this->attributes))
			return (count($this->attributes) > 0);
		else
			return false;
	}
	
	function hasChildren() {
		return (count($this->childs) > 0);
	}
	
	function getNodeAttributeString() {
		$str = "";
		foreach($this->attributes as $name => $value)
			$str .= " " . $name . "=\"" . $value . "\"";
		
		return $str;
	}
}
?>
