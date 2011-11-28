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
// $Id: addons.php 7822 2009-08-14 06:57:34Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

$option_types = array (
	'input' => 'I',
	'textarea' => 'T',
	'radiogroup' => 'R',
	'selectbox' => 'S',
	'password' => 'P',
	'checkbox' => 'C',
	'multiple select' => 'M',
	'multiple checkboxes' => 'N',
	'countries list' => 'X',
	'states list' => 'W',
	'file' => 'F',
	'info' => 'O',
	'header' => 'H',
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update') {
		fn_update_addon($_REQUEST['addon'], $_REQUEST['addon_data']);
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=addons.manage");
}

if ($mode == 'update') {
	fn_get_schema('settings', 'variants', 'php', false, true);

	$addon_options = db_get_field("SELECT options FROM ?:addons WHERE addon = ?s", $_REQUEST['addon']);
	$addon_options = fn_parse_addon_options($addon_options);

	$xml = simplexml_load_file(DIR_ADDONS . $_REQUEST['addon'] . '/addon.xml');

	$descriptions = db_get_array("SELECT object_type, object_id, description, addon FROM ?:addon_descriptions WHERE addon = ?s AND object_id != '' AND lang_code = ?s", $_REQUEST['addon'], CART_LANGUAGE);

	fn_update_lang_objects('addon_fields', $descriptions);
	$field_descriptions = array();
	foreach ($descriptions as $field) {
		$field_descriptions[$field['object_type']][$field['object_id']] = $field['description'];
	}

	// Generate options list
	$fields = array();
	if (isset($xml->opt_settings)) {
		foreach ($xml->opt_settings->item as $item) {
			$fields[(string)$item['id']] = array(
				'type' => $option_types[(string)$item->type],
				'description' => isset($field_descriptions['O'][(string)$item['id']]) ? $field_descriptions['O'][(string)$item['id']] : '',
			);

			if (isset($item->variants)) {
				$fields[(string)$item['id']]['variants'] = array();
				foreach ($item->variants->item as $vitem) {
					$fields[(string)$item['id']]['variants'][(string)$vitem['id']] = isset($field_descriptions['V'][(string)$vitem['id']]) ? $field_descriptions['V'][(string)$vitem['id']] : '';
				}
			}

			// Check if option has variants function
			$func = 'fn_settings_variants_addons_' . $_REQUEST['addon'] . '_' . (string)$item['id'];
			if (function_exists($func)) {
				$fields[(string)$item['id']]['variants'] = $func();
			}

			if (isset($item->handler)) {
				$args = explode(',', (string)$item->handler);
				$func = array_shift($args);
				if (function_exists($func)) {
					$fields[(string)$item['id']]['info'] = call_user_func_array($func, $args);
				} else {
					$fields[(string)$item['id']]['info'] = "Something goes wrong";
				}
			}
		}
	}

	$view->assign('fields', $fields);
	$view->assign('addon_options', $addon_options);

} elseif ($mode == 'install') {

	$xml = simplexml_load_file(DIR_ADDONS . $_REQUEST['addon'] . '/addon.xml');

	$_data = array (
		'addon' => (string)$xml->id,
		'priority' => isset($xml->priority) ? (string)$xml->priority : 0,
		'dependencies' => isset($xml->dependencies) ? (string)$xml->dependencies : '',
		'status' => ((string)$xml->status == 'active') ? 'A' : 'D',
	);

	if (isset($xml->opt_settings)) {
		$options = array();
		foreach ($xml->opt_settings->item as $item) {
			if (!empty($item->name)) { // options
				if ((string)$item->type != 'header') {
					$options[(string)$item['id']] = (string)$item->default_value;
				}

				$descriptions = array(
					'addon' => (string)$xml->id,
					'object_id' => (string)$item['id'],
					'object_type' => 'O', //option
				);

				foreach ((array)Registry::get('languages') as $descriptions['lang_code'] => $_v) {
					$descriptions['description'] = (string)$item->name;
					if (isset($item->translations)) {
						foreach ($item->translations->item as $_item) {
							if ((string)$_item['lang'] == $descriptions['lang_code']) {
								$descriptions['description'] = (string)$_item;
							}
						}
					}
					db_query("REPLACE INTO ?:addon_descriptions ?e", $descriptions);
				}

				if (isset($item->variants)) {
					foreach ($item->variants->item as $vitem) {
						$descriptions = array(
							'addon' => (string)$xml->id,
							'object_id' => (string)$vitem['id'],
							'object_type' => 'V', //variant
						);

						foreach ((array)Registry::get('languages') as $descriptions['lang_code'] => $_v) {
							$descriptions['description'] = (string)$vitem->name;
							if (isset($vitem->translations)) {
								foreach ($vitem->translations->item as $_vitem) {
									if ((string)$_vitem['lang'] == $descriptions['lang_code']) {
										$descriptions['description'] = (string)$_vitem;
									}
								}
							}
							db_query("REPLACE INTO ?:addon_descriptions ?e", $descriptions);
						}
					}
				}
			}
		}

		$_data['options'] = serialize($options);
	}

	db_query("REPLACE INTO ?:addons ?e", $_data);
	$descriptions = array(
		'addon' => (string)$xml->id,
		'object_id' => '',
		'object_type' => 'A', //addon
		'description' => (string)$xml->name,
	);

	foreach ((array)Registry::get('languages') as $descriptions['lang_code'] => $_v) {
		$descriptions['description'] = (string)$xml->name;
		if (isset($xml->translations)) {
			foreach ($xml->translations->item as $item) {
				if ((string)$item['for'] == 'name' && (string)$item['lang'] == $descriptions['lang_code']) {
					$descriptions['description'] = (string)$item;
				}
			}
		}
		db_query("REPLACE INTO ?:addon_descriptions ?e", $descriptions);
	}

	if (isset($xml->description)) {
		$descriptions = array(
			'addon' => (string)$xml->id,
			'object_id' => '',
			'object_type' => 'D', //description
		);
		foreach ((array)Registry::get('languages') as $descriptions['lang_code'] => $_v) {
			$descriptions['description'] = (string)$xml->description;
			if (isset($xml->translations)) {
				foreach ($xml->translations->item as $item) {
					if ((string)$item['for'] == 'description' && (string)$item['lang'] == $descriptions['lang_code']) {
						$descriptions['description'] = (string)$item;
					}
				}
			}
			db_query("REPLACE INTO ?:addon_descriptions ?e", $descriptions);
		}
	}

	// Install templates
	$areas = array('customer', 'admin', 'mail');
	$addon = (string)$xml->id;
	foreach ($areas as $area) {
		if (is_dir(DIR_SKINS_REPOSITORY . 'base/' . $area . '/addons/' . $addon)) {
			$skin_name = Registry::get('settings.skin_name_' . ($area == 'mail' ? 'customer' : $area));
			fn_copy(DIR_SKINS_REPOSITORY . 'base/' . $area . '/addons/' . $addon, DIR_SKINS . $skin_name . '/' . $area . '/addons/' . $addon);
		}
	}

	// Execute optional queries
	if (isset($xml->opt_queries)) {
		foreach ($xml->opt_queries->item as $v) {
			if (!isset($v['for']) || (string)$v['for'] == 'install') {
				db_query((string)$v);
			}
		}
	}

	// Add optional language variables
	if (isset($xml->opt_language_variables)) {
		$cache = array();
		foreach ($xml->opt_language_variables->item as $v) {
			$descriptions = array(
				'lang_code' => (string)$v['lang'],
				'name' => (string)$v['id'],
				'value' => (string)$v,
			);

			$cache[$descriptions['name']][$descriptions['lang_code']] = $descriptions['value'];

			db_query("REPLACE INTO ?:language_values ?e", $descriptions);
		}

		// Add variables for missed languages
		$_all_languages = Registry::get('languages');
		$_all_languages = array_keys($_all_languages);
		foreach ($cache as $n => $lcs) {
			$_lcs = array_keys($lcs);

			$missed_languages = array_diff($_all_languages, $_lcs);
			if (!empty($missed_languages)) {
				$descriptions = array(
					'name' => $n,
					'value' => $lcs['EN'],
				);

				foreach ($missed_languages as $descriptions['lang_code']) {
					db_query("REPLACE INTO ?:language_values ?e", $descriptions);
				}
			}
		}
	}

	$msg = fn_get_lang_var('text_addon_installed');
	fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[addon]', (string)$xml->name, $msg));

	// Clean cache
	fn_rm(DIR_COMPILED, false);
	fn_rm(DIR_CACHE, false);

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=addons.manage");

} elseif ($mode == 'uninstall') {

	$addon_name = db_get_field("SELECT description FROM ?:addon_descriptions WHERE addon = ?s AND object_type = 'A' and lang_code = ?s", $_REQUEST['addon'], CART_LANGUAGE);

	// Delete options
	db_query("DELETE FROM ?:addons WHERE addon = ?s", $_REQUEST['addon']);
	db_query("DELETE FROM ?:addon_descriptions WHERE addon = ?s", $_REQUEST['addon']);

	$xml = simplexml_load_file(DIR_ADDONS . $_REQUEST['addon'] . '/addon.xml');

	// Delete language variables
	if (isset($xml->opt_language_variables)) {
		foreach ($xml->opt_language_variables->item as $v) {
			db_query("DELETE FROM ?:language_values WHERE name = ?s", (string)$v['id']);
		}
	}

	// Revert database structure
	if (isset($xml->opt_queries)) {
		foreach ($xml->opt_queries->item as $v) {
			if (isset($v['for']) && (string)$v['for'] == 'uninstall') {
				db_query((string)$v);
			}
		}
	}

	// Delete templates
	$addon = basename($_REQUEST['addon']);
	$areas = array('customer', 'admin', 'mail');
	foreach ($areas as $area) {
		$skin_name = Registry::get('settings.skin_name_' . ($area == 'mail' ? 'customer' : $area));
		if (is_dir(DIR_SKINS . $skin_name . '/' . $area . '/addons/' . $addon)) {
			if (!defined('DEVELOPMENT')) {
				fn_rm(DIR_SKINS . $skin_name . '/' . $area . '/addons/' . $addon);
			}
		}
	}

	$msg = fn_get_lang_var('text_addon_uninstalled');
	fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[addon]', $addon_name, $msg));

	// Clean cache
	fn_rm(DIR_COMPILED, false);
	fn_rm(DIR_CACHE, false);

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=addons.manage");


} elseif ($mode == 'update_status') {
	fn_get_schema('settings', 'actions', 'php', false, true);

	$old_status = db_get_field("SELECT status FROM ?:addons WHERE addon = ?s", $_REQUEST['id']);
	$new_status = $_REQUEST['status'];
	if ($old_status != $new_status) {
		$func = 'fn_settings_actions_addons_' . $_REQUEST['id'];
		if (function_exists($func)) {
			$func($new_status, $old_status);
		}

		if ($old_status != $new_status) {
			db_query("UPDATE ?:addons SET status = ?s WHERE addon = ?s", $_REQUEST['status'], $_REQUEST['id']);
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
		} else {
			$ajax->assign('return_status', $old_status);	
		}
	}

	exit;

} elseif ($mode == 'manage') {

	$all_addons = fn_get_dir_contents(DIR_ADDONS, true, false);

	$installed_addons = db_get_hash_array("SELECT a.addon, a.status, d.description as name, b.description, LENGTH(a.options) as has_options, d.object_id, d.object_type FROM ?:addons as a LEFT JOIN ?:addon_descriptions as d ON d.addon = a.addon AND d.object_id = '' AND d.object_type = 'A' AND d.lang_code = ?s LEFT JOIN ?:addon_descriptions as b ON b.addon = a.addon AND b.object_id = '' AND b.object_type = 'D' AND b.lang_code = ?s ORDER BY d.description ASC", 'addon', CART_LANGUAGE, CART_LANGUAGE);
	fn_update_lang_objects('installed_addons', $installed_addons);
	$addons_list = array();

	foreach ($all_addons as $addon) {
		if (!empty($installed_addons[$addon])) {
			$addons_list[$addon] = $installed_addons[$addon];
		} else {
			if (file_exists(DIR_ADDONS . $addon . '/addon.xml')) {
				$xml = simplexml_load_file(DIR_ADDONS . $addon . '/addon.xml');

				$addons_list[$addon] = array (
					'status' => 'N', // not installed
					'name' => (string)$xml->name,
				);
			}
		}
	}

	$view->assign('addons_list', fn_sort_array_by_key($addons_list, 'name', SORT_ASC));
}

