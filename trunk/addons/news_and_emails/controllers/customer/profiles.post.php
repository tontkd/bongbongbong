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
// $Id: profiles.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($mode == 'add' || $mode == 'update') {
		$subscriber = db_get_row("SELECT * FROM ?:subscribers WHERE email = ?s", $_REQUEST['user_data']['email']);

		if (empty($subscriber)) {
			$_data = array(			
				'email' => $_REQUEST['user_data']['email'],
				'timestamp' => TIME,				
			);
						
			$subscriber_id = db_query("INSERT INTO ?:subscribers ?e", $_data);				
		} else {
			$subscriber_id = $subscriber['subscriber_id'];
		}
		
		fn_update_subscriptions($subscriber_id, $_REQUEST['mailing_lists'], $_REQUEST['newsletter_format'], NEWSLETTER_DELETE_UNCHECKED);
	}
	return;
}

if ($mode == 'add' || $mode == 'update') {	
	$view->assign('page_mailing_lists', fn_get_mailing_lists(array('registration' => true)));	
}


if ($mode == 'update') {	
	$email = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i", $_SESSION['auth']['user_id']);
	$mailing_lists = db_get_hash_array("SELECT * FROM ?:subscribers INNER JOIN ?:user_mailing_lists ON ?:subscribers.subscriber_id = ?:user_mailing_lists.subscriber_id WHERE ?:subscribers.email = ?s", 'list_id', $email);
	$view->assign('user_mailing_lists', $mailing_lists);
	// on profile page we show only one "format" selectbox. so we take active format from 
	// first active newsletter from this user.
	$first = array_shift($mailing_lists);	
	$view->assign('newsletter_format', $first['format']);
}



?>
