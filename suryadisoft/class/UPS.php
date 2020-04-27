<?php
class UPS
{
	function UPS() {
	}
	
	function getZone($origzipcode,$destzipcode,$method) {
		$code = substr($destzipcode,0,3);
		$filename = $this->getZoneFile($origzipcode);
		if (file_exists($filename)) { 
			$file_in = fopen($filename,"r");
			while(!feof($file_in)) {
				$str = fgets($file_in,10000);
				if (substr($str,0,1) != "\"" && trim($str) != "") {
					$zones = explode(",",$str);
					$destcode = $zones[0];
					if (strstr($destcode,"-") != "") {
						$range1 = strtok($destcode,"-");
						$range2 = strtok("-");
						if ($code >= $range1 && $code <= $range2) {
							if ($method == "Ground")
								return trim($zones[1]);
							else if ($method == "3 Day Select")
								return trim($zones[2]);
							else if ($method == "2nd Day Air") {
								if (trim($zones[3]) == "[1]")
									return "-";
								else if (trim($zones[3]) == "[2]")
									return $this->getHawaiiZone($destzipcode,$method);
								else if (trim($zones[3]) == "[3]")
									return $this->getAlaskaZone($destzipcode,$method);
								else
									return trim($zones[3]);
							} else if ($method == "2nd Day Air A.M.")
								return trim($zones[4]);
							else if ($method == "Next Day Air Saver")
								return trim($zones[5]);
							else if ($method == "Next Day Air") {
								if (trim($zones[6]) == "[1]")
									return "-";
								else if (trim($zones[6]) == "[2]")
									return $this->getHawaiiZone($destzipcode,$method);
								else if (trim($zones[6]) == "[3]")
									return $this->getAlaskaZone($destzipcode,$method);
								else
									return trim($zones[6]);
							}
						} 
					} else {
						if ($code == $destcode) {
							if ($method == "Ground")
								return trim($zones[1]);
							else if ($method == "3 Day Select")
								return trim($zones[2]);
							else if ($method == "2nd Day Air") {
								if (trim($zones[3]) == "[1]")
									return "-";
								else if (trim($zones[3]) == "[2]")
									return $this->getHawaiiZone($destzipcode,$method);
								else if (trim($zones[3]) == "[3]")
									return $this->getAlaskaZone($destzipcode,$method);
								else
									return trim($zones[3]);
							} else if ($method == "2nd Day Air A.M.")
								return trim($zones[4]);
							else if ($method == "Next Day Air Saver")
								return trim($zones[5]);
							else if ($method == "Next Day Air") {
								if (trim($zones[6]) == "[1]")
									return "-";
								else if (trim($zones[6]) == "[2]")
									return $this->getHawaiiZone($destzipcode,$method);
								else if (trim($zones[6]) == "[3]")
									return $this->getAlaskaZone($destzipcode,$method);
								else
									return trim($zones[6]);
							}
						} 
					}
				}
			}
			fclose($file_in);
		}
		
		return "";
	}
	
	function getCanadaZone($origstate,$destzipcode,$method) {
		$code = substr($destzipcode,0,3);
		$filename = $this->getCanadaZoneFile($origstate,$method);
		if (file_exists($filename)) {
			$file_in = fopen($filename,"r");
			while(!feof($file_in)) {
				$str = fgets($file_in,10000);
				if (substr($str,0,1) != "\"" && trim($str) != "") {
					$zones = explode(",",$str);
					$destcode = $zones[0];
					if (strlen($destcode) == 3) {
						$range1 = $zones[0];
						$range2 = $zones[1];
						if ($code >= $range1 && $code <= $range2 && ($method == "Canada Standard" || $method == "Worldwide Express")) 
							return trim($zones[2]); 
						else if ($code >= $range1 && $code <= $range2 && $method == "Worldwide Expedited") 
							return trim($zones[3]);
					} 
				}
			}
			fclose($file_in);
		}
		
		return "";
	}
	
	function getWorldwideZone($region,$country,$method) {
		$country = strtolower($country);
		$filename = $this->getWorldWideZoneFile();
		if (file_exists($filename)) {
			$file_in = fopen($filename,"r");
			while(!feof($file_in)) {
				$str = fgets($file_in,10000);
				if (substr($str,0,1) != "\"" && trim($str) != "") {
					$zones = explode(",",$str);
					if (strtolower($zones[0]) == $country) {
						if ($method == "Worldwide Express") 
							return trim($zones[2]); 
						else if ($method == "Worldwide Expedited" && $region == "Western U.S.")
							return trim($zones[4]);
						else if ($method == "Worldwide Expedited" && $region == "Eastern U.S.")
							return trim($zones[5]);
					} 
				}
			}
			fclose($file_in);
		}
		
		return "";
	}
	
