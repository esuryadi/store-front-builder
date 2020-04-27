<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript">
<!--
function addNewComponent() {
	open('web_content.php?Action=Create&cat=<?=urlencode($cat)?>','_parent');
}
function deleteComponent() {
	window.parent.frames[0].deleteComponent();
}
-->
</script>
<body>
<div align="center">
  <input name="deleteButton" type="button" id="deleteButton" value="Delete Component" onClick="deleteComponent();">
  <input name="addButton" type="button" id="addButton" value="New Component" onClick="addNewComponent();">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#web_contents','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</div>
</body>
</html>
