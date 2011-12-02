<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:19
         compiled from addons/tags/hooks/products/tabs_block.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>

<?php if ($__tpl_vars['addons']['tags']['tags_for_products'] == 'Y'): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/views/tags/components/tags.tpl", 'smarty_include_vars' => array('object' => $__tpl_vars['product'],'object_id' => $__tpl_vars['product']['product_id'],'object_type' => 'P')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>