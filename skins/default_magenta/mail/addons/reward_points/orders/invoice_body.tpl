{* $Id: invoice_body.tpl 6285 2008-11-09 15:55:49Z zeke $ *}
{*if $order_info.points_info.reward}
	<td align="right">{$oi.extra.points_info.reward|default:"-"}</td>
{/if*}

{if $order_info.points_info.price}
	<p>{$lang.price_in_points}:&nbsp;{$oi.extra.points_info.price}</p>
{/if}
