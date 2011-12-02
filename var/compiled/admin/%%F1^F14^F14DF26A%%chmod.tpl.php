<?php /* Smarty version 2.6.18, created on 2011-12-01 22:48:40
         compiled from views/template_editor/components/chmod.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('owner','group','world','recursively'));
?>

<div id="template_editor_perms">
	<div class="object-container" align="center">
		<table cellspacing="1" class="center">
		<tr>
			<td class="manage-row" colspan="3" ><?php echo fn_get_lang_var('owner', $this->getLanguage()); ?>
</td>
			<td colspan="3" ><?php echo fn_get_lang_var('group', $this->getLanguage()); ?>
</td>
			<td class="manage-row" colspan="3" ><?php echo fn_get_lang_var('world', $this->getLanguage()); ?>
</td>
		</tr>
		<tr>
			<td><strong>r</strong></td>
			<td><strong>w</strong></td>
			<td><strong>x</strong></td>
		
			<td class="manage-row"><strong>r</strong></td>
			<td class="manage-row"><strong>w</strong></td>
			<td class="manage-row"><strong>x</strong></td>
		
			<td><strong>r</strong></td>
			<td><strong>w</strong></td>
			<td><strong>x</strong></td>
		</tr>
		
		<tr>
			<td><input id="o_read" type="checkbox" name="o_read" /></td>
			<td><input id="o_write" type="checkbox" name="o_write" /></td>
			<td><input id="o_exec" type="checkbox" name="o_exec" /></td>
		
			<td><input id="g_read" type="checkbox" name="g_read" /></td>
			<td><input id="g_write" type="checkbox" name="g_write" /></td>
			<td><input id="g_exec" type="checkbox" name="g_exec" /></td>
		
			<td><input id="w_read" type="checkbox" name="w_read" /></td>
			<td><input id="w_write" type="checkbox" name="w_write" /></td>
			<td><input id="w_exec" type="checkbox" name="w_exec" /></td>
		</tr>
		</table>
		
		<div class="center">
			<label for="chmod_recursive"><?php echo fn_get_lang_var('recursively', $this->getLanguage()); ?>
:</label> <input id="chmod_recursive" type="checkbox" name="r" value="Y" />
		</div>
	</div>
	
	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_type' => 'button','but_onclick' => "template_editor.set_perms()",'but_meta' => "cm-popup-switch",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>