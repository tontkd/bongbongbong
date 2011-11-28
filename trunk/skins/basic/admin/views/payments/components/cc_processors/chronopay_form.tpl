{* $Id: chronopay_form.tpl 6560 2008-12-15 11:41:36Z zeke $ *}

<p>{$lang.text_chronopay_form_notice|replace:"[return_url]":"<strong>`$config.current_location`/`$config.customer_index`?dispatch=payment_notification.notify&payment=chronopay_form</strong>"}</p>
<hr />

<div class="form-field">
	<label for="product_id">{$lang.product_id}:</label>
	<input type="text" name="payment_data[processor_params][product_id]" id="product_id" value="{$processor_params.product_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="encrypt">{$lang.encryption_key}:</label>
	<input type="text" name="payment_data[processor_params][encrypt]" id="encrypt" value="{$processor_params.encrypt}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="USD" {if $processor_params.currency == "USD"}selected="selected"{/if}>{$lang.currency_code_usd}</option>
	</select>
</div>
