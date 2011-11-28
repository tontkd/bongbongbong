{* $Id: pagination.tpl 7184 2009-04-02 11:52:38Z zeke $ *}

{assign var="id" value=$id|default:"pagination_contents"}
{if $smarty.capture.pagination_open != "Y"}
	{if $settings.DHTML.customer_ajax_based_pagination == "Y" && $pagination.total_pages > 1}
		{script src="js/jquery.history.js"}
	{/if}
	<div class="pagination-container" id="{$id}">
	
	{if $save_current_page}
	<input type="hidden" name="page" value="{$search.page|default:$smarty.request.page}" />
	{/if}
	
	{if $save_current_url}
	<input type="hidden" name="redirect_url" value="{$config.current_url}" />
	{/if}
	
	{/if}
	
	{if $pagination.total_pages > 1}
	{assign var="qstring" value=$smarty.server.QUERY_STRING|fn_query_remove:"page":"result_ids"|escape}
	{if $settings.DHTML.customer_ajax_based_pagination == "Y"}
		{assign var="ajax_class" value="cm-ajax"}
	{/if}
	
	<div class="pagination cm-pagination-wraper center">
		{$lang.navi_pages}:&nbsp;&nbsp;
	
		{if $pagination.prev_range}
			<a name="pagination" href="{$index_script}?{$qstring}&amp;page={$pagination.prev_range}" rel="{$pagination.prev_range}" class="cm-history {$ajax_class}" rev="{$id}">...</a>
		{/if}
	
		{foreach from=$pagination.navi_pages item="pg"}
			{if $pg != $pagination.current_page}
				<a name="pagination" href="{$index_script}?{$qstring}&amp;page={$pg}" rel="{$pg}" class="cm-history {$ajax_class}" rev="{$id}">{$pg}</a>
			{else}
				<strong class="pagination-selected-page">{$pg}</strong>
			{/if}
		{/foreach}
	
		{if $pagination.next_range}
			<a name="pagination" href="{$index_script}?{$qstring}&amp;page={$pagination.next_range}" rel="{$pagination.next_range}" class="cm-history {$ajax_class}" rev="{$id}">...</a>
		{/if}
	</div>
{/if}

{if $smarty.capture.pagination_open == "Y"}
	<!--{$id}--></div>
	{capture name="pagination_open"}N{/capture}
{elseif $smarty.capture.pagination_open != "Y"}
	{capture name="pagination_open"}Y{/capture}
{/if}