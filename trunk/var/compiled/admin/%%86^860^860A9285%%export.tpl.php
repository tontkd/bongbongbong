<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:50
         compiled from views/exim/export.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/exim/export.tpl', 3, false),array('function', 'cycle', 'views/exim/export.tpl', 444, false),array('modifier', 'escape', 'views/exim/export.tpl', 7, false),array('modifier', 'lower', 'views/exim/export.tpl', 14, false),array('modifier', 'replace', 'views/exim/export.tpl', 17, false),array('modifier', 'fn_check_view_permissions', 'views/exim/export.tpl', 71, false),array('modifier', 'default', 'views/exim/export.tpl', 74, false),array('modifier', 'in_array', 'views/exim/export.tpl', 117, false),array('modifier', 'call_user_func', 'views/exim/export.tpl', 311, false),array('modifier', 'date_format', 'views/exim/export.tpl', 355, false),array('modifier', 'number_format', 'views/exim/export.tpl', 448, false),array('block', 'notes', 'views/exim/export.tpl', 15, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('error_exim_layout_required_fields','text_objects_for_export','change_range','delete_range','text_select_range','select','general','layouts','load','remove_this_item','remove_this_item','or','delete','no_items','text_exim_export_notice','exported_fields','available_fields','save_layout','remove_this_item','remove_this_item','or','clear_fields','remove_this_item','remove_this_item','save_layout_as','save','remove_this_item','remove_this_item','export_options','csv_delimiter','semicolon','comma','tab','output','direct_download','screen','server','filename','export','remove_this_item','remove_this_item','filename','filesize','bytes','download','download','delete','no_data','exported_files','exported_files','export_data'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
	lang.error_exim_layout_missed_fields = '<?php echo smarty_modifier_escape(fn_get_lang_var('error_exim_layout_required_fields', $this->getLanguage()), 'javascript'); ?>
';
//]]>
</script>

<?php if ($__tpl_vars['pattern']['#range_options']): ?>
	<?php $this->assign('r_opt', $__tpl_vars['pattern']['#range_options'], false); ?>
	<?php $this->assign('r_url', ($__tpl_vars['index_script'])."?dispatch=exim.export&section=".($__tpl_vars['pattern']['#section'])."&pattern_id=".($__tpl_vars['pattern']['#pattern_id']), false); ?>
	<?php $this->assign('oname', smarty_modifier_lower($__tpl_vars['r_opt']['#object_name']), false); ?>
	<?php $this->_tag_stack[] = array('notes', array()); $_block_repeat=true;smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($__tpl_vars['export_range']): ?>
		<?php echo smarty_modifier_replace(smarty_modifier_replace(fn_get_lang_var('text_objects_for_export', $this->getLanguage()), "[total]", $__tpl_vars['export_range']), "[name]", $__tpl_vars['oname']); ?>

		<p>
		<a href="<?php echo $__tpl_vars['r_opt']['#selector_url']; ?>
"><?php echo fn_get_lang_var('change_range', $this->getLanguage()); ?>
 &#155;&#155;</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.delete_range&amp;section=<?php echo $__tpl_vars['pattern']['#section']; ?>
&amp;pattern_id=<?php echo $__tpl_vars['pattern']['#pattern_id']; ?>
"><?php echo fn_get_lang_var('delete_range', $this->getLanguage()); ?>
 &#155;&#155;</a>
		</p>
	<?php else: ?>
		<?php echo smarty_modifier_replace(fn_get_lang_var('text_select_range', $this->getLanguage()), "[name]", $__tpl_vars['oname']); ?>
: <a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.select_range&amp;section=<?php echo $__tpl_vars['pattern']['#section']; ?>
&amp;pattern_id=<?php echo $__tpl_vars['pattern']['#pattern_id']; ?>
"><?php echo fn_get_lang_var('select', $this->getLanguage()); ?>
 &#155;&#155;</a>
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>

<?php ob_start(); ?>

<?php ob_start(); ?>

