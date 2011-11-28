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
// $Id: fn.control.php 7822 2009-08-14 06:57:34Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

define('GET_CONTROLLERS', 1);
define('GET_PRE_CONTROLLERS', 2);
define('GET_POST_CONTROLLERS', 3);

/**
 * Set hook to use by addons
 *
 * @param mixed $argN argument, passed to addon
 * @return boolean always true
 */
function fn_set_hook($arg0 = NULL, &$arg1 = NULL, &$arg2 = NULL, &$arg3 = NULL, &$arg4 = NULL, &$arg5 = NULL, &$arg6 = NULL, &$arg7 = NULL, &$arg8 = NULL, &$arg9 = NULL, &$arg10 = NULL, &$arg11 = NULL, &$arg12 = NULL, &$arg13 = NULL, &$arg14 = NULL, &$arg15 = NULL)
{
	$hooks = Registry::get('hooks');
	static $loaded_addons;
	static $callable_functions;
	static $hooks_already_sorted;

	for ($args = array(), $i = 0; $i < 10; $i++) {
		$name = 'arg' . $i;
		if ($i < func_num_args()) {
			$args[$i] = &$$name;
		}
		unset($$name, $name);
	}

	$hook_name = array_shift($args);

	if (isset($hooks[$hook_name])) {

		// cache hooks sorting
		if (!isset($hooks_already_sorted[$hook_name])) {
			$hooks[$hook_name] = fn_sort_array_by_key($hooks[$hook_name], 'priority');
			$hooks_already_sorted[$hook_name] = true;
		}

		foreach ($hooks[$hook_name] as $callback) {

			//cache loaded addon
			if (!isset($loaded_addons[$callback['addon']])) { // FIXME: duplicate with cache in fn_load_addon
				fn_load_addon($callback['addon']);
				$loaded_addons[$callback['addon']] = true;
			}

			// cache if hook function callable
			if (!isset($callable_functions[$callback['func']])) {
				if (!is_callable($callback['func'])) {
					die("Hook $callback[func] is not callable");
				}
				$callable_functions[$callback['func']] = true;
			}

			call_user_func_array($callback['func'], $args);
		}
	}

	return true;
}


/**
 * Register hooks addon uses
 *
 * @return boolean always true
 */
function fn_register_hooks()
{
	$hooks = & Registry::get('hooks');

	$args = func_get_args();
	$backtrace = debug_backtrace();

	$addon_path = fn_unified_path($backtrace[0]['file']);
	if (strpos($addon_path, DIR_ADDONS) !== false) {
		$path_dirs = explode('/', substr($addon_path, strlen(DIR_ADDONS)));
		$addon_name = array_shift($path_dirs);
	} else {
		die("Hooks can be only registered by addons: $addon_path is not addon path ");
	}

	foreach ($args as &$hook) {
		$priority = 0;

		// if we get array we need to set priority manually
		if(is_array($hook)) {
			$priority = $hook[1];
			$hook = $hook[0];
		}

		$callback = 'fn_' . $addon_name . '_' . $hook;

		if (!isset($hooks[$hook])) {
			$hooks[$hook] = Array();
		}

		$hooks[$hook][] = array('func' => $callback, 'addon' => $addon_name, 'priority' => $priority);
	}

	return true;
}

/**
 * Initialize all enabled addons
 *
 * @return boolean always true
 */
function fn_init_addons()
{
	Registry::register_cache('addons', array('addons'), CACHE_LEVEL_STATIC);

	// Get settings
	if (Registry::is_exist('addons') == false) {
		$_addons = db_get_hash_array("SELECT addon, IF(status = 'A',options,'') as options, status FROM ?:addons ORDER BY priority", 'addon');
		foreach ($_addons as $k => $v) {
			$_addons[$k] = ($v['status'] == 'A') ? fn_parse_addon_options($v['options']) : array();
			$_addons[$k]['status'] = $v['status'];
		}
		Registry::set('addons',  $_addons);
	}

	foreach	((array)Registry::get('addons') as $addon_name => $data) {
		if ($data['status'] == 'A') {
			if (is_file(DIR_ADDONS . $addon_name . '/init.php')) {
				include(DIR_ADDONS . $addon_name . '/init.php');
			}
		}
	}

	return true;
}