	function getRate($origzipcode,$destzipcode,$zone,$method,$weight,$address_type) { 
		$filename = $this->getRateFile($origzipcode,$destzipcode,$zone,$method,$weight,$address_type);
		if (file_exists($filename)) {
			$file_in = fopen($filename,"r");
			$firsttime = true;
			$keys = array();
			while(!feof($file_in)) {
				$str = fgets($file_in,10000);
				if ($zone != "-" && substr($str,0,1) != "\"" && trim($str) != "") {
					$rates = explode(",",$str);
					if ($firsttime && substr(trim($rates[1]),0,4) == "Zone") {
						$keys = $rates;
						$firsttime = false;
					}
					if ((strtolower($weight) != "letter" && strlen($rates[0]) <= 3 && ceil($weight) == $rates[0]) || (count($keys) > 0 && strtolower($rates[0]) == "letter" && strtolower($weight) == "letter")) {
						for ($i=1;$i<count($rates);$i++) {
							if ($zone == substr(trim($keys[$i]),5)) {
								if ((trim($method) == "Next Day Air" || trim($method) == "Next Day Air Saver" || trim($method) == "2nd Day Air" || trim($method) == "3 Day Select") && $address_type == "residential")
									$rate = $rates[$i] + 1.40;
								else
									$rate = $rates[$i];								
								return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
							}			
						}
					} else {
						if (count($keys) > 0 && $weight != "letter") {
							$w1 = trim(strtok($rates[0],"to"));
							$w2 = substr(trim(strtok("to")),0,3);
							if (ceil($weight) == $w1) {
								for ($i=1;$i<count($rates);$i++) {
									if ($zone == substr(trim($keys[$i]),5)) {
										$rate = $rates[$i];
										return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
									}
								} 
							} else if (ceil($weight) > 150 && ceil($weight) < 200) {
								if ($w1 == "Mul") {
									for ($i=1;$i<count($rates);$i++) {
										if ($zone == substr(trim($keys[$i]),5)) {
											$rate = ceil($weight) * $rates[$i];
											return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
										}
									} 
								} else if (trim($method) == "Ground" && $w1 == 150) {
									for ($i=1;$i<count($rates);$i++) {
										if ($zone == substr(trim($keys[$i]),5)) {
											$rate = $rates[$i];
											return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
										}
									} 
								}
							} else if (ceil($weight) >= $w1 && ceil($weight) <= $w2) {
								for ($i=1;$i<count($rates);$i++) {
									if ($zone == substr(trim($keys[$i]),5)) {
										if ($method == "Ground" || $method == "3 Day Select")
											$rate = ceil($weight)/100 * $rates[$i];
										else
											$rate = ceil($weight) * $rates[$i];
										return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
									}
								} 
							}
						} else if (substr($rates[0],0,5) == "1000+" && ceil($weight) >= 1000) {
							for ($i=1;$i<count($rates);$i++) {
								if ($zone == substr(trim($keys[$i]),5)) {
									if ($method == "Ground" || $method == "3 Day Select")
										$rate = ceil($weight)/100 * $rates[$i];
									else
										$rate = ceil($weight) * $rates[$i];
									return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
								}
							} 
						}
					}
				}
			}
			fclose($file_in);
		}
		
		return "-";
	}
	
	function getCanadaRate($zone,$method,$weight) {
		$filename = $this->getCanadaRateFile($method);
		if (file_exists($filename)) {
			$file_in = fopen($filename,"r");
			$firsttime = true;
			$keys = array();
			while(!feof($file_in)) {
				$str = fgets($file_in,10000);
				if ($zone != "-" && $zone != "" && substr($str,0,1) != "\"" && trim($str) != "") {
					$rates = explode(",",$str);
					if ($firsttime && substr(trim($rates[1]),0,4) == "Zone") {
						$keys = $rates;
						$firsttime = false;
					}
					if (strlen($rates[0]) <= 3 && ceil($weight) == $rates[0]) {
						for ($i=1;$i<count($rates);$i++) {
							if ($zone == substr(trim($keys[$i]),5)) {
								$rate = $rates[$i];
								if ($method == "Canada Standard")
									return $rate;
								else
									return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
							}			
						}
					} 
				}
			}
			fclose($file_in);
		}
		
		return "-";
	}
	
	function getWorldWideRate($zone,$method,$weight) {
		$filename = $this->getWorldWideRateFile($method);
		if (file_exists($filename)) {
			$file_in = fopen($filename,"r");
			$firsttime = true;
			$keys = array();
			while(!feof($file_in)) {
				$str = fgets($file_in,10000);
				if ($zone != "-" && $zone != "" && substr($str,0,1) != "\"" && trim($str) != "") {
					$rates = explode(",",$str);
					if ($firsttime && substr(trim($rates[1]),0,4) == "Zone") {
						$keys = $rates;
						$firsttime = false;
					}
					if (strlen($rates[0]) <= 3 && ceil($weight) == $rates[0]) {
						for ($i=1;$i<count($rates);$i++) {
							if ($zone == substr(trim($keys[$i]),5)) {
								$rate = $rates[$i];
								return ($rate + ($rate * 0.0700)); //Add 4.50% UPS Fuel Surcharge
							}			
						}
					} 
				}
			}
			fclose($file_in);
		}
		
		return "-";
	}
	
