<?php /* Smarty version 2.6.18, created on 2011-12-01 22:19:02
         compiled from views/static_data/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strpos', 'views/static_data/update.tpl', 32, false),array('modifier', 'indent', 'views/static_data/update.tpl', 33, false),array('modifier', 'fn_static_data_megabox', 'views/static_data/update.tpl', 70, false),array('modifier', 'fn_explode_localizations', 'views/static_data/update.tpl', 105, false),array('modifier', 'default', 'views/static_data/update.tpl', 113, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','parent_item','root_level','position_short','none','category','all_categories','page','all_pages','static_data_use_item','localization','multiple_selectbox_notice'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('id', '0', false); ?>
<?php else: ?>
	<?php $this->assign('id', $__tpl_vars['static_data']['param_id'], false); ?>
<?php endif; ?>

<div id="content_group<?php echo $__tpl_vars['id']; ?>
">

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="static_data_form_<?php echo $__tpl_vars['id']; ?>
" enctype="multipart/form-data" class="cm-form-highlight">
<input name="section" type="hidden" value="<?php echo $__tpl_vars['section']; ?>
" />
<input name="param_id" type="hidden" value="<?php echo $__tpl_vars['id']; ?>
" />

<div class="object-container">
	<div class="tabs cm-j-tabs clear">
		<ul>
			<li id="details_<?php echo $__tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
	<fieldset>
		<?php if ($__tpl_vars['section_data']['multi_level']): ?>
		<div class="form-field">
			<label for="parent_<?php echo $__tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('parent_item', $this->getLanguage()); ?>
:</label>
			<select id="parent_<?php echo $__tpl_vars['id']; ?>
" name="static_data[parent_id]">
			<option	value="0">- <?php echo fn_get_lang_var('root_level', $this->getLanguage()); ?>
 -</option>
			<?php $_from_2242320987 = & $__tpl_vars['parent_items']; if (!is_array($_from_2242320987) && !is_object($_from_2242320987)) { settype($_from_2242320987, 'array'); }if (count($_from_2242320987)):
    foreach ($_from_2242320987 as $__tpl_vars['i']):
?>
				<?php if (( strpos($__tpl_vars['i']['id_path'], ($__tpl_vars['static_data']['id_path'])."/") === false || $__tpl_vars['static_data']['id_path'] == "" ) && $__tpl_vars['i']['param_id'] != $__tpl_vars['static_data']['param_id'] || $__tpl_vars['mode'] == 'add'): ?>
					<option	value="<?php echo $__tpl_vars['i']['param_id']; ?>
" <?php if ($__tpl_vars['static_data']['parent_id'] == $__tpl_vars['i']['param_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($__tpl_vars['i']['descr'], $__tpl_vars['i']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
		<?php endif; ?>

		<div class="form-field">
			<label for="descr_<?php echo $__tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var($__tpl_vars['section_data']['descr'], $this->getLanguage()); ?>
:</label>
			<input type="text" size="40" id="descr_<?php echo $__tpl_vars['id']; ?>
" name="static_data[descr]" value="<?php echo $__tpl_vars['static_data']['descr']; ?>
" class="input-text-large main-input" />
		</div>

		<div class="form-field">
			<label for="position_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
:</label>
			<input type="text" size="2" id="position_<?php echo $__tpl_vars['id']; ?>
" name="static_data[position]" value="<?php echo $__tpl_vars['static_data']['position']; ?>
" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="param_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var($__tpl_vars['section_data']['param'], $this->getLanguage()); ?>
:</label>
			<input type="text" size="40" id="param_<?php echo $__tpl_vars['id']; ?>
" name="static_data[param]" value="<?php echo $__tpl_vars['static_data']['param']; ?>
" class="input-text-large" />
		</div>

		<?php if ($__tpl_vars['section_data']['icon']): ?>
		<div class="form-field">
			<label><?php echo fn_get_lang_var($__tpl_vars['section_data']['icon']['title'], $this->getLanguage()); ?>
:</label>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'static_data_icon','image_object_type' => "static_data_".($__tpl_vars['section']),'image_pair' => $__tpl_vars['static_data']['icon'],'no_detailed' => 'Y','hide_titles' => 'Y','image_key' => $__tpl_vars['id'],'image_object_id' => $__tpl_vars['id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<?php endif; ?>

		<?php if ($__tpl_vars['section_data']['additional_params']): ?>
		<?php $_from_2715546473 = & $__tpl_vars['section_data']['additional_params']; if (!is_array($_from_2715546473) && !is_object($_from_2715546473)) { settype($_from_2715546473, 'array'); }if (count($_from_2715546473)):
    foreach ($_from_2715546473 as $__tpl_vars['k'] => $__tpl_vars['p']):
?>
		<div class="form-field">
			<label for="param_<?php echo $__tpl_vars['k']; ?>
_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var($__tpl_vars['p']['title'], $this->getLanguage()); ?>
:</label>
			<?php if ($__tpl_vars['p']['type'] == 'checkbox'): ?>
				<input type="hidden" name="static_data[<?php echo $__tpl_vars['p']['name']; ?>
]" value="N" />
				<input type="checkbox" id="param_<?php echo $__tpl_vars['k']; ?>
_<?php echo $__tpl_vars['id']; ?>
" name="static_data[<?php echo $__tpl_vars['p']['name']; ?>
]" value="Y" <?php if ($__tpl_vars['static_data'][$__tpl_vars['p']['name']] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
			<?php elseif ($__tpl_vars['p']['type'] == 'megabox'): ?>
				<?php $this->assign('_megabox_values', fn_static_data_megabox($__tpl_vars['static_data'][$__tpl_vars['p']['name']]), false); ?>

				<div class="clear select-field">
					<input type="radio" name="static_data[megabox][type][<?php echo $__tpl_vars['p']['name']; ?>
]" id="rb_<?php echo $__tpl_vars['id']; ?>
" <?php if (! $__tpl_vars['_megabox_values']): ?>checked="checked"<?php endif; ?> value="" onclick="$('#un_<?php echo $__tpl_vars['id']; ?>
').attr('disabled', true);" /><label for="rb_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label>
				</div>
				
				<div class="clear select-field">
					<div class="float-left"><input type="radio" name="static_data[megabox][type][<?php echo $__tpl_vars['p']['name']; ?>
]" id="rb_c_<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['_megabox_values']['types']['C']): ?>checked="checked"<?php endif; ?> value="C" onclick="$('#un_<?php echo $__tpl_vars['id']; ?>
').attr('disabled', false);" /><label for="rb_c_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('category', $this->getLanguage()); ?>
:</label></div><div id="megabox_container_c_<?php echo $__tpl_vars['id']; ?>
" class="float-left"><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => "megabox_category_".($__tpl_vars['id']),'input_name' => "static_data[".($__tpl_vars['p']['name'])."][C]",'item_ids' => $__tpl_vars['_megabox_values']['types']['C']['value'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_categories', $this->getLanguage()),'extra' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				</div>

				<div class="clear select-field">
					<div class="float-left"><input type="radio" name="static_data[megabox][type][<?php echo $__tpl_vars['p']['name']; ?>
]" id="rb_a_<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['_megabox_values']['types']['A']): ?>checked="checked"<?php endif; ?> value="A" onclick="$('#un_<?php echo $__tpl_vars['id']; ?>
').attr('disabled', false);" /><label for="rb_a_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('page', $this->getLanguage()); ?>
:</label></div><div id="megabox_container_a_<?php echo $__tpl_vars['id']; ?>
" class="float-left"><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/pages_picker.tpl", 'smarty_include_vars' => array('data_id' => "megabox_page_".($__tpl_vars['id']),'input_name' => "static_data[".($__tpl_vars['p']['name'])."][A]",'item_ids' => $__tpl_vars['_megabox_values']['types']['A']['value'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_pages', $this->getLanguage()),'extra' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				</div>

				<div class="clear select-field">
					<input type="hidden" name="static_data[megabox][use_item][<?php echo $__tpl_vars['p']['name']; ?>
]" value="N" />
					<input type="checkbox" name="static_data[megabox][use_item][<?php echo $__tpl_vars['p']['name']; ?>
]" id="un_<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['_megabox_values']['use_item'] == 'Y'): ?>checked="checked"<?php endif; ?> value="Y" /><label for="un_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('static_data_use_item', $this->getLanguage()); ?>
</label>
				</div>

			<?php elseif ($__tpl_vars['p']['type'] == 'select'): ?>
				<select id="param_<?php echo $__tpl_vars['k']; ?>
_<?php echo $__tpl_vars['id']; ?>
" name="static_data[<?php echo $__tpl_vars['p']['name']; ?>
]">
				<?php $_from_2887414406 = & $__tpl_vars['p']['values']; if (!is_array($_from_2887414406) && !is_object($_from_2887414406)) { settype($_from_2887414406, 'array'); }if (count($_from_2887414406)):
    foreach ($_from_2887414406 as $__tpl_vars['vk'] => $__tpl_vars['vv']):
?>
				<option	value="<?php echo $__tpl_vars['vk']; ?>
" <?php if ($__tpl_vars['static_data'][$__tpl_vars['p']['name']] == $__tpl_vars['vk']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var($__tpl_vars['vv'], $this->getLanguage()); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php elseif ($__tpl_vars['p']['type'] == 'input'): ?>
				<input type="text" id="param_<?php echo $__tpl_vars['k']; ?>
_<?php echo $__tpl_vars['id']; ?>
" name="static_data[<?php echo $__tpl_vars['p']['name']; ?>
]" value="<?php echo $__tpl_vars['static_data'][$__tpl_vars['p']['name']]; ?>
" class="input-text-large" />
			<?php endif; ?>
		</div>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>

		<?php if ($__tpl_vars['section_data']['has_localization']): ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('data_name' => "static_data[localization]", 'data_from' => $__tpl_vars['static_data']['localization'], )); ?>

<?php $this->assign('data', fn_explode_localizations($__tpl_vars['data_from']), false); ?>

<?php if ($__tpl_vars['localizations']): ?>
<?php if (! $__tpl_vars['no_div']): ?>
<div class="form-field">
	<label for="<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('localization', $this->getLanguage()); ?>
:</label>
<?php endif; ?>
		<?php if (! $__tpl_vars['disabled']): ?><input type="hidden" name="<?php echo $__tpl_vars['data_name']; ?>
" value="" /><?php endif; ?>
		<select	name="<?php echo $__tpl_vars['data_name']; ?>
[]" multiple="multiple" size="3" id="<?php echo smarty_modifier_default(@$__tpl_vars['id'], @$__tpl_vars['data_name']); ?>
" class="<?php if ($__tpl_vars['disabled']): ?>elm-disabled<?php else: ?>input-text<?php endif; ?>" <?php if ($__tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from_466923040 = & $__tpl_vars['localizations']; if (!is_array($_from_466923040) && !is_object($_from_466923040)) { settype($_from_466923040, 'array'); }if (count($_from_466923040)):
    foreach ($_from_466923040 as $__tpl_vars['loc']):
?>
			<option	value="<?php echo $__tpl_vars['loc']['localization_id']; ?>
" <?php $_from_1215306045 = & $__tpl_vars['data']; if (!is_array($_from_1215306045) && !is_object($_from_1215306045)) { settype($_from_1215306045, 'array'); }if (count($_from_1215306045)):
    foreach ($_from_1215306045 as $__tpl_vars['p_loc']):
?><?php if ($__tpl_vars['p_loc'] == $__tpl_vars['loc']['localization_id']): ?>selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $__tpl_vars['loc']['localization']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
<?php if (! $__tpl_vars['no_div']): ?>
<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

</div>
<?php endif; ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php endif; ?>
	</fieldset>
	</div>
</div>

<div class="buttons-container">
	<?php if ($__tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[static_data.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[static_data.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form>
<!--content_group<?php echo $__tpl_vars['id']; ?>
--></div>