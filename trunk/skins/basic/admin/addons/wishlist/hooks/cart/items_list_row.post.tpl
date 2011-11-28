{* $Id: items_list_row.post.tpl 7211 2009-04-07 12:44:55Z zeke $ *}

<td valign="top">
	<div id="wishlist_products_{$customer.user_id}">
	{if $customer.user_id == $sl_user_id}
		{if $wishlist_products}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th>{$lang.product}</th>
		</tr>
		{foreach from=$wishlist_products item="product" name="products"}
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
		</tr>
		{/foreach}
		</table>
		{else}
		&nbsp;
		{/if}
	{else}
		&nbsp;
	{/if}
	<!--wishlist_products_{$customer.user_id}--></div>
</td>