<?php /* Smarty version 2.6.18, created on 2011-12-01 22:48:20
         compiled from common_templates/attach_images.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'common_templates/attach_images.tpl', 12, false),array('modifier', 'define', 'common_templates/attach_images.tpl', 13, false),array('modifier', 'explode', 'common_templates/attach_images.tpl', 36, false),array('modifier', 'default', 'common_templates/attach_images.tpl', 37, false),array('modifier', 'cat', 'common_templates/attach_images.tpl', 108, false),array('modifier', 'md5', 'common_templates/attach_images.tpl', 108, false),array('function', 'math', 'common_templates/attach_images.tpl', 79, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('delete_image_pair','thumbnail','delete_image','remove_this_item','remove_this_item','text_select_file','local','server','url','alt_text','popup_larger_image','delete_image','remove_this_item','remove_this_item','text_select_file','local','server','url','alt_text'));
?>
<?php  ob_start();  ?>

<?php if (! defined('SMARTY_ATTACH_IMAGES_LOADED')): ?>
<?php $this->assign('tmp', define('SMARTY_ATTACH_IMAGES_LOADED', true), false); ?>
<script type="text/javascript">
	//<![CDATA[
	<?php echo '
	function fn_delete_image(r, p)
	{
		if (r.deleted == true) {
			$(\'#\' + p.result_ids).replaceWith(\'<img border="0" src="\' + images_dir + \'/no_image.gif" />\');
			$(\'a[rev=\' + p.result_ids + \']\').hide();
		}
	}
	
	function fn_delete_image_pair(r, p)
	{
		if (r.deleted == true) {
			$(\'#\' + p.result_ids).remove();
		}
	}
	'; ?>

	//]]>
</script>
<?php endif; ?>

<?php $this->assign('_plug', explode(".", ""), false); ?>
<?php $this->assign('key', smarty_modifier_default(@$__tpl_vars['image_key'], '0'), false); ?>
<?php $this->assign('object_id', smarty_modifier_default(@$__tpl_vars['image_object_id'], '0'), false); ?>
<?php $this->assign('name', smarty_modifier_default(@$__tpl_vars['image_name'], ""), false); ?>
<?php $this->assign('object_type', smarty_modifier_default(@$__tpl_vars['image_object_type'], ""), false); ?>
<?php $this->assign('type', smarty_modifier_default(@$__tpl_vars['image_type'], 'M'), false); ?>
<?php $this->assign('pair', smarty_modifier_default(@$__tpl_vars['image_pair'], @$__tpl_vars['_plug']), false); ?>
<?php $this->assign('suffix', smarty_modifier_default(@$__tpl_vars['image_suffix'], ""), false); ?>

<input type="hidden" name="<?php echo $__tpl_vars['name']; ?>
_image_data<?php echo $__tpl_vars['suffix']; ?>
[<?php echo $__tpl_vars['key']; ?>
][pair_id]" value="<?php echo $__tpl_vars['pair']['pair_id']; ?>
" class="cm-image-field" />
<input type="hidden" name="<?php echo $__tpl_vars['name']; ?>
_image_data<?php echo $__tpl_vars['suffix']; ?>
[<?php echo $__tpl_vars['key']; ?>
][type]" value="<?php echo smarty_modifier_default(@$__tpl_vars['type'], 'M'); ?>
" class="cm-image-field" />
<input type="hidden" name="<?php echo $__tpl_vars['name']; ?>
_image_data<?php echo $__tpl_vars['suffix']; ?>
[<?php echo $__tpl_vars['key']; ?>
][object_id]" value="<?php echo $__tpl_vars['object_id']; ?>
" class="cm-image-field" />

<div id="box_attach_images_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['key']; ?>
">
	<div class="clear">
	<?php if ($__tpl_vars['delete_pair'] && $__tpl_vars['pair']['pair_id']): ?>
		<div class="float-right">
			<a rev="box_attach_images_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['key']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.delete_image_pair&amp;pair_id=<?php echo $__tpl_vars['pair']['pair_id']; ?>
&amp;object_type=<?php echo $__tpl_vars['object_type']; ?>
" class="cm-confirm cm-ajax delete" name="delete_image_pair"><?php echo fn_get_lang_var('delete_image_pair', $this->getLanguage()); ?>
</a>
		</div>
	<?php endif; ?>
		<?php if (! $__tpl_vars['hide_titles']): ?>
			<p>
				<span class="field-name"><?php echo smarty_modifier_default(@$__tpl_vars['icon_title'], fn_get_lang_var('thumbnail', $this->getLanguage())); ?>
</span>
				<?php if ($__tpl_vars['icon_text']): ?><span class="small-note"><?php echo $__tpl_vars['icon_text']; ?>
</span><?php endif; ?>
				<span class="field-name">:</span>
			</p>
		<?php endif; ?>
		
		<?php if (! $__tpl_vars['hide_images']): ?>
			<div class="float-left image">
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('image' => $__tpl_vars['pair']['icon'], 'image_id' => $__tpl_vars['pair']['image_id'], 'image_width' => 85, 'object_type' => $__tpl_vars['object_type'], )); ?>

<?php if (! $__tpl_vars['image_width']): ?><?php if ($__tpl_vars['image']['image_x']): ?><?php $this->assign('image_width', $__tpl_vars['image']['image_x'], false); ?><?php endif; ?><?php if ($__tpl_vars['image']['image_y']): ?><?php $this->assign('image_height', $__tpl_vars['image']['image_y'], false); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['image']['image_x'] && $__tpl_vars['image']['image_y']): ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $__tpl_vars['image_width'],'x' => $__tpl_vars['image']['image_x'],'y' => $__tpl_vars['image']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php endif; ?><?php endif; ?><?php if (! $__tpl_vars['image']['is_flash']): ?><?php if ($__tpl_vars['image']['image_x']): ?><a href="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" target="_blank"><?php endif; ?><img <?php if ($__tpl_vars['image_id']): ?>id="image_<?php echo $__tpl_vars['object_type']; ?>_<?php echo $__tpl_vars['image_id']; ?>"<?php endif; ?> src="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> alt="<?php echo $__tpl_vars['image']['alt']; ?>" border="0" <?php if ($__tpl_vars['close_on_click'] == true): ?>onclick="window.close();"<?php endif; ?> /><?php if ($__tpl_vars['image']['image_x']): ?></a><?php endif; ?><?php else: ?><object <?php if ($__tpl_vars['image_id']): ?>id="image_<?php echo $__tpl_vars['object_type']; ?>_<?php echo $__tpl_vars['image_id']; ?>"<?php endif; ?> classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> <?php if ($__tpl_vars['close_on_click'] == true): ?>onclick="window.close();"<?php endif; ?>><param name="movie" value="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><embed src="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" quality="high" wmode="transparent" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php if ($__tpl_vars['pair']['image_id']): ?>
				<p>
					<a rev="image_<?php echo $__tpl_vars['object_type']; ?>
_<?php echo $__tpl_vars['pair']['image_id']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.delete_image&pair_id=<?php echo $__tpl_vars['pair']['pair_id']; ?>
&amp;image_id=<?php echo $__tpl_vars['pair']['image_id']; ?>
&amp;object_type=<?php echo $__tpl_vars['object_type']; ?>
" class="cm-confirm cm-ajax delete" name="delete_image"><?php echo fn_get_lang_var('delete_image', $this->getLanguage()); ?>
</a>
				</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div class="float-left attach-images-alt">
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => ($__tpl_vars['name'])."_image_icon".($__tpl_vars['suffix'])."[".($__tpl_vars['key'])."]", 'image' => true, )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php if (! $__tpl_vars['hide_alt']): ?>
			<label for="alt_icon_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('alt_text', $this->getLanguage()); ?>
:</label>
			<input type="text" class="input-text cm-image-field" id="alt_icon_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['key']; ?>
" name="<?php echo $__tpl_vars['name']; ?>
_image_data<?php echo $__tpl_vars['suffix']; ?>
[<?php echo $__tpl_vars['key']; ?>
][image_alt]" value="<?php echo $__tpl_vars['pair']['icon']['alt']; ?>
" />
			<?php endif; ?>
		</div>
	</div>
	
	<?php if (! $__tpl_vars['no_detailed']): ?>
	<div class="clear margin-top">
		<?php if (! $__tpl_vars['hide_titles']): ?>
			<p>
				<span class="field-name"><?php echo smarty_modifier_default(@$__tpl_vars['detailed_title'], fn_get_lang_var('popup_larger_image', $this->getLanguage())); ?>
</span>
				<?php if ($__tpl_vars['detailed_text']): ?>
					<span class="small-note"><?php echo $__tpl_vars['detailed_text']; ?>
</span>
				<?php endif; ?>
				<span class="field-name">:</span>
			</p>
		<?php endif; ?>
		
		<?php if (! $__tpl_vars['hide_images']): ?>
			<div class="float-left image">
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('image' => $__tpl_vars['pair']['detailed'], 'image_id' => $__tpl_vars['pair']['detailed_id'], 'image_width' => 85, 'object_type' => 'detailed', )); ?>

<?php if (! $__tpl_vars['image_width']): ?><?php if ($__tpl_vars['image']['image_x']): ?><?php $this->assign('image_width', $__tpl_vars['image']['image_x'], false); ?><?php endif; ?><?php if ($__tpl_vars['image']['image_y']): ?><?php $this->assign('image_height', $__tpl_vars['image']['image_y'], false); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['image']['image_x'] && $__tpl_vars['image']['image_y']): ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $__tpl_vars['image_width'],'x' => $__tpl_vars['image']['image_x'],'y' => $__tpl_vars['image']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php endif; ?><?php endif; ?><?php if (! $__tpl_vars['image']['is_flash']): ?><?php if ($__tpl_vars['image']['image_x']): ?><a href="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" target="_blank"><?php endif; ?><img <?php if ($__tpl_vars['image_id']): ?>id="image_<?php echo $__tpl_vars['object_type']; ?>_<?php echo $__tpl_vars['image_id']; ?>"<?php endif; ?> src="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> alt="<?php echo $__tpl_vars['image']['alt']; ?>" border="0" <?php if ($__tpl_vars['close_on_click'] == true): ?>onclick="window.close();"<?php endif; ?> /><?php if ($__tpl_vars['image']['image_x']): ?></a><?php endif; ?><?php else: ?><object <?php if ($__tpl_vars['image_id']): ?>id="image_<?php echo $__tpl_vars['object_type']; ?>_<?php echo $__tpl_vars['image_id']; ?>"<?php endif; ?> classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> <?php if ($__tpl_vars['close_on_click'] == true): ?>onclick="window.close();"<?php endif; ?>><param name="movie" value="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><embed src="<?php echo smarty_modifier_default(@$__tpl_vars['image']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" quality="high" wmode="transparent" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php if ($__tpl_vars['pair']['detailed_id']): ?>
				<p>
					<a rev="image_detailed_<?php echo $__tpl_vars['pair']['detailed_id']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.delete_image&pair_id=<?php echo $__tpl_vars['pair']['pair_id']; ?>
&amp;image_id=<?php echo $__tpl_vars['pair']['detailed_id']; ?>
&amp;object_type=detailed" class="cm-confirm cm-ajax delete" name="delete_image"><?php echo fn_get_lang_var('delete_image', $this->getLanguage()); ?>
</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div class="float-left attach-images-alt">
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('var_name' => ($__tpl_vars['name'])."_image_detailed".($__tpl_vars['suffix'])."[".($__tpl_vars['key'])."]", )); ?>

<?php $this->assign('id_var_name', md5(smarty_modifier_cat($__tpl_vars['prefix'], $__tpl_vars['var_name'])), false); ?>

<div class="fileuploader nowrap">
	<div class="upload-file-section" id="message_<?php echo $__tpl_vars['id_var_name']; ?>" title=""><p class="cm-fu-file hidden"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" id="clean_selection_<?php echo $__tpl_vars['id_var_name']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p><p class="cm-fu-no-file"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?></p></div><div class="select-field upload-file-links"><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" value="" id="file_<?php echo $__tpl_vars['id_var_name']; ?>" /><input type="hidden" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="type_<?php echo $__tpl_vars['var_name']; ?>" value="" id="type_<?php echo $__tpl_vars['id_var_name']; ?>" /><div class="upload-file-local"><input type="file" <?php if ($__tpl_vars['image']): ?>class="cm-image-field"<?php endif; ?> name="file_<?php echo $__tpl_vars['var_name']; ?>" id="_local_<?php echo $__tpl_vars['id_var_name']; ?>" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" /><a id="local_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('local', $this->getLanguage()); ?></a></div>&nbsp;&nbsp;|&nbsp;&nbsp;<?php if (! $__tpl_vars['hide_server']): ?><a onclick="fileuploader.show_loader(this.id);" id="server_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('server', $this->getLanguage()); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?><a onclick="fileuploader.show_loader(this.id);" id="url_<?php echo $__tpl_vars['id_var_name']; ?>"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?></a></div>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php if (! $__tpl_vars['hide_alt']): ?>
			<label for="alt_det_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('alt_text', $this->getLanguage()); ?>
:</label>
			<input type="text" class="input-text cm-image-field" id="alt_det_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['key']; ?>
" name="<?php echo $__tpl_vars['name']; ?>
_image_data<?php echo $__tpl_vars['suffix']; ?>
[<?php echo $__tpl_vars['key']; ?>
][detailed_alt]" value="<?php echo $__tpl_vars['pair']['detailed']['alt']; ?>
" />
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php  ob_end_flush();  ?>