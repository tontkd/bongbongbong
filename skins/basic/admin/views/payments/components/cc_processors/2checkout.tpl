{* $Id: 2checkout.tpl 6560 2008-12-15 11:41:36Z zeke $ *}

{assign var="r_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.notify&payment=2checkout"}
<p>{$lang.text_2checkout_notice|replace:"[return_url]":$r_url}</p>
<hr />

<div class="form-field">
	<label for="account_number">{$lang.account_number}:</label>
	<input type="text" name="payment_data[processor_params][account_number]" id="account_number" value="{$processor_params.account_number}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="secret_word">{$lang.secret_word}:</label>
	<input type="text" name="payment_data[processor_params][secret_word]" id="secret_word" value="{$processor_params.secret_word}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" {if $processor_params.mode == "test"}selected="selected"{/if}>{$lang.test}</option>
		<option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>
