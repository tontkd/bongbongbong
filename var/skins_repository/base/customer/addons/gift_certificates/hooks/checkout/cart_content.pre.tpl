{* $Id: cart_content.pre.tpl 6967 2009-03-04 09:26:06Z angel $ *}
{if $cart.gift_certificates}
{foreach from=$cart.gift_certificates item="gift" key="gift_key"}
{cycle values=",table-row" name="class_cycle" assign="_class"}
{assign var="_colspan" value="4"}
<tr class="{$_class}">
	<td>
		<div class="clear">
			<a href="{$index_script}?dispatch=gift_certificates.update&amp;gift_cert_id={$gift_key}" class="float-left product-title">{$lang.gift_certificate}</a>
			<a href="{$index_script}?dispatch=gift_certificates.delete&amp;return=checkout&amp;gift_cert_id={$gift_key}&amp;redirect_mode=checkout" class="float-right"><img width="12" height="12" border="0" align="bottom" alt="" src="{$images_dir}/icons/delete_product.gif"/></a>
		</div>
		<p><img src="{$images_dir}/icons/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_gift_{$gift_key}" class="hand cm-combination" /><img src="{$images_dir}/icons/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_gift_{$gift_key}" class="hand cm-combination hidden" /><a class="cm-combination" id="sw_gift_{$gift_key}">{$lang.details_upper}</a></p>
	</td>
	<td class="center">
		{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.subtotal}{else}{$lang.free}{/if}</td>
	<td class="center">
		1</td>
	{if $cart.use_discount}
	{assign var="_colspan" value=$_colspan+1}
	<td class="center">-</td>
	{/if}
	{if $cart.taxes}
	{assign var="_colspan" value=$_colspan+1}
	<td class="center">-</td>
	{/if}
	<td class="right">
		{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.subtotal}{else}{$lang.free}{/if}</td>
</tr>
<tr class="{$_class} hidden" id="gift_{$gift_key}">
	<td class="left nowrap" colspan="{$_colspan}">
		<div class="box">
			<div class="form-field product-list-field">
				<label>{$lang.gift_cert_to}:</label>
				<span>{$gift.recipient}</span>
			</div>
			<div class="form-field product-list-field">
				<label>{$lang.gift_cert_from}:</label>
				<span>{$gift.sender}</span>
			</div>
			<div class="form-field product-list-field">
				<label>{$lang.amount}:</label>
				<span>{include file="common_templates/price.tpl" value=$gift.amount}</span>
			</div>
			<div class="form-field product-list-field">
				<label>{$lang.send_via}:</label>
				<span>{if $gift.send_via == "E"}{$lang.email}{else}{$lang.postal_mail}{/if}</span>
			</div>
			{if $gift.products && $addons.gift_certificates.free_products_allow == "Y"}
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table product-list">
			<tr>
				<th width="50%">{$lang.product}</th>
				<th width="10%">{$lang.price}</th>
				<th width="10%">{$lang.quantity}</th>
				{if $cart.use_discount}
				<th class="right" width="10%">{$lang.discount}</th>
				{/if}
				{if $cart.taxes}
				<th width="10%">{$lang.tax}</th>
				{/if}
				<th class="right" width="10%">{$lang.subtotal}</th>
			</tr>
			{foreach from=$cart_products item="_product" key="sub_key"}
			{if $cart.products.$sub_key.extra.parent.certificate == $gift_key}
			<tr  {cycle values=",class=\"table-row\"" name="gc_`$gift_key`"}>
				<td>
					<input type="hidden" name="cart_products[{$sub_key}][amount]" value="{$_product.amount}" />
					<input type="hidden" name="cart_products[{$sub_key}][product_id]" value="{$_product.product_id}" />
					<input type="hidden" name="cart_products[{$key}][extra][parent][certificate]" value="{$gift_key}" />

					<a href="{$index_script}?dispatch=products.view&amp;product_id={$_product.product_id}" title="{$_product.product}">{$_product.product|truncate:70:"...":true}</a>
					{hook name="checkout:product_info"}
					{if $_product.product_code}
					<p>{$lang.code}:&nbsp;{$_product.product_code}</p>
					{/if}
					{/hook}
					{if $_product.product_options}
						{include file="common_templates/options_info.tpl" product_options=$_product.product_options fields_prefix="cart_products[`$sub_key`][product_options]"}
					{/if}
				</td>
				<td class="center">
					{include file="common_templates/price.tpl" value=$_product.price}</td>
				<td class="center">
					{$_product.amount}</td>
				{if $cart.use_discount}
				<td class="center">
					{if $_product.discount|floatval}{include file="common_templates/price.tpl" value=$_product.discount}{else}-{/if}</td>
				{/if}
				{if $cart.taxes}
				<td class="center">
					{include file="common_templates/price.tpl" value=$_product.tax_summary.total}</td>
				{/if}
				<td class="right">
					{include file="common_templates/price.tpl" value=$_product.display_subtotal}</td>
			</tr>
				{/if}
			{/foreach}
			<tr class="table-footer">
				<td colspan="{$_colspan}">&nbsp;</td>
			</tr>
			</table>
			{/if}
		</div>
		</td>
</tr>
{/foreach}

{/if}
