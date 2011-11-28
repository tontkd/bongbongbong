{* $Id: new_notification.tpl 6626 2008-12-22 08:25:14Z zeke $ *}

{$user.firstname} {$user.lastname}<br />
<br />
{$lang.revisions_history}: <a href="{$history_link}">{$history_link}</a><br />
<br />
{$lang.date}: {$time|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}<br />
<br />
{if $revision.note}
{$lang.declined_by}: {$puser.firstname} {$puser.lastname}<br />
<br />
{$lang.decline_reason}: {$revision.note}
{else}
{$lang.created_by}: {$puser.firstname} {$puser.lastname}
{/if}