	function getRateFile($origzipcode,$destzipcode,$zone,$method,$weight,$address_type) {
		$origcode = substr($origzipcode,0,3);
		$destcode = substr($destzipcode,0,3);
		$file = "";
		
		if ($origcode >= 995 && $origcode <= 999 && $destcode >= 995 && $destcode <= 999 && ($zone == 2 || $zone == 3) && $address_type == "residential") 
			$file = _ROOTPATH . "admin/script/ups/rates/akiakgr.csv";
		else if ($origcode >= 995 && $origcode <= 999 && $destcode >= 995 && $destcode <= 999 && ($zone == 2 || $zone == 3) && $address_type == "commercial")  
			$file = _ROOTPATH . "admin/script/ups/rates/akiakgc.csv";
		else if ($origcode >= 967 && $origcode <= 968 && $method == "Ground" && $address_type == "residential")
			$file = _ROOTPATH . "admin/script/ups/rates/hi48gr.csv";
		else if ($origcode >= 967 && $origcode <= 968 && $weight < 200 && $address_type == "commercial")
			$file = _ROOTPATH . "admin/script/ups/rates/hi48gc.csv";
		else if ($origcode >= 995 && $origcode <= 999 && $method == "Ground" && $address_type == "residential")
			$file = _ROOTPATH . "admin/script/ups/rates/ak48gr.csv";
		else if ($origcode >= 995 && $origcode <= 999 && $weight < 200 && $address_type == "commercial")
			$file = _ROOTPATH . "admin/script/ups/rates/ak48gc.csv";
		else if ($method == "Ground" && $weight < 200 && $address_type == "residential")
			$file = _ROOTPATH . "admin/script/ups/rates/gndres.csv";
		else if ($method == "Ground" && $weight < 200 && $address_type == "commercial")
			$file = _ROOTPATH . "admin/script/ups/rates/gndcomm.csv";
		else if ($method == "Ground" && $weight >= 200)
			$file = _ROOTPATH . "admin/script/ups/rates/gndcwt.csv";
		else if ($method == "3 Day Select" && $weight < 200)
			$file = _ROOTPATH . "admin/script/ups/rates/3dscomm.csv";
		else if ($method == "3 Day Select" && $weight >= 200)
			$file = _ROOTPATH . "admin/script/ups/rates/3dscwt.csv";
		else if ($origcode >= 967 && $origcode <= 968 && ($zone == 14 || $zone == 16) && $method == "2nd Day Air")
			$file = _ROOTPATH . "admin/script/ups/rates/hi2da.csv";
		else if ($origcode >= 995 && $origcode <= 999 && ($zone == 14) && $method == "2nd Day Air")
			$file = _ROOTPATH . "admin/script/ups/rates/ak_2da.csv";
		else if ($method == "2nd Day Air" && $weight < 200)
			$file = _ROOTPATH . "admin/script/ups/rates/2da.csv";
		else if ($method == "2nd Day Air" && $weight >= 200)
			$file = _ROOTPATH . "admin/script/ups/rates/2dacwt.csv";
		else if ($origcode >= 967 && $origcode <= 968 && $zone == 18 && $method == "2nd Day Air A.M.")
			$file = _ROOTPATH . "admin/script/ups/rates/hi2dam.csv";
		else if ($origcode >= 995 && $origcode <= 999 && $zone == 18 && $method == "2nd Day Air A.M.")
			$file = _ROOTPATH . "admin/script/ups/rates/ak_2dam.csv";
		else if ($method == "2nd Day Air A.M." && $weight < 200)
			$file = _ROOTPATH . "admin/script/ups/rates/2dam.csv";
		else if ($method == "2nd Day Air A.M." && $weight >= 200)
			$file = _ROOTPATH . "admin/script/ups/rates/2damcwt.csv";
		else if ($origcode >= 995 && $origcode <= 999 && $zone == 20 && $method == "Next Day Air Saver")
			$file = _ROOTPATH . "admin/script/ups/rates/ak_ndas.csv";
		else if ($method == "Next Day Air Saver" && $weight < 200)
			$file = _ROOTPATH . "admin/script/ups/rates/1dasaver.csv";
		else if ($method == "Next Day Air Saver" && $weight >= 200)
			$file = _ROOTPATH . "admin/script/ups/rates/1dasavercwt.csv";
		else if ($origcode >= 995 && $origcode <= 999 && $zone == 14 && $method == "Next Day Air") 
			$file = _ROOTPATH . "admin/script/ups/rates/ak_nda.csv";
		else if ($method == "Next Day Air" && $weight < 200) 
			$file = _ROOTPATH . "admin/script/ups/rates/1da.csv";
		else if ($method == "Next Day Air" && $weight >= 200) 
			$file = _ROOTPATH . "admin/script/ups/rates/1dacwt.csv";
		else if ($origcode >= 967 && $origcode <= 968 && ($zone == 12 || $zone == 22)) 
			$file = _ROOTPATH . "admin/script/ups/rates/hiihia.csv";
		else if ($origcode >= 967 && $origcode <= 968 && ($zone == 1 || $zone == 2) && $address_type == "residential") 
			$file = _ROOTPATH . "admin/script/ups/rates/hiiogr.csv";
		else if ($origcode >= 967 && $origcode <= 968 && ($zone == 1 || $zone == 2) && $address_type == "commercial")  
			$file = _ROOTPATH . "admin/script/ups/rates/hiiogc.csv";
			
		return $file;
	}
	
	function getCanadaRateFile($method) {
		$file = "";
		
		if ($method == "Worldwide Express")
			$file = _ROOTPATH . "admin/script/ups/rates/canada/ww-xpr.csv";
		else if ($method == "Worldwide Expedited")
			$file = _ROOTPATH . "admin/script/ups/rates/canada/ww-xpd.csv";
		else
			$file = _ROOTPATH . "admin/script/ups/rates/canada/canstnd.csv";
			
		return $file;
	}
	
	function getWorldWideRateFile($method) {
		$file = "";
		
		if ($method == "Worldwide Express")
			$file = _ROOTPATH . "admin/script/ups/rates/worldwide/ww-xpr.csv";
		else if ($method == "Worldwide Expedited")
			$file = _ROOTPATH . "admin/script/ups/rates/worldwide/ww-xpd.csv";
			
		return $file;
	}
	
	function getHawaiiZone($destzipcode,$method) {
		$zipcodegroup1 = array(96701,96706,96707,96709,96712,96717,96730,96731,96734,96744,96759,96762,96782,96786,96789,96791,96792,96795,96797,96801,96802,96803,96804,96805,96806,96807,96808,96809,96810,96811,96812,96813,96814,96815,96816,96817,96818,96819,96820,96821,96822,96823,96824,96825,96826,96827,96828,96830,96835,96836,96837,96838,96839,96840,96841,96842,96843,96844,96845,96846,96847,96848,96849,96850,96853,96854,96857,96858,96859,96860,96861,96862,96863,96898);
		$zipcodegroup2 = array(96703,96704,96705,96708,96710,96713,96714,96715,96716,96718,96719,96720,96721,96722,96725,96726,96727,96728,96729,96732,96733,96737,96738,96739,96740,96741,96742,96743,96745,96746,96747,96748,96749,96750,96751,96752,96753,96754,96755,96756,96757,96760,96761,96763,96764,96765,96766,96767,96768,96769,96770,96771,96772,96773,96774,96775,96776,96777,96778,96779,96780,96781,96783,96784,96785,96788,96790,96793,96796);
		if (array_search($destzipcode,$zipcodegroup1) == 0 || array_search($destzipcode,$zipcodegroup1) != "") {
			if ($method == "Next Day Air")
				return 124;
			else if ($method == "2nd Day Air")
				return 224;
		} else if (array_search($destzipcode,$zipcodegroup2) == 0 || array_search($destzipcode,$zipcodegroup2) != "") {
			if ($method == "Next Day Air")
				return 126;
			else if ($method == "2nd Day Air")
				return 226;
		}
		return "-";
	}
	
