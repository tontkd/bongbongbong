{* $Id: buy_now.tpl 7862 2009-08-19 12:18:39Z zeke $ *}

{if ($product.price|floatval || $product.zero_price_action == "P" || $product.zero_price_action == "A" || (!$product.price|floatval && $product.zero_price_action == "R")) && !($settings.General.allow_anonymous_shopping == "P" && !$auth.user_id)}
	{assign var="show_price_values" value=true}
{else}
	{assign var="show_price_values" value=false}
{/if}

{assign var="obj_id" value=$obj_id|default:$product.product_id}

{capture name="add_to_cart"}
{if !($product.zero_price_action == "R" && $product.price == 0) && !($settings.General.inventory_tracking == "Y" && $settings.General.allow_negative_amount != "Y" && ($product.amount <= 0 || $product.amount < $product.min_qty) && $product.is_edp != "Y" && $product.tracking == "B")}
	{if $product.avail_since <= $smarty.const.TIME || ($product.avail_since > $smarty.const.TIME && $product.buy_in_advance == "Y")}
		{if $product.has_options && (!$product.product_options || $simple)}
			{include file="buttons/button.tpl" but_id="button_cart_`$obj_id`" but_text=$lang.select_options but_href="$index_script?dispatch=products.view&amp;product_id=`$product.product_id`" but_role="text" but_name=""}
		{else}
			{if $additional_link}{$additional_link}&nbsp;{/if}
			{include file="buttons/add_to_cart.tpl" but_id="button_cart_`$obj_id`" but_name="dispatch[checkout.add..`$obj_id`]" but_role=$but_role}&nbsp;
		{/if}
	{/if}
	{if $product.avail_since > $smarty.const.TIME}
		{include file="common_templates/coming_soon_notice.tpl" avail_date=$product.avail_since add_to_cart=$product.buy_in_advance}
	{/if}
{/if}
{/capture}

{if $show_sku}
<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$obj_id}">{$lang.sku}: <span id="product_code_{$obj_id}">{$product.product_code}</span></p>
{/if}

{if $show_features}
	{include file="views/products/components/product_features_short_list.tpl" features=$product.product_id|fn_get_product_features_list|escape}
{/if}

{if !$hide_form}
<form {if $settings.DHTML.ajax_add_to_cart == "Y" && !$no_ajax}class="cm-ajax"{/if} action="{$index_script}" method="post" name="product_form_{$obj_id}">
<input type="hidden" name="result_ids" value="cart_status,wish_list" />
{if !$stay_in_cart}
<input type="hidden" name="redirect_url" value="{$config.current_url}" />
{/if}
<input type="hidden" name="product_data[{$obj_id}][product_id]" value="{$product.product_id}" />
{/if}

{if ($product.discount_prc || $product.list_discount_prc) && $show_price_values && !$simple}
<div class="clear">
	<div class="prices-container">
{/if}
	{hook name="products:prices_block"}
	{if $show_price_values}
	
		{if !$simple}
			{if $product.discount} 	{********************** Old Price *****************}
				<span class="list-price" id="line_old_price_{$obj_id}">{$lang.old_price}: {include file="common_templates/price.tpl" value=$product.base_price span_id="old_price_`$obj_id`" class="list-price"}</span>
			{elseif $product.list_discount}
				<span class="list-price" id="line_list_price_{$obj_id}">{$lang.list_price}: {include file="common_templates/price.tpl" value=$product.list_price span_id="list_price_`$obj_id`" class="list-price"}</span>
			{/if}
		{/if}
	
		{if $capture_price}
		{capture name="price"}
		{/if}
			<p class="price"> 	{********************** Price *********************}
			{if $product.price|floatval || $product.zero_price_action == "P" || ($hide_add_to_cart_button == "Y" && $product.zero_price_action == "A")}
				<span class="price{if !$product.price|floatval} hidden{/if}" id="line_discounted_price_{$obj_id}">{if !$hide_price_title}{$lang.price}: {/if}{include file="common_templates/price.tpl" value=$product.price span_id="discounted_price_`$obj_id`" class="price"}</span>
			{elseif $product.zero_price_action == "A"}
				<span class="price">{$lang.enter_your_price}: <input class="input-text-short" type="text" size="3" name="product_data[{$obj_id}][price]" value="" /></span>
			{elseif $product.zero_price_action == "R"}
				<span class="price">{$lang.contact_us_for_price}</span>
			{/if}
	
			{if $settings.Appearance.show_prices_taxed_clean == "Y" && $product.taxed_price}
				{if $product.clean_price != $product.taxed_price && $product.included_tax}
					<span class="list-price" id="line_product_price_{$obj_id}">({include file="common_templates/price.tpl" value=$product.taxed_price span_id="product_price_`$obj_id`" class="list-price"} {$lang.inc_tax})</span>
				{elseif $product.clean_price != $product.taxed_price && !$product.included_tax}
					<span class="list-price">({$lang.including_tax})</span>
				{/if}
			{/if}
			</p>
		{if $capture_price}
		{/capture}
		{/if}
	
		{if !$simple}
			{if $product.discount} 	{********************** You Save ******************}
				<span class="list-price" id="line_discount_value_{$obj_id}">{$lang.you_save}: {include file="common_templates/price.tpl" value=$product.discount span_id="discount_value_`$obj_id`" class="list-price"}&nbsp;(<span id="prc_discount_value_{$obj_id}" class="list-price">{$product.discount_prc}</span>%)</span>
			{elseif $product.list_discount}
				<span class="list-price" id="line_discount_value_{$obj_id}">{$lang.you_save}: {include file="common_templates/price.tpl" value=$product.list_discount span_id="discount_value_`$obj_id`" class="list-price"}&nbsp;(<span id="prc_discount_value_{$obj_id}" class="list-price">{$product.list_discount_prc}</span>%)</span>
			{/if}
		{/if}
	
	{elseif $settings.General.allow_anonymous_shopping == "P" && !$auth.user_id}
		<span class="price">{$lang.sign_in_to_view_price}</span>
	{/if}
	{/hook}
	
