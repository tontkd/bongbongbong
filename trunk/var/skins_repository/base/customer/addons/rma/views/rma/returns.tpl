{* $Id: returns.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{capture name="section"}
	{include file="addons/rma/views/rma/components/rma_search_form.tpl"}
{/capture}
{include file="common_templates/section.tpl" section_title=$lang.search section_content=$smarty.capture.section}

<form action="{$index_script}" method="post" name="rma_list_form">

{include file="common_templates/pagination.tpl"}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
{if $search.sort_order == "asc"}
{assign var="sort_sign" value="&nbsp;&nbsp;&#8595;"}
{else}
{assign var="sort_sign" value="&nbsp;&nbsp;&#8593;"}
{/if}
{if $settings.DHTML.admin_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}

{/if}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th width="10%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=return_id&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.id}</a>{if $search.sort_by == "return_id"}{$sort_sign}{/if}</th>
	<th width="10%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=status&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.status}</a>{if $search.sort_by == "status"}{$sort_sign}{/if}</th>
	<th width="30%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=customer&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.customer}</a>{if $search.sort_by == "customer"}{$sort_sign}{/if}</th>
	<th width="25%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=timestamp&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.date}</a>{if $search.sort_by == "timestamp"}{$sort_sign}{/if}</th>
	<th width="10%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=order_id&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.order}&nbsp;{$lang.id}</a>{if $search.sort_by == "order_id"}{$sort_sign}{/if}</th>
	<th width="10%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=amount&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.quantity}</a>{if $search.sort_by == "amount"}{$sort_sign}{/if}</th>
</tr>
{foreach from=$return_requests item="request"}
<tr {cycle values=",class=\"table-row\""}>
	<td class="center"><a href="{$index_script}?dispatch=rma.details&amp;return_id={$request.return_id}" class="underlined">&nbsp;<strong>#{$request.return_id}</strong>&nbsp;</a></td>
	<td>
		<input type="hidden" name="origin_statuses[{$request.return_id}]" value="{$request.status}">
		{include file="common_templates/status.tpl" status=$request.status display="view" name="return_statuses[`$request.return_id`]" status_type=$smarty.const.STATUSES_RETURN}
	</td>
	<td>{$request.firstname} {$request.lastname}</td>
	<td><a href="{$index_script}?dispatch=rma.details&amp;return_id={$request.return_id}" class="underlined">{$request.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</a></td>
	<td class="center"><a href="{$index_script}?dispatch=orders.details&amp;order_id={$request.order_id}" class="underlined">&nbsp;<strong>#{$request.order_id}</strong>&nbsp;</a></td>
	<td class="center">{$request.total_amount}</td>
<tr>
{foreachelse}
<tr>
	<td colspan="6"><p class="no-items">{$lang.no_return_requests_found}</p></td>
</tr>
{/foreach}
<tr class="table-footer">
	<td colspan="6">&nbsp;</td>
</tr>
</table>

{include file="common_templates/pagination.tpl"}

</form>

{capture name="mainbox_title"}{$lang.return_requests}{/capture}
