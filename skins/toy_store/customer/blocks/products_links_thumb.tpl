{* $Id: products_links_thumb.tpl 7286 2009-04-16 13:13:14Z angel $ *}
{** block-description:links_thumb **}

{foreach from=$items item="product" name="products"}
{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
<div class="center">
	<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width="70" images=$product.main_pair obj_id=$obj_id object_type="product" show_thumbnail="Y" no_ids=true}</a>
	<p>{if $block.properties.item_number == "Y"}{$smarty.foreach.products.iteration}.&nbsp;{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$product.product}">{$product.product|unescape|strip_tags|truncate:40:"...":true}{else}>{$product.product|unescape}{/if}</a></p>
	{include file="views/products/components/buy_now.tpl" but_role="text" but_rev="product_form_`$obj_id`" hide_wishlist_button=true hide_compare_list_button=true product=$product obj_id=$obj_id hide_add_to_cart_button=$block.properties.hide_add_to_cart_button simple=true}
</div>
{/foreach}
