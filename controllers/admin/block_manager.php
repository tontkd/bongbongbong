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
// $Id: block_manager.php 7813 2009-08-13 09:51:18Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$suffix = '';

	if ($mode == 'add') {
		if (!empty($_REQUEST['block'])) {
			$block = $_REQUEST['block'];
			$block['location'] = $_REQUEST['add_selected_section'];
			$bid = fn_update_block($block, $_REQUEST['add_selected_section']);
			// if the block doesn't require assigning to the one object (product, category etc)
			if (in_array($block['location'], array('all_pages', 'checkout', 'cart', 'index'))) {
				fn_assign_block(array ('block_id' => $bid, 'location' => $block['location'], 'status' => 'A'));
			}
		}

		$suffix = "&selected_section=$_REQUEST[add_selected_section]";
	}

	if ($mode == 'enable_disable' && !empty($_REQUEST['block_id'])) {
		fn_assign_block($_REQUEST);
		exit();
	}

	if ($mode == 'update') {
		fn_update_block($_REQUEST['block'], $_REQUEST['redirect_location']);
		$suffix .= "&selected_section=$_REQUEST[redirect_location]";
	}

	if ($mode == 'add_items') {
		fn_add_items_to_block($_REQUEST['block_id'], !empty($_REQUEST['block_items']) ? $_REQUEST['block_items'] : '', 0, $_REQUEST['block_location'], empty($_REQUEST['is_manage']), !empty($_REQUEST['page']) ? $_REQUEST['page'] : 0);
		$suffix .= "&selected_section=$_REQUEST[redirect_location]";
	}

	if ($mode == 'save_layout') {
		fn_save_block_location($_REQUEST['block_positions'], $_REQUEST['add_selected_section']);
		$suffix .= "&selected_section=$_REQUEST[add_selected_section]";
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=block_manager.manage" . $suffix);
}

$view->assign('block_settings', fn_get_all_blocks());

if ($mode == 'delete') {
	if (!empty($_REQUEST['block_id'])) {
		fn_delete_block($_REQUEST['block_id'], $_REQUEST['selected_section']);
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=block_manager.manage");

} elseif ($mode == 'bulk_actions') {
	fn_block_bulk_actions($_REQUEST['block_id'], ACTION);

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=block_manager.manage");

} elseif ($mode == 'update_status') {
	// Check if global (all_pages) block is disabled for sub-location (products, categories etc.)
	if (!empty($_REQUEST['selected_location']) && $_REQUEST['selected_location'] != 'all_pages' && $_REQUEST['block_location'] == 'all_pages') {
		$disabled_locations = db_get_field("SELECT disabled_locations FROM ?:blocks WHERE block_id = ?i", $_REQUEST['id']);
		if (strpos($disabled_locations, $_REQUEST['selected_location']) === false && $_REQUEST['status'] != 'A') {
			// disable block
			$query = fn_add_to_set('disabled_locations', $_REQUEST['selected_location']);
			$_action = 'disabled';
		} else {
			// enable block
			$query = fn_remove_from_set('disabled_locations', $_REQUEST['selected_location']);
			$_action = 'enabled';
		}

		db_query("UPDATE ?:blocks SET disabled_locations = ?p WHERE block_id = ?i", $query, $_REQUEST['id']);
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var("block_$_action"));
		exit();
	}
}

