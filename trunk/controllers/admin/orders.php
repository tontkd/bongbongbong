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
// $Id: orders.php 7695 2009-07-13 06:26:40Z alexions $
//

if ( !defined('AREA') )	{ die('Access denied');	}

fn_define('GOOGLE_ORDER_DATA', 'O');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$suffix = '';

	if ($mode == 'delete_orders' && !empty($_REQUEST['order_ids'])) {
		foreach ($_REQUEST['order_ids'] as $v) {
			fn_delete_order($v);
		}
	}

	if ($mode == 'update_details') {
		fn_trusted_vars('update_order');

		// Update customer's email if its changed in customer's account
		if (!empty($_REQUEST['update_customer_details']) && $_REQUEST['update_customer_details'] == 'Y') {
			$u_id = db_get_field("SELECT user_id FROM ?:orders WHERE order_id = ?i", $_REQUEST['order_id']);
			$current_email = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i", $u_id);
			db_query("UPDATE ?:orders SET email = ?s WHERE order_id = ?i", $current_email, $_REQUEST['order_id']);
		}

		// Log order update
		fn_log_event('orders', 'update', array(
			'order_id' => $_REQUEST['order_id']
		));

		db_query('UPDATE ?:orders SET ?u WHERE order_id = ?i', $_REQUEST['update_order'], $_REQUEST['order_id']);

		//Update shipping info
		if (!empty($_REQUEST['update_shipping'])) {
			$additional_data = db_get_hash_single_array("SELECT type, data FROM ?:order_data WHERE order_id = ?i", array('type', 'data'), $_REQUEST['order_id']);
			// Get shipping information
			if (!empty($additional_data['L'])) {
				$shippings = unserialize($additional_data['L']);
				if (!empty($shippings)) {
					foreach((array)$shippings as $shipping_id => $shipping) {
						$shippings[$shipping_id] = fn_array_merge($shipping, $_REQUEST['update_shipping'][$shipping_id]);
					}
					db_query("UPDATE ?:order_data SET ?u WHERE order_id = ?i AND type = 'L'", array('data' => serialize($shippings)), $_REQUEST['order_id']);
				}
			}
		}

		$order_info = fn_get_order_info($_REQUEST['order_id']);
		fn_order_notification($order_info, array(), !empty($_REQUEST['notify_user']));

		if (!empty($_REQUEST['prolongate_data']) && is_array($_REQUEST['prolongate_data'])) {
			foreach ($_REQUEST['prolongate_data'] as $ekey => $v) {
				$newttl = fn_parse_date($v, true);
				db_query('UPDATE ?:product_file_ekeys SET ?u WHERE ekey = ?s', array('ttl' => $newttl), $ekey);
			}
		}

		if (!empty($_REQUEST['activate_files'])) {
			$edp_data = fn_generate_ekeys_for_edp(array(), $order_info, $_REQUEST['activate_files']);
		}

		if (!empty($edp_data)) {
			$view_mail->assign('order_info', $order_info);
			$view_mail->assign('edp_data', $edp_data);
			fn_send_mail($order_info['email'], Registry::get('settings.Company.company_orders_department'), 'orders/edp_access_subj.tpl', 'orders/edp_access.tpl', '', $order_info['lang_code']);
		}

		// Update file downloads section
		if (!empty($_REQUEST['edp_downloads'])) {
			foreach ($_REQUEST['edp_downloads'] as $ekey => $v) {
				foreach ($v as $file_id => $downloads) {
					$max_downloads = db_get_field("SELECT max_downloads FROM ?:product_files WHERE file_id = ?i", $file_id);
					if (!empty($max_downloads)) {
						db_query('UPDATE ?:product_file_ekeys SET ?u WHERE ekey = ?s', array('downloads' => $max_downloads - $downloads), $ekey);
					}
				}
			}
		}

		$suffix = ".details&order_id=$_REQUEST[order_id]";
	}

	if ($mode == 'bulk_print' && !empty($_REQUEST['order_ids'])) {
		$view_mail->assign('order_status_descr', fn_get_statuses(STATUSES_ORDER, true));

		$html = array();
		foreach ($_REQUEST['order_ids'] as $k => $v) {
			$view_mail->assign('order_info', fn_get_order_info($v));
			if (DISPATCH_EXTRA == 'pdf') {
				$html[] = $view_mail->display('orders/print_invoice.tpl', false);
			} else {
				$view_mail->display('orders/print_invoice.tpl');
				echo "<div style='page-break-before: always;'>&nbsp;</div>";
			}
		}

		if (DISPATCH_EXTRA == 'pdf') {
			fn_html_to_pdf($html, fn_get_lang_var('invoices') . '-' . implode('-', $_REQUEST['order_ids']));
		}

		exit;
	}

	if ($mode == 'packing_slip' && !empty($_REQUEST['order_ids'])) {
		foreach ($_REQUEST['order_ids'] as $k => $v) {
			$view_mail->assign('order_info', fn_get_order_info($v));
			$view_mail->display('orders/print_packing_slip.tpl');
			echo "<div style='page-break-before: always;'>&nbsp;</div>";
		}
		
		exit;
	}

	if ($mode == 'remove_all_cc_info' && !empty($_REQUEST['statuses'])) {
		$data = array(1);
		$i = 0;
		while (!empty($data)) {
			$data = db_get_array("SELECT order_id, data FROM ?:order_data INNER JOIN ?:orders ON ?:orders.order_id = ?:order_data.order_id WHERE ?:orders.status IN (?a) AND ?:order_data.type = 'P' LIMIT $i, 30", $_REQUEST['statuses']);
			foreach ($data as $v) {
				fn_cleanup_payment_info($v['order_id'], $v['data']);
			}
			$i = $i + 30;
		}
	}

	if ($mode == 'remove_cc_info' && !empty($_REQUEST['order_ids'])) {
		foreach ($_REQUEST['order_ids'] as $v) {
			$payment_info = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = 'P'", $v);
			fn_cleanup_payment_info($v, $payment_info);
		}

		if (count($_REQUEST['order_ids']) == 1) {
			$o_id = array_pop($_REQUEST['order_ids']);
			$suffix = ".details&order_id=$o_id"; 
		}
	}

	if ($mode == 'export_range') {
		if (!empty($_REQUEST['order_ids'])) {
			if (empty($_SESSION['export_ranges'])) {
				$_SESSION['export_ranges'] = array();
			}

			if (empty($_SESSION['export_ranges']['orders'])) {
				$_SESSION['export_ranges']['orders'] = array('pattern_id' => 'orders');
			}

			$_SESSION['export_ranges']['orders']['data'] = array('order_id' => $_REQUEST['order_ids']);

			unset($_REQUEST['redirect_url']);
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=exim.export&section=orders&pattern_id=" . $_SESSION['export_ranges']['orders']['pattern_id']);
		}
	}

	if ($mode == 'google') {
		$google_request_sent = false;
		$order_info = fn_get_order_info($_REQUEST['order_id']);
		$processor_data = fn_get_payment_method_data($order_info['payment_id']);
		$base_url = "https://" . (($processor_data['params']['test'] == 'N') ? 'checkout.google.com' : 'sandbox.google.com/checkout') . '/cws/v2/Merchant/' . $processor_data['params']['merchant_id'];
		$request_url = $base_url . '/request';
		$schema_url = 'http://checkout.google.com/schema/2';
		$google_data = !empty($_REQUEST['google_data']) ? $_REQUEST['google_data'] : array();

		$post = array();
		// XML request to mark order delivered
		if ($action == 'deliver') {
			$ship_info = reset($order_info['shipping']);

			$post = array();
			$post[] = "<deliver-order xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "'>";
			$post[] = '<tracking-data>';
			$post[] = '<carrier>' . (!empty($ship_info['carrier']) ? $ship_info['carrier'] : 'Other') . '</carrier>';
			$post[] = '<tracking-number>' . (!empty($ship_info['tracking_number']) ? $ship_info['tracking_number'] : '') . '</tracking-number>';
			$post[] = '</tracking-data>';
			$post[] = '<send-email>false</send-email>';
			$post[] = '</deliver-order>';

		// XML request to cancel the order
		} elseif ($action == 'add_tracking_data') {
			//$ship_info = reset($order_info['shipping']);

			foreach ($order_info['shipping'] as $ship_info) {
				if (!empty($ship_info['carrier']) && !empty($ship_info['tracking_number'])) {
					$post = array();
					$post[] = "<add-tracking-data xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "'>";
					$post[] = '<tracking-data>';
					$post[] = '<carrier>' . $ship_info['carrier'] . '</carrier>';
					$post[] = '<tracking-number>' . $ship_info['tracking_number'] . '</tracking-number>';
					$post[] = '</tracking-data>';
					$post[] = '</add-tracking-data>';
					fn_google_send_order_command($post, $processor_data, $request_url, $action, $_REQUEST['order_id']);
				}
			}
			$google_request_sent = true;

		// XML request to send a message to the customer
		} elseif ($action == 'send_message') {
			$post[] = "<send-buyer-message xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "'>";
			$post[] = '<message>' . $google_data['message'] . '</message>';
			$post[] = '<send-email>true</send-email>';
			$post[] = '</send-buyer-message>';

		// XML request to refund the order
		} elseif ($action == 'charge') {
			$post[] = "<charge-order xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "'>";
			$post[] = '<amount currency="' . $processor_data['params']['currency'] . '">' . $google_data['charge_amount'] . '</amount>';
			$post[] = '</charge-order>';

		// XML request to refund the order
		} elseif ($action == 'refund') {
			$post[] = "<refund-order xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "'>";
			$post[] = '<amount currency="' . $processor_data['params']['currency'] . '">' . $google_data['refund_amount'] . '</amount>';
			$post[] = '<reason>' . $google_data['refund_reason'] . '</reason>';
			$post[] = '<comment>' . $google_data['refund_comment'] . '</comment>';
			$post[] = '</refund-order>';

		// XML request to cancel the order
		} elseif ($action == 'cancel') {
			$post[] = "<cancel-order xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "'>";
			$post[] = '<reason>' . $google_data['cancel_reason'] . '</reason>';
			$post[] = '<comment>' . $google_data['cancel_comment'] . '</comment>';
			$post[] = '</cancel-order>';

		// XML request to archive the order
		} elseif ($action == 'archive') {
			$post[] = "<archive-order xmlns='" . $schema_url . "' google-order-number='" . $order_info['payment_info']['transaction_id'] . "' />";

		}

		if (!$google_request_sent) {
			fn_google_send_order_command($post, $processor_data, $request_url, $action, $_REQUEST['order_id']);
		}
		
		$suffix = '.details&order_id=' . $_REQUEST['order_id'];
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=orders" . $suffix);
}