	function getAlaskaZone($destzipcode,$method) {
		$zipcodegroup1 = array(99501,99502,99503,99504,99505,99506,99507,99508,99509,99510,99511,99512,99513,99514,99515,99516,99517,99518,99519,99520,99521,99522,99523,99524,99540,99556,99567,99568,99572,99577,99587,99603,99605,99610,99611,99631,99635,99639,99645,99654,99664,99669,99672,99687,99701,99702,99703,99705,99706,99707,99708,99709,99710,99711,99712,99775);
		$zipcodegroup2 = array(99547,99548,99549,99550,99551,99552,99553,99554,99555,99557,99558,99559,99561,99563,99564,99565,99566,99569,99571,99573,99574,99575,99576,99578,99579,99580,99581,99583,99584,99585,99586,99588,99589,99590,99591,99602,99604,99606,99607,99608,99609,99612,99613,99614,99615,99619,99620,99621,99622,99624,99625,99626,99627,99628,99630,99632,99633,99634,99636,99637,99638,99640,99641,99643,99644,99647,99648,99649,99650,99651,99652,99653,99655,99656,99657,99658,99659,99660,99661,99662,99663,99665,99666,99667,99668,99670,99671,99674,99675,99676,99677,99678,99679,99680,99681,99682,99683,99684,99685,99686,99688,99689,99690,99691,99692,99693,99694,99695,99697,99704,99714,99716,99720,99721,99722,99723,99724,99725,99726,99727,99729,99730,99732,99733,99734,99736,99737,99738,99739,99740,99741,99742,99743,99744,99745,99746,99747,99748,99749,99750,99751,99752,99753,99754,99755,99756,99757,99758,99759,99760,99761,99762,99763,99764,99765,99766,99767,99768,99769,99770,99771,99772,99773,99774,99776,99777,99778,99779,99780,99781,99782,99783,99784,99785,99786,99788,99789,99790,99791,99801,99802,99803,99811,99820,99821,99824,99825,99826,99827,99829,99830,99832,99833,99835,99836,99840,99841,99850,99901,99903,99918,99919,99921,99922,99923,99925,99926,99927,99928,99929,99950);
		if (array_search($destzipcode,$zipcodegroup1) == 0 || array_search($destzipcode,$zipcodegroup1) != "") {
			if ($method == "Next Day Air")
				return 124;
			else if ($method == "2nd Day Air")
				return 224;
		} else if (array_search($destzipcode,$zipcodegroup2) == 0 || array_search($destzipcode,$zipcodegroup2) != "") {
			if ($method == "Next Day Air")
				return 126;
			else if ($method == "2nd Day Air")
				return 226;
		}
		return "-";
	}
	
