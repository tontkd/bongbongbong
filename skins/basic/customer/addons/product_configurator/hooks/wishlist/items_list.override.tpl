{* $Id: items_list.override.tpl 7126 2009-03-24 13:55:09Z angel $ *}

{if $wishlist.products.$key.extra.configuration}
	<form action="{$index_script}" method="post" name="{$form_prefix}productform_{$key}">
	<input type="hidden" name="product_data[{$product.product_id}][product_id]" value="{$product.product_id}" />
	<input type="hidden" name="product_data[{$product.product_id}][amount]" value="1" />

	{foreach from=$wishlist.products.$key.extra.configuration key="g_id" item="p_id"}
	{if $p_id|is_array}
	{foreach from=$p_id item="p"}
	<input type="hidden" name="product_data[{$product.product_id}][configuration][{$g_id}][]" value="{$p}" />
	{/foreach}
	{else}
	<input type="hidden" name="product_data[{$product.product_id}][configuration][{$g_id}]" value="{$p_id}" />
	{/if}
	{/foreach}

	{if $show_hr}
	<hr />
	{else}
		{assign var="show_hr" value=true}
	{/if}

	<div class="product-container clear">
		<div class="product-image">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$product.product_id images=$product.main_pair object_type="product"}</a>
			<div class="more-info"><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$lang.view_details}&nbsp;<strong>&#8250;&#8250;</strong></a></div>
		</div>
		<div class="product-description">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>&nbsp;<a href="{$index_script}?dispatch=wishlist.delete&amp;cart_id={$key}"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="{$lang.remove}" title="{$lang.remove}" align="bottom" /></a>

			<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$product.product_id}">{$lang.sku}: <span id="product_code_{$product.product_id}">{$product.product_code}</span></p>

			{include file="views/products/components/product_options.tpl" product_options=$product.product_options product=$product name="product_data" id=$product.product_id location="cart"}

			<p><strong>{$lang.configuration}:</strong></p>
			
			<table cellpadding="0" cellspacing="0" border="0" width="85%" class="table">
			<tr>
				<th width="50%">{$lang.product}</th>
				<th width="10%">{$lang.price}</th>
			</tr>
			{foreach from=$products item="product_conf" key="key_conf"}
			{if $wishlist.products.$key_conf.extra.parent.configuration == $key}
			<tr {cycle values=",class=\"table-row\""}>
				<td><a href="{$index_script}?dispatch=products.view&amp;product_id={$product_conf.product_id}" class="underlined">{$product_conf.product}</a></td>
				<td class="center nowrap">
					{include file="common_templates/price.tpl" value=$product_conf.price}&nbsp;&nbsp;</td>
				{math equation="item_price + conf_" item_price=$product_conf.price|default:"0" conf_=$conf_price|default:"0" assign="conf_price"}
			</tr>
			{/if}
			{/foreach}
			<tr {cycle values="class=\"table-row\","}>
				<td colspan="4"><hr /></td>
			</tr>
			<tr {cycle values=",class=\"table-row\""}>
				<td><strong>{$lang.product_summary}:</strong></td>
				<td class="center">
					{math equation="item_price + conf_" item_price=$product.price|default:"0" conf_=$conf_price|default:"0" assign="conf_price"}
					<strong>{include file="common_templates/price.tpl" value=$conf_price}</strong></td>
			</tr>
			<tr class="table-footer">
				<td colspan="2">&nbsp;</td>
			</tr>
			</table>

			{if !($product.zero_price_action == "R" && $product.price == 0) && !($settings.General.inventory_tracking == "Y" && $product.amount <= 0 && $product.is_edp != "Y" && $product.tracking == "B")}
			<div class="buttons-container">
				{include file="buttons/add_to_cart.tpl" but_name="dispatch[checkout.add]"}
			</div>
			{/if}
		</div>
	</div>
	</form>
{/if}