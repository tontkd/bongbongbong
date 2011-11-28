{* $Id: update.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{assign var="id" value=$block.block_id|default:"0"}
<div id="content_group{$id}_{$location}">
{if !$add_block}
<input type="hidden" value="{$smarty.request.position}" id="{$location}_{$id}_id_positions" />
{/if}
<form action="{$index_script}" method="post" class="cm-form-highlight" name="block_{$location}_{$id}_update_form">
{assign var="js_param" value="false"}
{if $add_block}
	{assign var="js_param" value="true"}
	<input type="hidden" name="add_selected_section" id="add_selected_section" value="{$location|default:"all_pages"}" />
{else}
	<input type="hidden" name="block[block_id]" value="{$id}" />
	<input type="hidden" name="block_location" value="{$block.location}" />
	<input type="hidden" name="redirect_location" value="{$location}" />
	<input type="hidden" name="block[location]" value="{$block.location}" />
	<input type="hidden" name="block[positions]" value="{$smarty.request.position}" />

	<script type="text/javascript">
	//<![CDATA[
	block_properties['{$location}_{$id}_'] = {$block.properties|to_json};
	block_location['{$location}_{$id}_'] = '{$block.location}';
	block_properties_used['{$location}_{$id}_'] = false;
	//]]>
	</script>
{/if}
<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_new_block" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
	<fieldset>
		{if $id != "central"}
		<div class="form-field">
			<label for="{$location}_{$id}_block_name" class="cm-required">{$lang.name}:</label>
			<input type="text" name="block[block]" id="{$location}_{$id}_block_name" size="25" value="{$block.block}" class="input-text main-input" />
		</div>

		<div class="form-field float-left">
			<label for="{$location}_{$id}_block_object">{$lang.block_content}:</label>
			<select name="block[list_object]" id="{$location}_{$id}_block_object" onchange="fn_check_block_params({$js_param}, '{$location}', {$id}, this); fn_get_specific_settings(this.value, {$id}, 'list_object');">
			<optgroup label="{$lang.list_objects}">
				{foreach from=$block_settings.dynamic key="object_name" item="listed_block"}
					<option value="{$object_name}" {if $block.properties.list_object == $object_name}selected="selected"{/if}>{if $listed_block.object_description}{$lang[$listed_block.object_description]}{else}{$lang.$object_name}{/if}</option>
				{/foreach}
			</optgroup>
			<optgroup label="{$lang.standard_sidebox}">
				{foreach from=$block_settings.static item="static_block"}
					<option value="{$static_block.template}" {if $block.properties.list_object == $static_block.template}selected="selected"{/if}>{$static_block.name}</option>
				{/foreach}
			</optgroup>
			</select>
		</div>
		{assign var="index" value=$block.properties.list_object|default:"products"}
		{include file="views/block_manager/specific_settings.tpl" spec_settings=$specific_settings.list_object[$index] s_set_id="`$id`_list_object"}

		<div class="form-field float-left">
			<label for="{$location}_{$id}_id_fillings">{$lang.filling}:</label>
			<select name="block[fillings]" id="{$location}_{$id}_id_fillings" onchange="fn_check_block_params({$js_param}, '{$location}', {$id}, this);">
			</select>
		</div>

		{assign var="index" value=$block.properties.fillings|default:"manually"}
		{include file="views/block_manager/specific_settings.tpl" spec_settings=$specific_settings.fillings[$index] s_set_id="`$id`_fillings"}

		{if $add_block && $location != "product_details"}
			<div class="form-field">
				<label for="{$location}_{$id}_id_positions">{$lang.position}:</label>
				<select name="block[positions]" id="{$location}_{$id}_id_positions" onchange="fn_check_block_params({$js_param}, '{$location}', {$id}, this);">
				</select>
			</div>
		{/if}

		<div class="form-field float-left">
			<label for="{$location}_{$id}_id_appearances">{$lang.appearance_type}:</label>
			<select name="block[appearances]" id="{$location}_{$id}_id_appearances" onchange="fn_get_specific_settings(this.value, {$id}, 'appearances');">
			</select>
		</div>

		{assign var="index" value=$block.properties.appearances|default:"blocks/products_text_links.tpl"}
		{include file="views/block_manager/specific_settings.tpl" spec_settings=$specific_settings.appearances[$index] s_set_id="`$id`_appearances"}
		{/if}

		<div class="form-field">
			<label for="{$location}_{$id}_id_wrapper">{$lang.wrapper}:</label>
			<select name="block[wrapper]" id="{$location}_{$id}_id_wrapper">
				<option value="">--</option>
				{foreach from=$block_settings.wrappers item="w"}
				<option value="{$w}" {if $block.properties.wrapper == $w}selected="selected"{/if}>{$w}</option>
				{/foreach}
			</select>
		</div>
	</fieldset>
	</div>
</div>

{if $id != "central"}
<script type="text/javascript">
//<![CDATA[
fn_check_block_params({$js_param}, '{$location}', {$id}, null);
//]]>
</script>
{/if}
<div class="buttons-container">
	{if $add_block}
		{include file="buttons/create_cancel.tpl" but_name="dispatch[block_manager.add]" cancel_action="close"}
	{else}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.update]" cancel_action="close"}
	{/if}
</div>
</form>
<!--content_group{$id}_{$location}--></div>
