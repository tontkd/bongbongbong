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
// $Id: orders.php 7663 2009-07-03 12:11:34Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}


if (!empty($_REQUEST['order_id']) && $mode != 'search') {
	// If user is not logged in and trying to see the order, redirect him to login form
	if (empty($auth['user_id']) && empty($auth['order_ids'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=auth.login_form&return_url=" . urlencode(Registry::get('config.current_url')));
	}

	if (!empty($auth['user_id'])) {
		$allowed_id = db_get_field("SELECT user_id FROM ?:orders WHERE user_id = ?i AND order_id = ?i", $auth['user_id'], $_REQUEST['order_id']);

	} elseif (!empty($auth['order_ids'])) {
		$allowed_id = in_array($_REQUEST['order_id'], $auth['order_ids']);
	}

	if (empty($allowed_id)) { // Access denied
		return array(CONTROLLER_STATUS_DENIED);
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$suffix = '';

	if ($mode == 'repay') {
		$view->assign('order_action', fn_get_lang_var('processing'));
		$view->display('views/orders/components/placing_order.tpl');
		fn_flush();

		$order_info = fn_get_order_info($_REQUEST['order_id']);

		$payment_info = empty($_REQUEST['payment_info']) ? array() : $_REQUEST['payment_info'];

		// Save payment information
		if (!empty($payment_info)) {
			$ccards = fn_get_static_data_section('C', true);
			if (!empty($payment_info['card']) && !empty($ccards[$payment_info['card']])) {
				// Check if cvv2 number required and unset it if not
				if ($ccards[$payment_info['card']]['param_2'] != 'Y') {
					unset($payment_info['cvv2']);
				}
				// Check if start date exists and required and convert it to string
				if ($ccards[$payment_info['card']]['param_3'] != 'Y') {
					unset($payment_info['start_month'], $payment_info['start_year']);
				}
				// Check if issue number required
				if ($ccards[$payment_info['card']]['param_4'] != 'Y') {
					unset($payment_info['issue_number']);
				}
			}

			$_data = array (
				'order_id' => $_REQUEST['order_id'],
				'type' => 'P', //payment information
				'data' => fn_encrypt_text(serialize($payment_info)),
			);

			db_query("REPLACE INTO ?:order_data ?e", $_data);
		}

		// Change payment method
		$update_order['payment_id'] = $_REQUEST['payment_id'];
		$update_order['repaid'] = ++ $order_info['repaid'];

		// Add new customer notes
		if (!empty($_REQUEST['customer_notes'])) {
			$update_order['notes'] = (!empty($order_info['notes']) ? $order_info['notes'] . "\n" : '') . $_REQUEST['customer_notes'];
		}

		// Update total and surcharge amount
		$payment = fn_get_payment_method_data($_REQUEST['payment_id']);
		if (!empty($payment['p_surcharge']) || !empty($payment['a_surcharge'])) {
			$surcharge_value = 0;
			if (floatval($payment['a_surcharge'])) {
				$surcharge_value += $payment['a_surcharge'];
			}
			if (floatval($payment['p_surcharge'])) {
				$surcharge_value += fn_format_price(($order_info['total'] - $order_info['payment_surcharge']) * $payment['p_surcharge'] / 100);
			}
			$update_order['payment_surcharge'] = $surcharge_value;
			$update_order['total'] = fn_format_price($order_info['total'] - $order_info['payment_surcharge'] + $surcharge_value);
		} else {
			$update_order['total'] = fn_format_price($order_info['total'] - $order_info['payment_surcharge']);
			$update_order['payment_surcharge'] = 0;
		}

		db_query('UPDATE ?:orders SET ?u WHERE order_id = ?i', $update_order, $_REQUEST['order_id']);

		// Change order status back to Open and restore amount.
		fn_change_order_status($order_info['order_id'], 'O', $order_info['status'], false);

		// Process order (payment)
		fn_start_payment($order_info['order_id']);

		fn_order_placement_routines($order_info['order_id'], null, true, 'repay');
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=orders.details&order_id=$_REQUEST[order_id]$suffix");
}

fn_add_breadcrumb(fn_get_lang_var('orders'), $mode == 'search' ? '' : "$index_script?dispatch=orders.search");

//
// Show invoice
//
if ($mode == 'invoice') {
	fn_add_breadcrumb(fn_get_lang_var('order') . ' #' . $_REQUEST['order_id'], "$index_script?dispatch=orders.details&order_id=$_REQUEST[order_id]");
	fn_add_breadcrumb(fn_get_lang_var('invoice'));

	$view->assign('order_info', fn_get_order_info($_REQUEST['order_id']));

//
// Show invoice on separate page
//
} elseif ($mode == 'print_invoice') {

	$view_mail->assign('order_info', fn_get_order_info($_REQUEST['order_id']));

	if (!empty($_REQUEST['format']) && $_REQUEST['format'] == 'pdf') {
		$view_mail->assign('index_script', Registry::get('config.current_location') . '/' . $index_script);
		fn_html_to_pdf($view_mail->display('orders/print_invoice.tpl', false), fn_get_lang_var('invoice') . '-' . $_REQUEST['order_id']);
	} else {
		$view_mail->display('orders/print_invoice.tpl');
	}
	exit;

//
// Track orders by ekey
//
} elseif ($mode == 'track') {
	if (!empty($_REQUEST['ekey'])) {
		$email = db_get_field("SELECT object_string FROM ?:ekeys WHERE object_type = 'T' AND ekey = ?s AND ttl > ?i", $_REQUEST['ekey'], TIME);

		// Cleanup keys
		db_query("DELETE FROM ?:ekeys WHERE object_type = 'T' AND ttl < ?i", TIME);

		if (empty($email)) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		$auth['order_ids'] = db_get_fields("SELECT order_id FROM ?:orders WHERE email = ?s", $email);

		if (!empty($_REQUEST['o_id']) && in_array($_REQUEST['o_id'], $auth['order_ids'])) {
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.details&order_id=$_REQUEST[o_id]");
		} else {
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.search");
		}
	} else {
		return array(CONTROLLER_STATUS_DENIED);
	}

	exit;

//
// Request for order tracking
//
} elseif ($mode == 'track_request') {

	$email = '';
	if (!empty($_REQUEST['track_data'])) {
		$o_id = 0;
		// If track by email
		if (strpos($_REQUEST['track_data'], '@') !== false) {
			$email = db_get_field("SELECT email FROM ?:orders WHERE email = ?s LIMIT 1", $_REQUEST['track_data']);
		// Assume that this is order number
		} else {
			$email = db_get_field("SELECT email FROM ?:orders WHERE order_id = ?i", $_REQUEST['track_data']);
			$o_id = $_REQUEST['track_data'];
		}
	}

	if (!empty($email)) {
		// Create access key
		$ekey_data = array (
			'object_string' => $email,
			'object_type' => 'T',
			'ekey' => md5(uniqid(rand())),
			'ttl' => strtotime("+1 hour"), // FIXME!!! hardcoded
		);

		db_query("REPLACE INTO ?:ekeys ?e", $ekey_data);

		$view_mail->assign('access_key', $ekey_data['ekey']);
		$view_mail->assign('o_id', $o_id);

		fn_send_mail($email, Registry::get('settings.Company.company_orders_department'), 'orders/track_subj.tpl', 'orders/track.tpl');
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_track_instructions_sent'));
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('warning_track_orders_not_found'));
	}

	return array(CONTROLLER_STATUS_OK);

//
// Show order details
//
} elseif ($mode == 'details') {

	fn_add_breadcrumb(fn_get_lang_var('order_info'));

	$order_info = fn_get_order_info($_REQUEST['order_id']);

	if (empty($order_info)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	// Repay functionality
	$statuses = fn_get_statuses(STATUSES_ORDER);

	if (Registry::get('settings.General.repay') == 'Y' && (!empty($statuses[$order_info['status']]['repay']) && $statuses[$order_info['status']]['repay'] == 'Y')) {

		//Get payment methods
		$payment_methods = fn_get_payment_methods($auth);
		if (!empty($payment_methods)) {
			// Get payment method info
			if (!empty($_REQUEST['payment_id'])) {
				$order_payment_id = $_REQUEST['payment_id'];
			} else {
				$first = reset($payment_methods);
				$order_payment_id = $first['payment_id'];
			}
			
			$payment_data = fn_get_payment_method_data($order_payment_id);
			$payment_data['surcharge_value'] = 0;

			if (floatval($payment_data['a_surcharge'])) {
				$payment_data['surcharge_value'] += $payment_data['a_surcharge'];
			}

			if (floatval($payment_data['p_surcharge'])) {
				$payment_data['surcharge_value'] += fn_format_price(($order_info['total'] - $order_info['payment_surcharge']) * $payment_data['p_surcharge'] / 100);
			}

			$view->assign('payment_methods', $payment_methods);
			$view->assign('credit_cards', fn_get_static_data_section('C', true));
			$view->assign('order_payment_id', $order_payment_id);
			$view->assign('payment_method', $payment_data);
		}
	}

	$view->assign('order_info', $order_info);

//
// Search orders
//
} elseif ($mode == 'search') {

	$params = $_REQUEST;
	if (!empty($auth['user_id'])) {
		$params['user_id'] = $auth['user_id'];

	} elseif (!empty($auth['order_ids'])) {
		$params['order_id'] = $auth['order_ids'];

	} else {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=auth.login_form&return_url=" . urlencode(Registry::get('config.current_url')));
	}

	list($orders, $search) = fn_get_orders($params, Registry::get('settings.Appearance.orders_per_page'));

	$view->assign('orders', $orders);
	$view->assign('search', $search);

//
// Reorder order
//
} elseif ($mode == 'reorder') {

	fn_reorder($_REQUEST['order_id'], $_SESSION['cart'], $auth['user_id']);

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.cart");

} elseif ($mode == 'downloads') {

	if (empty($auth['user_id']) && empty($auth['order_ids'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	fn_add_breadcrumb(fn_get_lang_var('downloads'));

	$view->assign('products', fn_get_user_edp($auth['user_id'], empty($auth['user_id']) ? $auth['order_ids'] : 0, empty($_REQUEST['page']) ? 1 : $_REQUEST['page']));

} elseif ($mode == 'order_downloads') {

	if (empty($auth['user_id']) && empty($auth['order_ids'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	if (!empty($_REQUEST['order_id'])) {
		if (empty($auth['user_id']) && !in_array($_REQUEST['order_id'], $auth['order_ids'])) {
			return array(CONTROLLER_STATUS_DENIED);
		}
		$order = db_get_row("SELECT order_id FROM ?:orders WHERE ?:orders.order_id = ?i", $_REQUEST['order_id']);

		if (empty($order)) {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		fn_add_breadcrumb(fn_get_lang_var('orders'), "$index_script?dispatch=orders.search");
		fn_add_breadcrumb(fn_get_lang_var('order') . ' #' . $_REQUEST['order_id'], "$index_script?dispatch=orders.details&order_id=" . $_REQUEST['order_id']);
		fn_add_breadcrumb(fn_get_lang_var('downloads'));

		$view->assign('products', fn_get_user_edp($_SESSION['auth']['user_id'], $_REQUEST['order_id']));
	} else {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

} elseif ($mode == 'get_file') {

	$field = empty($_REQUEST['preview']) ? 'file_path' : 'preview_path';

	if (($field == 'file_path' && !empty($_REQUEST['ekey']) || $field == 'preview_path')) {

		if (!empty($_REQUEST['ekey'])) {

			$ekey_info = fn_get_product_edp_info($_REQUEST['product_id'], $_REQUEST['ekey']);

			if (empty($ekey_info)) {
				return array(CONTROLLER_STATUS_DENIED);
			}

			// Increase downloads for this file
			$max_downloads = db_get_field("SELECT max_downloads FROM ?:product_files WHERE file_id = ?i", $_REQUEST['file_id']);
			$file_downloads = db_get_field("SELECT downloads FROM ?:product_file_ekeys WHERE ekey = ?s AND file_id = ?i", $_REQUEST['ekey'], $_REQUEST['file_id']);

			if (!empty($max_downloads)) {
				if ($file_downloads >= $max_downloads) {
					return array(CONTROLLER_STATUS_DENIED);
				}
			}
			db_query('UPDATE ?:product_file_ekeys SET ?u WHERE file_id = ?i AND product_id = ?i AND order_id = ?i', array('downloads' => $file_downloads + 1), $_REQUEST['file_id'], $ekey_info['product_id'], $ekey_info['order_id']);
		}

		$file = db_get_row("SELECT $field, file_name, product_id FROM ?:product_files LEFT JOIN ?:product_file_descriptions ON ?:product_file_descriptions.file_id = ?:product_files.file_id AND ?:product_file_descriptions.lang_code = ?s WHERE ?:product_files.file_id = ?i", CART_LANGUAGE, $_REQUEST['file_id']);
		if (!empty($file)) {
			fn_get_file(DIR_DOWNLOADS . $file['product_id'] . '/' . $file[$field]);
		}
	}

	return array(CONTROLLER_STATUS_DENIED);

//
// Display list of files for downloadable product
//
} elseif ($mode == 'download') {
	if (!empty($_REQUEST['ekey'])) {

		$ekey_info = fn_get_product_edp_info($_REQUEST['product_id'], $_REQUEST['ekey']);

		if (empty($ekey_info)) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		$product = array(
			'ekey' => $_REQUEST['ekey'],
			'product_id' => $ekey_info['product_id'],
		);

		if (!empty($product['product_id'])) {
			$product['product'] = db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $product['product_id'], CART_LANGUAGE);
			$product['files'] = fn_get_product_files($product['product_id'], false, $ekey_info['order_id']);
		}
	}

	if (!empty($auth['user_id'])) {
		fn_add_breadcrumb(fn_get_lang_var('downloads'), "$index_script?dispatch=profiles.downloads");
	}

	fn_add_breadcrumb($product['product'], "$index_script?dispatch=products.view&product_id=$product[product_id]");
	fn_add_breadcrumb(fn_get_lang_var('download'));

	if (!empty($product['files'])) {
		$view->assign('product', $product);
	} else {
		return array(CONTROLLER_STATUS_DENIED);
	}
}

function fn_reorder($order_id, &$cart, $user_id)
{
	$order_info = fn_get_order_info($order_id, false, false);

	fn_set_hook('reorder', $order_info, $cart);

	foreach ($order_info['items'] as $k => $item) {
		unset($order_info['items'][$k]['extra']['ekey_info']);
		$order_info['items'][$k]['product_options'] = empty($order_info['items'][$k]['extra']['product_options']) ? array() : $order_info['items'][$k]['extra']['product_options'];
	}

	if (!empty($cart) && !empty($cart['products'])) {
		$cart['products'] = fn_array_merge($cart['products'], $order_info['items']);
	} else {
		$cart['products'] = $order_info['items'];
	}

	fn_save_cart_content($cart, $user_id);
}

/**
 * Return edp ekey info
 *
 * @param int $product_id
 * @param string $ekey - download key
 * @return array download key info
 */
function fn_get_product_edp_info($product_id, $ekey)
{
	$unlimited = db_get_field("SELECT unlimited_download FROM ?:products WHERE product_id = ?i", $product_id);
	$ttl_condition = ($unlimited == 'Y') ? '' :  db_quote(" AND ttl > ?i", TIME);

	return db_get_row("SELECT product_id, order_id, file_id FROM ?:product_file_ekeys WHERE product_id = ?i AND active = 'Y' AND ekey = ?s ?p", $product_id, $ekey, $ttl_condition);
}
?>