	function getZoneFile($zipcode) {
		$code = substr($zipcode,0,3);
		$file = "";
		if ($code >= 4 && $code < 10)
			$file = _ROOTPATH . "admin/script/ups/zone/004.csv";
		else if ($code >= 10 && $code < 12)
			$file = _ROOTPATH . "admin/script/ups/zone/010.csv";
		else if ($code >= 15 && $code < 17)
			$file = _ROOTPATH . "admin/script/ups/zone/015.csv";
		else if ($code >= 17 && $code < 19)
			$file = _ROOTPATH . "admin/script/ups/zone/019.csv";
		else if ($code >= 20 && $code < 25)
			$file = _ROOTPATH . "admin/script/ups/zone/025.csv";
		else if ($code >= 25 && $code < 27)
			$file = _ROOTPATH . "admin/script/ups/zone/027.csv";
		else if ($code >= 28 && $code < 30)
			$file = _ROOTPATH . "admin/script/ups/zone/028.csv";
		else if ($code >= 30 && $code < 32)
			$file = _ROOTPATH . "admin/script/ups/zone/030.csv";
		else if ($code >= 32 && $code < 34)
			$file = _ROOTPATH . "admin/script/ups/zone/035.csv";
		else if ($code >= 40 && $code < 42)
			$file = _ROOTPATH . "admin/script/ups/zone/040.csv";
		else if ($code >= 60 && $code < 62)
			$file = _ROOTPATH . "admin/script/ups/zone/060.csv";
		else if ($code >= 64 && $code < 66)
			$file = _ROOTPATH . "admin/script/ups/zone/064.csv";
		else if ($code >= 68 && $code < 70)
			$file = _ROOTPATH . "admin/script/ups/zone/068.csv";
		else if ($code >= 70 && $code < 77)
			$file = _ROOTPATH . "admin/script/ups/zone/070.csv";
		else if ($code >= 80 && $code < 84)
			$file = _ROOTPATH . "admin/script/ups/zone/080.csv";
		else if ($code >= 85 && $code < 87)
			$file = _ROOTPATH . "admin/script/ups/zone/085.csv";
		else if ($code >= 87 && $code < 100)
			$file = _ROOTPATH . "admin/script/ups/zone/087.csv";
		else if ($code >= 100 && $code < 105)
			$file = _ROOTPATH . "admin/script/ups/zone/100.csv";
		else if ($code >= 107 && $code < 109)
			$file = _ROOTPATH . "admin/script/ups/zone/107.csv";
		else if ($code >= 110 && $code < 114)
			$file = _ROOTPATH . "admin/script/ups/zone/110.csv";
		else if ($code >= 114 && $code < 116)
			$file = _ROOTPATH . "admin/script/ups/zone/114.csv";
		else if ($code >= 117 && $code < 119)
			$file = _ROOTPATH . "admin/script/ups/zone/117.csv";
		else if ($code >= 120 && $code < 124)
			$file = _ROOTPATH . "admin/script/ups/zone/120.csv";
		else if ($code >= 124 && $code < 127)
			$file = _ROOTPATH . "admin/script/ups/zone/124.csv";
		else if ($code >= 130 && $code < 133)
			$file = _ROOTPATH . "admin/script/ups/zone/130.csv";
		else if ($code >= 133 && $code < 136)
			$file = _ROOTPATH . "admin/script/ups/zone/133.csv";
		else if ($code >= 137 && $code < 140)
			$file = _ROOTPATH . "admin/script/ups/zone/137.csv";
		else if ($code >= 140 && $code < 143)
			$file = _ROOTPATH . "admin/script/ups/zone/140.csv";
		else if ($code >= 144 && $code < 147)
			$file = _ROOTPATH . "admin/script/ups/zone/144.csv";
		else if ($code >= 148 && $code < 150)
			$file = _ROOTPATH . "admin/script/ups/zone/148.csv";
		else if ($code >= 150 && $code < 154)
			$file = _ROOTPATH . "admin/script/ups/zone/150.csv";
		else if ($code >= 164 && $code < 166)
			$file = _ROOTPATH . "admin/script/ups/zone/164.csv";
		else if ($code >= 170 && $code < 173)
			$file = _ROOTPATH . "admin/script/ups/zone/170.csv";
		else if ($code >= 173 && $code < 175)
			$file = _ROOTPATH . "admin/script/ups/zone/173.csv";
		else if ($code >= 175 && $code < 177)
			$file = _ROOTPATH . "admin/script/ups/zone/175.csv";
		else if ($code >= 180 && $code < 182)
			$file = _ROOTPATH . "admin/script/ups/zone/180.csv";
		else if ($code >= 184 && $code < 188)
			$file = _ROOTPATH . "admin/script/ups/zone/184.csv";
		else if ($code >= 190 && $code < 193)
			$file = _ROOTPATH . "admin/script/ups/zone/190.csv";
		else if ($code >= 193 && $code < 195)
			$file = _ROOTPATH . "admin/script/ups/zone/193.csv";
		else if ($code >= 195 && $code < 197)
			$file = _ROOTPATH . "admin/script/ups/zone/195.csv";
		else if ($code >= 197 && $code < 199)
			$file = _ROOTPATH . "admin/script/ups/zone/197.csv";
		else if ($code >= 200 && $code < 206)
			$file = _ROOTPATH . "admin/script/ups/zone/200.csv";
		else if ($code >= 206 && $code < 209)
			$file = _ROOTPATH . "admin/script/ups/zone/206.csv";
		else if ($code >= 210 && $code < 213)
			$file = _ROOTPATH . "admin/script/ups/zone/210.csv";
		else if ($code >= 220 && $code < 224)
			$file = _ROOTPATH . "admin/script/ups/zone/220.csv";
		else if ($code >= 224 && $code < 226)
			$file = _ROOTPATH . "admin/script/ups/zone/224.csv";
		else if ($code >= 228 && $code < 230)
			$file = _ROOTPATH . "admin/script/ups/zone/228.csv";
		else if ($code >= 230 && $code < 233)
			$file = _ROOTPATH . "admin/script/ups/zone/230.csv";
		else if ($code >= 233 && $code < 238)
			$file = _ROOTPATH . "admin/script/ups/zone/233.csv";
		else if ($code >= 240 && $code < 242)
			$file = _ROOTPATH . "admin/script/ups/zone/240.csv";
		else if ($code >= 247 && $code < 249)
			$file = _ROOTPATH . "admin/script/ups/zone/247.csv";
		else if ($code >= 250 && $code < 254)
			$file = _ROOTPATH . "admin/script/ups/zone/250.csv";
		else if ($code >= 255 && $code < 258)
			$file = _ROOTPATH . "admin/script/ups/zone/255.csv";
		else if ($code >= 258 && $code < 260)
			$file = _ROOTPATH . "admin/script/ups/zone/258.csv";
		else if ($code >= 263 && $code < 265)
			$file = _ROOTPATH . "admin/script/ups/zone/263.csv";
		else if ($code >= 268 && $code < 270)
			$file = _ROOTPATH . "admin/script/ups/zone/268.csv";
		else if ($code >= 272 && $code < 275)
			$file = _ROOTPATH . "admin/script/ups/zone/272.csv";
		else if ($code >= 275 && $code < 278)
			$file = _ROOTPATH . "admin/script/ups/zone/275.csv";
		else if ($code >= 280 && $code < 283)
			$file = _ROOTPATH . "admin/script/ups/zone/280.csv";
		else if ($code >= 287 && $code < 289)
			$file = _ROOTPATH . "admin/script/ups/zone/287.csv";
		else if ($code >= 290 && $code < 293)
			$file = _ROOTPATH . "admin/script/ups/zone/290.csv";
		else if ($code >= 300 && $code < 304)
			$file = _ROOTPATH . "admin/script/ups/zone/300.csv";
		else if ($code >= 308 && $code < 310)
			$file = _ROOTPATH . "admin/script/ups/zone/308.csv";
		else if ($code >= 313 && $code < 315)
			$file = _ROOTPATH . "admin/script/ups/zone/313.csv";
		else if ($code >= 318 && $code < 320)
			$file = _ROOTPATH . "admin/script/ups/zone/318.csv";
		else if ($code >= 320 && $code < 323)
			$file = _ROOTPATH . "admin/script/ups/zone/320.csv";
		else if ($code >= 327 && $code < 329)
			$file = _ROOTPATH . "admin/script/ups/zone/327.csv";
		else if ($code >= 330 && $code < 333)
			$file = _ROOTPATH . "admin/script/ups/zone/330.csv";
		else if ($code >= 335 && $code < 337)
			$file = _ROOTPATH . "admin/script/ups/zone/335.csv";
		else if ($code >= 339 && $code < 342)
			$file = _ROOTPATH . "admin/script/ups/zone/339.csv";
		else if ($code >= 342 && $code < 344)
			$file = _ROOTPATH . "admin/script/ups/zone/342.csv";
		else if ($code >= 344 && $code < 346)
			$file = _ROOTPATH . "admin/script/ups/zone/344.csv";
		else if ($code >= 347 && $code < 349)
			$file = _ROOTPATH . "admin/script/ups/zone/347.csv";
		else if ($code >= 350 && $code < 354)
			$file = _ROOTPATH . "admin/script/ups/zone/350.csv";
		else if ($code >= 356 && $code < 359)
			$file = _ROOTPATH . "admin/script/ups/zone/356.csv";
		else if ($code >= 360 && $code < 362)
			$file = _ROOTPATH . "admin/script/ups/zone/360.csv";
		else if ($code >= 365 && $code < 367)
			$file = _ROOTPATH . "admin/script/ups/zone/365.csv";
		else if ($code >= 370 && $code < 373)
			$file = _ROOTPATH . "admin/script/ups/zone/370.csv";
		else if ($code >= 373 && $code < 375)
			$file = _ROOTPATH . "admin/script/ups/zone/373.csv";
		else if ($code >= 377 && $code < 380)
			$file = _ROOTPATH . "admin/script/ups/zone/377.csv";
		else if ($code >= 380 && $code < 382)
			$file = _ROOTPATH . "admin/script/ups/zone/380.csv";
		else if ($code >= 390 && $code < 393)
			$file = _ROOTPATH . "admin/script/ups/zone/390.csv";
		else if ($code >= 397 && $code < 399)
			$file = _ROOTPATH . "admin/script/ups/zone/397.csv";
		else if ($code >= 400 && $code < 403)
			$file = _ROOTPATH . "admin/script/ups/zone/400.csv";
		else if ($code >= 403 && $code < 406)
			$file = _ROOTPATH . "admin/script/ups/zone/403.csv";
		else if ($code >= 407 && $code < 410)
			$file = _ROOTPATH . "admin/script/ups/zone/407.csv";
		else if ($code >= 411 && $code < 413)
			$file = _ROOTPATH . "admin/script/ups/zone/411.csv";
		else if ($code >= 413 && $code < 415)
			$file = _ROOTPATH . "admin/script/ups/zone/413.csv";
		else if ($code >= 415 && $code < 417)
			$file = _ROOTPATH . "admin/script/ups/zone/415.csv";
		else if ($code >= 417 && $code < 420)
			$file = _ROOTPATH . "admin/script/ups/zone/417.csv";
		else if ($code >= 421 && $code < 423)
			$file = _ROOTPATH . "admin/script/ups/zone/421.csv";
		else if ($code >= 425 && $code < 427)
			$file = _ROOTPATH . "admin/script/ups/zone/425.csv";
		else if ($code >= 427 && $code < 430)
			$file = _ROOTPATH . "admin/script/ups/zone/427.csv";
		else if ($code >= 430 && $code < 433)
			$file = _ROOTPATH . "admin/script/ups/zone/430.csv";
		else if ($code >= 434 && $code < 437)
			$file = _ROOTPATH . "admin/script/ups/zone/434.csv";
		else if ($code >= 437 && $code < 439)
			$file = _ROOTPATH . "admin/script/ups/zone/437.csv";
		else if ($code >= 440 && $code < 444)
			$file = _ROOTPATH . "admin/script/ups/zone/440.csv";
		else if ($code >= 444 && $code < 446)
			$file = _ROOTPATH . "admin/script/ups/zone/444.csv";
		else if ($code >= 446 && $code < 448)
			$file = _ROOTPATH . "admin/script/ups/zone/446.csv";
		else if ($code >= 448 && $code < 450)
			$file = _ROOTPATH . "admin/script/ups/zone/448.csv";
		else if ($code >= 450 && $code < 453)
			$file = _ROOTPATH . "admin/script/ups/zone/450.csv";
		else if ($code >= 453 && $code < 455)
			$file = _ROOTPATH . "admin/script/ups/zone/453.csv";
		else if ($code >= 460 && $code < 463)
			$file = _ROOTPATH . "admin/script/ups/zone/460.csv";
		else if ($code >= 463 && $code < 465)
			$file = _ROOTPATH . "admin/script/ups/zone/463.csv";
		else if ($code >= 465 && $code < 467)
			$file = _ROOTPATH . "admin/script/ups/zone/465.csv";
		else if ($code >= 467 && $code < 469)
			$file = _ROOTPATH . "admin/script/ups/zone/467.csv";
		else if ($code >= 476 && $code < 478)
			$file = _ROOTPATH . "admin/script/ups/zone/476.csv";
		else if ($code >= 480 && $code < 484)
			$file = _ROOTPATH . "admin/script/ups/zone/480.csv";
		else if ($code >= 484 && $code < 488)
			$file = _ROOTPATH . "admin/script/ups/zone/484.csv";
		else if ($code >= 488 && $code < 490)
			$file = _ROOTPATH . "admin/script/ups/zone/488.csv";
		else if ($code >= 490 && $code < 492)
			$file = _ROOTPATH . "admin/script/ups/zone/490.csv";
		else if ($code >= 493 && $code < 496)
			$file = _ROOTPATH . "admin/script/ups/zone/493.csv";
		else if ($code >= 498 && $code < 500)
			$file = _ROOTPATH . "admin/script/ups/zone/498.csv";
		else if ($code >= 500 && $code < 504)
			$file = _ROOTPATH . "admin/script/ups/zone/500.csv";
		else if ($code >= 506 && $code < 508)
			$file = _ROOTPATH . "admin/script/ups/zone/508.csv";
		else if ($code >= 510 && $code < 512)
			$file = _ROOTPATH . "admin/script/ups/zone/510.csv";
		else if ($code >= 516 && $code < 520)
			$file = _ROOTPATH . "admin/script/ups/zone/516.csv";
		else if ($code >= 522 && $code < 525)
			$file = _ROOTPATH . "admin/script/ups/zone/522.csv";
		else if ($code >= 528 && $code < 530)
			$file = _ROOTPATH . "admin/script/ups/zone/528.csv";
		else if ($code >= 530 && $code < 534)
			$file = _ROOTPATH . "admin/script/ups/zone/530.csv";
		else if ($code >= 535 && $code < 538)
			$file = _ROOTPATH . "admin/script/ups/zone/535.csv";
		else if ($code >= 541 && $code < 544)
			$file = _ROOTPATH . "admin/script/ups/zone/541.csv";
		else if ($code >= 550 && $code < 556)
			$file = _ROOTPATH . "admin/script/ups/zone/550.csv";
		else if ($code >= 556 && $code < 559)
			$file = _ROOTPATH . "admin/script/ups/zone/556.csv";
		else if ($code >= 567 && $code < 570)
			$file = _ROOTPATH . "admin/script/ups/zone/567.csv";
		else if ($code >= 570 && $code < 572)
			$file = _ROOTPATH . "admin/script/ups/zone/570.csv";
		else if ($code >= 577 && $code < 580)
			$file = _ROOTPATH . "admin/script/ups/zone/577.csv";
		else if ($code >= 580 && $code < 582)
			$file = _ROOTPATH . "admin/script/ups/zone/580.csv";
		else if ($code >= 588 && $code < 590)
			$file = _ROOTPATH . "admin/script/ups/zone/588.csv";
		else if ($code >= 590 && $code < 592)
			$file = _ROOTPATH . "admin/script/ups/zone/590.csv";
		else if ($code >= 600 && $code < 602)
			$file = _ROOTPATH . "admin/script/ups/zone/600.csv";
		else if ($code >= 603 && $code < 609)
			$file = _ROOTPATH . "admin/script/ups/zone/603.csv";
		else if ($code >= 610 && $code < 612)
			$file = _ROOTPATH . "admin/script/ups/zone/610.csv";
		else if ($code >= 615 && $code < 617)
			$file = _ROOTPATH . "admin/script/ups/zone/615.csv";
		else if ($code >= 618 && $code < 620)
			$file = _ROOTPATH . "admin/script/ups/zone/618.csv";
		else if ($code >= 620 && $code < 623)
			$file = _ROOTPATH . "admin/script/ups/zone/620.csv";
		else if ($code >= 625 && $code < 628)
			$file = _ROOTPATH . "admin/script/ups/zone/625.csv";
		else if ($code >= 630 && $code < 634)
			$file = _ROOTPATH . "admin/script/ups/zone/630.csv";
		else if ($code >= 640 && $code < 644)
			$file = _ROOTPATH . "admin/script/ups/zone/640.csv";
		else if ($code >= 644 && $code < 646)
			$file = _ROOTPATH . "admin/script/ups/zone/644.csv";
		else if ($code >= 650 && $code < 653)
			$file = _ROOTPATH . "admin/script/ups/zone/650.csv";
		else if ($code >= 654 && $code < 656)
			$file = _ROOTPATH . "admin/script/ups/zone/654.csv";
		else if ($code >= 656 && $code < 660)
			$file = _ROOTPATH . "admin/script/ups/zone/656.csv";
		else if ($code >= 660 && $code < 664)
			$file = _ROOTPATH . "admin/script/ups/zone/660.csv";
		else if ($code >= 664 && $code < 667)
			$file = _ROOTPATH . "admin/script/ups/zone/664.csv";
		else if ($code >= 670 && $code < 673)
			$file = _ROOTPATH . "admin/script/ups/zone/670.csv";
		else if ($code >= 680 && $code < 683)
			$file = _ROOTPATH . "admin/script/ups/zone/680.csv";
		else if ($code >= 683 && $code < 686)
			$file = _ROOTPATH . "admin/script/ups/zone/683.csv";
		else if ($code >= 688 && $code < 690)
			$file = _ROOTPATH . "admin/script/ups/zone/688.csv";
		else if ($code >= 693 && $code < 700)
			$file = _ROOTPATH . "admin/script/ups/zone/693.csv";
		else if ($code >= 700 && $code < 703)
			$file = _ROOTPATH . "admin/script/ups/zone/700.csv";
		else if ($code >= 707 && $code < 710)
			$file = _ROOTPATH . "admin/script/ups/zone/707.csv";
		else if ($code >= 710 && $code < 712)
			$file = _ROOTPATH . "admin/script/ups/zone/710.csv";
		else if ($code >= 713 && $code < 716)
			$file = _ROOTPATH . "admin/script/ups/zone/713.csv";
		else if ($code >= 720 && $code < 723)
			$file = _ROOTPATH . "admin/script/ups/zone/720.csv";
		else if ($code >= 730 && $code < 733)
			$file = _ROOTPATH . "admin/script/ups/zone/730.csv";
		else if ($code >= 740 && $code < 743)
			$file = _ROOTPATH . "admin/script/ups/zone/740.csv";
		else if ($code >= 750 && $code < 755)
			$file = _ROOTPATH . "admin/script/ups/zone/750.csv";
		else if ($code >= 760 && $code < 762)
			$file = _ROOTPATH . "admin/script/ups/zone/760.csv";
		else if ($code >= 766 && $code < 768)
			$file = _ROOTPATH . "admin/script/ups/zone/766.csv";
		else if ($code >= 770 && $code < 773)
			$file = _ROOTPATH . "admin/script/ups/zone/770.csv";
		else if ($code >= 774 && $code < 776)
			$file = _ROOTPATH . "admin/script/ups/zone/774.csv";
		else if ($code >= 776 && $code < 778)
			$file = _ROOTPATH . "admin/script/ups/zone/776.csv";
		else if ($code >= 780 && $code < 783)
			$file = _ROOTPATH . "admin/script/ups/zone/780.csv";
		else if ($code >= 783 && $code < 785)
			$file = _ROOTPATH . "admin/script/ups/zone/783.csv";
		else if ($code >= 786 && $code < 788)
			$file = _ROOTPATH . "admin/script/ups/zone/786.csv";
		else if ($code >= 790 && $code < 792)
			$file = _ROOTPATH . "admin/script/ups/zone/790.csv";
		else if ($code >= 793 && $code < 795)
			$file = _ROOTPATH . "admin/script/ups/zone/793.csv";
		else if ($code >= 795 && $code < 797)
			$file = _ROOTPATH . "admin/script/ups/zone/795.csv";
		else if ($code >= 798 && $code < 800)
			$file = _ROOTPATH . "admin/script/ups/zone/798.csv";
		else if ($code >= 800 && $code < 803)
			$file = _ROOTPATH . "admin/script/ups/zone/800.csv";
		else if ($code >= 808 && $code < 810)
			$file = _ROOTPATH . "admin/script/ups/zone/808.csv";
		else if ($code >= 816 && $code < 820)
			$file = _ROOTPATH . "admin/script/ups/zone/816.csv";
		else if ($code >= 829 && $code < 831)
			$file = _ROOTPATH . "admin/script/ups/zone/829.csv";
		else if ($code >= 836 && $code < 838)
			$file = _ROOTPATH . "admin/script/ups/zone/836.csv";
		else if ($code >= 838 && $code < 840)
			$file = _ROOTPATH . "admin/script/ups/zone/838.csv";
		else if ($code >= 840 && $code < 842)
			$file = _ROOTPATH . "admin/script/ups/zone/840.csv";
		else if ($code >= 842 && $code < 845)
			$file = _ROOTPATH . "admin/script/ups/zone/842.csv";
		else if ($code >= 847 && $code < 850)
			$file = _ROOTPATH . "admin/script/ups/zone/847.csv";
		else if ($code >= 850 && $code < 852)
			$file = _ROOTPATH . "admin/script/ups/zone/852.csv";
		else if ($code >= 856 && $code < 859)
			$file = _ROOTPATH . "admin/script/ups/zone/856.csv";
		else if ($code >= 860 && $code < 863)
			$file = _ROOTPATH . "admin/script/ups/zone/860.csv";
		else if ($code >= 865 && $code < 870)
			$file = _ROOTPATH . "admin/script/ups/zone/865.csv";
		else if ($code >= 870 && $code < 873)
			$file = _ROOTPATH . "admin/script/ups/zone/870.csv";
		else if ($code >= 875 && $code < 877)
			$file = _ROOTPATH . "admin/script/ups/zone/875.csv";
		else if ($code >= 885 && $code < 889)
			$file = _ROOTPATH . "admin/script/ups/zone/885.csv";
		else if ($code >= 889 && $code < 893)
			$file = _ROOTPATH . "admin/script/ups/zone/889.csv";
		else if ($code >= 894 && $code < 898)
			$file = _ROOTPATH . "admin/script/ups/zone/894.csv";
		else if ($code >= 898 && $code < 900)
			$file = _ROOTPATH . "admin/script/ups/zone/898.csv";
		else if ($code >= 900 && $code < 902)
			$file = _ROOTPATH . "admin/script/ups/zone/900.csv";
		else if ($code >= 902 && $code < 910)
			$file = _ROOTPATH . "admin/script/ups/zone/902.csv";
		else if ($code >= 910 && $code < 919)
			$file = _ROOTPATH . "admin/script/ups/zone/910.csv";
		else if ($code >= 919 && $code < 922)
			$file = _ROOTPATH . "admin/script/ups/zone/919.csv";
		else if ($code >= 923 && $code < 926)
			$file = _ROOTPATH . "admin/script/ups/zone/923.csv";
		else if ($code >= 926 && $code < 930)
			$file = _ROOTPATH . "admin/script/ups/zone/926.csv";
		else if ($code >= 932 && $code < 934)
			$file = _ROOTPATH . "admin/script/ups/zone/932.csv";
		else if ($code >= 936 && $code < 939)
			$file = _ROOTPATH . "admin/script/ups/zone/936.csv";
		else if ($code >= 940 && $code < 942)
			$file = _ROOTPATH . "admin/script/ups/zone/940.csv";
		else if ($code >= 944 && $code < 949)
			$file = _ROOTPATH . "admin/script/ups/zone/944.csv";
		else if ($code >= 950 && $code < 952)
			$file = _ROOTPATH . "admin/script/ups/zone/950.csv";
		else if ($code >= 952 && $code < 954)
			$file = _ROOTPATH . "admin/script/ups/zone/952.csv";
		else if ($code >= 956 && $code < 959)
			$file = _ROOTPATH . "admin/script/ups/zone/954.csv";
		else if ($code >= 961 && $code < 970)
			$file = _ROOTPATH . "admin/script/ups/zone/961.csv";
		else if ($code >= 970 && $code < 973)
			$file = _ROOTPATH . "admin/script/ups/zone/970.csv";
		else if ($code >= 980 && $code < 983)
			$file = _ROOTPATH . "admin/script/ups/zone/980.csv";
		else if ($code >= 983 && $code < 985)
			$file = _ROOTPATH . "admin/script/ups/zone/983.csv";
		else if ($code >= 986 && $code < 988)
			$file = _ROOTPATH . "admin/script/ups/zone/986.csv";
		else if ($code >= 990 && $code < 993)
			$file = _ROOTPATH . "admin/script/ups/zone/990.csv";
		else if ($code >= 994 && $code < 999)
			$file = _ROOTPATH . "admin/script/ups/zone/994.csv";
		else
			$file = _ROOTPATH . "admin/script/ups/zone/" . $code . ".csv";
			
		return $file;
	}
	
