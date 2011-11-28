{* $Id: tabsbox.tpl 7538 2009-05-27 15:55:45Z lexa $ *}
{if !$active_tab}
	{assign var="active_tab" value=$smarty.request.selected_section}
{/if}

{if $navigation.tabs}
{script src="js/tabs.js"}
<div class="tabs cm-j-tabs{if $track} cm-track{/if}">
	<ul>
	{foreach from=$navigation.tabs item=tab key=key name=tabs}
		{if !$tabs_section || $tabs_section == $tab.section}
		<li id="{$key}{$id_suffix}" class="{if $tab.js}cm-js{elseif $tab.ajax}cm-js cm-ajax{/if}{if $key == $active_tab} cm-active{/if}"><a {if $tab.href}href="{$tab.href}"{/if}>{$tab.title}</a></li>
		{/if}
	{/foreach}
	</ul>
</div>
<div class="cm-tabs-content">
	{$content}
</div>
{else}
	{$content}
{/if}