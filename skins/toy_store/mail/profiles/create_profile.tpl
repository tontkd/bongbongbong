{* $Id: create_profile.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.dear} {if $user_data.firstname}{$user_data.firstname}{else}{$user_data.user_type|fn_get_user_type_description|lower}{/if},<br><br>

{$lang.create_profile_notification_header} {$settings.Company.company_name}.<br><br>

{if $user_data.user_type == 'P'}
	<p>{$lang.affiliate_backend}:	{$config.http_location}/{$config.partner_index}<br />
	{$lang.text_partner_create_profile}</p><br /><br />

{/if}
{include file="profiles/profiles_info.tpl"}

{include file="letter_footer.tpl"}
