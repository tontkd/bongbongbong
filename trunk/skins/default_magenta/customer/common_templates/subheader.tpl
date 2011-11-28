{* $Id: subheader.tpl 7043 2009-03-16 08:49:44Z zeke $ *}
{if $anchor}
<a name="{$anchor}"></a>
{/if}
<h2 class="{$class|default:"subheader"}">
	{if $notes|trim}
		{include file="common_templates/help.tpl" content=$notes id=$notes_id text=$text}
	{/if}
	{$title}
</h2>