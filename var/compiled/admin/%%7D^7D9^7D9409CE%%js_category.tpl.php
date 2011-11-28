<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from pickers/js_category.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_category_name', 'pickers/js_category.tpl', 4, false),array('modifier', 'default', 'pickers/js_category.tpl', 4, false),array('function', 'math', 'pickers/js_category.tpl', 10, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('delete'));
?>

<?php if ($__tpl_vars['category_id']): ?>
	<?php $this->assign('category', smarty_modifier_default(fn_get_category_name($__tpl_vars['category_id']), ($__tpl_vars['ldelim'])."category".($__tpl_vars['rdelim'])), false); ?>
<?php else: ?>
	<?php $this->assign('category', $__tpl_vars['default_name'], false); ?>
<?php endif; ?>
<?php if ($__tpl_vars['multiple']): ?>
	<tr <?php if (! $__tpl_vars['clone']): ?>id="<?php echo $__tpl_vars['holder']; ?>
_<?php echo $__tpl_vars['category_id']; ?>
" <?php endif; ?>class="cm-js-item <?php if ($__tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
		<?php if ($__tpl_vars['position_field']): ?><td><input type="text" name="<?php echo $__tpl_vars['input_name']; ?>
[<?php echo $__tpl_vars['category_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a*b",'a' => $__tpl_vars['position'],'b' => 10), $this);?>
" size="3" class="input-text-short"<?php if ($__tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> /></td><?php endif; ?>
		<td><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=categories.update&amp;category_id=<?php echo $__tpl_vars['category_id']; ?>
"><?php echo $__tpl_vars['category']; ?>
</a></td>
		<td class="nowrap">
		<?php if (! $__tpl_vars['hide_delete_button'] && ! $__tpl_vars['view_only']): ?>
		<?php ob_start(); ?>
			<li><a onclick="jQuery.delete_js_item('<?php echo $__tpl_vars['holder']; ?>
', '<?php echo $__tpl_vars['category_id']; ?>
', 'c'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => ($__tpl_vars['index_script'])."?dispatch=categories.update&category_id=".($__tpl_vars['category_id']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>&nbsp;
		<?php endif; ?>
		</td>
	</tr>
<?php else: ?>
	<<?php if ($__tpl_vars['single_line']): ?>span<?php else: ?>p<?php endif; ?> <?php if (! $__tpl_vars['clone']): ?>id="<?php echo $__tpl_vars['holder']; ?>
_<?php echo $__tpl_vars['category_id']; ?>
" <?php endif; ?>class="cm-js-item no-margin<?php if ($__tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
	<?php if (! $__tpl_vars['first_item'] && $__tpl_vars['single_line']): ?><span class="cm-comma<?php if ($__tpl_vars['clone']): ?> hidden<?php endif; ?>">,&nbsp;&nbsp;</span><?php endif; ?>
	<input class="input-text-medium cm-picker-value-description<?php echo $__tpl_vars['extra_class']; ?>
" type="text" value="<?php echo $__tpl_vars['category']; ?>
" <?php if ($__tpl_vars['display_input_id']): ?>id="<?php echo $__tpl_vars['display_input_id']; ?>
"<?php endif; ?> size="10" name="category_name" readonly="readonly" <?php echo $__tpl_vars['extra']; ?>
 />
	</<?php if ($__tpl_vars['single_line']): ?>span<?php else: ?>p<?php endif; ?>>
<?php endif; ?>