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
// $Id: products.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'picker') {

	$params = $_REQUEST;
	$params['type'] = 'extended';

	list($products, $search) = fn_get_products($params, AREA == 'C' ? Registry::get('settings.Appearance.products_per_page') : Registry::get('settings.Appearance.admin_products_per_page'));

	if (!empty($_REQUEST['display']) || (AREA == 'C' && !defined('EVENT_OWNER'))) {
		foreach ($products as $k => $v) {
			fn_gather_additional_product_data($products[$k], true, false, true, true);
		}
	}

	if (!empty($products)){
		foreach($products as $k=>$v){
			$products[$k]['options'] = fn_get_product_options($v['product_id'], DESCR_SL, true, false, true);
			$products[$k]['exceptions'] = fn_get_product_exceptions($v['product_id']);
			if (!empty($products[$k]['exceptions'])) {
				foreach($products[$k]['exceptions'] as $v) {
					$products[$k]['exception_combinations'][fn_get_options_combination($v['combination'])] = '';
				}
			}
		}
	}

	$view->assign('products', $products);
	$view->assign('search', $search);

	$view->display('pickers/products_picker_contents.tpl');
	exit;

}

?>
