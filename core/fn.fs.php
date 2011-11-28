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
// $Id: fn.fs.php 7884 2009-08-21 12:50:57Z alexey $
//

if ( !defined('AREA') )	{ die('Access denied');	}

//
// File system functions definitions
//

/**
 * Delete file function
 *
 * @param string $file_path file location
 * @return bool true
 */
function fn_delete_file($file_path)
{
	if (!empty($file_path)) {
		if (file_exists($file_path)) {
			@chmod($file_path, 0775);
			@unlink($file_path);
		}
	}

	return true;
}

/**
 * Normalize path: remove "../", "./" and duplicated slashes
 *
 * @param string $path
 * @param string $separator
 * @return string normilized path
 */
function fn_normalize_path($path, $separator = '/')
{

	$result = array();
	$path = preg_replace("/[\\\\\/]+/S", $separator, $path);
	$path_array = explode($separator, $path);
	if (!$path_array[0])  {
		$result[] = '';
	}

	foreach ($path_array as $key => $dir) {
		if ($dir == '..') {
			if (end($result) == '..') {
			   $result[] = '..';
			} elseif (!array_pop($result)) {
			   $result[] = '..';
			}
		} elseif ($dir != '' && $dir != '.') {
			$result[] = $dir;
		}
	}

	if (!end($path_array)) {
		$result[] = '';
	}

	return fn_is_empty($result) ? '' : implode($separator, $result);
}

/**
 * Create directory wrapper. Allows to create included directories
 *
 * @param string $dir
 * @param int $perms permission for new directory
 */
function fn_mkdir($dir, $perms = 0777)
{
	$result = false;

	// Truncate the full path to related to avoid problems with
	// some buggy hostings
	if (strpos($dir, DIR_ROOT) === 0) {
		$dir = './' . substr($dir, strlen(DIR_ROOT) + 1);
		$old_dir = getcwd();
		chdir(DIR_ROOT);
	}

	if (!empty($dir)) {
		$result = true;
		if (@!is_dir($dir)) {
			$dir = fn_normalize_path($dir, '/');
			$path = '';
			$dir_arr = array();
			if (strstr($dir, '/')) {
				$dir_arr = explode('/', $dir);
			} else {
				$dir_arr[] = $dir;
			}

			foreach ($dir_arr as $k => $v) {
				$path .= (empty($k) ? '' : '/') . $v;
				if (!@is_dir($path)) {
					umask(0);
					mkdir($path, $perms);
				}
			}
		}
	}

	if (!empty($old_dir)) {
		chdir($old_dir);
	}
	return $result;
}

/**
 * Compress files with Tar archiver
 *
 * @param string $archive_name - name of the compressed file will be created
 * @param string $file_list - list of files to place into archive
 * @param string $dirname - directory, where the files should be get from
 * @return bool true
 */
function fn_compress_files($archive_name, $file_list, $dirname = '')
{
	include_once(DIR_LIB . 'tar/tar.php');

	$tar = new Archive_Tar($archive_name, 'gz');

	if (!is_object($tar)) {
		fn_error(debug_backtrace(), 'Archiver initialization error', false);
	}

	if (!empty($dirname) && is_dir($dirname)) {
		chdir($dirname);
		$tar->create($file_list);
		chdir(DIR_ROOT);
	} else {
		$tar->create($file_list);
	}

	return true;
}

/**
 * Extract files with Tar archiver
 *
 * @param $archive_name - name of the compressed file will be created
 * @param $file_list - list of files to place into archive
 * @param $dirname - directory, where the files should be extracted to
 * @return bool true
 */
function fn_decompress_files($archive_name, $dirname = '')
{
	include_once(DIR_LIB . 'tar/tar.php');

	$tar = new Archive_Tar($archive_name, 'gz');

	if (!is_object($tar)) {
		fn_error(debug_backtrace(), 'Archiver initialization error', false);
	}

	if (!empty($dirname) && is_dir($dirname)) {
		chdir($dirname);
		$tar->extract('');
		chdir(DIR_ROOT);
	} else {
		$tar->extract('');
	}

	return true;
}

/**
 * Get mime type by the file name
 *
 * @param string $filename
 * @return string $file_type
 */
function fn_get_file_type($filename)
{
	$file_type = 'application/unknown';

	static $types = array (
		'zip' => 'application/zip',
		'tgz' => 'application/tgz',
		'rar' => 'application/rar',

		'exe' => 'application/exe',
		'com' => 'application/com',
		'bat' => 'application/bat',

		'png' => 'image/png',
		'jpg' => 'image/jpeg',
		'jpeg' => 'jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'swf' => 'application/x-shockwave-flash',

		'csv' => 'text/csv',
		'txt' => 'text/plain',
		'doc' => 'application/msword',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pdf' => 'application/pdf'
	);

	$ext = substr($filename, strrpos($filename, '.') + 1);

	if (!empty($types[$ext])) {
		$file_type = $types[$ext];
    }

    return $file_type;
}

