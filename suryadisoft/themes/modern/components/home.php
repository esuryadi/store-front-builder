<table width="98%" border="0" cellpadding="3" cellspacing="0">
<? $top_content = new WebContent(WebContent::TOP_SECTION(),$Category,$SubCategory1,$SubCategory2);
if ($top_content->getContentCount() > 0) {?>
<? $position = "top";?>
<tr>
	<td valign="top" colspan="3">       
	<? for($n=0;$n<$top_content->getContentCount();$n++) {
	if ($top_content->getFilename($n) == "login.php") {
		$show = false;
		if (isset($Category) && $Category == "ALL") {
			if (array_search("User Account",$comp) > -1) {
				if (!isset($user) || (isset($user) && isset($isVerified) && !$isVerified)) {
					$show = true;
				}
			}
		}
		if (!$show)
			$n++;
		if ($n >= $top_content->getContentCount())
			break;
	}?>
      
	<? if($top_content->getTitle($n) != "") {?>
	<? $title = urlencode($top_content->getTitle($n));?>
	<table height="27" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="left"><strong><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/leftcorner.gif" width="16" height="15"></strong></div>
			</td>
			<td nowrap bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="center"><strong><div class="tableheaderfont"><?=$top_content->getTitle($n)?></div></strong></div>
			</td>
			<td align="right" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
				<img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/rightcorner.gif" width="16" height="15">
			</td>
		</tr>
	</table>
	<? }?>
	<table width="100%" border="<? if($top_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="0" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
				<? if ($top_content->getComponentType($n) == 'built-in') {
					include(_COMPONENTPATH . $top_content->getFilename($n));	
				} else {
					$str = (substr(_USER,0,4) == "test" || substr(_USER,0,5) == "trial" || _USER == "demo1" || _USER == "demo2" || _USER == "demo")?"wwwuser":substr(_USER,0,8);
					$url = (substr($company_url,0,3) == "www")?substr($company_url,4):$company_url;
					if ($top_content->getFilename($n) != "") {
						if (eregi(".jpg",$top_content->getFilename($n)) || eregi(".gif",$top_content->getFilename($n)))
							echo "<image src=\"" . $top_content->getFilename($n) . "\">";
						else
							include "/www/$url/httpdocs/" . $top_content->getFilename($n);
					}
				} ?>
			</td>
		</tr>
	</table>
	<br>
	<? }?>
	</td>
</tr>
<? }?>
		
<tr>
<? $left_content = new WebContent(WebContent::LEFT_SECTION(),$Category,$SubCategory1,$SubCategory2);
if ($left_content->getContentCount() > 0) {?>
<? $position = "left";?>
	<td valign="top"> 	
		<? for($n=0;$n<$left_content->getContentCount();$n++) {
			if ($left_content->getFilename($n) == "login.php") {
				$show = false;
				if (isset($Category) && $Category == "ALL") {
					if (array_search("User Account",$comp) > -1) {
						if (!isset($user) || (isset($user) && isset($isVerified) && !$isVerified)) {
							$show = true;
						}
					}
				}
				if (!$show)
					$n++;
				if ($n >= $left_content->getContentCount())
					break;
			}?>
		<? if($left_content->getTitle($n) != "") {?>
		<? $title = urlencode($left_content->getTitle($n));?>
		<table height="27" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="left"><strong><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/leftcorner.gif" width="16" height="15"></strong></div>
			</td>
			<td nowrap bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="center"><strong><div class="tableheaderfont"><?=$left_content->getTitle($n)?></div></strong></div>
			</td>
			<td align="right" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
				<img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/rightcorner.gif" width="16" height="15">
			</td>
		</tr>
		</table>
		<? }?>
		<table width="100%" border="<? if($left_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="0" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
				<? if ($left_content->getComponentType($n) == 'built-in') {
					include(_COMPONENTPATH . $left_content->getFilename($n));	
				} else {
					$str = (substr(_USER,0,4) == "test" || substr(_USER,0,5) == "trial" || _USER == "demo1" || _USER == "demo2" || _USER == "demo")?"wwwuser":substr(_USER,0,8);
					$url = (substr($company_url,0,3) == "www")?substr($company_url,4):$company_url;
					if ($left_content->getFilename($n) != "") {
						if (eregi(".jpg",$left_content->getFilename($n)) || eregi(".gif",$left_content->getFilename($n)))
							echo "<image src=\"" . $left_content->getFilename($n) . "\">";
						else
							include "/www/$url/httpdocs/" . $left_content->getFilename($n);
					}
				} ?>
			</td>
		</tr>
		</table>
		<br>	
		<? }?>
	</td>
<? }?>
		
