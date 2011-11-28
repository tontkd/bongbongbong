{* $Id: totals.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $order_info.use_gift_certificates}
{foreach from=$order_info.use_gift_certificates item="certificate" key="code"}
<tr>
	<td colspan="2" nowrap="nowrap">
		<b>{$lang.gift_certificate}</b> {$code} ({include file="common_templates/price.tpl" value=$certificate.cost})</td>
</tr>
{/foreach}
{/if}
