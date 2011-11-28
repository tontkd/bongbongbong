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
// $Id: fn.cart.php 7774 2009-07-31 09:47:01Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Get product description to show it in the cart
//
function fn_get_cart_product_data($hash, &$product, $skip_promotion, &$cart, &$auth)
{
	if (!empty($product['product_id'])) {

		$_p_statuses = array('A', 'H');
		$_c_statuses = array('A', 'H');

		$avail_cond = (AREA == 'C') ? db_quote(" AND ?:categories.membership_id IN (?n) AND ?:categories.status IN (?a)", array(0, $auth['membership_id']), $_c_statuses) : '';
		$avail_cond .= (AREA == 'C') ? db_quote(' AND ?:products.status IN (?a)', $_p_statuses) : '';
		$avail_cond .= (AREA == 'C') ? fn_get_localizations_condition('?:products.localization') : '';

		$join = " INNER JOIN ?:products_categories ON ?:products_categories.product_id = ?:products.product_id INNER JOIN ?:categories ON ?:categories.category_id = ?:products_categories.category_id $avail_cond";

		$_pdata = db_get_row("SELECT ?:products.product_id, GROUP_CONCAT(IF(?:products_categories.link_type = 'M', CONCAT(?:products_categories.category_id, 'M'), ?:products_categories.category_id)) as category_ids, ?:products.product_code, ?:products.weight, ?:products.tracking, ?:product_descriptions.product, ?:product_descriptions.short_description, ?:products.is_edp, ?:products.edp_shipping, ?:products.shipping_freight, ?:products.free_shipping, ?:products.zero_price_action, ?:products.tax_ids, ?:products.qty_step, ?:products.list_qty_count, ?:products.max_qty, ?:products.min_qty, ?:products.amount as in_stock FROM ?:products LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:products.product_id AND ?:product_descriptions.lang_code = ?s ?p WHERE ?:products.product_id = ?i GROUP BY ?:products.product_id", CART_LANGUAGE, $join, $product['product_id']);

		if (empty($_pdata)) {
			return false;
		}

		$_pdata['category_ids'] = fn_convert_categories($_pdata['category_ids']);

		$_pdata['options_count'] = db_get_field("SELECT COUNT(*) FROM ?:product_options WHERE product_id = ?i AND status = 'A'", $product['product_id']);

		fn_set_hook('get_cart_product_data', $product['product_id'], $_pdata, $product);

		$_pdata['base_price'] = $_pdata['price'] = fn_get_product_price($product['product_id'], $product['amount'], $auth);

		$product['stored_price'] = empty($product['stored_price']) ? 'N' : $product['stored_price'];
		$product['stored_discount'] = empty($product['stored_discount']) ? 'N' : $product['stored_discount'];
		$product['product_options'] = empty($product['product_options']) ? array() : $product['product_options'];

		if (empty($_pdata['product_id'])) { // FIXME - for deleted products for OM
			unset($cart['products'][$hash]);
			return array();
		}

		if (!empty($_pdata['options_count']) && empty($product['product_options'])) {
			$cart['products'][$hash]['product_options'] = fn_get_default_product_options($product['product_id']);
		}

		if (fn_check_amount_in_stock($product['product_id'], $product['amount'], $product['product_options'], $hash, $_pdata['is_edp'] , !empty($product['original_amount']) ? $product['original_amount'] : 0) == false) {
			unset($cart['products'][$hash]);
			$out_of_stock = true;
			return false;
		}

		$_pdata['calculation'] = array();

		if (isset($product['extra']['exclude_from_calculate'])) {
			$_pdata['exclude_from_calculate'] = $product['extra']['exclude_from_calculate'];
			$_pdata['aoc'] = !empty($product['extra']['aoc']);
			$_pdata['price'] = 0;
		} else {
			if ($product['stored_price'] == 'Y') {
				$_pdata['price'] = $product['price'];
			}
		}

		// If price defined and zero price action allows add zero priced product to cart, get price from the database
		if (isset($_pdata['price']) && $_pdata['zero_price_action'] != 'A') {
			$product['price'] = floatval($_pdata['price']);
			$cart['products'][$hash]['price'] = $product['price'];
		}

		$_pdata['pure_price'] = $product['price'];

		if ($product['stored_price'] != 'Y' && !isset($product['extra']['exclude_from_calculate'])) {
			if ($_pdata['zero_price_action'] != 'A' || $_pdata['zero_price_action'] == 'A' && empty($product['modifiers_price'])) {
				$_tmp = $product['price'];
				$product['price'] = fn_apply_options_modifiers($product['product_options'], $product['price'], 'P');
				$product['modifiers_price'] = $_pdata['modifiers_price'] = $product['price'] - $_tmp; // modifiers
			}
		} else {
			$product['modifiers_price'] = $_pdata['modifiers_price'] = 0;
		}

		if (isset($product['modifiers_price']) && $_pdata['zero_price_action'] == 'A') {
			$_pdata['base_price'] = $product['price'] - $product['modifiers_price'];
		}

		$_pdata['weight'] = fn_apply_options_modifiers($product['product_options'], $_pdata['weight'], 'W');
		$_pdata['amount'] = $product['amount'];
		$_pdata['price'] = $_pdata['original_price'] = fn_format_price($product['price']);

		$_pdata['stored_price'] = $product['stored_price'];

		if ($cart['options_style'] == 'F') {
			$_pdata['product_options'] = fn_get_selected_product_options($product['product_id'], $product['product_options'], CART_LANGUAGE);
		} elseif ($cart['options_style'] == 'I') {
			$_pdata['product_options'] = fn_get_selected_product_options_info($product['product_options'], CART_LANGUAGE);
		} else {
			$_pdata['product_options'] = $product['product_options'];
		}

		if (($_pdata['is_edp'] != 'Y' && $_pdata['free_shipping'] != 'Y') || ($_pdata['is_edp'] == 'Y' && $_pdata['edp_shipping'] == 'Y')) {
			$cart['shipping_required'] = true;
		}

		$cart['products'][$hash]['is_edp'] = (@$_pdata['is_edp'] == 'Y') ? 'Y' : '';

		if (empty($cart['products'][$hash]['extra']['parent'])) { // count only products without parent
			$cart['amount'] += $product['amount'];
		}

		if ($skip_promotion == false) {
			if (empty($cart['order_id'])) {
				fn_promotion_apply('catalog', $_pdata, $auth);
			} else {
				if (empty($product['original_discount'])) {
					$product['original_discount'] = !empty($product['discount']) ? $product['discount'] : 0;
					$cart['products'][$hash]['original_discount'] = $product['original_discount'];
				}
				if (isset($product['discount'])) {
					$_pdata['discount'] = $product['discount'];
					$_pdata['price'] -= $product['discount'];

					if ($_pdata['price'] < 0) {
						$_pdata['discount'] += $_pdata['price'];
						$_pdata['price'] = 0;
					}
				}
			}

			// apply discount to the product
			if (!empty($_pdata['discount'])) {
				$cart['use_discount'] = true;
			}
		}

		$_pdata['stored_discount'] = $product['stored_discount'];
		$cart['products'][$hash]['modifiers_price'] = $product['modifiers_price'];

		$_pdata['subtotal'] = $_pdata['price'] * $product['amount'];
		$cart['pure_subtotal'] += $_pdata['original_price'] * $product['amount'];
		$cart['subtotal'] += $_pdata['subtotal'];

		return $_pdata;
	}

	return array();
}

function fn_update_cart_data(&$cart, &$cart_products)
{
	foreach ($cart_products as $k => $v) {
		if (isset($cart['products'][$k])) {
			if (!isset($v['base_price'])) {
				$cart['products'][$k]['base_price'] = $v['base_price'] = $cart['products'][$k]['stored_price'] != 'Y' ? $v['price'] : $cart['products'][$k]['price'];
			} else {
				if ($cart['products'][$k]['stored_price'] == 'Y') {
					$cart_products[$k]['base_price'] = $cart['products'][$k]['price'];
				}
			}

			$cart['products'][$k]['base_price'] = $cart['products'][$k]['stored_price'] != 'Y' ? $v['base_price'] : $cart['products'][$k]['price'];
			$cart['products'][$k]['price'] = $cart['products'][$k]['stored_price'] != 'Y' ? $v['price'] : $cart['products'][$k]['price'];
			if (isset($v['discount'])) {
				$cart['products'][$k]['discount'] = $v['discount'];
			}
			if (isset($v['promotions'])) {
				$cart['products'][$k]['promotions'] = $v['promotions'];
			}
		}
	}
}

//
// Get payment methods
//
function fn_get_payment_methods(&$auth, $lang_code = CART_LANGUAGE)
{
	$condition = '';
	if (AREA == 'C') {
		$condition = db_quote(" AND ?:payments.membership_id IN (?n) AND ?:payments.status = 'A' AND (?:payment_processors.type != 'C' OR ?:payments.processor_id = 0)", array(0, $auth['membership_id']));
		$condition .= fn_get_localizations_condition('?:payments.localization');
	}

	$payment_methods = db_get_hash_array("SELECT ?:payments.payment_id, ?:payments.a_surcharge, ?:payments.p_surcharge, ?:payment_descriptions.* FROM ?:payments LEFT JOIN ?:payment_descriptions ON ?:payments.payment_id = ?:payment_descriptions.payment_id AND ?:payment_descriptions.lang_code = ?s LEFT JOIN ?:payment_processors ON ?:payment_processors.processor_id = ?:payments.processor_id WHERE 1 $condition ORDER BY ?:payments.position", 'payment_id', $lang_code);

	fn_set_hook('get_payment_methods', $payment_methods);

	return $payment_methods;
}

function fn_get_simple_payment_methods($lang_code = CART_LANGUAGE)
{
	return db_get_hash_single_array("SELECT ?:payments.payment_id, ?:payment_descriptions.payment FROM ?:payments LEFT JOIN ?:payment_descriptions ON ?:payments.payment_id = ?:payment_descriptions.payment_id AND ?:payment_descriptions.lang_code = ?s WHERE status = 'A' ORDER BY ?:payments.position, ?:payment_descriptions.payment", array('payment_id', 'payment'), $lang_code);
}

//
// Get payment method data
//
function fn_get_payment_method_data($payment_id, $lang_code = CART_LANGUAGE)
{
	$payment = db_get_row("SELECT ?:payments.*, ?:payment_descriptions.*, ?:payment_processors.processor, ?:payments.params FROM ?:payments LEFT JOIN ?:payment_processors ON ?:payment_processors.processor_id = ?:payments.processor_id LEFT JOIN ?:payment_descriptions ON ?:payments.payment_id = ?:payment_descriptions.payment_id AND ?:payment_descriptions.lang_code = ?s WHERE ?:payments.payment_id = ?i", $lang_code, $payment_id);

	$payment['params'] = (!empty($payment['params'])) ? unserialize($payment['params']) : '';

	fn_set_hook('summary_get_payment_method', $payment_id, $payment);

	return $payment;
}

//
// Update product amount
//
// returns true if inventory successfully updated and false if amount
// is negative is allow_negative_amount option set to false

function fn_update_product_amount($product_id = 0, $amount, $product_options = array(), $sign)
{
	if (Registry::get('settings.General.inventory_tracking') != 'Y') {
		return true;
	}

	$tracking = db_get_field("SELECT tracking FROM ?:products WHERE product_id = ?i", $product_id);

	if ($tracking == 'D') {
		return true;
	}

	if ($tracking == 'B') {
		$current_amount = db_get_field("SELECT amount FROM ?:products WHERE product_id = ?i", $product_id);
	} else {
		$cart_id = fn_generate_cart_id($product_id, array('product_options' => $product_options), true);
		$current_amount = db_get_field("SELECT amount FROM ?:product_options_inventory WHERE combination_hash = ?i", $cart_id);
	}

	if ($sign == '-') {
		$new_amount = $current_amount - $amount;

		// Notify administrator about inventory low stock
		if ($new_amount <= Registry::get('settings.General.low_stock_threshold')) {
			// Log product low-stock
			fn_log_event('products', 'low_stock', array (
				'product_id' => $product_id
			));

			$lang_code = Registry::get('settings.Appearance.admin_default_language');
			Registry::get('view_mail')->assign('new_amount', $new_amount);
			Registry::get('view_mail')->assign('product_id', $product_id);
			Registry::get('view_mail')->assign('product', db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $product_id, $lang_code));
			if ($tracking == 'O') {
				Registry::get('view_mail')->assign('product_options', fn_get_selected_product_options_info($product_options, $lang_code));
			}
			fn_send_mail(Registry::get('settings.Company.company_orders_department'), Registry::get('settings.Company.company_orders_department'), 'orders/low_stock_subj.tpl', 'orders/low_stock.tpl', '', $lang_code);
		}

		if ($new_amount < 0 && Registry::get('settings.General.allow_negative_amount') != 'Y') {
			return false;
		}
	} else {
		$new_amount = $current_amount + $amount;
	}

	fn_set_hook('update_product_amount', $new_amount, $product_id);

	if ($tracking == 'B') {
		db_query("UPDATE ?:products SET amount = ?i WHERE product_id = ?i", $new_amount, $product_id);
	} else {
		db_query("UPDATE ?:product_options_inventory SET amount = ?i WHERE combination_hash = ?i", $new_amount, $cart_id);
	}

	return true;
}

/**
 * Order placing function
 *
 * @param array $cart
 * @param array $auth
 * @param string $action
 * @return int order_id or bool FALSE
 */
