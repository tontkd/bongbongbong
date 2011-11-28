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
// $Id: orders.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$schema = array (
	'#section' => 'orders',
	'#pattern_id' => 'orders',
	'#name' => fn_get_lang_var('orders'),
	'#key' => array('order_id'),
	'#table' => 'orders',
	'#range_options' => array (
		'#selector_url' => INDEX_SCRIPT . '?dispatch=orders.manage',
		'#object_name' => fn_get_lang_var('orders'),
	),
	'#export_fields' => array (
		'Order ID' => array (
			'#db_field' => 'order_id',
			'#alt_key' => true,
			'#required' => true,
		),
		'E-mail' => array (
			'#db_field' => 'email',
			'#alt_key' => true,
			'#required' => true,
		),
		'User ID' => array (
			'#db_field' => 'user_id'
		),
		'Total' => array (
			'#db_field' => 'total'
		),
		'Subtotal' => array (
			'#db_field' => 'subtotal'
		),
		'Discount' => array (
			'#db_field' => 'discount'
		),
		'Payment surcharge' => array (
			'#db_field' => 'payment_surcharge'
		),
		'Shipping cost' => array (
			'#db_field' => 'shipping_cost'
		),
		'Date' => array (
			'#db_field' => 'timestamp',
			'#process_get' => array ('fn_timestamp_to_date', '#this'),
			'#convert_put' => array ('fn_date_to_timestamp'),
		),
		'Status' => array (
			'#db_field' => 'status',
		),
		'Notes' => array (
			'#db_field' => 'notes',
		),
		'Payment ID' => array (
			'#db_field' => 'payment_id',
		),
		'IP address' => array (
			'#db_field' => 'ip_address',
		),
		'Details' => array (
			'#db_field' => 'details',
		),
		'Payment information' => array (
			'#linked' => false,
			'#process_get' => array('fn_exim_orders_get_data', '#key', 'P'),
			'#process_put' => array('fn_exim_orders_set_data', '#key', '#this', 'P')
		),
		'Taxes' => array (
			'#linked' => false,
			'#process_get' => array('fn_exim_orders_get_data', '#key', 'T'),
			'#process_put' => array('fn_exim_orders_set_data', '#key', '#this', 'T')
		),
		'Coupons' => array (
			'#linked' => false,
			'#process_get' => array('fn_exim_orders_get_data', '#key', 'C'),
			'#process_put' => array('fn_exim_orders_set_data', '#key', '#this', 'C')
		),
		'Shipping' => array (
			'#linked' => false,
			'#process_get' => array('fn_exim_orders_get_data', '#key', 'L'),
			'#process_put' => array('fn_exim_orders_set_data', '#key', '#this', 'L')
		),
		'Title' => array (
			'#db_field' => 'title'
		),
		'First name' => array (
			'#db_field' => 'firstname'
		),
		'Last name' => array (
			'#db_field' => 'lastname'
		),
		'Company' => array (
			'#db_field' => 'company'
		),
		'Fax' => array (
			'#db_field' => 'fax'
		),
		'Phone' => array (
			'#db_field' => 'phone'
		),
		'Web site' => array (
			'#db_field' => 'url'
		),
		'Tax exempt' => array (
			'#db_field' => 'tax_exempt'
		),
		'Language' => array (
			'#db_field' => 'lang_code'
		),
		'Billing: title' => array (
			'#db_field' => 'b_title',
		),
		'Billing: first name' => array (
			'#db_field' => 'b_firstname',
		),
		'Billing: last name' => array (
			'#db_field' => 'b_lastname',
		),
		'Billing: address' => array (
			'#db_field' => 'b_address',
		),
		'Billing: address (line 2)' => array (
			'#db_field' => 'b_address_2',
		),
		'Billing: city' => array (
			'#db_field' => 'b_city',
		),
		'Billing: state' => array (
			'#db_field' => 'b_state',
		),
		'Billing: country' => array (
			'#db_field' => 'b_country',
		),
		'Billing: zipcode' => array (
			'#db_field' => 'b_zipcode',
		),
		'Shipping: title' => array (
			'#db_field' => 's_title',
		),
		'Shipping: first name' => array (
			'#db_field' => 's_firstname',
		),
		'Shipping: last name' => array (
			'#db_field' => 's_lastname',
		),
		'Shipping: address' => array (
			'#db_field' => 's_address',
		),
		'Shipping: address (line 2)' => array (
			'#db_field' => 's_address_2',
		),
		'Shipping: city' => array (
			'#db_field' => 's_city',
		),
		'Shipping: state' => array (
			'#db_field' => 's_state',
		),
		'Shipping: country' => array (
			'#db_field' => 's_country',
		),
		'Shipping: zipcode' => array (
			'#db_field' => 's_zipcode',
		),
		'Extra fields' => array (
			'#linked' => false,
			'#process_get' => array('fn_exim_orders_get_extra_fields', '#key', '@lang_code'),
			'#process_put' => array('fn_exim_orders_set_extra_fields', '#this', '#key', '@lang_code')
		)
	),
);

