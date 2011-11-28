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
// $Id: skin_selector.php 7625 2009-06-26 10:35:21Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update') {

		if (is_array($_REQUEST['skin_data'])) {
			foreach ($_REQUEST['skin_data'] as $zone => $skin) {
				$error = false;
				
				if (!is_dir(DIR_SKINS . $skin) && is_dir(DIR_ROOT . '/var/skins_repository/' . $skin)) {
					if (file_exists(DIR_ROOT . '/var/skins_repository/' . $skin . '/' . SKIN_MANIFEST)) {
						fn_start_scroller();
						if (fn_copy(DIR_ROOT . '/var/skins_repository/base', DIR_SKINS . $skin, false)) {
							fn_copy(DIR_ROOT . '/var/skins_repository/' . $skin, DIR_SKINS . $skin, false);

							$manifest = parse_ini_file(DIR_ROOT . '/var/skins_repository/' . $skin . '/' . SKIN_MANIFEST);
							if (empty($manifest['admin'])) {
								fn_rm(DIR_SKINS . $skin . '/admin');
							}

						} else {
							$msg = fn_get_lang_var('text_cannot_create_directory');
							$msg = str_replace('[directory]', DIR_SKINS . $skin, $msg);
							fn_set_notification('E', fn_get_lang_var('error'), $msg);
							$error = true;

						}
						fn_stop_scroller();
					} else {
						fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_skin_manifest_missed'));
						$error = true;
					}
				}
				
				if ($error == false) {
					if ($zone == 'customer') {
						// Copy block locations for customer skin from the current skin
						fn_copy(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/blocks/locations', DIR_SKINS . $skin . '/customer/blocks/locations', false);

						// copy from addons
						foreach (Registry::get('addons') as $addon => $_v) {
							if (is_dir(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/addons/' . $addon . '/blocks/locations')) {
								fn_copy(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/addons/' . $addon . '/blocks/locations', DIR_SKINS . $skin . '/customer/addons/' . $addon . '/blocks/locations', false);
							}
						}
					}

					fn_rm(DIR_COMPILED);
					db_query("UPDATE ?:settings SET ?u WHERE option_name = ?s", array('value' => $skin), "skin_name_$zone");
				}
			}
		}
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=skin_selector.manage");
}

if ($mode == 'manage') {
	$view->assign('available_skins', fn_get_available_skins());

	$view->assign('customer_path', 'skins/'.Registry::get('settings.skin_name_customer').'/customer');
	$view->assign('admin_path', 'skins/'.Registry::get('settings.skin_name_admin').'/admin');
}
?>