if ($mode == 'manage') {

	$locations = fn_get_block_locations();

	// [Page sections]
	if (!empty($locations)) {
		foreach ($locations as $location => $_location) {
			Registry::set("navigation.tabs.$location", array (
				'title' => fn_get_lang_var($location),
				'href' => "$index_script?dispatch=block_manager.manage&selected_section=$location"
			));
		}
	}
	// [/Page sections]

	$selected_section = empty($_REQUEST['selected_section']) ? 'all_pages' : $_REQUEST['selected_section'];
	$view->assign('locations', $locations);
	$blocks = fn_get_blocks(array('location' => $selected_section, 'all' => true), DESCR_SL);

	if ($selected_section !== 'all_pages') {
		$blocks = fn_array_merge($blocks, fn_get_blocks(array('location' => 'all_pages', 'all' => true)), true);
	}

	$dir = fn_get_blocks_location_dir($selected_section);
	$positions = array ();

	if (!empty($dir)) {

		$location_templates = fn_get_dir_contents($dir, false, true, '.tpl');

		foreach ($location_templates as $tpl) {
			$positions[str_replace('.tpl', '', $tpl)] = fn_parse_template("$dir/$tpl");
		}

		foreach ($positions as $pos_section => $_pos) {
			foreach ($_pos as $_k => $pos) {
				if (!empty($pos['id']) && !empty($blocks[$pos['id']])) {
					$blocks[$pos['id']]['properties']['positions'] = $pos_section;
					if (!empty($pos['template'])) {
						$blocks[$pos['id']]['properties']['appearances'] = str_replace('"', '', $pos['template']);
					}
					$blocks[$pos['id']]['properties']['wrapper'] = !empty($pos['wrapper']) ? str_replace('"', '', $pos['wrapper']) : '';
				} elseif (!empty($pos['content'])) {
					$positions[$pos_section][$_k]['wrapper']  = !empty($pos['wrapper']) ? str_replace('"', '', $pos['wrapper']) : '';
				}
			}
		}

		$view->assign('positions', $positions);
	} else {
		fn_set_notification('W', fn_get_lang_var('error'), str_replace('[dir]', $selected_section, fn_get_lang_var('bm_dir_not_found')));
	}

	$blocks = fn_check_blocks_availability($blocks, $view->get_var('block_settings'));
	//$view->assign('specific_settings', fn_get_block_specific_settings());
	$view->assign('location', $selected_section);
	$view->assign('blocks', $blocks);

} elseif ($mode == 'manage_items') {
	$view->assign('location', $_REQUEST['location']);
	$view->assign('block', fn_get_block_data($_REQUEST['block_id']));

	$block_items = db_get_field("SELECT item_ids FROM ?:block_links WHERE block_id = ?i", $_REQUEST['block_id']);
	if (!empty($block_items)) {
		$items_ids = explode(',', $block_items);
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$items_per_page = Registry::get('settings.Appearance.admin_elements_per_page');
		fn_paginate($page, count($items_ids), $items_per_page);
		if (!empty($_SESSION['items_per_page'])) {
			$items_per_page = $_SESSION['items_per_page'];
		}
		$start_pos = ($page - 1) * $items_per_page;
		$view->assign('start_position', $start_pos);
		$view->assign('block_items', array_slice($items_ids, $start_pos, $items_per_page));
	}

} elseif ($mode == 'specific_settings') {

	$specific_settings = fn_get_block_specific_settings();

	if (!empty($specific_settings[$_REQUEST['type']]) && !empty($specific_settings[$_REQUEST['type']][$_REQUEST['value']])) {
		$specific_settings = fn_process_specific_settings($specific_settings, $_REQUEST['type'], $_REQUEST['value']);
		$view->assign('spec_settings', $specific_settings[$_REQUEST['type']][$_REQUEST['value']]);
	}

	$view->assign('s_set_id', $_REQUEST['block_id'] . '_' . $_REQUEST['type']);

} elseif ($mode == 'assign_items') {
	$view->assign('location', $_REQUEST['location']);
	$view->assign('block', fn_get_block_data($_REQUEST['block_id']));

} elseif ($mode == 'update') {

	if (!empty($_REQUEST['block_id']) && $_REQUEST['block_id'] == 'central') {
		$block = array(
			'block_id' => 'central',
			'location' => $_REQUEST['location']
		);
		$block_data = fn_block_manager_get_central_block($_REQUEST['location']);
	} else { // central content
		$block = fn_get_block_data($_REQUEST['block_id'], DESCR_SL);
		$block['properties']['positions'] = $_REQUEST['position'];
		$dir = fn_get_blocks_location_dir($_REQUEST['location']);
		$block_data = fn_block_manager_get_block_tpl($_REQUEST['block_id'], $_REQUEST['location']);
	}

	if (!empty($block_data[0])) {
		if (preg_match('/template="(.*?)"/', $block_data[0], $match)) {
			$block['properties']['appearances'] = $match[1];
		}

		if (preg_match('/wrapper="(.*?)"/', $block_data[0], $match)) {
			$block['properties']['wrapper'] = $match[1];
		}
	}

	$view->assign('block', $block);
	$view->assign('location', $_REQUEST['location']);
	$view->assign('specific_settings', fn_process_specific_settings(fn_get_block_specific_settings()));
}

