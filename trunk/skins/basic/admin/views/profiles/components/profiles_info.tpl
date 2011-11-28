{* $Id: profiles_info.tpl 7424 2009-05-05 14:10:18Z zeke $ *}

{assign var="profile_fields" value=$location|fn_get_profile_fields}


<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td width="{if $payment_info}34%{else}50%{/if}">
		{if $user_data.b_firstname || $user_data.b_lastname || $user_data.b_address || $user_data.b_address_2 || $user_data.b_city || $user_data.b_country_descr || $user_data.b_state_descr || $user_data.b_zipcode || $profile_fields.B}
		{include file="common_templates/subheader.tpl" title=$lang.billing_address}
		<div class="details-block">
			<p class="strong">{if $user_data.b_title_descr}{$user_data.b_title_descr}&nbsp;{/if}{$user_data.b_firstname}&nbsp;{$user_data.b_lastname}</p>
			<p>{$user_data.b_address}{if $user_data.b_address_2} {$user_data.b_address_2}{/if}{if $user_data.b_city || $user_data.b_country_descr || $user_data.b_state_descr},{/if}</p>
			<p>{$user_data.b_city}{if $user_data.b_city && $user_data.b_state_descr}, {/if}{$user_data.b_state_descr}{if $user_data.b_country_descr && ($user_data.b_city || $user_data.b_state_descr)}, {/if}{$user_data.b_country_descr}</p>
			{if $user_data.b_zipcode}<p>{$lang.zip_postal_code}: {$user_data.b_zipcode}</p>{/if}
			{include file="views/profiles/components/profile_fields_info.tpl" fields=$profile_fields.B}
		</div>
		{/if}
	</td>
	<td class="details-block-container" width="{if $payment_info}34%{else}50%{/if}">
		{if $user_data.s_firstname || $user_data.s_lastname || $user_data.s_address || $user_data.s_address_2 || $user_data.s_city || $user_data.s_country_descr || $user_data.s_state_descr || $lang.zip_postal_code || $profile_fields.S}
		{include file="common_templates/subheader.tpl" title=$lang.shipping_address}
		<div class="details-block">
			<p class="strong">{if $user_data.s_title_descr}{$user_data.s_title_descr}&nbsp;{/if}{$user_data.s_firstname}&nbsp;{$user_data.s_lastname}</p>
			<p>{$user_data.s_address}{if $user_data.s_address_2} {$user_data.s_address_2}{/if}{if $user_data.s_city || $user_data.s_country_descr || $user_data.s_state_descr},{/if}</p>
			<p>{$user_data.s_city}{if $user_data.s_city && $user_data.s_state_descr}, {/if}{$user_data.s_state_descr}{if $user_data.s_country_descr && ($user_data.s_city || $user_data.s_state_descr)}, {$user_data.s_country_descr}{/if}</p>
			<p>{$lang.zip_postal_code}: {$user_data.s_zipcode}</p>
			{include file="views/profiles/components/profile_fields_info.tpl" fields=$profile_fields.S}
		</div>
		{/if}
	</td>
	{if $payment_info}
	<td class="details-block-container" width="33%" rowspan="2">
	{hook name="orders:payment_info"}
	{***************** Payment INFO ******************}
	{if $user_data.payment_id}
		{include file="common_templates/subheader.tpl" title=$lang.payment_information}
		<div class="form-field">
			<label>{$lang.method}:</label>
			{$user_data.payment_method.payment}&nbsp;{if $user_data.payment_method.description}({$user_data.payment_method.description}){/if}
		</div>

		{if $user_data.payment_info}
			{foreach from=$user_data.payment_info item=item key=key}
			{if $item && ($key != "expiry_year" && $key != "start_year")}
				<div class="form-field">
					<label>{if $key == "card"}{assign var="cc_exists" value=true}{$lang.credit_card}{elseif $key == "expiry_month"}{$lang.expiry_date}{elseif $key == "start_month"}{$lang.start_date}{else}{$lang.$key}{/if}:</label>
					{if $key == "order_status"}
						{include file="common_templates/status.tpl" status=$item display="view" status_type=""}
					{elseif $key == "reason_text"}
						{$item|nl2br}
					{elseif $key == "expiry_month"}
						{$item}/{$user_data.payment_info.expiry_year}
					{elseif $key == "start_month"}
						{$item}/{$user_data.payment_info.start_year}
					{else}
						{$item}
					{/if}
				</div>
			{/if}
			{/foreach}

			{if $cc_exists}
			<p class="right">
				<input type="hidden" name="order_ids[]" value="{$user_data.order_id}" />
				{include file="buttons/button.tpl" but_text=$lang.remove_cc_info but_name="dispatch[orders.remove_cc_info]"}
			</p>
			{/if}
		{/if}
	{/if}
	{/hook}

	{***************** Shipping INFO ******************}
	{if $user_data.shipping}
		{include file="common_templates/subheader.tpl" title=$lang.shipping_information}
	
		{foreach from=$user_data.shipping item="shipping" key="shipping_id" name="f_shipp"}
		<div class="form-field">
			<label>{$lang.method}:</label>
			{$shipping.shipping}
		</div>
	
		<div class="form-field">
			<label>{$lang.tracking_number}:</label>
			<input type="text" class="input-text-medium" name="update_shipping[{$shipping_id}][tracking_number]" size="45" value="{$shipping.tracking_number}" />
		</div>
		<div class="form-field">
			<label>{$lang.carrier}:</label>
			<select name="update_shipping[{$shipping_id}][carrier]">
				<option value="">--</option>
				<option value="USP" {if $shipping.carrier == "USP"}selected="selected"{/if}>{$lang.usps}</option>
				<option value="UPS" {if $shipping.carrier == "UPS"}selected="selected"{/if}>{$lang.ups}</option>
				<option value="FDX" {if $shipping.carrier == "FDX"}selected="selected"{/if}>{$lang.fedex}</option>
				<option value="AUP" {if $shipping.carrier == "AUP"}selected="selected"{/if}>{$lang.australia_post}</option>
				<option value="DHL" {if $shipping.carrier == "DHL" || $user_data.carrier == "ARB"}selected="selected"{/if}>{$lang.dhl}</option>
				<option value="CHP" {if $shipping.carrier == "CHP"}selected="selected"{/if}>{$lang.chp}</option>
			</select>
		</div>
		{/foreach}
	{/if}
	{**********\\*********}
	</td>
	{/if}
