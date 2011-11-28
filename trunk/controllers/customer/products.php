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
// $Id: products.php 7763 2009-07-29 13:19:43Z alexions $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Search products
//
if ($mode == 'search') {

	$params = $_REQUEST;
	unset($params['dispatch'], $params['advanced_filter']);

	if (sizeof($params) > 0) { // perform search if at least one parameter passed

		fn_add_breadcrumb(fn_get_lang_var('advanced_search'), "$index_script?dispatch=products.search" . (!empty($_REQUEST['advanced_filter']) ? '&advanced_filter=Y' : ''));
		fn_add_breadcrumb(fn_get_lang_var('search_results'));
		$params = $_REQUEST;
		$params['type'] = 'extended';
		list($products, $search, $products_count) = fn_get_products($params, Registry::get('settings.Appearance.products_per_page'));

		if (!empty($products)) {
			foreach ($products as $k => $v) {
				fn_gather_additional_product_data($products[$k], true);
			}
		}

		if (Registry::get('settings.General.extended_product_features_search') == 'Y') {
			$view->assign('product_features', fn_get_product_features(array('statuses' => array('A')), CART_LANGUAGE));
		}

		if (!empty($products)) {
			$_SESSION['continue_url'] = Registry::get('config.current_url');
		}

		$selected_layout = fn_get_products_layout($params);

		$view->assign('products', $products);
		$view->assign('search', $search);
		$view->assign('product_count', $products_count);
		$view->assign('selected_layout', $selected_layout);
	} else {
		fn_add_breadcrumb(fn_get_lang_var('advanced_search'));
	}

	if (!empty($_REQUEST['advanced_filter'])) {
		list($filters, $view_all_filter) = fn_get_filters_products_count($_REQUEST);
		$view->assign('filter_features', $filters);
		$view->assign('view_all_filter', $view_all_filter);
	}

//
// View product details
//
} elseif ($mode == 'view') {

	$product = fn_get_product_data($_REQUEST['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);

	if (empty($product)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	if (empty($_SESSION['current_category_id']) || empty($product['category_ids'][$_SESSION['current_category_id']])) {
		$_SESSION['current_category_id'] = $product['main_category'];
	}

	if (!empty($product['meta_description']) || !empty($product['meta_keywords'])) {
		$view->assign('meta_description', $product['meta_description']);
		$view->assign('meta_keywords', $product['meta_keywords']);

	} else {
		$meta_tags = db_get_row("SELECT meta_description, meta_keywords FROM ?:category_descriptions WHERE category_id = ?i AND lang_code = ?s", $_SESSION['current_category_id'], CART_LANGUAGE);
		if (!empty($meta_tags)) {
			$view->assign('meta_description', $meta_tags['meta_description']);
			$view->assign('meta_keywords', $meta_tags['meta_keywords']);
		}
	}

	$_SESSION['continue_url'] = "$index_script?dispatch=categories.view&category_id=$_SESSION[current_category_id]";

	$parent_ids = explode('/', db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $_SESSION['current_category_id']));
	if (!empty($parent_ids)) {
		$cats = fn_get_category_name($parent_ids);
		foreach($cats as $c_id => $c_name) {
			fn_add_breadcrumb($c_name, "$index_script?dispatch=categories.view&category_id=$c_id");
		}
	}

	fn_add_breadcrumb($product['product']);

	if (!empty($_REQUEST['combination'])) {
		$product['combination'] = $_REQUEST['combination'];
	}

	fn_gather_additional_product_data($product, true, true);
	$view->assign('product', $product);

	// If page title for this product is exist than assign it to template
	if (!empty($product['page_title'])) {
		$view->assign('page_title', $product['page_title']);
	}

	Registry::set('navigation.tabs.description', array (
		'title' => fn_get_lang_var('description'),
		'js' => true
	));

	if (!empty($product['product_features'])) {
		Registry::set('navigation.tabs.features', array (
			'title' => fn_get_lang_var('features'),
			'js' => true
		));
	}

	$files = fn_get_product_files($_REQUEST['product_id'], true);

	if (!empty($files)) {
		Registry::set('navigation.tabs.files', array (
			'title' => fn_get_lang_var('files'),
			'js' => true
		));
		$view->assign('files', $files);
	}

	/* [Block manager tabs] */
	$_blocks = $view->get_var('blocks');
	$tab_blocks = array ();
	foreach ($_blocks as $block) {
		if (!empty($block['properties']['positions']) && $block['properties']['positions'] == 'product_details') {
			Registry::set('navigation.tabs.block_' . $block['block_id'], array (
				'title' => $block['block'],
				'js' => true
			));
			$tab_blocks[] = $block;
		}
	}
	$view->assign('tab_blocks', $tab_blocks);
	/* [/Block manager tabs] */

	// Set recently viewed products history
	if (!empty($_SESSION['recently_viewed_products']) && !in_array($_REQUEST['product_id'], $_SESSION['recently_viewed_products'])) {
		array_unshift($_SESSION['recently_viewed_products'], $_REQUEST['product_id']);

	} elseif (empty($_SESSION['recently_viewed_products'])) {
		$_SESSION['recently_viewed_products'] = array($_REQUEST['product_id']);
	}

	if (count($_SESSION['recently_viewed_products']) > MAX_RECENTLY_VIEWED) {
		array_pop($_SESSION['recently_viewed_products']);
	}
	
	// Increase product popularity
	if (!empty($_REQUEST['product_id'])) {
		$_data = array (
			'product_id' => $_REQUEST['product_id'],
			'viewed' => 1,
			'total' => POPULARITY_VIEW
		);
		
		db_query("INSERT INTO ?:product_popularity ?e ON DUPLICATE KEY UPDATE viewed = viewed + 1, total = total + ?i", $_data, POPULARITY_VIEW);
	}
}

?>