/**
 * Download the file
 *
 * @param string $path path to the file
 * @param string $filename file name to be displayed in download dialog
 * @param bool $encode_name if file name contains non latin simbols than it should be encoded for Internet Explorer
 */
function fn_get_file($path, $filename = '', $encode_name = false)
{
	$fd = fopen($path, 'r');
	if ($fd) {
		header("Pragma: public");
   		header("Expires: 0");
   		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
   		header("Cache-Control: private", false);
		header("Content-type: " . fn_get_file_type($path));

		if (empty($filename)) {
			$filename = basename($path);
		}

		if ($encode_name == true) {
			$filename = rawurlencode($filename);
		}

		header("Content-disposition: attachment; filename=\"$filename\"");
		header("Content-Length: " . filesize($path));
		while (!feof($fd)) {
			echo(fread($fd, 30000)); // Read by 30k blocks to avoid memory leaks
			fn_flush();
		}
		exit; // stop script execution after reading file contents
	}

	return true;
}

/**
 * Create temporary file for uploaded file
 *
 * @param $val file path
 * @return array $val
 */
function fn_get_server_data($val)
{
	$tmp = fn_strip_slashes($val);

	$val = array();
	$val['name'] = basename($tmp);
	$val['path'] = fn_normalize_path(DIR_ROOT . '/' . $tmp);
	$tempfile = fn_create_temp_file();
	copy($val['path'], $tempfile);
	clearstatcache();
	$val['path'] = $tempfile;
	$val['size'] = filesize($val['path']);

	return $val;
}

/**
 * Rebuild $_FILES array to more user-friendly view
 *
 * @param string $name
 * @return array $rebuilt rebuilt file array
 */
function fn_rebuid_files($name)
{
	$rebuilt = array();

	if (!is_array(@$_FILES[$name])) {
		return $rebuilt;
	}

	if (isset($_FILES[$name]['error'])) {
		if (!is_array($_FILES[$name]['error'])) {
			return $_FILES[$name];
		}
	} elseif (fn_is_empty($_FILES[$name]['size'])) {
		return $_FILES[$name];
	}

	foreach ($_FILES[$name] as $k => $v) {
		if ($k == 'tmp_name') {
			$k = 'path';
		}
		$rebuilt = fn_array_multimerge($rebuilt, $v, $k);
	}

	return $rebuilt;
}

/**
 * Recursively copy directory (or just a file)
 *
 * @param string $source
 * @param string $dest
 * @param bool $silent
 */
function fn_copy($source, $dest, $silent = true)
{
    // Simple copy for a file
    if (is_file($source)) {
    	if (is_dir($dest)) {
			$dest .= '/' . basename($source);
		}
		if (filesize($source) == 0) {
			$fd = fopen($dest, 'w');
			fclose($fd);
			$res = true;
		} else {
			$res = copy($source, $dest);
		}
		@chmod($dest, 0777);
        return $res;
    }

    // Make destination directory
	if ($silent == false) {
		fn_echo('Creating directory <b>' . ((strpos($dest, DIR_ROOT) === 0) ? str_replace(DIR_ROOT . '/', '', $dest) : $dest) . '</b><br />');
	}

	if (!is_dir($dest)) {
        if (fn_mkdir($dest, 0777) == false) {
			return false;
		}
    }

    // Loop through the folder
	if (is_dir($source)) {
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}

			// Deep copy directories
			if ($dest !== $source . '/' . $entry) {
				if (fn_copy($source . '/' . $entry, $dest . '/' . $entry, $silent) == false) {
					return false;
				}
			}
		}

		// Clean up
		$dir->close();

		return true;
	} else {

		return false;
	}
}

/**
 * Recursively remove directory (or just a file)
 *
 * @param string $source
 * @param bool $delete_root
 * @param string $pattern
 * @return bool
 */
function fn_rm($source, $delete_root = true, $pattern = '')
{
    // Simple copy for a file
    if (is_file($source)) {
		$res = true;
		if (empty($pattern) || (!empty($pattern) && preg_match('/' . $pattern . '/', basename($source)))) {
			$res = @unlink($source);
		}
        return $res;
    }

    // Loop through the folder
	if (is_dir($source)) {
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}
	 		if (fn_rm($source . '/' . $entry, true, $pattern) == false) {
				return false;
			}
		}
		// Clean up
		$dir->close();
		return ($delete_root == true && empty($pattern)) ? @rmdir($source) : true;
	} else {
		return false;
	}
}

/**
 * Get file extension
 *
 * @param string $filename
 */
