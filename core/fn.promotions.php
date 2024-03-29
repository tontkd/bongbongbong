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
// $Id: fn.promotions.php 7833 2009-08-14 12:33:43Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

fn_define('COUPON_CODE_LENGTH', 8);

/**
 * Get promotions
 *
 * @param array $params array with search params
 * @param int $items_per_page
 * @param string $lang_code
 * @return array list of promotions in first element, filtered parameters in second
 */
function fn_get_promotions($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
	// Init filter
	$params = fn_init_view('promotions', $params);

	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page']; // default page is 1
	$params['get_hidden'] = !isset($params['get_hidden']) ? true : $params['get_hidden']; // always get hidden promotions

	// Define fields that should be retrieved
	$fields = array (
		"?:promotions.*",
		"?:promotion_descriptions.name",
		"?:promotion_descriptions.detailed_description",
		"?:promotion_descriptions.short_description",
	);

	// Define sort fields
	$sortings = array (
		'name' => "?:promotion_descriptions.name",
		'priority' => "?:promotions.priority",
		'zone' => "?:promotions.zone",
		'status' => "?:promotions.status",
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'desc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'name';
	}

	$sorting = (is_array($sortings[$params['sort_by']]) ? implode(' ' . $directions[$params['sort_order']]. ', ', $sortings[$params['sort_by']]): $sortings[$params['sort_by']]). " " .$directions[$params['sort_order']];

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	$condition = $join = $group = '';

	$statuses = array('A');
	if (!empty($params['get_hidden'])) {
		$statuses[] = 'H';
	}

	if (!empty($params['promotion_id'])) {
		$condition .= db_quote(' AND ?:promotions.promotion_id IN (?n)', $params['promotion_id']);
	}

	if (!empty($params['active'])) {
		$condition .= db_quote(" AND from_date <= ?i AND to_date >= ?i AND status IN (?a)", TIME, TIME, $statuses);
	}

	if (!empty($params['zone'])) {
		$condition .= db_quote(" AND ?:promotions.zone = ?s", $params['zone']);
	}

	if (!empty($params['coupon_code'])) {
		$condition .= db_quote(" AND ?:promotions.conditions_hash LIKE ?l", "%$params[coupon_code]%"); // FIXME, more smart rules
	}

	if (!empty($params['coupons'])) {
		$condition .= db_quote(" AND ?:promotions.conditions_hash LIKE ?l", "%coupon_code=%"); // FIXME
	}

	if (!empty($params['auto_coupons'])) {
		$condition .= db_quote(" AND ?:promotions.conditions_hash LIKE ?l", "%auto_coupons=%");
	}

	$join .= db_quote(" LEFT JOIN ?:promotion_descriptions ON ?:promotion_descriptions.promotion_id = ?:promotions.promotion_id AND ?:promotion_descriptions.lang_code = ?s", $lang_code);

	fn_set_hook('get_promotions', $params, $fields, $sortings, $condition, $join);

	$limit = '';
	if (!empty($items_per_page)) {
		$total = db_get_field("SELECT COUNT(*) FROM ?:promotions $join WHERE 1 $condition $group");
		$limit = fn_paginate($params['page'], $total, $items_per_page);
	}

	if (!empty($params['simple'])) {
		return db_get_hash_single_array("SELECT ?:promotions.promotion_id, ?:promotion_descriptions.name FROM ?:promotions $join WHERE 1 $condition $group ORDER BY $sorting $limit", array('promotion_id', 'name'));
	} else {
		$promotions = db_get_hash_array('SELECT ' . implode(', ', $fields) . " FROM ?:promotions $join WHERE 1 $condition $group ORDER BY $sorting $limit", 'promotion_id');
	}

	if (!empty($params['expand'])) {
		foreach ($promotions as $k => $v) {
			$promotions[$k]['conditions'] = !empty($v['conditions']) ? unserialize($v['conditions']) : array();
			$promotions[$k]['bonuses'] = !empty($v['bonuses']) ? unserialize($v['bonuses']) : array();
		}
	}

	return array($promotions, $params);
}

/**
 * Apply promotion rules
 *
 * @param array $data data array (product - for catalog rules, cart - for cart rules)
 * @param string $zone - promotiontion zone (catalog, cart)
 * @param array $cart_products (optional) - cart products array (for car rules)
 * @param array $auth (optional) - auth array (for car rules)
 * @return bool true if rule can be applied, false - otherwise
 */
