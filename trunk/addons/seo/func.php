<?php
/***************************************************************************
*                                                                          *
*    Copyright (c) 2009 Simbirsk Technologies Ltd. All rights reserved.    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/


//
// $Id: func.php 7892 2009-08-24 15:21:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// This function creates a html link to the item
//
function fn_seo_link($object_type, $object_id, $object_name = '', $seo_name = '', $query_params = array(), $skip_prefix = false)
{
	$d = SEO_DELIMITER;

	$seo_types = Registry::get('addons.seo');
	$seo_path = '';

	unset($query_params['dispatch']); // remove dispath from query string

	if (empty($seo_name)) {
		$seo_name = fn_get_seo_name($object_id, $object_type, $object_name);
	}

	// Product
	if ($object_type == 'p') {
		// Categories path
		if ($seo_types['seo_product_type'] == 'product_category') {
			$cat_path = db_get_field("SELECT b.id_path FROM ?:products_categories as a LEFT JOIN ?:categories as b ON a.category_id = b.category_id WHERE a.product_id = ?i AND a.link_type = 'M'", $object_id);
			if (!empty($cat_path)) {
				$cats = explode('/', $cat_path);
				foreach ($cats as $v) {
					$item_names[] = fn_get_seo_name($v, 'c');
				}
			}
		}
		$seo_name = $seo_name . '.html';
		unset($query_params['product_id']);

	// Category
	} elseif ($object_type == 'c') {

		$_path = db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $object_id);

		if (!empty($_path)) {
			$_path_i = explode("/", $_path);
			array_pop($_path_i);
			foreach ($_path_i as $v) {
				$item_names[] = fn_get_seo_name($v, 'c');
			}
		}

		if ($seo_types['seo_category_type'] == 'file') {
			// Add pagination
			if (!empty($query_params['page']) && $query_params['page'] != '1') {
				$seo_name .= $d . 'page' . $d . $query_params['page'];
			}

			$seo_name = $seo_name . '.html';
		} else {
			// Add pagination
			if (!empty($query_params['page']) && $query_params['page'] != '1') {
				$seo_name .= '/'.'page' . $d . $query_params['page'];
			}

			$seo_name = $seo_name . '/';
		}
		unset($query_params['category_id'], $query_params['page']);


	// Pages
	} elseif ($object_type == 'a') {

		if ($seo_types['seo_product_type'] == 'product_category') {
			$_path = db_get_field("SELECT id_path FROM ?:pages WHERE page_id = ?i", $object_id);

			if (!empty($_path)) {
				$_path_i = explode('/', $_path);
				array_pop($_path_i);
				foreach ($_path_i as $v) {
					$item_names[] = fn_get_seo_name($v, 'a');
				}
			}
		}

		$seo_name .= '.html';
		unset($query_params['page_id']);

	// Extended feature
	} elseif ($object_type == 'e') {
		$seo_name = $seo_name . '.html';
		unset($query_params['feature_id'], $query_params['variant_id']);
	}

	fn_set_hook('seo_link', $object_id, $object_type, $query_params, $item_names, $seo_name);

	if (!empty($item_names)) {
		foreach ($item_names as $v) {
			$seo_path .= fn_generate_name($v) . '/';
		}
	}

	if (!empty($query_params)) {
		$seo_name .= '?' . fn_build_query($query_params);
	}

	if ($skip_prefix == true) {
		return $seo_path . $seo_name;
	} else {
		$lang = (Registry::get('addons.seo.seo_language') == 'Y') ? (strtolower(CART_LANGUAGE) . '/') : '';

		// return link starting from root web directory
		return fn_seo_get_current_path() . '/' . $lang. $seo_path . $seo_name;
	}
}

function fn_seo_get_current_path($skip_catalog = false)
{
	$suffix = (Registry::get('addons.seo.html_catalog') == 'Y') && $skip_catalog == false ? '/catalog' : '';
	return ((AREA == 'C') ? Registry::get('config.current_path') : Registry::get('config.http_path')) . $suffix;
}

function fn_seo_generate_object($object, $object_name)
{
	if (($k = strrpos($object, '.')) !== false) {
		$key = substr($object, $k + 1);
		$obj = substr($object, 0, $k);
		$id = $object;
		$name = $obj . '.' . $object_name;
		$seo_name = $obj . '.seo_name';
	} else {
		$id = $object;
		$name = '""';
		$seo_name = '""';
	}

	return array($id, $name, $seo_name);
}

//
// Convert urls to SEO friendly
//
function fn_convert_tpl_urls($tpl_source, &$view)
{
	$index_script = INDEX_SCRIPT;

	$prefix = '{$config.current_path}/{if $addons.seo.html_catalog == "Y"}catalog/{/if}{if $addons.seo.seo_language == "Y"}{$smarty.const.CART_LANGUAGE|lower}/{/if}';

	fn_set_hook('convert_tpl_url', $tpl_source);

	//Convert product links
	if (preg_match_all('/((`?|\{)\$index_script(\}|`?)\?dispatch=products.view(&amp;|&)product_id=(\{|`?)(\$[\w\.]+)(\}|`?))(&amp;|&?)/i', $tpl_source, $matches)) {
		foreach ($matches[0] as $key => $match) {
			list($id, $name, $seo_name) = fn_seo_generate_object($matches[6][$key], 'product');

			if ($matches[2][$key] == '{') { // original code
				$tpl_source = str_replace($match, "{\"p\"|fn_seo_link:$id:$name:$seo_name}"  . (empty($matches[8][$key]) ? '' : '?'), $tpl_source);
			} else { // code injected into the string
				$tpl_source = str_replace($match, "p\"|fn_seo_link:$id:$name:$seo_name"  . (empty($matches[8][$key]) ? '|cat:"' : '|cat:"?'), $tpl_source);
			}
		}
	}

	//Convert product sorting/layout links
	if (preg_match_all('/"(\{\$curl\}(&amp;|&))/i', $tpl_source, $matches)) {
		$matches[1] = array_unique($matches[1]); // avoid duplicates
		foreach ($matches[1] as $key => $match) {
			$t = "{capture name='t_url'}" . $match . "{/capture}";
			$tpl_source = str_replace($match, $t . '{assign var="_u" value=$smarty.capture.t_url|fn_convert_php_urls}{$_u}' . (empty($matches[2][$key]) ? '' : '{if $_u|strpos:"?" !== false}&amp;{else}?{/if}'), $tpl_source);
		}
	}

	//Convert pagination links
	if (preg_match_all('/(\{\$index_script\}\?\{\$qstring\}(&amp;|&)page=\{(\$[\w\.]+)\})/i', $tpl_source, $matches)) {
		$matches[0] = array_unique($matches[0]); // avoid duplicates
		foreach ($matches[0] as $match) {
			$t = "{capture name='t_url'}" . $match . "{/capture}";
			$tpl_source = str_replace($match, $t . '{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);
		}
	}


	//Convert pages links
	if (preg_match_all('/(\{\$index_script\}\?dispatch=pages.view(&amp;|&)page_id=\{(\$[\w\.]+)\})(&amp;|&?)/i', $tpl_source, $matches)) {
		foreach ($matches[0] as $key => $match) {
			list($id, $name, $seo_name) = fn_seo_generate_object($matches[3][$key], 'page');

			$tpl_source = str_replace($match, "{\"a\"|fn_seo_link:$id:$name:$seo_name}" . (empty($matches[4][$key]) ? '' : '?'), $tpl_source);
		}
	}

	//Convert pages links that has a defined url
	if (preg_match_all('/(\{\$page\.page_link\})/i', $tpl_source, $matches)) {
		$matches[1] = array_unique($matches[1]); // avoid duplicates
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match, substr($match, 0, -1) . '|fn_convert_php_urls}', $tpl_source);
		}
	}

	//Convert pages links in the top menu
	if (preg_match_all('/(\{\$link\.param\})/i', $tpl_source, $matches)) {
		$matches[1] = array_unique($matches[1]); // avoid duplicates
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match, substr($match, 0, -1) . '|fn_convert_php_urls}', $tpl_source);
		}
	}

	//Convert pages links in the top menu
	if (preg_match_all('/href="(\{\$[_]?m\.href\})"/i', $tpl_source, $matches)) {
		$matches[1] = array_unique($matches[1]); // avoid duplicates
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match, substr($match, 0, -1) . '|fn_convert_php_urls}', $tpl_source);
		}
	}

	// Convert categories links
	if (preg_match_all('/(\{\$index_script\}\?dispatch=categories.view(&amp;|&)category_id=\{(\$[\w\.]+)\})(&amp;|&?)/i', $tpl_source, $matches)) {
		foreach ($matches[0] as $key => $match) {
			list($id, $name, $seo_name) = fn_seo_generate_object($matches[3][$key], 'category');

			$tpl_source = str_replace($match, "{\"c\"|fn_seo_link:$id:$name:$seo_name}" . (empty($matches[4][$key]) ? '' : '?'), $tpl_source);
		}
	}

	// Convert extended feature links
	if (preg_match_all('/(\{\$index_script\}\?dispatch=product_features.view(&amp;|&)variant_id=\{(\$[\w\.]+)\})(\{if \$[\w\.]+\}&amp;features_hash=)?/', $tpl_source, $matches)) {
		foreach ($matches[0] as $key => $match) {
			list($id, $name, $seo_name) = fn_seo_generate_object($matches[3][$key], 'range_name');

			$match = str_replace($matches[1][$key], "{\"e\"|fn_seo_link:$id:$name:$seo_name}", $match);
			$match = str_replace('&amp;', '?', $match);
			$tpl_source = str_replace($matches[0][$key], $match, $tpl_source);
		}

		// Convert more filters link
		$tpl_source = str_replace('{$filter_qstring}&amp;filter_id={$filter.filter_id}&amp;more_filters=Y', '{capture name="t_url"}{$filter_qstring}&amp;filter_id={$filter.filter_id}&amp;more_filters=Y{/capture}{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);

		// Convert advanced link
		$tpl_source = str_replace('{$reset_qstring}&amp;advanced_filter=Y', '{capture name="t_url"}{$reset_qstring}&amp;advanced_filter=Y{/capture}{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);

		// Convert range link
		$tpl_source = str_replace('{$filter_qstring}&amp;features_hash={$smarty.request.features_hash|fn_add_range_to_url_hash:$range:$filter.field_type}', '{capture name="t_url"}{$filter_qstring}&amp;features_hash={$smarty.request.features_hash|fn_add_range_to_url_hash:$range:$filter.field_type}{/capture}{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);
		
		// Convert links in "more" section
		$tpl_source = str_replace('{$filter_qstring}&features_hash={$fh|fn_add_range_to_url_hash:$r:$filter.field_type}', '{capture name="t_url"}{$filter_qstring}&features_hash={$fh|fn_add_range_to_url_hash:$r:$filter.field_type}{/capture}{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);

		// Convert reset link
		$tpl_source = str_replace('{$reset_qstring}{if $fh}&amp;features_hash={$fh}{/if}{$extra_query}', '{capture name="t_url"}{$reset_qstring}{if $fh}&amp;features_hash={$fh}{/if}{$extra_query}{/capture}{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);
	}

	//Convert Sitemap links
	if (preg_match_all('/(\{\$index_script\}\?dispatch=sitemap.view)/', $tpl_source, $matches)) {
		foreach ($matches[0] as $match) {
			$tpl_source = str_replace($match, $prefix . 'sitemap.html', $tpl_source);
		}
	}

	// Convert path
	if (preg_match_all('/["\']+(\{\$index_script\})/', $tpl_source, $matches)) {
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match . '?', '{$index_script}?', $tpl_source);
			break;
		}
	}

	// Convert form actions
	if (preg_match_all('/(action=["\']\{\$index_script\})["\']+/', $tpl_source, $matches)) {
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match . '"', 'action="' . $index_script . '"', $tpl_source);
			$tpl_source = str_replace($match . "'", 'action=\'' . $index_script . "'", $tpl_source);
			break;
		}
	}

	// Convert index
	if (preg_match_all('/(\{\$index_script\})["\']+/', $tpl_source, $matches)) {
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match . '"', $prefix . '"', $tpl_source);
			$tpl_source = str_replace($match . "'", $prefix . "'", $tpl_source);
			break;
		}
	}

	// Convert "Continue shopping" button link
	if (preg_match_all('/\=(\$continue_url\|default\:\$index_script)/', $tpl_source, $matches)) {
		$matches[1] = array_unique($matches[1]); // avoid duplicates
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match, $match . '|fn_convert_php_urls', $tpl_source);
		}
	}

	// Convert language/currency/localization selector
	if (preg_match_all('/="(\{\$link_tpl\}\{\$id\})"/', $tpl_source, $matches)) {
		$matches[1] = array_unique($matches[1]); // avoid duplicates
		foreach ($matches[1] as $match) {
			$tpl_source = str_replace($match, "{capture name='t_url'}" . $match . '{/capture}{$smarty.capture.t_url|fn_convert_php_urls}', $tpl_source);
		}
	}

	if (Registry::get('addons.seo.html_catalog') == 'Y') {
		// Remove dynamic blocks
		if (preg_match_all("/<\!--dynamic\b[^>]*>(?:(?>[^<]+)|<(?!--dynamic\b[^>]*>))*?<\!--\/dynamic-->/", $tpl_source, $matches)) {
			foreach ($matches[0] as $match) {
				$tpl_source = str_replace($match, '{if !$seo_url.static}' . $match . '{/if}', $tpl_source);
			}
		}
	}

	return $tpl_source;
}

function fn_seo_add_breadcrumb($lang_value, &$link)
{
	if (AREA == 'C') {
		fn_convert_php_urls($link, false);

		return true;
	}
}

//
// This function is to add url_prefix
//
function fn_seo_redirect(&$link)
{
	if (AREA != 'C') {
		return true;
	}


	fn_convert_php_urls($link, false);

	// Redirect function uses relative links, so remove prefix (but keep "catalog")
	$c_path = fn_seo_get_current_path(true);
	$link = substr($link, strlen($c_path) + 1);

	return true;
}

//
// Convert urls to SEO friendly
//
function fn_convert_php_urls(&$link, $escape = true)
{
	$index_script = INDEX_SCRIPT;
	$d = SEO_DELIMITER;

	$link = str_replace('&amp;', '&', $link);

	if (strpos($link, '://') !== false) {
		if ((($p = strpos($link, Registry::get('config.http_location'))) !== false || strpos($link, Registry::get('config.https_location')) !== false)) {
			$link = str_replace(((!empty($p) || $p !== false) ? Registry::get('config.http_location') : Registry::get('config.https_location')) . '/', '', $link);
		} else {
			// This is external link
			return $link;
		}
	}

	// link prefix starts from root web directory
	$prefix = fn_seo_get_current_path() . '/' . ((Registry::get('addons.seo.seo_language') == 'Y') ? (strtolower(CART_LANGUAGE) . '/') : '');

	// Remove query string
	if (strpos($link, '?') !== false) {
		$l = substr($link, strpos($link, '?') + 1); // parse query string is exist
		$link = str_replace('?' . $l, '', $link);
		parse_str($l, $res);
	} else {
		$res = array();
	}

	// If we have language parameter in url
	if (!empty($res['sl']) && Registry::get('addons.seo.seo_language') == 'Y') {
		$prefix = fn_seo_get_current_path() . '/' . strtolower($res['sl']) . '/';
		$sl = $res['sl']; // save current value to add it to url again if link won't be rewritten
		unset($res['sl']);
	}
	
	//Convert index page

	if ($link == $index_script && empty($res['dispatch'])) {

		$link = $prefix;
		if (!empty($res)) {
			$link .= '?' . fn_build_query($res);
		}
	} else {
		@list($controller, $mode) = explode('.', $res['dispatch']);

		// Convert products links
		if ($controller == 'products' && !empty($res['product_id'])) {

			$link = $prefix . fn_seo_link('p', $res['product_id'], '', '', $res, true);

		// Convert categories links
		} elseif ($controller == 'categories' && !empty($res['category_id'])) {

			$link = $prefix . fn_seo_link('c', $res['category_id'], '', '', $res, true);

		// Convert pages links
		} elseif ($controller == 'pages' && !empty($res['page_id'])) {

			$link = $prefix . fn_seo_link('a', $res['page_id'], '', '', $res, true);

		// Convert extended features links
		} elseif ($controller == 'product_features' && !empty($res['variant_id'])) {

			$link = $prefix . fn_seo_link('e', $res['variant_id'], '', '', $res, true);

		// Convert sitemap
		} elseif ($controller == 'sitemap') {
			$link = $prefix . 'sitemap.html';

		// Convert catalog
		} elseif ($controller == 'categories' && $mode == 'catalog') {
			$link = $prefix . 'catalog.html';

		// Other conversions
		} else {

			$t = $link; // save link state before hook
			fn_set_hook('convert_php_url', $link, $res, $d);

			if ($t == $link) { // check - if was not changed, generate it again
				if (!empty($sl)) { // return the selected language code to url again
					$res['sl'] = $sl;
				}
				$link = fn_seo_get_current_path() . '/' . $link . (!empty($res) ? '?' . fn_build_query($res) : '');
			}
		}
	}

	if ($escape == true) {
		$link = htmlspecialchars($link);
	}

	return $link;
}

function fn_seo_exim_get_product_url(&$url, $product_id, $seo)
{
	if ($seo == 'Y') {
		$url = 'http://' . Registry::get('config.http_host') . fn_seo_link('p', $product_id);
	}

	return true;
}

function fn_delete_seo_name($object_id, $object_type)
{
	db_query("DELETE FROM ?:seo_names WHERE object_id = ?i AND type = ?s", $object_id, $object_type);

	return true;
}


function fn_seo_delete_product($product_id)
{
	return fn_delete_seo_name($product_id, 'p');
}

function fn_seo_delete_category($category_id)
{
	return fn_delete_seo_name($category_id, 'c');
}

function fn_seo_delete_page($page_id)
{
	return fn_delete_seo_name($page_id, 'a');
}

function fn_create_seo_name($object_id, $object_type, $object_name, $index = 0)
{

	$_object_name = preg_replace("/[^-_a-zA-Z0-9]?/", "", fn_generate_name($object_name));
	if (empty($_object_name)) {
		$__name = fn_get_seo_vars($object_type);
		$_object_name = $__name['description'] . '-' . $object_id;
	}

	$exist = db_get_field("SELECT name FROM ?:seo_names WHERE name = ?s AND (object_id != ?i OR type != ?s)", $_object_name, $object_id, $object_type);
	if (!$exist) {
		$_data = array(
			'name' => $_object_name,
			'type' => $object_type,
			'object_id' => $object_id
			);
		db_query("REPLACE INTO ?:seo_names ?e", $_data);
	} else {
		$index ++;
		fn_create_seo_name($object_id, $object_type, $object_name . SEO_DELIMITER . $index, $index);
	}

	return $_object_name;
}

function fn_clone_seo_name($product_id, $old_name, $new_name)
{
	// Here we will use Product-name-2.html instead of  Product-name-[CLONE].html
	fn_create_seo_name($product_id, 'p', $old_name . SEO_DELIMITER . '2', 2);

	return true;
}

function fn_seo_clone_product($product_id, $to_product_id)
{
	$name = db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $to_product_id, CART_LANGUAGE);
	fn_create_seo_name($to_product_id, 'p', $name . SEO_DELIMITER . '2', 2);
}

/********************************* GET OBJECTS SEO NAMES ***********************************************/
function fn_get_seo_name($object_id, $object_type, $object_name = '')
{
	static $cache = array();

	if (empty($cache[$object_id . $object_type])) {
		$seo_name = db_get_field("SELECT name FROM ?:seo_names WHERE object_id = ?i AND type = ?s", $object_id, $object_type);
		if (empty($seo_name)) {
			if (empty($object_name)) {
				$_seo = fn_get_seo_vars($object_type);
				$suffix = array(
					'f' => "AND type = 'T'"
				);
				$object_name = db_get_field("SELECT $_seo[description] FROM $_seo[table] WHERE lang_code = ?s {$suffix[$object_type]} AND $_seo[item] = ?i", CART_LANGUAGE, $object_id);
			}
			$seo_name = fn_create_seo_name($object_id, $object_type, $object_name);
		}

		$cache[$object_id . $object_type] = $seo_name;
	}

	return $cache[$object_id . $object_type];
}

