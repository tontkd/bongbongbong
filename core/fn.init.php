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
// $Id: fn.init.php 7862 2009-08-19 12:18:39Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

/**
 * Init mail engine
 *
 * @return boolean always true
 */
function fn_init_mailer()
{
	if (defined('MAILER_STARTED')) {
		return true;
	}

	$mailer_settings = fn_get_settings('Emails');

	if (!include(DIR_CORE . 'class.mailer.php')) {
		fn_error(debug_backtrace(), "Can't find Mail class", false);
	}

	$mailer = new Mailer();
	$mailer->LE = (defined('IS_WINDOWS')) ? "\r\n" : "\n";
	$mailer->PluginDir = DIR_LIB . 'phpmailer/';

	if ($mailer_settings['mailer_send_method'] == 'smtp') {
		$mailer->IsSMTP();
		$mailer->SMTPAuth = ($mailer_settings['mailer_smtp_auth'] == 'Y') ? true : false;
		$mailer->Host = $mailer_settings['mailer_smtp_host'];
		$mailer->Username = $mailer_settings['mailer_smtp_username'];
		$mailer->Password = $mailer_settings['mailer_smtp_password'];

	} elseif ($mailer_settings['mailer_send_method'] == 'sendmail') {
		$mailer->IsSendmail();
		$mailer->Sendmail = $mailer_settings['mailer_sendmail_path'];

	} else {
		$mailer->IsMail();
	}

	Registry::set('mailer', $mailer);

	define('MAILER_STARTED', true);

	return true;
}

/**
 * Init template engine
 *
 * @return boolean always true
 */
