{* $Id: options_info.tpl 5807 2008-08-26 09:27:03Z zeke $ *}
{if $product_options}
<strong>{$lang.options}: </strong>
{foreach from=$product_options item=po name=po_opt}
	&nbsp;{$po.option_name}:&nbsp;{$po.variant_name}{if $po.modifier|floatval}&nbsp;({include file="common_templates/modifier.tpl" mod_type=$po.modifier_type mod_value=$po.modifier display_sign=true}){/if}{if !$smarty.foreach.po_opt.last},{/if}
{/foreach}
{else}
	&nbsp;
{/if}
