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
	'update_profile',
	'place_order',
	'edit_place_order',
	'get_users',
	'get_profile_fields',
	'get_user_type_description',
	'pre_promotion_check_coupon',
	'promotion_check_coupon',
	'auth_routines',
	'fill_auth',
	'profile_fields_areas',
	'get_order_info',
	'delete_user',
	'form_cart',
	'get_products',
	'check_user_type',
	'user_need_login',
	'change_order_status'
);

?>