function fn_get_file_ext($filename)
{
	$i = strrpos($filename, '.');
	if ($i === false) {
		return '';
	}

	return substr($filename, $i + 1);
}

/**
 * Get directory contents
 *
 * @param string $dir directory path
 * @param bool $get_dirs get sub directories
 * @param bool $get_files
 * @param mixed $extension allowed file extensions
 * @param string $prefix file/dir path prefix
 * @return array $contents directory contents
 */
function fn_get_dir_contents($dir, $get_dirs = true, $get_files = false, $extension = '', $prefix = '')
{

	$contents = array();
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {

			// $extention - can be string or array. Transform to array.
			$extension = is_array($extension) ? $extension : array($extension);

			while (($file = readdir($dh)) !== false) {
				if ($file == '.' || $file == '..' || $file{0} == '.') {
					continue;
				}

				if ((is_dir($dir . '/' . $file) && $get_dirs == true) || (is_file($dir . '/' . $file) && $get_files == true)) {
					if ($get_files == true && !fn_is_empty($extension)) {
						// Check all extentions for file
						foreach ($extension as $_ext) {
						 	if (substr($file, -strlen($_ext)) == $_ext) {
								$contents[] = $prefix . $file;
								break;
						 	}
						}
					} else {
						$contents[] = $prefix . $file;
					}
				}
			}
			closedir($dh);
		}
	}

	asort($contents, SORT_STRING);

	return $contents;
}

/**
 * Get file contents from local or remote filesystem
 *
 * @param string $location file location
 * @param string $base_dir
 * @return string $result
 */
function fn_get_contents($location, $base_dir = '')
{
	$result = '';
	$path = $base_dir . $location;

	if (!empty($base_dir) && !fn_check_path($path)) {
		return $result;
	}

	// Location is regular file
	if (is_file($path)) {
		$result = @file_get_contents($path);

	// Location is url
	} elseif (strpos($path, '://') !== false) {

		// Prepare url
		$path = str_replace(' ', '%20', $path);
		if (fn_get_ini_param('allow_url_fopen') == true) {
			$result = @file_get_contents($path);
		} else {
			list(, $result) = fn_http_request('GET', $path);
			$result = $result;
		}
	}

	return $result;
}

/**
 * Write a string to a file
 *
 * @param string $location file location
 * @param string $content
 * @param string $base_dir
 * @return string $result
 */
function fn_put_contents($location, $content, $base_dir = '')
{
	$result = '';
	$path = $base_dir . $location;

	if (!empty($base_dir) && !fn_check_path($path)) {
		return false;
	}

	// Location is regular file
	return file_put_contents($path, $content);
}

/**
 * Get data from url
 *
 * @param string $val
 * @return array $val
 */
function fn_get_url_data($val)
{
	$tmp = fn_strip_slashes($val);
	$_data = fn_get_contents($tmp);

	if (!empty($_data)) {
		$val = array();
		$val['name'] = basename($tmp);

		// Check if the file is dynamically generated
		if (strpos($val['name'], '&') !== false || strpos($val['name'], '?') !== false) {
			$val['name'] = 'url_uploaded_file_'.uniqid(TIME);
		}
		$val['path'] = fn_create_temp_file();
		$val['size'] = strlen($_data);

		$fd = fopen($val['path'], 'wb');
		fwrite($fd, $_data, $val['size']);
		fclose($fd);
	}
	return $val;
}

/**
 * Function get local uploaded
 *
 * @param unknown_type $val
 * @staticvar array $cache
 * @return unknown
 */
function fn_get_local_data($val)
{
	$cache = & Registry::get('temp_fs_data');

	if (!isset($cache[$val['path']])) { // cache file to allow multiple usage
		$tempfile = fn_create_temp_file();
		if (move_uploaded_file($val['path'], $tempfile) == true) {
			$cache[$val['path']] = $tempfile;
		} else {
			$cache[$val['path']] = '';
		}
	}

	if (defined('KEEP_UPLOADED_FILES')) {
		$tempfile = fn_create_temp_file();
		copy($cache[$val['path']], $tempfile);
		clearstatcache();
		$val['path'] = $tempfile;
	} else {
		$val['path'] = $cache[$val['path']];
	}

	return $val;
}

/**
 * Finds the last key in the array and applies the custom function to it.
 *
 * @param array $arr
 * @param string $fn
 * @param bool $is_first
 */
function fn_get_last_key(&$arr, $fn = '', $is_first = false)
{
	if (!is_array($arr)&&$is_first == true) {
		$arr = call_user_func($fn, $arr);
		return;
	}

	foreach ($arr as $k => $v) {
		if (is_array($v) && count($v)) {
			fn_get_last_key($arr[$k], $fn);
		}
		elseif (!is_array($v)&&!empty($v)) {
			$arr[$k] = call_user_func($fn, $arr[$k]);
		}
	}
}

