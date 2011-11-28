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
// $Id: product_filters.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update') {
		fn_update_product_filter($_REQUEST['filter_data'], $_REQUEST['filter_id'], DESCR_SL);
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=product_filters.manage");
}

if ($mode == 'manage') {

	$filters = fn_get_product_filters();
	if (!empty($filters)) {
		$view->assign('filters', $filters);
	}

	$view->assign('filter_features', fn_get_product_features(array('variants' => true, 'plain' => true, 'feature_types' => array('S', 'E', 'N', 'M', 'O', 'D')), DESCR_SL));

} elseif ($mode == 'update') {

	$params = $_REQUEST;
	$params['get_fields'] = true;

	$filters = fn_get_product_filters($params);
	$view->assign('filter', array_shift($filters));

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['filter_id'])) {
		fn_delete_product_filter($_REQUEST['filter_id']);
		$_filters = fn_get_product_filters();
		if (empty($_filters)) {
			$view->display('views/product_filters/manage.tpl');
		}
	}
	exit;
}

function fn_update_product_filter($filter_data, $filter_id, $lang_code = DESCR_SL)
{
	// Parse filter type
	if (strpos($filter_data['filter_type'], 'FF-') === 0 || strpos($filter_data['filter_type'], 'RF-') === 0)	{
		$filter_data['feature_id'] = str_replace(array('RF-', 'FF-'), '', $filter_data['filter_type']);
		$filter_data['feature_type'] = db_get_field("SELECT feature_type FROM ?:product_features WHERE feature_id = ?i", $filter_data['feature_id']);
	} else {
		$filter_data['field_type'] = str_replace(array('R-', 'B-'), '', $filter_data['filter_type']);
		$filter_fields = fn_get_product_filter_fields();
	}

	if (!empty($filter_id)) {
		db_query('UPDATE ?:product_filters SET ?u WHERE filter_id = ?i', $filter_data, $filter_id);
		db_query('UPDATE ?:product_filter_descriptions SET ?u WHERE filter_id = ?i AND lang_code = ?s', $filter_data, $filter_id, $lang_code);
	} else {
		$filter_data['filter_id'] = $filter_id = db_query('INSERT INTO ?:product_filters ?e', $filter_data);
		foreach (Registry::get('languages') as $filter_data['lang_code'] => $_d) {
			db_query("INSERT INTO ?:product_filter_descriptions ?e", $filter_data);
		}
	}

	// if filter has ranges
	if ((!empty($filter_data['feature_type']) && strpos('ODN', $filter_data['feature_type']) !== false) || (!empty($filter_data['field_type']) && !empty($filter_fields[$filter_data['field_type']]['is_range']))) {
	
		$range_ids = array();
		foreach ($filter_data['ranges'] as $range) {
			if (!empty($filter_data['feature_type']) && $filter_data['feature_type'] == 'D') {
				$range['to'] = fn_parse_date($range['to']);
				$range['from'] = fn_parse_date($range['from']);
			}

			$range['filter_id'] = $filter_id;
			if (!empty($filter_data['feature_id'])) {
				$range['feature_id'] = $filter_data['feature_id'];
			}

			if (!empty($range['range_id'])) {
				db_query("UPDATE ?:product_filter_ranges SET ?u WHERE range_id = ?i", $range, $range_id);
				db_query('UPDATE ?:product_filter_ranges_descriptions SET ?u WHERE range_id = ?i AND lang_code = ?s', $range, $range_id, $lang_code);

			} elseif ((!empty($range['from']) || !empty($range['to'])) && !empty($range['range_name'])) {
				$range['range_id'] = db_query("INSERT INTO ?:product_filter_ranges ?e", $range);
				foreach (Registry::get('languages') as $range['lang_code'] => $_d) {
					db_query("INSERT INTO ?:product_filter_ranges_descriptions ?e", $range);
				}
			}

			if (!empty($range['range_id'])) {
				$range_ids[] = $range['range_id'];
			}
		}

		if (!empty($range_ids)) {
			$deleted_ranges = db_get_fields("SELECT range_id FROM ?:product_filter_ranges WHERE filter_id = ?i AND range_id NOT IN (?n)", $filter_id, $range_ids);
			if (!empty($deleted_ranges)) {
				db_query("DELETE FROM ?:product_filter_ranges WHERE range_id IN (?n)", $deleted_ranges);
				db_query("DELETE FROM ?:product_filter_ranges_descriptions WHERE range_id IN (?n)", $deleted_ranges);
			}
		}
	} else {
		$deleted_ranges = db_get_fields("SELECT range_id FROM ?:product_filter_ranges WHERE filter_id = ?i", $filter_id);
		db_query("DELETE FROM ?:product_filter_ranges WHERE filter_id = ?i", $filter_id);
		db_query("DELETE FROM ?:product_filter_ranges_descriptions WHERE range_id IN (?n)", $deleted_ranges);
	}

	return $filter_id;
}

?>
