{* $Id: details_tools.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $order_info.allow_return}
	&nbsp;|&nbsp;{include file="buttons/button.tpl" but_text=$lang.return_registration but_href="`$index_script`?dispatch=rma.create_return&amp;order_id=`$order_info.order_id`" but_role="tool"}
{/if}
{if $order_info.isset_returns}
	&nbsp;|&nbsp;{include file="buttons/button.tpl" but_text=$lang.order_returns but_href="`$index_script`?dispatch=rma.returns&amp;order_id=`$order_info.order_id`" but_role="tool"}
{/if}