<?php $this->assign('p_id', $__tpl_vars['pattern']['#pattern_id'], false); ?>
<div id="content_<?php echo $__tpl_vars['p_id']; ?>
">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('general', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="<?php echo $__tpl_vars['p_id']; ?>
_set_layout_form">
	<input type="hidden" name="section" value="<?php echo $__tpl_vars['pattern']['#section']; ?>
" />
	<input type="hidden" name="layout_data[pattern_id]" value="<?php echo $__tpl_vars['p_id']; ?>
" />

	<?php echo fn_get_lang_var('layouts', $this->getLanguage()); ?>
:&nbsp;
		<?php if ($__tpl_vars['layouts']): ?>
		<select name="layout_data[layout_id]" id="s_layout_id_<?php echo $__tpl_vars['p_id']; ?>
" class="valign">
		<?php $_from_4273201199 = & $__tpl_vars['layouts']; if (!is_array($_from_4273201199) && !is_object($_from_4273201199)) { settype($_from_4273201199, 'array'); }if (count($_from_4273201199)):
    foreach ($_from_4273201199 as $__tpl_vars['l']):
?>
			<option value="<?php echo $__tpl_vars['l']['layout_id']; ?>
" <?php if ($__tpl_vars['l']['active'] == 'Y'): ?><?php $this->assign('active_layout', $__tpl_vars['l'], false); ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['l']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>&nbsp;
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "dispatch[exim.set_layout]", 'but_text' => fn_get_lang_var('load', $this->getLanguage()), 'but_role' => 'submit', )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;
		<a class="cm-confirm tool-link" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.delete_layout&amp;section=<?php echo $__tpl_vars['pattern']['#section']; ?>
&amp;pattern_id=<?php echo $__tpl_vars['p_id']; ?>
" onclick="this.href += '&layout_id=' + $('#s_layout_id_<?php echo $__tpl_vars['p_id']; ?>
').val();" class="text-button-edit"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a>
		<?php else: ?>
		<span class="lowercase"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</span>
		<?php endif; ?>
	</form>																									  

	<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="<?php echo $__tpl_vars['p_id']; ?>
_manage_layout_form">
	<input type="hidden" name="section" value="<?php echo $__tpl_vars['pattern']['#section']; ?>
" />
	<input type="hidden" name="layout_data[pattern_id]" value="<?php echo $__tpl_vars['p_id']; ?>
" />
	<input type="hidden" name="layout_data[layout_id]" value="<?php echo $__tpl_vars['active_layout']['layout_id']; ?>
" />

	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('items' => $__tpl_vars['pattern']['#export_fields'], 'assigned_ids' => $__tpl_vars['active_layout']['cols'], 'left_name' => "layout_data[cols]", 'left_id' => "pattern_".($__tpl_vars['p_id']), 'p_id' => $__tpl_vars['p_id'], )); ?>

<p><?php echo fn_get_lang_var('text_exim_export_notice', $this->getLanguage()); ?>
</p>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td width="50%" valign="top">
		<p align="center"><label for="<?php echo $__tpl_vars['left_id']; ?>
" class="cm-required cm-all"><strong><?php echo fn_get_lang_var('exported_fields', $this->getLanguage()); ?>
</strong></label></p>
		<select class="input-text cm-expanded" id="<?php echo $__tpl_vars['left_id']; ?>
" name="<?php echo $__tpl_vars['left_name']; ?>
[]" multiple="multiple" size="10" >
		<?php $_from_1582075990 = & $__tpl_vars['assigned_ids']; if (!is_array($_from_1582075990) && !is_object($_from_1582075990)) { settype($_from_1582075990, 'array'); }if (count($_from_1582075990)):
    foreach ($_from_1582075990 as $__tpl_vars['key']):
?>
		<?php if ($__tpl_vars['items'][$__tpl_vars['key']]): ?>
		<option value="<?php echo $__tpl_vars['key']; ?>
" <?php if ($__tpl_vars['items'][$__tpl_vars['key']]['#required']): ?>class="selectbox-highlighted cm-required"<?php endif; ?>><?php echo $__tpl_vars['key']; ?>
</option>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['key'] => $__tpl_vars['item']):
?>
		<?php if ($__tpl_vars['item']['#required'] && ! smarty_modifier_in_array($__tpl_vars['key'], $__tpl_vars['assigned_ids'])): ?>
		<option value="<?php echo $__tpl_vars['key']; ?>
