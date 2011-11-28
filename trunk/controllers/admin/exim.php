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
// $Id: exim.php 7883 2009-08-21 12:47:21Z alexey $
//

if ( !defined('AREA') ) { die('Access denied'); }

// Set line endings autodetection
ini_set('auto_detect_line_endings', true);
set_time_limit(3600);

if (empty($_SESSION['export_ranges'])) {
	$_SESSION['export_ranges'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Init YAML parser
	fn_init_yaml();
	$suffix = '';

	$layout_data = !empty($_REQUEST['layout_data']) ? $_REQUEST['layout_data'] : array();
	//
	// Select layout
	//
	if ($mode == 'set_layout') {
		db_query("UPDATE ?:exim_layouts SET active = 'N' WHERE pattern_id = ?s", $layout_data['pattern_id']);
		db_query("UPDATE ?:exim_layouts SET active = 'Y' WHERE layout_id = ?i", $layout_data['layout_id']);

		$suffix = ".export&section=$_REQUEST[section]&pattern_id=$layout_data[pattern_id]";
	}

	//
	// Store layout
	//
	if ($mode == 'store_layout') {
		if (!empty($layout_data['cols'])) {
			$layout_data['cols'] = implode(',', $layout_data['cols']);
			$_data = fn_check_table_fields($layout_data, 'exim_layouts', 'layout_id');

			// Update current layout
			if ($action == 'save_as') {
				if (!empty($layout_data['name'])) {
					$_data['active'] = 'Y';
					db_query("INSERT INTO ?:exim_layouts ?e", $_data);
				}
			} else {
				if (!empty($layout_data['layout_id'])) {
					unset($_data['name']);
					db_query("UPDATE ?:exim_layouts SET ?u WHERE layout_id = ?i", $_data, $layout_data['layout_id']);
				}
			}
		}
		$suffix = ".export&section=$_REQUEST[section]&pattern_id=$layout_data[pattern_id]";
	}

	//
	// Perform export
	//
	if ($mode == 'export') {
		$_suffix = '';
		if (!empty($layout_data['cols'])) {
			$pattern = fn_get_pattern_definition($layout_data['pattern_id']);

			if (empty($pattern)) {
				return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=exim.export");
			}

			if (!empty($_SESSION['export_ranges'][$pattern['#section']])) {
				if (empty($pattern['#condition'])) {
					$pattern['#condition'] = array();
				}

				$pattern['#condition'] = fn_array_merge($pattern['#condition'], $_SESSION['export_ranges'][$pattern['#section']]['data']);
			}

			if (fn_export($pattern, $layout_data['cols'], $_REQUEST['export_options']) == true) {

				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_exim_data_exported'));

				// Direct download
				if ($_REQUEST['export_options']['output'] == 'D') {
					$_suffix = '&output=D&filename=' . $_REQUEST['export_options']['filename'];

				// Output to screen
				} elseif ($_REQUEST['export_options']['output'] == 'C') {
					fn_echo("<script type=\"text/javascript\">document.body.innerHTML = '';</script>");
					fn_echo('<pre>');
					readfile(DIR_EXIM . basename($_REQUEST['export_options']['filename']));
					fn_echo('</pre>');
					exit;
				}

			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_no_data_exported'));
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_fields_not_selected'));
		}

		$suffix = ".export&section=$_REQUEST[section]&pattern_id=$layout_data[pattern_id]" . $_suffix;
	}

	//
	// Perform import
	//
	if ($mode == 'import') {
		$file = fn_filter_uploaded_data('csv_file');

		if (!empty($file)) {
			if (empty($_REQUEST['pattern_id'])) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_not_found'));
			} else {
				$pattern = fn_get_pattern_definition($_REQUEST['pattern_id']);
				if (($data = fn_get_csv($pattern, $file[0]['path'], $_REQUEST['import_options'])) != false) {
					fn_import($pattern, $data, $_REQUEST['import_options']);
				}
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_no_file_uploaded'));
		}

		$suffix = ".import&section=$_REQUEST[section]&pattern_id=$_REQUEST[pattern_id]";
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=exim" . $suffix);
}


//
// Delete layout
//
if ($mode == 'delete_layout') {
	db_query("DELETE FROM ?:exim_layouts WHERE layout_id = ?i", $_REQUEST['layout_id']);

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=exim.export&section=$_REQUEST[section]&pattern_id=$_REQUEST[pattern_id]");

} elseif ($mode == 'export') {

	if (empty($_REQUEST['section'])) {
		$_REQUEST['section'] = 'products';
	}

	list($sections, $patterns) = fn_get_patterns($_REQUEST['section'], 'export');

	$pattern_id = empty($_REQUEST['pattern_id']) ? key($patterns) : $_REQUEST['pattern_id'];

	foreach ($patterns as $p_id => $p) {
		Registry::set('navigation.tabs.' . $p_id, array (
			'title' => $p['#name'],
			'href' => "$index_script?dispatch=exim.export&pattern_id=" . $p_id . '&section=' . $_REQUEST['section'],
			'ajax' => true
		));
	}

	if (!empty($_SESSION['export_ranges'][$patterns[$pattern_id]['#section']])) {
		$key = key($_SESSION['export_ranges'][$patterns[$pattern_id]['#section']]['data']);
		if (!empty($key)) {
			$view->assign('export_range', count($_SESSION['export_ranges'][$patterns[$pattern_id]['#section']]['data'][$key]));
		}
	}

	// Get available layouts
	$layouts = db_get_array("SELECT * FROM ?:exim_layouts WHERE pattern_id = ?s", $pattern_id);

	// Extract columns information
	foreach ($layouts as $k => $v) {
		$layouts[$k]['cols'] = explode(',', $v['cols']);
	}

	// Get export files
	$export_files = fn_get_dir_contents(DIR_EXIM, false, true);
	$result = array();
	foreach ($export_files as $file) {
		$result[] = array (
			'name' => $file,
			'size' => filesize(DIR_EXIM . $file),
		);
	}

	Registry::set('navigation.dynamic.sections', $sections);
	Registry::set('navigation.dynamic.active_section', $_REQUEST['section']);

	$view->assign('export_files', $result);

	$view->assign('pattern', $patterns[$pattern_id]);
	$view->assign('layouts', $layouts);

} elseif ($mode == 'import') {

	if (empty($_REQUEST['section'])) {
		$_REQUEST['section'] = 'products';
	}

	list($sections, $patterns) = fn_get_patterns($_REQUEST['section'], 'import');

	$pattern_id = empty($_REQUEST['pattern_id']) ? key($patterns) : $_REQUEST['pattern_id'];

	foreach ($patterns as $p_id => $p) {
		Registry::set('navigation.tabs.' . $p_id, array (
			'title' => $p['#name'],
			'href' => "$index_script?dispatch=exim.import&pattern_id=" . $p_id . '&section=' . $_REQUEST['section'],
			'ajax' => true
		));
	}

	Registry::set('navigation.dynamic.sections', $sections);
	Registry::set('navigation.dynamic.active_section', $_REQUEST['section']);

	$view->assign('pattern', $patterns[$pattern_id]);
	$view->assign('sections', $sections);

} elseif ($mode == 'get_file' && !empty($_REQUEST['filename'])) {
	$file = basename($_REQUEST['filename']);
	fn_get_file(DIR_EXIM . $file);

} elseif ($mode == 'delete_file' && !empty($_REQUEST['filename'])) {
	$file = basename($_REQUEST['filename']);
	fn_rm(DIR_EXIM . $file);

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'delete_range') {
	unset($_SESSION['export_ranges'][$_REQUEST['section']]);

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=exim.export&section=$_REQUEST[section]&pattern_id=$_REQUEST[pattern_id]");

} elseif ($mode == 'select_range') {
	$_SESSION['export_ranges'][$_REQUEST['section']] = array (
		'pattern_id' => $_REQUEST['pattern_id'],
		'data' => array(),
	);
	$pattern = fn_get_pattern_definition($_REQUEST['pattern_id']);

	return array(CONTROLLER_STATUS_REDIRECT, $pattern['#range_options']['#selector_url']);
}


// --------- ExIm core functions ------------------


//
// Import data using pattern
// Parameters:
// @pattern - import/export pattern
// @import_data - data to import
// @options - import options

function fn_import($pattern, $import_data, $options)
{
	$alt_keys = array();
	$primary_fields = array();
	$table_groups = array();
	$processing_groups = array();
	$processed_data = array (
		'E' => 0, // existent
		'N' => 0, // new
		'S' => 0, // skipped
	);
	$default_groups = array();
	$converting_groups = array();
	$add_fields = array();

	fn_start_scroller();

	if (!empty($pattern['#pre_processing'])) {
		$func = $pattern['#pre_processing'];
		$function = array_shift($func);
		$args = $func;

		foreach ($args as $k => $v) {
			if (strpos($v, '@') !== false) {
				$_opt = str_replace('@', '', $v);
				$args[$k] = isset($options[$_opt]) ? $options[$_opt] : '';
			}
		}

		call_user_func_array($function, $args);
	}

	fn_echo('<br />' . fn_get_lang_var('importing_data') . '<br />');
	if (!empty($pattern['#references'])) {
		foreach ($pattern['#references'] as $table => $data) {
			$table_groups[$table] = $data;
		}
	}

	// Get keys to detect primary record
	foreach ($pattern['#export_fields'] as $field => $data) {

		$_db_field = (empty($data['#db_field']) ? $field : $data['#db_field']);

		// Collect fields with default values
		if (!empty($data['#default'])) {
			if (is_array($data['#default'])) {
				$default_groups[$_db_field] = call_user_func_array(array_shift($data['#default']), $data['#default']);
			} else {
				$default_groups[$_db_field] = $data['#default'];
			}
		}

		// Get alt keys for primary table
		if (!empty($data['#alt_key'])) {
			$alt_keys[$field] = $_db_field;
		}

		if (!isset($data['#linked']) || $data['#linked'] == true) {
			// Get fields for primary table
			if (empty($data['#table']) || $data['#table'] == $pattern['#table']) {
				$primary_fields[$field] = $_db_field;
			}

			// Group fields by tables
			if (!empty($data['#table'])) {
				$table_groups[$data['#table']]['#fields'][$_db_field] = true;
			}
		}

		// Create set with fields that must be added to data import if they are not exist
		// %'s are for compatibility with %% field type in "process_put" key
		if (!empty($data['#use_put_from'])) {
			$_f = str_replace('%', '', $data['#use_put_from']);
			$_f = !empty($pattern['#export_fields'][$_f]['#db_field']) ? $pattern['#export_fields'][$_f]['#db_field'] : $_f;
			$add_fields[$_f] = true;
		}

		// Generate processing groups
		if (!empty($data['#process_put'])) {
			$args = $data['#process_put'];
			$function = array_shift($args);
			$processing_groups[] = array (
				'function' => $function,
				'args' => $args,
				'this_field' => $_db_field,
				'table' => !empty($data['#table']) ? $data['#table'] : '',
				'return_result' => !empty($data['#return_result']) ? $data['#return_result'] : false,
			);
		}

		// Generate converting groups
		if (!empty($data['#convert_put'])) {
			$args = $data['#convert_put'];
			$function = array_shift($args);
			$converting_groups[] = array (
				'function' => $function,
				'this_field' => $_db_field,
				'table' => !empty($data['#table']) ? $data['#table'] : '',
			);
		}
	}

	foreach ($import_data as $k => $v) {
		foreach ($add_fields as $_f => $_val) {
			if (!isset($v[$_f])) {
				$v[$_f] = '';
			}
		}

		$_alt_keys = array();
		$object_exists = true;

		// Check if converting groups exist and convert fields if it is so
		if (!empty($converting_groups)) {
			foreach ($converting_groups as $group) {
				if (!isset($v[$group['this_field']])) {
					continue;
				}

				$v[$group['this_field']] = call_user_func_array($group['function'], array($v[$group['this_field']]));
			}
		}

		foreach ($alt_keys as $import_field => $real_field) {
			if (!isset($v[$real_field])) {
				continue;
			}
			$_alt_keys[$real_field] = $v[$real_field];
		}

		foreach ($primary_fields as $import_field => $real_field) {
			if (!isset($v[$real_field])) {
				continue;
			}
			$_primary_fields[$real_field] = $v[$real_field];
		}

		$primary_object_id = db_get_row('SELECT ' . implode(', ', $pattern['#key']) . ' FROM ?:' . $pattern['#table'] . ' WHERE ?w', $_alt_keys);

		if (empty($primary_object_id)) {

			// If scheme is used for update objects only, skip this record
			if (!empty($pattern['#update_only'])) {
				fn_echo(fn_get_lang_var('object_does_not_exist') . ' (');
				$_a = array();
				foreach ($alt_keys as $_d => $_v) {
					if (!isset($v[$_v])) {
						continue;
					}
					$_a[] = $_d . ' = ' . $v[$_v];
				}
				fn_echo(implode(', ', $_a) . ')...<br />');
				$processed_data['S']++;
				continue;
			}

			$object_exists = false;
			fn_echo(fn_get_lang_var('creating') . ' ' . $pattern['#name'] . '...');
			$processed_data['N']++;

			// For new objects - fill the default values
			if (!empty($default_groups)) {
				foreach ($default_groups as $field => $value) {
					if (empty($v[$field])) {
						$v[$field] = $value;
					}
				}
			}
		} else {
			fn_echo(fn_get_lang_var('updating') . ' ' . $pattern['#name'] . '...');
			$processed_data['E']++;
		}

		$_data = fn_check_table_fields($v, $pattern['#table']);

		if ($object_exists == true) {
			db_query('UPDATE ?:' . $pattern['#table'] . ' SET ?u WHERE ?w', $_data, $primary_object_id);
		} else {
			$o_id = db_query('INSERT INTO ?:' . $pattern['#table'] . ' ?e', $_data);

			if (!empty($o_id)) {
				$primary_object_id = array(reset($pattern['#key']) => $o_id);
			} else {
				foreach ($pattern['#key'] as $_v) {
					$primary_object_id[$_v] = $_data[$_v];
				}
			}
		}

		fn_echo('<b>' . implode(',', $primary_object_id) . '</b>. ');

		if (!empty($processing_groups)) {
			foreach ($processing_groups as $group) {
				$args = array();
				$use_this_group = true;
				$_refs = array();
				foreach ($group['args'] as $ak => $av) {
					if ($av == '#key') {
						$args[$ak] = (sizeof($primary_object_id) == 1) ? reset($primary_object_id) : $primary_object_id;
					} elseif ($av == '#this') {
						// If we do not have this field in the import data, do not apply the function
						if (!isset($v[$group['this_field']])) {
							$use_this_group = false;
							break;
						}
						$args[$ak] = $v[$group['this_field']];
					} elseif (strpos($av, '%') !== false) {
						$_ref = str_replace('%', '', $av);
						$_ref = !empty($pattern['#export_fields'][$_ref]['#db_field']) ? $pattern['#export_fields'][$_ref]['#db_field'] : $_ref; // FIXME!!! Move to code, which builds processing_groups
						$args[$ak] = isset($v[$_ref]) ? $v[$_ref] : '';
						$_refs[] = $_ref;
					} elseif (strpos($av, '@') !== false) {
						$_opt = str_replace('@', '', $av);
						$args[$ak] = $options[$_opt];
					} else {
						$args[$ak] = $av;
					}
				}

				if ($use_this_group == false) {
					continue;
				}

				$result = call_user_func_array($group['function'], $args); // FIXME - add checking for returned value

				if ($group['return_result'] == true) {
					$v[$group['this_field']] = $result;
				} else {
					// Remove processed fields from table groups
					if (!empty($group['table'])) {
						unset($table_groups[$group['table']]['#fields'][$group['this_field']]);
						foreach ($_refs as $_ref) {
							unset($table_groups[$group['table']]['#fields'][$_ref]);
						}
					}
				}
			}
		}

		// Update referenced tables
		fn_echo(fn_get_lang_var('updating_links') . '... ');

		foreach ($table_groups as $table => $tdata) {
			$_data = array();

			// First, build condition
			$where_insert = array();

			// If alternative key is defined, use it
			if (!empty($tdata['#alt_key'])) {
				foreach ($tdata['#alt_key'] as $akey) {
					if (strval($akey) == '#key') {
						$where_insert = fn_array_merge($where_insert, $primary_object_id);
					} elseif (strpos($akey, '@') !== false) {
						$_opt = str_replace('@', '', $akey);
						$where_insert[$akey] = $options[$_opt];
					} else {
						$where_insert[$akey] = $v[$akey];
					}
				}
			// Otherwise - link by reference fields
			} else {
				foreach ($tdata['#reference_fields'] as $field => $value) {
					if (strval($value) == '#key') {
						$_val = ((sizeof($primary_object_id) == 1) ? reset($primary_object_id) : $primary_object_id);

					} elseif (strpos($value, '@') !== false) {
						$_opt = str_replace('@', '', $value);
						$_val = $options[$_opt];
					} else {
						$_val = $value;
					}

					$where_insert[$field] = $_val;
				}
			}

			// Now, build update fields array
			foreach ($tdata['#fields'] as $import_field => $set) {
				if (!isset($v[$import_field])) {
					continue;
				}
				$_data[$import_field] = $v[$import_field];
			}

			// Check if object exists
			$is_exists = db_get_field("SELECT COUNT(*) FROM ?:$table WHERE ?w", $where_insert);

			if ($is_exists == true && !empty($_data)) {
				db_query("UPDATE ?:$table SET ?u WHERE ?w", $_data, $where_insert);
			} elseif (empty($is_exists)) { // if reference does not exist, we should insert it anyway to avoid inconsistency
				$_data = fn_array_merge($_data, $where_insert);
				if (substr($table, -13) == '_descriptions' && isset($_data['lang_code'])){
					// add description for all cart languages when adding object data
					foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
						db_query("INSERT INTO ?:$table ?e", $_data);
					}
				
				}else{
					db_query("INSERT INTO ?:$table ?e", $_data);
				}
			}
		}
		fn_echo('<b>' . fn_get_lang_var('uc_ok') .'</b><br />');

	}

	$msg = fn_get_lang_var('text_exim_data_imported');
	$msg = str_replace('[new]', $processed_data['N'], $msg);
	$msg = str_replace('[exist]', $processed_data['E'], $msg);
	$msg = str_replace('[skipped]', $processed_data['S'], $msg);
	$msg = str_replace('[total]', $processed_data['E'] + $processed_data['N'] + $processed_data['S'], $msg);

	fn_set_notification('N', fn_get_lang_var('notice'), $msg);
	fn_stop_scroller();

	return true;
}

//
// Export data using pattern
// Parameters:
// @pattern - import/export pattern
// @export_fields - export defined fields only
// @options - export options
// FIXME: add export conditions

function fn_export($pattern, $export_fields, $options)
{
	if (!empty($pattern['#pre_processing'])) {
		$func = $pattern['#pre_processing'];
		$function = array_shift($func);
		$args = $func;

		foreach ($args as $k => $v) {
			if (strpos($v, '@') !== false) {
				$_opt = str_replace('@', '', $v);
				$args[$k] = isset($options[$_opt]) ? $options[$_opt] : '';
			}
		}

		call_user_func_array($function, $args);
	}
	
	$primary_key = $pattern['#key'];
	array_walk($primary_key, 'fn_attach_value_helper', $pattern['#table'].'.');

	$table_fields = $primary_key;
	$joins = array();
	$processes = array();
	$conditions = array();

	// Build list of fields that should be retrieved from the database
	foreach ($pattern['#export_fields'] as $field => $data) {
		if (!in_array($field, $export_fields)) {
			continue;
		}

		// Do no link this field
		if (isset($data['#linked']) && $data['#linked'] == false) {
			// do something?
		}
		// Primary object table
		elseif (empty($data['#table']) || $data['#table'] == $pattern['#table']) {
			$table_fields[] = $pattern['#table'] . '.' . (!empty($data['#db_field']) ? $data['#db_field'] . ' as "' .$field. '"' : $field);
		// Linked object tables
		} else {
			$table_fields[] = $data['#table'] . '.' . (!empty($data['#db_field']) ? $data['#db_field'] . ' as "' .$field. '"' : $field);
		}

		if (!empty($data['#process_get'])) {
			$processes[$field]['function'] = array_shift($data['#process_get']);
			$processes[$field]['args'] = $data['#process_get'];
		}
	}

	// Build the list of joins
	if (!empty($pattern['#references'])) {
		foreach ($pattern['#references'] as $table => $data) {
			$ref = array();
			foreach ($data['#reference_fields'] as $k => $v) {
				if (strval($v) == '#key') {
					$_val = (sizeof($primary_key) == 1) ? reset($primary_key) : '';
				} elseif (strpos($v, '@') !== false) {
					$_opt = str_replace('@', '', $v);
					$_val = "'" . $options[$_opt] . "'";
				} else {
					$_val = "'$v'";
				}

				$ref[] = "$table.$k = $_val"; // fixme
			}

			$joins[] = $data['#join_type'] . ' JOIN ?:' . $table . " as $table ON " . implode(' AND ', $ref);
		}
	}

	// Add retrieve conditions
	if (!empty($pattern['#condition'])) {
		$_cond = array();
		foreach ($pattern['#condition'] as $field => $value) {
			if (is_array($value)) {
				$_val = implode("','", $value);
			} elseif (strpos($value, '@') !== false) {
				$_opt = str_replace('@', '', $value);
				$_val = $options[$_opt];
			} else {
				$_val = $value;
			}
			$_cond[] = $pattern['#table'] . ".$field IN ('$_val')";
		}

		$conditions[] = implode(' AND ', $_cond);
	}

	// Build main query
	$query = "SELECT " . implode(', ', $table_fields) . " FROM ?:" . $pattern['#table'] . " as " . $pattern['#table'] .' '. implode(' ', $joins) . (!empty($conditions) ? ' WHERE ' . implode(' AND ', $conditions) : '');

	$step = 30; // define number of rows to get from database
	$iterator = 0; // start retrieving from
	$data_exported = false;

	fn_start_scroller();
	fn_echo(fn_get_lang_var('exporting_data') . '<br />');
	while ($data = db_get_array($query . " LIMIT $iterator, $step")) {
		$data_exported = true;
		$iterator += $step;
		$result = array();
		foreach ($data as $k => $v) {
			$result[$k] = fn_array_key_intersect($v, $pattern['#export_fields']);
			foreach ($processes as $field => $process_data) {
				$args = array();
				foreach ($process_data['args'] as $ak => $av) {
					if ($av == '#this') {
						$args[$ak] = $v[$field];
					} elseif ($av == '#key') {
						$args[$ak] = (sizeof($pattern['#key']) == 1) ? $v[reset($pattern['#key'])] : '';
					} elseif (strpos($av, '@') !== false) {
						$_opt = str_replace('@', '', $av);
						$args[$ak] = $options[$_opt];
					} else {
						$args[$ak] = $av;
					}
				}
				$result[$k][$field] = call_user_func_array($process_data['function'], $args);
			}
		}

		// Sort result array
		$_result = array();
		foreach ($result as $k => $v) {
			foreach ($export_fields as $field) {
				$_result[$k][$field] = $v[$field];
			}
		}
		unset($result);

		// Put data
		$enclosure = (isset($pattern['#enclosure'])) ? $pattern['#enclosure'] : '"';
		fn_echo(' .');
		fn_put_csv($_result, $options, $enclosure);
		unset($_result);
	}
	fn_stop_scroller();

	if (!empty($pattern['#post_processing'])) {
		$func = $pattern['#post_processing'];
		if (file_exists(DIR_EXIM . $options['filename'])) {
			$function = array_shift($func);
			$args = $func;

			foreach ($args as $k => $v) {
				if (strpos($v, '@') !== false) {
					$_opt = str_replace('@', '', $v);
					$args[$k] = $options[$_opt];
				}
			}

			$data_exported = call_user_func_array($function, $args);
		}
	}

	return $data_exported;
}

//
// Process csv file using pattern
// Parameters:
// @pattern - import/export pattern
// @file - path to csv file on filesystem
// @options - processing options

function fn_get_csv($pattern, $file, $options)
{
	$max_line_size = 16384;
	$result = array();

	if ($options['delimiter'] == 'C') {
		$delimiter = ',';
	} elseif ($options['delimiter'] == 'T') {
		$delimiter = "\t";
	} else  {
		$delimiter = ';';
	}

	if (!empty($file) && file_exists($file)) {
		$f = fopen($file, 'rb');
		if ($f) {
			// Get import schema
			$import_schema = fgetcsv($f, $max_line_size, $delimiter);
			if (empty($import_schema)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_cant_read_file'));
				return false;
			}

			// Check if we selected correct delimiter
			// If line was read without delimition, array size will be == 1.
			if (sizeof($import_schema) == 1) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_incorrent_delimiter'));
				return false;
			}

			// Analyze schema - check for required fields
			if (fn_analyze_schema($import_schema, $pattern) == false) {
				return false;
			}

			// Collect data
			$schema_size = sizeof($import_schema);
			$skipped_lines = array();
			$line_it = 1;
			while (($data = fn_fgetcsv($f, $max_line_size, $delimiter)) !== false) {

				$line_it ++;
				if (fn_is_empty($data)) {
					continue;
				}

				if (sizeof($data) != $schema_size) {
					$skipped_lines[] = $line_it;
					continue;
				}

				$result[] = array_combine($import_schema, fn_strip_slashes($data));
			}

			if (!empty($skipped_lines)) {
				$msg = fn_get_lang_var('error_exim_incorrect_lines');
				$msg = str_replace('[lines]', implode(', ', $skipped_lines), $msg);
				fn_set_notification('W', fn_get_lang_var('warning'), $msg);
			}

			return $result;
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_cant_open_file'));
			return false;
		}
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_file_doesnt_exist'));
		return false;
	}
}

//
// Analyze import schema and convert fields using pattern
// Parameters:
// @schema - import schema
// @pattern - import/export pattern

function fn_analyze_schema(&$schema, $pattern)
{
	$failed_fields = array();
	$schema_match = false;
	array_walk($schema, 'fn_trim_helper');

	foreach ($pattern['#export_fields'] as $field => $data) {
		if (!empty($data['#required']) && $data['#required'] == true && !in_array($field, $schema)) {
			$failed_fields[] = $field;
		}

		if (in_array($field, $schema)) {
			$schema_match = true;
		}

		// Replace fields aliases with database representation
		if (!empty($data['#db_field'])) {
			$key = array_search($field, $schema);
			if ($key !== false) {
				$schema[$key] = $data['#db_field'];
			}
		}
	}

	if (!empty($failed_fields)) {
		$msg = fn_get_lang_var('error_exim_pattern_required_fields');
		$msg = str_replace('[fields]', implode(', ', $failed_fields), $msg);
		fn_set_notification('E', fn_get_lang_var('error'), $msg);
		return false;
	}

	if ($schema_match == false) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_dont_match'));
		return false;
	}


	return true;
}

