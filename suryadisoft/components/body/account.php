

		

<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td><p> <font size="-1"> 
		<? if (isset($user)) {?>
  </font>
		  <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
    <td width="17%" valign="top"> <p><font size="-1"><a href="mystore.php?Page=Account&Action=View&Link=AccountInfo">Account 
        Info</a></font></p>
      <p><font size="-1"><a href="mystore.php?Page=Account&Action=ViewOrder&Link=PurchaseHistory">Purchase 
        History</a></font></p></td>
    <td width="83%" valign="top"> <font size="-1">
			<? if (!isset($Link) || $Link == "AccountInfo") {?>
				<h3>Customer Information:</h3>
				<? if (!isset($Action) || $Action == "View" || $Action == "Update") {?>
					<? if ($customer->getLastName() == "") {?>
      </font>
      <blockquote> <font size="-1"><b>There currently no customer information 
        data.</b> </font></blockquote>
      <font size="-1">
					<? } else {?>
      </font>
      <blockquote> <font size="-1"><b>
        <?=$customer->getFirstName()?>
        <? if ($customer->getMiddleInitial() != "") {?>
        <?=$customer->getMiddleInitial()?>
					<? }?>							
        <?=$customer->getLastName()?>
        </b><br>
        <?=$customer->getAddress1()?>
        <br>
        <? if ($customer->getAddress2()) {?>
        <?=$customer->getAddress2()?>
        <br>
        <? }?>
        <?=$customer->getCity()?>
        , 
        <?=$customer->getState()?>
        <?=$customer->getZip()?>
        <br>
        <?=$customer->getCountry()?>
        <br>
        <b>Phone:</b> 
        <?=$customer->getDayPhone()?>
        <br>
        <? if ($customer->getEveningPhone() != "") {?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <?=$customer->getEveningPhone()?>
        <br>
        <? }?>
        <? if ($customer->getFax() != "") {?>
        <b>Fax:</b> 
        <?=$customer->getFax()?>
        <br>
        <? }?>
        <b>Email:</b> 
        <?=$customer->getEmail()?>
        </font></blockquote>
      <font size="-1">
      <? }?>
      </font>
      <p align="left"> <font size="-1">
              <input type="button" name="editButton" value="Edit Customer Information" onClick="MM_goToURL('parent','mystore.php?Page=Account&Action=Edit&amp;Link=AccountInfo');return document.MM_returnValue">
        </font></p>
      <font size="-1">
				<? } else if ($Action == "Edit") {?>
      </font>
				<blockquote>
					<form method="POST" action="mystore.php?Page=Account&Action=Update&Link=AccountInfo">
					<table width="0" border="0" cellspacing="0" cellpadding="5">
            <tr> 
              <td width="111" align="right"><font size="-1"><b>First Name:</b></font></td>
              <td width="112"> <font size="-1">
                <input type="text" name="FirstName" value="<?=$customer->getFirstName()?>" size="12">
                </font></td>
              <td width="53"><font size="-1"><b>M.I.</b></font></td>
              <td width="20"> <font size="-1">
                <input type="text" name="MiddleInitial" value="<?=$customer->getMiddleInitial()?>" size="1">
                </font></td>
              <td width="116"><font size="-1"><b>Last Name:</b></font></td>
              <td width="114"> <font size="-1">
                <input type="text" name="LastName" value="<?=$customer->getLastName()?>" size="12">
                </font></td>
            </tr>
            <tr> 
              <td width="111" align="right"><font size="-1"><b>Address:</b></font></td>
                    <td colspan="5" nowrap> <font size="-1"> 
                      <input type="text" name="Address1" value="<?=$customer->getAddress1()?>" size="70">
                      </font> </td>
            </tr>
            <tr> 
              <td width="111" align="right">&nbsp;</td>
                    <td colspan="5" nowrap> <font size="-1"> 
                      <input type="text" name="Address2" value="<?=$customer->getAddress2()?>" size="70">
                      </font></td>
            </tr>
            <tr> 
              <td width="111" align="right">&nbsp;</td>
                    <td colspan="5" nowrap><font size="-1"><b>City: 
                      <input type="text" name="City" value="<?=$customer->getCity()?>" size="20">
                State: 
                <select name="State">
                  <option value="">-Select State-</option>
                  <option value="AL" <? if ($customer->getState() == "AL") {?>selected<? }?>>AL-Alabama 
                  </option>
                  <option value="AK" <? if ($customer->getState() == "AK") {?>selected<? }?>>AK-Alaska 
                  </option>
                  <option value="AZ" <? if ($customer->getState() == "AZ") {?>selected<? }?>>AZ-Arizona 
                  </option>
                  <option value="AR" <? if ($customer->getState() == "AR") {?>selected<? }?>>AR-Arkansas 
                  </option>
                  <option value="CA" <? if ($customer->getState() == "CA") {?>selected<? }?>>CA-California 
                  </option>
                  <option value="CO" <? if ($customer->getState() == "CO") {?>selected<? }?>>CO-Colorado 
                  </option>
                  <option value="CT" <? if ($customer->getState() == "CT") {?>selected<? }?>>CT-Connecticut 
                  </option>
                  <option value="DC" <? if ($customer->getState() == "DC") {?>selected<? }?>>DC-Washington 
                  D.C. </option>
                  <option value="DE" <? if ($customer->getState() == "DE") {?>selected<? }?>>DE-Delaware 
                  </option>
                  <option value="FL" <? if ($customer->getState() == "FL") {?>selected<? }?>>FL-Florida 
                  </option>
                  <option value="GA" <? if ($customer->getState() == "GA") {?>selected<? }?>>GA-Georgia 
                  </option>
                  <option value="HI" <? if ($customer->getState() == "HI") {?>selected<? }?>>HI-Hawaii 
                  </option>
                  <option value="ID" <? if ($customer->getState() == "ID") {?>selected<? }?>>ID-Idaho 
                  </option>
                  <option value="IL" <? if ($customer->getState() == "IL") {?>selected<? }?>>IL-Illinois 
                  </option>
                  <option value="IN" <? if ($customer->getState() == "IN") {?>selected<? }?>>IN-Indiana 
                  </option>
                  <option value="IA" <? if ($customer->getState() == "IA") {?>selected<? }?>>IA-Iowa 
                  </option>
                  <option value="KS" <? if ($customer->getState() == "KS") {?>selected<? }?>>KS-Kansas 
                  </option>
                  <option value="KY" <? if ($customer->getState() == "KY") {?>selected<? }?>>KY-Kentucky 
                  </option>
                  <option value="LA" <? if ($customer->getState() == "LA") {?>selected<? }?>>LA-Louisiana 
                  </option>
                  <option value="ME" <? if ($customer->getState() == "ME") {?>selected<? }?>>ME-Maine 
                  </option>
                  <option value="MD" <? if ($customer->getState() == "MD") {?>selected<? }?>>MD-Maryland 
                  </option>
                  <option value="MA" <? if ($customer->getState() == "MA") {?>selected<? }?>>MA-Massachusetts 
                  </option>
                  <option value="MI" <? if ($customer->getState() == "MI") {?>selected<? }?>>MI-Michigan 
                  </option>
                  <option value="MN" <? if ($customer->getState() == "MN") {?>selected<? }?>>MN-Minnesota 
                  </option>
                  <option value="MS" <? if ($customer->getState() == "MS") {?>selected<? }?>>MS-Mississippi 
                  </option>
                  <option value="MO" <? if ($customer->getState() == "MO") {?>selected<? }?>>MO-Missouri 
                  </option>
                  <option value="MT" <? if ($customer->getState() == "MT") {?>selected<? }?>>MT-Montana 
                  </option>
                  <option value="NE" <? if ($customer->getState() == "NE") {?>selected<? }?>>NE-Nebraska 
                  </option>
                  <option value="NV" <? if ($customer->getState() == "NV") {?>selected<? }?>>NV-Nevada 
                  </option>
                  <option value="NH" <? if ($customer->getState() == "NH") {?>selected<? }?>>NH-New 
                  Hampshire </option>
                  <option value="NJ" <? if ($customer->getState() == "NJ") {?>selected<? }?>>NJ-New 
                  Jersey </option>
                  <option value="NM" <? if ($customer->getState() == "NM") {?>selected<? }?>>NM-New 
                  Mexico </option>
                  <option value="NY" <? if ($customer->getState() == "NY") {?>selected<? }?>>NY-New 
                  York </option>
                  <option value="NC" <? if ($customer->getState() == "NC") {?>selected<? }?>>NC-North 
                  Carolina </option>
                  <option value="ND" <? if ($customer->getState() == "ND") {?>selected<? }?>>ND-North 
                  Dakota </option>
                  <option value="OH" <? if ($customer->getState() == "OH") {?>selected<? }?>>OH-Ohio 
                  </option>
                  <option value="OK" <? if ($customer->getState() == "OK") {?>selected<? }?>>OK-Oklahoma 
                  </option>
                  <option value="OR" <? if ($customer->getState() == "OR") {?>selected<? }?>>OR-Oregon 
                  </option>
                  <option value="PA" <? if ($customer->getState() == "PA") {?>selected<? }?>>PA-Pennsylvania 
                  </option>
                  <option value="PR" <? if ($customer->getState() == "PR") {?>selected<? }?>>PR-Puerto 
                  Rico </option>
                  <option value="RI" <? if ($customer->getState() == "RI") {?>selected<? }?>>RI-Rhode 
                  Island </option>
                  <option value="SC" <? if ($customer->getState() == "SC") {?>selected<? }?>>SC-South 
                  Carolina </option>
                  <option value="SD" <? if ($customer->getState() == "SD") {?>selected<? }?>>SD-South 
                  Dakota </option>
                  <option value="TN" <? if ($customer->getState() == "TN") {?>selected<? }?>>TN-Tennessee 
                  </option>
                  <option value="TX" <? if ($customer->getState() == "TX") {?>selected<? }?>>TX-Texas 
                  </option>
                  <option value="UT" <? if ($customer->getState() == "UT") {?>selected<? }?>>UT-Utah 
                  </option>
                  <option value="VT" <? if ($customer->getState() == "VT") {?>selected<? }?>>VT-Vermont 
                  </option>
                  <option value="VA" <? if ($customer->getState() == "VA") {?>selected<? }?>>VA-Virginia 
                  </option>
                  <option value="WA" <? if ($customer->getState() == "WA") {?>selected<? }?>>WA-Washington 
                  </option>
                  <option value="WV" <? if ($customer->getState() == "WV") {?>selected<? }?>>WV-West 
                  Virginia </option>
                  <option value="WI" <? if ($customer->getState() == "WI") {?>selected<? }?>>WI-Wisconsin 
                  </option>
                  <option value="WY" <? if ($customer->getState() == "WY") {?>selected<? }?>>WY-Wyoming 
                  </option>
                </select>
                Zip: 
                <input type="text" name="Zip" value="<?=$customer->getZip()?>" size="5">
                      </b></font></td>
            </tr>
            <tr> 
              <td width="111" align="right">&nbsp;</td>
                    <td colspan="5" nowrap><font size="-1"><b>Province: 
                      <input name="Province" type="text" value="<? if ($customer->getProvince() != "") {?><?=$customer->getProvince()?><? }?>" id="Province" size="15">
                      </b><font size="-2"> (if now within U.S)</font><b> Country: 
                      <input name="Country" type="text" value="<? if ($customer->getCountry() == "") {?>United States<? } else {?><?=$customer->getCountry()?><? }?>" size="15">
                      </b></font></td>
            </tr>
            <tr> 
              <td width="111" align="right"><font size="-1"><b>Phone:</b></font></td>
              <td width="112"> <font size="-1">
                <input type="text" name="DayPhone" value="<?=$customer->getDayPhone()?>" size="12">
                </font></td>
              <td colspan="4"><font size="-1"><b>(Day) </b></font></td>
            </tr>
            <tr> 
              <td width="111" align="right">&nbsp;</td>
              <td width="112"> <font size="-1">
                <input type="text" name="EveningPhone" value="<?=$customer->getEveningPhone()?>" size="12">
                </font></td>
              <td colspan="4"><font size="-1"><b>(Evening)</b></font></td>
            </tr>
            <tr> 
              <td width="111" align="right"><font size="-1"><b>Fax:</b></font></td>
              <td width="112"> <font size="-1">
                <input type="text" name="Fax" value="<?=$customer->getFax()?>" size="12">
                </font></td>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr> 
              <td width="111" align="right"><font size="-1"><b>E-mail:</b></font></td>
              <td colspan="5"> <font size="-1">
                <input type="text" name="Email" value="<?=$customer->getEmail()?>" size="40">
                </font></td>
            </tr>
            <tr>               
              <td colspan="6"> <div align="center"> <font size="-1">
                <input type="submit" name="Submit" value="Update">
                <input type="reset" name="Submit2" value="Reset">
                  </font></div></td>
            </tr>
          </table>
					</form>
				</blockquote>
      <font size="-1">
				<? }?>
			<? } else if ($Link == "PurchaseHistory") {?>
				<? if ($Action == "ViewOrder") {?>
      </font>
      <table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
              <tr>
                <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="14%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>"><strong>Order 
                  #</strong> </font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="27%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Date Ordered</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="22%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Current Status</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="24%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Tracking Number</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="13%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Total</font></th>
					</tr>
					<? $transaction_id = $transaction->getTransactionId();
					$transaction_date_time = $transaction->getDateTime();
					$transaction_status = $transaction->getStatus();
					$transaction_tracking_number = $transaction->getTrackingNumber();
					$transaction_total_charges = $transaction->getTotalCharges(); ?>
					<? for($i=0;$i<count($transaction_date_time);$i++) {?>
					<tr>
          <td width="14%" align="center"> <font size="-1"><a href="mystore.php?Page=Account&Action=ViewPurchase&Link=PurchaseHistory&transaction_id=<?=$transaction_id[$i]?>">
            <?=$transaction_id[$i]?>
            </a> </font></td>
          <td width="27%" align="center"> <font size="-1">
                  <?=$transaction_date_time[$i]?>
            </font></td>
          <td width="22%" align="center"> <font size="-1">
                  <?=$transaction_status[$i]?>
            </font></td>
          <td width="24%" align="center"> <font size="-1">
                  <?=$transaction_tracking_number[$i]?>
            </font></td>
          <td width="13%" align="right" nowrap><font size="-1"> $ 
                  <?=$transaction_total_charges[$i]?>
            </font></td>
					</tr>
					<? }?>
				</table>
      <font size="-1">
				    <? } else if ($Action == "ViewPurchase") {?>
      </font>
      <table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
              <tr>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="59%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Item</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="3%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Quantity</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="12%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Price</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="12%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Total</font></th>
          <th <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>" width="14%"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Status</font></th>
              </tr>
							<? $product = new Product(); 
							$product_id = $purchase->getProductId();
							$quantity = $purchase->getQuantity();
							$total = $purchase->getCharges();
							$status = $purchase->getStatus();?>
							<? for($i=0;$i<count($product_id);$i++) {
								$product->setUser((isset($user))?$user:"");
								$prod = $product->getProduct($product_id[$i]);?>
              <tr>
          <td width="59%"><font size="-1">
            <?=$prod["name"]?>
            </font></td>
          <td width="3%"><font size="-1">
            <?=$quantity[$i]?>
            </font></td>
          <td width="12%"><font size="-1">
            <?=$prod["price"]?>
            </font></td>
          <td width="12%"><font size="-1">
            <?=$total[$i]?>
            </font></td>
          <td width="14%"><font size="-1">
            <?=$status[$i]?>
            </font></td>
              </tr>
							<? }?>
            </table>
      <font size="-1">
            <? }?>
            <? }?>
      </font></td>
		</tr>
		</table>
<font size="-1">
		  <? }?>
      </font> <p> </td>
  </tr>
</table>