/**
 * Load addon
 *
 * @param string $addon_name addon name
 * @return boolean true if addon loaded, false otherwise
 */
function fn_load_addon($addon_name)
{
	static $cache = array(); // FIXME: duplicate with fn_set_hook

	if (!isset($cache[$addon_name])) {
		if (Registry::get("addons.$addon_name.status") === 'D') {
			$cache[$addon_name] = false;
			return false;
		}

		if (file_exists(DIR_ADDONS . $addon_name . '/func.php')) {
			include(DIR_ADDONS . $addon_name . '/func.php');
		}
		if (file_exists(DIR_ADDONS . $addon_name . '/config.php')) {
			include(DIR_ADDONS . $addon_name . '/config.php');
		}
		$cache[$addon_name] = true;
	}

	return $cache[$addon_name];
}

/**
 * Gets list of secure controllers which use https connection
 *
 * @return array list of secure controllers
 */
function fn_get_secure_controllers()
{
	$secure_controllers = array(
		'payment_notification' => 'passive',
		'pages' => 'passive',
		'image' => 'passive',
	);

	if (Registry::get('settings.General.secure_auth') == 'Y') {
		$secure_controllers = array_merge($secure_controllers, array(
			'auth' => 'active',
			'orders' => 'active',
			'profiles' => 'active',
		));
	}

	if (Registry::get('settings.General.secure_checkout') == 'Y') {
		$secure_controllers = array_merge($secure_controllers, array(
			'checkout' => 'active',
		));
	}

	fn_set_hook('init_secure_controllers', $secure_controllers);

	return $secure_controllers;
}

/**
 * Dispathes the execution control to correct controller
 *
 * @return nothing
 */
