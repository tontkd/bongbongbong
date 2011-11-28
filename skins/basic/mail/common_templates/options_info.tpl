{* $Id: options_info.tpl 7875 2009-08-21 08:05:47Z zeke $ *}
{if $product_options}
<b>{$lang.options}:</b>&nbsp;
{foreach from=$product_options item=po name=po_opt}
	{$po.option_name}:&nbsp;{$po.variant_name}{if !$skip_modifiers && $po.modifier|floatval}&nbsp;({include file="common_templates/modifier.tpl" mod_type=$po.modifier_type mod_value=$po.modifier display_sign=true}){/if}{if !$smarty.foreach.po_opt.last},&nbsp;{/if}
{/foreach}
{else}
	&nbsp;
{/if}
