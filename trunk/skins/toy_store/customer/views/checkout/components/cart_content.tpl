{* $Id: cart_content.tpl 7257 2009-04-14 06:30:22Z angel $ *}

{assign var="result_ids" value="cart_items,checkout_totals,checkout_steps,cart_status"}

<form name="checkout_form" action="{$index_script}" method="post">
<input type="hidden" name="redirect_mode" value="cart" />
<input type="hidden" name="result_ids" value="{$result_ids}" />

{include file="views/checkout/components/cart_items.tpl" disable_ids="button_cart"}

<div class="cart-buttons clear">
	<div class="float-left">{include file="buttons/clear_cart.tpl" but_href="$index_script?dispatch=checkout.clear" but_role="text" but_meta="cm-confirm"}</div>
	<div class="float-right">{include file="buttons/update_cart.tpl" but_id="button_cart" but_name="dispatch[checkout.update]"}</div>
</div>

</form>

{include file="views/checkout/components/checkout_totals.tpl" location="cart"}

<div class="buttons-container clear">
	<div class="float-left">
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}</div>
	<div class="float-right">
	{if $payment_methods}
		{if $settings.General.one_page_checkout != "Y"}
			{assign var="m_name" value="customer_info"}
		{else}
			{assign var="m_name" value="checkout"}
		{/if}
		{include file="buttons/checkout.tpl" but_onclick="fn_proceed_to_checkout('$m_name');" but_href="$index_script?dispatch=checkout.checkout"}
	{/if}
	{if $checkout_add_buttons}
		{foreach from=$checkout_add_buttons item="checkout_add_button"}
			<p>{$checkout_add_button}</p>
		{/foreach}
	{/if}
	</div>
</div>
