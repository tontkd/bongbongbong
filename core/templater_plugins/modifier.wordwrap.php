<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * wordwrap for utf8 encoded strings
 *
 * @param string $str
 * @param integer $len
 * @param string $what
 * @return string
 * @author Milian Wolff <mail@milianw.de>
 */
function smarty_modifier_wordwrap($str, $width=80, $break="\n", $cut=false)
{
	if (!$cut) {
		$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
	} else {
		$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';
	}
	if (function_exists('mb_strlen')) {
		$str_len = mb_strlen($str,'UTF-8');
	} else {
		$str_len = preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $var_empty);
	}

	$while_what = ceil($str_len / $width);
	$i = 1;
	$return = '';

	while ($i < $while_what) {
		preg_match($regexp, $str,$matches);
		$string = $matches[0];
		$return .= $string.$break;
		$str = substr($str, strlen($string));
		$i++;
	}

	return $return.$str;
}

?>
