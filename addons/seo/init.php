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
	'delete_product', 
	'delete_category',
	'delete_page', 
	'clone_product', 
	'exim_get_product_url', 
	'get_product_data', 
	'get_products',
	'get_category_data', 
	'get_page_data', 
	'add_breadcrumb', 
	'redirect', 
	'get_listmania_object_link', 
	'get_route',
	'update_category',
	'update_product',
	'update_page',
	'init_templater',
	'get_product_feature_variants',
	'update_product_feature'
);

?>
