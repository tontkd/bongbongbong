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
// $Id: init.php 7574 2009-06-10 13:15:30Z lexa $
//

if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'clone_product', 
	'delete_cart_product', 
	'delete_wishlist_product', 
	'generate_cart_id',
	'get_products',
	'pre_add_to_cart',
	'calculate_cart',
	'pre_add_to_wishlist',
	'get_products_post'
);

?>