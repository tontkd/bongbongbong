{* $Id: details.tpl 7760 2009-07-29 11:53:02Z zeke $ *}

{capture name="mainbox"}

{capture name="tools"}
	<div class="float-right">
		{if $prev_id}
			<a class="lowercase" href="{$index_script}?dispatch=orders.details&amp;order_id={$prev_id}">&laquo;&nbsp;{$lang.previous_order}</a>&nbsp;&nbsp;&nbsp;
		{/if}
	
		{if $next_id}
			<a class="lowercase" href="{$index_script}?dispatch=orders.details&amp;order_id={$next_id}">{$lang.next_order}&nbsp;&raquo;</a>
		{/if}
	</div>
{/capture}

{capture name="extra_tools"}
	{hook name="orders:details_tools"}
	{include file="buttons/button_popup.tpl" but_text=$lang.print_invoice but_href="`$index_script`?dispatch=orders.print_invoice&order_id=`$order_info.order_id`" width="900" height="600" but_role="tool"}&nbsp;|&nbsp;
	{include file="buttons/button.tpl" but_text=$lang.print_pdf_invoice but_href="`$index_script`?dispatch=orders.print_invoice&order_id=`$order_info.order_id`&format=pdf" but_role="tool"}&nbsp;|&nbsp;
	{include file="buttons/button_popup.tpl" but_text=$lang.print_packing_slip but_href="`$index_script`?dispatch=orders.print_packing_slip&order_id=`$order_info.order_id`" width="900" height="600" but_role="tool"}&nbsp;|&nbsp;
	{include file="buttons/button.tpl" but_text=$lang.edit_order but_href="$index_script?dispatch=order_management.edit&order_id=`$order_info.order_id`" but_role="tool"}
	{/hook}
{/capture}

{capture name="tabsbox"}

<form action="{$index_script}" method="post" name="order_info_form" class="cm-form-highlight">
<input type="hidden" name="order_id" value="{$smarty.request.order_id}" />
<input type="hidden" name="order_status" value="{$order_info.status}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

