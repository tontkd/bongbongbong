{* $Id: product_info.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $cart.points_info.total_price}
	<p>{$lang.price_in_points}:&nbsp;{$cart.products.$key.extra.points_info.price|default:"-"}</p>
{/if}
