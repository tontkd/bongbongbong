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
// $Id: search.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'results') {
	$params = $_REQUEST;
	$params['objects'] = array_keys(fn_search_get_customer_objects());

	list($search_results, $search, $total) = fn_search($params, Registry::get('settings.Appearance.products_per_page'));

	$view->assign('search_results', $search_results);
	$view->assign('search', $search);
	$view->assign('search_results_total', $total);

	fn_add_breadcrumb(fn_get_lang_var('search_results'));
}
?>