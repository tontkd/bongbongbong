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
// $Id: admin.php 7808 2009-08-12 14:28:04Z zeke $
//

define('AREA', 'A');
define('AREA_NAME' ,'admin');

require './prepare.php';
require './init.php';

define('INDEX_SCRIPT',  Registry::get('config.admin_index'));

fn_dispatch();

?>
