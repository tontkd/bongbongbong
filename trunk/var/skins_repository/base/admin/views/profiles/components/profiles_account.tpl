{* $Id: profiles_account.tpl 7627 2009-06-29 07:52:45Z lexa $ *}

{include file="common_templates/subheader.tpl" title=$lang.user_account_information}

{if $uid == 1 || ($user_data.user_type == "A" && "RESTRICTED_ADMIN"|defined)}
	<input type="hidden" name="user_data[status]" value="A" />
	<input type="hidden" name="user_data[user_type]" value="A" />
	<input type="hidden" name="user_data[membership_id]" value="{$user_data.membership_id}" />
	<input type="hidden" name="user_data[membership_status]" value="{$user_data.membership_status}" />
{/if}

{if $settings.General.use_email_as_login == "Y"}
<div class="form-field">
	<label for="email" class="cm-required cm-email">{$lang.email}:</label>
	<input type="text" id="email" name="user_data[email]" class="input-text" size="32" maxlength="128" value="{$user_data.email}" />
</div>

{else}

<div class="form-field">
	<label for="user_login_profile" class="cm-required">{$lang.username}:</label>
	<input id="user_login_profile" type="text" name="user_data[user_login]" class="input-text" size="32" maxlength="32" value="{$user_data.user_login}" />
</div>
{/if}

<div class="form-field">
	<label for="password1" class="cm-required">{$lang.password}:</label>
	<input type="password" id="password1" name="user_data[password1]" class="input-text" size="32" maxlength="32" value="{if $mode == "update"}            {/if}" autocomplete="off" />
</div>

<div class="form-field">
	<label for="password2" class="cm-required">{$lang.confirm_password}:</label>
	<input type="password" id="password2" name="user_data[password2]" class="input-text" size="32" maxlength="32" value="{if $mode == "update"}            {/if}" autocomplete="off" />
</div>


{if $uid != 1 || $user_data.user_type != "A" || "RESTRICTED_ADMIN"|defined}

{include file="common_templates/select_status.tpl" input_name="user_data[status]" id="user_data" obj=$user_data hidden=false}

<div class="form-field">
	<label for="user_type" class="cm-required">{$lang.account_type}:</label>
	<select id="user_type" name="user_data[user_type]">
		<option value="C" {if $user_data.user_type == "C" || ($mode == "add" && $smarty.request.user_type == "C")}selected="selected"{/if}>{$lang.customer}</option>
		{hook name="profiles:account"}
		{if $user_data.user_type == "P"}
			<option value="P" {if $user_data.user_type == "P" || ($mode == "add" && $smarty.request.user_type == "P")}selected="selected"{/if}>{$lang.affiliate}</option>
		{/if}
		{/hook}
		<option value="A" {if $user_data.user_type == "A" || ($mode == "add" && $smarty.request.user_type == "A")}selected="selected"{/if}>{$lang.administrator}</option>
	</select>
</div>

<div class="form-field">
	<label for="tax_exempt">{$lang.tax_exempt}:</label>
	<input type="hidden" name="user_data[tax_exempt]" value="N" />
	<input id="tax_exempt" type="checkbox" name="user_data[tax_exempt]" value="Y" {if $user_data.tax_exempt == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="user_language">{$lang.language}</label>
	<select name="user_data[lang_code]" id="user_language">
		{foreach from=$languages item="language" key="lang_code"}
			<option value="{$lang_code}" {if $lang_code == $user_data.lang_code}selected="selected"{/if}>{$language.name}</option>
		{/foreach}
	</select>
</div>

{if $memberships}
{hook name="profiles:membership"}
<div class="form-field">
	<label for="membership_id">{$lang.signup_for_membership}:</label>
	<select id="membership_id" name="user_data[membership_id]">
		<option value="0">{$lang.not_a_member}</option>
		{foreach from=$memberships item=membership}
			<option value="{$membership.membership_id}" {if $user_data.membership_id == $membership.membership_id}selected="selected"{/if}>{$membership.membership}</option>
		{/foreach}
	</select>
</div>
{/hook}

<div class="form-field">
	<label for="membership_status">{$lang.activate_membership}:</label>
	<input type="hidden" name="user_data[membership_status]" value="P" />
	<input id="membership_status" type="checkbox" name="user_data[membership_status]" value="A" {if $user_data.membership_status == "A"}checked="checked"{/if} class="checkbox" />
</div>
{/if}
{/if}