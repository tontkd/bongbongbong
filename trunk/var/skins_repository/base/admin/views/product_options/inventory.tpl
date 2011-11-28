{* $Id: inventory.tpl 7408 2009-04-30 14:52:01Z zeke $ *}

<form action="{$index_script}" method="post" name="product_options_form" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="product_id" value="{$product_id}" />

{** include fileuploader **}
{include file="common_templates/file_browser.tpl"}
{** /include fileuploader **}

{capture name="mainbox"}

{notes}
	{include file="common_templates/create_thumbnails.tpl" width=$settings.Thumbnails.product_thumbnail_width option_name="product_thumbnail_width"}
{/notes}

{include file="common_templates/pagination.tpl"}
<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="100%">{$lang.combination}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$inventory item="i"}
<tr {cycle values="class=\"table-row\", "} valign="top">
	<td class="center"><input type="checkbox" name="combination_hashes[]" value="{$i.combination_hash}" class="checkbox cm-item" /></td>
	<td>
		{foreach from=$i.combination item="c" key="k"}
		<div class="form-field">
			<label>{$product_options.$k.option_name}:</label>
			{if $product_options.$k.option_type == "C"}
				[{if $product_options.$k.variants.$c.position == "1"}{$lang.yes}{else}{$lang.no}{/if}]
			{else}
				{$product_options.$k.variants.$c.variant_name}
			{/if}
		</div>
		{/foreach}

		<div class="form-field">
			<label>{$lang.product_code}:</label>
			<input type="text" name="inventory[{$i.combination_hash}][product_code]" class="input-text" size="16" value="{$i.product_code}" />
		</div>

		{if $product_inventory == "O"}
		<div class="form-field">
			<label>{$lang.quantity}:</label>
			<input type="text" name="inventory[{$i.combination_hash}][amount]" size="10" value="{$i.amount}" class="input-text-short" />
		</div>
		{else}
			<input type="hidden" name="inventory[{$i.combination_hash}][amount]" size="10" value="{$i.amount}" />
		{/if}

		{include file="common_templates/attach_images.tpl" image_name="combinations" image_object_type="product_option" image_pair=$i.image_pairs image_object_id=$i.combination_hash image_key=$i.combination_hash icon_title=$lang.additional__option_thumbnail}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{$index_script}?dispatch=product_options.delete_combination&amp;combination_hashe={$i.combination_hash}&amp;product_id={$product_id}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$i.combination_hash tools_list=$smarty.capture.tools_items}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="3"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}


<div class="buttons-container buttons-bg">
	{if $inventory}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[product_options.delete_combinations]" class="cm-process-items cm-confirm" rev="product_options_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[product_options.update_combinations]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
	
	<div class="float-right">
		{include file="common_templates/popupbox.tpl" id="add_new_combination" text=$lang.add_new_combination link_text=$lang.add_combination act="general"}
	</div>
</div>

{capture name="tools"}
	{capture name="add_new_picker"}
	<div class="object-container">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr class="cm-first-sibling">
			<th>{$lang.combination}</th>
			{if $product_inventory == "O"}
			<th>{$lang.in_stock}</th>
			{/if}
			<th>&nbsp;</th>
		</tr>
		<tr id="box_new_item">
			<td>
				<table>
				{foreach from=$product_options item="option" name="add_inv_fe"}
				<tr class="no-border">
					<td>{$option.option_name}</td>
					<td>{if $option.option_type == "C"}
							<select name="add_options_combination[0][{$option.option_id}]">
								{foreach from=$option.variants item="variant"}
								<option value="{$variant.variant_id}">{if $variant.position == 0}{$lang.no}{else}{$lang.yes}{/if}</option>
								{/foreach}
							</select>
						{else}
							<select name="add_options_combination[0][{$option.option_id}]">
								{foreach from=$option.variants item="variant"}
								<option value="{$variant.variant_id}">{$variant.variant_name}</option>
								{/foreach}
							</select>
						{/if}
					</td>
				</tr>
				{/foreach}
				</table>
			{if $product_inventory != "O"}
				<input type="hidden" name="add_inventory[0][amount]" value="" />
			{/if}
			</td>
			{if $product_inventory == "O"}
			<td valign="top"><input type="text" name="add_inventory[0][amount]" size="10" value="1" class="input-text-short" /></td>
			{/if}
			<td valign="top">{include file="buttons/multiple_buttons.tpl" item_id="new_item"}</td>
		</tr>
		</table>
	</div>

	<div class="buttons-container">
		{include file="buttons/create_cancel.tpl" but_name="dispatch[product_options.add_combinations]" cancel_action="close"}
	</div>
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_combination" text=$lang.add_new_combination content=$smarty.capture.add_new_picker link_text=$lang.add_combination act="general"}
{/capture}

{capture name="extra_tools"}
	{include file="buttons/button.tpl" but_text=$lang.rebuild_combinations but_href="$index_script?dispatch=product_options.rebuild_combinations&amp;product_id=`$product_id`" but_role="tool"}
{/capture}


{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.inventory content=$smarty.capture.mainbox tools=$smarty.capture.tools extra_tools=$smarty.capture.extra_tools}

</form>
