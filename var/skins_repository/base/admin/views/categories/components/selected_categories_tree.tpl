{* $Id: selected_categories_tree.tpl 6613 2008-12-19 12:46:16Z angel $ *}
{* --------- CATEGORY TREE --------------*}
{if $header}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th class="center">
	<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th>{$lang.categories}</th>
	<th>{$lang.products}</th>
</tr>
{/if}
{foreach from=$categories_tree item=cur_cat}
{assign var="cat_id" value=$cur_cat.category_id}
{if isset($categories.$cat_id)}
<tr class="table-row">
	<td class="center">
		<input type="checkbox" name="{$checkbox_name}[{$cur_cat.category_id}]" value="Y" class="checkbox cm-item" /></td>
	<td width="100%" class="no-padding">
		<a href="{$index_script}?dispatch=categories.update&amp;category_id={$cur_cat.category_id}" class="manage-item{if $cur_cat.status == "N"}-disabled{/if}">{$cur_cat.category}</a>{if $cur_cat.status == "N"}&nbsp;<span class="small-note">-&nbsp;[{$lang.disabled}]</span>{/if}
	</td>
	<td class="center nowrap" width="64">
		<a href="{$index_script}?dispatch=products.manage&amp;category_id={$cur_cat.category_id}"><u>&nbsp;{$cur_cat.product_count}&nbsp;</u></a>
	</td>
</tr>
{/if}
{if $cur_cat.subcategories}
	{include file="views/categories/components/selected_categories_tree.tpl" categories_tree=$cur_cat.subcategories header=""}
{/if}
{/foreach}
{if $header}
</table>
{/if}
{* --------- /CATEGORY TREE --------------*}
