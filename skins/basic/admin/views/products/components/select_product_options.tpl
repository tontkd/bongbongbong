{* $Id: select_product_options.tpl 7806 2009-08-12 10:22:35Z alexions $ *}

{if $product_options}

<p class="strong">{$lang.product_options}:</p>

<div id="opt_{$id}">
{foreach from=$product_options item="po"}
<div id="opt_{$id}_{$po.option_id}" class="form-field{if $additional_class} {$additional_class}{/if}">
	<label for="option_{$id}_{$po.option_id}" id="option_description_{$id}_{$po.option_id}" class="{if $po.required == "Y"}cm-required{/if} {if $po.regexp}cm-regexp{/if}">{$po.option_name}:</label>
	{if $po.option_type == "S"} {*Selectbox*}
		<select id="option_{$id}_{$po.option_id}" name="{$name}[{$id}][product_options][{$po.option_id}]" id="option_{$id}_{$po.option_id}" onchange="fn_check_exceptions({$id});" {if $cp.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if}>
		{foreach from=$po.variants item="vr"}
		<option value="{$vr.variant_id}" {if $po.value == $vr.variant_id}selected="selected"{/if}>{$vr.variant_name}{if $settings.General.display_options_modifiers == "Y"}{if $vr.modifier|floatval} ({include file="common_templates/modifier.tpl" mod_type=$vr.modifier_type mod_value=$vr.modifier display_sign=true}){/if}{hook name="products:select_options"}{/hook}{/if}</option>
		{/foreach}
		</select>
	{elseif $po.option_type == "R"} {*Radiobutton*}
		<div id="{$id}_option_{$po.option_id}" class="select-field">
			{foreach from=$po.variants item="vr" name="vars"}
				<input id="{$id}_variant_{$vr.variant_id}" type="radio" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$vr.variant_id}" {if $po.value == $vr.variant_id || (!$po.value && $smarty.foreach.vars.first)}checked="checked"{/if} onclick="fn_check_exceptions({$id});" {if $cp.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if} />
			<label id="option_description_{$id}_{$po.option_id}_{$vr.variant_id}">
				{$vr.variant_name}&nbsp;{if $settings.General.display_options_modifiers == "Y"}{if $vr.modifier|floatval}({include file="common_templates/modifier.tpl" mod_type=$vr.modifier_type mod_value=$vr.modifier display_sign=true}){/if}{hook name="products:select_options"}{/hook}{/if}</label>
			{/foreach}
		</div>
	{elseif $po.option_type == "C"} {*Checkbox*}

		{foreach from=$po.variants item="vr"}
		{if $vr.position == 0}
			<input id="unchecked_{$id}_option_{$po.option_id}" type="hidden" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$vr.variant_id}" />
		{else}
			<div class="select-field">
				<input id="{$id}_option_{$po.option_id}" type="checkbox" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$vr.variant_id}" {if $po.value == $vr.variant_id}checked="checked"{/if} onclick="fn_check_exceptions({$id});" {if $cp.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if} />

				<label>{if $settings.General.display_options_modifiers == "Y"}{if $vr.modifier|floatval}&nbsp;({include file="common_templates/modifier.tpl" mod_type=$vr.modifier_type mod_value=$vr.modifier display_sign=true}){/if}{hook name="products:select_options"}{/hook}{/if}</label>
			</div>
		{/if}
		{/foreach}

	{elseif $po.option_type == "I"} {*Input*}
		<input id="option_{$id}_{$po.option_id}" type="text" name="{$name}[{$id}][product_options][{$po.option_id}]" value="{$po.value|default:$po.inner_hint}" {if $cp.exclude_from_calculate && !$product.aoc}disabled="disabled"{/if} class="input-text {if $po.inner_hint && $po.value == ""}cm-hint{/if}" />
	{elseif $po.option_type == "T"} {*Textarea*}
		<textarea id="option_{$id}_{$po.option_id}" name="{$name}[{$id}][product_options][{$po.option_id}]" {if $cp.exclude_from_calculate}disabled="disabled"{/if} class="input-textarea-long {if $po.inner_hint && $po.value == ""}cm-hint{/if}">{$po.value|default:$po.inner_hint}</textarea>
	{/if}
	
	{if $po.regexp}
		<script type="text/javascript">
		//<![CDATA[
			regexp['option_{$id}_{$po.option_id}'] = {$ldelim}regexp: "{$po.regexp}", message: "{$po.incorrect_message}"{$rdelim};
		//]]>
		</script>
	{/if}
</div>
{/foreach}
</div>
{if $show_aoc}
<div class="select-field">
	<input id="option_{$id}_AOC" type="checkbox" name="{$name}[{$id}][product_options][AOC]" class="checkbox" value="N" onclick="options_routine.disable('opt_{$id}', this);"/><label for="option_{$id}_AOC">{$lang.any_option_combinations}</label>
</div>
{/if}
{/if}

{if $use_exceptions}
<script type="text/javascript">
//<![CDATA[
// Option features
var exception_style = '{$settings.General.exception_style}';
var image_location = '{$settings.General.images_location}';
{if $product.exclude_from_calculate}
exclude_from_calculate[{$id}] = '{$product.exclude_from_calculate}';
{/if}
{if $product.exception}
exceptions[{$id}] = {$product.exception};
{/if}
price[{$id}] = '{if $location == 'cart'}{$product.pure_price}{else}{$product.price}{/if}';
/*
{if $product.list_price}
list_price[{$id}] = '{$product.list_price}';
{/if}
// Define the discounts for the product
{if $product.discounts}
pr_d[{$id}] = {$ldelim}
	'P': {if $product.discounts.P}{$product.discounts.P}{else}0{/if},
	'A': {if $product.discounts.A}{$product.discounts.A}{else}0{/if}
{$rdelim}
{/if}*/
// Define the array of all options of the product
pr_o[{$id}] = {$ldelim}{$rdelim};
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
	{foreach from=$po.variants item="var" name="jj"}
		pr_o[{$id}][{$po.option_id}]['m'][{$var.variant_id}] = {if $var.modifier|floatval}'{$var.modifier_type}{$var.modifier}'{else}'0'{/if};
		pr_o[{$id}][{$po.option_id}]['v'][{$var.variant_id}] = jQuery.entityDecode('{$var.variant_name|escape:javascript}'{if $settings.General.display_options_modifiers == 'Y'}{if $var.modifier|floatval}+' ({include file="common_templates/modifier.tpl" mod_type=$var.modifier_type mod_value=$var.modifier display_sign=true})'{/if}{hook name="products:select_options_js"}{/hook}{/if});
	{/foreach}
{/foreach}

//]]>
</script>
{/if}
