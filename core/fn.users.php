<?php
/*
=====================================================
 Cs-Cart 2.0.7 Nulled By KenDesign
-----------------------------------------------------
 www.freeshareall.com - www.freeshareall.net
-----------------------------------------------------
 KenDesign Team
=====================================================
*/


//
// $Id: fn.users.php 7808 2009-08-12 14:28:04Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

//
// Get user info
//
function fn_get_user_info($user_id, $get_profile = true, &$profile_id = NULL)
{

	$user_fields = array (
		'user_id',
		'user_type',
		'status',
		'user_login',
		'membership_status',
		'membership_id',
		'title',
		'firstname',
		'lastname',
		'company',
		'email',
		'phone',
		'fax',
		'url',
		'tax_exempt',
		'lang_code'
	);

	$user_fields = implode(',', $user_fields);

	$user_data = db_get_row("SELECT $user_fields FROM ?:users WHERE user_id = ?i", $user_id);
	
	if (empty($user_data)) {
		return array();
	}

	if ($get_profile == true) {
		if (!empty($profile_id)) {
			$profile_data = db_get_row("SELECT * FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i", $user_data['user_id'], $profile_id);
		}

		if (empty($profile_data)) {
			$profile_data = db_get_row("SELECT * FROM ?:user_profiles WHERE user_id = ?i AND profile_type = 'P'", $user_data['user_id']);
			$profile_id = $profile_data['profile_id'];
		}

		$user_data = fn_array_merge($user_data, $profile_data);
	}

	// Get additional fields
	$prof_cond = ($get_profile && !empty($profile_data['profile_id'])) ? db_quote("OR (object_id = ?i AND object_type = 'P')", $profile_data['profile_id']) : '';
	$additional_fields = db_get_hash_single_array("SELECT field_id, value FROM ?:profile_fields_data WHERE (object_id = ?i AND object_type = 'U') $prof_cond", array('field_id', 'value'), $user_id);

	$user_data['fields'] = $additional_fields;

	fn_add_user_data_descriptions($user_data);

	fn_set_hook('get_user_info', $user_data);

	return $user_data;
}

//
// Get user short info
//
function fn_get_user_short_info($user_id)
{
	if (!empty($user_id)) {
		return db_get_row("SELECT user_id, user_login, firstname, lastname, email, user_type FROM ?:users WHERE user_id = ?i", $user_id);
	}

	return false;
}

//
// Get user name
//
function fn_get_user_name($user_id)
{
	if (!empty($user_id)) {
		$user_data = db_get_row("SELECT title, firstname, lastname FROM ?:users WHERE user_id = ?i", $user_id);
		if (!empty($user_data)) {
			$titles = fn_get_static_data_section('T', false);
			return (!empty($titles[$user_data['title']]['descr']) ? ($titles[$user_data['title']]['descr'] . ' ') : '') . $user_data['firstname'] . ' ' . $user_data['lastname'];
		}
	}

	return false;
}

//
// Get all user profiles
//
function fn_get_user_profiles($user_id)
{
	$profiles = array();
	if (!empty($user_id)) {
		$profiles = db_get_array("SELECT profile_id, profile_type, profile_name FROM ?:user_profiles WHERE user_id = ?i", $user_id);
	}

	return $profiles;
}

//
// Checks if shipping and billing addresses are different
// returns true if different, false - otherwise
function fn_check_shipping_billing($user_data, $profile_fields)
{
	if (empty($user_data)) {
		return false;
	}

	if (!empty($profile_fields['S'])) {
		foreach ($profile_fields['S'] as $v) {
			$id = !empty($v['field_name']) ? $v['field_name'] : $v['field_id'];
			$matching_id = !empty($profile_fields['B'][$v['matching_id']]) ? (!empty($v['field_name']) ? ($profile_fields['B'][$v['matching_id']]['field_name']) : $v['matching_id']) : 0;
			$udata = !empty($v['field_name']) ? $user_data : (!empty($user_data['fields']) ? $user_data['fields'] : array());

			// If field is set in shipping section and disabled in billing, so - different
			if (!empty($udata[$id]) && empty($matching_id)) {
				return true;
			}

			// If field set in both sections and fields are different, so - 
			if (!empty($udata[$id]) && !empty($udata[$matching_id]) && $udata[$id] != $udata[$matching_id]) {
				return true;
			}
		}
	}

	return false;
}

//
// Get all memberships list
//
function fn_get_memberships($type, $lang_code = CART_LANGUAGE)
{
	$where = " a.status = 'A'";

	if ($type == 'C' || AREA == 'C') {
		$where .= " AND type = 'C'";

	} elseif ($type == 'A') {
		$where .= " AND type = 'A'";
	}

	return db_get_hash_array("SELECT a.membership_id, a.status, a.type, b.membership  FROM ?:memberships as a LEFT JOIN ?:membership_descriptions as b ON b.membership_id = a.membership_id AND b.lang_code = ?s WHERE $where ORDER BY membership", 'membership_id', $lang_code);
}

