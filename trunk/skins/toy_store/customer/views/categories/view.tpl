{* $Id: view.tpl 7763 2009-07-29 13:19:43Z alexions $ *}

{hook name="categories:view"}
{if $subcategories or $category_data.description || $category_data.main_pair}
{math equation="ceil(n/c)" assign="rows" n=$subcategories|count c=$columns|default:"2"}
{split data=$subcategories size=$rows assign="splitted_subcategories"}

{if $category_data.description && $category_data.description != ""}
	<div class="category-description">{$category_data.description|unescape}</div>
{/if}


<div class="clear">
	{if $category_data.main_pair}
	<div class="categories-image">
		{include file="common_templates/image.tpl" show_detailed_link=true images=$category_data.main_pair object_type="category" no_ids=true class="cm-thumbnails"}
	</div>

	{if $category_data.main_pair.detailed_id}
	{include file="common_templates/previewer.tpl"}
	{/if}

	{/if}

	{if $subcategories}
	<div class="subcategories">
	{if $subcategories|@count < 6}
		<ul>
	{/if}
	{foreach from=$splitted_subcategories item="ssubcateg"}
		{if $subcategories|count >= 6}
			<div class="categories-columns">
				<ul>
		{/if}
			{foreach from=$ssubcateg item=category name="ssubcateg"}
			{if $category.category_id}<li><a href="{$index_script}?dispatch=categories.view&amp;category_id={$category.category_id}" class="underlined-bold">{$category.category}</a></li>{/if}
		{/foreach}
		{if $subcategories|count >= 6}
				</ul>
			</div>
		{/if}
	{/foreach}
	{if $subcategories|count < 6}
	</ul>
	{/if}
	</div>
	{/if}
</div>
{/if}

{if $smarty.request.advanced_filter}
	{include file="views/products/components/product_filters_advanced_form.tpl" separate_form=true}
{/if}

{if $products}
{assign var="layouts" value=""|fn_get_products_views:false:0}
{if $category_data.product_columns}
	{assign var="product_columns" value=$category_data.product_columns}
{else}
	{assign var="product_columns" value=$settings.Appearance.columns_in_products_list}
{/if}

{if $layouts.$selected_layout.template}
	{include file="`$layouts.$selected_layout.template`" columns=`$product_columns`}
{/if}

{elseif !$subcategories}
<p class="no-items">{$lang.text_no_products}</p>
{/if}

{capture name="mainbox_title"}{$category_data.category}{/capture}
{/hook}
