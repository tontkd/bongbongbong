{* $Id: view.tpl 7286 2009-04-16 13:13:14Z angel $ *}

{if !$wishlist|fn_cart_is_empty}

	{script src="js/exceptions.js"}

	{assign var="show_hr" value=false}

	{if $products}

		{foreach from=$products item=product key=key name="products"}
		{hook name="wishlist:items_list"}
		{if !$wishlist.products.$key.extra.parent}

		{if $show_hr}
		<hr />
		{else}
			{assign var="show_hr" value=true}
		{/if}

		<div class="product-container clear">
			<div class="product-image">
				<p><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$key images=$product.main_pair object_type="product"}</a></p>
				<span class="more-info"><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.view_details}&nbsp;<strong>&#8250;&#8250;</strong></a></span>
			</div>
			<div class="product-description">
				<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>&nbsp;<a href="{$index_script}?dispatch=wishlist.delete&amp;cart_id={$key}"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="{$lang.remove}" title="{$lang.remove}" align="bottom" /></a>

				<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$key}">{$lang.sku}: <span id="product_code_{$key}">{$product.product_code}</span></p>

				{include file="views/products/components/buy_now.tpl" hide_wishlist_button=true hide_compare_list_button=true obj_id=$key but_role="action"}
			</div>
		</div>
		{/if}
		{/hook}
		{/foreach}
	{/if}
	{hook name="wishlist:view"}
	{/hook}

	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.clear_wishlist but_href="$index_script?dispatch=wishlist.clear"}&nbsp;&nbsp;
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
	</div>
{else}

	<p class="no-items">{$lang.text_wishlist_empty}</p>

	<div class="buttons-container center">
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
	</div>

{/if}

{capture name="mainbox_title"}{$lang.wishlist_content}{/capture}
