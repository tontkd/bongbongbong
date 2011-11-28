{* $Id: testimonials.tpl 7476 2009-05-17 20:06:18Z zeke $ *}

{** block-description:discussion_title_home_page **}

{assign var="discussion" value=0|fn_get_discussion:"E"}

{if $discussion && $discussion.type != "D"}

{assign var="posts" value=$discussion.thread_id|fn_get_discussion_posts:0:$block.properties.limit}

{if $posts}
{foreach from=$posts item=post}

{if $discussion.type == "C" || $discussion.type == "B"}
	<p class="post-message">"{$post.message|truncate:100|nl2br}"</p>
{/if}

<p class="post-author">&ndash; {$post.name}{if $block.properties.positions != "left" && $block.properties.positions != "right"}, <em>{$post.timestamp|date_format:"`$settings.Appearance.date_format`"}</em>{/if}</p>

{if $block.properties.positions != "left" && $block.properties.positions != "right"}
<div class="clear">
	<div class="right"></div>
	{if $discussion.type == "R" || $discussion.type == "B"}
		<div class="right">{include file="addons/discussion/views/discussion/components/stars.tpl" stars=$post.rating_value|fn_get_discussion_rating}</div>
	{/if}
</div>
{/if}



{/foreach}

<div class="right">
	<a href="{$index_script}?dispatch=discussion.view&amp;thread_id={$discussion.thread_id}">{$lang.more_w_ellipsis}</a>
</div>
{/if}

{/if}