function fn_place_order(&$cart, &$auth, $action = '')
{
	$allow = true;

	fn_set_hook('pre_place_order', $cart, $allow);

	if ($allow == true && !fn_cart_is_empty($cart)) {
		$ip = fn_get_ip();
		$__order_status = 'O';
		$order = fn_check_table_fields($cart, 'orders');
		$order = fn_array_merge($order, fn_check_table_fields($cart['user_data'], 'orders'));
	
		$order['user_id'] = $auth['user_id'];
		$order['timestamp'] = TIME;
		$order['lang_code'] = CART_LANGUAGE;
		$order['tax_exempt'] = $auth['tax_exempt'];
		$order['status'] = 'B'; // backorder by default to increase inventory
		$order['ip_address'] = $ip['host'];

		$order['promotions'] = serialize(!empty($cart['promotions']) ? $cart['promotions'] : array());
		if (!empty($cart['promotions'])) {
			$order['promotion_ids'] = implode(', ', array_keys($cart['promotions']));
		}

		$order['shipping_ids'] = !empty($cart['shipping']) ? fn_create_set(array_keys($cart['shipping'])) : '';

		if (!empty($cart['payment_surcharge'])) {
			$cart['total'] += $cart['payment_surcharge'];
			$order['total'] = $cart['total'];
		}

		if (!empty($cart['payment_info'])) {
			$ccards = fn_get_static_data_section('C', true);
			if (!empty($cart['payment_info']['card']) && !empty($ccards[$cart['payment_info']['card']])) {
				// Check if cvv2 number required and unset it if not
				if ($ccards[$cart['payment_info']['card']]['param_2'] != 'Y') {
					unset($cart['payment_info']['cvv2']);
				}
				// Check if start date exists and required and convert it to string
				if ($ccards[$cart['payment_info']['card']]['param_3'] != 'Y') {
					unset($cart['payment_info']['start_year'], $cart['payment_info']['start_month']);
				}
				// Check if issue number required
				if ($ccards[$cart['payment_info']['card']]['param_4'] != 'Y') {
					unset($cart['payment_info']['issue_number']);
				}
			}
		}

		// We're editing existing order
		if (!empty($order['order_id'])) {

			$_tmp = db_get_row("SELECT status, ip_address, details, timestamp, lang_code FROM ?:orders WHERE order_id = ?i", $order['order_id']);
			$order['ip_address'] = $_tmp['ip_address']; // Leave original customers IP address
			$order['details'] = $_tmp['details']; // Leave order details
			$order['timestamp'] = $_tmp['timestamp']; // Leave the original date
			$order['lang_code'] = $_tmp['lang_code']; // Leave the original language

			if ($action == 'save') {
				$__order_status = $_tmp['status']; // Get the original order status
			}

			fn_change_order_status($order['order_id'], 'B', $_tmp['status'], false); // backorder the order to increase inventory amount.

			db_query("DELETE FROM ?:orders WHERE order_id = ?i", $order['order_id']);
			db_query("DELETE FROM ?:order_details WHERE order_id = ?i", $order['order_id']);
			db_query("DELETE FROM ?:profile_fields_data WHERE object_id = ?i AND object_type = 'O'", $order['order_id']);
			db_query("DELETE FROM ?:order_data WHERE order_id = ?i AND type IN ('T', 'C', 'P')", $order['order_id']);

			fn_set_hook('edit_place_order', $order['order_id']);
		}

		$order_id = db_query("INSERT INTO ?:orders ?e", $order);

		// Log order creation
		fn_log_event('orders', 'create', array(
			'order_id' => $order_id
		));

		fn_store_profile_fields($cart['user_data'], $order_id, 'O');

		$order['order_id'] = $order_id;
		// If customer is not logged in, store order ids in the session
		if (empty($auth['user_id'])) {
			$auth['order_ids'][] = $order_id;
		}
		// Add order details data
		if (!empty($order_id)) {
			if (!empty($cart['products'])) {
				foreach ((array)$cart['products'] as $k => $v) {
					$product_code = '';
					$extra = empty($v['extra']) ? array() : $v['extra'];

					if (isset($v['is_edp'])) {
						$extra['is_edp'] = $v['is_edp'];
					}
					if (!empty($v['discount'])) {
						$extra['discount'] = $v['discount'];
					}
					if (!empty($v['base_price'])) {
						$extra['base_price'] = $v['base_price'];
					}
					if (!empty($v['promotions'])) {
						$extra['promotions'] = $v['promotions'];
					}

					if (!empty($v['product_options'])) {
						$extra['product_options'] = $v['product_options'];
						$cart_id = fn_generate_cart_id($v['product_id'], array('product_options' => $v['product_options']), true);
						$product_code = db_get_field("SELECT product_code FROM ?:product_options_inventory WHERE combination_hash = ?i", $cart_id);
					} else {
						$v['product_options'] = array();
					}

					if (empty($product_code)) {
						$product_code = db_get_field("SELECT product_code FROM ?:products WHERE product_id = ?i", $v['product_id']);
					}

					$order_details = array (
						'item_id' => $k,
						'order_id' => $order_id,
						'product_id' => $v['product_id'],
						'product_code' => $product_code,
						'price' => $v['price'],
						'amount' => $v['amount'],
						'extra' => serialize($extra)
					);

					db_query("INSERT INTO ?:order_details ?e", $order_details);
					
					// Increase product popularity
					$_data = array (
						'product_id' => $v['product_id'],
						'bought' => 1,
						'total' => POPULARITY_BUY
					);
					
					db_query("INSERT INTO ?:product_popularity ?e ON DUPLICATE KEY UPDATE bought = bought + 1, total = total + ?i", $_data, POPULARITY_BUY);
				}
			}

			// Save shipping information
			if (!empty($cart['shipping'])) {
				// Get carriers and tracking number
				if ($action == 'save') {
					$data = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = 'L'", $order_id);
					if (!empty($data)) {
						$data = unserialize($data);
						foreach ($cart['shipping'] as $sh_id => $_d) {
							if (!empty($data[$sh_id]['carrier'])) {
								$cart['shipping'][$sh_id]['carrier'] = $data[$sh_id]['carrier'];
							}

							if (!empty($data[$sh_id]['tracking_number'])) {
								$cart['shipping'][$sh_id]['tracking_number'] = $data[$sh_id]['tracking_number'];
							}
						}
					}
				}
				$_data = array (
					'order_id' => $order_id,
					'type' => 'L', //shipping information
					'data' => serialize($cart['shipping'])
				);
				db_query("REPLACE INTO ?:order_data ?e", $_data);
			}

			// Save taxes
			if (!empty($cart['taxes'])) {
				$_data = array (
					'order_id' => $order_id,
					'type' => 'T', //taxes information
					'data' => serialize($cart['taxes']),
				);
				db_query("REPLACE INTO ?:order_data ?e", $_data);
			}

			// Save payment information
			if (!empty($cart['payment_info'])) {
				$_data = array (
					'order_id' => $order_id,
					'type' => 'P', //payment information
					'data' => fn_encrypt_text(serialize($cart['payment_info'])),
				);
				db_query("REPLACE INTO ?:order_data ?e", $_data);
			}

			// Save coupons information
			if (!empty($cart['coupons'])) {
				$_data = array (
					'order_id' => $order_id,
					'type' => 'C', //coupons
					'data' => serialize($cart['coupons']),
				);
				db_query("REPLACE INTO ?:order_data ?e", $_data);
			}

			//
			// Place the order_id to new_orders table for all admin profiles
			//
			$admins = db_get_fields("SELECT user_id FROM ?:users WHERE user_type = 'A'");
			foreach ($admins as $k => $v) {
				db_query("REPLACE INTO ?:new_orders (order_id, user_id) VALUES (?i, ?i)", $order_id, $v);
			}

			fn_set_hook('place_order', $order_id, $action, $__order_status, $cart);

			// If order total is zero, just save the order without any processing procedures
			if (floatval($cart['total']) == 0) {
				$action = 'save';
				$__order_status = 'P';
			}

			// Set new order status
			fn_change_order_status($order_id, $__order_status, '', false);

			return array($order_id, $action != 'save');
		}
	}

	return array(false, false);
}

/**
 * Order payment processing
 *
 * @param array $payment payment data
 * @param int $order_id order ID
 * @param bool $force_notification force user notification (true - notify, false - do not notify, order status properties will be skipped)
 */
function fn_start_payment($order_id, $force_notification = null)
{
	$order_info = fn_get_order_info($order_id);
	$payment = fn_get_payment_method_data($order_info['payment_id']);

	if (!empty($payment['processor_id'])) {
		set_time_limit(300);
		$processor_data = fn_get_processor_data($payment['payment_id']);
		if (!empty($processor_data['processor_script']) && file_exists(DIR_PAYMENT_FILES . $processor_data['processor_script'])) {
			$idata = array (
				'order_id' => $order_id,
				'type' => 'S',
				'data' => TIME,
			);
			db_query("REPLACE INTO ?:order_data ?e", $idata);


			$index_script = INDEX_SCRIPT;
			$mode = MODE;

			include(DIR_PAYMENT_FILES . $processor_data['processor_script']);

			return fn_finish_payment($order_id, $pp_response, $force_notification);
		}
	}

	return false;
}

/**
 * Finish order paymnent
 *
 * @param int $order_id order ID
 * @param array $pp_response payment response
 * @param bool $force_notification force user notification (true - notify, false - do not notify, order status properties will be skipped)
 */
function fn_finish_payment($order_id, $pp_response, $force_notification = null)
{
	// Change order status
	$valid_id = db_get_field("SELECT order_id FROM ?:order_data WHERE order_id = ?i AND type = 'S'", $order_id);

	if (!empty($valid_id)) {
		db_query("DELETE FROM ?:order_data WHERE order_id = ?i AND type = 'S'", $order_id);
		fn_change_order_status($order_id, $pp_response['order_status'], '', $force_notification);

		fn_update_order_payment_info($order_id, $pp_response);
	}
}

//
// Store cart content in the customer's profile
//
function fn_save_cart_content(&$cart, $user_id, $type = 'C', $user_type = 'R')
{
	if (empty($user_id)) {
		if (fn_get_cookie('cu_id')) {
			$user_id = fn_get_cookie('cu_id');
		} else {
			$user_id = fn_crc32(uniqid(TIME));
			fn_set_cookie('cu_id', $user_id, COOKIE_ALIVE_TIME);
		}
		$user_type = 'U';
	}

	if (!empty($user_id)) {
		db_query("DELETE FROM ?:user_session_products WHERE user_id = ?i AND type = ?s AND user_type = ?s", $user_id, $type, $user_type);
		if (!empty($cart['products']) && is_array($cart['products'])) {
			$_cart_prods = $cart['products'];
			foreach ($_cart_prods as $_item_id => $_prod) {
				$_cart_prods[$_item_id]['user_id'] = $user_id;
				$_cart_prods[$_item_id]['timestamp'] = TIME;
				$_cart_prods[$_item_id]['type'] = $type;
				$_cart_prods[$_item_id]['user_type'] = $user_type;
				$_cart_prods[$_item_id]['item_id'] = $_item_id;
				$_cart_prods[$_item_id]['item_type'] = 'P';
				$_cart_prods[$_item_id]['extra'] = serialize($_prod);
				$_cart_prods[$_item_id]['amount'] = empty($_cart_prods[$_item_id]['amount']) ? 1 : $_cart_prods[$_item_id]['amount'];

				if (!empty($_cart_prods[$_item_id])) {
					db_query('REPLACE INTO ?:user_session_products ?e', $_cart_prods[$_item_id]);
				}
			}
		}

		fn_set_hook('save_cart', $cart, $user_id, $type);

	}
	return true;
}

/**
 * Extract cart content from the customer's profile.
 * $type : C - cart, W - wishlist
 *
 * @param array $cart
 * @param integer $user_id
 * @param char $type
 *
 * @return void
 */
function fn_extract_cart_content(&$cart, $user_id, $type = 'C', $user_type = 'R')
{
	$auth = & $_SESSION['auth'];

	// Restore cart content
	if (!empty($user_id)) {
		$item_types = fn_get_cart_content_item_types('X');
		$_prods = db_get_hash_array("SELECT * FROM ?:user_session_products WHERE user_id = ?i AND type = ?s AND user_type = ?s AND item_type IN (?a)", 'item_id', $user_id, $type, $user_type, $item_types);
		if (!empty($_prods) && is_array($_prods)) {
			$cart['products'] = empty($cart['products']) ? array() : $cart['products'];
			foreach ($_prods as $_item_id => $_prod) {
				$_prod_extra = unserialize($_prod['extra']);
				unset($_prod['extra']);
				$cart['products'][$_item_id] = empty($cart['products'][$_item_id]) ? fn_array_merge($_prod, $_prod_extra, true) : $cart['products'][$_item_id];
			}
		}
	}

	fn_set_hook('extract_cart', $cart, $user_id, $type, $user_type);

	if ($type == 'C') {
		fn_calculate_cart_content($cart, $auth, 'S', false, 'I');
	}
}
/**
 * get cart content item types
 *
 * @param char $action
 * V - for View mode
 * X - for eXtract mode
 * @return array
 */
function fn_get_cart_content_item_types($action = 'V')
{
	$item_types = array('P');

	fn_set_hook('get_cart_item_types', $item_types, $action);

	return $item_types;
}

//
// Get order name
//
function fn_get_order_name($order_id)
{
	$total = db_get_field("SELECT total FROM ?:orders WHERE order_id = ?i", $order_id);
	if ($total == '') {
		return false;
	}
	$currencies = Registry::get('currencies');
	$currency = $currencies[CART_SECONDARY_CURRENCY];
	$value = fn_format_rate_value($total, 'F', $currency['decimals'], $currency['decimals_separator'], $currency['thousands_separator'], $currency['coefficient']);
	return $order_id . ' (' . $value . $currency['symbol'] . ')';
}

