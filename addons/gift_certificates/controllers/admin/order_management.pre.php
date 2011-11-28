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
// $Id: order_management.pre.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//
	// Delete products from the cart
	//
	if ($mode == 'delete') {

		foreach ($_REQUEST['cart_ids'] as $cart_id) {
			if (isset($cart['products'][$cart_id])) {
				$product = $cart['products'][$cart_id];
				if (!empty($product['extra']['exclude_from_calculate']) && $product['extra']['exclude_from_calculate'] == GIFT_CERTIFICATE_EXCLUDE_PRODUCTS){
					$cart['deleted_exclude_products'][GIFT_CERTIFICATE_EXCLUDE_PRODUCTS][$cart_id] = array(
						'product_id' => $product['product_id'],
						'in_use_certificate' => $product['extra']['in_use_certificate']
					);
				}

				if (isset($product['extra']['parent']['certificate'])) {
					unset($cart['gift_certificates'][$product['extra']['parent']['certificate']]['products'][$product['product_id']]);
				}
			}
		}
	}
}

?>