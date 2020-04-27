<form name="updateSettings" enctype="multipart/form-data" method="post" action="update_settings.php?Tab=<?=$Tab?>&AdvanceSettings=<?=$AdvanceSettings?>">
	<table width="60%" border="0" align="center" cellpadding="10" cellspacing="0">
    <tr>
		<td valign="top">
			<p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Themes:</strong><br>
			<select name="selected_theme" size="5" onChange="changeThemes(this.form);">
      <? for($i=0;$i<count($themes);$i++) {?>
      <option value="<?=$themes[$i]?>" <? if (isset($selected_theme) && $themes[$i] == $selected_theme) {?>selected<? }?>> 
			<?=ucwords(str_replace("_"," ",$themes[$i]))?>
			</option>
			<? }?>
			</select>
			</font>
			</p>
			<p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Color 
          Schemes:</strong><br> 
			<select name="selected_color_scheme" size="5" onChange="changeColorSchemes(this.form);">
      <? for($i=0;$i<count($color_schemes);$i++) {?>
      <option value="<?=$color_schemes[$i]?>" <? if (isset($selected_color_scheme) && $color_schemes[$i] == $selected_color_scheme) {?>selected<? }?>> 
			<?=ucwords(str_replace("_"," ",$color_schemes[$i]))?>
			</option>
			<? }?>
			</select>
			</font>
			</p>		
		</td>
		<td>
			<p align="center">
				<? if (isset($selected_theme) && $selected_theme == "custom") {?>
				<strong>Do not choose this option, unless you have Custom Store-Front Design</strong>
				<? } else {?>
				<? for($i=0;$i<count($properties);$i++) {
				$theme_prop = $properties[$i];
				$name = $selected_theme . "_" . str_replace(" ","_",strtolower($theme_prop["name"]));?>
				<? if ($theme_prop["name"] == "Preview Images") {?>
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../themes/<?=$theme->getDirectory($selected_theme)?>/images/<?=$theme_prop["value"]?>"> 
				</font> 
				<? break;
				}?>
				<? }?>
				<? }?>
			</p>
		</td>
	</tr>
	</table>
		
	<? if (isset($AdvanceSettings) && $AdvanceSettings == "true") {?> 
	<table width="100%" cellspacing="5" cellpadding="5">
		<? $n = 0; 
			for($i=0;$i<count($properties);$i++) {
			$theme_prop = $properties[$i];
			$name = $selected_theme . "_" . str_replace(" ","_",strtolower($theme_prop["name"]));?>
		<? if ($theme_prop["name"] != "Preview Images") {?>
		<? if (($n%2) == 0) {?>
		<tr> 
			<? }?>
			<td width="50%"> <table width="100%">
					<tr> 						
						<td width="50%"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 	
							<?=ucwords($theme_prop["name"])?>:</font>
						</td>
						<td width="50%"> <font face="Verdana, Arial, Helvetica, sans-serif"> 
							<? if ($selected_theme == "brushed_steel") {?>
							<? include("brushed_steel_theme_property.php"); ?>
							<? } else if ($selected_theme == "techno") {?>
							<? include("techno_theme_property.php"); ?>
							<? } else {?>
							<input type="text" name="<?=$name?>" value="<? if (isset($prop[$name]) && !isset($DefaultSettings) && !isset($ChangeColorScheme)) {?><?=$prop[$name]?><? } else {?><?=$theme_prop["value"]?><? }?>">
							<? }?>
							</font> 
							</td>							
					</tr>
				</table></td>
			<? if (($n%2) == 1) {?>
		</tr>
		<? }?>
		<? $n++;?>
		<? }?>
		<? }?>
		<tr>
			<td width="50%">
				<table width="100%">
				<tr>
					<td width="50%">
					<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 	
					Background Image:
					</font>
					</td>
					<td><input type="text" name="<?=$selected_theme?>_bg_img" value="<? if (isset($prop[($selected_theme . "_bg_img")]) && !isset($DefaultSettings) && !isset($ChangeColorScheme)) {?><?=$prop[($selected_theme . "_bg_img")]?><? }?>"> (Optional)</td>
				</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<? } else {?>
		<? for($i=0;$i<count($properties);$i++) {
			$theme_prop = $properties[$i];
			$name = $selected_theme . "_" . str_replace(" ","_",strtolower($theme_prop["name"]));?>
			<? if ($theme_prop["name"] != "Preview Images") {?>
			<input type="hidden" name="<?=$name?>" value="<? if (isset($prop[$name]) && !isset($DefaultSettings) && !isset($ChangeColorScheme)) {?><?=$prop[$name]?><? } else {?><?=$theme_prop["value"]?><? }?>">
			<? }?>
		<? }?>
	<? }?>
	<p align="center"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <input type="submit" name="Submit4" value="Update Settings">
    <? if (isset($AdvanceSettings) && $AdvanceSettings == "true") {?>
		<input type="button" name="defaultSettings" value="Default Settings" onClick="setDefaultSettings(this.form);">
    <input name="BasicSettingsButton" type="button" id="BasicSettingsButton" value="Basic Settings" onClick="setBasicSettings(this.form);">
		<? } else {?>
		<input name="AdvanceSettingsButton" type="button" id="AdvanceSettingsButton" value="Advance Settings" onClick="setAdvanceSettings(this.form);">
		<? }?>
    <input type="reset" name="Submit23" value="Reset">
    <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#themes_setting','help');">
    </font></p>
</form>
