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
// $Id: func.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

function fn_sms_notifications_place_order($order_id, $action, $fake1, $cart)
{
	if ($action !== 'save' && Registry::get('addons.sms_notifications.sms_new_order_placed') == 'Y') {
		Registry::get('view')->assign('order_id', $order_id);
		Registry::get('view')->assign('total', $cart['total']);

		$send_info = Registry::get('addons.sms_notifications.sms_send_payment_info');
		$send_email = Registry::get('addons.sms_notifications.sms_send_customer_email');
		$send_min_amount = Registry::get('addons.sms_notifications.sms_send_min_amout');
		$shippings = Registry::get('addons.sms_notifications.sms_send_shipping');

		if (!is_array($shippings)) {
			$shippings = array ();
		}

		Registry::get('view')->assign('send_info', $send_info == 'Y' ? true : false);
		Registry::get('view')->assign('send_email', $send_email == 'Y' ? true : false);
		Registry::get('view')->assign('send_min_amount', $send_min_amount == 'Y' ? true : false);

		$order = fn_get_order_info($order_id);

		Registry::get('view')->assign('order_email', $order['email']);
		Registry::get('view')->assign('order_payment_info', $order['payment_method']['payment']);

		if (count($shippings)) {
			$in_shipping = false;

			foreach ($order['shipping'] as $id => $data) {
				if ($shippings[$id] == 'Y') {
					$in_shipping = true;
					break;
				}
			}
		} else {
			$in_shipping = true;
		}

		if ($in_shipping && $order['subtotal'] > doubleval($send_min_amount)) {
			$body = Registry::get('view')->display('addons/sms_notifications/views/sms/components/order_sms.tpl', false);
			fn_send_sms_notification($body);
		}
	}
}

function fn_sms_notifications_update_profile($action, $user_data)
{
	if ($action == 'add' && AREA == 'C' && Registry::get('addons.sms_notifications.sms_new_cusomer_registered') == 'Y') {
		Registry::get('view')->assign('customer', $user_data['firstname'] . (empty($user_data['lastname']) ? '' : $user_data['lastname']));
		$body = Registry::get('view')->display('addons/sms_notifications/views/sms/components/new_profile_sms.tpl', false);
		fn_send_sms_notification($body);
	}
}

function fn_sms_notifications_update_product_amount($new_amount, $product_id)
{
	if ($new_amount <= Registry::get('settings.General.low_stock_threshold') && Registry::get('addons.sms_notifications.sms_product_negative_amount') == 'Y') {
		$lang_code = Registry::get('settings.Appearence.admin_default_language');

		Registry::get('view')->assign('product_id', $product_id);
		Registry::get('view')->assign('product', db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $product_id, $lang_code));
		$body = Registry::get('view')->display('addons/sms_notifications/views/sms/components/low_stock_sms.tpl', false);
		fn_send_sms_notification($body);
	}
}

function fn_send_sms_notification($body)
{
	$access_data = fn_get_sms_auth_data();
	$to = Registry::get('addons.sms_notifications.phone_number');

	if (!fn_is_empty($access_data) && !empty($to)) {
		$data = array('user' => $access_data['login'],
					  'password' => $access_data['password'],
					  'api_id' => $access_data['api_id'],
					  'to' => $to,
					  'text' => $body);
		fn_http_request('GET', 'http://api.clickatell.com/http/sendmsg' , $data);
	}
}

function fn_get_sms_auth_data()
{
 	return array('login' => Registry::get('addons.sms_notifications.clickatel_user'),
 				 'password' => Registry::get('addons.sms_notifications.clickatel_password') ,
 				 'api_id' => Registry::get('addons.sms_notifications.clickatel_api_id'));
}

?>