//
// Get order info
//
function fn_get_order_info($order_id, $native_language = false, $format_info = true, $get_edp_files = false)
{
	if (!empty($order_id)) {
		$order = db_get_row("SELECT * FROM ?:orders WHERE ?:orders.order_id = ?i", $order_id);

		if (empty($order)) {
			return false;
		}

		$lang_code = ($native_language == true) ? $order['lang_code'] : CART_LANGUAGE;

		$order['payment_method'] = fn_get_payment_method_data($order['payment_id'], $lang_code);

		if (!empty($order)) {
			// Get additional profile fields
			$additional_fields = db_get_hash_single_array("SELECT field_id, value FROM ?:profile_fields_data WHERE object_id = ?i AND object_type = 'O'", array('field_id', 'value'), $order_id);
			$order['fields'] = $additional_fields;

			$order['items'] = db_get_hash_array("SELECT ?:order_details.*, ?:product_descriptions.product FROM ?:order_details LEFT JOIN ?:product_descriptions ON ?:order_details.product_id = ?:product_descriptions.product_id AND ?:product_descriptions.lang_code = ?s WHERE ?:order_details.order_id = ?i ORDER BY ?:product_descriptions.product", 'item_id', $lang_code, $order_id);

			$order['promotions'] = unserialize($order['promotions']);
			if (!empty($order['promotions'])) { // collect additional data
				$params = array (
					'promotion_id' => array_keys($order['promotions']),
				);
				list($promotions) = fn_get_promotions($params);
				foreach ($promotions as $pr_id => $p) {
					$order['promotions'][$pr_id]['name'] = $p['name'];
					$order['promotions'][$pr_id]['short_description'] = $p['short_description'];
				}
			}

			// Get additional data
			$additional_data = db_get_hash_single_array("SELECT type,data FROM ?:order_data WHERE order_id = ?i", array('type', 'data'), $order_id);

			$order['taxes'] = array();
			$order['tax_subtotal'] = 0;
			$order['display_shipping_cost'] = $order['shipping_cost'];

			// Replace country, state and title values with their descriptions
			fn_add_user_data_descriptions($order, $lang_code);

			$deps = array();
			foreach ($order['items'] as $k => $v) {
				//Check for product existance
				if (empty($v['product'])) {
					$order['items'][$k]['deleted_product'] = true;
				}
				$order['items'][$k]['discount'] = 0;

				$v['extra'] = @unserialize($v['extra']);
				if (!empty($v['extra']['discount']) && floatval($v['extra']['discount'])) {
					$order['items'][$k]['discount'] = $v['extra']['discount'];
					$order['use_discount'] = true;
				}

				if (!empty($v['extra']['promotions'])) {
					$order['items'][$k]['promotions'] = $v['extra']['promotions'];
				}

				if (!empty($v['extra']['base_price'])) {
					$order['items'][$k]['base_price'] = $v['extra']['base_price'];
				}

				// Form hash key for this product
				$order['items'][$k]['cart_id'] = $v['item_id'];
				$deps['P_'.$order['items'][$k]['cart_id']] = $k;

				// Unserialize and collect product options information
				if (!empty($v['extra']['product_options']) && $format_info == true) {
					$order['items'][$k]['product_options'] = fn_get_selected_product_options_info($v['extra']['product_options'], $lang_code);
				}

				$order['items'][$k]['extra'] = $v['extra'];
				$order['items'][$k]['tax_value'] = 0;
				$order['items'][$k]['display_subtotal'] = $order['items'][$k]['subtotal'] = ($v['price'] * $v['amount']);

				// Get information about edp
				if ($get_edp_files == true && !empty($order['items'][$k]['extra']['is_edp'])) {
					$order['items'][$k]['files'] = db_get_array("SELECT ?:product_files.file_id, ?:product_files.activation_type, ?:product_files.max_downloads, ?:product_file_descriptions.file_name, ?:product_file_ekeys.active, ?:product_file_ekeys.downloads, ?:product_file_ekeys.ekey, ?:product_file_ekeys.ttl FROM ?:product_files LEFT JOIN ?:product_file_descriptions ON ?:product_file_descriptions.file_id = ?:product_files.file_id AND ?:product_file_descriptions.lang_code = ?s LEFT JOIN ?:product_file_ekeys ON ?:product_file_ekeys.file_id = ?:product_files.file_id AND ?:product_file_ekeys.order_id = ?i WHERE ?:product_files.product_id = ?i", $lang_code, $order_id, $v['product_id']);
				}
			}

			// Unserialize and collect taxes information
			if (!empty($additional_data['T'])) {
				$order['taxes'] = unserialize($additional_data['T']);
				if (is_array($order['taxes'])) {
					foreach ($order['taxes'] as  $tax_id => $tax_data) {
						foreach ($tax_data['applies'] as $_id => $value) {
							if (strpos($_id, 'P_') !== false && isset($deps[$_id])) {
								$order['items'][$deps[$_id]]['tax_value'] += $value;
								if ($tax_data['price_includes_tax'] != 'Y') {
									$order['items'][$deps[$_id]]['subtotal'] += $value;
									$order['items'][$deps[$_id]]['display_subtotal'] += (Registry::get('settings.Appearance.cart_prices_w_taxes') == 'Y') ? $value : 0;
									$order['tax_subtotal'] += $value;
								}
							}
							if (strpos($_id, 'S_') !== false && Registry::get('settings.Appearance.cart_prices_w_taxes') == 'Y') {
								if ($tax_data['price_includes_tax'] != 'Y') {
									$order['display_shipping_cost'] += $value;
								}
							}
						}
					}
				} else {
					$order['taxes'] = array();
				}
			}

			if (!empty($additional_data['C'])) {
				$order['coupons'] = unserialize($additional_data['C']);
			}

			// Recalculate subtotal
			$order['subtotal'] = $order['display_subtotal'] = 0;
			foreach ($order['items'] as $v) {
				$order['subtotal'] += $v['subtotal'];
				$order['display_subtotal'] += $v['display_subtotal'];
			}

			// Unserialize and collect payment information
			if (!empty($additional_data['P'])) {
				$order['payment_info'] = unserialize(fn_decrypt_text($additional_data['P']));
			}

			if (empty($order['payment_info']) || !is_array($order['payment_info'])) {
				$order['payment_info'] = array();
			}

			// Get shipping information
			if (!empty($additional_data['L'])) {
				$order['shipping'] = unserialize($additional_data['L']);
			}
		}

		fn_set_hook('get_order_info', $order, $additional_data);

		return $order;
	}

	return false;
}

//
// Get order short info
//
function fn_get_order_short_info($order_id)
{
	if (!empty($order_id)) {
		$order = db_get_row("SELECT total, status, firstname, lastname, timestamp FROM ?:orders WHERE order_id = ?i", $order_id);

		return $order;
	}

	return false;
}

//
// Change order status
//
function fn_change_order_status($order_id, $status_to, $status_from = '', $force_notification = null)
{
	$order_info = fn_get_order_info($order_id, true);
	$order_statuses = fn_get_statuses(STATUSES_ORDER);

	if (empty($status_from)) {
		$status_from = $order_info['status'];
	}

	if (empty($status_to) || $status_from == $status_to) {
		return false;
	}

	fn_promotion_post_processing($status_to, $status_from, $order_info, $force_notification);

	fn_set_hook('change_order_status', $status_to, $status_from, $order_info, $force_notification, $order_statuses);

	// Log order status change
	fn_log_event('orders', 'status', array (
		'order_id' => $order_id,
		'status_from' => $status_from,
		'status_to' => $status_to,
	));

	foreach ($order_info['items'] as $k => $v) {

		// Generate ekey if EDP is ordered
		if (!empty($v['extra']['is_edp']) && $v['extra']['is_edp'] == 'Y') {
			continue; // don't track inventory
		}

		// Update product amount if inventory tracking is enabled
		if (Registry::get('settings.General.inventory_tracking') == 'Y') {
			if ($order_statuses[$status_to]['inventory'] == 'D' && $order_statuses[$status_from]['inventory'] == 'I') {
				// decrease amount
				if (fn_update_product_amount($v['product_id'], $v['amount'], @$v['extra']['product_options'], '-') == false) {
					$status_to = 'B'; //backorder
					break;
				}
			} elseif ($order_statuses[$status_to]['inventory'] == 'I' && $order_statuses[$status_from]['inventory'] == 'D') {
				// increase amount
				fn_update_product_amount($v['product_id'], $v['amount'], @$v['extra']['product_options'], '+');
			}
		}
	}

	// Check if we need to remove CC info
	if (!empty($order_statuses[$status_to]['remove_cc_info']) && $order_statuses[$status_to]['remove_cc_info'] == 'Y' && !empty($order_info['payment_info'])) {
		fn_cleanup_payment_info($order_id, $order_info['payment_info'], true);
	}

	$edp_data = fn_generate_ekeys_for_edp(array('status_from' => $status_from, 'status_to' => $status_to), $order_info);
	$order_info['status'] = $status_to;

	fn_order_notification($order_info, $edp_data, $force_notification);

	db_query("UPDATE ?:orders SET status = ?s WHERE order_id = ?i", $status_to, $order_id);

	return true;
}

/**
 * Function generate edp ekeys for email notification
 *
 * @param array $statuses order statuses
 * @param array $order_info order information
 * @param array $active_files array with file download statuses
 * @return array $edp_data
 */

function fn_generate_ekeys_for_edp($statuses, $order_info, $active_files = array())
{
	$edp_data = array();
	$order_statuses = fn_get_statuses();

	foreach ($order_info['items'] as $v) {

		// Generate ekey if EDP is ordered
		if (!empty($v['extra']['is_edp']) && $v['extra']['is_edp'] == 'Y') {

			$activations = db_get_hash_single_array("SELECT activation_type, file_id FROM ?:product_files WHERE product_id = ?i", array('file_id', 'activation_type'), $v['product_id']);

			foreach ($activations as $file_id => $activation_type) {

				$send_notification = false;

				// Check if ekey already was generated for this file
				$_ekey = db_get_row("SELECT ekey, active, file_id, product_id, order_id, ekey FROM ?:product_file_ekeys WHERE file_id = ?i AND order_id = ?i", $file_id, $order_info['order_id']);
				if (!empty($_ekey)) {
					// If order status changed to "Processed"
					if ($activation_type == 'P' && !empty($statuses)) {
						if ($order_statuses[$statuses['status_to']]['inventory'] == 'D' && substr_count('O', $statuses['status_to']) == 0 && ($order_statuses[$statuses['status_from']]['inventory'] != 'D' || substr_count('O', $statuses['status_from']) > 0)) {
							$active_files[$v['product_id']][$file_id] = 'Y';
						} elseif (($order_statuses[$statuses['status_to']]['inventory'] != 'D' && substr_count('O', $statuses['status_from']) == 0 || substr_count('O', $statuses['status_to']) > 0) && $order_statuses[$statuses['status_from']]['inventory'] == 'D') {
							$active_files[$v['product_id']][$file_id] = 'N';
						}
					}

					if (!empty($active_files[$v['product_id']][$file_id])) {
						db_query('UPDATE ?:product_file_ekeys SET ?u WHERE file_id = ?i AND product_id = ?i AND order_id = ?i', array('active' => $active_files[$v['product_id']][$file_id]), $_ekey['file_id'], $_ekey['product_id'], $_ekey['order_id']);

						if ($active_files[$v['product_id']][$file_id] == 'Y' && $_ekey['active'] !== 'Y') {
							$edp_data[$v['product_id']]['files'][$file_id] = $_ekey;
						}
					}

				} else {
					$_data = array (
						'file_id' => $file_id,
						'product_id' => $v['product_id'],
						'ekey' => md5(uniqid(rand())),
						'ttl' => (TIME + (Registry::get('settings.General.edp_key_ttl') * 60 * 60)),
						'order_id' => $order_info['order_id']
					);

					// If file activation type is "Immediately"
					if ($activation_type == 'I' || !empty($active_files[$v['product_id']][$file_id]) && $active_files[$v['product_id']][$file_id] == 'Y') {
						$_data['active'] = 'Y';
						$edp_data[$v['product_id']]['files'][$file_id] = $_data;
					}

					db_query('REPLACE INTO ?:product_file_ekeys ?e', $_data);
				}

				if (!empty($edp_data[$v['product_id']]['files'][$file_id])) {
					$edp_data[$v['product_id']]['files'][$file_id]['file_size'] = db_get_field("SELECT file_size FROM ?:product_files WHERE file_id = ?i", $file_id);
					$edp_data[$v['product_id']]['files'][$file_id]['file_name'] = db_get_field("SELECT file_name FROM ?:product_file_descriptions WHERE file_id = ?i AND lang_code = ?s", $file_id, CART_LANGUAGE);
				}
			}
		}
	}

	return $edp_data;
}

//
// Update order payment information
//
function fn_update_order_payment_info($order_id, $pp_response)
{
	if (empty($order_id) || empty($pp_response) || !is_array($pp_response)) {
		return false;
	}

	$payment_info = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = 'P'", $order_id);
	if (!empty($payment_info)) {
		$payment_info = unserialize(fn_decrypt_text($payment_info));
	} else {
		$payment_info = array();
	}


	foreach ($pp_response as $k => $v) {
		$payment_info[$k] = $v;
	}

	$data = array (
		'data' => fn_encrypt_text(serialize($payment_info)),
		'order_id' => $order_id,
		'type' => 'P'
	);

	db_query("REPLACE INTO ?:order_data ?e", $data);

	return true;
}

//
// Get all shippings list
//


