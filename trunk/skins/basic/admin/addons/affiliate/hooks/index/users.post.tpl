{* $Id: users.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

<li>
	<span><strong>{$lang.affiliates}:</strong></span>
	<em>{if $users_stats.total.P}<a href="{$index_script}?dispatch=profiles.manage&amp;user_type=P">{$users_stats.total.P}</a>{else}0{/if}</em>
</li>

{if $memberships_type.P}
<li>
	<span>{$lang.not_a_member}:</span>
	<em>{if $users_stats.not_members.P}<a href="{$index_script}?dispatch=profiles.manage&amp;membership_id=0&amp;user_type=P">{$users_stats.not_members.P}</a>{else}0{/if}</em>
</li>
{/if}

{foreach from=$memberships key="mem_id" item="mem_name"}
{if $mem_name.type == "P"}
<li>
	<span>{$mem_name.membership}:</span>
	<em>{if $users_stats.membership.P.$mem_id}<a href="{$index_script}?dispatch=profiles.manage&amp;membership_id={$mem_id}">{$users_stats.membership.P.$mem_id}</a>{else}0{/if}</em>
</li>
{/if}
{/foreach}