function fn_dispatch()
{
	Profiler::checkpoint('After init');

	$regexp = "/^[a-zA-Z0-9_\+]+$/";
	$view = & Registry::get('view');
	$run_controllers = true;

	//If $config['http_host'] was different from the domain name, there was redirection to $config['http_host'] value.
	if ((defined('HTTPS') ? Registry::get('config.https_host') : Registry::get('config.http_host')) != REAL_HOST && $_SERVER['REQUEST_METHOD'] == 'GET' && !defined('CONSOLE')) {
		fn_redirect((defined('HTTPS') ? Registry::get('config.https_location') : Registry::get('config.http_location')) . '/' . Registry::get('config.current_url'));
	}

	if (!preg_match($regexp, CONTROLLER)) {
		die('Invalid controller name');
	}

	if (!preg_match($regexp, MODE)) {
		die('Invalid mode');
	}

	// If demo mode is enabled, check permissions FIX ME - why did we need one more user login check?
	if (AREA == 'A') {
		if (Registry::get('config.demo_mode') == true) {
			$run_controllers = fn_check_permissions(CONTROLLER, MODE, 'demo');

			if ($run_controllers == false) {
				fn_set_notification('W', fn_get_lang_var('demo_mode'), fn_get_lang_var('demo_mode_content_text'));
				if (defined('AJAX_REQUEST')) {
					exit;
				}
				$status = CONTROLLER_STATUS_REDIRECT;
				$_REQUEST['redirect_url'] = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : INDEX_SCRIPT;
			}

		} elseif (!empty($_SESSION['auth']['membership_id'])) {
			$run_controllers = fn_check_permissions(CONTROLLER, MODE, 'admin');
			if ($run_controllers == false) {
				$status = CONTROLLER_STATUS_DENIED;
			}
		}
	}

	// Check if request was rewritten and not handled
	// In this case this means that request was incorrect
	if (isset($_REQUEST['sef_rewrite'])) {
		$status = CONTROLLER_STATUS_NO_PAGE;
		$run_controllers = false;
	}


	if (AREA == 'A' && (Registry::get('settings.General.secure_admin') == 'Y')  && !defined('HTTPS') && ($_SERVER['REQUEST_METHOD'] != 'POST') && !defined('AJAX_REQUEST') && empty($_REQUEST['keep_location'])) {
		fn_redirect(Registry::get('config.https_location') . '/' . Registry::get('config.current_url'));
	} elseif (AREA == 'C' && $_SERVER['REQUEST_METHOD'] != 'POST' && !defined('AJAX_REQUEST')) {
		$secure_controllers = fn_get_secure_controllers();
		// if we are not on https but controller is secure, redirect to https
		if (isset($secure_controllers[CONTROLLER]) && $secure_controllers[CONTROLLER] == 'active' && !defined('HTTPS')) {
			fn_redirect(Registry::get('config.https_location') . '/' . Registry::get('config.current_url'));
		}

		// if we are on https and the controller is insecure, redirect to http
		if (!isset($secure_controllers[CONTROLLER]) && defined('HTTPS')) {
			fn_redirect(Registry::get('config.http_location') . '/' . Registry::get('config.current_url'));
		}
	}

	if ($run_controllers == true) {
		$controllers_cascade = array();
		foreach (array('init', CONTROLLER) as $ctrl) {
			$core_controllers = fn_init_core_controllers($ctrl);
			list($addon_controllers) = fn_init_addon_controllers($ctrl);

			if (empty($core_controllers) && empty($addon_controllers)) {
				$controllers_cascade = array();
				$status = CONTROLLER_STATUS_NO_PAGE;
				break;
			}

			if ((count($core_controllers) + count($addon_controllers)) > 1) {
				die('Duplicate controller ' . CONTROLLER . fn_print_r(array_merge($core_controllers, $addon_controllers), 1));
			}

			$core_pre_controllers = fn_init_core_controllers($ctrl, GET_PRE_CONTROLLERS);
			$core_post_controllers = fn_init_core_controllers($ctrl, GET_POST_CONTROLLERS);

			list($addon_pre_controllers) = fn_init_addon_controllers($ctrl, GET_PRE_CONTROLLERS);
			list($addon_post_controllers, $addons) = fn_init_addon_controllers($ctrl, GET_POST_CONTROLLERS);

			// we put addon post-controller to the top of post-controller cascade if current addon serves this request
			if(count($addon_controllers)) {
				$addon_post_controllers = fn_reorder_post_controllers($addon_post_controllers, $addon_controllers[0]);
			}

			$controllers_cascade = array_merge($controllers_cascade, $addon_pre_controllers, $core_pre_controllers, $core_controllers, $addon_controllers, $core_post_controllers, $addon_post_controllers);

			if (empty($controllers_cascade)) {
				die("No controllers for: $controller");
			}
		}

		if (MODE == 'add') {
			$tpl = 'update.tpl';
		} elseif (strpos(MODE, 'add_') === 0) {
			$tpl = str_replace('add_', 'update_', MODE) . '.tpl';
		} else {
			$tpl = MODE . '.tpl';
		}

		$view = & Registry::get('view');
		if ($view->template_exists('views/' . CONTROLLER . '/' . $tpl)) { // try to find template in base views
			$view->assign('content_tpl', 'views/' . CONTROLLER . '/' . $tpl);
		} elseif (defined('LOADED_ADDON_PATH') && $view->template_exists('addons/' . LOADED_ADDON_PATH . '/views/' . CONTROLLER . '/' . $tpl)) { // try to find template in addon views
			$view->assign('content_tpl', 'addons/' . LOADED_ADDON_PATH . '/views/' . CONTROLLER . '/' . $tpl);
		} elseif (!empty($addons)) { // try to find template in addon views that extend base views
			foreach ($addons as $addon => $_v) {
				if ($view->template_exists('addons/' . $addon . '/views/' . CONTROLLER . '/' . $tpl)) {
					$view->assign('content_tpl', 'addons/' . $addon . '/views/' . CONTROLLER . '/' . $tpl);
					break;
				}
			}
		}

		foreach ($controllers_cascade as $item) {
			$_res = fn_run_controller($item); // 0 - status, 1 - url

			$external = !empty($_res[2]) ? $_res[2] : false;
			$url = !empty($_res[1]) ? $_res[1] : '';
			$status = !empty($_res[0]) ? $_res[0] : CONTROLLER_STATUS_OK;

			if ($status == CONTROLLER_STATUS_OK && !empty($url)) {
				$redirect_url = $url;
			} elseif ($status == CONTROLLER_STATUS_REDIRECT && !empty($url)) {
				$redirect_url = $url;
				break;
			} elseif ($status == CONTROLLER_STATUS_DENIED || $status == CONTROLLER_STATUS_NO_PAGE) {
				break;
			}
		}
	}

	// In console mode, just stop here
	if (defined('CONSOLE')) {
		exit;
	}

	// Redirect if controller returned successful/redirect status only
	if (in_array($status, array(CONTROLLER_STATUS_OK, CONTROLLER_STATUS_REDIRECT)) && !empty($_REQUEST['redirect_url'])) {
		$redirect_url = $_REQUEST['redirect_url'];
	}

	// If controller returns "Redirect" status, check if redirect url exists
	if ($status == CONTROLLER_STATUS_REDIRECT && empty($redirect_url)) {
		$status = CONTROLLER_STATUS_NO_PAGE;
	}

	// Attach params and redirect if needed
	if (in_array($status, array(CONTROLLER_STATUS_OK, CONTROLLER_STATUS_REDIRECT)) && !empty($redirect_url)) {
		$params = array (
			'page',
			'selected_section',
		);

		if (strpos($redirect_url, '?') !== false) {
			foreach ($params as $param) {
				if (!empty($_REQUEST[$param])) {
					$redirect_url .= "&$param=" . $_REQUEST[$param];
				}
			}
		}

		if (!isset($external)) {
			$external = false;
		}

		fn_redirect($redirect_url, false, $external);
	}

	if (!$view->get_var('content_tpl') && $status == CONTROLLER_STATUS_OK) { // FIXME
		$status = CONTROLLER_STATUS_NO_PAGE;
	}

	if ($status != CONTROLLER_STATUS_OK) {

		if ($status == CONTROLLER_STATUS_NO_PAGE) {
			header(' ', true, 404);
		}
		$view->assign('exception_status', $status);
		$view->assign('content_tpl', 'exception.tpl');
		if ($status == CONTROLLER_STATUS_DENIED) {
			$view->assign('page_title', fn_get_lang_var('access_denied'));
		} elseif ($status == CONTROLLER_STATUS_NO_PAGE) {
			$view->assign('page_title', fn_get_lang_var('page_not_found'));
		}
		if (AREA != 'A') {
			Registry::set('root_template', 'exception.tpl');
		}
	}

	Profiler::checkpoint('Before TPL');
	Registry::get('view')->display(Registry::get('root_template'));
	Profiler::checkpoint('After TPL');
	//Profiler::display(true);
	exit; // stop execution
}

