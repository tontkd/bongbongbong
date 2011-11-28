{* $Id: categories_tree.tpl 7169 2009-04-01 12:23:18Z angel $ *}

{foreach from=$all_categories_tree item=category key=cat_key name="categories"}
   {if $category.level == "0"}
	   {if $ul_subcategories == "started"}
	   </ul>
			{assign var="ul_subcategories" value=""}
	   {/if}
		<ul class="sitemap-list">
			<li><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}" class="strong">{$category.category}</a></li>
		</ul>
   {else}
	   {if $ul_subcategories != "started"}
	   <ul>
			{assign var="ul_subcategories" value="started"}
		{/if}
		   <li style="padding-left: {if $category.level == "1"}13px{elseif $category.level > "1"}{math equation="x*y+13" x="7" y=$category.level}px{/if};"><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}">{$category.category}</a></li>
   {/if}
   {if $smarty.foreach.categories.last}
		</ul>
	 {/if}
{/foreach}
