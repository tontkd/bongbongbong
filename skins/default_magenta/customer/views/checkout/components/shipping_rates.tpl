{* $Id: shipping_rates.tpl 7400 2009-04-30 09:10:17Z zeke $ *}

{if $cart.shipping_required == true}

	{if $show_header == true}
		{include file="common_templates/subheader.tpl" title=$lang.select_shipping_method}
	{/if}

	{if !$no_form}
	<form {if $use_ajax}class="cm-ajax"{/if} action="{$index_script}" method="post" name="shippings_form">
	<input type="hidden" name="redirect_mode" value="checkout" />
	{if $use_ajax}<input type="hidden" name="result_ids" value="checkout_totals,checkout_steps" />{/if}
	{/if}

	{hook name="checkout:shipping_rates"}
	{if $shipping_rates}

		<div class="{if $display == "select"}form-field shipping-rates{elseif $display == "show"}step-complete-wrapper{/if}" id="shipping_rates_list">
		{if $display == "radio"}

			{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
			<p>
				<input type="radio" class="valign" name="shipping_ids[]" value="{$shipping_id}" id="sh_{$shipping_id}" {if $cart.shipping.$shipping_id}checked="checked"{/if} /><label for="sh_{$shipping_id}" class="valign">{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{else}{$lang.free_shipping}{/if}</label>
			</p>
			{/foreach}
			
		{elseif $display == "select"}

			<label for="ssr">{$lang.shipping_method}:</label>
	
			<select id="ssr" name="shipping_ids[]">
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

		<!--shipping_rates_list--></div>
	{/if}
	{/hook}

	{if !$no_form}
	<div class="cm-noscript buttons-container center">{include file="buttons/button.tpl" but_name="dispatch[checkout.update_shipping]" but_text=$lang.select}</div>

	</form>
	{/if}

{/if}
