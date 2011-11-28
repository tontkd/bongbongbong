{* $Id: categories_list.tpl 6955 2009-02-25 14:42:19Z angel $ *}

{if $list_data}
<ul class="bullets-list">
{foreach from=$list_data key=category_id item=category_name}
	<li><a href="{$config.customer_index}?dispatch=categories.view&amp;category_id={$category_id}" target="_blank">{$category_name}</a></li>
{/foreach}
</ul>
{/if}