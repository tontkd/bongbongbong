<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:18
         compiled from blocks/locations/products/central.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'block', 'blocks/locations/products/central.tpl', 1, false),)), $this); ?>
<?php  ob_start();  ?><?php echo smarty_function_block(array('content' => true,'wrapper' => "blocks/wrappers/mainbox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 9,'template' => "addons/tags/blocks/tag_cloud.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>
<?php  ob_end_flush();  ?>