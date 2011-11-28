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
// $Id: product_images.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Additional product images schema
//
$schema = array (
	'#section' => 'products',
	'#name' => fn_get_lang_var('images'),
	'#pattern_id' => 'product_images',
	'#key' => array('product_id'),
	'#table' => 'products',
	'#references' => array (
		'images_links' => array (
			'#reference_fields' => array('object_id' => '#key', 'object_type' => 'product'),
			'#join_type' => 'LEFT'
		),
	),
	'#update_only' => true,
	'#range_options' => array (
		'#selector_url' => INDEX_SCRIPT . '?dispatch=products.manage',
		'#object_name' => fn_get_lang_var('products'),
	),
	'#notes' => array (
		'text_exim_import_images_note',
	),
	'#options' => array (
		'images_path' => array (
			'title' => 'images_directory',
			'description' => 'text_images_directory',
			'type' => 'input',
			'default_value' => DIR_IMAGES . 'backup'
		),
	),
	'#export_fields' => array (
		'Product code' => array (
			'#required' => true,
			'#alt_key' => true,
			'#db_field' => 'product_code'
		),
		'Pair type' => array (
			'#db_field' => 'type',
			'#table' => 'images_links',
			'#required' => true
		),
		'Thumbnail' => array (
			'#process_get' => array ('fn_export_image', '#this', 'product', '@images_path'),
			'#table' => 'images_links',
			'#db_field' => 'image_id',
			'#use_put_from' => '%Detailed image%'
		),
		'Detailed image' => array (
			'#process_get' => array ('fn_export_image', '#this', 'detailed', '@images_path'),
			'#db_field' => 'detailed_id',
			'#table' => 'images_links',
			'#process_put' => array('fn_import_images', '@images_path', '%Thumbnail%', '#this', '%Pair type%', '#key', 'product')
		),
	),
);

?>