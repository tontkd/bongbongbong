{* $Id: updates_subscribed.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.text_success_subscription}<br />
<br />
<br />
{$lang.text_unsubscribe_instructions}<br />
<a href="{$config.http_location}/{$config.customer_index}?dispatch=news.unsubscribe&amp;key={$unsubscribe_key}">{$config.http_location}/{$config.customer_index}?dispatch=news.unsubscribe&amp;key={$unsubscribe_key}</a>

{include file="letter_footer.tpl"}