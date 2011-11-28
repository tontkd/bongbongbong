{* $Id: products_sidebox_1_item.tpl 7286 2009-04-16 13:13:14Z angel $ *}
{** block-description:sidebox_1_item **}

{foreach from=$items item="product" name="for_products"}
{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
	{if $smarty.foreach.for_products.first}
		<div class="item-wrap">
			<div class="clear">
				<div class="item-image">
					<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width="50" images=$product.main_pair obj_id=$obj_id show_thumbnail="Y" no_ids=true}</a>
				</div>
				<div class="item-description">
					{if $block.properties.item_number == "Y"}{$smarty.foreach.for_products.iteration}.&nbsp;{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$product.product|strip_tags}">{$product.product|unescape|strip_tags|truncate:25:"...":true}{else}>{$product.product|unescape}{/if}</a>
				</div>
			</div>

			{include file="views/products/components/buy_now.tpl" but_role="text" hide_wishlist_button=true hide_compare_list_button=true product=$product hide_add_to_cart_button=$block.properties.hide_add_to_cart_button simple=true}
		</div>
		<{if $block.properties.item_number == "Y"}ol start="2"{else}ul{/if} class="bullets-list">
	{else}
		<li>
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$product.product|strip_tags}">{$product.product|unescape|strip_tags|truncate:40:"...":true}{else}>{$product.product|unescape}{/if}</a>
		</li>
	{/if}
{/foreach}
</{if $block.properties.item_number == "Y"}ol{else}ul{/if}>
