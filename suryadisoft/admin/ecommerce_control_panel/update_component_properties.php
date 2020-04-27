<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/WebContent.php";
require_once "../../class/Admin.php";
require_once "../../class/FTP.php";
require_once("../config.php");
require_once("../../path_config.php");

$component_properties = WebContent::getComponentProperties($selected_component);

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

for ($i=0;$i<count($component_properties);$i++) {
	$prop = $component_properties[$i];
	$name = str_replace(" ","_",strtolower($selected_component)) . $id . "_" . $prop["name"];
	eval("\$value = \$" . $prop["name"] . ";");		
	if ($prop["type"] == "image_list" && isset($subaction)) {
		eval("\$img_src = \$" . $prop["name"] . "_dest;");	
		$admin = $HTTP_SESSION_VARS["admin_user"];
		if (substr($admin->getUserId(),0,5) == "trial") {
			$ftp_user_name = "tria0";
			$ftp_user_pwd = "trial";
		} else {
			$ftp_user_name = "client";
			$ftp_user_pwd = "image";
		}
		$root_path = "/" . $admin->getUserId() . "/images/";
		$dest_file = $root_path . $img_src;
		if (substr($admin->getUserId(),0,5) != "trial") {
			if (!file_exists(_ROOTPATH . "client_img_src/" . $admin->getUserId())) {
				mkdir(_ROOTPATH . "client_img_src/" . $admin->getUserId(),0777);
				chmod(_ROOTPATH . "client_img_src/" . $admin->getUserId(),0777);
				mkdir(_ROOTPATH . "client_img_src/" . $admin->getUserId() . "/images/",0777);
				chmod(_ROOTPATH . "client_img_src/" . $admin->getUserId() . "/images/",0777);
			}
		}
		$ftp = new FTP($ftp_user_name,$ftp_user_pwd,$HTTP_POST_FILES[$prop["name"] . "_text"]['tmp_name'],$dest_file);
		$ftp->put();		
	}
	$query1 = "SELECT * FROM PROPERTY WHERE property_name = '$name'";
	$num_rows = mysql_num_rows(mysql_query($query1));
	if ($num_rows == 0)
		$query2 = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('$name','$value')";
	else
		$query2 = "UPDATE PROPERTY SET property_value = '$value' WHERE property_name = '$name'";

	$isSuccess = mysql_query($query2);
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query2 . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<? if($isSuccess) {?>
<script language="JavaScript">
<? if (isset($subaction)) {?>
window.open("component_properties.php?Action=<?=$Action?>&selected_component=<?=$selected_component?>&id=<?=$id?>","_self");
<? } else {?>
window.parent.close();
<? }?>
</script>
<? }?>