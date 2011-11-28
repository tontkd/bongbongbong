{* $Id: select_blocks.tpl 7687 2009-07-09 12:33:49Z zeke $ *}

{if $blocks}
	<div class="clear">
		<div id="content_block_manager_blocks" class="listmania-lists">
			{foreach from=$blocks item="block" name="block_list"}
				&nbsp;<span class="bull">&bull;</span>&nbsp;{if $selected_block.block_id == $block.block_id}<span class="strong">{else}<a href="{$index_script}?dispatch={$smarty.const.CONTROLLER}{if $smarty.const.MODE}.{$smarty.const.MODE}{/if}{if $location}&amp;page_section={$location}{/if}{if $selected_block.object_id && $object_id}&amp;{$selected_block.object_id}={$object_id}{/if}&amp;selected_section={if $location}{$location}_{/if}blocks&amp;selected_block_id={$block.block_id}">{/if}{$block.block}{if $selected_block.block_id == $block.block_id}</span>{else}</a>{/if}{if $lm_list.use == "Y"}&nbsp;(+){else}{/if}&nbsp;&nbsp;&nbsp;&nbsp;
			{/foreach}
		</div>
	</div>

{if $selected_block.properties.fillings == "manually"}
	{assign var="_view_mode" value="mixed"}
	{assign var="_hide_delete_button" value=false}
{else}
	{assign var="_view_mode" value="list"}
	{assign var="_hide_delete_button" value=true}
{/if}
	<div class="clear">
		{if $selected_block.properties.fillings && $block_properties[$selected_block.properties.list_object].picker_props.picker}
		<div class="listed-items">
			{include file="common_templates/subheader.tpl" title=$lang.listed_items}
			<input type="hidden" name="{$data_name}[block_id]" value="{$selected_block.block_id}" />
			{if $selected_block.properties.fillings == "manually"}
				{assign var="show_position" value=true}
			{else}
				{assign var="show_position" value=false}
			{/if}

			{include file=$block_properties[$selected_block.properties.list_object].picker_props.picker data_id="added_`$selected_block.block_id`" input_name="`$data_name`[add_items]" item_ids=$selected_block.item_ids positions=$show_position view_mode=$_view_mode hide_delete_button=$_hide_delete_button params_array=$block_properties[$selected_block.properties.list_object].picker_props.params}
		</div>
		{/if}

		<div class="general-items">
			{include file="common_templates/subheader.tpl" title=$lang.general}
			<div class="form-field">
				<label>{$lang.block_name}:</label>
				<a href="{$index_script}?dispatch=block_manager.manage">{$selected_block.block}</a>
			</div>

			<div class="form-field">
				<label>{$lang.filling}:</label>
				{if $selected_block.properties.fillings}{$selected_block.properties.fillings|fn_get_lang_var}{else}{$lang.static_block}{/if}
			</div>

			<div class="form-field">
				<label for="enable_block_{$selected_block.block_id}">{$lang.enable_for_this_page}:</label>
				<input id="enable_block_{$selected_block.block_id}" type="checkbox" name="enable_block_{$selected_block.block_id}" value="Y" {if $selected_block.assigned == "Y"}checked="checked"{/if} onclick="jQuery.ajaxRequest('{$index_script}?dispatch=block_manager.enable_disable{if $object_id}&amp;location={$smarty.const.CONTROLLER}&amp;object_id={$object_id}{elseif $location}&amp;location={$location}{/if}&amp;block_id={$selected_block.block_id}&amp;enable=' + (this.checked ? this.value : 'N'), {literal}{method: 'POST', cache: false}{/literal});" />
			</div>
			{if $selected_block.disabled}
				<div class="form-field">
					<label>{$lang.disabled}:</label>
					{$selected_block.disabled}
				</div>
			{/if}
		</div>
	</div>

{else}
	<p class="no-items">{$lang.no_blocks_defined} <a href="{$index_script}?dispatch=block_manager.manage&amp;selected_section={$section}">{$lang.manage_custom_blocks} &raquo;</a></p>
{/if}
