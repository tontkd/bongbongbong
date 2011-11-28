{* $Id: preview_popup.tpl 7368 2009-04-27 14:29:23Z zeke $ *}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<title>
{$lang.page_title_text}
{foreach from=$breadcrumbs item=i name="bkt"}
	{if $smarty.foreach.bkt.index==1} - {/if}{if !$smarty.foreach.bkt.first}{$i.title}{if !$smarty.foreach.bkt.last} :: {/if}{/if}
{/foreach}</title>
{include file="meta.tpl"}
{include file="common_templates/styles.tpl"}
</head>
<body>
<div id="content">{$body|unescape}
</div>
</body>

</html>
