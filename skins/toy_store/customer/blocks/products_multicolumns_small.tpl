{* $Id: products_multicolumns_small.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:multicolumns_small **}

{script src="js/exceptions.js"}

{include file="views/products/components/products_small_list.tpl" products=$items columns=$block.properties.number_of_columns form_prefix="block_manager" no_sorting="Y" no_pagination="Y" hide_add_to_cart_button=$block.properties.hide_add_to_cart_button obj_prefix="`$block.block_id`000" item_number=$block.properties.item_number}
