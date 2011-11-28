{* $Id: buy_now.pre.tpl 7286 2009-04-16 13:13:14Z angel $ *}

{if !$hide_wishlist_button}
	{include file="addons/wishlist/views/wishlist/components/add_to_wishlist.tpl" but_id="button_wishlist_`$product.product_id`" but_name="dispatch[wishlist.add..`$product.product_id`]" but_role="text"}{if $buy_now_column_style != "Y"}&nbsp;{/if}
{/if}