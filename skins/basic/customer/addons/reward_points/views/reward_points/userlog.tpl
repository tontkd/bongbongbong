{* $Id: userlog.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
{if $sort_order == "asc"}
{assign var="sort_sign" value="&nbsp;&nbsp;&#8595;"}
{else}
{assign var="sort_sign" value="&nbsp;&nbsp;&#8593;"}
{/if}
{if $settings.DHTML.admin_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}

{/if}
{include file="common_templates/pagination.tpl"}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th width="15%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=timestamp&amp;sort_order={$sort_order}" rev="pagination_contents">{$lang.date}</a>{if $sort_by == "timestamp"}{$sort_sign}{/if}</th>
	<th width="10%"><a class="{$ajax_class}" href="{$c_url}&amp;sort_by=amount&amp;sort_order={$sort_order}" rev="pagination_contents">{$lang.points}</a>{if $sort_by == "amount"}{$sort_sign}{/if}</th>
	<th width="75%">{$lang.reason}</th>
</tr>
{foreach from=$userlog item="ul"}
<tr {cycle values=",class=\"table-row\""}>
	<td valign="top">{$ul.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	<td class="right"  valign="top">{$ul.amount}</td>
	<td  valign="top">
		{if $ul.action == $smarty.const.CHANGE_DUE_ORDER}
			{assign var="statuses" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true}
			{assign var="reason" value=$ul.reason|unescape|unserialize}
			{$lang.order}&nbsp;<a href="{$index_script}?dispatch=orders.details&amp;order_id={$reason.order_id}" class="underlined">&nbsp;<strong>#{$reason.order_id}</strong></a>:&nbsp;{$statuses[$reason.from]}&nbsp;&#8212;&#8250;&nbsp;{$statuses[$reason.to]}{if $reason.text}&nbsp;({$reason.text|fn_get_lang_var}){/if}
		{elseif $ul.action == $smarty.const.CHANGE_DUE_USE}
			{$lang.text_points_used_in_order}:<a href="{$index_script}?dispatch=orders.details&amp;order_id={$ul.reason}" class="underlined">&nbsp;<strong>#{$ul.reason}</strong>&nbsp;</a>
		{else}
			{hook name="reward_points:userlog"}
			{$ul.reason}
			{/hook}
		{/if}
	</td>
</tr>
{foreachelse}
<tr>
	<td colspan="3"><p class="no-items">{$lang.no_items}</p></td>
</tr>
{/foreach}
<tr class="table-footer">
	<td colspan="3">&nbsp;</td>
</tr>
</table>
{include file="common_templates/pagination.tpl"}
{** / userlog description section **}

{capture name="mainbox_title"}{$lang.reward_points_log}{/capture}
