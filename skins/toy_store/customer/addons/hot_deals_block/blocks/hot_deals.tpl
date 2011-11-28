{* $Id: hot_deals.tpl 7782 2009-08-04 12:56:07Z alexions $ *}
{** block-description:hot_deals **}

{script src="addons/hot_deals_block/js/jquery.deals.js"}

<script type="text/javascript">
//<![CDATA[
var items{$block.block_id} = [];
//]]>
</script>

<div class="border deals-main">
	<div class="subheaders-group">
		<h2 class="subheader"><span>{$block.block}</span></h2>
	</div>
	
	<div class="deals-container-{$block.block_id}">
		<div class="pagination cm-deals-pagination-list right"></div>
		<div class="clear"></div>
		<div class="hot-deals-skin-tango">
			<div class="hot-deals-container">
				<div class="hot-deals-prev cm-deals-left"></div>
				<div class="hot-deals-next cm-deals-right"></div>
				<div class="hot-deals-list">
					{section name="index" loop="4"}
						<div class="hot-deals-item cm-deals-item-{$smarty.section.index.index}"></div>
					{/section}
				</div>
			</div>
		</div>
		
		<div class="updates-wrapper deals-footer cm-deals-categories">
			<a name="0" class="cm-deals-category">{$lang.all_categories}</a>&nbsp;&nbsp;
			
			{foreach name="products" from=$items|sort_by:"category" item="product"}
				{if $product.product}
					{foreach from=$product.category_ids key=cat_id item=cat_main}
						{if $cat_main == "M"}
							<script type="text/javascript">
								//<![CDATA[
								items{$block.block_id}[{$smarty.foreach.products.iteration-1}] = {$ldelim}name: '{$product.product|truncate:50:"...":true}', link: '{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}', image: '{$product.main_pair.icon.image_path}', cat_id: {$cat_id}, width: 75, height: 75{$rdelim};
								//]]>
							</script>
							
							{if $category != $product.category}
								<a name="{$cat_id}" class="cm-deals-category">{$product.category}</a>&nbsp;&nbsp;
								
								{assign var="category" value=$product.category}
							{/if}
						{/if}
					{/foreach}
				{/if}
			{/foreach}
		</div>
	</div>
</div>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function()
{$ldelim}
	parent_elm = jQuery('.deals-container-{$block.block_id}');
	var deals{$block.block_id} = new Deals(items{$block.block_id}, parent_elm, {$block.block_id});
{$rdelim});
//]]>
</script>