{* $Id: manage_items.tpl 7130 2009-03-25 10:33:05Z lexa $ *}

<div id="content_edit_block_picker">
<form action="{$index_script}" method="post" class="cm-form-highlight" name="block_{$location}_{$block_data.block_id}_update_form">
<input type="hidden" name="block_id" value="{$block.block_id}" />
<input type="hidden" name="block_location" value="{$block.location}" />
<input type="hidden" name="redirect_location" value="{$location}" />
<input type="hidden" name="is_manage" value="Y" />
<div class="object-container">

{include file="common_templates/pagination.tpl" save_current_page=true disable_history=true}

{include file=$block_settings.dynamic[$block.properties.list_object].picker_props.picker data_id="added_`$location`_`$block.block_id`" input_name="block_items" item_ids=$block_items no_js=true positions=true view_mode="list" params_array=$block_settings.dynamic[$block.properties.list_object].picker_props.params start_pos=$start_position}

{include file="common_templates/pagination.tpl" disable_history=true}

</div>
<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.add_items]" cancel_action="close"}
</div>
</form>
<!--content_edit_block_picker--></div>