{* $Id: geography.tpl 6001 2008-09-26 06:16:17Z angel $ *}

{capture name="tabsbox"}

<div id="content_{$report_data.report}">
	{if $report_data.data}
	{capture name="table_chart"}
	
	<table cellpadding="2" cellspacing="1" border="0">
	{foreach from=$report_data.data item="row" name="stat"}
	<tr {cycle values=",class=\"manage-row\""}>
		<td>{$smarty.foreach.stat.iteration}</td>
		<td>
			<div class="no-scroll">
				{if $report_data.report == "ip_addresses"}
					{$row.host_ip} {if $row.proxy_ip}<span class="small-note">({$lang.proxy} {$row.proxy_ip})</span>{/if}
				{else}
					{$row.label|default:$lang.undefined}
				{/if}
				{include file="views/sales_reports/components/graph_bar.tpl" bar_width="400px" value_width=$row.percent|round}
			</div>
		</td>
		<td align="right">
			{if $report_data.report == "countries"}
				{assign var="object_code" value=$row.country_code}
			{elseif $report_data.report == "languages"}
				{assign var="object_code" value=$row.client_language}
			{elseif $report_data.report == "ip_addresses"}
				{assign var="object_code" value="`$row.host_ip`&amp;proxy_ip=`$row.proxy_ip`"}
			{/if}
			<a href="{$index_script}?dispatch=statistics.visitors&amp;section=geography&amp;report={$report_data.report}&amp;object_code={$object_code}">{$row.count}</a>
			<p class="small-note">{$row.percent}%</p></td>
	</tr>
	{/foreach}
	</table>

	{/capture}
	{include file="addons/statistics/views/statistics/components/select_charts.tpl" chart_table=$smarty.capture.table_chart chart_type=$chart_type applicable_charts="bar,pie"}
	{else}
		<p class="no-items">{$lang.no_data}</p>
	{/if}
<!--content_{$report_data.report}--></div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$report_data.report}