//
// Put data to csv file
// Parameters:
// @data - export data
// @options - options

function fn_put_csv(&$data, $options, $enclosure)
{
	static $output_started = false;

	$eol = "\n";

	if ($options['delimiter'] == 'C') {
		$delimiter = ',';
	} elseif ($options['delimiter'] == 'T') {
		$delimiter = "\t";
	} else  {
		$delimiter = ';';
	}

	if (!is_dir(DIR_EXIM)) {
		fn_mkdir(DIR_EXIM);
	}

	foreach ($data as $k => $v) {
		foreach ($v as $name => $value) {
			$data[$k][$name] = $enclosure . str_replace(array("\r","\n","\t",'"'), array('','','','""'), $value) . $enclosure;
		}
	}

	if ($output_started == false) {
		Registry::get('view')->assign('fields', array_keys($data[0]));
	} else {
		Registry::get('view')->clear_assign('fields');
	}

	Registry::get('view')->assign('export_data', $data);
	Registry::get('view')->assign('delimiter', $delimiter);
	Registry::get('view')->assign('eol', $eol);

	$csv = Registry::get('view')->display('views/exim/components/export_csv.tpl', false);
	$fd = fopen(DIR_EXIM . $options['filename'], ($output_started) ? 'ab' : 'wb');
	if ($fd) {
		fwrite($fd, $csv, strlen($csv));
		fclose($fd);
	}

	if ($output_started == false) {
		$output_started = true;
	}

	return true;
}

