{* $Id: edp_access.tpl 7577 2009-06-11 09:14:58Z lexa $ *}

{include file="letter_header.tpl"}

{$lang.dear} {$order_info.firstname},<br /><br />

{$lang.edp_access_granted}<br /><br />

{foreach from=$order_info.items item="oi"}
{if $oi.extra.is_edp == 'Y' && $edp_data[$oi.product_id].files}
{assign var="first_file" value=$edp_data[$oi.product_id].files|reset}
<a href="{$config.http_location}/{$config.customer_index}?dispatch=orders.downloads&amp;product_id={$oi.product_id}&amp;ekey={$first_file.ekey}"><b>{$oi.product}</b></a><br />
<p></p>
{foreach from=$edp_data[$oi.product_id].files item="file" key="file_id"}
<a href="{$config.http_location}/{$config.customer_index}?dispatch=orders.get_file&amp;file_id={$file.file_id}&amp;product_id={$oi.product_id}&amp;ekey={$file.ekey}">{$file.file_name} ({$file.file_size|number_format:0:'':' '}&nbsp;{$lang.bytes})</a><br /><br />
{/foreach}
{/if}
{/foreach}

{include file="letter_footer.tpl"}