	function getCanadaZoneFile($state,$method) {
		if ($state == "AL") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/alabama.csv";
		else if ($state == "AK")
			$file = "none";
		else if ($state == "AZ")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/arizona.csv";
		else if ($state == "AR")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/arkansas.csv";
		else if ($state == "CA") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/cal.csv";
		else if ($state == "CO")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/colorado.csv";
		else if ($state == "CT") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/conn.csv";
		else if ($state == "DC")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/d_of_c.csv";
		else if ($state == "DE") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/delaware.csv";
		else if ($state == "FL")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/florida.csv";
		else if ($state == "GA")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/georgia.csv";
		else if ($state == "HI") 
			$file = "none";
		else if ($state == "ID") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/idaho.csv";
		else if ($state == "IL") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/illinois.csv";
		else if ($state == "IN")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/indiana.csv";
		else if ($state == "IA")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/iowa.csv";
		else if ($state == "KS")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/kansas.csv";
		else if ($state == "KY")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/kentucky.csv";
		else if ($state == "LA") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/louisian.csv";
		else if ($state == "ME") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/maine.csv";
		else if ($state == "MD")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/maryland.csv";
		else if ($state == "MA") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/mass.csv";
		else if ($state == "MI")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/michigan.csv";
		else if ($state == "MN") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/minn.csv";
		else if ($state == "MS") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/miss.csv";
		else if ($state == "MO")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/missouri.csv";
		else if ($state == "MT")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/montana.csv";
		else if ($state == "NE") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/nebraska.csv";
		else if ($state == "NV")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/nevada.csv";
		else if ($state == "NH")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/n_hamp.csv";
		else if ($state == "NJ")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/n_jer.csv";
		else if ($state == "NM")
		 	$file = _ROOTPATH . "admin/script/ups/zone/canada/n_mex.csv";
		else if ($state == "NY")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/new_york.csv";
		else if ($state == "NC")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/n_car.csv";
		else if ($state == "ND")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/n_dak.csv";
		else if ($state == "OH")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/ohio.csv";
		else if ($state == "OK")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/oklahoma.csv";
		else if ($state == "OR") 
			$file = _ROOTPATH . "admin/script/ups/zone/canada/oregon.csv";
		else if ($state == "PA")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/penn.csv";
		else if ($state == "PR")
			$file = "none";
		else if ($state == "RI")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/r_isl.csv";
		else if ($state == "SC")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/s_car.csv";
		else if ($state == "SD")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/s_dak.csv";
		else if ($state == "TN")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/tenn.csv";
		else if ($state == "TX")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/texas.csv";
		else if ($state == "UT")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/utah.csv";
		else if ($state == "VT")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/vermont.csv";
		else if ($state == "VA")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/virginia.csv";
		else if ($state == "WA")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/wash.csv";
		else if ($state == "WV")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/wvir.csv";
		else if ($state == "WI")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/wis.csv";
		else if ($state == "WY")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/wyoming.csv";
			
		if ($method == "Worldwide Express" || $method == "Worldwide Expedited")
			$file = _ROOTPATH . "admin/script/ups/zone/canada/canww.csv";
		
		return $file;
	}
	
	function getWorldWideZoneFile() {
		return _ROOTPATH . "admin/script/ups/zone/worldwide/ewwzone.csv";
	}
}
?>
