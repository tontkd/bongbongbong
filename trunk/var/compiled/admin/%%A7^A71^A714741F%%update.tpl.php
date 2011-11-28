<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from addons/attachments/views/attachments/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'formatfilesize', 'addons/attachments/views/attachments/update.tpl', 38, false),array('modifier', 'md5', 'addons/attachments/views/attachments/update.tpl', 40, false),array('modifier', 'cat', 'addons/attachments/views/attachments/update.tpl', 43, false),array('modifier', 'fn_get_memberships', 'addons/attachments/views/attachments/update.tpl', 72, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','position','file','remove_this_item','remove_this_item','text_select_file','local','server','url','membership','all'));
?>

<?php if ($__tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('id', '0', false); ?>
<?php else: ?>
	<?php $this->assign('id', $__tpl_vars['attachment']['attachment_id'], false); ?>
<?php endif; ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" class="cm-form-highlight" name="attachments_form_<?php echo $__tpl_vars['id']; ?>
" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" value="attachments" />
<input type="hidden" name="object_id" value="<?php echo $__tpl_vars['object_id']; ?>
" />
<input type="hidden" name="object_type" value="<?php echo $__tpl_vars['object_type']; ?>
" />
<input type="hidden" name="attachment_id" value="<?php echo $__tpl_vars['id']; ?>
" />
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />

<div class="object-container">
	<div class="tabs cm-j-tabs clear">
		<ul>
			<li id="tab_details_<?php echo $__tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
		<div id="content_tab_details_<?php echo $__tpl_vars['id']; ?>
">
			<div class="form-field">
				<label for="elm_description_<?php echo $__tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</label>
				<input type="text" name="attachment_data[description]" id="elm_description_<?php echo $__tpl_vars['id']; ?>
" size="60" class="input-text-large main-input" value="<?php echo $__tpl_vars['attachment']['description']; ?>
" />
			</div>

			<div class="form-field">
				<label for="elm_position_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
</label>
				<input type="text" name="attachment_data[position]" id="elm_position_<?php echo $__tpl_vars['id']; ?>
" size="3" class="input-text-short" value="<?php echo $__tpl_vars['attachment']['position']; ?>
" />
			</div>

			<div class="form-field">
				<?php if ($__tpl_vars['attachment']['filename']): ?>
					<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=attachments.getfile&amp;attachment_id=<?php echo $__tpl_vars['attachment']['attachment_id']; ?>
&amp;object_type=<?php echo $__tpl_vars['object_type']; ?>
&amp;object_id=<?php echo $__tpl_vars['object_id']; ?>
"><?php echo $__tpl_vars['attachment']['filename']; ?>
</a> (<?php echo smarty_modifier_formatfilesize($__tpl_vars['attachment']['filesize']); ?>
)
				<?php endif; ?>
				<label for="type_<?php echo md5("attachment_files[".($__tpl_vars['id'])."]"); ?>
" <?php if (! $__tpl_vars['attachment']): ?>class="cm-required"<?php endif; ?>><?php echo fn_get_lang_var('file', $this->getLanguage()); ?>
</label>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => "attachment_files[".($__tpl_vars['id'])."]", )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</div>

			<div class="form-field">
				<label for="elm_membership_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('membership', $this->getLanguage()); ?>
:</label>
				<select id="elm_membership_<?php echo $__tpl_vars['id']; ?>
" name="attachment_data[membership_id]">
					<option value="0">- <?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
 -</option>
					<?php $_from_1205871841 = & fn_get_memberships('C'); if (!is_array($_from_1205871841) && !is_object($_from_1205871841)) { settype($_from_1205871841, 'array'); }if (count($_from_1205871841)):
    foreach ($_from_1205871841 as $__tpl_vars['membership']):
?>
					<option value="<?php echo $__tpl_vars['membership']['membership_id']; ?>
" <?php if ($__tpl_vars['attachment']['membership_id'] == $__tpl_vars['membership']['membership_id']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['membership']['membership']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</div>
		</div>
	</div>
</div>

<div class="buttons-container">
	<?php if ($__tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[attachments.add]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[attachments.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form>