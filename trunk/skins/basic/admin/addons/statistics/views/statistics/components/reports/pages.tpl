{* $Id: pages.tpl 6001 2008-09-26 06:16:17Z angel $ *}

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
			{$row.label|default:$lang.undefined}
			{if ($report_data.report == "pages_by_visits" || $report_data.report == "entry_points" || $report_data.report == "exit_points") && $row.title}
				<br />{$row.title}
			{/if}
			{include file="views/sales_reports/components/graph_bar.tpl" bar_width="400px" value_width=$row.percent|round}
			</div>
		</td>
		<td align="right">
			<a href="{$index_script}?dispatch=statistics.visitors&amp;section=pages&amp;report={$report_data.report}&amp;object_code={$row.label|escape:url}">{$row.count}</a>
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
