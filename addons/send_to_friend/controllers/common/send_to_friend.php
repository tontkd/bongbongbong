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
// $Id: send_to_friend.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'send') {
		if (Registry::get('settings.Image_verification.use_for_send_to_friend') == 'Y' && fn_image_verification('send_to_friend', empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
			fn_save_post_data();

			return array(CONTROLLER_STATUS_REDIRECT);
		}

		if (!empty($_REQUEST['send_data']['to_email'])) {
			$view_mail->assign('send_data', $_REQUEST['send_data']);
			$view_mail->assign('link', Registry::get('config.http_location') . '/' . fn_query_remove($_REQUEST['redirect_url'], 'selected_section'));

			fn_send_mail($_REQUEST['send_data']['to_email'], array('email' => $_REQUEST['send_data']['from_email'], 'name' => 	$_REQUEST['send_data']['from_name']), 'addons/send_to_friend/mail_subj.tpl', 'addons/send_to_friend/mail.tpl', '', CART_LANGUAGE);
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_email_sent'));
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_no_recipient_address'));
		}

		return array(CONTROLLER_STATUS_REDIRECT);
	}
}

?>
