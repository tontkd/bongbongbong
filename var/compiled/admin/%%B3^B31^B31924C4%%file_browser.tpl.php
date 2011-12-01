<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:06
         compiled from common_templates/file_browser.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'common_templates/file_browser.tpl', 38, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('close','file_upload','preview','no_preview_available','no_preview_available','text_click_to_select','select_file'));
?>

<div id="view_box_server_upload" class="popup-edit-content cm-popup-box cm-picker">
	<div class="cm-popup-content-header">
		<div class="float-right"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" class="hand cm-popup-switch" /></div>
		<h3><?php echo fn_get_lang_var('file_upload', $this->getLanguage()); ?>
</h3>
	</div>
	<div class="cm-popup-content-footer">
		<div class="object-container">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td>
					<div id="server_file_tree" class="file-browser panel-design"></div></td>
				<td width="100%">
					<h5><?php echo fn_get_lang_var('preview', $this->getLanguage()); ?>
</h5>
					<div class="cm-preview-wrap">
						<div id="preview">
							<img src="<?php echo $__tpl_vars['images_dir']; ?>
/no_image.gif" id="fo_img" onerror="this.src = '<?php echo $__tpl_vars['images_dir']; ?>
/no_image.gif';" class="hidden" align="middle" alt="<?php echo fn_get_lang_var('no_preview_available', $this->getLanguage()); ?>
" />
							<textarea cols="30" rows="12" id="fo_preview" class="hidden"></textarea>
							<div id="fo_no_preview"><?php echo fn_get_lang_var('no_preview_available', $this->getLanguage()); ?>
</div>
						</div>
					</div>
				</td>
			</tr>
			</table>
			<p><?php echo fn_get_lang_var('text_click_to_select', $this->getLanguage()); ?>
</p>
		</div>

		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('select_file', $this->getLanguage()),'but_onclick' => "$(window['last_clicked_item']).parent().trigger('dblclick')",'but_type' => 'button','cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>

<?php if (! $this->_smarty_vars['capture']['file_browser_loaded']): ?>
<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['file_browser_loaded'] = ob_get_contents(); ob_end_clean(); ?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/jqueryFileTree.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
<?php echo '
	$(document).ready( function() {
		$(\'#server_file_tree\').file_tree({ root: \'\', script: index_script + \'?dispatch=file_browser.browse\' }, function(file) {
			jQuery.ajaxRequest(index_script + \'?dispatch=file_browser.get_content\', {data:{file: escape(file)}, callback: fileuploader.get_content_callback, method: \'post\'});
		});
	});
'; ?>

//]]>
</script>
<?php endif; ?>