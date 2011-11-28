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
// $Id: categories.php 7838 2009-08-14 15:02:20Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'catalog') {
	fn_add_breadcrumb(fn_get_lang_var('catalog'));

	$root_categories = fn_get_subcategories(0);

	foreach ($root_categories as $k => $v) {
		$root_categories[$k]['main_pair'] = fn_get_image_pairs($v['category_id'], 'category', 'M', true, false);
	}

	$view->assign('root_categories', $root_categories);

} elseif ($mode == 'view') {

	$_statuses = array('A', 'H');
	$is_avail = db_get_field("SELECT category_id FROM ?:categories WHERE category_id = ?d AND membership_id IN(?n) AND status IN (?a)", $_REQUEST['category_id'], array(0, $auth['membership_id']), $_statuses);

	$loc_condition = fn_get_localizations_condition('localization', true);
	$is_avail = db_get_field("SELECT category_id FROM ?:categories WHERE category_id = ?d AND membership_id IN(?n) AND status IN (?a) ?p", $_REQUEST['category_id'], array(0, $auth['membership_id']), $_statuses, $loc_condition);

	if (!empty($is_avail)) {

		// Save current url to session for 'Continue shopping' button
		$_SESSION['continue_url'] = "$index_script?dispatch=categories.view&category_id=$_REQUEST[category_id]";

		// Save current category id to session
		$_SESSION['current_category_id'] = $_REQUEST['category_id'];

		// Get subcategories list for current category
		$view->assign('subcategories', fn_get_subcategories($_REQUEST['category_id']));

		// Get full data for current category
		$category_data = fn_get_category_data($_REQUEST['category_id'], CART_LANGUAGE, '*');

		if (!empty($category_data['meta_description']) || !empty($category_data['meta_keywords'])) {
			$view->assign('meta_description', $category_data['meta_description']);
			$view->assign('meta_keywords', $category_data['meta_keywords']);
		}

		$params = $_REQUEST;
		$params['cid'] = $_REQUEST['category_id'];
		$params['type'] = 'extended';
		if (Registry::get('settings.General.show_products_from_subcategories') == 'Y') {
			$params['subcats'] = 'Y';
		}

		list($products, $search) = fn_get_products($params, Registry::get('settings.Appearance.products_per_page'));

		if (!empty($products)) {
			foreach ($products as $k => $v) {
				fn_gather_additional_product_data($products[$k], true, false, true, true, true);
			}
		}

		$selected_layout = fn_get_products_layout($_REQUEST);

		$view->assign('products', $products);
		$view->assign('search', $search);
		$view->assign('selected_layout', $selected_layout);

		$view->assign('category_data', $category_data);

		// If page title for this category is exist than assign it to template
		if (!empty($category_data['page_title'])) {
			 $view->assign('page_title', $category_data['page_title']);
		}

		fn_define('FILTER_CUSTOM_ADVANCED', true); // this constant means that extended filtering should be stayed on the same page

		if (!empty($_REQUEST['advanced_filter']) && $_REQUEST['advanced_filter'] == 'Y') {
			list($filters) = fn_get_filters_products_count($_REQUEST);
			$view->assign('filter_features', $filters);
		}

		// [Breadcrumbs]
		$parent_ids = explode('/', $category_data['id_path']);
		array_pop($parent_ids);

		if (!empty($parent_ids)) {
			$cats = fn_get_category_name($parent_ids);
			foreach($cats as $c_id => $c_name) {
				fn_add_breadcrumb($c_name, "$index_script?dispatch=categories.view&category_id=$c_id");
			}
		}

		fn_add_breadcrumb($category_data['category'], (empty($_REQUEST['features_hash']) && empty($_REQUEST['advanced_filter'])) ? '' : "$index_script?dispatch=categories.view&category_id=$_REQUEST[category_id]");

		if (!empty($params['features_hash'])) {
			fn_add_filter_ranges_breadcrumbs($params, "$index_script?dispatch=categories.view&category_id=$_REQUEST[category_id]");
		} elseif (!empty($_REQUEST['advanced_filter'])) {
			fn_add_breadcrumb(fn_get_lang_var('advanced_filter'));
		}

		// [/Breadcrumbs]
	} else {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

} elseif ($mode == 'picker') {

	$category_count = db_get_field("SELECT COUNT(*) FROM ?:categories");
	$category_id = empty($_REQUEST['category_id']) ? 0 : $_REQUEST['category_id'];
	if ($category_count < CATEGORY_SHOW_ALL) {
		$params = array (
			'simple' => false
		);
 		list($categories_tree, ) = fn_get_categories($params);
 		$view->assign('show_all', true);
	} else {
		$params = array (
			'category_id' => $category_id,
			'visible' => true,
			'simple' => false
		);
		list($categories_tree, ) = fn_get_categories($params);
	}
	if (!empty($_REQUEST['root'])) {
		array_unshift($categories_tree, array('category_id' => 0, 'category' => $_REQUEST['root']));
	}
	$view->assign('categories_tree', $categories_tree);
	if ($category_count < CATEGORY_THRESHOLD) {
		$view->assign('expand_all', true);
	}
	if (defined('AJAX_REQUEST')) {
		$view->assign('category_id', $category_id);
	}
	$view->display('pickers/categories_picker_contents.tpl');
	exit;
}

?>