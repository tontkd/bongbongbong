{* $Id: products_list.tpl 7863 2009-08-19 12:33:25Z alexions $ *}

{script src="js/exceptions.js"}

{include file="common_templates/pagination.tpl"}

{if $show_price_values && $settings.General.allow_anonymous_shopping == "P" && !$auth.user_id}
{assign var="show_price_values" value="0"}
{else}
{assign var="show_price_values" value="1"}
{/if}

{foreach from=$products item=product key=key name="products"}
<div class="product-container clear">
	{hook name="products:product_list"}
	<div class="product-image">
		{if !$hide_links}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{/if}{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$product.product_id images=$product.main_pair object_type="product"}{if !$hide_links}</a>{/if}
		{if !$hide_links}<p class="more-info"><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.view_details}&nbsp;<strong>&#8250;&#8250;</strong></a></p>{/if}
	</div>
	<div class="float-right">
		<input class="cm-item" type="checkbox" id="bulk_addition_{$product.product_id}" name="product_data[{$product.product_id}][amount]" value="{if $js_product_var}{$product.product_id}{else}1{/if}" {if ($product.zero_price_action == "R" && $product.price == 0)}disabled="disabled"{/if} />
	</div>
	<div class="product-description">
		{if $js_product_var}
			<input type="hidden" id="product_{$product.product_id}" value="{$product.product}" />
		{/if}
		<a {if !$hide_links}href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{/if} class="product-title">{$product.product}</a>
		<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$product.product_id}">
			{$lang.sku}: <span class="sku" id="product_code_{$product.product_id}">{$product.product_code}</span>
		</p>

		<p class="price">
		{if $show_price_values && ($product.price|floatval || $product.zero_price_action == "P" || $product.zero_price_action == "A")}
			{if $product.list_price > $product.price && $product.price != 0}{$lang.our_price}{else }{$lang.price}{/if}: {include file="common_templates/price.tpl" value=$product.price span_id="original_price_`$product.product_id`" class="price"}
		{elseif !$show_price_values}
			<span class="price">{$lang.sign_in_to_view_price}</span>
		{elseif $product.zero_price_action == "R"}
			{$lang.contact_us_for_price}
		{/if}
		</p>
		
		{if $product.is_edp == "Y"}
		<p><strong>[{$lang.text_edp_product}]</strong><input type="hidden" name="product_data[{$product.product_id}][is_edp]" value="Y" /></p>
		{/if}

		{if $product.product_options}
		{include file="views/products/components/product_options.tpl" disable_ids="bulk_addition_`$product.product_id`" id=$product.product_id product_options=$product.product_options name="product_data"}
		{/if}

		{if $settings.General.inventory_tracking == "Y" && ($product.amount <= 0 || $product.amount < $product.min_qty) && $product.is_edp != "Y" && $product.tracking == "B"}
		<div class="price">{$lang.text_out_of_stock}</div>
		{/if}

		<div class="box margin-top">
		{if $product.short_description}
			{$product.short_description|unescape}
		{else}
			{$product.full_description|unescape|strip_tags|truncate:280:"..."}{if $product.full_description|strlen > 280 && !$hide_links}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.more_link}</a>{/if}
		{/if}
		</div>
	</div>
	<script type="text/javascript">
	//<![CDATA[
		$('#opt_' + '{$product.product_id} :input').each(function () {$ldelim}
			$(this).attr("disabled", true);
		{$rdelim});
	//]]>
	</script>
	{/hook}
</div>

{if !$smarty.foreach.products.last}
<hr />
{/if}

{/foreach}

{literal}
<script type="text/javascript">
//<![CDATA[
	$('.cm-item').click(function () {
		(this.checked) ? disable = false : disable = true;
		
		$('#opt_' + $(this).attr('id').replace('bulk_addition_', '')).switchAvailability(disable, false);
	});
//]]>
</script>
{/literal}

{include file="common_templates/pagination.tpl"}