function fn_promotion_apply($zone, &$data, &$auth = NULL, &$cart_products = NULL)
{
	static $promotions = array();
	$applied_promotions = array();

	if (!isset($promotions[$zone])) {
		$params = array(
			'active' => true,
			'expand' => true,
			'zone' => $zone,
			'sort_by' => 'priority',
			'sort_order' => 'asc'
		);

		list($promotions[$zone]) = fn_get_promotions($params);
	}

	// If we're in cart, set flag that promotions available
	if ($zone == 'cart') {
		$_promotion_ids = !empty($data['promotions']) ? array_keys($data['promotions']) : array();
		$data['no_promotions'] = empty($promotions[$zone]);
		$data['promotions'] = array(); // cleanup stored promotions
		$data['subtotal_discount'] = 0; // reset subtotal discount (FIXME: move to another place)
	}

	if (empty($promotions[$zone])) {
		return false;
	}

	// Pre-check coupon
	if ($zone == 'cart' && !empty($data['pending_coupon'])) {
		fn_promotion_check_coupon($data, true);
	}

	foreach ($promotions[$zone] as $promotion) {
		// Rule is valid and can be applied
		if (fn_promotion_check($promotion['promotion_id'], $promotion['conditions'], $data, $auth, $cart_products)) {
			if (fn_promotion_apply_bonuses($promotion, $data, $auth, $cart_products)) {
				$applied_promotions[$promotion['promotion_id']] = $promotion;

				// Stop processing further rules, if needed
				if ($promotion['stop'] == 'Y') {
					break;
				}
			}
		}
	}

	if ($zone == 'cart') {

		// Post-check coupon
		if (!empty($data['pending_coupon'])) {
			fn_promotion_check_coupon($data, false, $applied_promotions);
		}

		if (!empty($applied_promotions)) {
			// Display notifications for new promotions
			$_text = array();
			foreach ($applied_promotions as $v) {
				if (!in_array($v['promotion_id'], $_promotion_ids)) {
					$_text[] = $v['name'];
				}
			}

			if (!empty($_text)) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_applied_promotions') . ': ' . implode(', ', $_text));
			}

			Registry::get('view')->assign('applied_promotions', $applied_promotions);
		}

		// Summarize discounts
		foreach ($cart_products as $k => $v) {
			if (!empty($v['promotions'])) {
				foreach ($v['promotions'] as $pr_id => $bonuses) {
					foreach ($bonuses['bonuses'] as $bonus) {
						if (!empty($bonus['discount'])) {
							$data['promotions'][$pr_id]['total_discount'] = (!empty($data['promotions'][$pr_id]['total_discount']) ? $data['promotions'][$pr_id]['total_discount'] : 0) + ($bonus['discount'] * $v['amount']);
						}
					}
				}
			}
		}
	}

	return !empty($applied_promotions);
}

/**
 * Apply discount to the product
 *
 * @param int $promotion_id promotion ID
 * @param array $bonus promotion bonus
 * @param array $product product array (product - for catalog rules, cart - for cart rules)
 * @param bool $use_base use base price or with applied discounts
 * @return bool true if rule can be applied, false - otherwise
 */

function fn_promotion_apply_discount($promotion_id, $bonus, &$product, $use_base = true)
{
	if (!isset($product['promotions'])) {
		$product['promotions'] = array();
	}

	if (!isset($product['discount'])) {
		$product['discount'] = 0;
	}

	if (!isset($product['base_price'])) {
		$product['base_price'] = $product['price'];
	}

	$base_price = ($use_base == true) ? $product['base_price'] + (empty($product['modifiers_price']) ? 0 : $product['modifiers_price']) : $product['price'];

	$discount = fn_promotions_calculate_discount($bonus['discount_bonus'], $base_price, $bonus['discount_value'], $product['price']);
	$discount = fn_format_price($discount);

	$product['discount'] += $discount;
	$product['price'] -= $discount;

	if ($product['price'] < 0) {
		$product['discount'] += $product['price'];
		$product['price'] = 0;
	}

	$product['promotions'][$promotion_id]['bonuses'][] = array (
		'discount_bonus' =>	$bonus['discount_bonus'],
		'discount_value' => $bonus['discount_value'],
		'discount' => $product['discount']
	);

	if (isset($product['subtotal'])) {
		$product['subtotal'] = $product['price'] * $product['amount'];
	}

	$product['discount_prc'] = sprintf('%d', round($product['discount'] * 100 / $product['base_price']));

	return true;
}

/**
 * Apply promotion catalog rule
 *
 * @param array $promotion promotion array
 * @param array $product product array (product - for catalog rules, cart - for cart rules)
 * @param array $auth (optional) - auth array
 * @return bool true if rule can be applied, false - otherwise
 */
function fn_promotion_apply_catalog_rule($bonus, &$product, &$auth)
{
	if ($bonus['bonus'] == 'product_discount' && floatval($product['base_price'])) {
		fn_promotion_apply_discount($bonus['promotion_id'], $bonus, $product);
	}

	return true;
}

/**
 * Apply promotion cart rule
 *
 * @param array $promotion promotion array
 * @param array $cart cart array
 * @param array $auth (optional) - auth array
 * @param array $cart_products (optional) - cart products array (for cart rules)
 * @return bool true if rule can be applied, false - otherwise
 */