<div id="content_general">

	<div class="item-summary clear center">
		<div class="float-right">{assign var="order_status_descr" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true}
		{include file="common_templates/select_popup.tpl" suffix="o" id=$order_info.order_id status=$order_info.status items_status=$order_status_descr update_controller="orders" notify=true}
		</div>

		<div class="float-left">
		{$lang.order}&nbsp;&nbsp;<span>#{$order_info.order_id}</span>&nbsp;
		{$lang.by}&nbsp;&nbsp;<strong>{if $order_info.user_id}<a href="{$index_script}?dispatch=profiles.update&amp;user_id={$order_info.user_id}">{/if}{$order_info.firstname}&nbsp;{$order_info.lastname}{if $order_info.user_id}</a>{/if}</strong>&nbsp;
		{$lang.on}&nbsp;<a href="{$index_script}?dispatch=orders.manage&amp;period=C&amp;time_from={$order_info.timestamp|date_format:"`$settings.Appearance.date_format`"|escape:url}&amp;time_to={$order_info.timestamp|date_format:"`$settings.Appearance.date_format`"|escape:url}">{$order_info.timestamp|date_format:"`$settings.Appearance.date_format`"}</a>,&nbsp;&nbsp;{$order_info.timestamp|date_format:"`$settings.Appearance.time_format`"}
		</div>
		
		{hook name="orders:customer_shot_info"}
		{/hook}
	</div>
	
	{* Customer info *}
	{include file="views/profiles/components/profiles_info.tpl" user_data=$order_info location="I" payment_info=true}
	{* /Customer info *}

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th>{$lang.product}</th>
		<th width="5%">{$lang.price}</th>
		<th width="5%">{$lang.quantity}</th>
		{if $order_info.use_discount}
		<th width="5%">{$lang.discount}</th>
		{/if}
		{if $order_info.taxes}
		<th width="5%">&nbsp;{$lang.tax}</th>
		{/if}
		<th width="7%" class="right">&nbsp;{$lang.subtotal}</th>
	</tr>
	{foreach from=$order_info.items item="oi" key="key"}
	{hook name="orders:items_list_row"}
	{if !$oi.extra.parent}
	<tr {cycle values="class=\"table-row\", " name="class_cycle"}>
		<td>
			{if $oi.deleted_product}{$lang.deleted_product}{else}<a href="{$index_script}?dispatch=products.update&amp;product_id={$oi.product_id}">{$oi.product|unescape}</a>{/if}
			{hook name="orders:product_info"}
			{if $oi.product_code}</p>{$lang.sku}:&nbsp;{$oi.product_code}</p>{/if}
			{/hook}
			{if $oi.product_options}<div class="options-info">{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}
		</td>
		<td class="nowrap">
			{if $oi.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$oi.base_price}{/if}</td>
		<td class="center">&nbsp;{$oi.amount}</td>
		{if $order_info.use_discount}
		<td class="nowrap">
			{if $oi.extra.discount|floatval}{include file="common_templates/price.tpl" value=$oi.extra.discount}{else}-{/if}</td>
		{/if}
		{if $order_info.taxes}
		<td class="nowrap">
			{if $oi.tax_value|floatval}{include file="common_templates/price.tpl" value=$oi.tax_value}{else}-{/if}</td>
		{/if}
		<td class="right">&nbsp;<strong>{if $oi.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$oi.display_subtotal}{/if}</strong></td>
	</tr>
	{/if}
	{/hook}
	{/foreach}
	{hook name="orders:extra_list"}
	{/hook}
	</table>

	{* text_no_items_found*}

	<!--{***** Customer note, Staff note & Statistics *****}-->
	{hook name="orders:totals"}
	<div class="clear order-notes">
	<div class="float-left">
		<h3><label for="notes">{$lang.customer_notes}:</label></h3>
		<textarea class="input-textarea" name="update_order[notes]" id="notes" cols="40" rows="5">{$order_info.notes}</textarea>
	</div>
	
	<div class="float-left">
		<h3><label for="details">{$lang.staff_only_notes}:</label></h3>
		<textarea class="input-textarea" name="update_order[details]" id="details" cols="40" rows="5">{$order_info.details}</textarea>
	</div>

	<div class="float-right statistic-container">
		<ul class="statistic-list">
			<li>
				<em>{$lang.subtotal}:</em>
				<strong>{include file="common_templates/price.tpl" value=$order_info.display_subtotal}</strong>
			</li>

			{if $order_info.display_shipping_cost|floatval}
				<li>
					<em>{$lang.shipping_cost}:</em>
					<strong>{include file="common_templates/price.tpl" value=$order_info.display_shipping_cost}</strong>
				</li>
			{/if}

			{if $order_info.discount|floatval}
				<li>
					<em>{$lang.including_discount}:</em>
					<strong>{include file="common_templates/price.tpl" value=$order_info.discount}</strong>
				</li>
			{/if}

			{if $order_info.subtotal_discount|floatval}
			<li>
				<em>{$lang.order_discount}:</em>
				<strong>{include file="common_templates/price.tpl" value=$order_info.subtotal_discount}</strong>
			</li>
			{/if}

			{if $order_info.coupons}
			{foreach from=$order_info.coupons key="coupon" item="_c"}
				<li>
					<em>{$lang.discount_coupon}:</em>
					<strong>{$coupon}</strong>
				</li>
			{/foreach}
			{/if}

			{if $order_info.taxes}
				<li>
					<em>{$lang.taxes}:</em>
					<strong>&nbsp;</strong>
				</li>

				{foreach from=$order_info.taxes item="tax_data"}
				<li>
					<em>&nbsp;<strong>&middot;</strong>&nbsp;{$tax_data.description}&nbsp;{include file="common_templates/modifier.tpl" mod_value=$tax_data.rate_value mod_type=$tax_data.rate_type}{if $tax_data.price_includes_tax == "Y" && $settings.Appearance.cart_prices_w_taxes != "Y"}&nbsp;{$lang.included}{/if}{if $tax_data.regnumber}&nbsp;({$tax_data.regnumber}){/if}</em>
					<strong>{include file="common_templates/price.tpl" value=$tax_data.tax_subtotal}</strong>
				</li>
				{/foreach}
			{/if}

			{if $order_info.tax_exempt == "Y"}
				<li>
					<em>{$lang.tax_exempt}</em>
					<strong>&nbsp;</strong>
				</li>
			{/if}

			{if $order_info.payment_surcharge|floatval}
				<li>
					<em>{$lang.payment_surcharge}:</em>
					<strong>{include file="common_templates/price.tpl" value=$order_info.payment_surcharge}</strong>
				</li>
			{/if}

			{hook name="orders:totals_content"}
			{/hook}

			<li class="total">
				<em>{$lang.total}:</em>
				<strong>{include file="common_templates/price.tpl" value=$order_info.total}</strong>
			</li>
		</ul>
	</div>
	</div>
	{/hook}
	<!--{***** /Customer note, Staff note & Statistics *****}-->
	
	{hook name="orders:staff_only_note"}
	{/hook}

