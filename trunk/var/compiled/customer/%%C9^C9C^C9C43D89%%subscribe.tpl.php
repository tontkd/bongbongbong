<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:18
         compiled from addons/news_and_emails/blocks/subscribe.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'addons/news_and_emails/blocks/subscribe.tpl', 22, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_signup_for_subscriptions','txt_format','html_format','email','enter_email','go'));
?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['mailing_lists']): ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="subscribe_form">
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />

<p><?php echo fn_get_lang_var('text_signup_for_subscriptions', $this->getLanguage()); ?>
</p>
<?php $_from_1568803587 = & $__tpl_vars['mailing_lists']; if (!is_array($_from_1568803587) && !is_object($_from_1568803587)) { settype($_from_1568803587, 'array'); }if (count($_from_1568803587)):
    foreach ($_from_1568803587 as $__tpl_vars['list']):
?>
	<div class="select-field">
		<input id="mailing_list_<?php echo $__tpl_vars['list']['list_id']; ?>
" type="checkbox" class="checkbox" name="mailing_lists[<?php echo $__tpl_vars['list']['list_id']; ?>
]" value="1" />
		<label for="mailing_list_<?php echo $__tpl_vars['list']['list_id']; ?>
"><?php echo $__tpl_vars['list']['object']; ?>
</label>
	</div>
<?php endforeach; endif; unset($_from); ?>
<select name="newsletter_format" id="newsletter_format">
	<option value="<?php echo @NEWSLETTER_FORMAT_TXT; ?>
"><?php echo fn_get_lang_var('txt_format', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @NEWSLETTER_FORMAT_HTML; ?>
"><?php echo fn_get_lang_var('html_format', $this->getLanguage()); ?>
</option>
</select>
<div class="form-field"><label for="subscr_email" class="cm-required cm-email hidden"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?></label><input type="text" name="subscribe_email" id="subscr_email" size="20" value="<?php echo smarty_modifier_escape(fn_get_lang_var('enter_email', $this->getLanguage()), 'html'); ?>" class="input-text cm-hint" /><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "newsletters.add_subscriber", 'alt' => fn_get_lang_var('go', $this->getLanguage()), )); ?><input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>/icons/go.gif" alt="<?php echo $__tpl_vars['alt']; ?>" title="<?php echo $__tpl_vars['alt']; ?>" class="go-button" /><input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>

</form>
<?php endif; ?>
<?php  ob_end_flush();  ?>