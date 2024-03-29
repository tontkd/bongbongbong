{* $Id: products_update_file_details.tpl 7143 2009-03-26 15:52:19Z lexa $ *}

{script src="js/picker.js"}

<form action="{$index_script}" method="post" class="cm-form-highlight" name="files_form_{$product_file.file_id}" enctype="multipart/form-data">
<input type="hidden" name="product_id" value="{$product_id}" />
<input type="hidden" name="selected_section" value="files" />
<input type="hidden" name="file_id" value="{$product_file.file_id}" />

<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_details_{$product_file.file_id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>
	
	<div class="cm-tabs-content" id="tabs_content_{$product_file.file_id}">
		<div id="content_tab_details_{$product_file.file_id}">

			<div class="form-field">
				<label for="name_{$product_file.file}" class="cm-required">{$lang.name}:</label>
				<input type="text" name="product_file[file_name]" id="name_{$product_file.file}" value="{$product_file.file_name}" class="input-text-large main-input" />
			</div>

			<div class="form-field">
				<label for="position_{$product_file.file_id}">{$lang.position}:</label>
				<input type="text" name="product_file[position]" id="position_{$product_file.file_id}" value="{$product_file.position}" size="3" class="input-text-short" />
			</div>

			<div class="form-field">
				<label for="type_{"base_file[`$product_file.file_id`]"|md5}" {if !$product_file}class="cm-required"{/if}>{$lang.file}:</label>
				{if $product_file.file_path}
					<a href="{$index_script}?dispatch=products.getfile&amp;file_id={$product_file.file_id}">{$product_file.file_path}</a> ({$product_file.file_size|formatfilesize})
				{/if}
				{include file="common_templates/fileuploader.tpl" var_name="base_file[`$product_file.file_id`]"}
			</div>

			<div class="form-field">
				<label for="type_{"file_preview[`$product_file.file_id`]"|md5}">{$lang.preview}:</label>
				{if $product_file.preview_path}
					<a href="{$index_script}?dispatch=products.getfile&amp;file_id={$product_file.file_id}&amp;file_type=preview">{$product_file.preview_path}</a> ({$product_file.preview_size|number_format:0:"":" "}&nbsp;{$lang.bytes})
				{elseif $product_file}
					{$lang.none}
				{/if}
				{include file="common_templates/fileuploader.tpl" var_name="file_preview[`$product_file.file_id`]"}
			</div>

			<div class="form-field">
				<label for="activation_{$product_file.file_id}">{$lang.activation_mode}:</label>
				<select name="product_file[activation_type]" id="activation_{$product_file.file_id}">
					<option value="M" {if $product_file.activation_type == "M"}selected="selected"{/if}>{$lang.manually}</option>
					<option value="I" {if $product_file.activation_type == "I"}selected="selected"{/if}>{$lang.immediately}</option>
					<option value="P" {if $product_file.activation_type == "P"}selected="selected"{/if}>{$lang.after_full_payment}</option>
				</select>
			</div>

			<div class="form-field">
				<label for="max_downloads_{$product_file.file_id}">{$lang.max_downloads}:</label>
				<input type="text" name="product_file[max_downloads]" id="max_downloads_{$product_file.file_id}" value="{$product_file.max_downloads}" size="3" class="input-text-short" />
			</div>

			<div class="form-field">
				<label for="license_{$product_file.file}">{$lang.license_agreement}:</label>
				<textarea id="license_{$product_file.file}" name="product_file[license]" cols="55" rows="8" class="input-textarea-long">{$product_file.license}</textarea>
				<p>{include file="common_templates/wysiwyg.tpl" id="license_`$product_file.file`"}</p>
			</div>

			<div class="form-field">
				<label>{$lang.agreement_required}:</label>
				<div class="select-field float-left nowrap">
					<input type="radio" name="product_file[agreement]" id="agreement_{$product_file.file}_y" {if $product_file.agreement == "Y" || !$product_file}checked="checked"{/if} value="Y" class="radio" />
					<label for="agreement_{$product_file.file}_y">{$lang.yes}</label>
					<input type="radio" name="product_file[agreement]" id="agreement_{$product_file.file}_n" {if $product_file.agreement == "N"}checked="checked"{/if} value="N" class="radio" />
					<label for="agreement_{$product_file.file}_n">{$lang.no}</label>
				</div>
			</div>

			<div class="form-field">
				<label for="readme_{$product_file.file}">{$lang.readme}:</label>
				<textarea id="readme_{$product_file.file}" name="product_file[readme]" cols="55" rows="8" class="input-textarea-long">{$product_file.readme}</textarea>
				<p>{include file="common_templates/wysiwyg.tpl" id="readme_`$product_file.file`"}</p>
			</div>
		</div>
	</div>
</div>

<div class="buttons-container">
	{if $product_file}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[products.update_file]" cancel_action="close"}
	{else}
		{include file="buttons/create_cancel.tpl" but_name="dispatch[products.update_file]" cancel_action="close"}
	{/if}
</div>

</form>