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
// $Id: profiles.post.php 7774 2009-07-31 09:47:01Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'm_delete') {
		if (!empty($_REQUEST['user_ids']) && !empty($_REQUEST['user_types'])) {
			foreach ($_REQUEST['user_ids'] as $v) {
				if ($_REQUEST['user_types'][$v] == SUPPLIER) {
					$suppliers_products = db_get_fields("SELECT product_id FROM ?:products WHERE supplier_id = ?i", 'product_id', $v);
					if (!empty($suppliers_products)) {
						db_query("UPDATE ?:products SET ?u WHERE product_id IN (?n)", array('supplier_id' => 0), $supplier_products);
					}

					db_query("UPDATE ?:shippings SET supplier_ids = ?p", fn_remove_from_set('supplier_ids', $v));
				}
			}
		}
	}
}

?>
