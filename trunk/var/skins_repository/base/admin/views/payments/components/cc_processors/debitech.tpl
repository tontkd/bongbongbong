{* $Id: debitech.tpl 6560 2008-12-15 11:41:36Z zeke $ *}

{assign var="return_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.notify&payment=debitech&order_id=[ver valueof=referenceNo]"}
{assign var="notice" value=$lang.text_debitech_notice|replace:"[post_url]":"`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.notify&payment=debitech"}
<p>{$notice|replace:"[return_url]":$return_url}</p>
<hr />

<div class="form-field">
	<label for="shopname">{$lang.account}:</label>
	<input type="text" name="payment_data[processor_params][shopname]" id="shopname" value="{$processor_params.shopname}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="pageset">{$lang.pageset}:</label>
	<input type="text" name="payment_data[processor_params][pageset]" id="pageset" value="{$processor_params.pageset}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="test">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][test]" id="test">
		<option value="" {if $processor_params.test == ""}selected="selected"{/if}>{$lang.live}</option>
		<option value="1" {if $processor_params.test == "1"}selected="selected"{/if}>{$lang.test}: {$lang.random}</option>
		<option value="2" {if $processor_params.test == "2"}selected="selected"{/if}>{$lang.test}: {$lang.approved}</option>
		<option value="3" {if $processor_params.test == "3"}selected="selected"{/if}>{$lang.test}: {$lang.declined}</option>
	</select>
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="NOK"{if $processor_params.currency eq "NOK"} selected="selected"{/if}>{$lang.currency_code_nok}
		<option value="SEK"{if $processor_params.currency eq "SEK"} selected="selected"{/if}>{$lang.currency_code_sek}
		<option value="DKK"{if $processor_params.currency eq "DKK"} selected="selected"{/if}>{$lang.currency_code_dkk}
		<option value="EUR"{if $processor_params.currency eq "EUR"} selected="selected"{/if}>{$lang.currency_code_eur}
		<option value="GBP"{if $processor_params.currency eq "GBP"} selected="selected"{/if}>{$lang.currency_code_gbp}
		<option value="USD"{if $processor_params.currency eq "USD"} selected="selected"{/if}>{$lang.currency_code_usd}
	</select>
</div>

<div class="form-field">
	<label for="secure3d">{$lang.3dsecure}:</label>
	<select name="payment_data[processor_params][3dsecure]" id="secure3d">
		<option value="true" {if $processor_params.3dsecure == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="" {if $processor_params.3dsecure == ""}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>
