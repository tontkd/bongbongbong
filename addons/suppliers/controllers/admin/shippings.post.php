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
// $Id: shippings.post.php 7774 2009-07-31 09:47:01Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	return;
}

// Collect shipping methods data
if ($mode == 'update') {
	$shipping = $view->get_var('shipping');
	if (!empty($shipping['supplier_ids'])) {
		$shipping['supplier_ids'] = fn_explode(',', $shipping['supplier_ids']);
		$view->assign('shipping', $shipping);
	}

	$params = array(
		'user_type' => 'S'
	);

	list($suppliers) = fn_get_users($params, $auth);

	$view->assign('suppliers', $suppliers);

} elseif ($mode == 'add') {
	$params = array(
		'user_type' => 'S'
	);

	list($suppliers) = fn_get_users($params, $auth);

	$view->assign('suppliers', $suppliers);
}


?>