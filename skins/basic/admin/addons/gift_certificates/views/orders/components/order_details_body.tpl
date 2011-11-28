{* $Id: order_details_body.tpl 5805 2008-08-24 20:31:37Z zeke $ *}

{if $oi.extra.in_use_certificate}
<div>({$lang.gift_certificate}:{foreach from=$oi.extra.in_use_certificate item="c" key="c_key" name="f_fciu"}&nbsp;<a href="{$index_script}?dispatch=gift_certificates.update&amp;gift_cert_id={$order_info.use_gift_certificates.$c_key.gift_cert_id}">{$c_key}</a>{if !$smarty.foreach.f_fciu.last},{/if}{/foreach})</div>
{/if}
