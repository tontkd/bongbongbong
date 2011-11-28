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
// $Id: config.php 7857 2009-08-18 08:57:20Z zeke $
//


if ( !defined('AREA') ) { die('Access denied'); }

/*
 * Static options
 */

// These constants define when select box with categories list should be replaced with picker
define('CATEGORY_THRESHOLD', 100); // if number of categories less than this value, all categories will be retrieved, otherwise subcategories will be retrieved by ajax
define('CATEGORY_SHOW_ALL', 100);  // if number of categories less than this value, categories tree will be expanded

// These constants define when select box with pages list should be replaced with picker
define('PAGE_THRESHOLD', 2); // if number of pages less than this value, all pages will be retrieved, otherwise subpages will be retrieved by ajax 
define('PAGE_SHOW_ALL', 100); // if number of pages less than this value, pages tree will be expanded

// Maximum number of recently viewed products, stored in session
define('MAX_RECENTLY_VIEWED', 10);

// Filesystem paths
define('DIR_CORE', DIR_ROOT . '/core/');
define('DIR_LIB', DIR_ROOT . '/lib/');
define('DIR_ADDONS', DIR_ROOT . '/addons/');
define('DIR_SKINS',  DIR_ROOT . '/skins/');
define('DIR_PAYMENT_FILES', DIR_ROOT . '/payments/');
define('DIR_SHIPPING_FILES', DIR_ROOT . '/shippings/');
define('DIR_SCHEMAS', DIR_ROOT . '/schemas/');
define('DIR_IMAGES', DIR_ROOT . '/images/');
define('DIR_THUMBNAILS', DIR_IMAGES . 'thumbnails/');

// var dirs
define('DIR_COMPILED', DIR_ROOT . '/var/compiled/');
define('DIR_DATABASE', DIR_ROOT . '/var/database/');
define('DIR_DOWNLOADS', DIR_ROOT . '/var/downloads/');
define('DIR_UPGRADE', DIR_ROOT . '/var/upgrade/');
define('DIR_EXIM', DIR_ROOT . '/var/exim/');
define('DIR_CACHE', DIR_ROOT . '/var/cache/');
define('DIR_SKINS_REPOSITORY', DIR_ROOT . '/var/skins_repository/');

// Week days
define('SUNDAY',    0);
define('MONDAY',    1);
define('TUESDAY',   2);
define('WEDNESDAY', 3);
define('THURSDAY',  4);
define('FRIDAY',    5);
define('SATURDAY',  6);

// statuses definitions
define('STATUSES_ORDER', 'O');

// membership definitions
define('NOT_A_MEMBER', 0);
define('ALL_MEMBERSHIPS', -1);

// SEF urls delimiter
define('SEO_DELIMITER', '-');

// Live time for permanent cookies (currency, language, etc...)
define('COOKIE_ALIVE_TIME', 60 * 60 * 24 * 7); // one week

// Session live time
define('SESSION_ALIVE_TIME', 60 * 60 * 2); // 2 hours

// Sessions storage live time
define('SESSIONS_STORAGE_ALIVE_TIME',  60 * 60 * 24 * 7 * 2); // 2 weeks

// Number of seconds after last session update, while user considered as online
define('SESSION_ONLINE', 60 * 5); // 5 minutes

// Database tables prefix
define('TABLE_PREFIX', 'cscart_');

// Number of seconds before installation script will be redirected to itself to avoid server timeouts
define('INSTALL_DB_EXECUTION', 60 * 60); // 1 hour

// Uncomment this line if you experience problems with mysql5 server (disables strict mode)
//define('MYSQL5', true);

// Uncomment to enable code profiles
// define('PROFILER', true);

// Skin description file name
define('SKIN_MANIFEST', 'manifest.ini');

// Controller return statuses
define('CONTROLLER_STATUS_REDIRECT', 302);
define('CONTROLLER_STATUS_OK', 200);
define('CONTROLLER_STATUS_NO_PAGE', 404);
define('CONTROLLER_STATUS_DENIED', 403);
define('CONTROLLER_STATUS_DEMO', 401);

// Maximum number of items in "Last edited items" list (administrative area)
define('LAST_EDITED_ITEMS_COUNT', 10);

// Product filters settings
define('FILTERS_RANGES_COUNT', 10);
define('FILTERS_RANGES_MORE_COUNT', 20);

// Meta description auto generation
define('AUTO_META_DESCRIPTION', true);

// Session name
define('SESS_NAME', 'sess_id');

// Debug mode (displays report a bug button)
// define('DEBUG_MODE', true);

// Product information
define('PRODUCT_NAME', 'CS-CART');
define('PRODUCT_VERSION', '2.0.7');
define('PRODUCT_STATUS', '');

//Popularity rating
define('POPULARITY_VIEW', 3);
define('POPULARITY_ADD_TO_CART', 5);
define('POPULARITY_DELETE_FROM_CART', 5);
define('POPULARITY_BUY', 10);

 // The number of seconds after which the execution of query is considered to be long
define('LONG_QUERY_TIME', 3);

/*
 * Dymanic options
 */
$config = array();

// List of forbinned file extensions (for uploaded files)
$config['forbidden_file_extensions'] = array (
	'php',
	'php3',
	'pl',
	'com',
	'exe',
	'bat',
	'cgi',
	'htaccess'
);

// Locations that can be viewed via secure connection (customer area)
$config['secure_controllers'] = array (
	'checkout',
	'payment_notification',
	'auth',
	'profiles',
	'image_verification',
	'orders',
	'pages'
);

// Get local configuration
require(DIR_ROOT . '/config.local.php');

// Path to cache directory
$config['cache_path'] = $config['http_path'] . '/var/cache';

// Define host directory depending on the current connection
$config['current_path'] = (defined('HTTPS')) ? $config['https_path'] : $config['http_path'];

// Directory for store images on file system
$config['images_path'] = $config['current_path'] . '/images/';
$config['thumbnails_path'] = $config['images_path'] . 'thumbnails/';

$config['http_location'] = 'http://' . $config['http_host'] . $config['http_path'];
$config['https_location'] = 'https://' . $config['https_host'] . $config['https_path'];
$config['current_location'] = (defined('HTTPS')) ? $config['https_location'] : $config['http_location'];

?>
