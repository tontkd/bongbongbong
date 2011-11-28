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
// $Id: func.php 7775 2009-07-31 11:40:47Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

function fn_get_supplier_data($supplier_id, $no_profile = true)
{
	static $cache;

	if (empty($cache[$supplier_id])) {
		$cache[$supplier_id] = fn_get_user_info($supplier_id, !$no_profile);
	}

	return $cache[$supplier_id];
}

function fn_suppliers_get_product_data($product_id, &$field_list, &$join)
{
	$field_list .= ", ?:users.company as supplier";
	$join .= " LEFT JOIN ?:users ON ?:users.user_id = ?:products.supplier_id";
}

function fn_suppliers_add_to_cart(&$cart, $product_id, $_id)
{
	if (!empty($product_id)) {
		$supplier_id = db_get_field("SELECT supplier_id FROM ?:products WHERE product_id = ?i", $product_id);
		if (!empty($supplier_id)) {
			$cart['products'][$_id]['extra']['supplier_id'] = $supplier_id;
		}
	}
}

function fn_suppliers_order_notification(&$order_info, &$order_statuses, $force_notification = null)
{
	static $notification_sent = false;

	$status_params = $order_statuses[$order_info['status']];
	//$notify_supplier = !is_null($force_notification) ? $force_notification : (!empty($status_params['notify_supplier']) && $status_params['notify_supplier'] == 'Y' ? true : false);

	$notify_supplier = (!empty($status_params['notify_supplier']) && $status_params['notify_supplier'] == 'Y' ? true : false); // use own notification flag

	if ($notify_supplier == true && $notification_sent == false) {
		$notification_sent = true;
 		$suppliers = array();
		foreach ($order_info['items'] as $k => $v) {
			if (isset($v['extra']['supplier_id'])) {
				$suppliers[$v['extra']['supplier_id']] = 0;
			}
		}

		if (!empty($suppliers)) {
			if (!empty($order_info['shipping'])) {
				foreach ($order_info['shipping'] as $shipping_id => $shipping) {
					foreach ($shipping['rates'] as $supplier_id => $rate) {
						if (isset($suppliers[$supplier_id])) {
							$suppliers[$supplier_id] += $rate;
						}
					}
				}
			}

			Registry::get('view_mail')->assign('order_status', fn_get_status_data($order_info['status'], STATUSES_ORDER, Registry::get('settings.Appearance.admin_default_language')));
			Registry::get('view_mail')->assign('order_info', $order_info);
			Registry::get('view_mail')->assign('status_inventory', $order_statuses[$order_info['status']]['inventory']);
			foreach ($suppliers as $supplier_id => $shipping_cost) {
				if ($supplier_id != DEFAULT_SUPPLIER_ID){
					Registry::get('view_mail')->assign('shipping_cost', $shipping_cost);
					Registry::get('view_mail')->assign('supplier_id', $supplier_id);

					$supplier = fn_get_supplier_data($supplier_id);

					fn_send_mail($supplier['email'], Registry::get('settings.Company.company_orders_department'), 'addons/suppliers/notification_subj.tpl', 'addons/suppliers/notification.tpl', '', Registry::get('settings.Appearance.admin_default_language'));
				}
			}

			return true;
		}
	}

	return false;
}

function fn_suppliers_get_profile_fields($location, &$select, &$condition)
{
	if ($location == 'S') {
		$select = ", ?:profile_fields.supplier_required as required";
		$condition = "WHERE ?:profile_fields.supplier_show='Y'";
	}
}

