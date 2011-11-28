{* $Id: payment_methods.tpl 7567 2009-06-09 08:09:19Z isergi $ *}

{if $cart|fn_allow_place_order}

{if !$no_form}
<form class="cm-ajax cm-ajax-force" action="{$index_script}" method="post" name="order_info_form">
<input type="hidden" name="result_ids" value="summary,checkout_totals,cart_items,shipping_rates_list" />
{/if}

{if $cart.total|floatval}

	{if !$no_mainbox}
		{include file="common_templates/subheader.tpl" title=$lang.select_payment_method anchor="payment_methods"}
	{/if}

	<table cellpadding="0" cellspacing="8" border="0" id="list_payment_methods">
	{hook name="checkout:payment_methods"}
		{foreach from=$payment_methods item="pm" name="pay"}
		<tr>
			<td>
				<input type="radio" id="payment_method_{$pm.payment_id}" {if $pm.disabled}disabled="disabled"{/if} class="{if !$no_form}cm-submit{/if} radio" name="payment_id" value="{$pm.payment_id}" {if $cart.payment_id == $pm.payment_id || (!$cart.payment_id && $smarty.foreach.pay.first)}{assign var="selected_payment_id" value=$pm.payment_id}{assign var="selected_payment_surcharge_value" value=$pm.surcharge_value|default:"0"}checked="checked"{/if} />
			</td>
			<td><label for="payment_method_{$pm.payment_id}"><strong>{$pm.payment}</strong></label></td>
			<td>&nbsp;</td>
			<td>{$pm.description}</td>
		</tr>
		{/foreach}
	{/hook}
	</table>
{else}
	<input type="hidden" name="payment_id" value="0" />
{/if}

{if !$no_form}
	<div class="cm-noscript buttons-container center">{include file="buttons/button.tpl" but_name="dispatch[checkout.order_info]" but_text=$lang.apply}</div>
</form>
{/if}

{else}
	{if $cart.shipping_failed}
	<p class="error-text center">{$lang.text_no_shipping_methods}</p>
	{/if}
	{if $cart.amount_failed}
	<p class="error-text center">{$lang.text_min_order_amount_required}&nbsp;<strong>{include file="common_templates/price.tpl" value=$settings.General.min_order_amount}</strong></p>
	{/if}

	{if $settings.General.one_page_checkout != "Y"}
	<div class="buttons-container center">
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
	</div>
	{/if}
{/if}
