<?php

	/**
	 * Original data taken from:
	 * ftp://ftp.unicode.org/Public/MAPPINGS/VENDORS/MICSFT/WINDOWS/CP1256.TXT
	 * @param string $string
	 * @return string
	 */
	function charset_encode_windows_1256($string)
	{
		$mapping = array(
					"\xE2\x82\xAC" => "\x80",
					"\xD9\xBE" => "\x81",
					"\xE2\x80\x9A" => "\x82",
					"\xC6\x92" => "\x83",
					"\xE2\x80\x9E" => "\x84",
					"\xE2\x80\xA6" => "\x85",
					"\xE2\x80\xA0" => "\x86",
					"\xE2\x80\xA1" => "\x87",
					"\xCB\x86" => "\x88",
					"\xE2\x80\xB0" => "\x89",
					"\xD9\xB9" => "\x8A",
					"\xE2\x80\xB9" => "\x8B",
					"\xC5\x92" => "\x8C",
					"\xDA\x86" => "\x8D",
					"\xDA\x98" => "\x8E",
					"\xDA\x88" => "\x8F",
					"\xDA\xAF" => "\x90",
					"\xE2\x80\x98" => "\x91",
					"\xE2\x80\x99" => "\x92",
					"\xE2\x80\x9C" => "\x93",
					"\xE2\x80\x9D" => "\x94",
					"\xE2\x80\xA2" => "\x95",
					"\xE2\x80\x93" => "\x96",
					"\xE2\x80\x94" => "\x97",
					"\xDA\xA9" => "\x98",
					"\xE2\x84\xA2" => "\x99",
					"\xDA\x91" => "\x9A",
					"\xE2\x80\xBA" => "\x9B",
					"\xC5\x93" => "\x9C",
					"\xE2\x80\x8C" => "\x9D",
					"\xE2\x80\x8D" => "\x9E",
					"\xDA\xBA" => "\x9F",
					"\xC2\xA0" => "\xA0",
					"\xD8\x8C" => "\xA1",
					"\xC2\xA2" => "\xA2",
					"\xC2\xA3" => "\xA3",
					"\xC2\xA4" => "\xA4",
					"\xC2\xA5" => "\xA5",
					"\xC2\xA6" => "\xA6",
					"\xC2\xA7" => "\xA7",
					"\xC2\xA8" => "\xA8",
					"\xC2\xA9" => "\xA9",
					"\xDA\xBE" => "\xAA",
					"\xC2\xAB" => "\xAB",
					"\xC2\xAC" => "\xAC",
					"\xC2\xAD" => "\xAD",
					"\xC2\xAE" => "\xAE",
					"\xC2\xAF" => "\xAF",
					"\xC2\xB0" => "\xB0",
					"\xC2\xB1" => "\xB1",
					"\xC2\xB2" => "\xB2",
					"\xC2\xB3" => "\xB3",
					"\xC2\xB4" => "\xB4",
					"\xC2\xB5" => "\xB5",
					"\xC2\xB6" => "\xB6",
					"\xC2\xB7" => "\xB7",
					"\xC2\xB8" => "\xB8",
					"\xC2\xB9" => "\xB9",
					"\xD8\x9B" => "\xBA",
					"\xC2\xBB" => "\xBB",
					"\xC2\xBC" => "\xBC",
					"\xC2\xBD" => "\xBD",
					"\xC2\xBE" => "\xBE",
					"\xD8\x9F" => "\xBF",
					"\xDB\x81" => "\xC0",
					"\xD8\xA1" => "\xC1",
					"\xD8\xA2" => "\xC2",
					"\xD8\xA3" => "\xC3",
					"\xD8\xA4" => "\xC4",
					"\xD8\xA5" => "\xC5",
					"\xD8\xA6" => "\xC6",
					"\xD8\xA7" => "\xC7",
					"\xD8\xA8" => "\xC8",
					"\xD8\xA9" => "\xC9",
					"\xD8\xAA" => "\xCA",
					"\xD8\xAB" => "\xCB",
					"\xD8\xAC" => "\xCC",
					"\xD8\xAD" => "\xCD",
					"\xD8\xAE" => "\xCE",
					"\xD8\xAF" => "\xCF",
					"\xD8\xB0" => "\xD0",
					"\xD8\xB1" => "\xD1",
					"\xD8\xB2" => "\xD2",
					"\xD8\xB3" => "\xD3",
					"\xD8\xB4" => "\xD4",
					"\xD8\xB5" => "\xD5",
					"\xD8\xB6" => "\xD6",
					"\xC3\x97" => "\xD7",
					"\xD8\xB7" => "\xD8",
					"\xD8\xB8" => "\xD9",
					"\xD8\xB9" => "\xDA",
					"\xD8\xBA" => "\xDB",
					"\xD9\x80" => "\xDC",
					"\xD9\x81" => "\xDD",
					"\xD9\x82" => "\xDE",
					"\xD9\x83" => "\xDF",
					"\xC3\xA0" => "\xE0",
					"\xD9\x84" => "\xE1",
					"\xC3\xA2" => "\xE2",
					"\xD9\x85" => "\xE3",
					"\xD9\x86" => "\xE4",
					"\xD9\x87" => "\xE5",
					"\xD9\x88" => "\xE6",
					"\xC3\xA7" => "\xE7",
					"\xC3\xA8" => "\xE8",
					"\xC3\xA9" => "\xE9",
					"\xC3\xAA" => "\xEA",
					"\xC3\xAB" => "\xEB",
					"\xD9\x89" => "\xEC",
					"\xD9\x8A" => "\xED",
					"\xC3\xAE" => "\xEE",
					"\xC3\xAF" => "\xEF",
					"\xD9\x8B" => "\xF0",
					"\xD9\x8C" => "\xF1",
					"\xD9\x8D" => "\xF2",
					"\xD9\x8E" => "\xF3",
					"\xC3\xB4" => "\xF4",
					"\xD9\x8F" => "\xF5",
					"\xD9\x90" => "\xF6",
					"\xC3\xB7" => "\xF7",
					"\xD9\x91" => "\xF8",
					"\xC3\xB9" => "\xF9",
					"\xD9\x92" => "\xFA",
					"\xC3\xBB" => "\xFB",
					"\xC3\xBC" => "\xFC",
					"\xE2\x80\x8E" => "\xFD",
					"\xE2\x80\x8F" => "\xFE",
					"\xDB\x92" => "\xFF");

		return str_replace(array_keys($mapping), array_values($mapping), $string);
	}

?>
