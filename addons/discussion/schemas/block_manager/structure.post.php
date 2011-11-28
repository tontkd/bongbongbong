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

$schema['products']['fillings']['rating'] = array (
	'params' => array (
		'rating' => true,
		'sort_by' => 'rating'
	)
);
$schema['categories']['fillings']['rating'] = array (
	'params' => array (
		'rating' => true,
		'sort_by' => 'rating'
	)
);
$schema['pages']['fillings']['rating'] = array (
	'params' => array (
		'rating' => true,
		'sort_by' => 'rating'
	)
);
$schema['categories']['positions']['central']['conditions']['fillings'][] = 'rating';
$schema['categories']['appearances']['blocks/categories_text_links.tpl']['conditions']['fillings'][] = 'rating';

$schema['pages']['appearances']['blocks/pages_text_links.tpl']['conditions']['fillings'][] = 'rating';

?>