// TODO: former fn_suppliers_fill_google_shipping_info() - conflict with event naming
function fn_suppliers_prepare_google_shippings($shipping_methods)
{
	// Find out the needed suppliers and the shipping available for them
	$needed_suppliers = array();
	foreach ($_SESSION['cart']['products'] as $k => $v) {
		if (isset($v['extra']['supplier_id'])) {
			$s_id = $v['extra']['supplier_id'];
			$needed_suppliers[$s_id] = array();
			$ship_suppliers = db_get_fields("SELECT shipping_id FROM ?:shippings WHERE FIND_IN_SET(?i, supplier_ids)", $s_id);
			foreach ($shipping_methods as $k => $v) {
				if (in_array($v['shipping_id'], $ship_suppliers)) {
					$needed_suppliers[$s_id][$v['shipping_id']] = $v['shipping'];
				}
			}
		}
	}

	if (!empty($s_id) && is_array($needed_suppliers[$s_id])) {
		// Generate the available combiantions of all shippings for suppliers
		ksort($needed_suppliers);
		$total_suppliers = count($needed_suppliers);
		$new = array();
		$i = 0;
		foreach ($needed_suppliers as $s_id => $shippings) {
			foreach ($shippings as $shipping_id => $name) {
				$new[$i][$s_id] = $shipping_id;
				foreach ($needed_suppliers as $sub_s_id => $sub_shippings) {
					if ($s_id != $sub_s_id) {
						foreach ($sub_shippings as $sub_shipping_id => $sub_name) {
							if (!isset($new[$i][$sub_s_id]) && $new[$i][$sub_s_id] != $sub_shipping_id) {
								$new[$i][$sub_s_id] = $sub_shipping_id;
							}
							if (count($new[$i]) == $total_suppliers && isset($new[$i][$sub_s_id])) {
								$new[$i++] = $new[$i-1];
								unset($new[$i][$sub_s_id]);
							}
						}
					}
				}
			}
		}
	}

	// Form the list of shippings
	$_shipping_methods = array();
	if (!empty($new)) {
		foreach ($new as $items) {
			if (count($items) == $total_suppliers) {
				ksort($items);
				$string = '';
				foreach ($items as $k => $v) {
					$string .= $needed_suppliers[$k][$v] . ' + ';
				}
				$string = rtrim($string, ' + ');
				if (array_key_exists(implode('_', $items), $_shipping_methods) == false) {
					$_shipping_methods[implode('_', $items)] = array (
						'shipping' => $string,
						'shipping_id' => implode('_', $items)
					);
				}
			}
		}
	}

	$_shipping_methods[] =  array(
		'shipping_id' => 'FREESHIPPING',
		'shipping' => 'Free shipping'
	);

	$shipping_methods = $_shipping_methods;

	return true;
}

// Prepare and decode the shipping information from google checkout
function fn_suppliers_fill_google_shipping_info($id, &$cart, $order_adj)
{
	if (strpos($id, '_')) {
		$shippings = explode('_', $id);

		$needed_suppliers = array();
		foreach ($cart['products'] as $k => $v) {
			if (isset($v['extra']['supplier_id'])) {
				$needed_suppliers[$v['extra']['supplier_id']] = '';
			}
		}
		ksort($needed_suppliers);
		$_temp = array_keys($needed_suppliers);
		$cart['shipping'] = array();
		$total_suppliers = count($needed_suppliers);
		for ($i = 0; $i < $total_suppliers; $i++) {
			if (!is_array($cart['shipping'][$shippings[$i]])) {
				$cart['shipping'][$shippings[$i]] = array();
			}
			if (!is_array($cart['shipping'][$shippings[$i]]['rates'])) {
				$cart['shipping'][$shippings[$i]]['shipping'] = fn_get_shipping_name($shippings[$i], CART_LANGUAGE);
				$cart['shipping'][$shippings[$i]]['rates'] = array();
			}
			$cart['shipping'][$shippings[$i]]['rates'][$_temp[$i]] = '';
		}
	}

}

// This function calculates shipping rates for google checkout
function fn_suppliers_get_google_shipping_rate($id, &$shipping)
{
	$suppliers = Registry::get('view')->get_var('suppliers');

	if (!empty($suppliers) && strpos($id, '_')) {
		ksort($suppliers);
		$shippings_combination = explode("_", $id);
		$rate = 0;

		$temp = reset($suppliers);
		foreach ($shippings_combination as $v) {
			if (isset($temp['rates'][$v])) {
				$rate += $temp['rates'][$v]['rate'];
				$shipping['tax_ids'][] = 'S_'.$v.'_'.key($suppliers);
			}
			$temp = next($suppliers);
		}
		$shipping['rate'] = $rate;
	}

	return true;
}

