<?php
/***************************************************************************
*                                                                          *
*    Copyright (c) 2009 Simbirsk Technologies Ltd. All rights reserved.    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/


//
// $Id: func.php 7745 2009-07-21 07:15:15Z alexions $
//

if ( !defined('AREA') ) { die('Access denied'); }


//
// Update sales stats for the product
//
function fn_bestsellers_change_order_status($status_to, $status_from, $order_info, $force_notification, $order_statuses)
{

	$product_ids = db_get_fields("SELECT product_id FROM ?:order_details WHERE order_id = ?i GROUP BY product_id", $order_info['order_id']);

	if ($order_statuses[$status_to]['inventory'] == 'D' && $order_statuses[$status_from]['inventory'] == 'I') {
		$increase = true;
	} elseif ($order_statuses[$status_to]['inventory'] == 'I' && $order_statuses[$status_from]['inventory'] == 'D') {
		$increase = false;
	} else {
		return true;
	}

	foreach ($product_ids as $product_id) {
		$cids = db_get_fields("SELECT category_id FROM ?:products_categories WHERE product_id = ?i", $product_id);
		if (!empty($cids)) {
			foreach ($cids as $cid) {
				$c_amount = db_get_field("SELECT amount FROM ?:product_sales WHERE category_id = ?i AND product_id = ?i", $cid, $product_id);
				$c_amount = ($increase == true) ? ($c_amount + 1) : ($c_amount - 1);
				db_query("REPLACE INTO ?:product_sales (category_id, product_id, amount) VALUES (?i, ?i, ?i)", $cid, $product_id, $c_amount);
			}
		}
	}

	return db_query("DELETE FROM ?:product_sales WHERE amount = 0");
}

function fn_bestsellers_delete_product($product_id)
{
	db_query("DELETE FROM ?:product_sales WHERE product_id = ?i", $product_id);

	return true;
}

function fn_bestsellers_get_products(&$params, &$fields, &$sortings, &$condition, &$join, &$sorting, &$group_by)
{
	if (!empty($params['bestsellers'])) {
		$fields[] = 'SUM(?:product_sales.amount) as sales_amount';
		$sortings['sales_amount'] = 'sales_amount';
		$join .= ' INNER JOIN ?:product_sales ON ?:product_sales.product_id = products.product_id AND ?:product_sales.category_id = products_categories.category_id ';
		$group_by = '?:product_sales.product_id';
		if (!empty($params['category_id'])) {
			$condition .= db_quote(" AND ?:product_sales.category_id = ?i", $params['category_id']);
		}
	} else {
		$join .= ' LEFT JOIN ?:product_sales ON ?:product_sales.product_id = products.product_id AND ?:product_sales.category_id = products_categories.category_id ';
	}
	
	if (!empty($params['sort_by'])) {
		if ($params['sort_by'] == 'bestsellers') {
			$sortings['bestsellers'] = '?:product_sales.amount';
		}
	}
	
	if (isset($params['sales_amount_from']) && is_numeric($params['sales_amount_from'])) {
		$condition .= db_quote(' AND ?:product_sales.amount >= ?i', $params['sales_amount_from']);
	}

	if (isset($params['sales_amount_to']) && is_numeric($params['sales_amount_to'])) {
		$condition .= db_quote(' AND ?:product_sales.amount <= ?i', $params['sales_amount_to']);
	}

	return true;
}

function fn_bestsellers_products_sorting($sorting)
{
	$sorting['bestsellers'] = array('description' => fn_get_lang_var('bestselling'), 'default_order' => 'desc');
}

function fn_bestsellers_update_product($product_data, $product_id)
{
	$category_id = empty($product_data['main_category']) ? db_get_field("SELECT category_id FROM ?:products_categories WHERE link_type='M' AND product_id = ?i", $product_id) : $product_data['main_category'];
	
	if (!empty($product_data['sales_amount'])) {
		$_data = array (
			'category_id' => $category_id,
			'product_id' => $product_id,
			'amount' => $product_data['sales_amount']
		);
		
		db_query("INSERT INTO ?:product_sales ?e ON DUPLICATE KEY UPDATE amount = ?i", $_data, intval($product_data['sales_amount']));
	}
}

function fn_bestsellers_get_product_data($product_id, $field_list, $join, $auth)
{
	$product_category = db_get_field("SELECT category_id FROM ?:products_categories WHERE product_id = ?i AND link_type = 'M'", $product_id);
	
	$field_list .= ", ?:product_sales.amount as sales_amount";
	$join .= db_quote(" LEFT JOIN ?:product_sales ON ?:product_sales.product_id = ?:products.product_id AND ?:product_sales.category_id = ?i", $product_category);
}

?>