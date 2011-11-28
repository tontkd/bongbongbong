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
// $Id: index.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}

if ($mode == 'set_post_status') {

	$new_status = ($_REQUEST['new_status'] === 'A') ? 'A' : 'D';
	db_query("UPDATE ?:discussion_posts SET ?u WHERE post_id = ?i", array('status' => $new_status), $_REQUEST['post_id']);

	$post = db_get_row("SELECT * FROM ?:discussion_posts WHERE post_id = ?i", $_REQUEST['post_id']);
	$view->assign('post', $post);
	if (defined('AJAX_REQUEST')) {
		$view->display('addons/discussion/views/index/components/dashboard_status.tpl');
		exit;
	}
	return array(CONTROLLER_STATUS_OK, "$index_script");
}

if ($mode == 'delete_post' && defined('AJAX_REQUEST')) {
	db_query("DELETE FROM ?:discussion_messages WHERE post_id = ?i", $_REQUEST['post_id']);
	db_query("DELETE FROM ?:discussion_rating WHERE post_id = ?i", $_REQUEST['post_id']);
	db_query("DELETE FROM ?:discussion_posts WHERE post_id = ?i", $_REQUEST['post_id']);
	return array(CONTROLLER_STATUS_OK, "$index_script");
}


$latest_posts = db_get_array("SELECT a.post_id, a.ip_address, a.status, a.timestamp, b.object_id, b.object_type, b.type, a.name, c.message, d.rating_value FROM ?:discussion_posts as a LEFT JOIN ?:discussion as b ON a.thread_id = b.thread_id LEFT JOIN ?:discussion_messages as c ON a.post_id = c.post_id LEFT JOIN ?:discussion_rating as d ON a.post_id = d.post_id ORDER BY a.timestamp DESC LIMIT 5");

if (!empty($latest_posts)) {
	foreach ($latest_posts as $k => $v) {
		$latest_posts[$k]['object_data'] = fn_get_discussion_object_data($v['object_id'], $v['object_type'], DESCR_SL);
		$latest_posts[$k]['rating'] = fn_get_discussion_rating($v['rating_value']);
	}
}

$view->assign('discussion_objects', fn_get_discussion_objects());
$view->assign('latest_posts', $latest_posts);

if ($mode == 'delete_post' && defined('AJAX_REQUEST')) { // FIXME - bad style
	$view->display('addons/discussion/views/index/components/dashboard.tpl');
	exit;
}

?>
