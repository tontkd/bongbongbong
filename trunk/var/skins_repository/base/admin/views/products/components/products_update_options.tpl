{* $Id: products_update_options.tpl 6831 2009-01-27 14:32:41Z angel $ *}

{capture name="extra"}
	{if $global_options}
		{capture name="add_global_option"}
		<form action="{$index_script}" method="post" name="apply_global_option">
		<input type="hidden" name="product_id" value="{$smarty.request.product_id}" />
		<input type="hidden" name="selected_section" value="options" />
							
		<div class="object-container">
			<div class="form-field">
				<label for="global_option_id">{$lang.global_options}:</label>
				<select name="global_option[id]" id="global_option_id">
					{foreach from=$global_options item="option_" key="option_id"}
						<option value="{$option_id}">{$option_.option_name}</option>
					{/foreach}
				</select>
			</div>

			<div class="form-field">
				<label for="global_option_link">{$lang.apply_as_link}:</label>
				<input type="hidden" name="global_option[link]" value="N" />
				<input type="checkbox" name="global_option[link]" id="global_option_link" value="Y" class="checkbox" />
			</div>
		</div>

		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.apply but_name="dispatch[products.apply_global_option]"  cancel_action="close"}
		</div>

		</form>
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_global_option" text=$lang.add_global_option content=$smarty.capture.add_global_option link_text=$lang.add_global_option act="general"}
	{/if}

	{if $product_options}
		{include file="buttons/button.tpl" but_text=$lang.exceptions but_href="$index_script?dispatch=product_options.exceptions&product_id=`$product_data.product_id`" but_role="text"}
		{if $has_inventory}
			{include file="buttons/button.tpl" but_text=$lang.option_combinations but_href="$index_script?dispatch=product_options.inventory&product_id=`$product_data.product_id`" but_role="text"}
		{else}
			{capture name="notes_picker"}
				<div class="object-container">
					{$lang.text_options_no_inventory}
				</div>
			{/capture}
			{include file="common_templates/popupbox.tpl" act="button" id="content_option_combinations" text=$lang.note content=$smarty.capture.notes_picker link_text=$lang.option_combinations but_href="$index_script?dispatch=product_options.inventory&product_id=`$product_data.product_id`" but_role="text" extra_act="notes"}
		{/if}
	{/if}
{/capture}

{include file="views/product_options/manage.tpl" object="product" extra=$smarty.capture.extra product_id=$smarty.request.product_id}
