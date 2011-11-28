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
// $Id: checkout.php 7837 2009-08-14 14:35:58Z alexey $
//



if ( !defined('AREA') ) { die('Access denied'); }

fn_define('CHECKOUT', true);
fn_define('ORDERS_TIMEOUT', 60);

// Cart is empty, create it
if (empty($_SESSION['cart'])) {
	fn_clear_cart($_SESSION['cart']);
}

$cart = & $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$_suffix = '';

	//
	// Add product to cart
	//
	if ($mode == 'add') {

		if (empty($auth['user_id']) && Registry::get('settings.General.allow_anonymous_shopping') != 'Y') {
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=auth.login_form&return_url=" . urlencode($_SERVER['HTTP_REFERER']));
		}

		// Add to cart button was pressed for single product on advanced list
		if (!empty($dispatch_extra)) {
			if (empty($_REQUEST['product_data'][$dispatch_extra]['amount'])) {
				$_REQUEST['product_data'][$dispatch_extra]['amount'] = 1;
			}
			foreach ($_REQUEST['product_data'] as $key => $data) {
				if ($key != $dispatch_extra) {
					unset($_REQUEST['product_data'][$key]);
				}
			}
		}

		fn_add_product_to_cart($_REQUEST['product_data'], $cart, $auth);
		fn_save_cart_content($cart, $auth['user_id']);

		$previous_state = md5(serialize($cart['products']));
		fn_calculate_cart_content($cart, $auth, 'S', true, 'F', true);

		if (md5(serialize($cart['products'])) != $previous_state) {
			$msg = fn_get_lang_var('text_product_added_to');
			$msg = str_replace('[target]', strtolower(fn_get_lang_var('cart')), $msg);
			fn_set_notification('N', fn_get_lang_var('notice'), $msg);
			$cart['recalculate'] = true;
		}

		if (defined('AJAX_REQUEST')) {
			$view->assign('cart_amount', $cart['amount']);
			$view->assign('cart_subtotal', $cart['display_subtotal']);
			$view->assign('force_items_deletion', true);

			// The redirection is made in order to update the page content to see changes made in the cart when adding a product to it from the 'view cart' or 'checkout' pages. 
			if (strpos($_SERVER['HTTP_REFERER'], 'dispatch=checkout.cart') || strpos($_SERVER['HTTP_REFERER'], 'dispatch=checkout.checkout')) {
				$ajax->assign('force_redirection', $_SERVER['HTTP_REFERER']);
			}

			$view->display('views/checkout/components/cart_status.tpl');
			exit;
		}

		$_suffix = '.cart';
		
		if (Registry::get('settings.DHTML.ajax_add_to_cart') != 'Y' && Registry::get('settings.General.redirect_to_cart') == 'Y') {
			unset($_REQUEST['redirect_url']);
		}
	}

	//
	// Update products quantity in the cart
	//
	if ($mode == 'update') {
		if (!empty($_REQUEST['cart_products'])) {
			fn_add_product_to_cart($_REQUEST['cart_products'], $cart, $auth, true);
			fn_save_cart_content($cart, $auth['user_id']);
		}

		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_products_updated_successfully'));

		// Recalculate cart when updating the products
		$cart['recalculate'] = true;

		$_suffix = ".$_REQUEST[redirect_mode]";
	}

	//
	// Estimate shipping cost
	//
	if ($mode == 'shipping_estimation') {

		$customer_location = empty($_REQUEST['customer_location']) ? array() : $_REQUEST['customer_location'];
		foreach ($customer_location as $k => $v) {
			$cart['user_data']['s_' . $k] = $v;
		}
		$_SESSION['customer_loc'] = $customer_location;

		list ($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($cart, $auth, 'A', true, 'F', true);

		$view->assign('shipping_rates', $_SESSION['shipping_rates']);
		$view->assign('cart', $cart);
		$view->assign('cart_products', array_reverse($cart_products, true));
		$view->assign('location', empty($_REQUEST['location']) ? 'cart' : $_REQUEST['location']);
		$view->assign('additional_id', empty($_REQUEST['additional_id']) ? '' : $_REQUEST['additional_id']);

		if (defined('AJAX_REQUEST')) {
			if (fn_is_empty($cart_products) && fn_is_empty($_SESSION['shipping_rates'])) {
				$ajax->assign_html('shipping_estimation_sidebox' . (empty($_REQUEST['additional_id']) ? '' : '_' . $_REQUEST['additional_id']), fn_get_lang_var('no_rates_for_empty_cart'));
			} else {
				$view->display(empty($_REQUEST['location']) ? 'views/checkout/components/checkout_totals.tpl' : 'views/checkout/components/shipping_estimation.tpl');
			}
			exit;
		}

		$_suffix = '.' . (empty($_REQUEST['current_mode']) ? 'cart' : $_REQUEST['current_mode']) . '&show_shippings=Y';
	}

	if ($mode == 'update_shipping') {
		if (!empty($_REQUEST['shipping_ids'])) {
			fn_checkout_update_shipping($cart, $_REQUEST['shipping_ids']);
		}

		$_suffix = ".$_REQUEST[redirect_mode]";
	}

	// Apply Discount Coupon
	if ($mode == 'apply_coupon') {

		$cart['pending_coupon'] = $_REQUEST['coupon_code'];

		$_suffix = ".$_REQUEST[redirect_mode]";
	}

	if ($mode == 'add_profile') {

		if ($res = fn_update_user(0, $_REQUEST['user_data'], $auth, false, true)) {
			$suffix = '&edit_step=step_two';
		} else {
			$suffix = '&login_type=register';
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=checkout.checkout" .  $suffix);
	}

	if ($mode == 'customer_info') {
		if (empty($cart['user_data']['email']) && Registry::get('settings.Image_verification.use_for_checkout') == 'Y' && fn_image_verification('checkout', empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
			fn_save_post_data();

			if (Registry::get('settings.General.one_page_checkout') == 'Y') {
				return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.checkout&login_type=guest");
			} else {
				return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.customer_info&login_type=" . (!empty($_REQUEST['user_data']['password1']) ? 'register' : 'guest'));
			}
		}

		$profile_fields = fn_get_profile_fields('O');
		$user_profile = array();

		if (!empty($_REQUEST['user_data'])) {
			$user_data = $_REQUEST['user_data'];

			unset($user_data['user_type']);
			if (!empty($cart['user_data'])) {
				$cart['user_data'] = fn_array_merge($cart['user_data'], $user_data);
			} else {
				$cart['user_data'] = $user_data;
			}

			// Fill shipping info with billing if needed
			if (empty($_REQUEST['ship_to_another'])) {
				fn_fill_shipping_with_billing($cart['user_data'], $profile_fields);
			}

			// Add descriptions for titles, countries and states
			fn_add_user_data_descriptions($cart['user_data']);

			// Update profile info (if user is logged in)
			$cart['profile_registration_attempt'] = false;
			$cart['ship_to_another'] = !empty($_REQUEST['ship_to_another']);

			if (!empty($auth['user_id'])) {
				// Check email
				$email_exists = db_get_field("SELECT email FROM ?:users WHERE email = ?s AND user_id != ?i", $cart['user_data']['email'], $auth['user_id']);
				if (!empty($email_exists)) {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_user_exists'));
					$cart['user_data']['email'] = '';
				} else {
					db_query('UPDATE ?:users SET ?u WHERE user_id = ?i', $cart['user_data'], $auth['user_id']);

					if (!empty($cart['profile_id'])) {
						db_query('UPDATE ?:user_profiles SET ?u WHERE profile_id = ?i', $cart['user_data'], $cart['profile_id']);
					} else {
						$cart['profile_id'] = db_query('INSERT INTO ?:user_profiles ?e', $cart['user_data']);
					}

					fn_store_profile_fields($cart['user_data'], $cart['profile_id'], 'P');

					
				}

			} elseif (Registry::get('settings.General.disable_anonymous_checkout') == 'Y' || !empty($user_data['password1'])) {
				$cart['profile_registration_attempt'] = true;
				$user_profile = fn_update_user(0, $cart['user_data'], $auth, $cart['ship_to_another'], true);
				if ($user_profile === false) {
					unset($cart['user_data']['email'], $cart['user_data']['user_login']);
				}
			}
		}

		$cart['recalculate'] = true;

		fn_save_cart_content($cart, $auth['user_id']);

		if (Registry::get('settings.General.one_page_checkout') == 'Y') {
			$_suffix = '.checkout&edit_step=step_two';
		} else {
			$_suffix = $user_profile !== false ? '.checkout' : '.customer_info&login_type=register';
		}
	}

	if ($mode == 'order_info') {
		$payment_id = !empty($_REQUEST['payment_id']) ? (int) $_REQUEST['payment_id'] : 0;
		$cart['payment_id'] = $payment_id;
		$cart['payment_surcharge'] = 0;
		if (!empty($payment_id)) {
			$_data = db_get_row("SELECT a_surcharge, p_surcharge FROM ?:payments WHERE payment_id = ?i", $payment_id);
			if (floatval($_data['a_surcharge'])) {
				$cart['payment_surcharge'] += $_data['a_surcharge'];
			}
			if (floatval($_data['p_surcharge'])) {
				$cart['payment_surcharge'] += fn_format_price($cart['total'] * $_data['p_surcharge'] / 100);
			}
		}

		fn_save_cart_content($cart, $auth['user_id']);
		$_suffix = ".summary";
		
		if (Registry::get('settings.General.one_page_checkout') == 'Y') {
			$_suffix = '.checkout';
		
		} elseif (!empty($_REQUEST['shipping_ids'])) {
			fn_checkout_update_shipping($cart, $_REQUEST['shipping_ids']);
		}
	}

	if ($mode == 'place_order') {

		// Clean up saved shipping rates
		unset($_SESSION['shipping_rates']);
		if (!empty($_REQUEST['customer_notes'])) {
			$cart['notes'] = $_REQUEST['customer_notes'];
		}

		if (!empty($_REQUEST['payment_info'])) {
			$cart['payment_info'] = $_REQUEST['payment_info'];
		}

		if (!empty($cart['products'])) {
			foreach ($cart['products'] as $k => $v) {
				$_is_edp = db_get_field("SELECT is_edp FROM ?:products WHERE product_id = ?i", $v['product_id']);
				if (fn_check_amount_in_stock($v['product_id'], $v['amount'], empty($v['product_options']) ? array() : $v['product_options'], $k, $_is_edp) == false) {
					unset($cart['products'][$k]);
					return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.cart");
				}
			}
		}

		$_last_order_time = fn_get_cookie('last_order_time');

		/*if (!empty($_last_order_time) && ($_last_order_time + ORDERS_TIMEOUT > TIME)) {
			fn_set_notification('E', fn_get_lang_var('error'), str_replace('[minutes]', round(ORDERS_TIMEOUT / 60, 2), fn_get_lang_var('duplicate_order_warning')));
			if (!empty($auth['order_ids'])) {
				$_o_ids = $auth['order_ids'];
			}
			$last_order_id = empty($auth['user_id']) ? array_pop($_o_ids) : db_get_field("SELECT order_id FROM ?:orders WHERE user_id = ?i ORDER BY order_id DESC", $auth['user_id']);

			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=orders.details&order_id=$last_order_id");
		}*/

		// Time of placing ordes is saved to avoid duplicate  orders.
		fn_set_cookie('last_order_time', TIME);

		list($order_id, $process_payment) = fn_place_order($cart, $auth);

		if (!empty($order_id)) {
			$view->assign('order_action', fn_get_lang_var('placing_order'));
			$view->display('views/orders/components/placing_order.tpl');
			fn_flush();

			if (empty($_REQUEST['skip_payment']) && $process_payment == true) { // administrator, logged in as customer can skip payment
				fn_start_payment($order_id);
			}

			fn_order_placement_routines($order_id);
		} else {
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.cart");
		}
	}

	if ($mode == 'update_steps') {

		$user_data = !empty($_REQUEST['user_data']) ? $_REQUEST['user_data'] : array();
		$_suffix = ".checkout";
		unset($user_data['user_type']);

		if (!empty($auth['user_id'])) {
			if (isset($user_data['profile_id'])) {
				if (empty($user_data['profile_id'])) {
					$user_data['profile_type'] = 'S';
				}
				$profile_id = $user_data['profile_id'];

			} elseif (!empty($cart['profile_id'])) {
				$profile_id = $cart['profile_id'];

			} else {
				$profile_id = db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_type = 'P'", $auth['user_id']);
			}

			$user_data['user_id'] = $auth['user_id'];
			$current_user_data = fn_get_user_info($auth['user_id'], true, $profile_id);
			if ($profile_id != NULL) {
				$cart['profile_id'] = $profile_id;
			}

			// Update contact information
			if ($_REQUEST['update_step'] == 'step_one') {
				// Check email
				$email_exists = db_get_field("SELECT email FROM ?:users WHERE email = ?s AND user_id != ?i", $user_data['email'], $auth['user_id']);
				if (!empty($email_exists)) {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_user_exists'));
					$_suffix .= '&edit_step=step_one';
				} else {
					$user_data = fn_array_merge($current_user_data, $user_data);
					db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", $user_data, $auth['user_id']);
				}
			}

			// Update billing/shipping information
			if ($_REQUEST['update_step'] == 'step_two') {
				$user_data = fn_array_merge($current_user_data, $user_data);

				if (empty($_REQUEST['ship_to_another'])) {
					$profile_fields = fn_get_profile_fields('O');
					fn_fill_shipping_with_billing($user_data, $profile_fields);
				}

				$cart['profile_id'] = $profile_id = db_query("REPLACE INTO ?:user_profiles ?e", $user_data);

				fn_set_hook('checkout_profile_update', $cart, $_REQUEST['update_step']);
			}

			// Add/Update additional fields
			if (!empty($user_data['fields'])) {
				fn_store_profile_fields($user_data, array('U' => $auth['user_id'], 'P' => $profile_id), 'UP'); // FIXME
			}

		} elseif (Registry::get('settings.General.disable_anonymous_checkout') != 'Y') {
			if (isset($user_data['fields'])) {
				$fields = fn_array_merge(isset($cart['user_data']['fields']) ? $cart['user_data']['fields'] : array(), $user_data['fields']);
			}

			$cart['user_data'] = fn_array_merge($cart['user_data'], $user_data);

			// Fill shipping info with billing if needed
			if (empty($_REQUEST['ship_to_another']) && $_REQUEST['update_step'] == 'step_two') {
				$profile_fields = fn_get_profile_fields('O');
				fn_fill_shipping_with_billing($cart['user_data'] , $profile_fields);
			}
		}

		if (!empty($_REQUEST['next_step'])) {
			$_suffix .= '&edit_step=' . $_REQUEST['next_step'];
		}
	
		if (!empty($_REQUEST['shipping_ids'])) {
			fn_checkout_update_shipping($cart, $_REQUEST['shipping_ids']);
		}

		// Recalculate the cart
		$cart['recalculate'] = true;
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=checkout$_suffix");
}

//
// Delete discount coupon
//
if ($mode == 'delete_coupon') {
	unset($cart['coupons'][$_REQUEST['coupon_code']], $cart['pending_coupon']);
	$cart['recalculate'] = true;

	return array(CONTROLLER_STATUS_OK);
}

if (empty($mode) || (Registry::get('settings.General.one_page_checkout') == 'Y' && $_SERVER['REQUEST_METHOD'] != 'POST' && in_array($mode, array('customer_info', 'summary')) && !defined('AJAX_REQUEST'))) {
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout." .$_REQUEST['redirect_mode']);

}

$payment_methods = fn_prepare_checkout_payment_methods($cart, $auth);
if (((true == fn_cart_is_empty($cart) && !isset($force_redirection)) || empty($payment_methods)) && !in_array($mode, array('clear', 'delete', 'cart', 'update', 'apply_coupon', 'shipping_estimation', 'update_shipping'))) {
	if (empty($payment_methods)) {
		fn_set_notification('N', fn_get_lang_var('notice'),  fn_get_lang_var('cannot_proccess_checkout_without_payment_methods'));
	} else {
		fn_set_notification('N', fn_get_lang_var('cart_is_empty'),  fn_get_lang_var('cannot_proccess_checkout'));
	}
	$force_redirection = "$index_script?dispatch=checkout.cart";
	if (defined('AJAX_REQUEST')) {
		Registry::get('ajax')->assign('force_redirection', $force_redirection);
		exit;
	} else {
		return array(CONTROLLER_STATUS_REDIRECT, $force_redirection);
	}
}

//Cart Items
if ($mode == 'cart') {

	list ($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($cart, $auth, Registry::get('settings.General.estimate_shipping_cost') == 'Y' ? 'E' : 'S', true, 'F', true);

	if (!empty($cart_products)) {
		foreach($cart_products as $k => $v) {
			fn_gather_additional_product_data($cart_products[$k], true, false, true, false);
		}
	}

	// [Breadcrumbs]
	fn_add_breadcrumb(fn_get_lang_var('cart_contents'));
	// [/Breadcrumbs]

	$cart_products = array_reverse($cart_products, true);
	$view->assign('cart_products', $cart_products);
	$view->assign('shipping_rates', $_SESSION['shipping_rates']);

// Step 1: Customer information
} elseif ($mode == 'customer_info') {

	if (Registry::get('settings.General.approve_user_profiles') == 'Y' && Registry::get('settings.General.disable_anonymous_checkout') == 'Y' && empty($auth['user_id'])) {
		fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('text_anonymous_checkout'));

		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.cart");
	}

	$cart['profile_id'] = empty($cart['profile_id']) ? 0 : $cart['profile_id'];
	if (!empty($cart['user_data']['profile_id']) && $cart['profile_id'] != $cart['user_data']['profile_id']) {
		$cart['profile_id'] = $cart['user_data']['profile_id'];
	}
	$profile_fields = fn_get_profile_fields('O');

	//Get user profiles
	if (Registry::get('settings.General.user_multiple_profiles') == 'Y') {
		$user_profiles = fn_get_user_profiles($auth['user_id']);
		$view->assign('user_profiles', $user_profiles);
	}

	//Get countries and states
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	$view->assign('memberships', fn_get_memberships('C', CART_LANGUAGE));

	// CHECK ME!!!
	$_SESSION['saved_post_data'] = empty($_SESSION['saved_post_data']) ? array() : $_SESSION['saved_post_data'];
	$saved_post_data = & $_SESSION['saved_post_data'];
	unset($_SESSION['saved_post_data']);

	if (!empty($saved_post_data['user_data'])) {
		$view->assign('saved_user_data', $saved_post_data['user_data']);
		$view->assign('ship_to_another', !empty($saved_post_data['ship_to_another']));
	}

	if (!empty($_REQUEST['login_type'])) {
		$view->assign('login_type', $_REQUEST['login_type']);
	}

	// Change user profile
	if (!empty($auth['user_id']) && (empty($cart['user_data']) || (!empty($_REQUEST['profile_id']) && $cart['profile_id'] != $_REQUEST['profile_id']) || (!empty($_REQUEST['profile']) && $_REQUEST['profile'] == 'new'))) {
		if (!empty($_REQUEST['profile_id'])) {
			$cart['profile_id'] = $_REQUEST['profile_id'];
		}

		if (!empty($_REQUEST['profile']) && $_REQUEST['profile'] == 'new') {
			$cart['profile_id'] = 0;
		}

		$cart['user_data'] = fn_get_user_info($auth['user_id'], empty($_REQUEST['profile']), $cart['profile_id']);
	}

	if (!empty($cart['user_data'])) {
		$cart['ship_to_another'] = fn_check_shipping_billing($cart['user_data'], $profile_fields);
	}

	$titles = fn_get_static_data_section('T', false, true);
	$view->assign('titles', $titles);

// Step 2: Shipping and payment methods
} elseif ($mode == 'checkout') {

	$profile_fields = fn_get_profile_fields('O');

	if (Registry::get('settings.General.one_page_checkout') != 'Y') {

		// First, check if all fields are filled correctly
		foreach (array('C', 'B', 'S') as $section) {
			if (fn_check_profile_fields_population($cart['user_data'], $section, $profile_fields) == false) {
				return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.customer_info");
			}
		}

		// Get saved shipping rates
		if (!empty($_SESSION['shipping_rates']) && fn_need_shipping_recalculation($cart) == false) {
			define('CACHED_SHIPPING_RATES', true);
		}

		list ($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($cart, $auth, 'A', true, 'I');

		$view->assign('shipping_rates', $_SESSION['shipping_rates']);

	} else {

		// Array notifying that one or another step is completed.
		$completed_steps = array();
		
		// Array responsible for what step has editing status
		$edit_step = !empty($_REQUEST['edit_step']) ? $_REQUEST['edit_step'] : (!empty($_SESSION['edit_step']) ? $_SESSION['edit_step'] : '');
		$cart['user_data'] = !empty($cart['user_data']) ? $cart['user_data'] : array();

		if (!empty($auth['user_id'])) {

			//if the error occurred during registration, but despite this, the registration was performed, then the variable should be cleared.
			unset($_SESSION['failed_registration']);

			if (!empty($_REQUEST['profile_id'])) {
				$cart['profile_id'] = $_REQUEST['profile_id'];
			
			} elseif (!empty($_REQUEST['profile']) && $_REQUEST['profile'] == 'new') {
				$cart['profile_id'] = 0;
			
			} elseif (empty($cart['profile_id'])) {
				$cart['profile_id'] = db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_type='P'", $auth['user_id']);
			}

			// Here check the previous and the current checksum of user_data - if they are different, recalculate the cart.
			$current_state = fn_crc32(serialize($cart['user_data']));

			$cart['user_data'] = fn_get_user_info($auth['user_id'], empty($_REQUEST['profile']), $cart['profile_id']);

			if ($current_state != fn_crc32(serialize($cart['user_data']))) {
				$cart['recalculate'] = true;
			}

		} else {
			if (!empty($_SESSION['saved_post_data']) && !empty($_SESSION['saved_post_data']['user_data'])) {
				$_SESSION['failed_registration'] = true;
				$_user_data = $_SESSION['saved_post_data']['user_data'];
				unset($_SESSION['saved_post_data']);
			} else {
				unset($_SESSION['failed_registration']);
			}

			$view->assign('login_type', empty($_REQUEST['login_type']) ? 'login' : $_REQUEST['login_type']);

			fn_add_user_data_descriptions($cart['user_data']);

			if (!empty($_REQUEST['action'])) {
				$view->assign('checkout_type', $_REQUEST['action']);
			}
		}

		$view->assign('user_data', !empty($_user_data) ? $_user_data : $cart['user_data']);
		$contact_info_population = fn_check_profile_fields_population($cart['user_data'], 'C', $profile_fields);
		$view->assign('contact_info_population', $contact_info_population);

		// Check fields population on first and second steps
		if ($contact_info_population == true && empty($_SESSION['failed_registration'])) {
			$completed_steps['step_one'] = true;

			// All mandatory Billing address data exist.
			$billing_population = fn_check_profile_fields_population($cart['user_data'], 'B', $profile_fields);
			$view->assign('billing_population', $billing_population);

			if ($billing_population == true || empty($profile_fields['B'])) {
				// All mandatory Shipping address data exist.
				$shipping_population = fn_check_profile_fields_population($cart['user_data'], 'S', $profile_fields);
				$view->assign('shipping_population', $shipping_population);

				if ($shipping_population == true || empty($profile_fields['S'])) {
					$completed_steps['step_two'] = true;
				}
			}
		}

		// Define the variable only if the profiles have not been changed and settings.General.user_multiple_profiles == Y.
		if (fn_need_shipping_recalculation($cart) == false && (!empty($_SESSION['shipping_rates']) && (Registry::get('settings.General.user_multiple_profiles') != "Y" || (Registry::get('settings.General.user_multiple_profiles') == "Y" && ((isset($user_data['profile_id']) && empty($user_data['profile_id'])) || (!empty($user_data['profile_id']) && $user_data['profile_id'] == $cart['profile_id'])))) || (empty($_SESSION['shipping_rates']) && Registry::get('settings.General.user_multiple_profiles') == "Y" && isset($user_data['profile_id']) && empty($user_data['profile_id'])))) {
			define('CACHED_SHIPPING_RATES', true);
		}

		if (!empty($_SESSION['shipping_rates'])) {
			$old_shipping_hash = md5(serialize($_SESSION['shipping_rates']));
		}

		list ($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($cart, $auth, !empty($completed_steps['step_two']) ? 'A' : 'S', true, 'F');

		// if address step is completed, check if shipping step is completed
		if (!empty($completed_steps['step_two'])) {
			$completed_steps['step_three'] = true;
		}

		// If shipping step is completed, assume that payment step is completed too
		if (!empty($completed_steps['step_three'])) {
			$completed_steps['step_four'] = true;
		}

		// If shipping methods changed and shipping step is completed, display notification
		if (!empty($old_shipping_hash) && $old_shipping_hash != md5(serialize($_SESSION['shipping_rates'])) && !empty($completed_steps['step_three'])) {
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_shipping_rates_changed'));
		}

		if (!empty($cart_products)) {
			foreach($cart_products as $k => $v) {
				fn_gather_additional_product_data($cart_products[$k], true, false, true, false);
			}
		}

		$view->assign('shipping_rates', $_SESSION['shipping_rates']);
		$view->assign('payment_methods', $payment_methods = fn_prepare_checkout_payment_methods($cart, $auth));

		if (false !=($first_method = reset($payment_methods)) && empty($cart['payment_id']) && floatval($cart['total']) != 0) {
			$cart['payment_id'] = $first_method['payment_id'];
		}
		if (floatval($cart['total']) == 0) {
			$cart['payment_id'] = 0;
		}
		$cart['payment_surcharge'] = 0;
		if (!empty($cart['payment_id']) && !empty($payment_methods[$cart['payment_id']])) {
			$cart['payment_surcharge'] = $payment_methods[$cart['payment_id']]['surcharge_value'];
		}

		$view->assign('titles', fn_get_static_data_section('T'));
		$view->assign('memberships', fn_get_memberships('C', CART_LANGUAGE));
		$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
		$view->assign('states', fn_get_all_states());

		$cart['ship_to_another'] = fn_check_shipping_billing($cart['user_data'], $profile_fields);

		$view->assign('profile_fields', $profile_fields);

		if (Registry::get('settings.General.user_multiple_profiles') == 'Y') {
			$user_profiles = fn_get_user_profiles($auth['user_id']);
			$view->assign('user_profiles', $user_profiles);
		}

		fn_checkout_summary($cart);
		
		if ($edit_step == 'step_two' && $cart['shipping_required'] != true && !empty($completed_steps['step_one']) && empty($profile_fields['B']) && empty($profile_fields['S'])){
			$edit_step = 'step_four';
		}

		// If we're on shipping step and shipping is not required, switch to payment step
		if ($edit_step == 'step_three' && $cart['shipping_required'] != true) {
			$edit_step = 'step_four';
		}

		if (empty($edit_step) || empty($completed_steps[$edit_step])) {
			// If we don't pass step to edit, open default (from settings)
			if (!empty($completed_steps['step_three'])) {
				$edit_step = ($cart['shipping_required'] == true) ? Registry::get('settings.General.checkout_default_step') : 'step_four';
			} else {
				$edit_step = !empty($completed_steps['step_one']) ? 'step_two' : 'step_one';
			}
		}

		$_SESSION['edit_step'] = $edit_step;
		$view->assign('use_ajax', 'true');
		$view->assign('edit_step', $edit_step);
		$view->assign('completed_steps', $completed_steps);
		$view->assign('location', 'checkout');

		if (defined('AJAX_REQUEST')) {

			$view->assign('cart', $cart);
			$view->assign('cart_products', array_reverse($cart_products, true));

			if (in_array('sign_io', Registry::get('ajax')->result_ids)) {
				$view->display('top.tpl');
			}
			if (in_array('cart_status', Registry::get('ajax')->result_ids)) {
				$view->display('views/checkout/components/cart_status.tpl');
			}
			if (in_array('cart_items', Registry::get('ajax')->result_ids)) {
				$view->display('views/checkout/components/cart_items.tpl');
			}
			if (in_array('checkout_totals', Registry::get('ajax')->result_ids)) {
				//$view->assign('location', 'checkout');
				$view->display('views/checkout/components/checkout_totals.tpl');
			}
			if (in_array('checkout_steps', Registry::get('ajax')->result_ids)) {
				$view->display('views/checkout/components/checkout_steps.tpl');
			}
			
			if (in_array('summary', Registry::get('ajax')->result_ids)) {
				$view->display('views/checkout/summary.tpl');
			}
			
			exit;
		}
	}

	$view->assign('cart_products', array_reverse($cart_products, true));

// Step 3: Summary
} elseif ($mode == 'summary') {

	if (!empty($_SESSION['shipping_rates'])) {
		define('CACHED_SHIPPING_RATES', true);
	}

	list($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($cart, $auth, 'E', true, Registry::get('settings.General.one_page_checkout') == 'Y' ? 'F' : 'I'); // we need this for promotions only actually...

	$profile_fields = fn_get_profile_fields('O');

	if (empty($cart['payment_id']) && floatval($cart['total'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.checkout");
	}

	fn_checkout_summary($cart);

	$view->assign('shipping_rates', $_SESSION['shipping_rates']);

	if (defined('AJAX_REQUEST')) {

		if (!empty($cart_products)) {
			foreach($cart_products as $k => $v) {
				fn_gather_additional_product_data($cart_products[$k], true, false, true, false);
			}
		}

		$view->assign('cart', $cart);
		$view->assign('cart_products', array_reverse($cart_products, true));
		$view->assign('location', 'checkout');
		$view->assign('profile_fields', $profile_fields);
		$view->assign('use_ajax', true);

		if (Registry::get('settings.General.one_page_checkout') == 'Y') {
			$view->assign('edit_step', 'step_four');
			$view->display('views/checkout/components/checkout_steps.tpl');
			$view->display('views/checkout/components/cart_items.tpl');
		} else {
			$view->display('views/checkout/checkout.tpl');
		}
		$view->display('views/checkout/components/checkout_totals.tpl');

		exit;
	}

// Delete product from the cart
} elseif ($mode == 'delete' && isset($_REQUEST['cart_id'])) {

	fn_delete_cart_product($cart, $_REQUEST['cart_id']);
	
	if (fn_cart_is_empty($cart) == true) {
		fn_clear_cart($cart);
	}

	fn_save_cart_content($cart, $auth['user_id']);

	$cart['recalculate'] = true;

	if (defined('AJAX_REQUEST')) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_product_has_been_deleted'));
		if ($action == 'from_status') {
			fn_calculate_cart_content($cart, $auth, 'S', true, 'F', true);
			$view->assign('force_items_deletion', true);
			$view->display('views/checkout/components/cart_status.tpl');
			exit;
		}
	}

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout." . $_REQUEST['redirect_mode']);

//Clear cart
} elseif ($mode == 'clear') {

	fn_clear_cart($cart);
	fn_save_cart_content($cart, $auth['user_id']);

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=checkout.cart");
}

if (!empty($profile_fields)) {
	$view->assign('profile_fields', $profile_fields);
}

// Check if any outside checkout is enbaled
if (fn_cart_is_empty($cart) != true && $mode == 'cart') {

	$checkout_buttons = fn_get_checkout_payment_buttons($cart, $cart_products, $auth);
	if (!empty($checkout_buttons)) {
		$view->assign('checkout_add_buttons', $checkout_buttons, false);
	}
}

$view->assign('cart', $cart);
$view->assign('continue_url', empty($_SESSION['continue_url']) ? '' : $_SESSION['continue_url']);
$view->assign('mode', $mode);
$view->assign('payment_methods', $payment_methods);

// Remember mode for the check shipping rates
$_SESSION['checkout_mode'] = $mode;

function fn_prepare_checkout_payment_methods(&$cart, &$auth)
{
	static $payment_methods;

	//Get payment methods
	if (empty($payment_methods)) {
		$payment_methods = fn_get_payment_methods($auth);
	}

	// Check if payment method has surcharge rates
	foreach ($payment_methods as $k => $v) {
		$payment_methods[$k]['surcharge_value'] = 0;
		if (floatval($v['a_surcharge'])) {
			$payment_methods[$k]['surcharge_value'] += $v['a_surcharge'];
		}
		if (floatval($v['p_surcharge']) && !empty($cart['total'])) {
			$payment_methods[$k]['surcharge_value'] += fn_format_price($cart['total'] * $v['p_surcharge'] / 100);
		}
	}

	fn_set_hook('prepare_checkout_payment_methods', $cart, $auth, $payment_methods);

	return $payment_methods;
}

function fn_checkout_summary(&$cart)
{
	if (fn_cart_is_empty($cart) == true) {
		return false;
	}

	fn_set_hook('checkout_summary', $cart);

	//Get payment methods
	$payment_data = fn_get_payment_method_data($cart['payment_id']);

	Registry::get('view')->assign('payment_method', $payment_data);
	Registry::get('view')->assign('credit_cards', fn_get_static_data_section('C', true, 'credit_card'));

	// Downlodable files agreements
	$agreements = array();
	foreach ($cart['products'] as $item) {
		if ($item['is_edp'] == 'Y') {
			if ($_agreement = fn_get_edp_agreements($item['product_id'], true)) {
				$agreements[$item['product_id']] = $_agreement;
			}
		}
	}

	if (!empty($agreements)) {
		Registry::get('view')->assign('cart_agreements', $agreements);
	}
}

function fn_need_shipping_recalculation(&$cart)
{
	if ($cart['recalculate'] == true) {
		return true;
	}

	$recalculate_shipping = false;
	if (!empty($_SESSION['customer_loc'])) {
		foreach ($_SESSION['customer_loc'] as $k => $v) {
			if (!empty($v) && empty($cart['user_data'][$k])) {
				$recalculate_shipping = true;
				break;
			}
		}
	}

	if ($recalculate_shipping == false && !empty($_SESSION['checkout_mode']) && ($_SESSION['checkout_mode'] == 'cart' && MODE == 'checkout')) {
		$recalculate_shipping = true;
	}

	unset($_SESSION['customer_loc']);

	return $recalculate_shipping;

}

function fn_get_checkout_payment_buttons(&$cart, &$cart_products, &$auth)
{
	$checkout_buttons = array();

	$checkout_payments = db_get_fields("SELECT b.payment_id FROM ?:payment_processors as a LEFT JOIN ?:payments as b ON a.processor_id = b.processor_id WHERE a.type != 'P' AND b.status = 'A' AND b.membership_id IN (?n)", array(0, $auth['membership_id']));

	if (!empty($checkout_payments)) {
		foreach ($checkout_payments as $_payment_id) {
			$processor_data = fn_get_processor_data($_payment_id);
			if (!empty($processor_data['processor_script']) && file_exists(DIR_PAYMENT_FILES . $processor_data['processor_script'])) {
				include(DIR_PAYMENT_FILES . $processor_data['processor_script']);
			}
		}
	}

	return $checkout_buttons;
}

function fn_check_profile_fields_population($user_data, $section, $profile_fields)
{
	// If this section does not have fields, assume it's filled
	// or if we're checking shipping section and shipping address does not differ from billing, assume that fields filled correctly
	if (empty($profile_fields[$section]) || ($section == 'S' && fn_check_shipping_billing($user_data, $profile_fields) == false)) {
		return true;
	}

	foreach($profile_fields[$section] as $field) {
		if ($field['required'] == 'Y' && ((!empty($field['field_name']) && empty($user_data[$field['field_name']])) || (empty($field['field_name']) && empty($user_data['fields'][$field['field_id']])))) {
			if ($field['field_type'] == 'A') {
				if (($field['field_name'] == 'b_state') && !empty($user_data['b_country'])) {
					$_states = db_get_field("SELECT COUNT(*) FROM ?:states WHERE country_code = ?s AND status = 'A'", $user_data['b_country']);
					if (empty($_states)) {
						return true;
					}
				} elseif (($field['field_name'] == 's_state') && !empty($user_data['s_country'])) {
					$_states = db_get_field("SELECT COUNT(*) FROM ?:states WHERE country_code = ?s AND status = 'A'", $user_data['s_country']);
					if (empty($_states)) {
						return true;
					}
				}
			}
			return false;
		}
	}
	return true;
}

function fn_checkout_update_shipping(&$cart, $shipping_ids)
{
	$cart['shipping'] = array();
	$parsed_data = array();
	foreach ($shipping_ids as $k => $shipping_id) {
		if (strpos($k, ',') !== false) {
			$parsed_data = fn_array_merge($parsed_data, fn_array_combine(fn_explode(',', $k), $shipping_id));
		} else {
			$parsed_data[$k] = $shipping_id;
		}
	}

	foreach ($parsed_data as $k => $shipping_id) {
		if (empty($cart['shipping'][$shipping_id])) {
			$cart['shipping'][$shipping_id] = array(
				'shipping' => $_SESSION['shipping_rates'][$shipping_id]['name'],
			);
		}

		$cart['shipping'][$shipping_id]['rates'][$k] = $_SESSION['shipping_rates'][$shipping_id]['rates'][$k];
	}

	return true;
}
?>
