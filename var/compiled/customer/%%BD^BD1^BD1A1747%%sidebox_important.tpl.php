<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:01
         compiled from blocks/wrappers/sidebox_important.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'blocks/wrappers/sidebox_important.tpl', 5, false),)), $this); ?>
<?php  ob_start();  ?>
<div class="sidebox-categories-wrapper <?php if ($__tpl_vars['hide_wrapper']): ?>hidden cm-hidden-wrapper<?php endif; ?>">
	<h3 class="sidebox-title<?php if ($__tpl_vars['header_class']): ?> <?php echo $__tpl_vars['header_class']; ?>
<?php endif; ?>"><span><?php echo $__tpl_vars['title']; ?>
</span></h3>
	<div class="sidebox-body"><?php echo smarty_modifier_default(@$__tpl_vars['content'], "&nbsp;"); ?>
</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div><?php  ob_end_flush();  ?>