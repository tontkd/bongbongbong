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
// $Id: init.php 7745 2009-07-21 07:15:15Z alexions $
//

if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'change_order_status',
	'delete_product',
	'get_products',
	'products_sorting',
	'update_product',
	'get_product_data'
);

?>
