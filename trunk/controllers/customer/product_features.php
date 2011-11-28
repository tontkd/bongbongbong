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
// $Id: product_features.php 7786 2009-08-04 15:11:03Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if (empty($action)) {
	$action = 'show_all';
}

$list = 'features';

if (empty($_SESSION['excluded_features'])) {
	$_SESSION['excluded_features'] = array();
}

if (empty($_SESSION['excluded_features'])) {
	$_SESSION['excluded_features'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Add feature to comparison list
	if ($mode == 'add_feature') {
		if (!empty($_REQUEST['add_features'])) {
			$_SESSION['excluded_features'] = array_diff($_SESSION['excluded_features'], $_REQUEST['add_features']);
		}
	}

	return array(CONTROLLER_STATUS_OK);
}


// Add product to comparison list
if ($mode == 'add_product') {
	if (empty($_SESSION['comparison_list'])) {
		$_SESSION['comparison_list'] = array();
	}

	if (!in_array($_REQUEST['product_id'], $_SESSION['comparison_list'])) {
		array_unshift($_SESSION['comparison_list'], $_REQUEST['product_id']);
	}

	$msg = fn_get_lang_var('text_product_added_to');
	$msg = str_replace('[target]', strtolower(fn_get_lang_var('comparison_list')), $msg);
	fn_set_notification('N', fn_get_lang_var('notice'), $msg);

	if (defined('AJAX_REQUEST')) {
		$compared_products = array();
		$_tmp = db_get_hash_array("SELECT product_id, product FROM ?:product_descriptions WHERE product_id IN (?n) AND lang_code = ?s", 'product_id', $_SESSION['comparison_list'], CART_LANGUAGE);
		foreach ($_SESSION['comparison_list'] as $p_id) {
			$compared_products[] = $_tmp[$p_id];
		}
		$view->assign('compared_products', $compared_products);
		$view->assign('new_product', $_REQUEST['product_id']);
		$view->display('blocks/feature_comparison.tpl');
		exit;
	}

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'clear_list') {
	unset($_SESSION['comparison_list']);
	unset($_SESSION['excluded_features']);

	if (defined('AJAX_REQUEST')) {
		$view->assign('compared_products', array());
		$view->display('blocks/feature_comparison.tpl');
		exit;
	}

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'delete_product' && !empty($_REQUEST['product_id'])) {
	$key = array_search ($_REQUEST['product_id'], $_SESSION['comparison_list']);
	unset($_SESSION['comparison_list'][$key]);

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'delete_feature') {
	$_SESSION['excluded_features'][] = $_REQUEST['feature_id'];

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'compare') {
	fn_add_breadcrumb(fn_get_lang_var('feature_comparison'));
	if (!empty($_SESSION['comparison_list'])) {
		$view->assign('comparison_data', fn_get_product_data_for_compare($_SESSION['comparison_list'], $action));
	}
	$view->assign('list', $list);
	$view->assign('action', $action);

	if (!empty($_SESSION['continue_url'])) {
		$view->assign('continue_url', $_SESSION['continue_url']);
	}

} elseif ($mode == 'view_all') {

	parse_str(substr($_REQUEST['q'], strpos($_REQUEST['q'], '?') + 1), $params);

	$params['view_all'] = 'Y';
	$params['get_custom'] = 'Y';

	if (!empty($params['category_id'])) {
		$parent_ids = explode('/', db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $params['category_id']));

		if (!empty($parent_ids)) {
			$cats = fn_get_category_name($parent_ids);
			foreach($cats as $c_id => $c_name) {
				fn_add_breadcrumb($c_name, "$index_script?dispatch=categories.view&category_id=$c_id");
			}
		}
	}

	list( , $view_all_filter) = fn_get_filters_products_count($params);

	fn_add_breadcrumb(db_get_field("SELECT filter FROM ?:product_filter_descriptions WHERE filter_id = ?i AND lang_code = ?s", $params['filter_id'], CART_LANGUAGE));

	$view->assign('params', $params);
	$view->assign('view_all_filter', $view_all_filter);

} elseif ($mode == 'view') {

	fn_define('FILTER_BLOCKING_VARIANT', true); // this constant means that extended features on this page should be displayed as simple

	$variant_data = fn_get_product_feature_variant($_REQUEST['variant_id']);
	$view->assign('variant_data', $variant_data);

	if (!empty($_REQUEST['features_hash']) || !empty($_REQUEST['advanced_filter'])) {
		fn_add_breadcrumb($variant_data['variant'], "$index_script?dispatch=product_features.view&variant_id=$_REQUEST[variant_id]");
		fn_add_filter_ranges_breadcrumbs($_REQUEST, "$index_script?dispatch=product_features.view&variant_id=$_REQUEST[variant_id]");
	} else {
		fn_add_breadcrumb($variant_data['variant']);
	}

	// Override meta description/keywords
	if (!empty($variant_data['meta_description']) || !empty($variant_data['meta_keywords'])) {
		$view->assign('meta_description', $variant_data['meta_description']);
		$view->assign('meta_keywords', $variant_data['meta_keywords']);
	}

	// Override page title
	if (!empty($variant_data['page_title'])) {
		$view->assign('page_title', $variant_data['page_title']);
	}

	fn_define('FILTER_CUSTOM_ADVANCED', true); // this constant means that extended filtering should be stayed on the same page

	$params = $_REQUEST;
	$params['features_hash'] = (!empty($params['features_hash']) ? ($params['features_hash'] . '.') : '') . 'V' . $params['variant_id'];

	if (!empty($params['advanced_filter']) && $params['advanced_filter'] == 'Y') {
		fn_add_breadcrumb(fn_get_lang_var('advanced_filter'));
		list($filters) = fn_get_filters_products_count($params);
		$view->assign('filter_features', $filters);
	}

	// Get products
	$params['type'] = 'extended';
	list($products, $search) = fn_get_products($params, Registry::get('settings.Appearance.products_per_page'));

	if (!empty($products)) {
		foreach ($products as $k => $v) {
			fn_gather_additional_product_data($products[$k], true, false, true, true, true);
		}
	}

	$view->assign('products', $products);
	$view->assign('search', $search);
}

