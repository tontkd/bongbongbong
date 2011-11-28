{* $Id: shipping_rates.tpl 7804 2009-08-11 13:28:28Z alexey $ *}

{if $display == "show"}
<div class="step-complete-wrapper">
{/if}


{if $addons.suppliers.multiple_selectboxes === "Y"}

{foreach from=$suppliers key=supplier_id item=supplier name="s"}
<p>
<strong>{$lang.supplier}:&nbsp;</strong>{$supplier.company|default:$lang.none}
</p>
<ul class="bullets-list">
{foreach from=$supplier.products item="cart_id"}
	<li>{if $cart_products.$cart_id}{$cart_products.$cart_id.product|unescape}{else}{$cart.products.$cart_id.product_id|fn_get_product_name:$smarty.const.CART_LANGUAGE}{/if}</li>
{/foreach}
</ul>
{if $supplier.rates}

	{if $display == "radio"}

	{foreach from=$supplier.rates key="shipping_id" item="rate"}
	<p>
		<input type="radio" class="valign" id="sh_{$supplier_id}_{$shipping_id}" name="shipping_ids[{$supplier_id}]" value="{$shipping_id}" {if isset($cart.shipping.$shipping_id.rates.$supplier_id)}checked="checked"{/if} /><label for="sh_{$supplier_id}_{$shipping_id}" class="valign">{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{else}{$lang.free_shipping}{/if}</label>
	</p>
	{/foreach}

	{elseif $display == "select"}

	<p>
	<select id="ssr_{$supplier_id}" name="shipping_ids[{$supplier_id}]" {if $onchange}onchange="{$onchange}"{/if}>
	{foreach from=$supplier.rates key=shipping_id item=rate}
	<option value="{$shipping_id}" {if isset($cart.shipping.$shipping_id.rates.$supplier_id)}selected="selected"{/if}>{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{else}{$lang.free_shipping}{/if}</option>
	{/foreach}
	</select>
	</p>

	{elseif $display == "show"}

	{foreach from=$supplier.rates key=shipping_id item=rate}
	{if isset($cart.shipping.$shipping_id.rates.$supplier_id)}<p><strong>{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{else}{$lang.free_shipping}{/if}</strong></p>{/if}
	{/foreach}

	{/if}
{else}
<p>-</p>
{/if}
{/foreach}
<p class="right"><strong>{$lang.total}:</strong>&nbsp;{include file="common_templates/price.tpl" value=$cart.shipping_cost class="price"}</p>

{else}

	{if $display == "radio"}

		{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
		<p>
			<input type="radio" class="valign" name="shipping_ids[{","|implode:$supplier_ids}]" value="{$shipping_id}" id="sh_{$shipping_id}" {if $cart.shipping.$shipping_id}checked="checked"{/if} /><label for="sh_{$shipping_id}" class="valign">{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{else}{$lang.free_shipping}{/if}</label>
		</p>
		{/foreach}
		
	{elseif $display == "select"}

		<label for="ssr">{$lang.shipping_method}:</label>

		<select id="ssr" name="shipping_ids[{","|implode:$supplier_ids}]">
		{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
			<option value="{$shipping_id}" {if $cart.shipping.$shipping_id}selected="selected"{/if}>{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{else}{$lang.free_shipping}{/if}</option>
		{/foreach}
		</select>

	{elseif $display == "show"}

		{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
			{if $cart.shipping.$shipping_id}
				{capture name="selected_shipping"}
					{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{else}{$lang.free_shipping}{/if}
				{/capture}
			{/if}
		{/foreach}
		{$smarty.capture.selected_shipping}
	{/if}


{/if}

{if $display == "show"}
</div>
{/if}