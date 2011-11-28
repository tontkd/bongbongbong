{* $Id: object_group.tpl 7726 2009-07-17 06:52:02Z zeke $ *}

{if !$no_table}
<div class="object-group{$element} clear cm-row-item">
	<div class="float-right delete">
		{capture name="tool_items"}
			{if $tool_items}
			{$tool_items}
			{/if}
			{if $href_delete}
			<li><a href="{$href_delete}" rev="{$rev_delete}" class="cm-ajax cm-delete-row cm-confirm lowercase">{$lang.delete}</a></li>
			{elseif $links}
			<li>{$links}</li>
			{else !$href_delete && !$links}
			<li class="undeleted-element"><span>{$lang.delete}</span></li>
			{/if}
		{/capture}
		{include file="common_templates/table_tools_list.tpl" separate=true tools_list=$smarty.capture.tool_items prefix=$id href=""}
	</div>
	<div class="float-right">
{/if}

	{if !$non_editable}
		{include file="common_templates/popupbox.tpl" id="group`$id_prefix``$id`" edit_onclick=$onclick text=$header_text act=$act|default:"edit"}
	{else}	
		<span class="unedited-element block">{$link_text|default:$lang.edit}</span>
	{/if}

{if !$no_table}
	</div>
	{if $status}
	<div class="float-right">
		{include file="common_templates/select_popup.tpl" id=$id status=$status hidden=$hidden object_id_name=$object_id_name table=$table}
	</div>
	{/if}
	<div class="object-name">
		{if $checkbox_name}
			<input type="checkbox" name="{$checkbox_name}" value="{$id}" class="checkbox cm-item" />
		{/if}
		<a class="cm-external-click" rev="opener_group{$id_prefix}{$id}">{$text}</a><span class="object-group-details">{$details}</span>
	</div>
</div>
{/if}