function fn_get_product_data_for_compare($product_ids, $action)
{
	$auth = & $_SESSION['auth'];

	$comparison_data = array();
	$tmp = array();
	foreach ($product_ids as $product_id) {

		$product_data['product_id'] = $product_id;
		$product_data['product'] = fn_get_product_name($product_id);
		$product_data['zero_price_action'] = db_get_field("SELECT zero_price_action FROM ?:products WHERE product_id = ?i", $product_id);

		$product_data['price'] = fn_get_product_price($product_id, 1, $auth);

		fn_gather_additional_product_data($product_data, true, false, false, true, false);

		$product_data['features'] = fn_get_product_features_list($product_id, 'CP');

		if (!empty($product_data['features'])) {
			foreach ($product_data['features'] as $k => $v) {
				if (in_array($k, $_SESSION['excluded_features'])) {
					unset($product_data['features'][$k]);
					continue;
				}

				if (empty($comparison_data['features'][$k])) {
					$comparison_data['features'][$k] = db_get_field("SELECT description FROM ?:product_features_descriptions WHERE feature_id = ?i AND lang_code = ?s", $k, CART_LANGUAGE);
				}
			}
		}

		$comparison_data['products'][] = $product_data;
		unset($product_data);
	}

	if ($action != 'show_all' && !empty($comparison_data['features'])) {
		$value = '';
		foreach ($comparison_data['features'] as $feature_id => $v) {
			unset($value);
			$c = ($action == 'similar_only') ? true : false;
			foreach ($comparison_data['products'] as $product) {
				if (empty($product['features'][$feature_id])) {
					$c = !$c;
					break;
				}
				if (!isset($value)) {
					$value = in_array($product['features'][$feature_id]['feature_type'], array('S','M', 'N', 'E')) ? $product['features'][$feature_id]['variant_id'] : $product['features'][$feature_id]['value'];
					continue;
				} elseif ($value != (in_array($product['features'][$feature_id]['feature_type'], array('S','M', 'N', 'E')) ? $product['features'][$feature_id]['variant_id'] : $product['features'][$feature_id]['value'])) {
					$c = !$c;
					break;
				}
			}

			if ($c == false) {
				unset($comparison_data['features'][$feature_id]);
			}
		}
	}

	return $comparison_data;

}

?>
