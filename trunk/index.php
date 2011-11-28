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
// $Id: index.php 7808 2009-08-12 14:28:04Z zeke $
//
define('AREA', 'C');
define('AREA_NAME' ,'customer');
require './prepare.php';
require './init.php';

define('INDEX_SCRIPT', Registry::get('config.customer_index'));

fn_dispatch();

?>
