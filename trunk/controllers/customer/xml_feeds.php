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
// $Id: xml_feeds.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$xml = '<?xml version="1.0" encoding="'. CHARSET .'"?>';

// Products management
if ($mode == 'get_products') {

	list($products) = fn_get_products($_REQUEST, Registry::get('settings.Appearance.products_per_page'));

	if (!empty($products)) {
		foreach ($products as $k => $v) {
			fn_gather_additional_product_data($products[$k], true);
		}
	}

	$xml .= fn_array_to_xml($products, 'products');
}

//
// View product details
//
if ($mode == 'get_product') {
	$product = fn_get_product_data($product_id, $auth, CART_LANGUAGE);
	if (!empty($product)) {
		if (!empty($combination)) {
			$product['combination'] = $combination;
		}

		fn_gather_additional_product_data($product, true, true);

		$xml .= fn_array_to_xml($product, 'product_data');
	}
}

if ($mode == 'get_categories') {
	$params = array (
		'category_id' => $category_id,
		'visible' => false,
		'plain' => (!empty($format) && $format == 'plain') ? true : false
	);
	list($categories, ) = fn_get_categories($params, CART_LANGUAGE);
	$xml .= fn_array_to_xml($categories, 'categories');
}

if ($mode == 'get_category') {
	$category_data = fn_get_category_data($category_id, '*');
	$xml .= fn_array_to_xml($category_data, 'category_data');
}

echo $xml;
exit;


function fn_array_to_xml(&$array, $name)
{
	$xml = "<$name>";
	$subname = 'item';

	foreach ($array as $k => $v) {
		if (!is_array($v)) {
			$param = is_int($k) ? $subname : $k;
			$id = is_int($k) ? " id=\"$k\"" : '';
			$xml .= "<$param$id>";
			$xml .= htmlspecialchars($v);
			$xml .= "</$param>";
		} else {
			$param = is_int($k) ? $subname : $k;
			$xml .= fn_array_to_xml($v, $param);
		}
	}

	$xml .= "</$name>";

	return $xml;
}

?>
