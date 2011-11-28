{* $Id: create_cancel.tpl 6831 2009-01-27 14:32:41Z angel $ *}

{include file="buttons/button.tpl" but_text=$but_text|default:$lang.create but_onclick=$but_onclick but_role="button_main" but_name=$but_name but_meta=$but_meta}

{if $extra}
	{$extra}
{/if}

{if $cancel_action || $breadcrumbs}&nbsp;{$lang.or}&nbsp;&nbsp;{/if}

{if $cancel_action == "close"}
	<a class="cm-popup-switch cm-cancel tool-link">{$lang.cancel}</a>
{elseif $breadcrumbs}
	{foreach from=$breadcrumbs item="b" name="fe_b"}
	{if $smarty.foreach.fe_b.last}
	<a href="{$b.link}" class="underlined tool-link">{$lang.cancel}</a>
	{/if}
	{/foreach}
{/if}