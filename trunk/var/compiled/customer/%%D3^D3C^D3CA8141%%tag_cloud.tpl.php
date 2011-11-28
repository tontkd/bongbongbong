<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:03
         compiled from addons/tags/blocks/tag_cloud.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'addons/tags/blocks/tag_cloud.tpl', 6, false),)), $this); ?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['items']): ?>
<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['tag']):
?>
	<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tags.view&amp;tag=<?php echo smarty_modifier_escape($__tpl_vars['tag']['tag'], 'url'); ?>
" class="tag-level-<?php echo $__tpl_vars['tag']['level']; ?>
"><?php echo $__tpl_vars['tag']['tag']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?><?php  ob_end_flush();  ?>