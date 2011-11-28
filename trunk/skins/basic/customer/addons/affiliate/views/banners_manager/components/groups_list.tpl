{* $Id: groups_list.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if $list_data}
	{if $list_data.link_to == "P"}
		<span class="product-details-title">{$lang.products}</span>
		{include file="addons/affiliate/views/banners_manager/components/products_list.tpl" list_data=$list_data.products}
	{elseif $list_data.link_to == "C"}
		<span class="product-details-title">{$lang.categories}</span>
		{include file="addons/affiliate/views/banners_manager/components/categories_list.tpl" list_data=$list_data.categories}
	{elseif $list_data.link_to == "U"}
		<span class="product-details-title">{$lang.url}</span>
		{include file="addons/affiliate/views/banners_manager/components/url_list.tpl" list_data=$list_data.url}
	{/if}
{/if}