function fn_get_shippings($simple, $lang_code = CART_LANGUAGE)
{
	$conditions = '1';

	if (AREA == 'C') {
		$conditions .= " AND a.membership_id IN ('0', '{$_SESSION['auth']['membership_id']}')";
		$conditions .= " AND a.status = 'A'";
		$conditions .= fn_get_localizations_condition('a.localization');
	}

	if ($simple == true) {
		return db_get_hash_single_array("SELECT a.shipping_id, b.shipping FROM ?:shippings as a LEFT JOIN ?:shipping_descriptions as b ON a.shipping_id = b.shipping_id AND b.lang_code = ?s WHERE ?p ORDER BY a.position", array('shipping_id', 'shipping'), $lang_code, $conditions);
	} else {
		return db_get_array("SELECT a.shipping_id, a.min_weight, a.max_weight, a.position, a.status, b.shipping, b.delivery_time, a.membership_id FROM ?:shippings as a LEFT JOIN ?:shipping_descriptions as b ON a.shipping_id = b.shipping_id AND b.lang_code = ?s WHERE ?p ORDER BY a.position", $lang_code, $conditions);
	}
}

//
// Get all rates for specific shipping
//
function fn_get_shipping_rates($shipping_id)
{
	if (!empty($shipping_id)) {
		return db_get_array("SELECT rate_id, ?:shipping_rates.destination_id, destination FROM ?:shipping_rates LEFT JOIN ?:destination_descriptions ON ?:destination_descriptions.destination_id = ?:shipping_rates.destination_id AND ?:destination_descriptions.lang_code = ?s WHERE shipping_id = ?i", CART_LANGUAGE, $shipping_id);
	} else {
		return false;
	}
}

//
// Get shipping name
//
function fn_get_shipping_name($shipping_id, $lang_code = CART_LANGUAGE)
{
	if (!empty($shipping_id)) {
		return db_get_field("SELECT shipping FROM ?:shipping_descriptions WHERE shipping_id = ?i AND lang_code = ?s", $shipping_id, $lang_code);
	}

	return false;
}

//
// Get all taxes list
//
function fn_get_taxes($lang_code = '')
{
	if (empty($lang_code)) {
		$lang_code = CART_LANGUAGE;
	}

	return db_get_hash_array("SELECT a.*, b.tax FROM ?:taxes as a LEFT JOIN ?:tax_descriptions as b ON b.tax_id = a.tax_id AND b.lang_code = ?s ORDER BY a.priority", 'tax_id', $lang_code);
}

//
// Get tax name
//
function fn_get_tax_name($tax_id = 0, $lang_code = CART_LANGUAGE, $as_array = false)
{
	if (!empty($tax_id)) {
		if (!is_array($tax_id) && strpos($tax_id, ',') !== false) {
			$tax_id = explode(',', $tax_id);
		}
		if (is_array($tax_id) || $as_array == true) {
			return db_get_hash_single_array("SELECT tax_id, tax FROM ?:tax_descriptions WHERE tax_id IN (?n) AND lang_code = ?s", array('tax_id', 'tax'), $tax_id, $lang_code);
		} else {
			return db_get_field("SELECT tax FROM ?:tax_descriptions WHERE tax_id = ?i AND lang_code = ?s", $tax_id, $lang_code);
		}
	}

	return false;
}

//
// Get all rates for specific tax
//
function fn_get_tax_rates($tax_id, $destination_id = 0)
{
	if (empty($tax_id)) {
		return false;
	}
	return db_get_array("SELECT * FROM ?:tax_rates WHERE tax_id = ?i AND destination_id = ?i", $tax_id, $destination_id);
}

//
// Get selected taxes
//
function fn_get_set_taxes($taxes_set)
{
	if (empty($taxes_set)) {
		return false;
	}

	return db_get_hash_array("SELECT tax_id, address_type, priority, price_includes_tax, regnumber FROM ?:taxes WHERE tax_id IN (?n) AND status = 'A' ORDER BY priority", 'tax_id', explode(',', $taxes_set));
}

function fn_add_exclude_products(&$cart, &$auth)
{
	$subtotal = 0;
	$pure_subtotal = 0;

	if (isset($cart['products']) && is_array($cart['products'])) {
		foreach($cart['products'] as $cart_id => $product) {
			if (isset($product['extra']['exclude_from_calculate'])) {
				if (empty($cart['order_id'])) {
					unset($cart['products'][$cart_id]);
				}
			} else {
				$product_subtotal = fn_apply_options_modifiers($product['product_options'], $product['price'], 'P') * $product['amount'];
				$pure_subtotal += $product_subtotal;
				$subtotal += $product_subtotal - ((isset($product['discount'])) ? $product['discount'] : 0);
			}
		}
	}

	fn_set_hook('exclude_products_from_calculation', $cart, $auth, $pure_subtotal, $subtotal);

}

//
// Calculate cart content
//
// options style:
// F - full
// S - skip selection
// I - info
// calculate_shipping:
// A - calculate all available methods
// E - calculate selected methods only (from cart[shipping])
// S - skip calculation
function fn_calculate_cart_content(&$cart, $auth, $calculate_shipping = 'A', $calculate_taxes = true, $options_style = 'F', $apply_cart_promotions = true)
{
	$shipping_rates = array();
	$cart_products = array();
	$cart['subtotal'] = $cart['pure_subtotal'] = $cart['amount'] = $cart['total'] = $cart['discount'] = $cart['tax_subtotal'] = 0;
	$cart['use_discount'] = false;
	$cart['shipping_required'] = false;
	$cart['shipping_failed'] = false;
	$cart['stored_taxes'] = empty($cart['stored_taxes']) ? 'N': $cart['stored_taxes'];
	$cart['display_shipping_cost'] = $cart['shipping_cost'] = 0;
	$cart['coupons'] = empty($cart['coupons']) ? array() : $cart['coupons'];
	$cart['recalculate'] = isset($cart['recalculate']) ? $cart['recalculate'] : false;
	$cart['free_shipping'] = array();
	$cart['options_style'] = $options_style;

	fn_add_exclude_products($cart, $auth);

	if (isset($cart['products']) && is_array($cart['products'])) {

		// Collect product data
		foreach ($cart['products'] as $k => $v) {

			$_cproduct = fn_get_cart_product_data($k, $cart['products'][$k], false, $cart, $auth);
			if (empty($_cproduct)) { // FIXME - for deleted products for OM
				unset($cart['products'][$k]);
				continue;
			}

			$cart_products[$k] = $_cproduct;
		}

		fn_set_hook('calculate_cart_items', $cart, $cart_products, $auth);

		// Apply cart promotions
		if ($apply_cart_promotions == true && $cart['subtotal'] > 0 && empty($cart['order_id'])) {
			fn_promotion_apply('cart', $cart, $auth, $cart_products);
		}


		if (Registry::get('settings.Shippings.disable_shipping') == 'Y') {
			$cart['shipping_required'] = false;
		}
		
		// Apply shipping fee
		if ($calculate_shipping != 'S' && $cart['shipping_required'] == true) {

			if (defined('CACHED_SHIPPING_RATES') && $cart['recalculate'] == false) {
				$shipping_rates = $_SESSION['shipping_rates'];
			} else {
				$shipping_rates = fn_calculate_shipping_rates($cart, $cart_products, $auth, ($calculate_shipping == 'E'));
			}

			fn_apply_cart_shipping_rates($cart, $cart_products, $auth, $shipping_rates);

			if (!empty($cart['stored_shipping'])) {
				$total_cost = 0;
				foreach ($cart['shipping'] as $sh_id => $method) {
					if (isset($cart['stored_shipping'][$sh_id])) {
						$piece = fn_format_price($cart['stored_shipping'][$sh_id] / count($method['rates']));
						foreach ($method['rates'] as $k => $v) {
							$cart['shipping'][$sh_id]['rates'][$k] = $piece;
							$total_cost += $piece;
						}
						if (($sum = array_sum($cart['shipping'][$sh_id]['rates'])) != $cart['stored_shipping'][$sh_id]) {
							$deviation = $cart['stored_shipping'][$sh_id] - $sum;
							$value = reset($cart['shipping'][$sh_id]['rates']);
							$key = key($cart['shipping'][$sh_id]['rates']);
							$cart['shipping'][$sh_id]['rates'][$key] = $value + $deviation;
							$total_cost += $deviation;
						}
					} else {
						if (!empty($method['rates'])) {
							$total_cost += array_sum($method['rates']);
						}
					}
				}
				$cart['shipping_cost'] = $total_cost;
			}

		} else {
			$cart['shipping'] = $shipping_rates = array();
			$cart['shipping_cost'] = 0;
		}

		$cart['display_shipping_cost'] = $cart['shipping_cost'];

		// Calculate taxes
		if ($cart['subtotal'] > 0 && $calculate_taxes == true && $auth['tax_exempt'] != 'Y') {
			fn_calculate_taxes($cart, $cart_products, $shipping_rates, $auth);
		} elseif ($cart['stored_taxes'] != 'Y') {
			$cart['taxes'] = array();
		}

		$cart['subtotal'] = $cart['display_subtotal'] = 0;

		fn_update_cart_data($cart, $cart_products);

		// Calculate totals
		foreach ($cart_products as $k => $v) {
			$_tax = (!empty($cart_products[$k]['tax_summary']) ? ($cart_products[$k]['tax_summary']['added'] / $v['amount']) : 0);
			$cart_products[$k]['display_price'] = $cart_products[$k]['price'] + (Registry::get('settings.Appearance.cart_prices_w_taxes') == 'Y' ? $_tax : 0);
			$cart_products[$k]['subtotal'] = $cart_products[$k]['price'] * $v['amount'];

			$cart_products[$k]['display_subtotal'] = $cart_products[$k]['display_price'] * $v['amount'];

			$cart['subtotal'] += $cart_products[$k]['subtotal'];
			$cart['display_subtotal'] += $cart_products[$k]['display_subtotal'];
			$cart['products'][$k]['display_price'] = $cart_products[$k]['display_price'];

			$cart['tax_subtotal'] += (!empty($cart_products[$k]['tax_summary']) ? ($cart_products[$k]['tax_summary']['added']) : 0);

			$cart['total'] += ($cart_products[$k]['price'] - 0) * $v['amount'];

			if (!empty($v['discount'])) {
				$cart['discount'] += $v['discount'] * $v['amount'];
			}
		}

		$cart['subtotal'] = fn_format_price($cart['subtotal']);
		$cart['display_subtotal'] = fn_format_price($cart['display_subtotal']);

		$cart['total'] += $cart['tax_subtotal'];

		$cart['total'] = fn_format_price($cart['total'] + $cart['shipping_cost']);

		if (!empty($cart['subtotal_discount'])) {
			$cart['total'] -= ($cart['subtotal_discount'] < $cart['total']) ? $cart['subtotal_discount'] : $cart['total'];
		}
	}

	fn_set_hook('calculate_cart', $cart, $cart_products, $auth, $calculate_shipping, $calculate_taxes, $apply_cart_promotions);

	$cart['recalculate'] = false;
	return array (
		$cart_products,
		$shipping_rates
	);
}

function fn_cart_is_empty($cart)
{
	$result = true;

	if (!empty($cart['products'])) {
		foreach ($cart['products'] as $v) {
			if (!isset($v['extra']['exclude_from_calculate']) && empty($v['extra']['parent'])) {
				$result = false;
				break;
			}
		}
	}

	if ($result == true) {
		fn_set_hook('is_cart_empty', $cart, $result);
	}

	return $result;
}

/**
 * Calculate total cost of products in cart
 *
 * @param array $cart cart information
 * @param array $cart_products cart products
 * @param char $type S - cost for shipping, A - all, C - all, exception excluded from calculation
 * @return int products cost
 */
function fn_get_products_cost($cart, $cart_products, $type = 'S')
{
	$cost = 0;

	if (is_array($cart_products)) {
		foreach ($cart_products as $k => $v) {
			if ($type == 'S') {
				if (($v['is_edp'] == 'Y' && $v['edp_shipping'] != 'Y') || $v['free_shipping'] == 'Y' || fn_exclude_from_shipping_calculate($cart['products'][$k])) {
					continue;
				}
			} elseif ($type == 'C') {
				if (isset($v['exclude_from_calculate'])) {
					continue;
				}
			}
			if (isset($v['price'])) {
				$cost += $v['subtotal'];
			}
		}
	}

	return $cost;
}

/**
 * Calculate total weight of products in cart
 *
 * @param array $cart cart information
 * @param array $cart_products cart products
 * @param char $type S - weight for shipping, A - all, C - all, exception excluded from calculation
 * @return int products weight
 */
function fn_get_products_weight($cart, $cart_products, $type = 'S')
{
	$weight = 0;

	if (is_array($cart_products)) {
		foreach ($cart_products as $k => $v) {
			if ($type == 'S') {
				if (($v['is_edp'] == 'Y' && $v['edp_shipping'] != 'Y') || $v['free_shipping'] == 'Y' || fn_exclude_from_shipping_calculate($cart['products'][$k])) {
					continue;
				}
			} elseif ($type == 'C') {
				if (isset($v['exclude_from_calculate'])) {
					continue;
				}
			}

			if (isset($v['weight'])) {
				$weight += ($v['weight'] * $v['amount']);
			}
		}
	}

	return !empty($weight) ? sprintf("%.2f", $weight) : '0.01';
}

/**
 * Calculate total quantity of products in cart
 *
 * @param array $cart cart information
 * @param array $cart_products cart products
 * @param char $type S - quantity for shipping, A - all, C - all, exception excluded from calculation
 * @return int products quantity
 */
function fn_get_products_amount($cart, $cart_products, $type = 'S')
{
	$amount = 0;

	foreach ($cart_products as $k => $v) {
		if ($type == 'S') {
			if (($v['is_edp'] == 'Y' && $v['edp_shipping'] != 'Y') || $v['free_shipping'] == 'Y' || fn_exclude_from_shipping_calculate($cart['products'][$k])) {
				continue;
			}
		} elseif ($type == 'C') {
			if (isset($v['exclude_from_calculate'])) {
				continue;
			}
		}

		$amount += $v['amount'];
	}

	return $amount;
}