function fn_get_simple_memberships($type, $lang_code = CART_LANGUAGE)
{
	$where = " a.status = 'A'";

	if ($type == 'C' || AREA == 'C') {
		$where .= " AND type = 'C'";

	} elseif ($type == 'A') {
		$where .= " AND type = 'A'";
	}

	return db_get_hash_single_array("SELECT a.membership_id, b.membership FROM ?:memberships as a LEFT JOIN ?:membership_descriptions as b ON b.membership_id = a.membership_id AND b.lang_code = ?s WHERE $where ORDER BY membership", array('membership_id', 'membership'), $lang_code);
}

//
// Get membership description
//
function fn_get_membership_name($id, $lang_code = CART_LANGUAGE)
{
	if (!empty($id)) {
		return db_get_field("SELECT membership FROM ?:membership_descriptions WHERE membership_id = ?i AND lang_code = ?s", $id, $lang_code);
	}

	return false;
}

function fn_add_user_data_descriptions(&$user_data, $lang_code = CART_LANGUAGE)
{
	fn_fill_user_fields($user_data);
	// Replace titles ids with their descriptions
	$_titles = fn_get_static_data_section('T', false);
	$titles = array();
	foreach ($_titles as $val) {
		$titles[$val['param']] = $val;
	}
	if (!empty($user_data['title'])) {
		$user_data['title_descr'] = !empty($titles[$user_data['title']]['descr']) ? $titles[$user_data['title']]['descr'] : $user_data['title'];
	}
	if (!empty($user_data['b_title'])) {
		$user_data['b_title_descr'] = !empty($titles[$user_data['b_title']]['descr']) ? $titles[$user_data['b_title']]['descr'] : $user_data['b_title'];
	}
	if (!empty($user_data['s_title'])) {
		$user_data['s_title_descr'] = !empty($titles[$user_data['s_title']]['descr']) ? $titles[$user_data['s_title']]['descr'] : $user_data['s_title'];
	}

	// Replace country and state values with their descriptions
	if (!empty($user_data['b_country'])) {
		$user_data['b_country_descr'] = fn_get_country_name($user_data['b_country'], $lang_code);
	}
	if (!empty($user_data['s_country'])) {
		$user_data['s_country_descr'] = fn_get_country_name($user_data['s_country'], $lang_code);
	}
	if (!empty($user_data['b_state'])) {
		$user_data['b_state_descr'] = fn_get_state_name($user_data['b_state'], $user_data['b_country'], $lang_code);
		if (empty($user_data['b_state_descr'])) {
			$user_data['b_state_descr'] = $user_data['b_state'];
		}
	}
	if (!empty($user_data['s_state'])) {
		$user_data['s_state_descr'] = fn_get_state_name($user_data['s_state'], $user_data['s_country'], $lang_code);
		if (empty($user_data['s_state_descr'])) {
			$user_data['s_state_descr'] = $user_data['s_state'];
		}
	}
}

function fn_fill_shipping_with_billing(&$user_data, &$profile_fields)
{
	if (!empty($profile_fields['S'])) {
		// Clean shipping data
		foreach ($profile_fields['S'] as $v) {
			if (!empty($v['field_name'])) {
				$user_data[$v['field_name']] = '';
			} else {
				$user_data['fields'][$v['field_id']] = '';
			}
		}

		// Fill shipping data with billing
		foreach ($profile_fields['S'] as $v) {
			if (isset($profile_fields['B'][$v['matching_id']])) {
				if (!empty($v['field_name']) && !empty($user_data[$profile_fields['B'][$v['matching_id']]['field_name']])) {
					$user_data[$v['field_name']] = $user_data[$profile_fields['B'][$v['matching_id']]['field_name']];
				} elseif (!empty($user_data['fields'][$profile_fields['B'][$v['matching_id']]['field_id']])) {
					$user_data['fields'][$v['field_id']] = $user_data['fields'][$profile_fields['B'][$v['matching_id']]['field_id']];
				}
			}
		}
	}
}

