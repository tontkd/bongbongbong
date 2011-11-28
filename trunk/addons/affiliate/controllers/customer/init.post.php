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
// $Id: init.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if (Registry::get('addons.affiliate.show_affiliate_code') == 'Y' && !empty($_SESSION['partner_data']) && !empty($_SESSION['partner_data']['partner_id'])) {
	$view->assign('partner_code', fn_dec2any($_SESSION['partner_data']['partner_id']));
}

if (empty($auth['is_affiliate']) && in_array(CONTROLLER, Registry::get('affiliate_controllers'))) {
	return array(CONTROLLER_STATUS_REDIRECT, $index_script);
}

?>