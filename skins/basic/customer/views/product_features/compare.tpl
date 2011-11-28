{* $Id: compare.tpl 7299 2009-04-17 11:27:35Z zeke $ *}

{if !$comparison_data}
	<p class="no-items">{$lang.no_products_selected}</p>
{else}

	{script src="js/exceptions.js"}

	<div align="right" class="info-field-title">
		<ul class="action-bullets">
			<li>{if $action != "show_all"}<a href="{$index_script}?dispatch=product_features.compare.show_all" class="underlined">{$lang.all_features}</a>{else}{$lang.all_features}{/if}</li>
			<li>{if $action != "similar_only"}<a href="{$index_script}?dispatch=product_features.compare.similar_only" class="underlined">{$lang.similar_only}</a>{else}{$lang.similar_only}{/if}</li>
			<li>{if $action != "different_only"}<a href="{$index_script}?dispatch=product_features.compare.different_only" class="underlined">{$lang.different_only}</a>{else}{$lang.different_only}{/if}</li>
		</ul>
	</div>

	{math equation="floor(100/x)" x=$comparison_data.products|sizeof assign="cell_width"}
	<div class="scroll-x">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="compare-table">
	<tr>
		<td valign="middle" class="first-cell center" rowspan="2" colspan="2"><strong>{$lang.compare}:</strong></td>
		{foreach from=$comparison_data.products item=product}
		<td valign="bottom" width="{$cell_width}%" class="left-border">
			<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$settings.Appearance.thumbnail_width obj_id=$product.product_id images=$product.main_pair object_type="product" no_ids=true}</a></td>
		{/foreach}
	</tr>
	<tr valign="top">
		{foreach from=$comparison_data.products item=product}
		<td class="left-border bottom-border"><a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>&nbsp;<a href="{$index_script}?dispatch=product_features.delete_product&amp;product_id={$product.product_id}&amp;redirect_url={$config.current_url|escape:url}"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="" align="bottom" /></a></td>
		{/foreach}
	</tr>
	{foreach from=$comparison_data.features item=feature key=id name="product_features"}
	<tr {cycle values="class=\"table-row\", " name="fixed"}>
		<td height="30" {if $smarty.foreach.product_features.last}class="bottom-border"{/if}><a href="{$index_script}?dispatch=product_features.delete_feature&amp;feature_id={$id}&amp;redirect_url={$config.current_url|escape:url}"><img src="{$images_dir}/icons/delete_product.gif" width="12" height="12" border="0" alt="" align="bottom" /></a>
		</td>
		<td class="nowrap{if $smarty.foreach.product_features.last} bottom-border{/if}"><strong>{$feature}:</strong>&nbsp;&nbsp;&nbsp;</td>
		{foreach from=$comparison_data.products item=product}
		<td valign="top" class="left-border{if $smarty.foreach.product_features.last} bottom-border{/if}">

		{assign var="feature" value=$product.features.$id}

		{strip}
		{if $feature.prefix}{$feature.prefix}{/if}
		{if $feature.feature_type == "C"}
			<img src="{$images_dir}/icons/checkbox_{if $feature.value == "N"}un{/if}ticked.gif" width="13" height="13" alt="{$feature.value}" align="top" />
		{elseif $feature.feature_type == "D"}
			{$feature.value_int|date_format:"`$settings.Appearance.date_format`"}
		{elseif $feature.feature_type == "M" && $feature.variants}
			<ul class="float-left">
			{foreach from=$feature.variants item="var"}
			<li><img src="{$images_dir}/icons/checkbox_ticked.gif" width="13" height="13" alt="{$var.variant}" />&nbsp;{$var.variant}</li>
			{/foreach}
			</ul>
		{elseif $feature.feature_type == "S" || $feature.feature_type == "E"}
			{foreach from=$feature.variants item="var"}
				{$var.variant}
			{/foreach}
		{elseif $feature.feature_type == "N" || $feature.feature_type == "O"}
			{$feature.value_int|default:"-"}
		{else}
			{$feature.value|default:"-"}
		{/if}
		{if $feature.suffix}{$feature.suffix}{/if}
		{/strip}

		{/foreach}

	</tr>
	{/foreach}
	<tr>
		<td colspan="2">&nbsp;</td>
		{foreach from=$comparison_data.products item=product}
		<td class="left-border">
			<div class="buttons-container">
			{include file="views/products/components/buy_now.tpl" hide_wishlist_button=true hide_compare_list_button=true simple=true but_role="action"}
			</div>
		</td>
		{/foreach}
	</tr>
	</table>
	</div>

	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.clear_list but_href="$index_script?dispatch=product_features.clear_list&amp;redirect_url=$index_script"}&nbsp;&nbsp;&nbsp;
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
	</div>

	{if $comparison_data.hidden_features}
	<p>&nbsp;</p>
	{include file="common_templates/subheader.tpl" title=$lang.add_feature}
	<form action="{$index_script}" method="post" name="add_feature_form">
	<input type="hidden" name="redirect_url" value="{$config.current_url}" />
	<select name="add_features[]" multiple="multiple">
	{foreach from=$comparison_data.hidden_features key=k item=f}
	<option value="{$k}">{$f}</option>
	{/foreach}
	</select>
	<p>&nbsp;</p>
	{include file="buttons/button.tpl" but_text=$lang.add but_name="dispatch[product_features.add_feature]"}
	</form>
	{/if}
{/if}

{capture name="mainbox_title"}{$lang.compare}{/capture}
