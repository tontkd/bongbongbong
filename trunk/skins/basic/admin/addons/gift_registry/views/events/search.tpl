{* $Id: search.tpl 7194 2009-04-03 14:21:51Z lexa $ *}

{capture name="mainbox"}

{include file="addons/gift_registry/views/events/components/events_search_form.tpl"}

<form action="{$index_script}" method="post" name="delete_events_form">

{include file="common_templates/pagination.tpl" save_current_url=true}

<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
<tr>
	<th width="1%" class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></td>
	<th width="50%">{$lang.title}</th>
	<th width="15%">{$lang.start_date}</th>
	<th width="15%">{$lang.end_date}</th>
	<th width="10%">{$lang.status}</th>
	<th width="10%">{$lang.type}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$events item=event}
<tr {cycle values="class=\"table-row\","}>
	<td width="1%" class="center">
		<input type="checkbox" name="event_ids[]" value="{$event.event_id}" class="checkbox cm-item" /></td>
	<td><a href="{$index_script}?dispatch=events.update&amp;event_id={$event.event_id}">{$event.title}</a></td>
	<td>{$event.start_date|date_format:$settings.Appearance.date_format}</td>
	<td>{$event.end_date|date_format:$settings.Appearance.date_format}</td>
	<td>{if $event.status == "A"}{$lang.awaiting}{elseif $event.status == "P"}{$lang.in_progress}{else}{$lang.finished}{/if}</td>
	<td>{if $event.type == "P"}{$lang.public}{elseif $event.type == "U"}{$lang.private}{else}{$lang.disabled}{/if}</td>
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{$index_script}?dispatch=events.delete_events&amp;event_id={$event.event_id}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$event.event_id tools_list=$smarty.capture.tools_items href="$index_script?dispatch=events.update&event_id=`$event.event_id`"}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="6"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

<div class="buttons-container buttons-bg">
	{if $events}
	<div class="float-left">
		{include file="buttons/delete_selected.tpl" but_name="dispatch[events.delete_events]" but_meta="cm-process-items cm-confirm" but_role="button_main"}
	</div>
	{/if}
	
	<div class="float-right">
		{include file="common_templates/tools.tpl" tool_href="$index_script?dispatch=events.add" prefix="bottom" hide_tools="true" link_text=$lang.add_event}
	</div>
</div>
</form>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="$index_script?dispatch=events.add" prefix="top" hide_tools="true" link_text=$lang.add_event}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.events content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}
