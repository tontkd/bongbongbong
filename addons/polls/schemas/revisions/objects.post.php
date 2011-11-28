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
// $Id: objects.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Add new tables
//
$schema['pages']['database']['polls'] = array (
	'keys' => array ('page_id'),
	'parent' => array (
		'table' => 'pages',
		'key' => 'page_id'
	),
	'children' => array (),
	'is_auto' => false,
);

$schema['pages']['database']['poll_descriptions'] = array(
	'keys' => array ('object_id', 'type', 'lang_code'),
	'parent' => array (
		'table' => 'pages',
		'key' => 'page_id',
	),
	'children' => array (),
	'is_auto' => false,
);

$schema['pages']['database']['poll_items'] = array(
	'keys' => array ('item_id'),
	'parent' => array (
		'table' => 'pages',
		'key' => 'page_id',
	),
	'children' => array (),
	'is_auto' => true,
	'auto_key' => 'item_id'
);

//
// Extend children
//
$schema['pages']['database']['pages']['children'][] = array(
	'table' => 'polls',
	'key' => 'page_id'
);

$schema['pages']['database']['pages']['children'][] = array(
	'table' => 'poll_descriptions',
	'key' => 'page_id',
);

$schema['pages']['database']['pages']['children'][] = array(
	'table' => 'poll_items',
	'key' => 'page_id',
);

?>