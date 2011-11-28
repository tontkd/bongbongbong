{* $Id: giftregistry.tpl 7321 2009-04-20 13:20:33Z angel $ *}
{** block-description:events **}

<!--dynamic:events-->
{if $today_events}
<div><strong>{$lang.today_events}</strong>:</div>
<ul class="bullets-list">
{foreach from=$today_events item=event}
	<li><a href="{$index_script}?dispatch=events.view&amp;event_id={$event.event_id}" class="underlined">{$event.title}</a></li>
{/foreach}
</ul>

{if $additional_link}
<div class="right"><a href="{$index_script}?dispatch=events.search&amp;today_events=Y" class="underlined">{$lang.more_w_ellipsis}</a></div>
{/if}
<div class="delim"></div>
{/if}
<ul class="arrows-list">
	<li><a href="{$index_script}?dispatch=events.search" class="underlined">{$lang.search}</a></li>
	<li><a href="{$index_script}?dispatch=events.add" class="underlined">{$lang.add_new}</a></li>
	<li><a href="{$index_script}?dispatch=events.access_key" class="underlined">{$lang.private_events}</a></li>
</ul>
<!--/dynamic-->