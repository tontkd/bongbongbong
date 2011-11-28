{* $Id: categories_multicolumns.tpl 7547 2009-06-01 13:43:49Z angel $ *}

{split data=$categories size=$columns|default:"3" assign="splitted_categories"}
{math equation="floor(100/x)" x=$columns|default:"3" assign="cell_width"}

<table cellpadding="0" cellspacing="3" border="0" width="100%">
{foreach from=$splitted_categories item="scats"}
<tr valign="bottom">
{foreach from=$scats item="category"}
	{if $category}
	<td class="center" width="{$cell_width}%">
		<a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}">{include file="common_templates/image.tpl" show_detailed_link=false object_type="category" images=$category.main_pair no_ids=true}</a>
	</td>
	{else}
	<td width="{$cell_width}%">&nbsp;</td>
	{/if}
{/foreach}
</tr>
<tr class="category-names">
{foreach from=$scats item="category"}
	{if $category}
	<td class="center" valign="top" width="{$cell_width}%">
		<a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}" class="underlined-bold">{$category.category}</a>
	</td>
	{else}
	<td width="{$cell_width}%">&nbsp;</td>
	{/if}
{/foreach}
</tr>
{/foreach}
</table>

{capture name="mainbox_title"}{$title|default:$lang.categories}{/capture}