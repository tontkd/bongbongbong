<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:58
         compiled from views/languages/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/languages/manage.tpl', 3, false),array('function', 'cycle', 'views/languages/manage.tpl', 28, false),array('modifier', 'substr_count', 'views/languages/manage.tpl', 66, false),array('modifier', 'replace', 'views/languages/manage.tpl', 67, false),array('modifier', 'default', 'views/languages/manage.tpl', 72, false),array('modifier', 'is_array', 'views/languages/manage.tpl', 176, false),array('modifier', 'yaml_unserialize', 'views/languages/manage.tpl', 177, false),array('modifier', 'lower', 'views/languages/manage.tpl', 180, false),array('modifier', 'count', 'views/languages/manage.tpl', 219, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','language_variable','value','delete','no_data','delete_selected','choose_action','or','tools','add','add_language','add_language','add_language_variable','add_language_variable','add_language','add_language','add_language_variable','add_language_variable','language_variable','value','language_code','name','active','hidden','disabled','status','active','hidden','disabled','check_uncheck_all','language_code','name','status','active','disabled','hidden','pending','active','disabled','hidden','notify_customer','delete','delete','delete_selected','choose_action','or','tools','add','add_language','add_language','add_language_variable','add_language_variable','add_language','add_language','add_language_variable','add_language_variable','languages'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php ob_start(); ?>

<?php ob_start(); ?>

<div id="content_translations">

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/languages/components/langvars_search_form.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="language_variables_form">
<input type="hidden" name="q" value="<?php echo $__tpl_vars['_REQUEST']['q']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $__tpl_vars['_REQUEST']['selected_section']; ?>
" />

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr>
	<th width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="35%"><?php echo fn_get_lang_var('language_variable', $this->getLanguage()); ?>
</th>
	<th width="64%"><?php echo fn_get_lang_var('value', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php $_from_2707849579 = & $__tpl_vars['lang_data']; if (!is_array($_from_2707849579) && !is_object($_from_2707849579)) { settype($_from_2707849579, 'array'); }if (count($_from_2707849579)):
    foreach ($_from_2707849579 as $__tpl_vars['key'] => $__tpl_vars['var']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", ",'name' => '2'), $this);?>
 valign="top">
	<td width="1%">
		<input type="checkbox" name="names[]" value="<?php echo $__tpl_vars['var']['name']; ?>
" class="checkbox cm-item" /></td>
	<td width="29%">
		<input type="hidden" name="lang_data[<?php echo $__tpl_vars['key']; ?>
][name]" value="<?php echo $__tpl_vars['var']['name']; ?>
" />
		<p><strong><?php echo $__tpl_vars['var']['name']; ?>
</strong></p></td>
	<td width="70%">
		<textarea name="lang_data[<?php echo $__tpl_vars['key']; ?>
][value]" cols="55" rows="3" class="input-text"><?php echo $__tpl_vars['var']['value']; ?>
</textarea></td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=languages.delete_variable&amp;name=<?php echo $__tpl_vars['var']['name']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['var']['name'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="4"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['lang_data']): ?>
	<div class="buttons-container buttons-bg">
		<div class="float-left">
			<?php ob_start(); ?>
			<ul>
				<li><a name="dispatch[languages.delete_variables]" class="cm-process-items cm-confirm" rev="language_variables_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
			</ul>
			<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.update_variables]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
		</div>
		
		<div class="float-right">
			<?php ob_start(); ?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_language','text' => fn_get_lang_var('add_language', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_language'],'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_langvar','text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_langvar'],'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
		
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_language','text' => fn_get_lang_var('add_language', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_langvar','text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
<?php endif; ?>
</form>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="lang_add_var">
<input type="hidden" name="page" value="<?php echo $__tpl_vars['_REQUEST']['page']; ?>
" />
<input type="hidden" name="q" value="<?php echo $__tpl_vars['_REQUEST']['q']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $__tpl_vars['_REQUEST']['selected_section']; ?>
" />

<div class="object-container">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="add-new-table">
<tr class="cm-first-sibling">
	<th width="35%"><?php echo fn_get_lang_var('language_variable', $this->getLanguage()); ?>
</th>
	<th width="64%"><?php echo fn_get_lang_var('value', $this->getLanguage()); ?>
</th>
	<th width="1%">&nbsp;</th>
