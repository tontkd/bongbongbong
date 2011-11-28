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
// $Id: promotions.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	fn_trusted_vars('promotion_data');
	$suffix = '';

	//
	// Update promotion
	//
	if ($mode == 'update') {

		$promotion_id = fn_update_promotion($_REQUEST['promotion_data'], $_REQUEST['promotion_id'], DESCR_SL);

		$suffix = ".update&promotion_id=$promotion_id";
	}

	//
	// Multiple promotion update
	//
	if ($mode == 'm_update') {

		if (!empty($_REQUEST['promotions']) && is_array($_REQUEST['promotions'])) {
			foreach ($_REQUEST['promotions'] as $pr_id => $v) {
				db_query("UPDATE ?:promotions SET ?u WHERE promotion_id = ?i", $v, $pr_id);
				db_query("UPDATE ?:promotion_descriptions SET ?u WHERE promotion_id = ?i AND lang_code = ?s", $v, $pr_id, DESCR_SL);
			}
		}

		$suffix = ".manage";
	}

	//
	// Delete selected promotions
	//
	if ($mode == 'delete') {

		if (!empty($_REQUEST['promotion_ids'])) {
			fn_delete_promotions($_REQUEST['promotion_ids']);
		}

		$suffix = ".manage";
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=promotions$suffix");
}

// ----------------------------- GET routines -------------------------------------------------

