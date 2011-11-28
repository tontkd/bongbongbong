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
// $Id: profiles.post.php 7789 2009-08-05 08:10:02Z zeke $
//
if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (AREA == 'A') {
		$_auth = NULL;
	} else {
		$_auth = &$auth;
	}

	//
	// Create new user
	//
	if ($mode == 'add') {

		if (fn_is_restricted_admin($_REQUEST) == true) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		if (AREA != 'A') {
			if (Registry::get('settings.Image_verification.use_for_register') == 'Y' && fn_image_verification('register', empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
				fn_save_post_data();
				$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=register';

				return array(CONTROLLER_STATUS_REDIRECT, $_SERVER['HTTP_REFERER'] . $suffix);
			}
		}

		if ($res = fn_update_user(0, $_REQUEST['user_data'], $_auth, !empty($_REQUEST['ship_to_another']), (AREA == 'A' ? !empty($_REQUEST['notify_customer']) : true))) {
			$suffix = 'update';
			list($user_id, $profile_id) = $res;

			// Cleanup user info stored in cart
			if (!empty($_SESSION['cart']) && !empty($_SESSION['cart']['user_data']) && AREA != 'A') {
				unset($_SESSION['cart']['user_data']);
			}

			if (Registry::get('settings.General.user_multiple_profiles') == 'Y') {
				$suffix .= "&profile_id=$profile_id";
			}

			if (AREA == 'A') {
				$suffix .= "&user_id=$user_id";
			}

			// Delete anonymous authentication
			if (AREA != 'A') {
				if ($cu_id = fn_get_cookie('cu_id') && !empty($auth['user_id'])) {
					fn_delete_cookies('cu_id');
				}
			}
		} else {
			$suffix = 'add';
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=profiles." . $suffix);
	}

	//
	// Update user
	//
	if ($mode == 'update') {

		if (fn_is_restricted_admin($_REQUEST) == true) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		$user_id = (AREA == 'A' && !empty($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : $auth['user_id'];
		$suffix = '';

		if ($res = fn_update_user($user_id, $_REQUEST['user_data'], $_auth, !empty($_REQUEST['ship_to_another']), (AREA == 'A' ? !empty($_REQUEST['notify_customer']) : true))) {

			list($user_id, $profile_id) = $res;

			// Cleanup user info stored in cart
			if (!empty($_SESSION['cart']) && !empty($_SESSION['cart']['user_data']) && AREA != 'A') {
				unset($_SESSION['cart']['user_data']);
			}

			if (Registry::get('settings.General.user_multiple_profiles') == 'Y') {
				$suffix = "&profile_id=$profile_id";
			}
		}

		if (AREA == 'A' && !empty($_REQUEST['user_id'])) {
			$suffix .= "&user_id=$_REQUEST[user_id]";
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=profiles.update" . $suffix);

	}

}

if ($mode == 'add' || $mode == 'update') {

	if (AREA == 'A' && fn_is_restricted_admin($_REQUEST) == true) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	$uid = 0;
	$user_data = array();
	$profile_id = empty($_REQUEST['profile_id']) ? 0 : $_REQUEST['profile_id'];
	if (AREA == 'A') {
		$uid = empty($_REQUEST['user_id']) ? (($mode == 'add') ? '' : $auth['user_id']) : $_REQUEST['user_id'];
	} elseif ($mode == 'update') {
		fn_add_breadcrumb(fn_get_lang_var(($mode == 'add') ? 'new_profile' : 'editing_profile'));
		$uid = $auth['user_id'];
	}

	if (!empty($_SESSION['saved_post_data']['user_data'])) {
		foreach	((array)$_SESSION['saved_post_data'] as $k => $v)	{
			$view->assign($k, $v);
		}

		$user_data = $_SESSION['saved_post_data']['user_data'];
		unset($_SESSION['saved_post_data']['user_data']);

	} else {
		if ($mode == 'update') {

			if (!empty($profile_id)) {
				$is_allowed = db_get_field("SELECT user_id FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i", $uid, $profile_id);
				if (empty($is_allowed)) {

					return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=profiles.update" . (!empty($_REQUEST['user_id']) ? "&user_id=$_REQUEST[user_id]" : ''));
				}
			}


			if (!empty($profile_id)) {
				$user_data = fn_get_user_info($uid, true, $profile_id);
			} elseif (!empty($_REQUEST['profile']) && $_REQUEST['profile'] == 'new') {
				$user_data = fn_get_user_info($uid, false, $profile_id);
			} else {
				$user_data = fn_get_user_info($uid, true, $profile_id);
			}

			if (empty($user_data)) {
				return array(CONTROLLER_STATUS_NO_PAGE);
			}
		}

		if ($mode == 'add' && !empty($_SESSION['cart']) && !empty($_SESSION['cart']['user_data']) && AREA != 'A') {
			$user_data = $_SESSION['cart']['user_data'];
		}
	}

	$user_type = (!empty($user_data['user_type'])) ? ($user_data['user_type']) : (!empty($_REQUEST['user_type']) ? $_REQUEST['user_type'] : 'C'); // customer by default
	if (AREA == 'A') {
		fn_add_breadcrumb(fn_get_lang_var('users'), "$index_script?dispatch=profiles.manage");
		fn_add_breadcrumb(fn_get_user_type_description($user_type, true), "$index_script?dispatch=profiles.manage&user_type=" . $user_type);
	}

	$profile_fields = fn_get_profile_fields($user_type);
	$view->assign('user_type', $user_type);
	$view->assign('profile_fields', $profile_fields);
	$view->assign('user_data', $user_data);
	$view->assign('ship_to_another', fn_check_shipping_billing($user_data, $profile_fields));
	$view->assign('titles', fn_get_static_data_section('T'));
	$view->assign('memberships', fn_get_memberships('F', CART_LANGUAGE));
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	$view->assign('uid', $uid);
	if (Registry::get('settings.General.user_multiple_profiles') == 'Y' && !empty($uid)) {
		$view->assign('user_profiles', fn_get_user_profiles($uid));
	}

// Delete profile
} elseif ($mode == 'delete_profile') {

	if (AREA == 'A' && fn_is_restricted_admin($_REQUEST) == true) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	if (AREA == 'A') {
		$uid = empty($_REQUEST['user_id']) ? $auth['user_id'] : $_REQUEST['user_id'];
	} else {
		$uid = $auth['user_id'];
	}

	$can_delete = db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i AND profile_type = 'S'", $uid, $_REQUEST['profile_id']);
	if (!empty($can_delete)) {
		db_query("DELETE FROM ?:user_profiles WHERE profile_id = ?i", $_REQUEST['profile_id']);
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=profiles.update&user_id=" . $uid);
}

?>
