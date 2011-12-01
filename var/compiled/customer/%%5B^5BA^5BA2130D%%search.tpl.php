<?php /* Smarty version 2.6.18, created on 2011-11-30 23:28:04
         compiled from views/products/search.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_products_views', 'views/products/search.tpl', 19, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search_results','advanced_search','products_found','products_found','text_no_matching_products_found'));
?>

<?php if ($__tpl_vars['search']): ?>
	<?php $this->assign('_title', fn_get_lang_var('search_results', $this->getLanguage()), false); ?>
	<?php $this->assign('_collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('_title', fn_get_lang_var('advanced_search', $this->getLanguage()), false); ?>
	<?php $this->assign('_collapse', false, false); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_search_form.tpl", 'smarty_include_vars' => array('dispatch' => "products.search",'collapse' => $__tpl_vars['_collapse'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['search']): ?>
	<div><?php echo fn_get_lang_var('products_found', $this->getLanguage()); ?>
:&nbsp;<strong><?php echo $__tpl_vars['product_count']; ?>
</strong></div>

	<hr />
	<?php if ($__tpl_vars['products']): ?>

	<?php $this->assign('layouts', fn_get_products_views("", false, 0), false); ?>
	<?php if ($__tpl_vars['category_data']['product_columns']): ?>
		<?php $this->assign('product_columns', $__tpl_vars['category_data']['product_columns'], false); ?>
	<?php else: ?>
		<?php $this->assign('product_columns', $__tpl_vars['settings']['Appearance']['columns_in_products_list'], false); ?>
	<?php endif; ?>
	
	<?php if ($__tpl_vars['layouts'][$__tpl_vars['selected_layout']]['template']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['layouts'][$__tpl_vars['selected_layout']]['template']), 'smarty_include_vars' => array('columns' => ($__tpl_vars['product_columns']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>


	<hr />
	<div><?php echo fn_get_lang_var('products_found', $this->getLanguage()); ?>
:&nbsp;<strong><?php echo $__tpl_vars['product_count']; ?>
</strong></div>

	<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('text_no_matching_products_found', $this->getLanguage()); ?>
</p>

	<?php endif; ?>

<?php endif; ?>

<?php ob_start(); ?><?php echo $__tpl_vars['_title']; ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>