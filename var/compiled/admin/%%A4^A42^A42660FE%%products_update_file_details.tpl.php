<?php /* Smarty version 2.6.18, created on 2011-11-28 13:16:54
         compiled from views/products/components/products_update_file_details.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/products/components/products_update_file_details.tpl', 3, false),array('modifier', 'md5', 'views/products/components/products_update_file_details.tpl', 31, false),array('modifier', 'formatfilesize', 'views/products/components/products_update_file_details.tpl', 33, false),array('modifier', 'cat', 'views/products/components/products_update_file_details.tpl', 37, false),array('modifier', 'number_format', 'views/products/components/products_update_file_details.tpl', 65, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','position','file','remove_this_item','remove_this_item','text_select_file','local','server','url','preview','bytes','none','remove_this_item','remove_this_item','text_select_file','local','server','url','activation_mode','manually','immediately','after_full_payment','max_downloads','license_agreement','agreement_required','yes','no','readme'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" class="cm-form-highlight" name="files_form_<?php echo $__tpl_vars['product_file']['file_id']; ?>
" enctype="multipart/form-data">
<input type="hidden" name="product_id" value="<?php echo $__tpl_vars['product_id']; ?>
" />
<input type="hidden" name="selected_section" value="files" />
<input type="hidden" name="file_id" value="<?php echo $__tpl_vars['product_file']['file_id']; ?>
" />

<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_details_<?php echo $__tpl_vars['product_file']['file_id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>
	
	<div class="cm-tabs-content" id="tabs_content_<?php echo $__tpl_vars['product_file']['file_id']; ?>
">
		<div id="content_tab_details_<?php echo $__tpl_vars['product_file']['file_id']; ?>
">

			<div class="form-field">
				<label for="name_<?php echo $__tpl_vars['product_file']['file']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
				<input type="text" name="product_file[file_name]" id="name_<?php echo $__tpl_vars['product_file']['file']; ?>
" value="<?php echo $__tpl_vars['product_file']['file_name']; ?>
" class="input-text-large main-input" />
			</div>

			<div class="form-field">
				<label for="position_<?php echo $__tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
				<input type="text" name="product_file[position]" id="position_<?php echo $__tpl_vars['product_file']['file_id']; ?>
" value="<?php echo $__tpl_vars['product_file']['position']; ?>
" size="3" class="input-text-short" />
			</div>

			<div class="form-field">
				<label for="type_<?php echo md5("base_file[".($__tpl_vars['product_file']['file_id'])."]"); ?>
" <?php if (! $__tpl_vars['product_file']): ?>class="cm-required"<?php endif; ?>><?php echo fn_get_lang_var('file', $this->getLanguage()); ?>
:</label>
				<?php if ($__tpl_vars['product_file']['file_path']): ?>
					<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.getfile&amp;file_id=<?php echo $__tpl_vars['product_file']['file_id']; ?>
"><?php echo $__tpl_vars['product_file']['file_path']; ?>
</a> (<?php echo smarty_modifier_formatfilesize($__tpl_vars['product_file']['file_size']); ?>
)
				<?php endif; ?>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => "base_file[".($__tpl_vars['product_file']['file_id'])."]", )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</div>

			<div class="form-field">
				<label for="type_<?php echo md5("file_preview[".($__tpl_vars['product_file']['file_id'])."]"); ?>
"><?php echo fn_get_lang_var('preview', $this->getLanguage()); ?>
:</label>
				<?php if ($__tpl_vars['product_file']['preview_path']): ?>
					<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.getfile&amp;file_id=<?php echo $__tpl_vars['product_file']['file_id']; ?>
&amp;file_type=preview"><?php echo $__tpl_vars['product_file']['preview_path']; ?>
</a> (<?php echo number_format($__tpl_vars['product_file']['preview_size'], 0, "", ' '); ?>
&nbsp;<?php echo fn_get_lang_var('bytes', $this->getLanguage()); ?>
)
				<?php elseif ($__tpl_vars['product_file']): ?>
					<?php echo fn_get_lang_var('none', $this->getLanguage()); ?>

				<?php endif; ?>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => "file_preview[".($__tpl_vars['product_file']['file_id'])."]", )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</div>

			<div class="form-field">
				<label for="activation_<?php echo $__tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('activation_mode', $this->getLanguage()); ?>
:</label>
				<select name="product_file[activation_type]" id="activation_<?php echo $__tpl_vars['product_file']['file_id']; ?>
">
					<option value="M" <?php if ($__tpl_vars['product_file']['activation_type'] == 'M'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('manually', $this->getLanguage()); ?>
</option>
					<option value="I" <?php if ($__tpl_vars['product_file']['activation_type'] == 'I'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('immediately', $this->getLanguage()); ?>
</option>
					<option value="P" <?php if ($__tpl_vars['product_file']['activation_type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('after_full_payment', $this->getLanguage()); ?>
</option>
				</select>
			</div>

			<div class="form-field">
				<label for="max_downloads_<?php echo $__tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('max_downloads', $this->getLanguage()); ?>
:</label>
				<input type="text" name="product_file[max_downloads]" id="max_downloads_<?php echo $__tpl_vars['product_file']['file_id']; ?>
" value="<?php echo $__tpl_vars['product_file']['max_downloads']; ?>
" size="3" class="input-text-short" />
			</div>

			<div class="form-field">
				<label for="license_<?php echo $__tpl_vars['product_file']['file']; ?>
"><?php echo fn_get_lang_var('license_agreement', $this->getLanguage()); ?>
:</label>
				<textarea id="license_<?php echo $__tpl_vars['product_file']['file']; ?>
" name="product_file[license]" cols="55" rows="8" class="input-textarea-long"><?php echo $__tpl_vars['product_file']['license']; ?>
</textarea>
				<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => "license_".($__tpl_vars['product_file']['file']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
			</div>

			<div class="form-field">
				<label><?php echo fn_get_lang_var('agreement_required', $this->getLanguage()); ?>
:</label>
				<div class="select-field float-left nowrap">
					<input type="radio" name="product_file[agreement]" id="agreement_<?php echo $__tpl_vars['product_file']['file']; ?>
_y" <?php if ($__tpl_vars['product_file']['agreement'] == 'Y' || ! $__tpl_vars['product_file']): ?>checked="checked"<?php endif; ?> value="Y" class="radio" />
					<label for="agreement_<?php echo $__tpl_vars['product_file']['file']; ?>
_y"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
					<input type="radio" name="product_file[agreement]" id="agreement_<?php echo $__tpl_vars['product_file']['file']; ?>
_n" <?php if ($__tpl_vars['product_file']['agreement'] == 'N'): ?>checked="checked"<?php endif; ?> value="N" class="radio" />
					<label for="agreement_<?php echo $__tpl_vars['product_file']['file']; ?>
_n"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
				</div>
			</div>

			<div class="form-field">
				<label for="readme_<?php echo $__tpl_vars['product_file']['file']; ?>
"><?php echo fn_get_lang_var('readme', $this->getLanguage()); ?>
:</label>
				<textarea id="readme_<?php echo $__tpl_vars['product_file']['file']; ?>
" name="product_file[readme]" cols="55" rows="8" class="input-textarea-long"><?php echo $__tpl_vars['product_file']['readme']; ?>
</textarea>
				<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => "readme_".($__tpl_vars['product_file']['file']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
			</div>
		</div>
	</div>
</div>

<div class="buttons-container">
	<?php if ($__tpl_vars['product_file']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.update_file]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.update_file]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form>