<? $middle_content = new WebContent(WebContent::MIDDLE_SECTION(),$Category,$SubCategory1,$SubCategory2);
if ($middle_content->getContentCount() > 0) {?>
	<? $position = "center";?>
  <td valign="top">       
		<? for($n=0;$n<$middle_content->getContentCount();$n++) {
		if ($middle_content->getFilename($n) == "login.php") {
			$show = false;
			if (isset($Category) && $Category == "ALL") {
				if (array_search("User Account",$comp) > -1) {
					if (!isset($user) || (isset($user) && isset($isVerified) && !$isVerified)) {
						$show = true;
					}
				}
			}
			if (!$show)
				$n++;
			if ($n >= $middle_content->getContentCount())
				break;
		}?>

		<? if($middle_content->getTitle($n) != "") {?>
		<? $title = urlencode($middle_content->getTitle($n));?>
    <table height="27" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="left"><strong><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/leftcorner.gif" width="16" height="15"></strong></div>
			</td>
			<td nowrap bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="center"><strong><div class="tableheaderfont"><?=$middle_content->getTitle($n)?></div></strong></div>
			</td>
			<td align="right" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
				<img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/rightcorner.gif" width="16" height="15">
			</td>
		</tr>
		</table>
		<? }?>
    <table width="100%" border="<? if($middle_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="0" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
				<? if ($middle_content->getComponentType($n) == 'built-in') {
					include(_COMPONENTPATH . $middle_content->getFilename($n));	
				} else {
					$str = (substr(_USER,0,4) == "test" || substr(_USER,0,5) == "trial" || _USER == "demo1" || _USER == "demo2" || _USER == "demo")?"wwwuser":substr(_USER,0,8);
					$url = (substr($company_url,0,3) == "www")?substr($company_url,4):$company_url;
					if ($middle_content->getFilename($n) != "") {
						if (eregi(".jpg",$middle_content->getFilename($n)) || eregi(".gif",$middle_content->getFilename($n)))
							echo "<image src=\"" . $middle_content->getFilename($n) . "\">";
						else
							include "/www/$url/httpdocs/" . $middle_content->getFilename($n);
					}
				} ?>
			</td>
		</tr>
		</table>
		<br>	
	<? }?>
	</td>
<? }?>
		