function fn_suppliers_get_products(&$params, &$fields, &$sortings, &$condition, &$join)
{
	$sid = empty($params['sid']) ? ((empty($params['supplier_id'])) ? 0 : $params['supplier_id']) : $params['sid'];

	if (!empty($sid)) {
		$condition .= db_quote(' AND products.supplier_id = ?i', $sid);
	}

	return true;
}

function fn_suppliers_get_product_filter_fields(&$fields)
{
	$fields['S'] = array (
		'db_field' => 'supplier_id',
		'table' => 'products',
		'description' => 'supplier',
		'condition_type' => 'F',
		'range_name' => 'company',
		'foreign_table' => 'users',
		'foreign_index' => 'user_id'
	);
}

function fn_suppliers_get_user_type_description(&$type_descr)
{
	$type_descr['S']['S'] = 'supplier';
	$type_descr['P']['S'] = 'suppliers';

	return true;
}

function fn_suppliers_get_status_params_definition(&$status_params, $type)
{
	if ($type == STATUSES_ORDER) {
		$status_params['notify_supplier'] = array (
			'type' => 'checkbox',
			'label' => 'notify_supplier'
		);
	}

	return true;
}

function fn_suppliers_profile_fields_areas(&$areas)
{
	$areas['supplier'] = 'supplier';
}

function fn_suppliers_reorder(&$order_info)
{
	if (!empty($order_info['items'])) {
		foreach ($order_info['items'] as $id => $val) {
			$supplier_id = db_get_field("SELECT supplier_id FROM ?:products WHERE product_id = ?i", $val['product_id']);
			if ($supplier_id) {
				$order_info['items'][$id]['extra']['supplier_id'] = $supplier_id;
			} else {
				unset($order_info['items'][$id]['extra']['supplier_id']);	
			}
		}
	}
}

function fn_suppliers_prepare_package_info(&$cart, &$cart_products, &$package_infos)
{
	$groupped_products = array();

	foreach ($cart['products'] as $k => $v) {
		if (!empty($v['extra']['supplier_id'])) {
			$_sid = $v['extra']['supplier_id'];
		} else {
			$_sid = 0;
		}

		$groupped_products[$_sid][$k] = $cart_products[$k];
	}

	foreach ($groupped_products as $_sid => $products) {
		$package_infos[$_sid]['C'] = fn_get_products_cost($cart, $products);
		$package_infos[$_sid]['W'] = fn_get_products_weight($cart, $products);
		$package_infos[$_sid]['I'] = fn_get_products_amount($cart, $products);

		if (empty($package_infos[$_sid]['origination'])) {
			$supplier_data = fn_get_supplier_data($_sid, false);
			$package_infos[$_sid]['origination'] = array(
				'name' => !empty($supplier_data['company']) ? $supplier_data['company'] : '',
				'phone' => !empty($supplier_data['phone']) ? $supplier_data['phone'] : '',
				'fax' => !empty($supplier_data['fax']) ? $supplier_data['fax'] : '',
				'country' => !empty($supplier_data['s_country']) ? $supplier_data['s_country'] : '',
				'state' => !empty($supplier_data['s_state']) ? $supplier_data['s_state'] : '',
				'zipcode' => !empty($supplier_data['s_zipcode']) ? $supplier_data['s_zipcode'] : '',
				'city' => !empty($supplier_data['s_city']) ? $supplier_data['s_city'] : '',
				'address' => !empty($supplier_data['s_address']) ? $supplier_data['s_address'] : '',
			);
		}
	}

	return true;

}

function fn_suppliers_update_shipping(&$data, $shipping_id, $lang_code)
{
	$data['supplier_ids'] = !empty($data['supplier_ids']) ? fn_create_set($data['supplier_ids']) : '';

	return true;
}

function fn_suppliers_get_cart_product_data($product_id, &$p_data, $product)
{
	if (!empty($product['extra']['supplier_id'])) {
		$p_data['supplier_id'] = $product['extra']['supplier_id'];
	}
}

