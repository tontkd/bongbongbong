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
// $Id: profiles.php 7502 2009-05-19 14:54:59Z zeke $
//
if ( !defined('AREA') )	{ die('Access denied');	}

if (Registry::get('settings.General.secure_auth') == 'Y' && !defined('HTTPS')) {
	return array(CONTROLLER_STATUS_REDIRECT, Registry::get('config.https_location') . '/' . Registry::get('config.current_url'));
}

if (!empty($auth['user_id']) && $mode == 'add') {
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=profiles.update");
}

if (empty($auth['user_id']) && $mode == 'update') {
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=auth.login_form&return_url=".urlencode(Registry::get('config.current_url')));
}

?>
