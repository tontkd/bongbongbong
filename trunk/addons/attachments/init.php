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
// $Id: init.php 7538 2009-05-27 15:55:45Z lexa $
//

if (!defined('AREA')) { die('Access denied'); }

fn_register_hooks(
	'revisions_publish',
	'revisions_delete_objects',
	'revisions_create_objects',
	'revisions_clone',
	'revisions_get_data',
	'create_revision_tables',
	'revisions_delete'
);

?>