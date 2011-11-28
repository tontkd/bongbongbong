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
// $Id: products.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'add' || $mode == 'update' || $mode == 'm_update' || $mode == 'manage') {
	
	$params = array(
		'user_type' => 'S'
	);

	list($suppliers) = fn_get_users($params, $auth);

	$view->assign('suppliers', $suppliers);			
}

if ($mode == 'manage'){

	$selected_fields = $view->get_var('selected_fields');

	$selected_fields[] = array(
		'name' => '[data][supplier_id]',
		'text' => fn_get_lang_var('supplier')
	);

	$view->assign('selected_fields', $selected_fields);
}

?>