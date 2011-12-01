<?php /* Smarty version 2.6.18, created on 2011-11-30 23:25:53
         compiled from views/block_manager/specific_settings.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_checkboxes', 'views/block_manager/specific_settings.tpl', 31, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('specific_settings'));
?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['spec_settings']): ?>
<div id="toggle_<?php echo $__tpl_vars['s_set_id']; ?>
">
<div class="specific-settings float-left" id="container_<?php echo $__tpl_vars['s_set_id']; ?>
">
<a id="sw_additional_<?php echo $__tpl_vars['s_set_id']; ?>
" class="cm-combo-on|off cm-combination"><?php echo fn_get_lang_var('specific_settings', $this->getLanguage()); ?>
</a>
<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/section_collapsed.gif" width="7" height="9" border="0" alt="" id="on_additional_<?php echo $__tpl_vars['s_set_id']; ?>
" class="cm-combination" />
<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/section_expanded.gif" width="7" height="9" border="0" alt="" id="off_additional_<?php echo $__tpl_vars['s_set_id']; ?>
" class="cm-combination hidden" />
</div>

<div class="hidden" id="additional_<?php echo $__tpl_vars['s_set_id']; ?>
">
<?php $_from_4052276163 = & $__tpl_vars['spec_settings']; if (!is_array($_from_4052276163) && !is_object($_from_4052276163)) { settype($_from_4052276163, 'array'); }if (count($_from_4052276163)):
    foreach ($_from_4052276163 as $__tpl_vars['set_name'] => $__tpl_vars['_option']):
?>
<div class="form-field">
<label for="spec_<?php echo $__tpl_vars['set_name']; ?>
_<?php echo $__tpl_vars['s_set_id']; ?>
"><?php if ($__tpl_vars['_option']['option_name']): ?><?php echo fn_get_lang_var($__tpl_vars['_option']['option_name'], $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var($__tpl_vars['set_name'], $this->getLanguage()); ?>
<?php endif; ?>:</label>
<?php if ($__tpl_vars['_option']['type'] == 'checkbox'): ?>
	<input type="hidden" name="block[<?php echo $__tpl_vars['set_name']; ?>
]" value="N" />
	<input type="checkbox" class="checkbox" name="block[<?php echo $__tpl_vars['set_name']; ?>
]" value="Y" id="spec_<?php echo $__tpl_vars['set_name']; ?>
_<?php echo $__tpl_vars['s_set_id']; ?>
" <?php if ($__tpl_vars['block']['properties'][$__tpl_vars['set_name']] && $__tpl_vars['block']['properties'][$__tpl_vars['set_name']] == 'Y' || ! $__tpl_vars['block']['properties'][$__tpl_vars['set_name']] && $__tpl_vars['_option']['default_value'] == 'Y'): ?>checked="checked"<?php endif; ?> />
<?php elseif ($__tpl_vars['_option']['type'] == 'selectbox'): ?>
	<select id="spec_<?php echo $__tpl_vars['set_name']; ?>
_<?php echo $__tpl_vars['s_set_id']; ?>
" name="block[<?php echo $__tpl_vars['set_name']; ?>
]">
	<?php $_from_3118284119 = & $__tpl_vars['_option']['values']; if (!is_array($_from_3118284119) && !is_object($_from_3118284119)) { settype($_from_3118284119, 'array'); }if (count($_from_3118284119)):
    foreach ($_from_3118284119 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
		<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['block']['properties'][$__tpl_vars['set_name']] && $__tpl_vars['block']['properties'][$__tpl_vars['set_name']] == $__tpl_vars['k'] || ! $__tpl_vars['block']['properties'][$__tpl_vars['set_name']] && $__tpl_vars['_option']['default_value'] == $__tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php if ($__tpl_vars['_option']['no_lang']): ?><?php echo $__tpl_vars['v']; ?>
<?php else: ?><?php echo fn_get_lang_var($__tpl_vars['v'], $this->getLanguage()); ?>
<?php endif; ?></option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php elseif ($__tpl_vars['_option']['type'] == 'input'): ?>
	<input id="spec_<?php echo $__tpl_vars['set_name']; ?>
_<?php echo $__tpl_vars['s_set_id']; ?>
" class="input-text" name="block[<?php echo $__tpl_vars['set_name']; ?>
]" value="<?php if ($__tpl_vars['block']['properties'][$__tpl_vars['set_name']]): ?><?php echo $__tpl_vars['block']['properties'][$__tpl_vars['set_name']]; ?>
<?php else: ?><?php echo $__tpl_vars['_option']['default_value']; ?>
<?php endif; ?>" />

<?php elseif ($__tpl_vars['_option']['type'] == 'multiple_checkboxes'): ?>

	<?php echo smarty_function_html_checkboxes(array('name' => "block[".($__tpl_vars['set_name'])."]",'options' => $__tpl_vars['_option']['values'],'columns' => 4,'selected' => $__tpl_vars['block']['properties'][$__tpl_vars['set_name']]), $this);?>

<?php endif; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>
<!--toggle_<?php echo $__tpl_vars['s_set_id']; ?>
--></div>
<?php else: ?>
<div id="toggle_<?php echo $__tpl_vars['s_set_id']; ?>
"><!--toggle_<?php echo $__tpl_vars['s_set_id']; ?>
--></div>
<?php endif; ?>
<?php  ob_end_flush();  ?>