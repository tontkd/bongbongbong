<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:32
         compiled from pickers/search_products_picker.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'pickers/search_products_picker.tpl', 4, false),array('modifier', 'fn_get_views', 'pickers/search_products_picker.tpl', 9, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('any_of','add','or_saved_search'));
?>

<?php if ($__tpl_vars['search']['p_ids']): ?>
	<?php $this->assign('product_ids', explode(",", $__tpl_vars['search']['p_ids']), false); ?>
<?php endif; ?>
<div class="info-line">
	<?php echo fn_get_lang_var('any_of', $this->getLanguage()); ?>
&nbsp;
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/products_picker.tpl", 'smarty_include_vars' => array('data_id' => 'added_products','but_text' => fn_get_lang_var('add', $this->getLanguage()),'item_ids' => $__tpl_vars['product_ids'],'input_name' => 'p_ids','type' => 'links','no_container' => true,'picker_view' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->assign('filters', fn_get_views('products'), false); ?>
	<?php if ($__tpl_vars['filters']): ?>
	<?php echo fn_get_lang_var('or_saved_search', $this->getLanguage()); ?>
:&nbsp;
	<select name="product_filter_id">
		<option value="0">--</option>
		<?php $_from_2701457515 = & $__tpl_vars['filters']; if (!is_array($_from_2701457515) && !is_object($_from_2701457515)) { settype($_from_2701457515, 'array'); }if (count($_from_2701457515)):
    foreach ($_from_2701457515 as $__tpl_vars['f']):
?>
			<option value="<?php echo $__tpl_vars['f']['filter_id']; ?>
" <?php if ($__tpl_vars['search']['product_filter_id'] == $__tpl_vars['f']['filter_id']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['f']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
	<?php endif; ?>
</div>