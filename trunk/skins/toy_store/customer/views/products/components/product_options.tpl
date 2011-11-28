{* $Id: product_options.tpl 7863 2009-08-19 12:33:25Z alexions $ *}
{if $product_options}
<div id="opt_{$id}">
	{foreach from=$product_options item="po"}
	{assign var="selected_variant" value=""}
	<div class="form-field product-list-field clear" id="opt_{$id}_{$po.option_id}">
		{if $po.description}
			{include file="views/products/components/product_options_description.tpl" id=$po.option_id description=$po.description text="?" capture_link=true}
		{/if}
		<label for="option_{$id}_{$po.option_id}" class="{if $po.required == "Y"}cm-required{/if} {if $po.regexp}cm-regexp{/if}">{$po.option_name}{if $po.description}&nbsp;({$smarty.capture.link|trim}){/if}:</label>
		{if $po.option_type == "S"} {*Selectbox*}
			<select name="{$name}[{$id}][product_options][{$po.option_id}]" id="option_{$id}_{$po.option_id}" onchange="fn_check_exceptions({$id}); fn_change_variant_image({$id}, {$po.option_id}, this.value); cart_changed = true;" {if $product.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if}>
			{foreach from=$po.variants item="vr" name=vars}
				<option value="{$vr.variant_id}" {if $po.value == $vr.variant_id || ($location != "cart" && $smarty.foreach.vars.first)}{assign var="selected_variant" value=$vr.variant_id}selected="selected"{/if}>{$vr.variant_name} {if $settings.General.display_options_modifiers == "Y"}{hook name="products:options_modifiers"}{if $vr.modifier|floatval}({include file="common_templates/modifier.tpl" mod_type=$vr.modifier_type mod_value=$vr.modifier display_sign=true}){/if}{/hook}{/if}</option>
			{/foreach}
			</select>
		{elseif $po.option_type == "R"} {*Radiobutton*}
			<ul id="option_{$id}_{$po.option_id}">
				{foreach from=$po.variants item="vr" name="vars"}
					<li><input type="radio" class="radio" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$vr.variant_id}" {if $po.value == $vr.variant_id || ($location != "cart" && $smarty.foreach.vars.first)}{assign var="selected_variant" value=$vr.variant_id}checked="checked"{/if} onclick="fn_check_exceptions({$id}); fn_change_variant_image({$id}, {$po.option_id}, this.value); cart_changed = true;" {if $product.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if}/>
					<span id="option_description_{$id}_{$po.option_id}_{$vr.variant_id}">{$vr.variant_name}&nbsp;{if $settings.General.display_options_modifiers == "Y"}{hook name="products:options_modifiers"}{if $vr.modifier|floatval}({include file="common_templates/modifier.tpl" mod_type=$vr.modifier_type mod_value=$vr.modifier display_sign=true}){/if}{/hook}{/if}</span></li>
				{/foreach}
			</ul>

		{elseif $po.option_type == "C"} {*Checkbox*}

			{foreach from=$po.variants item="vr"}
			{if $vr.position == 0}
				<input id="unchecked_option_{$id}_{$po.option_id}" type="hidden" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$vr.variant_id}" />
			{else}
				<input id="option_{$id}_{$po.option_id}" type="checkbox" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$vr.variant_id}" {if $po.value == $vr.variant_id}checked="checked"{/if} onclick="fn_check_exceptions({$id}); cart_changed = true;" {if $product.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if}/>
				{if $settings.General.display_options_modifiers == "Y"}{hook name="products:options_modifiers"}{if $vr.modifier|floatval}({include file="common_templates/modifier.tpl" mod_type=$vr.modifier_type mod_value=$vr.modifier display_sign=true}){/if}{/hook}{/if}
			{/if}
			{/foreach}

		{elseif $po.option_type == "I"} {*Input*}
			<input id="option_{$id}_{$po.option_id}" type="text" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$po.value|default:$po.inner_hint}" {if $product.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if} onkeypress="cart_changed = true;" class="valign input-text {if $po.inner_hint && $po.value == ""}cm-hint{/if}" />
		{elseif $po.option_type == "T"} {*Textarea*}
			<textarea id="option_{$id}_{$po.option_id}" class="input-textarea-long {if $po.inner_hint && $po.value == ""}cm-hint{/if}" rows="3" name="{$name}[{$id}][product_options][{$po.option_id}]" {if $product.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if} onkeypress="cart_changed = true;">{$po.value|default:$po.inner_hint}</textarea>
		{/if}

		{if $po.regexp}
			<script type="text/javascript">
			//<![CDATA[
				regexp['option_{$id}_{$po.option_id}'] = {$ldelim}regexp: "{$po.regexp}", message: "{$po.incorrect_message}"{$rdelim};
			//]]>
			</script>
		{/if}

		{capture name="variant_images"}
			{foreach from=$po.variants item="var"}
				{if $var.image_pair.image_id}
					{if $var.variant_id == $selected_variant}{assign var="_class" value="product-variant-image-selected"}{else}{assign var="_class" value="product-variant-image-unselected"}{/if}
					{include file="common_templates/image.tpl" class="hand $_class" show_thumbnail="Y" images=$var.image_pair object_type="product_option" image_width="50" obj_id="variant_image_`$id`_`$var.variant_id`" image_onclick="fn_set_option_value(`$id`, '`$po.option_id`', `$var.variant_id`); void(0);"}
				{/if}
			{/foreach}
		{/capture}
		{if $smarty.capture.variant_images|trim}<div class="product-variant-image clear-both">{$smarty.capture.variant_images}</div>{/if}
	</div>
	{/foreach}
