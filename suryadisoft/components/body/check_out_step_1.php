<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td>
 			<font size="-1"><b>Please enter the following information:</b></font></p>
      <form name="customerForm" method="post" action="mystore.php?Page=CheckOut2">
	<? if (WebContent::getPropertyValue("ask_cust_info") == "" || WebContent::getPropertyValue("ask_cust_info") == "yes") {?>
  <h2><font size="-1">Customer Information:</font></h2>
				<blockquote>
					<table border="0" cellspacing="0" cellpadding="5">
            <tr> 
              <td><font size="-1"><b>First Name:</b></font></td>
              <td nowrap> <font size="-1"> 
                <input type="text" name="FirstName" value="<?=$first_name?>" size="12">
                <font color="#FF0000"><b>*</b></font></font> 
				<? if (WebContent::getPropertyValue("ask_middle_name") == "no") {?>
				<input type="hidden" name="MiddleInitial" value="">
				<? } else {?>
				<font size="-1"><b>M.I.</b></font> 
                <font size="-1"> 
                <input type="text" name="MiddleInitial" value="<?=$customer->getMiddleInitial()?>" size="1">
                </font>
				<? }?>
				<font size="-1"><b>Last Name:</b></font> <font size="-1"> 
                <input type="text" name="LastName" value="<?=$last_name?>" size="12">
                <font color="#FF0000"><b>*</b></font></font> </td>
            </tr>
            <tr> 
              <td><font size="-1"><b>Address:</b></font></td>
              <td nowrap> <font size="-1"> 
                <input type="text" name="Address1" value="<?=$customer->getAddress1()?>" size="70">
                <font color="#FF0000"><b>*</b></font></font> </td>
            </tr>
			<? if (WebContent::getPropertyValue("ask_address_2") == "no") {?>
			<input type="hidden" name="Address2" value="">
			<? } else {?>
            <tr> 
              <td>&nbsp;</td>
              <td nowrap> <font size="-1"> 
                <input type="text" name="Address2" value="<?=$customer->getAddress2()?>" size="70">
                </font></td>
            </tr>
			<? }?>
            <tr> 
              <td>&nbsp;</td>
              <td nowrap><font size="-1"><b>City: 
                <input type="text" name="City" value="<?=$customer->getCity()?>" size="20">
				<? if (WebContent::getPropertyValue("ask_state") == "no") {?>
				<input type="hidden" name="State" value="">
				<? } else {?>
                <font color="#FF0000">*</font> State: 
                <select name="State">
                  <option value="">-Select US State-</option>
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
				  <option value="">-Select Canadian Province-</option>
				  <option value="AB" <? if ($customer->getState() == "AB") {?>selected<? }?>>AB-Alberta</option>
				  <option value="BC" <? if ($customer->getState() == "BC") {?>selected<? }?>>BC-British Columbia</option>
				  <option value="MB" <? if ($customer->getState() == "MB") {?>selected<? }?>>MB-Manitoba</option>
				  <option value="NB" <? if ($customer->getState() == "NB") {?>selected<? }?>>NB-New Brunswick</option>
				  <option value="NL" <? if ($customer->getState() == "NL") {?>selected<? }?>>NL-Newfoundland</option>
				  <option value="NT" <? if ($customer->getState() == "NT") {?>selected<? }?>>NT-Northwest Territories</option>
				  <option value="NS" <? if ($customer->getState() == "NS") {?>selected<? }?>>NS-Nova Scotia</option>
				  <option value="NU" <? if ($customer->getState() == "NU") {?>selected<? }?>>NU-Nunavut</option>
				  <option value="ON" <? if ($customer->getState() == "ON") {?>selected<? }?>>ON-Ontario</option>
				  <option value="PE" <? if ($customer->getState() == "PE") {?>selected<? }?>>PE-Prince Edward Island</option>
				  <option value="QC" <? if ($customer->getState() == "QC") {?>selected<? }?>>QC-Quebec</option>
				  <option value="SK" <? if ($customer->getState() == "SK") {?>selected<? }?>>SK-Saskatchewan</option>
				  <option value="YT" <? if ($customer->getState() == "YT") {?>selected<? }?>>YT-Yukon</option>
				  <option value="">-Outside US & Canada-</option>
                </select>
				<? }?>
                <font color="#FF0000">*</font> Postal Code: 
                <input type="text" name="Zip" value="<?=$customer->getZip()?>" size="5">
                <font color="#FF0000">*</font> </b> </font></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td nowrap>
			  	<? if (WebContent::getPropertyValue("ask_province") == "no") {?>
				<input type="hidden" name="Province" value="">
				<? } else {?>
				<font size="-1"><b>Province: 
                <input name="Province" type="text" value="<? if ($customer->getProvince() != "") {?><?=$customer->getProvince()?><? }?>" size="15">
                </b><font size="-2">(if not within U.S)</font>
				<? }?>
				<? if (WebContent::getPropertyValue("ask_country") == "no") {?>
				<input type="hidden" name="Country" value="">
				<? } else {?>
				<b> Country: 
                <select name="Country" onChange="disableState(this.form,'customer');">
					<option value="Albania" <? if ($customer->getCountry() == "Albania") {?>selected<? }?>>Albania</option>
					<option value="Algeria" <? if ($customer->getCountry() == "Algeria") {?>selected<? }?>>Algeria</option>
					<option value="American Samoa" <? if ($customer->getCountry() == "American Samoa") {?>selected<? }?>>American Samoa</option>
					<option value="Andorra" <? if ($customer->getCountry() == "Andorra") {?>selected<? }?>>Andorra</option>
					<option value="Angola" <? if ($customer->getCountry() == "Angola") {?>selected<? }?>>Angola</option>
					<option value="Anguilla" <? if ($customer->getCountry() == "Anguilla") {?>selected<? }?>>Anguilla</option>
					<option value="Antarctica" <? if ($customer->getCountry() == "") {?>selected<? }?>>Antarctica</option>
					<option value="Antigua and Barbuda" <? if ($customer->getCountry() == "Antigua and Barbuda") {?>selected<? }?>>Antigua and Barbuda</option>
					<option value="Argentina" <? if ($customer->getCountry() == "Argentina") {?>selected<? }?>>Argentina</option>
					<option value="Armenia" <? if ($customer->getCountry() == "Armenia") {?>selected<? }?>>Armenia</option>
					<option value="Aruba" <? if ($customer->getCountry() == "Aruba") {?>selected<? }?>>Aruba</option>
					<option value="Ascension" <? if ($customer->getCountry() == "Ascension") {?>selected<? }?>>Ascension</option>
					<option value="Australia" <? if ($customer->getCountry() == "Australia") {?>selected<? }?>>Australia</option>
					<option value="Austria" <? if ($customer->getCountry() == "Austria") {?>selected<? }?>>Austria</option>
					<option value="Azerbaijan" <? if ($customer->getCountry() == "Azerbaijan") {?>selected<? }?>>Azerbaijan</option>
					<option value="Bahamas" <? if ($customer->getCountry() == "Bahamas") {?>selected<? }?>>Bahamas</option>
					<option value="Bahrain" <? if ($customer->getCountry() == "Bahrain") {?>selected<? }?>>Bahrain</option>
					<option value="Bangladesh" <? if ($customer->getCountry() == "Bangladesh") {?>selected<? }?>>Bangladesh</option>
					<option value="Barbados" <? if ($customer->getCountry() == "Barbados") {?>selected<? }?>>Barbados</option>
					<option value="Belarus" <? if ($customer->getCountry() == "Belarus") {?>selected<? }?>>Belarus</option>
					<option value="Belgium" <? if ($customer->getCountry() == "Belgium") {?>selected<? }?>>Belgium</option>
					<option value="Belize" <? if ($customer->getCountry() == "Belize") {?>selected<? }?>>Belize</option>
					<option value="Benin, Republic of" <? if ($customer->getCountry() == "Benin, Republic of") {?>selected<? }?>>Benin, Republic of</option>
					<option value="Bermuda" <? if ($customer->getCountry() == "Bermuda") {?>selected<? }?>>Bermuda</option>
					<option value="Bhutan" <? if ($customer->getCountry() == "Bhutan") {?>selected<? }?>>Bhutan</option>
					<option value="Bolivia" <? if ($customer->getCountry() == "Bolivia") {?>selected<? }?>>Bolivia</option>
					<option value="Bosnia and Herzegovina" <? if ($customer->getCountry() == "Bosnia and Herzegovina") {?>selected<? }?>>Bosnia and Herzegovina</option>
					<option value="Botswana" <? if ($customer->getCountry() == "Botswana") {?>selected<? }?>>Botswana</option>
					<option value="Brazil" <? if ($customer->getCountry() == "Brazil") {?>selected<? }?>>Brazil</option>
					<option value="British Virgin Islands" <? if ($customer->getCountry() == "British Virgin Islands") {?>selected<? }?>>British Virgin Islands</option>
					<option value="Brunei" <? if ($customer->getCountry() == "Brunei") {?>selected<? }?>>Brunei</option>
					<option value="Bulgaria" <? if ($customer->getCountry() == "Bulgaria") {?>selected<? }?>>Bulgaria</option>
					<option value="Burkina Faso" <? if ($customer->getCountry() == "Burkina Faso") {?>selected<? }?>>Burkina Faso</option>
					<option value="Burundi" <? if ($customer->getCountry() == "Burundi") {?>selected<? }?>>Burundi</option>
					<option value="Cambodia" <? if ($customer->getCountry() == "Cambodia") {?>selected<? }?>>Cambodia</option>
					<option value="Cameroon" <? if ($customer->getCountry() == "Cameroon") {?>selected<? }?>>Cameroon</option>
					<option value="Canada" <? if ($customer->getCountry() == "Canada") {?>selected<? }?>>Canada</option>
					<option value="Cape Verde Islands" <? if ($customer->getCountry() == "Cape Verde Islands") {?>selected<? }?>>Cape Verde Islands</option>
					<option value="Cayman Islands" <? if ($customer->getCountry() == "Cayman Islands") {?>selected<? }?>>Cayman Islands</option>
					<option value="Central African Rep" <? if ($customer->getCountry() == "Central African Rep") {?>selected<? }?>>Central African Rep</option>
					<option value="Chad Republic" <? if ($customer->getCountry() == "Chad Republic") {?>selected<? }?>>Chad Republic</option>
					<option value="Chatham Island, NZ" <? if ($customer->getCountry() == "Chatham Island, NZ") {?>selected<? }?>>Chatham Island, NZ</option>
					<option value="Chile" <? if ($customer->getCountry() == "Chile") {?>selected<? }?>>Chile</option>
					<option value="China" <? if ($customer->getCountry() == "China") {?>selected<? }?>>China</option>
					<option value="Christmas Island" <? if ($customer->getCountry() == "Christmas Island") {?>selected<? }?>>Christmas Island</option>
					<option value="Cocos Islands" <? if ($customer->getCountry() == "Cocos Islands") {?>selected<? }?>>Cocos Islands</option>
					<option value="Colombia" <? if ($customer->getCountry() == "Colombia") {?>selected<? }?>>Colombia</option>
					<option value="Comoros" <? if ($customer->getCountry() == "Comoros") {?>selected<? }?>>Comoros</option>
					<option value="Congo" <? if ($customer->getCountry() == "Congo") {?>selected<? }?>>Congo</option>
					<option value="Cook Islands" <? if ($customer->getCountry() == "Cook Islands") {?>selected<? }?>>Cook Islands</option>
					<option value="Costa Rica" <? if ($customer->getCountry() == "Costa Rica") {?>selected<? }?>>Costa Rica</option>
					<option value="Croatia" <? if ($customer->getCountry() == "Croatia") {?>selected<? }?>>Croatia</option>
					<option value="Cuba" <? if ($customer->getCountry() == "Cuba") {?>selected<? }?>>Cuba</option>
					<option value="Curacao" <? if ($customer->getCountry() == "Curacao") {?>selected<? }?>>Curacao</option>
					<option value="Cyprus" <? if ($customer->getCountry() == "Cyprus") {?>selected<? }?>>Cyprus</option>
					<option value="Czech Republic" <? if ($customer->getCountry() == "Czech Republic") {?>selected<? }?>>Czech Republic</option>
					<option value="Denmark" <? if ($customer->getCountry() == "Denmark") {?>selected<? }?>>Denmark</option>
					<option value="Diego Garcia" <? if ($customer->getCountry() == "Diego Garcia") {?>selected<? }?>>Diego Garcia</option>
					<option value="Djibouti" <? if ($customer->getCountry() == "Djibouti") {?>selected<? }?>>Djibouti</option>
					<option value="Dominica" <? if ($customer->getCountry() == "Dominica") {?>selected<? }?>>Dominica</option>
					<option value="Dominican Republic" <? if ($customer->getCountry() == "Dominican Republic") {?>selected<? }?>>Dominican Republic</option>
					<option value="Easter Island" <? if ($customer->getCountry() == "Easter Island") {?>selected<? }?>>Easter Island</option>
					<option value="Ecuador" <? if ($customer->getCountry() == "Ecuador") {?>selected<? }?>>Ecuador</option>
					<option value="Egypt" <? if ($customer->getCountry() == "Egypt") {?>selected<? }?>>Egypt</option>
					<option value="El Salvador" <? if ($customer->getCountry() == "El Salvador") {?>selected<? }?>>El Salvador</option>
					<option value="Equitorial Guinea" <? if ($customer->getCountry() == "Equitorial Guinea") {?>selected<? }?>>Equitorial Guinea</option>
					<option value="Eritrea" <? if ($customer->getCountry() == "Eritrea") {?>selected<? }?>>Eritrea</option>
					<option value="Estonia" <? if ($customer->getCountry() == "Estonia") {?>selected<? }?>>Estonia</option>
					<option value="Ethiopia" <? if ($customer->getCountry() == "Ethiopia") {?>selected<? }?>>Ethiopia</option>
					<option value="Falkland Islands" <? if ($customer->getCountry() == "Falkland Islands") {?>selected<? }?>>Falkland Islands</option>
					<option value="Faroe Islands" <? if ($customer->getCountry() == "Faroe Islands") {?>selected<? }?>>Faroe Islands</option>
					<option value="Fiji Islands" <? if ($customer->getCountry() == "Fiji Islands") {?>selected<? }?>>Fiji Islands</option>
					<option value="Finland" <? if ($customer->getCountry() == "Finland") {?>selected<? }?>>Finland</option>
					<option value="France" <? if ($customer->getCountry() == "France") {?>selected<? }?>>France</option>
					<option value="French Antilles" <? if ($customer->getCountry() == "French Antilles") {?>selected<? }?>>French Antilles</option>
					<option value="French Guiana" <? if ($customer->getCountry() == "French Guiana") {?>selected<? }?>>French Guiana</option>
					<option value="French Polynesia" <? if ($customer->getCountry() == "French Polynesia") {?>selected<? }?>>French Polynesia</option>
					<option value="Gabon Republic" <? if ($customer->getCountry() == "Gabon Republic") {?>selected<? }?>>Gabon Republic</option>
					<option value="Gambia" <? if ($customer->getCountry() == "Gambia") {?>selected<? }?>>Gambia</option>
					<option value="Georgia" <? if ($customer->getCountry() == "Georgia") {?>selected<? }?>>Georgia</option>
					<option value="Germany" <? if ($customer->getCountry() == "Germany") {?>selected<? }?>>Germany</option>
					<option value="Ghana" <? if ($customer->getCountry() == "Ghana") {?>selected<? }?>>Ghana</option>
					<option value="Gibraltar" <? if ($customer->getCountry() == "Gibraltar") {?>selected<? }?>>Gibraltar</option>
					<option value="Greece" <? if ($customer->getCountry() == "Greece") {?>selected<? }?>>Greece</option>
					<option value="Greenland" <? if ($customer->getCountry() == "Greenland") {?>selected<? }?>>Greenland</option>
					<option value="Grenada and Carriacuou" <? if ($customer->getCountry() == "Grenada and Carriacuou") {?>selected<? }?>>Grenada and Carriacuou</option>
					<option value="Grenadin Islands" <? if ($customer->getCountry() == "Grenadin Islands") {?>selected<? }?>>Grenadin Islands</option>
					<option value="Guadeloupe" <? if ($customer->getCountry() == "Guadeloupe") {?>selected<? }?>>Guadeloupe</option>
					<option value="Guam" <? if ($customer->getCountry() == "Guam") {?>selected<? }?>>Guam</option>
					<option value="Guantanamo Bay" <? if ($customer->getCountry() == "Guantanamo Bay") {?>selected<? }?>>Guantanamo Bay</option>
					<option value="Guatemala" <? if ($customer->getCountry() == "Guatemala") {?>selected<? }?>>Guatemala</option>
					<option value="Guiana" <? if ($customer->getCountry() == "Guiana") {?>selected<? }?>>Guiana</option>
					<option value="Guinea, Bissau" <? if ($customer->getCountry() == "Guinea, Bissau") {?>selected<? }?>>Guinea, Bissau</option>
					<option value="Guinea, Rep" <? if ($customer->getCountry() == "Guinea, Rep") {?>selected<? }?>>Guinea, Rep</option>
					<option value="Guyana" <? if ($customer->getCountry() == "Guyana") {?>selected<? }?>>Guyana</option>
					<option value="Haiti" <? if ($customer->getCountry() == "Haiti") {?>selected<? }?>>Haiti</option>
					<option value="Honduras" <? if ($customer->getCountry() == "Honduras") {?>selected<? }?>>Honduras</option>
					<option value="Hong Kong" <? if ($customer->getCountry() == "Hong Kong") {?>selected<? }?>>Hong Kong</option>
					<option value="Hungary" <? if ($customer->getCountry() == "Hungary") {?>selected<? }?>>Hungary</option>
					<option value="Iceland" <? if ($customer->getCountry() == "Iceland") {?>selected<? }?>>Iceland</option>
					<option value="India" <? if ($customer->getCountry() == "India") {?>selected<? }?>>India</option>
					<option value="Indonesia" <? if ($customer->getCountry() == "Indonesia") {?>selected<? }?>>Indonesia</option>
					<option value="Inmarsat" <? if ($customer->getCountry() == "Inmarsat") {?>selected<? }?>>Inmarsat</option>
					<option value="Iran" <? if ($customer->getCountry() == "Iran") {?>selected<? }?>>Iran</option>
					<option value="Iraq" <? if ($customer->getCountry() == "Iraq") {?>selected<? }?>>Iraq</option>
					<option value="Ireland" <? if ($customer->getCountry() == "Ireland") {?>selected<? }?>>Ireland</option>
					<option value="Israel" <? if ($customer->getCountry() == "Israel") {?>selected<? }?>>Israel</option>
					<option value="Italy" <? if ($customer->getCountry() == "Italy") {?>selected<? }?>>Italy</option>
					<option value="Ivory Coast" <? if ($customer->getCountry() == "Ivory Coast") {?>selected<? }?>>Ivory Coast</option>
					<option value="Jamaica" <? if ($customer->getCountry() == "Jamaica") {?>selected<? }?>>Jamaica</option>
					<option value="Japan" <? if ($customer->getCountry() == "Japan") {?>selected<? }?>>Japan</option>
					<option value="Jordan" <? if ($customer->getCountry() == "Jordan") {?>selected<? }?>>Jordan</option>
					<option value="Kazakhstan" <? if ($customer->getCountry() == "Kazakhstan") {?>selected<? }?>>Kazakhstan</option>
					<option value="Kenya" <? if ($customer->getCountry() == "Kenya") {?>selected<? }?>>Kenya</option>
					<option value="Kiribati" <? if ($customer->getCountry() == "Kiribati") {?>selected<? }?>>Kiribati</option>
					<option value="Korea, North" <? if ($customer->getCountry() == "Korea, North") {?>selected<? }?>>Korea, North</option>
					<option value="Korea, South" <? if ($customer->getCountry() == "Korea, South") {?>selected<? }?>>Korea, South</option>
					<option value="Kuwait" <? if ($customer->getCountry() == "Kuwait") {?>selected<? }?>>Kuwait</option>
					<option value="Kyrgyzstan" <? if ($customer->getCountry() == "Kyrgyzstan") {?>selected<? }?>>Kyrgyzstan</option>
					<option value="Laos" <? if ($customer->getCountry() == "Laos") {?>selected<? }?>>Laos</option>
					<option value="Latvia" <? if ($customer->getCountry() == "Latvia") {?>selected<? }?>>Latvia</option>
					<option value="Lebanon" <? if ($customer->getCountry() == "Lebanon") {?>selected<? }?>>Lebanon</option>
					<option value="Lesotho" <? if ($customer->getCountry() == "Lesotho") {?>selected<? }?>>Lesotho</option>
					<option value="Liberia" <? if ($customer->getCountry() == "Liberia") {?>selected<? }?>>Liberia</option>
					<option value="Libya" <? if ($customer->getCountry() == "Libya") {?>selected<? }?>>Libya</option>
					<option value="Liechtenstein" <? if ($customer->getCountry() == "Liechtenstein") {?>selected<? }?>>Liechtenstein</option>
					<option value="Lithuania" <? if ($customer->getCountry() == "Lithuania") {?>selected<? }?>>Lithuania</option>
					<option value="Luxembourg" <? if ($customer->getCountry() == "Luxembourg") {?>selected<? }?>>Luxembourg</option>
					<option value="Macau" <? if ($customer->getCountry() == "Macau") {?>selected<? }?>>Macau</option>
					<option value="Macedonia, FYROM" <? if ($customer->getCountry() == "Macedonia, FYROM") {?>selected<? }?>>Macedonia, FYROM</option>
					<option value="Madagascar" <? if ($customer->getCountry() == "Madagascar") {?>selected<? }?>>Madagascar</option>
					<option value="Malawi" <? if ($customer->getCountry() == "Malawi") {?>selected<? }?>>Malawi</option>
					<option value="Malaysia" <? if ($customer->getCountry() == "Malaysia") {?>selected<? }?>>Malaysia</option>
					<option value="Maldives" <? if ($customer->getCountry() == "Maldives") {?>selected<? }?>>Maldives</option>
					<option value="Mali Republic" <? if ($customer->getCountry() == "Mali Republic") {?>selected<? }?>>Mali Republic</option>
					<option value="Malta" <? if ($customer->getCountry() == "Malta") {?>selected<? }?>>Malta</option>
					<option value="Mariana Islands" <? if ($customer->getCountry() == "Mariana Islands") {?>selected<? }?>>Mariana Islands</option>
					<option value="Marshall Islands" <? if ($customer->getCountry() == "Marshall Islands") {?>selected<? }?>>Marshall Islands</option>
					<option value="Martinique" <? if ($customer->getCountry() == "Martinique") {?>selected<? }?>>Martinique</option>
					<option value="Mauritania" <? if ($customer->getCountry() == "Mauritania") {?>selected<? }?>>Mauritania</option>
					<option value="Mauritius" <? if ($customer->getCountry() == "Mauritius") {?>selected<? }?>>Mauritius</option>
					<option value="Mayotte Island" <? if ($customer->getCountry() == "Mayotte Island") {?>selected<? }?>>Mayotte Island</option>
					<option value="Mexico" <? if ($customer->getCountry() == "Mexico") {?>selected<? }?>>Mexico</option>
					<option value="Micronesia, Fed States" <? if ($customer->getCountry() == "Micronesia, Fed States") {?>selected<? }?>>Micronesia, Fed States</option>
					<option value="Midway Islands" <? if ($customer->getCountry() == "Midway Islands") {?>selected<? }?>>Midway Islands</option>
					<option value="Miquelon" <? if ($customer->getCountry() == "Miquelon") {?>selected<? }?>>Miquelon</option>
					<option value="Moldova" <? if ($customer->getCountry() == "Moldova") {?>selected<? }?>>Moldova</option>
					<option value="Monaco" <? if ($customer->getCountry() == "Monaco") {?>selected<? }?>>Monaco</option>
					<option value="Mongolia" <? if ($customer->getCountry() == "Mongolia") {?>selected<? }?>>Mongolia</option>
					<option value="Montserrat" <? if ($customer->getCountry() == "Montserrat") {?>selected<? }?>>Montserrat</option>
					<option value="Morocco" <? if ($customer->getCountry() == "Morocco") {?>selected<? }?>>Morocco</option>
					<option value="Mozambique" <? if ($customer->getCountry() == "Mozambique") {?>selected<? }?>>Mozambique</option>
					<option value="Myanmar" <? if ($customer->getCountry() == "Myanmar") {?>selected<? }?>>Myanmar</option>
					<option value="Namibia" <? if ($customer->getCountry() == "Namibia") {?>selected<? }?>>Namibia</option>
					<option value="Nauru" <? if ($customer->getCountry() == "Nauru") {?>selected<? }?>>Nauru</option>
					<option value="Nepal" <? if ($customer->getCountry() == "Nepal") {?>selected<? }?>>Nepal</option>
					<option value="Neth. Antilles" <? if ($customer->getCountry() == "Neth. Antilles") {?>selected<? }?>>Neth. Antilles</option>
					<option value="Netherlands" <? if ($customer->getCountry() == "Netherlands") {?>selected<? }?>>Netherlands</option>
					<option value="Nevis" <? if ($customer->getCountry() == "Nevis") {?>selected<? }?>>Nevis</option>
					<option value="New Caledonia" <? if ($customer->getCountry() == "New Caledonia") {?>selected<? }?>>New Caledonia</option>
					<option value="New Zealand" <? if ($customer->getCountry() == "New Zealand") {?>selected<? }?>>New Zealand</option>
					<option value="Nicaragua" <? if ($customer->getCountry() == "Nicaragua") {?>selected<? }?>>Nicaragua</option>
					<option value="Niger Republic" <? if ($customer->getCountry() == "Niger Republic") {?>selected<? }?>>Niger Republic</option>
					<option value="Nigeria" <? if ($customer->getCountry() == "Nigeria") {?>selected<? }?>>Nigeria</option>
					<option value="Niue" <? if ($customer->getCountry() == "Niue") {?>selected<? }?>>Niue</option>
					<option value="Norfolk Island" <? if ($customer->getCountry() == "Norfolk Island") {?>selected<? }?>>Norfolk Island</option>
					<option value="Norway" <? if ($customer->getCountry() == "Norway") {?>selected<? }?>>Norway</option>
					<option value="Oman" <? if ($customer->getCountry() == "Oman") {?>selected<? }?>>Oman</option>
					<option value="Pakistan" <? if ($customer->getCountry() == "Pakistan") {?>selected<? }?>>Pakistan</option>
					<option value="Palau" <? if ($customer->getCountry() == "Palau") {?>selected<? }?>>Palau</option>
					<option value="Panama" <? if ($customer->getCountry() == "Panama") {?>selected<? }?>>Panama</option>
					<option value="Papua New Guinea" <? if ($customer->getCountry() == "Papua New Guinea") {?>selected<? }?>>Papua New Guinea</option>
					<option value="Paraguay" <? if ($customer->getCountry() == "Paraguay") {?>selected<? }?>>Paraguay</option>
					<option value="Peru" <? if ($customer->getCountry() == "Peru") {?>selected<? }?>>Peru</option>
					<option value="Philippines" <? if ($customer->getCountry() == "Philippines") {?>selected<? }?>>Philippines</option>
					<option value="Poland" <? if ($customer->getCountry() == "Poland") {?>selected<? }?>>Poland</option>
					<option value="Portugal" <? if ($customer->getCountry() == "Portugal") {?>selected<? }?>>Portugal</option>
					<option value="Principe" <? if ($customer->getCountry() == "Principe") {?>selected<? }?>>Principe</option>
					<option value="Puerto Rico" <? if ($customer->getCountry() == "Puerto Rico") {?>selected<? }?>>Puerto Rico</option>
					<option value="Qatar" <? if ($customer->getCountry() == "Qatar") {?>selected<? }?>>Qatar</option>
					<option value="Reunion Island" <? if ($customer->getCountry() == "Reunion Island") {?>selected<? }?>>Reunion Island</option>
					<option value="Romania" <? if ($customer->getCountry() == "Romania") {?>selected<? }?>>Romania</option>
					<option value="Russia" <? if ($customer->getCountry() == "Russia") {?>selected<? }?>>Russia</option>
					<option value="Rwanda" <? if ($customer->getCountry() == "Rwanda") {?>selected<? }?>>Rwanda</option>
					<option value="Saipan" <? if ($customer->getCountry() == "Saipan") {?>selected<? }?>>Saipan</option>
					<option value="San Marino" <? if ($customer->getCountry() == "San Marino") {?>selected<? }?>>San Marino</option>
					<option value="Sao Tome" <? if ($customer->getCountry() == "Sao Tome") {?>selected<? }?>>Sao Tome</option>
					<option value="Saudi Arabia" <? if ($customer->getCountry() == "Saudi Arabia") {?>selected<? }?>>Saudi Arabia</option>
					<option value="Senegal Republic" <? if ($customer->getCountry() == "Senegal Republic") {?>selected<? }?>>Senegal Republic</option>
					<option value="Serbia, Republic of" <? if ($customer->getCountry() == "Serbia, Republic of") {?>selected<? }?>>Serbia, Republic of</option>
					<option value="Seychelles" <? if ($customer->getCountry() == "Seychelles") {?>selected<? }?>>Seychelles</option>
					<option value="Sierra Leone" <? if ($customer->getCountry() == "Sierra Leone") {?>selected<? }?>>Sierra Leone</option>
					<option value="Singapore" <? if ($customer->getCountry() == "Singapore") {?>selected<? }?>>Singapore</option>
					<option value="Slovakia" <? if ($customer->getCountry() == "Slovakia") {?>selected<? }?>>Slovakia</option>
					<option value="Slovenia" <? if ($customer->getCountry() == "Slovenia") {?>selected<? }?>>Slovenia</option>
					<option value="Solomon Islands" <? if ($customer->getCountry() == "Solomon Islands") {?>selected<? }?>>Solomon Islands</option>
					<option value="Somalia Republic" <? if ($customer->getCountry() == "Somalia Republic") {?>selected<? }?>>Somalia Republic</option>
					<option value="South Africa" <? if ($customer->getCountry() == "South Africa") {?>selected<? }?>>South Africa</option>
					<option value="Spain" <? if ($customer->getCountry() == "Spain") {?>selected<? }?>>Spain</option>
					<option value="Sri Lanka" <? if ($customer->getCountry() == "Sri Lanka") {?>selected<? }?>>Sri Lanka</option>
					<option value="St. Helena" <? if ($customer->getCountry() == "St. Helena") {?>selected<? }?>>St. Helena</option>
					<option value="St. Kitts" <? if ($customer->getCountry() == "St. Kitts") {?>selected<? }?>>St. Kitts</option>
					<option value="St. Lucia" <? if ($customer->getCountry() == "St. Lucia") {?>selected<? }?>>St. Lucia</option>
					<option value="St. Pierre et Miquelon" <? if ($customer->getCountry() == "St. Pierre et Miquelon") {?>selected<? }?>>St. Pierre et Miquelon</option>
					<option value="St. Vincent" <? if ($customer->getCountry() == "St. Vincent") {?>selected<? }?>>St. Vincent</option>
					<option value="Sudan" <? if ($customer->getCountry() == "Sudan") {?>selected<? }?>>Sudan</option>
					<option value="Suriname" <? if ($customer->getCountry() == "Suriname") {?>selected<? }?>>Suriname</option>
					<option value="Swaziland" <? if ($customer->getCountry() == "Swaziland") {?>selected<? }?>>Swaziland</option>
					<option value="Sweden" <? if ($customer->getCountry() == "Sweden") {?>selected<? }?>>Sweden</option>
					<option value="Switzerland" <? if ($customer->getCountry() == "Switzerland") {?>selected<? }?>>Switzerland</option>
					<option value="Syria" <? if ($customer->getCountry() == "Syria") {?>selected<? }?>>Syria</option>
					<option value="Taiwan" <? if ($customer->getCountry() == "Taiwan") {?>selected<? }?>>Taiwan</option>
					<option value="Tajikistan" <? if ($customer->getCountry() == "Tajikistan") {?>selected<? }?>>Tajikistan</option>
					<option value="Tanzania" <? if ($customer->getCountry() == "Tanzania") {?>selected<? }?>>Tanzania</option>
					<option value="Thailand" <? if ($customer->getCountry() == "Thailand") {?>selected<? }?>>Thailand</option>
					<option value="Togo" <? if ($customer->getCountry() == "Togo") {?>selected<? }?>>Togo</option>
					<option value="Tokelau" <? if ($customer->getCountry() == "Tokelau") {?>selected<? }?>>Tokelau</option>
					<option value="Tonga" <? if ($customer->getCountry() == "Tonga") {?>selected<? }?>>Tonga</option>
					<option value="Trinidad and Tobago" <? if ($customer->getCountry() == "Trinidad and Tobago") {?>selected<? }?>>Trinidad and Tobago</option>
					<option value="Tunisia" <? if ($customer->getCountry() == "Tunisia") {?>selected<? }?>>Tunisia</option>
					<option value="Turkey" <? if ($customer->getCountry() == "Turkey") {?>selected<? }?>>Turkey</option>
					<option value="Turkmenistan" <? if ($customer->getCountry() == "Turkmenistan") {?>selected<? }?>>Turkmenistan</option>
					<option value="Turks and Caicos Islands" <? if ($customer->getCountry() == "Turks and Caicos Islands") {?>selected<? }?>>Turks and Caicos Islands</option>
					<option value="Tuvalu" <? if ($customer->getCountry() == "Tuvalu") {?>selected<? }?>>Tuvalu</option>
					<option value="Uganda" <? if ($customer->getCountry() == "Uganda") {?>selected<? }?>>Uganda</option>
					<option value="Ukraine" <? if ($customer->getCountry() == "Ukraine") {?>selected<? }?>>Ukraine</option>
					<option value="United Arab Emirates" <? if ($customer->getCountry() == "United Arab Emirates") {?>selected<? }?>>United Arab Emirates</option>
					<option value="United Kingdom" <? if ($customer->getCountry() == "United Kingdom") {?>selected<? }?>>United Kingdom</option>
					<option value="United States" <? if ($customer->getCountry() == "" || $customer->getCountry() == "United States") {?>selected<? }?>>United States</option>
					<option value="Uruguay" <? if ($customer->getCountry() == "Uruguay") {?>selected<? }?>>Uruguay</option>
					<option value="US Virgin Islands" <? if ($customer->getCountry() == "US Virgin Islands") {?>selected<? }?>>US Virgin Islands</option>
					<option value="Uzbekistan" <? if ($customer->getCountry() == "Uzbekistan") {?>selected<? }?>>Uzbekistan</option>
					<option value="Vanuatu" <? if ($customer->getCountry() == "Vanuatu") {?>selected<? }?>>Vanuatu</option>
					<option value="Vatican city" <? if ($customer->getCountry() == "Vatican city") {?>selected<? }?>>Vatican city</option>
					<option value="Venezuela" <? if ($customer->getCountry() == "Venezuela") {?>selected<? }?>>Venezuela</option>
					<option value="Vietnam, Soc Republic of" <? if ($customer->getCountry() == "Vietnam, Soc Republic of") {?>selected<? }?>>Vietnam, Soc Republic of</option>
					<option value="Wake Island" <? if ($customer->getCountry() == "Wake Island") {?>selected<? }?>>Wake Island</option>
					<option value="Wallis and Futuna Islands" <? if ($customer->getCountry() == "Wallis and Futuna Islands") {?>selected<? }?>>Wallis and Futuna Islands</option>
					<option value="Western Samoa" <? if ($customer->getCountry() == "Western Samoa") {?>selected<? }?>>Western Samoa</option>
					<option value="Yemen" <? if ($customer->getCountry() == "Yemen") {?>selected<? }?>>Yemen</option>
					<option value="Yugoslavia" <? if ($customer->getCountry() == "Yugoslavia") {?>selected<? }?>>Yugoslavia</option>
					<option value="Zaire" <? if ($customer->getCountry() == "Zaire") {?>selected<? }?>>Zaire</option>
					<option value="Zambia" <? if ($customer->getCountry() == "Zambia") {?>selected<? }?>>Zambia</option>
					<option value="Zanzibar" <? if ($customer->getCountry() == "Zanzibar") {?>selected<? }?>>Zanzibar</option>
					<option value="Zimbabwe" <? if ($customer->getCountry() == "Zimbabwe") {?>selected<? }?>>Zimbabwe</option>
				</select>
				</b></font>
			  	<? }?>
			  </td>
            </tr>
            <tr> 
              <td><font size="-1"><b>Phone:</b></font></td>
              <td> <font size="-1"> 
                <input type="text" name="DayPhone" value="<?=$customer->getDayPhone()?>" size="12">
                </font><font size="-1"><b>(Day) <font color="#FF0000">*</font></b></font></td>
            </tr>
			<? if (WebContent::getPropertyValue("ask_phone_2") == "no") {?>
			<input type="hidden" name="EveningPhone" value="">
			<? } else {?>
            <tr> 
              <td>&nbsp;</td>
              <td> <font size="-1"> 
                <input type="text" name="EveningPhone" value="<?=$customer->getEveningPhone()?>" size="12">
                </font><font size="-1"><b>(Evening)</b></font></td>
            </tr>
			<? }?>
			<? if (WebContent::getPropertyValue("ask_fax") == "no") {?>
			<input type="hidden" name="Fax" value="">
			<? } else {?>
            <tr> 
              <td><font size="-1"><b>Fax:</b></font></td>
              <td> <font size="-1"> 
                <input type="text" name="Fax" value="<?=$customer->getFax()?>" size="12">
                </font></td>
            </tr>
			<? }?>
			<? if (WebContent::getPropertyValue("ask_email") == "no") {?>
			<input type="hidden" name="Email" value="">
			<? } else {?>
            <tr> 
              <td><font size="-1"><b>E-mail:</b></font></td>
              <td> <font size="-1"> 
                <input type="text" name="Email" value="<?=$email?>" size="40">
                <b><font color="#FF0000">*</font></b><font size="-2"> (Don't have 
                email? Click <a href="http://www.hotmail.com" target="hotmail">here</a> 
                to get a free email account with Hotmail.)</font></font></td>
            </tr>
			<? }?>
            <tr> 
              <td colspan="2"> <font color="#FF0000" size="-1"><b>*</b></font><font size="-1"> 
                Required field</font></td>
            </tr>
          </table>
				</blockquote>
	<? }?>
	<? if (WebContent::getPropertyValue("ask_shipping_info") == "" || WebContent::getPropertyValue("ask_shipping_info") == "yes") {?>
  <h2><font size="-1">Shipping Information:</font></h2>
				<blockquote>
					<table border="0" cellspacing="0" cellpadding="5">
            <tr> 
              <td colspan="6"> <font size="-1"><b>Ship To:</b></font></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td colspan="5"> <font size="-1"> 
                <input type="checkbox" name="checkbox" value="checkbox" onClick="setShippingAddress(this.form);">
                Same as Customer Address</font></td>
            </tr>
            <tr> 
              <td><font size="-1"><b>First Name:</b></font></td>
              <td colspan="5"> <font size="-1"> 
                <input type="text" name="ShippingFirstName" value="<?=$customer->getShippingFirstName()?>" size="12">
                <font color="#FF0000"><b>*</b></font></font><font size="-1"><b> 
				<? if (WebContent::getPropertyValue("ask_shipping_middle_name") == "no") {?>
				<input type="hidden" name="ShippingMiddleInitial" value="">
				<? } else {?>
				M.I. 
                <input type="text" name="ShippingMiddleInitial" value="<?=$customer->getShippingMiddleInitial()?>" size="1">
                <? }?>
				Last Name: 
                <input type="text" name="ShippingLastName" value="<?=$customer->getShippingLastName()?>" size="12">
                <font color="#FF0000"><b>*</b></font> </b></font></td>
            </tr>
            <tr> 
              <td><font size="-1"><b>Address:</b></font></td>
              <td colspan="5" nowrap> <font size="-1"> 
                <input type="text" name="ShippingAddress1" value="<?=$customer->getShippingAddress1()?>" size="70">
                <font color="#FF0000"><b>*</b></font></font> </td>
            </tr>
			<? if (WebContent::getPropertyValue("ask_shipping_address_2") == "no") {?>
			<input type="hidden" name="ShippingAddress2" value="">
			<? } else {?>
            <tr> 
              <td width="86">&nbsp;</td>
              <td colspan="5" nowrap> <font size="-1"> 
                <input type="text" name="ShippingAddress2" value="<?=$customer->getShippingAddress2()?>" size="70">
                </font></td>
            </tr>
            <? }?>
			<tr> 
              <td>&nbsp;</td>
              <td colspan="5" nowrap><font size="-1"><b>City: 
                <input type="text" name="ShippingCity" value="<?=$customer->getShippingCity()?>" size="20">
                <font color="#FF0000">*</font> 
				<? if (WebContent::getPropertyValue("ask_shipping_state") == "no") {?>
				<input type="hidden" name="ShippingState" value="">
				<? } else {?>
				State: 
                <select name="ShippingState">
                  <option value="">-Select US State-</option>
                  <option value="AL" <? if ($customer->getShippingState() == "AL") {?>selected<? }?>>AL-Alabama 
                  </option>
                  <option value="AK" <? if ($customer->getShippingState() == "AK") {?>selected<? }?>>AK-Alaska 
                  </option>
                  <option value="AZ" <? if ($customer->getShippingState() == "AZ") {?>selected<? }?>>AZ-Arizona 
                  </option>
                  <option value="AR" <? if ($customer->getShippingState() == "AR") {?>selected<? }?>>AR-Arkansas 
                  </option>
                  <option value="CA" <? if ($customer->getShippingState() == "CA") {?>selected<? }?>>CA-California 
                  </option>
                  <option value="CO" <? if ($customer->getShippingState() == "CO") {?>selected<? }?>>CO-Colorado 
                  </option>
                  <option value="CT" <? if ($customer->getShippingState() == "CT") {?>selected<? }?>>CT-Connecticut 
                  </option>
                  <option value="DC" <? if ($customer->getShippingState() == "DC") {?>selected<? }?>>DC-Washington 
                  D.C. </option>
                  <option value="DE" <? if ($customer->getShippingState() == "DE") {?>selected<? }?>>DE-Delaware 
                  </option>
                  <option value="FL" <? if ($customer->getShippingState() == "FL") {?>selected<? }?>>FL-Florida 
                  </option>
                  <option value="GA" <? if ($customer->getShippingState() == "GA") {?>selected<? }?>>GA-Georgia 
                  </option>
                  <option value="HI" <? if ($customer->getShippingState() == "HI") {?>selected<? }?>>HI-Hawaii 
                  </option>
                  <option value="ID" <? if ($customer->getShippingState() == "ID") {?>selected<? }?>>ID-Idaho 
                  </option>
                  <option value="IL" <? if ($customer->getShippingState() == "IL") {?>selected<? }?>>IL-Illinois 
                  </option>
                  <option value="IN" <? if ($customer->getShippingState() == "IN") {?>selected<? }?>>IN-Indiana 
                  </option>
                  <option value="IA" <? if ($customer->getShippingState() == "IA") {?>selected<? }?>>IA-Iowa 
                  </option>
                  <option value="KS" <? if ($customer->getShippingState() == "KS") {?>selected<? }?>>KS-Kansas 
                  </option>
                  <option value="KY" <? if ($customer->getShippingState() == "KY") {?>selected<? }?>>KY-Kentucky 
                  </option>
                  <option value="LA" <? if ($customer->getShippingState() == "LA") {?>selected<? }?>>LA-Louisiana 
                  </option>
                  <option value="ME" <? if ($customer->getShippingState() == "ME") {?>selected<? }?>>ME-Maine 
                  </option>
                  <option value="MD" <? if ($customer->getShippingState() == "MD") {?>selected<? }?>>MD-Maryland 
                  </option>
                  <option value="MA" <? if ($customer->getShippingState() == "MA") {?>selected<? }?>>MA-Massachusetts 
                  </option>
                  <option value="MI" <? if ($customer->getShippingState() == "MI") {?>selected<? }?>>MI-Michigan 
                  </option>
                  <option value="MN" <? if ($customer->getShippingState() == "MN") {?>selected<? }?>>MN-Minnesota 
                  </option>
                  <option value="MS" <? if ($customer->getShippingState() == "MS") {?>selected<? }?>>MS-Mississippi 
                  </option>
                  <option value="MO" <? if ($customer->getShippingState() == "MO") {?>selected<? }?>>MO-Missouri 
                  </option>
                  <option value="MT" <? if ($customer->getShippingState() == "MT") {?>selected<? }?>>MT-Montana 
                  </option>
                  <option value="NE" <? if ($customer->getShippingState() == "NE") {?>selected<? }?>>NE-Nebraska 
                  </option>
                  <option value="NV" <? if ($customer->getShippingState() == "NV") {?>selected<? }?>>NV-Nevada 
                  </option>
                  <option value="NH" <? if ($customer->getShippingState() == "NH") {?>selected<? }?>>NH-New 
                  Hampshire </option>
                  <option value="NJ" <? if ($customer->getShippingState() == "NJ") {?>selected<? }?>>NJ-New 
                  Jersey </option>
                  <option value="NM" <? if ($customer->getShippingState() == "NM") {?>selected<? }?>>NM-New 
                  Mexico </option>
                  <option value="NY" <? if ($customer->getShippingState() == "NY") {?>selected<? }?>>NY-New 
                  York </option>
                  <option value="NC" <? if ($customer->getShippingState() == "NC") {?>selected<? }?>>NC-North 
                  Carolina </option>
                  <option value="ND" <? if ($customer->getShippingState() == "ND") {?>selected<? }?>>ND-North 
                  Dakota </option>
                  <option value="OH" <? if ($customer->getShippingState() == "OH") {?>selected<? }?>>OH-Ohio 
                  </option>
                  <option value="OK" <? if ($customer->getShippingState() == "OK") {?>selected<? }?>>OK-Oklahoma 
                  </option>
                  <option value="OR" <? if ($customer->getShippingState() == "OR") {?>selected<? }?>>OR-Oregon 
                  </option>
                  <option value="PA" <? if ($customer->getShippingState() == "PA") {?>selected<? }?>>PA-Pennsylvania 
                  </option>
                  <option value="PR" <? if ($customer->getShippingState() == "PR") {?>selected<? }?>>PR-Puerto 
                  Rico </option>
                  <option value="RI" <? if ($customer->getShippingState() == "RI") {?>selected<? }?>>RI-Rhode 
                  Island </option>
                  <option value="SC" <? if ($customer->getShippingState() == "SC") {?>selected<? }?>>SC-South 
                  Carolina </option>
                  <option value="SD" <? if ($customer->getShippingState() == "SD") {?>selected<? }?>>SD-South 
                  Dakota </option>
                  <option value="TN" <? if ($customer->getShippingState() == "TN") {?>selected<? }?>>TN-Tennessee 
                  </option>
                  <option value="TX" <? if ($customer->getShippingState() == "TX") {?>selected<? }?>>TX-Texas 
                  </option>
                  <option value="UT" <? if ($customer->getShippingState() == "UT") {?>selected<? }?>>UT-Utah 
                  </option>
                  <option value="VT" <? if ($customer->getShippingState() == "VT") {?>selected<? }?>>VT-Vermont 
                  </option>
                  <option value="VA" <? if ($customer->getShippingState() == "VA") {?>selected<? }?>>VA-Virginia 
                  </option>
                  <option value="WA" <? if ($customer->getShippingState() == "WA") {?>selected<? }?>>WA-Washington 
                  </option>
                  <option value="WV" <? if ($customer->getShippingState() == "WV") {?>selected<? }?>>WV-West 
                  Virginia </option>
                  <option value="WI" <? if ($customer->getShippingState() == "WI") {?>selected<? }?>>WI-Wisconsin 
                  </option>
                  <option value="WY" <? if ($customer->getShippingState() == "WY") {?>selected<? }?>>WY-Wyoming 
                  </option>
				  <option value="">-Select Canadian Province-</option>
				  <option value="AB" <? if ($customer->getShippingState() == "AB") {?>selected<? }?>>AB-Alberta</option>
				  <option value="BC" <? if ($customer->getShippingState() == "BC") {?>selected<? }?>>BC-British Columbia</option>
				  <option value="MB" <? if ($customer->getShippingState() == "MB") {?>selected<? }?>>MB-Manitoba</option>
				  <option value="NB" <? if ($customer->getShippingState() == "NB") {?>selected<? }?>>NB-New Brunswick</option>
				  <option value="NL" <? if ($customer->getShippingState() == "NL") {?>selected<? }?>>NL-Newfoundland</option>
				  <option value="NT" <? if ($customer->getShippingState() == "NT") {?>selected<? }?>>NT-Northwest Territories</option>
				  <option value="NS" <? if ($customer->getShippingState() == "NS") {?>selected<? }?>>NS-Nova Scotia</option>
				  <option value="NU" <? if ($customer->getShippingState() == "NU") {?>selected<? }?>>NU-Nunavut</option>
				  <option value="ON" <? if ($customer->getShippingState() == "ON") {?>selected<? }?>>ON-Ontario</option>
				  <option value="PE" <? if ($customer->getShippingState() == "PE") {?>selected<? }?>>PE-Prince Edward Island</option>
				  <option value="QC" <? if ($customer->getShippingState() == "QC") {?>selected<? }?>>QC-Quebec</option>
				  <option value="SK" <? if ($customer->getShippingState() == "SK") {?>selected<? }?>>SK-Saskatchewan</option>
				  <option value="YT" <? if ($customer->getShippingState() == "YT") {?>selected<? }?>>YT-Yukon</option>
				  <option value="">-Outside US & Canada-</option>
                </select>
				<? }?>
                <font color="#FF0000">*</font> Postal Code: 
                <input type="text" name="ShippingZip" value="<?=$customer->getShippingZip()?>" size="5">
                <font color="#FF0000">*</font> </b> </font></td>
            </tr>
            <tr> 
              <td width="86">&nbsp;</td>
              <td colspan="5" nowrap>
			  	<? if (WebContent::getPropertyValue("ask_shipping_province") == "no") {?>
				<input type="hidden" name="ShippingProvince" value="">
				<? } else {?>
				<font size="-1"><b>Province: 
                <input name="ShippingProvince" type="text" value="<? if ($customer->getShippingProvince() != "") {?><?=$customer->getShippingProvince()?><? }?>" id="ShippingProvince" size="15">
                </b> <font size="-2">(if not within U.S)</font>
				<? }?>
				<? if (WebContent::getPropertyValue("ask_shipping_country") == "no") {?>
				<input type="hidden" name="ShippingCountry" value="">
				<? } else {?>
				<b> Country: 
                <select name="ShippingCountry" onChange="disableState(this.form,'shipping');">
					<option value="Albania" <? if ($customer->getShippingCountry() == "Albania") {?>selected<? }?>>Albania</option>
					<option value="Algeria" <? if ($customer->getShippingCountry() == "Algeria") {?>selected<? }?>>Algeria</option>
					<option value="American Samoa" <? if ($customer->getShippingCountry() == "American Samoa") {?>selected<? }?>>American Samoa</option>
					<option value="Andorra" <? if ($customer->getShippingCountry() == "Andorra") {?>selected<? }?>>Andorra</option>
					<option value="Angola" <? if ($customer->getShippingCountry() == "Angola") {?>selected<? }?>>Angola</option>
					<option value="Anguilla" <? if ($customer->getShippingCountry() == "Anguilla") {?>selected<? }?>>Anguilla</option>
					<option value="Antarctica" <? if ($customer->getShippingCountry() == "") {?>selected<? }?>>Antarctica</option>
					<option value="Antigua and Barbuda" <? if ($customer->getShippingCountry() == "Antigua and Barbuda") {?>selected<? }?>>Antigua and Barbuda</option>
					<option value="Argentina" <? if ($customer->getShippingCountry() == "Argentina") {?>selected<? }?>>Argentina</option>
					<option value="Armenia" <? if ($customer->getShippingCountry() == "Armenia") {?>selected<? }?>>Armenia</option>
					<option value="Aruba" <? if ($customer->getShippingCountry() == "Aruba") {?>selected<? }?>>Aruba</option>
					<option value="Ascension" <? if ($customer->getShippingCountry() == "Ascension") {?>selected<? }?>>Ascension</option>
					<option value="Australia" <? if ($customer->getShippingCountry() == "Australia") {?>selected<? }?>>Australia</option>
					<option value="Austria" <? if ($customer->getShippingCountry() == "Austria") {?>selected<? }?>>Austria</option>
					<option value="Azerbaijan" <? if ($customer->getShippingCountry() == "Azerbaijan") {?>selected<? }?>>Azerbaijan</option>
					<option value="Bahamas" <? if ($customer->getShippingCountry() == "Bahamas") {?>selected<? }?>>Bahamas</option>
					<option value="Bahrain" <? if ($customer->getShippingCountry() == "Bahrain") {?>selected<? }?>>Bahrain</option>
					<option value="Bangladesh" <? if ($customer->getShippingCountry() == "Bangladesh") {?>selected<? }?>>Bangladesh</option>
					<option value="Barbados" <? if ($customer->getShippingCountry() == "Barbados") {?>selected<? }?>>Barbados</option>
					<option value="Belarus" <? if ($customer->getShippingCountry() == "Belarus") {?>selected<? }?>>Belarus</option>
					<option value="Belgium" <? if ($customer->getShippingCountry() == "Belgium") {?>selected<? }?>>Belgium</option>
					<option value="Belize" <? if ($customer->getShippingCountry() == "Belize") {?>selected<? }?>>Belize</option>
					<option value="Benin, Republic of" <? if ($customer->getShippingCountry() == "Benin, Republic of") {?>selected<? }?>>Benin, Republic of</option>
					<option value="Bermuda" <? if ($customer->getShippingCountry() == "Bermuda") {?>selected<? }?>>Bermuda</option>
					<option value="Bhutan" <? if ($customer->getShippingCountry() == "Bhutan") {?>selected<? }?>>Bhutan</option>
					<option value="Bolivia" <? if ($customer->getShippingCountry() == "Bolivia") {?>selected<? }?>>Bolivia</option>
					<option value="Bosnia and Herzegovina" <? if ($customer->getShippingCountry() == "Bosnia and Herzegovina") {?>selected<? }?>>Bosnia and Herzegovina</option>
					<option value="Botswana" <? if ($customer->getShippingCountry() == "Botswana") {?>selected<? }?>>Botswana</option>
					<option value="Brazil" <? if ($customer->getShippingCountry() == "Brazil") {?>selected<? }?>>Brazil</option>
					<option value="British Virgin Islands" <? if ($customer->getShippingCountry() == "British Virgin Islands") {?>selected<? }?>>British Virgin Islands</option>
					<option value="Brunei" <? if ($customer->getShippingCountry() == "Brunei") {?>selected<? }?>>Brunei</option>
					<option value="Bulgaria" <? if ($customer->getShippingCountry() == "Bulgaria") {?>selected<? }?>>Bulgaria</option>
					<option value="Burkina Faso" <? if ($customer->getShippingCountry() == "Burkina Faso") {?>selected<? }?>>Burkina Faso</option>
					<option value="Burundi" <? if ($customer->getShippingCountry() == "Burundi") {?>selected<? }?>>Burundi</option>
					<option value="Cambodia" <? if ($customer->getShippingCountry() == "Cambodia") {?>selected<? }?>>Cambodia</option>
					<option value="Cameroon" <? if ($customer->getShippingCountry() == "Cameroon") {?>selected<? }?>>Cameroon</option>
					<option value="Canada" <? if ($customer->getShippingCountry() == "Canada") {?>selected<? }?>>Canada</option>
					<option value="Cape Verde Islands" <? if ($customer->getShippingCountry() == "Cape Verde Islands") {?>selected<? }?>>Cape Verde Islands</option>
					<option value="Cayman Islands" <? if ($customer->getShippingCountry() == "Cayman Islands") {?>selected<? }?>>Cayman Islands</option>
					<option value="Central African Rep" <? if ($customer->getShippingCountry() == "Central African Rep") {?>selected<? }?>>Central African Rep</option>
					<option value="Chad Republic" <? if ($customer->getShippingCountry() == "Chad Republic") {?>selected<? }?>>Chad Republic</option>
					<option value="Chatham Island, NZ" <? if ($customer->getShippingCountry() == "Chatham Island, NZ") {?>selected<? }?>>Chatham Island, NZ</option>
					<option value="Chile" <? if ($customer->getShippingCountry() == "Chile") {?>selected<? }?>>Chile</option>
					<option value="China" <? if ($customer->getShippingCountry() == "China") {?>selected<? }?>>China</option>
					<option value="Christmas Island" <? if ($customer->getShippingCountry() == "Christmas Island") {?>selected<? }?>>Christmas Island</option>
					<option value="Cocos Islands" <? if ($customer->getShippingCountry() == "Cocos Islands") {?>selected<? }?>>Cocos Islands</option>
					<option value="Colombia" <? if ($customer->getShippingCountry() == "Colombia") {?>selected<? }?>>Colombia</option>
					<option value="Comoros" <? if ($customer->getShippingCountry() == "Comoros") {?>selected<? }?>>Comoros</option>
					<option value="Congo" <? if ($customer->getShippingCountry() == "Congo") {?>selected<? }?>>Congo</option>
					<option value="Cook Islands" <? if ($customer->getShippingCountry() == "Cook Islands") {?>selected<? }?>>Cook Islands</option>
					<option value="Costa Rica" <? if ($customer->getShippingCountry() == "Costa Rica") {?>selected<? }?>>Costa Rica</option>
					<option value="Croatia" <? if ($customer->getShippingCountry() == "Croatia") {?>selected<? }?>>Croatia</option>
					<option value="Cuba" <? if ($customer->getShippingCountry() == "Cuba") {?>selected<? }?>>Cuba</option>
					<option value="Curacao" <? if ($customer->getShippingCountry() == "Curacao") {?>selected<? }?>>Curacao</option>
					<option value="Cyprus" <? if ($customer->getShippingCountry() == "Cyprus") {?>selected<? }?>>Cyprus</option>
					<option value="Czech Republic" <? if ($customer->getShippingCountry() == "Czech Republic") {?>selected<? }?>>Czech Republic</option>
					<option value="Denmark" <? if ($customer->getShippingCountry() == "Denmark") {?>selected<? }?>>Denmark</option>
					<option value="Diego Garcia" <? if ($customer->getShippingCountry() == "Diego Garcia") {?>selected<? }?>>Diego Garcia</option>
					<option value="Djibouti" <? if ($customer->getShippingCountry() == "Djibouti") {?>selected<? }?>>Djibouti</option>
					<option value="Dominica" <? if ($customer->getShippingCountry() == "Dominica") {?>selected<? }?>>Dominica</option>
					<option value="Dominican Republic" <? if ($customer->getShippingCountry() == "Dominican Republic") {?>selected<? }?>>Dominican Republic</option>
					<option value="Easter Island" <? if ($customer->getShippingCountry() == "Easter Island") {?>selected<? }?>>Easter Island</option>
					<option value="Ecuador" <? if ($customer->getShippingCountry() == "Ecuador") {?>selected<? }?>>Ecuador</option>
					<option value="Egypt" <? if ($customer->getShippingCountry() == "Egypt") {?>selected<? }?>>Egypt</option>
					<option value="El Salvador" <? if ($customer->getShippingCountry() == "El Salvador") {?>selected<? }?>>El Salvador</option>
					<option value="Equitorial Guinea" <? if ($customer->getShippingCountry() == "Equitorial Guinea") {?>selected<? }?>>Equitorial Guinea</option>
					<option value="Eritrea" <? if ($customer->getShippingCountry() == "Eritrea") {?>selected<? }?>>Eritrea</option>
					<option value="Estonia" <? if ($customer->getShippingCountry() == "Estonia") {?>selected<? }?>>Estonia</option>
					<option value="Ethiopia" <? if ($customer->getShippingCountry() == "Ethiopia") {?>selected<? }?>>Ethiopia</option>
					<option value="Falkland Islands" <? if ($customer->getShippingCountry() == "Falkland Islands") {?>selected<? }?>>Falkland Islands</option>
					<option value="Faroe Islands" <? if ($customer->getShippingCountry() == "Faroe Islands") {?>selected<? }?>>Faroe Islands</option>
					<option value="Fiji Islands" <? if ($customer->getShippingCountry() == "Fiji Islands") {?>selected<? }?>>Fiji Islands</option>
					<option value="Finland" <? if ($customer->getShippingCountry() == "Finland") {?>selected<? }?>>Finland</option>
					<option value="France" <? if ($customer->getShippingCountry() == "France") {?>selected<? }?>>France</option>
					<option value="French Antilles" <? if ($customer->getShippingCountry() == "French Antilles") {?>selected<? }?>>French Antilles</option>
					<option value="French Guiana" <? if ($customer->getShippingCountry() == "French Guiana") {?>selected<? }?>>French Guiana</option>
					<option value="French Polynesia" <? if ($customer->getShippingCountry() == "French Polynesia") {?>selected<? }?>>French Polynesia</option>
					<option value="Gabon Republic" <? if ($customer->getShippingCountry() == "Gabon Republic") {?>selected<? }?>>Gabon Republic</option>
					<option value="Gambia" <? if ($customer->getShippingCountry() == "Gambia") {?>selected<? }?>>Gambia</option>
					<option value="Georgia" <? if ($customer->getShippingCountry() == "Georgia") {?>selected<? }?>>Georgia</option>
					<option value="Germany" <? if ($customer->getShippingCountry() == "Germany") {?>selected<? }?>>Germany</option>
					<option value="Ghana" <? if ($customer->getShippingCountry() == "Ghana") {?>selected<? }?>>Ghana</option>
					<option value="Gibraltar" <? if ($customer->getShippingCountry() == "Gibraltar") {?>selected<? }?>>Gibraltar</option>
					<option value="Greece" <? if ($customer->getShippingCountry() == "Greece") {?>selected<? }?>>Greece</option>
					<option value="Greenland" <? if ($customer->getShippingCountry() == "Greenland") {?>selected<? }?>>Greenland</option>
					<option value="Grenada and Carriacuou" <? if ($customer->getShippingCountry() == "Grenada and Carriacuou") {?>selected<? }?>>Grenada and Carriacuou</option>
					<option value="Grenadin Islands" <? if ($customer->getShippingCountry() == "Grenadin Islands") {?>selected<? }?>>Grenadin Islands</option>
					<option value="Guadeloupe" <? if ($customer->getShippingCountry() == "Guadeloupe") {?>selected<? }?>>Guadeloupe</option>
					<option value="Guam" <? if ($customer->getShippingCountry() == "Guam") {?>selected<? }?>>Guam</option>
					<option value="Guantanamo Bay" <? if ($customer->getShippingCountry() == "Guantanamo Bay") {?>selected<? }?>>Guantanamo Bay</option>
					<option value="Guatemala" <? if ($customer->getShippingCountry() == "Guatemala") {?>selected<? }?>>Guatemala</option>
					<option value="Guiana" <? if ($customer->getShippingCountry() == "Guiana") {?>selected<? }?>>Guiana</option>
					<option value="Guinea, Bissau" <? if ($customer->getShippingCountry() == "Guinea, Bissau") {?>selected<? }?>>Guinea, Bissau</option>
					<option value="Guinea, Rep" <? if ($customer->getShippingCountry() == "Guinea, Rep") {?>selected<? }?>>Guinea, Rep</option>
					<option value="Guyana" <? if ($customer->getShippingCountry() == "Guyana") {?>selected<? }?>>Guyana</option>
					<option value="Haiti" <? if ($customer->getShippingCountry() == "Haiti") {?>selected<? }?>>Haiti</option>
					<option value="Honduras" <? if ($customer->getShippingCountry() == "Honduras") {?>selected<? }?>>Honduras</option>
					<option value="Hong Kong" <? if ($customer->getShippingCountry() == "Hong Kong") {?>selected<? }?>>Hong Kong</option>
					<option value="Hungary" <? if ($customer->getShippingCountry() == "Hungary") {?>selected<? }?>>Hungary</option>
					<option value="Iceland" <? if ($customer->getShippingCountry() == "Iceland") {?>selected<? }?>>Iceland</option>
					<option value="India" <? if ($customer->getShippingCountry() == "India") {?>selected<? }?>>India</option>
					<option value="Indonesia" <? if ($customer->getShippingCountry() == "Indonesia") {?>selected<? }?>>Indonesia</option>
					<option value="Inmarsat" <? if ($customer->getShippingCountry() == "Inmarsat") {?>selected<? }?>>Inmarsat</option>
					<option value="Iran" <? if ($customer->getShippingCountry() == "Iran") {?>selected<? }?>>Iran</option>
					<option value="Iraq" <? if ($customer->getShippingCountry() == "Iraq") {?>selected<? }?>>Iraq</option>
					<option value="Ireland" <? if ($customer->getShippingCountry() == "Ireland") {?>selected<? }?>>Ireland</option>
					<option value="Israel" <? if ($customer->getShippingCountry() == "Israel") {?>selected<? }?>>Israel</option>
					<option value="Italy" <? if ($customer->getShippingCountry() == "Italy") {?>selected<? }?>>Italy</option>
					<option value="Ivory Coast" <? if ($customer->getShippingCountry() == "Ivory Coast") {?>selected<? }?>>Ivory Coast</option>
					<option value="Jamaica" <? if ($customer->getShippingCountry() == "Jamaica") {?>selected<? }?>>Jamaica</option>
					<option value="Japan" <? if ($customer->getShippingCountry() == "Japan") {?>selected<? }?>>Japan</option>
					<option value="Jordan" <? if ($customer->getShippingCountry() == "Jordan") {?>selected<? }?>>Jordan</option>
					<option value="Kazakhstan" <? if ($customer->getShippingCountry() == "Kazakhstan") {?>selected<? }?>>Kazakhstan</option>
					<option value="Kenya" <? if ($customer->getShippingCountry() == "Kenya") {?>selected<? }?>>Kenya</option>
					<option value="Kiribati" <? if ($customer->getShippingCountry() == "Kiribati") {?>selected<? }?>>Kiribati</option>
					<option value="Korea, North" <? if ($customer->getShippingCountry() == "Korea, North") {?>selected<? }?>>Korea, North</option>
					<option value="Korea, South" <? if ($customer->getShippingCountry() == "Korea, South") {?>selected<? }?>>Korea, South</option>
					<option value="Kuwait" <? if ($customer->getShippingCountry() == "Kuwait") {?>selected<? }?>>Kuwait</option>
					<option value="Kyrgyzstan" <? if ($customer->getShippingCountry() == "Kyrgyzstan") {?>selected<? }?>>Kyrgyzstan</option>
					<option value="Laos" <? if ($customer->getShippingCountry() == "Laos") {?>selected<? }?>>Laos</option>
					<option value="Latvia" <? if ($customer->getShippingCountry() == "Latvia") {?>selected<? }?>>Latvia</option>
					<option value="Lebanon" <? if ($customer->getShippingCountry() == "Lebanon") {?>selected<? }?>>Lebanon</option>
					<option value="Lesotho" <? if ($customer->getShippingCountry() == "Lesotho") {?>selected<? }?>>Lesotho</option>
					<option value="Liberia" <? if ($customer->getShippingCountry() == "Liberia") {?>selected<? }?>>Liberia</option>
					<option value="Libya" <? if ($customer->getShippingCountry() == "Libya") {?>selected<? }?>>Libya</option>
					<option value="Liechtenstein" <? if ($customer->getShippingCountry() == "Liechtenstein") {?>selected<? }?>>Liechtenstein</option>
					<option value="Lithuania" <? if ($customer->getShippingCountry() == "Lithuania") {?>selected<? }?>>Lithuania</option>
					<option value="Luxembourg" <? if ($customer->getShippingCountry() == "Luxembourg") {?>selected<? }?>>Luxembourg</option>
					<option value="Macau" <? if ($customer->getShippingCountry() == "Macau") {?>selected<? }?>>Macau</option>
					<option value="Macedonia, FYROM" <? if ($customer->getShippingCountry() == "Macedonia, FYROM") {?>selected<? }?>>Macedonia, FYROM</option>
					<option value="Madagascar" <? if ($customer->getShippingCountry() == "Madagascar") {?>selected<? }?>>Madagascar</option>
					<option value="Malawi" <? if ($customer->getShippingCountry() == "Malawi") {?>selected<? }?>>Malawi</option>
					<option value="Malaysia" <? if ($customer->getShippingCountry() == "Malaysia") {?>selected<? }?>>Malaysia</option>
					<option value="Maldives" <? if ($customer->getShippingCountry() == "Maldives") {?>selected<? }?>>Maldives</option>
					<option value="Mali Republic" <? if ($customer->getShippingCountry() == "Mali Republic") {?>selected<? }?>>Mali Republic</option>
					<option value="Malta" <? if ($customer->getShippingCountry() == "Malta") {?>selected<? }?>>Malta</option>
					<option value="Mariana Islands" <? if ($customer->getShippingCountry() == "Mariana Islands") {?>selected<? }?>>Mariana Islands</option>
					<option value="Marshall Islands" <? if ($customer->getShippingCountry() == "Marshall Islands") {?>selected<? }?>>Marshall Islands</option>
					<option value="Martinique" <? if ($customer->getShippingCountry() == "Martinique") {?>selected<? }?>>Martinique</option>
					<option value="Mauritania" <? if ($customer->getShippingCountry() == "Mauritania") {?>selected<? }?>>Mauritania</option>
					<option value="Mauritius" <? if ($customer->getShippingCountry() == "Mauritius") {?>selected<? }?>>Mauritius</option>
					<option value="Mayotte Island" <? if ($customer->getShippingCountry() == "Mayotte Island") {?>selected<? }?>>Mayotte Island</option>
					<option value="Mexico" <? if ($customer->getShippingCountry() == "Mexico") {?>selected<? }?>>Mexico</option>
					<option value="Micronesia, Fed States" <? if ($customer->getShippingCountry() == "Micronesia, Fed States") {?>selected<? }?>>Micronesia, Fed States</option>
					<option value="Midway Islands" <? if ($customer->getShippingCountry() == "Midway Islands") {?>selected<? }?>>Midway Islands</option>
					<option value="Miquelon" <? if ($customer->getShippingCountry() == "Miquelon") {?>selected<? }?>>Miquelon</option>
					<option value="Moldova" <? if ($customer->getShippingCountry() == "Moldova") {?>selected<? }?>>Moldova</option>
					<option value="Monaco" <? if ($customer->getShippingCountry() == "Monaco") {?>selected<? }?>>Monaco</option>
					<option value="Mongolia" <? if ($customer->getShippingCountry() == "Mongolia") {?>selected<? }?>>Mongolia</option>
					<option value="Montserrat" <? if ($customer->getShippingCountry() == "Montserrat") {?>selected<? }?>>Montserrat</option>
					<option value="Morocco" <? if ($customer->getShippingCountry() == "Morocco") {?>selected<? }?>>Morocco</option>
					<option value="Mozambique" <? if ($customer->getShippingCountry() == "Mozambique") {?>selected<? }?>>Mozambique</option>
					<option value="Myanmar" <? if ($customer->getShippingCountry() == "Myanmar") {?>selected<? }?>>Myanmar</option>
					<option value="Namibia" <? if ($customer->getShippingCountry() == "Namibia") {?>selected<? }?>>Namibia</option>
					<option value="Nauru" <? if ($customer->getShippingCountry() == "Nauru") {?>selected<? }?>>Nauru</option>
					<option value="Nepal" <? if ($customer->getShippingCountry() == "Nepal") {?>selected<? }?>>Nepal</option>
					<option value="Neth. Antilles" <? if ($customer->getShippingCountry() == "Neth. Antilles") {?>selected<? }?>>Neth. Antilles</option>
					<option value="Netherlands" <? if ($customer->getShippingCountry() == "Netherlands") {?>selected<? }?>>Netherlands</option>
					<option value="Nevis" <? if ($customer->getShippingCountry() == "Nevis") {?>selected<? }?>>Nevis</option>
					<option value="New Caledonia" <? if ($customer->getShippingCountry() == "New Caledonia") {?>selected<? }?>>New Caledonia</option>
					<option value="New Zealand" <? if ($customer->getShippingCountry() == "New Zealand") {?>selected<? }?>>New Zealand</option>
					<option value="Nicaragua" <? if ($customer->getShippingCountry() == "Nicaragua") {?>selected<? }?>>Nicaragua</option>
					<option value="Niger Republic" <? if ($customer->getShippingCountry() == "Niger Republic") {?>selected<? }?>>Niger Republic</option>
					<option value="Nigeria" <? if ($customer->getShippingCountry() == "Nigeria") {?>selected<? }?>>Nigeria</option>
					<option value="Niue" <? if ($customer->getShippingCountry() == "Niue") {?>selected<? }?>>Niue</option>
					<option value="Norfolk Island" <? if ($customer->getShippingCountry() == "Norfolk Island") {?>selected<? }?>>Norfolk Island</option>
					<option value="Norway" <? if ($customer->getShippingCountry() == "Norway") {?>selected<? }?>>Norway</option>
					<option value="Oman" <? if ($customer->getShippingCountry() == "Oman") {?>selected<? }?>>Oman</option>
					<option value="Pakistan" <? if ($customer->getShippingCountry() == "Pakistan") {?>selected<? }?>>Pakistan</option>
					<option value="Palau" <? if ($customer->getShippingCountry() == "Palau") {?>selected<? }?>>Palau</option>
					<option value="Panama" <? if ($customer->getShippingCountry() == "Panama") {?>selected<? }?>>Panama</option>
					<option value="Papua New Guinea" <? if ($customer->getShippingCountry() == "Papua New Guinea") {?>selected<? }?>>Papua New Guinea</option>
					<option value="Paraguay" <? if ($customer->getShippingCountry() == "Paraguay") {?>selected<? }?>>Paraguay</option>
					<option value="Peru" <? if ($customer->getShippingCountry() == "Peru") {?>selected<? }?>>Peru</option>
					<option value="Philippines" <? if ($customer->getShippingCountry() == "Philippines") {?>selected<? }?>>Philippines</option>
					<option value="Poland" <? if ($customer->getShippingCountry() == "Poland") {?>selected<? }?>>Poland</option>
					<option value="Portugal" <? if ($customer->getShippingCountry() == "Portugal") {?>selected<? }?>>Portugal</option>
					<option value="Principe" <? if ($customer->getShippingCountry() == "Principe") {?>selected<? }?>>Principe</option>
					<option value="Puerto Rico" <? if ($customer->getShippingCountry() == "Puerto Rico") {?>selected<? }?>>Puerto Rico</option>
					<option value="Qatar" <? if ($customer->getShippingCountry() == "Qatar") {?>selected<? }?>>Qatar</option>
					<option value="Reunion Island" <? if ($customer->getShippingCountry() == "Reunion Island") {?>selected<? }?>>Reunion Island</option>
					<option value="Romania" <? if ($customer->getShippingCountry() == "Romania") {?>selected<? }?>>Romania</option>
					<option value="Russia" <? if ($customer->getShippingCountry() == "Russia") {?>selected<? }?>>Russia</option>
					<option value="Rwanda" <? if ($customer->getShippingCountry() == "Rwanda") {?>selected<? }?>>Rwanda</option>
					<option value="Saipan" <? if ($customer->getShippingCountry() == "Saipan") {?>selected<? }?>>Saipan</option>
					<option value="San Marino" <? if ($customer->getShippingCountry() == "San Marino") {?>selected<? }?>>San Marino</option>
					<option value="Sao Tome" <? if ($customer->getShippingCountry() == "Sao Tome") {?>selected<? }?>>Sao Tome</option>
					<option value="Saudi Arabia" <? if ($customer->getShippingCountry() == "Saudi Arabia") {?>selected<? }?>>Saudi Arabia</option>
					<option value="Senegal Republic" <? if ($customer->getShippingCountry() == "Senegal Republic") {?>selected<? }?>>Senegal Republic</option>
					<option value="Serbia, Republic of" <? if ($customer->getShippingCountry() == "Serbia, Republic of") {?>selected<? }?>>Serbia, Republic of</option>
					<option value="Seychelles" <? if ($customer->getShippingCountry() == "Seychelles") {?>selected<? }?>>Seychelles</option>
					<option value="Sierra Leone" <? if ($customer->getShippingCountry() == "Sierra Leone") {?>selected<? }?>>Sierra Leone</option>
					<option value="Singapore" <? if ($customer->getShippingCountry() == "Singapore") {?>selected<? }?>>Singapore</option>
					<option value="Slovakia" <? if ($customer->getShippingCountry() == "Slovakia") {?>selected<? }?>>Slovakia</option>
					<option value="Slovenia" <? if ($customer->getShippingCountry() == "Slovenia") {?>selected<? }?>>Slovenia</option>
					<option value="Solomon Islands" <? if ($customer->getShippingCountry() == "Solomon Islands") {?>selected<? }?>>Solomon Islands</option>
					<option value="Somalia Republic" <? if ($customer->getShippingCountry() == "Somalia Republic") {?>selected<? }?>>Somalia Republic</option>
					<option value="South Africa" <? if ($customer->getShippingCountry() == "South Africa") {?>selected<? }?>>South Africa</option>
					<option value="Spain" <? if ($customer->getShippingCountry() == "Spain") {?>selected<? }?>>Spain</option>
					<option value="Sri Lanka" <? if ($customer->getShippingCountry() == "Sri Lanka") {?>selected<? }?>>Sri Lanka</option>
					<option value="St. Helena" <? if ($customer->getShippingCountry() == "St. Helena") {?>selected<? }?>>St. Helena</option>
					<option value="St. Kitts" <? if ($customer->getShippingCountry() == "St. Kitts") {?>selected<? }?>>St. Kitts</option>
					<option value="St. Lucia" <? if ($customer->getShippingCountry() == "St. Lucia") {?>selected<? }?>>St. Lucia</option>
					<option value="St. Pierre et Miquelon" <? if ($customer->getShippingCountry() == "St. Pierre et Miquelon") {?>selected<? }?>>St. Pierre et Miquelon</option>
					<option value="St. Vincent" <? if ($customer->getShippingCountry() == "St. Vincent") {?>selected<? }?>>St. Vincent</option>
					<option value="Sudan" <? if ($customer->getShippingCountry() == "Sudan") {?>selected<? }?>>Sudan</option>
					<option value="Suriname" <? if ($customer->getShippingCountry() == "Suriname") {?>selected<? }?>>Suriname</option>
					<option value="Swaziland" <? if ($customer->getShippingCountry() == "Swaziland") {?>selected<? }?>>Swaziland</option>
					<option value="Sweden" <? if ($customer->getShippingCountry() == "Sweden") {?>selected<? }?>>Sweden</option>
					<option value="Switzerland" <? if ($customer->getShippingCountry() == "Switzerland") {?>selected<? }?>>Switzerland</option>
					<option value="Syria" <? if ($customer->getShippingCountry() == "Syria") {?>selected<? }?>>Syria</option>
					<option value="Taiwan" <? if ($customer->getShippingCountry() == "Taiwan") {?>selected<? }?>>Taiwan</option>
					<option value="Tajikistan" <? if ($customer->getShippingCountry() == "Tajikistan") {?>selected<? }?>>Tajikistan</option>
					<option value="Tanzania" <? if ($customer->getShippingCountry() == "Tanzania") {?>selected<? }?>>Tanzania</option>
					<option value="Thailand" <? if ($customer->getShippingCountry() == "Thailand") {?>selected<? }?>>Thailand</option>
					<option value="Togo" <? if ($customer->getShippingCountry() == "Togo") {?>selected<? }?>>Togo</option>
					<option value="Tokelau" <? if ($customer->getShippingCountry() == "Tokelau") {?>selected<? }?>>Tokelau</option>
					<option value="Tonga" <? if ($customer->getShippingCountry() == "Tonga") {?>selected<? }?>>Tonga</option>
					<option value="Trinidad and Tobago" <? if ($customer->getShippingCountry() == "Trinidad and Tobago") {?>selected<? }?>>Trinidad and Tobago</option>
					<option value="Tunisia" <? if ($customer->getShippingCountry() == "Tunisia") {?>selected<? }?>>Tunisia</option>
					<option value="Turkey" <? if ($customer->getShippingCountry() == "Turkey") {?>selected<? }?>>Turkey</option>
					<option value="Turkmenistan" <? if ($customer->getShippingCountry() == "Turkmenistan") {?>selected<? }?>>Turkmenistan</option>
					<option value="Turks and Caicos Islands" <? if ($customer->getShippingCountry() == "Turks and Caicos Islands") {?>selected<? }?>>Turks and Caicos Islands</option>
					<option value="Tuvalu" <? if ($customer->getShippingCountry() == "Tuvalu") {?>selected<? }?>>Tuvalu</option>
					<option value="Uganda" <? if ($customer->getShippingCountry() == "Uganda") {?>selected<? }?>>Uganda</option>
					<option value="Ukraine" <? if ($customer->getShippingCountry() == "Ukraine") {?>selected<? }?>>Ukraine</option>
					<option value="United Arab Emirates" <? if ($customer->getShippingCountry() == "United Arab Emirates") {?>selected<? }?>>United Arab Emirates</option>
					<option value="United Kingdom" <? if ($customer->getShippingCountry() == "United Kingdom") {?>selected<? }?>>United Kingdom</option>
					<option value="United States" <? if ($customer->getShippingCountry() == "" || $customer->getShippingCountry() == "United States") {?>selected<? }?>>United States</option>
					<option value="Uruguay" <? if ($customer->getShippingCountry() == "Uruguay") {?>selected<? }?>>Uruguay</option>
					<option value="US Virgin Islands" <? if ($customer->getShippingCountry() == "US Virgin Islands") {?>selected<? }?>>US Virgin Islands</option>
					<option value="Uzbekistan" <? if ($customer->getShippingCountry() == "Uzbekistan") {?>selected<? }?>>Uzbekistan</option>
					<option value="Vanuatu" <? if ($customer->getShippingCountry() == "Vanuatu") {?>selected<? }?>>Vanuatu</option>
					<option value="Vatican city" <? if ($customer->getShippingCountry() == "Vatican city") {?>selected<? }?>>Vatican city</option>
					<option value="Venezuela" <? if ($customer->getShippingCountry() == "Venezuela") {?>selected<? }?>>Venezuela</option>
					<option value="Vietnam, Soc Republic of" <? if ($customer->getShippingCountry() == "Vietnam, Soc Republic of") {?>selected<? }?>>Vietnam, Soc Republic of</option>
					<option value="Wake Island" <? if ($customer->getShippingCountry() == "Wake Island") {?>selected<? }?>>Wake Island</option>
					<option value="Wallis and Futuna Islands" <? if ($customer->getShippingCountry() == "Wallis and Futuna Islands") {?>selected<? }?>>Wallis and Futuna Islands</option>
					<option value="Western Samoa" <? if ($customer->getShippingCountry() == "Western Samoa") {?>selected<? }?>>Western Samoa</option>
					<option value="Yemen" <? if ($customer->getShippingCountry() == "Yemen") {?>selected<? }?>>Yemen</option>
					<option value="Yugoslavia" <? if ($customer->getShippingCountry() == "Yugoslavia") {?>selected<? }?>>Yugoslavia</option>
					<option value="Zaire" <? if ($customer->getShippingCountry() == "Zaire") {?>selected<? }?>>Zaire</option>
					<option value="Zambia" <? if ($customer->getShippingCountry() == "Zambia") {?>selected<? }?>>Zambia</option>
					<option value="Zanzibar" <? if ($customer->getShippingCountry() == "Zanzibar") {?>selected<? }?>>Zanzibar</option>
					<option value="Zimbabwe" <? if ($customer->getShippingCountry() == "Zimbabwe") {?>selected<? }?>>Zimbabwe</option>
				</select>
				</b></font>
			    <? }?>
			  </td>
            </tr>
						<? if (WebContent::getPropertyValue("shipping_mode") != "manual") {?>
            <tr>
              <td colspan="6"><strong>This address is:</strong> 
                <input name="address_type" type="radio" value="residential" checked>
                <strong>residential</strong> 
                <input type="radio" name="address_type" value="commercial">
                <strong>commercial</strong></td>
            </tr>
						<? }?>
            <tr> 
              <td colspan="6"> <font color="#FF0000" size="-1"><b>*</b></font><font size="-1"> 
                Required field</font></td>
            </tr>
          </table>
					<? if (WebContent::getPropertyValue("shipping_mode") == "manual" && WebContent::getPropertyValue("ship_rate_calc_method") == "by total purchase" && WebContent::getPropertyValue("express_checkout") == "yes") {?>
					<p><font size="-1"><b>Select your shipping options:</b></font></p>
					<table width="65%" border="1" cellspacing="0" cellpadding="5" bordercolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
					<tr> 
						<th width="50%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Shipping Method</font></th>
						<th width="15%" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"><font size="-1" color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>">Rate</font></th>
					</tr>
					<? for($i=0;$i<count($shipping_method);$i++) {?>
					<tr> 
						<td width="50%"> 
							<font size="-1"> 
							<input type="radio" name="ShippingMethod" value="<?=$i?>" <? if($customer->getShippingMethod() == $shipping_method[$i]) {?>CHECKED<? } else if ($i == 0) {?>CHECKED<? }?>>
							<?=$shipping_method[$i]?>
							</font>
						</td>
						<td width="15%" align="right"><font size="-1"> $ <? printf("%01.2f",$shipping_rate[$i]);?></font></td>
					</tr>
					<? }?>
					</table>					
					<? }?>
				</blockquote>
	<? }?>
	<? if (WebContent::getPropertyValue("ask_billing_info") == "" || WebContent::getPropertyValue("ask_billing_info") == "yes") {?>
	<h2><font size="-1">Billing Information:</font></h2>
				<blockquote>
					<table width="0" border="0" cellspacing="0" cellpadding="5">
            <tr> 
              <td colspan="6"><font size="-1"><b>Bill To:</b></font></td>
            </tr>
            <tr> 
              <td >&nbsp;</td>
              <td colspan="5"> <font size="-1"> 
                <input type="checkbox" name="checkbox3" value="checkbox" onClick="setBillingAddress(this.form);">
                Same as Customer Address</font></td>
            </tr>
            <tr> 
              <td><font size="-1"><b>First Name:</b></font></td>
              <td colspan="5"> <font size="-1"> 
                <input type="text" name="BillingFirstName" value="<?=$customer->getBillingFirstName()?>" size="12">
                <font color="#FF0000"><b>*</b></font></font> <font size="-1"><b>
				<? if (WebContent::getPropertyValue("ask_billing_middle_name") == "no") {?>
				<input type="hidden" name="BillingMiddleInitial" value="">
				<? } else {?>
				M.I. 
                <input type="text" name="BillingMiddleInitial" value="<?=$customer->getBillingMiddleInitial()?>" size="1">
                <? }?>
				Last Name: 
                <input type="text" name="BillingLastName" value="<?=$customer->getBillingLastName()?>" size="12">
                <font color="#FF0000"><b>*</b></font> </b></font></td>
            </tr>
            <tr> 
              <td><font size="-1"><b>Address:</b></font></td>
              <td colspan="5" nowrap> <font size="-1"> 
                <input type="text" name="BillingAddress1" value="<?=$customer->getBillingAddress1()?>" size="70">
                <font color="#FF0000"><b>*</b></font></font> </td>
            </tr>
			<? if (WebContent::getPropertyValue("ask_billing_address_2") == "no") {?>
			<input type="hidden" name="BillingAddress2" value="">
			<? } else {?>
            <tr> 
              <td>&nbsp;</td>
              <td colspan="5" nowrap> <font size="-1"> 
                <input type="text" name="BillingAddress2" value="<?=$customer->getBillingAddress2()?>" size="70">
                </font></td>
            </tr>
			<? }?>
            <tr> 
              <td>&nbsp;</td>
              <td colspan="5" nowrap><font size="-1"><b>City: 
                <input type="text" name="BillingCity" value="<?=$customer->getBillingCity()?>" size="20">
                <font color="#FF0000">*</font> 
				<? if (WebContent::getPropertyValue("ask_billing_state") == "no") {?>
				<input type="hidden" name="BillingState" value="">
				<? } else {?>
				State: 
                <select name="BillingState">
                  <option value="">-Select US State-</option>
                  <option value="AL" <? if ($customer->getBillingState() == "AL") {?>selected<? }?>>AL-Alabama 
                  </option>
                  <option value="AK" <? if ($customer->getBillingState() == "AK") {?>selected<? }?>>AK-Alaska 
                  </option>
                  <option value="AZ" <? if ($customer->getBillingState() == "AZ") {?>selected<? }?>>AZ-Arizona 
                  </option>
                  <option value="AR" <? if ($customer->getBillingState() == "AR") {?>selected<? }?>>AR-Arkansas 
                  </option>
                  <option value="CA" <? if ($customer->getBillingState() == "CA") {?>selected<? }?>>CA-California 
                  </option>
                  <option value="CO" <? if ($customer->getBillingState() == "CO") {?>selected<? }?>>CO-Colorado 
                  </option>
                  <option value="CT" <? if ($customer->getBillingState() == "CT") {?>selected<? }?>>CT-Connecticut 
                  </option>
                  <option value="DC" <? if ($customer->getBillingState() == "DC") {?>selected<? }?>>DC-Washington 
                  D.C. </option>
                  <option value="DE" <? if ($customer->getBillingState() == "DE") {?>selected<? }?>>DE-Delaware 
                  </option>
                  <option value="FL" <? if ($customer->getBillingState() == "FL") {?>selected<? }?>>FL-Florida 
                  </option>
                  <option value="GA" <? if ($customer->getBillingState() == "GA") {?>selected<? }?>>GA-Georgia 
                  </option>
                  <option value="HI" <? if ($customer->getBillingState() == "HI") {?>selected<? }?>>HI-Hawaii 
                  </option>
                  <option value="ID" <? if ($customer->getBillingState() == "ID") {?>selected<? }?>>ID-Idaho 
                  </option>
                  <option value="IL" <? if ($customer->getBillingState() == "IL") {?>selected<? }?>>IL-Illinois 
                  </option>
                  <option value="IN" <? if ($customer->getBillingState() == "IN") {?>selected<? }?>>IN-Indiana 
                  </option>
                  <option value="IA" <? if ($customer->getBillingState() == "IA") {?>selected<? }?>>IA-Iowa 
                  </option>
                  <option value="KS" <? if ($customer->getBillingState() == "KS") {?>selected<? }?>>KS-Kansas 
                  </option>
                  <option value="KY" <? if ($customer->getBillingState() == "KY") {?>selected<? }?>>KY-Kentucky 
                  </option>
                  <option value="LA" <? if ($customer->getBillingState() == "LA") {?>selected<? }?>>LA-Louisiana 
                  </option>
                  <option value="ME" <? if ($customer->getBillingState() == "ME") {?>selected<? }?>>ME-Maine 
                  </option>
                  <option value="MD" <? if ($customer->getBillingState() == "MD") {?>selected<? }?>>MD-Maryland 
                  </option>
                  <option value="MA" <? if ($customer->getBillingState() == "MA") {?>selected<? }?>>MA-Massachusetts 
                  </option>
                  <option value="MI" <? if ($customer->getBillingState() == "MI") {?>selected<? }?>>MI-Michigan 
                  </option>
                  <option value="MN" <? if ($customer->getBillingState() == "MN") {?>selected<? }?>>MN-Minnesota 
                  </option>
                  <option value="MS" <? if ($customer->getBillingState() == "MS") {?>selected<? }?>>MS-Mississippi 
                  </option>
                  <option value="MO" <? if ($customer->getBillingState() == "MO") {?>selected<? }?>>MO-Missouri 
                  </option>
                  <option value="MT" <? if ($customer->getBillingState() == "MT") {?>selected<? }?>>MT-Montana 
                  </option>
                  <option value="NE" <? if ($customer->getBillingState() == "NE") {?>selected<? }?>>NE-Nebraska 
                  </option>
                  <option value="NV" <? if ($customer->getBillingState() == "NV") {?>selected<? }?>>NV-Nevada 
                  </option>
                  <option value="NH" <? if ($customer->getBillingState() == "NH") {?>selected<? }?>>NH-New 
                  Hampshire </option>
                  <option value="NJ" <? if ($customer->getBillingState() == "NJ") {?>selected<? }?>>NJ-New 
                  Jersey </option>
                  <option value="NM" <? if ($customer->getBillingState() == "NM") {?>selected<? }?>>NM-New 
                  Mexico </option>
                  <option value="NY" <? if ($customer->getBillingState() == "NY") {?>selected<? }?>>NY-New 
                  York </option>
                  <option value="NC" <? if ($customer->getBillingState() == "NC") {?>selected<? }?>>NC-North 
                  Carolina </option>
                  <option value="ND" <? if ($customer->getBillingState() == "ND") {?>selected<? }?>>ND-North 
                  Dakota </option>
                  <option value="OH" <? if ($customer->getBillingState() == "OH") {?>selected<? }?>>OH-Ohio 
                  </option>
                  <option value="OK" <? if ($customer->getBillingState() == "OK") {?>selected<? }?>>OK-Oklahoma 
                  </option>
                  <option value="OR" <? if ($customer->getBillingState() == "OR") {?>selected<? }?>>OR-Oregon 
                  </option>
                  <option value="PA" <? if ($customer->getBillingState() == "PA") {?>selected<? }?>>PA-Pennsylvania 
                  </option>
                  <option value="PR" <? if ($customer->getBillingState() == "PR") {?>selected<? }?>>PR-Puerto 
                  Rico </option>
                  <option value="RI" <? if ($customer->getBillingState() == "RI") {?>selected<? }?>>RI-Rhode 
                  Island </option>
                  <option value="SC" <? if ($customer->getBillingState() == "SC") {?>selected<? }?>>SC-South 
                  Carolina </option>
                  <option value="SD" <? if ($customer->getBillingState() == "SD") {?>selected<? }?>>SD-South 
                  Dakota </option>
                  <option value="TN" <? if ($customer->getBillingState() == "TN") {?>selected<? }?>>TN-Tennessee 
                  </option>
                  <option value="TX" <? if ($customer->getBillingState() == "TX") {?>selected<? }?>>TX-Texas 
                  </option>
                  <option value="UT" <? if ($customer->getBillingState() == "UT") {?>selected<? }?>>UT-Utah 
                  </option>
                  <option value="VT" <? if ($customer->getBillingState() == "VT") {?>selected<? }?>>VT-Vermont 
                  </option>
                  <option value="VA" <? if ($customer->getBillingState() == "VA") {?>selected<? }?>>VA-Virginia 
                  </option>
                  <option value="WA" <? if ($customer->getBillingState() == "WA") {?>selected<? }?>>WA-Washington 
                  </option>
                  <option value="WV" <? if ($customer->getBillingState() == "WV") {?>selected<? }?>>WV-West 
                  Virginia </option>
                  <option value="WI" <? if ($customer->getBillingState() == "WI") {?>selected<? }?>>WI-Wisconsin 
                  </option>
                  <option value="WY" <? if ($customer->getBillingState() == "WY") {?>selected<? }?>>WY-Wyoming 
                  </option>
				  <option value="">-Select Canadian Province-</option>
				  <option value="AB" <? if ($customer->getBillingState() == "AB") {?>selected<? }?>>AB-Alberta</option>
				  <option value="BC" <? if ($customer->getBillingState() == "BC") {?>selected<? }?>>BC-British Columbia</option>
				  <option value="MB" <? if ($customer->getBillingState() == "MB") {?>selected<? }?>>MN-Manitoba</option>
				  <option value="NB" <? if ($customer->getBillingState() == "NB") {?>selected<? }?>>NB-New Brunswick</option>
				  <option value="NL" <? if ($customer->getBillingState() == "NL") {?>selected<? }?>>NL-Newfoundland</option>
				  <option value="NT" <? if ($customer->getBillingState() == "NT") {?>selected<? }?>>NT-Northwest Territories</option>
				  <option value="NS" <? if ($customer->getBillingState() == "NS") {?>selected<? }?>>NS-Nova Scotia</option>
				  <option value="NU" <? if ($customer->getBillingState() == "NU") {?>selected<? }?>>NU-Nunavut</option>
				  <option value="ON" <? if ($customer->getBillingState() == "ON") {?>selected<? }?>>ON-Ontario</option>
				  <option value="PE" <? if ($customer->getBillingState() == "PE") {?>selected<? }?>>PE-Prince Edward Island</option>
				  <option value="QC" <? if ($customer->getBillingState() == "QC") {?>selected<? }?>>QC-Quebec</option>
				  <option value="SK" <? if ($customer->getBillingState() == "SK") {?>selected<? }?>>SK-Saskatchewan</option>
				  <option value="YT" <? if ($customer->getBillingState() == "YT") {?>selected<? }?>>YT-Yukon</option>
				  <option value="">-Outside US & Canada-</option>
                </select>
				<? }?>
                <font color="#FF0000">*</font> Postal Code: 
                <input type="text" name="BillingZip" value="<?=$customer->getBillingZip()?>" size="5">
                <font color="#FF0000">*</font> </b> </font></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td colspan="5" nowrap>
			  	<? if (WebContent::getPropertyValue("ask_billing_province") == "no") {?>
				<input type="hidden" name="BillingProvince" value="">
				<? } else {?>
			  	<font size="-1"><b>Province: 
                <input name="BillingProvince" type="text" value="<? if ($customer->getBillingProvince() != "") {?><?=$customer->getBillingProvince()?><? }?>" id="BillingProvince" size="15">
                </b><font size="-2">(if not within U.S)</font>
				<? }?>
				<? if (WebContent::getPropertyValue("ask_billing_country") == "no") {?>
				<input type="hidden" name="BillingCountry" value="">
				<? } else {?>
				<b> Country: 
                <select name="BillingCountry" onChange="disableState(this.form,'billing');">
					<option value="Albania" <? if ($customer->getBillingCountry() == "Albania") {?>selected<? }?>>Albania</option>
					<option value="Algeria" <? if ($customer->getBillingCountry() == "Algeria") {?>selected<? }?>>Algeria</option>
					<option value="American Samoa" <? if ($customer->getBillingCountry() == "American Samoa") {?>selected<? }?>>American Samoa</option>
					<option value="Andorra" <? if ($customer->getBillingCountry() == "Andorra") {?>selected<? }?>>Andorra</option>
					<option value="Angola" <? if ($customer->getBillingCountry() == "Angola") {?>selected<? }?>>Angola</option>
					<option value="Anguilla" <? if ($customer->getBillingCountry() == "Anguilla") {?>selected<? }?>>Anguilla</option>
					<option value="Antarctica" <? if ($customer->getBillingCountry() == "") {?>selected<? }?>>Antarctica</option>
					<option value="Antigua and Barbuda" <? if ($customer->getBillingCountry() == "Antigua and Barbuda") {?>selected<? }?>>Antigua and Barbuda</option>
					<option value="Argentina" <? if ($customer->getBillingCountry() == "Argentina") {?>selected<? }?>>Argentina</option>
					<option value="Armenia" <? if ($customer->getBillingCountry() == "Armenia") {?>selected<? }?>>Armenia</option>
					<option value="Aruba" <? if ($customer->getBillingCountry() == "Aruba") {?>selected<? }?>>Aruba</option>
					<option value="Ascension" <? if ($customer->getBillingCountry() == "Ascension") {?>selected<? }?>>Ascension</option>
					<option value="Australia" <? if ($customer->getBillingCountry() == "Australia") {?>selected<? }?>>Australia</option>
					<option value="Austria" <? if ($customer->getBillingCountry() == "Austria") {?>selected<? }?>>Austria</option>
					<option value="Azerbaijan" <? if ($customer->getBillingCountry() == "Azerbaijan") {?>selected<? }?>>Azerbaijan</option>
					<option value="Bahamas" <? if ($customer->getBillingCountry() == "Bahamas") {?>selected<? }?>>Bahamas</option>
					<option value="Bahrain" <? if ($customer->getBillingCountry() == "Bahrain") {?>selected<? }?>>Bahrain</option>
					<option value="Bangladesh" <? if ($customer->getBillingCountry() == "Bangladesh") {?>selected<? }?>>Bangladesh</option>
					<option value="Barbados" <? if ($customer->getBillingCountry() == "Barbados") {?>selected<? }?>>Barbados</option>
					<option value="Belarus" <? if ($customer->getBillingCountry() == "Belarus") {?>selected<? }?>>Belarus</option>
					<option value="Belgium" <? if ($customer->getBillingCountry() == "Belgium") {?>selected<? }?>>Belgium</option>
					<option value="Belize" <? if ($customer->getBillingCountry() == "Belize") {?>selected<? }?>>Belize</option>
					<option value="Benin, Republic of" <? if ($customer->getBillingCountry() == "Benin, Republic of") {?>selected<? }?>>Benin, Republic of</option>
					<option value="Bermuda" <? if ($customer->getBillingCountry() == "Bermuda") {?>selected<? }?>>Bermuda</option>
					<option value="Bhutan" <? if ($customer->getBillingCountry() == "Bhutan") {?>selected<? }?>>Bhutan</option>
					<option value="Bolivia" <? if ($customer->getBillingCountry() == "Bolivia") {?>selected<? }?>>Bolivia</option>
					<option value="Bosnia and Herzegovina" <? if ($customer->getBillingCountry() == "Bosnia and Herzegovina") {?>selected<? }?>>Bosnia and Herzegovina</option>
					<option value="Botswana" <? if ($customer->getBillingCountry() == "Botswana") {?>selected<? }?>>Botswana</option>
					<option value="Brazil" <? if ($customer->getBillingCountry() == "Brazil") {?>selected<? }?>>Brazil</option>
					<option value="British Virgin Islands" <? if ($customer->getBillingCountry() == "British Virgin Islands") {?>selected<? }?>>British Virgin Islands</option>
					<option value="Brunei" <? if ($customer->getBillingCountry() == "Brunei") {?>selected<? }?>>Brunei</option>
					<option value="Bulgaria" <? if ($customer->getBillingCountry() == "Bulgaria") {?>selected<? }?>>Bulgaria</option>
					<option value="Burkina Faso" <? if ($customer->getBillingCountry() == "Burkina Faso") {?>selected<? }?>>Burkina Faso</option>
					<option value="Burundi" <? if ($customer->getBillingCountry() == "Burundi") {?>selected<? }?>>Burundi</option>
					<option value="Cambodia" <? if ($customer->getBillingCountry() == "Cambodia") {?>selected<? }?>>Cambodia</option>
					<option value="Cameroon" <? if ($customer->getBillingCountry() == "Cameroon") {?>selected<? }?>>Cameroon</option>
					<option value="Canada" <? if ($customer->getBillingCountry() == "Canada") {?>selected<? }?>>Canada</option>
					<option value="Cape Verde Islands" <? if ($customer->getBillingCountry() == "Cape Verde Islands") {?>selected<? }?>>Cape Verde Islands</option>
					<option value="Cayman Islands" <? if ($customer->getBillingCountry() == "Cayman Islands") {?>selected<? }?>>Cayman Islands</option>
					<option value="Central African Rep" <? if ($customer->getBillingCountry() == "Central African Rep") {?>selected<? }?>>Central African Rep</option>
					<option value="Chad Republic" <? if ($customer->getBillingCountry() == "Chad Republic") {?>selected<? }?>>Chad Republic</option>
					<option value="Chatham Island, NZ" <? if ($customer->getBillingCountry() == "Chatham Island, NZ") {?>selected<? }?>>Chatham Island, NZ</option>
					<option value="Chile" <? if ($customer->getBillingCountry() == "Chile") {?>selected<? }?>>Chile</option>
					<option value="China" <? if ($customer->getBillingCountry() == "China") {?>selected<? }?>>China</option>
					<option value="Christmas Island" <? if ($customer->getBillingCountry() == "Christmas Island") {?>selected<? }?>>Christmas Island</option>
					<option value="Cocos Islands" <? if ($customer->getBillingCountry() == "Cocos Islands") {?>selected<? }?>>Cocos Islands</option>
					<option value="Colombia" <? if ($customer->getBillingCountry() == "Colombia") {?>selected<? }?>>Colombia</option>
					<option value="Comoros" <? if ($customer->getBillingCountry() == "Comoros") {?>selected<? }?>>Comoros</option>
					<option value="Congo" <? if ($customer->getBillingCountry() == "Congo") {?>selected<? }?>>Congo</option>
					<option value="Cook Islands" <? if ($customer->getBillingCountry() == "Cook Islands") {?>selected<? }?>>Cook Islands</option>
					<option value="Costa Rica" <? if ($customer->getBillingCountry() == "Costa Rica") {?>selected<? }?>>Costa Rica</option>
					<option value="Croatia" <? if ($customer->getBillingCountry() == "Croatia") {?>selected<? }?>>Croatia</option>
					<option value="Cuba" <? if ($customer->getBillingCountry() == "Cuba") {?>selected<? }?>>Cuba</option>
					<option value="Curacao" <? if ($customer->getBillingCountry() == "Curacao") {?>selected<? }?>>Curacao</option>
					<option value="Cyprus" <? if ($customer->getBillingCountry() == "Cyprus") {?>selected<? }?>>Cyprus</option>
					<option value="Czech Republic" <? if ($customer->getBillingCountry() == "Czech Republic") {?>selected<? }?>>Czech Republic</option>
					<option value="Denmark" <? if ($customer->getBillingCountry() == "Denmark") {?>selected<? }?>>Denmark</option>
					<option value="Diego Garcia" <? if ($customer->getBillingCountry() == "Diego Garcia") {?>selected<? }?>>Diego Garcia</option>
					<option value="Djibouti" <? if ($customer->getBillingCountry() == "Djibouti") {?>selected<? }?>>Djibouti</option>
					<option value="Dominica" <? if ($customer->getBillingCountry() == "Dominica") {?>selected<? }?>>Dominica</option>
					<option value="Dominican Republic" <? if ($customer->getBillingCountry() == "Dominican Republic") {?>selected<? }?>>Dominican Republic</option>
					<option value="Easter Island" <? if ($customer->getBillingCountry() == "Easter Island") {?>selected<? }?>>Easter Island</option>
					<option value="Ecuador" <? if ($customer->getBillingCountry() == "Ecuador") {?>selected<? }?>>Ecuador</option>
					<option value="Egypt" <? if ($customer->getBillingCountry() == "Egypt") {?>selected<? }?>>Egypt</option>
					<option value="El Salvador" <? if ($customer->getBillingCountry() == "El Salvador") {?>selected<? }?>>El Salvador</option>
					<option value="Equitorial Guinea" <? if ($customer->getBillingCountry() == "Equitorial Guinea") {?>selected<? }?>>Equitorial Guinea</option>
					<option value="Eritrea" <? if ($customer->getBillingCountry() == "Eritrea") {?>selected<? }?>>Eritrea</option>
					<option value="Estonia" <? if ($customer->getBillingCountry() == "Estonia") {?>selected<? }?>>Estonia</option>
					<option value="Ethiopia" <? if ($customer->getBillingCountry() == "Ethiopia") {?>selected<? }?>>Ethiopia</option>
					<option value="Falkland Islands" <? if ($customer->getBillingCountry() == "Falkland Islands") {?>selected<? }?>>Falkland Islands</option>
					<option value="Faroe Islands" <? if ($customer->getBillingCountry() == "Faroe Islands") {?>selected<? }?>>Faroe Islands</option>
					<option value="Fiji Islands" <? if ($customer->getBillingCountry() == "Fiji Islands") {?>selected<? }?>>Fiji Islands</option>
					<option value="Finland" <? if ($customer->getBillingCountry() == "Finland") {?>selected<? }?>>Finland</option>
					<option value="France" <? if ($customer->getBillingCountry() == "France") {?>selected<? }?>>France</option>
					<option value="French Antilles" <? if ($customer->getBillingCountry() == "French Antilles") {?>selected<? }?>>French Antilles</option>
					<option value="French Guiana" <? if ($customer->getBillingCountry() == "French Guiana") {?>selected<? }?>>French Guiana</option>
					<option value="French Polynesia" <? if ($customer->getBillingCountry() == "French Polynesia") {?>selected<? }?>>French Polynesia</option>
					<option value="Gabon Republic" <? if ($customer->getBillingCountry() == "Gabon Republic") {?>selected<? }?>>Gabon Republic</option>
					<option value="Gambia" <? if ($customer->getBillingCountry() == "Gambia") {?>selected<? }?>>Gambia</option>
					<option value="Georgia" <? if ($customer->getBillingCountry() == "Georgia") {?>selected<? }?>>Georgia</option>
					<option value="Germany" <? if ($customer->getBillingCountry() == "Germany") {?>selected<? }?>>Germany</option>
					<option value="Ghana" <? if ($customer->getBillingCountry() == "Ghana") {?>selected<? }?>>Ghana</option>
					<option value="Gibraltar" <? if ($customer->getBillingCountry() == "Gibraltar") {?>selected<? }?>>Gibraltar</option>
					<option value="Greece" <? if ($customer->getBillingCountry() == "Greece") {?>selected<? }?>>Greece</option>
					<option value="Greenland" <? if ($customer->getBillingCountry() == "Greenland") {?>selected<? }?>>Greenland</option>
					<option value="Grenada and Carriacuou" <? if ($customer->getBillingCountry() == "Grenada and Carriacuou") {?>selected<? }?>>Grenada and Carriacuou</option>
					<option value="Grenadin Islands" <? if ($customer->getBillingCountry() == "Grenadin Islands") {?>selected<? }?>>Grenadin Islands</option>
					<option value="Guadeloupe" <? if ($customer->getBillingCountry() == "Guadeloupe") {?>selected<? }?>>Guadeloupe</option>
					<option value="Guam" <? if ($customer->getBillingCountry() == "Guam") {?>selected<? }?>>Guam</option>
					<option value="Guantanamo Bay" <? if ($customer->getBillingCountry() == "Guantanamo Bay") {?>selected<? }?>>Guantanamo Bay</option>
					<option value="Guatemala" <? if ($customer->getBillingCountry() == "Guatemala") {?>selected<? }?>>Guatemala</option>
					<option value="Guiana" <? if ($customer->getBillingCountry() == "Guiana") {?>selected<? }?>>Guiana</option>
					<option value="Guinea, Bissau" <? if ($customer->getBillingCountry() == "Guinea, Bissau") {?>selected<? }?>>Guinea, Bissau</option>
					<option value="Guinea, Rep" <? if ($customer->getBillingCountry() == "Guinea, Rep") {?>selected<? }?>>Guinea, Rep</option>
					<option value="Guyana" <? if ($customer->getBillingCountry() == "Guyana") {?>selected<? }?>>Guyana</option>
					<option value="Haiti" <? if ($customer->getBillingCountry() == "Haiti") {?>selected<? }?>>Haiti</option>
					<option value="Honduras" <? if ($customer->getBillingCountry() == "Honduras") {?>selected<? }?>>Honduras</option>
					<option value="Hong Kong" <? if ($customer->getBillingCountry() == "Hong Kong") {?>selected<? }?>>Hong Kong</option>
					<option value="Hungary" <? if ($customer->getBillingCountry() == "Hungary") {?>selected<? }?>>Hungary</option>
					<option value="Iceland" <? if ($customer->getBillingCountry() == "Iceland") {?>selected<? }?>>Iceland</option>
					<option value="India" <? if ($customer->getBillingCountry() == "India") {?>selected<? }?>>India</option>
					<option value="Indonesia" <? if ($customer->getBillingCountry() == "Indonesia") {?>selected<? }?>>Indonesia</option>
					<option value="Inmarsat" <? if ($customer->getBillingCountry() == "Inmarsat") {?>selected<? }?>>Inmarsat</option>
					<option value="Iran" <? if ($customer->getBillingCountry() == "Iran") {?>selected<? }?>>Iran</option>
					<option value="Iraq" <? if ($customer->getBillingCountry() == "Iraq") {?>selected<? }?>>Iraq</option>
					<option value="Ireland" <? if ($customer->getBillingCountry() == "Ireland") {?>selected<? }?>>Ireland</option>
					<option value="Israel" <? if ($customer->getBillingCountry() == "Israel") {?>selected<? }?>>Israel</option>
					<option value="Italy" <? if ($customer->getBillingCountry() == "Italy") {?>selected<? }?>>Italy</option>
					<option value="Ivory Coast" <? if ($customer->getBillingCountry() == "Ivory Coast") {?>selected<? }?>>Ivory Coast</option>
					<option value="Jamaica" <? if ($customer->getBillingCountry() == "Jamaica") {?>selected<? }?>>Jamaica</option>
					<option value="Japan" <? if ($customer->getBillingCountry() == "Japan") {?>selected<? }?>>Japan</option>
					<option value="Jordan" <? if ($customer->getBillingCountry() == "Jordan") {?>selected<? }?>>Jordan</option>
					<option value="Kazakhstan" <? if ($customer->getBillingCountry() == "Kazakhstan") {?>selected<? }?>>Kazakhstan</option>
					<option value="Kenya" <? if ($customer->getBillingCountry() == "Kenya") {?>selected<? }?>>Kenya</option>
					<option value="Kiribati" <? if ($customer->getBillingCountry() == "Kiribati") {?>selected<? }?>>Kiribati</option>
					<option value="Korea, North" <? if ($customer->getBillingCountry() == "Korea, North") {?>selected<? }?>>Korea, North</option>
					<option value="Korea, South" <? if ($customer->getBillingCountry() == "Korea, South") {?>selected<? }?>>Korea, South</option>
					<option value="Kuwait" <? if ($customer->getBillingCountry() == "Kuwait") {?>selected<? }?>>Kuwait</option>
					<option value="Kyrgyzstan" <? if ($customer->getBillingCountry() == "Kyrgyzstan") {?>selected<? }?>>Kyrgyzstan</option>
					<option value="Laos" <? if ($customer->getBillingCountry() == "Laos") {?>selected<? }?>>Laos</option>
					<option value="Latvia" <? if ($customer->getBillingCountry() == "Latvia") {?>selected<? }?>>Latvia</option>
					<option value="Lebanon" <? if ($customer->getBillingCountry() == "Lebanon") {?>selected<? }?>>Lebanon</option>
					<option value="Lesotho" <? if ($customer->getBillingCountry() == "Lesotho") {?>selected<? }?>>Lesotho</option>
					<option value="Liberia" <? if ($customer->getBillingCountry() == "Liberia") {?>selected<? }?>>Liberia</option>
					<option value="Libya" <? if ($customer->getBillingCountry() == "Libya") {?>selected<? }?>>Libya</option>
					<option value="Liechtenstein" <? if ($customer->getBillingCountry() == "Liechtenstein") {?>selected<? }?>>Liechtenstein</option>
					<option value="Lithuania" <? if ($customer->getBillingCountry() == "Lithuania") {?>selected<? }?>>Lithuania</option>
					<option value="Luxembourg" <? if ($customer->getBillingCountry() == "Luxembourg") {?>selected<? }?>>Luxembourg</option>
					<option value="Macau" <? if ($customer->getBillingCountry() == "Macau") {?>selected<? }?>>Macau</option>
					<option value="Macedonia, FYROM" <? if ($customer->getBillingCountry() == "Macedonia, FYROM") {?>selected<? }?>>Macedonia, FYROM</option>
					<option value="Madagascar" <? if ($customer->getBillingCountry() == "Madagascar") {?>selected<? }?>>Madagascar</option>
					<option value="Malawi" <? if ($customer->getBillingCountry() == "Malawi") {?>selected<? }?>>Malawi</option>
					<option value="Malaysia" <? if ($customer->getBillingCountry() == "Malaysia") {?>selected<? }?>>Malaysia</option>
					<option value="Maldives" <? if ($customer->getBillingCountry() == "Maldives") {?>selected<? }?>>Maldives</option>
					<option value="Mali Republic" <? if ($customer->getBillingCountry() == "Mali Republic") {?>selected<? }?>>Mali Republic</option>
					<option value="Malta" <? if ($customer->getBillingCountry() == "Malta") {?>selected<? }?>>Malta</option>
					<option value="Mariana Islands" <? if ($customer->getBillingCountry() == "Mariana Islands") {?>selected<? }?>>Mariana Islands</option>
					<option value="Marshall Islands" <? if ($customer->getBillingCountry() == "Marshall Islands") {?>selected<? }?>>Marshall Islands</option>
					<option value="Martinique" <? if ($customer->getBillingCountry() == "Martinique") {?>selected<? }?>>Martinique</option>
					<option value="Mauritania" <? if ($customer->getBillingCountry() == "Mauritania") {?>selected<? }?>>Mauritania</option>
					<option value="Mauritius" <? if ($customer->getBillingCountry() == "Mauritius") {?>selected<? }?>>Mauritius</option>
					<option value="Mayotte Island" <? if ($customer->getBillingCountry() == "Mayotte Island") {?>selected<? }?>>Mayotte Island</option>
					<option value="Mexico" <? if ($customer->getBillingCountry() == "Mexico") {?>selected<? }?>>Mexico</option>
					<option value="Micronesia, Fed States" <? if ($customer->getBillingCountry() == "Micronesia, Fed States") {?>selected<? }?>>Micronesia, Fed States</option>
					<option value="Midway Islands" <? if ($customer->getBillingCountry() == "Midway Islands") {?>selected<? }?>>Midway Islands</option>
					<option value="Miquelon" <? if ($customer->getBillingCountry() == "Miquelon") {?>selected<? }?>>Miquelon</option>
					<option value="Moldova" <? if ($customer->getBillingCountry() == "Moldova") {?>selected<? }?>>Moldova</option>
					<option value="Monaco" <? if ($customer->getBillingCountry() == "Monaco") {?>selected<? }?>>Monaco</option>
					<option value="Mongolia" <? if ($customer->getBillingCountry() == "Mongolia") {?>selected<? }?>>Mongolia</option>
					<option value="Montserrat" <? if ($customer->getBillingCountry() == "Montserrat") {?>selected<? }?>>Montserrat</option>
					<option value="Morocco" <? if ($customer->getBillingCountry() == "Morocco") {?>selected<? }?>>Morocco</option>
					<option value="Mozambique" <? if ($customer->getBillingCountry() == "Mozambique") {?>selected<? }?>>Mozambique</option>
					<option value="Myanmar" <? if ($customer->getBillingCountry() == "Myanmar") {?>selected<? }?>>Myanmar</option>
					<option value="Namibia" <? if ($customer->getBillingCountry() == "Namibia") {?>selected<? }?>>Namibia</option>
					<option value="Nauru" <? if ($customer->getBillingCountry() == "Nauru") {?>selected<? }?>>Nauru</option>
					<option value="Nepal" <? if ($customer->getBillingCountry() == "Nepal") {?>selected<? }?>>Nepal</option>
					<option value="Neth. Antilles" <? if ($customer->getBillingCountry() == "Neth. Antilles") {?>selected<? }?>>Neth. Antilles</option>
					<option value="Netherlands" <? if ($customer->getBillingCountry() == "Netherlands") {?>selected<? }?>>Netherlands</option>
					<option value="Nevis" <? if ($customer->getBillingCountry() == "Nevis") {?>selected<? }?>>Nevis</option>
					<option value="New Caledonia" <? if ($customer->getBillingCountry() == "New Caledonia") {?>selected<? }?>>New Caledonia</option>
					<option value="New Zealand" <? if ($customer->getBillingCountry() == "New Zealand") {?>selected<? }?>>New Zealand</option>
					<option value="Nicaragua" <? if ($customer->getBillingCountry() == "Nicaragua") {?>selected<? }?>>Nicaragua</option>
					<option value="Niger Republic" <? if ($customer->getBillingCountry() == "Niger Republic") {?>selected<? }?>>Niger Republic</option>
					<option value="Nigeria" <? if ($customer->getBillingCountry() == "Nigeria") {?>selected<? }?>>Nigeria</option>
					<option value="Niue" <? if ($customer->getBillingCountry() == "Niue") {?>selected<? }?>>Niue</option>
					<option value="Norfolk Island" <? if ($customer->getBillingCountry() == "Norfolk Island") {?>selected<? }?>>Norfolk Island</option>
					<option value="Norway" <? if ($customer->getBillingCountry() == "Norway") {?>selected<? }?>>Norway</option>
					<option value="Oman" <? if ($customer->getBillingCountry() == "Oman") {?>selected<? }?>>Oman</option>
					<option value="Pakistan" <? if ($customer->getBillingCountry() == "Pakistan") {?>selected<? }?>>Pakistan</option>
					<option value="Palau" <? if ($customer->getBillingCountry() == "Palau") {?>selected<? }?>>Palau</option>
					<option value="Panama" <? if ($customer->getBillingCountry() == "Panama") {?>selected<? }?>>Panama</option>
					<option value="Papua New Guinea" <? if ($customer->getBillingCountry() == "Papua New Guinea") {?>selected<? }?>>Papua New Guinea</option>
					<option value="Paraguay" <? if ($customer->getBillingCountry() == "Paraguay") {?>selected<? }?>>Paraguay</option>
					<option value="Peru" <? if ($customer->getBillingCountry() == "Peru") {?>selected<? }?>>Peru</option>
					<option value="Philippines" <? if ($customer->getBillingCountry() == "Philippines") {?>selected<? }?>>Philippines</option>
					<option value="Poland" <? if ($customer->getBillingCountry() == "Poland") {?>selected<? }?>>Poland</option>
					<option value="Portugal" <? if ($customer->getBillingCountry() == "Portugal") {?>selected<? }?>>Portugal</option>
					<option value="Principe" <? if ($customer->getBillingCountry() == "Principe") {?>selected<? }?>>Principe</option>
					<option value="Puerto Rico" <? if ($customer->getBillingCountry() == "Puerto Rico") {?>selected<? }?>>Puerto Rico</option>
					<option value="Qatar" <? if ($customer->getBillingCountry() == "Qatar") {?>selected<? }?>>Qatar</option>
					<option value="Reunion Island" <? if ($customer->getBillingCountry() == "Reunion Island") {?>selected<? }?>>Reunion Island</option>
					<option value="Romania" <? if ($customer->getBillingCountry() == "Romania") {?>selected<? }?>>Romania</option>
					<option value="Russia" <? if ($customer->getBillingCountry() == "Russia") {?>selected<? }?>>Russia</option>
					<option value="Rwanda" <? if ($customer->getBillingCountry() == "Rwanda") {?>selected<? }?>>Rwanda</option>
					<option value="Saipan" <? if ($customer->getBillingCountry() == "Saipan") {?>selected<? }?>>Saipan</option>
					<option value="San Marino" <? if ($customer->getBillingCountry() == "San Marino") {?>selected<? }?>>San Marino</option>
					<option value="Sao Tome" <? if ($customer->getBillingCountry() == "Sao Tome") {?>selected<? }?>>Sao Tome</option>
					<option value="Saudi Arabia" <? if ($customer->getBillingCountry() == "Saudi Arabia") {?>selected<? }?>>Saudi Arabia</option>
					<option value="Senegal Republic" <? if ($customer->getBillingCountry() == "Senegal Republic") {?>selected<? }?>>Senegal Republic</option>
					<option value="Serbia, Republic of" <? if ($customer->getBillingCountry() == "Serbia, Republic of") {?>selected<? }?>>Serbia, Republic of</option>
					<option value="Seychelles" <? if ($customer->getBillingCountry() == "Seychelles") {?>selected<? }?>>Seychelles</option>
					<option value="Sierra Leone" <? if ($customer->getBillingCountry() == "Sierra Leone") {?>selected<? }?>>Sierra Leone</option>
					<option value="Singapore" <? if ($customer->getBillingCountry() == "Singapore") {?>selected<? }?>>Singapore</option>
					<option value="Slovakia" <? if ($customer->getBillingCountry() == "Slovakia") {?>selected<? }?>>Slovakia</option>
					<option value="Slovenia" <? if ($customer->getBillingCountry() == "Slovenia") {?>selected<? }?>>Slovenia</option>
					<option value="Solomon Islands" <? if ($customer->getBillingCountry() == "Solomon Islands") {?>selected<? }?>>Solomon Islands</option>
					<option value="Somalia Republic" <? if ($customer->getBillingCountry() == "Somalia Republic") {?>selected<? }?>>Somalia Republic</option>
					<option value="South Africa" <? if ($customer->getBillingCountry() == "South Africa") {?>selected<? }?>>South Africa</option>
					<option value="Spain" <? if ($customer->getBillingCountry() == "Spain") {?>selected<? }?>>Spain</option>
					<option value="Sri Lanka" <? if ($customer->getBillingCountry() == "Sri Lanka") {?>selected<? }?>>Sri Lanka</option>
					<option value="St. Helena" <? if ($customer->getBillingCountry() == "St. Helena") {?>selected<? }?>>St. Helena</option>
					<option value="St. Kitts" <? if ($customer->getBillingCountry() == "St. Kitts") {?>selected<? }?>>St. Kitts</option>
					<option value="St. Lucia" <? if ($customer->getBillingCountry() == "St. Lucia") {?>selected<? }?>>St. Lucia</option>
					<option value="St. Pierre et Miquelon" <? if ($customer->getBillingCountry() == "St. Pierre et Miquelon") {?>selected<? }?>>St. Pierre et Miquelon</option>
					<option value="St. Vincent" <? if ($customer->getBillingCountry() == "St. Vincent") {?>selected<? }?>>St. Vincent</option>
					<option value="Sudan" <? if ($customer->getBillingCountry() == "Sudan") {?>selected<? }?>>Sudan</option>
					<option value="Suriname" <? if ($customer->getBillingCountry() == "Suriname") {?>selected<? }?>>Suriname</option>
					<option value="Swaziland" <? if ($customer->getBillingCountry() == "Swaziland") {?>selected<? }?>>Swaziland</option>
					<option value="Sweden" <? if ($customer->getBillingCountry() == "Sweden") {?>selected<? }?>>Sweden</option>
					<option value="Switzerland" <? if ($customer->getBillingCountry() == "Switzerland") {?>selected<? }?>>Switzerland</option>
					<option value="Syria" <? if ($customer->getBillingCountry() == "Syria") {?>selected<? }?>>Syria</option>
					<option value="Taiwan" <? if ($customer->getBillingCountry() == "Taiwan") {?>selected<? }?>>Taiwan</option>
					<option value="Tajikistan" <? if ($customer->getBillingCountry() == "Tajikistan") {?>selected<? }?>>Tajikistan</option>
					<option value="Tanzania" <? if ($customer->getBillingCountry() == "Tanzania") {?>selected<? }?>>Tanzania</option>
					<option value="Thailand" <? if ($customer->getBillingCountry() == "Thailand") {?>selected<? }?>>Thailand</option>
					<option value="Togo" <? if ($customer->getBillingCountry() == "Togo") {?>selected<? }?>>Togo</option>
					<option value="Tokelau" <? if ($customer->getBillingCountry() == "Tokelau") {?>selected<? }?>>Tokelau</option>
					<option value="Tonga" <? if ($customer->getBillingCountry() == "Tonga") {?>selected<? }?>>Tonga</option>
					<option value="Trinidad and Tobago" <? if ($customer->getBillingCountry() == "Trinidad and Tobago") {?>selected<? }?>>Trinidad and Tobago</option>
					<option value="Tunisia" <? if ($customer->getBillingCountry() == "Tunisia") {?>selected<? }?>>Tunisia</option>
					<option value="Turkey" <? if ($customer->getBillingCountry() == "Turkey") {?>selected<? }?>>Turkey</option>
					<option value="Turkmenistan" <? if ($customer->getBillingCountry() == "Turkmenistan") {?>selected<? }?>>Turkmenistan</option>
					<option value="Turks and Caicos Islands" <? if ($customer->getBillingCountry() == "Turks and Caicos Islands") {?>selected<? }?>>Turks and Caicos Islands</option>
					<option value="Tuvalu" <? if ($customer->getBillingCountry() == "Tuvalu") {?>selected<? }?>>Tuvalu</option>
					<option value="Uganda" <? if ($customer->getBillingCountry() == "Uganda") {?>selected<? }?>>Uganda</option>
					<option value="Ukraine" <? if ($customer->getBillingCountry() == "Ukraine") {?>selected<? }?>>Ukraine</option>
					<option value="United Arab Emirates" <? if ($customer->getBillingCountry() == "United Arab Emirates") {?>selected<? }?>>United Arab Emirates</option>
					<option value="United Kingdom" <? if ($customer->getBillingCountry() == "United Kingdom") {?>selected<? }?>>United Kingdom</option>
					<option value="United States" <? if ($customer->getBillingCountry() == "" || $customer->getBillingCountry() == "United States") {?>selected<? }?>>United States</option>
					<option value="Uruguay" <? if ($customer->getBillingCountry() == "Uruguay") {?>selected<? }?>>Uruguay</option>
					<option value="US Virgin Islands" <? if ($customer->getBillingCountry() == "US Virgin Islands") {?>selected<? }?>>US Virgin Islands</option>
					<option value="Uzbekistan" <? if ($customer->getBillingCountry() == "Uzbekistan") {?>selected<? }?>>Uzbekistan</option>
					<option value="Vanuatu" <? if ($customer->getBillingCountry() == "Vanuatu") {?>selected<? }?>>Vanuatu</option>
					<option value="Vatican city" <? if ($customer->getBillingCountry() == "Vatican city") {?>selected<? }?>>Vatican city</option>
					<option value="Venezuela" <? if ($customer->getBillingCountry() == "Venezuela") {?>selected<? }?>>Venezuela</option>
					<option value="Vietnam, Soc Republic of" <? if ($customer->getBillingCountry() == "Vietnam, Soc Republic of") {?>selected<? }?>>Vietnam, Soc Republic of</option>
					<option value="Wake Island" <? if ($customer->getBillingCountry() == "Wake Island") {?>selected<? }?>>Wake Island</option>
					<option value="Wallis and Futuna Islands" <? if ($customer->getBillingCountry() == "Wallis and Futuna Islands") {?>selected<? }?>>Wallis and Futuna Islands</option>
					<option value="Western Samoa" <? if ($customer->getBillingCountry() == "Western Samoa") {?>selected<? }?>>Western Samoa</option>
					<option value="Yemen" <? if ($customer->getBillingCountry() == "Yemen") {?>selected<? }?>>Yemen</option>
					<option value="Yugoslavia" <? if ($customer->getBillingCountry() == "Yugoslavia") {?>selected<? }?>>Yugoslavia</option>
					<option value="Zaire" <? if ($customer->getBillingCountry() == "Zaire") {?>selected<? }?>>Zaire</option>
					<option value="Zambia" <? if ($customer->getBillingCountry() == "Zambia") {?>selected<? }?>>Zambia</option>
					<option value="Zanzibar" <? if ($customer->getBillingCountry() == "Zanzibar") {?>selected<? }?>>Zanzibar</option>
					<option value="Zimbabwe" <? if ($customer->getBillingCountry() == "Zimbabwe") {?>selected<? }?>>Zimbabwe</option>
				</select>
				</b></font>
			  	<? }?>
			  </td>
            </tr>
            <tr> 
              <td colspan="2"><font size="-1"><b>Billing Telephone:</b> 
                <input type="text" name="BillingPhone" value="<?=$customer->getBillingPhone()?>" size="12">
                <b><font color="#FF0000">*</font></b> </font></td>
            </tr>
            <? if ((($payment->getPaymentService(_USER) == "Manual" && WebContent::getPropertyValue("payment_method") == "Credit Card") || $payment->getPaymentService(_USER) == "VeriSign PayFlow Pro" || $payment->getPaymentService(_USER) == "Paradata") || ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && (WebContent::getPropertyValue("verisign_order_form") == "" || WebContent::getPropertyValue("verisign_order_form") == "False"))) {?>
            <? if (WebContent::getPropertyValue("other_payment_type") != "") {?>
						<tr>
              <td colspan="2" nowrap><font size="-1"><strong>Payment Method: </strong> 
                <input name="PaymentMethod" type="radio" value="credit card" checked onClick="setPaymentMethod(this.form,this.value);">
                Credit Card 
                <input type="radio" name="PaymentMethod" value="PayPal" onClick="setPaymentMethod(this.form,this.value);">
                PayPal 
                <input type="radio" name="PaymentMethod" value="Check" onClick="setPaymentMethod(this.form,this.value);">
              Check</font></td>
            </tr>
						<? }?>
            <tr> 
              <td colspan="2"><font size="-1"><b>Credit Card Type: 
                <select name="PaymentType">
                  <? if (strstr(WebContent::getPropertyValue("payment_type"),"Visa") != "" || WebContent::getPropertyValue("payment_type") == "") {?>
                  <option value="Visa" <? if($customer->getPaymentType() == "Visa") {?>selected<? }?>>Visa</option>
                  <? }?>
                  <? if (strstr(WebContent::getPropertyValue("payment_type"),"MasterCard") != "" || WebContent::getPropertyValue("payment_type") == "") {?>
                  <option value="MasterCard" <? if($customer->getPaymentType() == "MasterCard") {?>selected<? }?>>MasterCard</option>
                  <? }?>
                  <? if (strstr(WebContent::getPropertyValue("payment_type"),"Discover") != "") {?>
                  <option value="Discover" <? if($customer->getPaymentType() == "Discover") {?>selected<? }?>>Discover</option>
                  <? }?>
                  <? if (strstr(WebContent::getPropertyValue("payment_type"),"Amex") != "") {?>
                  <option value="Amex" <? if($customer->getPaymentType() == "Amex") {?>selected<? }?>>Amex</option>
                  <? }?>
                  <? if (strstr(WebContent::getPropertyValue("payment_type"),"Diners") != "") {?>
                  <option value="Diners" <? if($customer->getPaymentType() == "Diners") {?>selected<? }?>>Diners</option>
                  <? }?>
                </select>
                <b><font color="#FF0000">*</font></b></b></font></td>
            </tr>
            <tr> 
              <td colspan="2" nowrap><font size="-1"><b>Credit Card Number:</b> 
                <input type="text" name="AccountNumber" value="<?=$customer->getAccountNumber()?>" size="16" maxlength="16">
                <b><font color="#FF0000">*</font></b> (No Space)</font></td>
            </tr>
            <tr> 
              <td colspan="6"><font size="-1"><b>Credit Card Exp. Date:</b> 
                <select name="cc_exp_mm" size="1" tabindex="41">
                  <option value="01" <? if (substr($customer->getCreditCardExpDate(),0,2) == "01") {?>selected<? }?>>01</option>
                  <option value="02" <? if (substr($customer->getCreditCardExpDate(),0,2) == "02") {?>selected<? }?>>02</option>
                  <option value="03" <? if (substr($customer->getCreditCardExpDate(),0,2) == "03") {?>selected<? }?>>03</option>
                  <option value="04" <? if (substr($customer->getCreditCardExpDate(),0,2) == "04") {?>selected<? }?>>04</option>
                  <option value="05" <? if (substr($customer->getCreditCardExpDate(),0,2) == "05") {?>selected<? }?>>05</option>
                  <option value="06" <? if (substr($customer->getCreditCardExpDate(),0,2) == "06") {?>selected<? }?>>06</option>
                  <option value="07" <? if (substr($customer->getCreditCardExpDate(),0,2) == "07") {?>selected<? }?>>07</option>
                  <option value="08" <? if (substr($customer->getCreditCardExpDate(),0,2) == "08") {?>selected<? }?>>08</option>
                  <option value="09" <? if (substr($customer->getCreditCardExpDate(),0,2) == "09") {?>selected<? }?>>09</option>
                  <option value="10" <? if (substr($customer->getCreditCardExpDate(),0,2) == "10") {?>selected<? }?>>10</option>
                  <option value="11" <? if (substr($customer->getCreditCardExpDate(),0,2) == "11") {?>selected<? }?>>11</option>
                  <option value="12" <? if (substr($customer->getCreditCardExpDate(),0,2) == "12") {?>selected<? }?>>12</option>
                </select>
                / 
                <select name="cc_exp_yyyy" size="1" tabindex="43">
                  <option value="02" <? if (substr($customer->getCreditCardExpDate(),2,2) == "02") {?>selected<? }?>>2002</option>
                  <option value="03" <? if (substr($customer->getCreditCardExpDate(),2,2) == "03") {?>selected<? }?>>2003</option>
                  <option value="04" <? if (substr($customer->getCreditCardExpDate(),2,2) == "04") {?>selected<? }?>>2004</option>
                  <option value="05" <? if (substr($customer->getCreditCardExpDate(),2,2) == "05") {?>selected<? }?>>2005</option>
                  <option value="06" <? if (substr($customer->getCreditCardExpDate(),2,2) == "06") {?>selected<? }?>>2006</option>
                  <option value="07" <? if (substr($customer->getCreditCardExpDate(),2,2) == "07") {?>selected<? }?>>2007</option>
                  <option value="08" <? if (substr($customer->getCreditCardExpDate(),2,2) == "08") {?>selected<? }?>>2008</option>
                  <option value="09" <? if (substr($customer->getCreditCardExpDate(),2,2) == "09") {?>selected<? }?>>2009</option>
                  <option value="10" <? if (substr($customer->getCreditCardExpDate(),2,2) == "10") {?>selected<? }?>>2010</option>
                  <option value="11" <? if (substr($customer->getCreditCardExpDate(),2,2) == "11") {?>selected<? }?>>2011</option>
                  <option value="12" <? if (substr($customer->getCreditCardExpDate(),2,2) == "12") {?>selected<? }?>>2012</option>
                  <option value="13" <? if (substr($customer->getCreditCardExpDate(),2,2) == "13") {?>selected<? }?>>2013</option>
                </select>
                <b><font color="#FF0000">*</font></b></font></td>
            </tr>
            <? if (WebContent::getPropertyValue("ask_cvv") == "yes") {?>
            <tr> 
              <td colspan="2" nowrap><font size="-1"><strong>Credit Card Security 
                Code:</strong></font> 
                <input type="text" name="CreditCardVerCode" value="<?=$customer->getCreditCardVerCode()?>" size="3" maxlength="3">
                <font color="#FF0000">*</font> <font size="-2">(the 3-digit code 
                in back of your credit card) </font></td>
            </tr>
            <? }?>
            <? }?>
            <tr> 
              <td colspan="6"><font color="#FF0000" size="-1"><b>*</b></font><font size="-1"> 
                Required field</font></td>
            </tr>
            <? if (WebContent::getPropertyValue("payment_message") != "") {?>
            <tr> 
              <td colspan="2"><strong><font size="-1">Messages to buyer:</font></strong><br> 
                <blockquote>
                  <?=WebContent::getPropertyValue("payment_message")?>
                </blockquote></td>
            </tr>
            <? }?>
          </table>
				</blockquote>
		<? }?>
        <div align="center"> <font size="-1"> 
									<? if (WebContent::getPropertyValue("shipping_mode") == "manual" && WebContent::getPropertyValue("ship_rate_calc_method") == "by total purchase" && WebContent::getPropertyValue("express_checkout") == "yes") {?>
									<input type="hidden" name="Action" value="ProcessOrder">
									<input type="submit" name="reviewOrderButton" value="Review Order" onClick="setAction(this.form,'ReviewOrder');validateForm(this.form)">
									<input type="submit" name="Submit" value="Process Order" onClick="validateForm(this.form);">
                  <? } else {?>
				  <input type="button" name="back" value="Back" onClick="history.go(-1);">
                  <input type="submit" name="Submit" value="Proceed" onClick="validateForm(this.form);">
									<? }?>
                  <input type="reset" name="Reset" value="Reset">
            </font></div>
      </form>
		</td>
	</tr>
</table>
<script language="javascript">
<!--
<? if (WebContent::getPropertyValue("ask_state") != "no" && WebContent::getPropertyValue("ask_country") != "no") {?>
if (document.customerForm.Country.value.toLowerCase() != "united states") {
	document.customerForm.State.disabled = true;
	document.customerForm.State.value = "";
	document.customerForm.State.selectedIndex = 0;
}
<? }?>
<? if (WebContent::getPropertyValue("ask_shipping_state") != "no" && WebContent::getPropertyValue("ask_shipping_country") != "no") {?>
if (document.customerForm.ShippingCountry.value.toLowerCase() != "united states") {
	document.customerForm.ShippingState.disabled = true;
	document.customerForm.ShippingState.value = "";
	document.customerForm.ShippingState.selectedIndex = 0;
}
<? }?>
<? if (WebContent::getPropertyValue("ask_billing_state") != "no" && WebContent::getPropertyValue("ask_billing_country") != "no") {?>
if (document.customerForm.BillingCountry.value.toLowerCase() != "united states") {
	document.customerForm.BillingState.disabled = true;
	document.customerForm.BillingState.value = "";
	document.customerForm.BillingState.selectedIndex = 0;
}
<? }?>
-->
</script>