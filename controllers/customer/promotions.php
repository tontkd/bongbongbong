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
// $Id: promotions.php 7502 2009-05-19 14:54:59Z zeke $
//

if (!defined('AREA') ) { die('Access denied'); }

if ($mode == 'list') {
	$params = array (
		'active' => true,
		/*'zone' => 'catalog',*/
		'get_hidden' => false,
	);

	list($promotions) = fn_get_promotions($params);

	$view->assign('promotions', $promotions);
}

?>
