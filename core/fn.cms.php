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
// $Id: fn.cms.php 7660 2009-07-03 07:30:06Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

// basic cms page types
define('PAGE_TYPE_LINK', 'L');
define('PAGE_TYPE_TEXT', 'T');


//
// Search pages by set of params
// Returns array(array of pages, params)
//
function fn_get_pages($params = array(), $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
	// Init filter
	$params = fn_init_view('pages', $params);

	$default_params = array(
		'page_id' => 0,
		'page' => 1,
		'visible' => false,
		'simple' => true,
		'get_tree' => '',
		'items_per_page' => 0,
		'pdescr' => '',
		'subpages' => ''
	);

	$params = array_merge($default_params, $params);

	if (empty($params['pname']) && empty($params['pdescr']) && empty($params['subpages'])) {
		$params['pname'] = 'Y';
	}

	$fields = array (
		'?:pages.*',
		'?:page_descriptions.*'
	);

	// Define sort fields
    $sortings = array (
    	'position' => '?:pages.position',
        'name' => '?:page_descriptions.page',
        'timestamp' => '?:pages.timestamp',
        'type' => '?:pages.page_type',
		'multi_level' => array(
			'?:pages.parent_id',
			'?:pages.position',
			'?:page_descriptions.page',
		),
    );

    $directions = array (
        'asc' => 'asc',
        'desc' => 'desc'
    );

	$auth = & $_SESSION['auth'];

	$condition = '1';
	$join = $limit = $group_by = '';

	if (!empty($params['q'])) {

		if ($params['match'] == 'all') {
			$pieces = explode(' ', $params['q']);
			$search_type = ' AND ';
		} else {
			$pieces = explode(' ', $params['q']);
			$search_type = ' OR ';
		}

		$_condition = array();
		foreach ($pieces as $piece) {
			$tmp = array();
			if (!empty($params['pname']) && $params['pname'] == 'Y') {
				$tmp[] = db_quote("(?:page_descriptions.page LIKE ?l)", "%$piece%"); // check search words
			}

			if ($params['pdescr'] == 'Y') {
				$tmp[] = db_quote("?:page_descriptions.description LIKE ?l", "%$piece%");
			}

			if (!empty($tmp)) {
				$_condition[] = '(' . implode(' OR ', $tmp) . ')';
			}
		}
		if (!empty($_condition)) {
			$condition .= ' AND ' . implode($search_type, $_condition);
		}
	}

	if (!empty($params['page_type'])) {
		$condition .= db_quote(" AND ?:pages.page_type = ?s", $params['page_type']);
	}

	if (isset($params['parent_id']) && $params['parent_id'] !== '') {
		$p_ids = array();
		if ($params['subpages'] == 'Y') {
			$p_ids = db_get_fields("SELECT a.page_id FROM ?:pages as a LEFT JOIN ?:pages as b ON b.page_id = ?i WHERE a.id_path LIKE CONCAT(b.id_path, '/%')", $params['parent_id']);
		}
		$p_ids[] = $params['parent_id'];

		$condition .= db_quote(" AND ?:pages.parent_id IN (?n)", $p_ids);
	}

	if (!empty($params['from_page_id'])) {
		$from_id_path = db_get_field("SELECT id_path FROM ?:pages WHERE page_id = ?i", $params['from_page_id']);
		$condition .= db_quote(" AND ?:pages.id_path LIKE ?l", "$from_id_path/%");
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(" AND ?:pages.status IN (?a)", $params['status']);
	}

	if (!empty($params['visible'])) {  // for pages tree: show visible branch only
		if (!empty($params['current_page_id'])) {
			$cur_id_path = db_get_field("SELECT id_path FROM ?:pages WHERE page_id = ?i", $params['current_page_id']);
			if (!empty($cur_id_path)) {
				$page_ids = explode('/', $cur_id_path);
			}
		}

		$page_ids[] = $params['page_id'];
		$condition .= db_quote(" AND ?:pages.parent_id IN (?n)", $page_ids);
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);
		$condition .= db_quote(" AND (?:pages.timestamp >= ?i AND ?:pages.timestamp <= ?i)", $params['time_from'], $params['time_to']);
	}

	if (!empty($params['item_ids'])) { // get only defined pages
		$condition .= db_quote(" AND ?:pages.page_id IN (?n)", explode(',', $params['item_ids']));
	}

	if (!empty($params['except_id']) && (empty($params['item_ids']) || !empty($params['item_ids']) && !in_array($params['except_id'], explode(',', $params['item_ids'])))) {
		$condition .= db_quote(' AND ?:pages.page_id != ?i AND ?:pages.parent_id != ?i', $params['except_id'], $params['except_id']);
	}

	if (AREA != 'A') {
		$condition .= db_quote(" AND ?:pages.membership_id IN (?n)", array(0, $auth['membership_id']));
		$condition .= fn_get_localizations_condition('?:pages.localization', true);
		$condition .= db_quote(" AND ?:pages.registred_only IN (?a)", !empty($auth['user_id']) ? array('Y','N') : array('N')); // FIXME: should be refactored using usergroups
		$condition .= db_quote(" AND (use_avail_period = ?s OR (use_avail_period = ?s AND avail_from_timestamp >= ?i AND avail_till_timestamp <= ?i))", 'N', 'Y', TIME, TIME);
	}

	$join = db_quote('LEFT JOIN ?:page_descriptions ON ?:pages.page_id = ?:page_descriptions.page_id AND ?:page_descriptions.lang_code = ?s', $lang_code);

	if (!empty($params['limit'])) {
		$limit = db_quote(" LIMIT 0, ?i", $params['limit']);
	}

	fn_set_hook('get_pages', $params, $join, $condition, $fields, $group_by, $sortings);

	if (!empty($params['get_tree'])) {
		$params['sort_by'] = 'multi_level';
	}

    if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
        $params['sort_order'] = 'asc';
    }

    if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
        $params['sort_by'] = 'position';
    }

    $sorting = (is_array($sortings[$params['sort_by']]) ? implode(' ' . $directions[$params['sort_order']] . ', ', $sortings[$params['sort_by']]) : $sortings[$params['sort_by']]) . " " . $directions[$params['sort_order']];

    if (!empty($group_by)) {
    	$group_by = ' GROUP BY ' . $group_by;
    }

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	// Get search conditions
	if (!empty($params['get_conditions'])) {
		return array($fields, $join, $condition);
	}

	$total = 0;
	if (!empty($items_per_page) && !empty($params['paginate'])) {
		$total = db_get_field("SELECT COUNT(DISTINCT(?:pages.page_id)) FROM ?:pages ?p WHERE ?p ?p ORDER BY ?p", $join, $condition, $group_by, $sorting);
		$limit = fn_paginate($params['page'], $total, $items_per_page);
	}

	$pages = db_get_hash_array("SELECT " . implode(', ', $fields) ." FROM ?:pages ?p WHERE ?p ?p ORDER BY ?p ?p", 'page_id', $join, $condition, $group_by, $sorting, $limit);

	if (!empty($pages)) {
		foreach ($pages as $k => $v) {
			$pages[$k]['level'] = substr_count($v['id_path'], '/');
		}

		if (!empty($params['get_tree'])) {
			$delete_keys = array();
			foreach ($pages as $k => $v) {
				if (!empty($v['parent_id']) && !empty($pages[$v['parent_id']])) {
					$pages[$v['parent_id']]['subpages'][$v['page_id']] = $v;
					$pages[$k] = & $pages[$v['parent_id']]['subpages'][$v['page_id']];
					$delete_keys[] = $k;
				}
			}

			foreach ($delete_keys as $k) {
				unset($pages[$k]);
			}
		}

		if ($params['get_tree'] == 'plain') {
			$pages = fn_multi_level_to_plain($pages, 'subpages');
		}

		if (!empty($params['get_children_count'])) {
			$where_condition = !empty($params['except_id']) ? db_quote(' AND page_id != ?i', $params['except_id']) : '';
			$children = db_get_hash_single_array("SELECT parent_id, COUNT(page_id) as children FROM ?:pages WHERE parent_id IN (?n) ?p GROUP BY parent_id", array('parent_id', 'children'), array_keys($pages), $where_condition);
			
			if (!empty($children)) {
				foreach ($children as $k => $v) {
					$pages[$k]['has_children'] = !empty($v);
				}
			}
		}
	}

	if (!empty($params['add_root'])) {
		array_unshift($pages, array('page_id' => 0, 'page' => $params['add_root']));
	}

	return array($pages, $params);
}

