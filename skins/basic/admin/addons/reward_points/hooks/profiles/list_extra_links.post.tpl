{* $Id: list_extra_links.post.tpl 6814 2009-01-20 14:53:58Z angel $ *}

{if $user.user_type == "C"}
	<li><a href="{$index_script}?dispatch=reward_points.userlog&amp;user_id={$user.user_id}">{$lang.points} ({if $user.points}{$user.points|@unserialize}{else}0{/if})</a></li>
{/if}