function fn_promotion_apply_cart_rule($bonus, &$cart, &$auth, &$cart_products)
{
	// Clean bonuses
	$cart['promotions'][$bonus['promotion_id']]['bonuses'][$bonus['bonus']] = $bonus;

	if ($bonus['bonus'] == 'order_discount') {
		if (floatval($cart['subtotal'])) {
			$discount = fn_promotions_calculate_discount($bonus['discount_bonus'], $cart['subtotal'], $bonus['discount_value']);
			if (floatval($discount)) {
				$cart['use_discount'] = true;
				$cart['subtotal_discount'] = fn_format_price($discount);
			}
		}

	} elseif ($bonus['bonus'] == 'discount_on_products') {
		foreach ($cart_products as $k => $v) {
			if (isset($v['exclude_from_calculate']) || !floatval($v['base_price'])) {
				continue;
			}

			if (fn_promotion_validate_attribute($v['product_id'], $bonus['value'], 'in')) {
				if (fn_promotion_apply_discount($bonus['promotion_id'], $bonus, $cart_products[$k])) {
					$cart['use_discount'] = true;
				}
			}
		}

	} elseif ($bonus['bonus'] == 'discount_on_categories') {
		foreach ($cart_products as $k => $v) {
			if (isset($v['exclude_from_calculate']) || !floatval($v['base_price'])) {
				continue;
			}

			$c_ids = array_keys($v['category_ids']);

			if (fn_promotion_validate_attribute($c_ids, $bonus['value'], 'in')) {
				fn_promotion_apply_discount($bonus['promotion_id'], $bonus, $cart_products[$k]);
			}
		}

	} elseif ($bonus['bonus'] == 'give_membership') {
		$cart['promotions'][$bonus['promotion_id']]['bonuses'][$bonus['bonus']]['pending'] = true;

	} elseif ($bonus['bonus'] == 'give_coupon') {
		$cart['promotions'][$bonus['promotion_id']]['bonuses'][$bonus['bonus']]['pending'] = true;
		$cart['promotions'][$bonus['promotion_id']]['bonuses'][$bonus['bonus']]['coupon_code'] = fn_generate_code('', COUPON_CODE_LENGTH);

	} elseif ($bonus['bonus'] == 'free_shipping') {

		$cart['free_shipping'][] = $bonus['value'];

	} elseif ($bonus['bonus'] == 'free_products') {

		foreach ($bonus['value'] as $p_data) {
			$product_data = array (
				$p_data['product_id'] => array (
					'amount' => $p_data['amount'],
					'product_id' => $p_data['product_id'],
					'extra' => array (
						'exclude_from_calculate' => true,
						'aoc' => empty($p_data['product_options']),
						'saved_options_key' => $bonus['promotion_id'] . '_' . $p_data['product_id'],
					)
				),
			);

			if (!empty($cart['saved_product_options'][$bonus['promotion_id'] . '_' . $p_data['product_id']])) {
				$product_data[$p_data['product_id']]['product_options'] = $cart['saved_product_options'][$bonus['promotion_id'] . '_' . $p_data['product_id']];
			} elseif (!empty($p_data['product_options'])) {
				$product_data[$p_data['product_id']]['product_options'] = $p_data['product_options'];
			}

			$existing_products = array_keys($cart['products']);

			if ($ids = fn_add_product_to_cart($product_data, $cart, $auth)) {
				$new_products = array_diff(array_keys($cart['products']), $existing_products);
				$hash = array_pop($new_products);

				$_cproduct = fn_get_cart_product_data($hash, $cart['products'][$hash], true, $cart, $auth);
				if (!empty($_cproduct)) {
					$cart_products[$hash] = $_cproduct;
				}
			}
		}
	}


	return true;
}

/**
 * Check promotiontion conditions
 *
 * @param int $promotion_id promotion ID
 * @param array $condition conditions set
 * @param array $data data array
 * @param array $auth auth array (for cart rules)
 * @param array $cart_products cart products array (for cart rules)
 * @return bool true if promotion can be applied, false - otherwise
 */
function fn_promotion_check($promotion_id, $condition, &$data, &$auth, &$cart_products)
{
	// This is unconditional promotiontion
	if (empty($condition)) {
		return true;
	}

	// if this is the conditions group, check each condition in cycle
	if (!empty($condition['conditions'])) {
		foreach ($condition['conditions'] as $cond) {
			if (!empty($cond['conditions'])) {
				$c_res = fn_promotion_check($promotion_id, $cond, $data, $auth, $cart_products);
			} else {
				$c_res = fn_promotion_validate($promotion_id, $cond, $data, $auth, $cart_products);
			}

			if (!isset($result)) {
				$result = $c_res;
			}

			// Check result, if any condition is correct
			if ($condition['set'] == 'any' && $c_res == $condition['set_value']) {
			   return true;

			// If we need to compare all conditions, summ the result
			} elseif ($condition['set'] == 'all') {
				$result = $result & $c_res;
			}
		}

		return ($condition['set_value'] == true) ? $result : !$result;

	// If this is the ordinary condition, check it directly
	} else {
		return fn_promotion_validate($promotion_id, $condition, $data, $auth, $cart_products);
	}
}

