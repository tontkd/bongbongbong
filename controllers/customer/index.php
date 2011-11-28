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
// $Id: index.php 7636 2009-06-30 07:03:06Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Forbid posts to index script
//
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	return array(CONTROLLER_STATUS_NO_PAGE);
}



?>
