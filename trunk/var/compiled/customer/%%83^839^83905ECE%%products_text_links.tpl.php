<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:01
         compiled from blocks/products_text_links.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'blocks/products_text_links.tpl', 10, false),array('modifier', 'strip_tags', 'blocks/products_text_links.tpl', 10, false),array('modifier', 'truncate', 'blocks/products_text_links.tpl', 10, false),)), $this); ?>
<?php  ob_start();  ?>
<<?php if ($__tpl_vars['block']['properties']['item_number'] == 'Y'): ?>ol<?php else: ?>ul<?php endif; ?> class="bullets-list">

<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['product']):
?>
<?php $this->assign('obj_id', ($__tpl_vars['block']['block_id'])."000".($__tpl_vars['product']['product_id']), false); ?>
<?php if ($__tpl_vars['product']): ?>
	<li>
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"<?php if ($__tpl_vars['block']['properties']['positions'] == 'left' || $__tpl_vars['block']['properties']['positions'] == 'right'): ?> title="<?php echo $__tpl_vars['product']['product']; ?>
"><?php echo smarty_modifier_truncate(smarty_modifier_strip_tags(smarty_modifier_unescape($__tpl_vars['product']['product'])), 40, "...", true); ?>
<?php else: ?>><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
<?php endif; ?></a>
	</li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

</<?php if ($__tpl_vars['block']['properties']['item_number'] == 'Y'): ?>ol<?php else: ?>ul<?php endif; ?>>
<?php  ob_end_flush();  ?>