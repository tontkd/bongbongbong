{* $Id: mail.tpl 5807 2008-08-26 09:27:03Z zeke $ *}
                                                   
{include file="letter_header.tpl"}

{$lang.hello} {$send_data.to_name},<br /><br />

{$lang.text_recommendation_notes}<br />
<a href="{$link}">{$link}</a><br /><br />
<b>{$lang.notes}:</b><br />
{$send_data.notes|replace:"\n":"<br />"}

{include file="letter_footer.tpl"}