function fn_get_page_data($page_id, $lang_code = CART_LANGUAGE)
{
	static $cache = array();

	if (empty($page_id)) {
		return false;
	}

	if (empty($cache[$page_id])) {
		$cache[$page_id] = db_get_row("SELECT * FROM ?:pages INNER JOIN ?:page_descriptions ON ?:pages.page_id = ?:page_descriptions.page_id WHERE ?:pages.page_id = ?i AND ?:page_descriptions.lang_code = ?s", $page_id, $lang_code);
		if (empty($cache[$page_id]) || AREA != 'A' && ($cache[$page_id]['status'] == 'D' || $cache[$page_id]['use_avail_period'] == 'Y' && ($cache[$page_id]['avail_from_timestamp'] > TIME || $cache[$page_id]['avail_till_timestamp'] < TIME) || $cache[$page_id]['registred_only'] == 'Y' && !$_SESSION['auth']['user_id'])) {
			return false;
		}
		fn_set_hook('get_page_data', $cache[$page_id], $lang_code);

		// Generate meta description automatically
		if (empty($cache[$page_id]['meta_description']) && defined('AUTO_META_DESCRIPTION') && AREA != 'A') {
			$cache[$page_id]['meta_description'] = fn_generate_meta_description($cache[$page_id]['description']);
		}
	}

	return (!empty($cache[$page_id]) ? $cache[$page_id] : false);
}

