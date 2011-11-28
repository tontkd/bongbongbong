{* $Id: return_info.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $return_info.extra.gift_certificates}
<tr>
	<td valign="top"><strong>{$lang.gift_certificates}</strong>:&nbsp;</td>
	<td>
		{foreach from=$return_info.extra.gift_certificates item="gift_cert" key="gift_cert_key"}
		<div><a href="{$index_script}?dispatch=gift_certificates.verify&amp;verify_code={$gift_cert.code}">{$gift_cert.code}</a>&nbsp;({include file="common_templates/price.tpl" value=$gift_cert.amount})</div>
		{/foreach}
	</td>
</tr>
{/if}
