<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:19
         compiled from views/products/components/product_features.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'views/products/components/product_features.tpl', 1, false),array('modifier', 'trim', 'views/products/components/product_features.tpl', 6, false),array('modifier', 'date_format', 'views/products/components/product_features.tpl', 14, false),array('modifier', 'default', 'views/products/components/product_features.tpl', 26, false),)), $this); ?>

<?php $_from_761673165 = & $__tpl_vars['product_features']; if (!is_array($_from_761673165) && !is_object($_from_761673165)) { settype($_from_761673165, 'array'); }if (count($_from_761673165)):
    foreach ($_from_761673165 as $__tpl_vars['feature']):
?>
	<?php if ($__tpl_vars['feature']['feature_type'] != 'G'): ?>
		<div class="form-field">
		<?php if (trim($__tpl_vars['feature']['full_description'])): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/help.tpl", 'smarty_include_vars' => array('text' => $__tpl_vars['feature']['description'],'content' => smarty_modifier_unescape($__tpl_vars['feature']['full_description']),'id' => $__tpl_vars['feature']['feature_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
		<label><strong><?php echo smarty_modifier_unescape($__tpl_vars['feature']['description']); ?>
</strong>:</label>

		<?php if ($__tpl_vars['feature']['prefix']): ?><?php echo $__tpl_vars['feature']['prefix']; ?><?php endif; ?><?php if ($__tpl_vars['feature']['feature_type'] == 'C'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/checkbox_<?php if ($__tpl_vars['feature']['value'] == 'N'): ?>un<?php endif; ?>ticked.gif" width="13" height="13" alt="<?php echo $__tpl_vars['feature']['value']; ?>" align="top" /><?php elseif ($__tpl_vars['feature']['feature_type'] == 'D'): ?><?php echo smarty_modifier_date_format($__tpl_vars['feature']['value_int'], ($__tpl_vars['settings']['Appearance']['date_format'])); ?><?php elseif ($__tpl_vars['feature']['feature_type'] == 'M' && $__tpl_vars['feature']['variants']): ?><ul class="no-markers"><?php $_from_1156591881 = & $__tpl_vars['feature']['variants']; if (!is_array($_from_1156591881) && !is_object($_from_1156591881)) { settype($_from_1156591881, 'array'); }if (count($_from_1156591881)):
    foreach ($_from_1156591881 as $__tpl_vars['var']):
?><?php if ($__tpl_vars['var']['selected']): ?><li><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/checkbox_ticked.gif" width="13" height="13" alt="<?php echo $__tpl_vars['var']['variant']; ?>" />&nbsp;<?php echo $__tpl_vars['var']['variant']; ?></li><?php endif; ?><?php endforeach; endif; unset($_from); ?></ul><?php elseif ($__tpl_vars['feature']['feature_type'] == 'S' || $__tpl_vars['feature']['feature_type'] == 'E'): ?><?php $_from_1156591881 = & $__tpl_vars['feature']['variants']; if (!is_array($_from_1156591881) && !is_object($_from_1156591881)) { settype($_from_1156591881, 'array'); }if (count($_from_1156591881)):
    foreach ($_from_1156591881 as $__tpl_vars['var']):
?><?php if ($__tpl_vars['var']['selected']): ?><?php echo $__tpl_vars['var']['variant']; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php elseif ($__tpl_vars['feature']['feature_type'] == 'N' || $__tpl_vars['feature']['feature_type'] == 'O'): ?><?php echo smarty_modifier_default(@$__tpl_vars['feature']['value_int'], "-"); ?><?php else: ?><?php echo smarty_modifier_default(@$__tpl_vars['feature']['value'], "-"); ?><?php endif; ?><?php if ($__tpl_vars['feature']['suffix']): ?><?php echo $__tpl_vars['feature']['suffix']; ?><?php endif; ?>

		</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from_761673165 = & $__tpl_vars['product_features']; if (!is_array($_from_761673165) && !is_object($_from_761673165)) { settype($_from_761673165, 'array'); }if (count($_from_761673165)):
    foreach ($_from_761673165 as $__tpl_vars['feature']):
?>
	<?php if ($__tpl_vars['feature']['feature_type'] == 'G' && $__tpl_vars['feature']['subfeatures']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['feature']['description'],'notes' => smarty_modifier_unescape($__tpl_vars['feature']['full_description']),'notes_id' => $__tpl_vars['feature']['feature_id'],'text' => $__tpl_vars['feature']['description'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_features.tpl", 'smarty_include_vars' => array('product_features' => $__tpl_vars['feature']['subfeatures'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>