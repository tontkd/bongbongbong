{* $Id: account_info.pre.tpl 7196 2009-04-06 07:57:02Z zeke $ *}

{if $user_data.user_type != "A"}
<div class="form-field">
	<label for="user_type">{$lang.account_type}:</label>
	<select id="user_type" name="user_data[user_type]" {if $mode == "add" || $user_data.user_type != "P"}onchange="$('#id_affiliate_agree_notification').toggleBy(this.value != 'P');"{/if}>
		<option value="C" {if $user_data.user_type == "C" || ($mode == "add" && $smarty.request.user_type == "C")}selected="selected"{/if}>{$lang.customer}</option>
		<option value="P" {if $user_data.user_type == "P" || ($mode == "add" && $smarty.request.user_type == "P")}selected="selected"{/if}>{$lang.affiliate}</option>
	</select>
</div>

{if $mode == "add" || $user_data.user_type != "P"}
{if $mode == "add"}{assign var="_but" value=$lang.register}{else}{assign var="_but" value=$lang.save}{/if}
<p id="id_affiliate_agree_notification" {if $user_data.user_type != "P"}class="hidden"{/if}>{$lang.affiliate_agree_to_terms_conditions|replace:"[button_name]":$_but}</p>
{/if}
{/if}