function fn_seo_get_product_data($product_id, &$field_list, &$join)
{
	$field_list .= ', ?:seo_names.name as seo_name';
	$join .= db_quote(" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i AND ?:seo_names.type = 'p'", $product_id);

	return true;
}

function fn_seo_get_products(&$params, &$fields, &$sortings, &$condition, &$join)
{
	$fields[] = '?:seo_names.name as seo_name';
	$join .= " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = products.product_id AND ?:seo_names.type = 'p'";
}

function fn_seo_get_category_data($category_id, &$field_list, &$join)
{
	$field_list .= ', ?:seo_names.name as seo_name';
	$join .= db_quote(" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i AND ?:seo_names.type = 'c'", $category_id);

	return true;
}

function fn_seo_get_page_data(&$page_data)
{
	$page_data['seo_name'] = db_get_field("SELECT name FROM ?:seo_names WHERE object_id = ?i AND type = 'a'", $page_data['page_id']);

	return true;
}
//******************************         ******************************//

function fn_get_seo_vars($type = '')
{
	$seo = array(
		'p' => array(
			'table' => '?:product_descriptions',
			'description' => 'product',
			'dispatch' => 'products.view',
			'item' => 'product_id',
		),
		'c' => array(
			'table' => '?:category_descriptions',
			'description' => 'category',
			'dispatch' => 'categories.view',
			'item' => 'category_id',
		),
		'a' => array(
			'table' => '?:page_descriptions',
			'description' => 'page',
			'dispatch' => 'pages.view',
			'item' => 'page_id',
		),
		'e' => array(
			'table' => '?:product_feature_variant_descriptions',
			'description' => 'variant',
			'dispatch' => 'product_features.view',
			'item' => 'variant_id',
		),
	);

	fn_set_hook('get_seo_vars', $seo);

	return (!empty($type)) ? $seo[$type] : $seo;
}

