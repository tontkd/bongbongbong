{* $Id: profile_activated.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.hello}&nbsp;{if $user_data.firstname}{$user_data.firstname}{else}{$user_data.user_type|fn_get_user_type_description|lower}{/if},<br /><br />
{$lang.text_profile_activated}

{include file="letter_footer.tpl"}
