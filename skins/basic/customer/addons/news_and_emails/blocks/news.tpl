{* $Id: news.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:site_news **}

{if $items}
<ul class="site-news">
{foreach from=$items item="news" name="site_news"}
	<li>
		<strong>{$news.date|date_format:$settings.Appearance.date_format}</strong>
		<a href="{$index_script}?dispatch=news.view&amp;news_id={$news.news_id}#{$news.news_id}">{$news.news}</a>
	</li>
	{if !$smarty.foreach.site_news.last}
	<li class="delim"></li>
	{/if}
{/foreach}
</ul>

<p class="right">
	<a href="{$index_script}?dispatch=news.list" class="extra-link">{$lang.view_all}</a>
</p>
{/if}
