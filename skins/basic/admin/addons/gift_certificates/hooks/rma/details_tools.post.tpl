{* $Id: details_tools.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $return_info.extra.gift_certificates}
	{capture name="url"}{$index_script}?dispatch=gift_certificates.manage{foreach from=$return_info.extra.gift_certificates item="gift_cert" key="gift_cert_key"}&amp;gift_cert_ids[]={$gift_cert_key}{/foreach}{/capture}
	&nbsp;|&nbsp;{include file="buttons/button.tpl" but_text=$lang.related_gift_cert but_href=$smarty.capture.url but_role="tool"}
{/if}