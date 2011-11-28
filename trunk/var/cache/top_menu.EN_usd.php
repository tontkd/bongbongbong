<?php
 if ( !defined('AREA') )	{ die('Access denied');	}
 $_cache_data = array (
  23 => 
  array (
    'param_id' => '23',
    'param_2' => 'index',
    'param_3' => '',
    'param_4' => '',
    'param_5' => '',
    'status' => 'A',
    'position' => '1',
    'parent_id' => '0',
    'id_path' => '',
    'item' => 'Home',
    'href' => 'index.php',
  ),
  24 => 
  array (
    'param_id' => '24',
    'param_2' => 'categories.catalog, categories.view, products.search, products.view',
    'param_3' => '',
    'param_4' => '',
    'param_5' => '',
    'status' => 'A',
    'position' => '2',
    'parent_id' => '0',
    'id_path' => '',
    'item' => 'Catalog',
    'href' => 'index.php?dispatch=categories.catalog',
  ),
  25 => 
  array (
    'param_id' => '25',
    'param_2' => 'profiles, auth',
    'param_3' => '',
    'param_4' => '',
    'param_5' => '',
    'status' => 'A',
    'position' => '3',
    'parent_id' => '0',
    'id_path' => '',
    'item' => 'My Account',
    'href' => 'index.php?dispatch=profiles.update',
  ),
  26 => 
  array (
    'param_id' => '26',
    'param_2' => 'checkout',
    'param_3' => '',
    'param_4' => '',
    'param_5' => '',
    'status' => 'A',
    'position' => '4',
    'parent_id' => '0',
    'id_path' => '',
    'item' => 'View cart',
    'href' => 'index.php?dispatch=checkout.cart',
  ),
  27 => 
  array (
    'param_id' => '27',
    'param_2' => 'pages',
    'param_3' => 'A:0:Y',
    'param_4' => 'left',
    'param_5' => '',
    'status' => 'A',
    'position' => '100',
    'parent_id' => '0',
    'id_path' => '27',
    'subitems' => 
    array (
      0 => 
      array (
        'param_4' => 'left',
        'item' => 'About our company',
        'href' => 'index.php?dispatch=pages.view&page_id=3',
      ),
      1 => 
      array (
        'param_4' => 'left',
        'item' => 'Contact us',
        'href' => 'index.php?dispatch=pages.view&page_id=1',
      ),
      2 => 
      array (
        'param_4' => 'left',
        'item' => 'What is CS-Cart?',
        'href' => 'index.php?dispatch=pages.view&page_id=2',
      ),
    ),
    'item' => 'Company',
    'href' => 'index.php?dispatch=pages.view&page_id=3',
  ),
)
?>