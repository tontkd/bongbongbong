<?php /* Smarty version 2.6.18, created on 2011-12-01 22:19:02
         compiled from views/static_data/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/static_data/manage.tpl', 3, false),)), $this); ?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>

<div id="static_data_list">
<?php if ($__tpl_vars['section_data']['multi_level'] == true): ?>
	<div class="items-container multi-level">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/static_data/components/multi_list.tpl", 'smarty_include_vars' => array('items' => $__tpl_vars['static_data'],'header' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php else: ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/static_data/components/single_list.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<!--static_data_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/static_data/update.tpl", 'smarty_include_vars' => array('mode' => 'add','static_data' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_section','text' => fn_get_lang_var($__tpl_vars['section_data']['add_title'], $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var($__tpl_vars['section_data']['add_button'], $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_section','text' => fn_get_lang_var($__tpl_vars['section_data']['add_title'], $this->getLanguage()),'link_text' => fn_get_lang_var($__tpl_vars['section_data']['add_button'], $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var($__tpl_vars['section_data']['mainbox_title'], $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>