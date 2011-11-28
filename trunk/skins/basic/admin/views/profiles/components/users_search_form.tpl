{* $Id: users_search_form.tpl 7083 2009-03-19 09:52:10Z zeke $ *}

{capture name="section"}

<form name="user_search_form" action="{$index_script}" method="get">

{if $smarty.request.redirect_url}
<input type="hidden" name="redirect_url" value="{$smarty.request.redirect_url}" />
{/if}

{if $selected_section != ""}
<input type="hidden" id="selected_section" name="selected_section" value="{$selected_section}" />
{/if}

{if $search.user_type}
<input type="hidden" name="user_type" value="{$search.user_type}" />
{/if}

{$extra}

<table cellpadding="0" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="search-field nowrap">
		<label for="name">{$lang.name}:</label>
		<div class="break">
			<input class="search-input-text" type="text" name="name" id="name" value="{$search.name}" />
			{include file="buttons/search_go.tpl" search="Y" but_name=$dispatch}
		</div>
	</td>
	<td class="search-field">
		<label for="company">{$lang.company}:</label>
		<div class="break">
			<input class="input-text" type="text" name="company" id="company" value="{$search.company}" />
		</div>
	</td>
	<td class="search-field">
		<label for="email">{$lang.email}:</label>
		<div class="break">
			<input class="input-text" type="text" name="email" id="email" value="{$search.email}" />
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_name="dispatch[$dispatch]" but_role="submit"}
	</td>
</tr>
</table>

{capture name="advanced_search"}

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td>
		<div class="search-field">
			<label for="user_login">{$lang.username}:</label>
			<input class="input-text" type="text" name="user_login" id="user_login" value="{$search.user_login}" />
		</div>

		<div class="search-field">
			<label for="membership_id">{$lang.membership}:</label>
			<select name="membership_id" id="membership_id">
				<option value="{$smarty.const.ALL_MEMBERSHIPS}"> -- </option>
				<option value="0" {if $search.membership_id == $smarty.const.NOT_A_MEMBER}selected="selected"{/if}>{$lang.not_a_member}</option>
				{foreach from=$memberships item=membership}
				<option value="{$membership.membership_id}" {if $search.membership_id == $membership.membership_id}selected="selected"{/if}>{$membership.membership}</option>
				{/foreach}
			</select>
		</div>

		<div class="search-field">
			<label for="tax_exempt">{$lang.tax_exempt}:</label>
			<select name="tax_exempt" id="tax_exempt">
				<option value="">--</option>
				<option value="Y" {if $search.tax_exempt == "Y"}selected="selected"{/if}>{$lang.yes}</option>
				<option value="N" {if $search.tax_exempt == "N"}selected="selected"{/if}>{$lang.no}</option>
			</select>
		</div>

		<div class="search-field">
			<label for="address">{$lang.address}:</label>
			<input class="input-text" type="text" name="address" id="address" value="{$search.address}" />
		</div>
	</td>
	<td>

		<div class="search-field">
			<label for="city">{$lang.city}:</label>
			<input class="input-text" type="text" name="city" id="city" value="{$search.city}" />
		</div>
		<div class="search-field">
			<label for="srch_country" class="cm-country cm-location-search">{$lang.country}:</label>
			<select id="srch_country" name="country" class="cm-location-search">
				<option value="">- {$lang.select_country} -</option>
				{foreach from=$countries item=country}
				<option value="{$country.code}" {if $search.country == $country.code}selected="selected"{/if}>{$country.country}</option>
				{/foreach}
			</select>
		</div>

		<div class="search-field">
			<label for="srch_state" class="cm-state cm-location-search">{$lang.state}:</label>
			<input type="text" id="srch_state_d" name="state" maxlength="64" value="{$search.state}" disabled="disabled" class="input-text hidden" />
			<select id="srch_state" name="state">
				<option value="">- {$lang.select_state} -</option>
			</select>
		</div>

		<div class="search-field">
			<label for="zipcode">{$lang.zip_postal_code}:</label>
			<input class="input-text" type="text" name="zipcode" id="zipcode" value="{$search.zipcode}" />
		</div>
	</td>
</tr>
</table>

{hook name="profiles:search_form"}
{/hook}

<div class="search-field">
	<label>{$lang.ordered_products}:</label>
	{include file="pickers/search_products_picker.tpl"}
</div>

{/capture}

{include file="common_templates/advanced_search.tpl" content=$smarty.capture.advanced_search dispatch=$dispatch view_type="users"}

</form>
<script type="text/javascript">
//<![CDATA[
	default_state = {$ldelim}'search':'{$smarty.request.state|escape:javascript}'{$rdelim};
//]]>
</script>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}
