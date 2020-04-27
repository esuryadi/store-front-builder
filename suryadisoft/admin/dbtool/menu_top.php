<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$db_list = mysql_list_dbs();
while ($row = mysql_fetch_array($db_list)) {
	$dbname [] = $row[0];
}

for ($i=0;$i<count($dbname);$i++) {
	if (isset($DBName) && $DBName == $dbname[$i]) { 
		$selected_db = $dbname[$i];
		break;
	} else {
		if (session_is_registered("selected_db")) {
			$selected_db = $HTTP_SESSION_VARS["selected_db"];
			if (!array_search($selected_db,$dbname)) {
				$selected_db = $dbname[0];
				$HTTP_SESSION_VARS["selected_db"] = $selected_db;
			}
		} else
			$selected_db = $dbname[0];
	}
}

$table_list = mysql_list_tables($selected_db);
if ($table_list) {
	while ($row = mysql_fetch_row($table_list)) {
		$table_name [] = $row[0];
	}
}

if (isset($table_name)) {
	for ($i=0;$i<count($table_name);$i++) {
		if (isset($TableName) && $TableName == $table_name[$i]) { 
			$selected_table = $table_name[$i];
			break;
		} else {
			if (isset($DBName)) {
				$selected_table = $table_name[0];
				$HTTP_SESSION_VARS["selected_table"] = $selected_table;
			} else if (session_is_registered("selected_table")) {
				$selected_table = $HTTP_SESSION_VARS["selected_table"];
				if (!array_search($selected_table,$table_name)) {
					$selected_table = $table_name[0];
					$HTTP_SESSION_VARS["selected_table"] = $selected_table;
				}
			} else
				$selected_table = $table_name[0];
		}
	}
} else
	$selected_table = "";

$HTTP_SESSION_VARS["db_connect"]->close();

if (!session_is_registered("selected_db"))
	session_register("selected_db");
if (!session_is_registered("selected_table"))
	session_register("selected_table");
?>
<title>Menu Top</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">



var coldColor = "#ffffff"

var hotColor  = "#ffffff"

var motionPix = "0"

var a='<style>'+

'A.InstantLink:link {'+

'  color:'+coldColor+';'+

'  text-decoration:none;'+

'  padding:0 '+motionPix+' 0 0;'+

'  }'+  

'A.InstantLink:visited {'+

'  color:'+coldColor+';'+

'  text-decoration:none;'+

'  padding:0 '+motionPix+' 0 0;}'+  

'A.InstantLink:active {'+

'  color:'+coldColor+';'+

'  text-decoration:none;'+

'  padding:0 '+motionPix+' 0 0;'+

'  }'+  

'A.InstantLink:hover {'+

'  color:'+hotColor+';'+

'  text-decoration:underline;'+

'  padding:0 0 0 '+motionPix+';'+

'  }'+

'</style>'

if (document.all || document.getElementById){

    document.write(a)

}



function setDatabase(db) {

	var url = "menu_top.php?SelectedDB=" + db;

	open(url,"_self");

}



function refreshMainFrame() {

	open("settings.php","mainFrame");

}



function refreshMainFrame() {

	var url2 = "query_all.php?DBName=<?=$selected_db?>&TableName=<?=$selected_table?>";
	open(url2,"mainFrame");
}

function setDatabase(form, value) {
	var url1 = "menu_top.php?DBName=" + value;
	open(url1,"topFrame");
}

function setTable(form, value) {
	var url = "query_all.php?DBName=" + form.DatabaseName.options[form.DatabaseName.selectedIndex].value + "&TableName=" + value;
	open(url,"mainFrame");
}

</script>
</head>



<body vlink="00aeef" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" <? if (isset($DBName) && !isset($TableName) || isset($Action)) {?>onLoad="refreshMainFrame();"<? }?>>

<form>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="00aeef">

  <tr>

      <td><img src="../../images/database_control_hdr.jpg"></td>

      <td valign="bottom">
	  <table border="0" cellspacing="0" cellpadding="3">
          <tr> 
            <td align="right" valign="bottom" nowrap><strong><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database</font></strong><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">: 
              </font> </td>
            <td nowrap><select name="DatabaseName" id="DatabaseName" onChange="setDatabase(this.form,this.value)">
        <? for ($i=0;$i<count($dbname);$i++) { ?>
        <option value="<?=$dbname[$i]?>" <? if ($dbname[$i] == $selected_db) {?>SELECTED<? }?>> 
        <?=$dbname[$i]?>
        </option>
        <? }?>
              </select></td>
          </tr>
          <tr> 
            <td align="right" valign="bottom" nowrap><strong><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Table:</font></strong> 
		</td>
            <td nowrap><select name="TableName" id="TableName" onChange="setTable(this.form,this.value)">
        <? for ($i=0;$i<count($table_name);$i++) { ?>
        <option value="<?=$table_name[$i]?>" <? if ($table_name[$i] == $selected_table) {?>SELECTED<? }?>> 
        <?=$table_name[$i]?>
        </option>
        <? }?>
              </select></td>
          </tr>
        </table>
        
		</td>

      <td align="right" valign="bottom"> 

        <div align="right">
          <table border="0" cellspacing="0" cellpadding="4">
          <tr> 
            <td nowrap><a class="InstantLink" href="../initialize.php" target="_parent"><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Administrator 
              Control Panel</font></a></td>
            <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">  | </font></td>
            <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a class="InstantLink" href="../login.php?Action=Logout" target="_parent"><font color="#FFFFFF">Logout</font></a></font></td>
  </tr>
</table>

      </td>

  </tr>
  <tr>
  	<td colspan="3" bgcolor="#000000"><img src="../../images/spacer.gif" height="4"></td></tr>

</table>

</form>
</body>
</html>
