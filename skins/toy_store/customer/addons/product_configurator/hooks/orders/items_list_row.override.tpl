{* $Id: items_list_row.override.tpl 7419 2009-05-05 11:40:34Z lexa $ *}

{if $product.extra.configuration}

	{assign var="_colspan" value=4}
	{assign var="c_product" value=$product}
	{foreach from=$order_info.items item="sub_oi"}
	{if $sub_oi.extra.parent.configuration && $sub_oi.extra.parent.configuration == $product.cart_id}
	{math equation="item_price + conf_price" item_price=$sub_oi.price|default:"0" conf_price=$conf_price|default:$product.price assign="conf_price"}	
	{math equation="discount + conf_discount" discount=$sub_oi.extra.discount|default:"0" conf_discount=$conf_discount|default:"0" assign="conf_discount"}
	{math equation="tax + conf_tax" tax=$sub_oi.tax_value|default:"0" conf_tax=$conf_tax|default:"0" assign="conf_tax"}
	{math equation="subtotal + conf_subtotal" subtotal=$sub_oi.display_subtotal|default:"0" conf_subtotal=$conf_subtotal|default:$product.display_subtotal assign="conf_subtotal"}	
	{/if}
	{/foreach}

	{cycle values=",table-row" name="class_cycle" assign="_class"}
	<tr class="{$_class}" valign="top">
		<td valign="top">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>
			{if $product.extra.is_edp}
			<div class="right"><a href="{$index_script}?dispatch=orders.order_downloads&amp;order_id={$order_info.order_id}"><strong>[{$lang.download}]</strong></a></div>
			{/if}
			{if $product.product_code}
			<p>{$lang.code}:&nbsp;{$product.product_code}</p>
			{/if}
			{hook name="orders:product_info"}
			{if $product.product_options}{include file="common_templates/options_info.tpl" product_options=$product.product_options}{/if}
			{/hook}
			
			<p><img src="{$images_dir}/icons/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_conf_{$key}" class="hand cm-combination" /><img src="{$images_dir}/icons/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_conf_{$key}" class="hand cm-combination hidden" /><a class="cm-combination" id="sw_conf_{$key}">{$lang.configuration}</a></p>
		</td>
		<td class="right">{include file="common_templates/price.tpl" value=$conf_price}</td>
		<td class="center">&nbsp;{$product.amount}</td>
		{if $order_info.use_discount}
		{assign var="_colspan" value=$_colspan+1}
		<td class="right">
			{include file="common_templates/price.tpl" value=$conf_discount}</td>
		{/if}
		{if $order_info.taxes}
		{assign var="_colspan" value=$_colspan+1}
		<td class="center">
			{include file="common_templates/price.tpl" value=$conf_tax}</td>
		{/if}
		<td class="right">&nbsp;<strong>{include file="common_templates/price.tpl" value=$conf_subtotal}</strong></td>
	</tr>
	<tr class="{$_class} hidden" id="conf_{$key}">
		<td colspan="{$_colspan}">
		<div class="box">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
			<tr>
				<th>{$lang.product}</th>
				<th>{$lang.price}</th>
				<th>{$lang.quantity}</th>
				{if $order_info.use_discount}
				<th>{$lang.discount}</th>
				{/if}
				{if $order_info.taxes}
				<th>{$lang.tax}</th>
				{/if}
				<th>{$lang.subtotal}</th>
			</tr>
			{foreach from=$order_info.items item="product" key="sub_key"}
			{if $product.extra.parent.configuration && $product.extra.parent.configuration == $c_product.cart_id}
			<tr {cycle values=",class=\"table-row\"" name="gc_`$gift_key`"} valign="top">
				<td>
					<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{$product.product|unescape|truncate:50:"...":true}</a>&nbsp;
					{if $product.product_code}
					<p>{$lang.code}:&nbsp;{$product.product_code}</p>
					{/if}
					{hook name="orders:product_info"}
					{if $product.product_options}
						{include file="common_templates/options_info.tpl" product_options=$product.product_options}
					{/if}
					{/hook}
				</td>
				<td class="center nowrap">
					{include file="common_templates/price.tpl" value=$product.price}</td>
				<td class="center nowrap">
					{$product.amount}</td>
				{if $order_info.use_discount}
				<td class="right nowrap">
					{if $product.extra.discount|floatval}{include file="common_templates/price.tpl" value=$product.extra.discount}{else}-{/if}</td>
				{/if}
				{if $order_info.taxes}
				<td class="center nowrap">
					{include file="common_templates/price.tpl" value=$product.tax_value}</td>
				{/if}
				<td class="right nowrap">
					{include file="common_templates/price.tpl" value=$product.display_subtotal}</td>
			</tr>
			{/if}
			{/foreach}
			<tr class="table-footer">
				<td colspan="10">&nbsp;</td>
			</tr>
			</table>
		</div>
		</td>
	</tr>
{/if}