// Get Payment processor data
function fn_get_processor_data($payment_id)
{
	$pdata = db_get_row("SELECT processor_id, params FROM ?:payments WHERE payment_id = ?i", $payment_id);
	if (empty($pdata)) {
		return false;
	}

	$processor_data = db_get_row("SELECT * FROM ?:payment_processors WHERE processor_id = ?i", $pdata['processor_id']);
	$processor_data['params'] = unserialize($pdata['params']);

	$processor_data['currencies'] = (!empty($processor_data['currencies'])) ? explode(',', $processor_data['currencies']) : array();

	return $processor_data;
}

//
// Calculate shipping rate
//
function fn_calculate_shipping_rate($package, $rate_value)
{
	$rate_value = unserialize($rate_value);

	$base_cost = $package['C'];
	$shipping_cost = 0;

	foreach ($package as $type => $amount) {
		if (isset($rate_value[$type]) && is_array($rate_value[$type])) {
			$__rval = array_reverse($rate_value[$type], true);
			foreach ($__rval as $__amnt => $__data) {
				if ($__amnt < $amount) {
					/*if (!empty($__data['per_unit']) && $__data['per_unit'] == 'Y') {
					$__data['value'] = (($__data['type'] == 'F') ? $__data['value'] : ($base_cost * $__data['value'])/100) * $package[$type];
					}*/

					$shipping_cost += (($__data['type'] == 'F') ? $__data['value'] : ($base_cost * $__data['value'])/100) * ((!empty($__data['per_unit']) && $__data['per_unit'] == 'Y') ? $package[$type] : 1);
					break;
				}
			}
		}
	}

	return fn_format_price($shipping_cost);
}

//
// Calculate shipping rates based on cart data and user info
//
function fn_calculate_shipping_rates(&$cart, &$cart_products, $auth, $calculate_selected = false)
{
	$shipping_rates = array();

	$condition = '';
	if ($calculate_selected == true) {
		$shipping_ids = !empty($cart['shipping']) ? array_keys($cart['shipping']) : array();
		if (!empty($shipping_ids)) {
			$condition = db_quote(" AND a.shipping_id IN (?n)", $shipping_ids);
		} else {
			return array();
		}
	}


	$condition .= fn_get_localizations_condition('a.localization');

	$location = fn_get_customer_location($auth, $cart);
	$destination_id = fn_get_available_destination($location);


	$package_infos = fn_prepare_package_info($cart, $cart_products);

	foreach ($package_infos as $o_id => $package_info) {

		$c = '';
		fn_set_hook('calculate_shipping_rates', $c, $o_id);

		$shipping_methods = db_get_hash_array("SELECT a.shipping_id, a.rate_calculation, a.service_id, b.shipping as name, b.delivery_time FROM ?:shippings as a LEFT JOIN ?:shipping_descriptions as b ON a.shipping_id = b.shipping_id AND b.lang_code = ?s WHERE a.membership_id IN (?n) AND (a.min_weight <= ?d AND (a.max_weight >= ?d OR a.max_weight = 0.00)) AND a.status = 'A' ?p ?p ORDER BY a.position", 'shipping_id', CART_LANGUAGE, array(0, $auth['membership_id']), $package_info['W'], $package_info['W'], $condition, $c);

		if (empty($shipping_methods)) {
			continue;
		}

		$found_rates = array();

		foreach ($shipping_methods as $method) {

			// Manual rate calculation
			if ($method['rate_calculation'] == 'M') {
				if ($destination_id !== false) {
					$rate_data = db_get_row("SELECT rate_id, rate_value FROM ?:shipping_rates WHERE shipping_id = ?i AND destination_id = ?i", $method['shipping_id'], $destination_id);

					if (!empty($rate_data)) {
						$found_rates[$method['shipping_id']] = fn_calculate_shipping_rate($package_info, $rate_data['rate_value']);
					}
				}

				// Realtime rate calculation
			} else {
				$charge = db_get_field("SELECT rate_value FROM ?:shipping_rates WHERE shipping_id = ?i AND destination_id = 0", $method['shipping_id']);
				$rate_data = fn_calculate_realtime_shipping_rate($method['service_id'], $location, $package_info, $auth);

				if ($rate_data !== false) {
					$found_rates[$method['shipping_id']] = $rate_data['cost'];
					$found_rates[$method['shipping_id']] += fn_calculate_shipping_rate($package_info, $charge);
				}
			}
		}

		$shipping_freight = 0;
		foreach ($cart_products as $v) {
			$shipping_freight += ($v['shipping_freight'] * $v['amount']);
		}

		foreach ($found_rates as $shipping_id => $rate_value) {
			if (!isset($shipping_rates[$shipping_id])) {
				$shipping_rates[$shipping_id]['name'] = $shipping_methods[$shipping_id]['name'];
				$shipping_rates[$shipping_id]['delivery_time'] = $shipping_methods[$shipping_id]['delivery_time'];
			}

			$shipping_rates[$shipping_id]['rates'][$o_id] = $rate_value + $shipping_freight;
		}
	}

	return $shipping_rates;
}

//
// Returns customer location or default location
//
function fn_get_customer_location($auth, $cart, $billing = false)
{

	$s_info = array();
	$prefix = 's';
	if ($billing == true) {
		$prefix = 'b';
	}

	$fields = array (
		'country',
		'state',
		'city',
		'zipcode',
		'address',
		'address_2',
	);

	$u_info = (!empty($cart['user_data'])) ? $cart['user_data'] : ((empty($cart['user_data']) && !empty($auth['user_id'])) ? fn_get_user_info($auth['user_id'], true, $cart['profile_id']) : array());

	// Fill basic fields
	foreach ($fields as $field) {
		$s_info[$field] = !empty($u_info[$prefix . '_' . $field]) ? $u_info[$prefix . '_' . $field] : Registry::get("settings.General.default_$field");
	}

	// Add phone
	$s_info['phone'] = !empty($u_info['phone']) ? $u_info['phone'] : Registry::get('settings.General.default_phone');

	// Add residential address flag
	$s_info['residential_address'] = (!empty($u_info['residential_address'])) ? $u_info['residential_address'] : 'Y';

	// Get First and Last names
	$u_info['firstname'] = !empty($u_info['firstname']) ? $u_info['firstname'] : 'John';
	$u_info['lastname'] = !empty($u_info['lastname']) ? $u_info['lastname'] : 'Doe';

	if ($prefix == 'b') {
		$s_info['firstname'] = (!empty($u_info['b_firstname'])) ? $u_info['b_firstname'] : $u_info['firstname'];
		$s_info['lastname'] = (!empty($u_info['b_lastname'])) ? $u_info['b_lastname'] : $u_info['lastname'];
	} else {
		$s_info['firstname'] = (!empty($u_info['s_firstname'])) ? $u_info['s_firstname'] : (!empty($u_info['b_firstname']) ? $u_info['b_firstname'] : $u_info['firstname']);
		$s_info['lastname'] = (!empty($u_info['s_lastname'])) ? $u_info['s_lastname'] : (!empty($u_info['b_lastname']) ? $u_info['b_lastname'] : $u_info['lastname']);
	}

	// Get country/state descriptions
	$avail_country = db_get_field("SELECT COUNT(*) FROM ?:countries WHERE code = ?s AND status = 'A'", $s_info['country']);
	if (empty($avail_country)) {
		return array();
	}

	$avail_state = db_get_field("SELECT COUNT(*) FROM ?:states WHERE country_code = ?s AND code = ?s AND status = 'A'", $s_info['country'], $s_info['state']);
	if (empty($avail_state)) {
		$s_info['state'] = '';
	}

	return $s_info;
}

//
// Calculate taxes for the products
//
function fn_calculate_taxes(&$cart, &$cart_products, &$shipping_rates, $auth)
{
	// Calculate product taxes
	foreach ($cart_products as $k => $product) {
		if ($cart['stored_taxes'] == 'Y') {
			$taxes = array();
			foreach ((array)$cart['taxes'] as $_k => $_v) {
				if (!empty($_v['applies']['P_'.$k])) {
					$taxes[$_k] = $_v;
				}
			}
		} else {
			$taxes = fn_get_set_taxes($cart_products[$k]['tax_ids']);
		}

		if (empty($taxes)) {
			continue;
		}

		if (isset($product['subtotal'])) {
			$price = fn_format_price($product['subtotal'] / $product['amount']);
			$calculated_data['P_'.$k] = fn_calculate_tax_rates($taxes, $price, $product['amount'], $auth, $cart);

			$cart_products[$k]['tax_summary'] = array('included' => 0, 'added' => 0, 'total' => 0); // tax summary for 1 unit of product

			// Apply taxes to product subtotal
			if (!empty($calculated_data['P_' . $k])) {
				foreach ($calculated_data['P_' . $k] as $_k => $v) {
					$cart_products[$k]['taxes'][$_k] = $v;
					if ($taxes[$_k]['price_includes_tax'] != 'Y') {
						$cart_products[$k]['tax_summary']['added'] += $v['tax_subtotal'];
					} else {
						$cart_products[$k]['tax_summary']['included'] += $v['tax_subtotal'];
					}
				}
				$cart_products[$k]['tax_summary']['total'] = $cart_products[$k]['tax_summary']['added'] + $cart_products[$k]['tax_summary']['included'];
			}
		}
	}

	// Calculate shipping taxes
	if (!empty($shipping_rates)) {
		$tax_ids = array();
		if (defined('ORDER_MANAGEMENT')) {
			$_taxes = db_get_hash_single_array("SELECT tax_ids, shipping_id FROM ?:shippings WHERE shipping_id IN (?n)", array('shipping_id', 'tax_ids'), array_keys($shipping_rates));
			if (!empty($_taxes)) {
				foreach ($_taxes as $_ship => $_tax) {
					if (!empty($_tax)) {
						$_tids = explode(',', $_tax);
						foreach ($_tids as $_tid) {
							$tax_ids[$_ship] = $_tid;
						}
					}
				}
			}
		}

		foreach ($shipping_rates as $shipping_id => $shipping) {

			if ($cart['stored_taxes'] == 'Y') {
				$taxes = array();

				foreach ((array)$cart['taxes'] as $_k => $_v) {
					$exists = false;
					foreach ($_v['applies'] as $aid => $av) {
						if (strpos($aid, 'S_' . $shipping_id . '_') !== false) {
							$exists = true;

						}
					}
					if ($exists == true || (!empty($tax_ids[$shipping_id]) && $tax_ids[$shipping_id] == $_k)) {
						$taxes[$_k] = $_v;
						$taxes[$_k]['applies'] = array();
					}
				}
			} else {
				$taxes = array();
				$tax_ids = db_get_field("SELECT tax_ids FROM ?:shippings WHERE shipping_id = ?i", $shipping_id);
				if (!empty($tax_ids)) {
					$taxes = db_get_hash_array("SELECT tax_id, address_type, priority, price_includes_tax, regnumber FROM ?:taxes WHERE tax_id IN (?n) AND status = 'A' ORDER BY priority", 'tax_id', explode(',', $tax_ids));
				}
			}

			if (!empty($taxes) && !empty($cart['shipping'][$shipping_id])) {

				foreach ($cart['shipping'][$shipping_id]['rates'] as $k => $v){
					if (isset($cart['shipping'][$shipping_id]['rates'][$k])) {
						$calculated_data['S_' . $shipping_id . '_' . $k] = fn_calculate_tax_rates($taxes, $v, 1, $auth, $cart);
						if (!empty($calculated_data['S_' . $shipping_id . '_' . $k])) {
							foreach ($calculated_data['S_' . $shipping_id . '_' . $k] as $__k => $__v) {
								if ($taxes[$__k]['price_includes_tax'] != 'Y') {
									$cart['display_shipping_cost'] += Registry::get('settings.Appearance.cart_prices_w_taxes') == 'Y' ? $__v['tax_subtotal'] : 0;
                                    $cart['tax_subtotal'] += $__v['tax_subtotal'];
								}

								if ($cart['stored_taxes'] == 'Y') {
									$cart['taxes'][$__k]['applies']['S_' . $shipping_id . '_' . $k] = $__v['tax_subtotal'];
								}
							}
						}
					}
				}
			}
		}
	}

	if (!empty($calculated_data)) {
		$taxes_data = array();
		foreach ($calculated_data as $id => $_taxes) {
			if (empty($_taxes)) {
				continue;
			}
			foreach ($_taxes as $k => $v) {
				if (empty($taxes_data[$k])) {
					$taxes_data[$k] = $v;
					$taxes_data[$k]['tax_subtotal'] = 0;
				}
				$taxes_data[$k]['applies'][$id] = $v['tax_subtotal'];
				$taxes_data[$k]['tax_subtotal'] += $v['tax_subtotal'];
			}
		}

		//if ($cart['stored_taxes'] != 'Y') {
			$cart['taxes'] = $taxes_data;
		//}

		return true;
	} else { // FIXME!!! Test on order management
		$cart['taxes'] = array();
	}

	return false;
}

function fn_format_rate_value($rate_value, $rate_type, $decimals='2', $dec_point='.', $thousands_sep=',', $coefficient = '')
{
	if (!empty($coefficient) && @$rate_type != 'P') {
		$rate_value = $rate_value / floatval($coefficient);
	}

	if (empty($rate_type)) {
		$rate_type = 'F';
	}

	$value = number_format(fn_format_price($rate_value), $decimals, $dec_point, $thousands_sep);
	if ($rate_type == 'F') { // Flat rate
		return $value;
	}
	elseif ($rate_type == 'P') { // Percent rate
		return $value.'%';
	}

	return $rate_value;

}

