{* $Id: items_content.post.tpl 7382 2009-04-28 13:59:40Z angel $ *}

{if $return_info.extra.gift_certificates}
	<div class="form-field">
		<label>{$lang.gift_certificates}</label>
		{foreach from=$return_info.extra.gift_certificates item="gift_cert" key="gift_cert_key"}
			<div><a href="{$index_script}?dispatch=gift_certificates.delete&amp;gift_cert_id={$gift_cert_key}&amp;extra[return_id]={$smarty.request.return_id}&amp;return_url={$config.current_url|escape:"url"}"><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="18" border="0" alt="" align="bottom" /></a>&nbsp;<a class="text-button-link" href="{$index_script}?dispatch=gift_certificates.update&amp;gift_cert_id={$gift_cert_key}">{$gift_cert.code}</a>&nbsp;({include file="common_templates/price.tpl" value=$gift_cert.amount})</div>
		{/foreach}
	</div>
{/if}