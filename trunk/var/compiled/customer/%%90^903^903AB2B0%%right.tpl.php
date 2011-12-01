<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:18
         compiled from blocks/locations/index/right.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'block', 'blocks/locations/index/right.tpl', 1, false),)), $this); ?>
<?php  ob_start();  ?><?php echo smarty_function_block(array('id' => 4,'template' => "addons/banners/blocks/original.tpl",'wrapper' => ""), $this);?>

<?php echo smarty_function_block(array('id' => 5,'template' => "blocks/my_account.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 7,'template' => "addons/news_and_emails/blocks/subscribe.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 8,'template' => "blocks/products_text_links.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>

<?php echo smarty_function_block(array('id' => 10,'template' => "blocks/feature_comparison.tpl",'wrapper' => "blocks/wrappers/sidebox_general.tpl"), $this);?>



<?php  ob_end_flush();  ?>