function fn_check_amount_in_stock($product_id, $amount, $product_options, $cart_id, $is_edp = 'N', $original_amount = 0)
{

	// If the product is EDP don't track the inventory
	if ($is_edp == 'Y') {
		return 1;
	}

	$product = db_get_row("SELECT ?:products.tracking, ?:products.amount, ?:products.min_qty, ?:products.max_qty, ?:products.qty_step, ?:products.list_qty_count, ?:product_descriptions.product FROM ?:products LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:products.product_id AND lang_code = ?s WHERE ?:products.product_id = ?i", CART_LANGUAGE, $product_id);

	if (Registry::get('settings.General.inventory_tracking') == 'Y') {
		// Track amount for ordinary product
		if ($product['tracking'] == 'B') {
			$current_amount = $product['amount'];

		// Track amount for product with options
		} elseif ($product['tracking'] == 'O') {
			$selectable_cart_id = fn_generate_cart_id($product_id, array('product_options' => $product_options), true);
			$current_amount = db_get_field("SELECT amount FROM ?:product_options_inventory WHERE combination_hash = ?i", $selectable_cart_id);

			// Check if the product with the same selectable options already exists
			if (!empty($_SESSION['cart']['products']) && is_array($_SESSION['cart']['products'])) {
				foreach ($_SESSION['cart']['products'] as $k => $v) {
					if (($k != $cart_id) && (@$v['selectable_cart_id'] == $selectable_cart_id)) {
						$current_amount -= $v['amount'];
					}
				}
				// Store cart_id for selectable options in cart variable, so if the same product is added to
				// the cart with the same selectable options, but different text options,
				// the total amount will be tracked anyway as it is the one product
				if (!empty($selectable_cart_id)) {
					$_SESSION['cart']['products'][$cart_id]['selectable_cart_id'] = $selectable_cart_id;
				}
			}
		}
	}

	$min_qty = 1;

	if (!empty($product['min_qty']) && $product['min_qty'] > $min_qty) {
		$min_qty = $product['min_qty'];
	}

	if (!empty($product['qty_step']) && $product['qty_step'] > $min_qty) {
		$min_qty = $product['qty_step'];
	}

	if (!empty($product['qty_step']) && !empty($product['list_qty_count'])) {
		$per_item = 0;
		$amount_corrected = false;
		for ($i = 1; $per_item <= ($product['amount'] - $product['qty_step']); $i++) {
			$per_item = $product['qty_step'] * $i;

			if ($i > $product['list_qty_count']) {
				break;
			}

			if ((!empty($product['max_qty']) && $per_item > $product['max_qty']) || (!empty($product['min_qty']) && $per_item < $product['min_qty'])) {
				continue;
			}

			if ($amount == $per_item) {
				break;
			}

			if ($amount != $per_item && $amount < $per_item) {
				$amount = $per_item;
				$amount_corrected = true;
				break;
			}
		}
		if ($amount > $per_item) {
			$amount = $per_item;
			$amount_corrected = true;
		}
		if ($amount_corrected) {
			fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[product]', $product['product'], fn_get_lang_var('text_cart_amount_changed')));
		}
	}

	if ($amount < $min_qty) {
		fn_set_notification('W', fn_get_lang_var('notice'), str_replace(array('[product]' , '[quantity]'), array($product['product'] , $min_qty), fn_get_lang_var('text_cart_min_qty')));
		$amount = $min_qty;
	} elseif (!empty($product['max_qty']) && $amount > $product['max_qty']) {
		$amount = $product['max_qty'];
		fn_set_notification('W', fn_get_lang_var('notice'), str_replace(array('[product]' , '[quantity]'), array($product['product'], $product['max_qty']), fn_get_lang_var('text_cart_max_qty')));
	} elseif (isset($current_amount) && $current_amount >= 0 && $current_amount - $amount < 0 && Registry::get('settings.General.allow_negative_amount') != 'Y') {

		// For order edit: add original amount to existent amount
		$current_amount += $original_amount;

		if ($current_amount > 0 && $current_amount - $amount < 0 && Registry::get('settings.General.allow_negative_amount') != 'Y') {
			$amount = $current_amount;
			fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[product]', $product['product'], fn_get_lang_var('text_cart_amount_corrected')));
		} elseif ($current_amount - $amount < 0 && Registry::get('settings.General.allow_negative_amount') != 'Y') {
			fn_set_notification('E', fn_get_lang_var('notice'), str_replace('[product]', $product['product'], fn_get_lang_var('text_cart_zero_inventory')));
			return false;
		} elseif ($current_amount <= 0 && $amount <= 0 && Registry::get('settings.General.allow_negative_amount') != 'Y') {
			fn_set_notification('E', fn_get_lang_var('notice'), str_replace('[product]', $product['product'], fn_get_lang_var('text_cart_zero_inventory_and_removed')));
			return false;
		}
	}

	return empty($amount) ? false : $amount;
}

//
// Calculate unique product id in the cart
//
function fn_generate_cart_id($product_id, $extra, $only_selectable = false)
{
	$_cid = array();

	if (!empty($extra['product_options']) && is_array($extra['product_options'])) {
		foreach ($extra['product_options'] as $k => $v) {
			if ($only_selectable == true && ((string)intval($v) != $v || db_get_field("SELECT inventory FROM ?:product_options WHERE option_id = ?i", $k) != 'Y')) {
				continue;
			}
			$_cid[] = $v;
		}
	}

	if (isset($extra['exclude_from_calculate'])) {
		$_cid[] = $extra['exclude_from_calculate'];
	}

	fn_set_hook('generate_cart_id', $_cid, $extra, $only_selectable);

	natsort($_cid);
	array_unshift($_cid, $product_id);
	$cart_id = fn_crc32(implode('_', $_cid));

	return $cart_id;
}


//
// Normalize product amount
//
function fn_normalize_amount($amount = '1')
{
	$amount = abs(intval($amount));

	return empty($amount) ? 0 : $amount;
}

function fn_order_placement_routines($order_id, $force_notification = null, $clear_cart = true, $action = '')
{
	$order_info = fn_get_order_info($order_id, true);

	if (AREA == 'C' && !empty($order_info['user_id'])) {
		$__fake = '';
		fn_save_cart_content($__fake, $order_info['user_id']);
	}

	$edp_data = fn_generate_ekeys_for_edp(array(), $order_info);
	fn_order_notification($order_info, $edp_data, $force_notification);

	if ($action == 'save') {
		fn_set_notification('N', fn_get_lang_var('congratulations'), fn_get_lang_var('text_order_saved_successfully'));
	} else {
		if (substr_count('OP', $order_info['status']) > 0) {
			if ($action == 'repay') {
				fn_set_notification('N', fn_get_lang_var('congratulations'), fn_get_lang_var('text_order_repayed_successfully'));
			} else {
				fn_set_notification('N',fn_get_lang_var('order_placed'),fn_get_lang_var('text_order_placed_successfully'));
			}
		} elseif ($order_info['status'] == 'B') {
			fn_set_notification('N',fn_get_lang_var('order_placed'),fn_get_lang_var('text_order_backordered'));
		} else {
			fn_set_notification('E',fn_get_lang_var('order_placed'),fn_get_lang_var('text_order_placed_error'));
		}
	}

	// Empty cart
	if ($clear_cart == true) {
		$_SESSION['cart'] = array(
			'user_data' => $_SESSION['cart']['user_data'], 
			'profile_id' => !empty($_SESSION['cart']['profile_id']) ? $_SESSION['cart']['profile_id'] : 0, 
			'user_id' => !empty($_SESSION['cart']['user_id']) ? $_SESSION['cart']['user_id'] : 0,
		);
	}

	fn_set_hook('order_placement_routines', $order_id, $force_notification, $order_info);

    $prefix = ((Registry::get('settings.General.secure_auth') == 'Y') && (AREA == 'C')) ? Registry::get('config.https_location') . '/' : '';

 	fn_redirect($prefix . INDEX_SCRIPT . "?dispatch=orders.details&order_id=$order_id&confirmation=Y", true);
}

//
// Calculate difference
//
function fn_less_zero($first_arg, $second_arg = 0, $zero = false)
{
	if (!empty($second_arg)) {
		if ($first_arg - $second_arg > 0) {
			return $first_arg - $second_arg;
		} else {
			return 0;
		}
	} else {
		if (empty($zero)) {
			return $first_arg;
		} else {
			return 0;
		}
	}
}

//
// Add product to cart
//
// @param array $product_data array with data for the product to add)(product_id, price, amount, product_options, is_edp)
// @return mixed cart ID for the product if addition is successful and false otherwise
//
function fn_add_product_to_cart($product_data, &$cart, &$auth, $update = false)
{

	$ids = array();
	if (!empty($product_data) && is_array($product_data)) {

		fn_set_hook('pre_add_to_cart', $product_data, $cart, $auth, $update);

		foreach ($product_data as $key => $data) {
			if (empty($key)) {
				continue;
			}
			if (empty($data['amount'])) {
				continue;
			}

			$data['stored_price'] = (!empty($data['stored_price']) && AREA != 'C') ? $data['stored_price'] : 'N';

			if (empty($data['extra'])) {
				$data['extra'] = array();
			}

			$product_id = (!empty($data['product_id'])) ? $data['product_id'] : $key;

			// Check if product options exist
			if (!isset($data['product_options'])) {
				$data['product_options'] = fn_get_default_product_options($product_id);
			}

			// Generate cart id
			$data['extra']['product_options'] = $data['product_options'];

			$_id = fn_generate_cart_id($product_id, $data['extra'], false);

			if (isset($data['extra']['exclude_from_calculate'])) {
				if (!empty($cart['products'][$key]) && !empty($cart['products'][$key]['extra']['aoc'])) {
					$cart['saved_product_options'][$cart['products'][$key]['extra']['saved_options_key']] = $data['product_options'];
				}
				if (isset($cart['deleted_exclude_products'][$data['extra']['exclude_from_calculate']][$_id])) {
					continue;
				}
			}
			$amount = fn_normalize_amount(@$data['amount']);

			if (!isset($data['extra']['exclude_from_calculate'])) {
				if ($data['stored_price'] != 'Y') {
					// Check if the product price equals to zero
					$price = fn_get_product_price($product_id, $amount, $auth);
					if (!floatval($price)) {
						$data['price'] = isset($data['price']) ? $data['price'] : 0;
						$zero_price_action = db_get_field("SELECT zero_price_action FROM ?:products WHERE product_id = ?i", $product_id);
						if (($zero_price_action == 'R' || ($zero_price_action == 'A' && floatval($data['price']) < 0)) && AREA == 'C') {
							if ($zero_price_action == 'A') {
								fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('incorrect_price_warning'));
							}
							continue;
						}
						$price = empty($data['price']) ? 0 : $data['price'];
					}
				} else {
					$price = @$data['price'];
				}
			} else {
				$price = 0;
			}

			if (!isset($cart['products'][$_id])) { // If product doesn't exists in the cart
				$amount = empty($data['original_amount']) ? fn_check_amount_in_stock($product_id, $amount, $data['product_options'], $_id, @$data['is_edp']) : $data['original_amount'];
				if ($amount === false) {
					continue;
				}

				$cart['products'][$_id]['product_id'] = $product_id;
				$cart['products'][$_id]['amount'] = $amount;
				$cart['products'][$_id]['product_options'] = $data['product_options'];
				$cart['products'][$_id]['price'] = $price;
				$cart['products'][$_id]['stored_price'] = $data['stored_price'];

				if (!empty($data['original_amount'])) {
					$cart['products'][$_id]['original_amount'] = $data['original_amount'];
				}

				if ($update == true && $key != $_id) {
					unset($cart['products'][$key]);
				}

			} else { // If product is already exist in the cart

				$_initial_amount = empty($cart['products'][$_id]['original_amount']) ? $cart['products'][$_id]['amount'] : $cart['products'][$_id]['original_amount'];

				// If ID changed (options were changed), summ the total amount of old and new products
				if ($update == true && $key != $_id) {
					$amount += $_initial_amount;
					unset($cart['products'][$key]);
				}

				$cart['products'][$_id]['amount'] = fn_check_amount_in_stock($product_id, (($update == true) ? 0 : $_initial_amount) + $amount, $data['product_options'], $_id, @$data['is_edp']);
			}

			$cart['products'][$_id]['extra'] = (empty($data['extra'])) ? array() : $data['extra'];
			$cart['products'][$_id]['stored_discount'] = @$data['stored_discount'];
			if (defined('ORDER_MANAGEMENT')) {
				$cart['products'][$_id]['discount'] = @$data['discount'];
			}

			// Increase product popularity
			$_data = array (
				'product_id' => $product_id,
				'added' => 1,
				'total' => POPULARITY_ADD_TO_CART
			);
			
			db_query("INSERT INTO ?:product_popularity ?e ON DUPLICATE KEY UPDATE added = added + 1, total = total + ?i", $_data, POPULARITY_ADD_TO_CART);

			fn_set_hook('add_to_cart', $cart, $product_id, $_id);

			$ids[] = $product_id;
		}

		$cart['recalculate'] = true;
		return $ids;

	} else {
		return false;
	}
}

