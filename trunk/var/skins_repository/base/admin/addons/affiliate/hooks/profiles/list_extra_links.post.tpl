{* $Id: list_extra_links.post.tpl 7190 2009-04-03 12:23:46Z zeke $ *}

{if $user.user_type == "P"}
	<li><a href="{$index_script}?dispatch=orders.manage&amp;user_id={$user.user_id}">{$lang.view_all_orders}</a></li>
	<li><a href="{$index_script}?dispatch=profiles.act_as_user&amp;user_id={$user.user_id}" target="_blank" >{$lang.act_on_behalf}</a></li>
{/if}