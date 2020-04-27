	<table width="100%" border="0" cellspacing="0" cellpadding="3">	
	<? $top_content = new WebContent(WebContent::TOP_SECTION(),$Category,$SubCategory1,$SubCategory2);
	if ($top_content->getContentCount() > 0) {?>
	<? $position = "top";?>
	<tr>
    <td valign="top" colspan="3"> <font size="-1">
			
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
      </font>
			<table width="100%" border="<? if($top_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color") != "")  {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Border Color")?><? }?>">
			<? if($top_content->getTitle($n) != "") {?>
			<? $title = urlencode($top_content->getTitle($n));?>
			<tr>
          <td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Background")?><? }?>"><div align="center" class="tableheaderfont"><strong> 
              <?=$top_content->getTitle($n)?>
              </strong></div></td>
			 </tr>
			<? }?>
			 <tr>
				<td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Background")?><? }?>">
            <font size="-1">
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
            </font></td>
			 </tr>
			</table>
      <font size="-1"><br>
			<? }?>
      </font></td>
		</tr>
		<? }?>
		
	<tr>
		<? $left_content = new WebContent(WebContent::LEFT_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($left_content->getContentCount() > 0) {?>
		<? $position = "left";?>
    <td valign="top"> <font size="-1">
			
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
      </font>
			<table width="100%" border="<? if($left_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color") != "")  {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Border Color")?><? }?>">
			<? if($left_content->getTitle($n) != "") {?>
			<? $title = urlencode($left_content->getTitle($n));?>
			<tr>
          <td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Background")?><? }?>"><div align="center" class="tableheaderfont"><strong> 
              <?=$left_content->getTitle($n)?>
              </strong></div></td>
			 </tr>
			<? }?>
			 <tr>
				<td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Background")?><? }?>">
            <font size="-1">
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
            </font></td>
			 </tr>
			</table>
      <font size="-1"><br>
			<? }?>
      </font></td>
	<? }?>

		<? $middle_content = new WebContent(WebContent::MIDDLE_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($middle_content->getContentCount() > 0) {?>
		<? $position = "center";?>
    <td valign="top"> <font size="-1">
			<? if ($Page == "Home" && isset($Category) && $Category == "ALL" && isset($user)) {?>
      <p><b>Welcome Back 
        <?=$user->getFirstName()?>
        <?=$user->getLastName()?>
        </b></p>
			<? }?>
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
      </font>
      <table width="100%" border="<? if($middle_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color") != "")  {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Border Color")?><? }?>">
			<? if($middle_content->getTitle($n) != "") {?>
			<? $title = urlencode($middle_content->getTitle($n));?>
			<tr>
				  <td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Background")?><? }?>">
            <div align="center" class="tableheaderfont"><strong> 
              <?=$middle_content->getTitle($n)?>
              </strong></div></td>
			 </tr>
			<? }?>
			 <tr>
				<td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Background")?><? }?>">
            <font size="-1">
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
            </font></td>
			 </tr>
			</table>
      <font size="-1"><br>
			<? }?>
      </font></td>
		<? }?>
			
		<? $right_content = new WebContent(WebContent::RIGHT_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($right_content->getContentCount() > 0) {?>
		<? $position = "right";?>
    <td valign="top"> <font size="-1">      
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
      </font>
			<table width="100%" border="<? if($right_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color") != "")  {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Border Color")?><? }?>">
			<? if($right_content->getTitle($n) != "") {?>
			<? $title = urlencode($right_content->getTitle($n));?>
			<tr>
				  <td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Background")?><? }?>">
            <div align="center" class="tableheaderfont"><strong> 
              <?=$right_content->getTitle($n)?>
              </strong></div></td>
			 </tr>
			<? }?>
			 <tr>
				<td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Background")?><? }?>">
            <font size="-1">
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
            </font></td>
			 </tr>
			</table>
      <font size="-1"><br>
			<? }?>
      </font></td>
		<? }?>
	</tr>
	
	<? $bottom_content = new WebContent(WebContent::BOTTOM_SECTION(),$Category,$SubCategory1,$SubCategory2);
	if ($bottom_content->getContentCount() > 0) {?>
	<? $position = "bottom";?>
	<tr>
    <td valign="top" colspan="3"> <font size="-1">
			
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
      </font>
			<table width="100%" border="<? if($bottom_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color") != "")  {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Border Color")?><? }?>">
			<? if($bottom_content->getTitle($n) != "") {?>
			<? $title = urlencode($bottom_content->getTitle($n));?>
			<tr>
          <td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Background")?><? }?>"><div align="center" class="tableheaderfont"><strong> 
              <?=$bottom_content->getTitle($n)?>
              </strong></div></td>
			 </tr>
			<? }?>
			 <tr>
				<td bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?><? } else {?><?=$theme->getDefaultProperty("classic", "Table Background")?><? }?>">
            <font size="-1">
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
            </font></td>
			 </tr>
			</table>
      <font size="-1"><br>
			<? }?>
      </font></td>
		</tr>
		<? }?>
	</table>