function fn_fill_user_fields(&$user_data)
{
	$exclude = array(
		'user_login',
		'password',
		'user_type',
		'status',
		'cart_content',
		'membership_status',
		'membership_id',
		'timestamp',
		'referer',
		'last_login',
		'card_name',
		'card_type',
		'card_expire',
		'card_cvv2',
		'lang_code',
		'user_id',
		'profile_id',
		'profile_type',
		'profile_name',
		'tax_exempt'
	);

	fn_set_hook('fill_user_fields', $exclude);

	$profile_fields = fn_get_table_fields('user_profiles', $exclude);
	$fields = fn_array_merge($profile_fields, fn_get_table_fields('users', $exclude), false);

	// Fill empty fields to avoid php notices
	foreach ($fields as $field) {
		if (empty($user_data[$field])) {
			$user_data[$field] = '';
		}
	}

	if (empty($user_data['b_firstname'])) {
		$user_data['b_firstname'] = $user_data['firstname'];
	}
	if (empty($user_data['b_lastname'])) {
		$user_data['b_lastname'] = $user_data['lastname'];
	}
	if (empty($user_data['b_title'])) {
		$user_data['b_title'] = $user_data['title'];
	}

	if (empty($user_data['s_firstname'])) {
		$user_data['s_firstname'] = empty($user_data['b_firstname']) ? $user_data['firstname'] : $user_data['b_firstname'];
	}
	if (empty($user_data['s_lastname'])) {
		$user_data['s_lastname'] = empty($user_data['b_lastname']) ? $user_data['lastname'] : $user_data['b_lastname'];
	}
	if (empty($user_data['s_title'])) {
		$user_data['s_title'] = empty($user_data['b_title']) ? $user_data['title'] : $user_data['b_title'];
	}

	// Reformat additional fields
	if (!empty($user_data['fields'])) {
		foreach ($user_data['fields'] as $field_id => $value) {
			if (substr_count($value, '/') == 2) { // FIXME: it's date field
				$user_data['fields'][$field_id] = fn_parse_date($value);
			}
		}
	}

	return true;
}


function fn_get_profile_fields($location = 'C', $_auth = array(), $lang_code = CART_LANGUAGE)
{
	$auth = & $_SESSION['auth'];

	if (empty($_auth)) {
		$_auth = $auth;
	}

	$condition = "WHERE 1 ";

	if ($location == 'A' || $location == 'C') {
		$select = ", ?:profile_fields.profile_required as required";
		$condition .= " AND ?:profile_fields.profile_show = 'Y'";
	} else {
		$select = ", ?:profile_fields.checkout_required as required";
		$condition .= " AND ?:profile_fields.checkout_show = 'Y'";
	}

	fn_set_hook('get_profile_fields', $location, $select, $condition);

	// Determine whether to retrieve or not email field
	if ($location != 'I' && (Registry::get('settings.General.use_email_as_login') == 'Y' && (($location == 'O' && (Registry::get('settings.General.disable_anonymous_checkout') == 'Y' && empty($_auth['user_id']))) || (strpos('APC', $location) !== false)))) {
		$condition .= " AND ?:profile_fields.field_type != 'E'";
	}

	$profile_fields = db_get_hash_multi_array("SELECT ?:profile_fields.section, ?:profile_fields.field_type, ?:profile_fields.field_id, ?:profile_fields.field_name, ?:profile_fields.matching_id, ?:profile_field_descriptions.description, ?:profile_fields.field_type $select FROM ?:profile_fields LEFT JOIN ?:profile_field_descriptions ON ?:profile_field_descriptions.object_id = ?:profile_fields.field_id AND ?:profile_field_descriptions.object_type = 'F' AND lang_code = ?s $condition ORDER BY ?:profile_fields.position", array('section', 'field_id'), $lang_code);

	$matches = array();

	// Collect matching IDs
	if (!empty($profile_fields['S'])) {
		foreach ($profile_fields['S'] as $v) {
			$matches[$v['matching_id']] = $v['field_id'];
		}
	}

	foreach ($profile_fields as $section => $fields) {
		foreach ($fields as $k => $v) {
			if ($v['field_type'] == 'S' || $v['field_type'] == 'R') {

				$_id = $v['field_id'];
				if ($section == 'B' && empty($v['field_name'])) {
					// If this field is enabled in billing section
					if (!empty($matches[$v['field_id']])) {
						$_id = $matches[$v['field_id']];
					// Otherwise, get it from database
					} else {
						$_id = db_get_field("SELECT field_id FROM ?:profile_fields WHERE matching_id = ?i", $v['field_id']);
					}

				}

				$profile_fields[$section][$k]['values'] = db_get_hash_single_array("SELECT ?:profile_field_values.value_id, ?:profile_field_descriptions.description FROM ?:profile_field_values LEFT JOIN ?:profile_field_descriptions ON ?:profile_field_descriptions.object_id = ?:profile_field_values.value_id AND ?:profile_field_descriptions.object_type = 'V' AND ?:profile_field_descriptions.lang_code = ?s WHERE ?:profile_field_values.field_id = ?i ORDER BY ?:profile_field_values.position", array('value_id', 'description'), $lang_code, $_id);
			}
		}
	}

	return $profile_fields;
}

