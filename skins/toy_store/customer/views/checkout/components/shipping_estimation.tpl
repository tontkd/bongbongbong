{* $Id: shipping_estimation.tpl 7774 2009-07-31 09:47:01Z zeke $ *}

{if $location == "sidebox"}
	{assign var="prefix" value="sidebox_"}
{/if}
{if $additional_id}
	{assign var="class_suffix" value="-`$additional_id`"}
	{assign var="id_suffix" value="_`$additional_id`"}
{/if}

{if $location != "sidebox"}
<a name="estimate"></a>
	<div class="buttons-container clear-both">{include file="buttons/button.tpl" but_role="text" but_text=$lang.estimate_shipping_cost but_id="sw_est_box`$id_suffix`" but_meta="cm-combination`$class_suffix`"}</div>
{/if}
{if $location != "sidebox"}
<div id="est_box{$id_suffix}"{if (!"AJAX_REQUEST"|defined && !$shipping_rates && $location != "sidebox")} class="hidden"{/if} align="right">
	<div class="estimation-popup-box float-right" align="left">
	{/if}
		<div id="shipping_estimation{if $location == "sidebox"}_sidebox{/if}{$id_suffix}">
		{if $mode == "shipping_estimation" || $smarty.request.show_shippings == "Y"}

			{if !$cart.shipping_failed}
			<form class="cm-ajax" name="{$prefix}select_shipping_form{$id_suffix}" action="{$index_script}" method="post">
			<input type="hidden" name="redirect_mode" value="cart" />
			<input type="hidden" name="result_ids" value="checkout_totals" />

			{hook name="checkout:shipping_estimation"}
				{foreach from=$shipping_rates key=shipping_id item=s_rate name="fee"}
					{assign var="rate" value="0"}
					{foreach from=$s_rate.rates key=key_id item=r}{math equation="x + y" x=$rate y=$r assign="rate"}{/foreach}
					<p>
						<input id="{$prefix}est_{$shipping_id}{$id_suffix}" type="radio" class="radio" name="shipping_ids[0]" value="{$shipping_id}" {if (!$cart.shipping && $smarty.foreach.fee.first) || $cart.shipping.$shipping_id}checked="checked"{/if} />&nbsp;<label for="{$prefix}est_{$shipping_id}{$id_suffix}" class="valign">{$s_rate.name}{if $s_rate.delivery_time} ({$s_rate.delivery_time}){/if} - {include file="common_templates/price.tpl" value=$rate}</label>
					</p>
				{/foreach}
			{/hook}

			<div class="buttons-container">
				{include file="buttons/button.tpl" but_text=$lang.select but_role="text" but_name="dispatch[checkout.update_shipping]"}
			</div>

			</form>
			{else}
			<p class="error-text center">
				{$lang.text_no_shipping_methods}
			</p>
			{/if}

			<hr />
		{/if}
		<!--shipping_estimation{if $location == "sidebox"}_sidebox{/if}{$id_suffix}--></div>

		<script type="text/javascript">
		//<![CDATA[
		{if !$smarty.capture.states_builded}
		var field_groups = new Object();
		// Message that will show if at least one of required fields isn't filled
		var default_country = '{$settings.General.default_country|escape:javascript}';
		var states = new Array();
		{assign var="states" value=$smarty.const.CART_LANGUAGE|fn_get_all_states:false:true}
		{if $states}
		{foreach from=$states item=country_states key=country_code}
		states['{$country_code}'] = new Array();
		{foreach from=$country_states item=state name="fs"}
		states['{$country_code}']['{$state.code|escape:quotes}'] = '{$state.state|escape:javascript}';
		{/foreach}
		{/foreach}
		{/if}
		{/if}
		if (!window['default_state']) {$ldelim}
			var default_state = [];
		{$rdelim}
		default_state['estimation{$class_suffix}'] = '{$cart.user_data.s_state|escape:javascript}';
		//]]>
		</script>
		{script src="js/profiles_scripts.js"}
		{capture name="states_builded"}Y{/capture}

		<form class="cm-ajax" name="{$prefix}estimation_form{$id_suffix}" action="{$index_script}" method="post">
		{if $location == "sidebox"}<input type="hidden" name="location" value="sidebox" />{/if}
		{if $additional_id}<input type="hidden" name="additional_id" value="{$additional_id}" />{/if}
		<input type="hidden" name="result_ids" value="shipping_estimation{if $location == "sidebox"}_sidebox{/if}{$id_suffix}" />
		<div class="form-field">
			<label for="{$prefix}elm_country{$id_suffix}" class="cm-country cm-location-estimation{$class_suffix}">{$lang.country}:</label>
			<select id="{$prefix}elm_country{$id_suffix}" class="cm-location-estimation{$class_suffix}" name="customer_location[country]">
				<option value="">- {$lang.select_country} -</option>
				{assign var="countries" value=1|fn_get_simple_countries}
				{foreach from=$countries item=country key=ccode}
				<option value="{$ccode}" {if ($cart.user_data.s_country == $ccode) || (!$cart.user_data.s_country && $ccode == $settings.General.default_country)}selected="selected"{/if}>{if $block.properties.positions == "left" || $block.properties.positions == "right"}{$country|truncate:18}{else}{$country}{/if}</option>
				{/foreach}
			</select>
		</div>

		<div class="form-field">
			<label for="{$prefix}elm_state{$id_suffix}" class="cm-state cm-location-estimation{$class_suffix}">{$lang.state}:</label>
			<input type="text" class="input-text hidden" id="{$prefix}elm_state{$id_suffix}_d" name="customer_location[state]" size="{if $location != "sidebox"}32{else}20{/if}" maxlength="64" value="{$cart.user_data.s_state}" disabled="disabled" />
			<select id="{$prefix}elm_state{$id_suffix}" name="customer_location[state]">
				<option label="" value="">- {$lang.select_state} -</option>
			</select>
		</div>

		<div class="form-field">
			<label for="{$prefix}elm_zipcode{$id_suffix}" {if $location == "sidebox"}class="nowrap"{/if}>{$lang.zip_postal_code}:</label>
			<input type="text" class="input-text" id="{$prefix}elm_zipcode{$id_suffix}" name="customer_location[zipcode]" size="{if $location != "sidebox"}25{else}20{/if}" value="{$cart.user_data.s_zipcode}" />
		</div>

		<div class="buttons-container">
			{include file="buttons/button.tpl" but_text=$lang.estimate but_name="dispatch[checkout.shipping_estimation]" but_role="text"}
		</div>

		</form>
{if $location != "sidebox"}
	</div>
</div>
{/if}