function fn_get_rewrite_rules()
{
	$customer_index = Registry::get('config.customer_index');

	$prefix = (Registry::get('addons.seo.html_catalog') == 'Y') ? '\/(catalog)' : '()';
	$prefix .= (Registry::get('addons.seo.seo_language') == 'Y') ? '\/([a-z]{2})' : '()';

	$rewrite_rules = array();

	fn_set_hook('get_rewrite_rules', $rewrite_rules, $prefix);

	$rewrite_rules['!^(.*)?' . $prefix . '\/catalog\.html$!'] = '$customer_index?dispatch=categories.catalog&sl=$matches[3]';
	$rewrite_rules['!^(.*)?' . $prefix . '\/sitemap\.html$!'] = '$customer_index?dispatch=sitemap.view&sl=$matches[3]';
	$rewrite_rules['!^(.*)?' . $prefix . '\/(.*\/)?([^\/]+)-page-([0-9]+|full_list)\.(html)$!'] = 'object_name=$matches[5]&page=$matches[6]&sl=$matches[3]&extension=$matches[7]';
	$rewrite_rules['!^(.*)?' . $prefix . '\/(.*\/)?([^\/]+)\.(html)$!'] = 'object_name=$matches[5]&sl=$matches[3]&extension=$matches[6]';
	if (Registry::get('addons.seo.seo_language') == 'Y') {
		$rewrite_rules['!^(.*)?' . $prefix . '\/?$!'] = '$customer_index?sl=$matches[3]';
	}
	if (Registry::get('addons.seo.seo_category_type') == 'category') {
		$rewrite_rules['!^(.*)?' . $prefix . '\/(.*\/)?([^\/]+)\/page-([0-9]+|full_list)(\/)?$!'] = 'object_name=$matches[5]&page=$matches[6]&sl=$matches[3]';
		$rewrite_rules['!^(.*)?' . $prefix . '\/(.*\/)?([^\/?]+)\/?$!'] = 'object_name=$matches[5]&sl=$matches[3]';
	} else {
		$rewrite_rules['!^(.*)?' . $prefix . '\/(.*\/)?([^\/?]+)\/?$!'] = 'object_name=_wrong_path_&sl=$matches[3]';
	}
	//$rewrite_rules['!^(.*)?/$!'] = '';

	return $rewrite_rules;
}

