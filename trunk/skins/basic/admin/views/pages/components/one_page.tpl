{* $Id: one_page.tpl 7394 2009-04-29 11:43:22Z zeke $ *}
<div class="search-result">
	<strong>{$page.result_number}.</strong> <a href="{$index_script}?dispatch=pages.update&amp;page_id={$page.page_id}">{$page.page|unescape}</a>
	<p>{$page.description|unescape|strip_tags|truncate:280:"<a href=\"`$index_script`?dispatch=pages.update&amp;page_id=`$page.page_id`\" >`$lang.more_link`</a>"}</p>
</div>