//
// Analyze import/export pattern
// Parameters:
// @pattern - pattern

function fn_analyze_pattern($pattern)
{
	$has_alt_keys = false;

	foreach ($pattern['#export_fields'] as $v) {

		if (!empty($v['#table'])) {
			// Table exists in export fields, but doesn't exist in references definition
			if (empty($pattern['#references'][$v['#table']])) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_definition_references'));
				return false;
			}
		}

		// Check if pattern has alternative keys to import basic data
		if (!empty($v['#alt_key'])) {
			$has_alt_keys = true;
		}
	}

	if ($has_alt_keys == false) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_definition_alt_keys'));
		return false;
	}

	return $pattern;
}

//
// Helper function: attaches prefix to value
//
function fn_attach_value_helper(&$value, $key, $attachment)
{
	$value = $attachment . $value;

	return true;
}


// -------------- ExIm utility functions ---------------------

/**
 * Export image (moves to selected directory on filesystem)
 *
 * @param int $image_id ID of the image
 * @param string $object object to export image for (product, category, etc...)
 * @param string $backup_path path to export image
 * @return string path to the exported image
 */
function fn_export_image($image_id, $object, $backup_path = '')
{
	$images_path = (!empty($backup_path) ? fn_strip_slashes($backup_path) : (DIR_IMAGES . 'images_backup')) . '/' . $object . '/';

	// if backup dir does not exist then try to create it
	if (!is_dir($images_path)) {
		fn_mkdir($images_path, 0777);
	}

	$image_data = db_get_row("SELECT image_id, image_path, alt FROM ?:images WHERE image_id = ?i", $image_id);
	if (empty($image_data)) {
		return '';
	}

	$path = $images_path . basename($image_data['image_path']);

	if (is_file(DIR_IMAGES . $object . '/' . $image_data['image_path'])) {
		copy(DIR_IMAGES . $object . '/' . $image_data['image_path'], $path);
	}

	return $path . (!empty($image_data['alt']) ? '#' . $image_data['alt'] : '');
}

