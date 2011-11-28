{* $Id: js_category.tpl 7165 2009-03-31 12:38:30Z angel $ *}

{if $category_id}
	{assign var="category" value=$category_id|fn_get_category_name|default:"`$ldelim`category`$rdelim`"}
{else}
	{assign var="category" value=$default_name}
{/if}
{if $multiple}
	<tr {if !$clone}id="{$holder}_{$category_id}" {/if}class="cm-js-item {if $clone} cm-clone hidden{/if}">
		{if $position_field}<td><input type="text" name="{$input_name}[{$category_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short"{if $clone} disabled="disabled"{/if} /></td>{/if}
		<td><a href="{$index_script}?dispatch=categories.update&amp;category_id={$category_id}">{$category}</a></td>
		<td class="nowrap">
		{if !$hide_delete_button && !$view_only}
		{capture name="tools_items"}
			<li><a onclick="jQuery.delete_js_item('{$holder}', '{$category_id}', 'c'); return false;">{$lang.delete}</a></li>
			{/capture}
			{include file="common_templates/table_tools_list.tpl" prefix=$category_id tools_list=$smarty.capture.tools_items href="$index_script?dispatch=categories.update&category_id=`$category_id`"}
		{else}&nbsp;
		{/if}
		</td>
	</tr>
{else}
	<{if $single_line}span{else}p{/if} {if !$clone}id="{$holder}_{$category_id}" {/if}class="cm-js-item no-margin{if $clone} cm-clone hidden{/if}">
	{if !$first_item && $single_line}<span class="cm-comma{if $clone} hidden{/if}">,&nbsp;&nbsp;</span>{/if}
	<input class="input-text-medium cm-picker-value-description{$extra_class}" type="text" value="{$category}" {if $display_input_id}id="{$display_input_id}"{/if} size="10" name="category_name" readonly="readonly" {$extra} />
	</{if $single_line}span{else}p{/if}>
{/if}