/**
 * This function save selected block or add new
 *
 * @param array $block block data
 * @return int block id or false
 */
function fn_update_block($block, $selected_location = 'all_pages', $child = false)
{
	if (!empty($block['positions'])) {
		$file_name = fn_get_blocks_location_dir($selected_location) . '/' . $block['positions'] . '.tpl';

		// Add new block
		if (empty($block['block_id'])) {
			$block['block_id'] = $_block_id = db_query("INSERT INTO ?:blocks ?e", $block);
			$block_tpl = empty($block['appearances']) ? $block['list_object'] : $block['appearances'];
			if ($block['positions'] != 'product_details') {
				fn_add_block_to_template($block['block_id'], $block_tpl, $file_name);
				if ($block['location'] == 'all_pages') {
					foreach (fn_get_all_blocks_location_dirs() as $location) {
						if (strpos($location, 'all_pages') === false) {
							fn_add_block_to_template($block['block_id'], $block_tpl, $location . '/' . $block['positions'] . '.tpl');
						}
					}
				}
			}
		}
	}

	// Update block appearance (tpl)
	if (!empty($file_name) && $block['positions'] != 'product_details') {
		$content = fn_get_contents($file_name);

		$_id = ($block['block_id'] == 'central') ? "content=true" : "id=[\"]?$block[block_id][\"]?";
		if (preg_match("/\{block ($_id.*?)\}/", $content, $m)) {
			$attrs = fn_parse_block_attrs($m[1]);

			if ($block['block_id'] != 'central') {
				$attrs['template'] = '"' . (empty($block['appearances']) ? $block['list_object'] : $block['appearances']) . '"';
			}

			if (!empty($block['wrapper'])) {
				$attrs['wrapper'] = '"' . $block['wrapper'] . '"';
			} else {
				unset($attrs['wrapper']);
			}

			$new_definition = '{block';
			foreach ($attrs as $a => $v) {
				$new_definition .= " $a=$v";
			}
			$new_definition .= '}';

			$content = str_replace($m[0], $new_definition, $content);

			fn_put_contents($file_name, $content);
		}

		if ($block['location'] == 'all_pages' && $child === false) {
			foreach (fn_get_all_blocks_location_dirs(true) as $sublocation) {
				if ($sublocation != 'all_pages') {
					fn_update_block($block, $sublocation, true);
				}
			}
		}

	}

	if ($block['block_id'] != 'central') {
		$disallow_properties = array (
			'block',
			'block_id',
			'position',
			'location',
			'status',
			'wrapper'
		);
		// Very strange code, I think we don't need it, but just comment out for now
		/*$old_list_object = db_get_field("SELECT value FROM ?:block_properties WHERE block_id = ?i AND property = 'list_object'", $block['block_id']);
		if ($old_list_object != $block['list_object']) {
			db_query("DELETE FROM ?:block_links WHERE block_id = ?i AND object_id = ?i", $block['block_id'], 0);
		}*/

		db_query("DELETE FROM ?:block_properties WHERE block_id = ?i", $block['block_id']);

		foreach ($block as $setting_name => $value) {
			if (!in_array($setting_name, $disallow_properties)) {
				// Check previous settings
				$_data = array (
					'block_id' => $block['block_id'],
					'property' => $setting_name,
					'value' => is_array($value) ? implode(',', $value) : $value,
				);

				db_query("REPLACE INTO ?:block_properties ?e", $_data);
			}
		}

		if (!empty($_block_id)) {
			foreach ((array)Registry::get('languages') as $block['lang_code'] => $v) {
				db_query("INSERT INTO ?:block_descriptions ?e", $block);
			}
		} else {
			db_query('UPDATE ?:blocks SET ?u WHERE block_id = ?i', $block, $block['block_id']);
			db_query("UPDATE ?:block_descriptions SET ?u WHERE block_id = ?i AND lang_code = ?s", $block, $block['block_id'], DESCR_SL);
		}
	}

	return empty($block['block_id']) ? false : $block['block_id'];
}

