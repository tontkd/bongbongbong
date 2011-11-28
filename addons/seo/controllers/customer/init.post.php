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
// $Id: init.post.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}

// Register url rewriter

// Set flag that SEO is enabled
if (!file_exists($view->compile_dir . '/mod_rewrite')) {
	fn_rm($view->compile_dir, false);
	$fd = fopen($view->compile_dir . '/mod_rewrite', 'w');
	fclose($fd);
}

$view->assign('seo_url', Registry::get('seo_url')); // FIXME: what is $seo_url ?

?>
