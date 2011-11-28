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
// $Id: site_layout.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($mode == 'update_variables') {
		if (!empty($_REQUEST['site_layout_data']) && !empty($_REQUEST['site_layout_data']['discussion_type'])) {
			$dicussion = array();
			$discussion['type'] = $_REQUEST['site_layout_data']['discussion_type'];
			$discussion['object_type'] = 'E';
			$discussion['object_id'] = 0;
			
			fn_update_discussion($discussion);
		}
	}
	
	return array(CONTROLLER_STATUS_OK);
}

if ($mode == 'manage') {
	$discussion = fn_get_discussion(0, 'E');
	if (!empty($discussion) && $discussion['type'] != 'D') {
		Registry::set('navigation.tabs.discussion', array (
			'title' => fn_get_lang_var('discussion_title_home_page'),
			'js' => true,
		));
		
		$view->assign('discussion', $discussion);
	}
}

?>
