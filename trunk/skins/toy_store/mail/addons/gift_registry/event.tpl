{* $Id: event.tpl 7322 2009-04-21 07:37:34Z lexa $ *}

{include file="letter_header.tpl"}

{$lang.hello} {$recipient.name},<br /><br />

{$lang.text_event_subscriber|replace:"[owner]":$event.owner}<br /><br />

<a href="{$config.http_location}/{$config.customer_index}?dispatch=events.view&amp;{if $access_key}access_key={$access_key}{else}event_id={$event.event_id}{/if}">{$lang.view_event_details}</a><br />
<a href="{$config.http_location}/{$config.customer_index}?dispatch=events.unsubscribe&amp;{if $access_key}access_key={$access_key}{else}event_id={$event.event_id}{/if}&amp;email={$recipient.email}">{$lang.unsubscribe}</a><br /><br />

{include file="letter_footer.tpl"}