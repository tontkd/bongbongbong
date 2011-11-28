<?php /* Smarty version 2.6.18, created on 2011-11-28 13:22:51
         compiled from blocks/locations/categories/left.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'block', 'blocks/locations/categories/left.tpl', 1, false),)), $this); ?>
<?php  ob_start();  ?><?php echo smarty_function_block(array('id' => 1,'template' => "blocks/categories_emenu.tpl",'wrapper' => "blocks/wrappers/sidebox_important.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 15,'template' => "blocks/product_filters.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 2,'template' => "blocks/pages_dynamic.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 3,'template' => "blocks/products_text_links.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 12,'template' => "addons/tags/blocks/user_tag_cloud.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 17,'template' => "addons/gift_registry/blocks/giftregistry.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>
<?php  ob_end_flush();  ?>