{* $Id: short_list.tpl 7763 2009-07-29 13:19:43Z alexions $ *}
{** block-description:short_list **}

{include file="views/categories/custom_templates/short_list.tpl" products=$items no_sorting="Y" no_pagination="Y" obj_prefix="`$block.block_id`000" item_number=$block.properties.item_number hide_add_to_cart_button=$block.properties.hide_add_to_cart_button}
