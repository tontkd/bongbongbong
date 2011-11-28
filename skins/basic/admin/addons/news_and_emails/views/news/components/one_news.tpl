{* $Id: one_news.tpl 7394 2009-04-29 11:43:22Z zeke $ *}
<div class="search-result">
	<strong>{$n.result_number}.</strong> <a href="{$index_script}?dispatch=news.update&amp;news_id={$n.news_id}#{$n.news_id}" class="list-product-title">{$n.news|unescape}</a>
	
	<p>
	{$lang.date_added}: {$n.date|date_format:"`$settings.Appearance.date_format`"}<br />
	{$n.description|unescape|strip_tags|truncate:280:"<a href=\"`$index_script`?dispatch=news.update&amp;news_id=`$n.news_id`#`$n.news_id`\" class=\"underlined\">`$lang.more_link`</a>"}</p>
</div>