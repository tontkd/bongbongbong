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
// $Id: init.php 7808 2009-08-12 14:28:04Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

// Require configuration
require(DIR_ROOT . '/config.php');

if (isset($_REQUEST['version'])) {
	die(PRODUCT_NAME . ': version <b>' . PRODUCT_VERSION . (PRODUCT_STATUS != '' ? (' (' . PRODUCT_STATUS . ')') : '') . '</b>');
}

if (isset($_REQUEST['check_https'])) {
	die(defined('HTTPS') ? 'OK' : '');
}

// Include core functions/classes
require(DIR_CORE . 'db/' . $config['db_type'] . '.php');
require(DIR_CORE . 'fn.database.php');
require(DIR_CORE . 'fn.users.php');
require(DIR_CORE . 'fn.catalog.php');
require(DIR_CORE . 'fn.cms.php');
require(DIR_CORE . 'fn.cart.php');
require(DIR_CORE . 'fn.locations.php');
require(DIR_CORE . 'fn.common.php');
require(DIR_CORE . 'fn.fs.php');
require(DIR_CORE . 'fn.requests.php');
require(DIR_CORE . 'fn.images.php');
require(DIR_CORE . 'fn.init.php');
require(DIR_CORE . 'fn.control.php');
require(DIR_CORE . 'fn.search.php');
require(DIR_CORE . 'fn.promotions.php');
require(DIR_CORE . 'fn.log.php');
require(DIR_CORE . 'class.profiler.php');
require(DIR_CORE . 'class.registry.php');

// Clean up templates cache
if (isset($_GET['cc'])) {
	fn_rm(DIR_COMPILED, false);
	fn_rm(DIR_CACHE, false);
}

// Set configuration options from config.php to registry
Registry::set('config', $config);
unset($config);

// Check if software is installed
if (Registry::get('config.db_host') == '%DB_HOST%') {
	die(PRODUCT_NAME . ' is <b>not installed</b>. Please click here to start the installation process: <a href="install/">[install]</a>');
}

// Connect to database
$db_conn = db_initiate(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), Registry::get('config.db_name'));

if (!$db_conn) {
	fn_error(debug_backtrace(), 'Cannot connect to the database server', false);
}

if (defined('MYSQL5')) {
	db_query("set @@sql_mode = ''");
}

register_shutdown_function(array('Registry', 'save'));

// First-level cache: static - the same for all requests
define('CACHE_LEVEL_STATIC', 'cache');
Registry::register_cache('settings', array('settings'), CACHE_LEVEL_STATIC);

// Get settings
if (Registry::is_exist('settings') == false) {
	Registry::set('settings', fn_get_settings());
}

// Init addons
fn_init_addons();

// init revisions
if (AREA == 'A' && Registry::get('settings.General.active_revisions_objects')) {
	require(DIR_CORE . 'fn.revisions.php');
	fn_init_revisions();
}

// initialize ajax handler
fn_init_ajax();

// get route to controller
fn_get_route();

// Start session mechanism
require(DIR_CORE . 'class.session.php');

// select the skin to display
fn_init_skin($_REQUEST);

// initialize templater
fn_init_templater();

// initialize store localization
if (AREA == 'C') {
	fn_init_localization($_REQUEST);
}

// initialize store language
fn_init_language($_REQUEST);

// initialize store currency
fn_init_currency($_REQUEST);

// Second-level (a) cache: different for dispatch-language-currency
define('CACHE_LEVEL_LOCALE', (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '_' . CART_SECONDARY_CURRENCY);

// Second-level (b) cache: different for dispatch-language-currency
define('CACHE_LEVEL_DISPATCH', $_SERVER['REQUEST_METHOD'] . '_' . str_replace('.', '_', $_REQUEST['dispatch']) . '_' . (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '_' . CART_SECONDARY_CURRENCY);
Registry::register_cache('lang_cache', array('language_values'), CACHE_LEVEL_DISPATCH, true);

if (!defined('NO_SESSION')) {
	// Get descriptions for company country and state
	if (Registry::get('settings.Company.company_country')) {
		Registry::set('settings.Company.company_country_descr', fn_get_country_name(Registry::get('settings.Company.company_country')));
	}
	if (Registry::get('settings.Company.company_state')) {
		Registry::set('settings.Company.company_state_descr', fn_get_state_name(Registry::get('settings.Company.company_state'), Registry::get('settings.Company.company_country')));
	}

	// Unset notification message by its id
	if (!empty($_REQUEST['close_notification'])) {
		unset($_SESSION['notifications'][$_REQUEST['close_notification']]);
		exit();
	}

	// Include user information
	fn_init_user();
}

// Third-level cache: different for dispatch-user-language-currency
define('CACHE_LEVEL_USER', $_SERVER['REQUEST_METHOD'] . '_' . str_replace('.', '_', $_REQUEST['dispatch']) . '.' . (!empty($_SESSION['auth']['membership_id']) ? $_SESSION['auth']['membership_id'] : 0) . '.' . (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '.' . CART_SECONDARY_CURRENCY);


// Set timezone
date_default_timezone_set(Registry::get('settings.Appearance.timezone'));

// Set root template
Registry::set('root_template', 'index.tpl');

if (defined('SKINS_PANEL')) {
	Registry::get('view')->assign('demo_skin', Registry::get('demo_skin'));
}

Registry::get('view')->assign('CARTSESSID', Session::get_id());

// URL's assignments
Registry::set('config.current_url', Registry::get('config.' . AREA_NAME . '_index') . ((!empty($_SERVER['QUERY_STRING'])) ? '?' . $_SERVER['QUERY_STRING'] : ''));

Registry::get('view')->assign('controller', CONTROLLER);
Registry::get('view')->assign('mode', MODE);
Registry::get('view')->assign('action', ACTION);
Registry::get('view')->assign('demo_username', Registry::get('config.demo_username'));
Registry::get('view')->assign('demo_password', Registry::get('config.demo_password'));
Registry::get('view')->assign('settings', Registry::get('settings'));
Registry::get('view')->assign('addons', Registry::get('addons'));
Registry::get('view')->assign('config', Registry::get('config'));
Registry::get('view')->assign('_REQUEST', $_REQUEST); // we need escape the request array too (access via $smarty.request in template)
Registry::get('view')->assign('SESS_ID', Session::get_id());

// FIXME: this variable already set in fn_statistics_init_area! do we need that?
/*if (AREA == 'A') {
	Registry::get('view')->assign('users_online', @$users_online);
 }*/

// Mail template assignments
Registry::get('view_mail')->assign('addons', Registry::get('addons'));
Registry::get('view_mail')->assign('settings', Registry::get('settings'));
Registry::get('view_mail')->assign('config', Registry::get('config'));

// init content search
fn_init_search();

?>
