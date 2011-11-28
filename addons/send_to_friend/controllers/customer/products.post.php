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

if ( !defined('AREA') ) { die('Access denied'); }

Registry::set('navigation.tabs.send_to_friend', array (
	'title' => fn_get_lang_var('send_to_friend'),
	'js' => true
));

if (!empty($_SESSION['saved_post_data']['send_data'])) {
	$view->assign('send_data', $_SESSION['saved_post_data']['send_data']);
	unset($_SESSION['saved_post_data']['send_data']);
}


?>
