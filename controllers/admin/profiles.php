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
// $Id: profiles.php 7654 2009-07-01 08:39:25Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($mode == 'm_delete') {

		if (!empty($_REQUEST['user_ids'])) {
			foreach ($_REQUEST['user_ids'] as $v) {
				fn_delete_user($v);
			}
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=profiles.manage" . (isset($_REQUEST['user_type']) ? "&user_type=" . $_REQUEST['user_type'] : '' ));
	}

	if ($mode == 'export_range') {
		if (!empty($_REQUEST['user_ids'])) {

			if (empty($_SESSION['export_ranges'])) {
				$_SESSION['export_ranges'] = array();
			}

			if (empty($_SESSION['export_ranges']['users'])) {
				$_SESSION['export_ranges']['users'] = array('pattern_id' => 'users');
			}

			$_SESSION['export_ranges']['users']['data'] = array('user_id' => $_REQUEST['user_ids']);

			unset($_REQUEST['redirect_url']);
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=exim.export&section=users&pattern_id=" . $_SESSION['export_ranges']['users']['pattern_id']);
		}
	}
}

if ($mode == 'manage') {

	list($users, $search) = fn_get_users($_REQUEST, $auth, Registry::get('settings.Appearance.admin_elements_per_page'));
	$view->assign('users', $users);
	$view->assign('search', $search);

	if (!empty($search['user_type'])) {
		$view->assign('user_type_description', fn_get_user_type_description($search['user_type']));
	}

	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	$view->assign('memberships', fn_get_memberships('F', DESCR_SL));

} elseif ($mode == 'act_as_user') {

	if (fn_is_restricted_admin($_REQUEST) == true) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	$user_data = db_get_row("SELECT * FROM ?:users WHERE user_id = ?i", $_REQUEST['user_id']);

	if (!empty($user_data)) {
		$user_type = empty($_REQUEST['area']) ? (($user_data['user_type'] == 'A') ? 'A' : 'C') : $_REQUEST['area']; // 'area' variable was used for loging in to the area different from the user type.

		$sess_data = array(
			'auth' => fn_fill_auth($user_data, array(), true)
		);

		fn_init_user_session_data($sess_data, $_REQUEST['user_id']);

		Session::save(Session::get_id(), $sess_data, $user_type);

		return array(CONTROLLER_STATUS_REDIRECT, ($user_type == 'A') ? Registry::get('config.admin_index') : Registry::get('config.customer_index'));
	}

} elseif ($mode == 'picker') {
	$params = $_REQUEST;
	$params['exclude_user_types'] = array ('A', 'S');

	list($users, $search) = fn_get_users($params, $auth, Registry::get('settings.Appearance.admin_elements_per_page'));
	$view->assign('users', $users);
	$view->assign('search', $search);

	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	$view->assign('memberships', fn_get_memberships('F', CART_LANGUAGE));

	$view->display('pickers/users_picker_contents.tpl');
	exit;

} elseif ($mode == 'update' || $mode == 'add') {
	Registry::set('navigation.tabs', array (
		'general' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'addons' => array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		)
	));

} elseif ($mode == 'delete') {

	$a = fn_delete_user($_REQUEST['user_id']);

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'update_status') {

	$user_data = db_get_row("SELECT * FROM ?:users WHERE user_id = ?i", $_REQUEST['id']);
	$result = db_query("UPDATE ?:users SET status = ?s WHERE user_id = ?i", $_REQUEST['status'], $_REQUEST['id']);
	if ($result) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
		if (!empty($_REQUEST['notify_user']) && $_REQUEST['status'] == 'A' && $user_data['status'] == 'D') {
			Registry::get('view_mail')->assign('user_data', $user_data);
			fn_send_mail($user_data['email'], Registry::get('settings.Company.company_users_department'), 'profiles/profile_activated_subj.tpl', 'profiles/profile_activated.tpl', '', ($_REQUEST['id'] != 1 ? $user_data['lang_code'] : CART_LANGUAGE));
		}
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_status_not_changed'));
		$ajax->assign('return_status', $user_data['status']);
	}

	exit;
}

function fn_delete_user($user_id)
{
	if ($user_id == 1 || fn_is_restricted_admin(array('user_id' => $user_id))) { // Skip root administrator
		return false; 
	}

	// Log user deletion
	fn_log_event('users', 'delete', array (
		'user_id' => $user_id
	));

	db_query("DELETE FROM ?:users WHERE user_id = ?i", $user_id);
	db_query("DELETE FROM ?:user_profiles WHERE user_id = ?i", $user_id);
	db_query("DELETE FROM ?:user_session_products WHERE user_id = ?i", $user_id);
	db_query("DELETE FROM ?:user_data WHERE user_id = ?i", $user_id);
	db_query("UPDATE ?:orders SET user_id = 0 WHERE user_id = ?i", $user_id);

	fn_set_hook('delete_user', $user_id);

	return true;
}

?>