/**
 * Validate rule
 *
 * @param int $promotion_id promotion ID
 * @param array $promotion rule data
 * @param array $data data array
 * @param array $auth auth array (for cart rules)
 * @param array $cart_products cart products array (for cart rules)
 * @return bool true if rule can be applied, false - otherwise
 */
function fn_promotion_validate($promotion_id, $promotion, &$data, &$auth, &$cart_products)
{
	$schema = fn_promotion_get_schema('conditions');

	if (empty($promotion['condition'])) { // if promotion is unconditional, apply it
		return true;
	}

	$promotion['value'] = !isset($promotion['value']) ? '' : $promotion['value'];

	if (!empty($schema[$promotion['condition']])) {
		$value = '';

		// Ordinary field
		if (!empty($schema[$promotion['condition']]['field'])) {

			// Array definition, parse it
			if (strpos($schema[$promotion['condition']]['field'], '@') === 0) {
				$value = fn_promotion_get_object_value($schema[$promotion['condition']]['field'], $data, $auth, $cart_products);
			} else {

				// If field can be used in both zones, it means that we're using products
				if (in_array('catalog', $schema[$promotion['condition']]['zones']) && in_array('cart', $schema[$promotion['condition']]['zones']) && !empty($cart_products)) {// this is the "cart" zone. FIXME!!!
					foreach ($cart_products as $v) {
						if (fn_promotion_validate_attribute($v[$schema[$promotion['condition']]['field']], $promotion['value'], $promotion['operator']) == true) {
							return true;
						}
					}

					return false;
				}

				if (!isset($data[$schema[$promotion['condition']]['field']])) {
					return false;
				}

				$value = $data[$schema[$promotion['condition']]['field']];
			}

		// Field is the result of function
		} elseif (!empty($schema[$promotion['condition']]['field_function'])) {
			$p = $schema[$promotion['condition']]['field_function'];
			$func = array_shift($p);
			$p_orig = $p;

			// If field can be used in both zones, it means that we're using products
			if (in_array('catalog', $schema[$promotion['condition']]['zones']) && in_array('cart', $schema[$promotion['condition']]['zones']) && !empty($cart_products)) { // this is the "cart" zone. FIXME!!!
				foreach ($cart_products as $product) {
					$p = $p_orig;
					foreach ($p as $k => $v) {
						if (strpos($v, '@') !== false) {
						   $p[$k] = & fn_promotion_get_object_value($v, $product, $auth);
						} elseif ($v == '#this') {
							$p[$k] = & $promotion;
						} elseif ($v == '#id') {
							$p[$k] = & $promotion_id;
						}
					}

					$value = call_user_func_array($func, $p);

					if (fn_promotion_validate_attribute($value, $promotion['value'], $promotion['operator'])) {
						return true;
					}
				}

				return false;
			}

			foreach ($p as $k => $v) {
				if (strpos($v, '@') !== false) {
				   $p[$k] = & fn_promotion_get_object_value($v, $data, $auth, $cart_products);
				} elseif ($v == '#this') {
					$p[$k] = & $promotion;
				} elseif ($v == '#id') {
					$p[$k] = & $promotion_id;
				}
			}

			$value = call_user_func_array($func, $p);
		}

		// Value is validated
		return fn_promotion_validate_attribute($value, $promotion['value'], $promotion['operator']);
	}

	return false;
}

/**
 * Get object value by path
 *
 * @param string $path path to object value
 * @param array $data data array
 * @param array $auth auth array (for cart rules)
 * @param array $cart_products cart products array (for cart rules)
 * @return mixed object value, dies if path does not exist
 */
function & fn_promotion_get_object_value($path, &$data, &$auth, &$cart_products = NULL)
{
	$p = explode('.', $path);
	$object = array_shift($p);
	if ($object == '@cart' || $object == '@product') {
		$obj = & $data;
	} elseif ($object == '@auth') {
		$obj = & $auth;
	} elseif ($object == '@cart_products') {
		$obj = & $cart_products;
	} else {
		die("promotion:object_not_implemented[$object]");
	}

	foreach ($p as $v) {
		if (!isset($obj[$v])) {
			$obj[$v] = array(); // FIXME?? Is it correct? //die("promotion:incorrect_key[$v]");
		}

		$obj = & $obj[$v];
	}

	return $obj;
}

/**
 * Validate attribute
 *
 * @param mixed $val value to compare with (can be one-dimensional array, in this case, every item will be checked)
 * @param mixed $condition value to compare to
 * @param string $op compare operator
 * @return bool true in success, false - otherwise
 */
