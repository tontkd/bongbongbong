{* $Id: products2.tpl 7862 2009-08-19 12:18:39Z zeke $ *}
{** block-description:products2 **}
{assign var="columns" value=$block.properties.number_of_columns|default:$settings.Appearance.columns_in_products_list}
{if $columns > $items|count}
	{assign var="columns" value=$items|count}
{/if}
{split data=$items size=$columns assign="splitted_objects"}
{math equation="floor(100/x)" x=$columns assign="cell_width"}

{if $block.properties.item_number == "Y"}
	{assign var="cur_number" value=1}
{/if}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
{foreach from=$splitted_objects item="sobjs" name="splitted_objects"}
<tr>
	{foreach from=$sobjs item="product" name="sobjs"}
	{if $product.product}
		<td width="4"><img src="{$images_dir}/listmania_top_left_angle.gif" width="4" height="4" border="0" alt="" /></td>
		<td valign="top" width="{if $items|count > 1}{$cell_width}{else}100{/if}%" class="lm-top"><img src="{$images_dir}/spacer.gif" width="1" height="1" border="0" alt="" /></td>
		<td width="4"><img src="{$images_dir}/listmania_top_right_angle.gif" width="4" height="4" border="0" alt="" /></td>
		{if !$smarty.foreach.sobjs.last}
			<td width="13"><img src="{$images_dir}/spacer.gif" width="13" height="1" border="0" alt="" /></td>
		{/if}
	{/if}
	{/foreach}
</tr>
<tr>
	{foreach from=$sobjs item="product" name="sobjs"}
	{if $product.product}
		{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
		{include file="views/products/components/buy_now.tpl" but_role="act" but_rev="product_form_`$obj_id`" box_class="products-rounded" hide_wishlist_button=true hide_compare_list_button=true product=$product obj_id=$obj_id simple=true capture_price=true assign="buttons" hide_add_to_cart_button=$block.properties.hide_add_to_cart_button additional_link=""}
		<td class="lm-left"><img src="{$images_dir}/spacer.gif" width="3" height="1" border="0" alt="" /></td>
		<td valign="top" width="{if $items|count > 1}{$cell_width}{else}100{/if}%" class="lm-center">
			<div class="float-right">
				&nbsp;&nbsp;&nbsp;<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width="70" images=$product.main_pair obj_id=$obj_id object_type="product" show_thumbnail="Y"}</a>
			</div>
			
			{if $block.properties.item_number == "Y"}{$cur_number}.&nbsp;{math equation="num + 1" num=$cur_number assign="cur_number"}{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}"{if $columns > 1} title="{$product.product}">{$product.product|unescape|strip_tags|truncate:45:"...":true}{else}>{$product.product|unescape}{/if}</a>
			{$smarty.capture.price}
		</td>
		<td class="lm-right"><img src="{$images_dir}/spacer.gif" width="3" height="1" border="0" alt="" /></td>
		{if !$smarty.foreach.sobjs.last}
			<td width="13"><img src="{$images_dir}/spacer.gif" width="13" height="1" border="0" alt="" /></td>
		{/if}
	{/if}
	{/foreach}
</tr>
<tr>
	{foreach from=$sobjs item="product" name="sobjs"}
	{if $product.product}
	{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
	{include file="buttons/button.tpl" but_role="text" but_href="`$index_script`?dispatch=products.view&amp;product_id=`$product.product_id`" but_text=$lang.more_info assign="additional_link"}
	{include file="views/products/components/buy_now.tpl" but_role="act" but_rev="product_form_`$obj_id`" box_class="products-rounded" hide_wishlist_button=true hide_compare_list_button=true product=$product obj_id=$obj_id simple=true capture_price=true assign="buttons" hide_add_to_cart_button=$block.properties.hide_add_to_cart_button additional_link=$additional_link}
	<td class="lm-left"><img src="{$images_dir}/spacer.gif" width="3" height="1" border="0" alt="" /></td>
	<td valign="top" width="{if $items|count > 1}{$cell_width}{else}100{/if}%" class="lm-center">
		<div class="float-right products-rounded right">{$buttons}</div>
	</td>
	<td class="lm-right"><img src="{$images_dir}/spacer.gif" width="3" height="1" border="0" alt="" /></td>
		{if !$smarty.foreach.sobjs.last}
			<td width="13"><img src="{$images_dir}/spacer.gif" width="13" height="1" border="0" alt="" /></td>
		{/if}
	{/if}
	{/foreach}
</tr>

<tr>
	{foreach from=$sobjs item="product" name="sobjs"}
	{if $product.product}
		<td width="4"><img src="{$images_dir}/listmania_bottom_left_angle.gif" width="4" height="4" border="0" alt="" /></td>
		<td valign="top" width="{if $items|count > 1}{$cell_width}{else}100{/if}%" class="lm-bottom"><img src="{$images_dir}/spacer.gif" width="1" height="1" border="0" alt="" /></td>
		<td width="4"><img src="{$images_dir}/listmania_bottom_right_angle.gif" width="4" height="4" border="0" alt="" /></td>
		{if !$smarty.foreach.sobjs.last}
			<td width="13"><img src="{$images_dir}/spacer.gif" width="13" height="1" border="0" alt="" /></td>
		{/if}
	{/if}
	{/foreach}
</tr>
{if !$smarty.foreach.splitted_objects.last}
<tr>
	{foreach from=$sobjs item="product" name="sobjs"}
	{if $product.product}
	<td colspan="3" width="{if $items|count > 1}{$cell_width}{else}100{/if}%"><img src="{$images_dir}/spacer.gif" width="1" height="13" border="0" alt="" /></td>
		{if !$smarty.foreach.sobjs.last}
			<td width="13"><img src="{$images_dir}/spacer.gif" width="13" height="1" border="0" alt="" /></td>
		{/if}
	{/if}
	{/foreach}
</tr>
{/if}
{/foreach}
</table>