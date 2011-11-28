{* $Id: products_text_links.tpl 7257 2009-04-14 06:30:22Z angel $ *}
{** block-description:text_links **}

<{if $block.properties.item_number == "Y"}ol{else}ul{/if} class="bullets-list">

{foreach from=$items item="product"}
{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
{if $product}
	<li>
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$product.product}">{$product.product|unescape|strip_tags|truncate:40:"...":true}{else}>{$product.product|unescape}{/if}</a>
	</li>
{/if}
{/foreach}

</{if $block.properties.item_number == "Y"}ol{else}ul{/if}>
