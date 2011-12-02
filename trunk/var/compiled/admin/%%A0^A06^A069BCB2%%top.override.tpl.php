<?php /* Smarty version 2.6.18, created on 2011-12-01 21:45:14
         compiled from addons/statistics/hooks/index/top.override.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/statistics/hooks/index/top.override.tpl', 3, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('users_online'));
?>
<?php  ob_start();  ?>
<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=statistics.visitors&amp;report=online&amp;section=general" class="underlined"><?php echo fn_get_lang_var('users_online', $this->getLanguage()); ?>
:&nbsp;<strong><?php echo smarty_modifier_default(@$__tpl_vars['users_online'], 0); ?>
</strong></a><?php  ob_end_flush();  ?>