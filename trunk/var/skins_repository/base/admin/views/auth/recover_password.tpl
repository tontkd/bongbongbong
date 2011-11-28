{* $Id: recover_password.tpl 7274 2009-04-15 08:25:03Z angel $ *}

<form action="{$index_script}" method="post" name="recover_form" class="cm-form-highlight">

<span class="right"><span>&nbsp;</span></span>
<h1 class="clear">
	<a href="{$index_script}" class="float-left"><img src="{$images_dir}/{$manifest.Signin_logo.filename}" width="{$manifest.Signin_logo.width}" height="{$manifest.Signin_logo.height}" border="0" alt="{$settings.Company.company_name}" title="{$settings.Company.company_name}" /></a>
	<span>{$lang.recover_password}</span>
</h1>

<div class="login-content">
	<p>{$lang.text_recover_password_notice}</p>
	<p><label for="user_login">{$lang.email}:&nbsp;</label></p>
	<input type="text" name="user_email" id="user_login" size="20" value="" class="input-text cm-focus" />

	<div class="buttons-container center">
		{include file="buttons/button.tpl" but_text=$lang.reset_password but_name="dispatch[auth.recover_password]" but_role="button_main"}
	</div>
</div>
</form>
