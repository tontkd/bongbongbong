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
// $Id: news.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'view') {

	fn_add_breadcrumb(fn_get_lang_var('news'), "$index_script?dispatch=news.list");

	$news_data = fn_get_news_data($_REQUEST['news_id']);
	fn_add_breadcrumb($news_data['news']);

	$view->assign('news', $news_data);

} elseif ($mode == 'list') {

	fn_add_breadcrumb(fn_get_lang_var('news'));

	$params = $_REQUEST;
	$params['paginate'] = true;

	list($news, ) = fn_get_news($params, CART_LANGUAGE);

	$view->assign('news', $news);
}

?>