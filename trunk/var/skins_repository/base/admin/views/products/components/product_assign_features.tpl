{* $Id: product_assign_features.tpl 7043 2009-03-16 08:49:44Z zeke $ *}

{foreach from=$product_features item=feature key="feature_id"}
	{if $feature.feature_type != "G"}
		<div class="form-field">
			<label for="feature_{$feature_id}">{$feature.description}:</label>
			<div class="select-field">
			<label><strong>{$feature.prefix}</strong></label>
			{if $feature.feature_type == "S" || $feature.feature_type == "N" || $feature.feature_type == "E"}
				{assign var="value_selected" value=false}
				<select name="product_data[product_features][{$feature_id}]" id="feature_{$feature_id}" onchange="$('#input_{$feature_id}').toggleBy((this.value != 'disable_select'));">
					<option value="">-{$lang.none}-</option>
					{foreach from=$feature.variants item="var"}
					<option value="{$var.variant_id}" {if $var.variant_id == $feature.variant_id}{assign var="value_selected" value=true}selected="selected"{/if}>{$var.variant}</option>
					{/foreach}
					<option value="disable_select">-{$lang.enter_other}-</option>
				</select>
				<input type="text" class="input-text input-empty hidden" name="product_data[add_new_variant][{$feature.feature_id}][variant]" id="input_{$feature_id}" />

			{elseif $feature.feature_type == "M"}
				<div class="select-field">
					<input type="hidden" name="product_data[product_features][{$feature_id}]" value="" />
					{foreach from=$feature.variants item="var"}
						<p><label class="label-html-checkboxes" for="variant_{$var.variant_id}"><input type="checkbox" class="html-checkboxes" id="variant_{$var.variant_id}" name="product_data[product_features][{$feature_id}][{$var.variant_id}]" {if $var.selected}checked="checked"{/if} value="{$var.variant_id}" />{$var.variant}</label></p>
					{/foreach}
					<p><label for="input_{$feature_id}">{$lang.enter_other}:</label>&nbsp;
					<input type="text" class="input-text" name="product_data[add_new_variant][{$feature.feature_id}][variant]" id="feature_{$feature_id}" />
					</p>
				</div>
			{elseif $feature.feature_type == "C"}
				<input type="hidden" name="product_data[product_features][{$feature_id}]" value="N" />
				<input type="checkbox" name="product_data[product_features][{$feature_id}]" value="Y" id="feature_{$feature_id}" class="checkbox" {if $feature.value == "Y"}checked="checked"{/if} />

			{elseif $feature.feature_type == "D"}
				{include file="common_templates/calendar.tpl" date_id="date_`$feature_id`" date_name="product_data[product_features][$feature_id]" date_val=$feature.value_int|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}

			{else}
				<input type="text" name="product_data[product_features][{$feature_id}]" value="{if $feature.feature_type == "O"}{$feature.value_int}{else}{$feature.value}{/if}" id="feature_{$feature_id}" class="input-text" {if $feature.feature_type == "O"}onkeyup="javascript: this.value = this.value.replace(/\D+/g, '');"{/if} />
			{/if}
			<label><strong>{$feature.suffix}</strong></label>
			</div>
		</div>
	{/if}
{/foreach}

{foreach from=$product_features item=feature key="feature_id"}
	{if $feature.feature_type == "G" && $feature.subfeatures}
		{include file="common_templates/subheader.tpl" title=$feature.description}
		{include file="views/products/components/product_assign_features.tpl" product_features=$feature.subfeatures}
	{/if}
{/foreach}
