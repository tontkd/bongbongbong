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
// $Id: categories.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD']	== 'POST') {

	return;
}

if ($mode == 'update') {

	// Add new tab to page sections
	// [Page sections]
	// Add new tab to page sections
	Registry::set('navigation.tabs.reward_points', array (
		'title' => fn_get_lang_var('reward_points'),
		'js' => true
	));


	// [/Page sections]

	$view->assign('reward_points', fn_get_reward_points($_REQUEST['category_id'], CATEGORY_REWARD_POINTS));
	$view->assign('object_type', CATEGORY_REWARD_POINTS);	
	
} elseif ($mode == 'add') {

	// Add new tab to page sections
	// [Page sections]
	Registry::set('navigation.tabs.reward_points', array (
		'title' => fn_get_lang_var('reward_points'),
		'js' => true
	));
	// [/Page sections]
		
	$view->assign('object_type', CATEGORY_REWARD_POINTS);	
}

$view->assign('reward_memberships', fn_array_merge(fn_get_memberships('C'), array( array( 
	'membership_id' => NOT_A_MEMBER, 
	'membership' => fn_get_lang_var('not_a_member'))
)));

/** /Body **/
?>