/**
 * Filter data from file uploader
 *
 * @param string $name
 * @return array $filtered
 */
function fn_filter_uploaded_data($name)
{
	$udata_local = fn_rebuid_files('file_' . $name);
	$udata_other = !empty($_REQUEST['file_' . $name]) ? $_REQUEST['file_' . $name] : array();
	$utype = !empty($_REQUEST['type_' . $name]) ? $_REQUEST['type_' . $name] : array();

	if (empty($utype)) {
		return array();
	}

	$filtered = array();

	foreach ($utype as $id => $type) {
		if ($type == 'local' && !fn_is_empty(@$udata_local[$id])) {
			$filtered[$id] = fn_get_local_data(fn_strip_slashes($udata_local[$id]));

		} elseif ($type == 'server' && !fn_is_empty(@$udata_other[$id]) && AREA == 'A') {
			fn_get_last_key($udata_other[$id], 'fn_get_server_data', true);
			$filtered[$id] = $udata_other[$id];

		} elseif ($type == 'url' && !fn_is_empty(@$udata_other[$id])) {
			fn_get_last_key($udata_other[$id], 'fn_get_url_data', true);
			$filtered[$id] = $udata_other[$id];
		} 

		if (!empty($filtered[$id]['name'])) {
			$filtered[$id]['name'] = str_replace(' ', '_', urldecode($filtered[$id]['name'])); // replace spaces with underscores
			$ext = fn_get_file_ext($filtered[$id]['name']);
			if (in_array($ext, Registry::get('config.forbidden_file_extensions'))) {
				unset($filtered[$id]);
				$msg = fn_get_lang_var('text_forbidden_file_extension');
				$msg = str_replace('[ext]', $ext, $msg);
				fn_set_notification('E', fn_get_lang_var('error'), $msg);
			}
		}
	}

	static $shutdown_inited;

	if (!$shutdown_inited) {
		$shutdown_inited = true;
		register_shutdown_function('fn_remove_temp_data');
	}

	return $filtered;
}

/**
 * Remove temporary files
 */
function fn_remove_temp_data()
{
	$fs_data = Registry::get('temp_fs_data');
	if (!empty($fs_data)) {
		foreach ($fs_data as $file) {
			fn_delete_file($file);
		}
	}
}

/**
 * Create temporary file
 *
 * @return temporary file
 */
function fn_create_temp_file()
{
	return tempnam(DIR_COMPILED, 'ztemp');
}

/**
 * Returns correct path from url "path" component
 *
 * @param string $path
 * @return correct path
 */
function fn_get_url_path($path)
{
	$dir = dirname($path);

	if ($dir == '.' || $dir == '/') {
		return '';
	}

	return (IIS == true) ? str_replace('\\', '/', $dir) : $dir;
}

/**
 * Check path to file 
 *
 * @param string $path
 * @return bool
 */
function fn_check_path($path)
{
	$real_path = realpath($path);
	return str_replace('\\', '/', $real_path) == $path ? true : false;
}

/**
 * Gets line from file pointer and parse for CSV fields 
 *
 * @param handle $f a valid file pointer to a file successfully opened by fopen(), popen(), or fsockopen().
 * @param int $length maximum line length
 * @param string $d field delimiter
 * @param string $q the field enclosure character
 * @return array structured data
 */
function fn_fgetcsv($f, $length, $d = ',', $q = '"') 
{
	$list = array();
	$st = fgets($f, $length);
	if ($st === false || $st === null) {
		return $st;
	}

	if (trim($st) === '') {
		return array('');
	}
	
	$st = rtrim($st, "\n\r");
	if (substr($st, -strlen($d)) == $d){
		$st .= '""';
	}
	
	while ($st !== '' && $st !== false) {
		if ($st[0] !== $q) {
			// Non-quoted.
			list ($field) = explode($d, $st, 2);
			$st = substr($st, strlen($field) + strlen($d));
		} else {
			// Quoted field.
			$st = substr($st, 1);
			$field = '';
			while (1) {
				// Find until finishing quote (EXCLUDING) or eol (including)
				preg_match("/^((?:[^$q]+|$q$q)*)/sx", $st, $p);
				$part = $p[1];
				$partlen = strlen($part);
				$st = substr($st, strlen($p[0]));
				$field .= str_replace($q . $q, $q, $part);
				if (strlen($st) && $st[0] === $q) {
					// Found finishing quote.
					list ($dummy) = explode($d, $st, 2);
					$st = substr($st, strlen($dummy) + strlen($d));
					break;
				} else {
					// No finishing quote - newline.
					$st = fgets($f, $length);
				}
			}
		}

		$list[] = $field;
	}

	return $list;
}
?>