/**
 * Function delete selected block from database and templates
 *
 * @param int $block_id
 * @return bool true
 */

function fn_delete_block($block_id, $section = '')
{
	// Delete block from file system
	$location = db_get_field("SELECT location FROM ?:blocks WHERE block_id = ?i", $block_id);

	fn_delete_block_from_template($block_id, $location);

	foreach (fn_get_block_locations() as $_location => $value) {
		if ($_location != $section) {
			fn_delete_block_from_template($block_id, $_location);
		}
	}

	db_query("DELETE FROM ?:blocks WHERE block_id = ?i", $block_id);
	db_query("DELETE FROM ?:block_descriptions WHERE block_id = ?i", $block_id);
	db_query("DELETE FROM ?:block_properties WHERE block_id = ?i", $block_id);
	db_query("DELETE FROM ?:block_links WHERE block_id = ?i", $block_id);

	return true;
}

/**
 * Function parse templates and returns params
 *
 * @param string $template_path
 * @param bool $central
 * @return array
 */

function fn_parse_template($template_path, $central = false)
{
	$view = Registry::get('view');

	if (file_exists($template_path)) {
		$template_source = fn_get_contents($template_path);
	}

	$pattern = '!' . preg_quote($view->left_delimiter, '!') . 'block (.*)' . preg_quote($view->right_delimiter, '!') . '!Us';
	$parsed = array();

	if (preg_match_all($pattern, $template_source, $matches)) {
		if (!empty($matches[1])) {
			foreach ($matches[1] as $key => $match) {
				$parsed[$key] = fn_parse_block_attrs($match);
			}
		}
	}

	return $parsed;
}

/**
 * Parse block attributes
 *
 * @param string $block - block definition from template file
 * @return array attributes
 */

function fn_parse_block_attrs($block)
{
	static $compiler;
	if (empty($compiler)) {
		$compiler = new Templater_Compiler();
	}

	return $compiler->_parse_attrs($block);
}

/**
 * This function will save block positions the blocks location, if necessary
 *
 * @param array $positions - The array contains the block positions in the following format: ('left' => array (block ids), 'right' => array (...), 'center' => array (...))
 * @param string $section
 * @return bool true
 */

