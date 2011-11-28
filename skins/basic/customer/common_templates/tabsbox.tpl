{* $Id: tabsbox.tpl 6123 2008-10-08 14:37:14Z lexa $ *}
{if !$active_tab}
	{assign var="active_tab" value=$smarty.request.selected_section}
{/if}

{if $navigation.tabs}
{script src="js/tabs.js"}
<div class="tabs clear cm-j-tabs">
	<ul {if $tabs_section}id="tabs_{$tabs_section}"{/if}>
	{foreach from=$navigation.tabs item=tab key=key name=tabs}
		{if (!$tabs_section && !$tab.section) || ($tabs_section == $tab.section)}
		<li id="{$key}" class="{if $tab.js}cm-js{elseif $tab.ajax}cm-js cm-ajax{/if}{if $key == $active_tab} cm-active{/if}"><a{if $tab.href} href="{$tab.href}"{/if}>{$tab.title}</a></li>
		{/if}
	{/foreach}
	</ul>
</div>
<div class="cm-tabs-content" id="tabs_content">
	{$content}
</div>

{if $onclick}
<script>
	//<![CDATA[
	var hndl = {$ldelim}
		'tabs_{$tabs_section}': {$onclick}
	{$rdelim}
	//]]>
</script>
{/if}
{else}
	{$content}
{/if}