function fn_promotion_validate_attribute($value, $condition, $op)
{
	$result = false;

	if (empty($condition)) { // condition can't be empty, I think...
		return false;
	}

	$val = !is_array($value) ? array($value) : $value;

	foreach ($val as $v) {
		if ($op == 'eq') {
			$result = ($v == $condition);

		} elseif ($op == 'neq') {
			$result = ($v != $condition);

		} elseif ($op == 'lte') {
			$result = ($v <= $condition);

		} elseif ($op == 'lt') {
			$result = ($v < $condition);

		} elseif ($op == 'gte') {
			$result = ($v >= $condition);

		} elseif ($op == 'gt') {
			$result = ($v > $condition);

		} elseif ($op == 'cont') {
			$result = (stripos((string)$v, (string)$condition) !== false);

		} elseif ($op == 'ncont') {
			$result = (stripos((string)$v, (string)$condition) === false);

		} elseif ($op == 'in') {
			$condition = is_array($condition) ? $condition : fn_explode(',', $condition);
			if (is_array($v)) {
				foreach ($condition as $item) {
					if (sizeof($v) != sizeof($item)) {
						if (sizeof(array_intersect($v, $item)) == sizeof($item)) {
							$result = true;
							break;
						}
					} else {
						array_multisort($v);
						array_multisort($item);
						if ($v == $item) {
							$result = true;
							break;
						}	
					}
				}
			} else {
				$result = in_array($v, $condition);
			}

		} elseif ($op == 'nin') {
			$condition = is_array($condition) ? $condition : fn_explode(',', $condition);
			if (is_array($v)) {
				$result = true;
				foreach ($condition as $item) {
					if (sizeof($v) != sizeof($item)) {
						if (sizeof(array_intersect($v, $item)) == sizeof($item)) {
							$result = false;
							break;
						}
					} else {
						array_multisort($v);
						array_multisort($item);
						if ($v == $item) {
							$result = false;
							break;
						}
					}
				}
			} else {
				$result = !in_array($v, $condition);
			}
		}

		if (!empty($result)) {
			return true;
		}
	}

	return false;
}

/**
 * Apply promotiontion bonuses
 *
 * @param array $promotion promotiontion data
 * @param array $data data array
 * @param array $auth auth array
 * @param array $cart_products cart products
 * @return bool true in success, false - otherwise
 */
function fn_promotion_apply_bonuses($promotion, &$data, &$auth, &$cart_products)
{
	$schema = fn_promotion_get_schema('bonuses');
	$can_apply = false;
	if (!empty($cart_products)) { // FIXME: this is cart
		$data['promotions'][$promotion['promotion_id']]['bonuses'] = array();
	}

	foreach ($promotion['bonuses'] as $bonus) {
		if (!empty($schema[$bonus['bonus']])) {
			$p = $schema[$bonus['bonus']]['function'];

			$func = array_shift($p);

			foreach ($p as $k => $v) {
				if ($v == '#this') {
					$bonus['promotion_id'] = $promotion['promotion_id'];
					$p[$k] = & $bonus;

				} elseif (strpos($v, '@') === 0) {
					$p[$k] = & fn_promotion_get_object_value($v, $data, $auth, $cart_products);
				}
			}

			if (call_user_func_array($func, $p) == true) {
				$can_apply = true;
			}
		}
	}

	if (!empty($cart_products) && $can_apply == false) { // FIXME: this is cart
		unset($data['promotions'][$promotion['promotion_id']]);
	}

	return $can_apply;
}

/**
 * Get promotion schema
 *
 * @param string $type schema type (conditions, bonuses)
 * @return array schema of definite type
 */
function fn_promotion_get_schema($type = '')
{
	static $schema = array();

	if (empty($schema)) {
		$schema = fn_get_schema('promotions', 'schema');
	}

	return !empty($type) ? $schema[$type] : $schema;
}

/**
 * Distribute fixed discount amount all products
 *
 * @param array $cart_products products list
 * @param float $value discount for distribution
 * @param bool $use_base use base price for calculation or with applied discounts
 * @return array discounts list
 */
function fn_promotion_distribute_discount(&$cart_products, $value, $use_base = true)
{
	// Calculate subtotal
	$subtotal = 0;
	foreach ($cart_products as $k => $v) {
		if (isset($v['exclude_from_calculate'])) {
			continue;
		}
		$subtotal += (($use_base == true) ? $v['base_price'] : $v['price']) * $v['amount'];
	}

	// Calculate discount for each product
	$discount = array();

	foreach ($cart_products as $k => $v) {
		if (isset($v['exclude_from_calculate'])) {
			continue;
		}
		$discount[$k] = fn_format_price(((($use_base == true) ? $v['base_price'] : $v['price']) / $subtotal) * $value);
	}

	$sum = array_sum($discount);

	// If sum of distributed values does not equal to total discount, correct it
	/*if ($sum != $value) {
		$diff = $sum - $value;

		foreach ($discount as $k => $v) {
			if ($v + $sum - $value > 0) {
				$discount[$k] = $v + $sum - $value;
				break;
			}
		}
	} */

	return $discount;
}

