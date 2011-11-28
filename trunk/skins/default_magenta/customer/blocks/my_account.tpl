{* $Id: my_account.tpl 7806 2009-08-12 10:22:35Z alexions $ *}
{** block-description:my_account **}

<!--dynamic:my_account-->
{if $auth.user_id}
<strong>{$user_info.firstname} {$user_info.lastname}</strong>
{/if}

<ul class="arrows-list">
{hook name="profiles:my_account_menu"}
	{if $auth.user_id}
		<li><a href="{$index_script}?dispatch=profiles.update" class="underlined">{$lang.profile_details}</a></li>
		<li><a href="{$index_script}?dispatch=orders.downloads" class="underlined">{$lang.downloads}</a></li>
	{else}
		<li><a href="{if $controller == "auth" && $mode == "login_form"}{$config.current_url}{else}{$index_script}?dispatch=auth.login_form&amp;return_url={$config.current_url|escape:url}{/if}" class="underlined">{$lang.sign_in}</a> / <a href="{$index_script}?dispatch=profiles.add" class="underlined">{$lang.register}</a></li>
	{/if}
	<li><a href="{$index_script}?dispatch=orders.search" class="underlined">{$lang.orders}</a></li>
{/hook}

{if $auth.user_id}
		<li class="delim"></li>
		<li><a href="{$index_script}?dispatch=auth.logout&amp;redirect_url={$config.current_url|escape:url}" class="underlined">{$lang.sign_out}</a></li>
{/if}
</ul>

<div class="updates-wrapper">

<form action="{$index_script}" method="get" name="track_order_quick">

<p>{$lang.track_my_order}:</p>

<div class="form-field">
<label for="track_order_item" class="cm-required hidden">{$lang.track_my_order}:</label>
{strip}
{if $auth.user_id}
	{assign var="_mode" value="details"}
	<input type="text" size="20" class="input-text cm-hint" id="track_order_item" name="order_id" value="{$lang.order_id|escape:html}" />
{else}
	{assign var="_mode" value="track_request"}
	<input type="hidden" name="redirect_url" value="{$config.current_url}" />
	<input type="text" size="20" class="input-text cm-hint" id="track_order_item" name="track_data" value="{$lang.order_id|escape:html}/{$lang.email|escape:html}" />
{/if}

{include file="buttons/go.tpl" but_name="orders.$_mode" alt=$lang.go}
</div>

{/strip}
</form>

</div>
<!--/dynamic-->