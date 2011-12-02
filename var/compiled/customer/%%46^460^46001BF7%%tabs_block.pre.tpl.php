<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:19
         compiled from addons/required_products/hooks/products/tabs_block.pre.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>

<?php if ($__tpl_vars['product']['required_products']): ?>
<div id="content_required_products">

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_multicolumns.tpl", 'smarty_include_vars' => array('details_page' => true,'no_pagination' => true,'no_sorting' => true,'products' => $__tpl_vars['product']['required_products'],'show_product_status' => 'Y')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>
<?php endif; ?>