function fn_get_page_name($page_id, $lang_code = CART_LANGUAGE)
{
	if (!empty($page_id)) {
		if (is_array($page_id)) {
			return db_get_hash_single_array("SELECT page_id, page FROM ?:page_descriptions WHERE page_id IN (?n) AND lang_code = ?s", array('page_id', 'page'), $page_id, $lang_code);
		} else {
			return db_get_field("SELECT page FROM ?:page_descriptions WHERE page_id = ?i AND lang_code = ?s", $page_id, $lang_code);
		}
	}

	return false;
}

/** Block manager **/

function fn_get_block_properties($structure_section = '')
{
	static $schema;

	if (!isset($schema)) {

		$schema = fn_get_schema('block_manager', 'structure');

		if (AREA == 'A') {
			foreach ($schema as $k => $v) {
				foreach (array('fillings', 'positions', 'appearances', 'order') as $section_name) {
					if (!empty($v[$section_name])) {
						$_tmp = array();
						foreach ($v[$section_name] as $key => $val) {
							if (is_array($val) == true) {
								$_tmp[$key] = $val;
								$_tmp[$key]['name'] = ($section_name == 'appearances') ? fn_get_block_template_description($key) : fn_get_lang_var($key);
							} else {
								$_tmp[$val] = ($section_name == 'appearances') ? fn_get_block_template_description($val) : fn_get_lang_var($val);
							}
						}
						$schema[$k][$section_name] = $_tmp;
					}
				}
			}
		}
	}

	return (empty($structure_section) || !array_key_exists($structure_section, $schema)) ? $schema : $schema[$structure_section];
}

