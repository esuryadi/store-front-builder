 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td valign="top"> <table width="200" border="0" cellpadding="10" cellspacing="0">
        <tr> 
          <td background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_tab_active_color")?>" align="right"> 
            <? if (isset($Category) && $Category != "ALL") {
						$sub_cat_1 = WebContent::getSubCategory1($Category);?>
            <p> 
              <? for($x=0;$x<count($sub_cat_1);$x++) {?>
							<? if ($sub_cat_1[$x] != "") {?>
              <a href="mystore.php?Page=Home&Category=<?=urlencode($Category)?>&SubCategory1=<?=urlencode($sub_cat_1[$x])?>" style="text-decoration:none"><font color="#FFFFFF"> 
              <?=$sub_cat_1[$x]?>
              </font></a> 
              <? if ($x < count($sub_cat_1)-1) {?>
              <br>
              <? }?>
							<? }?>
              <? }?>
            </p>
            <? } else {
						$sub_cat_1 = WebContent::getSubCategory1("Home");?>
						<p> 
              <? for($x=0;$x<count($sub_cat_1);$x++) {?>
							<? if ($sub_cat_1[$x] != "") {?>
              <a href="mystore.php?Page=Home&Category=Home&SubCategory1=<?=urlencode($sub_cat_1[$x])?>" style="text-decoration:none"><font color="#FFFFFF"> 
              <?=$sub_cat_1[$x]?>
              </font></a> 
              <? if ($x < count($sub_cat_1)-1) {?>
              <br>
              <? }?>
              <? }?>
							<? }?>
            </p>
						<? }?>
          </td>
        </tr>
        <tr> 
          <td background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue("brushed_steel_tab_active_color")?>"> 
            <form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm">
              <font color="#FFFFFF" size="-1">Search:</font><br>
              <select name="Category" id="Category">
                <? $main_cat = WebContent::getMainCategory();?>
								<option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All Products</option>
								<? for($z=0;$z<count($main_cat);$z++) {?>
								<option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>><?=$main_cat[$z]?></option>
								<? }?>
              </select>
              <input name="Keyword" type="text" id="Keyword">
              <input name="SearchButton" type="submit" id="SearchButton3" value="Go">
            </form></td>
        </tr>
      </table>
      <? $left_content = new WebContent(WebContent::LEFT_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($left_content->getContentCount() > 0) {?>
      <? $position = "left";?>
      <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td> <br> 
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
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <? if($left_content->getTitle($n) != "") {?>
              <? $title = urlencode($left_content->getTitle($n));?>
              <tr> 
                <td><table border="0" cellpadding="0" cellspacing="0" background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
                    <tr> 
                      <td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td>
                      <td rowspan="2"><table border="0" cellspacing="0" cellpadding="5">
                          <tr> 
                            <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong> 
                              <?=$left_content->getTitle($n)?>
                              </strong></font></td>
                          </tr>
                        </table></td>
                      <td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td>
                    </tr>
                    <tr> 
                      <td></td>
                    </tr>
                  </table></td>
              </tr>
              <? }?>
              <tr> 
                <td><table width="100%" border="<? if($left_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
                    <tr> 
                      <td bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td> 
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
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br> 
            <? }?>
          </td>
        </tr>
      </table></td>
    <? }?>
    <td valign="top"> 
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="right" colspan="2">
						<table cellpadding="5">
						<tr>
							<td>
								<?$links = WebContent::getLinks("Top");?>
								<strong>
								<? for ($i=0;$i<count($links);$i++) {
									$link = $links[$i];?>
									<? if ($link["target"] == "Self") {?>	
									<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="mystore.php?Page=Link&Link=<?=urlencode($link["url"])?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
									<? } else if ($link["target"] == "Parent") {?>
									<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="<?=$link["url"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
									<? } else if ($link["target"] == "New Window") {?>
									<? if ($link["type"] == "Text") {?><? }?><a class="InstantLink" href="<?=$link["url"]?>" target="<?=$link["target"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
									<? }?>
								<? }?>
								</strong>
							</td>
						</tr>
						</table>
					</td>
				</tr>
        <? $top_content = new WebContent(WebContent::TOP_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($top_content->getContentCount() > 0) {?>
        <? $position = "top";?>
        <tr> 
          <td valign="top" colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr> 
                <td> 
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
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <? if($top_content->getTitle($n) != "") {?>
                    <? $title = urlencode($top_content->getTitle($n));?>
                    <tr> 
                      <td><table border="0" cellpadding="0" cellspacing="0" background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
                          <tr> 
                            <td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td>
                            <td rowspan="2"><table border="0" cellspacing="0" cellpadding="5">
                                <tr> 
                                  <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong> 
                                    <?=$top_content->getTitle($n)?>
                                    </strong></font></td>
                                </tr>
                              </table></td>
                            <td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td>
                          </tr>
                          <tr> 
                            <td></td>
                          </tr>
                        </table></td>
                    </tr>
                    <? }?>
                    <tr> 
                      <td> <table width="100%" border="<? if($top_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
                          <tr> 
                            <td bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><strong> 
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
                                    </strong> </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <br> 
                  <? }?>
                </td>
              </tr>
            </table>
            <strong> </strong></td>
        </tr>
        <? }?>
        <tr> 
          <? $middle_content = new WebContent(WebContent::MIDDLE_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($middle_content->getContentCount() > 0) {?>
          <? $position = "center";?>
          <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr> 
                <td> 
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
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <? if($middle_content->getTitle($n) != "") {?>
                    <? $title = urlencode($middle_content->getTitle($n));?>
                    <tr> 
                      <td><table border="0" cellpadding="0" cellspacing="0" background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
                          <tr> 
                            <td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td>
                            <td rowspan="2"><table border="0" cellspacing="0" cellpadding="5">
                                <tr> 
                                  <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong> 
                                    <?=$middle_content->getTitle($n)?>
                                    </strong></font></td>
                                </tr>
                              </table></td>
                            <td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td>
                          </tr>
                          <tr> 
                            <td></td>
                          </tr>
                        </table></td>
                    </tr>
                    <? }?>
                    <tr> 
                      <td><table width="100%" border="<? if($middle_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
                          <tr> 
                            <td bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><strong> 
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
                                    </strong> </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <br> 
                  <? }?>
                </td>
              </tr>
            </table>
            <strong> </strong></td>
          <? }?>
          <? $right_content = new WebContent(WebContent::RIGHT_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($right_content->getContentCount() > 0) {?>
          <? $position = "right";?>
          <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr> 
                <td> 
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
                  <br> <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <? if($right_content->getTitle($n) != "") {?>
                    <? $title = urlencode($right_content->getTitle($n));?>
                    <tr> 
                      <td><table border="0" cellpadding="0" cellspacing="0" background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
                          <tr> 
                            <td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td>
                            <td rowspan="2"><table border="0" cellspacing="0" cellpadding="5">
                                <tr> 
                                  <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong> 
                                    <?=$right_content->getTitle($n)?>
                                    </strong></font></td>
                                </tr>
                              </table></td>
                            <td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td>
                          </tr>
                          <tr> 
                            <td></td>
                          </tr>
                        </table></td>
                    </tr>
                    <? }?>
                    <tr> 
                      <td><table width="100%" border="<? if($right_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
                          <tr> 
                            <td bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><strong> 
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
                                    </strong> </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <br> <strong> 
                  <? }?>
                  </strong><br> </td>
              </tr>
            </table>
            <strong> </strong> </td>
          <? }?>
        </tr>
        <? $bottom_content = new WebContent(WebContent::BOTTOM_SECTION(),$Category,$SubCategory1,$SubCategory2);
		if ($bottom_content->getContentCount() > 0) {?>
        <? $position = "bottom";?>
        <tr> 
          <td valign="top" colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr> 
                <td> 
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
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <? if($bottom_content->getTitle($n) != "") {?>
                    <? $title = urlencode($bottom_content->getTitle($n));?>
                    <tr> 
                      <td><table border="0" cellpadding="0" cellspacing="0" background="<?=(_URLPATH . "themes/brushed_steel/")?>images/<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>">
                          <tr> 
                            <td align="left" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_left.gif"></td>
                            <td rowspan="2"><table border="0" cellspacing="0" cellpadding="5">
                                <tr> 
                                  <td nowrap><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong> 
                                    <?=$bottom_content->getTitle($n)?>
                                    </strong></font></td>
                                </tr>
                              </table></td>
                            <td rowspan="2" valign="top"><img src="<?=(_URLPATH . "themes/brushed_steel/")?>images/corner_top_right.gif" width="20" height="20"></td>
                          </tr>
                          <tr> 
                            <td></td>
                          </tr>
                        </table></td>
                    </tr>
                    <? }?>
                    <tr> 
                      <td><table width="100%" border="<? if($bottom_content->getType($n) == "Frame") {?>1<? } else {?>0<? }?>" cellpadding="2" cellspacing="0" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
                          <tr> 
                            <td bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>"> 
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><strong> 
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
                                    </strong> </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <br> 
                  <? }?>
                </td>
              </tr>
            </table>
            <strong> </strong></td>
        </tr>
        <? }?>
      </table></td>
  </tr>
</table>

