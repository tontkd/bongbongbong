{* $Id: downloads.tpl 7419 2009-05-05 11:40:34Z lexa $ *}

{if $products}

	{include file="common_templates/pagination.tpl"}

	{foreach from=$products item=dp}
	<a name="{$dp.order_id}_{$dp.product_id}"></a>
	{include file="views/products/download.tpl" product=$dp no_capture=true}
	{/foreach}

	{include file="common_templates/pagination.tpl"}

{else}
	<p class="no-items">{$lang.text_downloads_empty}</p>
{/if}

{capture name="mainbox_title"}{$lang.downloads}{/capture}
