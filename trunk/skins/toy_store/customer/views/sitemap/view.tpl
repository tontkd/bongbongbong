{* $Id: view.tpl 7169 2009-04-01 12:23:18Z angel $ *}

<table cellpadding="5" cellspacing="0" align="center" border="0" width="100%">
<tr>
	{if $sitemap.categories || $sitemap.categories_tree}
	<td width="33%" valign="top">
		<h3>{$lang.catalog}</h3>
		{if $sitemap.categories}
			<ul class="sitemap-list">
				{foreach from=$sitemap.categories item=category}
					<li><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}" class="underlined-bold">{$category.category}</a></li>
				{/foreach}
			</ul>
		{/if}
		{if $sitemap.categories_tree}
			{include file="views/sitemap/components/categories_tree.tpl" all_categories_tree=$sitemap.categories_tree background="white"}
		{/if}
	</td>
	{/if}
	{if $sitemap_settings.show_site_info == "Y"}
	<td width="33%" valign="top">
		<h3>{$lang.information}</h3>
		<ul class="sitemap-list">
			{include file="views/pages/components/pages_tree.tpl" tree=$sitemap.pages_tree root=true no_delim=true}
		</ul>
	</td>
	{/if}
	<td width="33%" valign="top">
		{if $sitemap.custom}
		{foreach from=$sitemap.custom item=section key=name}
			<h3>{$name}</h3>
			<ul class="sitemap-list">
				{foreach from=$section item=link}
					<li><a href="{$link.link_href}">{$link.link}</a></li>
				{/foreach}
			</ul>
		{/foreach}
		{/if}
	</td>
</tr>
</table>

{capture name="mainbox_title"}{$lang.sitemap}{/capture}
