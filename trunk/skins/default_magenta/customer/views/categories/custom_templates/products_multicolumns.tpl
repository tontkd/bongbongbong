{* $Id: products_multicolumns.tpl 7765 2009-07-30 09:32:56Z alexions $ *}
{** template-description:grid **}

{if $products}

{script src="js/exceptions.js"}

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}
{if !$no_sorting}
	{include file="views/products/components/sorting.tpl"}
{/if}

{if $products|sizeof < $columns}
{assign var="columns" value=$products|@sizeof}
{/if}
{split data=$products size=$columns|default:"2" assign="splitted_products"}
{math equation="100 / x" x=$columns|default:"2" assign="cell_width"}
{if $item_number == "Y"}
	{assign var="cur_number" value=1}
{/if}
<table cellspacing="0" cellpadding="0" width="100%" border="0" class="fixed-layout multicolumns-list">
{foreach from=$splitted_products item="sproducts" name="sprod"}
<tr>
{foreach from=$sproducts item="product" name="sproducts"}
	<td class="product-spacer">&nbsp;</td>
	<td {if !$smarty.foreach.sprod.last}class="border-bottom"{/if} valign="top" width="{$cell_width}%">
	{if $product}
		{hook name="products:product_multicolumns_list"}
		{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
		<table border="0" cellpadding="0" cellspacing="0">
		<tr valign="top">
			<td class="product-image">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$obj_id images=$product.main_pair object_type="product"}</a></td>
			<td class="product-description">
				{if $item_number == "Y"}{$cur_number}.&nbsp;{math equation="num + 1" num=$cur_number assign="cur_number"}{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title"{if $columns > 1} title="{$product.product}">{$product.product|unescape|strip_tags|truncate:40:"...":true}{else}>{$product.product|unescape}{/if}</a>

				{include file="views/products/components/buy_now.tpl" hide_wishlist_button=true hide_compare_list_button=true simple=true show_sku=true hide_add_to_cart_button=$hide_add_to_cart_button but_role="action"}
			</td>
		</tr>
		</table>
		{/hook}
	{/if}
	</td>
	<td class="product-spacer">&nbsp;</td>
{/foreach}
</tr>
{/foreach}
</table>

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}