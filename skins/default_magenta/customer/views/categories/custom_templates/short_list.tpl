{* $Id: short_list.tpl 7850 2009-08-17 14:55:45Z alexions $ *}
{** template-description:compact_list **}

{if $products}

{script src="js/exceptions.js"}

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}
{if !$no_sorting}
	{include file="views/products/components/sorting.tpl"}
{/if}

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table storefront-table">
<tr>
	<th align="center"></th>
	<th align="left">{$lang.product}</th>
	<th align="center">{$lang.product_code}</th>
	<th align="center">{$lang.price}</th>
	<th align="center">&nbsp;</th>
</tr>

{foreach from=$products item="product" key="key" name="products"}
	{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
	{include file="views/products/components/buy_now.tpl" but_role="act" hide_wishlist_button=true hide_compare_list_button=true product=$product simple=true capture_price=true assign="buttons" hide_add_to_cart_button=$hide_add_to_cart_button but_rev="product_form_`$obj_id`" hide_price_title=true obj_id=$obj_id}
	
	<tr {cycle values=",class=\"table-row\""}>
		<td valign="middle">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width="40" images=$product.main_pair object_type="product" obj_id=$obj_id show_thumbnail="Y"}</a>
		</td>
		<td valign="middle">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{$product.product|unescape}</a>
		</td>
		<td valign="middle" align="center">
			{$product.product_code}
		</td>
		<td valign="middle" align="center">
			{$smarty.capture.price}
		</td>
		<td valign="middle" align="center" nowrap="nowrap">
			{$buttons}
		</td>
	</tr>
{/foreach}
</table>

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{/if}