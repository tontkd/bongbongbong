{* $Id: products_scroller2.tpl 7286 2009-04-16 13:13:14Z angel $ *}
{** block-description:scroller2 **}

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
		{assign var="total_height" value="100"}
		{math equation="total_height + delim_height" assign="item_height" delim_height=$delim_height total_height=$total_height}
		{foreach from=$items item="product" name="for_products"}
			<li>
				<table cellpadding="0" cellspacing="0" border="0" width="{$item_width}" style="height: {$item_height}px;">
				<tr>
					<td valign="middle" class="left">
						<table cellpadding="0" cellspacing="3" border="0">
						<tr>
							{if $block.properties.hide_image != "Y"}
							<td valign="top">
								<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}">{include file="common_templates/image.tpl" image_width=$block.properties.thumbnail_width images=$product.main_pair no_ids=true show_thumbnail="Y"}</a></td>
							<td>&nbsp;</td>
							{/if}
							<td valign="top" class="left">
								{if $block.properties.item_number == "Y"}{$smarty.foreach.for_products.iteration}.&nbsp;{/if}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" title="{$product.product}">{$product.product|unescape|strip_tags|truncate:45:"...":true}</a>
								{include file="views/products/components/buy_now.tpl" but_role="text" hide_wishlist_button=true hide_compare_list_button=true product=$product hide_add_to_cart_button=$block.properties.hide_add_to_cart_button simple=true}
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</li>
		{/foreach}
	</ul>
</div>

{script src="js/jquery.jcarousel.js"}
{include file="common_templates/scroller_init.tpl"}
