{* $Id: view.tpl 7086 2009-03-19 12:33:33Z zeke $ *}

{if $addons.tags.tags_for_products == "Y" && $products}

	{include file="common_templates/subheader.tpl" title=$lang.products}
	
	{if $settings.Appearance.columns_in_products_list > 1}
		{include file="views/products/components/products_multicolumns.tpl" columns=$settings.Appearance.columns_in_products_list}
	{else}
		{include file="views/products/components/products.tpl" title=""}
	{/if}
	
{/if}

{if $addons.tags.tags_for_pages == "Y" && $pages}
	{include file="common_templates/subheader.tpl" title=$lang.pages}

	<ul>
		{foreach from=$pages item="page"}
		<li><a href="{$index_script}?dispatch=pages.view&amp;page_id={$page.page_id}">{$page.page}</a></li>
		{/foreach}
	</ul>
{/if}

{hook name="tags:view"}{/hook}

{if !$tag_objects_exist}
<p class="no-items">{$lang.no_data}</p>
{/if}

{capture name="mainbox_title"}{$page_title}{/capture}