</tr>
<tr id="box_new_lang_tag" valign="top">
	<td>
		<input type="text" size="30" name="new_lang_data[0][name]" class="input-text" /></td>
	<td>
		<textarea name="new_lang_data[0][value]" cols="48" rows="2" class="input-textarea-long"></textarea></td>
	<td>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'new_lang_tag')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
</tr>
</table>

</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.add_variables]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<?php $this->_smarty_vars['capture']['add_langvar'] = ob_get_contents(); ob_end_clean(); ?>

</div>

<div class="hidden" id="content_languages">


<?php ob_start(); ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="add_language_form">
<input type="hidden" name="page" value="<?php echo $__tpl_vars['_REQUEST']['page']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $__tpl_vars['_REQUEST']['selected_section']; ?>
" />


<div class="object-container">

<fieldset>
	<div class="form-field">
		<label for="elm_lng_code" class="cm-required"><?php echo fn_get_lang_var('language_code', $this->getLanguage()); ?>
:</label>
		<input id="elm_lng_code" type="text" name="new_language[lang_code]" value="" size="6" maxlength="2" class="input-text" />
	</div>

	<div class="form-field">
		<label for="elm_lng_name" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<input id="elm_lng_name" type="text" name="new_language[name]" value="" maxlength="64" class="input-text" />
	</div>

	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('display' => 'radio', 'input_name' => "new_language[status]", 'hidden' => false, )); ?>

<?php if ($__tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $__tpl_vars['input_name']; ?>
" <?php if ($__tpl_vars['input_id']): ?>id="<?php echo $__tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($__tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($__tpl_vars['hidden']): ?>
	<option value="H" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from_3342526419), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
" <?php if ($__tpl_vars['obj']['status'] == $__tpl_vars['st'] || ( ! $__tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $__tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
"><?php echo $__tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a" <?php if ($__tpl_vars['obj']['status'] == 'A' || ! $__tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($__tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

</fieldset>

</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.add_languages]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>
<?php $this->_smarty_vars['capture']['add_language'] = ob_get_contents(); ob_end_clean(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="languages_form">
<input type="hidden" name="page" value="<?php echo $__tpl_vars['_REQUEST']['page']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $__tpl_vars['_REQUEST']['selected_section']; ?>
" />

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr class="cm-first-sibling">
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><?php echo fn_get_lang_var('language_code', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
	<th width="100%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php if (count($__tpl_vars['langs']) == 1): ?>
	<?php $this->assign('disable_change', true, false); ?>
<?php endif; ?>
<?php $_from_491353924 = & $__tpl_vars['langs']; if (!is_array($_from_491353924) && !is_object($_from_491353924)) { settype($_from_491353924, 'array'); }if (count($_from_491353924)):
    foreach ($_from_491353924 as $__tpl_vars['language']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td class="center" width="1%">
		<input type="checkbox" name="lang_codes[]" value="<?php echo $__tpl_vars['language']['lang_code']; ?>
" <?php if ($__tpl_vars['language']['lang_code'] == 'EN'): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item" /></td>
	<td>
		<strong><?php echo $__tpl_vars['language']['lang_code']; ?>
</strong></td>
	<td>
		<input type="text" name="update_language[<?php echo $__tpl_vars['language']['lang_code']; ?>
][name]" value="<?php echo $__tpl_vars['language']['name']; ?>
" maxlength="64" class="input-text" /></td>
	<td>
		<?php if ($__tpl_vars['disable_change']): ?>
			<?php $this->assign('lang_id', "", false); ?>
		<?php else: ?>
			<?php $this->assign('lang_id', $__tpl_vars['language']['lang_code'], false); ?>
		<?php endif; ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => $__tpl_vars['lang_id'], 'prefix' => 'lng', 'status' => $__tpl_vars['language']['status'], 'hidden' => "", 'object_id_name' => 'lang_code', 'table' => 'languages', )); ?>

<?php $this->assign('prefix', smarty_modifier_default(@$__tpl_vars['prefix'], 'select'), false); ?>
<div class="select-popup-container">
	<div <?php if ($__tpl_vars['id']): ?>id="sw_<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="selected-status status-<?php if ($__tpl_vars['suffix']): ?><?php echo $__tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($__tpl_vars['status']); ?>
<?php if ($__tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
		<a <?php if ($__tpl_vars['id']): ?>class="cm-combo-on<?php if (! $__tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php echo $__tpl_vars['items_status'][$__tpl_vars['status']]; ?>

		<?php else: ?>
			<?php if ($__tpl_vars['status'] == 'A'): ?>
				<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'D'): ?>
				<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'H'): ?>
				<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'P'): ?>
				<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

			<?php endif; ?>
		<?php endif; ?>
		</a>
	</div>
	<?php if ($__tpl_vars['id']): ?>
		<div id="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box hidden">
			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
			<ul class="cm-select-list">
			<?php if ($__tpl_vars['items_status']): ?>
				<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }if (count($_from_3342526419)):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