function fn_seo_get_route(& $req)
{
	$config = & Registry::get('config');
	$seo_settings = & Registry::get('addons.seo');

	if ((AREA == 'C') && !empty($req['sef_rewrite'])) {

		// Remove web directory from request
		if (!preg_match('!^(.*)?/('.$config['customer_index'].')(.*)$!', $_SERVER['REQUEST_URI'])) {

			$url_pattern = parse_url($_SERVER['REQUEST_URI']);
			$rewrite_rules = fn_get_rewrite_rules();

			foreach ($rewrite_rules as $pattern => $query) {
				if (preg_match($pattern, $url_pattern['path'], $matches) || preg_match($pattern, urldecode($query), $matches)) {
					$_query = preg_replace("!^.+\?!", '', $query);
					parse_str($_query, $objects);
					$result_values = 'matches';

					foreach ($objects as $key => $value) {
						preg_match('!^.+\[([0-9])+\]$!', $value, $_id);
						$objects[$key] = (substr($value, 0, 1) == '$') ? ${$result_values}[$_id[1]] : $value;
					}

					// For the locations wich names stored in the table
					if (!empty($objects) && !empty($objects['object_name'])) {
						$_seo = db_get_row("SELECT * FROM ?:seo_names WHERE name = ?s", $objects['object_name']);
						if (!empty($_seo)) {
							if (fn_seo_validate_object($_seo, $url_pattern['path'], $objects) == false) {
								return false;
							}

							$_seo_vars = fn_get_seo_vars($_seo['type']);
							$page_suffix = (!empty($objects['page'])) ? ('&page=' . $objects['page']) : '';
							$query = 'dispatch=' . $_seo_vars['dispatch'] .'&'. $_seo_vars['item'] .'='. $_seo['object_id'] . $page_suffix;

							$req['dispatch'] = $_seo_vars['dispatch'];
							$req[$_seo_vars['item']] = $_seo['object_id'];

						} elseif (!strstr($config['http_path'], $objects['object_name']) || strlen($objects['object_name']) == 2) {
							$req = array(
								'dispatch' => '_no_page'
							);

							return false;
						}

					// For the locations wich names are not in the table
					} elseif (!empty($objects)) {
						$query = empty($objects['dispatch']) ? '' : "dispatch=$objects[dispatch]";
						$req['dispatch'] = @$objects['dispatch'];

					// Empty query
					} else {
						$query = '';
					}

					if (!empty($objects['page'])) {
						$req['page'] = $objects['page'];
					}
					if (!empty($objects['sl'])) {
						$req['sl'] = strtoupper($objects['sl']);
					}

					Registry::set('seo_url', array(
						'page' => substr($_SERVER['REQUEST_URI'], strlen((defined('HTTPS') ? $config['https_path'] : $config['http_path'])) + 1),
						'href' => $_SERVER['REQUEST_URI'],
						'query' => substr(strstr($_SERVER['REQUEST_URI'], '?'), 1),
						'static' => (Registry::get('addons.seo.html_catalog') == 'Y')
					));

					$_SERVER['REQUEST_URI'] = $config['customer_index'] . '?' . $query;
					$_SERVER['QUERY_STRING'] = $query . (!empty($_SERVER['QUERY_STRING']) ? '&' . $_SERVER['QUERY_STRING'] : '');
					break;
				}
			}

			if ($su = Registry::get('seo_url')) {
				if ($su['static']) {
					Registry::set('seo_path', $url_pattern['path']);
					// Disable dynamic options
					Registry::set('settings.DHTML.customer_ajax_based_pagination', 'N');
					Registry::set('settings.DHTML.ajax_add_to_cart', 'N');
					Registry::set('settings.DHTML.ajax_comparison_list', 'N');
					// Disable session
					fn_define('NO_SESSION', true);

					// Capture page output
					ob_start('fn_seo_generate_page');
				}
			} else {
				$req = array(
					'dispatch' => '_no_page'
				);
			}
		}

		unset($req['sef_rewrite']);
		$_SERVER['QUERY_STRING'] = fn_query_remove($_SERVER['QUERY_STRING'], 'sef_rewrite');
	}
}