" class="selectbox-highlighted cm-required"><?php echo $__tpl_vars['key']; ?>
</option>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		</select>
		<p>
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/up_icon.gif" width="11" height="11" onclick="$('#<?php echo $__tpl_vars['left_id']; ?>
').swapOptions('up');" class="hand" />&nbsp;&nbsp;&nbsp;
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/down_icon.gif" width="11" height="11" onclick="$('#<?php echo $__tpl_vars['left_id']; ?>
').swapOptions('down');" class="hand" />
		</p>

	</td>
	<td class="center valign" width="4%">
		<p><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/to_left_icon.gif" width="11" height="11" onclick="$('#<?php echo $__tpl_vars['left_id']; ?>
_right').moveOptions('#<?php echo $__tpl_vars['left_id']; ?>
');" class="hand" /></p>
		<p><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/to_right_icon.gif" width="11" height="11" onclick="$('#<?php echo $__tpl_vars['left_id']; ?>
').moveOptions('#<?php echo $__tpl_vars['left_id']; ?>
_right', <?php echo $__tpl_vars['ldelim']; ?>
check_required: true, message: window.lang.error_exim_layout_missed_fields<?php echo $__tpl_vars['rdelim']; ?>
);" class="hand" /></p>
	</td>
	<td width="50%" valign="top">
		<p align="center"><label for="<?php echo $__tpl_vars['left_id']; ?>
_right"><strong><?php echo fn_get_lang_var('available_fields', $this->getLanguage()); ?>
</strong></label></p>
		<select class="input-text cm-expanded" id="<?php echo $__tpl_vars['left_id']; ?>
_right" name="unset_mbox[]" multiple="multiple" size="10" >
		<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['key'] => $__tpl_vars['item']):
?>
		<?php if (! smarty_modifier_in_array($__tpl_vars['key'], $__tpl_vars['assigned_ids']) && ! $__tpl_vars['item']['#required']): ?>
		<option value="<?php echo $__tpl_vars['key']; ?>
" <?php if ($__tpl_vars['item']['#required']): ?>class="selectbox-highlighted cm-required"<?php endif; ?>><?php echo $__tpl_vars['key']; ?>
</option>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
</tr>
</table>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

	<div class="buttons-container right">
		<div class="float-left">
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "dispatch[exim.store_layout]", 'but_text' => fn_get_lang_var('save_layout', $this->getLanguage()), )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;&nbsp;
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('clear_fields', $this->getLanguage()), 'but_onclick' => "$('#pattern_".($__tpl_vars['p_id'])."').moveOptions('#pattern_".($__tpl_vars['p_id'])."_right', ".($__tpl_vars['ldelim'])."move_all: true".($__tpl_vars['rdelim']).");", 'but_role' => 'edit', )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
		<label for="layout_data"><?php echo fn_get_lang_var('save_layout_as', $this->getLanguage()); ?>
:</label>
		<input type="text" id="layout_data" class="input-text valign" name="layout_data[name]" value="" />
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "dispatch[exim.store_layout/save_as]", 'but_text' => fn_get_lang_var('save', $this->getLanguage()), )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>

	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('export_options', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php if ($__tpl_vars['pattern']['#options']): ?>
	<?php $_from_1861039234 = & $__tpl_vars['pattern']['#options']; if (!is_array($_from_1861039234) && !is_object($_from_1861039234)) { settype($_from_1861039234, 'array'); }if (count($_from_1861039234)):
    foreach ($_from_1861039234 as $__tpl_vars['k'] => $__tpl_vars['o']):
?>
	<?php if (! $__tpl_vars['o']['import_only']): ?>
	<div class="form-field">
		<label for="<?php echo $__tpl_vars['p_id']; ?>
_<?php echo $__tpl_vars['k']; ?>
"><?php echo fn_get_lang_var($__tpl_vars['o']['title'], $this->getLanguage()); ?>
:</label>
		<?php if ($__tpl_vars['o']['type'] == 'checkbox'): ?>
			<input type="hidden" name="export_options[<?php echo $__tpl_vars['k']; ?>
]" value="N" />
			<input id="<?php echo $__tpl_vars['p_id']; ?>
