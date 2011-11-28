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

$schema['polls'] = array (
	'fillings' => array (
		'manually',
	),
	'positions' => array (
		'left',
		'right',
		'central',
		'top',
		'bottom',
		'product_details' => array (
			'conditions' => array (
				'locations' => array('products')
			)
		)
	),
	'appearances' => array (
		'addons/polls/blocks/sidebox.tpl' => array (
			'conditions' => array (
				'positions' => array('left', 'right', 'top', 'bottom')
			),
			'params' => array ()
		),
		'addons/polls/blocks/central.tpl' => array (
			'conditions' => array (
				'positions' => array('central', 'product_details')
			)
		)
	),
	'dispatch' => 'pages.update',
	'object_id' => 'page_id',
	'object_name' => 'polls',
	'picker_props' => array (
		'picker' => 'addons/polls/pickers/polls_picker.tpl',
		'params' => array (
			'multiple' => true,
		),
	),
	
);

?>