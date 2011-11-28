{* $Id: products_small_items.tpl 7560 2009-06-03 11:52:21Z zeke $ *}
{** block-description:small_items **}

{foreach from=$items item="product" name="for_products"}
{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
<div class="item-wrap{if $smarty.foreach.for_products.last} last-item-wrap{/if}">
	<div class="item-image">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width="40" images=$product.main_pair obj_id=$obj_id show_thumbnail="Y" no_ids=true}</a>
	</div>
	<div class="item-description">
		{if $block.properties.item_number == "Y"}{$smarty.foreach.for_products.iteration}.&nbsp;{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$product.product}">{$product.product|unescape|strip_tags|truncate:40:"...":true}{else}>{$product.product|unescape}{/if}</a>{if $product.manufacturer}</p>{/if}
		{include file="views/products/components/buy_now.tpl" but_role="text" hide_wishlist_button=true hide_compare_list_button=true product=$product hide_add_to_cart_button=$block.properties.hide_add_to_cart_button simple=true}
	</div>
</div>
{/foreach}
