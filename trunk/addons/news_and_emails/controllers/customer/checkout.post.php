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
// $Id: checkout.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($mode == 'customer_info') {
		
		if (!empty($_REQUEST['mailing_lists'])) {
			$subscriber = db_get_row("SELECT * FROM ?:subscribers WHERE email='{$_REQUEST['user_data']['email']}'");

			if (empty($subscriber)) {
				$_data = array(			
					'email' => $_REQUEST['user_data']['email'],
					'timestamp' => TIME,				
				);
							
				$subscriber_id = db_query("INSERT INTO ?:subscribers ?e", $_data);							
			} else {
				$subscriber_id = $subscriber['subscriber_id'];
			}
			
			fn_update_subscriptions($subscriber_id, $_REQUEST['mailing_lists'], $_REQUEST['newsletter_format'], NEWSLETTER_SAVE_UNCHECKED);
		}
	}
	return;
}

if ($mode == 'checkout') {	
	$view->assign('page_mailing_lists', fn_get_mailing_lists(array('checkout' => true)));		
}


?>
