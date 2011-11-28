{* $Id: products.tpl 7126 2009-03-24 13:55:09Z angel $ *}

{if $products}

{script src="js/exceptions.js"}

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}
{if !$no_sorting}
	{include file="views/products/components/sorting.tpl"}
{/if}
{foreach from=$products item=product key=key name="products"}
{hook name="products:product_block"}
{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
<div class="product-container clear">
	<div class="product-image">
	<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$obj_id images=$product.main_pair object_type="product"}</a>
		<div class="more-info"><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.view_details}&nbsp;<strong>&#8250;&#8250;</strong></a></div>
	</div>
	<div class="product-description">
		{if $item_number == "Y"}<strong>{$smarty.foreach.products.iteration}.&nbsp;</strong>{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>

		{include file="views/products/components/buy_now.tpl" product=$product but_role="action" show_features=true show_sku=true hide_add_to_cart_button=$hide_add_to_cart_button}

		{if $product.short_description || $product.full_description}
		<div class="box margin-top">
		{if $product.short_description}
			{$product.short_description|unescape}
		{else}
			{$product.full_description|unescape|strip_tags|truncate:280:"..."}{if $product.full_description|strlen > 280}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.more_link}</a>{/if}
		{/if}
		</div>
		{/if}
	</div>
</div>
{/hook}

{if !$smarty.foreach.products.last}
<hr />
{/if}

{/foreach}

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}