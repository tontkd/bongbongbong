<?php /* Smarty version 2.6.18, created on 2011-12-01 22:50:59
         compiled from addons/news_and_emails/views/subscribers/components/picker_opts.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_checkboxes', 'addons/news_and_emails/views/subscribers/components/picker_opts.tpl', 8, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('show_extra_options_section','mailing_lists','format','txt_format','html_format','confirmed','notify_user'));
?>
<?php  ob_start();  ?><a class="cm-combo-on cm-combination" id="sw_picker_options"><?php echo fn_get_lang_var('show_extra_options_section', $this->getLanguage()); ?>
</a>
 <div class="cm-picker-extra-options hidden" id="picker_options">

	<?php if ($__tpl_vars['mailing_lists']): ?>
	<div class="form-field">
		<label><?php echo fn_get_lang_var('mailing_lists', $this->getLanguage()); ?>
:</label>
		<?php echo smarty_function_html_checkboxes(array('name' => 'picker_mailing_list_ids','options' => $__tpl_vars['mailing_lists'],'columns' => '3','selected' => $__tpl_vars['_REQUEST']['list_id']), $this);?>

	</div>
	<?php endif; ?>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('format', $this->getLanguage()); ?>
:</label>
		<select name="picker_mailing_lists[format]">
			<option value="<?php echo @NEWSLETTER_FORMAT_TXT; ?>
"><?php echo fn_get_lang_var('txt_format', $this->getLanguage()); ?>
</option>
			<option value="<?php echo @NEWSLETTER_FORMAT_HTML; ?>
" selected="selected"><?php echo fn_get_lang_var('html_format', $this->getLanguage()); ?>
</option>
		</select>
	</div>
				
	<div class="form-field">			
		<label><?php echo fn_get_lang_var('confirmed', $this->getLanguage()); ?>
:</label>			
		<input type="hidden" name="picker_mailing_lists[confirmed]" value="0" />
		<input type="checkbox" name="picker_mailing_lists[confirmed]" value="1" class="checkbox" />
	</div>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('notify_user', $this->getLanguage()); ?>
:</label>
		<input type="hidden" name="picker_mailing_lists[notify_user]" value="0" />
		<input type="checkbox" name="picker_mailing_lists[notify_user]" value="1" class="checkbox" />
	</div>
</div>
<?php  ob_end_flush();  ?>