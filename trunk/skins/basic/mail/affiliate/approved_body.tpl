{* $Id: approved_body.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.dear} {$user_data.firstname},<br /><br />

{$lang.email_approved_notification_header|replace:"[company]":$settings.Company.company_name}<br /><br />

<p>{$lang.affiliate_backend}:	{$config.http_location}/{$config.partner_index}</p><br />

{if $reason_approved}
<b>{$lang.reason}:</b><br />
{$reason_approved}<br /><br />
{/if}

{include file="profiles/profiles_info.tpl"}

{include file="letter_footer.tpl"}
