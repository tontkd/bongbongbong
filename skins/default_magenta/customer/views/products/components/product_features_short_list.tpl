{* $Id: product_features_short_list.tpl 7636 2009-06-30 07:03:06Z zeke $ *}

{if $features}
{strip}
<p>
	<label><strong>
	{foreach from=$features name=features_list item=feature}
	{if $feature.prefix}{$feature.prefix}{/if}
	{if $feature.feature_type == "D"}{$feature.value_int|date_format:"`$settings.Appearance.date_format`"}
	{elseif $feature.feature_type == "M"}
		{foreach from=$feature.variants item="v" name="ffev"}
		{$v.variant|default:$v.value}{if !$smarty.foreach.ffev.last},&nbsp;{/if}
		{/foreach}
	{elseif $feature.feature_type == "S" || $feature.feature_type == "N" || $feature.feature_type == "E"}
		{$feature.variant|default:$feature.value}
	{elseif $feature.feature_type == "C"}
		{$feature.description}
	{elseif $feature.feature_type == "O"}
		{$feature.value_int}
	{else}
		{$feature.value}
	{/if}
	{if $feature.suffix}{$feature.suffix}{/if}
		{if !$smarty.foreach.features_list.last} / {/if}
	{/foreach}
	</strong></label>
</p>
{/strip}
{/if}