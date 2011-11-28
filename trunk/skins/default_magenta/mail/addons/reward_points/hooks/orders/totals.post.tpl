{* $Id: totals.post.tpl 6701 2008-12-29 08:54:31Z angel $ *}

{if  $order_info.points_info.reward}
	<tr>
		<td  align="right" nowrap="nowrap"><b>{$lang.reward_points}:&nbsp;</b></td>
		<td  align="right" nowrap="nowrap">{$order_info.points_info.reward}</td>
	</tr>
{/if}

{if $order_info.points_info.in_use}
	<tr>
		<td align="right" nowrap="nowrap"><b>{$lang.points_in_use}</b>&nbsp;({$order_info.points_info.in_use.points}&nbsp;{$lang.points_lower})<b>:</b>&nbsp;</td>
		<td align="right" nowrap="nowrap">{include file="common_templates/price.tpl" value=$order_info.points_info.in_use.cost}</td>
	</tr> 
{/if}