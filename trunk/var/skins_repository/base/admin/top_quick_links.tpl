{* $Id: top_quick_links.tpl 6308 2008-11-12 07:09:24Z angel $ *}

{*<a href="{$index_script}" class="top-quick-links">{$lang.home}</a>&nbsp;&nbsp;|&nbsp;
<a href="{$index_script}?dispatch=orders.search" class="top-quick-links">{$lang.orders}</a>&nbsp;&nbsp;|&nbsp;
<a href="{$index_script}?dispatch=categories.manage" class="top-quick-links">{$lang.categories}</a>&nbsp;&nbsp;|&nbsp;
<a href="{$index_script}?dispatch=products.manage" class="top-quick-links">{$lang.products}</a>&nbsp;&nbsp;|&nbsp;
<a href="{$index_script}?dispatch=settings.manage" class="top-quick-links">{$lang.settings}</a>&nbsp;&nbsp;|&nbsp;*}
<a href="{$config.http_location}" class="top-quick-links" target="_blank">{$lang.view_storefront}</a>&nbsp;&nbsp;|&nbsp;
<a href="{$index_script}?dispatch=profiles.update&amp;user_id={$auth.user_id}"><strong class="lowercase">{if $settings.General.use_email_as_login == "Y"}{$user_info.email}{else}{$user_info.user_login}{/if}</strong></a>
({include file="buttons/sign_out.tpl" but_href="$index_script?dispatch=auth.logout" but_role="text"})