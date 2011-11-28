<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (defined('TRANSLATION_MODE') && preg_match('/(\[lang name\=[\w-]+?( [pre\-ajx]*)?\])(.*?)(\[\/lang\])/is', $string, $matches)) {
    	list(, $pre, , $string, $post) = $matches;
	} else {
		$pre = $post = '';
	}


	if (strlen(utf8_decode($string)) > $length) {
		$length -= strlen(utf8_decode($etc));
		if (!$break_words && !$middle) {
			$string = preg_replace('/\s+?(\S+)?$/u', '', smarty_utf8_substr($string, 0, $length+1));
		}

		if(!$middle) {
			return smarty_utf8_substr($string, 0, $length).$etc;
		} else {
			return smarty_utf8_substr($string, 0, $length/2) . $etc . smarty_utf8_substr($string, -$length/2);
		}
	} else {
		return $string;
	}
}

function smarty_utf8_substr($str, $start)
{
	preg_match_all("/./su", $str, $ar);

	if(func_num_args() >= 3) {
		$end = func_get_arg(2);
		return implode('', array_slice($ar[0], $start, $end));
	} else {
		return implode('', array_slice($ar[0], $start));
	}
}

/* vim: set expandtab: */

?>
