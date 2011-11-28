{* $Id: payment_info.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $order_info.use_gift_certificates}
{if $order_info.payment_id == 0}
	{include file="common_templates/subheader.tpl" title=$lang.payment_information}
{/if}

<table cellpadding="2" cellspacing="0" border="0">
<tr>
	<td class="field-name">{$lang.method}:&nbsp;</td>
	<td>{$lang.gift_certificate}</td>
</tr>
</table>

<div class="light-notice-box">
	<table cellpadding="2" cellspacing="2" border="0">
	{foreach from=$order_info.use_gift_certificates item="certificate" key="code"}
	<tr>
		<td class="field-name">{$lang.code}:&nbsp;</td>
		<td><a href="{$index_script}?dispatch=gift_certificates.update&amp;gift_cert_id={$certificate.gift_cert_id}">{$code}</a></td>
	</tr>
	<tr>
		<td class="field-name">{$lang.amount}:&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$certificate.cost}</td>
	</tr>
	{/foreach}
	</table>
</div>
{/if}