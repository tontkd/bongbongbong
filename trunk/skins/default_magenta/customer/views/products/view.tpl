{* $Id: view.tpl 7229 2009-04-08 12:13:22Z lexa $ *}

{script src="js/exceptions.js"}

{hook name="products:view_main_info"}
<div class="clear">
	<div class="product-image" id="product_images_{$product.product_id}">
		{include file="views/products/components/product_images.tpl" product=$product show_detailed_link="Y"}
	</div>
	<div class="product-description product-details-options">
		{include file="views/products/components/buy_now.tpl" product=$product but_role="action" show_qty=true show_sku=true obj_id=$product.product_id}
	</div>
</div>
{/hook}

{capture name="tabsbox"}

	<div id="content_description">
		{$product.full_description|default:$product.short_description|unescape}
	</div>

	{if $product.product_features}
	<div id="content_features">
		{include file="views/products/components/product_features.tpl" product_features=$product.product_features details_page=true}
	</div>
	{/if}

	{if $files}
	<div id="content_files">
		{include file="views/products/components/product_files.tpl"}
	</div>
	{/if}
	
	{hook name="products:tabs_block"}{/hook}

	{if $tab_blocks}
	{foreach from=$tab_blocks item="block"}
	<div id="content_block_{$block.block_id}">
		{block id=$block.block_id template=$block.properties.appearances|default:$block.properties.list_object no_box=true}
	</div>
	{/foreach}
	{/if}
{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}

{capture name="mainbox_title"}{$product.product|unescape}{/capture}
