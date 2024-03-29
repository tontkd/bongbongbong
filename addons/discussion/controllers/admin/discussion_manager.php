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
// $Id: discussion_manager.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'manage') {
	$discussion_object_types = fn_get_discussion_objects();
	if (empty($_REQUEST['object_type'])) {
		reset($discussion_object_types);
		$_REQUEST['object_type'] = key($discussion_object_types); // FIXME: bad style
	}

	$_url = fn_query_remove(Registry::get('config.current_url'), 'object_type');
	foreach ($discussion_object_types as $obj_type => $obj) {
		$_name = ($obj_type != 'E') ? fn_get_lang_var($obj) . ' ' . strtolower(fn_get_lang_var('discussion_title_' . $obj)) : fn_get_lang_var('discussion_title_' . $obj); // FIXME!!! Bad style

		Registry::set('navigation.tabs.' . $obj, array (
			'title' => $_name,
			'href' => $_url . '&object_type=' . $obj_type,
			'ajax' => true
		));

	}

	list($posts, $search) = fn_get_discussions($_REQUEST);

	if (!empty($posts)) {
		foreach ($posts as $k => $v) {
			$posts[$k]['object_data'] = fn_get_discussion_object_data($v['object_id'], $v['object_type'], DESCR_SL);
		}
	}

	$view->assign('posts', $posts);
	$view->assign('search', $search);

	if ($_REQUEST['object_type'] == 'E') { // FIXME!!! Bad style, must be reworked

		$is_enabled = db_get_field("SELECT type FROM ?:discussion WHERE object_id = '0' AND object_type = 'E'");
		if (empty($is_enabled) || $is_enabled == 'D') {
			$view->assign('object_notice', fn_get_lang_var('text_enabled_testimonials_notice'));
		} else {
			$view->assign('but_text', fn_get_lang_var('add_new'));
			$view->assign('but_href', "$index_script?dispatch=site_layout.manage&selected_section=discussion#add_new_post");
			$view->assign('but_role', "text");
			$view->assign('object_notice', $view->display('buttons/button.tpl', false));
		}

	}

	$view->assign('object_type', $_REQUEST['object_type']);
	$view->assign('discussion_object_types', $discussion_object_types);
}


function fn_get_discussions($params)
{
	// Init filter
	$params = fn_init_view('discussion', $params);

	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page'];

	// Define fields that should be retrieved
	$fields = array (
		'?:discussion_posts.*',
		'?:discussion_messages.message',
		'?:discussion_rating.rating_value',
		'?:discussion.*'
	);

	// Define sort fields
	$sortings = array (
		'object' => "?:discussion.object_type",
		'name' => "?:discussion_posts.name",
		'ip_address' => "?:discussion_posts.ip_address",
		'timestamp' => "?:discussion_posts.timestamp",
		'status' => "?:discussion_posts.status",
		'date' => "?:orders.timestamp",
		'total' => "?:orders.total",
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'desc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'timestamp';
	}

	$sort = $sortings[$params['sort_by']]. " " .$directions[$params['sort_order']];

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	$condition = $join = '';

	if (!empty($params['name'])) {
		$condition .= db_quote(" AND ?:discussion_posts.name LIKE ?l", "%$params[name]%");
	}

	if (!empty($params['message'])) {
		$condition .= db_quote(" AND ?:discussion_messages.message LIKE ?l", "%$params[message]%");
	}

	if (!empty($params['type'])) {
		$condition .= db_quote(" AND ?:discussion.type = ?s", $params['type']);
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(" AND ?:discussion_posts.status = ?s", $params['status']);
	}

	if (!empty($params['post_id'])) {
		$condition .= db_quote(" AND ?:discussion_posts.post_id = ?i", $params['post_id']);
	}

	if (!empty($params['ip_address'])) {
		$condition .= db_quote(" AND ?:discussion_posts.ip_address = ?s", $params['ip_address']);
	}

	if (!empty($params['rating_value'])) {
		$condition .= db_quote(" AND ?:discussion_rating.rating_value = ?i", $params['rating_value']);
	}

	if (!empty($params['object_type'])) {
		$condition .= db_quote(" AND ?:discussion.object_type = ?s", $params['object_type']);
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);
		$condition .= db_quote(" AND (?:discussion_posts.timestamp >= ?i AND ?:discussion_posts.timestamp <= ?i)", $params['time_from'], $params['time_to']);
	}

	$join .= " INNER JOIN ?:discussion ON ?:discussion.thread_id = ?:discussion_posts.thread_id";
	$join .= " INNER JOIN ?:discussion_messages ON ?:discussion_messages.post_id = ?:discussion_posts.post_id";
	$join .= " INNER JOIN ?:discussion_rating ON ?:discussion_rating.post_id = ?:discussion_posts.post_id";

	$total = db_get_field("SELECT COUNT(*) FROM ?:discussion_posts $join WHERE 1 $condition");
	$limit = fn_paginate($params['page'], $total, Registry::get('settings.Appearance.admin_elements_per_page'));

	$posts = db_get_array("SELECT " . implode(',', $fields) . " FROM ?:discussion_posts $join WHERE 1 $condition ORDER BY $sort $limit");

	return array($posts, $params);
}

?>
