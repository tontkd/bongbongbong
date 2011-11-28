{* $Id: view.tpl 7700 2009-07-13 09:14:01Z zeke $ *}

<div class="form-field">
	<label>{$lang.name}:</label>
	{$event_data.owner}
</div>

<div class="form-field">
	<label>{$lang.start_date}:</label>
	{$event_data.start_date|date_format:$settings.Appearance.date_format}
</div>

<div class="form-field">
	<label>{$lang.end_date}:</label>
	{$event_data.end_date|date_format:$settings.Appearance.date_format}
</div>

{foreach from=$event_fields item="field" key="f_id"}
<div class="form-field">
	<label>{$field.description}:</label>
	{if $field.field_type == "S" || $field.field_type == "R"}
		{assign var="i" value=$event_data.fields.$f_id}
		{$field.variants.$i.description}
	{elseif $field.field_type == "C"}
		{if $event_data.fields.$f_id == "Y"}{$lang.yes}{else}{$lang.no}{/if}
	{elseif $field.field_type == "I" || $field.field_type == "T"}
		{$event_data.fields.$f_id}
	{elseif $field.field_type == "V"}
		{$event_data.fields.$f_id|date_format:$settings.Appearance.date_format}
	{/if}
</div>
{/foreach}

{include file="common_templates/subheader.tpl" title=$lang.defined_desired_products}

{if $event_data.products}
{script src="js/exceptions.js"}

<form {if $settings.DHTML.ajax_add_to_cart == "Y" && !$no_ajax}class="cm-ajax"{/if} action="{$index_script}" method="post" name="event_products_form">
<input type="hidden" name="result_ids" value="cart_status" />
{foreach from=$event_data.products item="product" key="key" name="products"}
<div class="product-container clear">
	<div class="product-image">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}{if $product.product_options_combination}&amp;combination={$product.product_options_combination}{/if}">
		{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$key images=$product.main_pair object_type="product"}</a>
	</div>
	<div class="product-description">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}{if $product.product_options_combination}&amp;combination={$product.product_options_combination}{/if}" class="product-title">{$product.product|unescape}</a>&nbsp;
		<p class="sku{if !$product.product_code} hidden{/if}" id="sku_{$product.product_id}">
			{$lang.sku}: <span class="sku" id="product_code_{$product.product_id}">{$product.product_code}</span>
		</p>

		<div class="clear">
			{if $product.product_options}
				{foreach from=$product.product_options_ids item=v key=k}
					<input type="hidden" name="product_data[{$product.product_id}][product_options][{$k}]" value="{$v}" />
				{/foreach}
				{include file="common_templates/options_info.tpl" product_options=$product.product_options}
			{/if}
		</div>

		<table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr>
			<th>{$lang.price}</th>
			<th>{$lang.desired_amount}</th>
			<th>{$lang.bought_amount}</th>
			<th>{$lang.quantity}</th>
		</tr>
		<tr>
			<td class="nowrap center" height="23">
				{if $product.discounted_price}
					{include file="common_templates/price.tpl" value=$product.discounted_price span_id="discounted_price_`$key`" class="sub-price"}
				{else}
					{include file="common_templates/price.tpl" value=$product.price span_id="original_price_`$key`" class="sub-price"}
				{/if}</td>
			<td class="nowrap center strong">{$product.amount}</td>
			<td class="nowrap center strong">{$product.ordered_amount}</td>
			<td class="center">
				<input id="giftreg_item_amount_{$product.item_id}" type="hidden" name="product_data[{$product.product_id}][extra][events][{$product.item_id}]" value="1"  />
				{if $product.avail_amount}
				{assign var="range" value=1|range:$product.avail_amount}
				<select name="product_data[{$product.product_id}][amount]" onchange="document.getElementById('giftreg_item_amount_{$product.item_id}').value = this.value;">
				<option value="">0</option>
				{foreach from=$range item=r}
				<option value="{$r}">{$r}</option>
				{/foreach}
				</select>
				{assign var="show_add_to_cart" value="Y"}
				{else}
				&nbsp;-&nbsp;
				{/if}
			</td>
		</tr>
		<tr class="table-footer">
			<td colspan="4">&nbsp;</td>
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

{if $show_add_to_cart == "Y"}
<div class="buttons-container">
	{include file="buttons/add_to_cart.tpl" but_name="dispatch[checkout.add]"}
</div>
{/if}

</form>
{else}
	<p class="no-items">{$lang.text_no_products_defined}</p>
{/if}

{capture name="mainbox_title"}{$event_data.title}{/capture}

{hook name="events:view"}
{/hook}