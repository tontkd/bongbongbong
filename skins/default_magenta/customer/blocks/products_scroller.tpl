{* $Id: products_scroller.tpl 7286 2009-04-16 13:13:14Z angel $ *}
{** block-description:scroller **}

{if $scrollers_initialization != "Y"}
<script type="text/javascript">
//<![CDATA[
var scroller_directions = {""|fn_get_block_scroller_directions|to_json};
var scrollers_list = [];
//]]>
</script>
{capture name="scrollers_initialization"}Y{/capture}
{/if}

{assign var="item_width" value="140"}
{assign var="delim_height" value="20"}

<div align="center">
	<ul id="scroll_list_{$block.block_id}" class="jcarousel-skin hidden">
		{assign var="image_h" value="123"}
		{assign var="text_h" value="90"}
		{assign var="cellspacing" value="2"}

		{math equation="3 * cellspacing + image_h + text_h" assign="item_height" cellspacing=$cellspacing image_h=$image_h text_h=$text_h}

		{foreach from=$items item="product" name="for_products"}
			<li>
			{assign var="obj_id" value="scr_`$block.block_id`000`$product.product_id`"}
			{assign var="img_object_type" value="product"}
			{include file="common_templates/image.tpl" assign="object_img" image_width=$block.properties.thumbnail_width images=$product.main_pair no_ids=true object_type=$img_object_type show_thumbnail="Y"}
			<table cellpadding="0" cellspacing="{$cellspacing}" border="0" width="{$item_width}">
			<tr>
				<td class="center" style="height: {$image_h}px;">
					<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{$object_img}</a></td>
			</tr>
			<tr>
				<td class="center" style="height: {$text_h}px;">
					{strip}
					{if $block.properties.item_number == "Y"}{$smarty.foreach.for_products.iteration}.&nbsp;{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" title="{$product.product}">{$product.product|unescape|strip_tags|truncate:40:"...":true}</a>
					{/strip}
					{include file="views/products/components/buy_now.tpl" but_role="text" hide_wishlist_button=true hide_compare_list_button=true product=$product hide_add_to_cart_button=$block.properties.hide_add_to_cart_button simple=true}
				</td>
			</tr>
			</table>
			</li>
		{/foreach}
	</ul>
</div>

{script src="js/jquery.jcarousel.js"}
{include file="common_templates/scroller_init.tpl"}