</div>
<p id="warning_{$id}" class="hidden price">{$lang.nocombination}</p>

<script type="text/javascript">
//<![CDATA[

// Option features
var exception_style = '{$settings.General.exception_style}';
var image_location = '{$settings.General.images_location}';
var allow_negative_amount = {if $settings.General.allow_negative_amount == 'Y'}true{else}false{/if};
{if $product.exclude_from_calculate}
exclude_from_calculate[{$id}] = '{$product.exclude_from_calculate}';
{/if}
{if $product.exception}
exceptions[{$id}] = {$product.exception};
function fn_form_pre_{$form_name|default:"product_form_`$id`"}()
{$ldelim}
	var res = fn_check_exceptions({$id});
{literal}
	if (!res) {
		jQuery.showNotifications({'notification': {'type': 'W', 'title': lang.warning, 'message': lang.cannot_buy, 'save_state': false}});
	}
{/literal}
	return res;
{$rdelim};
{/if}
price[{$id}] = '{$product.base_price}';
{if $product.list_price|floatval}
list_price[{$id}] = '{$product.list_price}';
{/if}
// Define the discounts for the product
pr_d[{$id}] = {$ldelim}
	'P': {if $product.discounts.P}{$product.discounts.P}{else}0{/if},
	'A': {if $product.discounts.A}{$product.discounts.A}{else}0{/if}
{$rdelim}
// Define the array of all options of the product
pr_o[{$id}] = {$ldelim}{$rdelim};
variant_images[{$id}] = {$ldelim}{$rdelim};

{foreach from=$product_options item="po" name="ii"}
	pr_o[{$id}][{$po.option_id}] = {$ldelim}
		'type': '{$po.option_type}',
		'option_id': '{$po.option_id}',
		'id': 'option_{$id}_{$po.option_id}',
		'inventory': '{$po.inventory}',
		'name': '{$po.option_name|escape:javascript}',
		'm': {$ldelim}{$rdelim},
		'v': {$ldelim}{$rdelim}
	{$rdelim};

	variant_images[{$id}][{$po.option_id}] = {$ldelim}{$rdelim};
	{foreach from=$po.variants item="var" name="jj"}
        {if $var.image_pair}
        	variant_images[{$id}][{$po.option_id}][{$var.variant_id}] = {$ldelim}
        	'image_path': '{$var.image_pair.icon.image_path|escape:javascript}'
          	{$rdelim}
        {/if}
		pr_o[{$id}][{$po.option_id}]['m'][{$var.variant_id}] = {if $var.modifier|floatval}'{$var.modifier_type}{$var.modifier}'{else}'0'{/if};
		pr_o[{$id}][{$po.option_id}]['v'][{$var.variant_id}] = jQuery.entityDecode('{$var.variant_name|escape:javascript}'{if $settings.General.display_options_modifiers == 'Y'}{hook name="products:options_modifiers_js"}{if $var.modifier|floatval}+' ({include file="common_templates/modifier.tpl" mod_type=$var.modifier_type mod_value=$var.modifier display_sign=true})'{/if}{/hook}{/if});
	{/foreach}
{/foreach}

// images
pr_i[{$id}] = {$ldelim}{$rdelim};
{foreach from=$product.option_image_pairs item="imag" name="ii" key="_key"}
	pr_i[{$id}][{$smarty.foreach.ii.iteration}-1] = {$ldelim}
		'image_id': '{$imag.image_id}',
		'detailed_id': '{$imag.detailed_id}',
		'options': '{$imag.options}'
	{$rdelim};
	{if $imag.image_id}
	pr_i[{$id}][{$smarty.foreach.ii.iteration}-1]['icon'] = {$ldelim}
		'alt': '{$imag.icon.alt}',
		'type': '{$imag.icon.type}',
		'src': '{$imag.icon.image_path}',
		'src-mini': '{$imag.icon.image_path|fn_generate_thumbnail:34}'
	{$rdelim};
	{/if}
	{if $imag.detailed_id}
	pr_i[{$id}][{$smarty.foreach.ii.iteration}-1]['detailed'] = {$ldelim}
		'image_path': '{$imag.detailed.image_path}'
	{$rdelim};
	{/if}
{/foreach}

{if $product.main_pair.icon}
	{assign var="image_pair_var" value=$product.main_pair}
{elseif $product.option_image_pairs}
        image_changed[{$id}] = "Y";
	{assign var="image_pair_var" value=$product.option_image_pairs|reset}
{/if}
{if $image_pair_var}
default_image[{$id}] = {$ldelim}
	'src': '{$config.no_image_path}',
	'src-mini': '{$config.no_image_path|fn_generate_thumbnail:34}',
	'alt': '{$image_pair_var.icon.alt|escape:javascript}'
{$rdelim};
default_href[{$id}] = '{$image_pair_var.detailed.image_path}';
{/if}

// amount and product code
pr_c[{$id}] = '{$product.product_code|escape:javascript}'; // define default product code
pr_a[{$id}] = {$ldelim}{$rdelim};
{foreach from=$product.option_inventory item="amount" name="ii" key="_key"}
	pr_a[{$id}]['{$amount.options}_'] = {$ldelim}
		'amount': '{$amount.amount}',
		'product_code': '{$amount.product_code|escape:javascript}'
	{$rdelim};
{/foreach}
{if $settings.Appearance.show_prices_taxed_clean == "Y" || $location == "cart"}
	{include file="views/products/components/product_taxes.tpl" id=$id}
{/if}

$(document).ready(function() {$ldelim}
	fn_check_exceptions({$id});
{$rdelim});

//]]>
</script>

{hook name="products:options_js"}{/hook}

{/if}
