{* $Id: products.tpl 6704 2009-01-05 09:07:14Z lexa $ *}
{** block-description:products **}

{include file="views/products/components/products.tpl" products=$items no_sorting="Y" obj_prefix="`$block.block_id`000" item_number=$block.properties.item_number hide_add_to_cart_button=$block.properties.hide_add_to_cart_button}
