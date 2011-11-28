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
// $Id: class.registry.php 7788 2009-08-05 07:17:39Z isergi $
//

if (!defined('AREA')) { die('Access denied'); }

class Registry {

	static private $_storage = array();
	static private $_cached_keys = array();
	static private $_changed_tables = array();

	//
	// Put variable to registry
	// Path (e.g. config.host) can be passed in $key, will be created automatically if not exists
	static function set($key, $value)
	{
		$var = & self::_get_var_by_key($key, true);
		$var = $value;

		if (isset(self::$_cached_keys[$key]) && self::$_cached_keys[$key]['track'] == false) { // save cache immediatelly
			self::_set_cache($key, $var, self::$_cached_keys[$key]['tables'], self::$_cached_keys[$key]['cache_level']);
			unset(self::$_cached_keys[$key]);
		}


		return true;
	}

	//
	// Get variable from registry
	// value can be returned by reference
	static function & get($key)
	{
		return self::_get_var_by_key($key);
	}

	//
	// Push data to array
	//
	static function push()
	{
		$args = func_get_args();

		$data = & self::get(array_shift($args));
		if (!is_array($data)) {
			$data = array();
		}

		$data =	array_merge($data, $args);

		return true;
	}

	//
	// Delete variable from registry
	// nullifies variable value (does not delete actually)
	static function del($key)
	{
		if ($var = & self::_get_var_by_key($key)) {
			$var = NULL;

			return true;
		}
	}

	//
	// Private, get value by path
	// @create - path will be created if not exist
	private static function & _get_var_by_key($key, $create = false)
	{
		if (strpos($key, '.') !== false) {
			$parts = explode('.', $key);
			$part = array_shift($parts);
			if (empty(self::$_storage[$part])) {
				if ($create == true) {
					self::$_storage[$part] = array();
				} else {
					die("cant_find_config_parameter:$key");
				}
			}

			$piece = & self::$_storage[$part];
			foreach ($parts as $part) {
				if (!is_array($piece)) {
					if (1||$create == true) {
						$piece = array();
					} else {
						die("invalid_config_parameter_access:$key");
					}
				}

				$piece = & $piece[$part];
			}

			return $piece;
		}

		if (!isset(self::$_storage[$key]) && $create == true) {
			self::$_storage[$key] = array();
		}

		return self::$_storage[$key];
	}

	//
	// Conditional get, returns default value if variable does not exist
	//
	static function if_get($key, $default)
	{
		$var = self::_get_var_by_key($key);

		return !empty($var) ? $var : $default;
	}

	//
	// Check if variable exists
	//
	static function is_exist($key)
	{
		return !empty(self::$_storage[$key]);
	}


	//
	// Store data in the file cache
	//
	private static function _set_cache($name, $data, $tables, $cache_level = NULL)
	{
		$fname = $name . '.' . $cache_level . '.php';
		if (!is_dir(DIR_CACHE)) {
			fn_mkdir(DIR_CACHE);
		}
		
		$change_cache = false;

		if (self::$_cached_keys[$name]['track'] == true && !empty(self::$_cached_keys[$name . '_real_value']) && self::$_cached_keys[$name . '_real_value'] != $data) {
			$change_cache = true;
		}

		if (!empty($data) && (file_exists(DIR_CACHE . $fname) == false || $change_cache == true)) {
			file_put_contents(DIR_CACHE . $fname, "<?php\n if ( !defined('AREA') )	{ die('Access denied');	}\n \$_cache_data = " . var_export($data, true) . "\n?>");

			if (file_exists(DIR_CACHE . 'cache_update_handlers.php')) {
				include(DIR_CACHE . 'cache_update_handlers.php');
			}

			foreach ($tables as $table) {
				if (empty($cache_handlers[$table])) {
					$cache_handlers[$table] = array();
				}

				$cache_handlers[$table][$name] = true;
			}

			file_put_contents(DIR_CACHE . 'cache_update_handlers.php', "<?php\n if ( !defined('AREA') )	{ die('Access denied');	}\n \$cache_handlers = " . var_export($cache_handlers, true) . "\n?>");
		}
	}

	//
	// Retirieve data from the file cache
	//
	private static function _get_cache($name, $cache_level = NULL)
	{
		$fname = $name . '.' . $cache_level . '.php';

		if (!empty($name) && is_file(DIR_CACHE . $fname) && is_readable(DIR_CACHE . $fname)) {
			include(DIR_CACHE . $fname);
			if (!isset($_cache_data)) {
				die('registry:cache_exception');
			}
		
			if (self::$_cached_keys[$name]['track'] == true) {
				self::$_cached_keys[$name . '_real_value'] = $_cache_data;
			}

			self::set($name, $_cache_data);

			return true;
		}

		return false;
	}

	//
	// Fill changed tables array
	//
	static function set_changed_tables($table)
	{
		self::$_changed_tables[$table] = true;
	}

	//
	// Register variable in cache
	//
	static function register_cache($key, $tables, $cache_level = NULL, $track = false)
	{
		self::$_cached_keys[$key] = array(
			'tables' => $tables,
			'cache_level' => $cache_level,
			'track' => $track
		);

		if (!self::is_exist($key)) {
			self::_get_cache($key, $cache_level);
		}
	}

	//
	// Save cache data
	//
	static function save()
	{
		chdir(DIR_ROOT);

		foreach (self::$_cached_keys as $key => $arg) {
			if (!isset(self::$_storage[$key])) {
				continue;
			}
			self::_set_cache($key, self::$_storage[$key], $arg['tables'], $arg['cache_level']);
		}

		if (!empty(self::$_changed_tables) && file_exists(DIR_CACHE . 'cache_update_handlers.php')) {
			include(DIR_CACHE . 'cache_update_handlers.php');

			foreach (self::$_changed_tables as $table => $flag) {
				if (!empty($cache_handlers[$table])) {
					foreach ($cache_handlers[$table] as $cache_name => $_d) {
 						fn_rm(DIR_CACHE, false, '^' . $cache_name . '\.');
					}
				}
			}
		}

		return true;
	}
}

?>
