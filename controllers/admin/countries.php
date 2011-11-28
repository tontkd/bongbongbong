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
// $Id: countries.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//
	// Updating existing countries
	//

	if ($mode == 'update') {

		foreach ($_REQUEST['country_description'] as $key => $value) {
			if (!empty($value['country'])) {
				if (!empty($_REQUEST['country_data'][$key])) {
					$_data = fn_check_table_fields($_REQUEST['country_data'][$key], 'countries');
					db_query("UPDATE ?:countries SET ?u WHERE code = ?s", $_data, $key);
				}
				unset($_data);
				$_data = fn_check_table_fields($value, 'country_descriptions');
				db_query("UPDATE ?:country_descriptions SET ?u WHERE code = ?s AND lang_code = ?s", $_data, $key, DESCR_SL);
			}
		}
	}

	//
	// Delete selected countries
	//
	if ($mode == 'delete') {

		if (is_array($_REQUEST['delete'])) {
			foreach ($_REQUEST['delete'] as $k => $v) {
				db_query("DELETE FROM ?:countries WHERE code = ?s", $k);
				db_query("DELETE FROM ?:country_descriptions WHERE code = ?s", $k);
			}
		}
	}

	//
	// Adding new countries
	//
	if ($mode == 'add') {
		foreach ($_REQUEST['country_data_add'] as $key => $value) {
			if (!empty($value['code']) && !empty($_REQUEST['country_description_add'][$key]['country'])) {
				if (db_get_field("SELECT COUNT(*) FROM ?:countries WHERE code = ?s", $value['code'])) {
					continue;
				}

				$_data = fn_check_table_fields($value, 'countries');
				db_query('INSERT INTO ?:countries ?e', $_data);
				unset($_data);
				$_data = fn_check_table_fields($_REQUEST['country_description_add'][$key], 'country_descriptions');
				$_data['code'] = $value['code'];

				foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
					db_query("INSERT INTO ?:country_descriptions ?e", $_data);
				}
			}
		}

	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=countries.manage");
}

$view->assign('countries', fn_get_countries(DESCR_SL, false, true));

/** /Body **/

?>
