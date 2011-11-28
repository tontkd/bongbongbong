{* $Id: update.tpl 7745 2009-07-21 07:15:15Z alexions $ *}

{** include fileuploader **}
{include file="common_templates/file_browser.tpl"}
{** /include fileuploader **}

{capture name="mainbox"}

{notes}
{include file="common_templates/create_thumbnails.tpl" width=$settings.Thumbnails.product_thumbnail_width option_name="product_thumbnail_width"}
{/notes}

{capture name="tabsbox"}
{** /Item menu section **}

<form action="{$index_script}" method="post" name="product_update_form" class="cm-form-highlight" enctype="multipart/form-data"> {* product update form *}
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" id="selected_section" value="{$smarty.request.selected_section}" />
<input type="hidden" name="product_id" value="{$product_data.product_id}" />

{** Product description section **}

<div id="content_detailed"> {* content detailed *}

{** General info section **}
<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.information}

<div class="form-field">
	<label for="product_description_product" class="cm-required">{$lang.name}:</label>
	<input type="text" name="product_data[product]" id="product_description_product" size="55" value="{$product_data.product}" class="input-text-large main-input" />
</div>

<div class="form-field">
	{if "categories"|fn_show_picker:$smarty.const.CATEGORY_THRESHOLD}
		<label for="main_category_id" class="cm-required">{$lang.main_category}:</label>
		{include file="pickers/categories_picker.tpl" data_id="main_category" input_name="product_data[main_category]" item_ids=$product_data.main_category|default:$smarty.request.category_id hide_link=true hide_delete_button=true display_input_id="main_category_id" disable_no_item_text=true}
	{else}
		<label for="products_categories_M" class="cm-required">{$lang.main_category}:</label>
		<select	name="product_data[main_category]" id="products_categories_M">
			{foreach from=0|fn_get_plain_categories_tree:false item="cat"}
				<option	value="{$cat.category_id}" {if $product_data.main_category == $cat.category_id || $cat.category_id == $smarty.request.category_id}selected="selected"{/if}>{$cat.category|indent:$cat.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
			{/foreach}
		</select>
	{/if}
</div>

<div class="form-field">
	<label for="price_price" class="cm-required">{$lang.price} ({$currencies.$primary_currency.symbol}) :</label>
	<input type="text" name="product_data[price]" id="price_price" size="10" value="{$product_data.price|default:"0.00"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_full_descr">{$lang.full_description}:</label>
	<textarea id="product_full_descr" name="product_data[full_description]" cols="55" rows="8" class="input-textarea-long">{$product_data.full_description}</textarea>
	<p>{include file="common_templates/wysiwyg.tpl" id="product_full_descr"}</p>
</div>
{** /General info section **}

{include file="common_templates/select_status.tpl" input_name="product_data[status]" id="product_data" obj=$product_data hidden=true}

<div class="form-field">
	<label>{$lang.images}:</label>
	{include file="common_templates/attach_images.tpl" image_name="product_main" image_object_type="product" image_pair=$product_data.main_pair icon_text=$lang.text_product_thumbnail detailed_text=$lang.text_product_detailed_image}
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.pricing_inventory}

<div class="form-field">
	<label for="product_product_code">{$lang.product_code}:</label>
	<input type="text" name="product_data[product_code]" id="product_product_code" size="20" value="{$product_data.product_code}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_list_price">{$lang.list_price} ({$currencies.$primary_currency.symbol}) :</label>
	<input type="text" name="product_data[list_price]" id="product_data_list_price" size="10" value="{$product_data.list_price|default:"0.00"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_amount">{$lang.in_stock}:</label>
	{if $product_data.tracking == "O"}
		{include file="buttons/button.tpl" but_text=$lang.edit but_href="$index_script?dispatch=product_options.inventory&product_id=`$product_data.product_id`" but_role="edit"}
	{else}
		<input type="text" name="product_data[amount]" id="product_amount" size="10" value="{$product_data.amount|default:"1"}" class="input-text-short" />
	{/if}
</div>

<div class="form-field">
	<label for="zero_price_action">{$lang.zero_price_action}:</label>
	<select name="product_data[zero_price_action]" id="zero_price_action">
		<option value="R" {if $product_data.zero_price_action == "R"}selected="selected"{/if}>{$lang.zpa_refuse}</option>
		<option value="P" {if $product_data.zero_price_action == "P"}selected="selected"{/if}>{$lang.zpa_permit}</option>
		<option value="A" {if $product_data.zero_price_action == "A"}selected="selected"{/if}>{$lang.zpa_ask_price}</option>
	</select>
</div>

<div class="form-field">
	<label for="product_tracking">{$lang.inventory}:</label>
	<select name="product_data[tracking]" id="product_tracking">
		{if $product_options}
			<option value="O" {if $product_data.tracking == "O"}selected="selected"{/if}>{$lang.track_with_options}</option>
		{/if}
		<option value="B" {if $product_data.tracking == "B"}selected="selected"{/if}>{$lang.track_without_options}</option>
		<option value="D" {if $product_data.tracking == "D"}selected="selected"{/if}>{$lang.dont_track}</option>
	</select>