_<?php echo $__tpl_vars['k']; ?>
" class="checkbox" type="checkbox" name="export_options[<?php echo $__tpl_vars['k']; ?>
]" value="Y" <?php if ($__tpl_vars['o']['default_value'] == 'Y'): ?>checked="checked"<?php endif; ?> />
		<?php elseif ($__tpl_vars['o']['type'] == 'input'): ?>
			<input id="<?php echo $__tpl_vars['p_id']; ?>
_<?php echo $__tpl_vars['k']; ?>
" class="input-text-large" type="text" name="export_options[<?php echo $__tpl_vars['k']; ?>
]" value="<?php echo $__tpl_vars['o']['default_value']; ?>
" />
		<?php elseif ($__tpl_vars['o']['type'] == 'languages'): ?>
			<select id="<?php echo $__tpl_vars['p_id']; ?>
_<?php echo $__tpl_vars['k']; ?>
" name="export_options[<?php echo $__tpl_vars['k']; ?>
]">
			<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['language']):
?>
				<option value="<?php echo $__tpl_vars['language']['lang_code']; ?>
" <?php if ($__tpl_vars['language']['lang_code'] == @CART_LANGUAGE): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['language']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php elseif ($__tpl_vars['o']['type'] == 'select'): ?>
			<select id="<?php echo $__tpl_vars['p_id']; ?>
_<?php echo $__tpl_vars['k']; ?>
" name="export_options[<?php echo $__tpl_vars['k']; ?>
]">
			<?php if ($__tpl_vars['o']['variants_function']): ?>
				<?php $_from_975608923 = & call_user_func($__tpl_vars['o']['variants_function']); if (!is_array($_from_975608923) && !is_object($_from_975608923)) { settype($_from_975608923, 'array'); }if (count($_from_975608923)):
    foreach ($_from_975608923 as $__tpl_vars['vk'] => $__tpl_vars['vi']):
?>
				<option value="<?php echo $__tpl_vars['vk']; ?>
" <?php if ($__tpl_vars['vk'] == $__tpl_vars['o']['default_value']): ?>checked="checked"<?php endif; ?>><?php echo $__tpl_vars['vi']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<?php $_from_1815829990 = & $__tpl_vars['o']['variants']; if (!is_array($_from_1815829990) && !is_object($_from_1815829990)) { settype($_from_1815829990, 'array'); }if (count($_from_1815829990)):
    foreach ($_from_1815829990 as $__tpl_vars['vk'] => $__tpl_vars['vi']):
?>
				<option value="<?php echo $__tpl_vars['vk']; ?>
" <?php if ($__tpl_vars['vk'] == $__tpl_vars['o']['default_value']): ?>checked="checked"<?php endif; ?>><?php echo fn_get_lang_var($__tpl_vars['vi'], $this->getLanguage()); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			</select>
		<?php endif; ?>
	</div>
	<?php if ($__tpl_vars['o']['description']): ?><p class="manage-row"><?php echo fn_get_lang_var($__tpl_vars['o']['description'], $this->getLanguage()); ?>
</p><?php endif; ?>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php $this->assign('override_options', $__tpl_vars['pattern']['#override_options'], false); ?>
	<?php if ($__tpl_vars['override_options']['delimiter']): ?>
		<input type="hidden" name="export_options[delimiter]" value="<?php echo $__tpl_vars['override_options']['delimiter']; ?>
" />
	<?php else: ?>
	<div class="form-field">
		<label><?php echo fn_get_lang_var('csv_delimiter', $this->getLanguage()); ?>
