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
// $Id: func.php 7712 2009-07-14 13:41:57Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

function fn_statistics_init_secure_controllers($controllers)
{
	$controllers['statistics'] = 'passive';
}

//
// Search requests for LiveHelp
// $group_name - LH variable (visitors)
// $result - array entities of $group_name
function fn_statistics_livehelp_get_group_data($group_name, &$result)
{
	if ($group_name == 'visitors' && !empty($result)) {
		foreach ($result as $k => $v) {
			if (!empty($v['ip'])) {
				$sess_id = db_get_field("SELECT MAX(sess_id) FROM ?:stat_sessions WHERE host_ip = ?i", $v['ip']);
				$sess_data = db_get_row("SELECT CONCAT(?:stat_browsers.browser, ', ', ?:stat_browsers.version) AS browser, ?:stat_sessions.os, ?:stat_sessions.referrer, CONCAT(?:stat_ips.country_code, '|', ?:country_descriptions.country) AS country FROM ?:stat_sessions LEFT JOIN ?:stat_browsers ON ?:stat_sessions.browser_id = ?:stat_browsers.browser_id LEFT JOIN ?:stat_ips ON ?:stat_sessions.ip_id = ?:stat_ips.ip_id LEFT JOIN ?:country_descriptions ON ?:stat_ips.country_code = ?:country_descriptions.code AND ?:country_descriptions.lang_code = ?s WHERE sess_id = ?i", CART_LANGUAGE, $sess_id);
				if (!empty($sess_data)) {
					$result[$k]['browser'] = htmlentities($sess_data['browser']);
					$result[$k]['os'] = htmlentities($sess_data['os']);
					$result[$k]['referer'] = htmlentities($sess_data['referrer']);
					$result[$k]['country'] = htmlentities($sess_data['country']);
				}

				$req_id = db_get_field("SELECT MAX(req_id) FROM ?:stat_requests WHERE sess_id = ?i", $sess_id);
				$req_data = db_get_row("SELECT url, title FROM ?:stat_requests WHERE req_id = ?i", $req_id);
				if (!empty($req_data)) {
					$result[$k]['href'] = htmlentities($req_data['url']);
					$result[$k]['title'] = htmlentities($req_data['title']);
				}
			}
		}
	}

}

function fn_statistics_get_banners(&$banners)
{
	if (AREA == 'C' && !fn_is_empty($banners) && !defined('AJAX_REQUEST')) {
		foreach ($banners as $k => $v) {
			if ($v['type'] == 'T' && !empty($v['description'])) {
				if (preg_match_all('/href=([\'|"])(.*?)([\'|"])/i', $v['description'], $matches)) {
					foreach ($matches[0] as $match_key => $match) {
						$banners[$k]['description'] = str_replace($matches[2][$match_key], Registry::get('config.customer_index') . "?dispatch=statistics.banners&amp;banner_id=$v[banner_id]&amp;redirect_url=" . urlencode($matches[2][$match_key]), $banners[$k]['description']);
					}
				}

			} elseif (!empty($v['url'])) {
				$banners[$k]['url'] = Registry::get('config.customer_index') . "?dispatch=statistics.banners&banner_id=$v[banner_id]&redirect_url=" . urlencode($v['url']);
			}

			db_query('INSERT INTO ?:stat_banners_log ?e', array('banner_id' => $v['banner_id'], 'type' => 'V', 'timestamp' => TIME));
		}
	} else {
		return false;
	}
}

function fn_statistics_delete_banners($banner_id)
{
	db_query("DELETE FROM ?:stat_banners_log WHERE banner_id = ?i", $banner_id);
}

function fn_check_search_robot($user_agent = '')
{
	static $robot_agents;

	if (!isset($robot_agents)) {
		$robot_agents = db_get_hash_array("SELECT robot_id, exclusion_useragent FROM ?:stat_search_robots WHERE exclusion_useragent != ''", 'robot_id');
	}

	if (empty($user_agent)) {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
	}

	foreach ($robot_agents as $r_id => $agent) {
		if (strpos(strtolower($user_agent), strtolower($agent['exclusion_useragent'])) !== false) {
			return array('robot_id' => $r_id, 'client_type' => 'B');
		}
	}

	return false;
}

function fn_statistics_search_by_objects($conditions)
{
	if (!empty($conditions['products'])) {
		$obj = $conditions['products'];
		$total = db_get_field("SELECT COUNT(DISTINCT($obj[table].$obj[key])) FROM ?:products as $obj[table] $obj[join] WHERE $obj[condition]");
		Registry::get('view')->assign('product_count', $total);
	}
}
?>