</div>

<div class="form-field">
	<label for="min_qty">{$lang.min_order_qty}:</label>
	<input type="text" name="product_data[min_qty]" size="10" id="min_qty" value="{$product_data.min_qty|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="max_qty">{$lang.max_order_qty}:</label>
	<input type="text" name="product_data[max_qty]" id="max_qty" size="10" value="{$product_data.max_qty|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="qty_step">{$lang.quantity_step}:</label>
	<input type="text" name="product_data[qty_step]" id="qty_step" size="10" value="{$product_data.qty_step|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="list_qty_count">{$lang.list_quantity_count}:</label>
	<input type="text" name="product_data[list_qty_count]" id="list_qty_count" size="10" value="{$product_data.list_qty_count|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="product_weight">{$lang.weight} ({$settings.General.weight_symbol}) :</label>
	<input type="text" name="product_data[weight]" id="product_weight" size="10" value="{$product_data.weight|default:"0"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_free_shipping">{$lang.free_shipping}:</label>
	<input type="hidden" name="product_data[free_shipping]" value="N" />
	<input type="checkbox" name="product_data[free_shipping]" id="product_free_shipping" value="Y" {if $product_data.free_shipping == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="product_shipping_freight">{$lang.shipping_freight} ({$currencies.$primary_currency.symbol}):</label>
	<input type="text" name="product_data[shipping_freight]" id="product_shipping_freight" size="10" value="{$product_data.shipping_freight|default:"0.00"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="products_tax_id">{$lang.taxes}:</label>
	<div class="select-field">
		<input type="hidden" name="product_data[tax_ids]" value="" />
		{foreach from=$taxes item="tax"}
			<input type="checkbox" name="product_data[tax_ids][{$tax.tax_id}]" id="product_data_{$tax.tax_id}" {if $tax.tax_id|in_array:$product_data.taxes || $product_data.taxes[$tax.tax_id]}checked="checked"{/if} class="checkbox" value="{$tax.tax_id}" />
			<label for="product_data_{$tax.tax_id}">{$tax.tax}</label>
		{foreachelse}
			&ndash;
		{/foreach}
	</div>
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.seo_meta_data}

<div class="form-field">
	<label for="product_page_title">{$lang.page_title}:</label>
	<input type="text" name="product_data[page_title]" id="product_page_title" size="55" value="{$product_data.page_title}" class="input-text-large" />
</div>

<div class="form-field">
	<label for="product_meta_descr">{$lang.meta_description}:</label>
	<textarea name="product_data[meta_description]" id="product_meta_descr" cols="55" rows="2" class="input-textarea-long">{$product_data.meta_description}</textarea>
</div>

<div class="form-field">
	<label for="product_meta_keywords">{$lang.meta_keywords}:</label>
	<textarea name="product_data[meta_keywords]" id="product_meta_keywords" cols="55" rows="2" class="input-textarea-long">{$product_data.meta_keywords}</textarea>
</div>

<div class="form-field">
	<label for="product_search_words">{$lang.search_words}:</label>
	<textarea name="product_data[search_words]" id="product_search_words" cols="55" rows="2" class="input-textarea-long">{$product_data.search_words}</textarea>
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.availability}

<div class="form-field">
	<label>{$lang.created_date}:</label>
	{include file="common_templates/calendar.tpl" date_id="date_holder" date_name="product_data[timestamp]" date_val=$product_data.timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
</div>

<div class="form-field">
	<label for="date_avail_holder">{$lang.available_since}:</label>
	{include file="common_templates/calendar.tpl" date_id="date_avail_holder" date_name="product_data[avail_since]" date_val=$product_data.avail_since|default:"" start_year=$settings.Company.company_start_year}
</div>

<div class="form-field">
	<label for="buy_in_advance">{$lang.buy_in_advance}:</label>
	<input type="hidden" name="product_data[buy_in_advance]" value="N" />
	<input type="checkbox" id="buy_in_advance" name="product_data[buy_in_advance]" value="Y" {if $product_data.buy_in_advance == "Y"}checked="checked"{/if} class="checkbox" />
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.extra}

