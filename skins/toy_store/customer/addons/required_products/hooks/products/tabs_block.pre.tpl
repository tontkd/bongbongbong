{* $Id: tabs_block.pre.tpl 7134 2009-03-25 15:46:35Z lexa $ *}

{if $product.required_products}
<div id="content_required_products">

{include file="views/products/components/products_multicolumns.tpl" details_page=true no_pagination=true no_sorting=true products=$product.required_products show_product_status="Y"}

</div>
{/if}
