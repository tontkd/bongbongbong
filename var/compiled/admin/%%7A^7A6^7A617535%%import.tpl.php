<?php /* Smarty version 2.6.18, created on 2011-11-28 12:01:18
         compiled from views/exim/import.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'views/exim/import.tpl', 19, false),array('function', 'split', 'views/exim/import.tpl', 28, false),array('function', 'script', 'views/exim/import.tpl', 170, false),array('modifier', 'cat', 'views/exim/import.tpl', 88, false),array('modifier', 'md5', 'views/exim/import.tpl', 88, false),array('modifier', 'fn_check_view_permissions', 'views/exim/import.tpl', 140, false),array('modifier', 'default', 'views/exim/import.tpl', 143, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_exim_import_notice','import_options','csv_delimiter','semicolon','comma','tab','select_file','remove_this_item','remove_this_item','text_select_file','local','server','url','import','remove_this_item','remove_this_item','import_data'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>

<?php ob_start(); ?>

<?php $this->assign('p_id', $__tpl_vars['pattern']['#pattern_id'], false); ?>
<div id="content_<?php echo $__tpl_vars['p_id']; ?>
">
		
	<?php if ($__tpl_vars['pattern']['#notes']): ?>
		<?php ob_start(); ?>
			<?php $_from_1915018061 = & $__tpl_vars['pattern']['#notes']; if (!is_array($_from_1915018061) && !is_object($_from_1915018061)) { settype($_from_1915018061, 'array'); }if (count($_from_1915018061)):
    foreach ($_from_1915018061 as $__tpl_vars['note']):
?>
				<?php echo smarty_function_eval(array('var' => fn_get_lang_var($__tpl_vars['note'], $this->getLanguage())), $this);?>

				<hr />
			<?php endforeach; endif; unset($_from); ?>
		<?php $this->_smarty_vars['capture']['local_notes'] = ob_get_contents(); ob_end_clean(); ?>
	<?php endif; ?>
	
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['pattern']['#name'],'notes' => $this->_smarty_vars['capture']['local_notes'],'notes_id' => $__tpl_vars['p_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<p><?php echo fn_get_lang_var('text_exim_import_notice', $this->getLanguage()); ?>
</p>
	<?php echo smarty_function_split(array('data' => $__tpl_vars['pattern']['#export_fields'],'size' => 3,'assign' => 'splitted_fields','simple' => true), $this);?>

	<div class="clear">
		<?php $_from_3659933504 = & $__tpl_vars['splitted_fields']; if (!is_array($_from_3659933504) && !is_object($_from_3659933504)) { settype($_from_3659933504, 'array'); }if (count($_from_3659933504)):
    foreach ($_from_3659933504 as $__tpl_vars['fields']):
?>
			<ul class="float-left inside-list">
				<?php $_from_2062017905 = & $__tpl_vars['fields']; if (!is_array($_from_2062017905) && !is_object($_from_2062017905)) { settype($_from_2062017905, 'array'); }if (count($_from_2062017905)):
    foreach ($_from_2062017905 as $__tpl_vars['field'] => $__tpl_vars['f']):
?>
					<li <?php if ($__tpl_vars['f']['#required']): ?>class="strong"<?php endif; ?>><?php echo $__tpl_vars['field']; ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		<?php endforeach; endif; unset($_from); ?>
	</div>

	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('import_options', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="<?php echo $__tpl_vars['p_id']; ?>
_import_form" enctype="multipart/form-data">
	<input type="hidden" name="section" value="<?php echo $__tpl_vars['pattern']['#section']; ?>
" />
	<input type="hidden" name="pattern_id" value="<?php echo $__tpl_vars['p_id']; ?>
" />

	<?php if ($__tpl_vars['pattern']['#options']): ?>
	<?php $_from_1861039234 = & $__tpl_vars['pattern']['#options']; if (!is_array($_from_1861039234) && !is_object($_from_1861039234)) { settype($_from_1861039234, 'array'); }if (count($_from_1861039234)):
    foreach ($_from_1861039234 as $__tpl_vars['k'] => $__tpl_vars['o']):
?>
	<div class="form-field">
		<label for="<?php echo $__tpl_vars['k']; ?>
"><?php echo fn_get_lang_var($__tpl_vars['o']['title'], $this->getLanguage()); ?>
:</label>
		<?php if ($__tpl_vars['o']['type'] == 'checkbox'): ?>
			<input type="hidden" name="import_options[<?php echo $__tpl_vars['k']; ?>
]" value="N" />
			<input id="<?php echo $__tpl_vars['k']; ?>
" class="checkbox" type="checkbox" name="import_options[<?php echo $__tpl_vars['k']; ?>
]" value="Y" <?php if ($__tpl_vars['o']['default_value'] == 'Y'): ?>checked="checked"<?php endif; ?> />
		<?php elseif ($__tpl_vars['o']['type'] == 'input'): ?>
			<input id="<?php echo $__tpl_vars['k']; ?>
" class="input-text-large" type="text" name="import_options[<?php echo $__tpl_vars['k']; ?>
]" value="<?php echo $__tpl_vars['o']['default_value']; ?>
" />
		<?php elseif ($__tpl_vars['o']['type'] == 'languages'): ?>
			<select name="import_options[<?php echo $__tpl_vars['k']; ?>
]" id="<?php echo $__tpl_vars['k']; ?>
">
				<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['language']):
?>
					<option value="<?php echo $__tpl_vars['language']['lang_code']; ?>
" <?php if ($__tpl_vars['language']['lang_code'] == @CART_LANGUAGE): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['language']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php elseif ($__tpl_vars['o']['type'] == 'select'): ?>
			<select name="import_options[<?php echo $__tpl_vars['k']; ?>
]" id="<?php echo $__tpl_vars['k']; ?>
">
				<?php $_from_1815829990 = & $__tpl_vars['o']['variants']; if (!is_array($_from_1815829990) && !is_object($_from_1815829990)) { settype($_from_1815829990, 'array'); }if (count($_from_1815829990)):
    foreach ($_from_1815829990 as $__tpl_vars['vk'] => $__tpl_vars['vi']):
?>
					<option value="<?php echo $__tpl_vars['vk']; ?>
" <?php if ($__tpl_vars['vk'] == $__tpl_vars['o']['default_value']): ?>checked="checked"<?php endif; ?>><?php echo fn_get_lang_var($__tpl_vars['vi'], $this->getLanguage()); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php endif; ?>
		<?php if ($__tpl_vars['o']['description']): ?>
			<p class="description"><?php echo fn_get_lang_var($__tpl_vars['o']['description'], $this->getLanguage()); ?>
</p>
		<?php endif; ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('csv_delimiter', $this->getLanguage()); ?>
:</label>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('name' => "import_options[delimiter]", )); ?>
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

	<div class="form-field">
		<label><?php echo fn_get_lang_var('select_file', $this->getLanguage()); ?>
:</label>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => "csv_file[0]", 'prefix' => $__tpl_vars['p_id'], )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>

	<div class="buttons-container buttons-bg">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('import', $this->getLanguage()), 'but_name' => "dispatch[exim.import]", 'but_role' => 'button_main', )); ?>

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

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('import_data', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>