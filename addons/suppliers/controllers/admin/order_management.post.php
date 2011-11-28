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
// $Id: order_management.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	/*if ($mode == 'update_totals') {	// FIXME - do we need it?
		if (!empty($_REQUEST['suppliers_shipping']) &&  !empty($_REQUEST['shipping_rates'])) {
			foreach ((array)$_REQUEST['suppliers_shipping']['current'] as $supplier_id => $shipping_id) {
				$pr_shipping_id = $_REQUEST['suppliers_shipping']['previous'][$supplier_id];
				if (empty($pr_shipping_id)) {
					$suppliers_shipping_method = fn_get_suppliers_shipping_method($cart);
					$pr_shipping_id = $suppliers_shipping_method[$supplier_id];
				}
				if ($shipping_id != $pr_shipping_id) {
					$cart['shipping'][$shipping_id]['suppliers'][$supplier_id] = '';
					unset($cart['shipping'][$pr_shipping_id]['suppliers'][$supplier_id]);
					if (empty($cart['shipping'][$pr_shipping_id]['suppliers'])) {
						unset($cart['shipping'][$pr_shipping_id]);
					}
				}
			}
		}
	}
	return;
	*/
}

?>