:</label>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('name' => "export_options[delimiter]", )); ?>
<select name="<?php echo $__tpl_vars['name']; ?>
">
<option value="S"><?php echo fn_get_lang_var('semicolon', $this->getLanguage()); ?>
</option>
<option value="C"><?php echo fn_get_lang_var('comma', $this->getLanguage()); ?>
</option>
<option value="T"><?php echo fn_get_lang_var('tab', $this->getLanguage()); ?>
</option>
</select>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
	<?php endif; ?>
	<?php if ($__tpl_vars['override_options']['output']): ?>
		<input type="hidden" name="export_options[output]" value="<?php echo $__tpl_vars['override_options']['output']; ?>
" />
	<?php else: ?>
	<div class="form-field">
		<label for="output"><?php echo fn_get_lang_var('output', $this->getLanguage()); ?>
:</label>
		<select name="export_options[output]" id="output">
			<option value="D"><?php echo fn_get_lang_var('direct_download', $this->getLanguage()); ?>
</option>
			<option value="C"><?php echo fn_get_lang_var('screen', $this->getLanguage()); ?>
</option>
			<option value="S"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?>
</option>
		</select>
	</div>
	<?php endif; ?>
	<div class="form-field">
		<label for="filename"><?php echo fn_get_lang_var('filename', $this->getLanguage()); ?>
:</label>
		<input type="text" name="export_options[filename]" id="filename" size="50" class="input-text-large" value="<?php echo $__tpl_vars['p_id']; ?>
_<?php echo $__tpl_vars['l']['name']; ?>
_<?php echo smarty_modifier_date_format(@TIME, "%m%d%Y"); ?>
.csv" />
	</div>

	<div class="buttons-container buttons-bg">
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('export', $this->getLanguage()), 'but_name' => "dispatch[exim.export]", 'but_role' => 'button_main', )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>

	</form>
<!--content_<?php echo $__tpl_vars['p_id']; ?>
--></div>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $__tpl_vars['p_id'], )); ?>
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

<?php ob_start(); ?>
<?php ob_start(); ?>
<?php $this->assign('c_url', smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'), false); ?>
<div class="object-container" id="content_exported_files">
<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
<tr>
	<th width="100%"><?php echo fn_get_lang_var('filename', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('filesize', $this->getLanguage()); ?>
</th>
	<th colspan="2">&nbsp;</th>
</tr>
<?php $_from_3867568167 = & $__tpl_vars['export_files']; if (!is_array($_from_3867568167) && !is_object($_from_3867568167)) { settype($_from_3867568167, 'array'); }$this->_foreach['export_files'] = array('total' => count($_from_3867568167), 'iteration' => 0);
if ($this->_foreach['export_files']['total'] > 0):
    foreach ($_from_3867568167 as $__tpl_vars['file']):
        $this->_foreach['export_files']['iteration']++;
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td>
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.get_file&amp;filename=<?php echo $__tpl_vars['file']['name']; ?>
"><?php echo $__tpl_vars['file']['name']; ?>
</a></td>
	<td>
		<?php echo number_format($__tpl_vars['file']['size']); ?>
&nbsp;<?php echo fn_get_lang_var('bytes', $this->getLanguage()); ?>
</td>
	<td>
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.get_file&amp;filename=<?php echo $__tpl_vars['file']['name']; ?>
" class="underlined"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_download.gif" width="16" height="16" border="0" alt="<?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
" /></a>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<li><a class="cm-ajax cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.delete_file&amp;filename=<?php echo $__tpl_vars['file']['name']; ?>
&amp;redirect_url=<?php echo $__tpl_vars['c_url']; ?>
" rev="content_exported_files"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_foreach['export_files']['iteration'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
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
<!--content_exported_files--></div>
<?php $this->_smarty_vars['capture']['exported_files'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('act' => 'edit','id' => 'exported_files','link_text' => fn_get_lang_var('exported_files', $this->getLanguage()),'text' => fn_get_lang_var('exported_files', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['exported_files'],'link_class' => "tool-link")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('export_data', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'extra_tools' => $this->_smarty_vars['capture']['extra_tools'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['_REQUEST']['output'] == 'D'): ?>
<meta http-equiv="Refresh" content="0;URL=<?php echo $__tpl_vars['index_script']; ?>
?dispatch=exim.get_file&amp;filename=<?php echo $__tpl_vars['_REQUEST']['filename']; ?>
" />
<?php endif; ?>