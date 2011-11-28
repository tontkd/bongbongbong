{* $Id: one_product.tpl 7394 2009-04-29 11:43:22Z zeke $ *}
{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
<div class="search-result">
	<strong>{$product.result_number}.</strong> <a href="{$index_script}?dispatch=products.update&amp;product_id={$product.product_id}" class="list-product-title">{$product.product|unescape}</a>
	{if $product.short_description || $product.full_description}
	<p>
	{if $product.short_description}
		{$product.short_description|unescape}
	{else}
		{$product.full_description|unescape|strip_tags|truncate:380:"..."}
	{/if}
	</p>
	{/if}
</div>
