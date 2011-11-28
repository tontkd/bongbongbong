{* $Id: list.post.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{assign var="discussion" value=$n.news_id|fn_get_discussion:"N"}

{if $discussion && $discussion.type != "D"}
	<p><a href="{$index_script}?dispatch=news.view&amp;news_id={$n.news_id}">{$lang.more_w_ellipsis}</a></p>
{/if}