?>
				<li><a class="status-link-<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
 <?php if ($__tpl_vars['status'] == $__tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;status=<?php echo $__tpl_vars['st']; ?>
<?php if ($__tpl_vars['table'] && $__tpl_vars['object_id_name']): ?>&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
<?php endif; ?><?php echo $__tpl_vars['extra']; ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
');" name="update_object_status_callback"><?php echo $__tpl_vars['val']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<li><a class="status-link-a <?php if ($__tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=A" onclick="return fn_check_object_status(this, 'a');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
				<li><a class="status-link-d <?php if ($__tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=D" onclick="return fn_check_object_status(this, 'd');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
				<?php if ($__tpl_vars['hidden']): ?>
				<li><a class="status-link-h <?php if ($__tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=H" onclick="return fn_check_object_status(this, 'h');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($__tpl_vars['notify']): ?>
				<li class="select-field">
					<input type="checkbox" name="__notify_user" id="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
					<label for="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$__tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
				</li>
			<?php endif; ?>
			</ul>
		</div>
		<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
		<script type="text/javascript">
		//<![CDATA[
		<?php echo '
		function fn_check_object_status(obj, status) 
		{
			if ($(obj).hasClass(\'cm-active\')) {
				$(obj).removeClass(\'cm-ajax\');
				return false;
			}
			fn_update_object_status(obj, status);
			return true;
		}
		function fn_update_object_status_callback(data, params) 
		{
			if (data.return_status && params.preload_obj) {
				fn_update_object_status(params.preload_obj, data.return_status.toLowerCase());
			}
		}
		function fn_update_object_status(obj, status)
		{
			var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
			var upd_elm = $(\'#\' + upd_elm_id);
			upd_elm.hide();
			if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
				$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
			} else {
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), \'notify_user\'));
			}
			$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
			$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
			$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
			'; ?>

			$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($__tpl_vars['suffix']): ?><?php echo $__tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
			<?php echo '
		}
		'; ?>

		//]]>
		</script>
		<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<?php if ($__tpl_vars['language']['lang_code'] == 'EN'): ?>
			<li><span class="undeleted-element"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
		<?php else: ?>
			<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=languages.delete_language&amp;lang_code=<?php echo $__tpl_vars['language']['lang_code']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php endif; ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['language']['lang_code'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<div class="buttons-container buttons-bg">
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[languages.delete_languages]" class="cm-process-items cm-confirm" rev="languages_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.update_languages]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
	</div>
		
	<div class="float-right">
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_language','text' => fn_get_lang_var('add_language', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_language'],'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_langvar','text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_langvar'],'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_language','text' => fn_get_lang_var('add_language', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_langvar','text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

</form>

</div>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $__tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?>
<?php if (! $__tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $__tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['tabs']): ?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($__tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from_2538893706 = & $__tpl_vars['navigation']['tabs']; if (!is_array($_from_2538893706) && !is_object($_from_2538893706)) { settype($_from_2538893706, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from_2538893706), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from_2538893706 as $__tpl_vars['key'] => $__tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (! $__tpl_vars['tabs_section'] || $__tpl_vars['tabs_section'] == $__tpl_vars['tab']['section']): ?>
		<li id="<?php echo $__tpl_vars['key']; ?>
<?php echo $__tpl_vars['id_suffix']; ?>
" class="<?php if ($__tpl_vars['tab']['js']): ?>cm-js<?php elseif ($__tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($__tpl_vars['key'] == $__tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($__tpl_vars['tab']['href']): ?>href="<?php echo $__tpl_vars['tab']['href']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $__tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $__tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('languages', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>