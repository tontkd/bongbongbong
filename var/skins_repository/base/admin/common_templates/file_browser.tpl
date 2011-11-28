{* $Id: file_browser.tpl 7497 2009-05-19 10:41:21Z zeke $ *}

<div id="view_box_server_upload" class="popup-edit-content cm-popup-box cm-picker">
	<div class="cm-popup-content-header">
		<div class="float-right"><img src="{$images_dir}/icons/icon_close.gif" width="13" height="13" border="0" alt="{$lang.close}" class="hand cm-popup-switch" /></div>
		<h3>{$lang.file_upload}</h3>
	</div>
	<div class="cm-popup-content-footer">
		<div class="object-container">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td>
					<div id="server_file_tree" class="file-browser panel-design"></div></td>
				<td width="100%">
					<h5>{$lang.preview}</h5>
					<div class="cm-preview-wrap">
						<div id="preview">
							<img src="{$images_dir}/no_image.gif" id="fo_img" onerror="this.src = '{$images_dir}/no_image.gif';" class="hidden" align="middle" alt="{$lang.no_preview_available}" />
							<textarea cols="30" rows="12" id="fo_preview" class="hidden"></textarea>
							<div id="fo_no_preview">{$lang.no_preview_available}</div>
						</div>
					</div>
				</td>
			</tr>
			</table>
			<p>{$lang.text_click_to_select}</p>
		</div>

		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.select_file but_onclick="$(window['last_clicked_item']).parent().trigger('dblclick')" but_type="button" cancel_action="close"}
		</div>
	</div>
</div>

{if !$smarty.capture.file_browser_loaded}
{capture name="file_browser_loaded"}Y{/capture}

{script src="js/picker.js"}
{script src="js/fileuploader_scripts.js"}
{script src="js/jqueryFileTree.js"}

<script type="text/javascript">
//<![CDATA[
{literal}
	$(document).ready( function() {
		$('#server_file_tree').file_tree({ root: '', script: index_script + '?dispatch=file_browser.browse' }, function(file) {
			jQuery.ajaxRequest(index_script + '?dispatch=file_browser.get_content', {data:{file: escape(file)}, callback: fileuploader.get_content_callback, method: 'post'});
		});
	});
{/literal}
//]]>
</script>
{/if}