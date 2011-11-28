{* $Id: products_small_list.tpl 7286 2009-04-16 13:13:14Z angel $ *}

{if $products}

{if $show_price_values && $settings.General.allow_anonymous_shopping == "P" && !$auth.user_id}
{assign var="show_price_values" value="0"}
{else}
{assign var="show_price_values" value="1"}
{/if}

{if !$no_sorting}
	{include file="views/products/components/sorting.tpl"}
{/if}
{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{if $products|@sizeof < $columns}
{assign var="columns" value=$products|@sizeof}
{/if}
{split data=$products size=$columns|default:"2" assign="splitted_products"}

{assign var="img_width" value="2"}
{assign var="space_width" value="2"}
{math equation="(100 + space_width) / x - space_width - img_width" x=$columns|default:"2" assign="cell_width" space_width=$space_width img_width=$img_width}
{math equation="cell_width + img_width" cell_width=$cell_width img_width=$img_width assign="2_cell_width"}

{if $item_number == "Y"}
	{assign var="cur_number" value=1}
{/if}
<table cellpadding="3" cellspacing="3" border="0" width="100%">
{foreach from=$splitted_products item="sproducts" name="splitted_products"}
<tr>
{foreach from=$sproducts item="product" name="sproducts"}
	<td valign="top" {if !$smarty.foreach.splitted_products.last}class="border-bottom"{/if} style="width: {$cell_width}%;">
		{if $product}
		{hook name="products:product_small_list"}
		{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
		<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr>
			<td class="center" valign="top" width="{$img_width}%">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width="40" obj_id=$obj_id images=$product.main_pair object_type="product"}</a></td>
		<td width="{$cell_width}%" valign="top">
			{if $item_number == "Y"}{$cur_number}.&nbsp;{math equation="num + 1" num=$cur_number assign="cur_number"}{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $columns > 1} title="{$product.product|unescape}">{$product.product|unescape|strip_tags|truncate:30:"...":true}{else}>{$product.product|unescape}{/if}</a>
			{include file="views/products/components/buy_now.tpl" but_role="text" but_meta="cm-tools-list" but_rev="product_form_`$obj_id`" simple=true obj_id=$obj_id hide_wishlist_button=true hide_compare_list_button=true hide_add_to_cart_button=$hide_add_to_cart_button}
		</td>
		</tr>
		</table>
		{/hook}
		{else}
		&nbsp;
		{/if}
	</td>
	{if !$smarty.foreach.sproducts.last}
	<td width="{$space_width}%">&nbsp;</td>
	{/if}
{/foreach}
</tr>
{/foreach}
</table>

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}
