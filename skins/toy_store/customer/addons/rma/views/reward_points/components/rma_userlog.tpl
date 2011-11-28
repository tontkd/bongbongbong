{* $Id: rma_userlog.tpl 6967 2009-03-04 09:26:06Z angel $ *}

	{assign var="statuses" value=$smarty.const.STATUSES_RETURN|fn_get_statuses:true}
	{assign var="reason" value=$ul.reason|@unserialize}
	{$lang.rma_return}&nbsp;<a href="{$index_script}?dispatch=rma.details&return_id={$reason.return_id}" class="underlined">&nbsp;<strong>#{$reason.return_id}</strong></a>:&nbsp;{$statuses[$reason.from]}&nbsp;&#8212;&#8250;&nbsp;{$statuses[$reason.to]}

