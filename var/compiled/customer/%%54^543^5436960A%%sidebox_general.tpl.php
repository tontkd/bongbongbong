<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:18
         compiled from blocks/wrappers/sidebox_general.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'blocks/wrappers/sidebox_general.tpl', 3, false),)), $this); ?>
<?php  ob_start();  ?>
<div class="<?php echo smarty_modifier_default(@$__tpl_vars['sidebox_wrapper'], "sidebox-wrapper"); ?>
 <?php if ($__tpl_vars['hide_wrapper']): ?>hidden cm-hidden-wrapper<?php endif; ?>">
	<h3 class="sidebox-title<?php if ($__tpl_vars['header_class']): ?> <?php echo $__tpl_vars['header_class']; ?>
<?php endif; ?>"><span><?php echo $__tpl_vars['title']; ?>
</span></h3>
	<div class="sidebox-body"><?php echo smarty_modifier_default(@$__tpl_vars['content'], "&nbsp;"); ?>
</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div><?php  ob_end_flush();  ?>