function fn_store_profile_fields($user_data, $object_id, $object_type)
{
	// Delete existing fields
	if ($object_type == 'UP') {
		db_query("DELETE FROM ?:profile_fields_data WHERE (object_id = ?i AND object_type = ?s) OR (object_id = ?i AND object_type = ?s)", $object_id['U'], 'U', $object_id['P'], 'P');
	} else {
		db_query("DELETE FROM ?:profile_fields_data WHERE object_id = ?i AND object_type = ?s", $object_id, $object_type);
	}

	if (!empty($user_data['fields'])) {
		$field_object_types = db_get_hash_single_array("SELECT field_id, section FROM ?:profile_fields WHERE field_id IN (?n)", array('field_id', 'section'), array_keys($user_data['fields']));

		$_data = array ();
		foreach ($user_data['fields'] as $field_id => $value) {
			if ($object_type == 'UP') {
				$_data['object_type'] = ($field_object_types[$field_id] == 'C') ? 'U' : 'P';
				$_data['object_id'] = ($field_object_types[$field_id] == 'C') ? $object_id['U'] : $object_id['P'];
			} else {
				$_data['object_type'] = $object_type;
				$_data['object_id'] = $object_id;
			}
			$_data['field_id'] = $field_id;
			$_data['value'] = (substr_count($value, '/') == 2) ? fn_parse_date($value) : $value; // FIXME

			db_query("REPLACE INTO ?:profile_fields_data ?e", $_data);
		}
	}

	return true;
}

//
// Fill auth array
//
function fn_fill_auth($user_data = array(), $order_ids = array() , $act_as_user = false)
{

	// Get membership info
	if (!empty($user_data['membership_id'])) {
		$user_data['membership_id'] = db_get_field("SELECT membership_id FROM ?:memberships WHERE membership_id = ?i AND status = 'A'", $user_data['membership_id']);
	}

	$_auth = array (
		// [test edition]
		'area' => (empty($user_data['user_type']) || $user_data['user_type'] != 'A') ? 'C' : $user_data['user_type'],
		// [/test edition]
		'user_id' => empty($user_data['user_id']) ? 0 : $user_data['user_id'],
		'tax_exempt' => empty($user_data['tax_exempt']) ? 'N' : $user_data['tax_exempt'],
		'last_login' => empty($user_data['last_login']) ? 0 : $user_data['last_login'],
		'membership_id' => empty($user_data['membership_status']) ? 0 : (($user_data['membership_status'] == 'P') ? 0 : intval($user_data['membership_id'])),
		'order_ids' => $order_ids,
		'act_as_user' => $act_as_user,
		'this_login' => TIME
	);

	fn_set_hook('fill_auth', $_auth, $user_data);

	return $_auth;
}

//
// The function saves information into user_data table.
//
function fn_save_user_additional_data($type, $data, $user_id = 0)
{
	$auth = & $_SESSION['auth'];

	if (AREA != 'A') {
		$user_id = 0;
	}
	if (empty($user_id) && !empty($auth['user_id'])) {
		$user_id = $auth['user_id'];
	}
	if (empty($user_id)) {
		return false;
	}

	return db_query('REPLACE INTO ?:user_data ?e', array('user_id' => $user_id, 'type' => $type, 'data' => serialize($data)));
}

//
// The function returns information from user_data table.
//
function fn_get_user_additional_data($type, $user_id = 0)
{
	$auth = & $_SESSION['auth'];

	if (AREA != 'A') {
		$user_id = 0;
	}
	if (empty($user_id) && !empty($auth['user_id'])) {
		$user_id = $auth['user_id'];
	}
	if (empty($user_id)) {
		return false;
	}
	$data = db_get_field("SELECT data FROM ?:user_data WHERE user_id = ?i AND type = ?s", $user_id, $type);
	if (!empty($data)) {
		$data = unserialize($data);
	}
	return $data;
}

//
// The function returns description of user type.
//
function fn_get_user_type_description($type, $plural = false, $lang_code = CART_LANGUAGE)
{
	$type_descr = array(
		'S' => array(
			'C' => 'customer',
			'A' => 'administrator'
		),
		'P' => array(
			'C' => 'customers',
			'A' => 'administrators'
		),
	);

	fn_set_hook('get_user_type_description', $type_descr);

	$s = ($plural = true) ? 'P' : 'S';

	return fn_get_lang_var($type_descr[$s][$type], $lang_code);
}

