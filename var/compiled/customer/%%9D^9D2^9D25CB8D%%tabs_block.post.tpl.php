<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:19
         compiled from addons/discussion/hooks/products/tabs_block.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('discussion_title_product'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/views/discussion/view.tpl", 'smarty_include_vars' => array('object_id' => $__tpl_vars['product']['product_id'],'object_type' => 'P','title' => fn_get_lang_var('discussion_title_product', $this->getLanguage()),'quicklink' => 'disussion_link','no_box' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>