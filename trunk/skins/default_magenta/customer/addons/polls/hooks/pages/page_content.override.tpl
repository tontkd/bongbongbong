{* $Id: page_content.override.tpl 6581 2008-12-17 09:45:53Z zeke $ *}

{if $page.page_type == $smarty.const.PAGE_TYPE_POLL}
	{include file="addons/polls/views/pages/components/poll.tpl" poll=$page.poll}
{/if}