function fn_suppliers_apply_cart_shipping_rates(&$cart, $cart_products, $auth, $shipping_rates)
{
	$cart['use_suppliers'] = false;
	$cart['shipping_failed'] = false;

	// Get suppliers products
	$supplier_products = array();
	foreach ($cart_products as $k => $v) {
		$s_id = !empty($v['supplier_id']) ? $v['supplier_id'] : 0;
		$supplier_products[$s_id][] = $k;
	}


	// Add zero rates to free shipping
	foreach ($shipping_rates as $sh_id => $v) {
		if (!empty($v['added_manually'])) {
			$shipping_rates[$sh_id]['rates'] = fn_array_combine(array_keys($supplier_products), 0);
		}
	}

	// If all suppliers should be displayed in one box, filter them
	if (Registry::get('addons.suppliers.multiple_selectboxes') !== 'Y') {
		$s_ids = array_keys($supplier_products);

		foreach ($shipping_rates as $sh_id => $v) {
			if (sizeof(array_intersect($s_ids, array_keys($v['rates']))) != sizeof($s_ids)) {
				unset($shipping_rates[$sh_id]);
			}
		}
	}
	
	// Get suppliers and determine what shipping methods applicable to them
	$suppliers = array();
	foreach ($supplier_products as $s_id => $p_ids) {
		if (!empty($s_id)) {
			$s_data = fn_get_supplier_data($s_id);
			$cart['use_suppliers'] = true;
		} else {
			$s_data = array(
				'company' => ''
			);
		}

		$suppliers[$s_id] = array (
			'company' => $s_data['company'],
			'products' => $p_ids,
			'rates' => array()
		);

		// Get shipping methods
		foreach ($shipping_rates as $sh_id => $shipping) {
			if (isset($shipping['rates'][$s_id])) {
				$shipping['rate'] = $shipping['rates'][$s_id];
				unset($shipping['rates']);
				$suppliers[$s_id]['rates'][$sh_id] = $shipping;
			}
		}
	}

	// Select shipping for each supplier
	$cart_shipping = $cart['shipping'];
	$cart['shipping'] = array();
	foreach ($suppliers as $s_id => $supplier) {
		if (empty($supplier['rates'])) {
			$cart['shipping_failed'] = true;
			continue;
		}

		$sh_ids = array_keys($supplier['rates']);
		$shipping_selected = false;

		// Check if shipping method from this supplier is selected
		foreach ($sh_ids as $sh_id) {
			if (isset($cart_shipping[$sh_id]) && isset($cart_shipping[$sh_id]['rates'][$s_id])) {
				if ($shipping_selected == false) {
					if (!isset($cart['shipping'][$sh_id])) {
						$cart['shipping'][$sh_id] = $cart_shipping[$sh_id];
					}
					$cart['shipping'][$sh_id]['rates'][$s_id] = $supplier['rates'][$sh_id]['rate']; // set new rate
					$shipping_selected = true;
				} else {
					//unset($cart['shipping'][$sh_id]['rates'][$s_id]);
				}
			}
		}

		if ($shipping_selected == false) {
			$sh_id = reset($sh_ids);
			if (empty($cart['shipping'][$sh_id])) {
				if (empty($cart_shipping[$sh_id])) {
					$cart['shipping'][$sh_id] = array(
						'shipping' => $supplier['rates'][$sh_id]['name'],
					);
				} else {
					$cart['shipping'][$sh_id] = $cart_shipping[$sh_id];
				}
			}

			$cart['shipping'][$sh_id]['rates'][$s_id] = $supplier['rates'][$sh_id]['rate'];
		}
	}

	// Calculate total shipping cost
	$cart['shipping_cost'] = 0;
	foreach ($cart['shipping'] as $sh_id => $shipping) {
		$cart['shipping_cost'] += array_sum($shipping['rates']);
	}

	Registry::get('view')->assign('suppliers', $suppliers); // FIXME: That's bad...
	Registry::get('view')->assign('supplier_ids', array_keys($suppliers)); // FIXME: That's bad...

	return true;
}

function fn_suppliers_calculate_shipping_rates(&$c, $o_id)
{
	if (!empty($o_id)) {
		$c = db_quote(" AND FIND_IN_SET(?i, supplier_ids)", $o_id);
	} else {
		$c = db_quote(" AND supplier_ids = ''");
	}
}


?>
