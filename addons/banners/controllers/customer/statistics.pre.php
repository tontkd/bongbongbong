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
// $Id: statistics.php 6788 2009-01-16 13:29:11Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}

if ($mode == 'banners') {

	if (!empty($_REQUEST['banner_id'])) {
		// Check if banner exists
		$is_exist = db_get_field("SELECT banner_id FROM ?:banners WHERE banner_id = ?i AND status IN ('A', 'H')", $_REQUEST['banner_id']);
		if (!empty($is_exist)) {
			db_query('INSERT INTO ?:stat_banners_log ?e', array('banner_id' => $_REQUEST['banner_id'], 'timestamp' => TIME));
			if (empty($_REQUEST['redirect_url'])) {
				$redirect_url = db_get_field("SELECT url FROM ?:banners WHERE banner_id = ?i", $_REQUEST['banner_id']);
			} else {
				$redirect_url = $_REQUEST['redirect_url'];
			}
		} else {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		return array(CONTROLLER_STATUS_REDIRECT, $redirect_url, true);
	}

}

?>
