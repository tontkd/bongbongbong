{* $Id: one_product.tpl 7700 2009-07-13 09:14:01Z zeke $ *}

{script src="js/exceptions.js"}

{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
{if $product.result_type == "full"}
{hook name="products:product_block"}
<div class="product-container clear">
	<div class="product-image">
	<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$obj_id images=$product.main_pair object_type="product"}</a>
		<div class="more-info"><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.view_details}&nbsp;<strong>&#8250;&#8250;</strong></a></div>
	</div>
	<div class="product-description">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>
		<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$obj_id}">{$lang.sku}: <span id="product_code_{$obj_id}">{$product.product_code}</span></p>
		{include file="views/products/components/product_features_short_list.tpl" features=$product.product_id|fn_get_product_features_list}

		{include file="views/products/components/buy_now.tpl" product=$product but_role="action"}

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
{else}
<div class="search-result">
	<strong>{$product.result_number}.</strong> <a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>
	{if !$hide_info}
	{if $product.short_description || $product.full_description}
	<p>
	{if $product.short_description}
		{$product.short_description|unescape}
	{else}
		{$product.full_description|unescape|strip_tags|truncate:280:"..."}{if $product.full_description|strlen > 280}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.more_link}</a>{/if}
	{/if}
	</p>
	{/if}

	{elseif $hide_info == "age-verify"}
		<div class="box margin-top">
			{$product.age_warning_message}
			<div class="buttons-container">
				{include file="buttons/button.tpl" but_text=$lang.verify but_href="`$index_script`?dispatch=products.view&product_id=`$product.product_id`" but_role="text"}
			</div>
		</div>
	{/if}
</div>
{/if}