function fn_init_templater()
{
	if (defined('TEMPLATER_STARTED')) {
		return true;
	}

	require(DIR_CORE . 'class.templater.php');

	//
	// Template objects for processing html templates
	//
	$view = new Templater();
	$view_mail = new Templater();

	fn_set_hook('init_templater', $view, $view_mail);

	$view->register_prefilter(array(&$view, 'prefilter_hook'));
	$view_mail->register_prefilter(array(&$view_mail, 'prefilter_hook'));

	if (Registry::get('settings.customization_mode') == 'Y' && AREA == 'C') {
		$view->register_prefilter(array(&$view, 'prefilter_template_wrapper'));
		$view->register_outputfilter(array(&$view, 'outputfilter_template_ids'));
		$view->customization = true;
	} else {
		// Inline prefilter
		if (Registry::get('config.tweaks.inline_compilation') == true) {
			$view->register_prefilter(array(&$view, 'prefilter_inline'));
		}
	}

	// Cache separate templates
	$view->register_prefilter(array(&$view, 'prefilter_cache_templates'));

	// Output bufferring postfilter
	$view->register_prefilter(array(&$view, 'prefilter_output_buffering'));

	// Translation postfilter
	$view->register_postfilter(array(&$view, 'postfilter_translation'));

	if (Registry::get('settings.translation_mode') == 'Y') {
		$view->register_outputfilter(array(&$view, 'outputfilter_translate_wrapper'));
	}

	//
	// Store all compiled templates to the single directory
	//
	$view->use_sub_dirs = false;
	$view->compile_check = Registry::get('config.tweaks.check_templates');


	if (Registry::get('settings.General.debugging_console') == 'Y') {

		if (empty($_SESSION['debugging_console']) && !empty($_SESSION['auth']['user_id']))	{
			$user_type = db_get_field("SELECT user_type FROM ?:users WHERE user_id = ?i", $_SESSION['auth']['user_id']);
			if ($user_type == 'A') {
				$_SESSION['debugging_console'] = true;
			}
		}

		if (isset($_SESSION['debugging_console']) && $_SESSION['debugging_console'] == true) {
			error_reporting(0);
			$view->debugging = true;
		}
	}

	$skin_name = Registry::get('config.skin_name');

	$view->template_dir = DIR_SKINS . $skin_name . '/' . AREA_NAME;
	$view->config_dir = DIR_SKINS . $skin_name . '/' . AREA_NAME;
	$view->secure_dir = DIR_SKINS . $skin_name . '/' . AREA_NAME;
	$view->assign('images_dir', Registry::get('config.current_path') . "/skins/$skin_name/" . AREA_NAME . "/images");

	$view->compile_dir = DIR_COMPILED . AREA_NAME . (defined('SKINS_PANEL') ? $skin_name : '');
	$view->cache_dir = DIR_CACHE;
	$view->assign('skin_area', AREA_NAME);

	// Get manifest
	$manifest = parse_ini_file(DIR_SKINS . Registry::get('settings.skin_name_' . AREA_NAME) . '/' . SKIN_MANIFEST, true);
	$view->assign('manifest', $manifest);

	// Mail templates should be taken from the customer skin
	$manifest = (AREA == 'C') ? $manifest : parse_ini_file(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/' . SKIN_MANIFEST, true);
	$view_mail->assign('manifest', $manifest);
	$view_mail->template_dir = DIR_SKINS . Registry::get('settings.skin_name_customer') . '/mail';
	$view_mail->config_dir = DIR_SKINS . Registry::get('settings.skin_name_customer') . '/mail';
	$view_mail->secure_dir = DIR_SKINS . Registry::get('settings.skin_name_customer') . '/mail';
	$view_mail->assign('images_dir', Registry::get('config.current_path') . '/skins/' . Registry::get('settings.skin_name_customer') . '/mail/images');
	$view_mail->compile_dir = DIR_COMPILED . 'mail';
	$view_mail->assign('skin_area', 'mail');

	if (!is_dir($view->compile_dir)) {
		fn_mkdir($view->compile_dir);
	}

	if (!is_dir($view->cache_dir)) {
		fn_mkdir($view->cache_dir);
	}


	if (!is_dir($view_mail->compile_dir) ) {
		fn_mkdir($view_mail->compile_dir);
	}

	if (!is_writable($view->compile_dir) || !is_dir($view->compile_dir) ) {
		fn_error(debug_backtrace(), "Can't write template cache in the directory: <b>" . $view->compile_dir . '</b>.<br>Please check if it exists, and has writable permissions.', false);
	}

	$view->assign('ldelim','{');
	$view->assign('rdelim','}');

	Registry::set('view', $view);
	Registry::set('view_mail', $view_mail);

	define('TEMPLATER_STARTED', true);

	return true;
}

/**
 * Init crypt engine
 *
 * @return boolean always true
 */
function fn_init_crypt()
{
	if (!defined('CRYPT_STARTED')) {
		if (!include(DIR_LIB . 'crypt/Blowfish.php')) {
			fn_error(debug_backtrace(), "Can't connect Blowfish crypt class", false);
		}

		$crypt = new Crypt_Blowfish(Registry::get('config.crypt_key'));
		Registry::set('crypt', $crypt);

		fn_define('CRYPT_STARTED', true);
	}

	return true;
}

/**
 * Init ajax engine
 *
 * @return boolean true if current request is ajax, false - otherwise
 */
function fn_init_ajax()
{
	if (defined('AJAX_REQUEST')) {
		return true;
	}

	if (!empty($_REQUEST['is_ajax']) || (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
		require(DIR_CORE . 'class.ajax.php');
		$ajax = new Ajax();
		Registry::set('ajax', $ajax);
		fn_define('AJAX_REQUEST', true);
		return true;
	}

	return false;
}

/**
 * Init yaml engine
 *
 * @return boolean always true
 */
function fn_init_yaml()
{
	if (!defined('YAML_STARTED')) {
		require(DIR_LIB . 'spyc/spyc.php');
		fn_define('YAML_STARTED', true);
	}

	return true;
}

/**
 * Init pdf engine
 *
 * @return boolean always true
 */
function fn_init_pdf()
{
	// pdf can't be generated correctly without DOM extension (DOMDocument class)
	if (!class_exists('DOMDocument')) {
		$msg = (AREA == 'A') ? fn_get_lang_var('error_generate_pdf_admin') : fn_get_lang_var('error_generate_pdf_customer');
		fn_set_notification('E', fn_get_lang_var('error'), $msg);
		return false;
	}

	if (defined('PDF_STARTED')) {
		return true;
	}

	require(DIR_LIB . 'html2pdf/config.inc.php');

	define('CACHE_DIR', DIR_CACHE . 'pdf/cache');
	define('OUTPUT_FILE_DIRECTORY', DIR_CACHE . 'pdf/out');
	define('WRITER_TEMPDIR', DIR_CACHE . 'pdf/temp');

	if (!is_dir('CACHE_DIR')) {
		fn_mkdir(CACHE_DIR);
	}

	if (!is_dir('OUTPUT_FILE_DIRECTORY')) {
		fn_mkdir(OUTPUT_FILE_DIRECTORY);
	}

	if (!is_dir('WRITER_TEMPDIR')) {
		fn_mkdir(WRITER_TEMPDIR);
	}

	require(HTML2PS_DIR . 'pipeline.factory.class.php');

	@set_time_limit(10000);
	parse_config_file(HTML2PS_DIR . 'html2ps.config');

	class MyFetcherMemory extends Fetcher {
		var $base_path;
		var $content;

		function MyFetcherMemory($content, $base_path) 
		{
			$this->content   = $content;
			$this->base_path = $base_path;
		}

		function get_data($url) 
		{
		    if (!$url) {
        		return new FetchedDataURL($this->content[$url], array(), "");
   		    } else {
    			if (substr($url,0,8) == 'file:///') {
    			    $url = substr($url, 10);
    			    if (defined('IS_WINDOWS')) {
						$url = substr($url, 1);
					}
    			}

				list(, $result) = fn_http_request('GET', $url);

    			return new FetchedDataURL($result, array(), "");
		    }
   		}

		function get_base_url() {
			return $this->base_path;
		}
	}

	fn_define('PDF_STARTED', true);
	
	return true;
}

/**
 * Init diff engine
 *
 * @return boolean always true
 */
function fn_init_diff()
{
	if (!defined('DIFF_STARTED')) {
		include(DIR_LIB . 'pear/PEAR.php');
		include(DIR_LIB . 'Text/Diff.php');
		include(DIR_LIB . 'Text/Diff/Renderer.php');
		include(DIR_LIB . 'Text/Diff/Renderer/inline.php');

		fn_define('DIFF_STARTED', true);
	}

	return true;
}

/**
 * Init languages
 *
 * @param array $params request parameters
 * @return boolean always true
 */

function fn_init_language($params)
{
	$join_cond = '';
	$condition = (AREA == 'A') ? '' : "WHERE ?:languages.status = 'A'";
	$order_by = '';

	if ((AREA == 'C') && defined('CART_LOCALIZATION')) {
		$join_cond = "LEFT JOIN ?:localization_elements ON ?:localization_elements.element = ?:languages.lang_code AND ?:localization_elements.element_type = 'L'";
		$condition .= db_quote(' AND ?:localization_elements.localization_id = ?i', CART_LOCALIZATION);
		$order_by = "ORDER BY ?:localization_elements.position ASC";
	}

	$languages = db_get_hash_array("SELECT ?:languages.* FROM ?:languages $join_cond ?p $order_by", 'lang_code', $condition);
	$avail_languages = array();

	foreach ($languages as $k => $v) {
		if ($v['status'] == 'D') {
			continue;
		}

		$avail_languages[$k] = $v;
	}

	if (!empty($params['sl']) && !empty($avail_languages[$params['sl']])) {
		fn_define('CART_LANGUAGE', $params['sl']);
	} elseif (!fn_get_cookie('cart_language' . AREA) && $_lc = fn_get_browser_language($avail_languages)) {
		fn_define('CART_LANGUAGE', $_lc);
	} elseif (!fn_get_cookie('cart_language' . AREA) && !empty($avail_languages[Registry::get('settings.Appearance.' . AREA_NAME . '_default_language')])) {
		fn_define('CART_LANGUAGE', Registry::get('settings.Appearance.' . AREA_NAME . '_default_language'));

	} elseif (($_c = fn_get_cookie('cart_language' . AREA)) && !empty($avail_languages[$_c])) {
		fn_define('CART_LANGUAGE', $_c);

	} else {
		reset($avail_languages);
		fn_define('CART_LANGUAGE', key($avail_languages));
	}

	// For administrative area, set description language
	if (!empty($params['descr_sl']) && !empty($avail_languages[$params['descr_sl']])) {
		fn_define('DESCR_SL', $params['descr_sl']);
		fn_set_cookie('descr_sl', $params['descr_sl'], COOKIE_ALIVE_TIME);
	} elseif (($d = fn_get_cookie('descr_sl')) && !empty($avail_languages[$d])) {
		fn_define('DESCR_SL', $d);
	} else {
		fn_define('DESCR_SL', CART_LANGUAGE);
	}

	if (CART_LANGUAGE != fn_get_cookie('cart_language' . AREA)) {
		fn_set_cookie('cart_language' . AREA, CART_LANGUAGE, COOKIE_ALIVE_TIME);
	}

	fn_define('CHARSET', 'utf-8');
	header("Content-Type: text/html; charset=" . CHARSET);

	Registry::get('view')->assign('localizations' , fn_get_localizations(CART_LANGUAGE , true));

	if (defined('CART_LOCALIZATION')) {
		Registry::get('view')->assign('localization', fn_get_localization_data(CART_LOCALIZATION));
	}

	Registry::set('languages', $languages);

	Registry::get('view')->assign('languages', $avail_languages);
	Registry::get('view')->setLanguage(CART_LANGUAGE);
	Registry::get('view_mail')->setLanguage(CART_LANGUAGE);

	return true;
}

/**
 * Init currencies
 *
 * @param array $params request parameters
 * @return boolean always true
 */
function fn_init_currency($params)
{
	$cond = $join = $order_by = '';

	if ((AREA == 'C') && defined('CART_LOCALIZATION')) {
		$join = " LEFT JOIN ?:localization_elements as c ON c.element = a.currency_code AND c.element_type = 'M'";
		$cond = db_quote('AND c.localization_id = ?i', CART_LOCALIZATION);
		$order_by = "ORDER BY c.position ASC";
	}

	$currencies = db_get_hash_array("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_code = b.currency_code AND lang_code = ?s $join WHERE status = 'A' ?p $order_by", 'currency_code', CART_LANGUAGE, $cond);

	if (!empty($params['currency']) && !empty($currencies[$params['currency']])) {
		$secondary_currency = $params['currency'];
	} elseif (($c = fn_get_cookie('secondary_currency' . AREA)) && !empty($currencies[$c])) {
		$secondary_currency = $c;
	} else {
		foreach ($currencies as $v) {
			if ($v['is_primary'] == 'Y') {
				$secondary_currency = $v['currency_code'];
				break;
			}
		}
	}

	if (empty($secondary_currency)) {
		reset($currencies);
		$secondary_currency = key($currencies);
	}

	if ($secondary_currency != fn_get_cookie('secondary_currency' . AREA)) {
		fn_set_cookie('secondary_currency'.AREA, $secondary_currency, COOKIE_ALIVE_TIME);
	}

	$primary_currency = '';

	foreach ($currencies as $v) {
		if ($v['is_primary'] == 'Y') {
			$primary_currency = $v['currency_code'];
			break;
		}
	}

	if (empty($primary_currency)) {
		reset($currencies);
		$first_currency = current($currencies);
		$primary_currency = $first_currency['currency_code'];
	}

	define('CART_PRIMARY_CURRENCY', $primary_currency);
	define('CART_SECONDARY_CURRENCY', $secondary_currency);

	Registry::set('currencies', $currencies);
	Registry::get('view')->assign('currencies', $currencies, false);
	Registry::get('view')->assign('primary_currency', $primary_currency, false);
	Registry::get('view')->assign('secondary_currency', $secondary_currency, false);

	Registry::get('view_mail')->assign('currencies', $currencies, false);
	Registry::get('view_mail')->assign('primary_currency', $primary_currency, false);
	Registry::get('view_mail')->assign('secondary_currency', $secondary_currency, false);

	return true;
}

/**
 * Init skin
 *
 * @param array $params request parameters
 * @return boolean always true
 */
function fn_init_skin($params)
{
	if ((Registry::get('settings.skin_name_' . AREA_NAME) == '' || !is_dir(DIR_SKINS . Registry::get('settings.skin_name_' . AREA_NAME))) && !defined('SKINS_PANEL')) {
		$all = fn_get_dir_contents(DIR_SKINS, true);
		$skin_found = false;
		foreach ($all as $sk) {
			if (is_file(DIR_SKINS . $sk . '/' . AREA_NAME . '/index.tpl')) {
				Registry::set('settings.skin_name' . AREA_NAME, basename($sk));
				$skin_found = true;
				break;
			}
		}

		if ($skin_found == false) {
			die("No skins found");
		} else {
			echo <<<EOT
				<div style="background: #ff0000; color: #ffffff; font-weight: bold;" align="center">SELECTED SKIN NOT FOUND. REPLACED BY FIRST FOUND</div>
EOT;
		}
	}

	if (defined('DEVELOPMENT')) {
		foreach (Registry::get('config.dev_skins') as $k => $v) {
			Registry::set('settings.skin_name_' . $k, $v);
		}
	}

	// Allow user to change the skin during the current session
	if (defined('SKINS_PANEL')) {
		$demo_skin = fn_get_cookie('demo_skin');

		if (!empty($params['demo_skin'][AREA])) {
			$tmp_skin = basename($params['demo_skin'][AREA]);

			if (is_dir(DIR_SKINS . $tmp_skin)) {
				Registry::set('settings.skin_name_' . AREA_NAME, $tmp_skin);
				$demo_skin[AREA] = $tmp_skin;
			} else {
				Registry::set('settings.skin_name_' . AREA_NAME, $demo_skin[AREA]);
			}
		} elseif (empty($demo_skin[AREA])) {
			$demo_skin[AREA] = 'basic';
		}

		Registry::set('settings.skin_name_' . AREA_NAME, $demo_skin[AREA]);
		fn_set_cookie('demo_skin', $demo_skin);

		Registry::set('demo_skin', array(
			'selected' => $demo_skin,
			'available_skins' => fn_get_available_skins(AREA_NAME)
		));
	}

	$skin_name = Registry::get('settings.skin_name_' . AREA_NAME);
	Registry::set('config.skin_name', $skin_name);
	Registry::set('config.skin_path', Registry::get('config.current_path') .'/skins/' . $skin_name . '/' . AREA_NAME);
	Registry::set('config.no_image_path', Registry::get('config.images_path') . 'no_image.gif');

	return true;
}

/**
 * Init user
 *
 * @return boolean always true
 */
function fn_init_user()
{
	if (!empty($_SESSION['auth']['user_id']))	{
		$user_info = fn_get_user_short_info($_SESSION['auth']['user_id']);
		if (empty($user_info)) { // user does not exist in the database, but exists in session
			$_SESSION['auth'] = array();
		}
	}

	if (empty($_SESSION['auth'])) {

		$udata = array();

		if (fn_get_cookie(AREA_NAME . '_user_id')) {
			$udata = db_get_row("SELECT user_id, user_type, tax_exempt, last_login, membership_status, membership_id FROM ?:users WHERE user_id = ?i AND password = ?s", fn_get_cookie(AREA_NAME . '_user_id'), fn_get_cookie(AREA_NAME . '_password'));
			fn_define('LOGGED_VIA_COOKIE', true);
		}

		$_SESSION['auth'] = fn_fill_auth($udata, isset($_SESSION['auth']['order_ids']) ? $_SESSION['auth']['order_ids'] : array());

		if (!defined('NO_SESSION')) {
			$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
		}

		if ((defined('LOGGED_VIA_COOKIE') && !empty($_SESSION['auth']['user_id'])) || ($cu_id = fn_get_cookie('cu_id'))) {

			if (!empty($cu_id)) {
				fn_define('COOKIE_CART' , true);
			}

			// Cleanup cached shipping rates

			unset($_SESSION['shipping_rates']);

			$_utype = empty($_SESSION['auth']['user_id']) ? 'U' : 'R';
			$_uid = empty($_SESSION['auth']['user_id']) ? $cu_id : $_SESSION['auth']['user_id'];
			fn_extract_cart_content($_SESSION['cart'], $_uid , 'C' , $_utype);
			fn_save_cart_content($_SESSION['cart'] , $_uid , 'C' , $_utype);
			if (!empty($_SESSION['auth']['user_id'])) {
				$_SESSION['cart']['user_data'] = fn_get_user_info($_SESSION['auth']['user_id']);
			}
		}
	}

	if (TIME > Registry::get('settings.cart_products_next_check')) {
		fn_define('CART_PRODUCTS_CHECK_PERIOD' , 60 * 60 * 12);
		fn_define('CART_PRODUCTS_DELETE_TIME' , TIME - 60 * 60 * 24 * 30);
		db_query("DELETE FROM ?:user_session_products WHERE user_type = 'U' AND timestamp < ?i", CART_PRODUCTS_DELETE_TIME);
		db_query("UPDATE ?:settings SET value = ?s WHERE option_name = 'cart_products_next_check'", TIME + CART_PRODUCTS_CHECK_PERIOD);
	}

	// If administrative account has membership, it means the access restrictions are in action
	if (AREA == 'A' && !empty($_SESSION['auth']['membership_id'])) {
		fn_define('RESTRICTED_ADMIN', true);
	}

	if (!empty($user_info) && $user_info['user_type'] == 'A') {
		if (Registry::get('settings.translation_mode') == 'Y') {
			fn_define('TRANSLATION_MODE', true);
		}
		
		if (Registry::get('settings.customization_mode') == 'Y') {
			if (AREA != 'A') {
				fn_define('PARSE_ALL', true);
			}
			fn_define('CUSTOMIZATION_MODE', true);
		}
	}

	fn_set_hook('user_init', $_SESSION['auth'], $user_info);

	Registry::set('user_info', $user_info);
	Registry::get('view')->assign('auth', $_SESSION['auth']);
	Registry::get('view')->assign('user_info', $user_info);

	return true;
}

/**
 * Init localizations
 *
 * @param array $params request parameters
 * @return boolean true if localizations exists, false otherwise
 */
function fn_init_localization($params)
{
	$locs = db_get_hash_array("SELECT localization_id, custom_weight_settings, weight_symbol, weight_unit FROM ?:localizations WHERE status = 'A'", 'localization_id');

	if (empty($locs)) {
		return false;
	}

	if (!empty($_REQUEST['lc']) && !empty($locs[$_REQUEST['lc']])) {
		$cart_localization = $_REQUEST['lc'];

	} elseif (($l = fn_get_cookie('cart_localization')) && !empty($locs[$l])) {
		$cart_localization = $l;

	} else {
		$_ip = fn_get_ip(true);
		$_country = fn_get_country_by_ip($_ip['host']);
		$_lngs = db_get_hash_single_array("SELECT lang_code, 1 as 'l' FROM ?:languages", array('lang_code', 'l'));
		$_language = fn_get_browser_language($_lngs);

		$cart_localization = db_get_field("SELECT localization_id, COUNT(localization_id) as c FROM ?:localization_elements WHERE (element = ?s AND element_type = 'C') OR (element = ?s AND element_type = 'L') GROUP BY localization_id ORDER BY c DESC LIMIT 1", $_country, $_language);

		if (empty($cart_localization)) {
			$cart_localization = db_get_field("SELECT localization_id FROM ?:localizations WHERE is_default = 'Y'");
		}
	}

	if (empty($cart_localization)) {
		reset($locs);
		$cart_localization = key($locs);
	}

	if ($cart_localization != fn_get_cookie('cart_localization')) {
		fn_set_cookie('cart_localization', $cart_localization, COOKIE_ALIVE_TIME);
	}

	if ($locs[$cart_localization]['custom_weight_settings'] == 'Y') {
		Registry::set('config.localization.weight_symbol', $locs[$cart_localization]['weight_symbol']);
		Registry::set('config.localization.weight_unit', $locs[$cart_localization]['weight_unit']);
	}

	fn_define('CART_LOCALIZATION', $cart_localization);

	return true;
}


?>