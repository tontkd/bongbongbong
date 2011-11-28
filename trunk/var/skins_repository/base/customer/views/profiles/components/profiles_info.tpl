{* $Id: profiles_info.tpl 6861 2009-02-02 11:41:41Z angel $ *}

{include file="common_templates/subheader.tpl" title=$lang.customer_information}

{assign var="profile_fields" value=$location|fn_get_profile_fields}
{split data=$profile_fields.C size=2 assign="contact_fields" simple=true}

<h5 class="info-field-title">{$lang.contact_information}</h5>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td width="50%" class="info-field-body"{if $profile_fields.B && $profile_fields.S} colspan="2"{/if}>
		{include file="views/profiles/components/profile_fields_info.tpl" fields=$contact_fields.0 title=$lang.contact_information}
	</td>
	<td width="50%" class="info-field-body">
		{include file="views/profiles/components/profile_fields_info.tpl" fields=$contact_fields.1}
	</td>
</tr>
{if $profile_fields.B || $profile_fields.S}
<tr valign="top">
	{if $profile_fields.B}
	<td width="48%"{if !$profile_fields.S} colspan="2"{/if}>
		<h5 class="info-field-title">{$lang.billing_address}</h5>
		<div class="info-field-body">{include file="views/profiles/components/profile_fields_info.tpl" fields=$profile_fields.B title=$lang.billing_address}</div>
	</td>
	{/if}
	{if $profile_fields.B && $profile_fields.S}<td width="4%">&nbsp;</td>{/if}
	{if $profile_fields.S}
	<td width="48%"{if !$profile_fields.B} colspan="2"{/if}>
		<h5 class="info-field-title">{$lang.shipping_address}</h5>
		<div class="info-field-body">{include file="views/profiles/components/profile_fields_info.tpl" fields=$profile_fields.S title=$lang.shipping_address}</div>
	</td>
	{/if}
</tr>
{/if}
</table>

{if !$details}
	{include file="common_templates/subheader.tpl" title=$lang.payment_information}
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		{if $payment_method.payment && !$order_info}
		<td valign="top" width="48%">
			<h5 class="info-field-title">
				<a href="{$index_script}?dispatch=checkout.checkout#payment_methods" class="float-right">{$lang.change}</a>
				{$lang.payment_method}
			</h5>
			<div class="info-field-body">
				{$payment_method.payment}
			</div>
		</td>
		{/if}
		{if $payment_method.payment && !$order_info && $shipping_method}<td width="4%">&nbsp;</td>{/if}
		{if $shipping_method}
		<td valign="top" width="48%">
			<h5 class="info-field-title">
				<a href="{$index_script}?dispatch=checkout.checkout#shipping_rates" class="float-right">{$lang.change}</a>
				{$lang.shipping_method}
			</h5>
			<div class="info-field-body">
			<ul>
				{foreach from=$shipping_method item="shipping" name="f_shipp"}
					<li>{$shipping.shipping}</li>
				{/foreach}
			</ul>
			</div>
		</td>
		{/if}
	</tr>
	</table>
	
	{if $payment_method.template}
		{capture name="payment_template"}
			{include file="views/orders/components/payments/`$payment_method.template`" payment_id=$payment_method.payment_id}
		{/capture}
		
		{if $smarty.capture.payment_template|trim}
		<h5 class="info-field-title">{$lang.payment_details}</h5>
		<div class="info-field-body">
			{$smarty.capture.payment_template}
		</div>
		{/if}
		{if $auth.act_as_user}
		<div class="select-field">
			<input type="checkbox" name="skip_payment" id="skip_payment_checkbox" value="Y" class="checkbox" />
			<label for="skip_payment_checkbox">{$lang.skip_payment}</label>
		</div>
		{/if}
	{/if}
{/if}
