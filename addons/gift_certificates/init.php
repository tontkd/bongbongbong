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
// $Id: init.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'place_order',
	'get_order_info',
	'change_order_status',
	'order_notification',
	'delete_order',
	'delete_cart_product',
	'generate_cart_id',
	array('calculate_cart', 200),
	array('exclude_products_from_calculation', 100),
	'form_cart',
	'allow_place_order',
	'save_cart',
	'extract_cart',
	'get_cart_item_types',
	'is_cart_empty',
	'exclude_from_shipping_calculation',
	'get_orders',
	'pre_add_to_cart',
	'delete_cart_product',
	'init_secure_controllers',
	'get_status_params_definition',
	'get_manifest_definition',
	'get_google_codes',
	'apply_google_codes',
	'form_google_codes_response',
	'google_coupons_calculation',
	'get_google_add_items',
	'reorder'
);

?>
