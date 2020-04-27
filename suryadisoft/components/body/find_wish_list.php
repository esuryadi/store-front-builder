<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td>
			<? if (!$found) {?>
			<font size="-1">Sorry, there is no wish list for <?=$FirstName?> <?=$LastName?>.</font>
			<p align="center">
			<table border="0" cellpadding="0" cellspacing="1" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>" dwcopytype="CopyTableRow">
      <tr> 
      	<td><table border="0" cellpadding="5" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
          <tr> 
            <td align="center" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>" size="-1"><strong>Find Wish 
              List</strong></font></td>
          </tr>
          <tr> 
            <td><form name="findWishListForm" method="post" action="mystore.php?Page=FindWishList">
                <table border="0" cellspacing="5" cellpadding="5">
          <tr> 
                    <td align="right" nowrap><font size="-1">First Name:</font></td>
                    <td> <font size="-1"> 
                      <input type="text" name="FirstName" size="12">
                      </font></td>
                  </tr>
                  <tr> 
                    <td align="right" nowrap><font size="-1">Last Name:</font></td>
                    <td> <font size="-1"> 
                      <input type="text" name="LastName" size="12">
                      </font></td>
                  </tr>
                  <tr> 
                    <td colspan="2"> <div align="center"> <font size="-1"> 
                <input type="submit" name="Find" value="Find">
                <input type="reset" name="Reset" value="Reset">
                        </font></div></td>
							</tr>
						</table>
									</form></td>
							</tr>
						</table></td>
				</tr>
			</table>
			</p>
			<? }?>
		</td>
  </tr>
</table>
