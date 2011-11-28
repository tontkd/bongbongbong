{* $Id: invoice.tpl 7703 2009-07-13 10:36:45Z angel $ *}

{if $order_info}
{literal}
<style type="text/css" media="screen,print">
body,p,div {
	color: #000000;
	font: 12px Arial;
}
body {
	padding: 0;
	margin: 0;
}
a, a:link, a:visited, a:hover, a:active {
	color: #000000;
	text-decoration: underline;
}
a:hover {
	text-decoration: none;
}
</style>
<style media="print">
.main-table {
	background-color: #ffffff !important;
}
</style>
{/literal}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="main-table" style="background-color: #f4f6f8; height: 100%;">
<tr>
	<td align="center" style="width: 100%; height: 100%; padding: 24px 0;">
	<div style="background-color: #ffffff; border: 1px solid #e6e6e6; margin: 0px auto; padding: 0px 44px 0px 46px; width: 510px; text-align: left;">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding: 27px 0px 8px 0px;">
		<tr>
			<td align="left" style="border-bottom: 1px solid #868686; padding-bottom: 3px;" valign="middle"><img src="{$images_dir}/{$manifest.Mail_logo.filename}" width="{$manifest.Mail_logo.width}" height="{$manifest.Mail_logo.height}" border="0" alt="{$settings.Company.company_name}" /></td>
			<td width="100%" valign="bottom" style="border-bottom: 1px solid #868686; text-align: right;  font: bold 26px Arial; text-transform: uppercase;  margin: 0px;">{$lang.invoice_title}</td>
		</tr>
		</table>
	
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td style="width: 50%; padding: 14px 0px 0px 2px;">
				<h2 style="font: bold 12px Arial; margin: 0px 0px 3px 0px;">{$settings.Company.company_name}</h2>
				{$settings.Company.company_address},&nbsp;{$settings.Company.company_city},&nbsp;{$settings.Company.company_country_descr},&nbsp;{$settings.Company.company_state_descr},&nbsp;{$settings.Company.company_zipcode}
				<table cellpadding="0" cellspacing="0" border="0">
				{if $settings.Company.company_phone}
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px;	white-space: nowrap;">{$lang.phone1_label}:</td>
					<td width="100%">{$settings.Company.company_phone}</td>
				</tr>
				{/if}
				{if $settings.Company.company_phone_2}
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.phone2_label}:</td>
					<td width="100%">{$settings.Company.company_phone_2}</td>
				</tr>
				{/if}
				{if $settings.Company.company_fax}
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.fax}:</td>
					<td width="100%">{$settings.Company.company_fax}</td>
				</tr>
				{/if}
				{if $settings.Company.company_website}
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.web_site}:</td>
					<td width="100%">{$settings.Company.company_website}</td>
				</tr>
				{/if}
				{if $settings.Company.company_orders_department}
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.email}:</td>
					<td width="100%"><a href="mailto:{$settings.Company.company_orders_department}">{$settings.Company.company_orders_department}</a></td>
				</tr>
				{/if}
				</table>
			</td>
			
			<td style="padding-top: 14px;">
				<h2 style="font: bold 17px Tahoma; margin: 0px;">{$lang.order}&nbsp;#{$order_info.order_id}</h2>
				<table cellpadding="0" cellspacing="0" border="0">
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.status}:</td>
					<td width="100%">{include file="common_templates/status.tpl" status=$order_info.status display="view"}</td>
				</tr>
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.date}:</td>
					<td>{$order_info.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
				</tr>
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.payment_method}:</td>
					<td>{$order_info.payment_method.payment}</td>
				</tr>
				{if $order_info.shipping}
				<tr valign="top">
					<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.shipping_method}:</td>
					<td>
						{foreach from=$order_info.shipping item="shipping" name="f_shipp"}
							{$shipping.shipping}
							{if !$smarty.foreach.f_shipp.last}, {/if}
							{if $shipping.tracking_number}{assign var="tracking_number_exists" value="Y"}{/if}
						{/foreach}</td>
				</tr>
				{if $tracking_number_exists}
					<tr valign="top">
						<td style="font: 12px verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;">{$lang.tracking_number}:</td>
						<td>
							{foreach from=$order_info.shipping item="shipping" name="f_shipp"}
								{if $shipping.tracking_number}{$shipping.tracking_number}
									{if !$smarty.foreach.f_shipp.last},{/if}
								{/if}
							{/foreach}</td>
					</tr>
				{/if}
				{/if}
				</table>
			</td>
		</tr>
		</table>
	
		{assign var="profile_fields" value='I'|fn_get_profile_fields}
		{split data=$profile_fields.C size=2 assign="contact_fields" simple=true}
		{if $profile_fields}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding: 32px 0px 24px 0px;">
		<tr valign="top">
			{if $profile_fields.C}
			<td width="33%">
				<h3 style="font: bold 17px Tahoma; padding: 0px 0px 3px 1px; margin: 0px;">{$lang.customer}:</h3>
				<p style="margin: 2px 0px 3px 0px;">{$order_info.firstname}&nbsp;{$order_info.lastname}</p>
				<p style="margin: 2px 0px 3px 0px;"><a href="mailto:{$order_info.email}">{$order_info.email}</a></p>
				<p style="margin: 2px 0px 3px 0px;"><span style="text-transform: uppercase;">{$lang.phone}:</span>&nbsp;{$order_info.phone}</p>
				{include file="profiles/profiles_extra_fields.tpl" fields=$profile_fields.C}
			</td>
			{/if}
			{if $profile_fields.B}
			<td width="34%">
				<h3 style="font: bold 17px Tahoma; padding: 0px 0px 3px 1px; margin: 0px;">{$lang.bill_to}:</h3>
				{if $order_info.b_firstname || $order_info.b_lastname}<p style="margin: 2px 0px 3px 0px;">{$order_info.b_firstname}&nbsp;{$order_info.b_lastname}</p>{/if}
				<p style="margin: 2px 0px 3px 0px;">{$order_info.b_address}
				{if $order_info.b_address_2}&nbsp;{$order_info.b_address_2}{/if}
				{if $order_info.b_city && ($order_info.b_address || $order_info.b_address_2)},&nbsp;{/if}
				{$order_info.b_city}
				{if $order_info.b_country_descr && ($order_info.b_address || $order_info.b_address_2 || $order_info.b_city)},&nbsp;{/if}
				{$order_info.b_country_descr}</p>
				
				<p style="margin: 2px 0px 3px 0px;">{$order_info.b_state_descr}
				{if $order_info.b_state_descr || $order_info.b_zipcode},&nbsp;{/if}
				{$order_info.b_zipcode}</p>
				{include file="profiles/profiles_extra_fields.tpl" fields=$profile_fields.B}
			</td>
			{/if}
			{if $profile_fields.S}
			<td width="33%">
				<h3 style="font: bold 17px Tahoma; padding: 0px 0px 3px 1px; margin: 0px;">{$lang.ship_to}:</h3>
				{if $order_info.s_firstname || $order_info.s_lastname}<p style="margin: 2px 0px 3px 0px;">{$order_info.s_firstname}&nbsp;{$order_info.s_lastname}</p>{/if}
				<p style="margin: 2px 0px 3px 0px;">{$order_info.s_address}
				{if $order_info.s_address_2}&nbsp;{$order_info.s_address_2}{/if}
				{if $order_info.s_city && ($order_info.s_address || $order_info.s_address_2)},&nbsp;{/if}
				{$order_info.s_city}
				{if $order_info.s_country_descr && ($order_info.s_city || $order_info.s_address)},&nbsp;{/if}
				{$order_info.s_country_descr}</p>
				
				<p style="margin: 2px 0px 3px 0px;">{$order_info.s_state_descr}
				{if $order_info.s_zipcode && $order_info.s_state_descr},&nbsp;{/if}
				{$order_info.s_zipcode}</p>
				{include file="profiles/profiles_extra_fields.tpl" fields=$profile_fields.S}
			</td>
			{/if}
		</tr>
		</table>
		{/if}
		{* Customer info *}
	
	
		{* Ordered products *}
	
		<table width="100%" cellpadding="0" cellspacing="1" style="background-color: #dddddd;">
		<tr>
			<th width="70%" style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.product}</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.quantity}</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.unit_price}</th>
			{if $order_info.use_discount}
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.discount}</th>
			{/if}
			{if $order_info.taxes}
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.tax}</th>
			{/if}
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.subtotal}</th>
		</tr>
		{foreach from=$order_info.items item="oi"}
		{hook name="orders:items_list_row"}
			{if !$oi.extra.parent}
			<tr>
				<td style="padding: 5px 10px; background-color: #ffffff;">
					{$oi.product|unescape|default:$lang.deleted_product}
					{hook name="orders:product_info"}
					{if $oi.product_code}<p style="margin: 2px 0px 3px 0px;">{$lang.code}:&nbsp;{$oi.product_code}</p>{/if}
					{/hook}
					{if $oi.product_options}<br/>{include file="common_templates/options_info.tpl" product_options=$oi.product_options}{/if}
				</td>
				<td style="padding: 5px 10px; background-color: #ffffff; text-align: center;">{$oi.amount}</td>
				<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $oi.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$oi.price}{/if}</td>
				{if $order_info.use_discount}
				<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $oi.extra.discount|floatval}{include file="common_templates/price.tpl" value=$oi.extra.discount}{else}&nbsp;-&nbsp;{/if}</td>
				{/if}
				{if $order_info.taxes}
				<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $oi.tax_value}{include file="common_templates/price.tpl" value=$oi.tax_value}{else}&nbsp;-&nbsp;{/if}</td>
				{/if}
	
				<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><b>{if $oi.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$oi.display_subtotal}{/if}</b>&nbsp;</td>
			</tr>
			{/if}
		{/hook}
		{/foreach}
		{hook name="orders:extra_list"}
		{/hook}
		</table>
	
		{hook name="orders:ordered_products"}
		{/hook}
		{* /Ordered products *}
	
		{* Order totals *}
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td align="right">
			<table border="0" style="padding: 3px 0px 12px 0px;">
			<tr>
				<td style="text-align: right; white-space: nowrap;"><b>{$lang.subtotal}:</b>&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;">{include file="common_templates/price.tpl" value=$order_info.display_subtotal}</td>
			</tr>
			{if $order_info.discount|floatval}
			<tr>
				<td style="text-align: right; white-space: nowrap;"><b>{$lang.including_discount}:</b>&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;">
					{include file="common_templates/price.tpl" value=$order_info.discount}</td>
			</tr>
			{/if}
		
			{if $order_info.coupons}
			{foreach from=$order_info.coupons item="coupon" key="key"}
			<tr>
				<td style="text-align: right; white-space: nowrap;"><b>{$lang.coupon}:</b>&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;">{$key}</td>
			</tr>
			{/foreach}
			{/if}
			{if $order_info.taxes}
			<tr>
				<td style="text-align: right; white-space: nowrap;"><b>{$lang.taxes}:</b>&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;">&nbsp;</td>
			</tr>
			{foreach from=$order_info.taxes item=tax_data}
			<tr>
				<td style="text-align: right; white-space: nowrap;">{$tax_data.description}&nbsp;{include file="common_templates/modifier.tpl" mod_value=$tax_data.rate_value mod_type=$tax_data.rate_type}{if $tax_data.price_includes_tax == "Y" && $settings.Appearance.cart_prices_w_taxes != "Y"}&nbsp;{$lang.included}{/if}{if $tax_data.regnumber}&nbsp;({$tax_data.regnumber}){/if}:&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;">{include file="common_templates/price.tpl" value=$tax_data.tax_subtotal}</td>
			</tr>
			{/foreach}
			{/if}
			{if $order_info.tax_exempt == 'Y'}
			<tr>
				<td style="text-align: right; white-space: nowrap;"><b>{$lang.tax_exempt}</b></td>
				<td style="text-align: right; white-space: nowrap;">&nbsp;</td>
			<tr>
			{/if}
		
			{if $order_info.payment_surcharge|floatval}
			<tr>
				<td style="text-align: right; white-space: nowrap;">{$lang.payment_surcharge}:&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;"><b>{include file="common_templates/price.tpl" value=$order_info.payment_surcharge}</b></td>
			</tr>
			{/if}
		
		
			{if $order_info.shipping}
			<tr>
				<td style="text-align: right; white-space: nowrap;"><b>{$lang.shipping_cost}:</b>&nbsp;</td>
				<td style="text-align: right; white-space: nowrap;">{include file="common_templates/price.tpl" value=$order_info.display_shipping_cost}</td>
			</tr>
			{/if}
			{hook name="orders:totals"}
			{/hook}
			
			<tr>
				<td colspan="2"><hr style="border: 0px solid #d5d5d5; border-top-width: 1px;" /></td>
			</tr>
			<tr>
				<td style="text-align: right; white-space: nowrap; font: 15px Tahoma; text-align: right;">{$lang.total_cost}:&nbsp;</td>
				<td style="text-align: right; white-space: nowrap; font: 15px Tahoma; text-align: right;"><strong style="font: bold 17px Tahoma;">{include file="common_templates/price.tpl" value=$order_info.total}</strong></td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
	
		{* /Order totals *}
	
		{if $order_info.notes}
			<div style="float: left;"><strong>{$lang.notes}:</strong></div>
			<div style="padding-left: 7px; padding-bottom: 15px; overflow-x: auto; clear: both; width: 505px; height: 100%; padding-bottom: 20px; overflow-y: hidden;">{$order_info.notes|wordwrap:90:"\n":true|nl2br}</div>
		{/if}
	
		{if $content == "invoice"}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td>
				{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_arrow="on" skin_area="customer"}</td>
			<td align="right">
				{include file="buttons/button_popup.tpl" but_text=$lang.print_invoice but_href="`$index_script`?dispatch=orders.print_invoice&amp;order_id=`$order_info.order_id`" width="800" height="600"  skin_area="customer"}</td>
		</tr>
		</table>	
		{/if}
	{/if}
	
	{hook name="orders:invoice"}
	{/hook}
	</div>
	</td>
</tr>
</table>
