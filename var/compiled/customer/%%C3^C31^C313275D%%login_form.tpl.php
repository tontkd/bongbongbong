<?php /* Smarty version 2.6.18, created on 2011-12-04 07:11:25
         compiled from views/auth/login_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/auth/login_form.tpl', 3, false),array('modifier', 'fn_needs_image_verification', 'views/auth/login_form.tpl', 23, false),array('modifier', 'uniqid', 'views/auth/login_form.tpl', 28, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('email','username','password','image_verification_body','remember_me','forgot_password_question','sign_in'));
?>

<?php $this->assign('form_name', smarty_modifier_default(@$__tpl_vars['form_name'], 'main_login_form'), false); ?>

<?php ob_start(); ?>
<form name="<?php echo $__tpl_vars['form_name']; ?>
" action="<?php echo $__tpl_vars['index_script']; ?>
" method="post">
<input type="hidden" name="form_name" value="<?php echo $__tpl_vars['form_name']; ?>
" />
<input type="hidden" name="return_url" value="<?php echo smarty_modifier_default(@$__tpl_vars['_REQUEST']['return_url'], @$__tpl_vars['config']['current_url']); ?>
" />
<br /><br /><br /><br /><br /><br /><br /><br />
<div class="form-field">
<!-- <label for="login_<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?>class="cm-email"<?php endif; ?>><?php if ($__tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
<?php endif; ?>:</label> -->
	<center><input type="text" id="login_text" name="user_login" size="10" value="<?php echo $__tpl_vars['config']['demo_username']; ?>
" class="input-text cm-focus" /></center>
</div>
<br /><br />
<div class="form-field">
	<!-- <label for="psw_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('password', $this->getLanguage()); ?>
:</label> -->
	<center><input type="password" id="psw_text" name="password" size="10" value="<?php echo $__tpl_vars['config']['demo_password']; ?>
" class="input-text password" /></center>
</div>
<center>
<?php if ($__tpl_vars['settings']['Image_verification']['use_for_login'] == 'Y'): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => "login_".($__tpl_vars['form_name']), 'align' => 'left', )); ?>

<?php if (fn_needs_image_verification("") == true): ?>

<p<?php if ($__tpl_vars['align']): ?> class="<?php echo $__tpl_vars['align']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('image_verification_body', $this->getLanguage()); ?>
</p>

<?php if ($__tpl_vars['sidebox']): ?>
	<p><img id="verification_image_<?php echo $__tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo $__tpl_vars['config']['current_location']; ?>
/<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.captcha&amp;verification_id=<?php echo $__tpl_vars['SESS_ID']; ?>
:<?php echo $__tpl_vars['id']; ?>
&amp;<?php echo uniqid($__tpl_vars['id']); ?>
&amp;" alt="" onclick="this.src += 'reload' ;" /></p>
<?php endif; ?>

<p><input class="captcha-input-text valign" type="text" name="verification_answer" value= "" />
	<?php if (! $__tpl_vars['sidebox']): ?>
	<img id="verification_image_<?php echo $__tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo $__tpl_vars['config']['current_location']; ?>
/<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.captcha&amp;verification_id=<?php echo $__tpl_vars['SESS_ID']; ?>
:<?php echo $__tpl_vars['id']; ?>
&amp;<?php echo uniqid($__tpl_vars['id']); ?>
&amp;" alt="" onclick="this.src += 'reload' ;" />
	<?php endif; ?></p>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>
</center>
<div class="clear">
	<div class="float-left">
		<input class="valign checkbox" type="checkbox" name="remember_me" id="remember_me_<?php echo $__tpl_vars['id']; ?>
" value="Y" />
		<label for="remember_me_<?php echo $__tpl_vars['id']; ?>
" class="valign lowercase"><?php echo fn_get_lang_var('remember_me', $this->getLanguage()); ?>
</label>
	</div>

	<div class="float-right">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/login.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[auth.login]",'but_role' => 'action')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

<p class="center"><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=auth.recover_password" class="underlined"><?php echo fn_get_lang_var('forgot_password_question', $this->getLanguage()); ?>
</a></p>
</form>
<?php $this->_smarty_vars['capture']['login'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($__tpl_vars['style'] == 'popup'): ?>
	<?php echo $this->_smarty_vars['capture']['login']; ?>

<?php else: ?>
	<div class="login">
		<?php echo $this->_smarty_vars['capture']['login']; ?>

	</div>

	<?php ob_start(); ?><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>