function fn_save_block_location($positions, $section = 'all_pages')
{
	$dir = fn_get_blocks_location_dir($section);

	$location_templates = fn_get_dir_contents($dir, false, true, '.tpl');
	$block_records = array();
	$block_update = array();

	if ($section == 'products') {
		array_push($location_templates, 'product_details');
	}

	foreach ($positions as $pos_section) {
		$_pos = explode(',', $pos_section);
		if (!empty($_pos)) {
			foreach ($_pos as $block_id) {
				if (!empty($block_id)) {
					if ($block_id != 'central') {
						$block_records[$block_id] = fn_block_manager_get_block_tpl($block_id, $section);
					} else {
						$block_records[$block_id] = fn_block_manager_get_central_block($section);
					}
				}
			}
		}
	}

	foreach ($location_templates as $tpl) {

		$template_path = "$dir/$tpl";

		if (is_file($template_path) || $tpl == 'product_details') {
			if ($tpl == 'product_details') {
				$block_position = 'product_details';
			} else {
				$current_content = fn_get_contents($template_path);
				$parsed = fn_parse_template($template_path);
				$block_position = str_replace('.tpl', '', $tpl);
			}
			$current_positions = $location_actions = array();

			$new_positions = empty($positions[$block_position]) ? array() : explode(',', trim($positions[$block_position]));

			foreach ($parsed as $template) {
				$current_positions[] = empty($template['id']) ? 'central' : $template['id'];
			}

			// If block section is empty
			if (empty($parsed) && empty($positions[$block_position])) {
				continue;
			}

			// There is a simple replace of the blocks in the location
			foreach ($current_positions as $k => $block_id) {
				if (!empty($new_positions[$k])) {
					$same_block = $new_positions[$k];

					if ($same_block != $block_id) {
						$location_actions[] = array (
							'action' => 'replace',
							'replacements' => array (
								$block_id, $same_block
							),
							'to_block_tpl' => $block_records[$same_block][0]
						);
					}

					if ($same_block != 'central' && $block_position != $block_records[$same_block][1]) {
						$block_update[] = array (
							'block_id' => $same_block,
							'block_tpl' => $block_records[$same_block],
							'new_position' => $block_position
						);
					}
				}
			}

			// Check if the new blocks were added to the location
			$new_blocks_count = count($new_positions);
			$current_blocks_count = count($current_positions);

			if ($new_blocks_count > $current_blocks_count) {
				foreach (array_slice($new_positions, $current_blocks_count) as $block_id) {
					if ($block_position != 'product_details') {
						$location_actions[] = array (
							'action' => 'add',
							'add' => $block_id,
							'add_tpl' => $block_records[$block_id][0]
						);
					}

					if ($block_id != 'central' && $block_position != $block_records[$block_id][1]) {
						$block_update[] = array (
							'block_id' => $block_id,
							'block_tpl' => $block_records[$block_id],
							'new_position' => $block_position
						);
					}
				}

			} elseif ($new_blocks_count < $current_blocks_count) {
				foreach (array_diff($current_positions, $new_positions) as $block_id) {
					if ($block_position != 'product_details') {
						$location_actions[] = array (
							'action' => 'delete',
							'delete' => $block_id
						);
					}
				}
			}

			if (!empty($location_actions)) {

				fn_apply_location_actions($location_actions, $current_content, $block_records, $template_path, $section);

				// We need to make changes in the other locations (products, categories, news...)
				if ($section == 'all_pages') {
					foreach (fn_get_block_locations() as $location => $_loc) {
						if ($location != 'all_pages') {
							$__tpl = basename($template_path);
							$__dir = fn_get_blocks_location_dir($location);
							$tpl_content = fn_get_contents($__dir . '/' . $__tpl);

							fn_apply_location_actions($location_actions, $tpl_content, $block_records, $__dir . '/' . $__tpl, $location);
						}
					}
				}
			}

		} else {
			fn_set_notification('W', fn_get_lang_var('warning'), str_replace('[file]', $template_path, fn_get_lang_var('bm_file_not_found')));
		}
	}

	if (!empty($block_update)) {
		foreach ($block_update as $block) {
			fn_check_block_properties($block);
		}
	}

	return true;
}

