<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (session_is_registered("primary_key_index"))
	$primary_key_index = $HTTP_SESSION_VARS["primary_key_index"];
if (session_is_registered("table_index"))
	$table_index = $HTTP_SESSION_VARS["table_index"];
		
//Check if this is the first time this page entered.
if (isset($ColumnName)) {
	if (session_is_registered("column"))
		$column = $HTTP_SESSION_VARS["column"];

	//Prevent inputing duplicate data when user refresh the page
	if (!isset($column) || count($column) == 0 || (count($column) > 0 && $column[count($column)-1] != $ColumnName)) {
		$column [] = $ColumnName;
		$data_type [] = "TEXT";
		$options [] = "";
		$length [] = 0;
		$decimal [] = "";
		$isNullAllowed [] = true;
		$isAutoIncrement [] = false;
		$isUnsigned [] = false;
		if (!session_is_registered("column"))
			session_register("column");
		if (!session_is_registered("data_type"))
			session_register("data_type");
		if (!session_is_registered("options"))
			session_register("options");
		if (!session_is_registered("length"))
			session_register("length");
		if (!session_is_registered("decimal"))
			session_register("decimal");
		if (!session_is_registered("isNullAllowed"))
			session_register("isNullAllowed");
		if (!session_is_registered("isAutoIncrement"))
			session_register("isAutoIncrement");
		if (!session_is_registered("isUnsigned"))
			session_register("isUnsigned");
	} 
} else if (isset($DataType)) {
	$data_type = $HTTP_SESSION_VARS["data_type"];
	$data_type [$Index] = $DataType;
} else if (isset($Options)) {
	$options = $HTTP_SESSION_VARS["options"];
	$options [$Index] = stripslashes($Options);
} else if (isset($Length)) {
	$length = $HTTP_SESSION_VARS["length"];
	$length [$Index] = $Length;
} else if (isset($Decimal)) {
	$decimal = $HTTP_SESSION_VARS["decimal"];
	$decimal [$Index] = stripslashes($Decimal);
} else if (isset($PrimaryKeyIndex)) {
	$primary_key_index = $PrimaryKeyIndex;
	if (!session_is_registered("primary_key_index"))
		session_register("primary_key_index");
} else if (isset($TableIndex)) {
	$table_index = $TableIndex;
	if (!session_is_registered("table_index"))
		session_register("table_index");
} else if (isset($IsNullAllowed)) {
	$isNullAllowed = $HTTP_SESSION_VARS["isNullAllowed"];
	$isNullAllowed [$Index] = ($IsNullAllowed == "true");
} else if (isset($IsAutoIncrement)) {
	$isAutoIncrement = $HTTP_SESSION_VARS["isAutoIncrement"];
	$isAutoIncrement [$Index] = ($IsAutoIncrement == "true");
} else if (isset($IsUnsigned)) {
	$isUnsigned = $HTTP_SESSION_VARS["isUnsigned"];
	$isUnsigned [$Index] = ($IsUnsigned == "true");
} else if (isset($Action) && $Action == "Delete") {
	array_splice($column,$Index,1);
	array_splice($data_type,$Index,1);
	array_splice($options,$Index,1);
	array_splice($length,$Index,1);
	array_splice($decimal,$Index,1);
	array_splice($isNullAllowed,$Index,1);
	array_splice($isAutoIncrement,$Index,1);
	array_splice($isUnsigned,$Index,1);
} else {
	session_unregister("column");
	session_unregister("data_type");
	session_unregister("options");
	session_unregister("length");
	session_unregister("decimal");
	session_unregister("primary_key_index");
	session_unregister("isNullAllowed");
	session_unregister("isAutoIncrement");
	session_unregister("isUnsigned");
	session_unregister("table_index");
	unset($column);
	unset($data_type);
	unset($options);
	unset($length);
	unset($decimal);
	unset($primary_key_index);
	unset($isNullAllowed);
	unset($isAutoIncrement);
	unset($isUnsigned);
	unset($table_index);
}

