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
// $Id: memberships.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$suffix = '';
	//
	// Updating memberships
	//
	if ($mode == 'update') {
		foreach ($_REQUEST['membership_data'] as $key => $v) {
			if (!empty($v['membership'])) {
				db_query("UPDATE ?:memberships SET ?u WHERE membership_id = ?i", $v, $key);
				db_query("UPDATE ?:membership_descriptions SET ?u WHERE membership_id = ?i AND lang_code = ?s", $v, $key, DESCR_SL);
			}
		}

		$suffix .= '.manage';
	}

	//
	// Deleting selected memberships
	//
	if ($mode == 'delete') {
		if (!empty($_REQUEST['membership_ids'])) {
			fn_delete_memberships($_REQUEST['membership_ids']);
		}

		$suffix .= '.manage';
	}

	//
	// Adding new memberships
	//
	if ($mode == 'add') {

		foreach ($_REQUEST['add_membership_data'] as $k => $v) {
			if (!empty($v['membership'])) {
				$membership_id = db_query("INSERT INTO ?:memberships ?e", $v);
				$v['membership_id'] = $membership_id;

				foreach ((array)Registry::get('languages') as $v['lang_code'] => $_v) {
					db_query("INSERT INTO ?:membership_descriptions ?e", $v);
				}
			}
		}

		$suffix .= '.manage';
	}

	// Set privileges
	if ($mode == 'assign_privileges') {
		db_query("DELETE FROM ?:membership_privileges WHERE membership_id = ?i", $_REQUEST['membership_id']);
		if (@is_array($_REQUEST['set_privileges'])) {
			$data = array (
				'membership_id' => $_REQUEST['membership_id']
			);
			foreach ($_REQUEST['set_privileges'] as $data['privilege'] => $v) {
				db_query("INSERT INTO ?:membership_privileges ?e", $data);
			}
		}

		$suffix = ".assign_privileges&membership_id=$_REQUEST[membership_id]";
	}

	if ($mode == 'privileges') {
		if ($action == 'add') {
			foreach ($_REQUEST['add_privilege'] as $k => $v) {
				if (empty($v['privilege']) || empty($v['description'])) {
					continue;
				}

				$v['is_default'] = 'N';
				db_query("REPLACE INTO ?:privileges ?e", $v);
				fn_create_description('privilege_descriptions', 'privilege', $v['privilege'], $v);
			}
		}

		if ($action == 'update') {
			foreach ((array)$_REQUEST['section_name'] as $sct => $v) {
				db_query("UPDATE ?:privilege_descriptions SET section = ?s WHERE section = ?s AND lang_code = ?s", $v, $sct, DESCR_SL);
			}

			foreach ((array)$_REQUEST['privilege_descr'] as $pr_id => $v) {
				db_query("UPDATE ?:privilege_descriptions SET description = ?s WHERE privilege = ?s AND lang_code = ?s", $v, $pr_id, DESCR_SL);
			}
		}

		if ($action == 'delete') {
			foreach ((array)$_REQUEST['delete'] as $pr_id => $v) {
				db_query("DELETE FROM ?:privileges WHERE privilege = ?s", $pr_id);
				db_query("DELETE FROM ?:privilege_descriptions WHERE privilege = ?s", $pr_id);
			}
		}

		$suffix = ".privileges";
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=memberships$suffix");
}

if ($mode == 'assign_privileges' && !empty($_REQUEST['membership_id'])) {

	if (defined('RESTRICTED_ADMIN')) {
		$requested_mtype = db_get_field("SELECT type FROM ?:memberships WHERE membership_id = ?i", $_REQUEST['membership_id']);
		if ($requested_mtype == 'A') {
			return array(CONTROLLER_STATUS_DENIED);
		}
	}

	$membership_name = db_get_field("SELECT membership FROM ?:membership_descriptions WHERE membership_id = ?i AND lang_code = ?s", $_REQUEST['membership_id'], DESCR_SL);

	fn_add_breadcrumb(fn_get_lang_var('memberships'), "$index_script?dispatch=memberships.manage");

	$membership_privileges = db_get_hash_single_array("SELECT privilege FROM ?:membership_privileges WHERE membership_id = ?i", array('privilege', 'privilege'), $_REQUEST['membership_id']);

	$view->assign('membership_privileges', $membership_privileges);
	$view->assign('privileges', db_get_hash_multi_array("SELECT a.*, b.* FROM ?:privileges as a LEFT JOIN ?:privilege_descriptions as b ON b.privilege = a.privilege AND b.lang_code = ?s", array('section'), DESCR_SL));

} elseif ($mode == 'privileges') {

	fn_add_breadcrumb(fn_get_lang_var('memberships'), "$index_script?dispatch=memberships.manage");

	$privileges = db_get_hash_multi_array("SELECT a.*, b.* FROM ?:privileges as a LEFT JOIN ?:privilege_descriptions as b ON b.privilege = a.privilege AND b.lang_code = ?s", array('section'), DESCR_SL);

	$sections = db_get_fields("SELECT section FROM ?:privilege_descriptions WHERE lang_code = ?s GROUP BY section", DESCR_SL);

	$view->assign('sections', $sections);
	$view->assign('privileges', $privileges);

} elseif ($mode == 'manage') {

	$where = defined('RESTRICTED_ADMIN') ? "a.type!='A' ": '1';

	$memberships = db_get_array("SELECT a.membership_id, a.status, a.type, b.membership FROM ?:memberships as a LEFT JOIN ?:membership_descriptions as b ON b.membership_id = a.membership_id AND b.lang_code = ?s WHERE $where ORDER BY membership", DESCR_SL);

	$view->assign('memberships', $memberships);

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['membership_id'])) {
		fn_delete_memberships((array)$_REQUEST['membership_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=memberships.manage");
}

function fn_delete_memberships($membership_ids)
{
	db_query("DELETE FROM ?:memberships WHERE membership_id IN (?n)", $membership_ids);
	db_query("DELETE FROM ?:membership_descriptions WHERE membership_id IN (?n)", $membership_ids);
}

?>