/**
 * Impoty image pair
 *
 * @param string $prefix path prefix
 * @param string $image_file thumbanil path or filename
 * @param string $detailed_path detailed image path or filename
 * @param string $type pair type
 * @param int $object_id ID of object to attach images to
 * @param string $object name of object to attach images to
 * @return boolean true if images were imported
 */
function fn_import_images($prefix, $image_file, $detailed_file, $type, $object_id, $object)
{
	$image_found = false;

	if (!empty($object_id)) {

		$_REQUEST["server_import_image_icon"] = '';
		$_REQUEST["type_import_image_icon"] = '';

		// Get image alternative text if exists
		if (!empty($image_file) && strpos($image_file, '#') !== false) {
			list ($image_file, $image_alt)  = explode('#', $image_file);
		}

		if (!empty($detailed_file) && strpos($detailed_file, '#') !== false) {
			list ($detailed_file, $detailed_alt)  = explode('#', $detailed_file);
		}


		if (($image_file = fn_find_file($prefix, $image_file)) !== false) {
			$_REQUEST["file_import_image_icon"] = array (str_ireplace(DIR_ROOT, '', $image_file));
			$_REQUEST["type_import_image_icon"] = array ('server');
			$image_found = true;
		}

		if (($detailed_file = fn_find_file($prefix, $detailed_file)) !== false) {
			$_REQUEST["file_import_image_detailed"] = array (str_ireplace(DIR_ROOT, '', $detailed_file));
			$_REQUEST["type_import_image_detailed"] = array ('server');
			$image_found = true;
		}

		if ($image_found == false) {
			return false;
		}

		$_REQUEST['import_image_data'] = array(
			array(
				'type' => $type,
				'image_alt' => !empty($image_alt) ? $image_alt : '',
				'detailed_alt' => !empty($detailed_alt) ? $detailed_alt : '',
			)
		);

		return fn_attach_image_pairs('import', $object, $object_id);
	}
}

