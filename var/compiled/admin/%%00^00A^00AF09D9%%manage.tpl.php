<?php /* Smarty version 2.6.18, created on 2011-11-30 23:41:13
         compiled from addons/store_locator/views/store_locator/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/store_locator/views/store_locator/manage.tpl', 3, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('editing_store_location','no_data','new_store_location','add_store_location','new_store_location','add_store_location','store_locator'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/store_locator/pickers/map.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>

<div class="items-container" id="store_locations">
<?php $_from_778657530 = & $__tpl_vars['store_locations']; if (!is_array($_from_778657530) && !is_object($_from_778657530)) { settype($_from_778657530, 'array'); }if (count($_from_778657530)):
    foreach ($_from_778657530 as $__tpl_vars['loc']):
?>
	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/store_locator/views/store_locator/update.tpl", 'smarty_include_vars' => array('loc' => $__tpl_vars['loc'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['edit_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['loc']['store_location_id'],'text' => $__tpl_vars['loc']['name'],'status' => $__tpl_vars['loc']['status'],'href' => "",'object_id_name' => 'store_location_id','table' => 'store_locations','href_delete' => ($__tpl_vars['index_script'])."?dispatch=store_locator.delete&store_location_id=".($__tpl_vars['loc']['store_location_id']),'rev_delete' => 'store_locations','header_text' => (fn_get_lang_var('editing_store_location', $this->getLanguage())).":&nbsp;".($__tpl_vars['loc']['name']),'content' => $this->_smarty_vars['capture']['edit_picker'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--store_locations--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/store_locator/views/store_locator/update.tpl", 'smarty_include_vars' => array('mode' => 'add','loc' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_store_location','text' => fn_get_lang_var('new_store_location', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_store_location', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_store_location','text' => fn_get_lang_var('new_store_location', $this->getLanguage()),'link_text' => fn_get_lang_var('add_store_location', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('store_locator', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>