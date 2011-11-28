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

$schema['#export_fields']['Supplier'] = array (
	'#process_get' => array ('fn_exim_get_supplier', '#key'),
	'#process_put' => array ('fn_exim_set_supplier', '#key', '#this'),
	'#linked' => false, // this field is not linked during import-export
);

//
// Get supplier company name
//
function fn_exim_get_supplier($product_id)
{
	return db_get_field("SELECT u.company FROM ?:products as p LEFT JOIN ?:users as u ON p.supplier_id = u.user_id WHERE p.product_id = ?i", $product_id);
}

//
// Set product supplier (create supplier is it doesn't exist)
//
function fn_exim_set_supplier($product_id, $supplier)
{
	$u_id = db_get_field("SELECT user_id FROM ?:users WHERE company = ?s AND user_type = 'S'", $supplier);
	if (empty($u_id)) {
		$data = array (
			'active' => 'Y',
			'user_type' => 'S',
			'timestamp' => TIME,
			'company' => $supplier,
			'email' => 'none@none.none',
		);

		$u_id = db_query("INSERT INTO ?:users ?e", $data);

		$data = array (
			'user_id' => $u_id,
			'profile_type' => 'P',
			'profile_name' => 'Main',
			's_country' => Registry::get('settings.General.default_country'),
			's_state' => Registry::get('settings.General.default_state'),
			's_city' => Registry::get('settings.General.default_city'),
			's_zipcode' => Registry::get('settings.General.default_zipcode'),
			's_address' => Registry::get('settings.General.default_address'),
		);

		db_query("INSERT INTO ?:user_profiles ?e", $data);
	}

	db_query("UPDATE ?:products SET supplier_id = ?i WHERE product_id = ?i", $u_id, $product_id);
	return true;
}

?>