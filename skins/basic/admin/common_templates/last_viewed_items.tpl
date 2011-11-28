{* $Id: last_viewed_items.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

<div class="last-items-content cm-smart-position cm-popup-box hidden" id="last_edited_items">
{if $last_edited_items}
	<ul>
	{foreach from=$last_edited_items item=lnk}
		<li><a {if $lnk.icon}class="{$lnk.icon}"{/if} href="{$lnk.url}" title="{$lnk.name}">{$lnk.name|truncate:40}</a></li>
	{/foreach}
	</ul>
	<p class="float-right"><a class="cm-ajax text-button-edit" href="{$index_script}?dispatch=tools.cleanup_history" rev="last_edited_items">{$lang.cleanup_history}</a></p>
{else}
	<p>{$lang.no_items}</p>
{/if}
<!--last_edited_items--></div>
