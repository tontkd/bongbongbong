{* $Id: categories_text_links.tpl 7026 2009-03-13 07:22:17Z angel $ *}
{** block-description:text_links **}

{if $items}
<ul class="arrow-list">
	{foreach from=$items item="category"}
	<li><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}">{$category.category}</a></li>
	{/foreach}
</ul>
{/if}