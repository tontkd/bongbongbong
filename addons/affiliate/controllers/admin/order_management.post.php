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

	if ($mode == 'update_totals') {

		$cart = & $_SESSION['cart'];
		// Update Affiliate code
		if (Registry::get('addons.affiliate.show_affiliate_code') == 'Y' || (!empty($cart['order_id']) && $cart['affiliate']['is_payouts'] != 'Y')) {
			$cart['affiliate']['code'] = empty($_REQUEST['affiliate_code']) ? '' : $_REQUEST['affiliate_code'];
			$_partner_id = fn_any2dec($cart['affiliate']['code']);
			$cart['affiliate']['partner_id'] = db_get_field("SELECT user_id FROM ?:users WHERE user_id = ?i AND user_type = 'P'", $_partner_id);
		}
	}

	return;
}

?>
