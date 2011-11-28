{* $Id: thaiepay.tpl 6560 2008-12-15 11:41:36Z zeke $ *}

{assign var="r_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.notify&payment=thaiepay"}
<p>{$lang.text_thaiepay_notice|replace:"[return_url]":$r_url}</p>
<hr />

<div class="form-field">
	<label for="merchantid">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchantid]" id="merchantid" value="{$processor_params.merchantid}" class="input-text" />
</div>

<div class="form-field">
	<label for="details">{$lang.payment_details}:</label>
	<input type="text" name="payment_data[processor_params][details]" id="details" value="{$processor_params.details}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="00" {if $processor_params.currency == "00"}selected="selected"{/if}>{$lang.currency_code_thb}</option>
		<option value="01" {if $processor_params.currency == "01"}selected="selected"{/if}>{$lang.currency_code_usd}</option>
		<option value="02" {if $processor_params.currency == "02"}selected="selected"{/if}>{$lang.currency_code_jpy}</option>
		<option value="03" {if $processor_params.currency == "03"}selected="selected"{/if}>{$lang.currency_code_sgd}</option>
		<option value="04" {if $processor_params.currency == "04"}selected="selected"{/if}>{$lang.currency_code_hkd}</option>
		<option value="05" {if $processor_params.currency == "05"}selected="selected"{/if}>{$lang.currency_code_eur}</option>
		<option value="06" {if $processor_params.currency == "06"}selected="selected"{/if}>{$lang.currency_code_gbp}</option>
		<option value="07" {if $processor_params.currency == "07"}selected="selected"{/if}>{$lang.currency_code_aud}</option>
		<option value="08" {if $processor_params.currency == "08"}selected="selected"{/if}>{$lang.currency_code_chf}</option>
	</select>
</div>
