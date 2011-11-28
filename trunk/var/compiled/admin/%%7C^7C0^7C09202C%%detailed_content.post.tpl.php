<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from addons/age_verification/hooks/products/detailed_content.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/age_verification/hooks/products/detailed_content.post.tpl', 14, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('age_verification','age_verification','age_limit','years','age_warning_message'));
?>

<fieldset>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('age_verification', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('array_name' => 'product_data', 'record' => $__tpl_vars['product_data'], )); ?>

<div class="form-field">
	<label for="age_verification"><?php echo fn_get_lang_var('age_verification', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="<?php echo $__tpl_vars['array_name']; ?>
[age_verification]" value="N" /><input type="checkbox" id="age_verification" name="<?php echo $__tpl_vars['array_name']; ?>
[age_verification]" value="Y" <?php if ($__tpl_vars['record']['age_verification'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field">
	<label for="age_limit"><?php echo fn_get_lang_var('age_limit', $this->getLanguage()); ?>
:</label>
	<input type="text" id="age_limit" name="<?php echo $__tpl_vars['array_name']; ?>
[age_limit]" size="10" maxlength="2" value="<?php echo smarty_modifier_default(@$__tpl_vars['record']['age_limit'], '0'); ?>
" class="input-text-short" /> <?php echo fn_get_lang_var('years', $this->getLanguage()); ?>

</div>

<div class="form-field">
	<label for="age_warning_message"><?php echo fn_get_lang_var('age_warning_message', $this->getLanguage()); ?>
:</label>
	<textarea id="age_warning_message" name="<?php echo $__tpl_vars['array_name']; ?>
[age_warning_message]" cols="55" rows="4" class="input-textarea-long"><?php echo $__tpl_vars['record']['age_warning_message']; ?>
</textarea>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</fieldset>