function fn_get_block_specific_settings()
{
	static $schema;

	if (!isset($schema)) {
		$schema = fn_get_schema('block_manager', 'specific_settings');
	}

	return $schema;
}

/**
 * The function returns the name of the template
 *
 * @param string $template path to template
 * @return string block name
 */

function fn_get_block_template_description($template)
{
	static $names;

	$path = DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/';

	if (!isset($names[$template])) {

		$fd = fopen($path . $template, 'r');
		$counter = 1;

		while (($s = fgets($fd, 4096)) && ($counter < 3)) {
			preg_match('/\{\*\* block-description:(\w+) \*\*\}/i', $s, $matches);
			if (!empty($matches[1])) {
				$names[$template] = fn_get_lang_var($matches[1]);
				break;
			}
		}

		fclose($fd);

		// If no description available, set it to template name
		if (empty($names[$template])) {
			$names[$template] = basename($template);
		}
	}

	return $names[$template];
}

/**
 * The function returns the list of available block locations
 *
 * @return array of objects
 *
 */

function fn_get_block_locations()
{
	$locations = array (
		'all_pages' => 'all_pages',
		'products' => 'product_id',
		'categories' => 'category_id',
		'pages' => 'page_id',
		'index' => 'home_page',
		'cart' => 'cart',
		'checkout' => 'checkout'
	);

	fn_set_hook('get_block_locations', $locations);

	return $locations;
}

/**
 * The function returns the list of the blocks
 *
 * @param array $params
 * @param string $lang_code
 * @return array of blocks
 */

function fn_get_blocks($params = array(), $lang_code = CART_LANGUAGE)
{
	$condition = '';
	$_blocks = $block_ids = array();
	$object_id = 0;

	if (empty($params['all'])) {
		$condition .= " AND ?:blocks.status = 'A'";
	}

	$fields = array (
		'?:blocks.*',
		'?:block_descriptions.block',
		'?:block_descriptions.block_id',
		'?:block_links.item_ids',
		'?:block_links.enable AS assigned'
	);

	if (!empty($params)) {
		if (AREA == 'A') {
			$condition .= db_quote(" AND ?:blocks.location = ?s", $params['location']);
		} else {

			if (!empty($params['product_id']) && $params['location'] == 'products') {
				$object_id = $params['product_id'];
			} elseif (!empty($params['category_id']) && $params['location'] == 'categories') {
				$object_id = $params['category_id'];
			} elseif (!empty($params['page_id']) && $params['location'] == 'pages') {
				$object_id = $params['page_id'];
			} elseif (!empty($params['location']) && $params['location'] == 'checkout') {
				if (MODE == 'cart') {
					$params['location'] = 'cart';
				}
			}

			$condition .= db_quote(" AND ?:block_links.enable = 'Y'");
			$condition .= db_quote(" AND NOT FIND_IN_SET(?s, ?:blocks.disabled_locations)", $params['location']);

			if (!empty($object_id)) {
				$condition .= db_quote(" AND (?:block_links.location = 'all_pages' OR (?:block_links.location = ?s AND ?:block_links.object_id = ?i))", $params['location'], $object_id);
			} else {
				$condition .= db_quote(" AND (?:block_links.location = 'all_pages' OR ?:block_links.location = ?s)", $params['location']);
			}
		}
	}

	$blocks = db_get_hash_array('SELECT ' . implode(',', $fields) . " FROM ?:blocks LEFT JOIN ?:block_links ON ?:block_links.block_id = ?:blocks.block_id LEFT JOIN ?:block_descriptions ON ?:block_descriptions.block_id = ?:blocks.block_id AND lang_code = ?s WHERE 1 ?p ORDER BY position", 'block_id', $lang_code, $condition); 

	if (!empty($blocks)) {
		$block_ids = array_keys($blocks);
	}

	$block_properties = db_get_hash_multi_array("SELECT * FROM ?:block_properties WHERE block_id IN (?n)", array('block_id', 'property', 'value'), $block_ids);

	if (!empty($blocks)) {
		$location_properties = fn_get_block_locations();

		if (AREA == 'A') {
			$assigned = db_get_hash_single_array("SELECT block_id, COUNT(*) as c FROM ?:block_links WHERE block_id IN (?n) AND enable = 'Y' GROUP BY block_id", array('block_id', 'c'), array_keys($blocks));
		}

		foreach ($blocks as $block_id => $block) {
			if (!empty($location_properties[$block['location']])) {
				$blocks[$block_id]['object_id'] = $location_properties[$block['location']];
			}
			$blocks[$block_id]['properties'] = $block_properties[$block_id];

			if (AREA == 'A') {
				if (strpos($blocks[$block_id]['properties']['list_object'], '.tpl') === false) {
					$blocks[$block_id]['items_count'] = empty($block['item_ids']) ? 0 : (substr_count($block['item_ids'], ',') + 1);
					$blocks[$block_id]['properties']['content_name'] = fn_get_lang_var($blocks[$block_id]['properties']['list_object']);
				} else {
					$blocks[$block_id]['properties']['content_name'] = fn_get_block_template_description($blocks[$block_id]['properties']['list_object']);
				}
				if (!in_array($block['location'], array ('all_pages', 'index', 'cart', 'checkout'))) {
					$blocks[$block_id]['assigned_to'] = !empty($assigned[$block_id]) ? $assigned[$block_id] : 0;
				}
			}
		}
	}

	return $blocks;
}

