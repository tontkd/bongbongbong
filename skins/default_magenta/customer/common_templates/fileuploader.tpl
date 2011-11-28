{* $Id: fileuploader.tpl 7497 2009-05-19 10:41:21Z zeke $ *}

{assign var="id_var_name" value=$prefix|cat:$var_name|md5}

<div class="fileuploader nowrap">
	{strip}
	<div class="select-field upload-file-links">
		<input type="hidden" {if $image}class="image-field"{/if} name="file_{$var_name}" value="" id="file_{$id_var_name}" />
		<input type="hidden" {if $image}class="image-field"{/if} name="type_{$var_name}" value="" id="type_{$id_var_name}" />
		<div class="upload-file-local">
			<input type="file" {if $image}class="image-field"{/if} name="file_{$var_name}" id="_local_{$id_var_name}" onchange="fileuploader.show_loader(this.id);" onclick="$(this).removeAttr('value');" />
			<a id="local_{$id_var_name}">{$lang.local}</a>
		</div>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a onclick="fileuploader.show_loader(this.id);" id="url_{$id_var_name}">{$lang.url}</a>
	</div>
	{/strip}

	<div class="upload-file-section" id="message_{$id_var_name}" title="">
		<p class="cm-fu-file hidden"><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="12" border="0" hspace="3" id="clean_selection_{$id_var_name}" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" onclick="fileuploader.clean_selection(this.id);" class="hand valign" /><span></span></p>
		<p class="cm-fu-no-file">{$lang.text_select_file}</p>
	</div>
</div>
