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

if (!defined('AREA')) { die('Access denied'); }

if ($mode == 'view') {
	$product_id = empty($_REQUEST['product_id']) ? 0 : $_REQUEST['product_id'];

	if ($product_id) {
		$ids = db_get_field('SELECT count(req_prod.required_id) FROM ?:product_required_products as req_prod LEFT JOIN ?:products ON req_prod.required_id = ?:products.product_id WHERE req_prod.product_id = ?i AND ?:products.status != ?s', $product_id, 'D');

		if ($ids) {
			Registry::set('navigation.tabs.required_products', array (
				'title' => fn_get_lang_var('required_products'),
				'js' => true
			));
		}
	}
}

?>