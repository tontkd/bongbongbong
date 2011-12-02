<?php /* Smarty version 2.6.18, created on 2011-12-01 22:11:09
         compiled from views/index/index.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'views/index/index.tpl', 3, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_welcome','welcome'));
?>
<?php  ob_start();  ?>
<?php $this->_tag_stack[] = array('hook', array('name' => "index:index")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php echo fn_get_lang_var('text_welcome', $this->getLanguage()); ?>

<?php ob_start(); ?><?php echo fn_get_lang_var('welcome', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php  ob_end_flush();  ?>