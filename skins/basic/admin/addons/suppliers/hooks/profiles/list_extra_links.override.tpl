{* $Id: list_extra_links.override.tpl 6682 2008-12-25 14:35:33Z angel $ *}

{if $user.user_type == "S"}
	<li><a href="{$index_script}?dispatch=products.manage&amp;sid={$user.user_id}">{$lang.view_supplier_products}</a></li>
{/if}