function fn_apply_location_actions($actions, $tpl_content, $block_records, $tpl_path, $section)
{
	$edited_items = array ();

	// It is basic routine, we need to analyze $actions (in which there are actions for edit block location) and made the corresponding changes
	foreach ($actions as $rules) {
		if ($rules['action'] == 'replace') {
			if ($rules['replacements'][0] != 'central') {
				preg_match_all("/\{block id={$rules['replacements'][0]} .*?\}/i", $tpl_content, $matches);
				if (isset($matches[0][0])) {
					$tpl_content = str_replace($matches[0][0], str_replace('}', " processed", $rules['to_block_tpl']), $tpl_content);
				}
			} else {
				preg_match_all("/\{block content=true .*?\}/i", $tpl_content, $matches);
				if (isset($matches[0][0])) {
					$tpl_content = str_replace($matches[0][0], str_replace('}', " processed", $rules['to_block_tpl']), $tpl_content);
				}
			}
			$edited_items[] = $rules['to_block_tpl'];
		} elseif ($rules['action'] == 'delete') {
			if (!isset($block_records[$rules['delete']])) { // deleting block with non-existent ID
				$br = fn_block_manager_get_block_tpl($rules['delete'], $section);
				$delete_block_tpl = $br[0];
			} else {
				$delete_block_tpl = $block_records[$rules['delete']][0];
			}
			$tpl_content = str_replace(array("$delete_block_tpl\n", "\n$delete_block_tpl", $delete_block_tpl), '', $tpl_content);
		} elseif ($rules['action'] == 'add') {
			$tpl_content .= ("\n" . str_replace('}', " processed", $rules['add_tpl']));
			$edited_items[] = $rules['add_tpl'];
		}
	}

	// The deletion of all duplicate blocks
	preg_match_all("/\{block (.*?)\}/U", $tpl_content, $matches);

	if (!empty($matches[0])) {
		foreach ($matches[0] as $block_string) {
			if (in_array($block_string, $edited_items)) {
				$tpl_content = str_replace($block_string, '', $tpl_content);
			}
		}
	}

	$tpl_content = str_replace(' processed', '}', $tpl_content);
	return file_put_contents($tpl_path, $tpl_content);
}

function fn_block_manager_get_block_tpl($block_id, $section)
{
	$dir = fn_get_blocks_location_dir($section);

	$location_templates = fn_get_dir_contents($dir, false, true, '.tpl');

	foreach ($location_templates as $tpl) {
		preg_match_all("/\{block id=$block_id (.*[^\}])\}/U", fn_get_contents($dir . '/' . $tpl), $matches);

		if (!empty($matches[0][0])) {
			return array (
				$matches[0][0],
				str_replace('.tpl', '', $tpl)
			);
		}
	}
	if (is_numeric($block_id)) {
		$block_data = fn_get_block_data($block_id);
		if (!empty($block_data)) {
			return array (
				'{block id=' . $block_id . ' template="' . (isset($block_data['properties']['appearances']) ? $block_data['properties']['appearances'] : $block_data['properties']['list_object']) . '"' . (!empty($block_data['properties']['wrapper']) ?  (' wrapper="' . $block_data['properties']['wrapper'] . '"') : '') . '}',
				$block_data['properties']['positions']
			);
		}
	}

	return true;
}

function fn_block_manager_get_central_block($section)
{
	$dir = fn_get_blocks_location_dir($section);

	$location_templates = fn_get_dir_contents($dir, false, true, '.tpl');

	foreach ($location_templates as $tpl) {
		preg_match_all("/\{block content=true(.*[^\}])\}/U", fn_get_contents($dir . '/' . $tpl), $matches);

		if (!empty($matches[0][0])) {
			return array (
				$matches[0][0],
				str_replace('.tpl', '', $tpl)
			);
		}
	}

	return true;
}

function fn_check_block_properties($params)
{
	$current_properties = db_get_hash_single_array("SELECT property, value FROM ?:block_properties WHERE block_id = ?i", array ('property', 'value'), $params['block_id']);

	$block_data = array_merge(fn_get_block_data($params['block_id'], DESCR_SL, true), $current_properties);
	$block_data['positions'] = $params['new_position'];

	if (preg_match('/wrapper="(.*?)"/', $params['block_tpl'][0], $match)) {
		$block_data['wrapper'] = isset($match[1]) ? $match[1] : null;
	}

	if (strpos($current_properties['list_object'], '.tpl') === false) {
		if (!isset($block_data['appearances'])) {
			preg_match('/template="([^"]*)"/U', $params['block_tpl'][0], $match);
			$appearance = isset($match[1]) ? $match[1] : null;
			if ($appearance) {
				$block_data['appearances'] = $appearance;
			}
		}
	}

	return fn_update_block($block_data);
}

function fn_add_block_to_template($block_id, $block_tpl, $tpl_source)
{
	$view = Registry::get('view');
	$content = trim(fn_get_contents($tpl_source));

	$new_line = $view->left_delimiter . 'block id=' . $block_id . ' template="' . $block_tpl . '"' . $view->right_delimiter . "\n";
	$content = $new_line . $content;

	return file_put_contents($tpl_source, $content);
}

