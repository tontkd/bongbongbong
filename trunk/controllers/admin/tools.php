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
// $Id: tools.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if ($mode == 'update_quick_menu_item') {
		$_data = $_REQUEST['item'];

		if (empty($_data['position'])) {
			$_data['position'] = db_get_field("SELECT max(position) FROM ?:quick_menu WHERE parent_id = ?i", $_data['parent_id']);
			$_data['position'] = $_data['position'] + 10;
		}

		$_data['user_id'] = $auth['user_id'];

		if (empty($_data['id'])) {
			$id = db_query("INSERT INTO ?:quick_menu ?e", $_data);

			$_data = array (
				'object_id' => $id,
				'description' => $_data['name'],
				'object_table' => 'quick_menu'
			);

			foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
				db_query("INSERT INTO ?:common_descriptions ?e", $_data);
			}
		} else {
			db_query("UPDATE ?:quick_menu SET ?u WHERE menu_id = ?i", $_data, $_data['id']);

			$__data = array(
				'description' => $_data['name']
			);
			db_query("UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND object_table = 'quick_menu' AND lang_code = ?s", $__data, $_data['id'], DESCR_SL);
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=tools.show_quick_menu.edit");
	}

	return;
}

if ($mode == 'phpinfo') {
	phpinfo();
	exit;

} elseif ($mode == 'show_quick_menu') {
	if (ACTION == 'edit') {
		$view->assign('edit_quick_menu', true);
	} else {
		$view->assign('expand_quick_menu', true);
	}

	if (!empty($_REQUEST['popup'])) {
		$view->assign('show_quick_popup', true);
	}

	$view->display('common_templates/quick_menu.tpl');
	exit;

} elseif ($mode == 'get_quick_menu_variant') {
	$ajax->assign('description', db_get_field("SELECT description FROM ?:common_descriptions WHERE object_id = ?i AND object_table = 'quick_menu' AND lang_code = ?s", $_REQUEST['id'], DESCR_SL));
	exit;

} elseif ($mode == 'remove_quick_menu_item') {
	$where = '';
	if (intval($_REQUEST['parent_id']) == 0) {
		$where = db_quote(" OR parent_id = ?i", $_REQUEST['id']);
		$delete_ids = db_get_fields("SELECT menu_id FROM ?:quick_menu WHERE parent_id = ?i", $_REQUEST['id']);
		db_query("DELETE FROM ?:common_descriptions WHERE object_id IN (?n) AND object_table = 'quick_menu'", $delete_ids);
	}

	db_query("DELETE FROM ?:quick_menu WHERE menu_id = ?i ?p", $_REQUEST['id'], $where);
	db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_table = 'quick_menu'", $_REQUEST['id']);

	$view->assign('edit_quick_menu', true);
	$view->assign('quick_menu', fn_get_quick_menu_data());
	$view->display('common_templates/quick_menu.tpl');
	exit;

} elseif ($mode == 'cleanup_history') {
	$_SESSION['last_edited_items'] = array();
	fn_save_user_additional_data('L', '');
	$view->assign('last_edited_items', '');
	$view->display('common_templates/last_viewed_items.tpl');
	exit;
	
} elseif ($mode == 'update_status') {
	if (preg_match("/^[a-z_]+$/", $_REQUEST['table'])) {
		$table_name = $_REQUEST['table'];
	} else {
		die; // incorrect table name
	}

	$old_status = db_get_field("SELECT status FROM ?:$table_name WHERE ?w", array($_REQUEST['id_name'] => $_REQUEST['id']));

	$result = db_query("UPDATE ?:$table_name SET status = ?s WHERE ?w", $_REQUEST['status'], array($_REQUEST['id_name'] => $_REQUEST['id']));
	if ($result) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_status_not_changed'));
		$ajax->assign('return_status', $old_status);
	}

	exit;

// Open/close the store
} elseif ($mode == 'store_mode') {

	fn_set_store_mode($_REQUEST['state']);

	$view->assign('settings', Registry::get('settings'));
	$view->display('bottom.tpl');
	exit;
}

?>
