{* $Id: my_account_menu.post.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if $auth.user_id}
<li><a href="{$index_script}?dispatch=reward_points.userlog" class="underlined">{$lang.my_points}:&nbsp;<strong>{$user_info.points|default:"0"}</strong></a></li>
{/if}