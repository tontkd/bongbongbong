{* $Id: cc.tpl 7811 2009-08-13 08:13:01Z zeke $ *}

<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr valign="top">
	<td>
		<div class="form-field">
			<label for="cc_type" class="cm-required">{$lang.select_card}:</label>
			<select id="cc_type" name="payment_info[card]" onchange="fn_check_cc_type(this.value);">
				{foreach from=$credit_cards item="c"}
					<option value="{$c.param}" {if $cart.payment_info.card == $c.param}selected="selected"{/if}>{$c.descr}</option>
				{/foreach}
			</select>
		</div>
		
		<div class="form-field">
			<label for="cc_number" class="cm-required cm-custom (validate_cc)">{$lang.card_number}:</label>
			<input id="cc_number" size="35" type="text" name="payment_info[card_number]" value="{$cart.payment_info.card_number}" class="input-text" />
		</div>

		<div class="form-field">
			<label for="cc_name" class="cm-required">{$lang.cardholder_name}:</label>
			<input id="cc_name" size="35" type="text" name="payment_info[cardholder_name]" value="{$cart.payment_info.cardholder_name}" class="input-text" />
		</div>

		<div class="form-field hidden" id="display_start_date">
			<label class="cm-required">{$lang.start_date}:</label>
			<label for="cc_start_month" class="hidden cm-required cm-custom (check_cc_date)">{$lang.month}:</label><label for="cc_start_year" class="hidden cm-required cm-custom (check_cc_date)">{$lang.year}:</label>
			<input type="text" id="cc_start_month" name="payment_info[start_month]" value="{$cart.payment_info.start_month}" size="2" maxlength="2" class="input-text-short" />&nbsp;/&nbsp;<input type="text" id="cc_start_year" name="payment_info[start_year]" value="{$cart.payment_info.start_year}" size="2" maxlength="2" class="input-text-short" />&nbsp;(mm/yy)
		</div>

		<div class="form-field">
			<label class="cm-required">{$lang.expiry_date}:</label>
			<label for="cc_exp_month" class="hidden cm-required cm-custom (check_cc_date)">{$lang.month}:</label><label for="cc_exp_year" class="hidden cm-required cm-custom (check_cc_date)">{$lang.year}:</label>
			<input type="text" id="cc_exp_month" name="payment_info[expiry_month]" value="{$cart.payment_info.expiry_month}" size="2" maxlength="2" class="input-text-short" />&nbsp;/&nbsp;<input type="text" id="cc_exp_year" name="payment_info[expiry_year]" value="{$cart.payment_info.expiry_year}" size="2" maxlength="2" class="input-text-short" />&nbsp;(mm/yy)
		</div>

		<div class="form-field hidden" id="display_cvv2">
			<label for="cc_cvv2" class="cm-required cm-integer">{$lang.cvv2}:</label>
			<input id="cc_cvv2" type="text" name="payment_info[cvv2]" value="{$cart.payment_info.cvv2}" size="4" maxlength="4" class="input-text-short" disabled="disabled" />
		</div>

		<div class="form-field hidden" id="display_issue_number">
			<label for="cc_issue_number" class="cm-required">{$lang.issue_number}:</label>
			<input id="cc_issue_number" type="text" name="payment_info[issue_number]" value="{$cart.payment_info.issue_number}" size="2" maxlength="2" class="input-text-short" disabled="disabled" />
		</div>
	</td>
	<td>
		{foreach from=$credit_cards item="c" name="credit_card"}
			{if $c.icon}
				{if $smarty.foreach.credit_card.first}
					{assign var="img_class" value="cm-cc-item"}
				{else}
					{assign var="img_class" value="cm-cc-item hidden"}
				{/if}
				{include file="common_templates/image.tpl" images=$c.icon class=$img_class obj_id=$c.param object_type="credit_card"}
			{/if}
		{/foreach}
	</td>
</tr>
</table>

<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
	lang.error_card_number_not_valid = '{$lang.error_card_number_not_valid|escape:javascript}';

	var cvv2_required = new Array();
	var start_date_required = new Array();
	var issue_number_required = new Array();
	{foreach from=$credit_cards item="c"}
		cvv2_required['{$c.param}'] = '{$c.param_2}';
		start_date_required['{$c.param}'] = '{$c.param_3}';
		issue_number_required['{$c.param}'] = '{$c.param_4}';
	{/foreach}

	{literal}

	function fn_check_cc_type(card)
	{
		if (cvv2_required[card] == 'Y') {
			$('#display_cvv2').switchAvailability(false);
		} else {
			$('#display_cvv2').switchAvailability(true);
		}

		if (start_date_required[card] == 'Y') {
			$('#display_start_date').switchAvailability(false);
		} else {
			$('#display_start_date').switchAvailability(true);
		}

		if (issue_number_required[card] == 'Y') {
			$('#display_issue_number').switchAvailability(false);
		} else {
			$('#display_issue_number').switchAvailability(true);
		}

		$('.cm-cc-item').hide();
		$('#det_img_' + card).show();
	}

	fn_check_cc_type($('#cc_type').val());

	function fn_check_cc_date(id)
	{
		var elm = $('#' + id);

		if (!jQuery.is.integer(elm.val())) {
			return lang.error_validator_integer;
		} else {
			if (elm.val().length == 1) {
				elm.val('0' + elm.val());
			}
		}

		return true;
	}

	{/literal}
//]]>
</script>
