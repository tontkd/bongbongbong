{* $Id: multiple_profiles.tpl 7247 2009-04-13 08:03:56Z zeke $ *}

{if $settings.General.user_multiple_profiles == "Y"}

<div class="form-field" id="profiles_list">
	<label>{$lang.select_profile}:</label>
	{foreach from=$user_profiles item="up" name="pfe"}
		{if $up.profile_id == $user_data.profile_id}
			<strong>{$up.profile_name}</strong>
		{else}
			<a href="{$config.current_url|fn_link_attach:"profile_id=`$up.profile_id`"}#profiles_list">{$up.profile_name}</a>
		{/if}

		{if $up.profile_type != "P"}
			{include file="buttons/button.tpl" but_meta="cm-confirm" but_text="&nbsp;" but_href="$index_script?dispatch=profiles.delete_profile&amp;user_id=`$user_data.user_id`&amp;profile_id=`$up.profile_id`" but_role="delete_item"}
		{/if}

		{if !$smarty.foreach.pfe.last}&nbsp;|&nbsp;{/if}
	{/foreach}
	{if !$skip_create}
		&nbsp;&nbsp;{$lang.or}&nbsp;&nbsp;&nbsp;<a class="lowercase" href="{$config.current_url|fn_query_remove:"profile_id"|fn_link_attach:"profile=new"}#profiles_list">{$lang.create_profile}</a>
	{/if}
</div>

<div class="form-field">
	<label for="profile_name" class="cm-required">{$lang.profile_name}:</label>
	{if $smarty.request.profile == "new"}
		{assign var="profile_name" value="- `$lang.new` -"}
	{else}
		{assign var="profile_name" value=$lang.main}
	{/if}
	<input type="hidden" id="profile_id" name="user_data[profile_id]" value="{$user_data.profile_id|default:"0"}" />
	<input type="text" id="profile_name" name="user_data[profile_name]" size="32" value="{$user_data.profile_name|default:$profile_name}" />
</div>
{else}
<div>
	<input type="hidden" id="profile_name" name="user_data[profile_name]" value="{$user_data.profile_name|default:$lang.main}" />
</div>
{/if}
