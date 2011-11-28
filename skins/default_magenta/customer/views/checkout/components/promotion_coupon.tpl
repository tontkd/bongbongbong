{* $Id: promotion_coupon.tpl 7177 2009-04-02 08:00:55Z zeke $ *}

<div class="promotion-coupon cm-tools-list right">
<form {if $use_ajax}class="cm-ajax"{/if} name="coupon_code_form" action="{$index_script}" method="post">
<input type="hidden" name="redirect_mode" value="{$location}" />
<input type="hidden" name="result_ids" value="checkout_totals,cart_items,checkout_steps,cart_status" />

<div class="form-field">
	<strong>{$lang.discount_coupon_code}:</strong><label for="coupon_field" class="hidden cm-required">{$lang.discount_coupon_code}</label>
	<input type="text" class="input-text" id="coupon_field" name="coupon_code" size="40" value="" />
	<input type="submit" class="hidden" name="dispatch[checkout.apply_coupon]" value="" />
	{include file="buttons/button.tpl" but_role="text" but_name="dispatch[checkout.apply_coupon]" but_text=$lang.apply but_rev="coupon_code_form"}
</div>

</form>
</div>