function fn_seo_generate_page($text)
{
	$path = Registry::get('seo_path');
	$path = substr($path, strlen((defined('HTTPS') ? Registry::get('config.https_path') : Registry::get('config.http_path'))) + 1); // remove path prefix
	$path = substr($path, strlen('catalog') + 1); // remove catalog prefix
	$path = rtrim($path, '/'); // remove trailing slash

	if (strpos($path, '.html') !== false) {
		$file = basename($path);
		$dir = dirname($path);
	} else {
		$file = 'index.html';
		$dir = $path;
	}

	fn_mkdir(DIR_ROOT . '/catalog/' . $dir);
	fn_put_contents(DIR_ROOT . '/catalog/' . $dir . '/' . $file, $text);

	return $text;
}

function fn_seo_update_category($category_data, $category_id)
{
	if (isset($category_data['seo_name'])) {
		fn_create_seo_name($category_id, 'c', (!empty($category_data['seo_name'])) ? $category_data['seo_name'] : $category_data['category']);
	}
}

function fn_seo_update_product($product_data, $product_id)
{
	if (isset($product_data['seo_name'])) {
		fn_create_seo_name($product_id, 'p', (!empty($product_data['seo_name'])) ? $product_data['seo_name'] : $product_data['product']);
	}
}

function fn_seo_update_page($page_data, $page_id)
{
	if (!empty($page_data['page']) && !empty($page_id)) {  // Checking for required fields for new page
		$object_name = (!empty($page_data['seo_name'])) ? $page_data['seo_name'] : $page_data['page'];
		fn_create_seo_name($page_id, "a", $object_name);
	}
}

