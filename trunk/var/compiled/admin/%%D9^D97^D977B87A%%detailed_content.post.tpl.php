<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from addons/discussion/hooks/products/detailed_content.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_discussion', 'addons/discussion/hooks/products/detailed_content.post.tpl', 9, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('comments_and_reviews','discussion_title_product','communication','and','rating','communication','rating','disabled'));
?>

<fieldset>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('comments_and_reviews', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => 'product_data', 'object_id' => $__tpl_vars['product_data']['product_id'], 'object_type' => 'P', 'title' => fn_get_lang_var('discussion_title_product', $this->getLanguage()), )); ?>

<div class="form-field">
	<label for="discussion_type"><?php echo $__tpl_vars['title']; ?>
:</label>
	<?php $this->assign('discussion', fn_get_discussion($__tpl_vars['object_id'], $__tpl_vars['object_type']), false); ?>
	<select name="<?php echo $__tpl_vars['prefix']; ?>
[discussion_type]" id="discussion_type">
		<option <?php if ($__tpl_vars['discussion']['type'] == 'B'): ?>selected="selected"<?php endif; ?> value="B"><?php echo fn_get_lang_var('communication', $this->getLanguage()); ?>
 <?php echo fn_get_lang_var('and', $this->getLanguage()); ?>
 <?php echo fn_get_lang_var('rating', $this->getLanguage()); ?>
</option>
		<option <?php if ($__tpl_vars['discussion']['type'] == 'C'): ?>selected="selected"<?php endif; ?> value="C"><?php echo fn_get_lang_var('communication', $this->getLanguage()); ?>
</option>
		<option <?php if ($__tpl_vars['discussion']['type'] == 'R'): ?>selected="selected"<?php endif; ?> value="R"><?php echo fn_get_lang_var('rating', $this->getLanguage()); ?>
</option>
		<option <?php if ($__tpl_vars['discussion']['type'] == 'D' || ! $__tpl_vars['discussion']): ?>selected="selected"<?php endif; ?> value="D"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
	</select>
</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</fieldset>