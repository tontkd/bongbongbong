<?php /* Smarty version 2.6.18, created on 2011-12-01 22:07:30
         compiled from views/block_manager/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/block_manager/update.tpl', 2, false),array('modifier', 'to_json', 'views/block_manager/update.tpl', 21, false),array('function', 'html_checkboxes', 'views/block_manager/update.tpl', 88, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','block_content','list_objects','standard_sidebox','specific_settings','filling','specific_settings','position','appearance_type','specific_settings','wrapper'));
?>
<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['block']['block_id'], '0'), false); ?>
<div id="content_group<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['location']; ?>
">
<?php if (! $__tpl_vars['add_block']): ?>
<input type="hidden" value="<?php echo $__tpl_vars['_REQUEST']['position']; ?>
" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_positions" />
<?php endif; ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" class="cm-form-highlight" name="block_<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_update_form">
<?php $this->assign('js_param', 'false', false); ?>
<?php if ($__tpl_vars['add_block']): ?>
	<?php $this->assign('js_param', 'true', false); ?>
	<input type="hidden" name="add_selected_section" id="add_selected_section" value="<?php echo smarty_modifier_default(@$__tpl_vars['location'], 'all_pages'); ?>
" />
<?php else: ?>
	<input type="hidden" name="block[block_id]" value="<?php echo $__tpl_vars['id']; ?>
" />
	<input type="hidden" name="block_location" value="<?php echo $__tpl_vars['block']['location']; ?>
" />
	<input type="hidden" name="redirect_location" value="<?php echo $__tpl_vars['location']; ?>
" />
	<input type="hidden" name="block[location]" value="<?php echo $__tpl_vars['block']['location']; ?>
" />
	<input type="hidden" name="block[positions]" value="<?php echo $__tpl_vars['_REQUEST']['position']; ?>
" />

	<script type="text/javascript">
	//<![CDATA[
	block_properties['<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_'] = <?php echo smarty_modifier_to_json($__tpl_vars['block']['properties']); ?>
;
	block_location['<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_'] = '<?php echo $__tpl_vars['block']['location']; ?>
';
	block_properties_used['<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_'] = false;
	//]]>
	</script>
<?php endif; ?>
<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_new_block" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
	<fieldset>
		<?php if ($__tpl_vars['id'] != 'central'): ?>
		<div class="form-field">
			<label for="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_block_name" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="block[block]" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_block_name" size="25" value="<?php echo $__tpl_vars['block']['block']; ?>
" class="input-text main-input" />
		</div>

		<div class="form-field float-left">
			<label for="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_block_object"><?php echo fn_get_lang_var('block_content', $this->getLanguage()); ?>
:</label>
			<select name="block[list_object]" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_block_object" onchange="fn_check_block_params(<?php echo $__tpl_vars['js_param']; ?>
, '<?php echo $__tpl_vars['location']; ?>
', <?php echo $__tpl_vars['id']; ?>
, this); fn_get_specific_settings(this.value, <?php echo $__tpl_vars['id']; ?>
, 'list_object');">
			<optgroup label="<?php echo fn_get_lang_var('list_objects', $this->getLanguage()); ?>
">
				<?php $_from_3174284801 = & $__tpl_vars['block_settings']['dynamic']; if (!is_array($_from_3174284801) && !is_object($_from_3174284801)) { settype($_from_3174284801, 'array'); }if (count($_from_3174284801)):
    foreach ($_from_3174284801 as $__tpl_vars['object_name'] => $__tpl_vars['listed_block']):
?>
					<option value="<?php echo $__tpl_vars['object_name']; ?>
" <?php if ($__tpl_vars['block']['properties']['list_object'] == $__tpl_vars['object_name']): ?>selected="selected"<?php endif; ?>><?php if ($__tpl_vars['listed_block']['object_description']): ?><?php echo fn_get_lang_var($__tpl_vars['listed_block']['object_description'], $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var($__tpl_vars['object_name'], $this->getLanguage()); ?>
<?php endif; ?></option>
				<?php endforeach; endif; unset($_from); ?>
			</optgroup>
			<optgroup label="<?php echo fn_get_lang_var('standard_sidebox', $this->getLanguage()); ?>
">
				<?php $_from_1776918268 = & $__tpl_vars['block_settings']['static']; if (!is_array($_from_1776918268) && !is_object($_from_1776918268)) { settype($_from_1776918268, 'array'); }if (count($_from_1776918268)):
    foreach ($_from_1776918268 as $__tpl_vars['static_block']):
?>
					<option value="<?php echo $__tpl_vars['static_block']['template']; ?>
" <?php if ($__tpl_vars['block']['properties']['list_object'] == $__tpl_vars['static_block']['template']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['static_block']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</optgroup>
			</select>
		</div>
		<?php $this->assign('index', smarty_modifier_default(@$__tpl_vars['block']['properties']['list_object'], 'products'), false); ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('spec_settings' => $__tpl_vars['specific_settings']['list_object'][$__tpl_vars['index']], 's_set_id' => ($__tpl_vars['id'])."_list_object", )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

		<div class="form-field float-left">
			<label for="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_fillings"><?php echo fn_get_lang_var('filling', $this->getLanguage()); ?>
:</label>
			<select name="block[fillings]" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_fillings" onchange="fn_check_block_params(<?php echo $__tpl_vars['js_param']; ?>
, '<?php echo $__tpl_vars['location']; ?>
', <?php echo $__tpl_vars['id']; ?>
, this);">
			</select>
		</div>

		<?php $this->assign('index', smarty_modifier_default(@$__tpl_vars['block']['properties']['fillings'], 'manually'), false); ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('spec_settings' => $__tpl_vars['specific_settings']['fillings'][$__tpl_vars['index']], 's_set_id' => ($__tpl_vars['id'])."_fillings", )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

		<?php if ($__tpl_vars['add_block'] && $__tpl_vars['location'] != 'product_details'): ?>
			<div class="form-field">
				<label for="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_positions"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
				<select name="block[positions]" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_positions" onchange="fn_check_block_params(<?php echo $__tpl_vars['js_param']; ?>
, '<?php echo $__tpl_vars['location']; ?>
', <?php echo $__tpl_vars['id']; ?>
, this);">
				</select>
			</div>
		<?php endif; ?>

		<div class="form-field float-left">
			<label for="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_appearances"><?php echo fn_get_lang_var('appearance_type', $this->getLanguage()); ?>
:</label>
			<select name="block[appearances]" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_appearances" onchange="fn_get_specific_settings(this.value, <?php echo $__tpl_vars['id']; ?>
, 'appearances');">
			</select>
		</div>

		<?php $this->assign('index', smarty_modifier_default(@$__tpl_vars['block']['properties']['appearances'], "blocks/products_text_links.tpl"), false); ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('spec_settings' => $__tpl_vars['specific_settings']['appearances'][$__tpl_vars['index']], 's_set_id' => ($__tpl_vars['id'])."_appearances", )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php endif; ?>

		<div class="form-field">
			<label for="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_wrapper"><?php echo fn_get_lang_var('wrapper', $this->getLanguage()); ?>
:</label>
			<select name="block[wrapper]" id="<?php echo $__tpl_vars['location']; ?>
_<?php echo $__tpl_vars['id']; ?>
_id_wrapper">
				<option value="">--</option>
				<?php $_from_3395238818 = & $__tpl_vars['block_settings']['wrappers']; if (!is_array($_from_3395238818) && !is_object($_from_3395238818)) { settype($_from_3395238818, 'array'); }if (count($_from_3395238818)):
    foreach ($_from_3395238818 as $__tpl_vars['w']):
?>
				<option value="<?php echo $__tpl_vars['w']; ?>
" <?php if ($__tpl_vars['block']['properties']['wrapper'] == $__tpl_vars['w']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['w']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
	</fieldset>
	</div>
</div>

<?php if ($__tpl_vars['id'] != 'central'): ?>
<script type="text/javascript">
//<![CDATA[
fn_check_block_params(<?php echo $__tpl_vars['js_param']; ?>
, '<?php echo $__tpl_vars['location']; ?>
', <?php echo $__tpl_vars['id']; ?>
, null);
//]]>
</script>
<?php endif; ?>
<div class="buttons-container">
	<?php if ($__tpl_vars['add_block']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.add]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>
</form>
<!--content_group<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['location']; ?>
--></div>