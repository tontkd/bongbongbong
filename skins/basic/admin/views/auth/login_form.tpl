{* $Id: login_form.tpl 7274 2009-04-15 08:25:03Z angel $ *}

<form action="{$config.current_location}/{$index_script}" method="post" name="main_login_form" class="cm-form-highlight">
<input type="hidden" name="return_url" value="{$smarty.request.return_url|default:$index_script}" />

<span class="right"><span>&nbsp;</span></span>
<h1 class="clear">
	<a href="{$index_script}" class="float-left"><img src="{$images_dir}/{$manifest.Signin_logo.filename}" width="{$manifest.Signin_logo.width}" height="{$manifest.Signin_logo.height}" border="0" alt="{$settings.Company.company_name}" title="{$settings.Company.company_name}" /></a>
	<span>{$lang.administration_panel}</span>
</h1>

<div class="login-content">
	<p><label for="username" class="cm-required">{if $settings.General.use_email_as_login == "Y"}{$lang.email}{else}{$lang.username}{/if}:</label></p>
	<input id="username" type="text" name="user_login" size="20" value="{$config.demo_username}" class="input-text cm-focus" tabindex="1" />
	<p><label for="password">{$lang.password}:</label></p>
	<input type="password" id="password" name="password" size="20" value="{$config.demo_password}" class="input-text" tabindex="2" />
	<div class="buttons-container nowrap right">
		<div class="float-left">
			<a href="{$index_script}?dispatch=auth.recover_password" class="underlined">{$lang.forgot_password_question}</a>&nbsp;&nbsp;
		</div>
		
		{include file="buttons/sign_in.tpl" but_name="dispatch[auth.login]" but_role="button_main" tabindex="3"}
	</div>
</div>
</form>
