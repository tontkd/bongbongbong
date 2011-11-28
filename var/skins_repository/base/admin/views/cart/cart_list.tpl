{* $Id: cart_list.tpl 7211 2009-04-07 12:44:55Z zeke $ *}

{capture name="mainbox"}

{capture name="section"}
	{include file="views/cart/components/carts_search_form.tpl"}
{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}

<form action="{$index_script}" method="post" target="" name="carts_list_form">

{include file="common_templates/pagination.tpl" save_current_url=true}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{if $settings.DHTML.admin_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}
{/if}

<table cellpadding="0" cellspacing="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		&nbsp;<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_carts" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combinations-carts" /><img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_carts" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand hidden cm-combinations-carts" /></th>
	<th width="50%"><a class="{$ajax_class}{if $search.sort_by == "customer"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=customer&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.customer}</a></th>
	<th width="25%" class="center">{$lang.cart_content}</th>
	{hook name="cart:items_list_header"}
	{/hook}
</tr>
{foreach from=$cart_list item="customer"}
<tr class="table-row">
	<td>
		<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_user_{$customer.user_id}" class="hand cm-combination-carts" onclick="jQuery.ajaxRequest('{$index_script}?dispatch=cart.cart_list&user_id={$customer.user_id}', {$ldelim}result_ids: 'cart_products_{$customer.user_id}, wishlist_products_{$customer.user_id}', caching: true{$rdelim});" />
		<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_user_{$customer.user_id}" class="hand hidden cm-combination-carts" /></td>
	<td>
	{if $customer.firstname || $customer.lastname}<a href="{$index_script}?dispatch=profiles.update&amp;user_id={$customer.user_id}" class="underlined">{$customer.firstname} {$customer.lastname}</a>{else}{$lang.unregistered_customer}{/if}</td>
	<td class="center">{$customer.cart_products|default:"0"} {$lang.product_s}</td>
	{hook name="cart:items_list"}
	{/hook}
</tr>
<tbody id="user_{$customer.user_id}" class="hidden">
<tr>
	<td>&nbsp;</td>
	<td valign="top" colspan="2">
		<div id="cart_products_{$customer.user_id}">
		{if $customer.user_id == $sl_user_id}
			{if $cart_products}
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
			<tr>
				<th width="100%">{$lang.product}</th>
				<th class="center">{$lang.quantity}</th>
				<th class="right">{$lang.price}</th>
			</tr>
			{foreach from=$cart_products item="product" name="products"}
			<tr>
				<td>
				{if $product.item_type == "P"}
					{if $product.product}
					<a href="{$index_script}?dispatch=products.update&amp;product_id={$product.product_id}">{$product.product|unescape}</a>
					{else}
					{$lang.deleted_product}
					{/if}
				{/if}
				{hook name="cart:products_list"}
				{/hook}
					</td>
				<td class="center">{$product.amount}</td>
				<td class="right">{include file="common_templates/price.tpl" value=$product.price span_id="c_`$customer.user_id`_$product.item_id"}</td>
			</tr>
			{/foreach}
			<tr>
				<td class="right"><strong>{$lang.total}:</strong></td>
				<td class="center"><strong>{$customer.cart_all_products}</strong></td>
				<td class="right"><strong>{include file="common_templates/price.tpl" value=$customer.total span_id="u_$customer.user_id"}</strong></td>
			</tr>
			</table>
			{else}
			&nbsp;
			{/if}
		{else}
			&nbsp;
		{/if}
		<!--cart_products_{$customer.user_id}--></div>
	</td>
	{hook name="cart:items_list_row"}
	{/hook}
</tr>
</tbody>
{foreachelse}
<tr class="no-items">
	<td colspan="4"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>
{include file="common_templates/pagination.tpl"}
</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.users_carts content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra}
