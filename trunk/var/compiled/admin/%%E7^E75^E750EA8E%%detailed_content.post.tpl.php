<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from addons/bestsellers/hooks/products/detailed_content.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/bestsellers/hooks/products/detailed_content.post.tpl', 8, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('bestselling','sales_amount'));
?>

<fieldset>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('bestselling', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="form-field">
		<label for="sales_amount"><?php echo fn_get_lang_var('sales_amount', $this->getLanguage()); ?>
:</label>
		<input type="text" id="sales_amount" name="product_data[sales_amount]" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['sales_amount'], '0'); ?>
" class="input-text" size="10" />
	</div>
</fieldset>