//
// Converts timestamp to human-readable date
//

function fn_timestamp_to_date($timestamp)
{
	return date('d M Y H:i:s', $timestamp);
}

//
// Converts human-readable date to timestamp
//

function fn_date_to_timestamp($date)
{
	return strtotime($date);
}

//
// Get absolute url to the image
// Parameters:
// @image_id - Id of image
// @object_type - type of image object
function fn_exim_get_image_url($image_id, $object_type)
{

	$image_data = fn_get_image($image_id, $object_type, false);

	return 'http://' . Registry::get('config.http_host') . $image_data['image_path'];
}

//
// Get pattern definition by its id
// Parameters:
// @pattern_id - pattern ID
function fn_get_pattern_definition($pattern_id)
{
	// First, check basic patterns
	$schema = fn_get_schema('exim', $pattern_id, 'php', false);

	if (empty($schema)) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_not_found'));
		return false;
	}

	return fn_analyze_pattern($schema);
}

//
// Get all available patterns for the section
// Parameters:
// @section - section to get patterns for
// @get_for - get import or export patterns
function fn_get_patterns($section, $get_for)
{
	// Get core patterns
	$files = fn_get_dir_contents(DIR_SCHEMAS . 'exim', false, true, '.php');

	foreach	(Registry::get('addons') as $k => $v) {
		if ($v['status'] != 'A') {
			continue;
		}

		if (is_dir(DIR_ADDONS . $k . '/schemas/exim')) {
			$_files = fn_get_dir_contents(DIR_ADDONS . $k . '/schemas/exim', false, true, '.php');
			foreach ($_files as $k => $v) {
				if (strpos($v, '.post.php') !== false) {
					unset($_files[$k]);
				}
			}

			if (!empty($_files)) {
				$files = fn_array_merge($files, $_files, false);
			}
		}
	}

	$patterns = array();
	$sections = array();
	foreach ($files as $k => $v) {
		$pattern_id = str_replace('.php', '', $v);
		$pattern = fn_get_pattern_definition($pattern_id);
		if ((!empty($pattern['#export_only']) && $get_for == 'import') || (!empty($pattern['#import_only']) && $get_for == 'export')) {
			continue;
		}

		$sections[$pattern['#section']] = array (
			'title' => fn_get_lang_var($pattern['#section']),
			'href' => INDEX_SCRIPT . '?dispatch=exim.' . MODE . '&section=' . $pattern['#section'],
		);
		if ($pattern['#section'] == $section) {
			$patterns[$pattern_id] = $pattern;
		}
	}

	ksort($sections, SORT_STRING);
	ksort($patterns, SORT_STRING);

	return array($sections, $patterns);
}

//
// Find file
// Parameters:
// @prefix - path to search in
// @file - filename (can be url, absolute, relative path too)
function fn_find_file($prefix, $file)
{

	$file = fn_strip_slashes($file);

	// Absolute path
	if (is_file($file)) {
		return realpath($file);
	}

	// Path is relative to prefix
	if (is_file($prefix . '/' . $file)) {
		return realpath($prefix . '/' . $file);
	}

	// Url
	if (strpos($file, '://') !== false) {
		$content = fn_get_contents($file);
		if (!empty($content)) {
			$fname = basename($file);
			if (empty($fname) || strpos($fname, '?') !== false) {
				$fname = basename(fn_create_temp_file());
			}

			if (file_put_contents(DIR_COMPILED . $fname, $content)) {
				return DIR_COMPILED . $fname;
			}
		}
	}

	return false;
}

?>