function fn_seo_update_product_feature($feature_data, $feature_id, $deleted_variants)
{
	if ($feature_data['feature_type'] == 'E' && !empty($feature_data['variants'])) {
		foreach ($feature_data['variants'] as $v) {
			if (!empty($v['variant_id'])) {
				fn_create_seo_name($v['variant_id'], 'e', (!empty($v['seo_name'])) ? $v['seo_name'] : $v['variant']);
			}
		}

		if (!empty($deleted_variants)) {
			db_query("DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s", $deleted_variants, 'e');
		}
	}
}

function fn_seo_get_product_feature_variants(&$fields, &$join, &$condition)
{
	$fields[] = '?:seo_names.name as seo_name';
	$join .= " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:product_feature_variants.variant_id AND ?:seo_names.type = 'e'";
}


function fn_seo_init_templater(&$view, &$view_mail)
{
	if (AREA == 'C') {
		$view->register_prefilter('fn_convert_tpl_urls');
		if ($su = Registry::get('seo_url')) {
			if (!empty($su['static'])) {
				$view->assign('stay_in_cart', true);
			}
		}
	}
}

function fn_seo_validate_object($seo, $path, $objects)
{
	$result = true;
	$path = substr($path, strlen((defined('HTTPS') ? Registry::get('config.https_path') : Registry::get('config.http_path'))) + 1); // remove path prefix
	$path = substr_replace($path, '', strrpos($path, $objects['object_name'])); // remove object from path

	if (Registry::get('addons.seo.html_catalog') == 'Y') {
		$path = substr($path, strlen('catalog') + 1); // remove catalog prefix
	}

	if (Registry::get('addons.seo.seo_language') == 'Y' && !empty($objects['sl'])) {
		$path = substr($path, 3); // remove language prefix
	}

	$path = rtrim($path, '/'); // remove trailing slash

	// check parent objects
	$vars = fn_get_seo_vars($seo['type']);
	$id_path = '';
	if ($seo['type'] == 'p') {
		if (Registry::get('addons.seo.seo_product_type') == 'product_category') {
			$id_path = db_get_field("SELECT id_path FROM ?:categories as c LEFT JOIN ?:products_categories as p ON p.category_id = c.category_id WHERE p.product_id = ?i AND p.link_type = 'M'", $seo['object_id']);
		}
		$result = fn_seo_validate_parents($path, $id_path, 'c');

	} elseif ($seo['type'] == 'c') {
		$id_path = db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i AND parent_id != 0", $seo['object_id']);
		$result = fn_seo_validate_parents($path, $id_path, 'c', true);

	} elseif ($seo['type'] == 'a') {
		if (Registry::get('addons.seo.seo_product_type') == 'product_category') {
			$id_path = db_get_field("SELECT id_path FROM ?:pages WHERE page_id = ?i AND parent_id != 0", $seo['object_id']);
		}
		$result = fn_seo_validate_parents($path, $id_path, 'c', true);
	}

	// check for .html extension for the current object
	if ((in_array($seo['type'], array('p', 'a')) && empty($objects['extension'])) || ($seo['type'] == 'c' && Registry::get('addons.seo.seo_category_type') == 'category' && !empty($objects['extension']))) {
		$result = false;
	}

	fn_set_hook('validate_sef_object', $path, $seo, $vars, $result);

	return $result;
}

function fn_seo_validate_parents($path, $id_path, $parent_type, $trim_last = false)
{
	$result = true;

	if (!empty($id_path)) {
		if ($trim_last == true) {
			$id_path = explode('/', $id_path);
			array_pop($id_path);
		}

		$parent_names = explode('/', $path);
		$parent_ids = is_array($id_path) ? $id_path : explode('/', $id_path);

		if (count($parent_ids) == count($parent_names)) {
			$parents = db_get_hash_single_array("SELECT object_id, name FROM ?:seo_names WHERE name IN (?a) AND type = ?s", array('object_id', 'name'), $parent_names, $parent_type);

			foreach ($parent_ids as $k => $id) {
				if (empty($parents[$id]) || $parent_names[$k] != $parents[$id]) {
					$result = false;
					break;
				}
			}
		} else {
			$result = false;
		}
	} elseif (!empty($path)) { // if we have no parents, but some was passed via URL
		$result = false;
	}

	return $result;
}

function fn_seo_html_catalog_info()
{
	$index_script = INDEX_SCRIPT;
	$text = fn_get_lang_var('text_seo_html_catalog_notice');

	return str_replace('[url]', "$index_script?dispatch=html_catalog.clean_up", $text);
}

?>