// promotion data
if ($mode == 'update') {

	fn_add_breadcrumb(fn_get_lang_var('promotions'), "$index_script?dispatch=promotions.manage");

	Registry::set('navigation.tabs', array (
		'details' => array (
			'title' => fn_get_lang_var('general'),
			'href' => "$index_script?dispatch=promotions.update&promotion_id=$_REQUEST[promotion_id]&selected_section=details",
			'js' => true
		),
		'conditions' => array (
			'title' => fn_get_lang_var('conditions'),
			'href' => "$index_script?dispatch=promotions.update&promotion_id=$_REQUEST[promotion_id]&selected_section=conditions",
			'js' => true
		),
		'bonuses' => array (
			'title' => fn_get_lang_var('bonuses'),
			'href' => "$index_script?dispatch=promotions.update&promotion_id=$_REQUEST[promotion_id]&selected_section=bonuses",
			'js' => true
		),
	));

	$promotion_data = fn_get_promotion_data($_REQUEST['promotion_id']);

	if (empty($promotion_data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	$view->assign('promotion_data', $promotion_data);

	$view->assign('zone', $promotion_data['zone']);
	$view->assign('schema', fn_promotion_get_schema());

// Add promotion
} elseif ($mode == 'add') {

	fn_add_breadcrumb(fn_get_lang_var('promotions'), "$index_script?dispatch=promotions.manage");

	Registry::set('navigation.tabs', array (
		'details' => array (
			'title' => fn_get_lang_var('general'),
			'href' => "$index_script?dispatch=promotions.add&selected_section=details",
			'js' => true
		),
		'conditions' => array (
			'title' => fn_get_lang_var('conditions'),
			'href' => "$index_script?dispatch=promotions.add&selected_section=conditions",
			'js' => true
		),
		'bonuses' => array (
			'title' => fn_get_lang_var('bonuses'),
			'href' => "$index_script?dispatch=promotions.add&selected_section=bonuses",
			'js' => true
		),
	));

	$view->assign('zone', !empty($_REQUEST['zone']) ? $_REQUEST['zone'] : 'catalog');
	$view->assign('schema', fn_promotion_get_schema());

} elseif ($mode == 'dynamic') {
	$view->assign('schema', fn_promotion_get_schema());
	$view->assign('prefix', $_REQUEST['prefix']);
	$view->assign('elm_id', $_REQUEST['elm_id']);

	if (!empty($_REQUEST['zone'])) {
		$view->assign('zone', $_REQUEST['zone']);
	}

	if (!empty($_REQUEST['condition'])) {
		$view->assign('condition_data', array('condition' => $_REQUEST['condition']));

	} elseif (!empty($_REQUEST['bonus'])) {
		$view->assign('bonus_data', array('bonus' => $_REQUEST['bonus']));
	}


// promotions list
} elseif ($mode == 'manage') {

	list($promotions, $search) = fn_get_promotions($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'), DESCR_SL);

	$view->assign('search', $search);
	$view->assign('promotions', $promotions);

// Delete selected promotions
} elseif ($mode == 'delete') {

	if (!empty($_REQUEST['promotion_id'])) {
		fn_delete_promotions($_REQUEST['promotion_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=promotions.manage");
}

function fn_delete_promotions($promotion_ids)
{
	foreach ((array)$promotion_ids as $pr_id) {
		db_query("DELETE FROM ?:promotions WHERE promotion_id = ?i", $pr_id);
		db_query("DELETE FROM ?:promotion_descriptions WHERE promotion_id = ?i", $pr_id);
	}
}

function fn_update_promotion($data, $promotion_id, $lang_code = DESCR_SL)
{
	if (!empty($data['conditions']['conditions'])) {
		$data['conditions_hash'] = fn_promotion_serialize($data['conditions']['conditions']);
	} else {
		$data['conditions_hash'] = '';
	}

	$data['conditions'] = empty($data['conditions']) ? array() : $data['conditions'];
	$data['bonuses'] = empty($data['bonuses']) ? array() : $data['bonuses'];

	fn_promotions_check_group_conditions($data['conditions']);

	$data['conditions'] = serialize($data['conditions']);
	$data['bonuses'] = serialize($data['bonuses']);

	$from_date = $data['from_date'];
	$to_date = $data['to_date'];

	$data['from_date'] = fn_parse_date($from_date);
	$data['to_date'] = fn_parse_date($to_date, true);

	if ($data['to_date'] < $data['from_date']) { // protection from incorrect date range (special for isergi :))
		$data['from_date'] = fn_parse_date($to_date);
		$data['to_date'] = fn_parse_date($from_date, true);
	}
	
	if (!empty($promotion_id)) {
		db_query("UPDATE ?:promotions SET ?u WHERE promotion_id = ?i", $data, $promotion_id);
		db_query('UPDATE ?:promotion_descriptions SET ?u WHERE promotion_id = ?i AND lang_code = ?s', $data, $promotion_id, $lang_code);
	} else {
		$promotion_id = $data['promotion_id'] = db_query("REPLACE INTO ?:promotions ?e", $data);

		foreach ((array)Registry::get('languages') as $data['lang_code'] => $_v) {
			db_query("REPLACE INTO ?:promotion_descriptions ?e", $data);
		}
	}

	return $promotion_id;
}

function fn_promotions_check_group_conditions(&$conditions, $parents = array())
{
	static $schema = array();

	if (empty($schema)) {
		$schema = fn_promotion_get_schema();
	}

	if (!empty($conditions['set'])) {
		if (!empty($conditions['conditions'])) {
			$parents[] = array(
				'set_value' => $conditions['set_value'],
				'set' => $conditions['set']
			);

			fn_promotions_check_group_conditions($conditions['conditions'], $parents);
		}
	} else {
		foreach ($conditions as $k => $c) {
			if (!empty($c['conditions'])) {
				fn_promotions_check_group_conditions($conditions[$k]['conditions'], fn_array_merge($parents, array('set_value' => $c['set_value'], 'set' => $c['set']), false));

			} elseif (isset($c['condition']) && !empty($schema['conditions'][$c['condition']]['applicability']['group'])) {
				foreach ($parents as $_c) {
					if ($_c['set_value'] != $schema['conditions'][$c['condition']]['applicability']['group']['set_value']) {
						$msg = fn_get_lang_var('warning_promotions_incorrect_condition');
						$msg = str_replace(array('[condition]', '[set_value]'), array(fn_get_lang_var('promotion_cond_' . $c['condition']), fn_get_lang_var($_c['set_value'] == true ? 'true': 'false')), $msg);
						fn_set_notification('W', fn_get_lang_var('warning'), $msg);
						unset($conditions[$k]);
					}
				}
			}
		}
	}
}

?>
