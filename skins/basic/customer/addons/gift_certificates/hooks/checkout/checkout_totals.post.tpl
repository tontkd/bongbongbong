{* $Id: checkout_totals.post.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{if $cart.use_gift_certificates}
{foreach from=$cart.use_gift_certificates item="ugc" key="ugc_key"}
	<li>
		<span>{$lang.gift_certificate}:</span>
		<strong>&nbsp;</strong>
	</li>
	<li>
	<span><a href="{$index_script}?dispatch=gift_certificates.verify&verify_code={$ugc_key}">{$ugc_key}</a>&nbsp;<a {if $use_ajax}class="cm-ajax"{/if} href="{$index_script}?dispatch=checkout.delete_use_certificate&amp;gift_cert_code={$ugc_key}&amp;redirect_mode={$location}" rev="checkout_totals,cart_items,cart_status,checkout_steps"><img src="{$images_dir}/icons/delete_icon.gif" width="10" height="8" border="0" alt="{$lang.delete}" title="{$lang.delete}" /></a>&nbsp;:</span>
	<strong>{include file="common_templates/price.tpl" value=$ugc.cost}</strong>
	</li>
{/foreach}
{/if}