function fn_get_users($params, &$auth, $items_per_page = 0, $custom_view = '')
{
	// Init filter
	$_view = !empty($custom_view) ? $custom_view : 'users';
	$params = fn_init_view($_view, $params);

	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page'];

	// Define fields that should be retrieved
	$fields = array (
		"?:users.user_id",
		"?:users.user_login",
		"?:users.timestamp",
		"?:users.user_type",
		"?:users.status",
		"?:users.firstname",
		"?:users.lastname",
		"?:users.email",
		"?:users.company",
	);

	// Define sort fields
	$sortings = array (
		'id' => "?:users.user_id",
		'username' => "?:users.user_login",
		'email' => "?:users.email",
		'name' => array("?:users.firstname", "?:users.lastname"),
		'date' => "?:users.timestamp",
		'type' => "?:users.user_type",
		'status' => "?:users.status",
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	$condition = $join = $group = '';

	$group .= " GROUP BY ?:users.user_id";

	if (!empty($params['company'])) {
		$condition .= db_quote(" AND ?:users.company LIKE ?l", "%$params[company]%");
	}

	if (!empty($params['name'])) {
		// Check if first and last names are entered
		$arr = explode(' ', $params['name']);
		if (sizeof($arr) == 2) {
			$condition .= db_quote(" AND (?:users.firstname LIKE ?l AND ?:users.lastname LIKE ?l)", "%$arr[0]%", "%$arr[1]%");
		} else {
			$condition .= db_quote(" AND (?:users.firstname LIKE ?l OR ?:users.lastname LIKE ?l)", "%$params[name]%", "%$params[name]%");
		}
	}

	if (!empty($params['user_login'])) {
		$condition .= db_quote(" AND ?:users.user_login LIKE ?l", "%$params[user_login]%");
	}

	if (!empty($params['tax_exempt'])) {
		$condition .= db_quote(" AND ?:users.tax_exempt = ?s", $params['tax_exempt']);
	}

	if (isset($params['membership_id']) && $params['membership_id'] != ALL_MEMBERSHIPS) {
		$condition .= db_quote(" AND ?:users.membership_id = ?i", $params['membership_id']);
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(" AND ?:users.status = ?s", $params['status']);
	}

	if (!empty($params['email'])) {
		$condition .= db_quote(" AND ?:users.email LIKE ?l", "%$params[email]%");
	}

	if (!empty($params['address'])) {
		$condition .= db_quote(" AND (?:user_profiles.b_address LIKE ?l OR ?:user_profiles.s_address LIKE ?l)", "%$params[address]%", "%$params[address]%");
	}

	if (!empty($params['zipcode'])) {
		$condition .= db_quote(" AND (?:user_profiles.b_zipcode LIKE ?l OR ?:user_profiles.s_zipcode LIKE ?l)", "%$params[zipcode]%", "%$params[zipcode]%");
	}

	if (!empty($params['country'])) {
		$condition .= db_quote(" AND (?:user_profiles.b_country LIKE ?l OR ?:user_profiles.s_country LIKE ?l)", "%$params[country]%", "%$params[country]%");
	}

	if (!empty($params['state'])) {
		$condition .= db_quote(" AND (?:user_profiles.b_state LIKE ?l OR ?:user_profiles.s_state LIKE ?l)", "%$params[state]%", "%$params[state]%");
	}

	if (!empty($params['city'])) {
		$condition .= db_quote(" AND (?:user_profiles.b_city LIKE ?l OR ?:user_profiles.s_city LIKE ?l)", "%$params[city]%", "%$params[city]%");
	}

	if (!empty($params['user_type'])) {
		$condition .= db_quote(' AND ?:users.user_type = ?s', $params['user_type']);
	}

	if (!empty($params['user_id'])){
		$condition .= db_quote(' AND ?:users.user_id IN (?n)', $params['user_id']);
	}

	if (!empty($params['exclude_user_types'])) {
		$condition .= db_quote(" AND ?:users.user_type NOT IN (?a)", $params['exclude_user_types']);
	}

	if (!empty($params['p_ids']) || !empty($params['product_view_id'])) {
		$arr = (strpos($params['p_ids'], ',') !== false || !is_array($params['p_ids'])) ? explode(',', $params['p_ids']) : $params['p_ids'];
		if (empty($params['product_view_id'])) {
			$condition .= db_quote(" AND ?:order_details.product_id IN (?n)", $arr);
		} else {
			$condition .= db_quote(" AND ?:order_details.product_id IN (?p)", fn_get_products(array('view_id' => $params['product_view_id'], 'get_query' => true)));
		}

		$join .= db_quote(" LEFT JOIN ?:orders ON ?:orders.user_id = ?:users.user_id LEFT JOIN ?:order_details ON ?:order_details.order_id = ?:orders.order_id");
		$group .= db_quote(" HAVING COUNT(?:orders.order_id) >= ?i", count($arr));
	}

	if (defined('RESTRICTED_ADMIN')) { // FIXME: NOT GOOD
		$condition .= db_quote(" AND (?:users.user_type != 'A' || (?:users.user_type = 'A' AND ?:users.user_id = ?i))", $auth['user_id']);
	}

	$join .= db_quote(" LEFT JOIN ?:user_profiles ON ?:user_profiles.user_id = ?:users.user_id");

	fn_set_hook('get_users', $params, $fields, $sortings, $condition, $join);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'asc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'name';
	}

	$sorting = (is_array($sortings[$params['sort_by']]) ? implode(' ' . $directions[$params['sort_order']]. ', ', $sortings[$params['sort_by']]) : $sortings[$params['sort_by']]). " " .$directions[$params['sort_order']];

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	// Paginate search results
	$limit = '';
	if (!empty($items_per_page)) {
		$total = db_get_field("SELECT COUNT(DISTINCT(?:users.user_id)) FROM ?:users $join WHERE 1 $condition");
		$limit = fn_paginate($params['page'], $total, $items_per_page);
	}

	$users = db_get_array("SELECT " . implode(', ', $fields) . " FROM ?:users $join WHERE 1 $condition $group ORDER BY $sorting $limit");

	return array($users, $params);
}

