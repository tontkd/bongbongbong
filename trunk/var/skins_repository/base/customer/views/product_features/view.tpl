{* $Id: view.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

<div class="clear">
	{if $variant_data.image_pair}
	<div class="feature-image">
		{include file="common_templates/image.tpl" images=$variant_data.image_pair object_type="feature_variant"}
	</div>
	{/if}
	<div class="feature-description">
		{if $variant_data.url}
		<p>
			<a href="{$variant_data.url}">{$variant_data.url}</a>
		</p>
		{/if}

		{$variant_data.description|unescape}
	</div>
</div>

{if $smarty.request.advanced_filter}
	{include file="views/products/components/product_filters_advanced_form.tpl" separate_form=true}
{/if}

{if $products}
	{if $settings.Appearance.columns_in_products_list > 1}
		{include file="views/products/components/products_multicolumns.tpl" columns=$settings.Appearance.columns_in_products_list}
	{else}
		{include file="views/products/components/products.tpl" title=""}
	{/if}
{else}
	<p class="no-items">{$lang.text_no_products}</p>
{/if}

{capture name="mainbox_title"}{$variant_data.variant|unescape}{/capture}