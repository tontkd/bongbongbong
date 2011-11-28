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
// $Id: upgrade_center.php 7891 2009-08-24 13:23:19Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

fn_define('DIR_REPOSITORY', 'var/skins_repository/base/');
$custom_skin_files = array(
	'styles_ie.css',
	'dropdown.css',
	'styles.css',
	'manifest.ini'
);

$skip_files = array(
	'manifest.ini'
);

set_time_limit(0);

$uc_settings = fn_get_settings('Upgrade_center');

// If we're performing the update, check if upgrade center override controller is exist in the package
if (!empty($_SESSION['uc_package']) && file_exists(DIR_UPGRADE . $_SESSION['uc_package'] . '/uc_override.php')) {
	return include(DIR_UPGRADE . $_SESSION['uc_package'] . '/uc_override.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update_settings') {
		if (!empty($_REQUEST['settings_data'])) {
			foreach ($_REQUEST['settings_data'] as $k => $v) {
				db_query("UPDATE ?:settings SET value = ?s WHERE section_id = 'Upgrade_center' AND option_name = ?s", $v, $k);
			}
		}
	}

	return array(CONTROLLER_STATUS_REDIRECT);
}

if ($mode == 'manage') {

	// Create directory structure
	fn_uc_create_structure();

	$view->assign('installed_upgrades', fn_uc_check_installed_upgrades());

	if (empty($uc_settings['license_number'])) {
		$view->assign('require_license_number', true);
	} else {
		$view->assign('packages', fn_uc_get_packages($uc_settings));
	}
	
	$view->assign('uc_settings', $uc_settings);

} elseif ($mode == 'refresh') {
	fn_rm(DIR_UPGRADE . 'packages.xml');

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center.manage");

} elseif ($mode == 'get_upgrade') {

	$package = fn_uc_get_package_details($_REQUEST['package_id']);
	if (fn_uc_get_package($_REQUEST['package_id'], $_REQUEST['md5'], $package, $uc_settings) == true) {
		$_SESSION['uc_package'] = $package['file'];
		$suffix = '.check';
	} else {
		unset($_SESSION['uc_package']);
		$suffix = '.manage';
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center" . $suffix);

} elseif ($mode == 'check') {

	if (empty($_SESSION['uc_package'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=upgrade_center.manage");
	}

	fn_add_breadcrumb(fn_get_lang_var('upgrade_center'), "$index_script?dispatch=upgrade_center.manage");

	fn_set_store_mode('closed'); // close the store
	
	$xml = simplexml_load_file(DIR_UPGRADE . $_SESSION['uc_package'] . '/uc.xml', NULL, LIBXML_NOERROR);

	if (!empty($xml)) {
		$hash_table = $result = array();

		// Get array with original files hashes
		if (isset($xml->original_files)) {
			foreach ($xml->original_files->item as $item) {
				$hash_table[(string)$item['file']] = (string)$item;
			}
		}

		fn_uc_ftp_connect($uc_settings);

		fn_uc_create_skins(DIR_UPGRADE . $_SESSION['uc_package'] . '/package', $_SESSION['uc_package'], $skip_files, $custom_skin_files);
		fn_uc_check_files(DIR_UPGRADE . $_SESSION['uc_package'] . '/package', $hash_table, $result, $_SESSION['uc_package'], $custom_skin_files);

		$udata = $data = array();
		if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
			include(DIR_UPGRADE . 'installed_upgrades.php');
		}

		if (!empty($result['changed'])) {
			foreach ($result['changed'] as $f) {
				$data[$f] = false;
			}
		}

		$udata[$_SESSION['uc_package']]['files'] = $data;
		fn_uc_update_installed_upgrades($udata);
	}

	$view->assign('check_results', $result);

} elseif ($mode == 'run_backup') {

	if (empty($_SESSION['uc_package'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=upgrade_center.manage");
	}

	$backup_details = array(
		'files' => array(),
		'tables' => array()
	);

	fn_uc_backup_files(DIR_UPGRADE . $_SESSION['uc_package'] . '/package', DIR_ROOT, $backup_details['files'], $_SESSION['uc_package']);
	$backup_details['tables'] = fn_uc_backup_database(DIR_UPGRADE . $_SESSION['uc_package']);

	$udata = array();
	if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
		include(DIR_UPGRADE . 'installed_upgrades.php');
	}

	$udata[$_SESSION['uc_package']]['backup_details'] = $backup_details;
	fn_uc_update_installed_upgrades($udata);

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center.backup");


} elseif ($mode == 'backup') {

	if (empty($_SESSION['uc_package'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=upgrade_center.manage");
	}

	if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
		include(DIR_UPGRADE . 'installed_upgrades.php');
	} else {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=upgrade_center.check");
	}

	$view->assign('backup_details', $udata[$_SESSION['uc_package']]['backup_details']); 

} elseif ($mode == 'upgrade') {

	if (empty($_SESSION['uc_package'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=upgrade_center.manage");
	}

	fn_uc_ftp_connect($uc_settings);
	fn_uc_copy_files(DIR_UPGRADE . $_SESSION['uc_package'] . '/package', DIR_ROOT);

	fn_uc_upgrade_database(DIR_UPGRADE . $_SESSION['uc_package'], true);
	fn_uc_post_upgrade(DIR_UPGRADE . $_SESSION['uc_package'], 'upgrade');

	fn_uc_cleanup_cache($_REQUEST['package'], 'upgrade');
	$package = $_SESSION['uc_package'];
	unset($_SESSION['uc_package']);

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center.summary&package=" . $package);

} elseif ($mode == 'revert') {

	fn_uc_ftp_connect($uc_settings);
	fn_uc_copy_files(DIR_UPGRADE . $_REQUEST['package'] . '/backup', DIR_ROOT);

	fn_uc_upgrade_database(DIR_UPGRADE . $_REQUEST['package'] . '/backup', false);
	fn_uc_post_upgrade(DIR_UPGRADE . $_REQUEST['package'], 'revert');

	if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
		include(DIR_UPGRADE . 'installed_upgrades.php');

		if (isset($udata[$_REQUEST['package']])) {
			unset($udata[$_REQUEST['package']]);
		}

		if (!empty($udata)) {
			fn_uc_update_installed_upgrades($udata);
		} else {
			fn_rm(DIR_UPGRADE . 'installed_upgrades.php');
		}
	}

	fn_rm(DIR_UPGRADE . 'packages.xml'); // cleanup packages list
	fn_uc_cleanup_cache($_REQUEST['package'], 'revert');

	fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_uc_upgrade_reverted'));

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center.manage");


} elseif ($mode == 'summary') {

	fn_rm(DIR_UPGRADE . 'packages.xml'); // cleanup packages list

} elseif ($mode == 'installed_upgrades') {

	fn_add_breadcrumb(fn_get_lang_var('upgrade_center'), "$index_script?dispatch=upgrade_center.manage");

	$udata = array();
	if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
		include(DIR_UPGRADE . 'installed_upgrades.php');
	}

	$packages = array();
	foreach ($udata as $pkg => $f) {
		$details = array();
		if (file_exists(DIR_UPGRADE . $pkg . '/package_details.php')) {
			$details = include(DIR_UPGRADE . $pkg . '/package_details.php');
		}
		$packages[$pkg] = array(
			'details' => $details,
			'files' => $f['files']
		);
	}

	if (empty($packages)) {
		return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=upgrade_center.manage");
	}

	$view->assign('packages', $packages);

} elseif ($mode == 'diff') {

	fn_add_breadcrumb(fn_get_lang_var('upgrade_center'), "$index_script?dispatch=upgrade_center.manage");
	fn_add_breadcrumb(fn_get_lang_var('installed_upgrades'), "$index_script?dispatch=upgrade_center.installed_upgrades");

	$view->assign('diff', fn_text_diff(fn_get_contents(DIR_UPGRADE . $_REQUEST['package'] . '/backup/' . $_REQUEST['file']), fn_get_contents(DIR_ROOT . '/' . $_REQUEST['file'])));

} elseif ($mode == 'conflicts') {

	if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
		include(DIR_UPGRADE . 'installed_upgrades.php');

		if (isset($udata[$_REQUEST['package']]['files'][$_REQUEST['file']])) {
			$udata[$_REQUEST['package']]['files'][$_REQUEST['file']] = ($action == 'mark') ? true : false;

			fn_uc_update_installed_upgrades($udata);
		}
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center.installed_upgrades");

} elseif ($mode == 'remove') {

	if (!empty($_REQUEST['package'])) {
		$dirs = fn_get_dir_contents(DIR_UPGRADE, true, false);
		$delete_dirs = array();
		preg_match_all("/(\d+)\.(\d+)\.(\d+)\.tgz$/", $_REQUEST['package'], $v);
		$c_ver_int = $v[1][0] * 10000 + $v[2][0] * 1000 + $v[3][0];
		foreach ($dirs as $dir) {
			if (preg_match_all("/(\d+)\.(\d+)\.(\d+)\.tgz$/", $dir, $v)) {
				$ver_int = $v[1][0] * 10000 + $v[2][0] * 1000 + $v[3][0];
				if ($ver_int <= $c_ver_int) {
					$delete_dirs[] = $dir;
				}
			}
		}

		if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
			include(DIR_UPGRADE . 'installed_upgrades.php');
		}

		if (!empty($delete_dirs)) {
			foreach ($delete_dirs as $dir) {
				fn_rm(DIR_UPGRADE . $dir, true);

				if (!empty($udata[$dir])) {
					unset($udata[$dir]);
				}
			}
		}

		if (!empty($udata)) {
			fn_uc_update_installed_upgrades($udata);
		} else {
			fn_rm(DIR_UPGRADE . 'installed_upgrades.php');
		}
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=upgrade_center.installed_upgrades");

}

/**
 * Get upgrade packages list
 *
 * @param array $uc_settings Upgrade center settings
 * @return array packages list
 */
function fn_uc_get_packages($uc_settings)
{
	$result = array();

	// Cache packages list
	if (!file_exists(DIR_UPGRADE . 'packages.xml') || filemtime(DIR_UPGRADE . 'packages.xml') < (TIME - 60 * 60 * 24)) {
		$data = fn_get_contents($uc_settings['updates_server'] . '/index.php?target=product_updates&mode=get_available&ver=' . PRODUCT_VERSION . '&license_number=' . $uc_settings['license_number']);
		fn_put_contents(DIR_UPGRADE . 'packages.xml', $data);
	} else {
		$data = fn_get_contents(DIR_UPGRADE . 'packages.xml');
	}

	if (!empty($data)) {
		$xml = simplexml_load_string($data, NULL, LIBXML_NOERROR);
		if (!empty($xml)) {
			// Get array with original files hashes
			if (isset($xml->packages)) {
				foreach ($xml->packages->item as $package) {

					$c = array();
					if (isset($package->contents)) {
						foreach ($package->contents->item as $item) {
							$c[] = str_replace('package/', '', (string)$item);
						}
					}

					$result[] = array(
						'md5' => (string)$package->file['md5'],
						'package_id' => (string)$package['id'],
						'file' => (string)$package->file,
						'name' => (string)$package->name,
						'timestamp' => (string)$package->timestamp,
						'description' => (string)$package->description,
						'from_version' => (string)$package->from_version,
						'to_version' => (string)$package->to_version,
						'size' => (string)$package->size,
						'is_avail' => (string)$package->is_avail,
						'purchase_time_limit' => (string)$package->purchase_time_limit,
						'contents' => $c
					);
				}
			}

			if (isset($xml->errors)) {
				foreach ($xml->errors->item as $error) {
					fn_set_notification('E', fn_get_lang_var('error'), (string)$error);
				}
				fn_rm(DIR_UPGRADE . 'packages.xml'); // if we have errors, do not cache server response
			}
		}
	}

	return $result;
}


/**
 * Get upgrade package details
 *
 * @param int $package_id package ID
 * @return array package details
 */
function fn_uc_get_package_details($package_id)
{
	$result = array();

	$data = fn_get_contents(DIR_UPGRADE . 'packages.xml');
	if (!empty($data)) {
		$xml = simplexml_load_string($data, NULL, LIBXML_NOERROR);
		if (!empty($xml)) {
			// Get array with original files hashes
			if (isset($xml->packages)) {
				foreach ($xml->packages->item as $p) {
					if ((string)$p['id'] == $package_id) {
						$result = array(
							'md5' => (string)$p->file['md5'],
							'package_id' => (string)$p['id'],
							'file' => (string)$p->file,
							'name' => (string)$p->name,
							'description' => (string)$p->description,
							'timestamp' => (string)$p->timestamp,
							'size' => (string)$p->size,
							'is_avail' => (string)$p->is_avail,
							'purchase_time_limit' => (string)$package->purchase_time_limit,
							'from_version' => (string)$p->from_version,
							'to_version' => (string)$p->to_version,
						);

						if (isset($p->contents)) {
							foreach ($p->contents->item as $item) {
								$result['contents'][] = (string)$item;
							}
						}

						break;
					}
				}
			}
		}
	}

	return $result;
}

/**
 * Get upgrade package
 *
 * @param int $package_id package ID
 * @param string $md5 md5 hash of package
 * @param array $package package details
 * @param array $uc_settings Upgrade center settings
 * @return boolean true if package downloaded and extracted successfully, false - otherwise
 */
function fn_uc_get_package($package_id, $md5, $package, $uc_settings)
{
	$result = true;
	
	if ($package['is_avail'] != 'Y'){
		return false;
	}
	
	$data = fn_get_contents($uc_settings['updates_server'] . '/index.php?target=product_updates&mode=get_package&package_id=' . $package_id . '&license_number=' . $uc_settings['license_number']);
	if (!empty($data)) {

		fn_put_contents(DIR_UPGRADE . 'uc.tgz', $data);

		if (md5_file(DIR_UPGRADE . 'uc.tgz') == $md5) {
			$dir = basename($package['file']);
			fn_mkdir(DIR_UPGRADE . $dir);
			fn_put_contents(DIR_UPGRADE . $dir . '/package_details.php', "<?php\n return " . var_export($package, true) . "; \n?>");

			return fn_decompress_files(DIR_UPGRADE . 'uc.tgz', DIR_UPGRADE . $dir);
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_broken_package'));
			$result = false;
		}
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_cant_download_package'));
		$result = false;
	}

	return $result;
}

/**
 * Check if files can be upgraded
 *
 * @param string $path files path
 * @param array $hash_table table with hashes of original files
 * @param array $result resulting array
 * @param string $package package to check files from
 * @param array $custom_skin_files list of custom skin files
 * @return boolean always true
 */
function fn_uc_check_files($path, $hash_table, &$result, $package, $custom_skin_files)
{
	// Simple copy for a file
    if (is_file($path)) {
		// Get original file name
		$original_file = str_replace(DIR_UPGRADE . $package . '/package/', DIR_ROOT . '/', $path);
		$relative_file = str_replace(DIR_ROOT . '/', '', $original_file);
		$file_name = basename($original_file);

		if (file_exists($original_file)) {
			if (md5_file($original_file) != md5_file($path)) {

				$_relative_file = $relative_file;
				// For skins, convert relative path to skins_repository
				if (strpos($relative_file, 'skins/') === 0) {
					$_relative_file = preg_replace('/skins\/[\w]+\//', 'var/skins_repository/base/', $relative_file);

					// replace all skins except basic
					if (in_array(basename($relative_file), $custom_skin_files) && strpos($relative_file, '/basic/') === false) {
						$_relative_file = preg_replace('/skins\/([\w]+)\//', 'var/skins_repository/${1}/', $relative_file);
					}
				}

				if (!empty($hash_table[$_relative_file])) {
					if (md5_file($original_file) != $hash_table[$_relative_file]) {
						$result['changed'][] = $relative_file;
					}
				} else {
					$result['changed'][] = $relative_file;
				}
			}
		} else {
			$result['new'][] = $relative_file;
		}

		$status = fn_uc_is_writable($original_file, true);
		if ($status['result'] == false) {
			$result['non_writable'][] = $relative_file;
		}

		if ($status['no_ftp'] == true) {
			$result['no_ftp'] = true;
		}

		return true;
    }

	if (is_dir($path)) {
		$dir = dir($path);
		while (false !== ($entry = $dir->read())) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			fn_uc_check_files(rtrim($path, '/') . '/' . $entry, $hash_table, $result, $package, $custom_skin_files);
		}
		// Clean up
		$dir->close();
		return true;
	} else {
		return false;
	}
}

/**
 * Check if file is writable
 *
 * @param string $path file path
 * @param boolean $extended return extended status
 * @return boolean true if file is writable, false - otherwise
 */
function fn_uc_is_writable($path, $extended = false)
{
	$result = false;
	$extended_result = array(
		'result' => false,
		'no_ftp' => false,
		'method' => ''
	);

	// File does not exist, check if directory is writable
	if (!file_exists($path)) {
		$a = explode('/', $path);
		do {
			array_pop($a);
		} while (!is_dir(implode('/', $a)));

		$path = implode('/', $a);
	}

	// Check if file can be written using php
	if (!is_writable($path)) {
		$result = fn_uc_ftp_is_writable($path);
		if ($result == false) {
			$ftp = Registry::get('uc_ftp');
			if (!is_resource($ftp)) {
				$extended_result['no_ftp'] = true;
			}
		} else {
		    $extended_result['method'] = 'ftp';
		}
	} else {
		$result = true;
		$extended_result['method'] = 'fs';
	}

	$extended_result['result'] = $result;

	return ($extended) ? $extended_result : $result;
}

/**
 * Create directory taking into account accessibility via php/ftp
 *
 * @param string $dir directory
 * @return boolean true if directory created successfully, false - otherwise
 */
function fn_uc_mkdir($dir)
{
	// Try to make directory using php
	$r = fn_uc_is_writable($dir, true);

	$result = $r['result'];
	if ($r['method'] == 'fs') {
		$result = fn_mkdir($dir);
	} elseif ($r['method'] == 'ftp') {
		$result = fn_uc_ftp_mkdir($dir);
	}

	return $result;
}

/**
 * Copy file taking into account accessibility via php/ftp
 *
 * @param string $source source file
 * @param string $dest destination file/directory
 * @return boolean true if directory copied correctly, false - otherwise
 */
function fn_uc_copy($source, $dest)
{
	$result = false;
	$file_name = basename($source);

	if (!file_exists($dest)) {
		if (basename($dest) == $file_name) { // if we're copying the file, create parent directory
			fn_uc_mkdir(dirname($dest));
		} else {
			fn_uc_mkdir($dest);
		}
	}

	fn_echo(' .');

	if (is_writable($dest) || is_writable(dirname($dest))) {
		if (is_dir($dest)) {
			$dest .= '/' . basename($source);
		}
		$result = copy($source, $dest);
		$ext = fn_get_file_ext($dest);
		@chmod($dest, (in_array($ext, array('tpl', 'css'))) ? 0777 : 0644); // set full permissions for templates and css files
	} else { // try ftp
		$result = fn_uc_ftp_copy($source, $dest);
	}

	return $result;
}

/**
 * Copy files from one directory to another
 *
 * @param string $source source directory
 * @param string $dest destination directory
 * @return boolean true if directory copied correctly, false - otherwise
 */
function fn_uc_copy_files($source, $dest)
{
	// Simple copy for a file
    if (is_file($source)) {
		return fn_uc_copy($source, $dest);
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
				if (fn_uc_copy_files(rtrim($source, '/') . '/' . $entry, $dest . '/' . $entry) == false) {
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
 * Upgrade database
 *
 * @param string $path directory with database file
 * @param bool $track track executed queries yes/no
 * @return boolean always true
 */
function fn_uc_upgrade_database($path, $track)
{
	$executed_queries = array();
	if (file_exists($path . '/uc.sql.tmp') && $track == true) {
		$executed_queries = unserialize(fn_get_contents($path . '/uc.sql.tmp'));
	}

	Registry::set('runtime.database.skip_errors', true);
	if (file_exists($path . '/uc.sql')) {
		$f = fopen($path . '/uc.sql', 'r');
		if ($f) {
			$ret = array();
			$rest = '';
			while (!feof($f)) {
				$str = $rest . fread($f, 1024);
				$rest = fn_parse_queries($ret, $str);

				if (!empty($ret)) {
					foreach ($ret as $query) {
						if (!in_array($query, $executed_queries)) {
							fn_echo(' .');
							db_query($query); // FIXME: how to use table prefixes?
							if ($track == true) {
								$executed_queries[] = $query;
								fn_put_contents($path . '/uc.sql.tmp', serialize($executed_queries));
							}
						}
					}

					$ret = array();
				}
			}

			fclose($f);
		}
	}
	Registry::set('runtime.database.skip_errors', false);

	return true;
}

/**
 * Run post-upgrade script
 *
 * @param string $path directory with post-upgrade script
 * @param string $upgrade_type script execution type - "upgrade" or "revert"
 * @return boolean always true
 */
function fn_uc_post_upgrade($path, $upgrade_type)
{
	if (file_exists($path . '/uc.php')) {
		include($path . '/uc.php');
	}

	return true;
}

/**
 * Create directory structure for upgrade
 *
 * @return boolean true if structured created correctly, false - otherwise
 */
function fn_uc_create_structure()
{
	return fn_mkdir(DIR_UPGRADE);
}

/**
 * Create directory structure for current active skins and copy templates there
 *
 * @param string $path path with skins repository
 * @param string $package package to create skins structure in
 * @param array $skip_files list of files that should not be copied to installed skins
 * @param array $custom_skin_files list of custom skin files
 * @return boolean true if structured created correctly, false - otherwise
 */
function fn_uc_create_skins($path, $package, $skip_files, $custom_skin_files)
{
	static $installed_skins = array();
	if (empty($installed_skins)) {
		$installed_skins = fn_get_dir_contents(DIR_SKINS, true, false);
	}

	if (is_file($path)) {
		$files = array();
		if (strpos($path, DIR_REPOSITORY) !== false) {
			// customer skin
			if (strpos($path, DIR_REPOSITORY . 'customer/') !== false || strpos($path, DIR_REPOSITORY . 'mail/') !== false) {
				foreach ($installed_skins as $s) {
					if (!in_array(basename($path), $custom_skin_files)) { // copy non-custom files only
						$files[] = str_replace(DIR_UPGRADE . $package . '/package/' . DIR_REPOSITORY, DIR_UPGRADE . $package . '/package/skins/' . $s . '/', $path);
					}
				}
			// admin skin
			} else {
				$files[] = str_replace(DIR_UPGRADE . $package . '/package/' . DIR_REPOSITORY, DIR_UPGRADE . $package . '/package/skins/' . Registry::get('settings.skin_name_admin') . '/', $path);
			}

		// Copy data from alternative skins
		} elseif (strpos($path, 'var/skins_repository/' . Registry::get('settings.skin_name_customer')) !== false) {
			$files[] = str_replace(DIR_UPGRADE . $package . '/package/var/skins_repository/', DIR_UPGRADE . $package . '/package/skins/', $path);
		}

		foreach ($files as $file) {
			$fname = basename($file);
			if (!in_array($fname, $skip_files) && !(file_exists($file) && strpos($path, '/base/') !== false)) {
				fn_mkdir(dirname($file));
				fn_copy($path, dirname($file));
			}
		}

		return true;
    }

	if (is_dir($path)) {
		$dir = dir($path);
		while (false !== ($entry = $dir->read())) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			fn_uc_create_skins(rtrim($path, '/') . '/' . $entry, $package, $skip_files, $custom_skin_files);
		}
		// Clean up
		$dir->close();
		return true;
	} else {
		return false;
	}
}
/**
 * Check if file is writable using ftp
 *
 * @param string $path file path
 * @return boolean true if file is writable, false - otherwise
 */
function fn_uc_ftp_is_writable($path)
{
	$result = false;
	// If ftp connection is available, check file/directory via ftp
	$ftp = Registry::get('uc_ftp');
	if (is_resource($ftp)) {
		$rel_path = ltrim(str_replace(DIR_ROOT, '', $path), '/');
		if (empty($rel_path)) {
			$rel_path = '.';
		}
		$ftp_path = (is_dir($path) || is_file($path)) ?  $rel_path : (dirname($rel_path));
		if (ftp_site($ftp, "CHMOD 0755 $ftp_path")) {
			$result = true;
		}
	}

	return $result;

}

/**
 * Copy file using ftp
 *
 * @param string $source source file
 * @param string $dest destination file/directory
 * @return boolean true if copied successfully, false - otherwise
 */
function fn_uc_ftp_copy($source, $dest)
{
	$result = false;

	$ftp = Registry::get('uc_ftp');
	if (is_resource($ftp)) {
		if (!is_dir($dest)) { // file
			$dest = dirname($dest);
		}
		$dest = rtrim($dest, '/') . '/'; // force adding trailing slash to path

		$rel_path = str_replace(DIR_ROOT . '/', '', $dest);
		$cdir = ftp_pwd($ftp);

		if (empty($rel_path)) { // if rel_path is empty, assume it's root directory
		    $rel_path = $cdir;
		}

		if (ftp_chdir($ftp, $rel_path) && ftp_put($ftp, basename($source), $source, FTP_BINARY)) {
			$ext = fn_get_file_ext($source);
			@ftp_site($ftp, "CHMOD " . ((in_array($ext, array('tpl', 'css'))) ? '0777' : '0644') . " " . basename($source)); // set full permissions for templates and css files
			$result = true;
			ftp_chdir($ftp, $cdir);
		}
	}

	return $result;
}

/**
 * Create directory using ftp
 *
 * @param string $dir directory
 * @return boolean true if directory created successfully, false - otherwise
 */
function fn_uc_ftp_mkdir($dir)
{
	$ftp = Registry::get('uc_ftp');
	if (is_resource($ftp)) {
		if (@!is_dir($dir)) {
			$rel_path = str_replace(DIR_ROOT . '/', '', $dir);
			$path = '';
			$dir_arr = array();
			if (strstr($rel_path, '/')) {
				$dir_arr = explode('/', $rel_path);
			} else {
				$dir_arr[] = $rel_dir;
			}

			foreach ($dir_arr as $k => $v) {
				$path .= (empty($k) ? '' : '/') . $v;
				if (!@is_dir(DIR_ROOT . '/' . $path)) {
					if (ftp_mkdir($ftp, $path)) {
						$result = true;
					} else {
						$result = false;
						break;
					}
				}
			}
		}

		return $result;
	}
}

/**
 * Connect to ftp server
 *
 * @param array $uc_settings upgrade center options
 * @return boolean true if connected successfully and working directory is correct, false - otherwise
 */
function fn_uc_ftp_connect($uc_settings)
{
	$result = true;

	if (function_exists('ftp_connect')) {
		if (!empty($uc_settings['ftp_hostname'])) {
			$ftp = ftp_connect($uc_settings['ftp_hostname']);
			if (!empty($ftp)) {
				if (@ftp_login($ftp, $uc_settings['ftp_username'], $uc_settings['ftp_password'])) {
					if (!empty($uc_settings['ftp_directory'])) {
						ftp_chdir($ftp, $uc_settings['ftp_directory']);
					}

					$files = ftp_nlist($ftp, '.');
					if (!empty($files) && in_array('config.php', $files)) {
						Registry::set('uc_ftp', $ftp);
					} else {
						fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_ftp_cart_directory_not_found'));
						$result = false;					
					}
				} else {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_ftp_login_failed'));
					$result = false;
				}
			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_ftp_connect_failed'));
				$result = false;
			}
		}
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_no_ftp_module'));
		$result = false;
	}

	return $result;
}

/**
 * Backup database data which will be affected during upgrade
 *
 * @param string $path path to backup directory
 * @return array backed up tables list
 */
function fn_uc_backup_database($path)
{
	$tables = array();
	$rows_per_pass = 40;
	$max_row_size = 10000;

	if (file_exists($path . '/uc.sql')) {

		$f = fopen($path . '/uc.sql', 'rb');
		if (!empty($f))  {
			while (!feof($f)) {
				$s = fgets($f);

				if (preg_match_all("/(INSERT INTO|REPLACE INTO|UPDATE|ALTER TABLE|RENAME TABLE|DELETE FROM|DROP TABLE|CREATE TABLE)( IF EXISTS| IF NOT EXISTS)? [`]?(\w+)[`]?/", $s, $m)) {
					$tables[$m[3][0]] = true;
				}
			}
			fclose($f);
		}
	}

	if (!empty($tables)) {
		$t_status = db_get_hash_array("SHOW TABLE STATUS", 'Name');
		$f = fopen($path . '/backup/uc.sql', 'wb');
		if (!empty($f)) {
			foreach ($tables as $table => $v) {
				fwrite($f, "\nDROP TABLE IF EXISTS " . $table . ";\n");
				if (empty($t_status[$table])) { // new table in upgrade, we need drop statement only
					continue;
				}
				$scheme = db_get_row("SHOW CREATE TABLE $table");
				fwrite($f, array_pop($scheme) . ";\n\n");

				$total_rows = db_get_field("SELECT COUNT(*) FROM $table");

				// Define iterator
				if ($t_status[$table]['Avg_row_length'] < $max_row_size) {
					$it = $rows_per_pass;
				} else {
					$it = 1;
				}

				fn_echo(' .');

				for ($i = 0; $i < $total_rows; $i = $i + $it) {
					$table_data = db_get_array("SELECT * FROM $table LIMIT $i, $it");
					foreach ($table_data as $_tdata) {
						$_tdata = fn_add_slashes($_tdata, true);
						fwrite($f, "INSERT INTO $table (`".implode('`, `', array_keys($_tdata))."`) VALUES ('".implode('\', \'', array_values($_tdata))."');\n");
					}
				}
			}
			fclose($f);
		}
	}

	return array_keys($tables);
}

/**
 * Backup files
 *
 * @param string $source upgrade package directory
 * @param string $dest working directory
 * @param array $result resulting list of backed up files
 * @param string $package package to make backup for
 * @return boolean true if directory copied correctly, false - otherwise
 */
function fn_uc_backup_files($source, $dest, &$result, $package)
{
	// Simple copy for a file
    if (is_file($source)) {
        return fn_uc_backup_file($source, $dest, $result, $package);
    }

    // Loop through the folder
	if (is_dir($source)) {
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}

			// Deep backup directories
			if ($dest !== $source . '/' . $entry) {
				if (fn_uc_backup_files(rtrim($source, '/') . '/' . $entry, $dest . '/' . $entry, $result, $package) == false) {
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
 * Backup certain file
 *
 * @param string $source source file
 * @param string $dest destination file/directory
 * @param array $result resulting list of backed up files
 * @param string $package package to make backup for
 * @return string filename of backed up file
 */
function fn_uc_backup_file($source, $dest, &$result, $package)
{
	$file_name = basename($source);

	if (is_file($dest)) {
		fn_echo(' .');
		$relative_path = str_replace(DIR_ROOT . '/', '', $dest);
		fn_mkdir(dirname(DIR_UPGRADE . $package . '/backup/' . $relative_path));
		copy($dest, DIR_UPGRADE . $package . '/backup/' . $relative_path);
		$result[] = $relative_path;
	}

	return true;
}

/**
 * Check installed upgrades
 *
 * @return array array which indicates, if any upgrade has conflicts and if any upgrade exist
 */
function fn_uc_check_installed_upgrades()
{
	$result = array(
		'has_conflicts' => false,
		'has_upgrades' => false,
	);

	if (file_exists(DIR_UPGRADE . 'installed_upgrades.php')) {
		include(DIR_UPGRADE . 'installed_upgrades.php');

		foreach ($udata as $p => $f) {
			if (!empty($f['files'])) {
				foreach ($f['files'] as $_f => $_s) {
					if ($_s == false) {
						$result['has_conflicts'] = true;
						break;
					}
				}
			}
		}

		$result['has_upgrades'] = sizeof($udata) > 0;
	}

	return $result;
}

function fn_uc_update_installed_upgrades($data)
{
	return fn_put_contents(DIR_UPGRADE . 'installed_upgrades.php', "<?php\n if ( !defined('AREA') )	{ die('Access denied');	}\n \$udata = " . var_export($data, true) . ";\n?>");
}

/**
 * Cleanup upgrade cache
 *
 * @param string $package package name
 * @param string $type upgrade type (upgrade/revert)
 * @return boolean always true
 */
function fn_uc_cleanup_cache($package, $type)
{
	if ($type == 'upgrade') {
		@unlink(DIR_UPGRADE . $package . '/backup/uc.sql.tmp');
	} else {
		@unlink(DIR_UPGRADE . $package . '/uc.sql.tmp');
	}
}


?>
