{* $Id: payment_extra.post.tpl 7177 2009-04-02 08:00:55Z zeke $ *}

<div class="promotion-coupon cm-tools-list right">
<form {if $location == "checkout" && $settings.General.one_page_checkout == "Y"}class="cm-ajax"{/if} name="gift_certificate_payment_form" action="{$index_script}" method="post">
<input type="hidden" name="redirect_mode" value="{$location}" />
<input type="hidden" name="result_ids" value="checkout_totals,cart_items,checkout_steps,cart_status" />

<div class="form-field">
	<strong class="valign">{$lang.gift_cert_code}:</strong><label for="gc_field" class="hidden cm-required">{$lang.gift_cert_code}:</label>
	<input type="text" id="gc_field" class="input-text" name="gift_cert_code" size="40" value="" />
	<input type="submit" class="hidden" name="dispatch[checkout.apply_certificate]" value="" />
	{include file="buttons/button.tpl" but_role="text" but_name="dispatch[checkout.apply_certificate]" but_rev="gift_certificate_payment_form" but_text=$lang.apply}
</div>

</form>
</div>