<? $main_cat = WebContent::getMainCategory();?>
<form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm">
<table align="center" border="0" cellspacing="0" cellpadding="3">
<tr> 
	<td><strong>Search:</strong></td>
	<td align="right"><strong>Category:</strong></td>
	<td> <select name="Category" id="Category">
			<option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All 
			Products</option>
			<? for($z=0;$z<count($main_cat);$z++) {?>
			<option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>> 
			<?=$main_cat[$z]?>
			</option>
			<? }?>
		</select> </td>
	<td align="right"><b>Keywords</b>: </td>
	<td nowrap><input name="Keyword" type="text" id="Keyword" size="12"> <input name="SearchButton" type="submit" id="SearchButton3" value="Go"></td>
</tr>
</table>
</form>
  