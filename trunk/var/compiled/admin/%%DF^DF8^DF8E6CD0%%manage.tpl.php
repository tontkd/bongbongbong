<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:37
         compiled from views/profile_fields/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/profile_fields/manage.tpl', 3, false),array('function', 'math', 'views/profile_fields/manage.tpl', 20, false),array('function', 'cycle', 'views/profile_fields/manage.tpl', 51, false),array('modifier', 'sizeof', 'views/profile_fields/manage.tpl', 20, false),array('modifier', 'substr_count', 'views/profile_fields/manage.tpl', 109, false),array('modifier', 'replace', 'views/profile_fields/manage.tpl', 168, false),array('modifier', 'default', 'views/profile_fields/manage.tpl', 173, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','position_short','description','type','show','required','contact_information','billing_address','shipping_address','checkbox','input_field','radiogroup','selectbox','textarea','date','email','zip_postal_code','phone','titles','country','state','phone','zip_postal_code','checkbox','date','input_field','radiogroup','selectbox','textarea','delete','delete','position_short','description','remove_this_item','remove_this_item','remove_this_item','remove_this_item','no_items','delete_selected','choose_action','or','tools','add','add_new_field','add_field','general','variants','description','position','type','phone','zip_postal_code','checkbox','date','input_field','radiogroup','selectbox','textarea','section','contact_information','billing_address','shipping_address','show','required','position','description','add_new_field','add_field','profile_fields'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php echo '
<script type="text/javascript">
//<![CDATA[
function fn_check_field_type(value, tab_id)
{
	$(\'#\' + tab_id).toggleBy(!(value == \'R\' || value == \'S\'));
}
//]]>
</script>
'; ?>


<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="fields_form">
<?php echo smarty_function_math(array('equation' => "x + 5",'assign' => '_colspan','x' => sizeof($__tpl_vars['profile_fields_areas'])), $this);?>


<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
	<th width="100%"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<?php $_from_1483393372 = & $__tpl_vars['profile_fields_areas']; if (!is_array($_from_1483393372) && !is_object($_from_1483393372)) { settype($_from_1483393372, 'array'); }if (count($_from_1483393372)):
    foreach ($_from_1483393372 as $__tpl_vars['key'] => $__tpl_vars['d']):
?>
	<th class="center">
		<ul>
			<li><?php echo fn_get_lang_var($__tpl_vars['d'], $this->getLanguage()); ?>
</li>
			<li><?php echo fn_get_lang_var('show', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('required', $this->getLanguage()); ?>
</li>
		</ul>
	</th>
	<?php endforeach; endif; unset($_from); ?>
	<th>&nbsp;</th>
</tr>

<?php $_from_495879635 = & $__tpl_vars['profile_fields']; if (!is_array($_from_495879635) && !is_object($_from_495879635)) { settype($_from_495879635, 'array'); }$this->_foreach['profile_fields'] = array('total' => count($_from_495879635), 'iteration' => 0);
if ($this->_foreach['profile_fields']['total'] > 0):
    foreach ($_from_495879635 as $__tpl_vars['section'] => $__tpl_vars['fields']):
        $this->_foreach['profile_fields']['iteration']++;
?>
	<tr>
		<td colspan="<?php echo $__tpl_vars['_colspan']; ?>
">
			<?php if ($__tpl_vars['section'] == 'C'): ?><?php $this->assign('s_title', fn_get_lang_var('contact_information', $this->getLanguage()), false); ?>
			<?php elseif ($__tpl_vars['section'] == 'B'): ?><?php $this->assign('s_title', fn_get_lang_var('billing_address', $this->getLanguage()), false); ?>
			<?php elseif ($__tpl_vars['section'] == 'S'): ?><?php $this->assign('s_title', fn_get_lang_var('shipping_address', $this->getLanguage()), false); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['s_title'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	<?php $_from_2062017905 = & $__tpl_vars['fields']; if (!is_array($_from_2062017905) && !is_object($_from_2062017905)) { settype($_from_2062017905, 'array'); }if (count($_from_2062017905)):
    foreach ($_from_2062017905 as $__tpl_vars['field']):
?>
	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
		<td class="center">
			<?php if ($__tpl_vars['section'] != 'B' && $__tpl_vars['field']['is_default'] != 'Y'): ?><?php $this->assign('extra_fields', true, false); ?><?php $this->assign('custom_fields', true, false); ?><?php if ($__tpl_vars['field']['matching_id']): ?><input type="hidden" name="matches[<?php echo $__tpl_vars['field']['matching_id']; ?>
]" value="<?php echo $__tpl_vars['field']['field_id']; ?>
" /><?php endif; ?><input type="checkbox" name="field_ids[]" value="<?php echo $__tpl_vars['field']['field_id']; ?>
" class="checkbox cm-item" /><?php else: ?>&nbsp;<?php endif; ?></td>
		<td><input class="input-text-short" type="text" size="3" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][position]" value="<?php echo $__tpl_vars['field']['position']; ?>
" /></td>
		<td>
			<input id="descr_elm_<?php echo $__tpl_vars['field']['field_id']; ?>
" class="input-text" size="20" type="text" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][description]" value="<?php echo $__tpl_vars['field']['description']; ?>
" /></td>
		<td class="nowrap">
			<?php if ($__tpl_vars['field']['is_default'] == 'Y' || $__tpl_vars['section'] == 'B'): ?>
				<?php if ($__tpl_vars['field']['field_type'] == 'C'): ?><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'I'): ?><?php echo fn_get_lang_var('input_field', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'R'): ?><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'S'): ?><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'T'): ?><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'D'): ?><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'E'): ?><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'Z'): ?><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'P'): ?><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>

				<?php elseif ($__tpl_vars['field']['field_type'] == 'L'): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=static_data.manage&amp;section=T" class="underlined"><?php echo fn_get_lang_var('titles', $this->getLanguage()); ?>
