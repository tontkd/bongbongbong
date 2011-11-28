<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:21
         compiled from views/memberships/privileges.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'views/memberships/privileges.tpl', 22, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','privilege','description','translate_privileges'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="privileges_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><?php echo fn_get_lang_var('privilege', $this->getLanguage()); ?>
</th>
	<th width="100%" class="center"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</th>
	</tr>			 

<?php $_from_2279827703 = & $__tpl_vars['privileges']; if (!is_array($_from_2279827703) && !is_object($_from_2279827703)) { settype($_from_2279827703, 'array'); }if (count($_from_2279827703)):
    foreach ($_from_2279827703 as $__tpl_vars['section'] => $__tpl_vars['privilege']):
?>
<tr>
	<td colspan="3"><input size="25" type="text" class="input-text-long" name="section_name[<?php echo $__tpl_vars['section']; ?>
]" value="<?php echo $__tpl_vars['section']; ?>
" /></td>
</tr>

<?php $_from_2326156696 = & $__tpl_vars['privilege']; if (!is_array($_from_2326156696) && !is_object($_from_2326156696)) { settype($_from_2326156696, 'array'); }if (count($_from_2326156696)):
    foreach ($_from_2326156696 as $__tpl_vars['p']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td width="1%">
		<?php if ($__tpl_vars['p']['is_default'] == 'Y'): ?>&nbsp;<?php else: ?><input type="checkbox" name="delete[<?php echo $__tpl_vars['p']['privilege']; ?>
]" id="delete_checkbox" class="checkbox cm-item" value="Y" /><?php endif; ?></td>
	<td><?php echo $__tpl_vars['p']['privilege']; ?>
</td>
	<td><input type="text" class="input-text" size="35" name="privilege_descr[<?php echo $__tpl_vars['p']['privilege']; ?>
]" value="<?php echo $__tpl_vars['p']['description']; ?>
" /></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
</table>

<div class="buttons-container buttons-bg">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[memberships.privileges.update]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

</form>


<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('translate_privileges', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>