{* $Id: products_list.post.tpl 6740 2009-01-12 11:55:02Z isergi $ *}

{if $product.item_type == "G"}
	{$lang.gift_certificate}
{/if}
{if $product.item_type == "C"}
	<a href="{$index_script}?dispatch=products.update&amp;product_id={$product.product_id}">{$product.product|unescape}</a>
{/if}