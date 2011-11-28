{* $Id: block_element.tpl 7164 2009-03-31 11:09:21Z lexa $ *}

{if $block_data && !$block_data.disabled}
<div class="cm-list-box{if $block_data.location != "all_pages"} this-page-block{else} base-block{/if}">
	<input type="hidden" name="block_positions[]" class="block-position" value="{$block_data.block_id}" />
	<h4><strong>
	{if $location == "all_pages" || $block_data.location != "all_pages"}
	<a class="float-right cm-confirm" href="{$index_script}?dispatch=block_manager.delete&amp;selected_section={$location}&amp;block_id={$block_data.block_id}"><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="18" border="0" title="{$lang.delete}" alt="{$lang.delete}" /></a>
	{/if}
	{$block_data.block}
	</strong></h4>
	<div class="block-content clear">
		{if $block_data.properties.list_object}
			<p><label>{$lang.content}:</label>
			<span class="lowercase">{$block_data.properties.content_name|default:$block_data.properties.list_object}</span></p>
		{/if}

		{if $block_data.properties.fillings}
			<p><label>{$lang.filling}:</label>
			{$block_data.properties.fillings}</p>
		{/if}

		{if $block_data.properties.appearances}
			<p><label>{$lang.appearance}:</label>
			{$block_data.properties.appearances}</p>
		{/if}

		{if $block_data.properties.wrapper}
			<p><label>{$lang.wrapper}:</label>
			{$block_data.properties.wrapper}</p>
		{/if}

		{if $block_data.properties.fillings == "manually" && ($block_data.location == "all_pages" || $block_data.location == "checkout" || $block_data.location == "cart" || $block_data.location == "index")}
			<div class="info-line">
				<div class="float-right">
					{include file=$block_settings.dynamic[$block_data.properties.list_object].picker_props.picker data_id="`$block_data.block_id`_`$block_data.location`" checkbox_name="block_items" extra_var="dispatch=block_manager.add_items&block_id=`$block_data.block_id`&block_location=`$block_data.location`&redirect_location=$location" no_container=true view_mode="button" params_array=$block_settings.dynamic[$block_data.properties.list_object].picker_props.params}
				</div>
				{$lang.items_in_block}:&nbsp;
				{include file="buttons/button.tpl" but_text="&nbsp;&nbsp;`$block_data.items_count`&nbsp;" but_href="$index_script?dispatch=block_manager.manage_items&amp;block_id=`$block_data.block_id`&amp;location=`$location`" but_role="link" but_onclick="jQuery.ajaxRequest(this.href, `$ldelim`callback: fn_show_block_picker, result_ids: 'content_edit_block_picker', caching: true`$rdelim`)" but_meta="text-button"}
			</div>
		{/if}

		{if $block_data.location != "all_pages" && $block_data.location != "checkout" && $block_data.location != "cart" && $block_data.location != "index"}
			<div class="info-line">
				{assign var="but_text" value=$lang.manage_products|replace:"products":$block_data.location}
				{$lang.text_switch_to_details_page|replace:"[product]":$block_data.location}.
				<p>{$lang.assigned_to_objects|replace:"[objects]":$block_data.assigned_to}</p>
				<p class="right">
					{include file="buttons/button.tpl" but_text=$lang.assign_to_all but_href="$index_script?dispatch=block_manager.bulk_actions.assign_to_all&amp;block_id=`$block_data.block_id`&amp;selected_section=`$smarty.request.selected_section`" but_role="simple"}&nbsp;/{include file="buttons/button.tpl" but_text=$lang.remove_from_all but_href="$index_script?dispatch=block_manager.bulk_actions.remove_from_all&amp;block_id=`$block_data.block_id`&amp;selected_section=`$smarty.request.selected_section`" but_role="simple"}
				</p>
				<p class="right">{include file="buttons/button.tpl" but_text=$but_text but_href="$index_script?dispatch=`$block_data.location`.manage" but_role="simple"}</p>
			</div>
		{/if}

		<div class="break">
			<div class="float-right">
			{if $block_data.location == "all_pages" && $smarty.request.selected_section && $smarty.request.selected_section != "all_pages"}
				{if $block_data.status == "A"}
					{assign var="_block_id" value=$block_data.block_id}
				{else}
					{assign var="_block_id" value=0}
				{/if}

				{if $block_data.disabled_locations|strpos:$smarty.request.selected_section === false && $block_data.status == "A"}
					{assign var="status" value="A"}
				{else}
					{assign var="status" value="D"}
				{/if}

				{include file="common_templates/select_popup.tpl" id=$_block_id status=$status object_id_name="block_id" table="blocks" update_controller="block_manager" items_status="A: `$lang.active`, D: `$lang.disabled`" extra="&amp;selected_location=`$smarty.request.selected_section`&amp;block_location=`$block_data.location`"}
			{else}
				{include file="common_templates/select_popup.tpl" id=$block_data.block_id status=$block_data.status object_id_name="block_id" table="blocks"}
			{/if}
			</div>

			{include file="common_templates/object_group.tpl" content=$smarty.capture.update_block id="`$block_data.block_id`_`$location`" no_table=true but_name="dispatch[block_manager.update]" href="$index_script?dispatch=block_manager.update&amp;block_id=`$block_data.block_id`&amp;location=$location&amp;position=$position" header_text="`$lang.editing_block`: `$block_data.block`"}
		</div>



	</div>

	<div class="block-bottom"><p class="no-margin">&nbsp;</p></div>
</div>
{/if}