function fn_form_cart($order_id, &$cart, &$auth)
{

	$order_info = fn_get_order_info($order_id, false, false);

	// Fill the cart
	foreach ($order_info['items'] as $item) {
		$_item = array (
			$item['product_id'] => array (
				'amount' => $item['amount'],
				'product_options' => @$item['extra']['product_options'],
				'price' => $item['price'],
				'stored_discount' => 'Y',
				'stored_price' => 'Y',
				'discount' => @$item['extra']['discount'],
				'original_amount' => $item['amount'], // the original amount, that stored in order
			),
		);
		if (isset($item['extra'])) {
			$_item[$item['product_id']]['extra'] = $item['extra'];
		}
		fn_add_product_to_cart($_item, $cart, $auth);
	}

	$cart['payment_id'] = $order_info['payment_id'];
	$cart['stored_taxes'] = 'Y';
	$cart['stored_discount'] = 'Y';
	$cart['taxes'] = $order_info['taxes'];
	$cart['promotions'] = !empty($order_info['promotions']) ? $order_info['promotions'] : array();

	$cart['shipping'] = (!empty($order_info['shipping'])) ? $order_info['shipping'] : array();
	$cart['stored_shipping'] = array();
	foreach ($cart['shipping'] as $sh_id => $v) {
		if (!empty($v['rates'])) {
			$cart['stored_shipping'][$sh_id] = array_sum($v['rates']);
		}
	}

	$cart['notes'] = $order_info['notes'];
	$cart['payment_info'] = @$order_info['payment_info'];

	// Add order discount
	if (floatval($order_info['subtotal_discount'])) {
		$cart['stored_subtotal_discount'] = 'Y';
		$cart['subtotal_discount'] = $cart['original_subtotal_discount'] = fn_format_price($order_info['subtotal_discount']);
	}

	// Fill the cart with the coupons
	if (!empty($order_info['coupons'])) {
		$cart['coupons'] = $order_info['coupons'];
	}

	// Set the customer if exists
	$_data = array();
	if (!empty($order_info['user_id'])) {
		$_data = db_get_row("SELECT user_id, user_login as login, membership_id, membership_status FROM ?:users WHERE user_id = ?i", $order_info['user_id']);
	}
	$auth = fn_fill_auth($_data);
	$auth['tax_exempt'] = $order_info['tax_exempt'];

	// Fill customer info
	$cart['user_data'] = fn_check_table_fields($order_info, 'user_profiles');
	$cart['user_data'] = fn_array_merge(fn_check_table_fields($order_info, 'users'), $cart['user_data']);
	if (!empty($order_info['fields'])) {
		$cart['user_data']['fields'] = $order_info['fields'];
	}
	fn_add_user_data_descriptions($cart['user_data']);

	fn_set_hook('form_cart', $order_info, $cart);

}

//
// Calculate taxes for products or shippings
//
function fn_calculate_tax_rates($taxes, $price, $amount = 1, $auth, &$cart)
{
	static $destination_id;
	static $tax_description;
	static $user_data;

	$taxed_price = $price;

	if (empty($auth['user_id']) && (empty($cart['user_data']) || fn_is_empty($cart['user_data'])) && defined('CHECKOUT') && Registry::get('settings.Appearance.taxes_using_default_address') !== 'Y') {
		return false;
	}

	if ((empty($destination_id) || $user_data != @$cart['user_data'])) {
		// Get billing location
		$location = fn_get_customer_location($auth, $cart, true);
		$destination_id['B'] = fn_get_available_destination($location);

		// Get shipping location
		$location = fn_get_customer_location($auth, $cart);
		$destination_id['S'] = fn_get_available_destination($location);
	}

	if (!empty($cart['user_data'])) {
		$user_data = $cart['user_data'];
	}
	$_tax = 0;
	$previous_priority = 0;

	foreach ($taxes as $key => $tax) {
		if (empty($tax['tax_id'])) {
			$tax['tax_id'] = $key;
		}

		if (empty($tax['priority'])) {
			$tax['priority'] = 1;
		}

		$_is_zero = floatval($taxed_price);
		if (empty($_is_zero)) {
			continue;
		}

		if (!empty($cart['stored_taxes']) && $cart['stored_taxes'] == 'Y' && !empty($tax['rate_type'])) {
			$rate = array (
				'rate_value' => $tax['rate_value'],
				'rate_type' => $tax['rate_type'],
			);
		} else {
			if (!isset($destination_id[$tax['address_type']])) {
				continue;
			}

			$rate = db_get_row("SELECT destination_id, apply_to, rate_value, rate_type FROM ?:tax_rates WHERE tax_id = ?i AND destination_id = ?i", $tax['tax_id'], $destination_id[$tax['address_type']]);
			if (!@floatval($rate['rate_value'])) {
				continue;
			}
		}


		$base_price = ($tax['priority'] == $previous_priority) ? $previous_price : $taxed_price;

		if ($rate['rate_type'] == 'P') { // Percent dependence
			// If tax is included into the price
			if ($tax['price_includes_tax'] == 'Y') {
				$_tax = fn_format_price($base_price - $base_price / ( 1 + ($rate['rate_value'] / 100)));
				// If tax is NOT included into the price
			} else {
				$_tax = fn_format_price($base_price * ($rate['rate_value'] / 100));
				$taxed_price += $_tax;
			}

		} else {
			$_tax = fn_format_price($rate['rate_value']);
			// If tax is NOT included into the price
			if ($tax['price_includes_tax'] != 'Y') {
				$taxed_price += $_tax;
			}
		}

		$previous_priority = $tax['priority'];
		$previous_price = $base_price;

		if (empty($tax_description[$tax['tax_id']])) {
			$tax_description[$tax['tax_id']] = db_get_field("SELECT tax FROM ?:tax_descriptions WHERE tax_id = ?i AND lang_code = ?s", $tax['tax_id'], CART_LANGUAGE);
		}

		$taxes_data[$tax['tax_id']] = array (
			'rate_type' => $rate['rate_type'],
			'rate_value' => $rate['rate_value'],
			'price_includes_tax' => $tax['price_includes_tax'],
			'regnumber' => @$tax['regnumber'],
			'priority' => @$tax['priority'],
			'tax_subtotal' => fn_format_price($_tax * $amount),
			'description' => $tax_description[$tax['tax_id']],
		);
	}

	return empty($taxes_data) ? false : $taxes_data;
}

//
// Get order status data
//
function fn_get_status_data($status, $type = STATUSES_ORDER, $lang_code = CART_LANGUAGE)
{
	return db_get_row("SELECT * FROM ?:status_descriptions WHERE status = ?s AND type = ?s AND lang_code = ?s", $status, $type, $lang_code);
}

//
// Get all order statuses
//
function fn_get_statuses($type = STATUSES_ORDER, $simple = false, $lang_code = CART_LANGUAGE)
{
	if ($simple) {
		$statuses = db_get_hash_single_array("SELECT a.status, b.description FROM ?:statuses as a LEFT JOIN ?:status_descriptions as b ON b.status = a.status AND b.type = a.type AND b.lang_code = ?s WHERE a.type = ?s", array('status', 'description'), $lang_code, $type);
	} else {
		$statuses = db_get_hash_array("SELECT a.status, b.description FROM ?:statuses as a LEFT JOIN ?:status_descriptions as b ON b.status = a.status AND b.type = a.type AND b.lang_code = ?s WHERE a.type = ?s", 'status', $lang_code, $type);
		foreach ($statuses as $status => $data) {
			$statuses[$status] = fn_array_merge($statuses[$status], fn_get_status_params($status, $type));
		}
	}

	return $statuses;
}

function fn_get_status_params($status, $type = STATUSES_ORDER)
{

	return db_get_hash_single_array("SELECT param, value FROM ?:status_data WHERE status = ?s AND type = ?s", array('param', 'value'), $status, $type);
}


//
// Delete product from the cart
//
function fn_delete_cart_product(&$cart, $cart_id, $full_erase = true)
{
	fn_set_hook('delete_cart_product', $cart, $cart_id, $full_erase);

	if (!empty($cart_id)) {
		// Decrease product popularity
		$product_id = $cart['products'][$cart_id]['product_id'];
		
		$_data = array (
			'product_id' => $product_id,
			'deleted' => 1,
			'total' => 0
		);
		
		db_query("INSERT INTO ?:product_popularity ?e ON DUPLICATE KEY UPDATE deleted = deleted + 1, total = total - ?i", $_data, POPULARITY_DELETE_FROM_CART);
		
		unset($cart['products'][$cart_id]);
		$cart['recalculate'] = true;
	}

	return true;
}

//
// Checks whether this order used the current payment and calls the payment_cc_complete.php file
//
function fn_check_payment_script($script_name, $order_id)
{
	$payment_id = db_get_field("SELECT payment_id FROM ?:orders WHERE order_id = ?i", $order_id);
	$processor_data = fn_get_processor_data($payment_id);
	if ($processor_data['processor_script'] == $script_name) {
		return true;
	}
	return false;
}

//
// This function calculates product prices without taxes and with taxes
//
function fn_get_taxed_and_clean_prices(&$product, &$auth)
{
	$tax_value = 0;
	$included_tax = false;

	if (empty($product) || empty($product['product_id']) || empty($product['tax_ids'])) {
		return false;
	}
	if (isset($product['subtotal'])) {
		$tx_price =  $product['subtotal'];
	} elseif (empty($product['price'])) {
		$tx_price = 0;
	} elseif (isset($product['discounted_price'])) {
		$tx_price = $product['discounted_price'];
	} else {
		$tx_price = $product['price'];
	}

	$product_taxes = fn_get_set_taxes($product['tax_ids']);

	$calculated_data = fn_calculate_tax_rates($product_taxes, $tx_price, 1, $auth, $_SESSION['cart']);
	// Apply taxes to product subtotal
	if (!empty($calculated_data)) {
		foreach ($calculated_data as $_k => $v) {
			$tax_value += $v['tax_subtotal'];
			if ($v['price_includes_tax'] != 'Y') {
				$included_tax = true;
				$tx_price += $v['tax_subtotal'];
			}
		}
	}

	$product['clean_price'] = $tx_price - $tax_value;
	$product['taxed_price'] = $tx_price;
	$product['taxes'] = $calculated_data;
	$product['included_tax'] = $included_tax;

	return true;
}

function fn_clear_cart(&$cart, $complete = false, $clear_all = false)
{
	// Decrease products popularity
	if (!empty($cart['products'])) {
		$pids = array();
		
		foreach ($cart['products'] as $product) {
			$pids[] = $product['product_id'];
		}
		
		db_query("UPDATE ?:product_popularity SET deleted = deleted + 1, total = total - ?i WHERE product_id IN (?n)", POPULARITY_DELETE_FROM_CART, $pids);
	}
	
	if($clear_all) {
		$cart = array();
	} else {
	$cart = array (
		'products' => array(),
		'recalculate' => false,
		'user_data' => !empty($cart['user_data']) && $complete == false ? $cart['user_data'] : array(),
	);
	}
	return true;
}

function fn_apply_cart_shipping_rates(&$cart, &$cart_products, &$auth, &$shipping_rates)
{
	$cart['shipping_failed'] = true;

	if (!fn_is_empty($shipping_rates)) {

		// Delete all free shippings
		foreach ($shipping_rates as $k => $v) {
			if (!empty($v['free_shipping']) && !in_array($k, $cart['free_shipping'])) {
				if (!empty($v['original_rates'])) {
					$shipping_rates[$k]['rates'] = $v['original_rates'];
					unset($shipping_rates[$k]['free_shipping']);
				} else {
					unset($shipping_rates[$k]);
				}
			}
		}

		// Set free shipping rates
		if (!empty($cart['free_shipping'])) {
			foreach ($cart['free_shipping'] as $sh_id) {
				if (isset($shipping_rates[$sh_id])) {
					if (empty($shipping_rates[$sh_id]['added_manually'])) {
						if (empty($shipping_rates[$sh_id]['original_rates'])) { // save original rates
							$shipping_rates[$sh_id]['original_rates'] = $shipping_rates[$sh_id]['rates'];
						}
						foreach ($shipping_rates[$sh_id]['rates'] as $_k => $_v) { // null rates
							$shipping_rates[$sh_id]['rates'][$_k] = 0;
						}
					}
				} else {
					$name = db_get_row("SELECT b.shipping as name, b.delivery_time FROM ?:shippings as a LEFT JOIN ?:shipping_descriptions as b ON a.shipping_id = b.shipping_id AND b.lang_code = ?s WHERE a.shipping_id = ?i AND a.status = 'A'", CART_LANGUAGE, $sh_id);
					if (!empty($name)) {
						$shipping_rates[$sh_id] = $name;
						$shipping_rates[$sh_id]['rates'] = array(0);
						$shipping_rates[$sh_id]['added_manually'] = true;
					}
				}

				if (isset($shipping_rates[$sh_id])) {
					$shipping_rates[$sh_id]['free_shipping'] = true;
				}
			}
		}

		// Delete not existent rates
		if (!empty($cart['shipping'])) {
			foreach ($cart['shipping'] as $sh_id => $v) {
				foreach ($v['rates'] as $o_id => $r) {
					if (!isset($shipping_rates[$sh_id]['rates'][$o_id]) && empty($shipping_rates[$sh_id]['added_manually'])) {
						unset($cart['shipping'][$sh_id]);
					}
				}
			}
		}

		if (isset($cart['shipping']) && false != reset($cart['shipping']) && isset($shipping_rates[key($cart['shipping'])])) {
			$k = key($cart['shipping']);
			$first_method = $shipping_rates[$k];
		} else {
			$cart['shipping'] = array();
			$first_method = reset($shipping_rates);
			$k = key($shipping_rates);
		}

		$cart['shipping_cost'] = reset($first_method['rates']);
		$cart['shipping'] = fn_array_merge(isset($cart['shipping']) ? $cart['shipping'] : array(), array(
			$k => array(
				'shipping' => $first_method['name'],
				'rates' => $first_method['rates']
			)
		));

		if (!empty($cart['shipping'])) {
			$cart['shipping_failed'] = false;
		}

		fn_set_hook('apply_cart_shipping_rates', $cart, $cart_products, $auth, $shipping_rates);
	}
}

function fn_external_discounts($product)
{
	$discounts = 0;

	fn_set_hook('get_external_discounts', $product, $discounts);

	return $discounts;
}

