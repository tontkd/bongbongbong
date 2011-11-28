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
// $Id: cart.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'cart_list') {
	$item_types = fn_get_cart_content_item_types();

	list($carts_list, $search) = fn_get_carts($_REQUEST);

	if (!empty($_REQUEST['user_id'])) {
		$cart_products = db_get_array("SELECT ?:user_session_products.item_id, ?:user_session_products.item_type, ?:user_session_products.product_id, ?:user_session_products.amount, ?:user_session_products.price, ?:product_descriptions.product FROM ?:user_session_products LEFT JOIN ?:product_descriptions ON ?:user_session_products.product_id = ?:product_descriptions.product_id AND ?:product_descriptions.lang_code = ?s WHERE ?:user_session_products.user_id = ?i AND ?:user_session_products.type = 'C' AND ?:user_session_products.item_type IN (?a)", DESCR_SL, $_REQUEST['user_id'], $item_types);

		$view->assign('cart_products', $cart_products);
		$view->assign('sl_user_id', $_REQUEST['user_id']);
	}

	if (!empty($carts_list) && is_array($carts_list)) {

		$all_cart_products = db_get_hash_array("SELECT user_id, SUM(amount) as count, SUM(amount) as sum, SUM(amount * price) as total FROM ?:user_session_products WHERE user_id IN (?n) AND type = 'C' AND item_type IN (?a) GROUP BY user_id", 'user_id', array_keys($carts_list), $item_types);
		foreach ($carts_list as $u_id => $cart) {
			if (!empty($all_cart_products[$u_id])) {
				$carts_list[$u_id]['cart_products'] = $all_cart_products[$u_id]['count'];
				$carts_list[$u_id]['cart_all_products'] = $all_cart_products[$u_id]['sum'];
				$carts_list[$u_id]['total'] = $all_cart_products[$u_id]['total'];
			}
		}
	}

	$view->assign('cart_list', $carts_list);
	$view->assign('search', $search);
}

function fn_get_carts($params)
{
	// Init filter
	$params = fn_init_view('carts', $params);

	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page'];

	// Define fields that should be retrieved
	$fields = array (
		'?:user_session_products.user_id',
		'?:users.firstname',
		'?:users.lastname',
	);

	// Define sort fields
	$sortings = array (
		'customer' => "CONCAT(?:users.firstname, ?:users.lastname)",
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'asc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by']= 'customer';
	}

	$sorting = $sortings[$params['sort_by']] . ' ' . $directions[$params['sort_order']];

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	$condition = $join = '';

	$group = " GROUP BY ?:user_session_products.user_id";

	if (!empty($params['cname'])) {
		$arr = explode(' ', $params['cname']);
		if (sizeof($arr) == 2) {
			$condition .= db_quote(" AND ?:users.firstname LIKE ?l AND ?:users.lastname LIKE ?l", "%$arr[0]%", "%$arr[1]%");
		} else {
			$condition .= db_quote(" AND (?:users.firstname LIKE ?l OR ?:users.lastname LIKE ?l)", "%$params[cname]%", "%$params[cname]%");
		}
	}

	if (!empty($params['email'])) {
		$condition .= db_quote(" AND ?:users.email LIKE ?l", "%$params[email]%");
	}

	if (!empty($params['user_id'])) {
		$condition .= db_quote(" AND ?:user_session_products.user_id = ?i", $params['user_id']);
	}

	if (!empty($params['online_only'])) {
		$join .= ' LEFT JOIN ?:sessions ON ?:sessions.session_id = ?:user_session_products.session_id';
		$condition .= db_quote(" AND ?:sessions.expiry > ?i", TIME + SESSION_ALIVE_TIME - 300);
	}

	if (!empty($params['total_from']) || !empty($params['total_to'])) {
		$having = '';
		if (!empty($params['total_from'])) {
			$having .= db_quote(" AND SUM(price * amount) >= ?d", $params['total_from']);
		}

		if (!empty($params['total_to'])) {
			$having .= db_quote(" AND SUM(price * amount) <= ?d", $params['total_to']);
		}

		if (!empty($having)) {
			$users4total = db_get_fields("SELECT user_id FROM ?:user_session_products HAVING 1 $having");
			if (!empty($users4total)) {
				$condition .= db_quote(" AND (?:user_session_products.user_id IN (?n))", $users4total);
			} else {
				$condition .= " AND (?:user_session_products.user_id = 'no')";
			}
		}
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);
		$condition .= db_quote(" AND (?:user_session_products.timestamp >= ?i AND ?:user_session_products.timestamp <= ?i)", $params['time_from'], $params['time_to']);
	}

	$_condition = array();
	if (!empty($params['product_type_c'])) {
		$_condition[] = "?:user_session_products.type = 'C'";
	}
	if (!empty($product_type_w) && $product_type_w == 'Y') {
		$_condition[] = "?:user_session_products.type = 'W'";
	}

	if (!empty($_condition)) {
		$condition .= " AND (" . implode(" OR ", $_condition).")";
	}

	if (!empty($params['p_ids']) || !empty($params['product_view_id'])) {
		$arr = (strpos($params['p_ids'], ',') !== false || !is_array($params['p_ids'])) ? explode(',', $params['p_ids']) : $params['p_ids'];
		if (empty($params['product_view_id'])) {
			$condition .= " AND ?:user_session_products.product_id IN ('" . implode("', '", $arr) . "')";
		} else {
			$condition .= " AND ?:user_session_products.product_id IN (" . fn_get_products(array('view_id' => $params['product_view_id'], 'get_query' => true)) . ")";
		}

		$group .=  " HAVING COUNT(?:user_session_products.user_id) >= " . count($arr);
	}

	$join .= " LEFT JOIN ?:users ON ?:user_session_products.user_id = ?:users.user_id";

	$total = db_get_field("SELECT COUNT(DISTINCT ?:user_session_products.user_id) FROM ?:user_session_products $join WHERE 1 $condition");
	$limit = fn_paginate($params['page'], $total);

	$carts_list = db_get_hash_array("SELECT " . implode(', ', $fields) . " FROM ?:user_session_products $join WHERE 1 $condition $group ORDER BY $sorting $limit", 'user_id');

	return array($carts_list, $params);
}

?>