<div class="form-field">
	<label for="product_feature_comparison">{$lang.feature_comparison}:</label>
	<input type="hidden" name="product_data[feature_comparison]" value="N" />
	<input type="checkbox" name="product_data[feature_comparison]" id="product_feature_comparison" value="Y" {if $product_data.feature_comparison == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="product_is_edp">{$lang.downloadable}:</label>
	<input type="hidden" name="product_data[is_edp]" value="N" />
	<input type="checkbox" name="product_data[is_edp]" id="product_is_edp" value="Y" {if $product_data.is_edp == "Y"}checked="checked"{/if} onclick="$('#edp_shipping').toggleBy(); $('#edp_unlimited').toggleBy();" class="checkbox" />
</div>

<div class="form-field {if $product_data.is_edp != "Y"}hidden{/if}" id="edp_shipping">
	<label for="product_edp_shipping">{$lang.edp_enable_shipping}:</label>
	<input type="hidden" name="product_data[edp_shipping]" value="N" />
	<input type="checkbox" name="product_data[edp_shipping]" id="product_edp_shipping" value="Y" {if $product_data.edp_shipping == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field {if $product_data.is_edp != "Y"}hidden{/if}" id="edp_unlimited">
	<label for="product_edp_unlimited">{$lang.time_unlimited_download}:</label>
	<input type="hidden" name="product_data[edp_unlimited_expire]" value="N" />
	<input type="checkbox" name="product_data[unlimited_download]" id="product_edp_unlimited" value="Y" {if $product_data.unlimited_download == "Y"}checked="checked"{/if} class="checkbox" />
</div>

{include file="views/localizations/components/select.tpl" data_from=$product_data.localization data_name="product_data[localization]"}

<div class="form-field">
	<label for="product_short_descr">{$lang.short_description}:</label>
	<textarea id="product_short_descr" name="product_data[short_description]" cols="55" rows="2" class="input-textarea-long">{$product_data.short_description}</textarea>
	<p>{include file="common_templates/wysiwyg.tpl" id="product_short_descr"}</p>
</div>

<div class="form-field">
	<label for="product_popularity">{$lang.popularity}:</label>
	<input type="text" name="product_data[popularity]" id="product_popularity" size="55" value="{$product_data.popularity|default:0}" class="input-text-medium" />
</div>

</fieldset>
</div> {* /content detailed *}

{** /Product description section **}

{** Product categories section **}
<div id="content_categories" class="hidden"> {* content categories *}
	{include file="pickers/categories_picker.tpl" input_name="product_data[add_categories]" item_ids=$product_data.add_categories multiple=true single_line=true}
</div> {* /content categories *}
{** /Product categories section **}

{** Product images section **}
<div id="content_images" class="hidden"> {* content images *}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.additional_images}
	{foreach from=$product_data.image_pairs item=pair name="detailed_images"}
		{include file="common_templates/attach_images.tpl" image_name="product_additional" image_object_type="product" image_key=$pair.pair_id image_type="A" image_pair=$pair icon_title=$lang.additional_thumbnail detailed_title=$lang.additional_popup_larger_image icon_text=$lang.text_additional_thumbnail detailed_text=$lang.text_additional_detailed_image delete_pair=true}
		<hr />
	{/foreach}
</fieldset>

<div id="box_new_image" class="margin-top">
	<div class="clear cm-row-item">
		<div class="float-left">{include file="common_templates/attach_images.tpl" image_name="product_add_additional" image_object_type="product" image_type="A" icon_title=$lang.additional_thumbnail detailed_title=$lang.additional_popup_larger_image icon_text=$lang.text_additional_thumbnail detailed_text=$lang.text_additional_detailed_image}</div>
		<div class="buttons-container">{include file="buttons/multiple_buttons.tpl" item_id="new_image"}</div>
	</div>
	<hr />
</div>

</div> {* /content images *}
{** /Product images section **}

{** Quantity discounts section **}
{include file="views/products/components/products_update_qty_discounts.tpl"}
{** /Quantity discounts section **}

{** Product features section **}
{include file="views/products/components/products_update_features.tpl"}
{** /Product features section **}

{if $mode != "add"}
<div id="content_blocks">
	{include file="views/block_manager/components/select_blocks.tpl" object_id=$product_data.product_id data_name="product_data" section="products"}
</div>
{/if}

<div id="content_addons">
{hook name="products:detailed_content"}
{/hook}
</div>


{hook name="products:tabs_content"}
{/hook}

{** Form submit section **}

<div class="buttons-container cm-toggle-button buttons-bg">
	{if $mode == "add"}
		{include file="buttons/create_cancel.tpl" but_name="dispatch[products.add]"}
	{else}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[products.update]"}
	{/if}
</div>
{** /Form submit section **}

</form> {* /product update form *}

{hook name="products:tabs_extra"}{/hook}

{if $mode == "update"}
{** Product options section **}
<div class="cm-hide-save-button hidden" id="content_options">
	{include file="views/products/components/products_update_options.tpl"}
</div>
{** /Product options section **}

{** Products files section **}
<div id="content_files" class="cm-hide-save-button hidden">
	{include file="views/products/components/products_update_files.tpl"}
</div>
{** /Products files section **}
{/if}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox group_name=$controller active_tab=$smarty.request.selected_section track=true}

{/capture}
{if $mode == "add"}
	{include file="common_templates/mainbox.tpl" title=$lang.new_product content=$smarty.capture.mainbox}
{else}
	{notes title=$lang.preview}
		<p>{$lang.txt_page_access_link}: <a target="_blank" title="{$config.customer_index}?dispatch=products.view&amp;product_id={$product_data.product_id}" href="{$config.customer_index}?dispatch=products.view&amp;product_id={$product_data.product_id}">{"`$config.customer_index`?dispatch=products.view&amp;product_id=`$product_data.product_id`"|fn_compact_value:28}</a></p>
	{/notes}
	{include file="common_templates/mainbox.tpl" title="`$lang.editing_product`:&nbsp;`$product_data.product`"|unescape content=$smarty.capture.mainbox select_languages=true}
{/if}
