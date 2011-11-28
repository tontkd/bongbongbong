{* $Id: track.tpl 5807 2008-08-26 09:27:03Z zeke $ *}
                                                   
{include file="letter_header.tpl"}

{$lang.hello},<br /><br />

{$lang.text_track_request}<br /><br />

{if $o_id}
{$lang.text_track_view_order|replace:"[order]":$o_id}<br />
<a href="{$config.http_location}/{$config.customer_index}?dispatch=orders.track&amp;ekey={$access_key}&amp;o_id={$o_id}">{$config.http_location}/{$config.customer_index}?dispatch=orders.track&amp;ekey={$access_key}&amp;o_id={$o_id}</a><br />
<br />
{/if}

{$lang.text_track_view_all_orders}<br />
<a href="{$config.http_location}/{$config.customer_index}?dispatch=orders.track&amp;ekey={$access_key}">{$config.http_location}/{$config.customer_index}?dispatch=orders.track&amp;ekey={$access_key}</a><br />

{include file="letter_footer.tpl"}