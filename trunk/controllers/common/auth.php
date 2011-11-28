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
// $Id: auth.php 7636 2009-06-30 07:03:06Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//
	// Login mode
	//
	if ($mode == 'login') {

		$redirect_url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $index_script;

		if (AREA != 'A') {
			if (Registry::get('settings.Image_verification.use_for_login') == 'Y' && fn_image_verification('login_' . $_REQUEST['form_name'], empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
				$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
				return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
			}
		}

		list($status, $user_data, $user_login, $password) = fn_auth_routines($_REQUEST);

		if ($status === false) {
			fn_save_post_data();
			$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
			return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
		}

		//
		// Success login
		//
		if (!empty($user_data) && md5($password) == $user_data['password'] && !empty($password)) {

			// Set system notifications
			if (Registry::get('config.demo_mode') != true && AREA == 'A') {

				// If username equals to the password
				if ($password == $user_data['user_login']) {
					$msg = fn_get_lang_var('warning_insecure_password');
					$msg = str_replace('[link]', Registry::get('config.admin_index') . "?dispatch=profiles.update", $msg);
					fn_set_notification('E', fn_get_lang_var('warning'), $msg, true, 'insecure_password');
				}

				// If upgrades available
				$uc_settings = fn_get_settings('Upgrade_center');
				$data = fn_get_contents($uc_settings['updates_server'] . '/index.php?target=product_updates&mode=check_available&ver=' . PRODUCT_VERSION . '&license_number=' . $uc_settings['license_number']);
				if ($data == 'AVAILABLE') {
					$msg = fn_get_lang_var('text_upgrade_available');
					$msg = str_replace('[link]', Registry::get('config.admin_index') . "?dispatch=upgrade_center.manage", $msg);
					fn_set_notification('W', fn_get_lang_var('notice'), $msg, true, 'upgrade_center');
				}
			}

			//
			// If customer placed orders before login, assign these orders to this account
			//
			if (!empty($auth['order_ids'])) {
				foreach ($auth['order_ids'] as $k => $v) {
					db_query("UPDATE ?:orders SET ?u WHERE order_id = ?i", array('user_id' => $user_data['user_id']), $v);
				}
			}

			$auth = fn_fill_auth($user_data);

			if (!empty($_REQUEST['remember_me'])) {
				fn_set_cookie(AREA_NAME . '_user_id', $user_data['user_id'], COOKIE_ALIVE_TIME);
				fn_set_cookie(AREA_NAME . '_password', $user_data['password'], COOKIE_ALIVE_TIME);
			}

			// Set last login time
			db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", array('last_login' => TIME), $user_data['user_id']);

			$_SESSION['auth']['this_login'] = TIME;
			$_SESSION['auth']['ip'] = $_SERVER['REMOTE_ADDR'];

			// Log user successful login
			fn_log_event('users', 'session', array(
				'user_id' => $user_data['user_id']
			));

			if (AREA == 'C') {

				if ($cu_id = fn_get_cookie('cu_id')) {
					fn_clear_cart($cart);
					fn_save_cart_content($cart, $cu_id, 'C', 'U');
					fn_delete_cookies('cu_id');
				}

				fn_init_user_session_data($_SESSION, $user_data['user_id']);
			}

			if (defined('AJAX_REQUEST') && Registry::get('settings.General.one_page_checkout') == 'Y') {
				$redirect_url = "$index_script?dispatch=checkout.checkout";
			} elseif (!empty($_REQUEST['return_url'])) {
				$redirect_url = $_REQUEST['return_url'];
			}
		} else {
		//
		// Login incorrect
		//
			// Log user failed login
			fn_log_event('users', 'failed_login', array (
				'user' => $user_login
			));

			$auth = array();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_incorrect_login'));
			$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
			return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
		}

		unset($_SESSION['edit_step']);
		if (!empty($_REQUEST['checkout_login']) && $_REQUEST['checkout_login'] == 'Y') {
			$profiles_num = db_get_field("SELECT COUNT(*) FROM ?:user_profiles WHERE user_id = ?i", $auth['user_id']);
			if ($profiles_num > 1 && Registry::get('settings.General.user_multiple_profiles') == 'Y') {
				$redirect_url = "$index_script?dispatch=checkout.customer_info";
			} else {
				$redirect_url = "$index_script?dispatch=checkout.checkout";
			}
		}
	}

	//
	// Recover password mode
	//
	if ($mode == 'recover_password') {
		$suffix = '';

		if (!empty($_REQUEST['user_email'])) {

			$u_data = db_get_row("SELECT ?:users.user_id, ?:users.email, ?:users.lang_code, ?:users.user_type FROM ?:users WHERE email = ?s", $_REQUEST['user_email']);

			if (!empty($u_data['email'])) {
				$_data = array (
					'object_id' => $u_data['user_id'],
					'object_type' => 'U',
					'ekey' => md5(uniqid(rand())),
					'ttl' => strtotime("+1 day")
				);

				db_query("REPLACE INTO ?:ekeys ?e", $_data);

				$view_mail->assign('index_script', $u_data['user_type'] == 'A' ? Registry::get('config.admin_index') : Registry::get('config.customer_index'));
				$view_mail->assign('ekey', $_data['ekey']);

				fn_send_mail($u_data['email'], Registry::get('settings.Company.company_users_department'), 'profiles/recover_password_subj.tpl','profiles/recover_password.tpl', '', $u_data['lang_code']);

				fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_password_recovery_instructions_sent'));

			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_login_not_exists'));
				$suffix = "?dispatch=auth.recover_password";
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_login_not_exists'));
			$suffix = "?dispatch=auth.recover_password";
		}

		$redirect_url = $index_script . $suffix;
	}

	return array(CONTROLLER_STATUS_OK, $redirect_url);
}

//
// Perform user log out
//
if ($mode == 'logout') {

	fn_save_cart_content($_SESSION['cart'], $auth['user_id']);

	$auth = $_SESSION['auth'];

	if (!empty($auth['user_id'])) {
		// Log user logout
		fn_log_event('users', 'session', array(
			'user_id' => $auth['user_id'],
			'time' => TIME - $auth['this_login'],
			'timeout' => false
		));
	}

	unset($_SESSION['auth']);
	fn_clear_cart($_SESSION['cart'], false, true);

	fn_delete_cookies(AREA_NAME . '_user_id', AREA_NAME . '_password');

	return array(CONTROLLER_STATUS_OK, $index_script);
}

//
// Recover password mode
//
if ($mode == 'recover_password') {

	// Cleanup expired keys
	db_query("DELETE FROM ?:ekeys WHERE ttl > 0 AND ttl < ?i", TIME); // FIXME: should be moved to another place

	if (!empty($_REQUEST['ekey'])) {
		$u_id = db_get_field("SELECT object_id FROM ?:ekeys WHERE ekey = ?s AND object_type = 'U' AND ttl > ?i", $_REQUEST['ekey'], TIME);
		if (!empty($u_id)) {
			$udata = db_get_row("SELECT user_id, user_type, tax_exempt, last_login, membership_status, membership_id FROM ?:users WHERE user_id = ?i", $u_id);
			$auth = fn_fill_auth($udata, isset($auth['order_ids']) ? $auth['order_ids'] : array());

			// Delete this key
			db_query("DELETE FROM ?:ekeys WHERE ekey = ?s", $_REQUEST['ekey']);

			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_change_password'));
			return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=profiles.update");

		} else {

			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_ekey_not_valid'));
			return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=auth.recover_password");
		}
	}

	fn_add_breadcrumb(fn_get_lang_var('recover_password'));
}

//
// Display login form in the mainbox
//
if ($mode == 'login_form') {
	if (defined('AJAX_REQUEST') && empty($auth)) {
		exit;
	}

	if (!empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	fn_add_breadcrumb(fn_get_lang_var('my_account'));

	$view->assign('redirect_url', empty($_REQUEST['return_url']) ? '' : $_REQUEST['return_url']);
}

function fn_auth_routines($request)
{
	$status = true;

	$user_login = $_REQUEST['user_login'];
	$password = $_POST['password'];
	$field = (Registry::get('settings.General.use_email_as_login') == 'Y') ? 'email' : 'user_login';
	$user_data = db_get_row("SELECT * FROM ?:users WHERE $field = ?s", $user_login);

	if (!empty($user_data['membership_id'])) {
		$user_data['membership_type'] = db_get_field("SELECT type FROM ?:memberships WHERE membership_id = ?i", $user_data['membership_id']);
	}

	fn_set_hook('auth_routines', $status, $user_data);

	if (!empty($user_data) && $user_data['user_type'] != 'A' && AREA == 'A') {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_area_access_denied'));
		$status = false;
	}

	if (!empty($user_data) && $user_data['status'] == 'D') {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_account_disabled'));
		$status = false;
	}

	return array($status, $user_data, $user_login, $password);
}
?>
