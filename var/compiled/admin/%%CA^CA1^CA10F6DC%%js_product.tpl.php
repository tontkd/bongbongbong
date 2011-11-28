<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:32
         compiled from pickers/js_product.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'pickers/js_product.tpl', 5, false),array('modifier', 'is_array', 'pickers/js_product.tpl', 13, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('delete','delete'));
?>

<?php if ($__tpl_vars['type'] == 'options'): ?>
<tr <?php if (! $__tpl_vars['clone']): ?>id="p_<?php echo $__tpl_vars['delete_id']; ?>
" <?php endif; ?>class="cm-js-item<?php if ($__tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
<?php if ($__tpl_vars['position_field']): ?><td><input type="text" name="<?php echo $__tpl_vars['input_name']; ?>
[<?php echo $__tpl_vars['delete_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a*b",'a' => $__tpl_vars['position'],'b' => 10), $this);?>
" size="3" class="input-text-short" <?php if ($__tpl_vars['clone']): ?>disabled="disabled"<?php endif; ?> /></td><?php endif; ?>
<td>
	<ul>
		<li><?php echo $__tpl_vars['product']; ?>
</li>
		<?php if ($__tpl_vars['options']): ?>
		<li><?php echo $__tpl_vars['options']; ?>
</li>
		<?php endif; ?>
	</ul>
	<?php if (is_array($__tpl_vars['options_array'])): ?>
		<?php $_from_593401681 = & $__tpl_vars['options_array']; if (!is_array($_from_593401681) && !is_object($_from_593401681)) { settype($_from_593401681, 'array'); }if (count($_from_593401681)):
    foreach ($_from_593401681 as $__tpl_vars['option_id'] => $__tpl_vars['option']):
?>
		<input type="hidden" name="<?php echo $__tpl_vars['input_name']; ?>
[product_options][<?php echo $__tpl_vars['option_id']; ?>
]" value="<?php echo $__tpl_vars['option']; ?>
"<?php if ($__tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php if ($__tpl_vars['product_id']): ?>
		<input type="hidden" name="<?php echo $__tpl_vars['input_name']; ?>
[product_id]" value="<?php echo $__tpl_vars['product_id']; ?>
"<?php if ($__tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
	<?php endif; ?>
	<?php if ($__tpl_vars['amount_input'] == 'hidden'): ?>
	<input type="hidden" name="<?php echo $__tpl_vars['input_name']; ?>
[amount]" value="<?php echo $__tpl_vars['amount']; ?>
"<?php if ($__tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
	<?php endif; ?>
</td>
	<?php if ($__tpl_vars['amount_input'] == 'text'): ?>
<td>
	<input type="text" name="<?php echo $__tpl_vars['input_name']; ?>
[amount]" value="<?php echo $__tpl_vars['amount']; ?>
" size="3" class="input-text-short"<?php if ($__tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
</td>
	<?php endif; ?>
<td class="nowrap">
	<?php if (! $__tpl_vars['hide_delete_button']): ?>
		<?php ob_start(); ?>
		<li><a onclick="jQuery.delete_js_item('<?php echo $__tpl_vars['root_id']; ?>
', '<?php echo $__tpl_vars['delete_id']; ?>
', 'p'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>&nbsp;<?php endif; ?>
</td>
</tr>

<?php elseif ($__tpl_vars['type'] == 'product'): ?>
	<tr <?php if (! $__tpl_vars['clone']): ?>id="p_<?php echo $__tpl_vars['delete_id']; ?>
" <?php endif; ?>class="cm-js-item<?php if ($__tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
		<?php if ($__tpl_vars['position_field']): ?><td><input type="text" name="<?php echo $__tpl_vars['input_name']; ?>
[<?php echo $__tpl_vars['delete_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a*b",'a' => $__tpl_vars['position'],'b' => 10), $this);?>
" size="3" class="input-text-short" <?php if ($__tpl_vars['clone']): ?>disabled="disabled"<?php endif; ?> /></td><?php endif; ?>
		<td><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.update&amp;product_id=<?php echo $__tpl_vars['delete_id']; ?>
"><?php echo $__tpl_vars['product']; ?>
</a></td>
		<td>&nbsp;</td>
		<td class="nowrap"><?php if (! $__tpl_vars['hide_delete_button']): ?>
			<?php ob_start(); ?>
			<li><a onclick="jQuery.delete_js_item('<?php echo $__tpl_vars['root_id']; ?>
', '<?php echo $__tpl_vars['delete_id']; ?>
', 'p'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => ($__tpl_vars['index_script'])."?dispatch=products.update&product_id=".($__tpl_vars['delete_id']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
<?php endif; ?>