function fn_get_block_items($block)
{
	$properties = fn_get_block_properties($block['properties']['list_object']);

	$params = $items = $data_modifier = array();

	if (!empty($block['properties'])) {
		foreach ($block['properties'] as $prop_name => $prop_val) {
			if (!empty($properties[$prop_name]) && !empty($properties[$prop_name][$prop_val]) && is_array($properties[$prop_name][$prop_val])) {
				// Settings for current element - appearance, filling etc
				$s_section = $properties[$prop_name][$prop_val];
				if (!empty($s_section['data_modifier'])) {
					$data_modifier = array_merge($s_section['data_modifier'], $data_modifier);
				}
				if (!empty($s_section['params'])) {
					$params = array_merge($s_section['params'], $params);
				}
			}
		}
	}

	// Collect data from $_REQUEST
	if (!empty($params['request'])) {
		foreach ($params['request'] as $param => $val) {
			$val = strtolower(str_replace('%', '', $val));
			if (isset($_REQUEST[$val])) {
				$params[$param] = $_REQUEST[$val];
			}
		}
		unset($params['request']);
	}

	// Collect data from $_SESSION !!! FIXME, merge with $_REQUEST
	if (!empty($params['session'])) {
		foreach ($params['session'] as $param => $val) {
			$val = strtolower(str_replace('%', '', $val));
			if (isset($_SESSION[$val])) {
				$params[$param] = $_SESSION[$val];
			}
		}
		unset($params['session']);
	}

	// Collect data from $auth !!! FIXME, merge with $_REQUEST
	if (!empty($params['auth'])) {
		foreach ($params['auth'] as $param => $val) {
			$val = strtolower(str_replace('%', '', $val));
			if (isset($_SESSION['auth'][$val])) {
				$params[$param] = $_SESSION['auth'][$val];
			}
		}
		unset($params['auth']);
	}


	$_params = $block['properties'];
	unset($_params['fillings'], $_params['list_object'], $_params['appearances'], $_params['order'], $_params['positions']);
	if (!empty($_params)) {
		$params = fn_array_merge($params, $_params);
	}

	if (!empty($block['properties']['fillings']) && $block['properties']['fillings'] == 'manually') {
		// Check items list
		if (empty($block['item_ids'])) {
			return array();
		} else {
			$params['item_ids'] = $block['item_ids'];
		}
	}

	if (!empty($properties['data_function'])) {
		$func = $properties['data_function'];
	} else {
		$func = 'fn_get_' . $block['properties']['list_object'];
	}

	if (function_exists($func)) {
		@list($items, ) = $func($params);
	}

	// Picker values
	if (!empty($items)) {
		if (AREA == 'A' && !empty($properties['object_id'])) {
			$picker_ids = array();
			foreach ($items as $item) {
				$picker_ids[] = $item[$properties['object_id']];
			}
			$items = $picker_ids;
		} elseif (!empty($data_modifier)) {
			foreach ($items as $k => $_item) {
				foreach ($data_modifier as $_func => $_param) {
					$__params = array();
					foreach ($_param as $v) {
						if ($v == '#this') {
							$__params[] = &$items[$k];
						} else {
							$__params[] = $v;
						}
					}
					call_user_func_array($_func, $__params);
				}
			}
		}
	}

	return $items;
}

