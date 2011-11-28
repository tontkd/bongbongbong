{* $Id: userlog.override.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $ul.action == $smarty.const.CHANGE_DUE_RMA}
	{assign var="statuses" value=$smarty.const.STATUSES_RETURN|fn_get_statuses:true}
	{assign var="reason" value=$ul.reason|@unserialize}
	{$lang.rma_return}&nbsp;<a href="{$index_script}?dispatch=rma.details&amp;return_id={$reason.return_id}" class="underlined">&nbsp;<strong>#{$reason.return_id}</strong></a>:&nbsp;{$statuses[$reason.from]}&nbsp;&#8212;&#8250;&nbsp;{$statuses[$reason.to]}
{/if}