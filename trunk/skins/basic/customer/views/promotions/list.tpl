{* $Id: list.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

{foreach from=$promotions item="promotion"}
	{include file="common_templates/subheader.tpl" title=$promotion.name}
	{$promotion.detailed_description|default:$promotion.short_description|unescape}
{foreachelse}
	<p>{$lang.text_no_active_promotions}</p>
{/foreach}

{capture name="mainbox_title"}{$lang.active_promotions}{/capture}
