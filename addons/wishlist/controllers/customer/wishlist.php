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
// $Id: wishlist.php 7636 2009-06-30 07:03:06Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }


if (empty($auth['user_id'])) {
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=auth.login_form&return_url=" . urlencode(Registry::get('config.current_url')));
}

$_SESSION['wishlist'] = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : array();
$wishlist = & $_SESSION['wishlist'];

$_SESSION['continue_url'] = isset($_SESSION['continue_url']) ? $_SESSION['continue_url'] : '';
$auth = & $_SESSION['auth'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Add product to the wishlist
	if ($mode == 'add') {
		// wishlist is empty, create it
		if (empty($wishlist)) {
			$wishlist = array(
				'products' => array()
			);
		}

		fn_add_product_to_wishlist($_REQUEST['product_data'], $wishlist, $auth);

		fn_save_cart_content($wishlist, $auth['user_id'], 'W');

		if (defined('AJAX_REQUEST')) {
			$msg = fn_get_lang_var('text_product_added_to');
			$msg = str_replace('[target]', strtolower(fn_get_lang_var('wishlist')), $msg);
			fn_set_notification('N', fn_get_lang_var('notice'), $msg);
			exit;
		} else {
			return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=wishlist.view");
		}
	}	

	fn_save_cart_content($wishlist, $auth['user_id'], 'W');

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=wishlist.view");
}

if ($mode == 'clear') {
	$wishlist = array();

	fn_save_cart_content($wishlist, $auth['user_id'], 'W');
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=wishlist.view");

} elseif ($mode == 'delete' && !empty($_REQUEST['cart_id'])) {
	fn_delete_wishlist_product($wishlist, $_REQUEST['cart_id']);

	fn_save_cart_content($wishlist, $auth['user_id'], 'W');
	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=wishlist.view");

} elseif ($mode == 'view') {

	fn_add_breadcrumb(fn_get_lang_var('wishlist_content'));

	$products = !empty($wishlist['products']) ? $wishlist['products'] : array();

	if (!empty($products)) {
		foreach($products as $k => $v) {
			$products[$k] = fn_get_product_data($v['product_id'], $auth);
			if (empty($products[$k])) {
				unset($products[$k], $wishlist['products'][$k]);
				continue;
			}
			fn_gather_additional_product_data($products[$k], true);
			$products[$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $v['product_options'], CART_LANGUAGE);
			$products[$k]['price'] = fn_apply_options_modifiers($v['product_options'], $products[$k]['price'], 'P');
		}
	}

	$view->assign('products', $products);
	$view->assign('wishlist', $wishlist);
	$view->assign('continue_url', $_SESSION['continue_url']);
}

/**
 * Add product to wishlist
 *
 * @param array $product_data array with data for the product to add)(product_id, price, amount, product_options, is_edp)
 * @param array $wishlist wishlist data storage
 * @param array $auth user session data
 * @return mixed array with wishlist IDs for the added products, false otherwise
 */
function fn_add_product_to_wishlist($product_data, &$wishlist, &$auth)
{
	fn_set_hook('pre_add_to_wishlist', $product_data, $wishlist, $auth);

	if (!empty($product_data) && is_array($product_data)) {
		$wishlist_ids = array();
		foreach ($product_data as $product_id => $data) {
			if (empty($data['amount'])) {
				$data['amount'] = 1;
			}

			if (empty($data['extra'])) {
				$data['extra'] = array();
			}

			// Add one product
			if (!isset($data['product_options'])) {
				$data['product_options'] = fn_get_default_product_options($product_id);
			}

			// Generate wishlist id
			$data['extra']['product_options'] = $data['product_options'];
			$wishlist_ids[] = $_id = fn_generate_cart_id($product_id, $data['extra']);
			$wishlist['products'][$_id]['product_id'] = $product_id;
			$wishlist['products'][$_id]['product_options'] = $data['product_options'];
			$wishlist['products'][$_id]['extra'] = $data['extra'];
		}

		return $wishlist_ids;
	} else {
		return false;
	}
}

/**
 * Delete product from the wishlist
 *
 * @param array $wishlist wishlist data storage
 * @param int $wishlist_id ID of the product to delete from wishlist
 * @return mixed array with wishlist IDs for the added products, false otherwise
 */
function fn_delete_wishlist_product(&$wishlist, $wishlist_id)
{
	fn_set_hook('delete_wishlist_product', $wishlist, $wishlist_id);

	if (!empty($wishlist_id)) {
		unset($wishlist['products'][$wishlist_id]);
	}

	return true;
}
?>
