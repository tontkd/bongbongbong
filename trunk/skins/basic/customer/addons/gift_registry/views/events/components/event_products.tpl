{* $Id: event_products.tpl 7700 2009-07-13 09:14:01Z zeke $ *}

<div id="content_products">

<p>{$lang.text_gr_desired_products}</p>

{include file="common_templates/subheader.tpl" title=$lang.defined_desired_products}

{script src="js/exceptions.js"}

{if $event_data.products}
<form action="{$index_script}" method="post" name="event_products_form" >
<input type="hidden" name="event_id" value="{$event_id}" />
{if $access_key}
<input type="hidden" name="access_key" value="{$access_key}" />
{/if}

{foreach from=$event_data.products item="product" key="key" name="products"}
<div class="product-container clear">
	<div class="product-image">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">
		{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$key images=$product.main_pair object_type="product"}</a>
	</div>
	<div class="product-description">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>&nbsp;<a href="{$index_script}?dispatch=events.delete&amp;item_id={$key}&amp;event_id={$event_id}&amp;access_key={$access_key}&selected_section=products"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="{$lang.remove|escape:html}" title="{$lang.remove|escape:html}" align="bottom" /></a>
		<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$product.product_id}">
			{$lang.sku}: <span class="sku" id="product_code_{$product.product_id}">{$product.product_code}</span>
		</p>

		{if $product.product_options}
			{include file="views/products/components/product_options.tpl" product_options=$product.product_options product=$product name="event_products" id=$key location="cart"}
		{/if}

		<table cellpadding="0" cellspacing="0" border="0" class="table margin-top">
		<tr>
			<th>{$lang.price}</th>
			<th>{$lang.desired_amount}</th>
			<th>{$lang.bought_amount}</th>
		</tr>
		<tr>
			<td class="nowrap center">
					{include file="common_templates/price.tpl" value=$product.price span_id="original_price_`$key`" class="sub-price"}</td>
			<td class="nowrap center">
				<input type="hidden" name="event_products[{$key}][product_id]" value="{$product.product_id}" />
				<input type="text" size="3" id="amount_{$key}" name="event_products[{$key}][amount]" value="{$product.amount}" class="input-text-short" {if $product.is_edp == "Y"}readonly="readonly"{/if} /></td>
			<td class="nowrap center">
				<strong>{$product.ordered_amount}</strong></td>
		</tr>
		<tr class="table-footer">
			<td colspan="3">&nbsp;</td>
		</tr>
		</table>

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

{if !$smarty.foreach.products.last}
<hr />
{/if}
{/foreach}


<div class="buttons-container">
	{include file="buttons/button.tpl" but_text=$lang.update but_name="dispatch[events.update_products]"}
</div>
</form>

{else}
<p class="no-items">{$lang.text_no_products_defined}</p>
{/if}

{include file="pickers/products_picker.tpl" data_id="ev_products" but_text=$lang.add_product extra_var="dispatch=events.add_products&event_id=`$event_id`&access_key=`$access_key`"}

</div>