function fn_get_user_edp($user_id, $order_id = 0, $page = 1)
{
	$fields = array (
		'?:order_details.product_id',
		'?:order_details.order_id',
		'?:order_details.extra',
		'?:orders.status',
		'?:products.unlimited_download',
		'?:product_descriptions.product'
	);

	$where = $limit = '';
	if (!empty($order_id)) {
		if (is_array($order_id)) {
			$where = db_quote("AND ?:orders.order_id IN (?n)", $order_id);
		} else {
			$where = db_quote("AND ?:orders.order_id = ?i", $order_id);
		}
	} else {
		$_total = db_get_fields("SELECT COUNT(*) FROM ?:order_details INNER JOIN ?:orders ON ?:orders.order_id = ?:order_details.order_id INNER JOIN ?:product_files ON ?:product_files.product_id = ?:order_details.product_id WHERE ?:orders.user_id = ?i AND ?:product_files.status = 'A' GROUP BY ?:order_details.product_id, ?:order_details.order_id", $user_id);
		$total = count($_total);

		$limit = fn_paginate($page, $total, Registry::get('settings.Appearance.elements_per_page'));
	}
	$products = db_get_array("SELECT " . implode(', ', $fields) . "	FROM ?:order_details INNER JOIN ?:product_files ON ?:product_files.product_id = ?:order_details.product_id INNER JOIN ?:orders ON ?:orders.order_id = ?:order_details.order_id LEFT JOIN ?:products ON ?:products.product_id = ?:order_details.product_id LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:order_details.product_id AND ?:product_descriptions.lang_code = ?s WHERE ?:orders.user_id = ?i AND ?:product_files.status = 'A' $where GROUP BY ?:order_details.order_id, ?:order_details.product_id ORDER BY ?:orders.order_id DESC $limit", CART_LANGUAGE, $user_id);

	if (!empty($products)) {
		foreach($products as $k => $v) {
			$products[$k]['files'] = fn_get_product_files($v['product_id'], false, $v['order_id']);
		}
	}

	return $products;
}

function fn_is_restricted_admin($params)
{
	if (!defined('RESTRICTED_ADMIN')) {
		return false;
	}

	$auth = & $_SESSION['auth'];

	if (!empty($params['user_id']) && $params['user_id'] != $auth['user_id']) {
		$requested_utype = db_get_field("SELECT user_type FROM ?:users WHERE user_id = ?i", $params['user_id']);
		if ($requested_utype == 'A') {
			return true;
		}
	}

	return false;
}

/**
 * This function initializes the session data of a selected user (cart, wishlist etc...)
 *
 * @param array $sess_data
 * @param int $user_id
 * @return true
 */

function fn_init_user_session_data(&$sess_data, $user_id)
{
	// Restore cart content
	$sess_data['cart'] = empty($sess_data['cart']) ? array() : $sess_data['cart'];

	// Cleanup cached shipping rates
	unset($sess_data['shipping_rates']);

	fn_extract_cart_content($sess_data['cart'], $user_id, 'C');
	$sess_data['cart']['user_data'] = fn_get_user_info($user_id);

	fn_set_hook('init_user_session_data', $sess_data, $user_id);

	return true;
}

/**
 * Add/update user
 *
 * @param int $user_id - user ID to update (empty for new user)
 * @param array $user_data - user data
 * @param array $auth - authentication information
 * @param bool $ship_to_another - flag indicates that shipping and billing fields are different
 * @param bool $notify_customer - flag indicates that customer should be notified
 * @return array with user ID and profile ID if success, false otherwise
 */
