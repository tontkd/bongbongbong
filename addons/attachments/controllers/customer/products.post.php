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

if (!defined('AREA')) { die('Access denied'); }

if ($mode == 'view') {
	// Assign attachments files for products
	$product_id = !empty($_REQUEST['product_id']) ? intval($_REQUEST['product_id']) : 0;
	$attachments = fn_get_attachments('product', $product_id);

	if (!empty($attachments)) {
		Registry::set('navigation.tabs.attachments', array (
			'title' => fn_get_lang_var('attachments'),
			'js' => true
		));

		$view->assign('attachments_data', $attachments);
	}
}
?>