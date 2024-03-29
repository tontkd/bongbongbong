{* $Id: totals.pre.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $order_info.returned_products}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th width="5%">{$lang.sku}</th>
		<th>{$lang.returned_product}</th>
		<th width="5%">{$lang.amount}</th>
		<th width="7%" class="rigth">{$lang.subtotal}</th>
	</tr>
	{foreach from=$order_info.returned_products item="oi"}
	<tr {cycle values="class=\"table-row\", "} valign="top">
		<td>{$oi.product_code}</td>
		<td>
			<a href="{$index_script}?dispatch=products.update&amp;product_id={$oi.product_id}">{$oi.product}</a>
			{hook name="orders:returned_product_info"}
			{/hook}
			{if $oi.product_options}<div class="options-info">&nbsp;{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}
			</td>
		<td>{$oi.amount}</td>
		<td class="right"><strong>{if $oi.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$oi.subtotal}{/if}</strong></td>
	</tr>
	{/foreach}
</table>
{/if}