function fn_update_user($user_id, $user_data, &$auth, $ship_to_another, $notify_customer)
{
	if (!empty($user_id)) {
		$current_user_data = db_get_row("SELECT user_id, status, membership_status, membership_id, user_type, user_login, lang_code FROM ?:users WHERE user_id = ?i", $user_id);
		$action = 'update';
	} else {
		$current_user_data = array(
			'membership_id' => 0,
			'membership_status' => 'P',
			'status' => (AREA != 'A' && Registry::get('settings.General.approve_user_profiles') == 'Y') ? 'D' : (!empty($user_data['status']) ? $user_data['status'] : 'A'),
			'user_type' => 'C' // FIXME?
		);
		$action = 'add';

		$user_data['lang_code'] = !empty($user_data['lang_code']) ? $user_data['lang_code'] : CART_LANGUAGE;
		$user_data['timestamp'] = TIME;
	}

	// Set the user type
	$user_data['user_type'] = fn_check_user_type($user_data, $current_user_data);

	// Check if this user needs login/password
	if (fn_user_need_login($user_data['user_type'])) {
		// Check if user_login already exists
		$is_exist = db_get_field("SELECT user_id FROM ?:users WHERE (email = ?s ?p) AND user_id != ?i", $user_data['email'], (empty($user_data['user_login']) ? '' : db_quote(" OR user_login = ?s", $user_data['user_login'])), $user_id);
		if ($is_exist) {
			fn_save_post_data();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_user_exists'));
			return false;
		}

		// Check the passwords
		$user_data['password1'] = !empty($user_data['password1']) ? trim($user_data['password1']) : '';
		$user_data['password2'] = !empty($user_data['password1']) ? trim($user_data['password2']) : '';

		if (!empty($user_data['password1']) && !empty($user_data['password2']) && $user_data['password1'] == $user_data['password2']) {
			$user_data['password'] = md5($user_data['password1']);
		} elseif ($user_data['password1'] != $user_data['password2']) {
			fn_save_post_data();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_passwords_dont_match'));

			return false;
		}

		// Set/delete insecure password notification
		if (AREA == 'A' && Registry::get('config.demo_mode') != true && !empty($user_data['user_login'])) {
			if ($user_data['password1'] != $user_data['user_login']) {
				fn_delete_notification('insecure_password');
			} else {
				$msg = fn_get_lang_var('warning_insecure_password');
				$msg = str_replace('[link]',  Registry::get('config.admin_index') . "?dispatch=profiles.update", $msg);
				fn_set_notification('E', fn_get_lang_var('warning'), $msg, true, 'insecure_password');
			}
		}
	}

	$user_data['status'] = (AREA != 'A' || empty($user_data['status'])) ? $current_user_data['status'] : $user_data['status']; // only administrator can change user status
	$user_data['membership_id'] = empty($user_data['membership_id']) ? 0 : $user_data['membership_id'];
	$user_data['membership_status'] = (AREA != 'A' || empty($user_data['membership_status'])) ? $current_user_data['membership_status'] : $user_data['membership_status']; 

	if ($current_user_data['membership_id'] != $user_data['membership_id'] && AREA != 'A') {
		$user_data['membership_status'] = 'P';
		$membership_request = true;

	} elseif ($action == 'update' && $current_user_data['membership_status'] == 'P' && $user_data['membership_status'] === 'A') {
		$membership_activation = true;
	}

	if (!empty($user_id)) {
		db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", $user_data, $user_id);

		fn_log_event('users', 'update', array(
			'user_id' => $user_id
		));
	} else {
		$user_id = db_query("INSERT INTO ?:users ?e" , $user_data);

		fn_log_event('users', 'create', array(
			'user_id' => $user_id
		));
	}

	$user_data['user_id'] = $user_id;

	if (empty($user_data['user_login'])) { // if we're using email as login or user type does not require login, fill login field
		db_query("UPDATE ?:users SET user_login = 'user_?i' WHERE user_id = ?i AND user_login = ''", $user_id, $user_id);
	}

	// Fill shipping info with billing if needed
	if (empty($ship_to_another)) {
		$profile_fields = fn_get_profile_fields($user_data['user_type']);
		fn_fill_shipping_with_billing($user_data, $profile_fields);
	}

	// Add new profile or update existing
	if ((isset($user_data['profile_id']) && empty($user_data['profile_id'])) || $action == 'add') {
		if ($action == 'add') {
			$user_data['profile_type'] = 'P';
			$user_data['profile_name'] = empty($user_data['profile_name']) ? fn_get_lang_var('main') : $user_data['profile_name'];
		} else {
			$user_data['profile_type'] = 'S';
		}

		$user_data['profile_id'] = db_query("INSERT INTO ?:user_profiles ?e", $user_data);
	} else {
		if (empty($user_data['profile_id'])) {
			$user_data['profile_id'] = db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_type = 'P'", $user_id);
		}
		db_query("UPDATE ?:user_profiles SET ?u WHERE profile_id = ?i", $user_data, $user_data['profile_id']);
	}

	// Add/Update additional fields
	fn_store_profile_fields($user_data, array('U' => $user_id, 'P' => $user_data['profile_id']), 'UP');

	$user_data = fn_get_user_info($user_id, true, $user_data['profile_id']);
	$lang_code = (AREA == 'A' && $user_id != 1) ? $user_data['lang_code'] : CART_LANGUAGE;

	Registry::get('view_mail')->assign('user_data', $user_data);
	Registry::get('view_mail')->assign('memberships', fn_get_memberships('F', $lang_code));

	// Notify administrator about membership request
	if (!empty($membership_request) && !empty($user_data['membership_id'])) {
		fn_send_mail(Registry::get('settings.Company.company_users_department'), Registry::get('settings.Company.company_users_department'), 'profiles/membership_request_subj.tpl', 'profiles/membership_request.tpl', '', Registry::get('settings.Appearance.admin_default_language'), $user_data['email']);
	}

	// Send notifications to customer
	if (!empty($notify_customer)) {

		// Notify customer about membership activation
		if (!empty($membership_activation)) {
			fn_send_mail($user_data['email'], Registry::get('settings.Company.company_users_department'), 'profiles/membership_activation_subj.tpl', 'profiles/membership_activation.tpl', '', $lang_code);
		}

		// Notify customer about profile activation (when update profile only)
		if ($action == 'update' && $current_user_data['status'] === 'D' && $user_data['status'] === 'A') {
			fn_send_mail($user_data['email'], Registry::get('settings.Company.company_users_department'), 'profiles/profile_activated_subj.tpl', 'profiles/profile_activated.tpl', '', $lang_code);
		}

		// Notify customer about profile add/update
		if ($action == 'add') {
			fn_send_mail($user_data['email'], Registry::get('settings.Company.company_users_department'), 'profiles/create_profile_subj.tpl', 'profiles/create_profile.tpl', '', $lang_code);
		} else {
			fn_send_mail($user_data['email'], Registry::get('settings.Company.company_users_department'), 'profiles/update_profile_subj.tpl', 'profiles/update_profile.tpl', '', $lang_code);
		}
	}

	if ($action == 'add') {

		$skip_auth = false;
		if (AREA != 'A') {
			if (Registry::get('settings.General.approve_user_profiles') == 'Y') {
				fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_profile_should_be_approved'));
				
				// Notify administrator about new profile
				fn_send_mail(Registry::get('settings.Company.company_users_department'), Registry::get('settings.Company.company_users_department'), 'profiles/activate_profile_subj.tpl', 'profiles/activate_profile.tpl', '', Registry::get('settings.Appearance.admin_default_language'), $user_data['email']);

				$skip_auth = true;
			} else {
				fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_profile_is_created'));
			}
		} else {
			fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_profile_is_created'));
		}

		
		if (!is_null($auth)) {
			if (!empty($auth['order_ids'])) {
				db_query("UPDATE ?:orders SET user_id = ?i WHERE order_id IN (?n)", $user_id, $auth['order_ids']);
			}

			if (empty($skip_auth)) {
				$auth = fn_fill_auth($user_data);
			}
		}
	} else {
		fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_profile_is_updated'));
	}

	fn_set_hook('update_profile', $action, $user_data, $current_user_data);

	return array($user_id, $user_data['profile_id']);
}

/**
 * Check if specified account needs login
 *
 * @param char $user_type - user account type
 * @return bool true if needs login, false otherwise
 */
function fn_user_need_login($user_type)
{
	$types = array(
		'A',
		'C'
	);

	fn_set_hook('user_need_login', $types);

	return in_array($user_type, $types);
}

/**
 * Check compatible user types
 *
 * @param array $user_data - new user data
 * @param array $current_user_data - current user data
 * @return char user type
 */
function fn_check_user_type($user_data, $current_user_data)
{
	$compatible_types = array();

	$current_u_type = $current_user_data['user_type'];
	$u_type = !empty($user_data['user_type']) ? $user_data['user_type'] : $current_user_data['user_type'];

	if (AREA == 'A' || $u_type == $current_u_type) {
		return $u_type;
	}

	fn_set_hook('check_user_type', $compatible_types);

	return !empty($compatible_types[$current_u_type]) && in_array($u_type, $compatible_types[$current_u_type]) ? $u_type : $current_u_type;
}

?>
