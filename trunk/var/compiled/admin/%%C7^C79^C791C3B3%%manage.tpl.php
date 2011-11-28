<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:50
         compiled from views/addons/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/addons/manage.tpl', 3, false),array('modifier', 'fn_get_all_states', 'views/addons/manage.tpl', 8, false),array('modifier', 'escape', 'views/addons/manage.tpl', 14, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('install','uninstall','options','no_items','addons'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>

<script type="text/javascript">
	//<![CDATA[
	<?php $this->assign('states', fn_get_all_states(@CART_LANGUAGE, false, true), false); ?>
	var states = new Array();
	<?php if ($__tpl_vars['states']): ?>
	<?php $_from_990436864 = & $__tpl_vars['states']; if (!is_array($_from_990436864) && !is_object($_from_990436864)) { settype($_from_990436864, 'array'); }if (count($_from_990436864)):
    foreach ($_from_990436864 as $__tpl_vars['country_code'] => $__tpl_vars['country_states']):
?>
	states['<?php echo $__tpl_vars['country_code']; ?>
'] = new Array();
	<?php $_from_2529267374 = & $__tpl_vars['country_states']; if (!is_array($_from_2529267374) && !is_object($_from_2529267374)) { settype($_from_2529267374, 'array'); }$this->_foreach['fs'] = array('total' => count($_from_2529267374), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from_2529267374 as $__tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
	states['<?php echo $__tpl_vars['country_code']; ?>
']['<?php echo smarty_modifier_escape($__tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($__tpl_vars['state']['state'], 'javascript'); ?>
';
	<?php endforeach; endif; unset($_from); ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	//]]>
</script>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>

<div class="items-container" id="addons_list">
<?php $_from_2817080944 = & $__tpl_vars['addons_list']; if (!is_array($_from_2817080944) && !is_object($_from_2817080944)) { settype($_from_2817080944, 'array'); }if (count($_from_2817080944)):
    foreach ($_from_2817080944 as $__tpl_vars['key'] => $__tpl_vars['a']):
?>
	<?php if ($__tpl_vars['a']['status'] == 'N'): ?>
		<?php $this->assign('details', "", false); ?>
		<?php $this->assign('status', "", false); ?>
		<?php $this->assign('act', 'fake', false); ?>
		<?php $this->assign('non_editable', true, false); ?>
		<?php ob_start(); ?>
		<a class="lowercase" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=addons.install&amp;addon=<?php echo $__tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('install', $this->getLanguage()); ?>
</a>
		<?php $this->_smarty_vars['capture']['links'] = ob_get_contents(); ob_end_clean(); ?>
	<?php else: ?>
		<?php $this->assign('details', "", false); ?>
		<?php $this->assign('status', $__tpl_vars['a']['status'], false); ?>
		<?php $this->assign('link_text', "", false); ?>
		<?php if ($__tpl_vars['a']['has_options']): ?>
			<?php $this->assign('act', 'edit', false); ?>
			<?php $this->assign('non_editable', false, false); ?>
		<?php else: ?>
			<?php $this->assign('act', 'fake', false); ?>
			<?php $this->assign('non_editable', true, false); ?>
		<?php endif; ?>
		<?php ob_start(); ?>
		<a class="cm-confirm lowercase" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=addons.uninstall&amp;addon=<?php echo $__tpl_vars['a']['addon']; ?>
"><?php echo fn_get_lang_var('uninstall', $this->getLanguage()); ?>
</a>
		<?php $this->_smarty_vars['capture']['links'] = ob_get_contents(); ob_end_clean(); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['a']['addon'],'text' => $__tpl_vars['a']['name'],'details' => $__tpl_vars['a']['description'],'status_rev' => 'header','update_controller' => 'addons','href' => ($__tpl_vars['index_script'])."?dispatch=addons.update&addon=".($__tpl_vars['a']['addon']),'href_delete' => "",'rev_delete' => 'addons_list','header_text' => ($__tpl_vars['a']['name']).":&nbsp;<span class=\"lowercase\">".(fn_get_lang_var('options', $this->getLanguage()))."</span>",'links' => $this->_smarty_vars['capture']['links'],'non_editable' => $__tpl_vars['non_editable'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--addons_list--></div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('addons', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>