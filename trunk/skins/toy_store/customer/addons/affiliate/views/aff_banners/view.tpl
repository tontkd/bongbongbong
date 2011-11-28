{* $Id: view.tpl 6335 2008-11-14 12:01:03Z zeke $ *}

{if $products}

	{if $settings.Appearance.columns_in_products_list > 1}
		{include file="views/products/components/products_multicolumns.tpl" columns=$settings.Appearance.columns_in_products_list}
	{else}
		{include file="views/products/components/products.tpl" title=""}
	{/if}

	{capture name="mainbox_title"}{$lang.products}{/capture}
{elseif $banner_categories}
	{include file="addons/affiliate/views/aff_banners/components/categories_list.tpl"}
{/if}