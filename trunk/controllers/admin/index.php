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
// $Id: index.php 7688 2009-07-10 05:58:05Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

// Generate dashboard
if ($mode == 'index') {
	$latest_orders = db_get_array("SELECT order_id, timestamp, firstname, lastname, total, user_id, status FROM ?:orders ORDER BY timestamp DESC LIMIT 10");

	// Collect orders information
	$today = getdate(TIME);
	$orders_stats = array();
	$orders_stats['daily_orders'] = db_get_hash_array("SELECT status, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i GROUP BY status", 'status', mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']), TIME);
	$orders_stats['daily_orders']['totals'] = db_get_row("SELECT SUM(IF(status = 'C' OR status = 'P', total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i", mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']), TIME);

	$wday = empty($today['wday']) ? "6" : (($today['wday'] == 1) ? "0" : $today['wday'] - 1);
	$wstart = getdate(strtotime("-$wday day"));
	$orders_stats['weekly_orders'] = db_get_hash_array("SELECT status, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i GROUP BY status", 'status', mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']), TIME);
	$orders_stats['weekly_orders']['totals'] = db_get_row("SELECT SUM(IF(status = 'C' OR status = 'P', total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i", mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']), TIME);

	$orders_stats['monthly_orders'] = db_get_hash_array("SELECT status, COUNT(*) as amount, SUM(total) as total FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i GROUP BY status", 'status', mktime(0, 0, 0, $today['mon'], 1, $today['year']), TIME);
	$orders_stats['monthly_orders']['totals'] = db_get_row("SELECT SUM(IF(status = 'C' OR status = 'P', total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i  AND timestamp <= ?i", mktime(0, 0, 0, $today['mon'], 1, $today['year']), TIME);

	$orders_stats['year_orders'] = db_get_hash_array("SELECT status, COUNT(*) as amount, SUM(total) as total FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i GROUP BY status", 'status', mktime(0, 0, 0, 1, 1, $today['year']), TIME);
	$orders_stats['year_orders']['totals'] = db_get_row("SELECT SUM(IF(status = 'C' OR status = 'P', total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i", mktime(0, 0, 0, 1, 1, $today['year']), TIME);
	$order_statuses = fn_get_statuses(STATUSES_ORDER, true);

	$product_stats['total'] = db_get_field("SELECT COUNT(*) as amount FROM ?:products");
	$product_stats['status'] = db_get_hash_single_array("SELECT status, COUNT(*) as amount FROM ?:products GROUP BY status", array('status', 'amount'));

	$product_stats['configurable'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE product_type = 'C'");
	$product_stats['downloadable'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE is_edp = 'Y'");
	$product_stats['free_shipping'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE free_shipping = 'Y'");

	$stock = db_get_hash_single_array("SELECT COUNT(product_id) as quantity, IF(amount > 0, 'in', 'out') as c FROM ?:products WHERE tracking = 'B' GROUP BY c", array('c', 'quantity'));
	$stock_o = db_get_hash_single_array("SELECT COUNT(DISTINCT(?:product_options_inventory.product_id))  as quantity, IF(?:product_options_inventory.amount > 0, 'in', 'out') as c FROM ?:product_options_inventory LEFT JOIN ?:products ON ?:products.product_id = ?:product_options_inventory.product_id WHERE ?:products.tracking = 'O' GROUP BY c", array('c', 'quantity'));

	$product_stats['in_stock'] = (!empty($stock['in']) ? $stock['in'] : 0) + (!empty($stock_o['in']) ? $stock_o['in'] : 0);
 	$product_stats['out_of_stock'] = (!empty($stock['out']) ? $stock['out'] : 0) + (!empty($stock_o['out']) ? $stock_o['out'] : 0);

	$category_stats['total'] = db_get_field("SELECT COUNT(*) FROM ?:categories");
	$category_stats['status'] =  db_get_hash_single_array("SELECT status, COUNT(*) as amount FROM ?:categories GROUP BY status", array('status', 'amount'));

	$memberships = fn_get_memberships('F', DESCR_SL);
	$memberships_type = db_get_hash_single_array("SELECT type, COUNT(*) as total FROM ?:memberships GROUP BY type", array('type', 'total'));
	$users_stats['total'] = db_get_hash_single_array("SELECT user_type, COUNT(*) as total FROM ?:users GROUP BY user_type", array('user_type', 'total'));
	$users_stats['total_all'] = db_get_field("SELECT COUNT(*) FROM ?:users");
	$users_stats['not_approved'] = db_get_field("SELECT COUNT(*) FROM ?:users WHERE status = 'D'");
	$users_stats['membership']['A'] = db_get_hash_single_array("SELECT a.membership_id, COUNT(*) as amount FROM ?:users as a LEFT JOIN ?:memberships as b ON a.membership_id = b.membership_id WHERE b.type = 'A' GROUP BY a.membership_id", array('membership_id', 'amount'));
	$users_stats['membership']['C'] = db_get_hash_single_array("SELECT a.membership_id, COUNT(*) as amount FROM ?:users as a LEFT JOIN ?:memberships as b ON a.membership_id = b.membership_id WHERE b.type = 'C' GROUP BY a.membership_id", array('membership_id', 'amount'));
	$users_stats['membership']['P'] = db_get_hash_single_array("SELECT a.membership_id, COUNT(*) as amount FROM ?:users as a LEFT JOIN ?:memberships as b ON a.membership_id = b.membership_id WHERE b.type = 'P' GROUP BY a.membership_id", array('membership_id', 'amount'));
	$users_stats['not_members'] = db_get_hash_single_array("SELECT user_type, COUNT(*) as amount FROM ?:users WHERE membership_id = 0 GROUP BY user_type", array('user_type', 'amount'));

	if (!defined('HTTPS')) {
		$view->assign('stats', base64_decode('PGltZyBzcmM9Imh0dHA6Ly93d3cuY3MtY2FydC5jb20vaW1hZ2VzL2JhY2tncm91bmQuZ2lmIiBoZWlnaHQ9IjEiIHdpZHRoPSIxIiBhbHQ9IiIgLz4='));
	}

	$view->assign('memberships', $memberships);
	$view->assign('memberships_type', $memberships_type);
	$view->assign('orders_stats', $orders_stats);
	$view->assign('order_statuses', $order_statuses);
	$view->assign('product_stats', $product_stats);
	$view->assign('category_stats', $category_stats);
	$view->assign('users_stats', $users_stats);
	$view->assign('latest_orders', $latest_orders);
}

?>
