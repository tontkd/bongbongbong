{* $Id: totals.post.tpl 6962 2009-03-02 14:40:38Z angel $ *}

{if $order_info.use_gift_certificates}
{foreach from=$order_info.use_gift_certificates item="certificate" key="code" name="certs"}
<tr>
	<td>{if $order_info.payment_id == 0 && $smarty.foreach.certs.first}<strong>{$lang.payment_method}:</strong>{/if}&nbsp;</td>
	<td class="nowrap">
	{$lang.gift_certificate}: <a href="{$index_script}?dispatch=gift_certificates.verify&amp;verify_code={$code}">{$code}</a> ({include file="common_templates/price.tpl" value=$certificate.cost})
	</td>
</tr>
{/foreach}
{/if}
