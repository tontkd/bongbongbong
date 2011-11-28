{* $Id: recover_password.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.text_confirm_passwd_recovery}:<br /><br />

<a href="{$config.http_location}/{$index_script}?dispatch=auth.recover_password&amp;ekey={$ekey}">{$config.http_location}/{$index_script}?dispatch=auth.recover_password&amp;ekey={$ekey}</a>

{include file="letter_footer.tpl"}