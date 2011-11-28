{* $Id: categories_list.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

<table cellpadding="0" cellspacing="3" border="0" width="100%">
{foreach from=$banner_categories key="category_id" item="category" name="b_categories"}
<tr>
	<td valign="top" class="center">{if $category.main_pair.image_id != "0"}{include file="common_templates/image.tpl" category_data=$category object_type="category" images=$category.main_pair}{else}&nbsp;{/if}</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td valign="top" width="100%">
		<span class="subcategories"><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}">{$category.category}</a></span>
		<p><span class="category-description">{$category.description}</span></p>
	</td>
</tr>
{if !$smarty.foreach.b_categories.last}
<tr>
	<td colspan="3"><hr /></td>
</tr>
{/if}
{/foreach}
</table>

{capture name="mainbox_title"}{$lang.categories}{/capture}