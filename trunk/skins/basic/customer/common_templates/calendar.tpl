{* $Id: calendar.tpl 7488 2009-05-18 09:59:28Z zeke $ *}

{if $settings.Appearance.calendar_date_format == "month_first"}
	{assign var="date_format" value="%m/%d/%Y"}
{else}
	{assign var="date_format" value="%d/%m/%Y"}
{/if}

<input type="text" id="{$date_id}" name="{$date_name}" class="input-text-medium" value="{if $date_val}{$date_val|date_format:"`$date_format`"}{/if}" {$extra} size="10" />&nbsp;<img src="{$images_dir}/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but hand" id="sw_{$date_id}_picker" title="{$lang.calendar}" alt="{$lang.calendar}" />
<div id="{$date_id}_picker" class="calendar-box cm-smart-position cm-popup-box hidden"></div>

{script src="js/calendar.js"}

{math equation="x+y" assign="end_year" x=$end_year|default:1 y=$smarty.const.TIME|date_format:"%Y"}
{assign var="start_year" value=$start_year|default:$settings.Company.company_start_year}
{assign var="years_list" value=$start_year|range:$end_year}

<script type="text/javascript">
//<![CDATA[
new ccal({$ldelim}id: '{$date_id}_picker', date_id: '{$date_id}', button_id: 'sw_{$date_id}_picker', month_first: {if $settings.Appearance.calendar_date_format == "month_first"}true{else}false{/if}, sunday_first: {if $settings.Appearance.calendar_week_format == "sunday_first"}true{else}false{/if}, week_days_name: ['{$lang.weekday_abr_0}', '{$lang.weekday_abr_1}', '{$lang.weekday_abr_2}', '{$lang.weekday_abr_3}', '{$lang.weekday_abr_4}', '{$lang.weekday_abr_5}', '{$lang.weekday_abr_6}'], months: ['{$lang.month_name_abr_1}', '{$lang.month_name_abr_2}', '{$lang.month_name_abr_3}', '{$lang.month_name_abr_4}', '{$lang.month_name_abr_5}', '{$lang.month_name_abr_6}', '{$lang.month_name_abr_7}', '{$lang.month_name_abr_8}', '{$lang.month_name_abr_9}', '{$lang.month_name_abr_10}', '{$lang.month_name_abr_11}', '{$lang.month_name_abr_12}'], years: [{", "|implode:$years_list}]{$rdelim});
//]]>
</script>