{* $Id: update.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $mode == "add"}
	{assign var="id" value="0"}
{else}
	{assign var="id" value=$attachment.attachment_id}
{/if}

<form action="{$index_script}" method="post" class="cm-form-highlight" name="attachments_form_{$id}" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" value="attachments" />
<input type="hidden" name="object_id" value="{$object_id}" />
<input type="hidden" name="object_type" value="{$object_type}" />
<input type="hidden" name="attachment_id" value="{$id}" />
<input type="hidden" name="redirect_url" value="{$config.current_url}" />

<div class="object-container">
	<div class="tabs cm-j-tabs clear">
		<ul>
			<li id="tab_details_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
		<div id="content_tab_details_{$id}">
			<div class="form-field">
				<label for="elm_description_{$id}" class="cm-required">{$lang.name}</label>
				<input type="text" name="attachment_data[description]" id="elm_description_{$id}" size="60" class="input-text-large main-input" value="{$attachment.description}" />
			</div>

			<div class="form-field">
				<label for="elm_position_{$id}">{$lang.position}</label>
				<input type="text" name="attachment_data[position]" id="elm_position_{$id}" size="3" class="input-text-short" value="{$attachment.position}" />
			</div>

			<div class="form-field">
				{if $attachment.filename}
					<a href="{$index_script}?dispatch=attachments.getfile&amp;attachment_id={$attachment.attachment_id}&amp;object_type={$object_type}&amp;object_id={$object_id}">{$attachment.filename}</a> ({$attachment.filesize|formatfilesize})
				{/if}
				<label for="type_{"attachment_files[`$id`]"|md5}" {if !$attachment}class="cm-required"{/if}>{$lang.file}</label>
				{include file="common_templates/fileuploader.tpl" var_name="attachment_files[`$id`]"}
			</div>

			<div class="form-field">
				<label for="elm_membership_{$id}">{$lang.membership}:</label>
				<select id="elm_membership_{$id}" name="attachment_data[membership_id]">
					<option value="0">- {$lang.all} -</option>
					{foreach from="C"|fn_get_memberships item="membership"}
					<option value="{$membership.membership_id}" {if $attachment.membership_id == $membership.membership_id}selected="selected"{/if}>{$membership.membership}</option>
					{/foreach}
				</select>
			</div>
		</div>
	</div>
</div>

<div class="buttons-container">
	{if $mode == "add"}
		{include file="buttons/create_cancel.tpl" but_name="dispatch[attachments.add]" cancel_action="close"}
	{else}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[attachments.update]" cancel_action="close"}
	{/if}
</div>

</form>