</tr>
{if $user_data.email || $user_data.phone || $user_data.fax || $user_data.company || $user_data.url}
<tr>
	<td colspan="2">
	<div class="details-block clear">
		{if $user_data.ip_address}
			<div class="form-field float-right">
				<label>{$lang.ip_address}:</label>
				{$user_data.ip_address}
			</div>
		{/if}
		
		<p class="strong">{if $user_data.title_descr}{$user_data.title_descr}&nbsp;{/if}{$user_data.firstname}&nbsp;{$user_data.lastname}, <a href="mailto:{$user_data.email}">{$user_data.email}</a></p>
		<div class="clear">
			<div class="left-col">
				{if $user_data.phone}
					<div class="form-field">
						<label>{$lang.phone}:</label>
						<strong>{$user_data.phone}</strong>
					</div>
				{/if}
				{if $user_data.fax}
					<div class="form-field">
						<label>{$lang.fax}:</label>
						<strong>{$user_data.fax}</strong>
					</div>
				{/if}
			</div>
			<div class="float-left">
				{if $user_data.company}
					<div class="form-field">
						<label>{$lang.company}:</label>
						<strong>{$user_data.company}</strong>
					</div>
				{/if}
				{if $user_data.url}
					<div class="form-field">
						<label>{$lang.website}:</label>
						<strong>{$user_data.url}</strong>
					</div>
				{/if}
			</div>
		</div>
		{include file="views/profiles/components/profile_fields_info.tpl" fields=$profile_fields.C customer_info="Y"}
		{if $email_changed}
			<div class="form-field">
				<label>{$lang.attention}</label>
				{$lang.notice_update_customer_details}
			</div>
	
			<div class="select-field">
				<input type="checkbox" name="update_customer_details" id="update_customer_details" value="Y" class="checkbox" />
				<label for="update_customer_details">{$lang.update_customer_info}</label>
			</div>
		{/if}
	</div>
	</td>
</tr>
{/if}
{if $mode == "order_management"}
<tr valign="top">
	<td width="50%">
		{if $payment_method.payment}
			{include file="common_templates/subheader.tpl" title=$lang.payment_method}
			<div class="details-block">
				{$payment_method.payment}&nbsp;<a href="{$index_script}?dispatch=order_management.totals">[{$lang.change}]</a>
			</div>
		{else}
			&nbsp;
		{/if}
	</td>
	<td class="details-block-container" width="50%">
		{if $shipping_method}
			{include file="common_templates/subheader.tpl" title=$lang.shipping_method}
			<div class="details-block">
				{foreach from=$shipping_method item="m" name="sh"}{$m.shipping}{if !$smarty.foreach.sh.last},&nbsp;{/if}{/foreach}&nbsp;<a href="{$index_script}?dispatch=order_management.totals">[{$lang.change}]</a>
			</div>
		{else}
			&nbsp;
		{/if}
	</td>
</tr>
{/if}

</table>