{if ($product.discount_prc || $product.list_discount_prc) && $show_price_values && !$simple}
	</div>
	
	{************************************ Discount label ****************************}
	<div class="discount-label" id="line_prc_discount_value_{$obj_id}">
		<em><strong>-</strong><span id="prc_discount_value_label_{$obj_id}">{if $product.discount}{$product.discount_prc}{else}{$product.list_discount_prc}{/if}</span>%</em>
	</div>
	{************************************ /Discount label ****************************}
</div>
{/if}

{if !$simple && $product.is_edp == "Y"}
<p>{$lang.text_edp_product}</p>
<input type="hidden" name="product_data[{$obj_id}][is_edp]" value="Y" />
{/if}

{hook name="products:options_advanced"}
{if $product.is_edp !== "Y" && $settings.General.inventory_tracking == "Y" && $product.tracking != "D"}
{if !$simple}
<div class="form-field product-list-field">
	<label>{$lang.in_stock}:</label>
	<span id="qty_in_stock_{$obj_id}" class="qty-in-stock">
	{if ($product.amount <= 0 || $product.amount < $product.min_qty) && $product.tracking == "B"}
		{$lang.text_out_of_stock}
	{else}
		{$product.amount}&nbsp;{$lang.items}
	{/if}
	</span>
</div>
{else}
	<span id="qty_in_stock_{$obj_id}" class="qty-in-stock">
	{if ($product.amount <= 0 || $product.amount < $product.min_qty) && $product.tracking == "B"}
		{$lang.text_out_of_stock}
	{/if}
	</span>
{/if}
{/if}
{/hook}

{if  $hide_add_to_cart_button != "Y"}
	{if !$simple && $product.product_options}
		{include file="views/products/components/product_options.tpl" id=$obj_id product_options=$product.product_options name="product_data"}
	{/if}

	{if ($product.qty_content || $show_qty) && $product.is_edp !== "Y"}
	<div class="form-field product-list-field" id="qty_{$obj_id}">
		<label for="qty_count_{$obj_id}">{$lang.quantity}:</label>
		{if $product.qty_content}
		<select name="product_data[{$obj_id}][amount]" id="qty_count_{$obj_id}">
		{foreach from=$product.qty_content item="var"}
			<option value="{$var}">{$var}</option>
		{/foreach}
		</select>
		{else}
			<input type="text" size="5" class="input-text-short" id="qty_count_{$obj_id}" name="product_data[{$obj_id}][amount]" value="1" />
		{/if}
	</div>
	{if $product.prices}
		{include file="views/products/components/products_qty_discounts.tpl"}
	{/if}
	{elseif !$bulk_add}
		<input type="hidden" name="product_data[{$obj_id}][amount]" value="1" />
	{/if}

	{if $product.min_qty}
		<p>{$lang.text_cart_min_qty|replace:"[product]":$product.product|replace:"[quantity]":$product.min_qty}</p>
	{/if}

	{if $separate_add_button}
	<div class="buttons-container {$align|default:"center"}" id="cart_add_block_{$obj_id}">
		{$smarty.capture.add_to_cart}
	</div>
	{/if}
	
	{if $capture_buttons}
	{capture name="cart_buttons"}
	{/if}
	{hook name="products:buttons_block"}
	<div id="cart_buttons_block_{$obj_id}" class="buttons-container">
		{if !$separate_add_button}
			{$smarty.capture.add_to_cart}
		{/if}
	
		{hook name="products:buy_now"}
		{if $product.feature_comparison == "Y"}
			{include file="buttons/add_to_compare_list.tpl" product_id=$product.product_id}
		{/if}
		{/hook}

	</div>
	{/hook}
	{if $capture_buttons}
	{/capture}
	{/if}
{/if}

{if !$hide_form}
</form>
{/if}