&nbsp;&#155;&#155;</a>
				<?php elseif ($__tpl_vars['field']['field_type'] == 'O'): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=countries.manage" class="underlined"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
&nbsp;&#155;&#155;</a>
				<?php elseif ($__tpl_vars['field']['field_type'] == 'A'): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=states.manage" class="underlined"><?php echo fn_get_lang_var('state', $this->getLanguage()); ?>
&nbsp;&#155;&#155;</a>
				<?php endif; ?>
				<input type="hidden" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][field_type]" value="<?php echo $__tpl_vars['field']['field_type']; ?>
" />
			<?php else: ?>
			<select id="elm_<?php echo $__tpl_vars['field']['field_id']; ?>
" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][field_type]" onchange="fn_check_field_type(this.value, 'field_values_<?php echo $__tpl_vars['field']['field_id']; ?>
');">
				<option value="P" <?php if ($__tpl_vars['field']['field_type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
</option>
				<option value="Z" <?php if ($__tpl_vars['field']['field_type'] == 'Z'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
</option>
				<option value="C" <?php if ($__tpl_vars['field']['field_type'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?>
</option>
				<option value="D" <?php if ($__tpl_vars['field']['field_type'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
</option>
				<option value="I" <?php if ($__tpl_vars['field']['field_type'] == 'I'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('input_field', $this->getLanguage()); ?>
</option>
				<option value="R" <?php if ($__tpl_vars['field']['field_type'] == 'R'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?>
</option>
				<option value="S" <?php if ($__tpl_vars['field']['field_type'] == 'S'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?>
</option>
				<option value="T" <?php if ($__tpl_vars['field']['field_type'] == 'T'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?>
</option>
			</select>
			<?php endif; ?>
		</td>

		<?php $_from_1483393372 = & $__tpl_vars['profile_fields_areas']; if (!is_array($_from_1483393372) && !is_object($_from_1483393372)) { settype($_from_1483393372, 'array'); }if (count($_from_1483393372)):
    foreach ($_from_1483393372 as $__tpl_vars['key'] => $__tpl_vars['d']):
?>
		<?php $this->assign('_show', ($__tpl_vars['key'])."_show", false); ?>
		<?php $this->assign('_required', ($__tpl_vars['key'])."_required", false); ?>
		<td class="center">
			<input type="hidden" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][<?php echo $__tpl_vars['_show']; ?>
]" value="<?php if ($__tpl_vars['field']['field_name'] == 'email'): ?>Y<?php else: ?>N<?php endif; ?>" />
			<input type="checkbox" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][<?php echo $__tpl_vars['_show']; ?>
]" value="Y" <?php if ($__tpl_vars['field'][$__tpl_vars['_show']] == 'Y'): ?>checked="checked"<?php endif; ?> <?php if ($__tpl_vars['field']['field_name'] == 'email'): ?>disabled="disabled"<?php endif; ?> onclick="document.getElementById('req_<?php echo $__tpl_vars['key']; ?>
_<?php echo $__tpl_vars['field']['field_id']; ?>
').disabled = !this.checked;" />
			<input type="hidden" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][<?php echo $__tpl_vars['_required']; ?>
]" value="<?php if ($__tpl_vars['field']['field_name'] == 'email'): ?>Y<?php else: ?>N<?php endif; ?>" />
			<input id="req_<?php echo $__tpl_vars['key']; ?>
_<?php echo $__tpl_vars['field']['field_id']; ?>
" type="checkbox" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][<?php echo $__tpl_vars['_required']; ?>
]" value="Y" <?php if ($__tpl_vars['field'][$__tpl_vars['_required']] == 'Y'): ?>checked="checked"<?php endif; ?> <?php if ($__tpl_vars['field'][$__tpl_vars['_show']] == 'N' || $__tpl_vars['field']['field_name'] == 'email'): ?>disabled="disabled"<?php endif; ?> />
		</td>
		<?php endforeach; endif; unset($_from); ?>
		<td class="nowrap">
			<?php ob_start(); ?>
			<?php if ($__tpl_vars['custom_fields']): ?>
				<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profile_fields.delete&amp;field_id=<?php echo $__tpl_vars['field']['field_id']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php else: ?>
				<li><span class="undeleted-element"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
			<?php endif; ?>
			<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['field']['field_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	<?php if ($__tpl_vars['field']['is_default'] == 'N' && $__tpl_vars['section'] != 'B'): ?>
	<tr id="field_values_<?php echo $__tpl_vars['field']['field_id']; ?>
" <?php if (substr_count('CHITDNPZ', $__tpl_vars['field']['field_type'])): ?>class="hidden"<?php endif; ?>>
		<td colspan="<?php echo $__tpl_vars['_colspan']; ?>
">
			<table cellpadding="0" cellspacing="0" border="0" width="1" class="table">
			<tr class="cm-first-sibling">
				<th>&nbsp;</th>
				<th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</th>
				<th>&nbsp;</th>
			</tr>
			<?php $_from_4069235686 = & $__tpl_vars['field']['values']; if (!is_array($_from_4069235686) && !is_object($_from_4069235686)) { settype($_from_4069235686, 'array'); }if (count($_from_4069235686)):
    foreach ($_from_4069235686 as $__tpl_vars['val']):
?>
			<tr class="cm-first-sibling">
				<td class="center">
					<input type="checkbox" name="value_ids[]" value="<?php echo $__tpl_vars['val']['value_id']; ?>
" class="checkbox cm-item" /></td>
				<td><input class="input-text-short" size="3" type="text" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][values][<?php echo $__tpl_vars['val']['value_id']; ?>
][position]" value="<?php echo $__tpl_vars['val']['position']; ?>
" /></td>
				<td><input class="input-text" type="text" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][values][<?php echo $__tpl_vars['val']['value_id']; ?>
][description]" value="<?php echo $__tpl_vars['val']['description']; ?>
" /></td>
				<td><a class="cm-confirm cm-ajax cm-delete-row" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profile_fields.delete&amp;value_id=<?php echo $__tpl_vars['val']['value_id']; ?>
"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('simple' => true, )); ?>

<?php if (! $__tpl_vars['simple']): ?>
<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete_disabled.gif" width="12" height="18" border="0" name="remove" id="<?php echo $__tpl_vars['item_id']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="hand<?php if ($__tpl_vars['only_delete'] == 'Y'): ?> hidden<?php endif; ?>" align="top" />
<?php endif; ?>
<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" name="remove_hidden" id="<?php echo $__tpl_vars['item_id']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
"<?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
"<?php endif; ?> class="hand<?php if (! $__tpl_vars['simple'] && $__tpl_vars['only_delete'] != 'Y'): ?> hidden<?php endif; ?><?php if ($__tpl_vars['but_class']): ?> <?php echo $__tpl_vars['but_class']; ?>
<?php endif; ?>" align="top" />
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></a></td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
			<tr id="box_elm_values_<?php echo $__tpl_vars['field']['field_id']; ?>
">
				<td>&nbsp;</td>
				<td><input class="input-text-short" size="3" type="text" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][add_values][0][position]" /></td>
				<td><input class="input-text" type="text" name="fields_data[<?php echo $__tpl_vars['field']['field_id']; ?>
][add_values][0][description]" /></td>
				<td><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => "elm_values_".($__tpl_vars['field']['field_id']),'tag_level' => 3)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
			</tr>
			</table>
		</td>
	</tr>
	<?php endif; ?>
	<?php $this->assign('custom_fields', false, false); ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="<?php echo $__tpl_vars['_colspan']; ?>
"><p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<div class="buttons-container buttons-bg">
	<?php if ($__tpl_vars['profile_fields']): ?>
		<div class="float-left">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[profile_fields.update]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($__tpl_vars['extra_fields']): ?>
			<?php ob_start(); ?>
			<ul>
				<li><a class="cm-process-items cm-confirm" name="dispatch[profile_fields.delete]" rev="fields_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
			</ul>
			<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => 'main', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?>


<?php if ($__tpl_vars['tools_list'] && $__tpl_vars['prefix'] == 'main' && ! $__tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($__tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($__tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($__tpl_vars['display']): ?> <?php echo $__tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $__tpl_vars['hide_tools'] && $__tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($__tpl_vars['display']): ?> <?php echo $__tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($__tpl_vars['override_meta']): ?><?php echo $__tpl_vars['override_meta']; ?>
<?php else: ?>select-link<?php endif; ?><?php if ($__tpl_vars['link_meta']): ?> <?php echo $__tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $__tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $__tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box">
				<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
					<?php echo $__tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $__tpl_vars['hide_actions']): ?>
		<span class="action-add">
			<a<?php if ($__tpl_vars['tool_id']): ?> id="<?php echo $__tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['tool_href']): ?> href="<?php echo $__tpl_vars['tool_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['tool_onclick']): ?> onclick="<?php echo $__tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
		</span>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="float-right">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_field','text' => fn_get_lang_var('add_new_field', $this->getLanguage()),'link_text' => fn_get_lang_var('add_field', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

</form>

<?php ob_start(); ?>
	<?php ob_start(); ?>
	<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="add_fields_form" class="cm-form-highlight">
	<div class="object-container">
		<div class="tabs cm-j-tabs">
			<ul>
				<li id="tab_new_profile" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
				<li id="tab_variants" class="cm-js hidden"><a><?php echo fn_get_lang_var('variants', $this->getLanguage()); ?>
</a></li>
			</ul>
		</div>
		<div class="cm-tabs-content">
			<div id="content_tab_new_profile">
				<div class="form-field">
					<label class="cm-required"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
					<input id="descr_add_field_values_section" class="input-text-large main-input" type="text" name="add_fields_data[0][description]" value="" />
				</div>
	
				<div class="form-field">
					<label><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
					<input class="input-text-short" type="text" size="3" name="add_fields_data[0][position]" value="" />
				</div>
	
				<div class="form-field">
					<label><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
					<select id="add_field_values_section" name="add_fields_data[0][field_type]" onchange="fn_check_field_type(this.value, 'tab_variants');">
						<option value="P"><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
</option>
						<option value="Z"><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
</option>
						<option value="C"><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?>
</option>
						<option value="D"><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
</option>
						<option value="I"><?php echo fn_get_lang_var('input_field', $this->getLanguage()); ?>
</option>
						<option value="R"><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?>
</option>
						<option value="S"><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?>
</option>
						<option value="T"><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?>
</option>
					</select>
				</div>
	
				<div class="form-field">
					<label><?php echo fn_get_lang_var('section', $this->getLanguage()); ?>
:</label>
					<select name="add_fields_data[0][section]">
						<option value="C"><?php echo fn_get_lang_var('contact_information', $this->getLanguage()); ?>
</option>
						<option value="BS"><?php echo fn_get_lang_var('billing_address', $this->getLanguage()); ?>
/<?php echo fn_get_lang_var('shipping_address', $this->getLanguage()); ?>
</option>
					</select>
				</div>
	
				<?php $_from_1483393372 = & $__tpl_vars['profile_fields_areas']; if (!is_array($_from_1483393372) && !is_object($_from_1483393372)) { settype($_from_1483393372, 'array'); }if (count($_from_1483393372)):
    foreach ($_from_1483393372 as $__tpl_vars['key'] => $__tpl_vars['d']):
?>
				<?php $this->assign('_show', ($__tpl_vars['key'])."_show", false); ?>
				<?php $this->assign('_required', ($__tpl_vars['key'])."_required", false); ?>
				<div class="form-field">
					<label><?php echo fn_get_lang_var($__tpl_vars['d'], $this->getLanguage()); ?>
&nbsp;(<?php echo fn_get_lang_var('show', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('required', $this->getLanguage()); ?>
):</label>
					<input type="hidden" name="add_fields_data[0][<?php echo $__tpl_vars['_show']; ?>
]" value="N" />
					<input type="checkbox" name="add_fields_data[0][<?php echo $__tpl_vars['_show']; ?>
]" value="Y" checked="checked" />&nbsp;
					<input type="hidden" name="add_fields_data[0][<?php echo $__tpl_vars['_required']; ?>
]" value="N" />
					<input type="checkbox" name="add_fields_data[0][<?php echo $__tpl_vars['_required']; ?>
]" value="Y" checked="checked" />
				</div>
				<?php endforeach; endif; unset($_from); ?>
			<!--content_tab_new_profile--></div>

			<div class="hidden" id="content_tab_variants">
				<table cellpadding="0" cellspacing="0" border="0" class="table">
				<tr>
					<th><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
</th>
					<th><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</th>
					<th>&nbsp;</th>
				</tr>
				<tr id="box_add_field_values">
					<td><input class="input-text-short" size="3" type="text" name="add_fields_data[0][values][0][position]" /></td>
					<td><input class="input-text" type="text" name="add_fields_data[0][values][0][description]" /></td>
					<td><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'add_field_values','tag_level' => '3')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				</tr>
				</table>
			<!--content_tab_variants--></div>
		</div>
	</div>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[profile_fields.add]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

	</form>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_field','text' => fn_get_lang_var('add_new_field', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_field', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('profile_fields', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>