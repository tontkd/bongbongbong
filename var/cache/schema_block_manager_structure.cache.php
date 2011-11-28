<?php
 if ( !defined('AREA') )	{ die('Access denied');	}
 $_cache_data = array (
  'products' => 
  array (
    'fillings' => 
    array (
      0 => 'manually',
      'newest' => 
      array (
        'params' => 
        array (
          'sort_by' => 'timestamp',
          'sort_order' => 'desc',
          'request' => 
          array (
            'cid' => '%CATEGORY_ID%',
          ),
        ),
      ),
      'recent_products' => 
      array (
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
          'session' => 
          array (
            'pid' => '%RECENTLY_VIEWED_PRODUCTS%',
          ),
          'request' => 
          array (
            'exclude_pid' => '%PRODUCT_ID%',
          ),
          'force_get_by_ids' => true,
        ),
      ),
      'popularity' => 
      array (
        'params' => 
        array (
          'popularity_from' => 1,
          'sort_by' => 'popularity',
          'sort_order' => 'desc',
          'type' => 'extended',
          'request' => 
          array (
            'cid' => '%CATEGORY_ID',
          ),
        ),
      ),
      'also_bought' => 
      array (
        'params' => 
        array (
          'sort_by' => 'amnt',
          'request' => 
          array (
            'also_bought_for_product_id' => '%PRODUCT_ID%',
          ),
        ),
        'locations' => 
        array (
          0 => 'products',
        ),
      ),
      'bestsellers' => 
      array (
        'params' => 
        array (
          'bestsellers' => true,
          'sales_amount_from' => 1,
          'sort_by' => 'sales_amount',
          'sort_order' => 'desc',
          'type' => 'extended',
          'request' => 
          array (
            'cid' => '%CATEGORY_ID',
          ),
        ),
      ),
      'rating' => 
      array (
        'params' => 
        array (
          'rating' => true,
          'sort_by' => 'rating',
        ),
      ),
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'central',
      3 => 'top',
      4 => 'bottom',
      'product_details' => 
      array (
        'name' => 'product_details_page',
        'conditions' => 
        array (
          'locations' => 
          array (
            0 => 'products',
          ),
        ),
      ),
    ),
    'appearances' => 
    array (
      'blocks/products_text_links.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
      ),
      'blocks/products_links_thumb.tpl' => 
      array (
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
      ),
      'blocks/products_multicolumns.tpl' => 
      array (
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
      ),
      'blocks/products_multicolumns_small.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
      ),
      'blocks/products.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
          ),
        ),
      ),
      'blocks/products2.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
      ),
      'blocks/products_sidebox_1_item.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
      ),
      'blocks/products_small_items.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
      ),
      'blocks/products_without_image.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
      ),
      'blocks/products_scroller.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
      ),
      'blocks/products_scroller2.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
      ),
      'blocks/products_scroller3.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
      ),
      'blocks/short_list.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
          'type' => 'extended',
        ),
        'data_modifier' => 
        array (
          'fn_gather_additional_product_data' => 
          array (
            'product' => '#this',
            'get_icon' => true,
            'get_detailed' => false,
            'get_options' => false,
          ),
        ),
      ),
    ),
    'dispatch' => 'products.update',
    'object_id' => 'product_id',
    'object_name' => 'product',
    'picker_props' => 
    array (
      'picker' => 'pickers/products_picker.tpl',
      'params' => 
      array (
        'type' => 'links',
      ),
    ),
  ),
  'categories' => 
  array (
    'fillings' => 
    array (
      'manually' => 
      array (
        'params' => 
        array (
          'simple' => false,
          'group_by_level' => false,
        ),
      ),
      'newest' => 
      array (
        'params' => 
        array (
          'sort_by' => 'timestamp',
          'plain' => true,
          'visible' => true,
        ),
      ),
      0 => 'emenu',
      'plain' => 
      array (
        'params' => 
        array (
          'plain' => true,
        ),
      ),
      'dynamic' => 
      array (
        'params' => 
        array (
          'visible' => true,
          'plain' => true,
          'request' => 
          array (
            'current_category_id' => '%CATEGORY_ID%',
          ),
          'session' => 
          array (
            'product_category_id' => '%CURRENT_CATEGORY_ID%',
          ),
        ),
      ),
      'rating' => 
      array (
        'params' => 
        array (
          'rating' => true,
          'sort_by' => 'rating',
        ),
      ),
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'top',
      3 => 'bottom',
      'central' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'manually',
            1 => 'newest',
            2 => 'rating',
          ),
        ),
      ),
      'product_details' => 
      array (
        'conditions' => 
        array (
          'locations' => 
          array (
            0 => 'products',
          ),
        ),
      ),
    ),
    'appearances' => 
    array (
      'blocks/categories_text_links.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'manually',
            1 => 'newest',
            2 => 'rating',
          ),
        ),
      ),
      'blocks/categories_emenu.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'emenu',
          ),
        ),
      ),
      'blocks/categories_dynamic.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'dynamic',
          ),
        ),
      ),
      'blocks/categories_plain.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'plain',
          ),
        ),
      ),
      'blocks/categories_multicolumns.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
          ),
        ),
        'params' => 
        array (
          'get_images' => true,
        ),
      ),
    ),
    'dispatch' => 'categories.update',
    'object_id' => 'category_id',
    'object_name' => 'category',
    'picker_props' => 
    array (
      'picker' => 'pickers/categories_picker.tpl',
      'params' => 
      array (
        'multiple' => true,
      ),
    ),
  ),
  'pages' => 
  array (
    'fillings' => 
    array (
      0 => 'manually',
      'newest' => 
      array (
        'params' => 
        array (
          'sort_by' => 'timestamp',
          'visible' => true,
          'status' => 'A',
        ),
      ),
      'dynamic' => 
      array (
        'params' => 
        array (
          'visible' => true,
          'get_tree' => 'plain',
          'status' => 'A',
          'request' => 
          array (
            'current_page_id' => '%PAGE_ID%',
          ),
        ),
      ),
      'rating' => 
      array (
        'params' => 
        array (
          'rating' => true,
          'sort_by' => 'rating',
        ),
      ),
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'top',
      3 => 'bottom',
      4 => 'central',
      'product_details' => 
      array (
        'conditions' => 
        array (
          'locations' => 
          array (
            0 => 'products',
          ),
        ),
      ),
    ),
    'appearances' => 
    array (
      'blocks/pages_text_links.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'manually',
            1 => 'newest',
            2 => 'rating',
          ),
        ),
        'params' => 
        array (
          'plain' => true,
        ),
      ),
      'blocks/pages_dynamic.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'dynamic',
          ),
        ),
      ),
    ),
    'dispatch' => 'pages.update',
    'object_id' => 'page_id',
    'object_name' => 'page',
    'picker_props' => 
    array (
      'picker' => 'pickers/pages_picker.tpl',
      'params' => 
      array (
        'multiple' => true,
      ),
    ),
  ),
  'product_filters' => 
  array (
    'fillings' => 
    array (
      'dynamic' => 
      array (
        'params' => 
        array (
          'check_location' => true,
          'request' => 
          array (
            'dispatch' => '%DISPATCH%',
            'category_id' => '%CATEGORY_ID%',
            'features_hash' => '%FEATURES_HASH%',
            'variant_id' => '%VARIANT_ID%',
            'advanced_filter' => '%advanced_filter%',
          ),
          'skip_if_advanced' => true,
        ),
      ),
      'filters' => 
      array (
        'params' => 
        array (
          'get_all' => true,
          'request' => 
          array (
            'variant_id' => '%VARIANT_ID%',
          ),
          'get_custom' => true,
          'skip_other_variants' => true,
        ),
      ),
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'top',
      3 => 'bottom',
      4 => 'central',
    ),
    'appearances' => 
    array (
      'blocks/product_filters.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'dynamic',
          ),
        ),
      ),
      'blocks/product_filters_extended.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'filters',
          ),
        ),
      ),
    ),
    'dispatch' => 'product_filters.manage',
    'object_id' => 'filter_id',
    'object_name' => 'product_filter',
    'data_function' => 'fn_get_filters_products_count',
  ),
  'tags' => 
  array (
    'fillings' => 
    array (
      'tag_cloud' => 
      array (
        'params' => 
        array (
          'status' => 'A',
          'sort_by' => 'popularity',
          'sort_order' => 'desc',
          'sort_popular' => true,
        ),
      ),
      'my_tags' => 
      array (
        'params' => 
        array (
          'auth' => 
          array (
            'user_id' => '%USER_ID%',
          ),
          'sort_by' => 'tag',
          'sort_order' => 'asc',
          'see' => 'my',
        ),
      ),
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'top',
      3 => 'bottom',
      4 => 'central',
    ),
    'appearances' => 
    array (
      'addons/tags/blocks/tag_cloud.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'tag_cloud',
          ),
        ),
      ),
      'addons/tags/blocks/user_tag_cloud.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'my_tags',
          ),
        ),
      ),
    ),
    'dispatch' => 'tags.manage',
    'object_id' => 'tag_id',
    'object_name' => 'tag',
  ),
  'news' => 
  array (
    'fillings' => 
    array (
      0 => 'manually',
      'newest' => 
      array (
        'params' => 
        array (
          'sort_by' => 'timestamp',
        ),
      ),
      1 => 'news_plain',
    ),
    'appearances' => 
    array (
      'addons/news_and_emails/blocks/news_text_links.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'manually',
            1 => 'newest',
          ),
        ),
      ),
      'addons/news_and_emails/blocks/news.tpl' => 
      array (
        'conditions' => 
        array (
          'fillings' => 
          array (
            0 => 'news_plain',
          ),
        ),
      ),
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'central',
      3 => 'top',
      4 => 'bottom',
      'product_details' => 
      array (
        'conditions' => 
        array (
          'locations' => 
          array (
            0 => 'products',
          ),
        ),
      ),
    ),
    'object_id' => 'news_id',
    'object_name' => 'news',
    'picker_props' => 
    array (
      'picker' => 'addons/news_and_emails/pickers/news_picker.tpl',
      'params' => 
      array (
      ),
    ),
  ),
  'polls' => 
  array (
    'fillings' => 
    array (
      0 => 'manually',
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'central',
      3 => 'top',
      4 => 'bottom',
      'product_details' => 
      array (
        'conditions' => 
        array (
          'locations' => 
          array (
            0 => 'products',
          ),
        ),
      ),
    ),
    'appearances' => 
    array (
      'addons/polls/blocks/sidebox.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'left',
            1 => 'right',
            2 => 'top',
            3 => 'bottom',
          ),
        ),
        'params' => 
        array (
        ),
      ),
      'addons/polls/blocks/central.tpl' => 
      array (
        'conditions' => 
        array (
          'positions' => 
          array (
            0 => 'central',
            1 => 'product_details',
          ),
        ),
      ),
    ),
    'dispatch' => 'pages.update',
    'object_id' => 'page_id',
    'object_name' => 'polls',
    'picker_props' => 
    array (
      'picker' => 'addons/polls/pickers/polls_picker.tpl',
      'params' => 
      array (
        'multiple' => true,
      ),
    ),
  ),
  'banners' => 
  array (
    'fillings' => 
    array (
      0 => 'manually',
      'newest' => 
      array (
        'params' => 
        array (
          'sort_by' => 'timestamp',
        ),
      ),
    ),
    'appearances' => 
    array (
      0 => 'addons/banners/blocks/original.tpl',
    ),
    'positions' => 
    array (
      0 => 'left',
      1 => 'right',
      2 => 'central',
      3 => 'top',
      4 => 'bottom',
      'product_details' => 
      array (
        'conditions' => 
        array (
          'locations' => 
          array (
            0 => 'products',
          ),
        ),
      ),
    ),
    'object_description' => 'banners',
    'object_id' => 'banner_id',
    'object_name' => 'banners',
    'picker_props' => 
    array (
      'picker' => 'addons/banners/pickers/banners_picker.tpl',
      'params' => 
      array (
      ),
    ),
  ),
)
?>