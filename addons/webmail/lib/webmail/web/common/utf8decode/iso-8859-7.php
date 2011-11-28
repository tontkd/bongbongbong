<?php

	/**
	 * Original data taken from:
	 * ftp://ftp.unicode.org/Public/MAPPINGS/ISO8859/8859-7.TXT
	 * @param string $string
	 * @return string
	 */
	function charset_decode_iso_8859_7($string)
	{
		$mapping = array(
					"\x80" => "\xC2\x80",
					"\x81" => "\xC2\x81",
					"\x82" => "\xC2\x82",
					"\x83" => "\xC2\x83",
					"\x84" => "\xC2\x84",
					"\x85" => "\xC2\x85",
					"\x86" => "\xC2\x86",
					"\x87" => "\xC2\x87",
					"\x88" => "\xC2\x88",
					"\x89" => "\xC2\x89",
					"\x8A" => "\xC2\x8A",
					"\x8B" => "\xC2\x8B",
					"\x8C" => "\xC2\x8C",
					"\x8D" => "\xC2\x8D",
					"\x8E" => "\xC2\x8E",
					"\x8F" => "\xC2\x8F",
					"\x90" => "\xC2\x90",
					"\x91" => "\xC2\x91",
					"\x92" => "\xC2\x92",
					"\x93" => "\xC2\x93",
					"\x94" => "\xC2\x94",
					"\x95" => "\xC2\x95",
					"\x96" => "\xC2\x96",
					"\x97" => "\xC2\x97",
					"\x98" => "\xC2\x98",
					"\x99" => "\xC2\x99",
					"\x9A" => "\xC2\x9A",
					"\x9B" => "\xC2\x9B",
					"\x9C" => "\xC2\x9C",
					"\x9D" => "\xC2\x9D",
					"\x9E" => "\xC2\x9E",
					"\x9F" => "\xC2\x9F",
					"\xA0" => "\xC2\xA0",
					"\xA1" => "\xE2\x80\x98",
					"\xA2" => "\xE2\x80\x99",
					"\xA3" => "\xC2\xA3",
					"\xA4" => "\xE2\x82\xAC",
					"\xA5" => "\xE2\x82\xAF",
					"\xA6" => "\xC2\xA6",
					"\xA7" => "\xC2\xA7",
					"\xA8" => "\xC2\xA8",
					"\xA9" => "\xC2\xA9",
					"\xAA" => "\xCD\xBA",
					"\xAB" => "\xC2\xAB",
					"\xAC" => "\xC2\xAC",
					"\xAD" => "\xC2\xAD",
					"\xAF" => "\xE2\x80\x95",
					"\xB0" => "\xC2\xB0",
					"\xB1" => "\xC2\xB1",
					"\xB2" => "\xC2\xB2",
					"\xB3" => "\xC2\xB3",
					"\xB4" => "\xCE\x84",
					"\xB5" => "\xCE\x85",
					"\xB6" => "\xCE\x86",
					"\xB7" => "\xC2\xB7",
					"\xB8" => "\xCE\x88",
					"\xB9" => "\xCE\x89",
					"\xBA" => "\xCE\x8A",
					"\xBB" => "\xC2\xBB",
					"\xBC" => "\xCE\x8C",
					"\xBD" => "\xC2\xBD",
					"\xBE" => "\xCE\x8E",
					"\xBF" => "\xCE\x8F",
					"\xC0" => "\xCE\x90",
					"\xC1" => "\xCE\x91",
					"\xC2" => "\xCE\x92",
					"\xC3" => "\xCE\x93",
					"\xC4" => "\xCE\x94",
					"\xC5" => "\xCE\x95",
					"\xC6" => "\xCE\x96",
					"\xC7" => "\xCE\x97",
					"\xC8" => "\xCE\x98",
					"\xC9" => "\xCE\x99",
					"\xCA" => "\xCE\x9A",
					"\xCB" => "\xCE\x9B",
					"\xCC" => "\xCE\x9C",
					"\xCD" => "\xCE\x9D",
					"\xCE" => "\xCE\x9E",
					"\xCF" => "\xCE\x9F",
					"\xD0" => "\xCE\xA0",
					"\xD1" => "\xCE\xA1",
					"\xD3" => "\xCE\xA3",
					"\xD4" => "\xCE\xA4",
					"\xD5" => "\xCE\xA5",
					"\xD6" => "\xCE\xA6",
					"\xD7" => "\xCE\xA7",
					"\xD8" => "\xCE\xA8",
					"\xD9" => "\xCE\xA9",
					"\xDA" => "\xCE\xAA",
					"\xDB" => "\xCE\xAB",
					"\xDC" => "\xCE\xAC",
					"\xDD" => "\xCE\xAD",
					"\xDE" => "\xCE\xAE",
					"\xDF" => "\xCE\xAF",
					"\xE0" => "\xCE\xB0",
					"\xE1" => "\xCE\xB1",
					"\xE2" => "\xCE\xB2",
					"\xE3" => "\xCE\xB3",
					"\xE4" => "\xCE\xB4",
					"\xE5" => "\xCE\xB5",
					"\xE6" => "\xCE\xB6",
					"\xE7" => "\xCE\xB7",
					"\xE8" => "\xCE\xB8",
					"\xE9" => "\xCE\xB9",
					"\xEA" => "\xCE\xBA",
					"\xEB" => "\xCE\xBB",
					"\xEC" => "\xCE\xBC",
					"\xED" => "\xCE\xBD",
					"\xEE" => "\xCE\xBE",
					"\xEF" => "\xCE\xBF",
					"\xF0" => "\xCF\x80",
					"\xF1" => "\xCF\x81",
					"\xF2" => "\xCF\x82",
					"\xF3" => "\xCF\x83",
					"\xF4" => "\xCF\x84",
					"\xF5" => "\xCF\x85",
					"\xF6" => "\xCF\x86",
					"\xF7" => "\xCF\x87",
					"\xF8" => "\xCF\x88",
					"\xF9" => "\xCF\x89",
					"\xFA" => "\xCF\x8A",
					"\xFB" => "\xCF\x8B",
					"\xFC" => "\xCF\x8C",
					"\xFD" => "\xCF\x8D",
					"\xFE" => "\xCF\x8E");

		$outStr = '';
    	for ($i = 0, $len = strlen($string); $i < $len; $i++)
    	{
    		$outStr .= (array_key_exists($string{$i}, $mapping))?$mapping[$string{$i}]:$string{$i};
		}
		
		return $outStr;
	}

?>