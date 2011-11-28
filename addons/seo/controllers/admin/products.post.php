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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}

if ($mode == 'manage') {

	$selected_fields = $view->get_var('selected_fields');

	$selected_fields[] = array(
		'name' => '[extra][seo_name]',
		'text' => fn_get_lang_var('seo_name')
	);

	$view->assign('selected_fields', $selected_fields);

} elseif ($mode == 'm_update') {

	$selected_fields = $_SESSION['selected_fields'];

	if (!empty($selected_fields['extra']['seo_name'])) {

		$field_groups = $view->get_var('field_groups');
		$filled_groups = $view->get_var('filled_groups');

		$field_groups['A']['seo_name'] = 'products_data';
		$filled_groups['A']['seo_name'] = fn_get_lang_var('seo_name');

		$view->assign('field_groups', $field_groups);
		$view->assign('filled_groups', $filled_groups);
	}
}
?>