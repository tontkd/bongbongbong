{* $Id: activate_profile.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.hello},<br /><br />
{$lang.text_new_user_activation|replace:"[user_login]":$user_data.user_login|replace:"[url]":"<a href=\"`$config.http_location`/`$config.admin_index`?dispatch=profiles.update&amp;user_id=`$user_data.user_id`\">`$config.http_location`/`$config.admin_index`?dispatch=profiles.update&user_id=`$user_data.user_id`</a>"}

{include file="letter_footer.tpl" user_type='A'}
