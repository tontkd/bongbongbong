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
// $Id: qty_discounts.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Additional product images schema
//
$schema = array (
	'#section' => 'products',
	'#name' => fn_get_lang_var('qty_discounts'),
	'#pattern_id' => 'qty_discounts',
	'#key' => array('product_id'),
	'#table' => 'products',
	'#references' => array (
		'product_prices' => array (
			'#reference_fields' => array('product_id' => '#key'),
			'#join_type' => 'INNER',
			'#alt_key' => array('lower_limit', 'membership_id', '#key')
		),
	),
	'#range_options' => array (
		'#selector_url' => INDEX_SCRIPT . '?dispatch=products.manage',
		'#object_name' => fn_get_lang_var('products'),
	),
	'#options' => array (
		'lang_code' => array (
			'title' => 'language',
			'type' => 'languages'
		),
	),
	'#export_fields' => array (
		'Product code' => array (
			'#required' => true,
			'#alt_key' => true,
			'#db_field' => 'product_code'
		),
		'Price' => array (
			'#table' => 'product_prices',
			'#db_field' => 'price',
			'#required' => true,
		),
		'Lower limit' => array (
			'#table' => 'product_prices',
			'#db_field' => 'lower_limit',
			'#key_component' => true,
			'#required' => true,
		),
		'Membership' => array (
			'#db_field' => 'membership_id',
			'#table' => 'product_prices',
			'#key_component' => true,
			'#process_get' => array ('fn_exim_get_membership', '#this', '@lang_code'),
			'#process_put' => array('fn_exim_put_membership', '#this', '@lang_code'),
			'#return_result' => true
		),
	),
);

function fn_exim_get_membership($membership_id, $lang_code = '')
{
	return db_get_field("SELECT membership FROM ?:membership_descriptions WHERE membership_id = ?i AND lang_code = ?s", $membership_id, $lang_code);
}

function fn_exim_put_membership($data, $lang_code = '')
{
	if (empty($data)) {
		return 0;
	}

	$membership_id = db_get_field("SELECT membership_id FROM ?:membership_descriptions WHERE membership = ?s AND lang_code = ?s LIMIT 1", $data, $lang_code);

	// Create new membership
	if (empty($membership_id)) {
		$_data = array (
			'type' => 'C', //customer
			'status' => 'A'
		);

		$membership_id = db_query("INSERT INTO ?:memberships ?e", $_data);

		$_data = array (
			'membership_id' => $membership_id,
			'membership' => $data
		);
		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
			db_query("INSERT INTO ?:membership_descriptions ?e", $_data);
		}
	}

	return $membership_id;
}

?>