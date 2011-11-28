{* $Id: cart_items.tpl 7580 2009-06-15 10:58:34Z lexa $ *}

{capture name="cartbox"}

<div id="cart_items">
{if $mode == "checkout"}
	{if $cart.coupons|floatval}<input type="hidden" name="c_id" value="" />{/if}
	{hook name="checkout:form_data"}
	{/hook}
{/if}

{if $cart_products}

{assign var="prods" value=false}
{foreach from=$cart_products item="product" key="key" name="cart_products"}
{hook name="checkout:items_list"}
{if !$cart.products.$key.extra.parent}
<div class="clear">
	{if $prods}
		<hr class="dark-hr" />
	{else}
		{assign var="prods" value=true}
	{/if}
	{if $mode == "cart"}
	<div class="product-image">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">
		{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$key images=$product.main_pair object_type="product"}</a></div>
	{/if}
	<div class="product-description">
		{if $use_ajax == true && $cart.amount != 1}
			{assign var="ajax_class" value="cm-ajax"}
		{/if}
		
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>{if !$product.exclude_from_calculate}&nbsp;<a class="{$ajax_class}" href="{$index_script}?dispatch=checkout.delete&amp;cart_id={$key}&amp;redirect_mode={$mode}" rev="cart_items,checkout_totals,cart_status,checkout_steps"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="{$lang.remove}" align="bottom" title="{$lang.remove}" /></a>{/if}
		
		<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$key}">
			{$lang.sku}: <span id="product_code_{$key}">{$product.product_code}</span>
		</p>
		
		<div class="quantity">
			<input type="hidden" name="cart_products[{$key}][product_id]" value="{$product.product_id}" />
			{if $product.exclude_from_calculate}<input type="hidden" name="cart_products[{$key}][extra][exclude_from_calculate]" value="{$product.exclude_from_calculate}" />{/if}

			<label for="amount_{$key}">{$lang.qty}:</label>
			{if $product.qty_content && $product.is_edp != "Y"}
			<select name="cart_products[{$key}][amount]" id="amount_{$key}">
			{foreach from=$product.qty_content item="var"}
				<option value="{$var}"{if $product.amount == $var} selected="selected"{/if}>{$var}</option>
			{/foreach}
			</select>
			{else}
				<input type="text" size="3" id="amount_{$key}" name="cart_products[{$key}][amount]" value="{$product.amount}" class="input-text-short" {if $product.is_edp == "Y" || $product.exclude_from_calculate}disabled="disabled"{/if} onkeypress="cart_changed = true;"/>
			{/if}
			{if $product.is_edp == "Y" || $product.exclude_from_calculate}
				<input type="hidden" name="cart_products[{$key}][amount]" value="{$product.amount}" />
			{/if}
			{if $product.is_edp == "Y"}
				<input type="hidden" name="cart_products[{$key}][is_edp]" value="Y" />
			{/if}
			x&nbsp;{include file="common_templates/price.tpl" value=$product.display_price span_id="product_price_`$key`" class="sub-price"}
			&nbsp;=&nbsp;&nbsp;&nbsp;{include file="common_templates/price.tpl" value=$product.display_subtotal span_id="product_subtotal_`$key`" class="price"}
			{if $product.zero_price_action == "A"}
				<input type="hidden" name="cart_products[{$key}][price]" value="{$product.base_price}" />
			{/if}
		</div>
		
		{assign var="name" value="product_options_$key"}
		{capture name=$name}
		{if $product.product_options}
			{include file="views/products/components/product_options.tpl" product_options=$product.product_options product=$product name="cart_products" id=$key location="cart" disable_ids=$disable_ids form_name="checkout_form"}
		{/if}

		{hook name="checkout:product_info"}
		    {if $product.exclude_from_calculate}
				<strong><span class="price">{$lang.free}</span></strong>
			{elseif $product.discount|floatval || $product.taxes}
				<table class="table" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<th>{$lang.price}</th>
					<th>{$lang.quantity}</th>
					{if $product.discount|floatval}<th>{$lang.discount}</th>{/if}
					{if $product.taxes}<th>{$lang.tax}</th>{/if}
					<th>{$lang.subtotal}</th>
				</tr>
				<tr>
					<td>{include file="common_templates/price.tpl" value=$product.base_price span_id="original_price_`$key`" class="none"}</td>
					<td class="center">{$product.amount}</td>
					{if $product.discount|floatval}<td>{include file="common_templates/price.tpl" value=$product.discount span_id="discount_subtotal_`$key`" class="none"}</td>{/if}
					{if $product.taxes}<td>{include file="common_templates/price.tpl" value=$product.tax_summary.total span_id="tax_subtotal_`$key`" class="none"}</td>{/if}
					<td>{include file="common_templates/price.tpl" span_id="product_subtotal_2_`$key`" value=$product.display_subtotal class="none"}</td>
				</tr>
				<tr class="table-footer">
					<td colspan="5">&nbsp;</td>
				</tr>
				</table>
			{/if}
		{/hook}
		{/capture}
		
		{if $smarty.capture.$name|trim}
		<p><a id="sw_options_{$key}" class="cm-combo-on cm-combination">{$lang.text_click_here}</a></p>

		<div id="options_{$key}" class="product-options hidden">
			{$smarty.capture.$name}
		</div>
		{/if}
	</div>
</div>
{/if}
{/hook}
{/foreach}
{/if}

{hook name="checkout:extra_list"}
{/hook}

<!--cart_items--></div>
{/capture}
{if $mode == "cart"}
{assign var="class" value="mainbox-cart-body-flex"}
{else}
{assign var="class" value=""}
{/if}
{include file="common_templates/mainbox_cart.tpl" title=$lang.cart_items content=$smarty.capture.cartbox mainbox_body=$class}
