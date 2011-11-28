{* $Id: add_to_wishlist.tpl 6703 2009-01-03 14:05:52Z angel $ *}

{if $auth.user_id}
	{include file="buttons/button.tpl" but_id=$but_id but_name=$but_name but_text=$lang.add_to_wishlist but_role="text" but_onclick=$but_onclick but_href=$but_href}
{else}
	{assign var="c_url" value=$config.current_url|escape:url}
	{include file="buttons/button.tpl" but_name="" but_text=$lang.add_to_wishlist but_role="text" but_href="$index_script?dispatch=auth.login_form&amp;return_url=$c_url" but_onclick=""}
{/if}