$table_width = 850;
if (isset($data_type) && (array_search("INT",$data_type) || 
	  isset($data_type[array_search("INT",$data_type)]))) {
	$table_width += 200;
} 
if (isset($data_type) && (array_search("DECIMAL",$data_type) || 
	  isset($data_type[array_search("DECIMAL",$data_type)]))) {
	$table_width += 100;
} 
if (isset($data_type) && (array_search("VARCHAR",$data_type) || 
	  isset($data_type[array_search("VARCHAR",$data_type)]))) {
	$table_width += 100;
}
if ((isset($data_type) && (array_search("ENUM",$data_type) || 
	  isset($data_type[array_search("ENUM",$data_type)]))) ||
		(isset($data_type) && (array_search("SET",$data_type) || 
	  isset($data_type[array_search("SET",$data_type)])))) {
	$table_width += 100;
}
?>
<title>Create New Table</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript">
	
	function addColumn(form) {
		var duplicate_exist = false;
		<? if (isset($column)) {?>
			col_name = new Array(<?=count($column)?>);
			<? for ($i=0;$i<count($column);$i++) {?>
			col_name [<?=$i?>] = "<?=$column[$i]?>";
			<? }?>
			for (i=0;i<col_name.length;i++) {
				if (col_name[i] == form.ColumnName.value) {
					duplicate_exist = true;
					break;
				}
			}
		<? }?>
		if (!duplicate_exist) {
			var url = "create_table.php?DBName=" + form.DatabaseName.selectedIndex + "&TableName=" + form.TableName.value + "&ColumnName=" + form.ColumnName.value;
			open(url,"_self");
		} else {
			alert("Column Name Exist! Cannot enter duplicate!");
		}
	}
	
	function setDataType(form,value,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&DataType=" + value + "&Index=" + index;
		open(url,"_self");
	}
	
	function setLength(form,value,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&Length=" + value + "&Index=" + index;
		open(url,"_self");
	}
	
	function setDecimal(form,value,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&Decimal=" + value + "&Index=" + index;
		open(url,"_self");
	}

	function setOptions(form,value,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&Options=" + value + "&Index=" + index;
		open(url,"_self");
	}
	
	function setPrimaryKey(form,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&PrimaryKeyIndex=" + index;
		open(url,"_self");
	}
	
	function setTableIndex(form,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&TableIndex=" + index;
		open(url,"_self");
	}
		
	function setNullValue(form,isChecked,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&IsNullAllowed=" + isChecked + "&Index=" + index;
		open(url,"_self");
	}
	
	function setAutoIncrement(form,isChecked,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&IsAutoIncrement=" + isChecked + "&Index=" + index;
		open(url,"_self");
	}
	
	function setUnsigned(form,isChecked,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&IsUnsigned=" + isChecked + "&Index=" + index;
		open(url,"_self");
	}
	
	function deleteRow(form,index) {
		var url = "create_table.php?TableName=" + form.TableName.value + "&Action=Delete&Index=" + index;
		open(url,"_self");
	}
	
	function resetForm() {
		var url = "create_table.php?Action=Reset";
		open(url,"_self");
	}
	
	function validateForm(form) {
		var is_valid = true;
		var err_msg = "";
		var column_exist = <?if (isset($column)) {?>true<?} else {?>false<?}?>;
		
		if (form.TableName.value == "") {
			is_valid = false;
			err_msg = err_msg + "You haven't entered the table name\n";
		}
		if (!column_exist) {
			is_valid = false;
			err_msg = err_msg + "You haven't entered any column name\n";
		} else {
			if (form.PrimaryKey.checked == false) {
				is_valid = false;
				err_msg = err_msg + "Primary Key must be set\n";
			}
		}
		
		if (!is_valid)
			alert(err_msg);
			
		event.returnValue = is_valid;
	}