<!--content_general--></div>

<div id="content_addons">

	{hook name="orders:customer_info"}
	{/hook}

<!--content_addons--></div>

{if $downloads_exist}
<div id="content_downloads">
	<input type="hidden" name="order_id" value="{$smarty.request.order_id}" />
	<input type="hidden" name="order_status" value="{$order_info.status}" />
	{foreach from=$order_info.items item="oi"}
	{if $oi.extra.is_edp == "Y"}
	<p><a href="{$index_script}?dispatch=products.update&amp;product_id={$oi.product_id}">{$oi.product}</a></p>
		{if $oi.files}
		<input type="hidden" name="files_exists[]" value="{$oi.product_id}" />
		<table cellpadding="5" cellspacing="0" border="0" class="table">
		<tr>
			<th>{$lang.filename}</th>
			<th>{$lang.activation_mode}</th>
			<th>{$lang.downloads_max_left}</th>
			<th>{$lang.download_key_expiry}</th>
			<th>{$lang.active}</th>
		</tr>
		{foreach from=$oi.files item="file"}
		<tr>
			<td>{$file.file_name}</td>
			<td>
				{if $file.activation_type == "M"}{$lang.manually}</label>{elseif $file.activation_type == "I"}{$lang.immediately}{else}{$lang.after_full_payment}{/if}
			</td>
			<td>{if $file.max_downloads}{$file.max_downloads} / <input type="text" class="input-text-short" name="edp_downloads[{$file.ekey}][{$file.file_id}]" value="{math equation="a-b" a=$file.max_downloads b=$file.downloads|default:0}" size="3" />{else}{$lang.none}{/if}</td>
			<td>
				{if $file.ekey}
				<p><label>{$lang.download_key_expiry}: </label><strong>{$file.ttl|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"|default:"n/a"}</strong></p>
				
				<p><label>{$lang.prolongate_download_key}: </label>{include file="common_templates/calendar.tpl" date_id="prolongate_date_`$file.file_id`" date_name="prolongate_data[`$file.ekey`]" date_val=$file.ttl|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}</p>
				{else}{$lang.file_doesnt_have_key}{/if}
			</td>
			<td>
				<select name="activate_files[{$oi.product_id}][{$file.file_id}]">
					<option value="Y" {if $file.active == "Y"}selected="selected"{/if}>{$lang.active}</option>
					<option value="N" {if $file.active == "N"}selected="selected"{/if}>{$lang.not_active}</option>
				</select>
			</td>
		</tr>
		{/foreach}
		</table>
		{/if}
	{/if}
	{/foreach}
<!--content_downloads--></div>
{/if}

{if $order_info.promotions}
<div id="content_promotions">
	{include file="views/orders/components/promotions.tpl" promotions=$order_info.promotions}
<!--content_promotions--></div>
{/if}

{hook name="orders:tabs_content"}
{/hook}

<div class="cm-toggle-button">
	<div class="select-field notify-customer">
		<input type="checkbox" name="notify_user" id="notify_user" value="Y" class="checkbox" />
		<label for="notify_user">{$lang.notify_customer}</label>
	</div>

	<div class="buttons-container buttons-bg">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[orders.update_details]"}
	</div>
</div>
</form>

{if $google_info}
<div class="cm-hide-save-button" id="content_google">
	{include file="views/orders/components/google_actions.tpl"}
<!--content_google--></div>
{/if}

{hook name="orders:tabs_extra"}
{/hook}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

{/capture}
{capture name="mainbox_title"}
	{$lang.viewing_order} #{$order_info.order_id} <span class="total">( {$lang.total}: <strong>{include file="common_templates/price.tpl" value=$order_info.total}</strong> )</span>
{/capture}
{include file="common_templates/mainbox.tpl" title=$smarty.capture.mainbox_title content=$smarty.capture.mainbox tools=$smarty.capture.tools extra_tools=$smarty.capture.extra_tools}