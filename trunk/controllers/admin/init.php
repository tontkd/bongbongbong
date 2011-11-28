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
// $Id: init.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$view->assign('descr_sl', DESCR_SL);

$view->assign('index_script', $index_script);
$view_mail->assign('index_script', $index_script);

if (!empty($auth['user_id']) && $auth['area'] != AREA) {
	$auth = array();
	return array(CONTROLLER_STATUS_REDIRECT, $index_script);
}

//
// Controllers that allow access without logging in
//
$trusted_controllers = array (
	'auth' => true,
	'image' => true
);

if (empty($auth['user_id']) && !isset($trusted_controllers[CONTROLLER])) {
	if (CONTROLLER != 'index') {
		fn_set_notification('E', fn_get_lang_var('access_denied'), fn_get_lang_var('error_not_logged'));
	}
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=auth.login_form&return_url=" . urlencode(Registry::get('config.current_url')));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	return;
}

// Get base menu
$menues = fn_get_schema('menu', 'menu', 'xml');

$xml = simplexml_load_string('<menu>' . $menues . '</menu>');

Registry::set('navigation', array(
	'static' => array(),
	'dynamic' => array(),
	'selected_tab' => NULL,
	'subsection' => NULL
));

// generate top tabbed menu from .xml files
// we get active tab in four ways:
// 1) we search xml item with attr 'dispatch' = current_controller . current_mode
// if no success:
// 2) we search xml item with attr 'dispatch' = current_controller . * (any_mode)
// if no success:
// 3) we search sidebox xml item with attr 'href' = current_url, and its parents are used as active tabs
// if no success:
// 4) we remove last parameter from current_url and we try 3rd way again with shortened url

$navigation = & Registry::get('navigation');

$_cache = array();
$_dispatch = CONTROLLER . '.' . MODE;

$tab_selected = false;
$groups = array();
$is = array();

// Get static section
foreach ($xml as $root => $item) {

	if (!isset($navigation['static'][$root])) {
		$navigation['static'][$root] = array();
	}
	$_cache[] = $root;
	
	if (!isset($is[$root])) {
		$is[$root] = 0;
	}
	foreach ($item->item as $it) {
		$_cache[] = (string)$it['title'];
		if (fn_check_view_permissions($it['dispatch'], 'GET') == false) {
			continue;
		}

		if (isset($it['active_option'])) {
			$_op = Registry::get((string)$it['active_option']);
			if (empty($_op) || $_op === 'N') {
				continue;
			}
		}

		$is[$root]++;
		if (isset($it['links_group'])) {
			if (!isset($groups[(string)$it['links_group']])) {
				$groups[(string)$it['links_group']] = $is[$root];
			}
		}

		$navigation['static'][$root][(string)$it['title']] = array(
			'href' => $index_script . '?dispatch=' . (string)$it['dispatch'] . (!empty($it['extra']) ? '&' . (string)$it['extra'] : ''),
			'position' => isset($it['links_group']) ? $groups[(string)$it['links_group']] : $is[$root]
		);

		// 1st way
		if ($_dispatch == (string)$it['dispatch']) {
			if (empty($it['extra']) || (strpos(Registry::get('config.current_url'), (string)$it['extra']) !== false)) {
				$navigation['selected_tab'] = $root;
				$navigation['subsection'] = (string)$it['title'];
				$tab_selected = true;
			}
		}

		// 1st A way
		if (!empty($it['alt'])) {
			$alt = fn_explode(',', (string)$it['alt']);
			foreach ($alt as $v) {
				@list($_d, $_m) = fn_explode('.', $v);
				if (((!empty($_m) && MODE == $_m) || empty($_m)) && CONTROLLER == $_d) {
					$navigation['selected_tab'] = $root;
					$navigation['subsection'] = (string)$it['title'];
					$tab_selected = true;
					break;
				}
			}
		}

		// 2nd way		
		if (empty($tab_selected) && strpos((string)$it['dispatch'], CONTROLLER . (strpos((string)$it['dispatch'], '.') ? '.' : '')) === 0) {
			$navigation['selected_tab'] = $root;
			$navigation['subsection'] = (string)$it['title'];
			$tab_selected = true;
		}
	}
}

$navigation['static'] = fn_sort_menu($navigation['static']);

// 3rd way
if (empty($tab_selected)) {
	// search current link by href
	$_data = $xml->xpath('//item[@href=\'' . Registry::get('config.current_url') . '\']');
	$active = !empty($_data) ? array_shift($_data) : false;

	// 4th way
	if (!$active) {
		if ($p = strpos(Registry::get('config.current_url'), '&')) {
			$shortened_href = substr(Registry::get('config.current_url'), 0, $p);
			$_data = $xml->xpath('//item[@href=\'' . $shortened_href . '\']');
			$active = !empty($_data) ? array_shift($_data) : false;
		}
	}

	if ($active) {
		$_data = $xml->xpath("//item[@dispatch='{$active['@attributes']['group']}']/..");
		$node = !empty($_data) ? array_shift($_data) : false;

		if ($node) {
			$active_root = $node->getName();
			$navigation['selected_tab'] = $active_root;
			$tab_selected = true;
		}

		$node = (array)array_shift($xml->xpath("//item[@dispatch='{$active['@attributes']['group']}']"));
		if ($node) {
			$navigation['subsection'] = $node['@attributes']['title'];
		}
	}
}

