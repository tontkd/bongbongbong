{* $Id: one_news.tpl 6967 2009-03-04 09:26:06Z angel $ *}
<div class="search-result">
	<strong>{$n.result_number}.</strong> <a href="{$index_script}?dispatch=news.view&amp;news_id={$n.news_id}#{$n.news_id}" class="product-title">{$n.news}</a>
	<p>{$lang.date_added}: {$n.date|date_format:"`$settings.Appearance.date_format`"}</p>
	<p>{$n.description|unescape|truncate:280:"... </i></b><a href=\"`$index_script`?dispatch=news.view&amp;news_id=`$n.news_id`#`$n.news_id`\" class=\"underlined\">`$lang.more_link`</a>"}</p>
</div>