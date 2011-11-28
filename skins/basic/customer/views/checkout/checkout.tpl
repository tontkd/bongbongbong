{* $Id: checkout.tpl 7793 2009-08-07 07:39:31Z alexey $ *}

{script src="js/exceptions.js"}

<script type="text/javascript">
//<![CDATA[
	var cart_changed = false;
	lang['text_cart_changed'] = '{$lang.text_cart_changed|escape:javascript}';
	
	{if $edit_steps}
	{assign var="c_step" value=$edit_steps|implode:""}	
	$(document).ready(function() {$ldelim}
		jQuery.scrollToElm($('#{$c_step}'));
	{$rdelim});
	{/if}
//]]>
</script>

{if $settings.General.one_page_checkout != "Y"}
	{if $cart_products}
	<div class="classic-checkout">
	{include file="views/checkout/components/progressbar.tpl"}
	{/if}

	<form action="{$index_script}" method="post" name="checkout_form">

	{capture name="group"}
		{include file="views/checkout/components/shipping_rates.tpl" no_form=true show_header=true display="select"}
		{include file="views/checkout/components/payment_methods.tpl" no_form=true}
	{/capture}
	{include file="common_templates/group.tpl" content=$smarty.capture.group}

	<div class="buttons-container right">
		{include file="buttons/button.tpl" but_name="dispatch[checkout.order_info]" but_role="big" but_text=$lang.proceed_to_the_next_step but_meta="cm-no-ajax"}
	</div>
	
	</form>

	{if $cart_products}
	</div>
	{/if}

{else}

	{script src="js/cc_validator.js"}
	<a name="checkout_top"></a>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td valign="top" class="checkout-left-col">
			{include file="views/checkout/components/checkout_steps.tpl"}
			</td>
		<td><img src="{$images_dir}/spacer.gif" width="7" height="1" border="0" alt="" /></td>
		<td class="checkout-right-col" valign="top">
			<form class="cm-ajax" name="checkout_form" action="{$index_script}" method="post">
			<input type="hidden" name="redirect_mode" value="checkout" />
			<div>
				{hook name="checkout:cart_item"}
				{if $cart_products}
					{include file="views/checkout/components/cart_items.tpl" disable_ids="button_cart" use_ajax=true}
				{/if}
				{/hook}
			</div>
			<div class="cart-buttons clear">
				{assign var="result_ids" value="cart_items,checkout_totals,checkout_steps,cart_status"}

				<input type="hidden" name="result_ids" value="{$result_ids}" />
				<div class="float-left">{include file="buttons/clear_cart.tpl" but_href="$index_script?dispatch=checkout.clear" but_role="text" but_meta="cm-confirm"}</div>
				<div class="float-right">{include file="buttons/update_cart.tpl" but_id="button_cart" but_name="dispatch[checkout.update]"}</div>
			</div>
			</form>

			{include file="views/checkout/components/checkout_totals.tpl" location="checkout"}
			{if $smarty.capture.checkout_column}
			<div class="right-column">
				{$smarty.capture.checkout_column}
			</div>	
			{/if}
		</td>
	</tr>
	</table>

	{capture name="mainbox_title"}{$lang.checkout}{/capture}
{/if}
