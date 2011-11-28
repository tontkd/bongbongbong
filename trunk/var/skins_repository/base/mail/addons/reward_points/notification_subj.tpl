{* $Id: notification_subj.tpl 2782 2007-03-27 05:31:14Z zenuch $ *}

{if $reason.action == 'A'}
	{assign var="action" value="added to"}
{elseif $reason.action == 'S'}
	{assign var="action" value="subtracted from"}
{/if}
{$settings.Company.company_name}: {$reason.amount} {$lang.points} {$lang.reward_points_subj|replace:"[action]":"`$action`"}