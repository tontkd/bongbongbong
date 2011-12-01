<?php /* Smarty version 2.6.18, created on 2011-11-30 23:27:16
         compiled from blocks/products_multicolumns_small.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'blocks/products_multicolumns_small.tpl', 4, false),)), $this); ?>

<?php echo smarty_function_script(array('src' => "js/exceptions.js"), $this);?>


<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_small_list.tpl", 'smarty_include_vars' => array('products' => $__tpl_vars['items'],'columns' => $__tpl_vars['block']['properties']['number_of_columns'],'form_prefix' => 'block_manager','no_sorting' => 'Y','no_pagination' => 'Y','hide_add_to_cart_button' => $__tpl_vars['block']['properties']['hide_add_to_cart_button'],'obj_prefix' => ($__tpl_vars['block']['block_id'])."000",'item_number' => $__tpl_vars['block']['properties']['item_number'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>