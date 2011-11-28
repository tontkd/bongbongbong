{* $Id: products_without_image.tpl 7286 2009-04-16 13:13:14Z angel $ *}
{** block-description:without_image **}

<{if $block.properties.item_number == "Y"}ol{else}ul{/if}>

{foreach from=$items item="product" name="for_products"}
{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
<li{if !$smarty.foreach.for_products.last} class="item-wrap"{/if}>
	{if $product.manufacturer}<strong>{$product.manufacturer}</strong>{/if}
	<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$product.product}">{$product.product|unescape|strip_tags|truncate:40:"...":true}{else}>{$product.product|unescape}{/if}</a>
	{include file="views/products/components/buy_now.tpl" but_role="text" hide_wishlist_button=true hide_compare_list_button=true product=$product hide_add_to_cart_button=$block.properties.hide_add_to_cart_button simple=true}
</li>
{/foreach}
</{if $block.properties.item_number == "Y"}ol{else}ul{/if}>
