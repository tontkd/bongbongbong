{* $Id: manage.tpl 6369 2008-11-20 10:54:05Z zeke $ *}

{foreach from=$items item="item"}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
{if $header}
{assign var="header" value=""}
<tr>
	<th>
		<div class="float-left">
			<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="on_item" class="hand cm-combinations" />
			<img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="off_item" class="hand cm-combinations hidden" />
		</div>
		&nbsp;{$lang.name}
	</th>
	<th>{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{/if}
<tr class="{if $item.level > 0}multiple-table-row{/if} cm-row-item">
	<td width="100%">
		<span style="padding-left: {math equation="x*14" x=$item.level|default:0}px;">
			{if $item.subitems}
			<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_item_{$item.param_id}" class="hand cm-combination" />
			<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_item_{$item.param_id}" class="hand cm-combination hidden" />{/if}
			<span {if !$item.subitems} style="padding-left: 17px;"{/if}>{$item.descr}</span>
		</span>
	</td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$item.param_id status=$item.status hidden=true object_id_name="param_id" table="static_data"}
	</td>
	<td class="nowrap">
		{include file="common_templates/popupbox.tpl" act="edit" text=$lang[$section_data.edit_title]|cat:": `$item.descr`" link_text=$lang.edit id="group`$item.param_id`" link_class="tool-link" href="$index_script?dispatch=static_data.update&amp;param_id=`$item.param_id`&amp;section=$section"}

		{capture name="tools_items"}
		<ul>
		{hook name="static_data:list_extra_links"}
		<li><a class="cm-confirm cm-ajax cm-delete-row" rev="static_data_list" href="{$index_script}?dispatch=static_data.delete&amp;param_id={$item.param_id}&amp;section={$section}">{$lang.delete}</a></li>
		{/hook}
		</ul>
		{/capture}
		{if $smarty.capture.tools_items|strpos:"<li>"}&nbsp;&nbsp;|
			{include file="common_templates/tools.tpl" prefix=$item.param_id hide_actions=true tools_list=$smarty.capture.tools_items display="inline" link_text=$lang.more link_meta="lowercase"}
		{/if}
	</td>
</tr>
</table>
{if $item.subitems}
<div id="item_{$item.param_id}" class="hidden">
	{include file="views/static_data/components/multi_list.tpl" items=$item.subitems header=false}
</div>
{/if}

{foreachelse}
	<p class="no-items">{$lang.no_data}</p>
{/foreach}