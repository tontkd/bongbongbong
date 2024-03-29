{* $Id: js_category.tpl 7570 2009-06-10 08:05:02Z lexa $ *}

{if $category_id == "0"}
	{assign var="category" value=$default_name}
{else}
	{assign var="category" value=$category_id|fn_get_category_name|default:"`$ldelim`category`$rdelim`"}
{/if}
<{if $single_line}span{else}p{/if} {if !$clone}id="{$holder}_{$category_id}" {/if}class="cm-js-item no-padding{if $clone} cm-clone hidden{/if}">
{if !$first_item && $single_line}<span class="cm-comma{if $clone} hidden{/if}">,&nbsp;&nbsp;</span>{/if}
{if $multiple}
	{if !$hide_link}
	{if $position_field}<input type="text" name="{$input_name}[{$category_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short"{if $clone} disabled="disabled"{/if} />&nbsp;{/if}<a href="{$index_script}?dispatch=categories.update&amp;category_id={$category_id}">{$category}</a>
	{else}
	<strong>{$category}</strong>
	{/if}
	{if !$hide_delete_button && !$view_only}
	&nbsp;<a onclick="jQuery.delete_js_item('{$holder}', '{$category_id}', 'c'); return false;"><img width="12" height="18" border="0" class="hand valign" alt="" src="{$images_dir}/icons/icon_delete.gif"/></a>
	{/if}
{else}
	<input class="input-text cm-picker-value-description" type="text" value="{$category}" {if $display_input_id}id="{$display_input_id}"{/if} size="10" name="category_name" readonly="readonly" {$extra} />
{/if}
</{if $single_line}span{else}p{/if}>
