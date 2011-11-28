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
// $Id: profiles.pre.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($mode == 'update' || $mode == 'add') {
		if (fn_email_is_blocked($_REQUEST['user_data'], true)) {
			return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=profiles.update" . ((AREA == 'A' && !empty($_REQUEST['user_id'])) ? "&user_id=$_REQUEST[user_id]" : ''));
		}
	}

	return;
}

/** /Body **/
?>
