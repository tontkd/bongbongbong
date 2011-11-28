{* $Id: details_bullets.post.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{assign var="discussion" value=$order_info.order_id|fn_get_discussion:"O"}
{if $addons.discussion.order_initiate == "Y" && !$discussion}
	<li><a href="{$index_script}?dispatch=orders.initiate_discussion&amp;order_id={$order_info.order_id}">{$lang.start_communication}</a></li>
{/if}