// FIX-EVENT - must be revbuilt to check edp, free, etc
function fn_exclude_from_shipping_calculate($product)
{
	$exclude = false;

	fn_set_hook('exclude_from_shipping_calculation', $product, $exclude);

	return $exclude;
}
//
// This function is used to find out the total shipping cost. Used in payments, quickbooks
//

function fn_order_shipping_cost($order_info)
{
	$cost = (floatval($order_info['shipping_cost'])) ? $order_info['shipping_cost'] : 0;

	if (floatval($order_info['shipping_cost'])) {
		foreach($order_info['taxes'] as $tax) {
			if ($tax['price_includes_tax'] == 'N') {
				foreach ($tax['applies'] as $_id => $value) {
					if (strpos($_id, 'S_') !== false) {
						$cost += $value;
					}
				}
			}
		}
	}

	return $cost ? fn_format_price($cost) : 0;
}

//
// Cleanup payment information
//
function fn_cleanup_payment_info($order_id, $payment_info, $silent = false)
{

	if ($silent == false) {
		$processing_msg = fn_get_lang_var('processing_order');
		$done_msg = fn_get_lang_var('uc_ok');
		echo $processing_msg . '&nbsp;<b>#'.$order_id.'</b>...';
		fn_flush();
	}

	if (!is_array($payment_info)) {
		$info = @unserialize(fn_decrypt_text($payment_info));
	} else {
		$info = $payment_info;
	}

	if (!empty($info['cvv2'])) {
		$info['cvv2'] = 'XXX';
	}
	if (!empty($info['card_number'])) {
		$info['card_number'] = substr_replace($info['card_number'], str_repeat('X', strlen($info['card_number']) - 4), 0, strlen($info['card_number']) - 4);
	}

	foreach (array('start_month', 'start_year', 'expiry_month', 'expiry_year') as $v) {
		if (!empty($info[$v])) {
			$info[$v] = 'XX';
		}
	}

	$_data = fn_encrypt_text(serialize($info));
	db_query("UPDATE ?:order_data SET data = ?s WHERE order_id = ?i AND type = 'P'", $_data, $order_id);

	if ($silent == false) {
		echo $done_msg .'<br />';
	}
}

//
// Checks if order can be placed
//
function fn_allow_place_order(&$cart)
{
	$total = $cart['total'];

	fn_set_hook('allow_place_order', $total, $cart);

	$cart['amount_failed'] = (Registry::get('settings.General.min_order_amount') > $total && floatval($total));

	if (!empty($cart['amount_failed']) || !empty($cart['shipping_failed'])) {
		return false;
	}

	return true;
}

/**
 * Returns orders
 *
 * @param array $params array with search params
 * @param int $items_per_page
 * @param bool $get_totals
 * @param string $lang_code
 * @return array
 */

function fn_get_orders($params, $items_per_page = 0, $get_totals = false, $lang_code = CART_LANGUAGE)
{
	// Init filter
	$params = fn_init_view('orders', $params);

	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page']; // default page is 1

	// Define fields that should be retrieved
	$fields = array (
		"distinct ?:orders.order_id",
		"?:orders.user_id",
		"?:orders.timestamp",
		"?:orders.firstname",
		"?:orders.lastname",
		"?:orders.email",
		"?:orders.status",
		"?:orders.total"
	);

	// Define sort fields
	$sortings = array (
		'order_id' => "?:orders.order_id",
		'status' => "?:orders.status",
		'customer' => array("?:orders.firstname", "?:orders.lastname"),
		'email' => "?:orders.email",
		'date' => "?:orders.timestamp",
		'total' => "?:orders.total",
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'desc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'date';
	}

	$sorting = (is_array($sortings[$params['sort_by']]) ? implode(' ' . $directions[$params['sort_order']]. ', ', $sortings[$params['sort_by']]): $sortings[$params['sort_by']]). " " .$directions[$params['sort_order']];

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	$condition = $join = $group = '';

	if (!empty($params['cname'])) {
		$arr = explode(' ', $params['cname']);
		if (sizeof($arr) == 2) {
			$condition .= db_quote(" AND ?:orders.firstname LIKE ?l AND ?:orders.lastname LIKE ?l", "%$arr[0]%", "%$arr[1]%");
		} else {
			$condition .= db_quote(" AND (?:orders.firstname LIKE ?l OR ?:orders.lastname LIKE ?l)", "%$params[cname]%", "%$params[cname]%");
		}
	}

	if (!empty($params['tax_exempt'])) {
		$condition .= db_quote(" AND ?:orders.tax_exempt = ?s", $params['tax_exempt']);
	}

	if (!empty($params['email'])) {
		$condition .= db_quote(" AND ?:orders.email LIKE ?l", "%$params[email]%");
	}

	if (!empty($params['user_id'])){
		$condition .= db_quote(' AND ?:orders.user_id IN (?n)', $params['user_id']);
	}

	if (!empty($params['total_from'])) {
		$condition .= db_quote(" AND ?:orders.total >= ?d", fn_convert_price($params['total_from']));
	}

	if (!empty($params['total_to'])) {
		$condition .= db_quote(" AND ?:orders.total <= ?d", fn_convert_price($params['total_to']));
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(' AND ?:orders.status IN (?a)', $params['status']);
	}

	if (!empty($params['order_id'])) {
		$condition .= db_quote(' AND ?:orders.order_id IN (?n)', $params['order_id']);
	}

	if (!empty($params['p_ids']) || !empty($params['product_view_id'])) {
		$arr = (strpos($params['p_ids'], ',') !== false || !is_array($params['p_ids'])) ? explode(',', $params['p_ids']) : $params['p_ids'];

		if (empty($params['product_view_id'])) {
			$condition .= db_quote(" AND ?:order_details.product_id IN (?a)", $arr);
		} else {
			$condition .= db_quote(" AND ?:order_details.product_id IN (?p)", fn_get_products(array('view_id' => $params['product_view_id'], 'get_query' => true)));
		}

		$join .= " LEFT JOIN ?:order_details ON ?:order_details.order_id = ?:orders.order_id";
		$group .=  " GROUP BY ?:orders.order_id HAVING COUNT(?:orders.order_id) >= " . count($arr);
	}

	if (!empty($params['admin_user_id'])) {
		$condition .= db_quote(" AND ?:new_orders.user_id = ?i", $params['admin_user_id']);
		$join .= " LEFT JOIN ?:new_orders ON ?:new_orders.order_id = ?:orders.order_id";
	}

	if (!empty($params['shippings'])) {
		$set_conditions = array();
		foreach ($params['shippings'] as $v) {
			$set_conditions[] = db_quote("FIND_IN_SET(?s, ?:orders.shipping_ids)", $v);
		}
		$condition .= " AND (" . implode(' OR ', $set_conditions) . ")";
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);

		$condition .= db_quote(" AND (?:orders.timestamp >= ?i AND ?:orders.timestamp <= ?i)", $params['time_from'], $params['time_to']);
	}

	fn_set_hook('get_orders', $params, $fields, $sortings, $condition, $join);

	$limit = '';
	if (!empty($items_per_page)) {
		$total = db_get_field("SELECT DISTINCT(COUNT(?:orders.order_id)) FROM ?:orders $join WHERE 1 $condition $group");
		$limit = fn_paginate($params['page'], $total, $items_per_page);
	}

	$orders = db_get_array('SELECT ' . implode(', ', $fields) . " FROM ?:orders $join WHERE 1 $condition $group ORDER BY $sorting $limit");

	if ($get_totals == true) {
		$totals = array (
			'gross_total' => db_get_field("SELECT sum(total) FROM ?:orders $join WHERE 1 $condition"),
			'totally_paid' => db_get_field("SELECT sum(total) FROM ?:orders $join WHERE status IN ('P', 'C') $condition"),
		);
	}

	return array($orders, $params, ($get_totals == true ? $totals : array()));
}

/**
 * Calculate shipping rates using real-time shipping processors
 *
 * @param int $service_id shipping service ID
 * @param array $location customer location
 * @param array $package_info package information (weight, subtotal, qty)
 * @param array $auth customer session information
 * @param array $substitution_settings settings what can replace default shipping origination
 * @return mixed array with rates if calculated, false otherwise
 */
function fn_calculate_realtime_shipping_rate($service_id, $location, $package_info, &$auth)
{
	static $shipping_settings = array();
	static $included_modules = array();

	if (!class_exists('XMLDocument')) {
		include(DIR_LIB . 'xmldocument/xmldocument.php');
	}

	if (empty($shipping_settings)) {
		$shipping_settings = fn_get_settings('Shippings');
	}

	$code = db_get_row("SELECT intershipper_code, code, module FROM ?:shipping_services WHERE service_id = ?i AND status = 'A'", $service_id);

	if (empty($code)) {
		return false;
	}

	$weight = fn_expand_weight($package_info['W']);

	if (!empty($code['intershipper_code']) && $shipping_settings['intershipper_enabled'] == 'Y') { // FIXME - hardcoded intershipper
		$code['module'] = 'intershipper';
		$code['code'] = $code['intershipper_code'];
	}

	if (empty($included_modules[$code['module']])) {
		include(DIR_SHIPPING_FILES . $code['module'] . '.php');
		$included_modules[$code['module']] = true;
	}

	$func = 'fn_get_' . $code['module'] . '_rates';

	return $func($code['code'], $weight, $location, $auth, $shipping_settings, $package_info, $package_info['origination'], $service_id);
}

/**
 * Convert weight to pounds/ounces
 *
 * @param float $weight weight
 * @return array converted data
 */
function fn_expand_weight($weight)
{
	$full_ounces = ceil(round($weight * Registry::get('settings.General.weight_symbol_grams') / 28.35, 3));
	$full_pounds = sprintf("%.1f", $full_ounces/16);
	$pounds = floor($full_ounces/16);
	$ounces = $full_ounces - $pounds * 16;

	return array (
		'full_ounces' => $full_ounces,
		'full_pounds' => $full_pounds,
		'pounds' => $pounds,
		'ounces' => $ounces,
		'plain' => $weight,
	);
}

/**
 * Generate unique ID to cache rates calculation results
 *
 * @param mixed parameters to generate unique ID from
 * @return mixed array with rates if calculated, false otherwise
 */
function fn_generate_cached_rate_id()
{
	$data = array();
	$num_args = func_num_args();
	for($i = 0; $i < $num_args; $i++){
		$variable = func_get_arg($i);
		if (is_array($variable)){
			$data = fn_array_merge($data, $variable, false);
		} else {
			$data[] = $variable;
		}
	}

	natsort($data);

	return fn_crc32(implode('_', $data));
}

/**
 * Send order notification
 *
 * @param array $order_info order information
 * @param array $edp_data information about downloadable products
 * @param mixed $force_notification user notification flag (true/false), if not set, will be retrieved from status parameters
 * @return array structured data
 */
function fn_order_notification(&$order_info, $edp_data = array(), $force_notification = null)
{
	static $notified;

	if ($notified) {
		return true;
	}

	$order_statuses = fn_get_statuses(STATUSES_ORDER);
	$status_params = $order_statuses[$order_info['status']];

	$notify_user = !is_null($force_notification) ? $force_notification : (!empty($status_params['notify']) && $status_params['notify'] == 'Y' ? true : false);

	if ($notify_user == true) {
		$notified = true;
		Registry::get('view_mail')->assign('order_info', $order_info);
		Registry::get('view_mail')->assign('order_status', fn_get_status_data($order_info['status'], STATUSES_ORDER, $order_info['lang_code']));

		// Notify customer
		fn_send_mail($order_info['email'], Registry::get('settings.Company.company_orders_department'), 'orders/order_notification_subj.tpl', 'orders/order_notification.tpl', '', $order_info['lang_code']);

		// Notify administrator (only if the changes performed from customer area)
		if (AREA == 'C') {
			// Translate descriptions to admin language
			fn_translate_products($order_info['items'], 'product', Registry::get('settings.Appearance.admin_default_language'));
			Registry::get('view_mail')->assign('order_status', fn_get_status_data($order_info['status'], STATUSES_ORDER, Registry::get('settings.Appearance.admin_default_language')));

			fn_send_mail(Registry::get('settings.Company.company_orders_department'), Registry::get('settings.Company.company_orders_department'), 'orders/order_notification_subj.tpl', 'orders/order_notification.tpl', '', Registry::get('settings.Appearance.admin_default_language'), $order_info['email']);
		}

		if (!empty($edp_data)) {
			Registry::get('view_mail')->assign('edp_data', $edp_data);
			fn_send_mail($order_info['email'], Registry::get('settings.Company.company_orders_department'), 'orders/edp_access_subj.tpl', 'orders/edp_access.tpl', '', $order_info['lang_code']);
		}
	}

	fn_set_hook('order_notification', $order_info, $order_statuses, $force_notification);
}

function fn_prepare_package_info(&$cart, &$cart_products)
{
	$package_infos = array(array(
		'C' => fn_get_products_cost($cart, $cart_products),
		'W' => fn_get_products_weight($cart, $cart_products),
		'I' => fn_get_products_amount($cart, $cart_products),
		'origination' => array(
			'name' => Registry::get('settings.Company.company_name'),
			'address' => Registry::get('settings.Company.company_address'),
			'city' => Registry::get('settings.Company.company_city'),
			'country' => Registry::get('settings.Company.company_country'),
			'state' => Registry::get('settings.Company.company_state'),
			'zipcode' => Registry::get('settings.Company.company_zipcode'),
			'phone' => Registry::get('settings.Company.company_phone'),
			'fax' => Registry::get('settings.Company.company_fax'),
		)
	));

	fn_set_hook('prepare_package_info', $cart, $cart_products, $package_infos);

	return $package_infos;

}

?>
