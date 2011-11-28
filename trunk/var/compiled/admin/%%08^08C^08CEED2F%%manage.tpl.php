<?php /* Smarty version 2.6.18, created on 2011-11-28 12:09:19
         compiled from views/template_editor/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/template_editor/manage.tpl', 7, false),array('modifier', 'escape', 'views/template_editor/manage.tpl', 10, false),array('modifier', 'cat', 'views/template_editor/manage.tpl', 93, false),array('modifier', 'md5', 'views/template_editor/manage.tpl', 93, false),array('block', 'notes', 'views/template_editor/manage.tpl', 21, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_enter_filename','text_are_you_sure_to_proceed','legend','legend_customer_directory','legend_admin_directory','legend_all_areas_directory','current_path','show_active_skins_only','loading','delete','rename','restore_from_repository','change_permissions','change_permissions','edit','select','remove_this_item','remove_this_item','text_select_file','local','server','url','upload','upload_file','upload_file','name','create_folder','create_folder','name','create_file','create_file','template_editor'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo smarty_function_script(array('src' => "js/template_editor_scripts.js"), $this);?>

<script type="text/javascript">
	//<![CDATA[
	lang.text_enter_filename = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_enter_filename', $this->getLanguage()), 'javascript'); ?>
';
	lang.text_are_you_sure_to_proceed = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_are_you_sure_to_proceed', $this->getLanguage()), 'javascript'); ?>
';

	$(document).ready(function()<?php echo $__tpl_vars['ldelim']; ?>

		template_editor.refresh();
	<?php echo $__tpl_vars['rdelim']; ?>
);
	//]]>
</script>

<?php ob_start(); ?>

<?php $this->_tag_stack[] = array('notes', array('title' => fn_get_lang_var('legend', $this->getLanguage()))); $_block_repeat=true;smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td class="nowrap"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_folder_c.gif" width="15" height="13" alt="" border="0" />&nbsp;&nbsp;-&nbsp;</td>
		<td><?php echo fn_get_lang_var('legend_customer_directory', $this->getLanguage()); ?>
</td>
	</tr>
	<tr valign="top">
		<td class="nowrap"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_folder_a.gif" width="15" height="13" alt="" border="0" />&nbsp;&nbsp;-&nbsp;</td>
		<td><?php echo fn_get_lang_var('legend_admin_directory', $this->getLanguage()); ?>
</td>
	</tr>
	<tr valign="top">
		<td class="nowrap"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_folder_ac.gif" width="15" height="13" alt="" border="0" />&nbsp;&nbsp;-&nbsp;</td>
		<td><?php echo fn_get_lang_var('legend_all_areas_directory', $this->getLanguage()); ?>
</td>
	</tr>
	</table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


<div id="error_box" class="hidden">
	<div align="center" class="notification-e">
		<div id="error_status"></div>
	</div>
</div>

<div id="status_box" class="hidden">
	<div class="notification-n" align="center">
		<div id="status"></div>
	</div>
</div>

<div class="items-container">
<div class="editor-tools clear">
	<div class="float-left"><strong><?php echo fn_get_lang_var('current_path', $this->getLanguage()); ?>
</strong>:&nbsp;&nbsp;<span id="path"></span></div>
	<div class="select-field float-right">
		<input type="checkbox" name="show_active_skins_only" id="show_active_skins_only" value="Y" <?php if ($__tpl_vars['show_active_skins_only'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="jQuery.ajaxRequest('<?php echo $__tpl_vars['index_script']; ?>
?dispatch=template_editor.active_skins&show_active_skins_only='+(this.checked ? 'Y' : ''), <?php echo '{callback: [template_editor, \'refresh\'], cache: false}'; ?>
);" class="checkbox" />
		<label for="show_active_skins_only"><?php echo fn_get_lang_var('show_active_skins_only', $this->getLanguage()); ?>
</label>
	</div>
</div>

<div id="filelist"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</div>

<div class="editor-tools clear" id="actions_table">
	<ul>
		<li><a href="javascript: template_editor.delete_file();"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<li>|<a href="javascript: template_editor.rename();"><?php echo fn_get_lang_var('rename', $this->getLanguage()); ?>
</a></li>
		<li>|<a href="javascript: template_editor.restore_file();"><?php echo fn_get_lang_var('restore_from_repository', $this->getLanguage()); ?>
</a></li>
	<?php if (1 || @IS_WINDOWS == false): ?>
	<li>|
		<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/template_editor/components/chmod.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['chmod'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'chmod','text' => fn_get_lang_var('change_permissions', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['chmod'],'link_text' => fn_get_lang_var('change_permissions', $this->getLanguage()),'act' => 'edit','edit_onclick' => "template_editor.parse_permissions();")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</li>
	<?php endif; ?>
	</ul>

	<ul id="file_actions">
		<li>|<a href="javascript: template_editor.show_content('');"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>
</div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<form name="upload_form" action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" enctype="multipart/form-data" class="cm-form-highlight">
		<div class="object-container">
			<div class="form-field">
				<label class="cm-required"><?php echo fn_get_lang_var('select', $this->getLanguage()); ?>
:</label>
				<input type="hidden" name="fake" value="1" />
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => "uploaded_data[0]", )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</div>
		</div>
		
		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('upload', $this->getLanguage()),'but_name' => "dispatch[template_editor.upload_file]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		</form>
	<?php $this->_smarty_vars['capture']['upload_file'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'upload_file','text' => fn_get_lang_var('upload_file', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['upload_file'],'link_text' => fn_get_lang_var('upload_file', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php ob_start(); ?>
		<form name="create_directory" onsubmit="template_editor.create_file(document.getElementById('new_directory').value, true); return false;" class="cm-form-highlight">
		<div class="object-container">
			<div class="form-field">
				<label for="new_directory" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
					<input class="input-text main-input" type="text" name="new_directory" id="new_directory" value="" size="30" />
			</div>
		</div>
		
		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_onclick' => "template_editor.create_file(document.getElementById('new_directory').value, true)",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		</form>
	<?php $this->_smarty_vars['capture']['add_new_folder'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_folder','text' => fn_get_lang_var('create_folder', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_folder'],'link_text' => fn_get_lang_var('create_folder', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php ob_start(); ?>
		<form name="create_file" onsubmit="template_editor.create_file(document.getElementById('new_file').value, false); return false;" class="cm-form-highlight">
		<div class="object-container">
			<div class="form-field">
				<label for="new_file" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
				<input class="input-text main-input" type="text" name="new_file" id="new_file" value="" size="30" />
			</div>
		</div>
		
		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_onclick' => "template_editor.create_file(document.getElementById('new_file').value, false)",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		</form>
	<?php $this->_smarty_vars['capture']['add_new_file'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_file','text' => fn_get_lang_var('create_file', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_file'],'link_text' => fn_get_lang_var('create_file', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/template_editor/components/template_editor_picker.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['mainbox'],'title' => fn_get_lang_var('template_editor', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>