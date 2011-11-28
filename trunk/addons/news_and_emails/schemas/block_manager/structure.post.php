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
// $Id: structure.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$schema['news'] = array (
	'fillings' => array (
		'manually',
		'newest' => array (
			'params' => array (
				'sort_by' => 'timestamp'
			)
		),
		'news_plain'
	),
	'appearances' => array (
		'addons/news_and_emails/blocks/news_text_links.tpl' => array (
			'conditions' => array (
				'fillings' => array ('manually', 'newest')
			)
		),
		'addons/news_and_emails/blocks/news.tpl' => array (
			'conditions' => array (
				'fillings' => array ('news_plain')
			)
		)
	),
	'positions' => array (
		'left',
		'right',
		'central',
		'top',
		'bottom',
		'product_details' => array (
			'conditions' => array (
				'locations' => array ('products')
			)
		)
	),
	'object_id' => 'news_id',
	'object_name' => 'news',
	'picker_props' => array (
		'picker' => 'addons/news_and_emails/pickers/news_picker.tpl',
		'params' => array (
		),
	),
);

?>