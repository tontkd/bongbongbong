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
// $Id: payment_notification.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if (!empty($_REQUEST['payment'])) {
	define('PAYMENT_NOTIFICATION', true);

	$payment = basename($_REQUEST['payment']);
	include(DIR_PAYMENT_FILES . $payment . '.php');
}

?>
