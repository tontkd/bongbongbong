<?php /* Smarty version 2.6.18, created on 2011-12-01 22:56:56
         compiled from blocks/locations/index/left.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'block', 'blocks/locations/index/left.tpl', 1, false),)), $this); ?>
<?php  ob_start();  ?><?php echo smarty_function_block(array('id' => 1,'template' => "blocks/categories_emenu.tpl",'wrapper' => "blocks/wrappers/sidebox_important.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 15,'template' => "blocks/product_filters_extended.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 12,'template' => "addons/tags/blocks/user_tag_cloud.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 17,'template' => "addons/gift_registry/blocks/giftregistry.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 22,'template' => "addons/discussion/blocks/testimonials.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>
<?php  ob_end_flush();  ?>