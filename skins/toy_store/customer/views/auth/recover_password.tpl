{* $Id: recover_password.tpl 7165 2009-03-31 12:38:30Z angel $ *}

<div class="login">
<form name="recoverfrm" action="{$index_script}" method="post">

<p>{$lang.text_recover_password_notice}</p>
<div class="center">
	<div class="recover-password">
		<label class="strong" for="login_id">{$lang.email}:</label>
		<p class="break"><input type="text" id="login_id" name="user_email" size="30" value="" class="input-text cm-focus" /></p>
	</div>
	
	<div class="buttons-container">
		{include file="buttons/reset_password.tpl" but_name="dispatch[auth.recover_password]"}
	</div>
</div>
</form>
</div>

{capture name="mainbox_title"}{$lang.recover_password}{/capture}