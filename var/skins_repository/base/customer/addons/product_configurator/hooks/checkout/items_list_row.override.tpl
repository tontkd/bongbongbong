{* $Id: items_list_row.override.tpl 6962 2009-03-02 14:40:38Z angel $ *}

{if $cart.products.$key.extra.configuration}
	{cycle values=",table-row" name="class_cycle" assign="_class"}
	<tr class="{$_class}">
		<td>
			<div class="clear">
				<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="float-left product-title">{$product.product|unescape}</a>
				<a href="{$index_script}?dispatch=checkout.delete&amp;cart_id={$key}&amp;redirect_mode=checkout" class="float-right"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="" align="bottom" /></a>
			</div>
			{hook name="checkout:product_info"}
			{if $product.product_code}
			<p>{$lang.code}:&nbsp;{$product.product_code}</p>
			{/if}
			{/hook}

			{if $product.product_options}
				{include file="common_templates/options_info.tpl" product_options=$product.product_options fields_prefix="cart_products[`$key`][product_options]"}
			{/if}

			<p><img src="{$images_dir}/icons/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_conf_{$key}" class="hand cm-combination" /><img src="{$images_dir}/icons/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_conf_{$key}" class="hand cm-combination hidden" /><a class="cm-combination" id="sw_conf_{$key}">{$lang.configuration}</a></p>
		</td>
		<td class="center">
			&nbsp;-&nbsp;</td>
		<td class="center">
			<input type="text" size="3" name="cart_products[{$key}][amount]" value="{$product.amount}" class="input-text-short" {if $product.is_edp == "Y"}readonly="readonly"{/if} /><input type="hidden" name="cart_products[{$key}][product_id]" value="{$product.product_id}" /></td>
		{if $cart.use_discount}
		<td class="center">
			{if $product.discount|floatval}{include file="common_templates/price.tpl" value=$product.discount}{else}-{/if}</td>
		{/if}
		{if $cart.taxes}
		<td class="center">
			{if $product.tax_summary}{include file="common_templates/price.tpl" value=$product.tax_summary.total}{else}-{/if}</td>
		{/if}
		<td class="right">
			{include file="common_templates/price.tpl" value=$product.subtotal}</td>
	</tr>
	{assign var="_colspan" value="4"}
	{if $cart.use_discount}{assign var="_colspan" value=$_colspan+1}{/if}
	{if $cart.taxes}{assign var="_colspan" value=$_colspan+1}{/if}
	<tr class="{$_class} hidden" id="conf_{$key}">
		<td colspan={$_colspan}>
			<div class="box">
			<ul class="bullets-list">
			{foreach from=$cart_products item="_product" key="sub_key"}
			{if $cart.products.$sub_key.extra.parent.configuration == $key}
				<li><a href="{$index_script}?dispatch=products.view&amp;product_id={$_product.product_id}">{$_product.product}</a><input type="hidden" name="cart_products[{$sub_key}][amount]" value="{$_product.amount}" /><input type="hidden" name="cart_products[{$sub_key}][product_id]" value="{$_product.product_id}" /></li>
			{/if}
			{/foreach}
			</ul>
			</div>
		</td>
	</tr>
{/if}
