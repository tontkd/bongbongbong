<?php
 if ( !defined('AREA') )	{ die('Access denied');	}
 $_cache_data = array (
  'C' => 
  array (
    'param' => 'card_code',
    'descr' => 'card_name',
    'add_title' => 'add_new_credit_cards',
    'edit_title' => 'editing_credit_card',
    'add_button' => 'add_credit_card',
    'mainbox_title' => 'credit_cards',
    'additional_params' => 
    array (
      0 => 
      array (
        'title' => 'cvv2',
        'type' => 'checkbox',
        'name' => 'param_2',
      ),
      1 => 
      array (
        'title' => 'start_date',
        'type' => 'checkbox',
        'name' => 'param_3',
      ),
      2 => 
      array (
        'title' => 'issue_number',
        'type' => 'checkbox',
        'name' => 'param_4',
      ),
    ),
    'icon' => 
    array (
      'title' => 'icon',
      'type' => 'credit_card',
    ),
    'has_localization' => true,
  ),
  'T' => 
  array (
    'param' => 'ID',
    'descr' => 'title',
    'add_title' => 'add_new_titles',
    'add_button' => 'add_title',
    'edit_title' => 'editing_title',
    'mainbox_title' => 'titles',
  ),
  'N' => 
  array (
    'param' => 'url',
    'descr' => 'link_text',
    'add_title' => 'add_new_items',
    'add_button' => 'add_item',
    'edit_title' => 'editing_item',
    'mainbox_title' => 'quick_links',
    'has_localization' => true,
  ),
  'A' => 
  array (
    'param' => 'url',
    'descr' => 'link_text',
    'add_title' => 'add_new_items',
    'add_button' => 'add_item',
    'edit_title' => 'editing_item',
    'mainbox_title' => 'top_menu',
    'additional_params' => 
    array (
      0 => 
      array (
        'title' => 'activate_menu_tab_for',
        'type' => 'input',
        'name' => 'param_2',
      ),
      1 => 
      array (
        'title' => 'generate_submenu',
        'type' => 'megabox',
        'name' => 'param_3',
      ),
      2 => 
      array (
        'title' => 'popup_direction',
        'type' => 'select',
        'name' => 'param_4',
        'values' => 
        array (
          'right' => 'right',
          'left' => 'left',
        ),
      ),
    ),
    'has_localization' => true,
    'multi_level' => true,
  ),
)
?>