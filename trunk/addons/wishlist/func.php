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
// $Id: func.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }


function fn_wishlist_fill_user_fields(&$exclude)
{
	$exclude[] = 'wishlist';
}

//
//
//
function fn_wishlist_get_gift_certificate_info(&$_certificate, $certificate, $type)
{
	if ($type == 'W' && is_numeric($certificate)) {
		$_certificate = fn_array_merge($_SESSION['wishlist']['gift_certificates'][$certificate], array('gift_cert_wishlist_id' => $certificate));
	}
}

function fn_wishlist_user_init(&$auth, &$user_info)
{
	if (defined('LOGGED_VIA_COOKIE') && !empty($auth['user_id'])) {
		fn_extract_cart_content($_SESSION['wishlist'], $auth['user_id'], 'W');

		return true;
	}

	return false;
}

function fn_wishlist_init_user_session_data(&$sess_data, $user_id)
{
	fn_extract_cart_content($sess_data['wishlist'], $user_id, 'W');

	return true;
}

?>
