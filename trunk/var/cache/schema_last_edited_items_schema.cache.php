<?php
 if ( !defined('AREA') )	{ die('Access denied');	}
 $_cache_data = array (
  'products.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_product_name',
      1 => '@product_id',
    ),
    'icon' => 'product-item',
    'text' => 'product',
  ),
  'orders.details' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_order_name',
      1 => '@order_id',
    ),
    'icon' => 'order-item',
    'text' => 'order',
  ),
  'categories.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_category_name',
      1 => '@category_id',
    ),
    'text' => 'category',
  ),
  'profiles.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_user_name',
      1 => '@user_id',
    ),
    'text' => 'user',
  ),
  'memberships.assign_privileges' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_membership_name',
      1 => '@membership_id',
    ),
    'text' => 'membership',
  ),
  'shippings.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_shipping_name',
      1 => '@shipping_id',
    ),
    'text' => 'shipping_method',
  ),
  'taxes.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_tax_name',
      1 => '@tax_id',
    ),
    'text' => 'tax',
  ),
  'destinations.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_destination_name',
      1 => '@destination_id',
    ),
    'text' => 'destination',
  ),
  'payments.manage' => 
  array (
    'text' => 'payment_methods',
  ),
  'pages.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_page_name',
      1 => '@page_id',
    ),
    'text' => 'page',
  ),
  'newsletters.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_newsletter_name',
      1 => '@newsletter_id',
    ),
    'text' => 'newsletter',
  ),
  'news.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_news_name',
      1 => '@news_id',
    ),
    'text' => 'news',
  ),
  'mailing_lists.manage' => 
  array (
    'text' => 'mailing_lists',
  ),
  'subscribers.manage' => 
  array (
    'text' => 'subscribers',
  ),
  'campaigns.manage' => 
  array (
    'text' => 'campaigns',
  ),
  'gift_certificates.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_gift_certificate_name',
      1 => '@gift_cert_id',
    ),
    'text' => 'certificate',
  ),
  'banners.update' => 
  array (
    'func' => 
    array (
      0 => 'fn_get_banner_name',
      1 => '@banner_id',
    ),
    'text' => 'banners',
  ),
)
?>