function fn_get_selected_block_data($params, $blocks, $object_id = 0, $location = 'products')
{
	if (empty($blocks)) {
		return false;
	}

	$block_ids = array_keys($blocks);
	if (empty($params['selected_block_id']) || in_array($params['selected_block_id'], $block_ids) == false) {
		$selected_block_id = $block_ids[0];
	} else {
		$selected_block_id = $params['selected_block_id'];
	}

	if (!empty($object_id) || !empty($location)) {
		$link = db_get_row("SELECT link_id, item_ids, enable as assigned FROM ?:block_links WHERE block_id = ?i AND object_id = ?i AND location = ?s", $selected_block_id, $object_id, $location);

		// If now link found, cleanup existing data
		if (empty($link)) {
			$link = array(
				'link_id' => '',
				'item_ids' => '',
				'enable' => 'N'
			);
		}

		$data = $blocks[$selected_block_id];
		$data = array_merge($data, $link);

		if (!empty($data['properties']['fillings']) && $data['properties']['fillings'] == 'manually' && AREA == 'A') {
			if (!empty($data['item_ids'])) {
				$data['item_ids'] = explode(',', $data['item_ids']);
			}

			return $data;
		}

		$data['item_ids'] = fn_get_block_items($data);
	}

	return $data;
}

function fn_get_block_scroller_directions()
{
	$scroller_directions = array(
		'D' => 'down',
		'U' => 'up',
		'R' => 'right',
		'L' => 'left'
	);

	return $scroller_directions;
}

function fn_get_active_addons_skin_dir($relative = false)
{
	$skins_dir = array();

	foreach	((array)Registry::get('addons') as $addon_name => $data) {
		if (fn_load_addon($addon_name) == true && strpos($addon_name, '_opts') === false) {
			$skins_dir[] = ($relative == true) ? "addons/$addon_name" : DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/addons/' . $addon_name;
		}
	}

	return $skins_dir;
}

function fn_get_blocks_location_dir($section, $relative = false)
{
	static $schema;

	if (!isset($schema)) {
		$schema = fn_get_schema('block_manager', 'block_controllers');
	}

	if (AREA == 'C') {
		if (array_key_exists($section, $schema)) {
			if (is_array($schema[$section]) && !empty($schema[$section][MODE])) {
				$new_section = $schema[$section][MODE];
			} else {
				$new_section = $schema[$section];
			}
		} else {
			$new_section = 'all_pages';
		}
	} else {
		$new_section = $section;
	}

	if (is_dir(DIR_SKINS . Registry::get('settings.skin_name_customer') . "/customer/blocks/locations/$new_section")) {
		return ($relative == true) ? "blocks/locations/$new_section" : DIR_SKINS . Registry::get('settings.skin_name_customer') . "/customer/blocks/locations/$new_section";
	} else {
		foreach (fn_get_active_addons_skin_dir(true) as $_dir) {
			if (is_dir(DIR_SKINS . Registry::get('settings.skin_name_customer') . "/customer/$_dir/blocks/locations/$new_section")) {
				return ($relative == true) ? "$_dir/blocks/locations/$new_section" : DIR_SKINS . Registry::get('settings.skin_name_customer') . "/customer/$_dir/blocks/locations/$new_section";
			}
		}

		return ($relative == true) ? 'blocks/locations/all_pages' : "$_dir/blocks/locations/all_pages";
	}
}

