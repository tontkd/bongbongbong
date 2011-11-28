{* $Id: update.tpl 7500 2009-05-19 11:20:46Z zeke $ *}

{include file="views/profiles/components/profiles_scripts.tpl"}

{capture name="mainbox"}

{capture name="tabsbox"}

	<form name="profile_form" action="{$index_script}" method="post" class="cm-form-highlight">
	{if $mode != "add"}<input type="hidden" name="user_id" value="{$smarty.request.user_id|default:$auth.user_id}" />{/if}
	<input type="hidden" name="selected_section" id="selected_section" value="{$selected_section}" />

	
	<div id="content_general">
		<fieldset>
		{if "ACP"|strstr:$user_type}
			{include file="views/profiles/components/profiles_account.tpl"}
		{else}
			{hook name="profiles:general_content"}
			{/hook}
		{/if}
		</fieldset>
		
		<fieldset>
		{include file="views/profiles/components/profile_fields.tpl" section="C" title=$lang.contact_information}
		</fieldset>

		{if $settings.General.user_multiple_profiles == "Y" && $mode == "update"}
		<fieldset>
			{include file="common_templates/subheader.tpl" title=$lang.user_profile_info}
			<p class="form-note">{$lang.text_multiprofile_notice}</p>
			{include file="views/profiles/components/multiple_profiles.tpl"}
		</fieldset>
		{/if}

		<fieldset>
		{if $profile_fields.B}
			{include file="views/profiles/components/profile_fields.tpl" section="B" title=$lang.billing_address}
			{include file="views/profiles/components/profile_fields.tpl" section="S" title=$lang.shipping_address body_id="sa" shipping_flag=$profile_fields.B|@sizeof|default:false}
		{else}
			{include file="views/profiles/components/profile_fields.tpl" section="S" title=$lang.shipping_address shipping_flag=false}
		{/if}
		</fieldset>
	</div>

	<div id="content_addons">
		{hook name="profiles:detailed_content"}
		{/hook}
	</div>

	{hook name="profiles:tabs_content"}
	{/hook}

	<p class="select-field notify-customer">
		<input type="checkbox" name="notify_customer" value="Y" checked="checked" class="checkbox" id="notify_customer" />
		<label for="notify_customer">{$lang.notify_user}</label>
	</p>

	<div class="buttons-container buttons-bg">
		{if $mode == "add"}
			{include file="buttons/create_cancel.tpl" but_name="dispatch[profiles.add]"}
		{else}
			{include file="buttons/save_cancel.tpl" but_name="dispatch[profiles.update.$action]"}
		{/if}
	</div>


	</form>

	{if $mode != "add"}
		{hook name="profiles:tabs_extra"}
		{/hook}
	{/if}
{/capture}

{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox group_name=$controller active_tab=$selected_section track=true}

{/capture}
{if $mode == "add"}
	{assign var="_title" value=$lang.new_profile}
{else}
	{if $user_data.firstname}
		{assign var="_title" value="`$lang.editing_profile`: `$user_data.firstname` `$user_data.lastname`"}
	{else}
		{assign var="_title" value="`$lang.editing_profile`: `$user_data.company`"}
	{/if}
	{capture name="extra_tools"}
		{if $user_data.user_type == "C"}
			<a class="tool-link" href="{$index_script}?dispatch=orders.manage&amp;user_id={$user_data.user_id}">{$lang.view_all_orders}</a>&nbsp;&nbsp;|&nbsp;
		{/if}
		{if $user_data.user_type|fn_user_need_login}
			<a class="tool-link" href="{$index_script}?dispatch=profiles.act_as_user&amp;user_id={$user_data.user_id}" target="_blank">{$lang.act_on_behalf}</a>
		{/if}
	{/capture}
{/if}
{include file="common_templates/mainbox.tpl" title=$_title content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools}