<?php /* Smarty version 2.6.18, created on 2011-11-30 23:28:04
         compiled from common_templates/subheader.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'common_templates/subheader.tpl', 5, false),array('modifier', 'trim', 'common_templates/subheader.tpl', 6, false),)), $this); ?>
<?php if ($__tpl_vars['anchor']): ?>
<a name="<?php echo $__tpl_vars['anchor']; ?>
"></a>
<?php endif; ?>
<h2 class="<?php echo smarty_modifier_default(@$__tpl_vars['class'], 'subheader'); ?>
">
	<?php if (trim($__tpl_vars['notes'])): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/help.tpl", 'smarty_include_vars' => array('content' => $__tpl_vars['notes'],'id' => $__tpl_vars['notes_id'],'text' => $__tpl_vars['text'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php echo $__tpl_vars['title']; ?>

</h2>