/**
 * Function delete object from the block (product, category, page etc)
 *
 * @param string $object the type of object
 * @param int $object_id
 *
 * @return true
 */

function fn_clean_block_items($object, $object_id)
{
	$rm = fn_remove_from_set('?:block_links.item_ids', $object_id);

	db_query("UPDATE ?:block_links SET item_ids = ?p WHERE block_id IN (SELECT block_id FROM ?:block_properties WHERE property = 'list_object' AND value = ?s)", $rm, $object);

	return true;
}

function fn_add_items_to_block($block_id, $objects, $object_id = 0, $location = '', $add_vals = false, $page = 0)
{
	$objects = empty($objects) ? array() : $objects;
	$_objects = array();

	$data = array (
		'block_id' => $block_id,
		'object_id' => $object_id,
		'location' => $location
	);

	$objects_set = '';

	if (empty($object_id)) {
		$data['location'] = db_get_field('SELECT location FROM ?:blocks WHERE block_id = ?i', $block_id);
	}
	
	if (!empty($objects)) {
		if (is_array($objects)) {
			$_objects = $objects;
			if ($add_vals == false) {
				asort($_objects);
				$_objects = array_keys($_objects);
			}
			$objects_set = empty($_objects) ? '' : implode(',', $_objects);
		} else {
			$objects_set = $objects;
			$objects = explode(',', $objects);
			$_objects = $objects;
		}
	} else {
		$_objects = array();
	}

	$current_items = db_get_field("SELECT item_ids FROM ?:block_links WHERE block_id = ?i AND object_id = ?i", $block_id, $object_id);
	if (!empty($current_items)) {
		$current_items = explode(',', $current_items);
		$delete_ids = array();
		if (empty($page) && $add_vals == false) {
			$delete_ids = array_diff($current_items, $_objects);
		} elseif (!empty($page)) {
			$items_per_page = !empty($_SESSION['items_per_page']) ? $_SESSION['items_per_page'] : Registry::get('settings.Appearance.admin_elements_per_page');
			$page_items = array_slice($current_items, ($page - 1) * $items_per_page, $items_per_page);
			if (count($page_items) > count($_objects)) {
				$delete_ids = array_diff($page_items, $_objects);
			}
		}
		if (!empty($delete_ids)) {
			$current_items = array_diff($current_items, $delete_ids);
		}
		if ($add_vals == false) {
			$key_items = array();
			foreach ($current_items as $id => $key) {
				$key_items[$key] = ($id + 1) * 10;
			}
			$objects = $objects + $key_items;
			asort($objects);
			$objects = array_keys($objects);
		} else {
			$objects = array_merge($objects, $current_items);
		}
		$objects = array_unique($objects);
		$objects_set = implode(',', $objects);
	}

	$link_id = fn_assign_block($data);

	db_query('UPDATE ?:block_links SET item_ids = ?s WHERE link_id = ?i', $objects_set, $link_id);

	return true;
}

function fn_assign_block($params)
{
	$w_params = array (
		'block_id' => $params['block_id'],
		'location' => empty($params['location']) ? '' : $params['location'],
		'object_id' => empty($params['object_id']) ? 0 : $params['object_id'],
	);

	$link_id = db_get_field('SELECT link_id FROM ?:block_links WHERE ?w', $w_params);

	if (empty($link_id)) {
		$link_id = db_query('INSERT INTO ?:block_links ?e', $params);
	} elseif (!empty($params['enable'])) {
		db_query('UPDATE ?:block_links SET enable = ?s WHERE link_id = ?i', $params['enable'], $link_id);
	}

	return $link_id;
}

?>
