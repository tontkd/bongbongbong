{* $Id: central.tpl 7128 2009-03-25 10:02:46Z zeke $ *}
{** block-description:polls_central **}

<!--dynamic:polls_central-->
{if $items}
{foreach from=$items item="poll"}
{include file="addons/polls/views/pages/components/poll.tpl"}
{/foreach}
{/if}
<!--/dynamic-->