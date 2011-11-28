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
// $Id: site_layout.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	fn_trusted_vars("lang_data");

	$suffix = '';
	//
	// Edit language variables
	//
	if ($mode == 'update_variables') {

		if (is_array($_REQUEST['lang_data'])) {
			$error_flag = false;
			foreach ($_REQUEST['lang_data'] as $k => $v) {
				if (!empty($v['name'])) {
					$v['lang_code'] = DESCR_SL;
					db_query("REPLACE INTO ?:language_values ?e", $v);
				}
			}
		}

		$suffix = '.manage';

	} 

	if ($mode == 'update_design_mode') {
		db_query("UPDATE ?:settings SET value = ?s WHERE option_name = ?s AND section_id = ?s", ($action == $_REQUEST['design_mode'] ? 'Y' : 'N'), $_REQUEST['design_mode'], '');
		if (!empty($_REQUEST['disable_mode'])) {
			db_query("UPDATE ?:settings SET value = 'N' WHERE option_name = ?s AND section_id = ?s", $_REQUEST['disable_mode'], '');
		}
		fn_rm(DIR_COMPILED . 'customer', false);
		fn_rm(DIR_COMPILED . 'admin', false);

		$suffix = '.design_mode';
	}

	if ($mode == 'update_logos') {
		$logos = fn_filter_uploaded_data('logotypes');

		$areas = fn_get_manifest_definition();

		// Update customer logotype
		if (!empty($logos)) {
			foreach ($logos as $type => $logo) {
				$area = $areas[$type];
				$manifest = parse_ini_file(DIR_SKINS . Registry::get('settings.skin_name_' . $area['skin']) . '/' . SKIN_MANIFEST, true);

				$filename = DIR_SKINS . Registry::get('settings.skin_name_' . $area['skin']) . '/' . $area['path'] . '/images/' . $logo['name'];

				if (copy($logo['path'], $filename)) {
					list($w, $h, ) = fn_get_image_size($filename);

					$manifest[$area['name']]['filename'] = $logo['name'];
					$manifest[$area['name']]['width'] = $w;
					$manifest[$area['name']]['height'] = $h;

					fn_write_ini_file(DIR_SKINS . Registry::get('settings.skin_name_' . $area['skin']) . '/' . SKIN_MANIFEST, $manifest);
				} else {
					$text = fn_get_lang_var('text_cannot_create_file');
					$text = str_replace('[file]', $filename, $text);
					fn_set_notification('E', fn_get_lang_var('error'), $text);
				}
				@unlink($logo['path']);
			}
		}
		$suffix = '.logos';
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=site_layout" . $suffix);
}

if ($mode == 'manage') {

	Registry::set('navigation.tabs.home', array (
		'title' => fn_get_lang_var('general'),
		'js' => true,
	));

	$site_layout_general = array (
		'page_title_text' => fn_get_lang_var('page_title_text', DESCR_SL),
		'text_welcome' => fn_get_lang_var('text_welcome', DESCR_SL),
		'home_meta_description' => fn_get_lang_var('home_meta_description', DESCR_SL),
		'home_meta_keywords' => fn_get_lang_var('home_meta_keywords', DESCR_SL)
	);

	$view->assign('general_content', $site_layout_general);

} elseif ($mode == 'logos') {

	$view->assign('customer_manifest', parse_ini_file(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/' . SKIN_MANIFEST, true));

} elseif ($mode == 'design_mode') {


}

function fn_get_manifest_definition()
{
	$areas = array(
		'C' => array (
			'skin' => 'customer',
			'path' => 'customer',
			'name' => 'Customer_logo'
		),
		'M' => array (
			'skin' => 'customer',
			'path' => 'mail',
			'name' => 'Mail_logo'
		),
		'A' => array (
			'skin' => 'admin',
			'path' => 'admin',
			'name' => 'Admin_logo'
		),
		'L' => array (
			'skin' => 'admin',
			'path' => 'admin',
			'name' => 'Signin_logo'
		)
	);

	fn_set_hook('get_manifest_definition', $areas);
	
	return $areas;
}
?>
