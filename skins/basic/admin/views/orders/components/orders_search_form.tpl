{* $Id: orders_search_form.tpl 6971 2009-03-05 09:28:18Z zeke $ *}

{capture name="section"}

<form action="{$index_script}" name="orders_search_form" method="get">

{if $smarty.request.redirect_url}
<input type="hidden" name="redirect_url" value="{$smarty.request.redirect_url}" />
{/if}
{if $selected_section != ""}
<input type="hidden" id="selected_section" name="selected_section" value="{$selected_section}" />
{/if}

{$extra}

<table cellpadding="10" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label for="cname">{$lang.customer}:</label>
		<div class="break">
			<input type="text" name="cname" id="cname" value="{$search.cname}" size="30" class="search-input-text" />
			{include file="buttons/search_go.tpl" search="Y" but_name=$dispatch}
		</div>
	</td>
	<td class="search-field">
		<label for="email">{$lang.email}:</label>
		<div class="break">
			<input type="text" name="email" id="email" value="{$search.email}" size="30" class="input-text" />
		</div>
	</td>
	<td class="nowrap search-field">
		<label for="total_from">{$lang.total}&nbsp;({$currencies.$primary_currency.symbol}):</label>
		<div class="break">
			<input type="text" name="total_from" id="total_from" value="{$search.total_from}" size="3" class="input-text-price" />&nbsp;&ndash;&nbsp;<input type="text" name="total_to" value="{$search.total_to}" size="3" class="input-text-price" />
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.search but_name="dispatch[`$dispatch`]" but_role="submit"}
	</td>
</tr>
</table>

{capture name="advanced_search"}

<div class="search-field">
	<label for="tax_exempt">{$lang.tax_exempt}:</label>
	<select name="tax_exempt" id="tax_exempt">
		<option value="">--</option>
		<option value="Y" {if $search.tax_exempt == "Y"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="N" {if $search.tax_exempt == "N"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>

<div class="search-field">
	<label>{$lang.order_status}:</label>
	{include file="common_templates/status.tpl" status=$search.status display="checkboxes" name="status"}
</div>

<div class="search-field">
	<label>{$lang.period}:</label>
	{include file="common_templates/period_selector.tpl" period=$search.period form_name="orders_search_form"}
</div>

<div class="search-field">
	<label for="order_id">{$lang.order_id}:</label>
	<input type="text" name="order_id" id="order_id" value="{$search.order_id}" size="10" class="input-text" />
</div>

<div class="search-field">
	<label for="order_id">{$lang.shipping}:</label>
	{html_checkboxes name="shippings" options=$shippings selected=$search.shippings columns=4}
</div>

<div class="search-field">
	<label for="a_uid">{$lang.new_orders}:</label>
	<input type="checkbox" name="admin_user_id" id="a_uid" value="{$auth.user_id}" class="checkbox" {if $search.admin_user_id}checked="checked"{/if} />
</div>

{hook name="orders:search_form"}
{/hook}

<div class="search-field">
	<label>{$lang.ordered_products}:</label>
	{include file="pickers/search_products_picker.tpl"}
</div>

{/capture}

{include file="common_templates/advanced_search.tpl" content=$smarty.capture.advanced_search dispatch=$dispatch view_type="orders"}

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}
