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
// $Id: install.php 7636 2009-06-30 07:03:06Z zeke $
//
if ( !defined('AREA') ) { die('Access denied'); }

define('REQUIRED_PHP_VERSION', '5.1.0');
define('OK_MSG', 'OK');
define('FAIL_MSG', 'FAIL');
define('DB_RECONNECT', '1000');
define('BASE_SKIN', 'basic');

set_time_limit(3600);
@ini_set('memory_limit', '64M');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');

session_start();

$error_msg = $warning_msg = '';
$can_continue = true;

include(DIR_ROOT . '/config.php');
						   
$d_type = (empty($_REQUEST['new_db_type']) ? $config['db_type'] : $_REQUEST['new_db_type']);
include(DIR_CORE . 'db/' . $d_type . '.php');
include(DIR_CORE . 'fn.database.php');
include(DIR_CORE . 'fn.fs.php');
include(DIR_CORE . 'fn.common.php');
include(DIR_CORE . 'class.registry.php');

define('DIR_INSTALL', DIR_ROOT . '/install/');

if (empty($_SESSION['sl'])) {
	$_SESSION['sl'] = 'en';
}

$installation_languages = fn_get_install_langs('install');

if (!empty($_REQUEST['sl']) && !empty($installation_languages[$_REQUEST['sl']])) {
	$_SESSION['sl'] = $_REQUEST['sl'];
}

$mode = empty($_REQUEST['mode']) ? 'license' : $_REQUEST['mode'];

$auth_code = empty($_REQUEST['auth_code']) ? (empty($_SESSION['auth_code']) ? '' : $_SESSION['auth_code']) : $_REQUEST['auth_code'];

if (!empty($auth_code)) {
	$_SESSION['auth_code'] = $auth_code;
}

if ($mode != 'license' && AUTH_CODE != '' && $auth_code != AUTH_CODE) {
	fn_error_msg(tr('text_auth_code_invalid'), $can_continue, $error_msg);
	$mode = 'license';
	$next_mode = 'requirements';
	$can_continue = true; // enable "next" button
	return;
}

if ($mode != 'install_db') { // reset parsed files cache
	$_SESSION['parse_sql'] = array();
}

