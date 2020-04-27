<?php
if (isset($prop["shipping_method"]))
	$method = explode(",",$prop["shipping_method"]);
if (isset($prop["international_shipping_method"]))
	$int_method = explode(",",$prop["international_shipping_method"]);
if (isset($prop["additional_services"]))
	$add_svc = explode(",",$prop["additional_services"]);
?>
 
<form action="update_settings.php?Tab=<?=$Tab?>" method="post" name="ShippingForm" id="ShippingForm">
  <p><strong>Shipping Mode:</strong> 
    <select name="shipping_mode" id="shipping_mode" onChange="changeShippingMode(this.value);">
      <option value="auto" <? if ((isset($shipping_mode) && $shipping_mode == "auto") || (!isset($shipping_mode) && isset($prop["shipping_mode"]) && $prop["shipping_mode"] == "auto") || !isset($shipping_mode)) {?>selected<? }?>>Auto</option>
      <option value="manual" <? if ((isset($shipping_mode) && $shipping_mode == "manual") || (!isset($shipping_mode) && isset($prop["shipping_mode"]) && $prop["shipping_mode"] == "manual")) {?>selected<? }?>>Manual</option>
    </select>
  </p>
  <? if ((isset($shipping_mode) && $shipping_mode == "auto") || (!isset($shipping_mode) && isset($prop["shipping_mode"]) && $prop["shipping_mode"] == "auto") || (!isset($shipping_mode) && !isset($prop["shipping_mode"]))) {?>
  <p><strong>Shipping Vendor:</strong> UPS (United Parcel Service)</p>
  <p><strong>Shipping Method:</strong></p>
  <blockquote> 
    <p> 
      <input name="shipping_method[]" type="checkbox" id="shipping_method[]" value="Ground" <? if ((isset($method) && array_search("Ground",$method) > -1) || !isset($method)) {?>checked<? }?>>
      Ground</p>
    <p> 
      <input name="shipping_method[]" type="checkbox" id="shipping_method[]" value="3 Day Select" <? if ((isset($method) && array_search("3 Day Select",$method) > -1) || !isset($method)) {?>checked<? }?>>
      3 Day Select</p>
    <p> 
      <input name="shipping_method[]" type="checkbox" id="shipping_method[]" value="2nd Day Air" <? if ((isset($method) && array_search("2nd Day Air",$method) > -1) || !isset($method)) {?>checked<? }?>>
      2nd Day Air</p>
    <p> 
      <input name="shipping_method[]" type="checkbox" id="shipping_method[]" value="2nd Day Air A.M." <? if ((isset($method) && array_search("2nd Day Air A.M.",$method) > -1) || !isset($method)) {?>checked<? }?>>
      2nd Day Air A.M.</p>
    <p> 
      <input name="shipping_method[]" type="checkbox" id="shipping_method[]" value="Next Day Air Saver" <? if ((isset($method) && array_search("Next Day Air Saver",$method) > -1) || !isset($method)) {?>checked<? }?>>
      Next Day Air Saver</p>
    <p> 
      <input name="shipping_method[]" type="checkbox" id="shipping_method[]" value="Next Day Air" <? if ((isset($method) && array_search("Next Day Air",$method) > -1) || !isset($method)) {?>checked<? }?>>
      Next Day Air</p>
  </blockquote>
	<p><strong>International Shipping Method:</strong></p>
  <blockquote> 
    <p> 
      <input name="international_shipping_method[]" type="checkbox" id="international_shipping_method[]" value="Worldwide Express" <? if ((isset($int_method) && array_search("Worldwide Express",$int_method) > -1) || !isset($int_method)) {?>checked<? }?>>
      Worldwide Express</p>
    <p> 
      <input name="international_shipping_method[]" type="checkbox" id="international_shipping_method[]" value="Worldwide Expedited" <? if ((isset($int_method) && array_search("Worldwide Expedited",$int_method) > -1) || !isset($int_method)) {?>checked<? }?>>
      Worldwide Expedited</p>
    <p> 
      <input name="international_shipping_method[]" type="checkbox" id="international_shipping_method[]" value="Canada Standard" <? if ((isset($int_method) && array_search("Canada Standard",$int_method) > -1) || !isset($int_method)) {?>checked<? }?>>
      Canada Standard</p>
  </blockquote>
	<p><strong>Additional Services: </strong></p>
  <blockquote> 
    <p> 
      <input name="additional_services[]" type="checkbox" id="additional_services[]" value="Saturday Delivery" <? if ((isset($add_svc) && array_search("Saturday Delivery",$add_svc) > -1)) {?>checked<? }?>>
      Saturday Delivery (Additional $12.50)</p>
  </blockquote>
	<p><strong>Shipping Origin Region:</strong> 
      <select name="origin_region">
			  <option value="">-Select Region-</option>
			  <option value="Western U.S." <? if (isset($prop["origin_region"]) && $prop["origin_region"] == "Western U.S.") {?>selected<? }?>>Western U.S. 
			  </option>
			  <option value="Eastern U.S." <? if (isset($prop["origin_region"]) && $prop["origin_region"] == "Eastern U.S.") {?>selected<? }?>>Eastern U.S. 
			  </option>			
	    </select>
  </p>
	<p><strong>Shipping Origin State:</strong> 
    <select name="origin_state">
			<option value="">-Select State-</option>
			<option value="AL" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "AL") {?>selected<? }?>>AL-Alabama 
			</option>
			<option value="AK" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "AK") {?>selected<? }?>>AK-Alaska 
			</option>
			<option value="AZ" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "AZ") {?>selected<? }?>>AZ-Arizona 
			</option>
			<option value="AR" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "AR") {?>selected<? }?>>AR-Arkansas 
			</option>
			<option value="CA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "CA") {?>selected<? }?>>CA-California 
			</option>
			<option value="CO" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "CO") {?>selected<? }?>>CO-Colorado 
			</option>
			<option value="CT" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "CT") {?>selected<? }?>>CT-Connecticut 
			</option>
			<option value="DC" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "DC") {?>selected<? }?>>DC-Washington 
			D.C. </option>
			<option value="DE" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "DE") {?>selected<? }?>>DE-Delaware 
			</option>
			<option value="FL" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "FL") {?>selected<? }?>>FL-Florida 
			</option>
			<option value="GA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "GA") {?>selected<? }?>>GA-Georgia 
			</option>
			<option value="HI" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "HI") {?>selected<? }?>>HI-Hawaii 
			</option>
			<option value="ID" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "ID") {?>selected<? }?>>ID-Idaho 
			</option>
			<option value="IL" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "IL") {?>selected<? }?>>IL-Illinois 
			</option>
			<option value="IN" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "IN") {?>selected<? }?>>IN-Indiana 
			</option>
			<option value="IA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "IA") {?>selected<? }?>>IA-Iowa 
			</option>
			<option value="KS" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "KS") {?>selected<? }?>>KS-Kansas 
			</option>
			<option value="KY" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "KY") {?>selected<? }?>>KY-Kentucky 
			</option>
			<option value="LA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "LA") {?>selected<? }?>>LA-Louisiana 
			</option>
			<option value="ME" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "ME") {?>selected<? }?>>ME-Maine 
			</option>
			<option value="MD" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MD") {?>selected<? }?>>MD-Maryland 
			</option>
			<option value="MA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MA") {?>selected<? }?>>MA-Massachusetts 
			</option>
			<option value="MI" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MI") {?>selected<? }?>>MI-Michigan 
			</option>
			<option value="MN" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MN") {?>selected<? }?>>MN-Minnesota 
			</option>
			<option value="MS" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MS") {?>selected<? }?>>MS-Mississippi 
			</option>
			<option value="MO" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MO") {?>selected<? }?>>MO-Missouri 
			</option>
			<option value="MT" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "MT") {?>selected<? }?>>MT-Montana 
			</option>
			<option value="NE" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NE") {?>selected<? }?>>NE-Nebraska 
			</option>
			<option value="NV" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NV") {?>selected<? }?>>NV-Nevada 
			</option>
			<option value="NH" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NH") {?>selected<? }?>>NH-New 
			Hampshire </option>
			<option value="NJ" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NJ") {?>selected<? }?>>NJ-New 
			Jersey </option>
			<option value="NM" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NM") {?>selected<? }?>>NM-New 
			Mexico </option>
			<option value="NY" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NY") {?>selected<? }?>>NY-New 
			York </option>
			<option value="NC" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "NC") {?>selected<? }?>>NC-North 
			Carolina </option>
			<option value="ND" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "ND") {?>selected<? }?>>ND-North 
			Dakota </option>
			<option value="OH" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "OH") {?>selected<? }?>>OH-Ohio 
			</option>
			<option value="OK" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "OK") {?>selected<? }?>>OK-Oklahoma 
			</option>
			<option value="OR" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "OR") {?>selected<? }?>>OR-Oregon 
			</option>
			<option value="PA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "PA") {?>selected<? }?>>PA-Pennsylvania 
			</option>
			<option value="PR" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "PR") {?>selected<? }?>>PR-Puerto 
			Rico </option>
			<option value="RI" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "RI") {?>selected<? }?>>RI-Rhode 
			Island </option>
			<option value="SC" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "SC") {?>selected<? }?>>SC-South 
			Carolina </option>
			<option value="SD" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "SD") {?>selected<? }?>>SD-South 
			Dakota </option>
			<option value="TN" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "TN") {?>selected<? }?>>TN-Tennessee 
			</option>
			<option value="TX" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "TX") {?>selected<? }?>>TX-Texas 
			</option>
			<option value="UT" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "UT") {?>selected<? }?>>UT-Utah 
			</option>
			<option value="VT" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "VT") {?>selected<? }?>>VT-Vermont 
			</option>
			<option value="VA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "VA") {?>selected<? }?>>VA-Virginia 
			</option>
			<option value="WA" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "WA") {?>selected<? }?>>WA-Washington 
			</option>
			<option value="WV" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "WV") {?>selected<? }?>>WV-West 
			Virginia </option>
			<option value="WI" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "WI") {?>selected<? }?>>WI-Wisconsin 
			</option>
			<option value="WY" <? if (isset($prop["origin_state"]) && $prop["origin_state"] == "WY") {?>selected<? }?>>WY-Wyoming 
			</option>
	  </select>
	</p>
  <p><strong>Shipping Origin Zip Code:</strong> 
    <input name="origin_zipcode" type="text" id="origin_zipcode" size="5" value="<? if (isset($prop["origin_zipcode"])) {?><?=$prop["origin_zipcode"]?><? } else {?><?=$admin->getCompanyZip()?><? }?>">
  </p>
  <p> 
    <input name="free_shipping" type="checkbox" id="free_shipping" value="true" <? if (isset($prop["free_shipping"]) && $prop["free_shipping"] == "true") {?>checked<? }?>>
    <strong>Free UPS Ground shipping for:</strong></p>
  <blockquote> 
    <p> 
      <input name="free_shipping_category" type="radio" value="by price" <? if (isset($prop["free_shipping_category"]) && $prop["free_shipping_category"] == "by price") {?>checked<? } else if (!isset($prop["free_shipping_category"])) {?>checked<? }?>>
      Total Purchase equal and above: $ 
      <input name="price" type="text" id="price" value="<? if (isset($prop["free_shipping_price"])) {?><?=$prop["free_shipping_price"]?><? } else {?>0<? }?>">
	  <input name="group_shipping" type="checkbox" id="group_shipping" value="true" <? if (isset($prop["group_shipping"]) && $prop["group_shipping"] == "true") {?>checked<? }?>> Use Group Shipping Rate if total purchase below this price
    </p>
    <p> 
      <input type="radio" name="free_shipping_category" value="by city" <? if (isset($prop["free_shipping_category"]) && $prop["free_shipping_category"] == "by city") {?>checked<? }?>>
      City of: 
      <input name="city" type="text" id="city" value="<? if (isset($prop["free_shipping_city"])) {?><?=$prop["free_shipping_city"]?><? }?>">
    </p>
    <p> 
      <input type="radio" name="free_shipping_category" value="by zip" <? if (isset($prop["free_shipping_category"]) && $prop["free_shipping_category"] == "by zip") {?>checked<? }?>>
      Zip code between 
      <input name="zip1" type="text" id="zip1" size="5" maxlength="5" value="<? if (isset($prop["free_shipping_zip"])) {?><?=strtok($prop["free_shipping_zip"],"-")?><? }?>">
      to 
      <input name="zip2" type="text" id="zip2" size="5" maxlength="5" value="<? if (isset($prop["free_shipping_zip"])) {?><?=strtok("-")?><? }?>">
    </p>
  </blockquote>
	<p> 
    <input name="extra_shipping" type="checkbox" id="extra_shipping" value="true" <? if (isset($prop["extra_shipping"]) && $prop["extra_shipping"] == "true") {?>checked<? }?>>
    <strong>Extra shipping $ 
    <input name="extra_shipping_fee" type="text" id="extra_shipping_fee" size="5" value="<? if (isset($prop["extra_shipping_fee"])) {?><?=$prop["extra_shipping_fee"]?><? }?>">
    for:</strong></p>
  <blockquote> 
    <p> 
      <input name="extra_shipping_category" type="radio" value="by weight" <? if (isset($prop["extra_shipping_category"]) && $prop["extra_shipping_category"] == "by weight") {?>checked<? } else if (!isset($prop["extra_shipping_category"])) {?>checked<? }?>>
      Total weight above:  
      <input name="weight" type="weight" id="price" value="<? if (isset($prop["extra_shipping_weight"])) {?><?=$prop["extra_shipping_weight"]?><? } else {?>0<? }?>"> lbs.
    </p>
    <p> 
      <input type="radio" name="extra_shipping_category" value="by city" <? if (isset($prop["extra_shipping_category"]) && $prop["extra_shipping_category"] == "by city") {?>checked<? }?>>
      City of: 
      <input name="city" type="text" id="city" value="<? if (isset($prop["extra_shipping_city"])) {?><?=$prop["extra_shipping_city"]?><? }?>">
    </p>
    <p> 
      <input type="radio" name="extra_shipping_category" value="by zip" <? if (isset($prop["extra_shipping_category"]) && $prop["extra_shipping_category"] == "by zip") {?>checked<? }?>>
      Zip code between 
      <input name="zip1" type="text" id="zip1" size="5" maxlength="5" value="<? if (isset($prop["extra_shipping_zip"])) {?><?=strtok($prop["extra_shipping_zip"],"-")?><? }?>">
      to 
      <input name="zip2" type="text" id="zip2" size="5" maxlength="5" value="<? if (isset($prop["extra_shipping_zip"])) {?><?=strtok("-")?><? }?>">
    </p>
  </blockquote>
	<? } else {?>
  <p align="left"><strong>Enter your method of shipping rate calculation</strong>: 
    <select name="ship_rate_calc_method" id="ship_rate_calc_method" onChange="changeRateCalcMethod(this.form);">
      <option value="by product" <? if ((isset($ship_rate_calc_method) && $ship_rate_calc_method == "by product") || (!isset($ship_rate_calc_method) && isset($prop["ship_rate_calc_method"]) && $prop["ship_rate_calc_method"] == "by product")) {?>selected<? }?>>Calculate the shipping rate based on product</option>
      <option value="by total purchase" <? if ((isset($ship_rate_calc_method) && $ship_rate_calc_method == "by total purchase") || (!isset($ship_rate_calc_method) && isset($prop["ship_rate_calc_method"]) && $prop["ship_rate_calc_method"] == "by total purchase")) {?>selected<? }?>>Calculate the shipping rate based on total purchase</option>
      <option value="by weight" <? if ((isset($ship_rate_calc_method) && $ship_rate_calc_method == "by weight") || (!isset($ship_rate_calc_method) && isset($prop["ship_rate_calc_method"]) && $prop["ship_rate_calc_method"] == "by weight")) {?>selected<? }?>>Calculate the shipping rate based on weight</option>
	</select>
  </p>
	<? if ((isset($ship_rate_calc_method) && $ship_rate_calc_method == "by total purchase") || (!isset($ship_rate_calc_method) && isset($prop["ship_rate_calc_method"]) && $prop["ship_rate_calc_method"] == "by total purchase")) {?>
	<p>
    <input name="express_checkout" type="checkbox" value="yes" <? if ((isset($express_checkout) && $express_checkout == "yes") || (!isset($express_checkout) && isset($prop["express_checkout"]) && $prop["express_checkout"] == "yes")) {?>checked<? }?>>
    <strong>Express Check-Out</strong> (allow your customer to proceed check-out 
    in 1-click)</p>
  <p> <strong>Warning:</strong> By enabling express check-out, your client will 
    not be able to review their order nor entering any coupons or gift certificates. 
    <? }?>
    <? }?>
  </p>
  <blockquote>
    <p align="center"> 
      <input type="submit" name="Submit" value="Update">
      <input type="reset" name="Submit2" value="Reset">
    </p>
  </blockquote>
</form>

