<?php
/*
=====================================================
 Cs-Cart 2.0.7 Nulled By KenDesign
-----------------------------------------------------
 www.freeshareall.com - www.freeshareall.net
-----------------------------------------------------
 KenDesign Team
=====================================================
*/


//
// $Id: image.php 7706 2009-07-13 13:44:54Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

//
// Delete image
//
if ($mode == 'delete_image') {
	if (AREA == 'A' && !empty($auth['user_id'])) {
		fn_delete_image($_REQUEST['image_id'], $_REQUEST['pair_id'], $_REQUEST['object_type']);
		if (defined('AJAX_REQUEST')) {
			$ajax->assign('deleted', true);
		}
	}
	exit;

//
// Delete image pair
//
} elseif ($mode == 'delete_image_pair') {
	if (AREA == 'A' && !empty($auth['user_id'])) {
		fn_delete_image_pair($_REQUEST['pair_id'], $_REQUEST['object_type']);
		if (defined('AJAX_REQUEST')) {
			$ajax->assign('deleted', true);
		}
	}
	exit;

//
// Resize image
//
} elseif ($mode == 'resize') {
	$w = !empty($_REQUEST['width']) ? $_REQUEST['width'] : 0;
	$h = !empty($_REQUEST['height']) ? $_REQUEST['height'] : 0;

	$image_path = (strpos($_REQUEST['image_path'], '://') !== false) ? str_replace(Registry::get('config.current_location'), '', $_REQUEST['image_path']) : $_REQUEST['image_path'];

	$ajax->assign('img_src', fn_generate_thumbnail($image_path, $w, $h, !empty($_REQUEST['make_box'])));
	exit;

} elseif ($mode == 'captcha') {
	require(DIR_LIB . 'captcha/captcha.php');

	$verification_id = $_REQUEST['verification_id'];
	if (empty($verification_id)) {
		$verification_id = 'common';
	}

	$verification_settings = fn_get_settings('Image_verification');
	$fonts = array(DIR_LIB . 'captcha/verdana.ttf');

	$c = new PhpCaptcha($verification_id, $fonts, $verification_settings['width'], $verification_settings['height']);

	// Set string length
	$c->SetNumChars($verification_settings['string_length']);

	// Set number of distortion lines
	$c->SetNumLines($verification_settings['lines_number']);

	// Set minimal font size 
	$c->SetMinFontSize($verification_settings['min_font_size']);

	// Set maximal font size 
	$c->SetMaxFontSize($verification_settings['max_font_size']);

	$c->SetGridColour($verification_settings['grid_color']);

	if ($verification_settings['char_shadow'] == 'Y') {
		$c->DisplayShadow(true);
	}

	if ($verification_settings['colour'] == 'Y') {
		$c->UseColour(true);
	}

	if ($verification_settings['string_type'] == 'digits') {
		$c->SetCharSet(array(2,3,4,5,6,8,9));
	} elseif ($verification_settings['string_type'] == 'letters') {
		$c->SetCharSet(range('A','F'));
	} else {
		$c->SetCharSet(fn_array_merge(range('A','F'), array(2,3,4,5,6,8,9), false));
	}

	if (!empty($verification_settings['background_image'])) {
		$c->SetBackgroundImages(DIR_ROOT . '/' . $verification_settings['background_image']);
	}

	$c->Create();
	exit;
}

?>