// Show php information
if ($mode == 'phpinfo') {
	phpinfo();
	exit;

// Install database data
} elseif ($mode == 'install_db') {

	db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
	fn_start_scroller_i();


	if (empty($_REQUEST['no_checking'])) {
		$_SESSION['langs'] = array();
		$tables_exist = db_get_array("SHOW TABLES LIKE '" . TABLE_PREFIX . "%'");
		if (!empty($tables_exist)) {

			$al = '';
			if (!empty($_REQUEST['additional_languages'])) {
				$al = 'additional_languages[]=' . implode('&additional_languages[]=', $_REQUEST['additional_languages']);
			}

			$_txt = addslashes(tr('text_db_has_tables'));
			echo <<<EOT
				<script language='javascript'>
				if (confirm('$_txt')) {
					location.replace("index.php?mode=install_db&no_checking=1&demo_catalog=$_REQUEST[demo_catalog]&admin_email=$_REQUEST[admin_email]&license_number=$_REQUEST[license_number]&$al");
				} else {
					history.go(-1);
				}
				</script>
EOT;
			exit;
		}
	}

	fn_parse_sql(DIR_INSTALL . 'database/scheme.sql', tr('creating_scheme'));
	fn_parse_sql(DIR_INSTALL . 'database/data.sql', tr('importing_data'));

	if (!empty($_REQUEST['demo_catalog']) && $_REQUEST['demo_catalog'] == 'Y') {
		fn_parse_sql(DIR_INSTALL . 'database/demo.sql', tr('text_creating_demo_catalog'));
	}

	if (!empty($_REQUEST['additional_languages']) && is_array($_REQUEST['additional_languages'])) {
		foreach ($_REQUEST['additional_languages'] as $lc) {
			$_lc = strtoupper($lc); // FIXME!!! Don't like this line :)
			if (empty($_SESSION['langs'][$lc])) {
				$db_descr_tables = db_get_fields("SHOW TABLES LIKE '%_descriptions'");
				$db_descr_tables[] = 'language_values';
				$db_descr_tables[] = 'product_features_values';

				foreach ($db_descr_tables as $table) {
					$table = str_replace(TABLE_PREFIX, '', $table);
					$fields_insert = $fields_select = fn_get_table_fields($table);
					$k = array_search('lang_code', $fields_select);
					$fields_select[$k] = db_quote("?s as lang_code", $_lc);
					db_query("REPLACE INTO ?:$table (" . implode(', ', $fields_insert) . ") SELECT " . implode(', ', $fields_select) . " FROM ?:$table WHERE lang_code = 'EN'");
				}

				$_SESSION['langs'][$lc] = true;
			}

			fn_parse_sql(DIR_INSTALL . "database/lang_{$lc}.sql", tr('text_installing_additional_language', $_lc));
		}
	}

	// Update root admin email
	db_query("UPDATE ?:users SET email = ?s WHERE user_id = 1", $_REQUEST['admin_email']);
	// Update company emails
	$company_emails = array (
		'company_users_department',
		'company_site_administrator',
		'company_orders_department',
		'company_support_department',
		'company_newsletter_email',
	);
	db_query("UPDATE ?:settings SET value = ?s WHERE option_name IN (?a)", $_REQUEST['admin_email'], $company_emails);

	// Update forms emails
	db_query("UPDATE ?:form_options SET value = ?s WHERE element_type = 'J'", $_REQUEST['admin_email']);

	// Update license number
	db_query("UPDATE ?:settings SET value = ?s WHERE option_name = 'license_number'", $_REQUEST['license_number']);

	fn_stop_scroller_i();
	fn_echo(tr('text_database_installed'));
	exit;

// Install skin
} elseif ($mode == 'install_skin') {	
	db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);

	fn_start_scroller_i();

	fn_install_skin($_REQUEST['new_skin_name'], $config);

	// Clean up caches
	fn_rm(DIR_ROOT . '/var/compiled');
	fn_rm(DIR_ROOT . '/var/cache');

	fn_stop_scroller_i();
	fn_echo(tr('text_skin_installed'));
	exit;

} elseif ($mode == 'license') {

	$next_mode = 'requirements';

// Checking requirements
} elseif ($mode == 'requirements') {

	$next_mode = 'settings';
	$error = false;

	// Checking php version
	$php_value = phpversion();
	$php_error = (version_compare($php_value, REQUIRED_PHP_VERSION)!=-1) ? false : true;
	$php_status = ($php_error == false) ? OK_MSG : FAIL_MSG;


	// Checking mysql support
	fn_check_db_support();
	$mysql_error = (IS_MYSQL|IS_MYSQLI) ? false : true;
	$mysql_value = ($mysql_error == false) ? 'ON' : 'OFF';
	$mysql_status = ($mysql_error == false) ? OK_MSG : FAIL_MSG;

	// Checking safe mode
	$safemode_error =  (fn_get_ini_param("safe_mode") == true) ? true : false;
	$safemode_value = ($safemode_error == false) ? 'OFF' : 'ON';
	$safemode_status = ($safemode_error == false) ? OK_MSG : FAIL_MSG;

	// File uploads
	$fileuploads_error = (fn_get_ini_param("file_uploads") == true) ? false : true;
	$fileuploads_value = ($fileuploads_error == false) ? 'ON' : 'OFF';
	$fileuploads_status = ($fileuploads_error == false) ? OK_MSG : FAIL_MSG;

	// Curl support
	$curl_error = (in_array('curl', get_loaded_extensions())) ? false : true;
	$curl_value = ($curl_error == false) ? 'ON' : 'OFF';
	$curl_status = ($curl_error == false) ? OK_MSG : FAIL_MSG;

	// Check for mod_securty enabled
	ob_start();
	phpinfo(INFO_MODULES);
	$_info = ob_get_contents();
	ob_end_clean();

	if (strpos($_info, 'mod_security') !== false) {
		fn_warning_msg(tr('text_mod_security'), $warning_msg);
	}
	
	if ($can_continue == true) {
		$can_continue = !($php_error | $mysql_error | $safemode_error | $fileuploads_error);
		if ($can_continue == false) {
			fn_error_msg(tr('text_settings_incorrect'), $can_continue, $error_msg);
		}
	}

// Select database/host permissions and check files permissions
} elseif ($mode == 'settings') {

	$next_mode = 'database';

	if ($config['http_host'] == '%HTTP_HOST%') {
		$config['http_host'] = $_SERVER['HTTP_HOST'];
		$_dname = str_replace('\\', '/', dirname($_SERVER['PHP_SELF']));
		$_dname = explode('/', $_dname);
		array_pop($_dname);
		$_dname = implode('/', $_dname);

		$config['http_path'] = ($_dname == '/') ? '' : $_dname;

		$config['https_host'] = $_SERVER['HTTP_HOST'];
		$config['https_path'] = ($_dname == '/') ? '' : $_dname;
		$config['db_host'] = 'localhost';
		$config['db_name'] = 'cart';
		$config['db_user'] = '';
		$config['db_password'] = '';
	}

	if (file_exists(DIR_ROOT . '/config.local.php')) {
		if (!is_writable(DIR_ROOT . '/config.local.php')) {
			fn_error_msg(tr('text_file_not_writable', 'config.local.php'), $can_continue, $error_msg);
		}
	} else {
		fn_error_msg(tr('text_file_not_exists', 'config.local.php'), $can_continue, $error_msg);
	}

	$languages = fn_get_install_langs('database');

	if (!(is_writable(DIR_ROOT . '/images')) ) {
		fn_error_msg(tr('text_directory_not_writable', DIR_ROOT . '/images'), $can_continue, $error_msg);
	}
	if (!(is_writable(DIR_ROOT . '/var')) ) {
		fn_error_msg(tr('text_directory_not_writable', DIR_ROOT . '/var'), $can_continue, $error_msg);
	}
	if (!is_writable(DIR_ROOT . '/skins')) {
		fn_error_msg(tr('text_directory_not_writable', DIR_ROOT . '/skins'), $can_continue, $error_msg);
	}

// Parse config file and installing the database
} elseif ($mode == 'database') {

	$next_mode = 'outlook';

	// Check database connection
	if (!$db_conn = driver_db_connect($_REQUEST['new_db_host'], $_REQUEST['new_db_user'], $_REQUEST['new_db_password'])) {
		fn_error_msg(tr('error_database_connect'), $can_continue, $error_msg);
	} elseif (!driver_db_select($_REQUEST['new_db_name'], true)) {
		if (!driver_db_create($_REQUEST['new_db_name'])) {
			fn_error_msg(tr('text_cant_create_database'), $can_continue, $error_msg);
		}
	}

	// Check if encryption key is not empty
	if (empty($_REQUEST['new_crypt_key'])) {
		fn_error_msg(tr('text_incorrect_secret_key'), $can_continue, $error_msg);
	}

	// Check if encryption key is not empty
	if (empty($_REQUEST['new_admin_email'])) {
		fn_error_msg(tr('text_incorrect_email'), $can_continue, $error_msg);
	}

	// Check files with database structure
	if ($can_continue == true) {
		if (file_exists(DIR_ROOT . '/install/database/scheme.sql')) {
			if (!is_readable(DIR_ROOT . '/install/database/scheme.sql')) {
				fn_error_msg(tr('text_file_not_readable', 'install/database/scheme.sql'), $can_continue, $error_msg);
			}
		} else {
			fn_error_msg(tr('text_file_not_exists', 'install/database/scheme.sql'), $can_continue, $error_msg);
		}
		if (file_exists(DIR_ROOT . '/install/database/data.sql')) {
			if (!is_readable(DIR_ROOT . '/install/database/data.sql')) {
				fn_error_msg(tr('text_file_not_readable', 'install/database/data.sql'), $can_continue, $error_msg);
			}
		} else {
			fn_error_msg(tr('text_file_not_exists', 'install/database/data.sql'), $can_continue, $error_msg);
		}
	}

	$adds = '';

	if (!empty($_REQUEST['demo_catalog']) && $_REQUEST['demo_catalog'] == "Y") {
		$adds = "&demo_catalog=Y";
	}
	if (!empty($_REQUEST['additional_languages']) && is_array($_REQUEST['additional_languages'])) {
		foreach ($_REQUEST['additional_languages'] as $lc) {
			$adds .= "&additional_languages[]=$lc";
		}
	}

	$adds .= "&admin_email=$_REQUEST[new_admin_email]";
	$adds .= "&license_number=$_REQUEST[new_license_number]";

	// Parse config file
	if ($can_continue == true) {
		$new_http_host = str_replace('\\', '/', $_REQUEST['new_http_host']);
		$new_https_host = str_replace('\\', '/', $_REQUEST['new_https_host']);
		$new_http_dir = str_replace('\\', '/', $_REQUEST['new_http_dir']);
		$new_https_dir = str_replace('\\', '/', $_REQUEST['new_https_dir']);

		$config_contents = file_get_contents(DIR_ROOT . '/config.local.php');
		if (!empty($config_contents)) {
			if (strstr($config_contents, '$config[\'db_host\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_host\'\] =.*;/mi', "\$config['db_host'] = '" . addslashes($_REQUEST['new_db_host']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_name\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_name\'\] =.*;/mi', "\$config['db_name'] = '" . addslashes($_REQUEST['new_db_name']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_user\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_user\'\] =.*;/mi', "\$config['db_user'] = '" . addslashes($_REQUEST['new_db_user']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_password\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_password\'\] =.*;/mi', "\$config['db_password'] = '" . addslashes($_REQUEST['new_db_password']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'http_host\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'http_host\'\] =.*;/mi', "\$config['http_host'] = '" . $new_http_host . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'https_host\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'https_host\'\] =.*;/mi', "\$config['https_host'] = '" . $new_https_host . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'http_path\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'http_path\'\] =.*;/mi', "\$config['http_path'] = '" . $new_http_dir . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'https_path\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'https_path\'\] =.*;/mi', "\$config['https_path'] = '" . $new_https_dir . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_type\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_type\'\] =.*;/mi', "\$config['db_type'] = '" . $_REQUEST['new_db_type'] . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'crypt_key\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'crypt_key\'\] =.*;/mi', "\$config['crypt_key'] = '" . $_REQUEST['new_crypt_key'] . "';", $config_contents);
			}

			if (file_put_contents(DIR_ROOT . '/config.local.php', $config_contents) == 0) {
				fn_error_msg(tr('text_file_not_writable', 'config.local.php'), $can_continue, $error_msg);
			}
		} else {
			fn_error_msg(tr('text_file_not_readable', 'config.local.php'), $can_continue, $error_msg);
		}
	}

// Select skin to install
} elseif ($mode == 'outlook') {

	$next_mode = 'skins';

	$skins = fn_get_dir_contents(DIR_INSTALL_SKINS, true);
	sort($skins);
	$skinset = array();
	$first_iteration = true;
	foreach ($skins as $v) {
		if (is_dir(DIR_INSTALL_SKINS . '/' . $v) && basename($v) != 'base') {
			$skinset[$v] = @parse_ini_file(DIR_INSTALL_SKINS . '/' . $v . '/' . SKIN_MANIFEST);
		}
	}

// Install skin
} elseif ($mode == 'skins') {

	$next_mode = 'summary';

	$new_skin_name = basename($_REQUEST['new_skin_name']);

	if (empty($new_skin_name)) {
		fn_error_msg(tr('text_select_skin'), $can_continue, $error_msg);
	}

// Summary page
} elseif ($mode == 'summary') {

	$config_contents = file_get_contents(DIR_ROOT . '/config.local.php');

	$acode = (AUTH_CODE == '') ? fn_generate_auth_code() : AUTH_CODE;

	$config_contents = preg_replace("/define\('AUTH_CODE',.*\);/i", "define('AUTH_CODE', '$acode');", $config_contents);
	if (file_put_contents(DIR_ROOT . '/config.local.php', $config_contents) == 0) {
		fn_error_msg(tr('text_file_not_writable', 'config.local.php'), $can_continue, $error_msg);
	}
}


// ------------------------ functions definitions --------------------------------

function fn_error_msg($msg, &$can_continue, &$error_msg)
{
	$can_continue = false;
	$error_msg = (!empty($error_msg)) ? $error_msg . '<br /><br />' . $msg : $msg;
}

function fn_warning_msg($msg, &$warning_msg)
{
	$warning_msg = (!empty($warning_msg)) ? $warning_msg . '<br /><br />' . $msg : $msg;
}

function fn_parse_sql($filename, $title)
{
	$title_shown = false;

	$fd = fopen($filename, 'r');
	if ($fd) {
		$_sess_name = basename($filename);
		if (!empty($_SESSION['parse_sql'][$_sess_name])) {
			if ($_SESSION['parse_sql'][$_sess_name] == 'COMPLETED') {
				fclose($fd);
				return true;
			}
			fseek($fd, $_SESSION['parse_sql'][$_sess_name]);
		}

		$rest = '';
		$ret = array();
		$counter = 0;
		while (!feof($fd)) {
			$str = $rest.fread($fd, 16384);
			$rest = fn_parse_queries($ret, $str);

			if (!empty($ret)) {
				if ($title_shown == false) {
					fn_echo($title);
					$title_shown = true;
				}

				foreach ($ret as $query) {
					$counter ++;
					if (strpos($query, 'CREATE TABLE')!==false) {
						preg_match("/" . TABLE_PREFIX . "\w*/i", $query, $matches);
						$table_name = $matches[0];
						fn_echo(tr('text_creating_table', $table_name));

					} else {
						if ($counter > 30) {
							fn_echo(' .');
							$counter = 0;
						}
					}
					db_query($query);

				}
				$ret = array();
			}

			// Break the connection and re-request
			if (time() - TIME > INSTALL_DB_EXECUTION) {
				$pos = ftell($fd);
				$pos = $pos - strlen($rest);
				fclose($fd);
				$_SESSION['parse_sql'][$_sess_name] = $pos;
				$location = $_SERVER['REQUEST_URI'] . '&no_checking=1';
				fn_echo("<meta http-equiv=\"Refresh\" content=\"0;URL=$location\" />");
				die;
			}
		}
		fclose($fd);
		$_SESSION['parse_sql'][$_sess_name] = 'COMPLETED';
		return true;
	}
}

// Start javascript autoscroller
function fn_start_scroller_i()
{
	fn_echo("
		<script language='javascript'>
		parent.document.getElementById('nextbut').disabled = true;
		loaded = false;
		function refresh() {
			window.scroll(0, 99999);
			if (loaded == false) {
				setTimeout('refresh()', 1000);
			}
		}
		setTimeout('refresh()', 1000);
		</script>
	");
}

// Stop javascript autoscroller
function fn_stop_scroller_i()
{
	fn_echo("
	<script language='javascript'>
		loaded = true;
		parent.document.getElementById('nextbut').disabled = false;
	</script>
	");
}

function fn_generate_auth_code()
{
	return strtoupper(substr(base64_encode(uniqid(time())), -9, 8));
}

function fn_check_db_support()
{
	$exts  = get_loaded_extensions();
	define('IS_MYSQL', in_array('mysql', $exts));
	define('IS_MYSQLI', in_array('mysqli', $exts));
}

function fn_install_skin($skin_name, $config, $for_admin = false)
{
	if (!file_exists(DIR_INSTALL_SKINS . '/' . $skin_name . '/' . SKIN_MANIFEST)) {
		die(tr('text_manifest_not_found', "var/skins_repository/$skin_name"));
	}

	$skin_data = parse_ini_file(DIR_INSTALL_SKINS . '/' . $skin_name . '/' . SKIN_MANIFEST);
	$from_skin = db_get_field("SELECT value FROM ?:settings WHERE option_name = 'skin_name_customer'");

	if ($for_admin == true) {
		db_query("UPDATE ?:settings SET value = ?s WHERE option_name LIKE 'skin_name_admin'", $skin_name);
	} else {
		db_query("UPDATE ?:settings SET value = ?s WHERE option_name LIKE 'skin_name_%'", $skin_name);
	}

	// Install base templates
	fn_echo(tr('text_installing_customer_base_templates'));
	if (fn_copy(DIR_INSTALL_SKINS . '/base/customer', DIR_SKINS . $skin_name . '/customer', false) == false) {
		die(tr('text_copy_error', 'var/skins_repository/base/customer'));
	} elseif (!empty($from_skin) && $from_skin != 'base' && is_dir(DIR_SKINS . $from_skin)) {
		// Copy block locations for customer skin from the current skin
		fn_copy(DIR_SKINS . $from_skin . '/customer/blocks/locations', DIR_SKINS . $skin_name . '/customer/blocks/locations', false);

		// copy from addons
		foreach (Registry::get('addons') as $addon => $_v) {
			if (is_dir(DIR_SKINS . $from_skin . '/customer/addons/' . $addon . '/blocks/locations')) {
				fn_copy(DIR_SKINS . $from_skin . '/customer/addons/' . $addon . '/blocks/locations', DIR_SKINS . $skin_name . '/customer/addons/' . $addon . '/blocks/locations', false);
			}
		}
		
	}

	// Install base mail templates
	fn_echo(tr('text_installing_mail_base_templates'));
	if (fn_copy(DIR_INSTALL_SKINS . '/base/mail', DIR_SKINS . $skin_name . '/mail', false) == false) {
		die(tr('text_copy_error', 'var/skins_repository/base/mail'));
	}

	// Install base admin templates if needed
	if (!empty($skin_data['admin']) && $skin_data['admin'] == 'Y') {
		fn_echo(tr('text_installing_mail_base_templates'));
		if (fn_copy(DIR_INSTALL_SKINS . '/base/admin', DIR_SKINS . $skin_name . '/admin', false) == false) {
			die(tr('text_copy_error', 'var/skins_repository/base/admin'));
		}
	}

	// Install scheme
	fn_echo(tr('text_installing_scheme'));
	if (fn_copy(DIR_INSTALL_SKINS . '/' . $skin_name . '/customer', DIR_SKINS . $skin_name . '/customer', false) == false) {
		die(tr('text_copy_error', "var/skins_repository/$skin_name/customer"));
	}

	if (is_dir(DIR_INSTALL_SKINS . '/' . $skin_name . '/mail')) {
		if (fn_copy(DIR_INSTALL_SKINS . '/' . $skin_name . '/mail', DIR_SKINS . $skin_name . '/mail', false) == false) {
			die(tr('text_copy_error', "var/skins_repository/$skin_name/mail"));
		}
	}

	if (!empty($skin_data['admin']) && $skin_data['admin'] == 'Y') {
		if (fn_copy(DIR_INSTALL_SKINS . '/' . $skin_name . '/admin', DIR_SKINS . $skin_name . '/admin', false) == false) {
			die(tr('text_copy_error', "var/skins_repository/$skin_name/admin"));
		}
	} else {
		// Install default blue scheme if the skin doesn't have the admin zone
		fn_install_skin(BASE_SKIN, $config, true);
	}

	// Install manifest
	fn_copy(DIR_INSTALL_SKINS . '/' . $skin_name . '/' . SKIN_MANIFEST, DIR_SKINS . $skin_name . '/', false);
}

function tr()
{
	static $texts = array();

	$args = func_get_args();
	$text = array_shift($args);

	if (empty($texts)) {
		$texts = parse_ini_file(DIR_INSTALL . 'lang/' . $_SESSION['sl'] . '.ini');
	}

	$_t = $text;

	$text = htmlspecialchars_decode($texts[$text]);

	if (!empty($args)) {
		if (preg_match_all("/(\[\?\])+/", $text, $m)) {
			$offset = 0;
			foreach ($m[0] as $k => $ph) {
				$text = tr_str_replace($ph, $args[$k], $text, $offset);
			}
		}
	}

	return $text;
}

function tr_str_replace($needle, $replacement, $subject, &$offset)
{
	$pos = strpos($subject, $needle, $offset);

	$offset = $pos + strlen($replacement);
	return substr_replace($subject, $replacement, $pos, 3);
}

function fn_get_install_langs($type = 'install')
{
	$languages = array();

	if ($type == 'install') {
		$files = fn_get_dir_contents(DIR_INSTALL . 'lang', false, true);
		if (!empty($files)) {
			foreach ($files as $file) {
				$lang = str_replace('.ini', '', $file);
				$languages[$lang] = tr('lang_' . $lang);
			}
		}
	} else {
		$files = fn_get_dir_contents(DIR_INSTALL . 'database', false, true);
		if (!empty($files)) {
			foreach ($files as $file) {
				if (strpos($file, 'lang_') !== false) {
					$lang = str_replace(array('lang_', '.sql'), '', $file);
					$languages[$lang] = tr('lang_' . $lang);
				}
			}
		}
	}

	return $languages;
}

function fn_print()
{
	static $count = 0;
	$args = func_get_args();

	if (!empty($args)) {
		echo "<div align='left' style='font-family: Courier; font-size: 13px;'><pre>";
		foreach ($args as $k => $v) {
			echo "<strong>Debug [$k/$count]:</strong>";
			echo htmlspecialchars(print_r($v, true) . "\n");
		}
		echo "</pre></div>";
	}
	$count++;
}

// Plug to logger
function fn_log_event()
{
	return true;
}

?>
