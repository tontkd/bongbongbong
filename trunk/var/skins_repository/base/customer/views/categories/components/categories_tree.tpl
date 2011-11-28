{* $Id: categories_tree.tpl 7780 2009-08-04 08:59:41Z zeke $ *}

{assign var="cc_id" value=$smarty.request.category_id|default:$smarty.session.current_category_id}
{foreach from=$categories item=category key=cat_key name="categories"}
	{if $category.level == "0"}
		{if $ul_subcategories == "started"}
			</ul>
			{assign var="ul_subcategories" value=""}
		{/if}
		<ul class="menu-root-categories">
			<li><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}" class="underlined-bold">{$category.category}</a></li>
		</ul>
	{else}
		{if $ul_subcategories != "started"}
			<ul class="menu-subcategories">
				{assign var="ul_subcategories" value="started"}
		{/if}
		<li style="padding-left: {if $category.level == "1"}13px{elseif $category.level > "1"}{math equation="x*y+13" x="7" y=$category.level}px{/if};"><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}" class="{if $category.category_id == $cc_id}subcategories-link-active{else}subcategories-link{/if}">{$category.category}</a></li>
	{/if}
	{if $smarty.foreach.categories.last && $ul_subcategories == "started"}
		</ul>
	{/if}
{/foreach}
