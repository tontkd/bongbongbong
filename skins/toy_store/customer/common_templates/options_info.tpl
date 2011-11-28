{* $Id: options_info.tpl 6838 2009-01-29 10:06:52Z angel $ *}

{if $product_options}
	<div class="product-list-field">
		<label>{$lang.options}:</label>
		{foreach from=$product_options item=po name=po_opt}
			{if $po.variants}
				{assign var="var" value=$po.variants[$po.value]}
			{else}
				{assign var="var" value=$po}
			{/if}
			{$po.option_name}:&nbsp;{$var.variant_name}{if $var.modifier|floatval}&nbsp;({include file="common_templates/modifier.tpl" mod_type=$var.modifier_type mod_value=$var.modifier display_sign=true}){/if}{if !$smarty.foreach.po_opt.last},&nbsp;{/if}
			{if $fields_prefix}<input type="hidden" name="{$fields_prefix}[{$po.option_id}]" value="{$po.value}" />{/if}
		{/foreach}
	</div>
{else}
	&nbsp;
{/if}