/**
 * Promotions post processing
 *
 * @param char $status_to new order status
 * @param char $status_from original order status
 * @param array $order_info order information
 * @param bool $force_notification force user notification
 * @return boolean always true
 */
function fn_promotion_post_processing($status_to, $status_from, $order_info, $force_notification = NULL)
{
	$order_statuses = fn_get_statuses(STATUSES_ORDER);

	$notify_user = !is_null($force_notification) ? $force_notification : (!empty($order_statuses[$status_to]['notify']) && $order_statuses[$status_to]['notify'] == 'Y' ? true : false);

	if ($status_to != $status_from && $order_statuses[$status_to]['inventory'] != $order_statuses[$status_from]['inventory']) {
		
		if (empty($order_info['promotions'])) {
			return false;
		}

		// Post processing
		if ($order_statuses[$status_to]['inventory'] == 'D' && $order_statuses[$status_from]['inventory'] == 'I') {
			db_query("UPDATE ?:promotions SET number_of_usages = number_of_usages + 1 WHERE promotion_id IN (?n)", array_keys($order_info['promotions']));
		} else {
			db_query("UPDATE ?:promotions SET number_of_usages = number_of_usages - 1 WHERE promotion_id IN (?n)", array_keys($order_info['promotions']));
		}

		// Apply pending actions
		foreach ($order_info['promotions'] as $k => $v) {
			if (!empty($v['bonuses'])) {
				foreach ($v['bonuses'] as $bonus) {
					// Assign membership
					if ($bonus['bonus'] == 'give_membership') {
						if (empty($order_info['user_id'])) {
							continue;
						}

						if ($order_statuses[$status_to]['inventory'] == 'D' && $order_statuses[$status_from]['inventory'] == 'I') {
							db_query("UPDATE ?:users SET membership_id = ?i, membership_status = 'A' WHERE user_id = ?i", $bonus['value'], $order_info['user_id']);
							$activated = true;
						} else {
							db_query("UPDATE ?:users SET membership_id = ?i, membership_status = 'P' WHERE user_id = ?i", 0, $order_info['user_id']);
							$activated = false;
						}

						if ($notify_user == true) {
							Registry::get('view_mail')->assign('user_data', fn_get_user_info($order_info['user_id']));
							Registry::get('view_mail')->assign('memberships', fn_get_memberships('F', $order_info['lang_code']));

							$prefix = ($activated == true) ? 'activation' : 'disactivation';
							fn_send_mail($order_info['email'], Registry::get('settings.Company.company_users_department'), 'profiles/membership_' . $prefix . '_subj.tpl', 'profiles/membership_' . $prefix . '.tpl', array(), $order_info['lang_code']);
						}


					} elseif ($bonus['bonus'] == 'give_coupon') {

						$promotion_data = fn_get_promotion_data($bonus['value']);
						if (empty($promotion_data)) {
							continue;
						}


						if ($order_statuses[$status_to]['inventory'] == 'D' && $order_statuses[$status_from]['inventory'] == 'I') {

							fn_promotion_update_condition($promotion_data['conditions']['conditions'], 'add', 'auto_coupons', $bonus['coupon_code']);

							if ($notify_user == true) {
								Registry::get('view_mail')->assign('promotion_data', $promotion_data);
								Registry::get('view_mail')->assign('bonus_data', $bonus);
								Registry::get('view_mail')->assign('order_info', $order_info);

								fn_send_mail($order_info['email'], Registry::get('settings.Company.company_users_department'), 'promotions/give_coupon_subj.tpl', 'promotions/give_coupon.tpl', array(), $order_info['lang_code']);
							}

						} else {
							fn_promotion_update_condition($promotion_data['conditions']['conditions'], 'remove', 'auto_coupons', $bonus['coupon_code']);
						}

						db_query("UPDATE ?:promotions SET conditions = ?s, conditions_hash = ?s WHERE promotion_id = ?i", serialize($promotion_data['conditions']), fn_promotion_serialize($promotion_data['conditions']['conditions']), $bonus['value']);
					}
				}
			}
		}
	}

	return true;
}

/**
 * Pre/Post coupon checking/applying
 *
 * @param array $cart cart
 * @param boolean $initial_check true for pre-check, false - for post-check
 * @param array $applied_promotions list of applied promotions
 * @return boolean true if coupon is applied, false - otherwise
 */
