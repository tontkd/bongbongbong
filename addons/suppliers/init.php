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
// $Id: init.php 7774 2009-07-31 09:47:01Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'get_google_shipping_rate',
	'prepare_google_shippings',
	'fill_google_shipping_info',
	'get_profile_fields',
	'get_product_data',
	'order_notification',
	'add_to_cart',
	'get_products',
	'get_product_filter_fields',
	'get_user_type_description',
	'get_status_params_definition',
	'profile_fields_areas',
	'reorder',
	'prepare_package_info',
	'update_shipping',
	'get_cart_product_data',
	'apply_cart_shipping_rates',
	'calculate_shipping_rates'
);

?>
