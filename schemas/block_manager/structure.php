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
// $Id: structure.php 7780 2009-08-04 08:59:41Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$schema = array (
	'products' => array (
		'fillings' => array (
			'manually',
			'newest' => array (
				'params' => array (
					'sort_by' => 'timestamp',
					'sort_order' => 'desc',
					'request' => array (
						'cid' => '%CATEGORY_ID%'
					)
				)
			),
			'recent_products' => array (
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
				'params' => array (
					'type' => 'extended',
					'session' => array (
						'pid' => '%RECENTLY_VIEWED_PRODUCTS%'
					),
					'request' => array (
						'exclude_pid' => '%PRODUCT_ID%'
					),
					'force_get_by_ids' => true,
				)
			),
			'popularity' => array (
				'params' => array (
					'popularity_from' => 1,
					'sort_by' => 'popularity',
					'sort_order' => 'desc',
					'type' => 'extended',
					'request' => array (
						'cid' => '%CATEGORY_ID'
					)
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
				'name' => 'product_details_page',
				'conditions' => array (
					'locations' => array('products')
				)
			)
		),
		'appearances' => array (
			'blocks/products_text_links.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right', 'top', 'bottom')
				)
			),
			'blocks/products_links_thumb.tpl' => array (
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
				'params' => array (
					'type' => 'extended'
				),
				'conditions' => array (
					'positions' => array ('left', 'right', 'top', 'bottom')
				)
			),
			'blocks/products_multicolumns.tpl' => array (
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
				'params' => array (
					'type' => 'extended'
				),
				'conditions' => array (
					'positions' => array ('central', 'product_details', 'top', 'bottom')
				)
			),
			'blocks/products_multicolumns_small.tpl' => array (
				'conditions' => array (
					'positions' => array ('central', 'product_details', 'top', 'bottom')
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
				'params' => array (
					'type' => 'extended'
				),
			),
			'blocks/products.tpl' => array (
				'conditions' => array (
					'positions' => array ('central', 'product_details', 'top', 'bottom')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true
					)
				),
			),
			'blocks/products2.tpl' => array (
				'conditions' => array (
					'positions' => array ('central', 'product_details', 'top', 'bottom')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
			),
			'blocks/products_sidebox_1_item.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right', 'top', 'bottom')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
			),
			'blocks/products_small_items.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right', 'top', 'bottom')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
			),
			'blocks/products_without_image.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right', 'top', 'bottom')
				),
				'params' => array (
					'type' => 'extended'
				),
			),
			'blocks/products_scroller.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
			),
			'blocks/products_scroller2.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
			),
			'blocks/products_scroller3.tpl' => array (
				'conditions' => array (
					'positions' => array ('left', 'right')
				),
				'params' => array (
					'type' => 'extended'
				)
			),
			'blocks/short_list.tpl' => array (
				'conditions' => array (
					'positions' => array ('central', 'product_details', 'top', 'bottom')
				),
				'params' => array (
					'type' => 'extended'
				),
				'data_modifier' => array (
					'fn_gather_additional_product_data' => array (
						'product' => '#this',
						'get_icon' => true,
						'get_detailed' => false,
						'get_options' => false
					)
				),
			),
		),
		'dispatch' => 'products.update',
		'object_id' => 'product_id',
		'object_name' => 'product',
		'picker_props' => array (
			'picker' => 'pickers/products_picker.tpl',
			'params' => array (
				'type' => 'links',
			),
		),
	),
	'categories' => array (
		'fillings' => array (
			'manually' => array (
				'params' => array (
					'simple' => false,
					'group_by_level' => false
				)
			),
			'newest' => array (
				'params' => array (
					'sort_by' => 'timestamp',
					'plain' => true,
					'visible' => true
				)
			),
			'emenu',
			'plain' => array (
				'params' => array (
					'plain' => true
				)
			),
			'dynamic' => array (
				'params' => array (
					'visible' => true,
					'plain' => true,
					'request' => array (
						'current_category_id' => '%CATEGORY_ID%',
					),
					'session' => array(
						'product_category_id' => '%CURRENT_CATEGORY_ID%'
					)
				)
			)
		),
		'positions' => array (
			'left',
			'right',
			'top',
			'bottom',
			'central' => array (
				'conditions' => array (
					'fillings' => array ('manually', 'newest')
				),
			),
			'product_details' => array (
				'conditions' => array (
					'locations' => array('products')
				)
			)
		),
		'appearances' => array (
			'blocks/categories_text_links.tpl' => array (
				'conditions' => array (
					'fillings' => array('manually', 'newest')
				)
			),
			'blocks/categories_emenu.tpl' => array (
				'conditions' => array (
					'fillings' => array('emenu')
				)
			),
			'blocks/categories_dynamic.tpl' => array (
				'conditions' => array (
					'fillings' => array('dynamic')
				)
			),
			'blocks/categories_plain.tpl' => array (
				'conditions' => array (
					'fillings' => array('plain')
				)
			),
			'blocks/categories_multicolumns.tpl' => array (
				'conditions' => array (
					'positions' => array('central', 'product_details')
				),
				'params' => array (
					'get_images' => true
				)
			),
		),
		'dispatch' => 'categories.update',
		'object_id' => 'category_id',
		'object_name' => 'category',
		'picker_props' => array (
			'picker' => 'pickers/categories_picker.tpl',
			'params' => array (
				'multiple' => true,
			),
		),
	),
	'pages' => array (
		'fillings' => array (
			'manually',
			'newest' => array (
				'params' => array (
					'sort_by' => 'timestamp',
					'visible' => true,
					'status' => 'A',

				)
			),
			'dynamic' => array (
				'params' => array (
					'visible' => true,
					'get_tree' => 'plain',
					'status' => 'A',
					'request' => array (
						'current_page_id' => '%PAGE_ID%'
					),
				)
			)
		),
		'positions' => array (
			'left',
			'right',
			'top',
			'bottom',
			'central',
			'product_details' => array (
				'conditions' => array (
					'locations' => array('products')
				)
			)
		),
		'appearances' => array (
			'blocks/pages_text_links.tpl' => array (
				'conditions' => array (
					'fillings' => array ('manually', 'newest')
				),
				'params' => array ('plain' => true)
			),
			'blocks/pages_dynamic.tpl' => array (
				'conditions' => array (
					'fillings' => array ('dynamic')
				)
			)
		),
		'dispatch' => 'pages.update',
		'object_id' => 'page_id',
		'object_name' => 'page',
		'picker_props' => array (
			'picker' => 'pickers/pages_picker.tpl',
			'params' => array (
				'multiple' => true,
			),
		),
	),

	'product_filters' => array (
		'fillings' => array (
			'dynamic' => array (
				'params' => array (
					'check_location' => true,
					'request' => array (
						'dispatch' => '%DISPATCH%',
						'category_id' => '%CATEGORY_ID%',
						'features_hash' => '%FEATURES_HASH%',
						'variant_id' => '%VARIANT_ID%',
						'advanced_filter' => '%advanced_filter%',
					),
					'skip_if_advanced' => true,
				)
			),
			'filters' => array (
				'params' => array (
					'get_all' => true,
					'request' => array(
						'variant_id' => '%VARIANT_ID%',
					),
					'get_custom' => true,
					'skip_other_variants' => true
				),
			)
		),
		'positions' => array (
			'left',
			'right',
			'top',
			'bottom',
			'central',
		),
		'appearances' => array (
			'blocks/product_filters.tpl' => array (
				'conditions' => array (
					'fillings' => array ('dynamic')
				),
			),
			'blocks/product_filters_extended.tpl' => array (
				'conditions' => array (
					'fillings' => array ('filters')
				)
			)
		),
		'dispatch' => 'product_filters.manage', // what for?
		'object_id' => 'filter_id',
		'object_name' => 'product_filter',
		'data_function' => 'fn_get_filters_products_count',
	),
);

?>