</script>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<h1 align="center">Create New Table</h1>
<form name="CreateTableForm" method="post" action="create_table_result.php">
	<p>Database: <?=$HTTP_SESSION_VARS["selected_db"]?></p>
	<input type="hidden" name="DatabaseName" value="<?=$HTTP_SESSION_VARS['selected_db']?>">
  <p>New Table Name: 
    <input type="text" name="TableName" value="<?if (isset($TableName)) {?><?=$TableName?><?}?>">
  </p>
  <p>New Field Name: 
    <input type="text" name="ColumnName">
    <input type="button" name="Add_Column" value="Add" onclick="addColumn(this.form);">
  </p>
  <table width="<?=$table_width?>" border="0" cellspacing="3" cellpadding="0">
    <tr> 
      <td width="300" bgcolor="#999999"> <div align="center"><strong>Field Name</strong></div></td>
      <td width="150" bgcolor="#999999"> <div align="center"><strong>Data Type</strong></div></td>
      <? if ((isset($data_type) && (array_search("ENUM",$data_type) || isset($data_type[array_search("ENUM",$data_type)]))) || (isset($data_type) && (array_search("SET",$data_type) || isset($data_type[array_search("SET",$data_type)])))) {?>
			<td width="100" bgcolor="#999999"> <div align="center"><strong>Options</strong></div></td>
			<? }?>
			<? if (isset($data_type) && (array_search("VARCHAR",$data_type) || isset($data_type[array_search("VARCHAR",$data_type)]))) {?>
			<td width="100" bgcolor="#999999"> <div align="center"><strong>Length</strong></div></td>
			<? }?>
			<? if (isset($data_type) && (array_search("DECIMAL",$data_type) || isset($data_type[array_search("DECIMAL",$data_type)]))) {?>
			<td width="100" bgcolor="#999999"> <div align="center"><strong>Max,Decimal</strong></div></td>
			<? }?>
			<? if (isset($data_type) && (array_search("INT",$data_type) || isset($data_type[array_search("INT",$data_type)]))) {?>
			<td width="100" bgcolor="#999999"> <div align="center"><strong>Unsigned</strong></div></td>
			<td width="100" bgcolor="#999999"> <div align="center"><strong>Auto Increment</strong></div></td>
      <? }?>
			<td width="100" bordercolor="#CCCCCC" bgcolor="#999999"> <div align="center"><strong>Primary 
          Key</strong></div></td>
			<td width="100" bordercolor="#CCCCCC" bgcolor="#999999"> <div align="center"><strong>Table Index</strong></div></td>
			<td width="100" bgcolor="#999999"> <div align="center"><strong>NULL Value Allowed</strong></div></td>
    	<td width="100"></td>
		</tr>
  </table>
  <?if (isset($ColumnName) || isset($DataType) || isset($PrimaryKeyIndex) || isset($IsNullAllowed) || isset($IsAutoIncrement) || isset($IsUnsigned) || isset($TableIndex) || isset($Length) || isset($Options) || isset($Decimal) || (isset($Action) && $Action != "Reset")) {?>
  <table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0">
    <?for ($i=0;$i<count($column);$i++) {?>
    <tr> 
      <td width="300" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <?=$column[$i]?>
      </td>
      <td width="150" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <center>
          <select name="DataType_<?=$i?>" onchange="setDataType(this.form, this.value, <?=$i?>);">
            <option value="TEXT" <? if ($data_type[$i] == "TEXT") {?>SELECTED<? }?>>TEXT</option>
            <option value="INT" <? if ($data_type[$i] == "INT") {?>SELECTED<? }?>>INT</option>
            <option value="DECIMAL" <? if ($data_type[$i] == "DECIMAL") {?>SELECTED<? }?>>DECIMAL</option>
            <option value="VARCHAR" <? if ($data_type[$i] == "VARCHAR") {?>SELECTED<? }?>>VARCHAR</option>
            <option value="ENUM" <? if ($data_type[$i] == "ENUM") {?>SELECTED<? }?>>ENUM</option>
            <option value="SET" <? if ($data_type[$i] == "SET") {?>SELECTED<? }?>>SET</option>
            <option value="DATE" <? if ($data_type[$i] == "DATE") {?>SELECTED<? }?>>DATE</option>
            <option value="TIME" <? if ($data_type[$i] == "TIME") {?>SELECTED<? }?>>TIME</option>
            <option value="DATETIME" <? if ($data_type[$i] == "DATETIME") {?>SELECTED<? }?>>DATETIME</option>
          </select>
        </center>
			</td>
			<? if ($data_type[$i] == "ENUM" || $data_type[$i] == "SET") {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>">
				<center>
					<input type="text" name="Options_<?=$i?>" value="<?=$options[$i]?>" size="10" onChange="setOptions(this.form,this.value,<?=$i?>);">
				</center>
			</td>
			<? } else if ((array_search("ENUM",$data_type) || isset($data_type[array_search("ENUM",$data_type)])) || (array_search("SET",$data_type) || isset($data_type[array_search("SET",$data_type)]))) {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"></td>
			<? }?>
			<? if ($data_type[$i] == "VARCHAR") {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>">
				<center>
					<input type="text" name="Length_<?=$i?>" value="<? if($length[$i] > 0) {?><?=$length[$i]?><? } else { $length[$i] = 99; ?>99<? }?>" size="3" onChange="setLength(this.form,this.value,<?=$i?>);">
				</center>
			</td>
			<? } else if (array_search("VARCHAR",$data_type) || isset($data_type[array_search("VARCHAR",$data_type)])) {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"></td>
			<? }?>
			<? if ($data_type[$i] == "DECIMAL") {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>">
				<center>
					<input type="text" name="Decimal_<?=$i?>" value="<? if($decimal[$i] != "") {?><?=$decimal[$i]?><? } else { $decimal[$i] = "9,2"; ?>9,2<? }?>" size="3" onChange="setDecimal(this.form,this.value,<?=$i?>);">
				</center>
			</td>
			<? } else if (array_search("DECIMAL",$data_type) || isset($data_type[array_search("DECIMAL",$data_type)])) {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"></td>
			<? }?>
			<? if ($data_type[$i] == "INT") {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <center>
					<input type="checkbox" name="IsUnsigned<?=$i?>" value="<? if ($isUnsigned[$i]) {?>UNSIGNED<? }?>" onClick="setUnsigned(this.form, this.checked, <?=$i?>);" <? if($isUnsigned[$i]) {?>CHECKED<? }?>>
        </center>
			</td>    
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <center>
					<input type="checkbox" name="IsAutoIncrement_<?=$i?>" value="<? if ($isAutoIncrement[$i]) {?>AUTO_INCREMENT<? }?>" onClick="setAutoIncrement(this.form, this.checked, <?=$i?>);" <? if($isAutoIncrement[$i]) {?>CHECKED<? }?>>
        </center>
			</td>
			<? } else if (array_search("INT",$data_type) || isset($data_type[array_search("INT",$data_type)])) {?>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"></td>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"></td>
			<? }?>
      <td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <center>
          <input type="radio" name="PrimaryKey" value="<?=$column[$i]?>" onClick="setPrimaryKey(this.form, <?=$i?>);" <? if(isset($primary_key_index) && $i == $primary_key_index) {?>CHECKED<? }?>>
        </center>
			</td>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <center>
          <input type="radio" name="TableIndex" value="<?=$column[$i]?>" onClick="setTableIndex(this.form, <?=$i?>);" <? if(isset($table_index) && $i == $table_index) {?>CHECKED<? }?>>
        </center>
			</td>
			<td width="100" bgcolor="<?if (($i%2) != 0) {?>#eeeeee<?} else {?>#FFFFFF<?}?>"> 
        <center>
          <input type="checkbox" name="IsNullAllowed_<?=$i?>" value="<? if (!$isNullAllowed[$i]) {?>NOT NULL<? }?>" onClick="setNullValue(this.form, this.checked, <?=$i?>);" <? if($isNullAllowed[$i]) {?>CHECKED<? }?>>
        </center>
			</td>
			<td width="100"> 
        <center>
          <input type="button" name="delete" value="delete" onClick="deleteRow(this.form,<?=$i?>);">
        </center>
			</td>
    </tr>
    <?}?>
  </table>
  <?}?>
  <p>&nbsp;</p>
  <p align="center"> 
    <input type="submit" name="Submit" value="Create Table" onclick="validateForm(this.form);">
    <input type="reset" name="Reset" value="Reset" onClick="resetForm();">
  </p>
</form>
</body>
</html>
