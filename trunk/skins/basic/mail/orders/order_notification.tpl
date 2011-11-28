{* $Id: order_notification.tpl 7703 2009-07-13 10:36:45Z angel $ *}
                                                   
{include file="letter_header.tpl"}

{$lang.dear} {$order_info.firstname},<br /><br />

{$order_status.email_header|unescape}<br /><br />

<b>{$lang.invoice}:</b><br />

{include file="orders/invoice.tpl"}

{include file="letter_footer.tpl"}