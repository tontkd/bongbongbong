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
// $Id: order_management.pre.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'place_order' && !empty($_REQUEST['payment_info']['card_number'])) {
		if (fn_card_number_is_blocked($_REQUEST['payment_info']['card_number'])) {
			fn_set_notification('E', fn_get_lang_var('error'), str_replace('[cc_number]', $_REQUEST['payment_info']['card_number'], fn_get_lang_var('text_cc_number_is_blocked')));

			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=order_management.summary");
		}
	
	} elseif ($mode == 'customer_info') {
		if (fn_email_is_blocked($_REQUEST['user_data'])) {

			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=order_management.customer_info");
		}
	}
}

?>
