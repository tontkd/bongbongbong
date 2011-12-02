<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:16
         compiled from views/categories/components/menu_items.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php $this->assign('foreach_name', "cats_".($__tpl_vars['cid']), false); ?><?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }$this->_foreach[$__tpl_vars['foreach_name']] = array('total' => count($_from_67574462), 'iteration' => 0);
if ($this->_foreach[$__tpl_vars['foreach_name']]['total'] > 0):
    foreach ($_from_67574462 as $__tpl_vars['category']):
        $this->_foreach[$__tpl_vars['foreach_name']]['iteration']++;
?><li <?php if ($__tpl_vars['category']['subcategories']): ?>class="dir"<?php endif; ?>><?php if ($__tpl_vars['category']['subcategories']): ?><ul><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/categories/components/menu_items.tpl", 'smarty_include_vars' => array('items' => $__tpl_vars['category']['subcategories'],'separated' => true,'submenu' => true,'cid' => $__tpl_vars['category']['category_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></ul><?php endif; ?><a href="<?php echo $__tpl_vars['index_script']; ?>?dispatch=categories.view&amp;category_id=<?php echo $__tpl_vars['category']['category_id']; ?>"><?php echo $__tpl_vars['category']['category']; ?></a></li><?php if ($__tpl_vars['separated'] && ! ($this->_foreach[$__tpl_vars['foreach_name']]['iteration'] == $this->_foreach[$__tpl_vars['foreach_name']]['total'])): ?><li class="h-sep">&nbsp;</li><?php endif; ?><?php endforeach; endif; unset($_from); ?>