function fn_promotion_check_coupon(&$cart, $initial_check, $applied_promotions = array())
{
	$result = true;

	// Pre-check: find if coupon is already used or only single coupon is allowed
	if ($initial_check == true) {
		fn_set_hook('pre_promotion_check_coupon', $cart['pending_coupon'], $cart);

		if (!empty($cart['coupons'][$cart['pending_coupon']])) {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('coupon_already_used'));
			
			$result = false;

		} elseif (Registry::get('settings.General.use_single_coupon') == 'Y' && !empty($cart['coupons'])) {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('single_coupon_is_allowed'));

			$result = false;

		} else {
			$cart['coupons'][$cart['pending_coupon']] = true;
		}

	// Post-check: check if coupon was applied successfully
	} else {

		if (!empty($cart['pending_coupon'])) {

			if (!empty($applied_promotions)) {
				$params = array (
					'active' => true,
					'coupon_code' => $cart['pending_coupon'],
					'promotion_id' => array_keys($applied_promotions)
				);

				list($coupon) = fn_get_promotions($params);
			}

			if (empty($coupon)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('no_such_coupon'));
				unset($cart['coupons'][$cart['pending_coupon']]);

				$result = false;
			} else {
				$cart['coupons'][$cart['pending_coupon']] = array_keys($coupon);
				fn_set_hook('promotion_check_coupon', $cart['pending_coupon'], $cart);
			}

			unset($cart['pending_coupon']);
		}
	}

	return $result;
}

/**
 * Validate coupon
 *
 * @param array $promotion values to validate with
 * @param array $cart cart
 * @return mixed coupon code if coupon exist, false otherwise
 */
function fn_promotion_validate_coupon($promotion, &$cart)
{
	$values = fn_explode(',', $promotion['value']);

	// Check already applied coupons
	if (!empty($cart['coupons'])) {
		$coupons = array_keys($cart['coupons']);
		return array_intersect($coupons, $values);
	}

	return false;
}

/**
 * Validate product (convert to common format)
 *
 * @param array $product product data
 * @return array converted product data
 */
function fn_promotion_validate_product($promotion, $product)
{
	$options = array();

	if (!empty($promotion['value']) && is_array($promotion['value'])) {
		if (!empty($product['product_options'])) {
			foreach ($product['product_options'] as $item) {
				$options[$item['option_id']] = $item['value'];
			}

			$upd_product = array('product_options' => $options, 'product_id' => $product['product_id'], 'amount' => $product['amount']);
		} else {
			$upd_product = array('product_id' => $product['product_id'], 'amount' => $product['amount']);
		}
	} else {
		$upd_product = $product['product_id'];
	}

	return array($upd_product);
}

/**
 * Get promotion dynamic properties
 *
 * @param array $promotion_id promotion ID
 * @param array $promotion promotion condition
 * @param array $condition condition
 * @param array $cart cart
 * @param array $auth auth information
 * @return mixed
 */
function fn_promotion_get_dynamic($promotion_id, $promotion, $condition, &$cart, &$auth = NULL)
{
	if ($condition == 'number_of_usages') {
		$usages = db_get_field("SELECT number_of_usages FROM ?:promotions WHERE promotion_id = ?i", $promotion_id);
		return intval($usages) + 1;

	} elseif ($condition == 'once_per_customer') {

		fn_define('PROMOTION_MIN_MATCHES', 5);

		$order_statuses = fn_get_statuses(STATUSES_ORDER);
		$_statuses = array();
		foreach ($order_statuses as $v) {
			if ($v['inventory'] == 'D') { // decreasing (positive) status
				$_statuses[] = $v['status'];
			}
		}

		if (empty($cart['user_data'])) {
			return 'Y';
		}

		$udata = $cart['user_data'];
		fn_fill_user_fields($udata);

		$exists = db_get_field("SELECT ((firstname = ?s) + (lastname = ?s) + (b_city = ?s) + (b_state = ?s) + (b_country = ?s) + (b_zipcode = ?s) + (email = ?s)) as r FROM ?:orders WHERE FIND_IN_SET(promotion_ids, ?i) AND status IN (?a) HAVING r >= ?i LIMIT 1", $udata['firstname'], $udata['lastname'], $udata['b_city'], $udata['b_state'], $udata['b_country'], $udata['b_zipcode'], $udata['email'], $promotion_id, $_statuses, PROMOTION_MIN_MATCHES);

		if (!empty($exists)) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_can_be_used_once'));
			return 'N';
		}

		return 'Y'; // this is checkbox with values (Y/N), so we need to return appropriate values
	}
}

/**
 * Serialize promotion conditions for search
 *
 * @param array $conditions conditions
 * @param boolean $plain flag - return as string (true) or array (false)
 * @return mixed serialized data
 */
function fn_promotion_serialize($conditions, $plain = true)
{
	$result = array();
	foreach ($conditions as $c) {
		if (!empty($c['conditions'])) {
			$result = fn_array_merge($result, fn_promotion_serialize($c['conditions']), false);
		} elseif (isset($c['value'])) {
			$result[] = $c['condition'] . '=' . $c['value'];
		}
	}

	return ($plain == true) ? implode(';', $result) : $result;
}

/**
 * Get promotion data
 *
 * @param int $promotion_id promotion ID
 * @param string $lang_code code language
 * @return array promotion data
 */
