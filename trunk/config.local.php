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
// $Id: config.local.php 7636 2009-06-30 07:03:06Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

/*
 * PHP options
 */

// Disable notices displaying
error_reporting(E_ALL ^ E_NOTICE);

// Set maximum memory limit
@ini_set('memory_limit', '48M');

// Set maximum time limit for script execution
@set_time_limit(3600);

/*
 * Database connection options
 */
$config['db_host'] = 'localhost';
$config['db_name'] = 'cscart';
$config['db_user'] = 'root';
$config['db_password'] = '123456';
$config['db_type'] = 'mysql';

/*
 * Script location options
 *
 *	Example:
 *	Your url is http://www.yourcompany.com/store/cart
 *	$config['http_host'] = 'www.yourcompany.com';
 *	$config['http_path'] = '/store/cart';
 * 
 *	Your secure url is https://secure.yourcompany.com/secure_dir/cart
 *	$config['https_host'] = 'secure.yourcompany.com';
 *	$config['https_path'] = '/secure_dir/cart';
 *
 */

// Host and directory where software is installed on no-secure server
$config['http_host'] = 'localhost';
$config['http_path'] = '/shop';

// Host and directory where software is installed on secure server
$config['https_host'] = 'localhost';
$config['https_path'] = '/shop';

/*
 * Misc options
 */
// Names of index files for administrative and customer areas
$config['admin_index'] = 'admin.php';
$config['customer_index'] = 'index.php';

// DEMO mode
$config['demo_mode'] = false;

// Tweaks
$config['tweaks'] = array (
	'js_compression' => false, // enables compession to reduce size of javascript files
	'check_templates' => true, // disables templates checking to improve template engine speed
	'inline_compilation' => true, // compiles nested templates in one file
);

// Key for sensitive data encryption
$config['crypt_key'] = '123';

// Developer configuration file
if (file_exists(DIR_ROOT . '/local_conf.php')) {
	include(DIR_ROOT . '/local_conf.php');
}

define('AUTH_CODE', '2MDM5ZJI');

?>
