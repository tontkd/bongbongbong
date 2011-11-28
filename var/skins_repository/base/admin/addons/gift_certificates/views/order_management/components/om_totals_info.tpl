{* $Id: om_totals_info.tpl 6613 2008-12-19 12:46:16Z angel $ *}

{if $cart.use_gift_certificates}
<input type="hidden" name="cert_code" value="" />
{foreach from=$cart.use_gift_certificates item="ugc" key="ugc_key"}
	<tr>
		<td class="right nowrap"><a href="{$index_script}?dispatch=order_management.delete_use_certificate&amp;gift_cert_code={$ugc_key}"><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="18" border="0" alt="" align="bottom" />{$lang.delete}</a>&nbsp;<strong>{$lang.gift_certificate}</strong>&nbsp;(<a href="{$index_script}?dispatch=gift_certificates.update&amp;gift_cert_id={$ugc.gift_cert_id}">{$ugc_key}</a>)&nbsp;<strong>:</strong></td>
		<td>&nbsp;</td>
		<td class="right nowrap">{include file="common_templates/price.tpl" value=$ugc.cost}</td>
	</tr>
{/foreach}
{/if}
