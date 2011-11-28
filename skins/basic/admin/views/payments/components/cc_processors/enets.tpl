{* $Id: enets.tpl 7719 2009-07-16 04:46:38Z zeke $ *}

{assign var="r_url" value="<strong>`$config.http_location`/payments/enets.php</strong>"}
<p>{$lang.text_enets_notice|replace:"[r_url]":$r_url}</p>
<hr />

<div class="form-field">
	<label for="merchantid">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchantid]" id="merchantid" value="{$processor_params.merchantid}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" {if $processor_params.mode == "test"}selected="selected"{/if}>{$lang.test}</option>
		<option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>