function fn_delete_block_from_template($block_id, $location)
{
	$dir = fn_get_blocks_location_dir($location);

	$tpl_s = fn_get_dir_contents($dir, false, true, '.tpl');

	foreach ($tpl_s as $tpl) {
		$file_name = fn_get_blocks_location_dir($location) . '/' . $tpl;
		$pattern = '/\{block id=' . $block_id . " ([^\}]*)" . "\}([\n?]|[\n]?)/U";
		$content = fn_get_contents($file_name);
		file_put_contents($file_name, preg_replace($pattern, '', $content));
	}

	if ($location == 'all_pages') {
		foreach (fn_get_all_blocks_location_dirs() as $location) {
			if (strpos($location, 'all_pages') === false) {
				fn_delete_block_from_template($block_id, basename($location));
			}
		}
	}
}

function fn_block_bulk_actions($block_id, $action)
{
	$schema = fn_get_schema('block_manager', 'structure');

	$block_data = fn_get_block_data($block_id);
	$o_id = $schema[$block_data['location']]['object_id'];

	if ($action == 'assign_to_all') {
		$exclude = db_get_fields("SELECT object_id FROM ?:block_links WHERE block_id = ?i AND location = ?s", $block_id, $block_data['location']);
		$where = empty($exclude) ? '' : db_quote("WHERE $o_id NOT IN(?n)", $exclude);
		$item_ids = db_query("REPLACE INTO ?:block_links (block_id, location, object_id, enable) SELECT ?i as block_id, ?s as location, $o_id as object_id, 'Y' as enable FROM ?:{$block_data['location']} ?p", $block_id, $block_data['location'], $where);

	} elseif ($action == 'remove_from_all') {
		db_query("DELETE FROM ?:block_links WHERE block_id = ?i AND location = ?s", $block_id, $block_data['location']);

	}

	return true;
}

/**
 * The function returns the selected block data used in the admin area
 *
 * @param int $block_id
 * @param string $lang_code
 * @param bool $descr if true, the function only returns the description of the block
 * @return array
 */
function fn_get_block_data($block_id, $lang_code = CART_LANGUAGE, $descr = false)
{
	$block = db_get_row('SELECT ?:blocks.*, ?:block_descriptions.block FROM ?:blocks LEFT JOIN ?:block_descriptions ON ?:block_descriptions.block_id = ?:blocks.block_id AND lang_code = ?s WHERE ?:blocks.block_id = ?i', $lang_code, $block_id);

	if (empty($block)) {
		return false;
	}

	if ($descr == true) {
		return $block;
	}

	if (!empty($block['item_ids'])) {
		$block['items'] = explode(',', $block['item_ids']);
	}

	$block['properties'] = db_get_hash_single_array('SELECT property, value FROM ?:block_properties WHERE block_id = ?i', array('property', 'value'), $block_id);

	return $block;
}

/**
 * Function returns direct paths to all the folders which contain blocks location
 *
 * @return array $dirs
 */
function fn_get_all_blocks_location_dirs($relative = false)
{
	$base_dir = DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/blocks/locations/';

	$dirs = fn_get_dir_contents($base_dir);

	foreach ($dirs as &$dir) {
		$dir = ($relative === true) ? $dir : $base_dir . $dir;
	}

	// addon dirs
	foreach (fn_get_active_addons_skin_dir() as $addon_dir) {
		if (is_dir($addon_dir . '/blocks/locations')) {
			$addon_dirs = fn_get_dir_contents($addon_dir . '/blocks/locations');
			if (!empty($addon_dirs)) {
				foreach ($addon_dirs as $_dir) {
					$dirs[] = ($relative === true) ? $_dir : $addon_dir . '/blocks/locations/' . $_dir;
				}
			}
		}
	}

	return $dirs;
}

/**
 * Get all block settings
 *
 * @return array block settings
 */