// ------------- Utility functions ---------------

//
// Get order data information
// Parameters:
// @order_id - order ID
// @type - type of information

function fn_exim_orders_get_data($order_id, $type)
{

	$data = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = ?s", $order_id, $type);
	if (!empty($data)) {

		// Payment information
		if ($type == 'P') {
			$data = @unserialize(fn_decrypt_text($data));
		// Coupons, Taxes and Shipping information
		} elseif (strpos('CTL', $type) !== false) {
			$data = @unserialize($data);
		}

		return YAML_Parser::serialize($data);
	}
}

//
// Get order data information
// Parameters:
// @order_id - order ID
// @data - data to set
// @type - type of information

function fn_exim_orders_set_data($order_id, $data, $type)
{

	$set_delimiter = ';';
	$pair_delimiter = ':';
	$left = '[';
	$right = ']';


	$data = YAML_Parser::unserialize($data);
	if (is_array($data)) {
		$data = serialize($data);
		if ($type == 'P') {
			$data = fn_encrypt_text($data);
		}
		$insert = array (
			'order_id' => $order_id,
			'type' => $type,
			'data' => $data
		);

		db_query("REPLACE INTO ?:order_data ?e", $insert);
	}

	return true;
}

function fn_exim_orders_get_extra_fields($user_id, $lang_code)
{
	$lang_code = 'EN';

	$fields = array();
	$_user = db_get_hash_single_array("SELECT d.description, f.value FROM ?:profile_fields_data as f LEFT JOIN ?:profile_field_descriptions as d ON d.object_id = f.field_id AND d.object_type = 'F' AND d.lang_code = ?s WHERE f.object_id = ?i  AND f.object_type = 'U'", array('description', 'value'), $lang_code, $user_id);

	$_profile = db_get_array("SELECT d.description, f.value, a.section FROM ?:profile_fields_data as f LEFT JOIN ?:profile_field_descriptions as d ON d.object_id = f.field_id AND d.object_type = 'F' AND d.lang_code = ?s LEFT JOIN ?:user_profiles as p ON f.object_id = p.profile_id AND f.object_type = 'P' LEFT JOIN ?:profile_fields as a ON a.field_id = f.field_id WHERE p.user_id = ?i", $lang_code, $user_id);

	if (!empty($_user)) {
		$fields['user'] = $_user;
	}

	if (!empty($_profile)) {
		foreach ($_profile as $field) {
			if ($field['section'] == 'B') {
				$type = 'billing';
			} else {
				$type = 'shipping';
			}

			$fields[$type][$field['description']] = $field['value'];
		}
	}

	if (!empty($fields)) {
		return YAML_Parser::serialize($fields);
	}

	return '';
}

function fn_exim_orders_set_extra_fields($data, $user_id, $lang_code)
{
	$lang_code = 'EN';

	$data = YAML_Parser::unserialize($data);

	if (!empty($data) && is_array($data)) {
		foreach ($data as $type => $_data) {
			foreach ($_data as $field => $value) {
				// Check if field is exist
				if ($type == 'billing' || $type == 'shipping') {
					$section = strtoupper(substr($type, 0, 1));
					$field_id = db_get_field("SELECT object_id FROM ?:profile_field_descriptions LEFT JOIN ?:profile_fields ON ?:profile_fields.field_id = ?:profile_field_descriptions.object_id WHERE description = ?s AND ?:profile_fields.section = ?s AND object_type = 'F' LIMIT 1", $field, $section);
				} else {
					$field_id = db_get_field("SELECT object_id FROM ?:profile_field_descriptions WHERE description = ?s AND object_type = 'F' LIMIT 1", $field);
				}

				if (!empty($field_id)) {
					$update = array (
						'object_id' => (($type == 'user') ? $user_id : (db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i LIMIT 1", $user_id))),
						'object_type' => (($type == 'user') ? 'U' : 'P'),
						'field_id' => $field_id,
						'value' => $value
					);

					db_query('REPLACE INTO ?:profile_fields_data ?e', $update);
				}
			}
		}

		return true;
	}

	return false;
}
?>