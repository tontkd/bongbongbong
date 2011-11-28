{* $Id: update.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

{include file="views/profiles/components/profiles_scripts.tpl"}

{$lang.text_mandatory_fields}

<form name="profile_form" action="{$index_script}" method="post">

{capture name="group"}
{include file="views/profiles/components/profiles_account.tpl"}
{include file="views/profiles/components/profile_fields.tpl" section="C" title=$lang.contact_information}

{if $profile_fields.B || $profile_fields.S}
	{if $settings.General.user_multiple_profiles == "Y" && $mode == "update"}
		<p>{$lang.text_multiprofile_notice}</p>
		{include file="views/profiles/components/multiple_profiles.tpl" profile_id=$user_data.profile_id}	
	{/if}

	{include file="views/profiles/components/profile_fields.tpl" section="B" title=$lang.billing_address}
	{include file="views/profiles/components/profile_fields.tpl" section="S" title=$lang.shipping_address body_id="sa" shipping_flag=$profile_fields.B|sizeof|default:false}
{/if}

{hook name="profiles:account_update"}
{/hook}

{if $mode == "add" && $settings.Image_verification.use_for_register == "Y"}
	{include file="common_templates/image_verification.tpl" id="register" align="center"}
{/if}

{/capture}
{include file="common_templates/group.tpl" content=$smarty.capture.group}

<div class="buttons-container center">
	{if $action}
		{assign var="_action" value="$action"}
	{/if}
	{if $mode == "update"}
		{include file="buttons/save.tpl" but_name="dispatch[profiles.update.$_action]"}
	{else}
		{include file="buttons/register_profile.tpl" but_name="dispatch[profiles.add.$_action]"}
	{/if}
</div>
</form>

{capture name="mainbox_title"}{$lang.profile_details}{/capture}
