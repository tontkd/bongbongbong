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
// $Id: pages.php 7543 2009-05-29 08:08:14Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}


//
// View page details
//
if ($mode == 'view') {

	$page = fn_get_page_data($_REQUEST['page_id'], CART_LANGUAGE);

	if (empty($page) || $page['status'] == 'D') {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	if (!empty($page['meta_description']) || !empty($page['meta_keywords'])) {
		$view->assign('meta_description', $page['meta_description']);
		$view->assign('meta_keywords', $page['meta_keywords']);
	}

	// If page title for this page is exist than assign it to template
	if (!empty($page['page_title'])) {
		$view->assign('page_title', $page['page_title']);
	}

	$parent_ids = explode('/', $page['id_path']);
	$page_names = fn_get_page_name($parent_ids);
	foreach($page_names as $p_id => $p) {
		fn_add_breadcrumb($p, ($p_id == $page['page_id']) ? '' : "$index_script?dispatch=pages.view&page_id=$p_id");
	}

	list($page_children,) = fn_get_pages(array('parent_id' => $_REQUEST['page_id'], 'status' => 'A'));

	$view->assign('page', $page);
	$view->assign('page_children', $page_children);
}

?>
