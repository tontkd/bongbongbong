{* $Id: mainbox_general.tpl 7166 2009-03-31 13:29:22Z zeke $ *}
{if $anchor}
<a name="{$anchor}"></a>
{/if}
<div class="mainbox-container">
	{if $title}
	<h1 class="mainbox-title"><span>{$title}</span></h1>
	{/if}
	<div class="mainbox-body">{$content}</div>
</div>