/**
 * Puts the addon post-controller to the top of post-controllers cascade if current addon serves this request
 *
 * @param array $addon_post_controllers post controllers from addons
 * @param array $current_controller current controllers list
 * @return array controllers list
 */
function fn_reorder_post_controllers($addon_post_controllers, $current_controller)
{
	if (empty($addon_post_controllers) || empty($current_controller)) {
		return $addon_post_controllers;
	}

	// get addon name from the path like /var/www/html/cart/addons/addon/controllers/admin/addon.php
	$part = substr($current_controller, strlen(DIR_ADDONS));
	// we have addon/controllers/admin/addon.php  in $part
	$addon_name = substr($part, 0, strpos($part, '/'));

	// we search post-controller of the addon that owns active controller of current request
	// and if we find it we put this post-controller to the top of the cascade
	foreach($addon_post_controllers as $k => $post_controller) {
		if(strpos($post_controller, DIR_ADDONS . $post_controller) !== false) {
			// delete in current place..
			unset($addon_post_controllers[$k]);
			// and put at the beginning
			array_unshift($addon_post_controllers, $post_controller);
			break; // only one post controller can be here
		}
	}

	return $addon_post_controllers;
}

/**
 * Runs specified controller by including its file
 *
 * @param string $path path to controller
 * @return array controller return status
 */
function fn_run_controller($path)
{
	$auth = & $_SESSION['auth'];

	$controller = CONTROLLER;
	$mode = MODE;
	$action = ACTION;
	$dispatch_extra = DISPATCH_EXTRA;
	$index_script = INDEX_SCRIPT;

	$ajax = & Registry::get('ajax');
	$view = & Registry::get('view');
	$view_mail = & Registry::get('view_mail');

	return include($path);
}

