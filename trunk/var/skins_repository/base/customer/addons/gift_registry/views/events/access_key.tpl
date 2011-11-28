{* $Id: access_key.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

<form action="{$index_script}" method="get" name="event_access_form">

<div class="center">
{$lang.text_enter_access_key}:
<p><input class="input-text" type="text" name="access_key" size="40" value="" /></p>

<p>{include file="buttons/button.tpl" but_text=$lang.submit but_name="dispatch[events.update]"}</p>
</div>
</form>

<hr />

<p class="center">{$lang.text_get_access_key_notice}</p>

<form action="{$index_script}" method="post" name="key_request_form">

<div class="center">
	<p>{$lang.email}:&nbsp;<input class="input-text" type="text" name="email" size="40" value="" /></p>
	<p>{include file="buttons/button.tpl" but_text=$lang.submit but_name="dispatch[events.request_access_key]"}</p>
</div>

</form>

{capture name="mainbox_title"}{$lang.access_key}{/capture}