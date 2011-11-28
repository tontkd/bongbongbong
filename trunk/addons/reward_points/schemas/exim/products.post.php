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
// $Id: products.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Schema definition
//

$schema['#export_fields']['Pay by points'] = array (
	'#db_field' => 'is_pbp',
);

$schema['#export_fields']['Override points'] = array (
	'#db_field' => 'is_op',
);

$schema['#export_fields']['Override exchange rate'] = array (
	'#db_field' => 'is_oper',
);

?>