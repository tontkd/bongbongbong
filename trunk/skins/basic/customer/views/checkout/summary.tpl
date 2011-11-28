{* $Id: summary.tpl 7599 2009-06-23 05:26:26Z lexa $ *}

{capture name="summary"}

{* Payment methods form *}

{if $settings.General.one_page_checkout != "Y"}
	{include file="views/profiles/components/profiles_info.tpl" user_data=$cart.user_data shipping_method=$cart.shipping location="I"}
{/if}

<div id="summary">
	{if $settings.General.one_page_checkout == "Y" && $payment_method.template && $cart|fn_allow_place_order && $cart.total|floatval}
		{include file="views/orders/components/payments/`$payment_method.template`" payment_id=$payment_method.payment_id}
	{/if}
<!--summary--></div>

<p>{$lang.text_customer_notes}:</p>
<textarea class="input-textarea checkout-textarea" name="customer_notes" cols="60" rows="8"></textarea>
{if $cart_agreements || $settings.General.agree_terms_conditions == "Y"}

<script type="text/javascript">
//<![CDATA[
lang.checkout_terms_n_conditions_alert = '{$lang.checkout_terms_n_conditions_alert|escape:javascript}';
{literal}
function fn_check_agreement(id)
{
	if (!$('#' + id).attr('checked')) {
		return lang.checkout_terms_n_conditions_alert;
	}

	return true;
}
{/literal}
//]]>
</script>

<table width="100%" cellpadding="3" cellspacing="0" border="0">
<tr valign="top">
	<td>
	{if $settings.General.agree_terms_conditions == "Y"}
	<div class="form-field revert">
		{hook name="checkout:terms_and_conditions"}
		<input type="checkbox" id="id_accept_terms" name="accept_terms" value="Y" class="checkbox valign" /><label for="id_accept_terms" class="valign cm-custom (check_agreement)">{$lang.checkout_terms_n_conditions}</label>
		{/hook}
	</div>
	{/if}
	{if $cart_agreements}
	<div class="form-field revert">
		{hook name="checkout:terms_and_conditions_downloadable"}
		<input type="checkbox" id="product_agreements" name="agreements[]" value="Y" class="valign checkbox" /><label for="product_agreements" class="valign cm-custom (check_agreement)">{$lang.checkout_edp_terms_n_conditions}</label>{include file="buttons/button.tpl" but_text=$lang.license_agreement but_role="text" but_id="sw_elm_agreements" but_meta="cm-combination"}
		{/hook}
		<div class="hidden" id="elm_agreements">
		{foreach from=$cart_agreements item="product_agreements"}
			{foreach from=$product_agreements item="agreement"}
			<p>{$agreement.license|unescape}</p>
			{/foreach}
		{/foreach}
		</div>
	</div>
	{/if}
	</td>
	<td valign="bottom">
{/if}
{if $settings.General.one_page_checkout == "Y"}
	<div class="buttons-container right">
		{include file="buttons/place_order.tpl" but_name="dispatch[checkout.place_order]" but_role="big"}
	</div>
{/if}

{if $cart_agreements || $settings.General.agree_terms_conditions == "Y"}
	</td>
</tr>
</table>
{/if}

{if $auth.act_as_user}
<div class="select-field">
	<input type="checkbox" id="skip_payment" name="skip_payment" value="Y" class="checkbox" />
	<label for="skip_payment">{$lang.skip_payment}</label>
</div>
{/if}
{/capture}

<form action="{$index_script}" method="post" name="summary_form">
{if $settings.General.one_page_checkout == "Y"}
	{$smarty.capture.summary}
{else}

	<div class="classic-checkout">
	{include file="views/checkout/components/progressbar.tpl"}

	{script src="js/cc_validator.js"}

	{capture name="group"}

	{$smarty.capture.summary}

	{/capture}
	{include file="common_templates/group.tpl" content=$smarty.capture.group}

	{include file="views/checkout/components/checkout_totals.tpl" location="checkout"}

	<div class="buttons-container right">
		{include file="buttons/place_order.tpl" but_name="dispatch[checkout.place_order]"}
	</div>

	</div>
{/if}
</form>