{* $Id: menu_items.tpl 6971 2009-03-05 09:28:18Z zeke $ *}
{strip}
{assign var="foreach_name" value="cats_$cid"}
{foreach from=$items item="category" name=$foreach_name}
<li {if $category.subcategories}class="dir"{/if}>
	{if $category.subcategories}
		<ul>
			{include file="views/categories/components/menu_items.tpl" items=$category.subcategories separated=true submenu=true cid=$category.category_id}
		</ul>
	{/if}
	<a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}">{$category.category}</a>
</li>
{if $separated && !$smarty.foreach.$foreach_name.last}
<li class="h-sep">&nbsp;</li>
{/if}
{/foreach}
{/strip}
