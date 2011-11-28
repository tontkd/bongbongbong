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
// $Id: product_features.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

fn_define('KEEP_UPLOADED_FILES', true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	fn_trusted_vars ('feature_data');

	// Update features
	if ($mode == 'update') {
		fn_update_product_feature($_REQUEST['feature_data'], $_REQUEST['feature_id'], DESCR_SL);
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=product_features.manage");
}

if ($mode == 'update') {

	$view->assign('feature', fn_get_product_feature_data($_REQUEST['feature_id'], true, true, DESCR_SL));
	$view->assign('group_features', fn_get_product_features(array('feature_type' => 'G'), DESCR_SL));

} elseif ($mode == 'delete') {

	if (!empty($_REQUEST['feature_id'])) {
		fn_delete_feature($_REQUEST['feature_id']);
		$_features = fn_get_product_features(array('variants' => true, 'statuses' => array('A', 'D', 'H')), DESCR_SL);
		if (empty($_features)) {
			$view->display('views/product_features/manage.tpl');
		}
	}
	exit;

} elseif ($mode == 'manage') {

	$view->assign('features', fn_get_product_features(array('variants' => true, 'statuses' => array('A', 'D', 'H')), DESCR_SL));
	$view->assign('group_features', fn_get_product_features(array('feature_types' => 'G'), DESCR_SL));
}

function fn_delete_feature($feature_id)
{
	$feature_type = db_get_field("SELECT feature_type FROM ?:product_features WHERE feature_id = ?i", $feature_id);

	if ($feature_type == 'G') {
		$fids = db_get_fields("SELECT feature_id FROM ?:product_features WHERE parent_id = ?i", $feature_id);

		if (!empty($fids)) {
			foreach ($fids as $fid) {
				fn_delete_feature($fid);
			}
		}
	}

	db_query("DELETE FROM ?:product_features WHERE feature_id = ?i", $feature_id);
	db_query("DELETE FROM ?:product_features_descriptions WHERE feature_id = ?i", $feature_id);
	db_query("DELETE FROM ?:product_features_values WHERE feature_id = ?i", $feature_id);

	$v_ids = db_get_fields("SELECT variant_id FROM ?:product_feature_variants WHERE feature_id = ?i", $feature_id);
	// Delete variant images
	foreach ($v_ids as $v_id) {
		fn_delete_image_pairs($v_id, 'feature_variant');
	}
	
	db_query("DELETE FROM ?:product_feature_variants WHERE feature_id = ?i", $feature_id);
	db_query("DELETE FROM ?:product_feature_variant_descriptions WHERE variant_id IN (?n)", $v_ids);

	$filter_ids = db_get_fields("SELECT filter_id FROM ?:product_filters WHERE feature_id = ?i", $feature_id);
	foreach ($filter_ids as $_filter_id) {
		fn_delete_product_filter($_filter_id);
	}
}

function fn_update_product_feature($feature_data, $feature_id, $lang_code = DESCR_SL)
{
	$deleted_variants = array();

	// If this feature belongs to the group, get categories assignment from this group
	if (!empty($feature_data['parent_id'])) {
		$feature_data['categories_path'] = db_get_field("SELECT categories_path FROM ?:product_features WHERE feature_id = ?i", $feature_data['parent_id']);
	}

	if (!intval($feature_id)) { // check for intval as we use "0G" for new group
		$feature_data['feature_id'] = $feature_id = db_query("INSERT INTO ?:product_features ?e", $feature_data);
		foreach (Registry::get('languages') as $feature_data['lang_code'] => $_d) {
			db_query("INSERT INTO ?:product_features_descriptions ?e", $feature_data);
		}
	} else {
		db_query("UPDATE ?:product_features SET ?u WHERE feature_id = ?i", $feature_data, $feature_id);
		db_query('UPDATE ?:product_features_descriptions SET ?u WHERE feature_id = ?i AND lang_code = ?s', $feature_data, $feature_id, $lang_code);
	}

	// If this feature is group, set its categories to all children
	if ($feature_data['feature_type'] == 'G') {
		db_query("UPDATE ?:product_features SET categories_path = ?s WHERE parent_id = ?i", $feature_data['categories_path'], $feature_id);
	}

	// Delete variants for simple features
	if (strpos('SMNE', $feature_data['feature_type']) === false) {
		$var_ids = db_get_fields("SELECT variant_id FROM ?:product_feature_variants WHERE feature_id = ?i", $feature_id);
		if (!empty($var_ids)) {
			db_query("DELETE FROM ?:product_feature_variants WHERE variant_id IN (?n)", $var_ids);
			db_query("DELETE FROM ?:product_feature_variant_descriptions WHERE variant_id IN (?n)", $var_ids);
			db_query("DELETE FROM ?:product_features_values WHERE variant_id IN (?n)", $var_ids);
			foreach ($var_ids as $v_id) {
				fn_delete_image_pairs($v_id, 'feature_variant');
			}
		}

	} elseif (!empty($feature_data['variants'])) {
		$var_ids = array();

		foreach ($feature_data['variants'] as $k => $v) {
			if (empty($v['variant'])) {
				continue;
			}
			$v['feature_id'] = $feature_id;

			if (empty($v['variant_id'])) {
				$v['variant_id'] = db_query("INSERT INTO ?:product_feature_variants ?e", $v);
				foreach (Registry::get('languages') as $v['lang_code'] => $_v) {
					db_query("INSERT INTO ?:product_feature_variant_descriptions ?e", $v);
				}
			} else {
				db_query("UPDATE ?:product_feature_variants SET ?u WHERE variant_id = ?i", $v, $v['variant_id']);
				db_query("UPDATE ?:product_feature_variant_descriptions SET ?u WHERE variant_id = ?i AND lang_code = ?s", $v, $v['variant_id'], $lang_code);
			}

			if ($feature_data['feature_type'] == 'N') { // number
				db_query('UPDATE ?:product_features_values SET ?u WHERE variant_id = ?i AND lang_code = ?s', array('value_int' => $v['variant']), $v['variant_id'], $lang_code);
			}

			$var_ids[] = $v['variant_id'];
			$feature_data['variants'][$k]['variant_id'] = $v['variant_id']; // for addons

			fn_attach_image_pairs('variant_image', 'feature_variant', 0, array($k => $v['variant_id']));
		}

		// Delete obsolete variants
		$deleted_variants = db_get_fields("SELECT variant_id FROM ?:product_feature_variants WHERE feature_id = ?i AND variant_id NOT IN (?n)", $feature_id, $var_ids);

		if (!empty($deleted_variants)) {
			db_query("DELETE FROM ?:product_feature_variants WHERE variant_id IN (?n)", $deleted_variants);
			db_query("DELETE FROM ?:product_feature_variant_descriptions WHERE variant_id IN (?n)", $deleted_variants);
			db_query("DELETE FROM ?:product_features_values WHERE variant_id IN (?n)", $deleted_variants);
			foreach ($deleted_variants as $v_id) {
				fn_delete_image_pairs($v_id, 'feature_variant');
			}
		}
	}

	fn_set_hook('update_product_feature', $feature_data, $feature_id, $deleted_variants);

	return $feature_id;
}

?>