function fn_get_promotion_data($promotion_id, $lang_code = DESCR_SL)
{
	$promotion_data = db_get_row("SELECT * FROM ?:promotions as p LEFT JOIN ?:promotion_descriptions as d ON p.promotion_id = d.promotion_id AND d.lang_code = ?s WHERE p.promotion_id = ?i", $lang_code, $promotion_id);

	if (!empty($promotion_data)) {
		$promotion_data['conditions'] = !empty($promotion_data['conditions']) ? unserialize($promotion_data['conditions']) : array();
		$promotion_data['bonuses'] = !empty($promotion_data['bonuses']) ? unserialize($promotion_data['bonuses']) : array();
	}

	return $promotion_data;
}

/**
 * Update promotion condition
 *
 * @param array $conditions conditions
 * @param string $action update action
 * @param string $field condition field to update
 * @param string $value value to update field with
 * @return boolean always true
 */
function fn_promotion_update_condition(&$conditions, $action, $field, $value)
{
	foreach ($conditions as $k => $c) {
		if (!empty($c['conditions'])) {
			fn_promotion_update_condition($c['conditions'], $action, $field, $value);
		} elseif ($c['condition'] == $field) {
			if ($action == 'add') {
				$conditions[$k]['value'] .= (!empty($c['value']) ? ',' : '') . $value;
			} else {
				$conditions[$k]['value'] = preg_replace("/(\b{$value}\b[,]?[ ]?)/", '', $c['value']);
			}
		}
	}

	return true;
}

/**
 * Call function and return its result
 *
 * @param array $data array with function and parameters
 * @return mixed function result
 */
function fn_get_promotion_variants($data)
{
	$f = array_shift($data);
	return call_user_func_array($f, $data);
}

/**
 * Get product features and convert the to common format
 *
 * @param string $lang_code language code
 * @return array formatted data
 */
function fn_promotions_get_features($lang_code = CART_LANGUAGE)
{
	$params = array(
		'variants' => true,
		'plain' => false,
	);

	$features = fn_get_product_features($params);

	$res = array();
	foreach ($features as $k => $v) {
		if (!empty($v['subfeatures'])) {
			$res[$k]['is_group'] = true;
			$res[$k]['group'] = $v['description'];
			$res[$k]['items'] = array();
			foreach ($v['subfeatures'] as $_k => $_v) {
				$res[$k]['items'][$_k]['value'] = $_v['description'];
				if (!empty($_v['variants'])) {
					foreach ($_v['variants'] as $__k => $__v) {
						$res[$k]['items'][$_k]['variants'][$__k] = $__v['variant'];
					}
				} elseif ($_v['feature_type'] == 'C') {
					$res[$k]['items'][$_k]['variants'] = array(
						'Y' => fn_get_lang_var('yes'),
						'N' => fn_get_lang_var('no'),
					);
				}
			}
		} else {
			$res[$k]['value'] = $v['description'];
			if (!empty($v['variants'])) {
				foreach ($v['variants'] as $__k => $__v) {
					$res[$k]['variants'][$__k] = $__v['variant'];
				}
			} elseif ($v['feature_type'] == 'C') {
				$res[$k]['variants'] = array(
					'Y' => fn_get_lang_var('yes'),
					'N' => fn_get_lang_var('no'),
				);
			}
		}
	}

	return $res;
}

/**
 * Check if product has certain features
 *
 * @param array $promotion promotion data
 * @param array $product product data
 * @return mixed feature value if found, boolean false otherwise
 */
function fn_promotions_check_features($promotion, $product)
{
	$features = db_get_hash_multi_array("SELECT feature_id, variant_id, value, value_int FROM ?:product_features_values WHERE product_id = ?i AND lang_code = ?s", array('feature_id'), $product['product_id'], CART_LANGUAGE);

	if (!empty($features) && !empty($promotion['condition_element']) && !empty($features[$promotion['condition_element']])) {
		$f = $features[$promotion['condition_element']];
	
		$result = array();
		foreach ($f as $v) {
			$result[] = !empty($v['variant_id']) ? $v['variant_id'] : ($v['value_int'] != '' ? $v['value_int'] : $v['value']);
		}

		return $result;
	}

	return false;
}

/**
 * Calculate discount
 *
 * @param string $type discount type
 * @param float $price price to apply discount to
 * @param float $value discount value
 * @param float $current_price current price, for fixed discount calculation
 * @return float calculated discount value
 */
function fn_promotions_calculate_discount($type, $price, $value, $current_price = 0)
{
	$discount = 0;

	if ($type == 'to_percentage') {
		$discount = $price * (100 - $value) / 100;

	} elseif ($type == 'by_percentage') {
		$discount = $price * $value / 100;

	} elseif ($type == 'to_fixed') {
		$discount = (!empty($current_price) ? $current_price : $price) - $value;

	} elseif ($type == 'by_fixed') {
		$discount = $value;
	}

	if ($discount < 0) {
		$discount = 0;
	}

	return $discount;
}

?>
