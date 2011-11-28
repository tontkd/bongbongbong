{* $Id: details_bullets.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $order_info.allow_return}
	<li><a href="{$index_script}?dispatch=rma.create_return&amp;order_id={$order_info.order_id}">{$lang.return_registration}</a></li>
{/if}
{if $order_info.isset_returns}
	<li><a href="{$index_script}?dispatch=rma.returns&amp;order_id={$order_info.order_id}">{$lang.order_returns}</a></li>
{/if}