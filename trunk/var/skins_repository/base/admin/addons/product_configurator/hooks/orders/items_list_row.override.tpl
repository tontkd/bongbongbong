{* $Id: items_list_row.override.tpl 6966 2009-03-04 06:42:39Z angel $ *}

{if $oi.extra.configuration}

	{assign var="_colspan" value=4}
	{assign var="c_oi" value=$oi}
	{foreach from=$order_info.items item="sub_oi"}
	{if $sub_oi.extra.parent.configuration && $sub_oi.extra.parent.configuration == $oi.cart_id}
	{math equation="item_price + conf_price" item_price=$sub_oi.price|default:"0" conf_price=$conf_price|default:$oi.price assign="conf_price"}	
	{math equation="discount + conf_discount" discount=$sub_oi.extra.discount|default:"0" conf_discount=$conf_discount|default:"0" assign="conf_discount"}
	{math equation="tax + conf_tax" tax=$sub_oi.tax_value|default:"0" conf_tax=$conf_tax|default:"0" assign="conf_tax"}
	{math equation="subtotal + conf_subtotal" subtotal=$sub_oi.display_subtotal|default:"0" conf_subtotal=$conf_subtotal|default:$oi.display_subtotal assign="conf_subtotal"}	
	{/if}
	{/foreach}

	<tr valign="top" class="no-border">
		<td>
			<a href="{$index_script}?dispatch=products.update&amp;product_id={$oi.product_id}">{$oi.product}</a>
			{hook name="orders:product_info"}
			{if $oi.product_code}</p>{$lang.sku}:&nbsp;{$oi.product_code}</p>{/if}
			{/hook}

			{if $oi.product_options}<div class="options-info">{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}
		</td>
		<td class="nowrap">{include file="common_templates/price.tpl" value=$conf_price|default:0}</td>
		<td class="center">&nbsp;{$oi.amount}</td>
		{if $order_info.use_discount}
		{assign var="_colspan" value=$_colspan+1}
		<td class="right nowrap">
			{include file="common_templates/price.tpl" value=$conf_discount|default:0}</td>
		{/if}
		{if $order_info.taxes}
		{assign var="_colspan" value=$_colspan+1}
		<td class="nowrap">
			{include file="common_templates/price.tpl" value=$conf_tax|default:0}</td>
		{/if}
		<td class="right">&nbsp;<strong>{include file="common_templates/price.tpl" value=$conf_subtotal|default:0}</strong></td>
	</tr>
	<tr>
		<td colspan="{$_colspan}">
			<p>{$lang.configuration}:</p>
			<table cellpadding="0" cellspacing="0" border="0" class="table">
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
			{foreach from=$order_info.items item="oi" key="sub_key"}
			{if $oi.extra.parent.configuration && $oi.extra.parent.configuration == $c_oi.cart_id}
			<tr {cycle values=",class=\"table-row\"" name="gc_`$gift_key`"} valign="top">
				<td>
					<a href="{$index_script}?dispatch=products.view&amp;product_id={$oi.product_id}">{$oi.product|truncate:50:"...":true}</a>&nbsp;
					{if $oi.product_code}
					<p>{$lang.code}:&nbsp;{$oi.product_code}</p>
					{/if}
					{hook name="orders:product_info"}
					{if $oi.product_options}<div style="padding-top: 1px; padding-bottom: 2px;">&nbsp;{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}
					{/hook}
				</td>
				<td class="center nowrap">
					{include file="common_templates/price.tpl" value=$oi.price}</td>
				<td class="center nowrap">
					{$oi.amount}</td>
				{if $order_info.use_discount}
				<td class="right nowrap">
					{if $oi.extra.discount|floatval}{include file="common_templates/price.tpl" value=$oi.extra.discount}{else}-{/if}</td>
				{/if}
				{if $order_info.taxes}
				<td class="center nowrap">
					{include file="common_templates/price.tpl" value=$oi.tax_value}</td>
				{/if}
				<td class="right nowrap">
					{include file="common_templates/price.tpl" value=$oi.display_subtotal}</td>
			</tr>
			{/if}
			{/foreach}
			</table>
		</td>
	</tr>
{/if}