// Get dynamic section
$actions = (array)$xml->xpath("//item[@group='$_dispatch']");
$actions = fn_array_merge($actions, (array)$xml->xpath('//item[@group=\'' . CONTROLLER . '\']'), false);


// prepare context variables for replacement (we replace %USER_ID in xml to current user id, etc)
$context_vars = array();
foreach ($_REQUEST as $var_name => $var_value) {
	$context_vars['%' . strtoupper($var_name)] = $var_value;
}

$context_vars['%CONTROLLER'] = CONTROLLER;
$context_vars['%MODE'] = MODE;
$context_vars['%INDEX_SCRIPT'] = $index_script;

foreach ($actions as $item) {
	if (empty($item) || !empty($item['extra']) && strpos(Registry::get('config.current_url'), (string)$item['extra']) === false) {
		continue;
	}

	$_cache[] = (string)$item['title'];
	$navigation['dynamic']['actions'][(string)$item['title']]  = array (
		'href' => strtr((string)$item['href'], $context_vars),
		'meta' => (!empty($item['meta']) ? (string)$item['meta'] : ''),
		'target' => (!empty($item['target']) ? (string)$item['target'] : '')
	);
}

fn_preload_lang_vars($_cache);

// Navigation is passed in view->display method to allow its modification in controllers

$view->assign('quick_menu', fn_get_quick_menu_data());


$schema = fn_get_schema('last_edited_items', 'schema');
$last_items_cnt = LAST_EDITED_ITEMS_COUNT;

if (empty($_SESSION['last_edited_items'])) {
	$stored_items = fn_get_user_additional_data('L');
	$last_edited_items = empty($stored_items) ? array() : $stored_items;
	$_SESSION['last_edited_items'] = $last_edited_items;
} else {
	$last_edited_items = $_SESSION['last_edited_items'];
}

$last_items = array();
foreach ($last_edited_items as $_k => $v) {
	if (!empty($v['func'])) {
		$func = array_shift($v['func']);
		if (function_exists($func)) {
			$content = call_user_func_array($func, $v['func']);
			if (!empty($content)) {
				$name = (empty($v['text']) ? '' : fn_get_lang_var($v['text']) . ': ') . $content;
				array_unshift($last_items, array('name' => $name, 'url' => $v['url'], 'icon' => $v['icon']));
			} else {
				unset($last_edited_items[$_k]);
			}
		} else {
			unset($last_edited_items[$_k]);
		}
	} else {
		array_unshift($last_items, array('name' => fn_get_lang_var($v['text']), 'url' => $v['url'], 'icon' => $v['icon']));
	}
}
$view->assign('last_edited_items', $last_items);

if (!empty($schema[CONTROLLER . '.' . MODE])) {
	$items_schema = $schema[CONTROLLER . '.' . MODE];
	if (empty($items_schema['func'])) {
		$c_elm = '';
	} else {
		$c_elm = $items_schema['func'];
		foreach ($c_elm as $k => $v) {
			if (strpos($v, '@') !== false) {
				$ind = str_replace('@', '', $v);
				$c_elm[$k] = ($ind == 'user_id' && empty($_REQUEST[$ind])) ? $auth[$ind] : $_REQUEST[$ind];
			}
		}
	}
	$last_item = array('func' => $c_elm, 'url' => Registry::get('config.current_url'), 'icon' => (empty($items_schema['icon']) ? '' : $items_schema['icon']), 'text' => (empty($items_schema['text']) ? '' : $items_schema['text']));
	$hash = fn_crc32(!empty($c_elm) ? implode('', $c_elm) : $items_schema['text']);

	if (!isset($last_edited_items[$hash])) {
		$last_edited_items[$hash] = $last_item;
	}

	if (count($last_edited_items) > $last_items_cnt) {
		array_shift($last_edited_items);
	}

	$_SESSION['last_edited_items'] = $last_edited_items;
	fn_save_user_additional_data('L', $last_edited_items);
}

function fn_sort_menu($menu)
{
	foreach ($menu as $root => $data) {
		$r = array();
		foreach ($data as $k => $v) {
			$r[$v['position']][$k] = $v;
		}

		if (!empty($r)) {
			$menu[$root] = call_user_func_array('array_merge', $r);
		}

		if (empty($menu[$root])) {
			unset($menu[$root]);
		}
	}

	return $menu;
}

?>
