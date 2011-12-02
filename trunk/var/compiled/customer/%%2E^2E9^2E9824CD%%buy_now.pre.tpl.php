<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:18
         compiled from addons/wishlist/hooks/products/buy_now.pre.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>

<?php if (! $__tpl_vars['hide_wishlist_button']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/views/wishlist/components/add_to_wishlist.tpl", 'smarty_include_vars' => array('but_id' => "button_wishlist_".($__tpl_vars['product']['product_id']),'but_name' => "dispatch[wishlist.add..".($__tpl_vars['product']['product_id'])."]",'but_role' => 'text')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php if ($__tpl_vars['buy_now_column_style'] != 'Y'): ?>&nbsp;<?php endif; ?>
<?php endif; ?>