/**
 * Generates list of core (pre/post)controllers
 *
 * @param string $controller controller name
 * @param string $type controller type (pre/post)
 * @return array controllers list
 */
function fn_init_core_controllers($controller, $type = GET_CONTROLLERS)
{
	$controllers = array();

	$prefix = '';

	if ($type == GET_POST_CONTROLLERS) {
		$prefix = '.post';
	} elseif ($type == GET_PRE_CONTROLLERS) {
		$prefix = '.pre';
	}

	// try to find area-specific controller
	if (is_readable(DIR_ROOT . '/controllers/' . AREA_NAME . '/' . $controller . $prefix . '.php')) {
		$controllers[] = DIR_ROOT . '/controllers/' . AREA_NAME . '/' . $controller . $prefix . '.php';
	}

	// try to find common controller
	if (is_readable(DIR_ROOT . '/controllers/common/' . $controller . $prefix . '.php')) {
		$controllers[] = DIR_ROOT . '/controllers/common/' . $controller . $prefix . '.php';
	}

	return $controllers;
}

/**
 * Generates list of (pre/post)controllers from active addons
 *
 * @param string $controller controller name
 * @param string $type controller type (pre/post)
 * @return array controllers list and active addons
 */
function fn_init_addon_controllers($controller, $type = GET_CONTROLLERS)
{
	$controllers = array();
	static $addons = array();
	$prefix = '';

	if($type == GET_POST_CONTROLLERS) {
		$prefix = '.post';
	} elseif ($type == GET_PRE_CONTROLLERS) {
		$prefix = '.pre';
	}

	foreach	((array)Registry::get('addons') as $addon_name => $data) {
		if (fn_load_addon($addon_name) == true) {

			// try to find area-specific controller
			$dir = DIR_ADDONS . $addon_name . '/controllers/' . AREA_NAME . '/';
			if (is_readable($dir . $controller . $prefix . '.php')) {
				$controllers[] = $dir . $controller . $prefix . '.php';
				$addons[$addon_name] = true;
				if (empty($prefix)) {
					fn_define('LOADED_ADDON_PATH', $addon_name);
				}
			}

			// try to find common controller
			$dir = DIR_ADDONS . $addon_name . '/controllers/common/';
			if (is_readable($dir . $controller . $prefix . '.php')) {
				$controllers[] = $dir . $controller . $prefix . '.php';
				$addons[$addon_name] = true;
				if (empty($prefix)) {
					fn_define('LOADED_ADDON_PATH', $addon_name);
				}
			}
		}
	}

	return array($controllers, $addons);
}

/**
 * Looks for "dispatch" parameter in REQUEST array and extracts controller, mode, action and extra parameters.
 *
 * @return boolean always true
 */
function fn_get_route()
{
	fn_set_hook('get_route', $_REQUEST);

	// if "dispatch" is empty, set to default
	if (empty($_REQUEST['dispatch'])) {
		$_REQUEST['dispatch'] = 'index.index';
	}

	$request = is_array($_REQUEST['dispatch']) ? key($_REQUEST['dispatch']) : $_REQUEST['dispatch'];

	rtrim($request, '/');
	rtrim($request, '.');
	$request = str_replace('/', '.', $request);

	@list($c, $m, $a, $e) = explode('.', $request);

	define('CONTROLLER', empty($c) ? 'index' : $c);
	define('MODE', empty($m) ? 'index' : $m);
	define('ACTION', $a);
	define('DISPATCH_EXTRA', $e);

	$_REQUEST['dispatch'] = $request;

	return true;
}

/**
 * Parse addon options
 *
 * @param string $options serialized options
 * @return array parsed options list
 */
function fn_parse_addon_options($options)
{
	$options = unserialize($options);
	if (!empty($options)) {
		foreach ($options as $k => $v) {
			if (strpos($v, '#M#') === 0) {
				parse_str(str_replace('#M#', '', $v), $options[$k]);
			}
		}
	}

	return $options;
}

?>