<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:07
         compiled from common_templates/file_browser_dirs.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'common_templates/file_browser_dirs.tpl', 6, false),)), $this); ?>

<ul class="cm-filetree">
<?php $_from_1741956718 = & $__tpl_vars['file_list']; if (!is_array($_from_1741956718) && !is_object($_from_1741956718)) { settype($_from_1741956718, 'array'); }if (count($_from_1741956718)):
    foreach ($_from_1741956718 as $__tpl_vars['file']):
?>
	<?php if ($__tpl_vars['file']['ext']): ?>
		<li class="file ext_<?php echo $__tpl_vars['file']['ext']; ?>
" ondblclick="fileuploader.set_file('<?php echo smarty_modifier_escape($__tpl_vars['current_dir'], 'javascript'); ?>
<?php echo smarty_modifier_escape($__tpl_vars['file']['file'], 'javascript'); ?>
', false);"><a rel="<?php echo $__tpl_vars['current_dir']; ?>
<?php echo $__tpl_vars['file']['file']; ?>
"><?php echo $__tpl_vars['file']['file']; ?>
</a></li>
	<?php else: ?>
		<?php if ($__tpl_vars['file']['next']): ?>
			<li class="directory cm-expanded"><a rel="<?php echo $__tpl_vars['current_dir']; ?>
<?php echo $__tpl_vars['file']['file']; ?>
/"><?php echo $__tpl_vars['file']['file']; ?>
</a>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser_dirs.tpl", 'smarty_include_vars' => array('file_list' => $__tpl_vars['file']['next'],'current_dir' => ($__tpl_vars['current_dir']).($__tpl_vars['file']['file'])."/")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></li>
		<?php else: ?>
			<li class="directory cm-collapsed"><a rel="<?php echo $__tpl_vars['current_dir']; ?>
<?php echo $__tpl_vars['file']['file']; ?>
/"><?php echo $__tpl_vars['file']['file']; ?>
</a></li>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>