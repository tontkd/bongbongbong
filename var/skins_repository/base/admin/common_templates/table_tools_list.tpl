{* $Id: table_tools_list.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $popup}
	{include file="common_templates/popupbox.tpl" id=$id text=$text link_text=$link_text act=$act href=$href link_class=$link_class}
{elseif $href}
	<a class="tool-link" href="{$href}">{$link_text|default:$lang.edit}</a>
{/if}
{if $tools_list|strpos:"<li"}{if $href}&nbsp;&nbsp;|{elseif $separate}|{/if}
	{include file="common_templates/tools.tpl" prefix=$prefix hide_actions=true tools_list="<ul>`$tools_list`</ul>" display="inline" link_text=$lang.more link_meta="lowercase"}
{/if}
