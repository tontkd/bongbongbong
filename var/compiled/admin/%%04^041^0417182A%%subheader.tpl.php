<?php /* Smarty version 2.6.18, created on 2011-12-01 21:45:16
         compiled from common_templates/subheader.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'common_templates/subheader.tpl', 3, false),)), $this); ?>

<h2 class="<?php echo smarty_modifier_default(@$__tpl_vars['subheader_class'], 'subheader'); ?>
">
	<?php if ($__tpl_vars['mode'] == 'translate'): ?>
		<input class="input-text" type="text" name="translate_elm[<?php echo $__tpl_vars['translate_elm_id']; ?>
]" value="<?php echo $__tpl_vars['item']['description']; ?>
" />
	<?php else: ?>
		<?php if ($__tpl_vars['notes']): ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/help.tpl", 'smarty_include_vars' => array('content' => $__tpl_vars['notes'],'id' => $__tpl_vars['notes_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<?php echo $__tpl_vars['title']; ?>

	<?php endif; ?>
</h2>