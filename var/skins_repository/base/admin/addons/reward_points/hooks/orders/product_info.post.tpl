{* $Id: product_info.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $order_info.points_info.price && $oi}
<p>{$lang.price_in_points}:{$oi.extra.points_info.price}</p>
{/if}