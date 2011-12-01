<?php /* Smarty version 2.6.18, created on 2011-11-30 23:27:57
         compiled from addons/discussion/hooks/categories/view.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('discussion_title_category'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/views/discussion/view.tpl", 'smarty_include_vars' => array('object_id' => $__tpl_vars['category_data']['category_id'],'object_type' => 'C','title' => fn_get_lang_var('discussion_title_category', $this->getLanguage()),'wrap' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>