{* $Id: totals_shipping.override.tpl 7774 2009-07-31 09:47:01Z zeke $ *}

{if $addons.suppliers.multiple_selectboxes == "Y" && $cart.use_suppliers}
<div class="form-field">
	<label>{$lang.shipping_method}:</label>
	<table cellpadding="1" cellspacing="1" border="0" width="100%">
	{foreach from=$suppliers key=supplier_id item=supplier}
		{cycle values="class=\"table-row\", " assign="_class"}
		<tr {$_class}>
			<td class="nowrap">&nbsp;<strong>{$supplier.company|default:$lang.none}</strong></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			{if $supplier.rates}
			<td width="100%">
		   		<select name="shipping_ids[{$supplier_id}]">
				{foreach from=$supplier.rates key=shipping_id item=rate}
				<option value="{$shipping_id}" {if $cart.shipping.$shipping_id.rates.$supplier_id}selected="selected"{/if}>{$rate.name} ({$rate.delivery_time}) - {include file="common_templates/price.tpl" value=$rate.rate}</option>
				{/foreach}
		   		</select></td>
			{else}
			<td class="error-text" align="center"  width="100%">{$lang.text_no_shipping_methods}</td>
			{assign var="is_empty_rates" value="Y"}
			{/if}
		</tr>
	{/foreach}
	</table>
</div>
{/if}