$params = $_REQUEST;


if ($mode == 'delete') {
	fn_delete_order($_REQUEST['order_id']);

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'print_invoice') {
	if (!empty($_REQUEST['order_id'])) {
		$order_info = fn_get_order_info($_REQUEST['order_id']);
		if (empty($order_info)) {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		$view_mail->assign('order_info', $order_info);

		if (!empty($_REQUEST['format']) && $_REQUEST['format'] == 'pdf') {
			fn_html_to_pdf($view_mail->display('orders/print_invoice.tpl', false), fn_get_lang_var('invoice') . '-' . $_REQUEST['order_id']);
		} else {
			$view_mail->display('orders/print_invoice.tpl');
		}

		exit;
	}

} elseif ($mode == 'print_packing_slip') {
	if (!empty($_REQUEST['order_id'])) {
		$order_info = fn_get_order_info($_REQUEST['order_id']);
		if (empty($order_info)) {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		$view_mail->assign('order_info', $order_info);

		$view_mail->display('orders/print_packing_slip.tpl');

		exit;
	}

} elseif ($mode == 'details' && !empty($_REQUEST['order_id'])) {

	$order_info = fn_get_order_info($_REQUEST['order_id'], false, true, true);

	if (empty($order_info)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	Registry::set('navigation.tabs', array (
		'general' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'addons' => array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		),
	));

	$google_info = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = ?s", $_REQUEST['order_id'], GOOGLE_ORDER_DATA);
	if (!empty($google_info)) {
		Registry::set('navigation.tabs.google', array (
			'title' => fn_get_lang_var('google_info'),
			'js' => true
		));

		$_SESSION['google_info'] = unserialize($google_info);
		$view->assign('google_info', $_SESSION['google_info']);
	}

	foreach ($order_info['items'] as $v) {
		if (!empty($v['extra']['is_edp']) && $v['extra']['is_edp'] == 'Y') {
			Registry::set('navigation.tabs.downloads', array (
				'title' => fn_get_lang_var('downloads'),
				'js' => true
			));
			$view->assign('downloads_exist', true);
			break;
		}
	}

	if (!empty($order_info['promotions'])) {
		Registry::set('navigation.tabs.promotions', array (
			'title' => fn_get_lang_var('promotions'),
			'js' => true
		));
	}

	$view->assign('order_info', $order_info);

	// Delete order_id from new_orders table
	db_query("DELETE FROM ?:new_orders WHERE order_id = ?i AND user_id = ?i", $_REQUEST['order_id'], $auth['user_id']);

	// Get previous and next order IDs
	$prev_id = db_get_field("SELECT MAX(order_id) FROM ?:orders WHERE order_id < ?i", $_REQUEST['order_id']);
	$next_id = db_get_field("SELECT MIN(order_id) FROM ?:orders WHERE order_id > ?i", $_REQUEST['order_id']);

	fn_add_breadcrumb(fn_get_lang_var('orders'), "$index_script?dispatch=orders.manage");

	// Check if customer's email is changed
	if (!empty($order_info['user_id'])) {
		$current_email = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i", $order_info['user_id']);
		if (!empty($current_email) && $current_email != $order_info['email']) {
			$view->assign('email_changed', true);
		}
	}

	$view->assign('prev_id', $prev_id);
	$view->assign('next_id', $next_id);

} elseif ($mode == 'picker') {

	list($orders, $search) = fn_get_orders($_REQUEST, Registry::get('settings.Appearance.admin_orders_per_page'));
	$view->assign('orders', $orders);
	$view->assign('search', $search);

	$view->display('pickers/orders_picker_contents.tpl');
	exit;

} elseif ($mode == 'update_status') {

	$order_info = fn_get_order_short_info($_REQUEST['id']);
	$old_status = $order_info['status'];
	if (fn_change_order_status($_REQUEST['id'], $_REQUEST['status'], '', !empty($_REQUEST['notify_user']))) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_status_not_changed'));
		$ajax->assign('return_status', $old_status);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.manage");

} elseif ($mode == 'manage') {

	list($orders, $search, $totals) = fn_get_orders($params, Registry::get('settings.Appearance.admin_orders_per_page'), true);

	if (!empty($_REQUEST['redirect_if_one']) && count($orders) == 1) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.details&order_id={$orders[0]['order_id']}");
	}

	$view->assign('orders', $orders);
	$view->assign('search', $search);

	$view->assign('totals', $totals);
	$view->assign('display_totals', fn_display_order_totals($orders));
	$view->assign('shippings', fn_get_shippings(true, CART_LANGUAGE));

} elseif ($mode == 'google') {
	// In this action we loop the script until google data is changed
	if ($action == 'wait_response') {
		$current_time = TIME;
		echo "Waiting for a Google response. Please be patient.";
		fn_flush();
		do {
			echo ' .';
			$google_info_new = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = ?s", $_REQUEST['order_id'], GOOGLE_ORDER_DATA);
			if ($google_info_new != $_SESSION['google_info']) {
				unset($_SESSION['google_info']);
				return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.details&order_id=$_REQUEST[order_id]");
			}
			sleep(1);
		} while (time() - TIME < 59);
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.google.wait_response&order_id=$_REQUEST[order_id]");
	}
}

//
// Calculate gross total and totally paid values for the current set of orders
//
function fn_display_order_totals($orders)
{
	$result = array();
	$result['gross_total'] = 0;
	$result['totally_paid'] = 0;

	if (is_array($orders)) {
		foreach ($orders as $k => $v) {
			$result['gross_total'] += $v['total'];
			if ($v['status'] == 'C' || $v['status'] == 'P') {
				$result['totally_paid'] += $v['total'];
			}
		}
	}

	return $result;
}

/**
 * Function delete order
 *
 * @param int $order_id
 */
function fn_delete_order($order_id)
{
	// Log order deletion
	fn_log_event('orders', 'delete', array (
		'order_id' => $order_id,
	));

	fn_change_order_status($order_id, 'B', '', false); // backorder to increase inventory
	
	fn_set_hook('delete_order', $order_id);

	db_query("DELETE FROM ?:new_orders WHERE order_id = ?i", $order_id);
	db_query("DELETE FROM ?:order_data WHERE order_id = ?i", $order_id);
	db_query("DELETE FROM ?:order_details WHERE order_id = ?i", $order_id);
	db_query("DELETE FROM ?:orders WHERE order_id = ?i", $order_id);
	db_query("DELETE FROM ?:product_file_ekeys WHERE order_id = ?i", $order_id);
}

function fn_google_send_order_command($post, $processor_data, $request_url, $action, $order_id)
{
	$_id = base64_encode($processor_data['params']['merchant_id'] . ":" . $processor_data['params']['merchant_key']);
	$headers[] = "Authorization: Basic $_id";
	$headers[] = "Accept: application/xml ";

	list($a, $return) = fn_https_request('POST', $request_url, $post, '', '', 'application/xml', '', '', '', $headers);

	preg_match("/<error-message>(.*)<\/error-message>/", $return, $error);

	if (!empty($error[1])) {
		fn_set_notification('E', fn_get_lang_var('notice'), $error[1]);
	} else {
		if (in_array($action, array('refund', 'cancel', 'deliver'))) {
			$_SESSION['google_info'] = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = ?s", $order_id, GOOGLE_ORDER_DATA);
			echo "Request is successfully sent.<br />";
			echo "Waiting for a Google response. Please be patient.";
			return array(CONTROLLER_STATUS_OK, Registry::get('index_script') . "?dispatch=orders.google.wait_response&order_id=$order_id");
		}
		fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[action]', fn_get_lang_var($action), fn_get_lang_var('google_request_sent')));
	}

	return true;
}
?>