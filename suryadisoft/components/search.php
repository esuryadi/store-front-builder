				<? $main_cat = WebContent::getMainCategory();?>
        <table align="center">

          <tr><td nowrap>

					<form action="mystore.php?Page=SearchResult" method="post" name="searchForm" id="searchForm">
					<strong>Search:</strong> 
          <select name="Category" id="Category">
						<option value="ALL" <? if (isset($Category) && $Category == "ALL") {?>selected<? }?>>All Products</option>
            <? for($z=0;$z<count($main_cat);$z++) {?>
						<option value="<?=$main_cat[$z]?>" <? if (isset($Category) && $Category == $main_cat[$z]) {?>selected<? }?>><?=$main_cat[$z]?></option>
						<? }?>     
					</select>       
          <input name="Keyword" type="text" id="Keyword">
          <input name="SearchButton" type="submit" id="SearchButton3" value="Go">    
					</form>
					</td></tr>
					</table>    