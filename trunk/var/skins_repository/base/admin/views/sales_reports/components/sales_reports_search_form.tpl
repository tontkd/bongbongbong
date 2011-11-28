{* $Id: sales_reports_search_form.tpl 6971 2009-03-05 09:28:18Z zeke $ *}

{capture name="section"}

<form action="{$index_script}" method="post" name="report_form_{$report.report_id}">
<input type="hidden" name="report_id" value="{$report.report_id}" />
<input type="hidden" name="selected_section" value="" />

{include file="common_templates/period_selector.tpl" period=$period form_name="orders_search_form" display="form" but_name="dispatch[sales_reports.reports_view.update_report]"}

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}