function fn_get_all_blocks($type = '')
{
	// Get core blocks
	$base_dir = DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/';
	$blocks = fn_get_dir_contents($base_dir . 'blocks', false, true, '.tpl', 'blocks/');
	$wrappers = fn_get_dir_contents($base_dir . 'blocks/wrappers', false, true, '.tpl', 'blocks/wrappers/');

	// Now get blocks from addons
	foreach (Registry::get('addons') as $addon => $v) {
		if ($v['status'] == 'A') {
			$_blocks = fn_get_dir_contents($base_dir . 'addons/' . $addon . '/blocks', false, true, '.tpl', 'addons/' . $addon . '/blocks/');
			if (!empty($_blocks)) {
				$blocks = fn_array_merge($blocks, $_blocks, false);
			}
			$_wrappers = fn_get_dir_contents($base_dir . 'addons/' . $addon . '/blocks/wrappers', false, true, '.tpl', 'addons/' . $addon . '/blocks/wrappers/');
			if (!empty($_wrappers)) {
				$wrappers = fn_array_merge($wrappers, $_wrappers, false);
			}
		}
	}

	// Convert array with blocks to key=>value form
	$blocks = fn_array_combine($blocks, true);

	// Get block options
	$_structure = fn_get_block_properties();
	foreach ($_structure as $object => $data) {
		if (!empty($data['appearances'])) {
			foreach ($data['appearances'] as $tpl => $_data) {
				if (!empty($blocks[$tpl])) {
					unset($blocks[$tpl]);
				}
			}
		}
	}

	$_blocks = array();
	foreach ($blocks as $k => $v) {
		$_blocks[] = array (
			'name' => fn_get_block_template_description($k),
			'template' => $k
		);
	}

	return array(
		'dynamic' => $_structure,
		'static' => $_blocks,
		'wrappers' => $wrappers
	);
}

function fn_check_blocks_availability($blocks, $block_settings)
{
	$block_settings = $block_settings['dynamic'];
	$disabled_blocks = array();

	foreach ($blocks as $k => $v) {
		// First, check addon blocks and remove if addon is disabled
		if (strpos($v['properties']['list_object'], 'addons/') !== false) {
			$a = explode('/', $v['properties']['list_object']);
			if (fn_load_addon($a[1]) == false) {
				$blocks[$k]['disabled'] = true;
				if ($v['status'] != 'D') {
					$disabled_blocks[] = $k;
				}
				continue;
			}
		}

		// Now, check schema
		if (strpos($v['properties']['list_object'], '.tpl') === false) {
			if (!isset($block_settings[$v['properties']['list_object']])) {
				$blocks[$k]['disabled'] = true;
				if ($v['status'] != 'D') {
					$disabled_blocks[] = $k;
				}
				continue;
			}

			foreach (array('fillings', 'positions', 'appearances') as $section_name) {
				if (!empty($v['properties'][$section_name])) {
					if (!isset($block_settings[$v['properties']['list_object']][$section_name]) || !isset($block_settings[$v['properties']['list_object']][$section_name][$v['properties'][$section_name]])) {
						$blocks[$k]['disabled'] = true;
						if ($v['status'] != 'D') {
							$disabled_blocks[] = $k;
						}
						break;
					}
				}
			}
		}
	}


	if (!empty($disabled_blocks)) {
		db_query("UPDATE ?:blocks SET status = 'D' WHERE block_id IN (?n)", $disabled_blocks);
	}

	return $blocks;
}

function fn_process_specific_settings($settings, $section = '', $object = '')
{
	foreach ($settings as $_section => $_objects) {
		if (!empty($section) && $_section == $section || empty($section)) {
			foreach ($_objects as $_object => $_options) {
				if (!empty($object) && $_object == $object || empty($object)) {
					foreach ($_options as $k => $v) {
						if (!empty($v['data_function'])) {
							$df = $v['data_function'];
							$f = array_shift($df);
							$settings[$_section][$_object][$k]['values'] = call_user_func_array($f, $df);
						}
					}
				}
			}
		}
	}
	
	return $settings;
}

?>
