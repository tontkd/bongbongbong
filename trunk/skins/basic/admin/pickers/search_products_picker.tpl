{* $Id: search_products_picker.tpl 6713 2009-01-06 15:38:06Z zeke $ *}

{if $search.p_ids}
	{assign var="product_ids" value=","|explode:$search.p_ids}
{/if}
<div class="info-line">
	{$lang.any_of}&nbsp;
	{include file="pickers/products_picker.tpl" data_id="added_products" but_text=$lang.add item_ids=$product_ids input_name="p_ids" type="links" no_container=true picker_view=true}
	{assign var="filters" value="products"|fn_get_views}
	{if $filters}
	{$lang.or_saved_search}:&nbsp;
	<select name="product_filter_id">
		<option value="0">--</option>
		{foreach from=$filters item=f}
			<option value="{$f.filter_id}" {if $search.product_filter_id == $f.filter_id}selected="selected"{/if}>{$f.name}</option>
		{/foreach}
	</select>
	{/if}
</div>