<? $right_content = new WebContent(WebContent::RIGHT_SECTION(),$Category,$SubCategory1,$SubCategory2);
if ($right_content->getContentCount() > 0) {?>
<? $position = "right";?>
<td valign="top"> 
	<? for($n=0;$n<$right_content->getContentCount();$n++) {
	if ($right_content->getFilename($n) == "login.php") {
		$show = false;
		if (isset($Category) && $Category == "ALL") {
			if (array_search("User Account",$comp) > -1) {
				if (!isset($user) || (isset($user) && isset($isVerified) && !$isVerified)) {
					$show = true;
				}
			}
		}
		if (!$show)
			$n++;
		if ($n >= $right_content->getContentCount())
			break;
	}?>				

		<? if($right_content->getTitle($n) != "") {?>
		<? $title = urlencode($right_content->getTitle($n));?>
    <table height="27" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="left"><strong><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/leftcorner.gif" width="16" height="15"></strong></div>
			</td>
			<td nowrap bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="center"><strong><div class="tableheaderfont"><?=$right_content->getTitle($n)?></div></strong></div>
			</td>
			<td align="right" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
				<img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/rightcorner.gif" width="16" height="15">
			</td>
		</tr>
		</table>
		<? }?>
		<table width="100%" border="<? if($right_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="0" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
				<? if ($right_content->getComponentType($n) == 'built-in') {
					include(_COMPONENTPATH . $right_content->getFilename($n));	
				} else {
					$str = (substr(_USER,0,4) == "test" || substr(_USER,0,5) == "trial" || _USER == "demo1" || _USER == "demo2" || _USER == "demo")?"wwwuser":substr(_USER,0,8);
					$url = (substr($company_url,0,3) == "www")?substr($company_url,4):$company_url;
					if ($right_content->getFilename($n) != "") {
						if (eregi(".jpg",$right_content->getFilename($n)) || eregi(".gif",$right_content->getFilename($n)))
							echo "<image src=\"" . $right_content->getFilename($n) . "\">";
						else
							include "/www/$url/httpdocs/" . $right_content->getFilename($n);
					}
				} ?>
			</td>
		</tr>
		</table>
		<br>
		<? }?>
	</td>
	<? }?>
</tr>
	
<? $bottom_content = new WebContent(WebContent::BOTTOM_SECTION(),$Category,$SubCategory1,$SubCategory2);
if ($bottom_content->getContentCount() > 0) {?>
<? $position = "bottom";?>
<tr>
<td valign="top" colspan="3">       
	<? for($n=0;$n<$bottom_content->getContentCount();$n++) {
	if ($bottom_content->getFilename($n) == "login.php") {
		$show = false;
		if (isset($Category) && $Category == "ALL") {
			if (array_search("User Account",$comp) > -1) {
				if (!isset($user) || (isset($user) && isset($isVerified) && !$isVerified)) {
					$show = true;
				}
			}
		}
		if (!$show)
			$n++;
		if ($n >= $bottom_content->getContentCount())
			break;
	}?>
	
	<? if($bottom_content->getTitle($n) != "") {?>				
	<? $title = urlencode($bottom_content->getTitle($n));?>
	<table height="27" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="left"><strong><img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/leftcorner.gif" width="16" height="15"></strong></div>
			</td>
			<td nowrap bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> 
				<div align="center"><strong><div class="tableheaderfont"><?=$bottom_content->getTitle($n)?></div></strong></div>
			</td>
			<td align="right" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
				<img src="<?=(_URLPATH . "themes/modern/")?>images/<?=WebContent::getPropertyValue("selected_color_scheme")?>/rightcorner.gif" width="16" height="15">
			</td>
		</tr>
		</table>
	<? }?>
	<table width="100%" border="<? if($bottom_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="0" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
		<tr> 
			<td align="left" valign="top" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
				<? if ($bottom_content->getComponentType($n) == 'built-in') {
					include(_COMPONENTPATH . $bottom_content->getFilename($n));	
				} else {
					$str = (substr(_USER,0,4) == "test" || substr(_USER,0,5) == "trial" || _USER == "demo1" || _USER == "demo2" || _USER == "demo")?"wwwuser":substr(_USER,0,8);
					$url = (substr($company_url,0,3) == "www")?substr($company_url,4):$company_url;
					if ($bottom_content->getFilename($n) != "") {
						if (eregi(".jpg",$bottom_content->getFilename($n)) || eregi(".gif",$bottom_content->getFilename($n)))
							echo "<image src=\"" . $bottom_content->getFilename($n) . "\">";
						else
							include "/www/$url/httpdocs/" . $bottom_content->getFilename($n);
					}
				} ?>
			</td>
		</tr>
		</table>
		<br>
	<? }?>
	</td>
</tr>
<? }?>
</table>