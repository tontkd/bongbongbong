{* $Id: categories_tree.tpl 7165 2009-03-31 12:38:30Z angel $ *}
{if $parent_id}
<div class="hidden" id="cat_{$parent_id}">
{/if}
{foreach from=$categories_tree item=category}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
{if $header && !$parent_id}
{assign var="header" value=""}
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th>{$lang.position_short}</th>
	<th width="100%">
		{if $show_all}
		<div class="float-left">
			<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="on_cat" class="hand cm-combinations" />
			<img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="off_cat" class="hand cm-combinations hidden" />
		</div>
		{/if}
		&nbsp;{$lang.name}
	</th>
	<th>{$lang.products}</th>
	<th>{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{/if}
<tr {if $category.level > 0}class="multiple-table-row"{/if}>
   	{math equation="x*14" x=$category.level assign="shift"}
	<td class="center" width="1%">
		<input type="checkbox" name="category_ids[]" value="{$category.category_id}" class="checkbox cm-item" /></td>
	<td>
		<input type="text" name="categories_data[{$category.category_id}][position]" value="{$category.position}" size="3" class="input-text-short" /></td>
	<td width="100%">
		<span style="padding-left: {$shift}px;">
			{if $category.has_children || $category.subcategories}<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_cat_{$category.category_id}" class="hand cm-combination"{if !$show_all} onclick="if (!$('#cat_{$category.category_id}').children().get(0)) jQuery.ajaxRequest('{$index_script}?dispatch=categories.manage&category_id={$category.category_id}', {$ldelim}result_ids: 'cat_{$category.category_id}'{$rdelim})"{/if} /><img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_cat_{$category.category_id}" class="hand cm-combination hidden" />{/if}<a href="{$index_script}?dispatch=categories.update&amp;category_id={$category.category_id}"{if $category.status == "N"} class="manage-root-item-disabled"{/if}{if !$category.subcategories} style="padding-left: 14px;"{/if} >{$category.category}</a>{if $category.status == "N"}&nbsp;<span class="small-note">-&nbsp;[{$lang.disabled}]</span>{/if}
		</span>
	</td>
	<td class="nowrap">
		&nbsp;<a href="{$index_script}?dispatch=products.manage&amp;cid={$category.category_id}"><u>&nbsp;{$category.product_count}&nbsp;</u></a>&nbsp;
		{include file="buttons/button.tpl" but_text=$lang.add but_href="$index_script?dispatch=products.add&category_id=`$category.category_id`" but_role="add"}&nbsp;&nbsp;
	</td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$category.category_id status=$category.status hidden=true object_id_name="category_id" table="categories"}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{$index_script}?dispatch=categories.delete&amp;category_id={$category.category_id}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$category.category_id tools_list=$smarty.capture.tools_items href="$index_script?dispatch=categories.update&category_id=`$category.category_id`"}
	</td>
</tr>
</table>
{if $category.has_children || $category.subcategories}
	<div class="hidden" id="cat_{$category.category_id}">
	{if $category.subcategories}
		{include file="views/categories/components/categories_tree.tpl" categories_tree=$category.subcategories parent_id=false}
	{/if}
	<!--cat_{$category.category_id}--></div>
{/if}
{/foreach}
{if $parent_id}<!--cat_{$parent_id}--></div>{/if}
