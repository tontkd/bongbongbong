{* $Id: list.tpl 7515 2009-05-21 07:27:31Z angel $ *}

{if $news}

{include file="common_templates/pagination.tpl"}

{foreach from=$news item=n}
<a name="{$n.news_id}"></a>
<h5 class="info-field-title">
	<em class="float-right">{$lang.date_added}: {$n.date|date_format:"`$settings.Appearance.date_format`"}</em>
	{$n.news}
</h5>
<div class="info-field-body">
{if $n.separate == "Y"}
	<a href="{$index_script}?dispatch=news.view&amp;news_id={$n.news_id}">{$lang.more_w_ellipsis}</a>
{else}
	{hook name="news:list"}
		{$n.description|unescape}
	{/hook}
{/if}
</div>
{/foreach}

{include file="common_templates/pagination.tpl"}

{/if}

{capture name="mainbox_title"}{$lang.site_news}{/capture}