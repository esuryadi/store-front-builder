<?php
require_once "../../class/UPS.php";
require_once "../../path_config.php";

$ups = new UPS();
$zone_g = $ups->getZone($origzipcode,$destzipcode,"Ground");
$rate_g = $ups->getRate($origzipcode,$destzipcode,$zone_g,"Ground",$weight,$address_type);
$zone_3ds = $ups->getZone($origzipcode,$destzipcode,"3 Day Select");
$rate_3ds = $ups->getRate($origzipcode,$destzipcode,$zone_3ds,"3 Day Select",$weight,$address_type);
$zone_2da = $ups->getZone($origzipcode,$destzipcode,"2nd Day Air");
$rate_2da = $ups->getRate($origzipcode,$destzipcode,$zone_2da,"2nd Day Air",$weight,$address_type);
$zone_2dam = $ups->getZone($origzipcode,$destzipcode,"2nd Day Air A.M.");
$rate_2dam = $ups->getRate($origzipcode,$destzipcode,$zone_2dam,"2nd Day Air A.M.",$weight,$address_type);
$zone_1das = $ups->getZone($origzipcode,$destzipcode,"Next Day Air Saver");
$rate_1das = $ups->getRate($origzipcode,$destzipcode,$zone_1das,"Next Day Air Saver",$weight,$address_type);
$zone_1da = $ups->getZone($origzipcode,$destzipcode,"Next Day Air");
$rate_1da = $ups->getRate($origzipcode,$destzipcode,$zone_1da,"Next Day Air",$weight,$address_type);
if (strtolower($country) == "canada") {
	$standard_zone = $ups->getCanadaZone($origstate,$destzipcode,"Canada Standard");
	$standard_rate = $ups->getCanadaRate($standard_zone,"Canada Standard",$weight);
	$express_zone = $ups->getCanadaZone($origstate,$destzipcode,"Worldwide Express");
	$express_rate = $ups->getCanadaRate($express_zone,"Worldwide Express",$weight);
	$expedited_zone = $ups->getCanadaZone($origstate,$destzipcode,"Worldwide Expedited");
	$expedited_rate = $ups->getCanadaRate($expedited_zone,"Worldwide Expedited",$weight);
} else {
	$standard_rate = "-";
	$express_zone = $ups->getWorldWideZone($region,$country,"Worldwide Express");
	$express_rate = $ups->getWorldWideRate($express_zone,"Worldwide Express",$weight);
	$expedited_zone = $ups->getWorldWideZone($region,$country,"Worldwide Expedited");
	$expedited_rate = $ups->getWorldWideRate($expedited_zone,"Worldwide Expedited",$weight);
}
?>
<div align="center">
  <p><strong><font size="+2">UPS Shipping Rate</font></strong></p>
  <p align="left">&nbsp;</p>
  <table border="0" cellspacing="0" cellpadding="10">
    <tr bgcolor="#CCCCCC"> 
      <td nowrap><strong>Shipping Method</strong></td>
      <td nowrap><strong>Shipping Rate</strong></td>
    </tr>
    <tr> 
      <td nowrap>UPS Ground</td>
      <td align="right" nowrap><? if ($rate_g != "-") { echo "\$"; printf("%01.2f",$rate_g); } else {?>N/A<? }?></td>
    </tr>
    <tr> 
      <td nowrap>3 Day Select</td>
      <td align="right" nowrap><? if ($rate_3ds != "-") { echo "\$"; printf("%01.2f",$rate_3ds); } else {?>N/A<? }?> 
        <div align="right"></div></td>
    </tr>
    <tr> 
      <td nowrap>2nd Day Air</td>
      <td align="right" nowrap><? if ($rate_2da != "-") { echo "\$"; printf("%01.2f",$rate_2da); } else {?>N/A<? }?> 
        <div align="right"></div></td>
    </tr>
    <tr> 
      <td nowrap>2nd Day Air A.M.</td>
      <td align="right" nowrap><? if ($rate_2dam != "-") { echo "\$"; printf("%01.2f",$rate_2dam); } else {?>N/A<? }?> 
        <div align="right"></div></td>
    </tr>
    <tr> 
      <td nowrap>Next Day Air Saver</td>
      <td align="right" nowrap><? if ($rate_1das != "-") { echo "\$"; printf("%01.2f",$rate_1das); } else {?>N/A<? }?> 
        <div align="right"></div></td>
    </tr>
    <tr> 
      <td nowrap>Next Day Air</td>
      <td align="right" nowrap><? if ($rate_1da != "-") { echo "\$"; printf("%01.2f",$rate_1da); } else {?>N/A<? }?> 
        <div align="right"></div></td>
    </tr>
    <tr>
      <td nowrap>Canada Standard </td>
      <td align="right" nowrap><? if ($standard_rate != "-") { echo "\$"; printf("%01.2f",$standard_rate); } else {?>N/A<? }?></td>
    </tr>
    <tr>
      <td nowrap>Worldwide Express </td>
      <td align="right" nowrap><? if ($express_rate != "-") { echo "\$"; printf("%01.2f",$express_rate); } else {?>N/A<? }?></td>
    </tr>
    <tr>
      <td nowrap>Worldwide Expedited </td>
      <td align="right" nowrap><? if ($expedited_rate != "-") { echo "\$"; printf("%01.2f",$expedited_rate); } else {?>N/A<? }?></td>
    </tr>
  </table>
</div>