/**
 * Update addon options
 *
 * @param string $addon addon to update options for
 * @param string $addon_data options data
 * @return bool always true
 */
function fn_update_addon($addon, $addon_data)
{
	fn_get_schema('settings', 'actions', 'php', false, true);

	// Get old options
	$old_options = db_get_field("SELECT options FROM ?:addons WHERE addon = ?s", $addon);
	$old_options = fn_parse_addon_options($old_options);

	foreach ($old_options as $k => $v) {
		if ((isset($addon_data['options'][$k]) && $addon_data['options'][$k] != $v) || !isset($addon_data['options'][$k])) {
			$func = 'fn_settings_actions_addons_' . $addon . '_' . $k;
			if (function_exists($func)) {
				$func($addon_data['options'][$k], $v);
			}
		}
	}

	if (!empty($addon_data['options'])) {
		foreach ($addon_data['options'] as $k => $v) {
			if (is_array($v)) {
				$addon_data['options'][$k] = '#M#' . implode('=Y&', $v) . '=Y';
			}
		}
		$addon_data['options'] = serialize($addon_data['options']);
	} else {
		$addon_data['options'] = '';
	}

	db_query("UPDATE ?:addons SET ?u WHERE addon = ?s", $addon_data, $addon);

	return true;
}

?>
